<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Consultar Cita | MotoDoctor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f5f7fa;
      font-family: 'Segoe UI', sans-serif;
    }
    header {
      background: linear-gradient(90deg, #1f3b73, #007bff);
      color: white;
      text-align: center;
      padding: 40px 0;
      margin-bottom: 40px;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    footer {
      background: #212529;
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<header>
  <h1 class="fw-bold">Consulta tu Cita</h1>
  <p>Ingresa tu número de cita para ver los detalles</p>
</header>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4">
        <h4 class="text-center text-primary mb-3">🔍 Buscar Cita</h4>

        <form method="GET">
          <div class="mb-3">
            <label class="form-label">Número de Cita (ID)</label>
            <input type="number" name="id_cita" class="form-control" placeholder="Ej. 1" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Consultar</button>
            <a href="index.html" class="btn btn-secondary btn-lg">⬅ Volver</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  if (isset($_GET['id_cita'])) {
    include("conexion.php");
    $id_cita = $_GET['id_cita'];

    $resultado = mysqli_query($conn, "SELECT * FROM citas WHERE id_cita = '$id_cita'");

    if (mysqli_num_rows($resultado) > 0) {
        $cita = mysqli_fetch_assoc($resultado);

        echo "
        <div class='row justify-content-center mt-5'>
          <div class='col-md-8'>
            <div class='alert alert-success text-center'>
              ✅ <strong>Cita #{$cita['id_cita']}</strong> encontrada correctamente.
            </div>

            <div class='card p-4 bg-white'>
              <h4 class='text-center text-success mb-3'>📋 Detalles de la Cita</h4>
              <table class='table table-striped'>
                <tr><th>ID Cita</th><td>{$cita['id_cita']}</td></tr>
                <tr><th>ID Cliente</th><td>{$cita['id_cliente']}</td></tr>
                <tr><th>ID Moto</th><td>{$cita['id_moto']}</td></tr>
                <tr><th>Fecha</th><td>{$cita['fecha_cita']}</td></tr>
                <tr><th>Hora</th><td>{$cita['hora_cita']}</td></tr>
                <tr><th>Servicio</th><td>{$cita['servicio']}</td></tr>
              </table>
            </div>
          </div>
        </div>";
    } else {
        echo "<div class='alert alert-danger text-center mt-4'>❌ No se encontró una cita con ese número.</div>";
    }
}
  ?>
</div>

<footer>
  © 2025 MotoDoctor.mx | Todos los derechos reservados
</footer>

</body>
</html>