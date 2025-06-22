<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedidos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
    include 'conexiona.php';

    try {
        $sql = "SELECT * FROM Pedido";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $num_filas = $stmt->rowCount();

        echo "Pedidos: " . $num_filas . "<br>";
        echo "Relación de Pedidos<br>";
        
        echo '<a href="index.php">Volver a menú</a><br>';
        echo '<style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 2px solid black;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
              </style>';
        echo '<table>
                <tr>
                    <th>IdPedido</th>
                    <th>IdMesa</th>
                    <th>IdCliente</th>
                    <th>IdUsuario</th>
                    <th>Estado</th>
                    <th>FechaHora</th>
                    <th>TotalVenta</th>
                    
                </tr>';

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $fila['IdPedido'] . '</td>';
            $id = $fila['IdPedido'];
            echo '<td>' . $fila['IdMesa'] . '</td>';
            echo '<td>' . $fila['IdCliente'] . '</td>';
            echo '<td>' . $fila['IdUsuario'] . '</td>';
            echo '<td>' . $fila['Estado'] . '</td>';
            echo '<td>' . $fila['FechaHora'] . '</td>';
            echo '<td>' . $fila['TotalVenta'] . '</td>';
            
            echo '</tr>';
        }
        echo '</table>';

        

        $conexion = null;
    } catch (PDOException $err) {
        echo "ERROR: No se pudo conectar a la base de datos: " . $err->getMessage();
    }
    ?>
</body>
</html>
