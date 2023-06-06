-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2023 a las 20:07:54
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
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(255) NOT NULL,
  `pregunta` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`idPregunta`, `pregunta`, `categoria`) VALUES
(1, '¿Cuál es la capital de Francia?', 'Geografia'),
(2, '¿En qué año se fundó Apple Inc.?', 'Historia'),
(3, '¿Cuál es el río más largo del mundo?', 'Geografia'),
(4, '¿Cuál es el símbolo químico del oro?', 'Quimica'),
(5, '¿Cuál es el país más poblado del mundo?', 'Geografia\r\n'),
(6, '¿Cuál es el planeta más grande del sistema solar?', 'Geografia\r\n'),
(7, '¿En qué año se lanzó el primer iPhone?', 'Historia'),
(8, '¿Cuál es el océano más grande del mundo?', 'Geografia'),
(9, '¿Quién pintó La última cena?', 'Arte'),
(10, '¿Cuál es la montaña más alta del mundo?', 'Geografia'),
(11, '¿En qué año se firmó la Declaración de Independencia de Estados Unidos?', 'Historia'),
(12, '¿Cuál es la moneda oficial de Japón?', 'Historia'),
(13, '¿Quién escribió el libro \"1984\"?', 'Arte'),
(14, '¿Cuál es el metal más abundante en la corteza terrestre?', 'Quimica'),
(15, '¿Cuál es el país más grande de América Latina?', 'Geografia'),
(16, '¿Cuál es el animal terrestre más grande del mundo?', 'General'),
(17, '¿Cuál es el instrumento musical de viento más largo?', 'Arte'),
(18, '¿Cuál es el planeta más cercano al Sol?', 'General'),
(19, '¿Cuál es el desierto más grande del mundo?', 'Geografia'),
(20, '¿Cuál es la fórmula química del agua?', 'Quimica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntasrespondidas`
--

CREATE TABLE `preguntasrespondidas` (
  `idPreguntaRespondida` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntasrespondidas`
--

INSERT INTO `preguntasrespondidas` (`idPreguntaRespondida`, `idUsuario`, `idPregunta`) VALUES
(298, 37, 4),
(299, 37, 19),
(300, 37, 11),
(301, 37, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `idRespuesta` int(11) NOT NULL,
  `respuesta` varchar(255) DEFAULT NULL,
  `isCorrecta` tinyint(1) DEFAULT NULL,
  `idPregunta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`idRespuesta`, `respuesta`, `isCorrecta`, `idPregunta`) VALUES
(1, 'Berlín', 0, 1),
(2, 'Roma', 0, 1),
(3, 'Madrid', 0, 1),
(4, 'París', 1, 1),
(5, '1976', 1, 2),
(6, '1984', 0, 2),
(7, '1977', 0, 2),
(8, '1975', 0, 2),
(9, 'Amazonas', 0, 3),
(10, 'Nilo', 1, 3),
(11, 'Yangtsé', 0, 3),
(12, 'Misisipi', 0, 3),
(13, 'Co', 0, 4),
(14, 'Ag', 0, 4),
(15, 'Cu', 0, 4),
(16, 'Au', 1, 4),
(17, 'China', 1, 5),
(18, 'India', 0, 5),
(19, 'Estados Unidos', 0, 5),
(20, 'Indonesia', 0, 5),
(21, 'Júpiter', 1, 6),
(22, 'Marte', 0, 6),
(23, 'Tierra', 0, 6),
(24, 'Saturno', 0, 6),
(25, '2005', 0, 7),
(26, '2006', 0, 7),
(27, '2007', 1, 7),
(28, '2008', 0, 7),
(29, 'Océano Atlántico', 0, 8),
(30, 'Océano Índico', 0, 8),
(31, 'Océano Pacífico', 1, 8),
(32, 'Océano Ártico', 0, 8),
(33, 'Miguel Angel', 0, 9),
(34, 'Pablo Picasso', 0, 9),
(35, 'Vincent van Gogh', 0, 9),
(36, 'Leonardo da Vinci', 1, 9),
(37, 'Monte Kilimanjaro', 0, 10),
(38, 'Monte Everest', 1, 10),
(39, 'Monte Aconcagua', 0, 10),
(40, 'Monte Fuji', 0, 10),
(41, '1776', 1, 11),
(42, '1789', 0, 11),
(43, '1812', 0, 11),
(44, '1865', 0, 11),
(45, 'Yen', 1, 12),
(46, 'Dólar', 0, 12),
(47, 'Euro', 0, 12),
(48, 'Libra esterlina', 0, 12),
(49, 'George Orwell', 1, 13),
(50, 'Aldous Huxley', 0, 13),
(51, 'Ray Bradbury', 0, 13),
(52, 'Ernest Hemingway', 0, 13),
(53, 'Aluminio', 1, 14),
(54, 'Hierro', 0, 14),
(55, 'Cobre', 0, 14),
(56, 'Plomo', 0, 14),
(57, 'Chile', 0, 15),
(58, 'México', 0, 15),
(59, 'Argentina', 0, 15),
(60, 'Brasil', 1, 15),
(61, 'Elefante africano', 1, 16),
(62, 'Jirafa', 0, 16),
(63, 'Rinoceronte', 0, 16),
(64, 'Hipopótamo', 0, 16),
(65, 'Saxofón', 0, 17),
(66, 'Trompeta', 0, 17),
(67, 'Trombón', 1, 17),
(68, 'Flauta', 0, 17),
(69, 'Mercurio', 1, 18),
(70, 'Venus', 0, 18),
(71, 'Marte', 0, 18),
(72, 'Tierra', 0, 18),
(73, 'Sahara', 1, 19),
(74, 'Gobi', 0, 19),
(75, 'Atacama', 0, 19),
(76, 'Kalimantan', 0, 19),
(77, 'H2O', 1, 20),
(78, 'CO2', 0, 20),
(79, 'NaCl', 0, 20),
(80, 'CH4', 0, 20);

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
  `esta_verificado` varchar(255) NOT NULL DEFAULT 'false',
  `puntaje` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `username`, `nombreCompleto`, `fechaDeNacimiento`, `sexo`, `password`, `ubicacion`, `mail`, `fotoDePerfil`, `rol`, `verify_token`, `esta_verificado`, `puntaje`) VALUES
(33, 'jaz', 'jaz', '2023-05-11', 'femenino', '81dc9bdb52d04dc20036dbd8313ed055', 'bsas', 'jazminisabeldestefano@gmail.com', 'jaz', 'jugador', '72165f9ac7677ec2b858422c5546dc66', 'true', 0),
(34, 'gabyGil', 'gaby', '2023-05-16', 'masculino', '81dc9bdb52d04dc20036dbd8313ed055', 'nashe', 'gabyGil@xd.com', 'nashe', 'jugador', '19c83133d7ddaf0c7c03d701a0d60ff1', 'false', 0),
(37, 'marcos', 'marcos', '1999-06-12', 'masculino', '81dc9bdb52d04dc20036dbd8313ed055', 'Buenos Aires', 'marcos.011@live.com', 'nashe', 'jugador', '4d9ac1b683d1459d63cc115cd102b3b8', 'true', 80);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPregunta`);

--
-- Indices de la tabla `preguntasrespondidas`
--
ALTER TABLE `preguntasrespondidas`
  ADD PRIMARY KEY (`idPreguntaRespondida`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`idRespuesta`),
  ADD KEY `idPregunta` (`idPregunta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `preguntasrespondidas`
--
ALTER TABLE `preguntasrespondidas`
  MODIFY `idPreguntaRespondida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `preguntas` (`idPregunta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
