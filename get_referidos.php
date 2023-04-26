<?php 
// Verificar si se ha pasado un líder como parámetro
if (!isset($_GET['leader_id'])) {
    echo 'Error: No se ha proporcionado el ID del líder.';
    exit();
  }
  
$leader_id = $_GET['leader_id'];
  
// Conexión a la base de datos
include 'conexion.php';
  
  // Consulta para recuperar las personas referidas por el líder seleccionado
  $sql = "SELECT id, nombre, apellido FROM personas WHERE fk_lider = " . $leader_id;
  $result = $conn->query($sql);
  
  // Crear un array con los detalles de las personas referidas
  $data = array();
  while ($row = $result->fetch_assoc()) {
    $person = array(
      'id' => $row['id'],
      'nombre' => $row['nombre'],
      'apellido' => $row['apellido']
    );
    array_push($data, $person);
  }
  
  // Devolver los detalles como JSON
  echo json_encode($data);
  
  // Cerrar la conexión
  $conn->close();
  
?>