

<?php
// register.php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $dni = $_POST["dni"];
    $telefono = $_POST["telefono"];

    // Verificar si el usuario ya existe
    $sql_check = "SELECT users FROM login WHERE users = '$user'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "Error: El usuario ya existe. Intenta con otro nombre.";
    } else {
        // Insertar usuario en la tabla login
        $sql = "INSERT INTO login (users, password) VALUES ('$user', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            $idlogin = $conn->insert_id; // Obtiene el ID del usuario recién registrado

            // Verificar si el DNI ya existe
            $sql_dni_check = "SELECT dni FROM cliente WHERE dni = '$dni'";
            $result_dni_check = $conn->query($sql_dni_check);

            if ($result_dni_check->num_rows > 0) {
                echo "Error: El DNI ya está registrado.";
            } else {
                // Insertar el cliente asociado
                $sql_cliente = "INSERT INTO cliente (nombre, apellido, dni, telefono, idlogin) 
                                VALUES('NombreEjemplo', 'ApellidoEjemplo', '$dni', '$telefono', '$idlogin')";
                
                if ($conn->query($sql_cliente) === TRUE) {
                    echo "Usuario registrado con éxito.";
                    header("refresh:2; url=login.php"); // Redirige al login después de 2 segundos
                } else {
                    echo "Error al registrar cliente: " . $conn->error;
                }
            }
        } else {
            echo "Error al registrar usuario: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="registro.css">
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <form method="post">
            <input type="text" name="user" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="text" name="dni" placeholder="DNI" required>
            <input type="text" name="telefono" placeholder="Teléfono" required>
            <input type="submit" value="Registrarse">
        </form>
        <br>
        <br>
        <a href="login.php">¿Ya tienes una cuenta? Inicia sesión</a>
    </div>
</body>
</html>
