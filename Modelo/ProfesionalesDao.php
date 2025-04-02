<?php
require_once "Profesional.php";
require_once "Conexion.php";
class ProfesionalesDao
{

    /**
     * @var Conexion $conexion almacenar la conexion con la base de datos
     */

    private $conexion;

    public function __construct()
    {
        return $this->conexion = new Conexion();
    }

    public function leerProfesionales($idEmpresa)
    {
        $sql = "SELECT p.idProfesional, u.nombre AS nombreProfesional, u.correo AS correo, u.telefono AS telefono, u.foto as foto
            FROM profesionales p
            LEFT JOIN usuarios u ON p.idUsuario = u.idUsuario
            WHERE u.idEmpresa = ?";

        $consulta = $this->conexion->getConexion()->prepare($sql);
        $consulta->bind_param("i", $idEmpresa); // "i" es para entero, asumiendo que idEmpresa es entero
        $consulta->execute();
        $resultado = $consulta->get_result();

        $datosArray = array();
        while ($reg = $resultado->fetch_array()) {
            $datosArray[] = $reg;
        }

        return $datosArray;
    }


    public function leerNombre($id)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "
            SELECT usuarios.nombre
            FROM profesionales
            INNER JOIN usuarios ON profesionales.idUsuario = usuarios.idUsuario
            WHERE profesionales.idProfesional = '$id'
        ") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));

        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }
        return $datosArray;
    }

    public function leerProfesionalPorServicio($idServicio, $idEmpresa)
    {
        $conexion = $this->conexion->getConexion();

        $stmt = $conexion->prepare("
            SELECT profesionales.*, usuarios.*, profesional_servicio.*
            FROM profesionales
            INNER JOIN profesional_servicio ON profesionales.idProfesional = profesional_servicio.idProfesional
            INNER JOIN usuarios ON profesionales.idUsuario = usuarios.idUsuario
            WHERE profesional_servicio.idServicio = ? 
            AND usuarios.idEmpresa = ?
        ");

        if (!$stmt) {
            die("Error en prepare: " . $conexion->error);
        }

        $stmt->bind_param("ii", $idServicio, $idEmpresa);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $datosArray = [];

        while ($reg = $resultado->fetch_assoc()) {
            $datosArray[] = $reg;
        }

        $stmt->close();

        return $datosArray;
    }




    public function obtenerIdProfesionalPorIdUsuario($idUsuario)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "
        SELECT idProfesional
        FROM profesionales
        WHERE idUsuario = '$idUsuario'
    ") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));

        // Solo esperamos un resultado, así que verificamos si hay una fila y la devolvemos
        if ($reg = mysqli_fetch_array($consulta)) {
            return $reg['idProfesional'];
        }
        return null; // Retorna null si no se encuentra un profesional con ese idUsuario
    }

    public function eliminarProfesional($idProfesional)
    {
        $sql = "DELETE FROM profesionales WHERE idProfesional = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("i", $idProfesional);
        if ($stmt->execute()) {
            return "Se ha eliminado el profesional.";
        } else {
            return "Error al eliminar el profesional.". $stmt->error;;
        }
    }
    
    public function crearProfesional($idUsuario)
    {
        $sql = "INSERT INTO profesionales(idUsuario) VALUES(?)";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("i", $idUsuario);
        if ($stmt->execute()) {
            return "Se ha registrado el profesional.";
        } else {
            return "Error al registrar profesional.". $stmt->error;;
        }
    }
}
