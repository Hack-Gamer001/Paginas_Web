<?php
session_start();
if (empty($_SESSION["IdUsuario"])) {
	header("location: log.php");
	
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gerente</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
        }

        .button-container {
            text-align: center;
        }

        .button-container .button {
            display: inline-block;
            margin: 10px;
            padding: 10px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            animation: bounce 1s ease infinite;
            background-image: url('https://2.bp.blogspot.com/-QWV-YIUdXgU/V7CSvI1DNmI/AAAAAAAFymQ/ea9APEjx32MlFilCtxCbEAEwYtRKaNG5gCLcB/s1600/EFECTOS%2B%2528536%2529.gif');
            background-size: cover;
        }

        @keyframes bounce {
            0%,
            100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        .login-link {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hola, gerente</h1>
        
        <div class="button-container">
            <a href="index.php" class="button">Control de tablas</a>
            <a href="controladorSS.php" class="button">Cerrar sesión</a>
        </div>
    </div>
</body>
</html>
