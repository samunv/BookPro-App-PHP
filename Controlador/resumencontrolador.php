<?php
include "../cors-conf/cors.php";

require_once "./../Modelo/ProfesionalesDao.php";
require_once "./../Modelo/CitaDao.php";
require_once "./../Modelo/Cita.php";
require_once "./../Modelo/Correo.php";
require_once "./../Modelo/Notificacion.php";
require_once "./../Modelo/NotificacionDao.php";


if (isset($_GET['fecha']) && isset($_GET['hora']) && isset($_GET['horaFin']) && isset($_GET['idUsuario']) && isset($_GET['idProfesional']) && isset($_GET['mes']) && isset($_GET['año']) && isset($_GET['idServicio']) && isset($_GET["correo"]) && isset($_GET["idEmpresa"])) {

	$fecha = $_GET['fecha'];
	$hora = $_GET['hora'];
	$horaFin = $_GET['horaFin'];
	$idUsuario = $_GET['idUsuario'];
	$idProfesional = $_GET['idProfesional'];
	$mes = $_GET['mes'];
	$año = $_GET['año'];
	$idServicio  = $_GET['idServicio'];
	$correo = $_GET['correo'];
	$idEmpresa = $_GET['idEmpresa'];

	$daoCita = new CitaDao();
	$cita = new Cita($idUsuario, $fecha, $hora, $horaFin, $idProfesional, $mes, $año, $idServicio);
	$fechaCita = $fecha . " de " .  $mes . " de " . $año . " a las " . $hora . " hasta las " . $horaFin;

	$notificacion = new Notificacion("Reserva de Cita", "Has reservado una cita el $fechaCita.", $correo, $idEmpresa);
	$notificacion->setImagen_notificacion("./img/notificacion-reserva.png");


	$reservaCompletada = $daoCita->crearCita($cita);
	enviarNotificacion($notificacion);

	echo json_encode($reservaCompletada);
} else if (isset($_GET["correoDestinatario"]) && isset($_GET["cliente"]) && isset($_GET["hora"]) && isset($_GET["fecha"]) && isset($_GET["mes"]) && isset($_GET["año"]) && isset($_GET["servicio"]) && isset($_GET["idEmpresa"])) {

	$destinatario = $_GET["correoDestinatario"];
	$cliente = $_GET["cliente"];
	$servicio = $_GET["servicio"];
	$hora = $_GET["hora"];
	$fecha = $_GET["fecha"];
	$mes = $_GET["mes"];
	$año = $_GET["año"];
	$idEmpresa = $_GET["idEmpresa"];

	$fechaCita = $fecha . " de " .  $mes . " de " . $año . " a las " . $hora;

	$notificacion = new Notificacion("Reserva de Cita", "$cliente ha reservado una cita de $servicio el $fechaCita.", $destinatario, $idEmpresa);
	$notificacion->setImagen_notificacion("./img/notificacion-reserva.png");
	enviarNotificacion($notificacion);
	echo json_encode("Notificación enviada al destinatario.");
}

// Función para enviar notificación
function enviarNotificacion($notificacion)
{
	$daoNotificacion = new NotificacionDAO();
	$daoNotificacion->crearNotificacion($notificacion);
	$notificacion->enviarNotificacionCorreo($notificacion);
}

// Función para enviar correo
function enviarCorreo($correo, $fecha)
{
	$c = new Correo($correo, "Cita Reservada", "Tu cita de $fecha ha sido reservada con éxito. Para más información mira la página de Mis citas en la aplicación.");
	$c->enviarCorreo();
}
