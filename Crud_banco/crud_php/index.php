<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Archivos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>📁 Archivos en crud_php</h2>
        <ul class="file-list">
            <?php
            foreach (scandir(__DIR__) as $archivo) {
                if ($archivo != "." && $archivo != ".." && $archivo != "index.php" && $archivo != "style.css") {
                    echo "<li><a href='$archivo'>$archivo</a></li>";
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>
