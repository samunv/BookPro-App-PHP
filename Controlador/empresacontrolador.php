<?php
require_once "../Modelo/EmpresaDao.php";
require_once "../cors-conf/cors.php";

header('Content-Type: application/json');

$empresaDao = new EmpresaDAO();

if (isset($_GET["idEmpresa"])) {

    $empresa = $empresaDao->obtenerPorId($_GET["idEmpresa"]);
    echo json_encode($empresa);
}


// Si es un POST (cuando se actualizan datos)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $logo = null;
    $banner = null;

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['logo']['name'];
        $rutaTemporal = $_FILES['logo']['tmp_name'];
        $directorioDestino = "../img-uploads/";

        // Validar tipo de archivo y extensión
        $tipoArchivo = mime_content_type($rutaTemporal);
        if ($tipoArchivo == 'image/jpeg' || $tipoArchivo == 'image/png') {
            // Guardar el archivo
            move_uploaded_file($rutaTemporal, $directorioDestino . "/" . $nombreArchivo);

            $logo = $directorioDestino . $nombreArchivo;
        } else {
            echo json_encode(["error" => "Solo se permiten imágenes JPEG o PNG."]);
            exit;
        }
    }

    // Lógica para manejar el banner
    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivoBanner = $_FILES['banner']['name'];
        $rutaTemporalBanner = $_FILES['banner']['tmp_name'];
        $directorioDestinoBanner = "../img-uploads/";

        // Validar tipo de archivo y extensión del banner
        $tipoArchivoBanner = mime_content_type($rutaTemporalBanner);
        $extensionesPermitidas = ['image/jpeg', 'image/png', 'image/webp', 'image/avif'];

        if (in_array($tipoArchivoBanner, $extensionesPermitidas)) {
            // Guardar el archivo banner
            move_uploaded_file($rutaTemporalBanner, $directorioDestinoBanner . $nombreArchivoBanner);
            $banner = $directorioDestinoBanner . $nombreArchivoBanner;
        } else {
            echo json_encode(["error" => "Solo se permiten imágenes JPEG, PNG, WebP o AVIF para el banner."]);
            exit;
        }
    }


    // Leemos los datos del formulario
    $nombreEmpresa = $_POST['nombre_empresa'] ?? null;
    $cif = $_POST['cif'] ?? null;
    $direccion = $_POST['direccion'] ?? null;
    $correo = $_POST['correo'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $idEmpresa = $_POST['idEmpresa'] ?? null;
    $color1 = $_POST['color1'] ?? null;
    $color2 = $_POST['color2'] ?? null;
    $accion = $_POST['accion'] ?? null;


    // Si no se ha subido un nuevo logo, obtener el logo actual de la empresa
    if (!$logo && isset($_POST['logo_actual'])) {
        $logo = $_POST['logo_actual'];
    }

    // Si no se ha subido un nuevo logo, obtener el logo actual de la empresa
    if (!$banner && isset($_POST['banner_actual'])) {
        $banner = $_POST['banner_actual'];
    }


    if ($accion === "actualizar" && $idEmpresa) {

        $datosActualizar = [
            "nombre_empresa" => $nombreEmpresa,
            "cif" => $cif,
            "direccion" => $direccion,
            "correo" => $correo,
            "telefono" => $telefono,
            "logo" => $logo,
            "color1" => $color1,
            "color2" => $color2,
            "banner" => $banner
        ];


        $resultado = $empresaDao->actualizar($idEmpresa, $datosActualizar);

        if ($resultado) {
            echo json_encode(
                $resultado
            );
        } else {
            echo json_encode([
                "error" => "No se pudo actualizar la empresa"
            ]);
        }
    } else {
        echo json_encode([
            "error" => "Datos incompletos o acción no válida"
        ]);
    }
}

if (isset($_GET["idEmpresaQuitarFondo"])) {
    $idEmpresa = $_GET["idEmpresaQuitarFondo"];
    echo json_encode($empresaDao->actualizarFondo($idEmpresa));
}
