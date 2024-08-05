<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $alumno_id = $_POST['alumno_id'];
    $curso = $_POST['curso'];
    $calificacion = $_POST['calificacion'];
    $fecha = $_POST['fecha'];

    // Insertar calificación en la base de datos de calificaciones
    $stmt = $conn_calificaciones->prepare("INSERT INTO calificaciones (alumno_id, curso, calificacion, fecha) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $alumno_id, $curso, $calificacion, $fecha);

    if ($stmt->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn_calificaciones->close();
?>
