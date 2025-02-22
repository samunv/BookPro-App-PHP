<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header('Content-Type: application/json');

require_once "../Modelo/UsuariosDao.php";
require_once "../Modelo/Sesion.php";

if (isset($_GET["idUsuario"])) {
	$daoUs = new UsuariosDao();
	$sesion = new Sesion();

	if (isset($_GET["nombre"]) && $_GET["nombre"] != "") {
		// Comprobar si la longitud está entre 5 y 15 caracteres
		if (strlen($_GET["nombre"]) >= 5 && strlen($_GET["nombre"]) <= 15) {
			$verificarNombre = $daoUs->leerUsuarioPorNombre($_GET["nombre"]);
			if (empty($verificarNombre)) {
				$nombreActualizado = $daoUs->actualizarNombre($_GET["nombre"], $_GET["idUsuario"]);
				echo json_encode($nombreActualizado);
			} else {
				echo json_encode("Error");
			}
		} else {
			echo json_encode("Error");
		}
	} elseif (isset($_GET["telefono"]) && $_GET["telefono"] != "") {
		// Verificar que la longitud sea 9 caracteres
		if (strlen($_GET["telefono"]) == 9) {
			$verificarTelefono = $daoUs->leerUsuarioPorTelefono($_GET["telefono"]);
			if (empty($verificarTelefono)) {
				$telefonoActualizado = $daoUs->actualizarTelefono($_GET["telefono"], $_GET["idUsuario"]);
				echo json_encode($telefonoActualizado);
			} else {
				echo json_encode("Error");
			}
		} else {
			echo json_encode("Error");
		}
	} else {
		echo json_encode("Algo está mal");
	}
} else if (isset($_GET['cerrarSesionBoolean']) && $_GET['cerrarSesionBoolean'] === 'true') {
	// Si se recibe el parámetro de cerrarSesionBoolean como true:
	$sesion = new Sesion();
	$array = array();

	if (isset($_SESSION["nombre"])) {
		$cerrar = $sesion->cerrarSesion();
		$array['exito'] = "Sesión cerrada";
	} else {
		$array['error'] = "No existe una sesión";
	}

	echo json_encode($array);
}
if(isset($_GET["correoUsuario"])){
	$correo = $_GET["correoUsuario"];
	$daoUs = new UsuariosDao();
	$resultado = $daoUs->leerUsuarioPorCorreo($correo);
	echo json_encode($resultado);
}