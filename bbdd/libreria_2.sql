-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2020 a las 17:23:32
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nombre`, `descripcion`) VALUES
(1, 'Tecnología', 'Libros tecnológicos para construir vainas varias'),
(3, 'Ciencia Ficción', 'Libros para perderse en el espacio'),
(4, 'Novela romántica', 'Los romances más comentados de la prehistoria'),
(5, 'Mundo Antiguo', 'Civilizaciones mesozoicas y paleomesopotámicas'),
(6, 'Medicina', 'Libros de consulta médica para todo uso'),
(7, 'Ciencias', 'Compendio de libros científicos de todos los tiempos'),
(8, 'Zoología', 'Animales vertebrados, invertebrados y semivertebrados'),
(9, 'Botánica', 'Plantas verdes, amarillas, rojas, azules y negras'),
(10, 'Virología', 'Virus humanos y de ordenador'),
(11, 'Desarrollo Personal', 'Los fantásticos libros de desarrollo personal que impulsarán tu vida.'),
(13, 'Psicología', 'Libros con el mayor potencial de éxito personal.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `idlibro` int(11) NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `fechaalta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechamodi` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`idlibro`, `titulo`, `precio`, `stock`, `fechaalta`, `fechamodi`) VALUES
(6, 'El club de las 5 de la mañana', '19.90', 20, '2020-04-05 17:00:12', NULL),
(8, 'Psicología del Éxito', '31.26', 10, '2020-04-05 17:02:20', NULL),
(9, 'El Elemento', '10.40', 10, '2020-04-05 17:03:32', '2020-04-06 09:03:40'),
(10, 'Cómo ganar amigos e influir sobre las personas', '13.77', 10, '2020-04-05 17:06:36', NULL),
(12, 'Mentalidad de ganador', '15.50', 5, '2020-04-11 15:39:24', '2020-04-11 15:53:13'),
(13, 'El club de los luchadores', '10.05', 10, '2020-04-15 07:49:06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroscategorias`
--

CREATE TABLE `libroscategorias` (
  `idlibro` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libroscategorias`
--

INSERT INTO `libroscategorias` (`idlibro`, `idcategoria`) VALUES
(6, 11),
(8, 11),
(9, 9),
(9, 11),
(10, 11),
(12, 11),
(12, 13),
(13, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idpedido` int(11) NOT NULL,
  `pedido` varchar(80) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `importe` decimal(5,2) NOT NULL,
  `estado` varchar(120) NOT NULL,
  `fechaalta` datetime NOT NULL DEFAULT current_timestamp(),
  `libros` varchar(300) NOT NULL,
  `idusuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idpedido`, `pedido`, `nombre`, `importe`, `estado`, `fechaalta`, `libros`, `idusuario`) VALUES
(25, 'Pedido 4', 'Andy Bogard', '9.95', 'Preparando envío', '2020-05-30 16:33:37', 'El hombre más rico del planeta / La cura de la libertad.', NULL),
(26, 'Pedido 1', 'Alice Rambo', '9.95', 'Entregado', '2020-05-30 17:19:04', 'La hazaña del hombre perdido.', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoslibros`
--

CREATE TABLE `pedidoslibros` (
  `idpedido` int(11) DEFAULT NULL,
  `idlibro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nif` char(9) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellidos` varchar(120) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `cp` char(5) NOT NULL,
  `email` varchar(80) NOT NULL,
  `telefono` char(9) DEFAULT NULL,
  `fechaalta` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nif`, `nombre`, `apellidos`, `direccion`, `cp`, `email`, `telefono`, `fechaalta`) VALUES
(14, '22315678Q', 'Alice', 'Rambo', 'gran via', '08001', 'alice@mail.com', NULL, '2020-01-23 11:19:33'),
(17, '12399678Q', 'Josephine', 'Rambo', 'av. sylvester', '30002', '', NULL, '2020-01-23 11:26:12'),
(22, '79897877O', 'Maurice', 'Delacroix', 'gran via', '90888', 'maurice@mail.com', '111234455', '2020-01-23 12:00:06'),
(23, '79777877O', 'Peter', 'O\'toole', 'gran via 2', '90880', 'peters@mail.com', '33333333', '2020-01-23 12:05:48'),
(25, '33338833L', 'John', 'O\'Donnell', 'gran via', '08001', 'david@mail.com', '', '2020-01-24 11:45:39'),
(26, '33300000P', 'Doctor', 'Hell', 'cementerio, 666', '90001', 'maligno@mail.com', '', '2020-01-24 11:46:51'),
(27, '56564558U', 'Johny', 'Mentero', 'rue percebe, 13', '50777', 'johny@mail.com', '43334343', '2020-01-27 09:03:06'),
(29, '12345656K', 'Daisy', 'Rossemary', 'margeritti, 34', '98001', 'daisy@mail.com', '123122121', '2020-01-28 14:30:41');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`idlibro`);

--
-- Indices de la tabla `libroscategorias`
--
ALTER TABLE `libroscategorias`
  ADD PRIMARY KEY (`idlibro`,`idcategoria`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idpedido`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `pedidoslibros`
--
ALTER TABLE `pedidoslibros`
  ADD UNIQUE KEY `idpedido` (`idpedido`),
  ADD UNIQUE KEY `idlibro` (`idlibro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `idlibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libroscategorias`
--
ALTER TABLE `libroscategorias`
  ADD CONSTRAINT `libroscategorias_ibfk_1` FOREIGN KEY (`idlibro`) REFERENCES `libros` (`idlibro`) ON DELETE CASCADE,
  ADD CONSTRAINT `libroscategorias_ibfk_2` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `pedidoslibros`
--
ALTER TABLE `pedidoslibros`
  ADD CONSTRAINT `pedidoslibros_ibfk_1` FOREIGN KEY (`idpedido`) REFERENCES `pedidos` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidoslibros_ibfk_2` FOREIGN KEY (`idlibro`) REFERENCES `libros` (`idlibro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
