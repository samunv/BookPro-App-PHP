<?php
require_once "Usuarios.php";
require_once "Conexion.php";
class UsuariosDao
{
    private $conexion;

    public function __construct()
    {
        return $this->conexion = new Conexion();
    }

    public function leerUsuario($correo, $contrasena)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));
        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }
        return $datosArray;
    }

    public function leerContraseñaPorCorreo($correo)
    {
        // Evitar inyecciones SQL usando una variable escape
        $conexion = $this->conexion->getConexion();
        $correoEscapado = mysqli_real_escape_string($conexion, $correo);

        $consulta = mysqli_query($conexion, "SELECT contrasena FROM usuarios WHERE correo = '$correoEscapado'");

        // Verificamos si se obtuvo algún resultado
        if ($reg = mysqli_fetch_assoc($consulta)) {
            return $reg['contrasena'];
        } else {
            return null;  // Si no se encuentra el correo
        }
    }


    public function leerUsuarioPorId($id)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "SELECT * FROM usuarios WHERE idUsuario='$id'") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));
        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }
        return $datosArray;
    }

    public function leerUsuarioPorTelefono($telefono)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "SELECT * FROM usuarios WHERE telefono='$telefono'") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));
        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }

        return $datosArray;
    }

    public function leerUsuarioPorNombre($nombre)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "SELECT * FROM usuarios WHERE nombre='$nombre'") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));
        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }

        return $datosArray;
    }


    public function leerUsuarioPorCorreo($correo)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "SELECT * FROM usuarios WHERE correo='$correo'") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));
        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }

        return $datosArray;
    }


    public function obtenerId($nombre)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "SELECT idUsuario FROM usuarios WHERE nombre='$nombre'") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));
        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }

        return $datosArray;
    }



    public function crearUsuario(Usuarios $u)
    {
        $sql = "INSERT INTO usuarios(nombre, permisos, telefono, contrasena, foto, correo, token) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $consulta = $this->conexion->getConexion()->prepare($sql);
        if ($consulta) {
            $nombre = $u->getNombre();
            $permisos = $u->getPermisos();
            $telefono = $u->getTelefono();
            $contrasena = $u->getContrasena();
            $foto = $u->getFoto();
            $correo = $u->getCorreo();
            $token = $u->getToken();

            $consulta->bind_param("sisssss", $nombre, $permisos, $telefono, $contrasena, $foto, $correo, $token);

            $resultado = $consulta->execute();  // Verificar si la ejecución tuvo éxito
            if ($resultado) {
                return "Se ha registrado el usuario '$correo'.";
            } else {
                return "Error al registrarse.";
            }
        } else {
            // Si la preparación falla, devolver un mensaje de error
            return "Error al preparar la consulta";
        }
    }

    public function actualizarUsuario($nombre, $telefono, $contrasena, $correo)
    {
        $sql = "UPDATE usuarios SET nombre=?, telefono=?, contrasena=? WHERE correo=?";
        $consulta = $this->conexion->getConexion()->prepare($sql);
        if ($consulta) {
            $consulta->bind_param("ssss", $nombre, $telefono, $contrasena, $correo);

            $resultado = $consulta->execute();  // Verificar si la ejecución tuvo éxito
            if ($resultado) {
                return "Se ha actualizado el usuario '$nombre'.";
            } else {
                return "Error al actualizar.";
            }
        } else {
            // Si la preparación falla, devolver un mensaje de error
            return "Error al preparar la consulta";
        }
    }
    public function actualizarNombre($nombre, $id)
    {
        $sql = "UPDATE usuarios SET nombre=? WHERE idUsuario=?";
        $consulta = $this->conexion->getConexion()->prepare($sql);
        if ($consulta) {
            $consulta->bind_param("si", $nombre, $id);

            $resultado = $consulta->execute();  // Verificar si la ejecución tuvo éxito
            if ($resultado) {
                return $nombre;
            } else {
                return "Error al actualizar.";
            }
        } else {
            // Si la preparación falla, devolver un mensaje de error
            return "Error al preparar la consulta";
        }
    }

    public function actualizarTelefono($telefono, $id)
    {
        $sql = "UPDATE usuarios SET telefono=? WHERE idUsuario=?";
        $consulta = $this->conexion->getConexion()->prepare($sql);
        if ($consulta) {
            $consulta->bind_param("si", $telefono, $id);

            $resultado = $consulta->execute();  // Verificar si la ejecución tuvo éxito
            if ($resultado) {
                return $telefono;
            } else {
                return "Error al actualizar.";
            }
        } else {
            // Si la preparación falla, devolver un mensaje de error
            return "Error al preparar la consulta";
        }
    }

    public function actualizarContrasena($contrasena, $correo)
    {
        $sql = "UPDATE usuarios SET contrasena=? WHERE correo=?";
        $consulta = $this->conexion->getConexion()->prepare($sql);
        if ($consulta) {
            $consulta->bind_param("ss", $contrasena, $correo);

            $resultado = $consulta->execute();  // Verificar si la ejecución tuvo éxito
            if ($resultado) {
                return "Se ha actualizado la contraseña correctamente.";
            } else {
                return "Error al actualizar.";
            }
        } else {
            // Si la preparación falla, devolver un mensaje de error
            return "Error al preparar la consulta";
        }
    }

    public function actualizarFoto($foto, $id)
    {
        $sql = "UPDATE usuarios SET foto=? WHERE idUsuario=?";
        $consulta = $this->conexion->getConexion()->prepare($sql);
        if ($consulta) {
            $consulta->bind_param("si", $foto, $id);

            $resultado = $consulta->execute();  // Verificar si la ejecución tuvo éxito
            if ($resultado) {
                return "Se ha actualizado la foto de perfil.";
            } else {
                return "Error al actualizar.";
            }
        } else {
            // Si la preparación falla, devolver un mensaje de error
            return "Error al preparar la consulta";
        }
    }

    public function buscarToken($token, $correo)
    {
        $conexion = $this->conexion->getConexion();

        // Preparar la consulta
        $sql = "SELECT * FROM usuarios WHERE token = ? AND correo = ? LIMIT 1";
        $stmt = $conexion->prepare($sql);

        if (!$stmt) {
            return false; // Error al preparar la consulta
        }

        // Vincular parámetros
        $stmt->bind_param("ss", $token, $correo);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener resultados
        $resultado = $stmt->get_result();

        // Verificar si hay coincidencias
        $existe = $resultado->num_rows > 0;

        // Cerrar la consulta
        $stmt->close();

        return $existe;
    }




    public function eliminarUsuario($correo)
    {
        $sql = "DELETE FROM usuarios WHERE correo=?";
        $consulta = $this->conexion->getConexion()->prepare($sql);
        if ($consulta) {
            $consulta->bind_param("s", $correo);

            $resultado = $consulta->execute();  // Verificar si la ejecución tuvo éxito
            if ($resultado) {
                return "Se ha eliminado el usuario.";
            } else {
                return "Error al eliminar.";
            }
        } else {
            // Si la preparación falla, devolver un mensaje de error
            return "Error al preparar la consulta";
        }
    }
}
