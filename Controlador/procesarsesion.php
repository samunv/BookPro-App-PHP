<?php
include "../cors-conf/cors.php";
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
