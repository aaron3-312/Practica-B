<?php
// ======================================================
// Archivo de prueba para envío de correo con PHPMailer
// ======================================================

require 'vendor/autoload.php';
require_once "correo_cita.php";

// Correo de destino para prueba
$correoPrueba = "aaronmolcruz@gmail.com";

// Datos ficticios de cita
$nombre = "Prueba Sistema";
$id_cita = rand(1000, 9999);
$fecha = date("Y-m-d");
$hora = "10:30";

echo "<h2>Enviando correo de prueba...</h2>";

$resultado = enviarCorreoCita($correoPrueba, $nombre, $id_cita, $fecha, $hora);

if ($resultado) {
    echo "<h3 style='color:green;'>✔ Correo enviado correctamente a $correoPrueba</h3>";
} else {
    echo "<h3 style='color:red;'>❌ Error al enviar correo (ver errores arriba)</h3>";
}

echo "<p>Revisa tu bandeja de entrada o SPAM.</p>";
?>