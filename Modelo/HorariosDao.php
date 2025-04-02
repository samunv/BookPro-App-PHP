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
        $datosArray[] = $reg['hora'];
    }

    $stmt->close();
    return $datosArray;  
}


    public function leerHorariosProfesional($idProfesional)
    {
        $sql = "SELECT h.hora FROM horarios h
            INNER JOIN horario_profesional hp ON h.idHorario = hp.idHorario
            WHERE hp.idProfesional = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("i", $idProfesional);
        $stmt->execute();
        $result = $stmt->get_result();

        $datosArray = array();
        while ($reg = $result->fetch_assoc()) {
            $datosArray[] = $reg['hora'];
        }
        $stmt->close();

        // Devolver el array con las horas
        return $datosArray;
    }


    public function leerHorasLibres($fecha, $mes, $año, $idProfesional)
    {
        $sql = "SELECT h.hora
            FROM horarios h
            INNER JOIN horario_profesional hp ON h.idHorario = hp.idHorario
            WHERE hp.idProfesional = ?
            AND h.hora NOT IN (
                SELECT c.hora
                FROM citas c
                WHERE c.fecha = ?
                AND c.mes = ?
                AND c.año = ?
                AND c.idProfesional = ?
            )
            ORDER BY h.hora";

        // Preparar la consulta
        $stmt = $this->conexion->getConexion()->prepare($sql);

        // Verificar si la preparación fue exitosa
        if ($stmt === false) {
            return json_encode(['error' => 'Error en la consulta SQL: ' . $this->conexion->getConexion()->error]);
        }

        // Asociar los parámetros en el orden correcto
        // 1. idProfesional (de la tabla horario_profesional)
        // 2. fecha, mes, año (de la cita)
        // 3. idProfesional (de la cita en la subconsulta)
        $stmt->bind_param("isssi", $idProfesional, $fecha, $mes, $año, $idProfesional);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        // Verificar si se obtuvieron resultados
        if ($result->num_rows > 0) {
            $datosArray = array();
            while ($reg = $result->fetch_assoc()) {
                $datosArray[] = $reg['hora'];
            }

            // Devolver los datos en formato JSON
            return json_encode($datosArray);
        } else {
            // Si no se encuentran horas libres, devolver mensaje
            return json_encode(['message' => 'No hay horas libres disponibles para esta fecha.']);
        }

        // Cerrar la declaración
        $stmt->close();
    }
}
