-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-07-2024 a las 17:10:43
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasesescolares`
--

CREATE TABLE `clasesescolares` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `fecha_horario` varchar(50) NOT NULL,
  `codigo` varchar(6) NOT NULL,
  `id_usuario_creador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clasesescolares`
--

INSERT INTO `clasesescolares` (`id`, `nombre`, `descripcion`, `fecha_horario`, `codigo`, `id_usuario_creador`) VALUES
(1, 'Ingles', '', 'Miercoles 18:30-20:00', '5ZjmJW', 3),
(2, 'Matemáticas', 'Introducción a conceptos fundamentales como álgebr', 'Miércoles 18:30-20:00', 'ABC123', 1),
(3, 'Historia', 'Exploración de eventos clave en la historia mundia', 'Lunes 14:00-15:30', 'DEF456', 2),
(4, 'Ciencias Naturales', 'Estudio de organismos vivos y sus interacciones co', 'Viernes 10:00-11:30', 'GHI789', 3),
(5, 'Literatura', 'Análisis de obras literarias destacadas y estilos ', 'Martes 16:00-17:30', 'JKL012', 1),
(6, 'Física', 'Estudio de las leyes fundamentales del movimiento ', 'Jueves 13:00-14:30', 'MNO345', 2),
(7, 'Educación Física', 'Promoción de la actividad física y la salud median', 'Miércoles 15:00-16:30', 'PQR678', 3),
(8, 'Arte', 'Exploración de diferentes formas de expresión artí', 'Martes 11:00-12:30', 'STU901', 1),
(9, 'Inglés', 'Desarrollo de habilidades en conversación y compre', 'Jueves 18:00-19:30', 'VWX234', 2),
(10, 'Programación', 'Introducción a la programación utilizando el lengu', 'Lunes 16:30-18:00', 'YZA567', 3),
(11, 'Química', 'Estudio de las propiedades y transformaciones de l', 'Viernes 14:00-15:30', 'BCD890', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_usuario`
--

CREATE TABLE `clase_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `fondo` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clase_usuario`
--

INSERT INTO `clase_usuario` (`id_usuario`, `id_clase`, `fondo`) VALUES
(3, 1, 'bg5.jpg'),
(2, 1, ''),
(4, 1, ''),
(4, 6, ''),
(3, 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(400) DEFAULT NULL,
  `codigo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `fecha_entrega` date NOT NULL,
  `enlace` varchar(50) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `tipo_material` varchar(50) NOT NULL,
  `enlace_archivo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `clase_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(60, 'No rompan las bolas pendejos de mierda', 'No rompan las bolas pendejos de mierda', '2024-07-04 02:47:18', '2024-07-05 03:50:00', 1),
(64, 'Hola', 'Hola', '2024-07-04 03:05:24', '2024-07-12 05:07:00', 1),
(68, 'UwU', 'UwU', '2024-07-04 03:19:24', '2024-07-10 06:22:00', 1),
(69, 'Hola', 'Hola', '2024-07-04 03:20:26', '2024-07-08 06:23:00', 1),
(70, 'sdsdsdsd', 'dssdsds', '2024-07-04 03:29:59', '2024-07-09 06:32:00', 1),
(71, 'Porfa 1', 'Porfa 1', '2024-07-04 03:36:48', '2024-07-11 06:39:00', 1),
(72, 'Porfa2', 'Porfa2', '2024-07-04 03:37:51', '2024-07-05 05:39:00', 1),
(73, 'ewjefss', 'sldkfmd', '2024-07-04 03:44:24', '2024-07-12 05:46:00', 1),
(74, 'aijsdkmasd', 'aksmdasd', '2024-07-04 03:48:45', '2024-07-15 06:48:00', 1),
(75, 'porfavor dale', 'PORFAVOR DALEE', '2024-07-04 03:54:22', '2024-07-18 06:57:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea_usuario`
--

CREATE TABLE `tarea_usuario` (
  `tarea_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 9, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `password`, `email`, `img`) VALUES
(1, 'LucaOshiro', '6b17f84c3e6e074b8a8c6de69a8cf25b', 'lucaoshiro@gmail.com', ''),
(2, 'Santiago', '04217c4d7e246e38b0d7014ee109755b', 'sdmatayoshi@gmail.com', 'Profesor.jpg'),
(3, 'Luh9090', '6b17f84c3e6e074b8a8c6de69a8cf25b', 'lucaoshiro@gmail.com', 'alumno.jpg'),
(4, 'elgabo', '38b1afebce3ecc702e3e04071ec2b94f', 'elgabo@gmail.com', 'alumno.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_cursos`
--

CREATE TABLE `usuarios_cursos` (
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `fecha_inscripcion` date NOT NULL,
  `estado_inscripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clasesescolares`
--
ALTER TABLE `clasesescolares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
