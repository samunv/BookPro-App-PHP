<?php
header("Access-Control-Allow-Origin: http://localhost:5173");


require_once "../Modelo/UsuariosDao.php";
$daoUs = new UsuariosDao();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Verificar si se envió el ID del usuario
	$idUsuario = $_POST['idUsuario'];

	if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

		$nombreArchivo = $_FILES['file']['name'];  // Nombre original del archivo

		$directorio = '../img-uploads/';  // Directorio donde se guardará la imagen

		// Obtener la extensión del archivo
		$fileExtension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

		// Comprobar si la extensión es válida
		if ($fileExtension !== 'jpg' && $fileExtension !== 'jpeg' && $fileExtension !== 'png') {
			echo json_encode("Error");
		} else {
			// Establecer la ruta completa de destino (sin renombrar el archivo)
			$srcArchivoSubido = $directorio . $nombreArchivo;

			if (move_uploaded_file($_FILES['file']['tmp_name'], $srcArchivoSubido)) {

				$respuesta = $daoUs->actualizarFoto($srcArchivoSubido, $idUsuario);

				//NO CAMBIAR ESTA RESPUESTA, YA QUE CONTIENE URL DE LA IMAGEN A LA QUE SE ACCEDERÁ MEDIANTE LA MISMA
				echo json_encode($srcArchivoSubido);
			} else {
				echo json_encode("Error");
			}
		}
	} else {
		echo json_encode("Error");
	}
}
