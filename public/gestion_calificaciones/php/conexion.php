<?php
$servername = "localhost";
$username = "root";
$password = "";

// Crear conexión a la base de datos de usuarios
$db_usuarios = "db_sistema_test";
$conn_usuarios = new mysqli($servername, $username, $password, $db_usuarios);

// Verificar conexión
if ($conn_usuarios->connect_error) {
    die("Error de conexión a la base de datos de usuarios: " . $conn_usuarios->connect_error);
}

// Crear conexión a la base de datos de calificaciones
$db_calificaciones = "db_calificaciones";
$conn_calificaciones = new mysqli($servername, $username, $password, $db_calificaciones);

// Verificar conexión
if ($conn_calificaciones->connect_error) {
    die("Error de conexión a la base de datos de calificaciones: " . $conn_calificaciones->connect_error);
}
?>
