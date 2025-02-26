<?php
include "../cors-conf/cors.php";

require_once "./../Modelo/Usuarios.php";
require_once "../Modelo/UsuariosDao.php";
require_once "../Modelo/Correo.php";


session_start();

// Crear una instancia de UsuarioDAO
$usuarioDAO = new UsuariosDao();

$array = array();


// Variable para almacenar temporalmente los datos del usuario provisional
$usuarioProvisional = null;

// Comprobar si los datos han sido enviados
if (isset($_POST["nombre"]) && isset($_POST["contrasena"]) && isset($_POST["telefono"]) && isset($_POST["correo-registro"])) {
	$inputNombre = $_POST["nombre"];
	$inputContrasena = $_POST["contrasena"];
	$inputTelefono = $_POST["telefono"];
	$inputCorreo = $_POST["correo-registro"];

	// Encriptar la constraseña del usuario para que no pueda ser vista desde la BBDD por protección de datos del usuario
	$contrasena_encriptada = password_hash($inputContrasena, PASSWORD_BCRYPT);

	// Verificar si el teléfono o el correo ya están en uso
	$verificarTelefono = $usuarioDAO->leerUsuarioPorTelefono($inputTelefono);
	$verificarCorreo = $usuarioDAO->leerUsuarioPorCorreo($inputCorreo);

	// Si el teléfono ya está en uso
	if (!empty($verificarTelefono)) {
		$array["error"] = "El teléfono introducido no está disponible o ya está en uso.";
	}

	$usuario = new Usuarios($inputNombre, 0, $inputTelefono, $contrasena_encriptada, "../img-uploads/perfil-default.png", $inputCorreo, "");
	$mensaje = $usuarioDAO->crearUsuario($usuario);
	$array["mensaje"] = $mensaje;
	$array["provisional"] = true; // Indicador de usuario provisional
	echo json_encode($array);
}




if (isset($_POST["correo"])) {
	$array = array();
	$correo = $_POST["correo"];
	$verificarCorreo = $usuarioDAO->leerUsuarioPorCorreo($correo);
	if (!empty($verificarCorreo)) {
		$array["error"] = "El correo introducido no está disponible o ya está en uso.";
	} else {
		// Crear un token único para confirmar el correo electrónico
		$tokenCorreo = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 8);
		// Enviar correo con el token
		if (enviarCorreo($correo, $tokenCorreo)) {
			$array["token"] = $tokenCorreo;
		} else {
			$array["error"] = "Hubo un problema al enviar el correo de verificación.";
		}
	}
	echo json_encode($array);
}

// Verificación del token de correo
if (isset($_GET["token"]) && isset($_GET["correoToken"])) {

	if (
		$usuarioDAO->buscarToken($_GET["token"], $_GET["correoToken"])
	) {
		echo json_encode(["mensaje" => "Usuario verificado con éxito."]);
	} else {
		$resultado = $usuarioDAO->eliminarUsuario($_GET["correoToken"]); // Eliminar el usuario provisional tras guardarlo
		echo json_encode(["mensaje" => "Token inválido para " . $_GET["correoToken"]]);
	}
}


// Eliminación manual del usuario provisional
if (isset($_GET["correoEliminar"])) {
	$usuarioDAO->eliminarUsuario($_GET["correoEliminar"]);
	$array["mensaje"] = "Usuario provisional eliminado.";
	echo json_encode($array);
}

// Función para enviar correo
function enviarCorreo($correo, $token)
{
	// Crear el objeto de correo
	$c = new Correo(
		$correo,
		"Registro en BarberPro - Confirma que eres tú",
		"Tu código de verificación es: $token. Si no eres tú, ignora este correo."
	);
	return $c->enviarCorreo();
}
