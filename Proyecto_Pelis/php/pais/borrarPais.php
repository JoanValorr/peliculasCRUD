<?php
include_once '../conBBDD.php'; // Se incluye el archivo para conectar con la base de datos

// Recupera el id del país a eliminar desde la URL
$id = $_GET['id'] ?? null; // Si no se pasa el id en la URL, se asigna null

if ($id) {
    // Consulta SQL para obtener los detalles del país con el ID proporcionado
    $query = "SELECT * FROM pais WHERE idPais = :id";
    $stmt = $pdo->prepare($query); // Preparamos la consulta SQL
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Vinculamos el parámetro :id con el valor de $id
    $stmt->execute(); // Ejecutamos la consulta
    $pais = $stmt->fetch(PDO::FETCH_ASSOC); // Obtenemos los resultados de la consulta como un array asociativo

    // Verificar si existen actores asociados al país
    $checkActorsQuery = "SELECT COUNT(*) FROM actor WHERE nacionalidadActor = :id";
    $checkActorsStmt = $pdo->prepare($checkActorsQuery); // Preparamos la consulta para contar actores
    $checkActorsStmt->bindParam(':id', $id, PDO::PARAM_INT); // Vinculamos el parámetro :id con el valor de $id
    $checkActorsStmt->execute(); // Ejecutamos la consulta
    $actorCount = $checkActorsStmt->fetchColumn(); // Obtenemos el número de actores asociados al país

    if ($actorCount > 0) {
        // Si hay actores asociados, mostramos un mensaje de error
        $errorMessage = "No se puede eliminar el país porque hay actores asociados a él.";
    }
} else {
    // Si no se pasó un id, redirigimos a la página de países
    header('Location: pais.php');
    exit;
}

// Lógica para eliminar el país si no hay actores asociados
if (isset($_POST['borrarPais']) && !$errorMessage) {
    // Si se confirma la eliminación y no hay error, se elimina el país de la base de datos
    $delete_query = "DELETE FROM pais WHERE idPais = :id"; // Consulta para eliminar el país
    $delete_stmt = $pdo->prepare($delete_query); // Preparamos la consulta
    $delete_stmt->bindParam(':id', $id, PDO::PARAM_INT); // Vinculamos el parámetro :id con el valor de $id
    $delete_stmt->execute(); // Ejecutamos la consulta

    // Redirigimos a la página de países después de eliminar
    header('Location: pais.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar País</title>
    <link rel="stylesheet" href="../../css/borrar.css">
</head>
<body>
    <div class="container">
        <!-- Si hay un error (actores asociados), mostramos el mensaje de error -->
        <?php if (isset($errorMessage)): ?>
            <h2><?php echo htmlspecialchars($errorMessage); ?></h2>
            <a href="pais.php" class="btn">Volver</a>
        <?php else: ?>
            <h2>Estás por eliminar el país "<?php echo htmlspecialchars($pais['nombrePais']); ?>". ¿Estás seguro de que quieres continuar?</h2>

            <div class="confirmDeleteContainer">
                <!-- Volver a la lista de países -->
                <a class="btn" href="pais.php">Volver</a>

                <!-- Formulario para confirmar la eliminación -->
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <button type="submit" name="borrarPais" class="confirmDelete">Eliminar</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
