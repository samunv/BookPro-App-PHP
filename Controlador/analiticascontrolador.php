<?php
include "../cors-conf/cors.php";
require_once "../Modelo/UsuariosDao.php";
require_once "../Modelo/CitaDao.php";

if (isset($_GET["idEmpresa"], $_GET["accion"])) {
    $idEmpresa = $_GET["idEmpresa"];
    if ($_GET["accion"] == "leerUsuarios") {
        $daoUs = new UsuariosDao();
        $usuariosRegistrados = $daoUs->leerUsuariosPorIdEmpresa($idEmpresa);
        echo json_encode(count($usuariosRegistrados));
    }
    if ($_GET["accion"] == "leerCitas") {
        $daoCitas = new CitaDao();
        $citasReservadas = $daoCitas->leerCitasPorIdEmpresa($idEmpresa);
        echo json_encode(count($citasReservadas));
    }
    if ($_GET["accion"] == "obtenerIngresosEstimados") {
        $daoCitas = new CitaDao();
        $ingresosEstimados = $daoCitas->obtenerIngresosPorIdEmpresa($idEmpresa);
        echo json_encode($ingresosEstimados);
    }
    if ($_GET["accion"] == "obtenerCitasPorAños" && isset($_GET["año"])) {
        $año = $_GET["año"];
        $daoCitas = new CitaDao();


        $citas = $daoCitas->leerCitasPorAño($idEmpresa, $año);
        
        echo json_encode($citas);
    }
}
