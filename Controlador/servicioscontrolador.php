<?php
include "../cors-conf/cors.php";

require_once "../Modelo/ServicioDao.php";
if(isset($_GET["idEmpresa"])){
    $daoSer = new ServicioDao();
    $servicios = $daoSer->leerServicios($_GET["idEmpresa"]);
    echo json_encode($servicios); 
}else{
    echo json_encode(["error"=>"Error al obtener servicios"]);
}
