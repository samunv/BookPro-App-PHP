<?php
require_once "Usuarios.php";
require_once "Conexion.php";

class UsuariosDao
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function leerUsuario($correo, $contrasena, $idEmpresa)
    {
        $sql = "SELECT * FROM usuarios WHERE correo=? AND contrasena=? AND idEmpresa = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("ssi", $correo, $contrasena, $idEmpresa);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function leerContraseñaPorCorreo($correo, $idEmpresa)
    {
        $sql = "SELECT contrasena FROM usuarios WHERE correo=? AND idEmpresa=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("si", $correo, $idEmpresa);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($reg = $resultado->fetch_assoc()) {
            return $reg['contrasena'];
        }
        return null;
    }

    public function leerUsuarioPorId($id)
    {
        $sql = "SELECT * FROM usuarios WHERE idUsuario=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function leerUsuarioPorTelefono($telefono, $idEmpresa)
    {
        $sql = "SELECT * FROM usuarios WHERE telefono=? AND idEmpresa=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("si", $telefono, $idEmpresa);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function leerUsuarioPorNombre($nombre, $idEmpresa)
    {
        $sql = "SELECT * FROM usuarios WHERE nombre=? AND idEmpresa=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("si", $nombre, $idEmpresa);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function leerUsuarioPorCorreo($correo, $idEmpresa)
    {
        $sql = "SELECT * FROM usuarios WHERE correo=? AND idEmpresa=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("si", $correo, $idEmpresa);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerId($correo, $idEmpresa)
    {
        $sql = "SELECT idUsuario FROM usuarios WHERE correo=? AND idEmpresa=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("si", $correo, $idEmpresa);
        $stmt->execute();

        // Obtener el primer resultado y devolver solo el idUsuario
        $resultado = $stmt->get_result()->fetch_assoc();

        // Si hay resultados, devolver el idUsuario, si no, devolver null o un valor indicativo
        return $resultado ? $resultado['idUsuario'] : null;
    }


    public function crearUsuario(Usuarios $u)
    {
        $sql = "INSERT INTO usuarios(nombre, permisos, telefono, contrasena, foto, correo, idEmpresa) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $nombre = $u->getNombre();
        $permisos = $u->getPermisos();
        $telefono = $u->getTelefono();
        $contrasena = $u->getContrasena();
        $foto = $u->getFoto();
        $correo = $u->getCorreo();
        $idEmpresa = $u->getIdEmpresa();

        $stmt->bind_param("sissssi", $nombre, $permisos, $telefono, $contrasena, $foto, $correo, $idEmpresa);
        if ($stmt->execute()) {
            return "Se ha registrado el usuario.";
        } else {
            return "Error al registrarse." . $stmt->error;;
        }
    }

    public function actualizarUsuario($nombre, $telefono, $contrasena, $correo)
    {
        $sql = "UPDATE usuarios SET nombre=?, telefono=?, contrasena=? WHERE correo=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $telefono, $contrasena, $correo);
        return $stmt->execute() ? "Se ha actualizado el usuario '$nombre'." : "Error al actualizar.";
    }

    public function actualizarNombre($nombre, $id, $idEmpresa)
    {
        $sql = "UPDATE usuarios SET nombre=? WHERE idUsuario=? AND idEmpresa=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("sii", $nombre, $id, $idEmpresa);
        return $stmt->execute() ? $nombre : "Error al actualizar.";
    }

    public function actualizarTelefono($telefono, $id, $idEmpresa)
    {
        $sql = "UPDATE usuarios SET telefono=? WHERE idUsuario=? AND idEmpresa=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("sii", $telefono, $id, $idEmpresa);
        return $stmt->execute() ? $telefono : "Error al actualizar.";
    }

    public function actualizarContrasena($contrasena, $correo)
    {
        $sql = "UPDATE usuarios SET contrasena=? WHERE correo=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("ss", $contrasena, $correo);
        return $stmt->execute() ? "Se ha actualizado la contraseña correctamente." : "Error al actualizar.";
    }

    public function actualizarFoto($foto, $id, $idEmpresa)
    {
        $sql = "UPDATE usuarios SET foto=? WHERE idUsuario=? AND idEmpresa=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("sii", $foto, $id, $idEmpresa);
        return $stmt->execute() ? "Se ha actualizado la foto de perfil." : "Error al actualizar.";
    }

    public function buscarToken($token, $correo)
    {
        $sql = "SELECT * FROM validacion_token WHERE token = ? AND correo = ? LIMIT 1";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("ss", $token, $correo);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function eliminarUsuario($correo)
    {
        $sql = "DELETE FROM usuarios WHERE correo=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("s", $correo);
        return $stmt->execute() ? "Se ha eliminado el usuario." : "Error al eliminar.";
    }

    public function registrarCorreoYtokenParaValidar($correo, $token)
    {
        $sql = "INSERT INTO validacion_token(correo, token) VALUES(?, ?)";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("ss", $correo, $token);
        if ($stmt->execute()) {
            return "Se ha almacenado el correo para confirmación";
        } else {
            return "Error al almacenar correo para confirmación.";
        }
    }

    public function eliminarCorreoParaValidar($correo)
    {
        $sql = "DELETE FROM validacion_token WHERE correo=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("s", $correo);
        return $stmt->execute() ? "Se ha eliminado el usuario." : "Error al eliminar.";
    }
}
