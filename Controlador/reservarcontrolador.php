<?php
include "../cors-conf/cors.php";

require_once "./../Modelo/HorariosDao.php";
require_once "../Modelo/ProfesionalesDao.php";


if (isset($_GET['diaParaHorario']) && isset($_GET['idProfesionalParaHorario']) && isset($_GET['anoParaHorario']) && isset($_GET['mesParaHorario'])&& isset($_GET['diaSemanaParaHorario'])) {

	// Si se reciben esos parámetros, obtener los horarios disponibles

	$daoHorario = new HorariosDao();

	$diaParaHorario = $_GET['diaParaHorario'];
	$idProfesionalParaHorario = $_GET['idProfesionalParaHorario'];
	$añoParaHorario = $_GET['anoParaHorario'];
	$mesParaHorario = $_GET['mesParaHorario'];
	$diaSemanaParaHorario = $_GET['diaSemanaParaHorario'];

	$horasDisponibles = $daoHorario->leerHorasLibres($diaParaHorario, $mesParaHorario, $añoParaHorario, $idProfesionalParaHorario, $diaSemanaParaHorario);

	echo $horasDisponibles;
}


if (isset($_GET['idServicioParaProfesionales'])&&isset($_GET["idEmpresaParaProfesionales"])) {

	// obtener los profesionales que estén relacionados con el servicio con idServicioParaProfesionales

	$daoProf = new ProfesionalesDao();

	$idServicioParaProfesionales = $_GET['idServicioParaProfesionales'];
	$idEmpresaParaProfesionales = $_GET['idEmpresaParaProfesionales'];
	$profesionales = $daoProf->leerProfesionalPorServicio($idServicioParaProfesionales, $idEmpresaParaProfesionales);

	echo json_encode($profesionales);
}
