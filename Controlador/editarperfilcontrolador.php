<?php
include "../cors-conf/cors.php";

require_once "../Modelo/UsuariosDao.php";

header("Content-Type: application/json");

// Obtener los datos JSON del cuerpo de la solicitud
$datosJSON = file_get_contents("php://input");
$datos = json_decode($datosJSON, true);

// Si los datos vienen en JSON, los pasamos a $_POST para compatibilidad
if ($datos) {
	$_POST = $datos;
}

if (isset($_POST["idUsuario"])&&isset($_POST["idEmpresa"])) {
	$daoUs = new UsuariosDao();

	if (isset($_POST["nombre"]) && $_POST["nombre"] != "") {
		// Comprobar si la longitud está entre 5 y 15 caracteres
		if (strlen($_POST["nombre"]) >= 5 && strlen($_POST["nombre"]) <= 15) {
			$verificarNombre = $daoUs->leerUsuarioPorNombre($_POST["nombre"], $_POST["idEmpresa"]);
			if (empty($verificarNombre)) {
				$nombreActualizado = $daoUs->actualizarNombre($_POST["nombre"], $_POST["idUsuario"], $_POST["idEmpresa"]);
				echo json_encode($nombreActualizado);
			} else {
				echo json_encode("Error");
			}
		} else {
			echo json_encode("Error");
		}
	} elseif (isset($_POST["telefono"]) && $_POST["telefono"] != "") {
		// Verificar que la longitud sea 9 caracteres
		if (strlen($_POST["telefono"]) == 9) {
			$verificarTelefono = $daoUs->leerUsuarioPorTelefono($_POST["telefono"],  $_POST["idEmpresa"]);
			if (empty($verificarTelefono)) {
				$telefonoActualizado = $daoUs->actualizarTelefono($_POST["telefono"], $_POST["idUsuario"],  $_POST["idEmpresa"]);
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
	$array = array();

	if (isset($_SESSION["nombre"])) {
		$cerrar = $sesion->cerrarSesion();
		$array['exito'] = "Sesión cerrada";
	} else {
		$array['error'] = "No existe una sesión";
	}

	echo json_encode($array);
}
if (isset($_GET["correoUsuario"]) && $_GET["idEmpresa"]) {
	$correo = $_GET["correoUsuario"];
	$idEmpresa = $_GET["idEmpresa"];
	$daoUs = new UsuariosDao();
	$resultado = $daoUs->leerUsuarioPorCorreo($correo, $idEmpresa);
	echo json_encode($resultado);
}
