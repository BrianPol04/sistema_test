<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Calificaciones</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <a href="../home" class="button back-button">Volver al Dashboard</a>
    <div class="container">
        <h1>Gestión de Calificaciones</h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Calificaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'php/conexion.php';
                $alumnos = $conn_usuarios->query("SELECT * FROM users WHERE rol = 'Alumno'");
                if (!$alumnos) {
                    die("Error en la consulta de alumnos: " . $conn_usuarios->error);
                }
                while ($alumno = $alumnos->fetch_assoc()) {
                    echo "<tr>
                        <td>{$alumno['name']}</td>
                        <td>{$alumno['email']}</td>
                        <td>";

                    $calificaciones = $conn_calificaciones->query("SELECT * FROM calificaciones WHERE alumno_id = " . $alumno['id']);
                    if ($calificaciones) {
                        while ($calificacion = $calificaciones->fetch_assoc()) {
                            echo "<p>Curso: {$calificacion['curso']} - Calificación: {$calificacion['calificacion']} - Fecha: {$calificacion['fecha']}
                            <a href='php/edit.php?name=" . urlencode($alumno['name']) . "&curso=" . urlencode($calificacion['curso']) . "'>Editar</a> |
                            <a href='php/delete.php?name=" . urlencode($alumno['name']) . "&curso=" . urlencode($calificacion['curso']) . "'>Eliminar</a></p>";
                        }
                    } else {
                        echo "No hay calificaciones.";
                    }
                    echo "</td>
                        <td><a href='php/create.php' class='button'>Agregar Calificación</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
