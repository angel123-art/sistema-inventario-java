<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $password = $_POST["password"];
    
    // Buscar el usuario en la tabla login
    $sql = "SELECT * FROM login WHERE users='$user'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['users'];
            $_SESSION['idlogin'] = $row['idlogin']; // Guarda el ID de login
            
            // Buscar el idcliente correspondiente al idlogin
            $idlogin = $row['idlogin'];
            $sql_cliente = "SELECT idcliente FROM cliente WHERE idlogin = '$idlogin'";
            $result_cliente = $conn->query($sql_cliente);
            
            if ($result_cliente->num_rows > 0) {
                $cliente = $result_cliente->fetch_assoc();
                $_SESSION['idcliente'] = $cliente['idcliente']; // Guarda el idcliente en la sesión
                
                // Redirigir al dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error: No se encontró un cliente asociado a este usuario.";
                exit();
            }
        } else {
            echo "⚠ Contraseña incorrecta.";
        }
    } else {
        echo "⚠ Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form method="post" action="login.php">
            <input type="text" name="user" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
            <br>
            <br>
            <a href="register.php">¿No tienes una cuenta? Registrate </a>
            
        </form>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error-message">Usuario o contraseña incorrectos</p>
        <?php } ?>

    </div>
    <div>        
    </div>
</body>
</html>


