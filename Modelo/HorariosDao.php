<?php
require_once "Conexion.php";

class HorariosDao
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }
    public function leerHorarios($diaSemana)
    {
        $sql = "SELECT * FROM horarios WHERE dia_semana = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);

        $stmt->bind_param("s", $diaSemana);

        $stmt->execute();

        $result = $stmt->get_result();
        $datosArray = array();

        // Recoger los resultados
        while ($reg = $result->fetch_assoc()) {
            $datosArray[] = $reg;
        }

        $stmt->close();
        return $datosArray;
    }



    public function leerHorariosProfesional($idProfesional, $diaSemana)
    {
        $sql = "SELECT * FROM horarios h
            INNER JOIN horario_profesional hp ON h.idHorario = hp.idHorario
            WHERE hp.idProfesional = ? AND h.dia_semana = ?";

        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("is", $idProfesional, $diaSemana);
        $stmt->execute();
        $result = $stmt->get_result();

        $datosArray = array();
        while ($reg = $result->fetch_assoc()) {
            $datosArray[] = $reg;
        }
        $stmt->close();
        return $datosArray;
    }


    public function leerHorasLibres($fecha, $mes, $año, $idProfesional, $diaSemana)
    {
        $sql = "SELECT DISTINCT h.hora
            FROM horarios h
            INNER JOIN horario_profesional hp ON h.idHorario = hp.idHorario
            WHERE hp.idProfesional = ? AND h.dia_semana = ?
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

        // 3. idProfesional (de la cita en la subconsulta)
        $stmt->bind_param("issssi", $idProfesional, $diaSemana, $fecha, $mes, $año, $idProfesional);

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
    }

    public function eliminarHorariosPorProfesional($idProfesional, $diaSemana)
    {
        $sql = " DELETE hp 
    FROM horario_profesional hp
    INNER JOIN horarios h ON hp.idHorario = h.idHorario
    WHERE hp.idProfesional = ? AND h.dia_semana = ?";

        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("is", $idProfesional, $diaSemana);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }


    public function agregarHorarioConDiaSemana($idProfesional, $idHorario)
    {
        //Relacionar el horario con el profesional en la tabla `horario_profesional`
        $sqlRelacion = "INSERT INTO horario_profesional (idProfesional, idHorario) VALUES (?, ?)";
        $stmtRelacion = $this->conexion->getConexion()->prepare($sqlRelacion);
        $stmtRelacion->bind_param("ii", $idProfesional, $idHorario);

        if ($stmtRelacion->execute()) {
            return true;
        }
        $stmtRelacion->close();

        return false;
    }
}
