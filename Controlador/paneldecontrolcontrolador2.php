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

if (isset($_GET["obtenerHorarios"]) && $_GET["obtenerHorarios"] === "true") {
	$daoHorarios = new HorariosDao();
	$horarios = $daoHorarios->leerHorarios();
	echo json_encode($horarios);
}

if (isset($_GET["obtenerServicio"]) && $_GET["obtenerServicio"] === "true" && isset($_GET["idProfesionalParaServicios"])) {
	$daoServ = new ServicioDao();
	$respuesta = $daoServ->leerServiciosDeIdProfesional($_GET["idProfesionalParaServicios"]);
	echo json_encode($respuesta);
}

if (isset($_GET["idCitaParaEliminar"]) && isset($_GET["correoParaEliminar"]) && isset($_GET["datosCitaParaEliminar"])) {
	$daoCitas = new CitaDao();
	$idCitaParaEliminar = $_GET["idCitaParaEliminar"];
	$correo = $_GET["correoParaEliminar"];

	$datos = $_GET['datosCitaParaEliminar'];

	$daoCitas->eliminarCita($idCitaParaEliminar);
	crearNotificacion($correo, $datos);

	echo json_encode("Cita eliminada");
}

function crearNotificacion($correo, $datos)
{
	$datos = json_decode($datos, true);
	$notificacion = new Notificacion("Reserva Cancelada", "Se ha cancelado tu reserva de  " . $datos['servicio'] . " el " . $datos['fecha'] . " de " . $datos['mes'] . " de " . $datos['año'] . " a las " . $datos['hora'], $correo, "");

	$notificacion->setImagen_notificacion("./img/notificacion-eliminar.png");
	$daoNotificacion = new NotificacionDAO();
	$daoNotificacion->crearNotificacion($notificacion);

	$notificacion->enviarNotificacionCorreo($notificacion);
}
