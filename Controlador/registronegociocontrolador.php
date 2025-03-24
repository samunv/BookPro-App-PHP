<?php
require_once "../cors-conf/cors.php";
require_once "./../Modelo/Usuarios.php";
require_once "../Modelo/UsuariosDao.php";
require_once "../Modelo/Correo.php";
require_once "../Modelo/EmpresaDao.php";

// Crear una instancia de UsuarioDAO
$usuarioDAO = new UsuariosDao();

$array = array();

header('Content-Type: application/json; charset=utf-8');

// Comprobar si los datos han sido enviados
if (isset($_POST["nombre"]) && isset($_POST["contrasena"]) && isset($_POST["telefono"]) && isset($_POST["correo-registro"]) && isset($_POST["idEmpresa"]) && isset($_POST["permisos"])) {
    $inputNombre = $_POST["nombre"];
    $inputContrasena = $_POST["contrasena"];
    $inputTelefono = $_POST["telefono"];
    $inputCorreo = $_POST["correo-registro"];
    $idEmpresa = $_POST["idEmpresa"];
    $permisos = $_POST["permisos"];


    // Encriptar la constraseña del usuario para que no pueda ser vista desde la BBDD por protección de datos del usuario
    $contrasena_encriptada = password_hash($inputContrasena, PASSWORD_BCRYPT);

    // Verificar si el teléfono o el correo ya están en uso
    $verificarTelefono = $usuarioDAO->leerUsuarioPorTelefono($inputTelefono, $idEmpresa);

    // Si el teléfono ya está en uso
    if (!empty($verificarTelefono)) {
        $array["error"] = "El teléfono introducido no está disponible o ya está en uso en esta empresa.";
        echo json_encode($array);
        exit;
    }
    // Crear usuario si no hay conflictos
    $usuario = new Usuarios($inputNombre, $permisos, $inputTelefono, $contrasena_encriptada, "../img-uploads/perfil-default.png", $inputCorreo, $idEmpresa);
    $mensaje = $usuarioDAO->crearUsuario($usuario);

    $array["mensaje"] = $mensaje;
    echo json_encode($array);
    exit;
}


if (isset($_POST["correo_usuario"]) && isset($_POST["idEmpresa"])) {
    $array = array();
    $correo = $_POST["correo_usuario"];
    $idEmpresa = $_POST["idEmpresa"];
    $verificarCorreo = $usuarioDAO->leerUsuarioPorCorreo($correo, $idEmpresa);
    if (!empty($verificarCorreo)) {
        $array["error"] = "El correo introducido no está disponible o ya está en uso en esta empresa.";
    } else {
        // Crear un token único para confirmar el correo electrónico
        $tokenCorreo = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 8);

        // Enviar correo con el token
        if (enviarCorreo($correo, $tokenCorreo)) {
            $mensaje = $usuarioDAO->registrarCorreoYtokenParaValidar($correo, $tokenCorreo);
            $array["exito"] = $mensaje;
        } else {
            $array["error"] = "Error al enviar el correo de verificación.";
        }
    }
    echo json_encode($array);
}

// Verificación del token de correo
if (isset($_GET["token"]) && isset($_GET["correoToken"])) {

    if (
        $usuarioDAO->buscarToken($_GET["token"], $_GET["correoToken"])
    ) {

        $usuarioDAO->eliminarCorreoParaValidar($_GET["correoToken"]);
        echo json_encode(["exito" => "Usuario verificado con éxito."]);
    } else {
        $resultado = $usuarioDAO->eliminarCorreoParaValidar($_GET["correoToken"]); // Eliminar el usuario provisional tras guardarlo
        echo json_encode(["error" => "Token inválido para " . $_GET["correoToken"]]);
    }
}

if (
    isset($_POST["nombre_empresa"]) &&
    isset($_POST["cif"]) &&
    isset($_POST["direccion"]) &&
    isset($_POST["correo"]) &&
    isset($_POST["telefono"])
) {
    $empresaDao = new EmpresaDao();

    $nombreEmpresa = $_POST["nombre_empresa"];
    $cif = $_POST["cif"];
    $direccion = $_POST["direccion"];
    $correoEmpresa = $_POST["correo"];
    $telefonoEmpresa = $_POST["telefono"];

    // Verificar que el correo ya no exista
    $verificarCorreo = $empresaDao->leerEmpresaPorCorreo($correoEmpresa);
    if (!empty($verificarCorreo)) {
        echo json_encode(["error" => "El correo del negocio ya está en uso."]);
        exit;
    }

    // Verificar que el nombre de empresa ya no exista
    $verificarNombre = $empresaDao->leerEmpresaPorNombre($nombreEmpresa);
    if (!empty($verificarNombre)) {
        echo json_encode(["error" => "El nombre de empresa -$nombreEmpresa- ya está en uso."]);
        exit;
    }

    // Verificar que el CIF ya no exista
    $verificarCif = $empresaDao->leerEmpresaPorCif($cif);
    if (!empty($verificarCif)) {
        echo json_encode(["error" => "El CIF introducido ya está registrado en otra empresa."]);
        exit;
    }

    // Crear la empresa
    $empresa = new Empresa($nombreEmpresa, $direccion, $cif, $telefonoEmpresa, $correoEmpresa);
    $idEmpresa = $empresaDao->crear($empresa);

    if ($idEmpresa) {
        echo json_encode(["exito" => "Empresa registrada correctamente.", "idEmpresa" => $idEmpresa]);
    } else {
        echo json_encode(["error" => "Error al registrar la empresa."]);
    }
    exit;
}


if(isset($_GET["idEmpresaParaEliminar"])){
    $idEmpresa = $_GET["idEmpresaParaEliminar"];
    $empresaDao = new EmpresaDAO();
    $resultado = $empresaDao->eliminar($idEmpresa);
    if ($resultado) {
        echo json_encode(["exito" => "Se ha eliminado el registro de la empresa por falta de administrador."]);
    } else {
        echo json_encode(["error" => "Error al eliminar empresa."]);
    }
    exit;
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
