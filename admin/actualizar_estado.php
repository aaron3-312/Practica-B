<?php
include("../conexion.php");

if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id = intval($_GET['id']);
    $estado = $_GET['estado'];

    // Preparar la consulta para mayor seguridad
    $stmt = $conn->prepare("UPDATE citas SET estado = ? WHERE id_cita = ?");
    $stmt->bind_param("si", $estado, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('❌ Error al actualizar el estado: " . addslashes($conn->error) . "');</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('⚠ Faltan parámetros.');</script>";
}

$conn->close();
?>