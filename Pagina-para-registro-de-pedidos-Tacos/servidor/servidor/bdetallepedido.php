<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eliminar</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
   
    <?php
        include 'conexion.php';

        $id = $_GET['id'];
        $sql = "DELETE FROM DetallePedido WHERE IdDetallePedido='$id'";

        if ($conexion->query($sql) === TRUE) {
            echo "Datos eliminados correctamente<br>";
            echo '<a href="lista_pedidos.php">Volver</a>';
        } else {
            echo "Error al eliminar datos: " . $conexion->error;
        }

        $conexion->close();
    ?>      
</body>
</html>