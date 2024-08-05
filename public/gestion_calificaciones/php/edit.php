<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Calificación</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <a href="../index.php" class="button back-button">Volver</a>
    <div class="form-container">
        <h1>Editar Calificación</h1>
        <?php
        include 'conexion.php';

        // Verificar si los parámetros 'name' y 'curso' están presentes en la URL
        if (isset($_GET['name']) && !empty($_GET['name']) && isset($_GET['curso']) && !empty($_GET['curso'])) {
            $name = $_GET['name'];
            $curso = $_GET['curso'];

            // Utilizar una consulta preparada para evitar inyecciones SQL
            $stmt = $conn_usuarios->prepare("SELECT u.id FROM users u WHERE u.name = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $alumno = $result->fetch_assoc();
                $alumno_id = $alumno['id'];

                // Obtener calificaciones del alumno para el curso específico
                $stmt_calif = $conn_calificaciones->prepare("SELECT * FROM calificaciones WHERE alumno_id = ? AND curso = ?");
                $stmt_calif->bind_param("is", $alumno_id, $curso);
                $stmt_calif->execute();
                $result_calif = $stmt_calif->get_result();

                if ($result_calif->num_rows > 0) {
                    $calificacion = $result_calif->fetch_assoc();
                } else {
                    die("Calificación no encontrada.");
                }
            } else {
                die("Alumno no encontrado.");
            }
        } else {
            die("Nombre o curso no válido.");
        }
        ?>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $calificacion['id']; ?>">
            <label for="curso">Curso</label>
            <select id="curso" name="curso">
                <option value="Informatica" <?php if ($calificacion['curso'] == 'Informatica') echo 'selected'; ?>>Informática</option>
                <option value="English" <?php if ($calificacion['curso'] == 'English') echo 'selected'; ?>>English</option>
                <option value="Arte" <?php if ($calificacion['curso'] == 'Arte') echo 'selected'; ?>>Arte</option>
                <option value="Frances" <?php if ($calificacion['curso'] == 'Frances') echo 'selected'; ?>>Francés</option>
            </select>
            <label for="calificacion">Calificación</label>
            <input type="number" step="0.01" id="calificacion" name="calificacion" value="<?php echo $calificacion['calificacion']; ?>" required>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $calificacion['fecha']; ?>" required>
            <button type="submit" class="button">Actualizar</button>
        </form>
    </div>
</body>
</html>
