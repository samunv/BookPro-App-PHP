<?php
header("Access-Control-Allow-Origin: http://localhost:5173");

require_once "./../Modelo/CitaDao.php";
$daoCitas = new CitaDao();
$citas = $daoCitas->obtenerTodasLasCitas();
echo json_encode($citas);