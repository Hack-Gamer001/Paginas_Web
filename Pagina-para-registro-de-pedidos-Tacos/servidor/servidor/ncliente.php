<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingresar Cliente</title>
    
    <link rel="stylesheet" href="estilos.css">
    <style>
        /* CSS styles for the buttons */
        input[type="submit"][name="btnEnviar"] {
            padding: 10px 20px;
            background-color: #00cc00;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"][name="btnEnviar"]:hover {
            background-color: #009900;
        }
    </style>
</head>
<body>
    <?php
    include 'conexiona.php';

    if (isset($_POST['btnEnviar'])) {
        
        $Nombre = $_POST['Nombre'];
        $TipoDocumento = $_POST['TipoDocumento'];
        $NumDocumento = $_POST['NumDocumento'];

        $sql = "INSERT INTO Cliente (Nombre, TipoDocumento, NumDocumento) VALUES ('$Nombre', '$TipoDocumento', '$NumDocumento')";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$IdCliente, $Nombre, $TipoDocumento, $NumDocumento]);

        if ($stmt->rowCount() > 0) {
            echo '<script>window.location.href = "lista_pedidos.php";</script>';
            exit;
        } else {
            echo "Error al insertar datos";
        }
    }
    ?>

    <h1>Nuevo Cliente</h1>
    <form action="" method="post">
        
        <p>Nombre:</p><input type="text" name="Nombre">
        <p>Tipo de Documento:</p><input type="text" name="TipoDocumento">
        <p>Número de Documento:</p><input type="text" name="NumDocumento">
        <br>  
        <input type="submit" name="btnEnviar" value="Agregar Cliente">      
    </form>

    <?php
    $conexion = null;
    ?>
</body>
</html>