-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-06-2023 a las 20:28:19
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
  `categoria` varchar(255) NOT NULL,
  `dificultad` varchar(255) NOT NULL DEFAULT 'facil',
  `estado` varchar(255) NOT NULL DEFAULT 'desaprobada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`idPregunta`, `pregunta`, `categoria`, `dificultad`, `estado`) VALUES
(75, '¿En qué año se fundó Apple Inc.?', 'General', 'facil', 'aprobado'),
(76, '¿Cuál es el río más largo del mundo?', 'Geografia', 'dificil', 'desaprobada'),
(77, '¿Cuál es el símbolo químico del oro?', 'Quimica', 'dificil', 'reportada'),
(78, '¿Cuál es el país más poblado del mundo?', 'Geografia\r\n', 'dificil', 'reportada'),
(79, '¿Cuál es el planeta más grande del sistema solar?', 'Geografia\r\n', 'dificil', 'reportada'),
(80, '¿En qué año se lanzó el primer iPhone?', 'Historia', 'dificil', 'aprobada'),
(81, '¿Cuál es el océano más grande del mundo?', 'Geografia', 'dificil', 'aprobada'),
(82, '¿Quién pintó La última cena?', 'Arte', 'dificil', 'desaprobada'),
(83, '¿Cuál es la montaña más alta del mundo?', 'Geografia', 'dificil', 'aprobada'),
(84, '¿En qué año se firmó la Declaración de Independencia de Estados Unidos?', 'Historia', 'dificil', 'aprobada'),
(85, '¿Cuál es la moneda oficial de Japón?', 'Historia', 'dificil', 'aprobada'),
(86, '¿Quién escribió el libro \"1984\"?', 'Arte', 'dificil', 'aprobada'),
(87, '¿Cuál es el metal más abundante en la corteza terrestre?', 'Quimica', 'dificil', 'aprobada'),
(88, '¿Cuál es el país más grande de América Latina?', 'Geografia', 'dificil', 'aprobada'),
(89, '¿Cuál es el animal terrestre más grande del mundo?', 'General', 'dificil', 'aprobada'),
(90, '¿Cuál es el instrumento musical de viento más largo?', 'Arte', 'dificil', 'aprobada'),
(91, '¿Cuál es el planeta más cercano al Sol?', 'General', 'facil', 'aprobada'),
(92, '¿Cuál es el desierto más grande del mundo?', 'Geografia', 'facil', 'desaprobado'),
(93, '¿Cuál es la fórmula química del agua?', 'Quimica', 'dificil', 'aprobada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntasrespondidas`
--

CREATE TABLE `preguntasrespondidas` (
  `idPreguntaRespondida` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `acertada` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntasrespondidas`
--

INSERT INTO `preguntasrespondidas` (`idPreguntaRespondida`, `idUsuario`, `idPregunta`, `acertada`) VALUES
(309, 33, 84, 1),
(310, 33, 88, 0),
(311, 33, 75, 1),
(312, 33, 75, 1),
(313, 33, 75, 1),
(314, 33, 75, 1),
(315, 33, 75, 1),
(316, 33, 75, 1),
(317, 33, 75, 1),
(318, 33, 75, 1),
(319, 33, 75, 1),
(320, 33, 75, 1),
(321, 33, 75, 1),
(322, 33, 75, 1),
(323, 33, 75, 1),
(324, 33, 75, 1),
(325, 33, 75, 1),
(326, 33, 90, 0),
(327, 33, 90, 0);

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
(186, '1976', 1, 75),
(187, '1984', 0, 75),
(188, '1977', 0, 75),
(189, '1975', 0, 75),
(190, 'Amazonas', 0, 76),
(191, 'Nilo', 1, 76),
(192, 'Yangtsé', 0, 76),
(193, 'Misisipi', 0, 76),
(194, 'Co', 0, 77),
(195, 'Ag', 0, 77),
(196, 'Cu', 0, 77),
(197, 'Au', 1, 77),
(198, 'China', 1, 78),
(199, 'India', 0, 78),
(200, 'Estados Unidos', 0, 78),
(201, 'Indonesia', 0, 78),
(202, 'Júpiter', 1, 79),
(203, 'Marte', 0, 79),
(204, 'Tierra', 0, 79),
(205, 'Saturno', 0, 79),
(206, '2005', 0, 80),
(207, '2006', 0, 80),
(208, '2007', 1, 80),
(209, '2008', 0, 80),
(210, 'Océano Atlántico', 0, 81),
(211, 'Océano Índico', 0, 81),
(212, 'Océano Pacífico', 1, 81),
(213, 'Océano Ártico', 0, 81),
(214, 'Miguel Angel', 0, 82),
(215, 'Pablo Picasso', 0, 82),
(216, 'Vincent van Gogh', 0, 82),
(217, 'Leonardo da Vinci', 1, 82),
(218, 'Monte Kilimanjaro', 0, 83),
(219, 'Monte Everest', 1, 83),
(220, 'Monte Aconcagua', 0, 83),
(221, 'Monte Fuji', 0, 83),
(222, '1776', 1, 84),
(223, '1789', 0, 84),
(224, '1812', 0, 84),
(225, '1865', 0, 84),
(226, 'Yen', 1, 85),
(227, 'Dólar', 0, 85),
(228, 'Euro', 0, 85),
(229, 'Libra esterlina', 0, 85),
(230, 'George Orwell', 1, 86),
(231, 'Aldous Huxley', 0, 86),
(232, 'Ray Bradbury', 0, 86),
(233, 'Ernest Hemingway', 0, 86),
(234, 'Aluminio', 1, 87),
(235, 'Hierro', 0, 87),
(236, 'Cobre', 0, 87),
(237, 'Plomo', 0, 87),
(238, 'Chile', 0, 88),
(239, 'México', 0, 88),
(240, 'Argentina', 0, 88),
(241, 'Brasil', 1, 88),
(242, 'Elefante africano', 1, 89),
(243, 'Jirafa', 0, 89),
(244, 'Rinoceronte', 0, 89),
(245, 'Hipopótamo', 0, 89),
(246, 'Saxofón', 0, 90),
(247, 'Trompeta', 0, 90),
(248, 'Trombón', 1, 90),
(249, 'Flauta', 0, 90),
(250, 'Mercurio', 1, 91),
(251, 'Venus', 0, 91),
(252, 'Marte', 0, 91),
(253, 'Tierra', 0, 91),
(254, 'Sahara', 1, 92),
(255, 'Gobi', 0, 92),
(256, 'Atacama', 0, 92),
(257, 'Kalimantan', 0, 92),
(258, 'H2O', 1, 93),
(259, 'CO2', 0, 93),
(260, 'NaCl', 0, 93),
(261, 'CH4', 0, 93);

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
  `puntaje` int(11) NOT NULL DEFAULT 0,
  `partidasJugadas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `username`, `nombreCompleto`, `fechaDeNacimiento`, `sexo`, `password`, `ubicacion`, `mail`, `fotoDePerfil`, `rol`, `verify_token`, `esta_verificado`, `puntaje`, `partidasJugadas`) VALUES
(33, 'jaz', 'jaz', '2023-05-11', 'femenino', '81dc9bdb52d04dc20036dbd8313ed055', 'bsas', 'jazminisabeldestefano@gmail.com', 'jaz', 'editor', '72165f9ac7677ec2b858422c5546dc66', 'true', 16, 3),
(34, 'gaby', 'gaby', '2023-05-16', 'masculino', '81dc9bdb52d04dc20036dbd8313ed055', 'nashe', 'gabyGil@xd.com', 'nashe', 'jugador', '19c83133d7ddaf0c7c03d701a0d60ff1', 'true', 0, 0),
(37, 'marcos', 'marcos', '1999-06-12', 'masculino', '81dc9bdb52d04dc20036dbd8313ed055', 'Buenos Aires', 'marcos.011@live.com', 'nashe', 'editor', '4d9ac1b683d1459d63cc115cd102b3b8', 'true', 85, 0);

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
  MODIFY `idPregunta` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `preguntasrespondidas`
--
ALTER TABLE `preguntasrespondidas`
  MODIFY `idPreguntaRespondida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

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
