<?php
require_once "Conexion.php";
class ServicioDao
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function leerServicios($idEmpresa)
    {
        // Preparar la consulta
        $query = "SELECT * from servicios s WHERE s.idEmpresa = ?";

        // Preparar la consulta
        $stmt = $this->conexion->getConexion()->prepare($query);
        $stmt->bind_param("i", $idEmpresa);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->get_result();

        $datosArray = array();
        while ($reg = $resultado->fetch_array(MYSQLI_ASSOC)) {
            $datosArray[] = $reg;
        }

        // Cerrar la declaración
        $stmt->close();

        return $datosArray;
    }


    public function leerServiciosDeIdProfesional($id)
    {
        $consulta = mysqli_query(
            $this->conexion->getConexion(),
            "SELECT s.*
        FROM profesional_servicio ps
        INNER JOIN servicios s ON ps.idServicio = s.idServicio
        WHERE ps.idProfesional = $id;"
        ) or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));
        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }
        return $datosArray;
    }

    public function eliminarServicio($idServicio, $idEmpresa)
    {
        $query = "DELETE FROM servicios WHERE idServicio = ? AND idEmpresa = ?";
        $stmt = $this->conexion->getConexion()->prepare($query);
        $stmt->bind_param("ii", $idServicio, $idEmpresa);
        $stmt->execute();
        $stmt->close();

        if ($this->conexion->getConexion()->affected_rows > 0) {
            // Si se eliminó al menos una fila, la eliminación fue exitosa
            return true;
        } else {
            // Si no se eliminó ninguna fila, la eliminación falló
            return false;
        }
    }
}
