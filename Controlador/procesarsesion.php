<?php
header("Access-Control-Allow-Origin: http://localhost:5173");  // Permite solicitudes desde tu frontend
header("Access-Control-Allow-Credentials: true");  // Permite el envío de cookies (si estás usando sesiones)
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization");  // Encabezados permitidos
ini_set('session.cookie_samesite', 'None');  // Asegura que las cookies se envíen entre diferentes dominios
ini_set('session.cookie_secure', 'true');    // Si usas HTTPS

require_once "../Modelo/Sesion.php";

$sesion = new Sesion();

$array = array();

if ($sesion->getUsuario() == "") {
	$array['error'] = "No existe una sesión";
} else {
	$array['usuario'] = $sesion->getUsuario();
}

echo json_encode($array);


// if(isset($_SESSION["usuario_provisional"])){
// 	$usuario_provisional = $sesion->getUsuarioProvisional(); 
// 	$array['usuario_provisional'] = $usuario_provisional;
// } else{
// 	$array['error'] = "No existe un usuario provisional";
// }
