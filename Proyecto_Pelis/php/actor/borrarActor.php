<?php
include_once '../conBBDD.php'; // Se asume que $pdo ya está configurado correctamente

// Recupera el id del actor a eliminar desde POST
$id = $_POST['id'] ?? null;

if ($id) {
    // Consulta el actor a eliminar
    $query = "SELECT * FROM actor WHERE idActor = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $actor = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirigir si no se pasó un id
    header('Location: actor.php');
    exit;
}

// Lógica para eliminar el actor si se confirma
if (isset($_POST['borrarActor'])) {
    $delete_query = "DELETE FROM actor WHERE idActor = :id";
    $stmt = $pdo->prepare($delete_query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute(); // Ejecutar la eliminación

    header('Location: actor.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Actor</title>
    <link rel="stylesheet" href="../../css/borrar.css"> <!-- Asegúrate de que la ruta sea correcta -->
</head>
<body>
    <div class="container">
        <h2>Estás por eliminar al actor "<?php echo htmlspecialchars($actor['nombreActor']); ?>". ¿Estás seguro de que quieres continuar?</h2>

        <div class="confirmDeleteContainer">
            <a class="btn" href="actor.php">Volver</a>

            <!-- Formulario para confirmar la eliminación del actor -->
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <button type="submit" name="borrarActor" class="confirmDelete">Eliminar</button>
            </form>
        </div>
    </div>
</body>
</html>
