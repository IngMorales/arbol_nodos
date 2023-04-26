<?php
include 'conexion.php';
// Consulta para recuperar los líderes
$sql = "SELECT id, nombre, apellido FROM lider";
$result = $conn->query($sql);

// Crear el árbol
$data = array();
while ($row = $result->fetch_assoc()) {
  $node = array(
    'id' => $row['id'],
    'text' => $row['nombre'] . ' ' . $row['apellido'],
    'data' => array(
      'type' => 'leader',
      'name' => $row['nombre'],
      'lastname' => $row['apellido']
    ),
    'children' => array()
  );

  // Consulta para recuperar las personas referidas por este líder
  $referidos_sql = "SELECT id, nombre, apellido FROM personas WHERE fk_lider = " . $row['id'];
  $referidos_result = $conn->query($referidos_sql);
  while ($referido_row = $referidos_result->fetch_assoc()) {
    $referido_node = array(
      'id' => $referido_row['id'],
      'text' => $referido_row['nombre'] . ' ' . $referido_row['apellido'],
      'data' => array(
        'type' => 'person',
        'name' => $referido_row['nombre'],
        'lastname' => $referido_row['apellido'],
        'leader' => $row['nombre'] . ' ' . $row['apellido']
      )
    );
    array_push($node['children'], $referido_node);
  }

  array_push($data, $node);
}

// Devolver los datos como JSON
echo json_encode($data);

// Cerrar la conexión
$conn->close();

?>
