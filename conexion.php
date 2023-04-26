<?php
$servername = "localhost";
$username = "root";
$password = "ingmorales";
$dbname = "arbol_multinivel";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}