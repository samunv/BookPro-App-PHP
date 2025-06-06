-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2025 a las 09:53:17
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
(125, 2, '31', '21:30:00', 1, 'Julio', 2024, 1),
(126, 2, '31', '15:00:00', 2, 'Julio', 2024, 1),
(127, 2, '31', '19:00:00', 2, 'Julio', 2024, 1),
(128, 2, '29', '21:30:00', 1, 'Agosto', 2024, 1),
(129, 2, '29', '18:30:00', 2, 'Agosto', 2024, 1),
(130, 2, '7', '18:30:00', 1, 'Agosto', 2024, 1),
(133, 2, '19', '15:30:00', 1, 'Septiembre', 2024, 1),
(134, 2, '22', '16:00:00', 1, 'Agosto', 2024, 1),
(135, 2, '29', '16:00:00', 1, 'Agosto', 2024, 1),
(136, 2, '28', '16:00:00', 1, 'Agosto', 2024, 1),
(137, 2, '21', '18:30:00', 1, 'Agosto', 2024, 1),
(138, 2, '27', '16:00:00', 1, 'Agosto', 2024, 1),
(139, 2, '13', '16:00:00', 1, 'Agosto', 2024, 1),
(140, 2, '13', '21:30:00', 1, 'Agosto', 2024, 1),
(141, 2, '14', '16:00:00', 1, 'Agosto', 2024, 1),
(142, 2, '14', '22:00:00', 1, 'Agosto', 2024, 1),
(143, 2, '10', '16:00:00', 1, 'Agosto', 2024, 1),
(145, 2, '14', '16:30:00', 1, 'Agosto', 2024, 1),
(146, 2, '14', '21:00:00', 1, 'Agosto', 2024, 1),
(147, 2, '14', '17:00:00', 1, 'Agosto', 2024, 1),
(148, 2, '15', '18:00:00', 1, 'Agosto', 2024, 1),
(149, 2, '10', '16:30:00', 1, 'Agosto', 2024, 1),
(150, 2, '20', '16:00:00', 1, 'Agosto', 2024, 1),
(151, 2, '14', '17:30:00', 1, 'Agosto', 2024, 1),
(152, 2, '23', '21:30:00', 1, 'Agosto', 2024, 1),
(153, 2, '15', '21:00:00', 2, 'Agosto', 2024, 1),
(154, 2, '29', '16:00:00', 2, 'Agosto', 2024, 1),
(155, 2, '30', '21:00:00', 2, 'Agosto', 2024, 1),
(156, 2, '28', '21:30:00', 1, 'Agosto', 2024, 1),
(157, 2, '27', '21:30:00', 1, 'Agosto', 2024, 1),
(158, 2, '28', '21:00:00', 1, 'Agosto', 2024, 1),
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
(197, 2, '25', '20:30:00', 1, 'Septiembre', 2024, 1),
(198, 2, '24', '16:30:00', 1, 'Septiembre', 2024, 1),
(199, 2, '15', '21:00:00', 1, 'Octubre', 2024, 1),
(207, 2, '29', '15:30:00', 2, 'Octubre', 2024, 1),
(208, 2, '27', '22:00:00', 2, 'Octubre', 2024, 1),
(218, 2, '23', '21:00:00', 1, 'Octubre', 2024, 1),
(219, 2, '29', '21:00:00', 3, 'Octubre', 2024, 2),
(220, 2, '31', '21:00:00', 1, 'Octubre', 2024, 1),
(230, 2, '5', '16:00:00', 1, 'Noviembre', 2024, 1),
(240, 2, '12', '18:30:00', 1, 'Noviembre', 2024, 1),
(243, 2, '13', '21:00:00', 1, 'Noviembre', 2024, 1),
(248, 2, '12', '21:00:00', 1, 'Noviembre', 2024, 1),
(250, 2, '13', '16:00:00', 3, 'Noviembre', 2024, 2),
(251, 2, '30', '22:00:00', 2, 'Noviembre', 2024, 1),
(256, 2, '13', '18:30:00', 1, 'Noviembre', 2024, 1),
(257, 2, '20', '16:00:00', 2, 'Noviembre', 2024, 2),
(259, 2, '13', '18:30:00', 2, 'Noviembre', 2024, 1),
(280, 2, '20', '16:00:00', 3, 'Noviembre', 2024, 2),
(289, 2, '26', '16:00:00', 1, 'Noviembre', 2024, 1),
(290, 2, '19', '19:30:00', 1, 'Noviembre', 2024, 1),
(291, 2, '19', '21:30:00', 1, 'Noviembre', 2024, 1),
(293, 2, '27', '18:30:00', 2, 'Noviembre', 2024, 1),
(294, 24, '19', '22:00:00', 1, 'Noviembre', 2024, 1),
(296, 2, '26', '21:00:00', 1, 'Noviembre', 2024, 1),
(298, 25, '23', '16:30:00', 1, 'Noviembre', 2024, 1),
(299, 2, '23', '17:00:00', 1, 'Noviembre', 2024, 1),
(300, 2, '29', '20:30:00', 2, 'Noviembre', 2024, 1),
(302, 2, '27', '17:00:00', 1, 'Noviembre', 2024, 1),
(303, 33, '27', '15:00:00', 3, 'Noviembre', 2024, 2),
(304, 33, '26', '16:30:00', 1, 'Noviembre', 2024, 1),
(305, 33, '24', '18:30:00', 3, 'Noviembre', 2024, 2),
(306, 2, '25', '18:30:00', 1, 'Noviembre', 2024, 1),
(307, 2, '27', '17:30:00', 1, 'Noviembre', 2024, 1),
(311, 2, '17', '18:30:00', 1, 'Diciembre', 2024, 1),
(312, 2, '27', '21:00:00', 2, 'Diciembre', 2024, 1),
(313, 34, '16', '16:30:00', 1, 'Diciembre', 2024, 1),
(314, 34, '19', '16:00:00', 1, 'Diciembre', 2024, 1),
(315, 34, '16', '15:00:00', 1, 'Diciembre', 2024, 1),
(316, 34, '17', '15:00:00', 1, 'Diciembre', 2024, 1),
(320, 34, '25', '16:00:00', 1, 'Diciembre', 2024, 1),
(321, 2, '24', '15:00:00', 1, 'Diciembre', 2024, 1),
(337, 2, '25', '16:00:00', 3, 'Diciembre', 2024, 2),
(340, 2, '26', '19:00:00', 1, 'Diciembre', 2024, 1),
(341, 2, '31', '20:00:00', 1, 'Diciembre', 2024, 1),
(342, 2, '26', '22:00:00', 1, 'Diciembre', 2024, 1),
(343, 2, '25', '22:00:00', 1, 'Diciembre', 2024, 1),
(344, 2, '30', '15:30:00', 1, 'Diciembre', 2024, 1),
(346, 2, '30', '16:30:00', 1, 'Diciembre', 2024, 1),
(347, 2, '30', '17:30:00', 1, 'Diciembre', 2024, 1),
(348, 2, '30', '18:00:00', 1, 'Diciembre', 2024, 1),
(349, 2, '30', '18:30:00', 1, 'Diciembre', 2024, 1),
(350, 2, '30', '19:00:00', 1, 'Diciembre', 2024, 1),
(351, 2, '30', '19:30:00', 1, 'Diciembre', 2024, 1),
(352, 2, '30', '20:00:00', 1, 'Diciembre', 2024, 1),
(353, 2, '30', '20:30:00', 1, 'Diciembre', 2024, 1),
(354, 2, '30', '21:00:00', 1, 'Diciembre', 2024, 1),
(355, 2, '30', '22:00:00', 1, 'Diciembre', 2024, 1),
(357, 2, '25', '16:30:00', 3, 'Diciembre', 2024, 2),
(358, 2, '24', '20:00:00', 1, 'Diciembre', 2024, 1),
(360, 35, '25', '21:00:00', 1, 'Diciembre', 2024, 1),
(361, 2, '25', '16:00:00', 2, 'Diciembre', 2024, 1),
(362, 2, '25', '15:00:00', 2, 'Diciembre', 2024, 1),
(372, 2, '25', '16:30:00', 1, 'Diciembre', 2024, 1),
(373, 2, '25', '17:00:00', 2, 'Diciembre', 2024, 1),
(375, 2, '31', '16:30:00', 3, 'Diciembre', 2024, 2),
(377, 2, '25', '17:00:00', 1, 'Diciembre', 2024, 1),
(378, 38, '25', '17:30:00', 1, 'Diciembre', 2024, 1),
(379, 2, '26', '18:30:00', 1, 'Diciembre', 2024, 3),
(380, 2, '26', '19:30:00', 1, 'Diciembre', 2024, 1),
(381, 2, '30', '21:30:00', 1, 'Diciembre', 2024, 3),
(401, 2, '31', '21:30:00', 1, 'Diciembre', 2024, 1),
(404, 59, '31', '15:00:00', 1, 'Diciembre', 2024, 1),
(405, 59, '31', '17:30:00', 1, 'Diciembre', 2024, 1),
(407, 61, '31', '15:30:00', 1, 'Diciembre', 2024, 3),
(408, 62, '31', '16:00:00', 1, 'Diciembre', 2024, 3),
(409, 63, '31', '18:30:00', 1, 'Diciembre', 2024, 1),
(410, 64, '31', '21:00:00', 1, 'Diciembre', 2024, 1),
(411, 33, '31', '19:00:00', 1, 'Diciembre', 2024, 1),
(412, 59, '1', '15:30:00', 1, 'Enero', 2025, 1),
(413, 2, '1', '16:30:00', 1, 'Enero', 2025, 1),
(414, 2, '31', '22:00:00', 1, 'Diciembre', 2024, 1),
(416, 2, '31', '16:00:00', 2, 'Diciembre', 2024, 1),
(417, 2, '31', '16:30:00', 1, 'Diciembre', 2024, 1),
(418, 61, '1', '17:00:00', 1, 'Enero', 2025, 3),
(419, 2, '1', '17:30:00', 1, 'Enero', 2025, 3),
(420, 66, '31', '21:00:00', 2, 'Diciembre', 2024, 1),
(426, 66, '1', '16:00:00', 1, 'Enero', 2025, 1),
(427, 66, '1', '18:30:00', 1, 'Enero', 2025, 1),
(428, 66, '30', '15:30:00', 1, 'Enero', 2025, 1),
(429, 67, '1', '15:00:00', 1, 'Enero', 2025, 1),
(431, 67, '28', '16:00:00', 1, 'Enero', 2025, 1),
(432, 67, '3', '15:00:00', 1, 'Enero', 2025, 1),
(433, 2, '3', '18:30:00', 1, 'Enero', 2025, 1),
(434, 2, '4', '15:30:00', 1, 'Enero', 2025, 1),
(435, 2, '4', '15:30:00', 2, 'Enero', 2025, 1),
(436, 2, '4', '18:30:00', 2, 'Enero', 2025, 1),
(437, 2, '4', '18:00:00', 1, 'Enero', 2025, 1),
(438, 2, '4', '17:30:00', 1, 'Enero', 2025, 1),
(439, 2, '4', '18:30:00', 1, 'Enero', 2025, 1),
(440, 2, '4', '19:00:00', 1, 'Enero', 2025, 1),
(441, 2, '4', '19:30:00', 1, 'Enero', 2025, 1),
(442, 2, '4', '20:00:00', 1, 'Enero', 2025, 1),
(443, 2, '4', '20:30:00', 1, 'Enero', 2025, 1),
(444, 2, '4', '21:00:00', 1, 'Enero', 2025, 1),
(445, 2, '4', '21:30:00', 1, 'Enero', 2025, 1),
(446, 2, '4', '22:00:00', 1, 'Enero', 2025, 1),
(447, 68, '10', '17:30:00', 3, 'Enero', 2025, 2),
(448, 2, '5', '15:30:00', 1, 'Enero', 2025, 1),
(450, 66, '5', '17:00:00', 1, 'Enero', 2025, 1),
(453, 2, '5', '16:30:00', 1, 'Enero', 2025, 3),
(467, 66, '14', '21:00:00', 1, 'Enero', 2025, 3),
(468, 66, '6', '17:30:00', 1, 'Enero', 2025, 1),
(469, 66, '6', '18:30:00', 1, 'Enero', 2025, 1),
(500, 2, '6', '18:00:00', 1, 'Enero', 2025, 1),
(501, 66, '8', '16:00:00', 1, 'Enero', 2025, 1),
(502, 69, '6', '20:00:00', 3, 'Enero', 2025, 5),
(503, 69, '6', '19:00:00', 1, 'Enero', 2025, 1),
(507, 2, '7', '16:30:00', 1, 'Enero', 2025, 3),
(509, 2, '8', '16:00:00', 3, 'Enero', 2025, 2),
(513, 2, '7', '16:00:00', 3, 'Enero', 2025, 2),
(515, 2, '8', '16:30:00', 3, 'Enero', 2025, 2),
(517, 2, '15', '16:00:00', 1, 'Enero', 2025, 1),
(519, 68, '8', '18:00:00', 1, 'Enero', 2025, 1),
(520, 66, '8', '18:30:00', 1, 'Enero', 2025, 1),
(521, 2, '22', '16:00:00', 1, 'Enero', 2025, 1);

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
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idNotificacion` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `destinatario` varchar(80) NOT NULL,
  `imagen_notificacion` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_expiracion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idNotificacion`, `titulo`, `mensaje`, `destinatario`, `imagen_notificacion`, `fecha_creacion`, `fecha_expiracion`) VALUES
