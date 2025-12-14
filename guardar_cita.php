<?php
include("conexion.php");
include("correo_cita.php"); // <- Importante

function clean($s){ 
    global $conn; 
    return $conn->real_escape_string(trim($s)); 
}

$nombre = clean($_POST['nombre']);
$telefono = clean($_POST['telefono']);
$correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
$marca = clean($_POST['marca']);
$modelo = clean($_POST['modelo']);
$anio = intval($_POST['anio']);
$placas = clean($_POST['placas']);
$fecha_cita = $_POST['fecha_cita'];
$hora_cita = $_POST['hora_cita'];
$servicio = clean($_POST['servicio']);

// -------------------------
// 🔹 VALIDACIONES BACKEND
// -------------------------

if(strlen($nombre) < 3){
    die("Nombre inválido");
}
if(!preg_match('/^\d{7,15}$/',$telefono)){
    die("Teléfono inválido");
}
if(!$fecha_cita || !$hora_cita){
    die("Fecha u hora inválidas");
}

// -------------------------
// 🔹 CONTROL: FECHA/HORA NO DISPONIBLE
// -------------------------

$stmt = $conn->prepare("SELECT COUNT(*) FROM citas WHERE fecha_cita = ? AND hora_cita = ?");
$stmt->bind_param("ss",$fecha_cita,$hora_cita);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if($count > 0){
    header("Location: registro_cita.php?error=ocupado");
    exit;
}

// -------------------------
// 🔹 INSERTAR CLIENTE
// -------------------------

$conn->query("
    INSERT INTO clientes (nombre, telefono, correo)
    VALUES ('$nombre', '$telefono', '$correo')
");

$id_cliente = $conn->insert_id;

// -------------------------
// 🔹 INSERTAR MOTO
// -------------------------

$conn->query("
    INSERT INTO motos (marca, modelo, anio, placas, id_cliente)
    VALUES ('$marca', '$modelo', '$anio', '$placas', '$id_cliente')
");

$id_moto = $conn->insert_id;

// -------------------------
// 🔹 INSERTAR CITA
// -------------------------

$conn->query("
    INSERT INTO citas (id_cliente, id_moto, fecha_cita, hora_cita, servicio, estado)
    VALUES ('$id_cliente', '$id_moto', '$fecha_cita', '$hora_cita', '$servicio', 'Pendiente')
");

$id_cita = $conn->insert_id;
require_once "correo_cita.php";
enviarCorreoCita($correo, $nombre, $id_cita, $fecha_cita, $hora_cita);

// -------------------------
// 🔹 ENVIAR CORREO (nuevo)
// -------------------------

enviarCorreoCita($correo, $nombre, $id_cita, $fecha_cita, $hora_cita);

// -------------------------
// 🔹 REDIRECCIÓN FINAL
// -------------------------

header("Location: index.html?success=1&id_cita=$id_cita");
exit;
?>