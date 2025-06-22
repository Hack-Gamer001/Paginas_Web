<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
            border: 1px solid black; /* Agregar borde a la tabla */
        }
        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid black; /* Agregar borde a las celdas */
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>


<?php
/* Conectar a una base de datos invocando al controlador */ 
$hostname ='mysql:host=localhost;dbname=daisl07_dsiproyecto03'; 
$usuario = 'daisl07_dsiproyecto03';
$contrasena = 'GQ.Jl~Ka);7O'; 
try
{
    $conn = new PDO($hostname, $usuario, $contrasena);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    echo 'Relacion de Boletas.<br>';
    echo '<a href="index.php">Volver a menú</a><br>';
    // Mostrar registros en una tabla HTML
    $sql = 'SELECT * FROM Boleta'; 
    echo "<table>"; // Agregar tabla
    echo "<tr><th>IdBoleta</th><th>IdPedido</th><th>Estado</th><th>FechaHora</th></tr>"; // Agregar encabezado de la tabla
    foreach ($conn->query($sql) as $fila) { 
        // Imprime datos de MySQL en una fila de la tabla
        echo "<tr><td>" .$fila['IdBoleta']."</td><td>".$fila['IdPedido'] . "</td><td>" .$fila['Estado'] ."</td><td>" .$fila['FechaHora'] ."</td></tr>"; 
    }
    echo "</table>"; // Cerrar tabla

    $conn = null; 
}
catch(PDOException $err) {
    // Imprime error de conexión
    echo "ERROR: No se pudo conectar a la base de datos: " . $err->getMessage(); 
}
?>

<tr>
  <td colspan="4" align="center">
    <a href="Agregar_Boleta.php"><button>Agregar Boleta </button></a>
    <a href="index.php"><button>Ir al inicio</button></a>

    <br>
    <br>
    <a href="ejemplo.php"><button>Ir al ejemplo</button></a>
    <a href="listar.php"><button>Ir al reporte</button></a>
  </td>
</tr>

</body>
</html>