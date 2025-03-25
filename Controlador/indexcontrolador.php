<?php
include "../cors-conf/cors.php";

require_once "../Modelo/UsuariosDao.php";
require_once "../Modelo/NotificacionDao.php";


if (isset($_GET["correoNotificaciones"])&&isset($_GET["idEmpresa"])) {
	$daoNot = new NotificacionDAO();
	$correo = $_GET["correoNotificaciones"];
	$idEmpresa = $_GET["idEmpresa"];
	$resultado = $daoNot->leerNotificacionesPorDestinatario($correo, $idEmpresa);
	echo json_encode($resultado);
}