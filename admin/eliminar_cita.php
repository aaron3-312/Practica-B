<?php
session_start();
include("../conexion.php");

if (isset($_GET['id_cita'])) {
    $id_cita = intval($_GET['id_cita']);
    $sql = "DELETE FROM citas WHERE id_cita = '$id_cita'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('✅ Cita eliminada correctamente.');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('❌ Error al eliminar la cita: " . addslashes($conn->error) . "');
                window.location.href = 'index.php';
              </script>";
    }
} else {
    echo "<script>
            alert('⚠ No se especificó ninguna cita para eliminar.');
            window.location.href = 'index.php';
          </script>";
}

$conn->close();
?>