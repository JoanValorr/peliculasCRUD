<?php
include_once '../conBBDD.php'; // Este archivo ya debería tener la conexión a la base de datos

// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombrePais = $_POST['nombrePais'] ?? null; // Obtiene el valor o null si no existe

    if (empty($nombrePais)) {
        $error = "No has rellenado todos los campos.";
    } else {
        try {
            // Escapa el valor para evitar inyecciones SQL (aunque PDO generalmente lo maneja automáticamente con prepared statements)
            $nombrePaisEscapado = htmlspecialchars($nombrePais);

            // Inserta en la base de datos usando PDO
            $queryInsert = "INSERT INTO pais (nombrePais) VALUES (:nombrePais)";
            $stmt = $pdo->prepare($queryInsert);
            $stmt->bindParam(':nombrePais', $nombrePaisEscapado, PDO::PARAM_STR);
            $stmt->execute();

            // Redirige al listado de países después de insertar
            header('Location: pais.php');
            exit;
        } catch (PDOException $e) {
            $error = "Error al insertar el país: " . $e->getMessage();
        }
    }
}
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

    <?php if (!empty($error)) : ?>
        <div class="error-message">
            <p><?php echo htmlspecialchars($error); ?></p>
        </div>
    <?php endif; ?>

    <form action="crearPais.php" method="POST">
        <label for="nombrePais">Nombre del País:</label>
        <input type="text" id="nombrePais" name="nombrePais">
        <button type="submit">Crear País</button>
    </form>

    <div class="backContainer">
        <a class="btn" href="pais.php">Volver a la lista de países</a>
    </div>
</body>
</html>
