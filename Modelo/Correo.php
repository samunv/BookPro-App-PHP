<?php
require_once "./../Recursos/PHPMailer-master/src/PHPMailer.php";
require_once "./../Recursos/PHPMailer-master/src/SMTP.php";
require_once "./../Recursos/PHPMailer-master/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Correo
{
    private $mail;
    private $destinatario;
    private $asunto;
    private $mensaje;

    public function __construct(String $destinatario, String $asunto, String $mensaje)
    {
        $this->mail = new PHPMailer(true);
        $this->destinatario = $destinatario;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
    }

    public function enviarCorreo()
    {
        try {
            $mail = $this->mail;

            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'sur00044@gmail.com';
            $mail->Password = 'arnn welh rjbv uads';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del correo
            $mail->setFrom('sur00044@gmail.com', 'BarberPro');
            $mail->addAddress($this->destinatario);
            $mail->Subject = $this->asunto;
            $mail->Body = $this->mensaje;

            // Enviar el correo
            $mail->send();
            return true;
        } catch (Exception $e) {
            // Registrar el error en el log
            error_log("Error al enviar el correo: " . $mail->ErrorInfo . " --------- " . $e->getMessage());
            return false;
        }
    }
}
