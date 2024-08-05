<?php
include 'conexion.php';

if (isset($_GET['name']) && !empty($_GET['name']) && isset($_GET['curso']) && !empty($_GET['curso'])) {
    $name = $_GET['name'];
    $curso = $_GET['curso'];

    // Obtener el ID del alumno basado en el nombre desde la base de datos de usuarios
    $stmt = $conn_usuarios->prepare("SELECT id FROM users WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $alumno = $result->fetch_assoc();
        $alumno_id = $alumno['id'];

        // Eliminar la calificación basada en el alumno_id y el curso en la base de datos de calificaciones
        $stmt_delete = $conn_calificaciones->prepare("DELETE FROM calificaciones WHERE alumno_id = ? AND curso = ?");
        $stmt_delete->bind_param("is", $alumno_id, $curso);

        if ($stmt_delete->execute()) {
            header("Location: ../index.php");
        } else {
            echo "Error: " . $stmt_delete->error;
        }

        $stmt_delete->close();
    } else {
        die("Alumno no encontrado.");
    }

    $stmt->close();
} else {
    die("Nombre o curso no válido.");
}

$conn_usuarios->close();
$conn_calificaciones->close();
?>
