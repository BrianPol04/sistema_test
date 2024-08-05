<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Calificación</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <a href="../index.php" class="button back-button">Volver</a>
    <div class="form-container">
        <h1>Agregar Calificación</h1>
        <?php
        include 'conexion.php';
        $alumnos = $conn_usuarios->query("SELECT * FROM users WHERE rol = 'Alumno'");
        ?>
        <form action="store.php" method="POST">
            <label for="alumno_id">Alumno</label>
            <select id="alumno_id" name="alumno_id" required>
                <?php while ($alumno = $alumnos->fetch_assoc()): ?>
                    <option value="<?php echo $alumno['id']; ?>"><?php echo $alumno['name']; ?></option>
                <?php endwhile; ?>
            </select>
            <label for="curso">Curso</label>
            <select id="curso" name="curso" required>
                <option value="Informatica">Informática</option>
                <option value="English">English</option>
                <option value="Arte">Arte</option>
                <option value="Frances">Francés</option>
            </select>
            <label for="calificacion">Calificación</label>
            <input type="number" step="0.01" id="calificacion" name="calificacion" required>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" required>
            <button type="submit" class="button">Guardar</button>
        </form>
    </div>
</body>
</html>
