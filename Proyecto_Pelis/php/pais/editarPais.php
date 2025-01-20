<?php
include_once '../conBBDD.php'; // Se asume que $pdo ya está configurado correctamente

// Verificar si 'id' está definido en $_GET
if (isset($_GET['id'])) {
    $idPais = $_GET['id'];

    // Preparar y ejecutar la consulta con PDO
    $stmt = $pdo->query("SELECT * FROM pais WHERE idPais = $idPais");
    $pais = $stmt->fetch(PDO::FETCH_ASSOC);

    // Ver si el país existe
    if (!$pais) {
        echo "<h2>Error: País no encontrado</h2>";
        echo "<a href='pais.php'>Volver</a>";
        exit;
    }
} else {
    echo "<h2>Error: idPais no definido</h2>";
    echo "<a href='pais.php'>Volver</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/editar.css">
    <title>Editar País</title>
</head>
<body>
    <div>
        <form action="editarPais.php?id=<?php echo htmlspecialchars($idPais); ?>" method="POST">
            <h2>Editando País: <?php echo htmlspecialchars($pais['nombrePais']); ?></h2>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($pais['idPais']); ?>">

            <label for="name">Nombre del País:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($pais['nombrePais']); ?>" required>

            <input type="submit" value="Actualizar" name="updatePais">
            <a class="btn" href="pais.php">Volver</a>
        </form>
    </div>

    <?php
    if (isset($_POST['updatePais'])):
        // Obtener los datos del formulario
        $name = $_POST['name'];
        $id = $_POST['id'];

        // Verificar si el campo no está vacío
        if (empty($name)) {
            echo "<script>alert('El nombre del país es obligatorio');</script>";
        } else {
            $queryUpdate = "UPDATE pais SET nombrePais = '$name' WHERE idPais = $id";
            $resultUpdate = $pdo->exec($queryUpdate);
            if ($resultUpdate) {
                // Redirigir a la lista de países si todo va bien
                echo "<script>window.location.href = 'pais.php';</script>";
                exit;
            } else {
                echo "<script>alert('Nada actualizado, actualiza algún campo, o cancela la operación');</script>";
            }
        }
    endif;
    ?>
</body>
</html>
