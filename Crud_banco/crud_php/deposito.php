<?php
session_start();
include 'config.php';

if (!isset($_SESSION['idlogin']) || !isset($_SESSION['idcliente'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $monto = floatval($_POST["monto"]); // Asegurar que es un número válido
    $idcliente = $_SESSION['idcliente']; 

    if ($monto <= 0) {
        echo "❌ Error: El monto debe ser mayor a 0.";
    } else {
        // Insertar el depósito en la base de datos
        $sql = "INSERT INTO deposito (deposito, fecha, idcliente) VALUES ('$monto', NOW(), '$idcliente')";
        if ($conn->query($sql) === TRUE) {
            echo "✅ Depósito realizado con éxito.";
            header("refresh:2; url=dashboard.php"); // Redirigir después de 2 segundos
        } else {
            echo "❌ Error: " . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Depósito</title>
    <link rel="stylesheet" type="text/css" href="deposito.css">
</head>
<body>
    <div class="deposit-container">
        <h2>Depositar Dinero</h2>
        <form method="post">
            <input type="number" name="monto" placeholder="Ingrese el monto" required>
            <input type="submit" value="Depositar">
        </form>
        <a href="dashboard.php" class="back-link">Volver al Dashboard</a>
    </div>
</body>
</html>
