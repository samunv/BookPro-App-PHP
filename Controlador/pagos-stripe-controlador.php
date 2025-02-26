<?php
include "../cors-conf/cors.php";

require_once '../Recursos/stripe-php-master/init.php';
require_once '../Modelo/CitaDao.php';

// Configurar la clave secreta de Stripe
\Stripe\Stripe::setApiKey('sk_test_51QeJlX03SQGnqkUoOvd5DSvuLG69FjLuQrD2rNBK6FYOuMz1ViiNPvVy1Qvp5UT8YIP7bxOZRdDiMGejDZOOvotp00Ii8Zp6mO');

// Obtener datos del frontend
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Verificar si los datos existen antes de usarlos
$amount = $data['amount'] ?? null;
$paymentMethodId = $data['payment_method_id'] ?? null;
$customerName = $data['customer_name'] ?? "Cliente Desconocido";
$customerEmail = $data['customer_email'] ?? null;
$idCita = $data['idCita'] ?? null;

// Validar que los datos obligatorios no estén vacíos
if (!$amount || !$paymentMethodId || !$customerEmail || !$idCita) {
	echo json_encode([
		'success' => false,
		'error' => 'Faltan datos obligatorios: amount, payment_method_id, customer_email o idCita'
	]);
	exit;
}

$daoCita = new CitaDao();
$leerCita = $daoCita->leerCitaPorId($idCita);

// Verificar si la cita existe en la base de datos antes de procesar el pago
if (!$leerCita || empty($leerCita)) {
	echo json_encode([
		'success' => false,
		'error' => 'No existe la cita que deseas pagar. Consulta la página de Mis Citas o reserva una nueva cita.'
	]);
	exit;
}

// Crear el PaymentIntent
try {
	$paymentIntent = \Stripe\PaymentIntent::create([
		'amount' => $amount,  // Monto en centavos
		'currency' => 'eur',  // Moneda
		'payment_method' => $paymentMethodId,  // ID del método de pago recibido del frontend
		'confirm' => true,  // Confirma inmediatamente el pago
		'confirmation_method' => 'manual',  // Confirmación manual del pago
		'payment_method_types' => ['card'],  // Acepta solo tarjetas de crédito
		'metadata' => [
			'customer_name' => $customerName,
			'customer_email' => $customerEmail,
			'service' => 'Pago de servicio en línea',
		],
		'receipt_email' => $customerEmail,  // Enviar recibo al cliente
	]);

	if ($paymentIntent->status === 'succeeded') {
		$resultado = $daoCita->actualizarEstadoDePago($idCita);
		echo json_encode([
			'success' => true,
			'paymentIntentId' => $paymentIntent->id,
			'clientSecret' => $paymentIntent->client_secret, // Necesario para confirmación en el frontend
			'status' => $paymentIntent->status,
			'update' => $resultado ? "Cita actualizada exitosamente" : "Error al actualizar la cita"
		]);
		exit;
	}

	echo json_encode([
		'success' => true,
		'paymentIntentId' => $paymentIntent->id,
		'clientSecret' => $paymentIntent->client_secret,
		'status' => $paymentIntent->status
	]);
	exit;

} catch (\Stripe\Exception\CardException $e) {
	echo json_encode(['success' => false, 'error' => $e->getError()->message]);
	exit;
} catch (\Stripe\Exception\ApiErrorException $e) {
	echo json_encode(['success' => false, 'error' => $e->getMessage()]);
	exit;
} catch (Exception $e) {
	echo json_encode(['success' => false, 'error' => 'Ocurrió un error inesperado: ' . $e->getMessage()]);
	exit;
}
