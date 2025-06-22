<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Categoría</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Nueva categoría</h1>
    <form action="ncategoria.php" method="post">
        <p>Nombre:</p><input type="text" name="Nombre">
        <p>Descripción:</p><input type="text" name="Descripcion">
        <br>  
        <input type="submit" name="btnEnviar" value="Agregar Categoría">      
    </form>
    
    <?php
        include 'conexiona.php';

        if (isset($_POST['btnEnviar'])) {
            $Nombre = $_POST['Nombre'];
            $Descripcion = $_POST['Descripcion'];

            $sql = "INSERT INTO Categoria (Nombre, Descripcion) VALUES (?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$Nombre, $Descripcion]);

            if ($stmt->rowCount() > 0) {
                echo "Datos insertados correctamente<br>";
                echo '<a href="categoria.php">Volver</a>';
            } else {
                echo "Error al insertar datos";
            }
        }

        $conexion = null;
    ?>      
</body>
</html>
