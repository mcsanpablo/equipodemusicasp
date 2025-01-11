<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'canciones');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener las canciones
$sql = "SELECT category, name, details FROM songs ORDER BY created_at DESC";
$result = $conn->query($sql);

$songs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
}

// Devolver las canciones en formato JSON
header('Content-Type: application/json');
echo json_encode($songs);

$conn->close();
?>
