<?php
include_once 'conBBDD.php'; // Se asume que $pdo ya está configurado correctamente

// Consulta SQL con JOIN para obtener el nombre del país
$consulta = 'SELECT actor.imagen, actor.nombreActor, pais.nombrePais 
             FROM actor 
             INNER JOIN pais ON actor.nacionalidadActor = pais.idPais';

$resultado = $pdo->query($consulta); // Ejecuta la consulta
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Biblioteca</title>
</head>
<body>
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
            <form action="../index.php" method="POST">
                <input type="submit" value="Acceder">
            </form>
        </td>
    </tr>
<?php endwhile; ?>
</table>
</body>
</html>
