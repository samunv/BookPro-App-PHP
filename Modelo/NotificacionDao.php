<?php
require_once "Notificacion.php";
require_once "Conexion.php";

class NotificacionDAO
{
    private $conexion;

    public function __construct()
    {
        return $this->conexion = new Conexion();
    }

    public function crearNotificacion(Notificacion $n)
    {
        $sql = "INSERT INTO notificaciones(titulo, mensaje, destinatario, imagen_notificacion, idEmpresa) VALUES(?, ?, ?, ?, ?)";
        $consulta = $this->conexion->getConexion()->prepare($sql);
        if ($consulta) {
            $titulo = $n->getTitulo();
            $mensaje = $n->getMensaje();
            $destinatario = trim($n->getDestinatario());
            $imagen = $n->getImagen_notificacion();
            $idEmpresa = $n->getIdEmpresa();
            $consulta->bind_param("ssssi", $titulo, $mensaje, $destinatario, $imagen, $idEmpresa);

            $resultado = $consulta->execute();  // Verificar si la ejecución tuvo éxito
            if ($resultado) {
                return "Se ha creado una notificación.";
            } else {
                return "Error al crear notificación.";
            }
        } else {
            // Si la preparación falla, devolver un mensaje de error
            return "Error al preparar la consulta";
        }
    }

    public function leerNotificacionesPorDestinatario($destinatario, $idEmpresa)
    {
        $sql = "SELECT * FROM notificaciones WHERE destinatario = ? AND idEmpresa = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("si", $destinatario, $idEmpresa);
        $stmt->execute();
        $result = $stmt->get_result();
        $datosArray = array();
        while ($reg = $result->fetch_assoc()) {
            $datosArray[] = $reg;
        }
        $stmt->close();
        return $datosArray;
    }
    

    public function borrarNotificacionesPorCorreo($correo, $idEmpresa)
    {
        $sql = "DELETE FROM notificaciones where destinatario=? AND idEmpresa = ?";
        $consulta = $this->conexion->getConexion()->prepare($sql);
        if ($consulta) {
            $consulta->bind_param("si", $correo, $idEmpresa);
            $resultado = $consulta->execute();  // Verificar si la ejecución tuvo éxito
            if ($resultado) {
                return "Se han eliminado las notificaciones.";
            } else {
                return "Error al eliminar notificaciones.";
            }
        } else {
            // Si la preparación falla, devolver un mensaje de error
            return "Error al preparar la consulta";
        }
    }
}
