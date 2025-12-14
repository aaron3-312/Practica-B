-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2025 a las 03:06:35
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
-- Base de datos: `motodoctor_citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_moto` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `servicio` varchar(100) NOT NULL,
  `estado` varchar(20) DEFAULT 'Pendiente',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_cliente`, `id_moto`, `fecha_cita`, `hora_cita`, `servicio`, `estado`, `fecha_registro`) VALUES
(18, 20, 18, '2025-10-28', '14:00:00', 'cambio de aceite', 'Entregado', '2025-10-27 06:11:22'),
(19, 22, 20, '2025-10-30', '13:00:00', 'mantenimiento de balatas', 'Pendiente', '2025-10-27 06:24:59'),
(20, 23, 21, '2025-10-31', '14:00:00', 'mantenimiento general', 'Cancelado', '2025-10-27 06:26:27'),
(21, 24, 22, '2025-12-04', '12:00:00', 'servicio', 'Pendiente', '2025-12-03 14:09:23'),
(22, 25, 23, '2025-12-25', '14:20:00', 'tablero', 'Entregado', '2025-12-03 14:26:12'),
(23, 26, 24, '2025-12-20', '22:00:00', 'tablero', 'Pendiente', '2025-12-03 17:38:11'),
(24, 27, 25, '2025-12-20', '12:00:00', 'servicio', 'Pendiente', '2025-12-05 14:21:44'),
(25, 28, 26, '2025-12-20', '10:00:00', 'tablero', 'Pendiente', '2025-12-05 14:24:08'),
(26, 29, 27, '2025-12-19', '12:30:00', 'mantenimiento', 'Pendiente', '2025-12-05 14:39:45'),
(27, 30, 28, '2025-12-06', '12:00:00', 'servicio', 'Entregado', '2025-12-05 14:47:27'),
(28, 31, 29, '2025-12-20', '16:20:00', 'talachas', 'Pendiente', '2025-12-08 15:45:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `telefono`, `correo`) VALUES
(1, 'Aaron', '5631342481', 'sapoperros@gmail.com'),
(2, 'benito', '5635473639', 'aaronmolcruz@gmail.com'),
(3, 'pedro', '1234567890', 'pedro@gmail.com'),
(4, 'pepe', '454147986', NULL),
(5, 'julio', '345676543', NULL),
(6, 'cachetes', '345676543', 'cache@gmail.com'),
(7, 'juanita', 't45467865353', 'juanita@gmail.com'),
(8, 'juanita', 't45467865353', 'juanita@gmail.com'),
(9, 'ameri', '9832084230', 'ameri@gmail.com'),
(10, 'ameri', '9832084230', 'ameri@gmail.com'),
(11, 'ameri', '9832084230', 'ameri@gmail.com'),
(12, 'ameri', '9832084230', 'ameri@gmail.com'),
(13, 'mauro', '8766787678', 'mauro@gmail.com'),
(14, 'montserrat', '948572375', 'mon@gmail.com'),
(15, 'ezequiel', '44567654345', 'eze@gmail.com'),
(16, 'Aaron', '5631342481', 'sapoperro@gmail.com'),
(17, 'benito', '1234567890', 'sapoperros@gmail.com'),
(18, 'Aaron', '5635473639', 'aaronmolcruz@gmail.com'),
(19, 'vann', '9876543210', 'vane@gmail.com'),
(20, 'Carlos', '78347849', 'carlos@gmail.com'),
(21, 'pepe', '123456765432', 'pepe@gmail.com'),
(22, 'pepe', '123456765432', 'pepe@gmail.com'),
(23, 'pedro', '5635473639', 'pedro@gmail.com'),
(24, 'Ricardo', '234532554', 'richar@gmail.com'),
(25, 'Colo', '2423431', 'colo@gmail.com'),
(26, 'prueba', '2342342345', 'aaronmolcruz@gmail.com'),
(27, 'Aaron', '5631342481', 'aaronmolcruz@gmail.com'),
(28, 'Aaron', '5631342481', 'pedro@gmail.com'),
(29, 'Pedrito', '9876543210', 'car@gmail.com'),
(30, 'Aaron', '5631342481', 'aaronmolcruz@gmail.com'),
(31, 'benito', '5635473639', 'sapoperro@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motos`
--

CREATE TABLE `motos` (
  `id_moto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `placas` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motos`
--

INSERT INTO `motos` (`id_moto`, `id_cliente`, `marca`, `modelo`, `anio`, `placas`) VALUES
(1, 1, 'honda', 'cbrr', 2020, '86buy8'),
(2, 2, 'suzuki', 'ninja 500', 2025, '34frd2'),
(3, 3, 'cf moto', '250 nk', 2023, '73bfm32'),
(4, 4, 'suzuki', 'gsxr600', 2024, '65bvf4'),
(5, 5, 'bajaj', 'ns160', 2023, '346fdv'),
(6, 6, 'bajaj', 'dominar250', 2023, '566vhb'),
(7, 8, 'italika', '125z', 2018, '678g8'),
(8, 9, 'kawasaki', 'z900', 2024, '12341'),
(9, 10, 'kawasaki', 'z900', 2024, '12341'),
(10, 12, 'kawasaki', 'z900', 2024, '12341'),
(11, 13, 'honda', 'cbrr1000', 2018, '234323'),
(12, 14, 'cf moto', '450sr', 2022, '13edw'),
(13, 15, 'italika', 'z280', 2025, '34543ftgg'),
(14, 16, 'italika', '200z', 2020, '23mmik4'),
(15, 17, 'vento', 'cb250', 2020, '6578'),
(16, 18, 'cf moto', '250 nk', 2024, '345fvb'),
(17, 19, 'italika', '200z', 2021, '73bfm32'),
(18, 20, 'italika', '125z', 2021, '34frd2'),
(20, 22, 'honda', 'cb250', 2025, '73bfm32'),
(21, 23, 'suzuki', 'gsxr600', 2022, '23jhhj32'),
(22, 24, 'vento', 'hyper', 2019, '7348j'),
(23, 25, 'honda', 'cb250', 2021, '1234jf'),
(24, 26, 'honda', 'cb250', 2020, 'xxxxxx'),
(25, 27, 'suzuki', '125z', 2020, '23mmik4'),
(26, 28, 'bajaj', '250 nk', 2020, '1234jf'),
(27, 29, 'suzuki', 'cbrr', 2025, '34frd2'),
(28, 30, 'vento', '200z', 2020, '234532'),
(29, 31, 'italika', '200z', 2020, '23mmik4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_moto` (`id_moto`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `motos`
--
ALTER TABLE `motos`
  ADD PRIMARY KEY (`id_moto`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `motos`
--
ALTER TABLE `motos`
  MODIFY `id_moto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_moto`) REFERENCES `motos` (`id_moto`);

--
-- Filtros para la tabla `motos`
--
ALTER TABLE `motos`
  ADD CONSTRAINT `motos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
