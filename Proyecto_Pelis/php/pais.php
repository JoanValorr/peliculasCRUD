<?php
include_once 'conBBDD.php'; // Se asume que $pdo ya está configurado correctamente

$consulta = 'SELECT * FROM pais';
$resultado = $pdo->query($consulta); // Ejecuta la consulta directamente
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
    <th>Pais</th>
    <th>Acciones</th>
<?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) : ?>
    <tr>
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
