-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2024 a las 20:18:43
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
-- Base de datos: `publicidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `contacto` varchar(255) DEFAULT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria` varchar(50) NOT NULL DEFAULT 'galeria'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `titulo`, `descripcion`, `archivo`, `contacto`, `fecha_subida`, `categoria`) VALUES
(1, 'ocre color azul ', 'este producto sirve para hacer de color axul tu piso \r\n', 'Captura.JPG', NULL, '2024-12-12 14:49:24', 'galeria'),
(2, 'rojo ', 'piso rojo ', 'Captura.PNG', NULL, '2024-12-12 15:15:27', 'galeria'),
(3, 'amarrillo ', 'oiso amarriloo\r\n', '46394eb7-896d-429c-9a52-fefa1efe60a1.jpg', NULL, '2024-12-12 15:16:17', 'galeria'),
(4, 'negro ', 'piso negro \r\n', 'Captura de pantalla (1).png', NULL, '2024-12-12 15:17:25', 'galeria'),
(5, 'blanco ', 'piso blanco ', 'Captura de pantalla (2).png', NULL, '2024-12-12 15:19:37', 'galeria'),
(6, 'ocre color azul ', '', 'Captura de pantalla (1).png', NULL, '2024-12-15 23:07:10', 'general'),
(7, 'ocre color azul ', '', 'Captura de pantalla (1).png', NULL, '2024-12-15 23:13:12', 'general'),
(8, 'ocre color azul ', '', 'Captura de pantalla (1).png', NULL, '2024-12-15 23:16:17', 'general'),
(10, 'rojo ', 'bolsa', 'Captura de pantalla (3).png', NULL, '2024-12-15 23:17:45', 'bolsitas'),
(11, 'bolsita ', 'piso azul ', '46394eb7-896d-429c-9a52-fefa1efe60a1.jpg', NULL, '2024-12-15 23:26:13', 'bolsas'),
(14, 'blanco ', 'bolsa', 'Captura.JPG', NULL, '2024-12-15 23:42:39', 'bolsas'),
(24, 'amarrillo ', 'oii', 'EscÃ¡ner_20211129.jpg', NULL, '2024-12-16 18:56:18', 'ocre'),
(27, 'ocre color azul ', 'fh', 'EscÃ¡ner_20211129.jpg', NULL, '2024-12-17 01:11:03', 'ocre'),
(31, 'ocre color azul ', 'fh', 'EscÃ¡ner_20211129.jpg', NULL, '2024-12-17 01:55:42', 'ocre');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
