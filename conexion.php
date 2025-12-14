<?php
$conn = new mysqli("localhost", "root", "", "motodoctor_citas");

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
?>