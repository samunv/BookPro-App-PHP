<?php
header("Access-Control-Allow-Origin: http://localhost:5173");

require_once "../Modelo/ServicioDao.php";
$daoSer = new ServicioDao();
$servicios = $daoSer->leerServicios();
echo json_encode($servicios);