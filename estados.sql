-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-04-2021 a las 13:46:55
-- Versión del servidor: 10.4.14-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u772532990_recad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'DISTRITO CAPITAL', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2, 'ANZOATEGUI', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(3, 'APURE', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(4, 'ARAGUA', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(5, 'BARINAS', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(6, 'BOLIVAR', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(7, 'CARABOBO', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(8, 'COJEDES', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(9, 'FALCON', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(10, 'GUARICO', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(11, 'LARA', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(12, 'MERIDA', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(13, 'MIRANDA', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(14, 'MONAGAS', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(15, 'NUEVA ESPARTA', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(16, 'PORTUGUESA', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(17, 'SUCRE', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(18, 'TACHIRA', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(19, 'TRUJILLO', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(20, 'YARACUY', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(21, 'ZULIA', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(22, 'AMAZONAS', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(23, 'DELTA AMACURO', '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(24, 'LA GUAIRA', '2020-04-20 01:55:55', '2020-04-20 01:55:55');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estados_descripcion_unique` (`descripcion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
