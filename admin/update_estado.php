<?php
include('../conexion.php');

if (isset($_POST['id_cita']) && isset($_POST['estado'])) {
    $id = $_POST['id_cita'];
    $estado = $_POST['estado'];

    $sql = "UPDATE citas SET estado = '$estado' WHERE id_cita = $id";
    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el estado: " . $conn->error;
    }
}
?>