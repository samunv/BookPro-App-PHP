<?php
require_once "../Modelo/TrabajoDao.php";
require_once "../cors-conf/cors.php";

if (isset($_GET["idEmpresa"])) {
    $daoTrabajos = new TrabajoDao();

    $trabajos = $daoTrabajos->leerTrabajos($_GET["idEmpresa"]);

    echo json_encode($trabajos);
}
