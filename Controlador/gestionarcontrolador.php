<?php
require_once "../cors-conf/cors.php";
require_once "../Modelo/ProfesionalesDao.php";
require_once "../Modelo/Usuarios.php";
require_once "../Modelo/UsuariosDao.php";
require_once "../Modelo/HorariosDao.php";


$array = array();
$usuariosDao = new UsuariosDao();

if (isset($_GET["idEmpresa"])) {
    $profesionalesDao = new ProfesionalesDao();
    $idEmpresa = $_GET["idEmpresa"];
    $profesionales = $profesionalesDao->leerProfesionales($idEmpresa);
    echo json_encode($profesionales);
}


if (isset($_POST["nombre"], $_POST["correo"], $_POST["telefono"], $_POST["contrasena"], $_POST["idEmpresa"])) {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $contrasena = $_POST["contrasena"];
    $idEmpresa = $_POST["idEmpresa"];
    $permisos = 1;
    $fotoPredeterminada = "../img-uploads/perfil-default.png";

    // Encriptar la constraseña del usuario para que no pueda ser vista desde la BBDD por protección de datos del usuario
    $contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

    // Si el teléfono ya está en uso
    $verificarTelefono = $usuariosDao->leerUsuarioPorTelefono($telefono, $idEmpresa);
    if (!empty($verificarTelefono)) {
        $array["error"] = "El teléfono introducido no está disponible o ya está en uso en esta empresa.";
        echo json_encode($array);
        exit;
    }

    $verificarCorreo = $usuariosDao->leerUsuarioPorCorreo($correo, $idEmpresa);
    if (!empty($verificarCorreo)) {
        $array["error"] = "El correo introducido no está disponible o ya está en uso en esta empresa.";
    } else {
        $usuarioProfesional = new Usuarios($nombre, $permisos, $telefono, $contrasena_encriptada, $fotoPredeterminada, $correo, $idEmpresa);
        $usuariosDao->crearUsuario($usuarioProfesional);

        $resultado = $usuariosDao->obtenerId($correo, $idEmpresa);

        crearProfesional($resultado);
    }
}


function crearProfesional($idUsuario)
{
    $profesionalesDao = new ProfesionalesDao();
    $resultado = $profesionalesDao->crearProfesional($idUsuario);

    $array["exito"] = $resultado;
    echo json_encode($resultado);
}


if(isset($_GET["idProfesionalEliminar"])){
    $profesionalesDao = new ProfesionalesDao();
    $resultado = $profesionalesDao->eliminarProfesional($_GET["idProfesionalEliminar"]);
    echo json_encode($resultado);
}

if(isset($_GET["horarios"])&& $_GET["horarios"]==="true"){
    $daoHorario = new HorariosDao();
    $horarios = $daoHorario->leerHorarios();
    echo json_encode($horarios);
}

if(isset($_GET["idProfesionalParaHorarios"])){
    $daoHorario = new HorariosDao();
    $resultado = $daoHorario->leerHorariosProfesional($_GET["idProfesionalParaHorarios"]);
    echo json_encode($resultado);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['idProfesionalParaActualizarHorarios'])) {
    $idProfesional = $_GET['idProfesionalParaActualizarHorarios'];
    
    // Leemos el cuerpo de la solicitud (el JSON enviado)
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Si no recibimos los horarios, devolvemos un error
    if (!isset($data['horarios'])) {
        echo json_encode(['error' => 'No se han enviado los horarios']);
        exit;
    }

    $horarios = $data['horarios'];
    $daoHorarios = new HorariosDao();

    // Eliminar las relaciones previas del profesional con los horarios
    $daoHorarios->eliminarHorariosPorProfesional($idProfesional);

    foreach ($horarios as $horaProfesional) {
        $idHorario = $horaProfesional['idHorario'];
        $daoHorarios->agregarHorarioParaProfesional($idProfesional, $idHorario);
    }

    // Enviamos la respuesta indicando que todo salió bien
    echo json_encode(['message' => 'Horarios actualizados exitosamente']);
}