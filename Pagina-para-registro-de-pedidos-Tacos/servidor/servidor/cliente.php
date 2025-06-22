<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clientes</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
    include 'conexiona.php';

    try {
        $sql = "SELECT * FROM Cliente";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $num_filas = $stmt->rowCount();

        echo "Clientes: " . $num_filas . "<br>";
        echo "Relación de Clientes<br>";
        
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
                    <th>IdCliente</th>
                    <th>Nombre</th>
                    <th>TipoDocumento</th>
                    <th>NumDocumento</th>
                    
                </tr>';

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $fila['IdCliente'] . '</td>';
            $id = $fila['IdCliente'];
            echo '<td>' . $fila['Nombre'] . '</td>';
            echo '<td>' . $fila['TipoDocumento'] . '</td>';
            echo '<td>' . $fila['NumDocumento'] . '</td>';

           

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
