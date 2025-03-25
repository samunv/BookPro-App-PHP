<?php
include "../cors-conf/cors.php";

require_once "../Modelo/NotificacionDao.php";
require_once "./../Modelo/UsuariosDao.php";

$daoNot = new NotificacionDAO();

if (isset($_GET["correo"])&&isset($_GET["idEmpresa"])) {
	$correo = $_GET["correo"];
	$idEmpresa = $_GET["idEmpresa"];
	$resultado = $daoNot->leerNotificacionesPorDestinatario($correo, $idEmpresa);
	echo json_encode($resultado);
}
if ((isset($_GET["borrarNotificaciones"]) && $_GET["borrarNotificaciones"] === "true") && isset($_GET["correoBorrar"])&&isset($_GET["idEmpresa"])) {
	$correo = $_GET["correoBorrar"];
	$idEmpresa = $_GET["idEmpresa"];
	$resultado = $daoNot->borrarNotificacionesPorCorreo($correo, $idEmpresa);
	echo json_encode($resultado);
}
