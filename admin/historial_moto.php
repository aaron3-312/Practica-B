<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include("../conexion.php");

$id_moto = intval($_GET['id_moto']);

$sql = "
  SELECT c.id_cita, c.fecha_cita, c.hora_cita, c.servicio, c.estado,
         cl.nombre AS cliente, cl.telefono,
         m.marca, m.modelo, m.placas
  FROM citas c
  INNER JOIN clientes cl ON c.id_cliente = cl.id_cliente
  INNER JOIN motos m ON c.id_moto = m.id_moto
  WHERE m.id_moto = $id_moto
  ORDER BY c.fecha_cita DESC, c.hora_cita DESC
";

$res = $conn->query($sql);

// Si no hay registros
if ($res->num_rows === 0) {
    die("No hay historial para esta moto.");
}

$data = [];
while ($row = $res->fetch_assoc()) {
    $data[] = $row;
}

$moto = $data[0]; // Datos generales
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Historial de Moto</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>
.card {
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
</style>

</head>
<body class="container mt-4">

<div class="card p-4 mb-4">
  <h2 class="text-primary">🔧 Historial de la Moto</h2>

  <p><strong>Cliente:</strong> <?= $moto['cliente'] ?></p>
  <p><strong>Teléfono:</strong> <?= $moto['telefono'] ?></p>
  <p><strong>Moto:</strong> <?= $moto['marca'] . " " . $moto['modelo'] ?></p>
  <p><strong>Placas:</strong> <?= $moto['placas'] ?></p>
</div>

<div class="card p-4">

  <h4 class="text-secondary mb-3">📋 Historial de Servicios</h4>

  <table class="table table-bordered table-striped text-center">
    <thead class="table-dark">
      <tr>
        <th>ID Cita</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Servicio</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $row) { ?>
      <tr>
        <td><?= $row['id_cita'] ?></td>
        <td><?= $row['fecha_cita'] ?></td>
        <td><?= $row['hora_cita'] ?></td>
        <td><?= $row['servicio'] ?></td>
        <td>
          <span class="badge 
            <?= $row['estado']=='Pendiente' ? 'bg-warning text-dark' : 
               ($row['estado']=='Entregado' ? 'bg-success' : 
               'bg-danger') ?>">
            <?= $row['estado'] ?>
          </span>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  <a href="index.php" class="btn btn-secondary mt-3">⬅ Volver al Panel</a>

</div>

</body>
</html>