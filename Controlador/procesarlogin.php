<?php
include "../cors-conf/cors.php";

require_once "./../Modelo/Usuarios.php";
require_once "../Modelo/UsuariosDao.php";
require_once "../Modelo/Correo.php";


$usuarioDAO = new UsuariosDao();


if (isset($_POST["contrasenaLogin"]) && isset($_POST["correo"]) && isset($_POST["idEmpresa"])) {
	$inputContrasena = $_POST["contrasenaLogin"];
	$inputCorreo = $_POST["correo"];
	$idEmpresa = $_POST["idEmpresa"];

	$response = [];  // Estructura de respuesta unificada


	// Validación de correo
	if (!filter_var($inputCorreo, FILTER_VALIDATE_EMAIL)) {
		$response["error"] = "Correo inválido";
		echo json_encode($response);
		exit;
	}


	// Verificar si el usuario existe
	$contrasenaFinal = obtenerContraseñaEncriptada($inputContrasena, $inputCorreo, $idEmpresa);
	$usuarioVerificado = $usuarioDAO->leerUsuario($inputCorreo, $contrasenaFinal, $idEmpresa);

	if (!empty($usuarioVerificado)) {

		// Devolver los datos del usuario
		$response["usuario"] = $usuarioVerificado[0];
	} else {
		$response["error"] = "Lo sentimos. No existe ese usuario.";
	}
	echo json_encode($response);  // Enviar una única respuesta JSON
}

function obtenerContraseñaEncriptada($contrasenaRecibida, $correoRecibido, $idEmpresa)
{
	$usuarioDAO = new UsuariosDao();
	// Recuperamos el hash almacenado en la base de datos
	$encriptado = $usuarioDAO->leerContraseñaPorCorreo($correoRecibido, $idEmpresa);

	// Verificar la contraseña ingresada con el hash almacenado
	if (password_verify($contrasenaRecibida, $encriptado)) {
		return $encriptado;
		// Continuar con el proceso de autenticación
	} else {
		return null;
	}
}

if (isset($_GET["correoRecuperar"])) {
	$destinatario = $_GET["correoRecuperar"];
	$correo = new Correo($destinatario, "Recuperar mi Cuenta", "Haz click en este enlace para recuperar tu cuenta http://localhost/barbershopWebApp/Vista/recuperarcuenta.php?correo=$destinatario");
	$correo->enviarCorreo();
	echo json_encode("Correo enviado a $destinatario");
}
