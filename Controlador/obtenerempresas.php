<?php
include "../cors-conf/cors.php";

require_once "../Modelo/EmpresaDao.php";

$empresaDao = new EmpresaDAO();

$empresas = $empresaDao->obtenerTodas();

echo json_encode($empresas);