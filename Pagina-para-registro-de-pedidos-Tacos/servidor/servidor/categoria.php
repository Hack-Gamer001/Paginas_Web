<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categorías</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
    include 'conexiona.php';

    try {
        $sql = "SELECT * FROM Categoria";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $num_filas = $stmt->rowCount();

        echo "Categorías: " . $num_filas . "<br>";
        echo "Relación de Categorías<br>";
        echo '<div class="button">
                <nav>
                    <form action="ncategoria.php" method="get">
                        <button type="submit" name="btnNuevo">Nuevo</button>
                    </form>
                </nav>
            </div>';
        echo '<a href="index.php">Volver a Menu</a><br>';
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
                    <th>IdCategoria</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th colspan="3">Operaciones</th>
                </tr>';

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $fila['IdCategoria'] . '</td>';
            $id = $fila['IdCategoria'];
            echo '<td>' . $fila['Nombre'] . '</td>';
            echo '<td>' . $fila['Descripcion'] . '</td>';

            echo "<td> <a href='acategoria.php?id=" . $id . "'>Actualizar</a> </td>";
            echo "<td> <a href='bcategoria.php?id=" . $id . "'>Eliminar</a> </td>";
            echo "<td> <a href='nconsumible.php?id=" . $id . "'>Nuevo consumible</a> </td>";

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
