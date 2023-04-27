<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "ingmorales", "arbol_multinivel");

// Crear arreglo de nodos de lideres
$lideres = array(
    "name" => "Líderes",
    "children" => array()
);

// Obtener todos los líderes
$sql_lideres = "SELECT * FROM lider";
$resultado_lideres = mysqli_query($conexion, $sql_lideres);

// Crear un nodo para cada líder y agregarlo al arreglo de líderes
while ($fila_lideres = mysqli_fetch_assoc($resultado_lideres)) {
    $nodo_lider = array(
        "name" => $fila_lideres["nombre"] . " " . $fila_lideres["apellido"],
        "children" => array()
    );

    // Obtener todas las personas que pertenecen a este líder
    $sql_personas = "SELECT * FROM personas WHERE fk_lider = " . $fila_lideres["id"];
    $resultado_personas = mysqli_query($conexion, $sql_personas);

    // Crear un nodo para cada persona y agregarlo al nodo del líder
    while ($fila_personas = mysqli_fetch_assoc($resultado_personas)) {
        $nodo_persona = array(
            "name" => $fila_personas["nombre"] . " " . $fila_personas["apellido"]
        );
        array_push($nodo_lider["children"], $nodo_persona);
    }

    // Agregar el nodo del líder al arreglo de líderes
    array_push($lideres["children"], $nodo_lider);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

// Convertir el arreglo de líderes a formato JSON y mostrarlo en pantalla
echo json_encode($lideres);
?>
