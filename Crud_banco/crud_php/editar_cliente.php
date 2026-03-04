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

// Obtener los datos actuales del cliente
$sql = "SELECT * FROM cliente WHERE idcliente = $idcliente";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 0) {
    die("Cliente no encontrado.");
}

$cliente = $resultado->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $telefono = $_POST["telefono"];

    $sql_update = "UPDATE cliente SET nombre='$nombre', apellido='$apellido', dni='$dni', telefono='$telefono' WHERE idcliente=$idcliente";
    
    if ($conn->query($sql_update) === TRUE) {
        header("Location: admin_clientes.php");
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Cliente</title>
    <link rel="stylesheet" type="text/css" href="editar.css">

</head>
<body>
    <h2>Editar Cliente</h2>
    <form method="post">
        Nombre: <input type="text" name="nombre" value="<?php echo $cliente['nombre']; ?>" required><br>
        Apellido: <input type="text" name="apellido" value="<?php echo $cliente['apellido']; ?>" required><br>
        DNI: <input type="text" name="dni" value="<?php echo $cliente['dni']; ?>" required><br>
        Teléfono: <input type="text" name="telefono" value="<?php echo $cliente['telefono']; ?>" required><br>
        <input type="submit" value="Actualizar">
    </form>
    <br>
    <a href="admin_clientes.php">Volver</a>
</body>
</html>

