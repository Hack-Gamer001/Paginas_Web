<?php
include 'conexiona.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menú de Consumibles</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Menú de Consumibles</h1>

    <?php
    $sql = "SELECT * FROM Consumible ";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $num_filas = $stmt->rowCount();

    echo "<p class='num-consumibles'>Consumibles: " . $num_filas . "</p>";
    echo "<p class='titulo-consumibles'>Relación de Consumibles</p>";

    echo '<table>
        <tr>
            <th>IdConsumible</th>
            <th>IdCategoría</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Precio Unitario</th> 
            <th colspan="2">Operaciones</th>
        </tr>';

    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $fila['IdConsumible'] . '</td>';
        $id = $fila['IdConsumible'];
        echo '<td>' . $fila['IdCategoria'] . '</td>';
        echo '<td>' . $fila['Nombre'] . '</td>';
        echo '<td>' . $fila['Descripcion'] . '</td>';
        echo '<td><img src="' . $fila['Imagen'] . '" alt="Imagen del consumible"></td>';
        echo '<td>' . $fila['PrecioUnitario'] . '</td>';

        echo "<td> <a href='aconsumible.php?id=".$id."'>Actualizar</a> </td>";
        echo "<td> <a href='bconsumible.php?id=".$id."'>Eliminar</a> </td>";

        echo '</tr>';
    }
    echo '</table>';

    echo '<a href="categoria.php" class="enlace-volver">Volver a categoría</a>';

    $conexion = null;
    ?>
</body>
</html>
