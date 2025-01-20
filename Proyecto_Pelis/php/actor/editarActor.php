<?php
include_once '../conBBDD.php'; // Se asume que $pdo ya está configurado correctamente

// Verificar si 'id' está definido en $_GET
if (isset($_GET['id'])) {
    $idActor = $_GET['id'];

    // Preparar y ejecutar la consulta con PDO
    $stmt = $pdo->prepare("SELECT * FROM actor WHERE idActor = :idActor");
    $stmt->bindParam(':idActor', $idActor, PDO::PARAM_INT);
    $stmt->execute();

    // Obtener resultados
    $tituloActor = $stmt->fetch(PDO::FETCH_ASSOC);

    // Ver si el actor existe
    if (!$tituloActor) {
        echo "<h2>Error: Actor no encontrado</h2>";
        echo "<a href='actor.php'>Volver</a>";
        exit;
    }
} else {
    echo "<h2>Error: idActor no definido</h2>";
    echo "<a href='actor.php'>Volver</a>";
    exit;
}

// Obtener las nacionalidades
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
    <link rel="stylesheet" href="../../css/editar.css">
    <title>Editar Actor</title>
</head>
<body>
    <div>
        <form action="editarActor.php?id=<?php echo htmlspecialchars($idActor); ?>" method="POST">
            <h2>Editando Actor: <?php echo htmlspecialchars($tituloActor['nombreActor']); ?></h2>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($tituloActor['idActor']); ?>">
            
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($tituloActor['nombreActor']); ?>" required>
            
            <label for="nacionalidadActor">Nacionalidad:</label>
            <select id="nacionalidadActor" name="nation" required>
                <option value="">Seleccione una nacionalidad</option>
                <?php foreach ($nacionalidades as $nacionalidad) : ?>
                    <option value="<?php echo $nacionalidad['idPais']; ?>"
                        <?php echo ($nacionalidad['idPais'] == $tituloActor['nacionalidadActor']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($nacionalidad['nombrePais']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label for="image">URL imagen:</label>
            <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($tituloActor['imagen']); ?>" required>
            
            <input type="submit" value="Actualizar" name="updateActor">
            <a class="btn" href="actor.php">Volver</a>
        </form>
    </div>

    <?php
    if (isset($_POST['updateActor'])):
        // Obtener los datos del formulario
        $name = $_POST['name'];
        $nation = $_POST['nation'];
        $image = $_POST['image'];
        $id = $_POST['id'];

        // Verificar si los campos no están vacíos
        if (empty($name) || empty($nation) || empty($image)) {
            echo "<script>alert('Todos los campos son obligatorios');</script>";
        } else {
            // Si no están vacíos, actualizar el actor
            $queryUpdate = "UPDATE actor SET nombreActor = '$name', nacionalidadActor = '$nation', imagen = '$image' WHERE idActor = '$id'";

            // Ejecutar la consulta
            $resultUpdate = $pdo->exec($queryUpdate);

            if ($resultUpdate) {
                // Redirigir a la lista de actores si todo va bien
                echo "<script>window.location.href = 'actor.php';</script>";
                exit;
            } else {
                echo "<script>alert('Error al actualizar el actor');</script>";
            }
        }
    endif;
    ?>
</body>
</html>
