<?php

include_once '../conBBDD.php'; // Conexión a la base de datos

$nombrePais = $_POST['nombrePais'] ?? null; // Recoge el nombre del país del formulario

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/creación.css">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Crear País</title>
</head>
<body>
    <h1>Crear Nuevo País</h1>
    <form action="crearPais.php" method="POST">
        <label for="nombrePais">Nombre del País:</label>
        <input type="text" id="nombrePais" name="nombrePais" value="<?php echo htmlspecialchars($nombrePais); ?>">
        <button type="submit">Crear País</button>
    </form>

    <?php if ($nombrePais !== null && !empty($nombrePais)) : ?>
        <?php
            // Si el campo no está vacío, insertar el nuevo país en la base de datos
            try {
                // Consulta SQL sin preparar
                $queryInsert = "INSERT INTO pais (nombrePais) VALUES ('$nombrePais')";
                $resultInsert = $pdo->exec($queryInsert); // Uso de exec() para consultas que no retornan datos

                if ($resultInsert) {
                    echo "<h2>País creado exitosamente.</h2>";
                    header('Location: pais.php');
                    exit(); // Detener el script después de redirigir
                }
            } catch (PDOException $e) {
                echo "<h2>Hubo un error al crear el país: " . $e->getMessage() . "</h2>";
            }
        ?>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <h2>No has rellenado el nombre del país.</h2>
    <?php endif ?>

    <div class="backContainer">
        <a class="btn" href="pais.php">Volver a la lista de países</a>
    </div>
</body>
</html>
