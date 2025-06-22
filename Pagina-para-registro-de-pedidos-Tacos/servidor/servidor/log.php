<?php
session_start();
include "conexion.php";

// boton
if (!empty($_POST["btnEnviar"])) {
    if (!empty($_POST["Login"]) && !empty($_POST["Clave"])) {
        $Login = $_POST["Login"];
        $Clave = $_POST["Clave"];
        $sql = $conexion->query("SELECT * FROM Usuario WHERE Login = '$Login' AND Clave = '$Clave'");
        if ($sql->num_rows > 0) {
            // Obtener el cargo del usuario
            $row = $sql->fetch_assoc();
            $cargo = $row['Cargo'];

            $_SESSION["IdUsuario"] = $row['IdUsuario'];
            $_SESSION["Nombre"] = $row['Nombre'];
            $_SESSION["NumDocumento"] = $row['NumDocumento'];

            // Redireccionar según el cargo del usuario
            switch ($cargo) {
                case 'Gerente':
                    header("Location: gerente.php");
                    exit;
                case 'Taquero':
                    header("Location: taquero.php");
                    exit;
                case 'Mesero':
                    header("Location: mesero.php");
                    exit;
                case 'Cajero':
                    header("Location: cajero.php");
                    exit;
                default:
                    echo "Cargo desconocido.";
                    break;
            }
            exit; // Agrega esta línea para detener la ejecución del script después de la redirección
        } else {
            // Credenciales inválidas
            echo "Datos erróneos.";
        }
    } else {
        echo "Campos vacíos.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Iniciar sesión</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p>Nombre:</p>
        <input type="text" name="Login" value="<?php echo isset($_POST['Login']) ? $_POST['Login'] : ''; ?>">          
        <p>Clave:</p>
        <input type="text" name="Clave" value="<?php echo isset($_POST['Clave']) ? $_POST['Clave'] : ''; ?>">          

        <input type="submit" name="btnEnviar" value="Acceder"><bd>      
    </form>
  
</body>
</html>
