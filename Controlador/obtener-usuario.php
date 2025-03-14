<?php
include "../cors-conf/cors.php";

require_once "../Modelo/UsuariosDao.php";

if (isset($_GET["correo-sesion"])) {
    $correo = $_GET["correo-sesion"];

    $daoUsuarios = new UsuariosDAO();
    $usuario = $daoUsuarios->leerUsuarioPorCorreo($correo);

    echo json_encode($usuario[0]);
}
