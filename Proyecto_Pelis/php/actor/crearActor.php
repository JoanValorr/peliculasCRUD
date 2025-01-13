<?php
include_once '../conBBDD.php'; // Este archivo ya debería tener la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera los datos del formulario
    $nombreActor = $_POST['nombreActor'] ?? null;
    $nacionalidadActor = $_POST['nacionalidadActor'] ?? null;
    $imagenActor = $_POST['imagenActor'] ?? null;

    // Depuración: muestra los valores recibidos para asegurarte de que la URL se está recibiendo
    echo "Nombre Actor: " . htmlspecialchars($nombreActor) . "<br>";
    echo "Imagen Actor: " . htmlspecialchars($imagenActor) . "<br>";
    echo "Nacionalidad Actor: " . htmlspecialchars($nacionalidadActor) . "<br>";
 

    if (empty($nombreActor) || empty($nacionalidadActor) || empty($imagenActor)) {
        $error = "No has rellenado todos los campos.";
    } else {
        try {
            // Escapa los valores para evitar inyecciones SQL
            $nombreActorEscapado = htmlspecialchars($nombreActor);
            $nacionalidadActorEscapada = htmlspecialchars($nacionalidadActor);
            $imagenActorEscapada = htmlspecialchars($imagenActor);

            // Inserta en la base de datos usando PDO
            $queryInsert = "INSERT INTO actor (nombreActor, nacionalidadActor, imagen) VALUES (:nombreActor, :nacionalidadActor, :imagenActor)";
            $stmt = $pdo->prepare($queryInsert);
            $stmt->bindParam(':nombreActor', $nombreActorEscapado, PDO::PARAM_STR);
            $stmt->bindParam(':nacionalidadActor', $nacionalidadActorEscapada, PDO::PARAM_STR);
            $stmt->bindParam(':imagenActor', $imagenActorEscapada, PDO::PARAM_STR);
            $stmt->execute();

            // Redirige al listado de actores después de insertar
            header('Location: actor.php');
            exit;
        } catch (PDOException $e) {
            $error = "Error al insertar el actor: " . $e->getMessage();
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
    <title>Crear Actor</title>
</head>
<body>
    <h1>Crear Nuevo Actor</h1>

    <?php if (!empty($error)) : ?>
        <div class="error-message">
            <p><?php echo htmlspecialchars($error); ?></p>
        </div>
    <?php endif; ?>

    <form action="crearActor.php" method="POST">
        <label for="nombreActor">Nombre del Actor:</label>
        <input type="text" id="nombreActor" name="nombreActor">

        <label for="nacionalidadActor">Nacionalidad:</label>
        <input type="text" id="nacionalidadActor" name="nacionalidadActor">

        <label for="imagenActor">Imagen (URL):</label>
        <input type="text" id="imagenActor" name="imagenActor">

        <button type="submit">Crear Actor</button>
    </form>

    <div class="backContainer">
        <a class="btn" href="actor.php">Volver a la lista de actores</a>
    </div>
</body>
</html>
