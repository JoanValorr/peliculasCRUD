<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Proyecto_Pelis/css/stylesIndex.css">
    <title>Página Principal</title>
</head>
<body>
    <h1>ValorFilms</h1>
    <nav>
        <ul>
            <li><a href="../Proyecto_Pelis/php/actor/actor.php">Ver Actores</a></li>
            <li><a href="../Proyecto_Pelis/php/pais/pais.php">País</a></li>
        </ul>
    </nav>

    <form action="buscar.php" method="GET">
        <label for="search">Buscar actor:</label>
        <input type="text" id="search" name="query" placeholder="busqueda...">
        <button type="submit">Buscar</button>
    </form>
</body>
</html>