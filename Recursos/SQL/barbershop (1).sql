-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2024 a las 12:36:23
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
-- Base de datos: `barbershop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idCita` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `hora` time NOT NULL,
  `idProfesional` int(11) DEFAULT NULL,
  `mes` varchar(255) NOT NULL,
  `año` int(11) DEFAULT NULL,
  `idServicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCita`, `idUsuario`, `fecha`, `hora`, `idProfesional`, `mes`, `año`, `idServicio`) VALUES
(125, 2, '31', '21:30:00', 1, 'Julio', 2024, NULL),
(126, 2, '31', '15:00:00', 2, 'Julio', 2024, NULL),
(127, 2, '31', '19:00:00', 2, 'Julio', 2024, NULL),
(128, 2, '29', '21:30:00', 1, 'Agosto', 2024, NULL),
(129, 2, '29', '18:30:00', 2, 'Agosto', 2024, NULL),
(130, 2, '7', '18:30:00', 1, 'Agosto', 2024, NULL),
(133, 2, '19', '15:30:00', 1, 'Septiembre', 2024, NULL),
(134, 2, '22', '16:00:00', 1, 'Agosto', 2024, NULL),
(135, 2, '29', '16:00:00', 1, 'Agosto', 2024, NULL),
(136, 2, '28', '16:00:00', 1, 'Agosto', 2024, NULL),
(137, 2, '21', '18:30:00', 1, 'Agosto', 2024, NULL),
(138, 2, '27', '16:00:00', 1, 'Agosto', 2024, NULL),
(139, 2, '13', '16:00:00', 1, 'Agosto', 2024, NULL),
(140, 2, '13', '21:30:00', 1, 'Agosto', 2024, NULL),
(141, 2, '14', '16:00:00', 1, 'Agosto', 2024, NULL),
(142, 2, '14', '22:00:00', 1, 'Agosto', 2024, NULL),
(143, 2, '10', '16:00:00', 1, 'Agosto', 2024, NULL),
(144, 2, '10', '16:00:00', 1, 'Agosto', 2024, NULL),
(145, 2, '14', '16:30:00', 1, 'Agosto', 2024, NULL),
(146, 2, '14', '21:00:00', 1, 'Agosto', 2024, NULL),
(147, 2, '14', '17:00:00', 1, 'Agosto', 2024, NULL),
(148, 2, '15', '18:00:00', 1, 'Agosto', 2024, NULL),
(149, 2, '10', '16:30:00', 1, 'Agosto', 2024, NULL),
(150, 2, '20', '16:00:00', 1, 'Agosto', 2024, NULL),
(151, 2, '14', '17:30:00', 1, 'Agosto', 2024, NULL),
(152, 2, '23', '21:30:00', 1, 'Agosto', 2024, NULL),
(153, 2, '15', '21:00:00', 2, 'Agosto', 2024, NULL),
(154, 2, '29', '16:00:00', 2, 'Agosto', 2024, NULL),
(155, 2, '30', '21:00:00', 2, 'Agosto', 2024, NULL),
(156, 2, '28', '21:30:00', 1, 'Agosto', 2024, NULL),
(157, 2, '27', '21:30:00', 1, 'Agosto', 2024, NULL),
(158, 2, '28', '21:00:00', 1, 'Agosto', 2024, NULL),
(159, 2, '27', '21:00:00', 1, 'Agosto', 2024, 1),
(160, 2, '28', '16:00:00', 2, 'Agosto', 2024, 1),
(161, 2, '28', '20:30:00', 1, 'Agosto', 2024, 1),
(162, 2, '28', '22:00:00', 1, 'Agosto', 2024, 1),
(163, 2, '28', '21:30:00', 2, 'Agosto', 2024, 1),
(164, 2, '29', '21:30:00', 2, 'Agosto', 2024, 1),
(165, 2, '31', '16:00:00', 1, 'Agosto', 2024, 1),
(166, 2, '29', '22:00:00', 2, 'Agosto', 2024, 1),
(167, 2, '29', '21:00:00', 1, 'Agosto', 2024, 1),
(168, 2, '22', '21:00:00', 2, 'Agosto', 2024, 1),
(169, 2, '28', '16:30:00', 1, 'Agosto', 2024, 1),
(170, 2, '29', '19:30:00', 2, 'Agosto', 2024, 1),
(171, 2, '27', '16:30:00', 1, 'Agosto', 2024, 1),
(172, 2, '29', '16:30:00', 2, 'Agosto', 2024, 1),
(173, 2, '20', '19:00:00', 1, 'Agosto', 2024, 1),
(174, 2, '21', '16:00:00', 1, 'Agosto', 2024, 1),
(180, 2, '28', '17:00:00', 1, 'Agosto', 2024, 1),
(181, 2, '27', '22:00:00', 1, 'Agosto', 2024, 1),
(182, 2, '21', '18:30:00', 2, 'Agosto', 2024, 1),
(183, 2, '28', '19:00:00', 1, 'Agosto', 2024, 1),
(184, 2, '28', '19:00:00', 1, 'Agosto', 2024, 1),
(185, 2, '21', '16:30:00', 1, 'Agosto', 2024, 1),
(186, 2, '28', '18:30:00', 1, 'Agosto', 2024, 1),
(187, 2, '29', '20:30:00', 1, 'Agosto', 2024, 1),
(188, 2, '30', '19:00:00', 2, 'Agosto', 2024, 1),
(189, 2, '28', '17:30:00', 1, 'Agosto', 2024, 1),
(190, 2, '30', '21:00:00', 3, 'Agosto', 2024, 2),
(191, 2, '12', '18:30:00', 2, 'Septiembre', 2024, 1),
(193, 2, '8', '16:00:00', 1, 'Septiembre', 2024, 1),
(194, 2, '25', '21:30:00', 1, 'Septiembre', 2024, 1),
(195, 2, '24', '16:00:00', 1, 'Septiembre', 2024, 1),
(196, 2, '28', '16:00:00', 1, 'Septiembre', 2024, 1),
(197, 2, '25', '20:30:00', 1, 'Septiembre', 2024, 1),
(198, 2, '24', '16:30:00', 1, 'Septiembre', 2024, 1),
(199, 2, '15', '21:00:00', 1, 'Octubre', 2024, 1),
(202, 22, '15', '20:30:00', 1, 'Octubre', 2024, 1),
(203, 22, '20', '16:00:00', 2, 'Octubre', 2024, 1),
(204, 22, '20', '16:00:00', 2, 'Octubre', 2024, 1),
(205, 22, '22', '19:00:00', 1, 'Octubre', 2024, 1),
(207, 2, '29', '15:30:00', 2, 'Octubre', 2024, 1),
(208, 2, '27', '22:00:00', 2, 'Octubre', 2024, 1),
(218, 2, '23', '21:00:00', 1, 'Octubre', 2024, 1),
(219, 2, '29', '21:00:00', 3, 'Octubre', 2024, 2),
(220, 2, '31', '21:00:00', 1, 'Octubre', 2024, 1),
(230, 2, '5', '16:00:00', 1, 'Noviembre', 2024, 1),
(239, 2, '25', '16:00:00', 1, 'Noviembre', 2024, 1),
(240, 2, '12', '18:30:00', 1, 'Noviembre', 2024, 1),
(243, 2, '13', '21:00:00', 1, 'Noviembre', 2024, 1),
(248, 2, '12', '21:00:00', 1, 'Noviembre', 2024, 1),
(250, 2, '13', '16:00:00', 3, 'Noviembre', 2024, 2),
(251, 2, '30', '22:00:00', 2, 'Noviembre', 2024, 1),
(252, 2, '26', '21:00:00', 1, 'Noviembre', 2024, 1),
(253, 2, '19', '16:00:00', 1, 'Noviembre', 2024, 1),
(254, 2, '20', '16:00:00', 1, 'Noviembre', 2024, 1),
(255, 2, '19', '21:00:00', 1, 'Noviembre', 2024, 1),
(256, 2, '13', '18:30:00', 1, 'Noviembre', 2024, 1),
(257, 2, '20', '16:00:00', 2, 'Noviembre', 2024, 2),
(258, 2, '19', '19:00:00', 1, 'Noviembre', 2024, 1),
(259, 2, '13', '18:30:00', 2, 'Noviembre', 2024, 1),
(260, 2, '31', '22:00:00', 1, 'Diciembre', 2024, 1),
(264, 27, '20', '21:00:00', 3, 'Noviembre', 2024, 2),
(266, 23, '26', '21:30:00', 1, 'Noviembre', 2024, 1),
(267, 3, '3', '15:00:00', 1, 'Diciembre', 2024, 1),
(278, 29, '19', '16:30:00', 1, 'Noviembre', 2024, 1),
(279, 2, '21', '21:00:00', 2, 'Noviembre', 2024, 1),
(280, 2, '20', '16:00:00', 3, 'Noviembre', 2024, 2),
(281, 2, '27', '16:00:00', 1, 'Noviembre', 2024, 1),
(282, 2, '27', '16:00:00', 1, 'Noviembre', 2024, 1),
(283, 30, '21', '16:00:00', 1, 'Noviembre', 2024, 1),
(284, 30, '21', '16:00:00', 3, 'Noviembre', 2024, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idHorario` int(11) NOT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idHorario`, `hora`) VALUES
(1, '15:00:00'),
(15, '15:30:00'),
(16, '16:00:00'),
(17, '16:30:00'),
(18, '17:00:00'),
(19, '17:30:00'),
(20, '18:00:00'),
(22, '18:30:00'),
(23, '19:00:00'),
(24, '19:30:00'),
(25, '20:00:00'),
(26, '20:30:00'),
(27, '21:00:00'),
(28, '21:30:00'),
(29, '22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales`
--

CREATE TABLE `profesionales` (
  `idProfesional` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesionales`
--

INSERT INTO `profesionales` (`idProfesional`, `idUsuario`) VALUES
(1, 24),
(2, 25),
(3, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional_servicio`
--

CREATE TABLE `profesional_servicio` (
  `idProfesional` int(11) NOT NULL,
  `idServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesional_servicio`
--

INSERT INTO `profesional_servicio` (`idProfesional`, `idServicio`) VALUES
(1, 1),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idServicio` int(11) NOT NULL,
  `nombreServicio` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`idServicio`, `nombreServicio`, `precio`, `duracion`, `imagen`) VALUES
(1, 'Corte de pelo', 10.00, 30, 'https://www.24horas.cl/24horas/site/artic/20231002/imag/foto_0000003020231002221814/corte-pelo-taper-fade.jpg'),
(2, 'Manicura', 13.00, 30, 'https://escuelaversailles.com/wp-content/uploads/Tipos-y-tecnicas-de-manicura.jpg'),
(3, 'Corte de Barba', 5.00, 15, 'https://img.freepik.com/foto-gratis/hombre-corta-barba-barberia_1157-16066.jpg?size=626&ext=jpg&ga=GA1.1.2008272138.1723593600&semt=ais_hybrid'),
(5, 'Maquillaje profesional', 20.00, 40, 'https://okdiario.com/img/2021/11/18/los-trucos-que-usan-los-maquilladores-profesionales-para-un-maquillaje-perfecto.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `permisos` tinyint(1) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `permisos`, `telefono`, `contrasena`, `foto`) VALUES
(2, 'Samuel', 0, '645342132', '12345678', './img/fotoCara.jpg'),
(3, 'Anouar', 0, '645265132', '12345678', 'https://i.pinimg.com/236x/2f/97/f0/2f97f05b32547f54ef1bdf99cd207c90.jpg'),
(16, 'usuario2', 0, '641347319', '12345678', NULL),
(17, 'Rodrigo', 0, '13452678', '12345678', NULL),
(18, 'prueba', 0, '46612446', '12345678', NULL),
(19, 'suren', 0, '641323427', 'samsur1234', NULL),
(20, 'rodrigo11', 0, '134526799', '12345678', NULL),
(21, 'nosoy11', 0, '454243333', '12345678', NULL),
(22, 'Josef', 0, '243234212', '12345678', NULL),
(23, 'usuario3', 0, '64235321', '12345678', NULL),
(24, 'Peluquero1', 1, '645252662', '12345678', 'https://cdn.iconscout.com/icon/free/png-256/free-barbero-3972159-3287197.png?f=webp'),
(25, 'Peluquero2', 1, '654321213', '12345678', NULL),
(26, 'Manicurista1', 1, '633216512', '12345678', NULL),
(27, 'Jaime', 0, '678543567', 'salomon1', NULL),
(28, 'prueba2', 0, '123456789', '12345678', NULL),
(29, 'pruebaFoto', 0, '123456788', '12345678', './img/perfil-default.png'),
(30, 'suren2', 0, '948384384', 'samsur1234', './img/perfil-default.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCita`),
  ADD KEY `fk_idUsuario` (`idUsuario`),
  ADD KEY `fk_idProfesional` (`idProfesional`),
  ADD KEY `idServicio` (`idServicio`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idHorario`);

--
-- Indices de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD PRIMARY KEY (`idProfesional`),
  ADD KEY `fk_profesionales_usuarios` (`idUsuario`);

--
-- Indices de la tabla `profesional_servicio`
--
ALTER TABLE `profesional_servicio`
  ADD PRIMARY KEY (`idProfesional`,`idServicio`),
  ADD KEY `idServicio` (`idServicio`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idServicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  MODIFY `idProfesional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`idServicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idProfesional` FOREIGN KEY (`idProfesional`) REFERENCES `profesionales` (`idProfesional`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD CONSTRAINT `fk_profesionales_usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesional_servicio`
--
ALTER TABLE `profesional_servicio`
  ADD CONSTRAINT `profesional_servicio_ibfk_1` FOREIGN KEY (`idProfesional`) REFERENCES `profesionales` (`idProfesional`),
  ADD CONSTRAINT `profesional_servicio_ibfk_2` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`idServicio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
