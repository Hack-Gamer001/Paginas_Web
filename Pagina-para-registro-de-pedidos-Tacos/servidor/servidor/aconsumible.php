<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualizar Consumible</title>
    
    <link rel="stylesheet" href="estilos.css">
</head>
<body>    
    
    <?php
        include 'conexion.php';

        $id = $_GET['id'];

        $consulta = "SELECT * FROM Consumible WHERE IdConsumible = '$id'";
        $resultado = $conexion->query($consulta);
        
        if ($resultado) {
            $fila = $resultado->fetch_assoc();            
            
            $consultaIdCategoria = $fila['IdCategoria'];
            $consultaNombre = $fila['Nombre'];
            $consultaDescripcion = $fila['Descripcion'];
            $consultaImagen = $fila['Imagen'];
            $consultaPrecioUnitario = $fila['PrecioUnitario'];
            
        } else {
            echo "Error al obtener datos del consumible: " . $conexion->error;
        }

        echo '
        <h1>Actualizar Consumible</h1>
        <form action="" method="post">   
             
            <p>IdCategoria:</p>
            <input type="text" name="IdCategoria" value="'. $consultaIdCategoria .'"  >

            <p>Nombre:</p>
            <input type="text" name="Nombre" value="'. $consultaNombre .'"  >

            <p>Descripción:</p>
            <input type="text" name="Descripcion" value="'. $consultaDescripcion .'" >

            <p>Imagen:</p>
            <input type="text" name="Imagen" value="'. $consultaImagen .'" >

            <p>PrecioUnitario:</p>
            <input type="text" name="PrecioUnitario" value="'. $consultaPrecioUnitario .'" >
            
            <input type="submit" name="btnEnviar" value="Actualizar Consumible">      
        </form>';

        if (isset($_POST['btnEnviar'])) {
            $IdCategoria = $_POST['IdCategoria'];
            $Nombre = $_POST['Nombre'];
            $Descripcion = $_POST['Descripcion'];
            $Imagen = $_POST['Imagen'];
            $PrecioUnitario = $_POST['PrecioUnitario'];   

            $sql = "UPDATE Consumible SET IdCategoria = '$IdCategoria', Nombre = '$Nombre', Descripcion = '$Descripcion', Imagen = '$Imagen', PrecioUnitario = '$PrecioUnitario' WHERE IdConsumible = '$id'";

            if ($conexion->query($sql) === TRUE) {
                header("Location: consumible.php");
                exit;
            } else {
                echo "Error al actualizar datos: " . $conexion->error;
            }
        }

        $conexion->close();
    ?>      
</body>
</html>
