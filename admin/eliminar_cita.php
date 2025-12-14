<?php
session_start();
include("../conexion.php");

if (!isset($_SESSION['usuario'])) {
    die("❌ No hay sesión");
}

if (!isset($_GET['id'])) {
    die("❌ No llegó el ID");
}

$id_cita = intval($_GET['id']);
die("✅ ID recibido: " . $id_cita);
