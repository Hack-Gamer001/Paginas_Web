<?php
session_start();
if (empty($_SESSION["IdUsuario"])) {
    header("location: log.php");
    exit();
}

// Conexión a la base de datos
$servername = "www.dais-l-07.com";
$username = "daisl07_dsiproyecto03";
$password = "GQ.Jl~Ka);7O";
$dbname = "daisl07_dsiproyecto03";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Falló la conexión a la base de datos: " . $conn->connect_error);
}

// Obtener el usuario autenticado por su IdUsuario
$IdUsuario = $_SESSION["IdUsuario"];

$sql = "SELECT * FROM Usuario WHERE IdUsuario = '$IdUsuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No se encontró ningún usuario con el IdUsuario proporcionado.";
}

// Obtener el nombre de usuario del usuario autenticado
$sql = "SELECT Nombre FROM Usuario WHERE IdUsuario = '$IdUsuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    $nombreUsuario = $userData['Nombre'];
} else {
    $nombreUsuario = "Nombre de Usuario Desconocido";
}

// Obtener los pedidos de todos los usuarios
$sql = "SELECT Pedido.IdPedido, Pedido.IdMesa, Usuario.Nombre AS NombreUsuario, Cliente.Nombre AS NombreCliente, Pedido.Estado, Pedido.FechaHora, Pedido.TotalVenta FROM Pedido INNER JOIN Usuario ON Pedido.IdUsuario = Usuario.IdUsuario INNER JOIN Cliente ON Pedido.IdCliente = Cliente.IdCliente";
$result = $conn->query($sql);

$pedidos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Inicio - Mesero</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        /* Contenedor principal */
        .container {
            display: flex;
            width: 100%;
        }

        /* Columna izquierda */
        .left-column {
            flex-basis: 20%;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgba(0, 128, 0, 0.7);
            padding: 10px;
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
        }

        .user-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 10px;
            object-fit: cover;
        }

        .user-details {
            text-align: center;
            color: white;
        }

        .user-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .menu {
            margin-top: 30px;
            color: white;
        }

        .menu-item {
            margin-bottom: 10px;
        }

        /* Columna derecha */
        .right-column {
            flex-grow: 1;
            background-color: #eeffee;
            padding: 20px;
            border-radius: 0px;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .search-form {
            margin-bottom: 10px;
        }

        .search-input {
            width: 300px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .search-button {
            padding: 5px 10px;
            background-color: #00cc00;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th,
        .orders-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .orders-table th {
            background-color: #00cc00;
            color: white;
        }

        .orders-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .orders-table td.actions {
            white-space: nowrap;
        }

        .update-icon,
        .delete-icon {
            color: #006600;
            margin-right: 5px;
            cursor: pointer;
        }

        .delete-icon {
            color: #cc0000;
        }
    </style>
</head>
<body>
<?php
// Tu código PHP aquí
?>

<div class="container">
    <!-- Columna izquierda -->
    <div class="left-column">
        <img class="user-image" src="<?php echo $user['Imagen']; ?>" alt="Imagen de Usuario">
        <div class="user-details">
            <div class="user-name"><?php echo $user['Nombre']; ?></div>
            <div class="menu">
                <div class="menu-item"><a href="perfil.php">Perfil</a></div>
                <div class="menu-item"><a href="lista_pedidos.php">Lista de Pedidos</a></div>
                <div class="menu-item"><a href="nuevo_pedido.php">Nuevo Pedido</a></div>
            </div>
        </div>
    </div>

    <!-- Columna derecha -->
    <!-- ... Código HTML anterior ... -->

<div class="right-column">
    <div class="header">Lista de Pedidos</div>
    <form class="search-form" method="get">
        <input class="search-input" type="text" name="cliente" placeholder="Buscar por nombre de cliente"
               oninput="searchOrders(this.value)">
    </form>
    <table class="orders-table">
        <thead>
        <tr>
            <th>IdPedido</th>
            <th>IdUsuario</th>
            <th>IdMesa</th>
            <th>NombreCliente</th>
            <th>Estado</th>
            <th>FechaHora</th>
            <th>TotalVenta</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pedidos as $pedido) { ?>
            <tr class="pedido-row">
                <td><?php echo $pedido['IdPedido']; ?></td>
                <td><?php echo $nombreUsuario; ?></td>
                <td><?php echo $pedido['IdMesa']; ?></td>
                <td><?php echo $pedido['NombreCliente']; ?></td>
                <td><?php echo $pedido['Estado']; ?></td>
                <td><?php echo $pedido['FechaHora']; ?></td>
                <td><?php echo $pedido['TotalVenta']; ?></td>
                <td class="actions">
                    <a href="editar_pedido.php?idPedido=<?php echo $pedido['IdPedido']; ?>">Editar</a>
    <a href="eliminar_pedido.php?idPedido=<?php echo $pedido['IdPedido']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este pedido?')">Eliminar</a>
    <a href="detallepedido.php?idPedido=<?php echo $pedido['IdPedido']; ?>">Ver Detalle</a>
    <a href="ndetalle.php?idPedido=<?php echo $pedido['IdPedido']; ?>">Agregar Detalle</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- ... Código HTML posterior ... -->

<script>
    function searchOrders(cliente) {
        // Obtener todas las filas de pedidos
        var pedidosRows = document.querySelectorAll('.pedido-row');
        
        // Convertir el valor de búsqueda a minúsculas para hacer la comparación no sensible a mayúsculas y minúsculas
        var clienteLowerCase = cliente.toLowerCase();

        // Recorrer todas las filas de pedidos
        pedidosRows.forEach(function(row) {
            // Obtener el nombre del cliente en esta fila
            var nombreCliente = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

            // Comprobar si el nombre del cliente coincide con el valor de búsqueda
            if (nombreCliente.includes(clienteLowerCase)) {
                // Mostrar la fila si coincide
                row.style.display = 'table-row';
            } else {
                // Ocultar la fila si no coincide
                row.style.display = 'none';
            }
        });
    }
</script>
