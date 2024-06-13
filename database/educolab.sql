-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2024 a las 21:17:46
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
  `fecha_horario` varchar(50) NOT NULL,
  `codigo` varchar(6) NOT NULL,
  `id_usuario_creador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clasesescolares`
--

INSERT INTO `clasesescolares` (`id`, `nombre`, `descripcion`, `fecha_horario`, `codigo`, `id_usuario_creador`) VALUES
(1, 'Ingles', '', 'Miercoles 18:30-20:00', '5ZjmJW', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_usuario`
--

CREATE TABLE `clase_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clase_usuario`
--

INSERT INTO `clase_usuario` (`id_usuario`, `id_clase`) VALUES
(3, 1),
(2, 1);

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
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `fecha_entrega` date NOT NULL,
  `enlace` varchar(50) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `fecha_horario` datetime NOT NULL,
  `clase_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `nombre`, `descripcion`, `fecha_horario`, `clase_id`) VALUES
(1, 'Tarea 1', 'Hacer un ensayo sobre la Revolución Industrial', '2024-06-15 10:00:00', 1),
(2, 'Tarea 2', 'Resolver los problemas del capítulo 5', '2024-06-14 15:30:00', 2),
(3, 'Tarea 3', 'Investigar sobre la célula animal', '2024-06-16 09:00:00', 3),
(4, 'Tarea 4', 'Preparar una presentación sobre la ecología', '2024-06-18 14:00:00', 4),
(5, 'Tarea 5', 'Entregar el proyecto final de matemáticas', '2024-06-20 17:00:00', 5),
(6, 'Tarea 6', 'Leer los capítulos 3 y 4 del libro de literatura', '2024-06-15 12:30:00', 6),
(7, 'Tarea 7', 'Practicar conjugaciones verbales en francés', '2024-06-17 11:00:00', 7),
(8, 'Tarea 8', 'Resolver los ejercicios de programación en Python', '2024-06-19 16:00:00', 8),
(9, 'Tarea 9', 'Hacer un análisis de mercado para el proyecto de e', '2024-06-21 09:30:00', 9),
(10, 'Tarea 10', 'Preparar la exposición sobre la Segunda Guerra Mun', '2024-06-14 13:00:00', 10),
(11, 'Tarea 11', 'Estudiar para el examen de química', '2024-06-16 10:30:00', 11),
(12, 'Tarea 12', 'Hacer un resumen del artículo científico asignado', '2024-06-18 15:45:00', 12),
(13, 'Tarea 13', 'Resolver los problemas de geometría', '2024-06-22 11:15:00', 13),
(14, 'Tarea 14', 'Preparar una presentación sobre la música clásica', '2024-06-23 14:30:00', 14),
(15, 'Tarea 15', 'Practicar la pronunciación en alemán', '2024-06-24 10:00:00', 15),
(16, 'Tarea 16', 'Entregar el informe de historia del arte', '2024-06-17 16:45:00', 16),
(17, 'Tarea 17', 'Hacer un análisis financiero para el proyecto de f', '2024-06-19 13:00:00', 17),
(18, 'Tarea 18', 'Resolver los ejercicios de estadística', '2024-06-21 15:30:00', 18),
(19, 'Tarea 19', 'Estudiar para el examen de biología celular', '2024-06-25 09:00:00', 19),
(20, 'Tarea 20', 'Investigar sobre las corrientes literarias del sig', '2024-06-26 11:30:00', 20);

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
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `password`, `email`, `rol`, `img`) VALUES
(1, 'LucaOshiro', '6b17f84c3e6e074b8a8c6de69a8cf25b', 'lucaoshiro@gmail.com', 'alumno', ''),
(2, 'Santiago', '04217c4d7e246e38b0d7014ee109755b', 'sdmatayoshi@gmail.com', 'alumno', 'Profesor.jpg'),
(3, 'Luh9090', '6b17f84c3e6e074b8a8c6de69a8cf25b', 'lucaoshiro@gmail.com', 'profesor', 'Profesor.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
