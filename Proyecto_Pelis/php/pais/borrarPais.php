<?php
include_once '../conBBDD.php'; // Se asume que $pdo ya está configurado correctamente

// Recupera el id del país desde GET o POST
$id = $_GET['id'] ?? $_POST['id'] ?? null;

if ($id) {
    // Consulta el país a eliminar
    $query = "SELECT * FROM pais WHERE idPais = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $pais = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($pais) {
        // Verifica si hay actores asociados al país
        $actorQuery = "SELECT COUNT(*) FROM actor WHERE nacionalidadActor = :id";
        $actorStmt = $pdo->prepare($actorQuery);
        $actorStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $actorStmt->execute();
        $actorCount = $actorStmt->fetchColumn();

        if ($actorCount > 0) {
            // Si hay actores asociados, mostramos un mensaje de error
            $errorMessage = "No se puede eliminar el país porque hay actores asociados a él.";
        } elseif (isset($_POST['borrarPais'])) {
            // Si no hay actores asociados y se confirma la eliminación
            $delete_query = "DELETE FROM pais WHERE idPais = :id";
            $stmt = $pdo->prepare($delete_query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Ejecutar la eliminación

            // Redirigir tras eliminar
            header('Location: pais.php?mensaje=El país ha sido eliminado correctamente.');
            exit;
        }
    } else {
        // Redirigir si el país no existe
        header('Location: pais.php');
        exit;
    }
} else {
    // Redirigir si no se pasó un id
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
        <?php if (!empty($errorMessage)): ?>
            <h2><?php echo htmlspecialchars($errorMessage); ?></h2>
            <a href="pais.php" class="btn">Volver</a>
        <?php elseif (!empty($pais)): ?>
            <h2>Estás por eliminar el país "<?php echo htmlspecialchars($pais['nombrePais']); ?>". ¿Estás seguro de que quieres continuar?</h2>
            <div class="confirmDeleteContainer">
                <a class="btn" href="pais.php">Volver</a>

                <!-- Formulario para confirmar la eliminación del país -->
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <button type="submit" name="borrarPais" class="confirmDelete">Eliminar</button>
                </form>
            </div>
        <?php else: ?>
            <h2>No se ha encontrado el país especificado.</h2>
            <a href="pais.php" class="btn">Volver</a>
        <?php endif; ?>
    </div>
</body>
</html>
