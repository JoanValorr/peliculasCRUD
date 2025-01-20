<?php
include_once '../conBBDD.php'; // Se asume que $pdo ya está configurado correctamente

// Consulta SQL con JOIN para obtener el nombre del país
$consulta = 'SELECT actor.imagen, actor.nombreActor, pais.nombrePais, actor.idActor 
             FROM actor 
             INNER JOIN pais ON actor.nacionalidadActor = pais.idPais';

$resultado = $pdo->query($consulta); // Ejecuta la consulta
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Biblioteca</title>
</head>
<body>
    <button ><a href="../../index.php">Volver a inicio</a></button>
    <button><a href="crearActor.php">Crear Actor</a></button>

<table>
    <th>Imagen</th> 
    <th>Nombre</th>
    <th>Nacionalidad</th>
    <th>Acciones</th>

<?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) : ?>
    <tr>
        <td><img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="Imagen de <?php echo htmlspecialchars($row['nombreActor']); ?>" class="img-thumbnail" style="max-width: 100px;"></td>
        <td><?php echo htmlspecialchars($row['nombreActor']); ?></td>
        <td><?php echo htmlspecialchars($row['nombrePais']); ?></td>
        <td>
        
            <a href="editarActor.php?id=<?php echo $row['idActor']; ?>" title="Editar">
                <img src="../../icons/edit-new-icon-22.png" alt="Editar" style="width: 24px; margin-right: 10px;">
            </a>

            <a href="borrarActor.php?id=<?php echo $row['idActor']; ?>" title="Eliminar" ">
                <img src="../../icons/delete-1-icon.png" alt="Eliminar" style="width: 24px;">
            </a>
        </td>
    </tr>
<?php endwhile; ?>
</table>
</body>
</html>
