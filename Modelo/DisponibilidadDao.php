<?php
require_once "Conexion.php";

class DisponibilidadDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function obtenerDisponibilidadesProfesional($idProfesional, $diaSemana)
    {
        $sql = "SELECT * FROM disponibilidad WHERE idProfesional = ? AND dia = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        if ($stmt === false) {
            return [];
        }
        $stmt->bind_param("is", $idProfesional, $diaSemana);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }



    // Verifica si hay solapamiento
    public function tieneSolapamiento($idProfesional, $dia, $horaInicio, $horaFin)
    {
        $sql = "SELECT id FROM disponibilidad
                WHERE idProfesional = ?
                AND dia = ?
                AND (hora_inicio < ? AND hora_fin > ?)";

        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("isss", $idProfesional, $dia, $horaFin, $horaInicio);
        $stmt->execute();

        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    // Insertar nueva disponibilidad
    public function insertarDisponibilidad($idProfesional, $dia, $horaInicio, $horaFin)
    {
        if ($horaInicio >= $horaFin) {
            return "Error: La hora de inicio debe ser menor que la de fin.";
        }

        if ($this->tieneSolapamiento($idProfesional, $dia, $horaInicio, $horaFin)) {
            return "Error: El rango horario se solapa con otro existente.";
        }

        $sql = "INSERT INTO disponibilidad (idProfesional, dia, hora_inicio, hora_fin)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("isss", $idProfesional, $dia, $horaInicio, $horaFin);

        if ($stmt->execute()) {
            return "Rango guardado correctamente.";
        } else {
            return "Error al guardar: " . $stmt->error;
        }
    }

    // Eliminar rango por ID
    public function eliminar($id)
    {
        $sql = "DELETE FROM disponibilidad WHERE id = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "Rango eliminado correctamente.";
        } else {
            return "Error al eliminar: " . $stmt->error;
        }
    }
}
