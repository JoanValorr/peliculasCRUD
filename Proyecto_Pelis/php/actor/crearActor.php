<?php
include_once '../conBBDD.php'; // Conexión a la base de datos

$nombreActor = $_POST['nombreActor'] ?? null;
$nacionalidadActor = $_POST['nacionalidadActor'] ?? null;
$imagenActor = $_POST['imagenActor'] ?? null;
$error = '';

// Establecer imagen predeterminada si no se proporciona una url
$imagenActor = $imagenActor ?: "../images/avatar.png";  // Ruta de la imagen predeterminada
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/creación.css">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Crear Actor</title>
</head>
<body>
    <h1>Crear Nuevo Actor</h1>
    <form action="crearActor.php" method="POST">
        <label for="nombreActor">Nombre del Actor:</label>
        <input type="text" id="nombreActor" name="nombreActor" value="<?php echo htmlspecialchars($nombreActor); ?>">

        <label for="nacionalidadActor">Nacionalidad:</label>
        <select id="nacionalidadActor" name="nacionalidadActor">
            <option value="">Seleccione una nacionalidad</option>
            <?php
                // Obtener las nacionalidades desde la base de datos
                try {
                    $stmt = $pdo->query("SELECT idPais, nombrePais FROM pais");
                    $nacionalidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    $error = 'Error al obtener las nacionalidades: ' . $e->getMessage();
                }

                // Mostrar opciones de nacionalidad
                foreach ($nacionalidades as $nacionalidad) {
                    echo '<option value="' . $nacionalidad['idPais'] . '" ' . ($nacionalidadActor == $nacionalidad['idPais'] ? 'selected' : '') . '>';
                    echo htmlspecialchars($nacionalidad['nombrePais']);
                    echo '</option>';
                }
            ?>
        </select>

        <label for="imagenActor">Imagen (URL):</label>
        <input type="text" id="imagenActor" name="imagenActor" >

        <button type="submit">Crear Actor</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <?php
            // Validación de campos
            if (empty($nombreActor) || empty($nacionalidadActor)) {
                echo "<h2>Por favor, completa todos los campos.</h2>";
            } else {
                    // Inserción de datos en la base de datos
                    $queryInsert = "INSERT INTO actor (nombreActor, nacionalidadActor, imagen) VALUES ('$nombreActor', '$nacionalidadActor', '$imagenActor')";
                    $resultInsert = $pdo->exec($queryInsert); // Ejecutar consulta sin preparación
                    header('Location: actor.php'); // Redirigir a la página de actores
                    exit;}
        ?>
    <?php endif; ?>
    <div class="backContainer">
        <a class="btn" href="actor.php">Volver a la lista de actores</a>
    </div>
</body>
</html>
