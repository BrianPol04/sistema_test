<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $id = $_POST['id'];
    $curso = $_POST['curso'];
    $calificacion = $_POST['calificacion'];
    $fecha = $_POST['fecha'];

    // Actualizar calificación en la base de datos de calificaciones
    $stmt = $conn_calificaciones->prepare("UPDATE calificaciones SET curso = ?, calificacion = ?, fecha = ? WHERE id = ?");
    $stmt->bind_param("sssi", $curso, $calificacion, $fecha, $id);

    if ($stmt->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn_calificaciones->close();
?>
