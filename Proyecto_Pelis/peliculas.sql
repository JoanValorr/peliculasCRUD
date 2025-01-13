-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-01-2025 a las 14:17:40
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `peliculas`
--
CREATE DATABASE IF NOT EXISTS `peliculas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `peliculas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actor`
--

CREATE TABLE `actor` (
  `idActor` int(11) NOT NULL,
  `nombreActor` varchar(30) NOT NULL,
  `nacionalidadActor` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `actor`
--

INSERT INTO `actor` (`idActor`, `nombreActor`, `nacionalidadActor`, `imagen`) VALUES
(1, 'Mark Hamill', 1, 'https://pics.filmaffinity.com/mark_hamill-257961294011764-nm_200.jpg'),
(2, 'Harrison Ford', 1, 'https://pics.filmaffinity.com/harrison_ford-021148117303532-nm_200.jpg'),
(3, 'Carrie Fisher', 1, 'https://pics.filmaffinity.com/carrie_fisher-039711170747070-nm_200.jpg'),
(4, 'Peter Cushing', 2, 'https://pics.filmaffinity.com/peter_cushing-204891147560934-nm_200.jpg'),
(5, 'Alec Guiness', 2, 'https://pics.filmaffinity.com/alec_guinness-094895075881094-nm_200.jpg'),
(6, 'Anthony Daniels', 2, 'https://pics.filmaffinity.com/anthony_daniels-108595224087471-nm_200.jpg'),
(7, 'Kenny Baker', 2, 'https://pics.filmaffinity.com/kenny_baker-229525724195046-nm_200.jpg'),
(8, 'Peter Mayhew', 2, 'https://pics.filmaffinity.com/peter_mayhew-207344901918965-nm_200.jpg'),
(10, 'David Prowse', 2, 'https://pics.filmaffinity.com/david_prowse-007139037689867-nm_200.jpg'),
(11, 'Frank Oz', 2, 'https://pics.filmaffinity.com/frank_oz-112953794040406-nm_200.jpg'),
(12, 'Billy Dee Williams', 1, 'https://pics.filmaffinity.com/billy_dee_williams-276290267497642-nm_200.jpg'),
(13, 'Sebastian Shaw', 2, 'https://pics.filmaffinity.com/sebastian_shaw-126641391428715-nm_200.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director`
--

CREATE TABLE `director` (
  `idDirector` int(11) NOT NULL,
  `nombreDirector` varchar(30) NOT NULL,
  `nacionalidadDirector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `director`
--

INSERT INTO `director` (`idDirector`, `nombreDirector`, `nacionalidadDirector`) VALUES
(1, 'George Lucas', 1),
(2, 'Irving Kershner', 1),
(3, 'Richard Marquand', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `idGenero` int(11) NOT NULL,
  `nombreGenero` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`idGenero`, `nombreGenero`) VALUES
(1, 'Ciencia Ficción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `idPais` int(11) NOT NULL,
  `nombrePais` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idPais`, `nombrePais`) VALUES
(1, 'Estados Unidos'),
(2, 'Inglaterra'),
(3, 'Gales'),
(4, 'Escocia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `idPelicula` int(11) NOT NULL,
  `tituloPelicula` varchar(50) NOT NULL,
  `directorPelicula` int(11) NOT NULL,
  `generoPelicula` int(11) NOT NULL,
  `anyoPelicula` int(11) NOT NULL,
  `duracionPelicula` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`idPelicula`, `tituloPelicula`, `directorPelicula`, `generoPelicula`, `anyoPelicula`, `duracionPelicula`, `imagen`) VALUES
(2, 'Star Wars: Episodio IV - Una nueva esperanza', 1, 1, 1977, 121, 'https://pics.filmaffinity.com/star_wars-166209019-mmed.jpg'),
(3, 'Star Wars: Episodio V - El Imperio contraataca', 2, 1, 1980, 124, 'https://pics.filmaffinity.com/star_wars_episode_v_the_empire_strikes_back-701818523-mmed.jpg'),
(4, 'Star Wars: Episodio VI - El retorno del Jedi', 3, 1, 1983, 131, 'https://pics.filmaffinity.com/star_wars_episode_vi_return_of_the_jedi-643019465-mmed.jpg'),
(5, 'Star Wars: Episodio I - La amenaza fantasma', 1, 1, 1999, 136, 'https://pics.filmaffinity.com/star_wars_episode_i_the_phantom_menace-434398792-mmed.jpg'),
(6, 'Star Wars: Episodio II - El ataque de los clones', 1, 1, 2002, 142, 'https://pics.filmaffinity.com/star_wars_episode_ii_attack_of_the_clones-495166632-mmed.jpg'),
(7, 'Star Wars: Episodio III - La venganza de los Sith', 1, 1, 2005, 139, 'https://pics.filmaffinity.com/star_wars_episode_iii_revenge_of_the_sith-699349136-mmed.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `pass` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `pass`) VALUES
(5, 'fidel', '$2y$10$WW2gKhMFm0YrRHTn0LWeS.5kkqJsTe1CJ8ykOarMSNDTUvBVUjYUi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`idActor`),
  ADD KEY `nacionalidadActor` (`nacionalidadActor`);

--
-- Indices de la tabla `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`idDirector`),
  ADD KEY `nacionalidadDirector` (`nacionalidadDirector`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`idGenero`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`idPais`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`idPelicula`),
  ADD KEY `directorPelicula` (`directorPelicula`),
  ADD KEY `generoPelicula` (`generoPelicula`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actor`
--
ALTER TABLE `actor`
  MODIFY `idActor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `director`
--
ALTER TABLE `director`
  MODIFY `idDirector` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `idPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `idPelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actor`
--
ALTER TABLE `actor`
  ADD CONSTRAINT `actor_ibfk_1` FOREIGN KEY (`nacionalidadActor`) REFERENCES `pais` (`idPais`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `director`
--
ALTER TABLE `director`
  ADD CONSTRAINT `director_ibfk_1` FOREIGN KEY (`nacionalidadDirector`) REFERENCES `pais` (`idPais`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `pelicula_ibfk_1` FOREIGN KEY (`directorPelicula`) REFERENCES `director` (`idDirector`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pelicula_ibfk_2` FOREIGN KEY (`generoPelicula`) REFERENCES `genero` (`idGenero`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
