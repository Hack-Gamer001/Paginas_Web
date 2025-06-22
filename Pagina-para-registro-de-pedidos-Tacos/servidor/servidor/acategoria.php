<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualizar Categoría</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>    
    
    <?php
        include 'conexion.php';

        $id = $_GET['id'];

        $consulta = "SELECT * FROM Categoria WHERE IdCategoria = '$id'";
        $resultado = $conexion->query($consulta);
        
        if ($resultado) {
            $fila = $resultado->fetch_assoc();            
            
            $consultaNombre = $fila['Nombre'];
            $consultaDescripcion = $fila['Descripcion'];            
            
        } else {
            echo "Error al obtener datos de la categoría: " . $conexion->error;
        }

        echo '
        <h1>Actualizar Categoría</h1>
        <form action="" method="post">   
             
            <p>Nombre:</p>
            <input type="text" name="Nombre" value="'. $consultaNombre .'"  >

            <p>Descripción:</p>
            <input type="text" name="Descripcion" value="'. $consultaDescripcion .'" >
            
            <input type="submit" name="btnEnviar" value="Actualizar Categoría">      
        </form>';

        if (isset($_POST['btnEnviar'])) {
            $Nombre = $_POST['Nombre'];
            $Descripcion = $_POST['Descripcion'];   

            $sql = "UPDATE Categoria SET Nombre = '$Nombre', Descripcion = '$Descripcion' WHERE IdCategoria = '$id'";
            

            if ($conexion->query($sql) === TRUE) {
                header("Location: categoria.php");
                exit;
            } else {
                echo "Error al actualizar datos: " . $conexion->error;
            }
        }

        $conexion = null;
    ?>      
</body>
</html>
