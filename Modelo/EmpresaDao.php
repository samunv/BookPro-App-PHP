<?php

require_once "Conexion.php";
require_once 'Empresa.php';

class EmpresaDAO
{
    private $conexion;

    public function __construct()
    {
        return $this->conexion = new Conexion();
    }

    // Crear una nueva empresa (INSERT)
    public function crear(Empresa $empresa)
    {
        $sql = "INSERT INTO empresas 
        (nombre_empresa, direccion, cif, telefono, correo, logo_principal, logo1por1, color1, color2) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $logoPrincipal = $empresa->getLogoPrincipal() ?? "../img-uploads/empresa-default.png";
        $logo1por1 = $empresa->getLogo1por1() ?? "../img-uploads/empresa-default.png";
        $color1 = $empresa->getColor1() ?? "#003883";
        $color2 = $empresa->getColor2() ?? "#ebf3ff";

        $stmt = $this->conexion->getConexion()->prepare($sql);
        $nombreEmpresa = $empresa->getNombreEmpresa();
        $direccion = $empresa->getDireccion();
        $cif = $empresa->getCif();
        $telefono = $empresa->getTelefono();
        $correo = $empresa->getCorreo();

        $stmt->bind_param(
            "sssssssss",
            $nombreEmpresa,
            $direccion,
            $cif,
            $telefono,
            $correo,
            $logoPrincipal,
            $logo1por1,
            $color1,
            $color2
        );

        $resultado = $stmt->execute();
        if ($resultado) {
            $idEmpresa = $this->conexion->getConexion()->insert_id;
        } else {
            $idEmpresa = false;
        }

        $stmt->close();
        return $idEmpresa; // Devuelve el ID o false
    }


    // Leer empresa por correo (para verificar duplicados)
    public function leerEmpresaPorCorreo($correo)
    {
        $sql = "SELECT * FROM empresas WHERE correo = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $empresa = null;
        if ($fila = $resultado->fetch_assoc()) {
            $empresa = $fila; // Devuelve el array asociativo si encuentra una empresa
        }

        $stmt->close();
        return $empresa;
    }

    public function leerEmpresaPorNombre($nombre)
    {
        $sql = "SELECT * FROM empresas WHERE nombre_empresa = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $empresa = $resultado->fetch_assoc();
        $stmt->close();
        return $empresa;
    }

    public function leerEmpresaPorCif($cif)
    {
        $sql = "SELECT * FROM empresas WHERE cif = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("s", $cif);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $empresa = $resultado->fetch_assoc();
        $stmt->close();
        return $empresa;
    }



    // Obtener empresa por ID y devolver array
    public function obtenerPorId($idEmpresa)
    {
        $sql = "SELECT * FROM empresas WHERE idEmpresa = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("i", $idEmpresa);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($fila = $resultado->fetch_assoc()) {
            $empresa = $fila; // Devolvemos directamente el array asociativo
        } else {
            $empresa = null;
        }

        $stmt->close();
        return $empresa;
    }


    public function obtenerTodas()
    {
        $sql = "SELECT * FROM empresas";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datosArray = $resultado->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $datosArray;
    }


    // Actualizar empresa (UPDATE)
public function actualizar($idEmpresa, $empresa)
{
    $sql = "UPDATE empresas SET 
        nombre_empresa = ?, 
        direccion = ?, 
        cif = ?, 
        telefono = ?, 
        correo = ?,
        logo1por1 = ?, 
        color1 = ?,
        color2 = ?
        WHERE idEmpresa = ?";

    try {
        $stmt = $this->conexion->getConexion()->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $this->conexion->getConexion()->error);
        }

        $stmt->bind_param(
            "ssssssssi",
            $empresa['nombre_empresa'],
            $empresa['direccion'],
            $empresa['cif'],
            $empresa['telefono'],
            $empresa['correo'],
            $empresa['logo'],
            $empresa['color1'],
            $empresa['color2'],
            $idEmpresa
        );

        $resultado = $stmt->execute();

        if (!$resultado) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        $stmt->close();

        return [
            "exito" => "Empresa actualizada correctamente"
        ];

    } catch (mysqli_sql_exception $e) {

        // Código de error específico de clave duplicada
        if ($e->getCode() == 1062) {
            return [
                "error" => "Ya existe una empresa con ese valor único (probablemente el CIF o el correo está duplicado)."
            ];
        }

        return [
            "error" => "Error en la base de datos: " . $e->getMessage()
        ];

    } catch (Exception $e) {
        return [
            "error" => "Error: " . $e->getMessage()
        ];
    }
}


    // Eliminar empresa (DELETE)
    public function eliminar($idEmpresa)
    {
        $sql = "DELETE FROM empresas WHERE idEmpresa = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->bind_param("i", $idEmpresa);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }
}
