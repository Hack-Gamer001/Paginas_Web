<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BDTACO";

$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay errores de conexión
if ($conexion->connect_error) {
    die("ERROR: No se puede conectar al servidor: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
?>