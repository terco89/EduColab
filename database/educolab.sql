-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-09-2024 a las 03:49:11
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
-- Base de datos: `educolab`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `titulo_asignacion` varchar(50) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `fecha_entrega` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasesescolares`
--

CREATE TABLE `clasesescolares` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `codigo` varchar(6) NOT NULL,
  `id_usuario_creador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clasesescolares`
--

INSERT INTO `clasesescolares` (`id`, `nombre`, `descripcion`, `codigo`, `id_usuario_creador`) VALUES
(51, 'clase1', '', 'vuvqS6', 14),
(54, 'lolo', '', '3ZqGRF', 14),
(61, 'clase3', '', 'p1rtjE', 14),
(62, 'Sebastian', '', 'h7YU7B', 14),
(63, 'clase1', '', 'IPYFGX', 14),
(64, 'clase1', '', 'Y1uRMZ', 14),
(66, 'clase1', '', 'FNF8d3', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_profesor`
--

CREATE TABLE `clase_profesor` (
  `id_usuario` int(255) NOT NULL,
  `id_clase` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clase_profesor`
--

INSERT INTO `clase_profesor` (`id_usuario`, `id_clase`) VALUES
(14, 66);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_usuario`
--

CREATE TABLE `clase_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `fondo` varchar(25) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clase_usuario`
--

INSERT INTO `clase_usuario` (`id_usuario`, `id_clase`, `fondo`, `estado`) VALUES
(14, 65, '', 'activa'),
(14, 66, '', 'activa'),
(12, 66, '', 'activa'),
(8, 66, '', 'activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(400) DEFAULT NULL,
  `codigo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discusiones`
--

CREATE TABLE `discusiones` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `tema` varchar(30) NOT NULL,
  `contenido` varchar(300) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `discusiones`
--

INSERT INTO `discusiones` (`id`, `id_alumno`, `id_clase`, `tema`, `contenido`, `fecha_creacion`) VALUES
(1, 4, 1, 'Duda sobre el uso de \"used to\"', 'Tengo una pregunta sobre el uso de \"used to\" y \"would\" en inglés para hablar sobre hábitos pasados. He leído algunas explicaciones, pero aún no estoy seguro de cuándo debería usar uno u otro. ¿Podrían explicarme las diferencias y darme ejemplos para cada uno?', '2024-07-04 12:40:42'),
(2, 3, 35, 'trtdftg', 'gfdydytdydtyt', '2024-07-04 16:18:52'),
(3, 14, 51, 'qw3e', 'qwe', '2024-08-26 14:37:00'),
(4, 14, 51, '', 'asd', '2024-08-26 14:38:17'),
(5, 14, 55, 'xczz', 'xcz', '2024-08-28 15:03:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `tarea_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `calificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`tarea_id`, `usuario_id`, `fecha_entrega`, `calificacion`) VALUES
(59, 4, '2024-08-01 15:56:15', NULL),
(60, 4, '2024-08-20 14:43:16', NULL),
(51, 12, '2024-08-22 13:55:52', NULL),
(66, 13, '2024-08-28 15:11:41', NULL),
(67, 14, '2024-08-28 15:41:04', NULL),
(67, 14, '2024-08-28 15:45:17', NULL),
(67, 14, '2024-08-28 15:45:18', NULL),
(67, 14, '2024-08-28 15:45:19', NULL),
(67, 14, '2024-08-28 15:45:19', NULL),
(67, 14, '2024-08-28 15:45:20', NULL),
(67, 14, '2024-08-28 15:45:20', NULL),
(67, 13, '2024-08-28 15:45:44', NULL),
(67, 13, '2024-08-28 15:45:44', NULL),
(67, 13, '2024-08-28 15:45:45', NULL),
(67, 13, '2024-08-28 15:45:45', NULL),
(67, 13, '2024-08-28 15:45:45', NULL),
(67, 13, '2024-08-28 15:45:57', NULL),
(68, 13, '2024-08-28 15:56:17', NULL),
(68, 13, '2024-08-28 15:56:21', NULL),
(69, 13, '2024-08-31 12:37:55', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacios`
--

CREATE TABLE `espacios` (
  `id` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `curso_division` varchar(255) NOT NULL,
  `id_usuario` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `espacios`
--

INSERT INTO `espacios` (`id`, `nombre`, `curso_division`, `id_usuario`) VALUES
(1, 'TCI', '3°', 14),
(2, 'Sebastian', 'asd', 13),
(3, 'asd', 'asda', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacios_clases`
--

CREATE TABLE `espacios_clases` (
  `id_espacio` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `espacios_clases`
--

INSERT INTO `espacios_clases` (`id_espacio`, `id_clase`) VALUES
(1, 51),
(1, 52),
(2, 53),
(3, 53),
(3, 59);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `nombre_clase` varchar(100) NOT NULL,
  `dia_semana` varchar(20) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horario`, `id_clase`, `nombre_clase`, `dia_semana`, `hora_inicio`, `hora_fin`) VALUES
(1, 62, 'Sebastian', 'Martes', '22:28:00', '11:11:00'),
(2, 63, 'clase1', 'Lunes', '11:11:00', '11:11:00'),
(3, 64, 'clase1', 'Lunes', '11:11:00', '11:11:00'),
(5, 66, 'clase1', 'Martes', '12:31:00', '12:23:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `tipo_material` varchar(50) NOT NULL,
  `enlace_archivo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_discusion` int(11) NOT NULL,
  `mensaje` varchar(300) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `id_usuario`, `id_discusion`, `mensaje`, `fecha_creacion`) VALUES
(1, 4, 1, 'nose', '2024-07-04 13:09:30'),
(2, 4, 1, 'a', '2024-07-04 13:26:43'),
(3, 4, 1, 'xd', '2024-07-04 13:26:52'),
(4, 3, 2, 'gsgsgdsdg', '2024-07-04 16:20:41'),
(5, 14, 3, 'qwe', '2024-08-26 14:37:07'),
(6, 14, 3, 'qweqwe', '2024-08-26 14:37:08'),
(7, 14, 3, 'qweqweqwewqeqweqweqwe', '2024-08-26 14:37:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_privado`
--

CREATE TABLE `mensajes_privado` (
  `id` int(10) UNSIGNED NOT NULL,
  `tarea_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `mensaje` varchar(1000) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `bandera` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes_privado`
--

INSERT INTO `mensajes_privado` (`id`, `tarea_id`, `usuario_id`, `mensaje`, `fecha_creacion`, `bandera`) VALUES
(9, 60, 11, 'fsafsdafda', '2024-08-20 17:01:51', 1),
(10, 60, 11, 'ggggg', '2024-08-20 17:04:17', 0),
(11, 60, 11, 'noooooo', '2024-08-20 17:04:38', 0),
(12, 60, 11, 'fdssfdgsd', '2024-08-20 17:09:17', 0),
(13, 60, 11, 'jkllkñ{{kl', '2024-08-20 17:10:34', 0),
(14, 60, 11, 'dfghgjkhh', '2024-08-20 17:11:21', 0),
(15, 60, 11, 'fdsfdsfdsdsfg', '2024-08-20 17:21:00', 1),
(16, 51, 12, 'sad', '2024-08-22 14:04:24', 1),
(17, 51, 12, 'asd', '2024-08-22 14:04:26', 1),
(18, 51, 12, 'asada', '2024-08-22 14:04:27', 1),
(19, 66, 14, 'si aaja ¿¿¿¿', '2024-08-28 15:11:13', 1),
(20, 66, 13, 'asdasd', '2024-08-28 15:11:24', 1),
(21, 66, 14, 'asd', '2024-08-28 15:32:05', 1),
(22, 66, 14, 'asd', '2024-08-28 15:32:13', 1),
(23, 66, 14, 'ewqwe', '2024-08-28 15:40:21', 1),
(24, 66, 14, 'wqeqw', '2024-08-28 15:40:25', 1),
(25, 67, 14, 'sada', '2024-08-28 15:41:00', 1),
(26, 68, 14, 'sfsdf', '2024-08-28 15:55:43', 1),
(27, 69, 13, 'asd', '2024-08-31 12:42:39', 1),
(28, 71, 13, 'sada', '2024-09-02 13:17:26', 1),
(29, 71, 14, 'asd', '2024-09-02 13:17:31', 1),
(30, 71, 14, 'asadasd', '2024-09-02 13:17:34', 1),
(31, 71, 13, 'asdd', '2024-09-02 13:17:39', 1),
(32, 71, 14, 'spy ppwep', '2024-09-02 13:18:10', 1),
(33, 72, 13, 'asda', '2024-09-02 13:24:47', 1),
(34, 72, 14, 'asd', '2024-09-02 13:25:01', 1),
(35, 72, 14, 'sddgtf', '2024-09-02 13:28:03', 1),
(36, 72, 13, 'fsdfsdfsds', '2024-09-02 13:28:17', 1),
(37, 73, 13, 'asd', '2024-09-02 13:28:40', 1),
(38, 73, 13, 'dasd', '2024-09-02 13:28:42', 1),
(39, 73, 13, 'adadasd', '2024-09-02 13:28:44', 1),
(40, 73, 13, 'asdasd', '2024-09-02 13:28:46', 1),
(41, 73, 13, 'sadsdsa', '2024-09-02 13:28:47', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `clase_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `nombre`, `descripcion`, `fecha_subida`, `fecha_entrega`, `clase_id`) VALUES
(26, 'Ensayo Revolución Industrial', 'Realizar un ensayo sobre la Revolución Industrial', '2024-06-01 08:00:00', '2024-06-15 23:59:59', 1),
(27, 'Ejercicios Matemáticas', 'Resolver los ejercicios del capítulo 5 de Matemáticas', '2024-06-02 10:30:00', '2024-06-09 18:00:00', 2),
(28, 'Presentación Sistema Solar', 'Preparar una presentación sobre el sistema solar', '2024-06-03 14:00:00', '2024-06-17 12:00:00', 3),
(29, 'Examen Historia del Arte', 'Estudiar para el examen de Historia del arte', '2024-06-04 09:00:00', '2024-06-10 09:00:00', 4),
(30, 'Investigación Guerra Fría', 'Realizar una investigación sobre la Guerra Fría', '2024-06-05 11:30:00', '2024-06-19 15:30:00', 5),
(31, 'Química Laboratorio', 'Resolver los problemas de química del laboratorio', '2024-06-06 13:45:00', '2024-06-12 16:45:00', 6),
(32, 'Leer Libro Literatura', 'Leer el libro asignado para literatura', '2024-06-07 07:00:00', '2024-06-14 23:00:00', 7),
(33, 'Conjugación Francés', 'Practicar la conjugación de los verbos en francés', '2024-06-08 16:30:00', '2024-06-18 19:30:00', 8),
(34, 'Investigación Albert Einstein', 'Investigar sobre la biografía de Albert Einstein', '2024-06-09 12:15:00', '2024-06-20 10:15:00', 9),
(35, 'Física Cuaderno', 'Resolver los problemas de física del cuaderno', '2024-06-10 10:00:00', '2024-06-16 14:00:00', 10),
(36, 'Dibujo Flora y Fauna', 'Realizar un dibujo sobre la flora y fauna local', '2024-06-11 15:00:00', '2024-06-25 08:00:00', 11),
(37, 'Examen Geografía Mundial', 'Estudiar para el examen de geografía mundial', '2024-06-12 11:00:00', '2024-06-23 16:00:00', 12),
(38, 'Programación Python', 'Resolver los ejercicios de programación en Python', '2024-06-13 09:30:00', '2024-06-21 11:30:00', 13),
(39, 'Presentación Primera Guerra Mu', 'Realizar una presentación oral sobre la Primera Guerra Mundial', '2024-06-14 08:45:00', '2024-06-22 13:45:00', 14),
(40, 'Vida de Miguel de Cervantes', 'Investigar sobre la vida y obra de Miguel de Cervantes', '2024-06-15 12:00:00', '2024-06-24 15:00:00', 15),
(41, 'Álgebra Libro', 'Resolver los problemas de álgebra del libro', '2024-06-16 14:30:00', '2024-06-26 17:30:00', 16),
(42, 'Experimento Ley de la Conserva', 'Realizar un experimento sobre la ley de la conservación de la energía', '2024-06-17 10:00:00', '2024-06-28 12:00:00', 17),
(43, 'Dramatización Edad Media', 'Preparar una dramatización sobre la vida en la Edad Media', '2024-06-18 13:20:00', '2024-06-29 15:20:00', 18),
(44, 'Trigonometría Cuaderno', 'Resolver los ejercicios de trigonometría del cuaderno', '2024-06-19 09:15:00', '2024-06-27 11:15:00', 19),
(45, 'Ensayo Globalización', 'Realizar un ensayo sobre el impacto de la globalización', '2024-06-20 08:30:00', '2024-07-03 10:30:00', 20),
(46, 'Ensayo Influencia del Cine', 'Escribir un ensayo sobre la influencia del cine en la cultura popular', '2024-06-21 10:00:00', '2024-07-05 12:00:00', 1),
(47, 'Presentación Gramática Pasado ', 'Realizar una presentación sobre la gramática del pasado simple', '2024-06-22 09:30:00', '2024-07-06 11:30:00', 1),
(48, 'Dramatización Shakespeare', 'Preparar una dramatización de una escena de una obra de Shakespeare', '2024-06-23 08:45:00', '2024-07-07 10:45:00', 1),
(49, 'Vocabulario Tecnología', 'Estudiar vocabulario relacionado con la tecnología moderna', '2024-06-24 12:00:00', '2024-07-08 14:00:00', 1),
(50, 'Comprensión Lectora', 'Resolver los ejercicios de comprensión lectora del libro de texto', '2024-06-25 14:30:00', '2024-07-09 16:30:00', 1),
(51, 'wefwefwefef', 'fwef', '2024-07-04 15:34:37', '2024-07-04 17:34:00', 33),
(52, 'ososjdfosdf', 'gdsfgsdfgsdf', '2024-07-04 15:57:04', '2024-07-10 17:59:00', 35),
(53, 'Hola', 'Chau', '2024-07-10 03:20:43', '2024-07-19 06:20:00', 35),
(54, 'wudised', '238e23e', '2024-07-10 04:28:41', '2024-07-05 06:30:00', 35),
(55, 'msd', 'msd', '2024-07-10 06:15:13', '2024-07-13 09:18:00', 35),
(56, 'Revolucion Industrial', 'hacer la tarea', '2024-07-10 06:36:04', '2024-07-11 09:39:00', 35),
(59, 'xd', 'xd', '2024-08-01 14:36:58', '2024-08-28 14:36:00', 36),
(60, 'tarea', 'tarea', '2024-08-20 14:42:51', '2024-08-02 14:42:00', 36),
(63, 'sadsad', 'asdsadasd', '2024-08-24 20:52:47', '2024-08-20 20:52:00', 45),
(65, 'zxc', 'zxcz', '2024-08-28 15:02:46', '2024-09-06 15:02:00', 57),
(69, 'tarea prueba', '', '2024-08-28 15:57:08', '0000-00-00 00:00:00', 58),
(72, 'tarea prueba', 'ver naruto', '2024-09-02 13:24:42', '2024-09-26 13:24:00', 66),
(73, 'asdas', 'dasdasd', '2024-09-02 13:28:36', '2024-10-03 13:28:00', 66);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea_usuario`
--

CREATE TABLE `tarea_usuario` (
  `tarea_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarea_usuario`
--

INSERT INTO `tarea_usuario` (`tarea_id`, `usuario_id`, `estado`) VALUES
(23, 7, 3),
(7, 3, 1),
(14, 8, 2),
(32, 4, 4),
(10, 6, 1),
(41, 1, 3),
(18, 9, 2),
(29, 2, 4),
(5, 10, 3),
(37, 5, 1),
(12, 7, 2),
(3, 2, 4),
(28, 4, 1),
(9, 1, 3),
(20, 8, 2),
(16, 3, 4),
(8, 6, 1),
(25, 10, 2),
(48, 5, 3),
(2, 9, 4),
(53, 3, 1),
(54, 3, 1),
(55, 3, 1),
(55, 1, 1),
(56, 3, 1),
(56, 1, 1),
(57, 4, 1),
(58, 4, 1),
(59, 4, 1),
(0, 4, 1),
(60, 4, 1),
(59, 11, 1),
(73, 14, 1),
(72, 13, 1),
(73, 13, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(350) NOT NULL,
  `fecha_alta` date NOT NULL,
  `id_clase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id`, `nombre`, `descripcion`, `fecha_alta`, `id_clase`) VALUES
(3, 'asd', 'asd', '2024-08-28', 55),
(4, 'tema prueba', 'si', '2024-09-02', 66);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema_usuario`
--

CREATE TABLE `tema_usuario` (
  `tema_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tema_usuario`
--

INSERT INTO `tema_usuario` (`tema_id`, `usuario_id`) VALUES
(3, 14),
(4, 14),
(4, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `rol` varchar(30) NOT NULL,
  `img` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellido` varchar(32) NOT NULL,
  `escuela` varchar(64) NOT NULL,
  `github` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `password`, `email`, `rol`, `img`, `edad`, `nombre`, `apellido`, `escuela`, `github`) VALUES
(1, 'LucaOshiro', '6b17f84c3e6e074b8a8c6de69a8cf25b', 'lucaoshiro@gmail.com', 'alumno', '', 0, 'Luca', 'Oshiro', '', ''),
(2, 'Santiago', '04217c4d7e246e38b0d7014ee109755b', 'sdmatayoshi@gmail.com', 'alumno', 'Profesor.jpg', 0, 'Santiago', 'matayoshi', '', ''),
(3, 'Luh9090', '6b17f84c3e6e074b8a8c6de69a8cf25b', 'lucaoshiro@gmail.com', 'profesor', 'eve.jpg', 0, 'Luca', 'Oshiro', '', ''),
(4, 'elgabo', '38b1afebce3ecc702e3e04071ec2b94f', 'elgabo@gmail.com', 'alumno', 'alumno.jpg', 0, '', '', '', ''),
(5, 'lol', '202cb962ac59075b964b07152d234b70', 'lol@gmail.com', 'alumno', 'alumno.jpg', 0, '', '', '', ''),
(6, 'qwe', '202cb962ac59075b964b07152d234b70', 'qwe@gmail.com', 'alumno', 'alumno.jpg', 0, '', '', '', ''),
(7, 'qwe', '76d80224611fc919a5d54f0ff9fba446', 'wqe', 'alumno', 'alumno.jpg', 0, '', '', '', ''),
(8, 'reichsacht', '5eb3c70fb1c47a19a7b6674092c19fc0', 'rechenbann@gmail.com', 'alumno', 'v-chan.png', 18, 'Santiago Daniel', 'Matayoshi', 'E.T.N°26 Confederación Suiza', 'sdmatayoshi'),
(10, 'nose', '9de355443f2000d9e076248b317f73b8', 'nose@nose.nose', 'alumno', 'alumno.jpg', 66, 'nose', 'nose', 'nose', ''),
(11, 'xd', '9de355443f2000d9e076248b317f73b8', 'xd@xd.xd', 'alumno', 'alumno.jpg', 19, 'xd', 'xd', '', ''),
(12, 'laydo', '202cb962ac59075b964b07152d234b70', 'sebastian.pardo.scp@gmail.com', 'alumno', 'alumno.jpg', 17, 'Sebastian', 'Pardo', '', ''),
(13, 'Alumno_usuario', '202cb962ac59075b964b07152d234b70', 'alumno@gmail.com', 'alumno', 'alumno.jpg', 16, 'Alumno_nombre', 'Alumno_apellido', '', ''),
(14, 'Profesor_usuario', '202cb962ac59075b964b07152d234b70', 'profesor@gmail.com', 'profesor', 'profesor.jpg', 44, 'Profesor_nombre', 'Profesor_apellido', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_cursos`
--

CREATE TABLE `usuarios_cursos` (
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `fecha_inscripcion` date NOT NULL,
  `estado_inscripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clasesescolares`
--
ALTER TABLE `clasesescolares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `discusiones`
--
ALTER TABLE `discusiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `espacios`
--
ALTER TABLE `espacios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `id_clase` (`id_clase`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes_privado`
--
ALTER TABLE `mensajes_privado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clasesescolares`
--
ALTER TABLE `clasesescolares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `discusiones`
--
ALTER TABLE `discusiones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `espacios`
--
ALTER TABLE `espacios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mensajes_privado`
--
ALTER TABLE `mensajes_privado`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`id_clase`) REFERENCES `clasesescolares` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
