<?php
session_start();
include 'config.php';

if (!isset($_SESSION['idlogin'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['idcliente'])) {
    // Obtener idcliente desde la BD si no está en la sesión
    $idlogin = $_SESSION['idlogin'];
    $sql_cliente = "SELECT idcliente FROM cliente WHERE idlogin = '$idlogin'";
    $resultado_cliente = $conn->query($sql_cliente);
    
    if ($resultado_cliente->num_rows > 0) {
        $fila_cliente = $resultado_cliente->fetch_assoc();
        $_SESSION['idcliente'] = $fila_cliente['idcliente'];
    } else {
        die("Error: No se encontró el cliente.");
    }
}

$idcliente = $_SESSION['idcliente'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $monto = floatval($_POST["monto"]); // Asegurar que es un número válido

    // Obtener saldo actual con consultas separadas
    $consulta_deposito = "SELECT IFNULL(SUM(deposito), 0) AS total_depositado FROM deposito WHERE idcliente = '$idcliente'";
    $resultado_deposito = $conn->query($consulta_deposito);
    $fila_deposito = $resultado_deposito->fetch_assoc();
    $total_depositado = $fila_deposito["total_depositado"];

    $consulta_retiro = "SELECT IFNULL(SUM(monto), 0) AS total_retirado FROM retiro WHERE idcliente = '$idcliente'";
    $resultado_retiro = $conn->query($consulta_retiro);
    $fila_retiro = $resultado_retiro->fetch_assoc();
    $total_retirado = $fila_retiro["total_retirado"];

    // Calcular saldo disponible
    $saldo_disponible = $total_depositado - $total_retirado;

    if ($monto <= 0) {
        echo "❌ Error: El monto debe ser mayor a 0.";
    } elseif ($monto > $saldo_disponible) {
        echo "❌ Error: Fondos insuficientes.";
    } else {
        // Insertar el retiro en la base de datos
        $sql_retiro = "INSERT INTO retiro (monto, fecha, idcliente) VALUES ('$monto', NOW(), '$idcliente')";
        if ($conn->query($sql_retiro) === TRUE) {
            echo "✅ Retiro realizado con éxito.";
            header("refresh:2; url=dashboard.php"); // Redirigir después de 2 segundos
        } else {
            echo "❌ Error al procesar el retiro: " . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Retiro</title>
    <link rel="stylesheet" type="text/css" href="retiro.css">
</head>
<body>
    <div class="retiro-container">
        <h2>Retirar Dinero</h2>
        <form method="post">
            <input type="number" name="monto" placeholder="Ingrese el monto" required>
            <input type="submit" value="Retirar">
        </form>
        <a href="dashboard.php" class="back-link">Volver al Dashboard</a>
    </div>
</body>
</html>
