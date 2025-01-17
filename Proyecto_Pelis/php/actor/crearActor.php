<?php
include_once '../conBBDD.php'; // Asegúrate de que este archivo establece correctamente la conexión PDO en $pdo.

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreActor = $_POST['nombreActor'] ?? '';
    $nacionalidadActor = $_POST['nacionalidadActor'] ?? '';
    $imagenActor = $_POST['imagenActor'] ?? '';

    if (empty($nombreActor) || empty($nacionalidadActor) || empty($imagenActor)) {
        $error = 'Por favor, completa todos los campos.';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO actor (nombreActor, nacionalidadActor, imagen) VALUES (:nombreActor, :nacionalidadActor, :imagen)");
            $stmt->bindParam(':nombreActor', $nombreActor);
            $stmt->bindParam(':nacionalidadActor', $nacionalidadActor, PDO::PARAM_INT);
            $stmt->bindParam(':imagen', $imagenActor);

            if ($stmt->execute()) {
                header('Location: actor.php');
                exit;
            } else {
                $error = 'Hubo un problema al crear el actor.';
            }
        } catch (PDOException $e) {
            $error = 'Error en la base de datos: ' . $e->getMessage();
        }
    }
}

// Obtener las nacionalidades desde la base de datos
$nacionalidades = [];
try {
    $stmt = $pdo->query("SELECT idPais, nombrePais FROM pais");
    $nacionalidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = 'Error al obtener las nacionalidades: ' . $e->getMessage();
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
        <input type="text" id="nombreActor" name="nombreActor" value="<?php echo htmlspecialchars($nombreActor ?? ''); ?>">

        <label for="nacionalidadActor">Nacionalidad:</label>
        <select id="nacionalidadActor" name="nacionalidadActor">
            <option value="">Seleccione una nacionalidad</option>
            <?php foreach ($nacionalidades as $nacionalidad) : ?>
                <option value="<?php echo $nacionalidad['idPais']; ?>">
                    <?php echo htmlspecialchars($nacionalidad['nombrePais']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="imagenActor">Imagen (URL):</label>
        <input type="text" id="imagenActor" name="imagenActor" value="<?php echo htmlspecialchars($imagenActor ?? ''); ?>">

        <button type="submit">Crear Actor</button>
    </form>

    <div class="backContainer">
        <a class="btn" href="actor.php">Volver a la lista de actores</a>
    </div>
</body>
</html>
