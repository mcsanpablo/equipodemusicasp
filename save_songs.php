<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'canciones');

// Verificar si hay algún error en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$category = $_POST['category'] ?? '';
$name = $_POST['name'] ?? '';
$details = $_POST['details'] ?? '';

// Verificar que los campos no estén vacíos
if (empty($category) || empty($name) || empty($details)) {
    echo "Todos los campos son obligatorios.";
    exit;
}

// Insertar los datos en la base de datos
$stmt = $conn->prepare("INSERT INTO canciones (category, name, details) VALUES (?, ?, ?)");
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param('sss', $category, $name, $details);

// Ejecutar la consulta y verificar si se ejecutó correctamente
if ($stmt->execute()) {
    echo "Canción guardada exitosamente.";
} else {
    echo "Error al guardar la canción: " . $conn->error;
}

// Cerrar la conexión y la declaración
$stmt->close();
$conn->close();
?>
