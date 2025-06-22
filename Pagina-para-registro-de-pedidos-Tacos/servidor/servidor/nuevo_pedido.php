<!DOCTYPE html>
<head>
    <title>Registrar Pedido</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Registrar Pedido</h1>
    <form id="pedido-form" action="nuevo_pedido.php" method="post">
        <!-- Cliente -->
        <label for="cliente">Cliente</label>
        <select id="cliente" name="cliente" required>
            <option value="">Seleccionar cliente</option>
            <?php
            include 'conexiona.php';

            $consulta = "SELECT * FROM Cliente";
$stmt = $conexion->prepare($consulta);
$stmt->execute();

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<option value="' . $fila['IdCliente'] . '">' . $fila['Nombre'] . '</option>';
}

            $conexion = null;
            ?>
        </select><br>
<!-- Mesa -->
        <label for="mesa">Mesa</label>
        <select id="mesa" name="mesa" required>
            <option value="">Seleccionar mesa</option>
            <?php
            include 'conexiona.php';

            $consulta = "SELECT * FROM Mesa";
            $stmt = $conexion->prepare($consulta);
            $stmt->execute();

            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $fila['IdMesa'] . '">Mesa ' . $fila['IdMesa'] . '</option>';
            }

            $conexion = null;
            ?>
        </select>
        <br>  
        <input type="submit" name="btnEnviar" value="Agregar Pedido">      
    </form>
<?php
        include 'conexiona.php';

        if (isset($_POST['btnEnviar'])) {
            $mesa = $_POST['mesa'];
            $cliente = $_POST['cliente'];

            $sql = "INSERT INTO Pedido ( IdMesa, IdCliente, IdUsuario,Estado, TotalVenta)
VALUES
    ( '$mesa', '$cliente', '2','EN ESPERA', 0)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$mesa, $cliente]);

            if ($stmt->rowCount() > 0) {
                echo "Datos insertados correctamente<br>";
                echo '<a href="lista_pedidos.php">Volver</a>';
            } else {
                echo "Error al insertar datos";
            }
        }

        $conexion = null;
    ?>  

        

</body>
</html>
