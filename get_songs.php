<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root"; // Cambiar según tu configuración
$password = ""; // Cambiar según tu configuración
$dbname = "canciones";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar todas las canciones
$sql = "SELECT category, name, details FROM songs";
$result = $conn->query($sql);

$songs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($songs);

$conn->close();
?>
