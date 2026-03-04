<?php
session_start();
include 'config.php';

if (!isset($_SESSION['idlogin'])) {
    header("Location: login.php");
    exit();
}

$idlogin = $_SESSION['idlogin'];

// Verificar si el usuario tiene un cliente asociado
$sql_cliente = "SELECT idcliente FROM cliente WHERE idlogin = '$idlogin'";
$resultado_cliente = $conn->query($sql_cliente);

if ($resultado_cliente->num_rows > 0) {
    $fila_cliente = $resultado_cliente->fetch_assoc();
    $_SESSION['idcliente'] = $fila_cliente['idcliente'];
} else {
    header("Location: completar_perfil.php"); // Si no tiene perfil, lo redirige
    exit();
}

// Obtener saldo
$consulta_saldo = "SELECT (IFNULL(SUM(deposito.deposito), 0) - IFNULL(SUM(retiro.monto), 0)) AS saldo 
                   FROM cliente 
                   LEFT JOIN deposito ON cliente.idcliente = deposito.idcliente 
                   LEFT JOIN retiro ON cliente.idcliente = retiro.idcliente 
                   WHERE cliente.idlogin = '$idlogin'";
$resultado = $conn->query($consulta_saldo);
$fila = $resultado->fetch_assoc();
$saldo_disponible = $fila["saldo"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <link rel="stylesheet" type="text/css" href="dashboard.css">
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['user']; ?></h2>
    <h3>Tu saldo actual es: $<?php echo number_format($saldo_disponible, 2); ?></h3>
    <a href="deposito.php">Depositar</a> | 
    <a href="retiro.php">Retirar</a> | 
    <a href="admin_clientes.php">Administrar Clientes</a> | 
    <a href="logout.php" class="delete">Cerrar Sesión</a>
</body>
</html>
