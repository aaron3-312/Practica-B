<?php
include("conexion.php");

// Obtener todas las citas con la información del cliente y la moto
$result = $conexion->query("
  SELECT 
    c.id_cita,
    cl.nombre AS cliente,
    cl.telefono,
    m.marca,
    m.modelo,
    c.fecha_cita,
    c.hora_cita,
    c.servicio,
    c.estado
  FROM citas c
  INNER JOIN clientes cl ON c.id_cliente = cl.id_cliente
  INNER JOIN motos m ON c.id_moto = m.id_moto
  ORDER BY c.fecha_cita ASC, c.hora_cita ASC
");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Citas - MotoDoctor.mx</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    h2 {
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="container mt-5">
    <div class="card shadow p-4">
      <h2 class="text-center text-primary mb-4">📋 Citas Registradas</h2>

      <div class="table-responsive">
        <table class="table table-striped table-bordered text-center align-middle">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Cliente</th>
              <th>Teléfono</th>
              <th>Moto</th>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Servicio</th>
              <th>Estado</th>
              <th>Acciones</th> <!-- 👈 Nueva columna -->
            </tr>
          </thead>
          <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?= $row['id_cita'] ?></td>
              <td><?= htmlspecialchars($row['cliente']) ?></td>
              <td><?= htmlspecialchars($row['telefono']) ?></td>
              <td><?= htmlspecialchars($row['marca'] . " " . $row['modelo']) ?></td>
              <td><?= $row['fecha_cita'] ?></td>
              <td><?= $row['hora_cita'] ?></td>
              <td><?= htmlspecialchars($row['servicio']) ?></td>
              <td><span class="badge bg-info"><?= htmlspecialchars($row['estado']) ?></span></td>
              <td>
                <a href="admin/eliminar_cita.php?id_cita=<?= $row['id_cita'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Seguro que deseas eliminar esta cita?');">
                   🗑 Eliminar
                </a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <div class="text-center mt-3">
        <a href="index.html" class="btn btn-secondary btn-lg">⬅ Volver al inicio</a>
      </div>
    </div>
  </div>

</body>
</html>