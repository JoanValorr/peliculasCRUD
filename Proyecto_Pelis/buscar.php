<?php
include_once '../Proyecto_Pelis/php/conBBDD.php'; // Incluye la conexión a la base de datos

// Verificar si se recibió el término de búsqueda
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (empty($query)) {
    echo '<p>Por favor ingresa un término de búsqueda.</p>';
    echo '<a class="btn" href="index.php">Volver</a>';
    exit;
}

// Preparar la búsqueda
$query = '%' . $query . '%';

// SQL para buscar actores por nombre o país
$sql = "
    SELECT 
        actor.imagen, 
        actor.nombreActor, 
        pais.nombrePais, 
        actor.idActor
    FROM actor 
    JOIN pais ON actor.nacionalidadActor = pais.idPais
    WHERE actor.nombreActor LIKE ? OR pais.nombrePais LIKE ?";

// Preparar y ejecutar la consulta
$stmt = $pdo->prepare($sql);
$stmt->execute([$query, $query]);

// Obtener resultados
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Proyecto_Pelis/css/styles.css"> <!-- Tu CSS para estilizar la tabla -->
    <title>Resultados de Búsqueda</title>
</head>
<body>
    <button class="action"><a href="../Proyecto_Pelis/index.php">Volver a inicio</a></button>

    <?php if (count($result) > 0) : ?>
        <h2>Resultados de búsqueda:</h2>
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Nacionalidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <td>
                        <img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="Imagen de <?php echo htmlspecialchars($row['nombreActor']); ?>" class="img-thumbnail" style="max-width: 100px;">
                    </td>
                    <td><?php echo htmlspecialchars($row['nombreActor']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombrePais']); ?></td>
                    <td>
                        <!-- Formulario para editar actor -->
                        <form action="../Proyecto_Pelis/php/actor/editarActor.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['idActor']; ?>">
                            <button type="submit" title="Editar">
                                <img src="../Proyecto_Pelis/icons/edit-new-icon-22.png" alt="Editar" style="width: 24px; margin-right: 10px;">
                            </button>
                        </form>

                        <!-- Formulario para eliminar actor -->
                        <form action="../Proyecto_Pelis/php/actor/borrarActor.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['idActor']; ?>">
                            <button type="submit" title="Eliminar">
                                <img src="../Proyecto_Pelis/icons/delete-1-icon.png" alt="Eliminar" style="width: 24px;">
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="no-results">No se encontraron resultados para '<?php echo htmlspecialchars($_GET['query']); ?>'.</p>
        <a class="btn" href="../Proyecto_Pelis/index.php">Volver</a>
    <?php endif; ?>
</body>
</html>
