-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2017 a las 16:50:30
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `descripcion_categoria` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`, `date_added`) VALUES
(17, 'lacteos', 'productos 100% lacteos', '2017-11-13 21:16:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota` varchar(255) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id_historial`, `id_producto`, `user_id`, `fecha`, `nota`, `referencia`, `cantidad`) VALUES
(27, 8, 1, '2017-11-21 15:57:58', 'Bryan agregÃ³ 10 producto(s) al inventario', '123456', 10),
(28, 8, 1, '2017-11-21 16:02:11', 'Bryan agregÃ³ 100 producto(s) al inventario', 'SALIDA', 100),
(29, 8, 1, '2017-11-21 16:02:12', 'Bryan agregÃ³ 100 producto(s) al inventario', 'SALIDA', 100),
(30, 8, 1, '2017-11-21 16:02:43', 'Bryan agregÃ³ 20 producto(s) al inventario', '', 20),
(31, 8, 1, '2017-11-21 16:15:47', 'Bryan agregÃ³ 70 producto(s) al inventario', 'boleta', 70),
(32, 8, 1, '2017-11-21 16:22:43', 'Bryan eliminÃ³ 5 producto(s) del inventario', 'malo', 5),
(33, 8, 1, '2017-11-21 16:26:35', 'Bryan eliminÃ³ 5 producto(s) del inventario', 'malo', 5),
(34, 8, 1, '2017-11-21 16:26:49', 'Bryan eliminÃ³ 5 producto(s) del inventario', 'malo', 5),
(35, 8, 1, '2017-11-21 16:28:26', 'Bryan eliminÃ³ 10 producto(s) del inventario', 'dsadas', 10),
(36, 8, 1, '2017-11-21 16:34:02', 'Bryan eliminÃ³ 10 producto(s) del inventario', 'disahidosa', 10),
(37, 8, 1, '2017-11-21 16:35:20', 'Bryan eliminÃ³ 10 producto(s) del inventario', 'disahidosa', 10),
(38, 8, 1, '2017-11-21 16:35:55', 'Bryan agregÃ³ 5 producto(s) al inventario', 'entrada', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model`
--

CREATE TABLE `model` (
  `modelado` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id_producto` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id_producto`, `fecha`, `cantidad`, `precio`) VALUES
(5, '2017-11-21 15:44:04', 100, 300),
(7, '0000-00-00 00:00:00', 0, 0),
(8, '2017-11-21 15:57:58', 10, 100),
(8, '2017-11-21 16:02:11', 100, 20),
(8, '2017-11-21 16:02:12', 100, 20),
(8, '2017-11-21 16:02:43', 20, 20),
(8, '2017-11-21 16:15:47', 70, 100),
(8, '2017-11-21 16:35:55', 5, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_producto` int(11) NOT NULL,
  `codigo_producto` char(20) NOT NULL,
  `nombre_producto` char(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_producto` double NOT NULL,
  `stock` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_producto`, `codigo_producto`, `nombre_producto`, `date_added`, `precio_producto`, `stock`, `id_categoria`) VALUES
(8, '123456', 'Yogurt', '2017-11-21 15:57:58', 100, 300, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`) VALUES
(1, 'Bryan', 'Silva', 'admin', '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO', 'bryanalejandro132@gmail.com', '2016-12-19 15:06:00'),
(2, 'Esteban', 'Ellwanger', 'esteban', '$2y$10$bppOW8nxbeF3cRDYKMaJdunulnrSIGkKq0xc2KJ9mORWT1hM7bi7i', 'esteban.ellwanger@gmail.com', '2017-10-10 19:16:53'),
(3, 'Enrique', 'Cayupan', 'lilenrique', '$2y$10$TKpsHQSZ/8cVkOQNOPG6wO/d71cL4VkLAqd5lYbJFJGPdanuhbCHy', 'ecayupan2016@alu.uct.cl', '2017-10-10 19:33:26'),
(4, 'Matias', 'Millahual', 'mati', '$2y$10$TNTaJx7HeMKOCJvifuoRiO8aXXqAAKOs9iPvXZpoKJz1Xy4i0WqY6', 'mmillahual2015@alu.uct.cl', '2017-10-10 19:34:18'),
(5, 'alberto', 'caro', 'alberto', '$2y$10$4Y69rQRTznkF6mGIaMJtaOn1p/6KbIDHCm.p5Z9igl99TLcOegENW', '1234@gmail.com', '2017-10-10 20:15:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `codigo_producto` (`codigo_producto`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `fk_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
