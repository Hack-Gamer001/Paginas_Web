<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingresar Detalle</title>
    
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
    include 'conexiona.php';

    $idPedido = $_GET['idPedido'];

    echo '<h1>Nuevo Detalle</h1>';

    echo '<form action="ndetalle.php?idPedido=' . $idPedido . '" method="post">';
    echo '<label for="consumible">Consumible</label>';
    echo '<select id="consumible" name="consumible" required>';
    echo '<option value="">Seleccionar consumible</option>';

    $consulta = "SELECT * FROM Consumible";
    $stmt = $conexion->prepare($consulta);
    $stmt->execute();

    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $fila['IdConsumible'] . '">' . $fila['Nombre'] . '</option>';
    }

    echo '</select><br>';

    echo '<p>Cantidad:</p>';
    echo '<input type="text" name="cantidad"><br>';

    

    echo '<input type="submit" name="btnEnviar" value="Agregar Detalle">';
    echo '</form>';

    if (isset($_POST['btnEnviar'])) {
        $idDetallePedido = uniqid(); // Genera un ID único para el detalle del pedido
        $idConsumible = $_POST['consumible'];
        $cantidad = $_POST['cantidad'];
        $precioUnitario = $_POST['precio_unitario'];

        $sql = "INSERT INTO DetallePedido (IdDetallePedido, IdPedido, IdConsumible, Cantidad, PrecioUnitario) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$idDetallePedido, $idPedido, $idConsumible, $cantidad, $precioUnitario]);

        if ($stmt->rowCount() > 0) {
            echo '<a href="lista_pedidos.php" class="enlace-volver">Volver a ver Pedidos</a>';
            exit;
        } else {
            echo "Error al insertar datos";
        }
    }

    $conexion = null;
    ?>
</body>
</html>
