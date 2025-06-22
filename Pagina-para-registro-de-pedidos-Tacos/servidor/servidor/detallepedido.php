<?php
include 'conexiona.php';
?>

<!DOCTYPE html>
<html> 
<head> 
    <meta charset="UTF-8">
    <title>Menú de Detalles</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
    echo "<h1>Lista de Detalles del pedido</h1>";
    $idPedido = $_GET['idPedido'];
    $sql = "SELECT dp.IdDetallePedido, cl.Nombre AS NombreCliente, c.Nombre AS NombreConsumible, dp.Cantidad, dp.PrecioUnitario 
FROM DetallePedido dp INNER JOIN Pedido p ON dp.IdPedido = p.IdPedido
                        INNER JOIN Consumible c ON dp.IdConsumible = c.IdConsumible inner join Cliente cl on cl.IdCliente = p.IdCliente
                        WHERE dp.IdPedido = '$idPedido'";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    
    
    echo "<p class='titulo-consumibles'>Relación de Detalles de Pedido</p>";
        
    echo '<table>
        <tr>
            <th>IdDetallePedido</th>
            <th>Cliente</th>
            <th>Consumible</th>
            <th>Cantidad</th>
            <th>PrecioUnitario</th>
            <th colspan="2">Operaciones</th>
        </tr>';

    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $fila['IdDetallePedido'] . '</td>';
        $id = $fila['IdDetallePedido'];
        echo '<td>' . $fila['NombreCliente'] . '</td>';
        echo '<td>' . $fila['NombreConsumible'] . '</td>';
        echo '<td>' . $fila['Cantidad'] . '</td>';
        echo '<td>' . $fila['PrecioUnitario'] . '</td>';
        echo "<td> <a href='bdetallepedido.php?id=".$id."'>Eliminar</a> </td>";
        echo '</tr>';
    }
    echo '</table>';

    echo '<a href="lista_pedidos.php" class="enlace-volver">Volver a ver Pedidos</a>';

    $conexion = null;
    ?>
</body>
</html>
