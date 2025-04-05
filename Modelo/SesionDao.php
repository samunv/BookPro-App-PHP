<?php
require_once "Conexion.php";

class SesionDao {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    // Crear una nueva sesión
    public function crearSesion($tokenSesion, $idUsuario, $idEmpresa) {
        $query = "INSERT INTO sesiones(tokenSesion, idUsuario, idEmpresa) 
                  VALUES (?, ?, ?)";
        $stmt = $this->conexion->getConexion()->prepare($query);

        $stmt->bind_param('sii', $tokenSesion, $idUsuario, $idEmpresa);
        if ($stmt->execute()) {
            $idSesion = $stmt->insert_id;
            return true;
        }
        return false;
    }

    // Obtener sesiones por usuario
    public function obtenerPorUsuario($idUsuario, $idEmpresa) {
        $query = "SELECT * FROM sesiones WHERE idUsuario = ? AND idEmpresa=?";
        $stmt = $this->conexion->getConexion()->prepare($query);
        $stmt->bind_param('ii', $idUsuario, $idEmpresa);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener sesión por token
    public function obtenerPorToken($tokenSesion, $idEmpresa) {
        $query = "SELECT * FROM sesiones WHERE tokenSesion = ? AND idEmpresa=?";
        $stmt = $this->conexion->getConexion()->prepare($query);
        $stmt->bind_param('si', $tokenSesion, $idEmpresa);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Eliminar sesión por token
    public function eliminarSesion($tokenSesion, $idEmpresa) {
        $query = "DELETE FROM sesiones WHERE tokenSesion = ? AND idEmpresa = ?";
        $stmt = $this->conexion->getConexion()->prepare($query);
        $stmt->bind_param('si', $tokenSesion, $idEmpresa);

        return $stmt->execute();
    }
}
?>
