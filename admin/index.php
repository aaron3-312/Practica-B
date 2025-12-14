<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include("../conexion.php");

// 🔹 Obtener estadísticas
$estadisticas = $conn->query("
  SELECT estado, COUNT(*) AS total
  FROM citas
  GROUP BY estado
");

$labels = [];
$datos = [];

while ($row = $estadisticas->fetch_assoc()) {
  $labels[] = $row['estado'];
  $datos[] = $row['total'];
}

// 🔹 Consultar citas
$result = $conn->query("
  SELECT 
    c.id_cita,
    cl.nombre AS cliente,
    cl.telefono,
    m.marca,
    m.modelo,
    m.id_moto,   -- 🔹 AGREGADO PARA EL HISTORIAL
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
  <title>Panel de Administración | MotoDoctor</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    header {
      background: linear-gradient(90deg, #1f3b73, #007bff);
      color: white;
      padding: 20px;
      margin-bottom: 30px;
      border-radius: 0 0 15px 15px;
    }

    #graficoCitas {
      max-width: 300px;
      height: 250px !important;
      margin: 0 auto;
    }
  </style>
</head>
<body>

<header class="text-center position-relative">
  <h2 class="fw-bold">🔧 Panel de Administración - MotoDoctor</h2>
  <p>Gestión de citas, estados, exportación y clientes</p>
  <div class="position-absolute top-0 end-0 mt-3 me-4">
    <a href="logout.php" class="btn btn-danger btn-sm">🔒 Cerrar sesión</a>
  </div>
</header>

<div class="container mt-3">

  <!-- 🔹 Gráfico -->
  <div class="card p-4 mb-4 text-center">
    <h4 class="text-primary mb-3">📈 Estadísticas de Citas</h4>
    <div style="width: 100%; display:flex; justify-content:center;">
      <canvas id="graficoCitas"></canvas>
    </div>
  </div>

  <!-- 🔹 Botón Exportar CSV -->
  <a href="exportar_excel.php" class="btn btn-success btn-sm">⬇ Exportar a Excel</a>

  <!-- 🔹 Tabla de citas -->
  <div class="card p-4">
    <h3 class="text-center text-primary mb-4">📋 Citas Registradas</h3>

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
            <th>Acciones</th>
          </tr>
        </thead>

        <tbody>
          <?php while($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?= $row['id_cita'] ?></td>
            <td><?= htmlspecialchars($row['cliente']) ?></td>
            <td><?= htmlspecialchars($row['telefono']) ?></td>
            <td><?= htmlspecialchars($row['marca'] . " " . $row['modelo']) ?></td>
            <td><?= htmlspecialchars($row['fecha_cita']) ?></td>
            <td><?= htmlspecialchars($row['hora_cita']) ?></td>
            <td><?= htmlspecialchars($row['servicio']) ?></td>

            <!-- Estado -->
            <td>
              <span class="badge 
                <?= $row['estado'] == 'Pendiente' ? 'bg-warning text-dark' : 
                   ($row['estado'] == 'Entregado' ? 'bg-success' : 
                   ($row['estado'] == 'Cancelado' ? 'bg-danger' : 'bg-secondary')) ?>">
                <?= htmlspecialchars($row['estado']) ?>
              </span>
            </td>

            <td>
              <a href="actualizar_estado.php?id=<?= $row['id_cita'] ?>&estado=Pendiente" class="btn btn-warning btn-sm">Pendiente</a>
              <a href="actualizar_estado.php?id=<?= $row['id_cita'] ?>&estado=Entregado" class="btn btn-success btn-sm">Entregado</a>
              <a href="actualizar_estado.php?id=<?= $row['id_cita'] ?>&estado=Cancelado" class="btn btn-danger btn-sm">Cancelado</a>

              <!-- 🔵 BOTÓN HISTORIAL (NUEVO) -->
              <a href="historial_moto.php?id_moto=<?= $row['id_moto'] ?>" 
                 class="btn btn-info btn-sm text-white">
                 Historial
              </a>

              <a href="eliminar_cita.php?id=<?= $row['id_cita'] ?>" 
                 onclick="return confirm('¿Seguro que deseas eliminar esta cita?');"
                 class="btn btn-outline-danger btn-sm">🗑 Eliminar</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <div class="text-center mt-4">
      <a href="../index.html" class="btn btn-secondary btn-lg">⬅ Volver al Inicio</a>
    </div>
  </div>
</div>

<!-- 🔹 Script del gráfico -->
<script>
  const estados = <?= json_encode($labels) ?>;
  const valores = <?= json_encode($datos) ?>;

  const colores = estados.map(e => {
    if (e === "Pendiente") return "#f6c23e";
    if (e === "Entregado") return "#1cc88a";
    if (e === "Cancelado") return "#e74a3b";
    return "#36b9cc";
  });

  const ctx = document.getElementById('graficoCitas').getContext('2d');

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: estados,
      datasets: [{
        data: valores,
        backgroundColor: colores,
        borderWidth: 1
      }]
    },
    options: {
      maintainAspectRatio: false,
      plugins: {
        legend: { position: 'bottom' }
      }
    }
  });
</script>

<script>
  $(document).ready(function(){
      $('.table').DataTable({
          "pageLength": 10,
          "lengthMenu": [5, 10, 25, 50],
          "order": [[4, "asc"]],
          "language": {
              "search": "Buscar:",
              "lengthMenu": "Mostrar _MENU_ registros",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
              "paginate": {
                  "first": "Primero",
                  "last": "Último",
                  "next": "Siguiente",
                  "previous": "Anterior"
              }
          }
      });
  });
</script>

</body>
</html>