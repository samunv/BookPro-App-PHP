<?php
require_once "Conexion.php";
class ServicioDao
{
    private $conexion;

    public function __construct()
    {
        return $this->conexion = new Conexion();
    }

    public function leerServicios($idEmpresa)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "SELECT * FROM servicios WHERE idEmpresa='$idEmpresa'") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));
        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }
        return $datosArray;
    }

    public function leerServiciosDeIdProfesional($id)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), 
        "SELECT s.*
        FROM profesional_servicio ps
        INNER JOIN servicios s ON ps.idServicio = s.idServicio
        WHERE ps.idProfesional = $id;") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));
        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }
        return $datosArray;
    }
}
