-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2023 a las 19:18:43
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `labanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones`
--

CREATE TABLE `canciones` (
  `idCancion` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `canciones`
--

INSERT INTO `canciones` (`idCancion`, `nombre`, `duracion`) VALUES
(1, 'cancion1', 10),
(2, 'cancion2', 12),
(3, 'cancion3', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentaciones`
--

CREATE TABLE `presentaciones` (
  `idPresentacion` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `precio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `presentaciones`
--

INSERT INTO `presentaciones` (`idPresentacion`, `nombre`, `fecha`, `precio`) VALUES
(1, 'Presentacion 1', '2020-06-02 22:02:14', 10),
(2, 'Presentacion 2', '2020-06-02 22:02:19', 10),
(3, 'Presentacion 3', '2020-06-02 22:02:21', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nombreCompleto` varchar(255) NOT NULL,
  `fechaDeNacimiento` date NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `fotoDePerfil` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL,
  `verify_token` varchar(255) DEFAULT NULL,
  `esta_verificado` varchar(255) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `username`, `nombreCompleto`, `fechaDeNacimiento`, `sexo`, `password`, `ubicacion`, `mail`, `fotoDePerfil`, `rol`, `verify_token`, `esta_verificado`) VALUES
(33, 'jaz', 'jaz', '2023-05-11', 'femenino', '81dc9bdb52d04dc20036dbd8313ed055', 'bsas', 'jazminisabeldestefano@gmail.com', 'jaz', 'jugador', '72165f9ac7677ec2b858422c5546dc66', 'true');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD PRIMARY KEY (`idCancion`);

--
-- Indices de la tabla `presentaciones`
--
ALTER TABLE `presentaciones`
  ADD PRIMARY KEY (`idPresentacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canciones`
--
ALTER TABLE `canciones`
  MODIFY `idCancion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `presentaciones`
--
ALTER TABLE `presentaciones`
  MODIFY `idPresentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
