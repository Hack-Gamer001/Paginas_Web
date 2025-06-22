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

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM Categoria WHERE IdCategoria='$id'";

            if ($conexion->query($sql) === TRUE) {
                echo "Datos eliminados correctamente<br>";
                echo '<a href="categoria.php">Volver</a>';
            } else {
                echo "Error al eliminar datos: " . $conexion->error;
            }
        }

        $conexion->close();
    ?>      
</body>
</html>
