<?php
session_start();
// Establecer la conexión a la base de datos

include "conexion.php";
// boton uwu
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
                    header('Location: gerente.php');
                    break;
                case 'Taquero':
                    header('Location: taquero.php');
                    break;
                case 'Mesero':
                    header('Location: mesero.php');
                    break;
                case 'Cajero':
                    header('Location: cajero.php');
                    break;
                default:
                    echo "Cargo desconocido.";
                    break;
            }
        } else {
            // Credenciales inválidas
            echo "Datos erróneos.";
        }
    } else {
        echo "Campos vacíos.";
    }
}
?>
