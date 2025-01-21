<?php
include_once '../conBBDD.php'; // Se asume que $pdo ya está configurado correctamente

// Consulta SQL con JOIN para obtener el nombre del país
$consulta = 'SELECT actor.imagen, actor.nombreActor, pais.nombrePais, actor.idActor 
             FROM actor 
             INNER JOIN pais ON actor.nacionalidadActor = pais.idPais';

$resultado = $pdo->query($consulta); // Ejecuta la consulta
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Biblioteca</title>
</head>
<body>
    <button class = "action"><a href="../../index.php">Volver a inicio</a></button>
    <button class = "action"><a href="crearActor.php">Crear Actor</a></button>

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
        <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="Imagen de <?php echo htmlspecialchars($row['nombreActor']); ?>" class="img-thumbnail" style="max-width: 100px;"></td>
                <td><?php echo htmlspecialchars($row['nombreActor']); ?></td>
                <td><?php echo htmlspecialchars($row['nombrePais']); ?></td>
                <td>
                    <!-- Formulario para editar actor -->
                    <form action="editarActor.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['idActor']; ?>">
                        <button type="submit" title="Editar">
                        <img src="../../icons/edit-new-icon-22.png" alt="Editar" style="width: 24px; margin-right: 10px;">
                        </button>
                    </form>


                    <!-- Formulario para eliminar actor -->
                    <form action="borrarActor.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['idActor']; ?>">
                        <button type="submit" title="Eliminar">
                            <img src="../../icons/delete-1-icon.png" alt="Eliminar" style="width: 24px;">
                        </button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
