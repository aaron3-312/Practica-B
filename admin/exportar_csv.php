<?php
include("../conexion.php");

// Ordenar por ID de cita
$result = $conn->query("
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
  ORDER BY c.id_cita ASC
");

// Encabezado para descargar archivo
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="citas_motodoctor.csv"');

// Abrimos la salida (Excel lo interpreta bien)
$output = fopen('php://output', 'w');

// Encabezados de la tabla
fputcsv($output, [
    'ID Cita',
    'Cliente',
    'Teléfono',
    'Marca',
    'Modelo',
    'Fecha de Cita',
    'Hora de Cita',
    'Servicio',
    'Estado'
]);

// Escribir cada fila
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['id_cita'],
        $row['cliente'],
        $row['telefono'],
        $row['marca'],
        $row['modelo'],
        $row['fecha_cita'],
        $row['hora_cita'],
        $row['servicio'],
        $row['estado']
    ]);
}

fclose($output);
exit;
?>