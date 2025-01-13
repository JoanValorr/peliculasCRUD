<?php
include_once '../conBBDD.php'; // Se asume que $pdo ya está configurado correctamente

// Recupera el id del país a eliminar
$id = $_GET['id'] ?? null;

if ($id) {
    // Consulta el país a eliminar
    $query = "SELECT * FROM pais WHERE idPais = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $pais = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirigir si no se pasó un id
    header('Location: pais.php');
    exit;
}

// Lógica para eliminar el país si se confirma
if (isset($_POST['borrarPais'])) {
    $delete_query = "DELETE FROM pais WHERE idPais = :id";
    $delete_stmt = $pdo->prepare($delete_query);
    $delete_stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $delete_stmt->execute();

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
        <h2>Estás por eliminar el país "<?php echo htmlspecialchars($pais['nombrePais']); ?>". ¿Estás seguro de que quieres continuar?</h2>

        <div class="confirmDeleteContainer">
            <a class="btn" href="pais.php">Volver</a>

            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <button type="submit" name="borrarPais" class="confirmDelete">Eliminar</button>
            </form>
        </div>
    </div>
</body>
</html>
