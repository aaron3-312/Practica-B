<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

function enviarCorreoCita($correoDestino, $nombreCliente, $idCita, $fecha, $hora) {

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;
        $mail->Username = 'mxmotodoctor@gmail.com'; 
        $mail->Password = 'tmec aavm upzh ompu'; // Contraseña de app
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remitente
        $mail->setFrom('mxmotodoctor@gmail.com', 'MotoDoctor');

        // Destinatario
        $mail->addAddress($correoDestino);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = "Confirmación de cita #$idCita - MotoDoctor";
        $mail->Body = "
            <h2>Confirmación de tu cita en MotoDoctor</h2>
            <p>Hola <strong>$nombreCliente</strong>, estos son los detalles de tu cita:</p>
            <p><strong>ID:</strong> $idCita</p>
            <p><strong>Fecha:</strong> $fecha</p>
            <p><strong>Hora:</strong> $hora</p>
            <hr>
            <p>Gracias por confiar en nosotros.</p>
        ";

        // Enviar
        $mail->send();
        return true;

    } catch (Exception $e) {
        error_log("Error correo: " . $mail->ErrorInfo);
        return false;
    }
}