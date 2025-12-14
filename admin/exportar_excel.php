<?php
include("../conexion.php");

// Consulta de datos
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

// Crear XML de Excel
$xml = '<?xml version="1.0" encoding="UTF-8"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">

 <Worksheet ss:Name="Citas">
  <Table>';


// Encabezados de la tabla
$xml .= "
<Row>
  <Cell><Data ss:Type='String'>ID Cita</Data></Cell>
  <Cell><Data ss:Type='String'>Cliente</Data></Cell>
  <Cell><Data ss:Type='String'>Teléfono</Data></Cell>
  <Cell><Data ss:Type='String'>Marca</Data></Cell>
  <Cell><Data ss:Type='String'>Modelo</Data></Cell>
  <Cell><Data ss:Type='String'>Fecha de Cita</Data></Cell>
  <Cell><Data ss:Type='String'>Hora de Cita</Data></Cell>
  <Cell><Data ss:Type='String'>Servicio</Data></Cell>
  <Cell><Data ss:Type='String'>Estado</Data></Cell>
</Row>";


// Agregar filas
while ($row = $result->fetch_assoc()) {
    $xml .= "<Row>
      <Cell><Data ss:Type='Number'>{$row['id_cita']}</Data></Cell>
      <Cell><Data ss:Type='String'>{$row['cliente']}</Data></Cell>
      <Cell><Data ss:Type='String'>{$row['telefono']}</Data></Cell>
      <Cell><Data ss:Type='String'>{$row['marca']}</Data></Cell>
      <Cell><Data ss:Type='String'>{$row['modelo']}</Data></Cell>
      <Cell><Data ss:Type='String'>{$row['fecha_cita']}</Data></Cell>
      <Cell><Data ss:Type='String'>{$row['hora_cita']}</Data></Cell>
      <Cell><Data ss:Type='String'>{$row['servicio']}</Data></Cell>
      <Cell><Data ss:Type='String'>{$row['estado']}</Data></Cell>
    </Row>";
}

$xml .= "
  </Table>
 </Worksheet>
</Workbook>";

// Descargar archivo Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=citas_motodoctor.xls");

echo $xml;
exit;
?>