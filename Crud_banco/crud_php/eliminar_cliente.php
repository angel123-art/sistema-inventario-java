<?php
session_start();
include 'config.php';

if (!isset($_SESSION['idlogin'])) {
    header("Location: login.php");
    exit();
}

// Verificar si se recibió un ID válido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de cliente no válido.");
}

$idcliente = $_GET['id'];

// Eliminar el cliente y sus transacciones relacionadas
$sql_delete = "DELETE FROM cliente WHERE idcliente = $idcliente";

if ($conn->query($sql_delete) === TRUE) {
    header("Location: admin_clientes.php");
    exit();
} else {
    echo "Error al eliminar: " . $conn->error;
}
?>
