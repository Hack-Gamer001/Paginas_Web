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

// Obtener los pedidos del usuario
$sql = "SELECT Pedido.IdPedido, Pedido.IdMesa, Cliente.Nombre AS NombreCliente, Pedido.Estado, Pedido.FechaHora, Pedido.TotalVenta FROM Pedido INNER JOIN Cliente ON Pedido.IdCliente = Cliente.IdCliente WHERE Pedido.IdUsuario = '$IdUsuario'";
$result = $conn->query($sql);

$pedidos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
}

// Cerrar la conexión
$conn->close();
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
    
    .new-order-button {
      padding: 10px 20px;
      background-color: #00cc00;
      border: none;
      color: white;
      font-weight: bold;
      border-radius: 5px;
      margin-bottom: 10px;
      cursor: pointer;
    }
    
    .search-select {
      margin-bottom: 10px;
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
    <div class="right-column">
      <div class="header">Lista de Pedidos</div>
      <button class="new-order-button" onclick="location.href='nuevo_pedido.php'">Nuevo Pedido</button>
      <select class="search-select" onchange="filterOrders(this.value)">
        <option value="hoy">Hoy</option>
        <option value="ayer">Ayer</option>
        <option value="ultimos7dias">Últimos 7 días</option>
        <!-- Agrega más opciones de búsqueda aquí -->
      </select>
      <table class="orders-table">
        <thead>
          <tr>
            <th>ID Pedido</th>
            <th>ID Mesa</th>
            <th>Cliente</th>
            <th>Estado</th>
            <th>Fecha y Hora</th>
            <th>Total Venta</th>
            <th class="actions">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pedidos as $pedido): ?>
          <tr>
            <td><?php echo $pedido['IdPedido']; $id = $pedido['IdPedido'];?></td>
            <td><?php echo $pedido['IdMesa'] ? $pedido['IdMesa'] : 'SM'; ?></td>
            <td><?php echo $pedido['NombreCliente']; ?></td>
            <td><?php echo $pedido['Estado']; ?></td>
            <td><?php echo $pedido['FechaHora']; ?></td>
            <td><?php echo $pedido['TotalVenta']; ?></td>
            <td class="actions">
    <a href="editar_pedido.php?idPedido=<?php echo $pedido['IdPedido']; ?>">Editar</a>
    <a href="eliminar_pedido.php?idPedido=<?php echo $pedido['IdPedido']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este pedido?')">Eliminar</a>
    <a href="detallepedido.php?idPedido=<?php echo $pedido['IdPedido']; ?>">Ver Detalle</a>
    
</td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

<script>
  function filterOrders(option) {
    // Implementa la lógica para filtrar los pedidos según la opción seleccionada
  }

  function editOrder(orderId) {
    // Redireccionar a la página de edición del pedido con el ID proporcionado
    window.location.href = 'editar_pedido.php?idPedido=' + orderId;
  }

  function deleteOrder(orderId) {
    if (confirm('¿Estás seguro de que deseas eliminar este pedido?')) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'eliminar_pedido.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // El pedido se eliminó correctamente
            // Actualizar la tabla de pedidos si es necesario
            location.reload();
          } else {
            // Ocurrió un error al eliminar el pedido
            alert('Error al eliminar el pedido. Por favor, intenta nuevamente.');
          }
        }
      };

      xhr.send('idPedido=' + encodeURIComponent(orderId));
    }
  }
  function viewOrder(orderId) {
    // Redireccionar a la página de detalle del pedido con el ID proporcionado
    window.location.href = 'detallepedido.php?id=' + orderId;
}

</script>

</body>
</html>
