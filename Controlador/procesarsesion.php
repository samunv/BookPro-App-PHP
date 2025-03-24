<?php
include "../cors-conf/cors.php";
require_once "../Modelo/SesionDao.php";

header('Content-Type: application/json');

$sesion = new SesionDao();
$array = array();

// Recibir datos JSON desde el cuerpo
$input = json_decode(file_get_contents("php://input"), true);

if (isset($input["accion"])) {
	$accion = $input["accion"];

	if ($accion == "crear" && isset($input["idUsuario"]) && isset($input["idEmpresa"])) {
		$idUsuario = $input["idUsuario"];
		$idEmpresa = $input["idEmpresa"];
		$token = generarTokenSesion();
		if ($sesion->crearSesion($token, $idUsuario, $idEmpresa)) {
			$array['token'] = $token;
		} else {
			$array['error'] = "No se pudo crear la sesión";
		}
	} elseif ($accion == "validar" && isset($input["idEmpresa"]) && isset($input["tokenDeSesion"])) {
		$idEmpresa = $input["idEmpresa"];
		$tokenDeSesion = $input["tokenDeSesion"];
		$resultado = $sesion->obtenerPorToken($tokenDeSesion, $idEmpresa);
		if ($resultado) {
			$array['exito'] = "Existe una sesión con estos datos.";
		} else {
			$array['error'] = "No existe una sesión con estos datos.";
		}
	} elseif ($accion == "cerrar" && isset($input["idEmpresa"]) && isset($input["tokenDeSesion"])) {
		$idEmpresa = $input["idEmpresa"];
		$tokenDeSesion = $input["tokenDeSesion"];
		$resultado = $sesion->eliminarSesion($tokenDeSesion, $idEmpresa);
		if ($resultado) {
			$array['exito'] = "Se ha cerrado y eliminado la sesión correctamente.";
		} else {
			$array['error'] = "No se ha podido eliminar la sesión.";
		}
	} else {
		$array['error'] = "Parámetros inválidos o acción no reconocida.";
	}
} else {
	$array['error'] = "Acción no especificada.";
}

echo json_encode($array);
exit;

function generarTokenSesion()
{
	$tamanio = 34;
	$caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$token = '';
	$maxIndex = strlen($caracteres) - 1;
	for ($i = 0; $i < $tamanio; $i++) {
		$token .= $caracteres[random_int(0, $maxIndex)];
	}
	return $token;
}
