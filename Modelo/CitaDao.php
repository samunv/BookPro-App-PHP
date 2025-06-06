<?php
require_once "Cita.php";
require_once "Conexion.php";
class CitaDao
{

    /**
     * @var Conexion $conexion almacenar la conexion con la base de datos
     */

    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    //obtener todas las citas
    public function obtenerTodasLasCitas()
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "SELECT * FROM citas") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));   //ejecutar la consulta
        $datosArray = array();  //crear un array para almacenar los datos
        while ($reg = mysqli_fetch_array($consulta)) {  //recorrer los datos de la consulta
            $datosArray[] = $reg;  //almacenar los datos en el array
        }
        return $datosArray;  //devolver el array
    }

    public function leerCitas($idProfesional)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "
        SELECT 
            citas.*,
            usuarios.correo,
            usuarios.telefono, 
            usuarios.nombre, 
            usuarios.foto,
            usuarios.color1,
            usuarios.color2,
            servicios.*
        FROM citas
        INNER JOIN usuarios ON citas.idUsuario = usuarios.idUsuario
        INNER JOIN servicios ON citas.idServicio = servicios.idServicio
        WHERE citas.idProfesional = '$idProfesional'
        ORDER BY 
            año,
            CASE 
                WHEN mes = 'enero' THEN 1
                WHEN mes = 'febrero' THEN 2
                WHEN mes = 'marzo' THEN 3
                WHEN mes = 'abril' THEN 4
                WHEN mes = 'mayo' THEN 5
                WHEN mes = 'junio' THEN 6
                WHEN mes = 'julio' THEN 7
                WHEN mes = 'agosto' THEN 8
                WHEN mes = 'septiembre' THEN 9
                WHEN mes = 'octubre' THEN 10
                WHEN mes = 'noviembre' THEN 11
                WHEN mes = 'diciembre' THEN 12
            END,
            fecha, hora
    ") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));

        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }

        return $datosArray;
    }

    public function leerCitaPorId($id)
    {
        $conexion = $this->conexion->getConexion();
        $sql = "
            SELECT 
                citas.*, 
                usuarios.nombre AS nombreUsuario,
                usuarios.correo AS correoUsuario,
                usuarios.idEmpresa AS idEmpresa,
                servicios.nombreServicio AS nombreServicio
            FROM citas
            INNER JOIN usuarios ON citas.idUsuario = usuarios.idUsuario
            INNER JOIN servicios ON citas.idServicio = servicios.idServicio
            WHERE citas.idCita = '$id'
        ";

        $consulta = mysqli_query($conexion, $sql) or die("Error en consulta: " . mysqli_error($conexion));

        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            $datosArray[] = $reg;
        }

        return $datosArray;
    }


    public function leerCitasPorIdEmpresa($idEmpresa)
    {
        $conexion = $this->conexion->getConexion();

        $sql = "SELECT citas.* 
            FROM citas 
            INNER JOIN usuarios ON citas.idUsuario = usuarios.idUsuario 
            WHERE usuarios.idEmpresa = ?";

        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        $stmt->bind_param("i", $idEmpresa); // Asumiendo que idEmpresa es un entero
        $stmt->execute();

        $resultado = $stmt->get_result();
        $datosArray = [];

        while ($reg = $resultado->fetch_assoc()) {
            $datosArray[] = $reg;
        }

        $stmt->close();

        return $datosArray;
    }

    public function leerCitasPorAño($idEmpresa, $año)
    {
        $conexion = $this->conexion->getConexion();

        $sql = "SELECT citas.* 
            FROM citas 
            INNER JOIN usuarios ON citas.idUsuario = usuarios.idUsuario 
            WHERE usuarios.idEmpresa = ?
            AND citas.año = ? ";

        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        $stmt->bind_param("is", $idEmpresa, $año); // Asumiendo que idEmpresa es un entero
        $stmt->execute();

        $resultado = $stmt->get_result();
        $datosArray = [];

        while ($reg = $resultado->fetch_assoc()) {
            $datosArray[] = $reg;
        }

        $stmt->close();

        return $datosArray;
    }


    public function obtenerIngresosPorIdEmpresa($idEmpresa)
    {
        $conexion = $this->conexion->getConexion();

        $sql = "SELECT SUM(servicios.precio) AS ingresosTotales
            FROM citas
            INNER JOIN usuarios ON citas.idUsuario = usuarios.idUsuario
            INNER JOIN servicios ON citas.idServicio = servicios.idServicio
            WHERE usuarios.idEmpresa = ?";

        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        $stmt->bind_param("i", $idEmpresa);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();

        $stmt->close();

        // Si no hay citas, SUM() puede devolver null
        return $fila["ingresosTotales"] ?? 0;
    }


    public function leerCitasPorIdUsuario($idUsuario)
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "
            SELECT 
                citas.*,                     -- Seleccionar todo de citas
                usuarios.nombre AS nombreProfesional,  -- Seleccionar el nombre del profesional
                usuarios.correo AS correoProfesional,
                servicios.*                  -- Seleccionar todo de servicios
            FROM 
                citas
            JOIN 
                profesionales ON citas.idProfesional = profesionales.idProfesional
            JOIN 
                usuarios ON profesionales.idUsuario = usuarios.idUsuario
            JOIN 
                servicios ON citas.idServicio = servicios.idServicio
            WHERE 
                citas.idUsuario = '$idUsuario'
        ") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));

        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }
        return $datosArray;
    }


    public function verificarHoraYDia($hora, $dia)
    {
        $sql = "SELECT * FROM citas WHERE hora = ? AND fecha=?";
        $stmt = $this->conexion->getConexion()->prepare($sql);

        if ($stmt) {
            // Bind de parámetro y ejecución de la consulta
            $stmt->bind_param("ss", $hora, $dia);
            $stmt->execute();

            // Obtener resultados
            $result = $stmt->get_result();

            // Contar el número de filas encontradas
            $numRows = $result->num_rows;

            // Si hay alguna fila, la hora está ocupada
            if ($numRows > 0) {
                return false; // Hora ocupada
            } else {
                return true; // Hora disponible
            }
        }
    }

    public function crearCita(Cita $c)
    {
        if (!$this->verificarCitaExistente(
            $c->getFecha(),
            $c->getHora(),
            $c->getIdProfesional(),
            $c->getMes(),
            $c->getAño(),
        )) {
            return ["error" => "La cita ya existe."];
        }

        $sql = "INSERT INTO citas(idUsuario, fecha, hora, idProfesional, mes, año, idServicio, horaFin) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $consulta = $this->conexion->getConexion()->prepare($sql);
        if ($consulta) {
            $fecha = $c->getFecha();
            $hora = $c->getHora();
            $idUsuario = $c->getIdUsuario();
            $idProfesional = $c->getIdProfesional();
            $año = $c->getAño();
            $mes = $c->getMes();
            $idServicio = $c->getIdServicio();
            $horaFin = $c->getHoraFin();
            $consulta->bind_param("issisiis", $idUsuario, $fecha, $hora, $idProfesional, $mes, $año, $idServicio, $horaFin);

            $resultado = $consulta->execute();
            if ($resultado) {
                $idCita = $this->conexion->getConexion()->insert_id;
                return ["success" => true, "idCita" => $idCita, "mensaje" => "Cita creada con éxito."];
            } else {
                return ["error" => "Error al crear la cita."];
            }
        } else {
            return ["error" => "Error al preparar la consulta."];
        }
    }


    public function leerDiasOcupados()
    {
        $consulta = mysqli_query($this->conexion->getConexion(), "SELECT fecha
FROM citas
GROUP BY fecha
HAVING COUNT(DISTINCT hora) = (SELECT COUNT(*) FROM horarios)") or die("Error en consulta: " . mysqli_error($this->conexion->getConexion()));
        $datosArray = array();
        while ($reg = mysqli_fetch_array($consulta)) {
            $datosArray[] = $reg;
        }
        return $datosArray;
    }

    public function eliminarCita($id)
    {
        // Realizar la consulta de eliminación
        $consulta = mysqli_query($this->conexion->getConexion(), "DELETE FROM citas WHERE idCita='$id'");

        // Verificar si la consulta fue exitosa
        if ($consulta) {
            // Devolver un array con un mensaje de éxito
            return  "Cita eliminada correctamente.";
        } else {
            // Devolver un array con el error si la consulta falló
            return "Error al eliminar la cita: " . mysqli_error($this->conexion->getConexion());
        }
    }

    public function verificarCitaExistente($dia, $hora, $idProfesional, $mes, $año)
    {
        $sql = "SELECT * FROM citas WHERE fecha = ? AND hora = ? AND idProfesional = ? AND mes = ? AND año = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssiss", $dia, $hora, $idProfesional, $mes, $año);
            $stmt->execute();

            $result = $stmt->get_result();
            return $result->num_rows === 0;  // Devuelve true si no hay duplicados
        }

        return false;  // Error en la consulta
    }

    public function actualizarEstadoDePago($id)
    {
        $sql = "UPDATE citas SET pagado = ? WHERE idCita = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        $pagado = 1;

        if ($stmt) {
            // Vincular parámetros
            $stmt->bind_param("ii", $pagado, $id);

            // Ejecutar la consulta
            $stmt->execute();

            // Verificar si se ha actualizado alguna fila
            if ($stmt->affected_rows > 0) {
                return true;  // Se actualizó correctamente
            } else {
                return false; // No se actualizó nada (probablemente no encontró la cita)
            }
        }

        return false;  // Error al preparar la consulta
    }

    public function actualizarCita($idCita, $fecha, $mes, $año, $nuevaHora, $idProfesional, $idServicio, $nuevaHoraFin)
    {

        // Verificar que los parámetros no estén vacíos o nulos
        if (empty($fecha) || empty($mes) || empty($año) || empty($nuevaHora) || empty($idCita)) {
            return ["error" => "Faltan parámetros necesarios"];
        }

        if (!$this->verificarCitaExistente(
            $fecha,
            $nuevaHora,
            $idProfesional,
            $mes,
            $año,
        )) {
            return ["error" => "No se puede cambiar la cita al $fecha de $mes del $año a las $nuevaHora H, porque ya existe una cita en ese hueco."];
        }

        // Consulta SQL para actualizar la cita
        $sql = "UPDATE citas SET fecha = ?, mes = ?, año = ?, hora = ?, horaFin = ? WHERE idCita = ?";

        // Preparar la consulta
        $stmt = $this->conexion->getConexion()->prepare($sql);

        // Asegúrate de que los tipos de los parámetros sean correctos
        $stmt->bind_param("sssssi", $fecha, $mes, $año, $nuevaHora, $nuevaHoraFin, $idCita);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return
                ["exito"  => "Cita actualizada correctamente"];
        } else {
            // Si algo falla, devuelve el error detallado de la base de datos
            return ["error" => $stmt->error];
        }
    }
}
