<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cerrar Sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
   
    <?php
        session_start();
        session_destroy();
        echo "Sesión cerrada.<br>";
        echo "<a href='log.php'>Volver a iniciar sesión</a>";
    ?>      
</body>
</html>