(5, 'Reserva de Cita', 'samuel_nv ha reservado una cita de Corte de pelo el  de  de  a las .', 'peluquero2@email.com', '', '2024-12-31 12:54:27', NULL),
(11, 'Reserva de Cita', 'Has reservado una cita el 1 de Enero de 2025 a las 17:00:00.', 'mopsidasti@gufum.com', '', '2024-12-31 13:28:09', NULL),
(14, 'Reserva de Cita', 'probarNotis ha reservado una cita de Corte de pelo el  de  de  a las .', 'peluquero2@email.com', '', '2024-12-31 15:22:27', NULL),
(16, 'Reserva de Cita', 'probarNotis ha reservado una cita de Corte de pelo el  de  de  a las .', 'peluquero2@email.com', '', '2024-12-31 15:22:37', NULL),
(17, 'Reserva de Cita', 'probarNotis ha reservado una cita de Corte de pelo el  de  de  a las .', 'peluquero2@email.com', '', '2024-12-31 15:25:07', NULL),
(44, 'Reserva de Cita', 'Has reservado una cita el 1 de Enero de 2025 a las 15:00:00.', 'surennavas22@gmail.com', '', '2024-12-31 22:32:28', NULL),
(46, 'Reserva de Cita', 'Has reservado una cita el 8 de Enero de 2025 a las 22:00:00.', 'surennavas22@gmail.com', '', '2024-12-31 22:36:05', NULL),
(48, 'Reserva de Cita', 'Has reservado una cita el 28 de Enero de 2025 a las 16:00:00.', 'surennavas22@gmail.com', '', '2025-01-03 00:39:50', NULL),
(51, 'Reserva de Cita', 'Has reservado una cita el 3 de Enero de 2025 a las 15:00:00.', 'surennavas22@gmail.com', '', '2025-01-03 01:09:51', NULL),
(56, 'Reserva de Cita', 'samuel_nv ha reservado una cita de Corte de pelo el 4 de Enero de 2025 a las 15:30:00.', 'peluquero2@email.com', '', '2025-01-04 11:56:22', NULL),
(58, 'Reserva de Cita', 'samuel_nv ha reservado una cita de Corte de pelo el 4 de Enero de 2025 a las 18:30:00.', 'peluquero2@email.com', '', '2025-01-04 15:38:45', NULL),
(81, 'Reserva de Cita', 'Has reservado una cita el 10 de Enero de 2025 a las 17:30:00.', 'paulamugaromero03@gmail.com', '', '2025-01-04 18:28:31', NULL),
(97, 'Reserva de Cita', 'Samuel NV ha reservado una cita de Manicura el 6 de Enero de 2025 a las 16:00:00.', 'manicurista@email.com', '', '2025-01-05 16:29:55', NULL),
(126, 'Reserva de Cita', 'Samuel NV ha reservado una cita de Manicura el 8 de Enero de 2025 a las 16:00:00.', 'manicurista@email.com', '', '2025-01-06 11:46:14', NULL),
(180, 'Reserva de Cita', 'Samuel NV ha reservado una cita de Manicura el 14 de Enero de 2025 a las 16:00:00.', 'manicurista@email.com', '', '2025-01-06 14:20:29', NULL),
(184, 'Reserva de Cita', 'Samuel NV ha reservado una cita de Maquillaje profesional el 8 de Enero de 2025 a las 18:30:00.', 'manicurista@email.com', '', '2025-01-06 14:48:23', NULL),
(192, 'Reserva de Cita', 'Reko Ceg ha reservado una cita de Maquillaje profesional el 6 de Enero de 2025 a las 20:00:00.', 'manicurista@email.com', '', '2025-01-06 15:19:19', NULL),
(193, 'Reserva de Cita', 'Has reservado una cita el 6 de Enero de 2025 a las 20:00:00.', 'rekoceg386@evnft.com', '', '2025-01-06 15:19:19', NULL),
(195, 'Reserva de Cita', 'Has reservado una cita el 6 de Enero de 2025 a las 19:00:00.', 'rekoceg386@evnft.com', '', '2025-01-06 15:20:04', NULL),
(206, 'Reserva de Cita', 'Samuel NV ha reservado una cita de Manicura el 8 de Enero de 2025 a las 16:00:00.', 'manicurista@email.com', '', '2025-01-06 23:26:49', NULL),
(214, 'Reserva de Cita', 'Samuel NV ha reservado una cita de Manicura el 7 de Enero de 2025 a las 16:00:00.', 'manicurista@email.com', '', '2025-01-07 00:02:42', NULL),
(219, 'Reserva de Cita', 'Samuel NV ha reservado una cita de Manicura el 8 de Enero de 2025 a las 16:30:00.', 'manicurista@email.com', '', '2025-01-07 21:14:47', NULL),
(220, 'Reserva de Cita', 'Samuel NV ha reservado una cita de Manicura el 8 de Enero de 2025 a las 16:30:00.', 'manicurista@email.com', '', '2025-01-07 21:14:50', NULL),
(222, 'Reserva de Cita', 'Has reservado una cita el 8 de Enero de 2025 a las 17:00:00.', 'sur00044@gmail.com', '', '2025-01-08 08:18:02', NULL),
(225, 'Reserva de Cita', 'Has reservado una cita el 15 de Enero de 2025 a las 16:00:00.', 'sur00044@gmail.com', '', '2025-01-08 15:09:16', NULL),
(227, 'Reserva de Cita', 'Has reservado una cita el 29 de Enero de 2025 a las 16:00:00.', 'sur00044@gmail.com', '', '2025-01-08 15:10:43', NULL),
(229, 'Reserva de Cita', 'Has reservado una cita el 8 de Enero de 2025 a las 18:00:00.', 'paulamugaromero03@gmail.com', '', '2025-01-08 16:22:10', NULL),
(231, 'Reserva de Cita', 'Has reservado una cita el 8 de Enero de 2025 a las 18:30:00.', 'snavasardyanv@alumnos.nebrija.es', '', '2025-01-08 16:49:00', NULL),
(232, 'Reserva de Cita', 'Has reservado una cita el 22 de Enero de 2025 a las 16:00:00.', 'sur00044@gmail.com', '', '2025-01-08 22:13:01', NULL),
(233, 'Reserva de Cita', 'Samuel NV ha reservado una cita de Corte de pelo Caballero el 22 de Enero de 2025 a las 16:00:00.', 'peluquero1@email.com', '', '2025-01-08 22:13:01', NULL);

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
(1, 3),
(2, 1),
(3, 2),
(3, 5);

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
(1, 'Corte de pelo Caballero', 10.00, 30, 'https://www.24horas.cl/24horas/site/artic/20231002/imag/foto_0000003020231002221814/corte-pelo-taper-fade.jpg'),
(2, 'Manicura', 27.00, 60, 'https://escuelaversailles.com/wp-content/uploads/Tipos-y-tecnicas-de-manicura.jpg'),
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
  `foto` varchar(255) DEFAULT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `token` varchar(16) DEFAULT NULL,
  `color1` varchar(100) DEFAULT NULL,
  `color2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `permisos`, `telefono`, `contrasena`, `foto`, `correo`, `token`, `color1`, `color2`) VALUES
(2, 'Samuel NV', 0, '641347319', 'paulaminovia', './../Vista/img/1695175580151.jpg', 'sur00044@gmail.com', NULL, '#BFE8FF', '#006bff'),
(24, 'Peluquero 1', 1, '643523433', '12345678', 'https://cdn.iconscout.com/icon/free/png-256/free-barbero-3972159-3287197.png?f=webp', 'peluquero1@email.com', NULL, NULL, NULL),
(25, 'Peluquero 2', 1, '654321213', '12345678', 'https://img.freepik.com/vector-premium/lindo-peluquero-vector-dibujos-animados-feliz-hipster-peluquero-hombre-profesional-peluquero-listo-hacer-corte-pelo-moda-ilustracion-aislada_454510-260.jpg?semt=ais_hybrid', 'peluquero2@email.com', NULL, NULL, NULL),
(26, 'Manicurista', 1, '633216512', '12345678', 'https://img.freepik.com/psd-gratis/ilustracion-estudio-unas_23-2150854537.jpg', 'manicurista@email.com', NULL, NULL, NULL),
(32, 'samuel_navasardyan_vardanyan', 0, '666666666', '12345678', './img/perfil-default.png', NULL, NULL, NULL, NULL),
(33, 'paulaMugaRomero', 0, '463212344', '12345678', './img/perfil-default.png', 'paulamuga@email.com', NULL, '#e7fff8', '#00c8a0'),
(34, 'Juanma', 0, '666222333', '12345678', './img/perfil-default.png', NULL, NULL, NULL, NULL),
(35, 'usuario_correo', 0, '243555555', '12345678', './../Vista/img/qlfFondoPantalla.png', 'usuariocorreo10@email.com', NULL, NULL, NULL),
(37, 'rodrigo', 0, '123564634', '12345678', './img/perfil-default.png', 'contactorodrigo@profesores.nebrija.es', NULL, NULL, NULL),
(38, 'Jorge Anton', 0, '224443222', '12345678', './img/perfil-default.png', 'jorgeanton@email.com', NULL, NULL, NULL),
(59, 'samu', 0, '452754735', '12345678', './img/perfil-default.png', 'prueba.barberpro@gmail.com', '0wa7oreM', '#ffe8e8', '#ff0000'),
(61, 'mopsidasti', 0, '653232353', '12345678', './../Vista/img/torre_eiffel_rosa.jpg', 'mopsidasti@gufum.com', 'ik54PWON', '#d5ffdb', '#00a317'),
(62, 'structuralloon', 0, '624244323', '12345678', './../Vista/img/portadaMoviles (1).png', 'structural.loon.arqd@instantletter.net', 'XFiVfBr0', '#f0f4ff', '#001eff'),
(63, 'dizzymuskoxxa', 0, '662132423', '12345678', './img/perfil-default.png', 'dizzy.muskox.xazh@instantletter.net', '9tQwCmfZ', '#d5ffdb', '#00a317'),
(64, 'miserableflyin', 0, '635886574', '12345678', './img/perfil-default.png', 'noble.koala.ibtx@instantletter.net', 'wU1NBeJI', '#fff5e3', '#ff9100'),
(65, 'probarNotis', 0, '4354323', '12345678', './img/perfil-default.png', 'ynlv0@freesourcecodes.com', 'cupvtUMK', '#BFE8FF', '#006bff'),
(66, 'samuNebrija', 0, '543454333', '12345678', './../Vista/img/descarga.jpg', 'snavasardyanv@alumnos.nebrija.es', 'ExnRiANm', '#ffd4fe', '#d600d3'),
(67, 'suren', 0, '641323427', 'elpepeetesech', './../Vista/img/muñecabarbie.jpg', 'surennavas22@gmail.com', '3x8ndWrc', '#e3ffe6', '#009933'),
(68, '03ppauu', 0, '627838433', '12345678', './../Vista/img/WhatsApp Image 2025-01-04 at 19.30.26.jpeg', 'paulamugaromero03@gmail.com', 'GUOcwQC4', '#fff5e3', '#ff9100'),
(69, 'Reko Ceg', 0, '232232111', '12345678', './../Vista/img/ASCK.jpg', 'rekoceg386@evnft.com', '7IucCiQ4', '#ffeeda', '#ff8a00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCita`),
  ADD UNIQUE KEY `unique_cita` (`fecha`,`hora`,`mes`,`año`,`idServicio`,`idProfesional`),
  ADD KEY `fk_idUsuario` (`idUsuario`),
  ADD KEY `fk_idProfesional` (`idProfesional`),
  ADD KEY `idServicio` (`idServicio`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idHorario`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idNotificacion`),
  ADD KEY `fk_destinatario` (`destinatario`);

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
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `correo_unique` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=522;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idNotificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

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
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_destinatario` FOREIGN KEY (`destinatario`) REFERENCES `usuarios` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE;

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
