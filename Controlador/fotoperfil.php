<?php
include "../cors-conf/cors.php";


require_once "../Modelo/UsuariosDao.php";
$daoUs = new UsuariosDao();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idUsuario = isset($_REQUEST['idUsuario']) ? $_REQUEST['idUsuario'] : null;

    if (!$idUsuario) {
        echo json_encode(["errorIDusuario" => "Falta el usuario"]);
        exit;
    }

    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(["errorVacio" => "No se recibió ningún archivo"]);
        exit;
    }

    $nombreArchivo = $_FILES['file']['name'];
    $directorio = '../img-uploads/';

    // Obtener la extensión del archivo
    $fileExtension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

    // Validar formato de imagen
    if (!in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
        echo json_encode(["errorFormato" => "Formato de archivo no permitido"]);
        exit;
    }

    // Ruta completa de destino
    $srcArchivoSubido = $directorio . $nombreArchivo;
    $idEmpresa = $_POST["idEmpresa"];

    if (move_uploaded_file($_FILES['file']['tmp_name'], $srcArchivoSubido)) {
        $daoUs->actualizarFoto($srcArchivoSubido, $idUsuario, $idEmpresa);
        echo json_encode(["url" => $srcArchivoSubido]); // Devuelve la URL de la imagen
    } else {
        echo json_encode(["errorMover" => "Error al mover el archivo"]);
    }
}
