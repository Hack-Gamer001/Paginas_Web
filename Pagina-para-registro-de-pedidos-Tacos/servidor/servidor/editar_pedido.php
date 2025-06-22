<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualizar Pedido</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>    
    
    <?php
    include 'conexion.php';

    $idPedido = $_GET['idPedido'];

    $consulta = "SELECT * FROM Pedido WHERE IdPedido = '$idPedido'";
    $resultado = $conexion->query($consulta);

    if ($resultado) {
        $fila = $resultado->fetch_assoc();            

        $idMesa = $fila['IdMesa'];
        $idCliente = $fila['IdCliente'];
        $idUsuario = $fila['IdUsuario'];
        $fechaHora = $fila['FechaHora'];
        $totalVenta = $fila['TotalVenta'];           
    } else {
        echo "Error al obtener datos del pedido: " . $conexion->error;
    }

    echo '<h1>Actualizar Pedido</h1>';
    echo '<form action="" method="post">';
    
    

    echo '<p>ID Mesa:</p>';
    echo '<input type="text" name="idMesa" value="' . $idMesa . '">';

    echo '<p>ID Cliente:</p>';
    echo '<input type="text" name="idCliente" value="' . $idCliente . '">';    

    

    

    echo '<input type="submit" name="btnEnviar" value="Actualizar Pedido">';
    echo '</form>';

    if (isset($_POST['btnEnviar'])) {
        $idMesa = $_POST['idMesa'];
        $idCliente = $_POST['idCliente'];        

        $sql = "UPDATE Pedido SET IdMesa = '$idMesa', IdCliente = '$idCliente'WHERE IdPedido = '$idPedido'";

        if ($conexion->query($sql) === TRUE) {
            echo "Datos editados correctamente<br>";
                echo '<a href="lista_pedidos.php">Volver</a>';
            exit;
        } else {
            echo "Error al actualizar datos: " . $conexion->error;
        }
    }

    $conexion = null;
    ?>      
</body>
</html>