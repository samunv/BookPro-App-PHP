<?php
require_once "Conexion.php";

class HorariosDao
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function leerHorarios()
    {
        $sql = "SELECT hora FROM horarios";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $datosArray = array();
        while ($reg = $result->fetch_assoc()) {
            $datosArray[] = $reg;
        }
        
        $stmt->close();
        return $datosArray;
    }

    public function leerHorasLibres($fecha, $mes, $año, $idProfesional)
    {
        $sql = "SELECT h.hora
                FROM horarios h
                WHERE NOT EXISTS (
                    SELECT 1 
                    FROM citas c
                    WHERE c.hora = h.hora
                    AND c.fecha = ?
                    AND c.mes = ?
                    AND c.idProfesional = ?
                    AND c.año = ?
                )
                ORDER BY h.hora";

        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("ssii", $fecha, $mes, $idProfesional, $año);
        $stmt->execute();
        $result = $stmt->get_result();

        $datosArray = array();
        while ($reg = $result->fetch_assoc()) {
            $datosArray[] = $reg;
        }

        $stmt->close();
        return json_encode($datosArray);
    }
}
