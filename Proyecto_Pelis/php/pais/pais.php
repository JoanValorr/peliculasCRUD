<?php
include_once '../conBBDD.php'; // Se asume que $pdo ya está configurado correctamente

// Consulta para obtener todos los países
$consulta = 'SELECT * FROM pais';
$resultado = $pdo->query($consulta); // Ejecuta la consulta directamente
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Países</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <button><a href="../../index.php">Volver a inicio</a></button>
    <button><a href="crearPais.php">Crear País</a></button>

    <table>
        <th>Pais</th>
        <th>Acciones</th>
        <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nombrePais']); ?></td>
                <td>
                    <a href="editarPais.php?id=<?php echo $row['idPais']; ?>" title="Editar">
                        <img src="../../icons/edit-new-icon-22.png" alt="Editar" style="width: 24px; margin-right: 10px;">
                    </a>
                    <!-- Enlace para eliminar país, pasando el id al archivo borrarPais.php -->
                    <a href="borrarPais.php?id=<?php echo $row['idPais']; ?>" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este país?');">
                        <img src="../../icons/delete-1-icon.png" alt="Eliminar" style="width: 24px;">
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
