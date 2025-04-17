<?php
include "../cors-conf/cors.php";

require_once "../Modelo/ProfesionalesDao.php";
require_once "../Modelo/UsuariosDao.php";
require_once "./../Modelo/CitaDao.php";
require_once "../Modelo/ProfesionalesDao.php";
require_once "../Modelo/ServicioDao.php";
require_once "../Modelo/HorariosDao.php";
require_once "../Modelo/Notificacion.php";
require_once "../Modelo/NotificacionDao.php";
require_once "../Modelo/Correo.php";

header('Content-Type: application/json');


if (isset($_GET['idUsuarioParaIdProfesional'])) {
	$daoProf = new ProfesionalesDao();

	$idUsuarioParaIdProfesional = $_GET['idUsuarioParaIdProfesional'];
	$idProfesional = $daoProf->obtenerIdProfesionalPorIdUsuario($idUsuarioParaIdProfesional);

	echo json_encode($idProfesional);
}



if (isset($_GET["idProfesionalParaCitas"])) {
	$daoCitas = new CitaDao();
	$idProfesionalParaCitas = $_GET["idProfesionalParaCitas"];
	$citasDelProfesional = $daoCitas->leerCitas($idProfesionalParaCitas);
	echo json_encode($citasDelProfesional);
}

// if (isset($_GET["obtenerHorarios"]) && $_GET["obtenerHorarios"] === "true") {
// 	$daoHorarios = new HorariosDao();
// 	$horarios = $daoHorarios->leerHorarios();
// 	echo json_encode($horarios);
// }

if (isset($_GET["obtenerServicio"]) && $_GET["obtenerServicio"] === "true" && isset($_GET["idProfesionalParaServicios"])) {
	$daoServ = new ServicioDao();
	$respuesta = $daoServ->leerServiciosDeIdProfesional($_GET["idProfesionalParaServicios"]);
	echo json_encode($respuesta);
}

if (isset($_GET["idCitaParaEliminar"]) && isset($_GET["correoParaEliminar"]) && isset($_GET["datosCitaParaEliminar"])&&isset($_GET["idEmpresa"])) {
	$daoCitas = new CitaDao();
	$idCitaParaEliminar = $_GET["idCitaParaEliminar"];
	$correo = $_GET["correoParaEliminar"];
	$idEmpresa = $_GET["idEmpresa"];

	$datos = $_GET['datosCitaParaEliminar'];

	$daoCitas->eliminarCita($idCitaParaEliminar);
	crearNotificacion($correo, $datos, $idEmpresa);

	echo json_encode("Cita eliminada");
}

function crearNotificacion($correo, $datos, $idEmpresa)
{
	$datos = json_decode($datos, true);
	$notificacion = new Notificacion("Reserva Cancelada", "Se ha cancelado tu reserva de  " . $datos['servicio'] . " del " . $datos['fecha'] . " a las " . $datos['hora'], $correo, $idEmpresa);

	$notificacion->setImagen_notificacion("./img/notificacion-eliminar.png");
	$daoNotificacion = new NotificacionDAO();
	$daoNotificacion->crearNotificacion($notificacion);

	$notificacion->enviarNotificacionCorreo($notificacion);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);

    // Verifica si los datos necesarios están presentes
    if (isset($data['idCita'], $data['nuevaFecha'], $data['nuevaHora'], $data["nuevaHoraFin"],$data['idProfesional'], $data['idServicio'])) {
        $idCita = $data['idCita'];
        $nuevaFecha = $data['nuevaFecha'];
        $nuevaHora = $data['nuevaHora'];
		$nuevaHoraFin = $data['nuevaHoraFin'];
		$mes = $nuevaFecha['mes'];
		$fecha = $nuevaFecha['fecha'];
		$año = $nuevaFecha['año'];
		$idProfesional = $data['idProfesional'];
		$idServicio = $data['idServicio'];

       
        // Actualizar la cita
        $daoCitas = new CitaDao();
        $respuesta = $daoCitas->actualizarCita($idCita, $fecha, $mes, $año, $nuevaHora, $idProfesional, $idServicio, $nuevaHoraFin);
		// Verificar si la actualización fue exitosa

       echo json_encode($respuesta);
    } else {
        echo json_encode("Faltan datos necesarios.");
    }
}
