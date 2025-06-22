<?php
session_start(); // Iniciar la sesión

include 'conexiona.php';

// Obtener los datos del usuario
$idUsuario = $_SESSION["IdUsuario"];

$sql = "SELECT * FROM Usuario WHERE IdUsuario = '$idUsuario'";
$stmt = $conexion->prepare($sql);
$stmt->execute();

echo '<html>
<head>
    <style> 
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .profile-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background-color: #d2e9cf;
            padding: 20px;
        }
        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #0b6623;
            margin-bottom: 20px;
        }
        .profile-info {
            background-color: #a9d3ab;
            padding: 20px;
            border-radius: 5px;
            width: 500px;
        }
        .profile-info > * {
            margin-bottom: 10px;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        a.button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>';



while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class="profile-container">';
    echo '<div class="profile-image-container">';
    echo '<img class="profile-image" src="' . $fila['Imagen'] . '" alt="Foto de perfil">';
    echo '</div>';
    echo '<div class="profile-info">';
    echo '<p><strong>ID Usuario:</strong> ' . $fila['IdUsuario'] . '</p>';
    echo '<p><strong>Nombre:</strong> ' . $fila['Nombre'] . '</p>';
    echo '<p><strong>Tipo de Documento:</strong> ' . $fila['TipoDocumento'] . '</p>';
    echo '<p><strong>Número de Documento:</strong> ' . $fila['NumDocumento'] . '</p>';
    echo '<p><strong>Dirección:</strong> ' . $fila['Direccion'] . '</p>';
    echo '<p><strong>Teléfono:</strong> ' . $fila['Telefono'] . '</p>';
    echo '<p><strong>Email:</strong> ' . $fila['Email'] . '</p>';
    echo '<p><strong>Cargo:</strong> ' . $fila['Cargo'] . '</p>';
    
    echo '</div>';
    echo '</div>';
}
echo '<a href="lista_pedidos.php" class="button">Centro de pedidos</a><br>';

echo '</body>
</html>';
?>
