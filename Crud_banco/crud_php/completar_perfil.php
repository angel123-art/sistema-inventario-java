<?php
session_start();
include 'config.php';

if (!isset($_SESSION['idlogin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $telefono = $_POST["telefono"];
    $idlogin = $_SESSION['idlogin'];

    $sql = "INSERT INTO cliente (nombre, apellido, dni, telefono, idlogin)
            VALUES ('$nombre', '$apellido', '$dni', '$telefono', '$idlogin')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['idcliente'] = $conn->insert_id; // Guarda el idcliente en la sesión
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Completar Perfil</title>
    <link rel="stylesheet" type="text/css" href="perfil_comple.css">
</head>
<body>
    <div class="perfil-container">
        <h2>Completar Perfil</h2>
        <form method="post">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellido" placeholder="Apellido" required>
            <input type="text" name="dni" placeholder="DNI" required>
            <input type="text" name="telefono" placeholder="Teléfono" required>
            <input type="submit" value="Guardar">
        </form>
    </div>
</body>
</html>

