<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BDTACO";

$conexion = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
