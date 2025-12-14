<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Cita | MotoDoctor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f4f6f7;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    header {
      background: linear-gradient(90deg, #1f3b73, #007bff);
      color: white;
      text-align: center;
      padding: 40px 0;
      margin-bottom: 40px;
    }
    .btn-custom {
      font-size: 1.1rem;
      padding: 12px 25px;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<header>
  <h1 class="fw-bold">Registrar Nueva Cita</h1>
  <p>Completa los datos para agendar tu servicio</p>
</header>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card p-4">
        <h4 class="text-center text-primary mb-4">🛠 Detalles de tu Cita</h4>

        <!-- FORMULARIO CORRECTO -->
        <form action="guardar_cita.php" method="POST">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Nombre del Cliente</label>
              <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Teléfono</label>
              <input type="text" name="telefono" class="form-control" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input type="email" name="correo" class="form-control">
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Marca</label>
              <input type="text" name="marca" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Modelo</label>
              <input type="text" name="modelo" class="form-control" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label">Año</label>
              <input type="number" name="anio" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Placas</label>
              <input type="text" name="placas" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Fecha</label>
              <input type="date" name="fecha_cita" class="form-control" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Hora</label>
            <input type="time" name="hora_cita" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Servicio Solicitado</label>
            <input type="text" name="servicio" class="form-control" required>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-success btn-custom">💾 Guardar Cita</button>
            <a href="index.html" class="btn btn-secondary btn-custom">⬅ Volver</a>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

</body>
</html>