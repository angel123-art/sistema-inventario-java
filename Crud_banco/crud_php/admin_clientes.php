<?php
session_start();
include 'config.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idlogin'])) {
    header("Location: login.php");
    exit();
}

// Obtener todos los clientes y su saldo
$sql = "SELECT cliente.idcliente, cliente.nombre, cliente.apellido, cliente.dni, cliente.telefono,
               (IFNULL(SUM(deposito.deposito), 0) - IFNULL(SUM(retiro.monto), 0)) AS saldo
        FROM cliente
        LEFT JOIN deposito ON cliente.idcliente = deposito.idcliente
        LEFT JOIN retiro ON cliente.idcliente = retiro.idcliente
        GROUP BY cliente.idcliente";
$resultado = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Administración de Clientes</title>
    <link rel="stylesheet" type="text/css" href="admin_clientes.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Clientes</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>Saldo</th>
                <th>Acciones</th>
            </tr>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila['idcliente']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['apellido']; ?></td>
                    <td><?php echo $fila['dni']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td>$<?php echo number_format($fila['saldo'], 2); ?></td>
                    <td>
                        <a href="editar_cliente.php?id=<?php echo $fila['idcliente']; ?>" class="edit">Editar</a>
                        <a href="eliminar_cliente.php?id=<?php echo $fila['idcliente']; ?>" class="delete" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <div class="btn-container">
            <a href="dashboard.php" class="back">Volver al Dashboard</a>
        </div>
    </div>
</body>
</html>

