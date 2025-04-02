<?php
include "../cors-conf/cors.php";

require_once "../Modelo/UsuariosDao.php";
require_once "../Modelo/NotificacionDao.php";
require_once "../Modelo/UsuariosDao.php";
require_once "../Modelo/SesionDao.php";

if (isset($_GET["correoNotificaciones"])&&isset($_GET["idEmpresa"])&&isset($_GET["idUsuario"])) {

	$idEmpresa = $_GET["idEmpresa"];
	$idUsuario = $_GET["idUsuario"];

	$sesionDao = new SesionDao();
	if(!empty($sesionDao->obtenerPorUsuario($idUsuario, $idEmpresa))){
		$daoNot = new NotificacionDAO();
		$correo = $_GET["correoNotificaciones"];
		
		$resultado = $daoNot->leerNotificacionesPorDestinatario($correo, $idEmpresa);
		echo json_encode($resultado);
	}else{
		http_response_code(403);
		echo json_encode(["error"=>"No puedes acceder"]);
	}

	
}