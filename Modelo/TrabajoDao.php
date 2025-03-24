<?php
require_once "Trabajo.php";
require_once "Conexion.php";

class TrabajoDao
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function leerTrabajos($idEmpresa)
    {
        $conn = $this->conexion->getConexion();

        $sql = "SELECT t.idTrabajo, t.titulo, t.descripcion, t.imagen, 
        u.nombre AS nombreProfesional, 
        u.foto AS fotoProfesional,
        s.nombreServicio AS nombreServicio
        FROM trabajos t
        INNER JOIN profesionales p ON t.idProfesional = p.idProfesional
        INNER JOIN usuarios u ON p.idUsuario = u.idUsuario
        INNER JOIN servicios s ON t.idServicio = s.idServicio
        WHERE t.idEmpresa = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idEmpresa);
        $stmt->execute();


        $result = $conn->query($sql);
        $trabajos = [];

        while ($fila = $result->fetch_assoc()) {
            $trabajos[] = $fila;
        }

        return $trabajos;
    }
}
