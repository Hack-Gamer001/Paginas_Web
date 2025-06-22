<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingresar categoría</title>
    
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
    include 'conexiona.php';

    $id = $_GET['id'];

    echo '
    <h1>Nuevo Consumible</h1>
    <form action="nconsumible.php?id=' . $id . '" method="post">
        <p>Nombre:</p><input type="text" name="Nombre">


        
        <p>Descripcion:</p><input type="text" name="Descripcion">
        <p>Imagen:</p><input type="text" name="Imagen">
        <p>PrecioUnitario:</p><input type="text" name="PrecioUnitario">
        <br>  
        <input type="submit" name="btnEnviar" value="Agregar Consumible">      
    </form>
    ';

    if (isset($_POST['btnEnviar'])) {
        $IdCategoria = $id;
        $Nombre = $_POST['Nombre'];
        $Descripcion = $_POST['Descripcion'];
        $Imagen = $_POST['Imagen'];
        $PrecioUnitario = $_POST['PrecioUnitario'];

        $sql = "INSERT INTO Consumible (IdCategoria, Nombre, Descripcion, Imagen, PrecioUnitario) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$IdCategoria, $Nombre, $Descripcion, $Imagen, $PrecioUnitario]);

        if ($stmt->rowCount() > 0) {
            header("Location: consumible.php");
            exit;
        } else {
            echo "Error al insertar datos";
        }
    }

    $conexion = null;
    ?>
</body>
</html>
