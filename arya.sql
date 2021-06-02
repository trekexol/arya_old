-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2021 a las 20:53:41
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `arya`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academiclevels`
--

CREATE TABLE `academiclevels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_one` int(11) NOT NULL,
  `code_two` int(11) NOT NULL,
  `code_three` int(11) NOT NULL,
  `code_four` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `balance_previus` decimal(15,2) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `accounts`
--

INSERT INTO `accounts` (`id`, `code_one`, `code_two`, `code_three`, `code_four`, `period`, `description`, `type`, `level`, `balance_previus`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 0, 2021, 'ACTIVO', 'Debe', 1, '110360000.00', '1', '2021-04-28 15:02:18', '2021-05-17 19:03:05'),
(2, 1, 1, 0, 0, 2021, 'CORRIENTE', 'Debe', 2, '110360000.00', '1', '2021-04-28 15:13:57', '2021-04-28 15:13:57'),
(3, 1, 1, 1, 0, 2021, 'Efectivo y Equivalente de Efectivo', 'Debe', 3, '-2000000.00', 'M', '2021-04-28 15:14:21', '2021-05-20 19:48:57'),
(4, 1, 1, 1, 1, 2021, 'Caja Chica', 'Debe', 4, '0.00', 'M', '2021-04-28 15:14:38', '2021-05-20 19:48:57'),
(5, 1, 1, 2, 0, 2021, 'Bancos', 'Debe', 3, '18960000.00', 'M', '2021-04-28 15:15:09', '2021-06-02 13:22:07'),
(6, 1, 1, 2, 1, 2021, 'Banco Banesco', 'Debe', 4, '30000000.00', 'M', '2021-04-28 15:15:25', '2021-05-24 13:33:32'),
(7, 1, 1, 2, 2, 2021, 'Punto de Venta prueba', 'Debe', 4, '60000.00', 'M', '2021-05-05 18:44:35', '2021-05-28 16:02:29'),
(8, 1, 1, 2, 3, 2021, 'Punto de Venta', 'Debe', 4, '12300000.00', 'M', '2021-05-05 18:46:20', '2021-05-24 13:33:32'),
(9, 6, 1, 5, 0, 2021, 'Gastos de Inventario', 'Debe', 3, '0.00', '1', '2021-05-13 17:06:40', '2021-05-13 17:06:40'),
(10, 6, 1, 5, 1, 2021, 'Gastos de ajuste de inventario', 'Debe', 4, '0.00', 'M', '2021-05-13 17:07:03', '2021-06-02 13:22:07'),
(11, 1, 1, 3, 0, 2021, 'Cuentas por Cobrar', 'Debe', 3, '0.00', '1', '2021-05-17 13:15:56', '2021-05-17 13:15:56'),
(12, 1, 1, 3, 1, 2021, 'Cuentas por Cobrar Clientes', 'Debe', 4, '0.00', 'M', '2021-05-17 13:17:02', '2021-05-24 13:33:32'),
(13, 4, 1, 1, 1, 2021, 'Ingresos por SubSegmento de Bienes', 'Debe', 4, '0.00', 'M', '2021-05-17 13:53:05', '2021-05-24 13:33:33'),
(14, 2, 1, 1, 4, 2021, 'Debito Fiscal IVA por Pagar', 'Debe', 4, '0.00', 'M', '2021-05-17 13:56:38', '2021-05-24 13:33:33'),
(15, 1, 1, 8, 1, 2021, 'Mercancia para la Venta', 'Debe', 4, '0.00', 'M', '2021-05-17 13:57:06', '2021-05-24 13:33:33'),
(16, 5, 1, 1, 1, 2021, 'Costo de Mercancia', 'Debe', 4, '0.00', 'M', '2021-05-17 13:57:31', '2021-05-24 13:33:33'),
(17, 1, 1, 1, 13, 2021, 'Sin determinar', 'Debe', 4, '0.00', 'M', '2021-05-20 13:47:10', '2021-05-28 16:45:59'),
(18, 1, 1, 6, 1, 2021, 'Anticipos a Proveedores Nacionales', 'Debe', 4, '0.00', 'M', '2021-05-20 15:18:02', '2021-05-28 15:34:07'),
(19, 1, 1, 1, 6, 2021, 'Tarjeta Corporativa', 'Debe', 4, '0.00', '1', '2021-05-20 16:08:32', '2021-05-20 16:09:04'),
(20, 2, 1, 4, 1, 2021, 'Cuentas por Pagar Proveedores', 'Debe', 4, '0.00', 'M', '2021-05-28 14:08:30', '2021-05-28 14:30:51'),
(21, 1, 1, 7, 1, 2021, 'IVA Credito Fiscal', 'Debe', 4, '0.00', 'M', '2021-05-28 15:17:17', '2021-05-28 16:42:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anticipos`
--

CREATE TABLE `anticipos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_client` bigint(20) UNSIGNED NOT NULL,
  `id_account` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `reference` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `anticipos`
--

INSERT INTO `anticipos` (`id`, `id_client`, `id_account`, `id_user`, `date`, `amount`, `reference`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 2, '2021-05-12', '50.00', '111', 'C', '2021-05-12 19:11:57', '2021-05-12 19:11:57'),
(3, 1, 7, 2, '2021-05-13', '60.00', '85', 'C', '2021-05-13 14:12:28', '2021-05-13 14:12:28'),
(4, 1, 4, 2, '2021-05-19', '500.00', '789', 'C', '2021-05-19 17:23:26', '2021-05-19 17:23:26'),
(5, 1, 7, 2, '2021-05-19', '400.00', '6262', 'C', '2021-05-19 17:55:50', '2021-05-19 17:55:50'),
(6, 2, 6, 2, '2021-05-19', '300.00', 'tyry', 'C', '2021-05-19 18:03:10', '2021-05-19 18:03:10'),
(7, 1, 6, 2, '2021-05-19', '1000.00', 'dewd', 'C', '2021-05-19 18:33:15', '2021-05-19 18:33:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bank_movements`
--

CREATE TABLE `bank_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_account` bigint(20) UNSIGNED NOT NULL,
  `id_counterpart` bigint(20) UNSIGNED NOT NULL,
  `id_client` bigint(20) UNSIGNED DEFAULT NULL,
  `id_vendor` bigint(20) UNSIGNED DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_movement` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `date` date NOT NULL,
  `reference` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bank_vouchers`
--

CREATE TABLE `bank_vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_client` bigint(20) UNSIGNED DEFAULT NULL,
  `id_vendor` bigint(20) UNSIGNED DEFAULT NULL,
  `id_provider` bigint(20) UNSIGNED DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_movement` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `reference` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bank_vouchers`
--

INSERT INTO `bank_vouchers` (`id`, `id_client`, `id_vendor`, `id_provider`, `id_user`, `description`, `type_movement`, `date`, `reference`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, 2, 'wewe', 'RE', '2021-05-31', NULL, '1', '2021-05-31 15:46:42', '2021-05-31 15:46:42'),
(2, NULL, NULL, 1, 2, 'gbfg', 'RE', '2021-05-31', NULL, '1', '2021-05-31 15:47:46', '2021-05-31 15:47:46'),
(3, 2, NULL, NULL, 2, 'tyutyu', 'RE', '2021-05-31', NULL, '1', '2021-05-31 15:59:19', '2021-05-31 15:59:19'),
(4, 1, NULL, NULL, 2, 'tuiuouo', 'RE', '2021-05-31', NULL, '1', '2021-05-31 16:01:09', '2021-05-31 16:01:09'),
(5, NULL, NULL, 1, 2, 'ipoop', 'RE', '2021-05-31', NULL, '1', '2021-05-31 16:02:48', '2021-05-31 16:02:48'),
(6, 1, NULL, NULL, 2, 'ghghg', 'RE', '2021-05-31', NULL, '1', '2021-05-31 16:44:40', '2021-05-31 16:44:40'),
(7, NULL, NULL, 1, 2, 'qweqwe', 'RE', '2021-05-31', NULL, '1', '2021-05-31 16:45:32', '2021-05-31 16:45:32'),
(8, 1, NULL, NULL, 2, 'qqqqq', 'RE', '2021-05-31', NULL, '1', '2021-05-31 16:47:35', '2021-05-31 16:47:35'),
(9, 2, NULL, NULL, 2, 'opop', 'RE', '2021-05-31', NULL, '1', '2021-05-31 16:48:41', '2021-05-31 16:48:41'),
(10, NULL, NULL, NULL, 2, 'sdfsdv', 'DE', '2021-05-31', NULL, '1', '2021-05-31 18:22:45', '2021-05-31 18:22:45'),
(11, NULL, NULL, NULL, 2, 'ghngh', 'DE', '2021-05-31', NULL, '1', '2021-05-31 18:23:38', '2021-05-31 18:23:38'),
(12, NULL, NULL, 1, 2, 'sdfsdf', 'RE', '2021-05-31', '454', '1', '2021-05-31 18:29:05', '2021-05-31 18:29:05'),
(13, NULL, NULL, 2, 2, 'plolplo', 'RE', '2021-05-31', NULL, '1', '2021-05-31 18:29:34', '2021-05-31 18:29:34'),
(14, NULL, NULL, NULL, 2, NULL, 'TR', '2021-05-31', '234234', '1', '2021-05-31 18:43:33', '2021-05-31 18:43:33'),
(15, NULL, NULL, NULL, 2, NULL, 'TR', '2021-05-31', '561', '1', '2021-05-31 18:44:17', '2021-05-31 18:44:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `parroquia_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_contact` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_contact` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observation` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `branches`
--

INSERT INTO `branches` (`id`, `company_id`, `parroquia_id`, `description`, `direction`, `phone`, `phone2`, `person_contact`, `phone_contact`, `observation`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 10111, 'asd', 'asdasd', '65151', '1651', 'sdfsd', '56156', 'sdfsdf', '1', '2021-04-09 14:24:25', '2021-04-09 14:24:25'),
(3, 1, 10102, 'www', 'wwww', '5151', '51515', 'wwoo', '5151', 'wwoo', '1', '2021-04-09 14:41:09', '2021-04-09 15:23:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_vendor` bigint(20) UNSIGNED DEFAULT NULL,
  `type_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula_rif` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `days_credit` int(11) NOT NULL,
  `amount_max_credit` decimal(12,2) DEFAULT NULL,
  `percentage_retencion_iva` decimal(6,2) DEFAULT NULL,
  `percentage_retencion_islr` decimal(6,2) DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `id_vendor`, `type_code`, `name`, `cedula_rif`, `direction`, `city`, `country`, `phone1`, `phone2`, `days_credit`, `amount_max_credit`, `percentage_retencion_iva`, `percentage_retencion_islr`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'J-', 'Carlos', '45645', 'asdsad', 'casd', 'Venezuela', '(123) 123-1231', NULL, 0, NULL, NULL, NULL, '1', '2021-05-11 18:41:26', '2021-05-11 18:41:26'),
(2, 2, 'J-', 'Manuel', '5616516', 'plaza', 'Caracas', 'Venezuela', '(132) 131-2321', '(123) 123-1232', 0, '1.00', '1.00', '1.00', '1', '2021-05-14 17:42:13', '2021-05-14 17:42:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `colors`
--

INSERT INTO `colors` (`id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Amarillo Claro', '1', '2021-04-14 15:52:37', '2021-04-14 15:52:51'),
(2, 'Azul', '1', '2021-04-14 15:52:43', '2021-04-14 15:52:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comision_types`
--

CREATE TABLE `comision_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comision_types`
--

INSERT INTO `comision_types` (`id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Comisión 3', '0', '2021-04-12 15:56:01', '2021-04-12 16:00:41'),
(2, 'Comisión 2', '1', '2021-04-12 15:56:07', '2021-04-12 15:56:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_rif` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `franqueo_postal` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_1` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tax_2` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tax_3` decimal(15,2) NOT NULL DEFAULT 0.00,
  `retention_islr` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tipoinv_id` bigint(20) UNSIGNED NOT NULL,
  `tiporate_id` bigint(20) UNSIGNED NOT NULL,
  `rate` decimal(64,2) NOT NULL,
  `rate_petro` decimal(64,2) NOT NULL,
  `foto_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `login`, `email`, `code_rif`, `razon_social`, `period`, `phone`, `address`, `franqueo_postal`, `tax_1`, `tax_2`, `tax_3`, `retention_islr`, `tipoinv_id`, `tiporate_id`, `rate`, `rate_petro`, `foto_company`, `status`, `created_at`, `updated_at`) VALUES
(1, 'trekexol', 'CEFREITAS.16@GMAIL.COM', '00354138-9', 'PATTERDAM', '2021', '04242041615', 'PLAZA VENEZUELA', '1010', '16.00', '0.00', '0.00', '0.00', 1, 1, '3115193.41', '9000000.00', 'default', '1', '2021-06-02 15:39:55', '2021-06-02 15:39:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detail_vouchers`
--

CREATE TABLE `detail_vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_account` bigint(20) UNSIGNED NOT NULL,
  `id_header_voucher` bigint(20) UNSIGNED DEFAULT NULL,
  `id_invoice` bigint(20) UNSIGNED DEFAULT NULL,
  `id_expense` bigint(20) UNSIGNED DEFAULT NULL,
  `id_bank_voucher` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `debe` decimal(16,2) NOT NULL,
  `haber` decimal(16,2) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detail_vouchers`
--

INSERT INTO `detail_vouchers` (`id`, `id_account`, `id_header_voucher`, `id_invoice`, `id_expense`, `id_bank_voucher`, `user_id`, `debe`, `haber`, `status`, `created_at`, `updated_at`) VALUES
(244, 6, 80, 31, NULL, NULL, 2, '1000.00', '0.00', 'C', '2021-05-24 13:33:32', '2021-05-24 13:33:32'),
(245, 4, 80, 31, NULL, NULL, 2, '1000.00', '0.00', 'C', '2021-05-24 13:33:32', '2021-05-24 13:33:32'),
(246, 4, 80, 31, NULL, NULL, 2, '1000.00', '0.00', 'C', '2021-05-24 13:33:32', '2021-05-24 13:33:32'),
(247, 8, 80, 31, NULL, NULL, 2, '686.40', '0.00', 'C', '2021-05-24 13:33:32', '2021-05-24 13:33:32'),
(248, 12, 80, 31, NULL, NULL, 2, '0.00', '4686.40', 'C', '2021-05-24 13:33:33', '2021-05-24 13:33:33'),
(249, 12, 81, 31, NULL, NULL, 2, '4686.40', '0.00', 'C', '2021-05-24 13:33:33', '2021-05-24 13:33:33'),
(250, 13, 81, 31, NULL, NULL, 2, '0.00', '4040.00', 'C', '2021-05-24 13:33:33', '2021-05-24 13:33:33'),
(251, 14, 81, 31, NULL, NULL, 2, '0.00', '646.40', 'C', '2021-05-24 13:33:33', '2021-05-24 13:33:33'),
(252, 15, 81, 31, NULL, NULL, 2, '0.00', '4040.00', 'C', '2021-05-24 13:33:33', '2021-05-24 13:33:33'),
(253, 16, 81, 31, NULL, NULL, 2, '4040.00', '0.00', 'C', '2021-05-24 13:33:33', '2021-05-24 13:33:33'),
(255, 4, 83, NULL, 7, NULL, 2, '2100.00', '0.00', 'C', '2021-05-28 14:00:19', '2021-05-28 14:00:19'),
(256, 4, 84, NULL, 7, NULL, 2, '2100.00', '0.00', 'C', '2021-05-28 14:01:31', '2021-05-28 14:01:31'),
(257, 12, 85, NULL, 7, NULL, 2, '2100.00', '0.00', 'C', '2021-05-28 14:01:31', '2021-05-28 14:01:31'),
(258, 13, 85, NULL, 7, NULL, 2, '0.00', '2100.00', 'C', '2021-05-28 14:01:31', '2021-05-28 14:01:31'),
(259, 15, 85, NULL, 7, NULL, 2, '0.00', '2100.00', 'C', '2021-05-28 14:01:31', '2021-05-28 14:01:31'),
(260, 16, 85, NULL, 7, NULL, 2, '2100.00', '0.00', 'C', '2021-05-28 14:01:31', '2021-05-28 14:01:31'),
(261, 8, 86, NULL, 8, NULL, 2, '1044.00', '0.00', 'C', '2021-05-28 14:30:51', '2021-05-28 14:30:51'),
(262, 20, 86, NULL, 8, NULL, 2, '0.00', '1044.00', 'C', '2021-05-28 14:30:51', '2021-05-28 14:30:51'),
(263, 18, 87, NULL, 9, NULL, 2, '1392.00', '0.00', 'C', '2021-05-28 15:34:07', '2021-05-28 15:34:07'),
(264, 14, 87, NULL, 9, NULL, 2, '192.00', '0.00', 'C', '2021-05-28 15:34:07', '2021-05-28 15:34:07'),
(265, 20, 87, NULL, 9, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 15:34:07', '2021-05-28 15:34:07'),
(266, 18, 88, NULL, 9, NULL, 2, '1392.00', '0.00', 'C', '2021-05-28 15:35:34', '2021-05-28 15:35:34'),
(267, 14, 88, NULL, 9, NULL, 2, '192.00', '0.00', 'C', '2021-05-28 15:35:34', '2021-05-28 15:35:34'),
(268, 20, 88, NULL, 9, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 15:35:34', '2021-05-28 15:35:34'),
(269, 18, 89, NULL, 9, NULL, 2, '1392.00', '0.00', 'C', '2021-05-28 15:35:54', '2021-05-28 15:35:54'),
(270, 14, 89, NULL, 9, NULL, 2, '192.00', '0.00', 'C', '2021-05-28 15:35:54', '2021-05-28 15:35:54'),
(271, 20, 89, NULL, 9, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 15:35:54', '2021-05-28 15:35:54'),
(272, 18, 90, NULL, 9, NULL, 2, '1392.00', '0.00', 'C', '2021-05-28 15:36:45', '2021-05-28 15:36:45'),
(273, 14, 90, NULL, 9, NULL, 2, '192.00', '0.00', 'C', '2021-05-28 15:36:45', '2021-05-28 15:36:45'),
(274, 20, 90, NULL, 9, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 15:36:45', '2021-05-28 15:36:45'),
(275, 18, 91, NULL, 9, NULL, 2, '1392.00', '0.00', 'C', '2021-05-28 15:37:13', '2021-05-28 15:37:13'),
(276, 14, 91, NULL, 9, NULL, 2, '192.00', '0.00', 'C', '2021-05-28 15:37:13', '2021-05-28 15:37:13'),
(277, 20, 91, NULL, 9, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 15:37:13', '2021-05-28 15:37:13'),
(278, 18, 92, NULL, 9, NULL, 2, '1392.00', '0.00', 'C', '2021-05-28 15:37:29', '2021-05-28 15:37:29'),
(279, 14, 92, NULL, 9, NULL, 2, '192.00', '0.00', 'C', '2021-05-28 15:37:29', '2021-05-28 15:37:29'),
(280, 20, 92, NULL, 9, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 15:37:29', '2021-05-28 15:37:29'),
(281, 18, 93, NULL, 9, NULL, 2, '1392.00', '0.00', 'C', '2021-05-28 15:37:48', '2021-05-28 15:37:48'),
(282, 14, 93, NULL, 9, NULL, 2, '192.00', '0.00', 'C', '2021-05-28 15:37:48', '2021-05-28 15:37:48'),
(283, 20, 93, NULL, 9, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 15:37:48', '2021-05-28 15:37:48'),
(284, 18, 94, NULL, 9, NULL, 2, '1392.00', '0.00', 'C', '2021-05-28 15:37:57', '2021-05-28 15:37:57'),
(285, 14, 94, NULL, 9, NULL, 2, '192.00', '0.00', 'C', '2021-05-28 15:37:57', '2021-05-28 15:37:57'),
(286, 20, 94, NULL, 9, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 15:37:57', '2021-05-28 15:37:57'),
(287, 18, 95, NULL, 9, NULL, 2, '1392.00', '0.00', 'C', '2021-05-28 15:38:38', '2021-05-28 15:38:38'),
(288, 14, 95, NULL, 9, NULL, 2, '192.00', '0.00', 'C', '2021-05-28 15:38:38', '2021-05-28 15:38:38'),
(289, 20, 95, NULL, 9, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 15:38:39', '2021-05-28 15:38:39'),
(290, 18, 96, NULL, 9, NULL, 2, '1392.00', '0.00', 'C', '2021-05-28 15:45:40', '2021-05-28 15:45:40'),
(291, 14, 96, NULL, 9, NULL, 2, '192.00', '0.00', 'C', '2021-05-28 15:45:40', '2021-05-28 15:45:40'),
(292, 20, 96, NULL, 9, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 15:45:40', '2021-05-28 15:45:40'),
(293, 7, 97, NULL, 10, NULL, 2, '2331.60', '0.00', 'C', '2021-05-28 16:02:29', '2021-05-28 16:02:29'),
(294, 14, 97, NULL, 10, NULL, 2, '321.60', '0.00', 'C', '2021-05-28 16:02:29', '2021-05-28 16:02:29'),
(295, 20, 97, NULL, 10, NULL, 2, '0.00', '2331.60', 'C', '2021-05-28 16:02:29', '2021-05-28 16:02:29'),
(296, 20, 98, NULL, 11, NULL, 2, '0.00', '696.00', 'C', '2021-05-28 16:38:14', '2021-05-28 16:38:14'),
(297, 18, 98, NULL, 11, NULL, 2, '696.00', '0.00', 'C', '2021-05-28 16:38:15', '2021-05-28 16:38:15'),
(298, 20, 99, NULL, 11, NULL, 2, '0.00', '696.00', 'C', '2021-05-28 16:39:03', '2021-05-28 16:39:03'),
(299, 18, 99, NULL, 11, NULL, 2, '696.00', '0.00', 'C', '2021-05-28 16:39:03', '2021-05-28 16:39:03'),
(300, 20, 100, NULL, 11, NULL, 2, '0.00', '696.00', 'C', '2021-05-28 16:39:43', '2021-05-28 16:39:43'),
(301, 18, 100, NULL, 11, NULL, 2, '696.00', '0.00', 'C', '2021-05-28 16:39:44', '2021-05-28 16:39:44'),
(302, 20, 101, NULL, 11, NULL, 2, '0.00', '696.00', 'C', '2021-05-28 16:40:26', '2021-05-28 16:40:26'),
(303, 18, 101, NULL, 11, NULL, 2, '696.00', '0.00', 'C', '2021-05-28 16:40:26', '2021-05-28 16:40:26'),
(304, 20, 101, NULL, 11, NULL, 2, '0.00', '696.00', 'C', '2021-05-28 16:40:26', '2021-05-28 16:40:26'),
(305, 20, 102, NULL, 12, NULL, 2, '0.00', '1931.40', 'C', '2021-05-28 16:42:45', '2021-05-28 16:42:45'),
(306, 4, 102, NULL, 12, NULL, 2, '1931.40', '0.00', 'C', '2021-05-28 16:42:45', '2021-05-28 16:42:45'),
(307, 21, 102, NULL, 12, NULL, 2, '266.40', '0.00', 'C', '2021-05-28 16:42:45', '2021-05-28 16:42:45'),
(308, 20, 102, NULL, 12, NULL, 2, '0.00', '1931.40', 'C', '2021-05-28 16:42:45', '2021-05-28 16:42:45'),
(309, 20, 103, NULL, 13, NULL, 2, '1044.00', '0.00', 'C', '2021-05-28 16:45:59', '2021-05-28 16:45:59'),
(310, 17, 103, NULL, 13, NULL, 2, '0.00', '0.00', 'C', '2021-05-28 16:45:59', '2021-05-28 16:45:59'),
(311, 21, 103, NULL, 13, NULL, 2, '144.00', '0.00', 'C', '2021-05-28 16:45:59', '2021-05-28 16:45:59'),
(312, 20, 103, NULL, 13, NULL, 2, '0.00', '1044.00', 'C', '2021-05-28 16:45:59', '2021-05-28 16:45:59'),
(313, 20, 104, NULL, 14, NULL, 2, '1392.00', '0.00', 'C', '2021-05-28 16:52:17', '2021-05-28 16:52:17'),
(314, 17, 104, NULL, 14, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 16:52:17', '2021-05-28 16:52:17'),
(315, 15, 104, NULL, 14, NULL, 2, '1200.00', '0.00', 'C', '2021-05-28 16:52:17', '2021-05-28 16:52:17'),
(316, 21, 104, NULL, 14, NULL, 2, '192.00', '0.00', 'C', '2021-05-28 16:52:17', '2021-05-28 16:52:17'),
(317, 20, 104, NULL, 14, NULL, 2, '0.00', '1392.00', 'C', '2021-05-28 16:52:17', '2021-05-28 16:52:17'),
(318, 20, 105, NULL, 15, NULL, 2, '1740.00', '0.00', 'C', '2021-05-28 16:55:01', '2021-05-28 16:55:01'),
(319, 6, 105, NULL, 15, NULL, 2, '0.00', '1740.00', 'C', '2021-05-28 16:55:01', '2021-05-28 16:55:01'),
(320, 15, 106, NULL, 15, NULL, 2, '1500.00', '0.00', 'C', '2021-05-28 16:55:01', '2021-05-28 16:55:01'),
(321, 21, 106, NULL, 15, NULL, 2, '240.00', '0.00', 'C', '2021-05-28 16:55:01', '2021-05-28 16:55:01'),
(322, 20, 106, NULL, 15, NULL, 2, '0.00', '1740.00', 'C', '2021-05-28 16:55:01', '2021-05-28 16:55:01'),
(323, 20, 107, NULL, 16, NULL, 2, '3219.00', '0.00', 'C', '2021-05-28 16:58:39', '2021-05-28 16:58:39'),
(324, 4, 107, NULL, 16, NULL, 2, '0.00', '3000.00', 'C', '2021-05-28 16:58:39', '2021-05-28 16:58:39'),
(325, 6, 107, NULL, 16, NULL, 2, '0.00', '219.00', 'C', '2021-05-28 16:58:39', '2021-05-28 16:58:39'),
(326, 15, 108, NULL, 16, NULL, 2, '2775.00', '0.00', 'C', '2021-05-28 16:58:39', '2021-05-28 16:58:39'),
(327, 21, 108, NULL, 16, NULL, 2, '444.00', '0.00', 'C', '2021-05-28 16:58:39', '2021-05-28 16:58:39'),
(328, 20, 108, NULL, 16, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 16:58:39', '2021-05-28 16:58:39'),
(329, 20, 109, NULL, 17, NULL, 2, '3360.00', '0.00', 'C', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(330, 8, 109, NULL, 17, NULL, 2, '0.00', '1000.00', 'C', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(331, 4, 109, NULL, 17, NULL, 2, '0.00', '1000.00', 'C', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(332, 7, 109, NULL, 17, NULL, 2, '0.00', '1360.00', 'C', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(333, 15, 110, NULL, 17, NULL, 2, '3000.00', '0.00', 'C', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(334, 21, 110, NULL, 17, NULL, 2, '360.00', '0.00', 'C', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(335, 20, 110, NULL, 17, NULL, 2, '0.00', '3360.00', 'C', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(336, 20, 111, NULL, 18, NULL, 2, '3480.00', '0.00', 'C', '2021-05-28 17:44:08', '2021-05-28 17:44:08'),
(337, 7, 111, NULL, 18, NULL, 2, '0.00', '3480.00', 'C', '2021-05-28 17:44:08', '2021-05-28 17:44:08'),
(338, 15, 112, NULL, 18, NULL, 2, '3000.00', '0.00', 'C', '2021-05-28 17:44:08', '2021-05-28 17:44:08'),
(339, 21, 112, NULL, 18, NULL, 2, '480.00', '0.00', 'C', '2021-05-28 17:44:08', '2021-05-28 17:44:08'),
(340, 20, 112, NULL, 18, NULL, 2, '0.00', '3480.00', 'C', '2021-05-28 17:44:08', '2021-05-28 17:44:08'),
(341, 20, 113, NULL, 19, NULL, 2, '3219.00', '0.00', 'C', '2021-05-28 17:46:10', '2021-05-28 17:46:10'),
(342, 18, 113, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:46:11', '2021-05-28 17:46:11'),
(343, 15, 114, NULL, 19, NULL, 2, '2775.00', '0.00', 'C', '2021-05-28 17:46:11', '2021-05-28 17:46:11'),
(344, 21, 114, NULL, 19, NULL, 2, '444.00', '0.00', 'C', '2021-05-28 17:46:11', '2021-05-28 17:46:11'),
(345, 20, 114, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:46:11', '2021-05-28 17:46:11'),
(346, 20, 115, NULL, 19, NULL, 2, '3219.00', '0.00', 'C', '2021-05-28 17:46:20', '2021-05-28 17:46:20'),
(347, 18, 115, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:46:21', '2021-05-28 17:46:21'),
(348, 15, 116, NULL, 19, NULL, 2, '2775.00', '0.00', 'C', '2021-05-28 17:46:21', '2021-05-28 17:46:21'),
(349, 21, 116, NULL, 19, NULL, 2, '444.00', '0.00', 'C', '2021-05-28 17:46:21', '2021-05-28 17:46:21'),
(350, 20, 116, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:46:21', '2021-05-28 17:46:21'),
(351, 20, 117, NULL, 19, NULL, 2, '3219.00', '0.00', 'C', '2021-05-28 17:46:46', '2021-05-28 17:46:46'),
(352, 18, 117, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:46:46', '2021-05-28 17:46:46'),
(353, 15, 118, NULL, 19, NULL, 2, '2775.00', '0.00', 'C', '2021-05-28 17:46:46', '2021-05-28 17:46:46'),
(354, 21, 118, NULL, 19, NULL, 2, '444.00', '0.00', 'C', '2021-05-28 17:46:46', '2021-05-28 17:46:46'),
(355, 20, 118, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:46:46', '2021-05-28 17:46:46'),
(356, 20, 119, NULL, 19, NULL, 2, '3219.00', '0.00', 'C', '2021-05-28 17:50:29', '2021-05-28 17:50:29'),
(357, 18, 119, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:50:29', '2021-05-28 17:50:29'),
(358, 15, 120, NULL, 19, NULL, 2, '2775.00', '0.00', 'C', '2021-05-28 17:50:29', '2021-05-28 17:50:29'),
(359, 21, 120, NULL, 19, NULL, 2, '444.00', '0.00', 'C', '2021-05-28 17:50:29', '2021-05-28 17:50:29'),
(360, 20, 120, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:50:29', '2021-05-28 17:50:29'),
(361, 20, 121, NULL, 19, NULL, 2, '3219.00', '0.00', 'C', '2021-05-28 17:51:13', '2021-05-28 17:51:13'),
(362, 18, 121, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:51:13', '2021-05-28 17:51:13'),
(363, 15, 122, NULL, 19, NULL, 2, '2775.00', '0.00', 'C', '2021-05-28 17:51:13', '2021-05-28 17:51:13'),
(364, 21, 122, NULL, 19, NULL, 2, '444.00', '0.00', 'C', '2021-05-28 17:51:13', '2021-05-28 17:51:13'),
(365, 20, 122, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:51:13', '2021-05-28 17:51:13'),
(366, 20, 123, NULL, 19, NULL, 2, '3219.00', '0.00', 'C', '2021-05-28 17:51:45', '2021-05-28 17:51:45'),
(367, 18, 123, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:51:45', '2021-05-28 17:51:45'),
(368, 15, 124, NULL, 19, NULL, 2, '2775.00', '0.00', 'C', '2021-05-28 17:51:45', '2021-05-28 17:51:45'),
(369, 21, 124, NULL, 19, NULL, 2, '444.00', '0.00', 'C', '2021-05-28 17:51:45', '2021-05-28 17:51:45'),
(370, 20, 124, NULL, 19, NULL, 2, '0.00', '3219.00', 'C', '2021-05-28 17:51:45', '2021-05-28 17:51:45'),
(371, 20, 125, NULL, 20, NULL, 2, '2448.00', '0.00', 'C', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(372, 18, 125, NULL, 20, NULL, 2, '0.00', '1000.00', 'C', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(373, 6, 125, NULL, 20, NULL, 2, '0.00', '1000.00', 'C', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(374, 17, 125, NULL, 20, NULL, 2, '0.00', '448.00', 'C', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(375, 15, 126, NULL, 20, NULL, 2, '2160.00', '0.00', 'C', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(376, 21, 126, NULL, 20, NULL, 2, '288.00', '0.00', 'C', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(377, 20, 126, NULL, 20, NULL, 2, '0.00', '2448.00', 'C', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(378, 20, 127, NULL, 4, NULL, 2, '6456.40', '0.00', 'C', '2021-05-28 18:26:10', '2021-05-28 18:26:10'),
(379, 6, 127, NULL, 4, NULL, 2, '0.00', '6456.40', 'C', '2021-05-28 18:26:10', '2021-05-28 18:26:10'),
(380, 15, 128, NULL, 4, NULL, 2, '5690.00', '0.00', 'C', '2021-05-28 18:26:10', '2021-05-28 18:26:10'),
(381, 21, 128, NULL, 4, NULL, 2, '766.40', '0.00', 'C', '2021-05-28 18:26:10', '2021-05-28 18:26:10'),
(382, 20, 128, NULL, 4, NULL, 2, '0.00', '6456.40', 'C', '2021-05-28 18:26:10', '2021-05-28 18:26:10'),
(383, 20, 129, NULL, 3, NULL, 2, '931.48', '0.00', 'C', '2021-05-28 18:37:26', '2021-05-28 18:37:26'),
(384, 4, 129, NULL, 3, NULL, 2, '0.00', '931.48', 'C', '2021-05-28 18:37:26', '2021-05-28 18:37:26'),
(385, 15, 130, NULL, 3, NULL, 2, '803.00', '0.00', 'C', '2021-05-28 18:37:27', '2021-05-28 18:37:27'),
(386, 21, 130, NULL, 3, NULL, 2, '128.48', '0.00', 'C', '2021-05-28 18:37:27', '2021-05-28 18:37:27'),
(387, 20, 130, NULL, 3, NULL, 2, '0.00', '931.48', 'C', '2021-05-28 18:37:27', '2021-05-28 18:37:27'),
(388, 15, 131, NULL, 21, NULL, 2, '2220.00', '0.00', 'C', '2021-05-28 19:21:47', '2021-05-28 19:21:47'),
(389, 21, 131, NULL, 21, NULL, 2, '355.20', '0.00', 'C', '2021-05-28 19:21:47', '2021-05-28 19:21:47'),
(390, 20, 131, NULL, 21, NULL, 2, '0.00', '2575.20', 'C', '2021-05-28 19:21:47', '2021-05-28 19:21:47'),
(391, 20, 132, NULL, 21, NULL, 2, '2575.20', '0.00', 'C', '2021-05-28 19:23:14', '2021-05-28 19:23:14'),
(392, 4, 132, NULL, 21, NULL, 2, '0.00', '2575.20', 'C', '2021-05-28 19:23:14', '2021-05-28 19:23:14'),
(393, 12, 133, 33, NULL, NULL, 2, '928.00', '0.00', 'C', '2021-05-28 19:49:40', '2021-05-28 19:49:40'),
(394, 13, 133, 33, NULL, NULL, 2, '0.00', '800.00', 'C', '2021-05-28 19:49:40', '2021-05-28 19:49:40'),
(395, 14, 133, 33, NULL, NULL, 2, '0.00', '128.00', 'C', '2021-05-28 19:49:40', '2021-05-28 19:49:40'),
(396, 15, 133, 33, NULL, NULL, 2, '0.00', '800.00', 'C', '2021-05-28 19:49:40', '2021-05-28 19:49:40'),
(397, 16, 133, 33, NULL, NULL, 2, '800.00', '0.00', 'C', '2021-05-28 19:49:41', '2021-05-28 19:49:41'),
(398, 4, 134, 33, NULL, NULL, 2, '928.00', '0.00', 'C', '2021-05-28 19:53:35', '2021-05-28 19:53:35'),
(399, 12, 134, 33, NULL, NULL, 2, '0.00', '928.00', 'C', '2021-05-28 19:53:35', '2021-05-28 19:53:35'),
(400, 4, 135, 33, NULL, NULL, 2, '928.00', '0.00', 'C', '2021-05-28 19:54:37', '2021-05-28 19:54:37'),
(401, 12, 135, 33, NULL, NULL, 2, '0.00', '928.00', 'C', '2021-05-28 19:54:37', '2021-05-28 19:54:37'),
(402, 12, 136, 30, NULL, NULL, 2, '1110.00', '0.00', 'C', '2021-05-28 19:55:03', '2021-05-28 19:55:03'),
(403, 13, 136, 30, NULL, NULL, 2, '0.00', '1110.00', 'C', '2021-05-28 19:55:03', '2021-05-28 19:55:03'),
(404, 15, 136, 30, NULL, NULL, 2, '0.00', '1110.00', 'C', '2021-05-28 19:55:03', '2021-05-28 19:55:03'),
(405, 16, 136, 30, NULL, NULL, 2, '1110.00', '0.00', 'C', '2021-05-28 19:55:03', '2021-05-28 19:55:03'),
(406, 4, 137, 30, NULL, NULL, 2, '1110.00', '0.00', 'C', '2021-05-28 19:55:40', '2021-05-28 19:55:40'),
(407, 12, 137, 30, NULL, NULL, 2, '0.00', '1110.00', 'C', '2021-05-28 19:55:40', '2021-05-28 19:55:40'),
(408, 4, NULL, NULL, NULL, 4, 2, '0.00', '450.00', 'C', '2021-05-31 16:01:09', '2021-05-31 16:01:09'),
(409, 6, NULL, NULL, NULL, 4, 2, '450.00', '0.00', 'C', '2021-05-31 16:01:09', '2021-05-31 16:01:09'),
(410, 4, NULL, NULL, NULL, 5, 2, '0.00', '500.00', 'C', '2021-05-31 16:02:48', '2021-05-31 16:02:48'),
(411, 6, NULL, NULL, NULL, 5, 2, '500.00', '0.00', 'C', '2021-05-31 16:02:48', '2021-05-31 16:02:48'),
(412, 8, NULL, NULL, NULL, 6, 2, '0.00', '200.00', 'C', '2021-05-31 16:44:40', '2021-05-31 16:44:40'),
(413, 4, NULL, NULL, NULL, 6, 2, '200.00', '0.00', 'C', '2021-05-31 16:44:40', '2021-05-31 16:44:40'),
(414, 8, NULL, NULL, NULL, 7, 2, '0.00', '300.00', 'C', '2021-05-31 16:45:32', '2021-05-31 16:45:32'),
(415, 4, NULL, NULL, NULL, 7, 2, '300.00', '0.00', 'C', '2021-05-31 16:45:32', '2021-05-31 16:45:32'),
(416, 4, NULL, NULL, NULL, 8, 2, '0.00', '400.00', 'C', '2021-05-31 16:47:35', '2021-05-31 16:47:35'),
(417, 8, NULL, NULL, NULL, 8, 2, '400.00', '0.00', 'C', '2021-05-31 16:47:35', '2021-05-31 16:47:35'),
(418, 8, NULL, NULL, NULL, 9, 2, '0.00', '1000.00', 'C', '2021-05-31 16:48:41', '2021-05-31 16:48:41'),
(419, 4, NULL, NULL, NULL, 9, 2, '1000.00', '0.00', 'C', '2021-05-31 16:48:41', '2021-05-31 16:48:41'),
(420, 6, NULL, NULL, NULL, 10, 2, '0.00', '2000.00', 'C', '2021-05-31 18:22:45', '2021-05-31 18:22:45'),
(421, 4, NULL, NULL, NULL, 10, 2, '2000.00', '0.00', 'C', '2021-05-31 18:22:45', '2021-05-31 18:22:45'),
(422, 7, NULL, NULL, NULL, 11, 2, '0.00', '7000.00', 'C', '2021-05-31 18:23:38', '2021-05-31 18:23:38'),
(423, 4, NULL, NULL, NULL, 11, 2, '7000.00', '0.00', 'C', '2021-05-31 18:23:38', '2021-05-31 18:23:38'),
(424, 4, NULL, NULL, NULL, 12, 2, '0.00', '2000.00', 'C', '2021-05-31 18:29:05', '2021-05-31 18:29:05'),
(425, 6, NULL, NULL, NULL, 12, 2, '2000.00', '0.00', 'C', '2021-05-31 18:29:05', '2021-05-31 18:29:05'),
(426, 4, NULL, NULL, NULL, 13, 2, '0.00', '3000.00', 'C', '2021-05-31 18:29:34', '2021-05-31 18:29:34'),
(427, 6, NULL, NULL, NULL, 13, 2, '3000.00', '0.00', 'C', '2021-05-31 18:29:34', '2021-05-31 18:29:34'),
(428, 4, NULL, NULL, NULL, 14, 2, '0.00', '1000.00', 'C', '2021-05-31 18:43:33', '2021-05-31 18:43:33'),
(429, 6, NULL, NULL, NULL, 14, 2, '1000.00', '0.00', 'C', '2021-05-31 18:43:33', '2021-05-31 18:43:33'),
(430, 4, NULL, NULL, NULL, 15, 2, '0.00', '6000.00', 'C', '2021-05-31 18:44:17', '2021-05-31 18:44:17'),
(431, 6, NULL, NULL, NULL, 15, 2, '6000.00', '0.00', 'C', '2021-05-31 18:44:17', '2021-05-31 18:44:17'),
(432, 5, 79, NULL, NULL, NULL, 2, '600.00', '0.00', 'C', '2021-06-02 12:48:45', '2021-06-02 12:48:45'),
(433, 7, 79, NULL, NULL, NULL, 2, '0.00', '600.00', 'C', '2021-06-02 12:50:59', '2021-06-02 12:50:59'),
(434, 10, 79, NULL, NULL, NULL, 2, '960.00', '0.00', 'C', '2021-06-02 13:21:47', '2021-06-02 13:21:47'),
(435, 10, 79, NULL, NULL, NULL, 2, '0.00', '960.00', 'C', '2021-06-02 13:22:02', '2021-06-02 13:22:02'),
(436, 15, 138, NULL, 22, NULL, 2, '2220.00', '0.00', 'C', '2021-06-02 14:07:05', '2021-06-02 14:07:05'),
(437, 21, 138, NULL, 22, NULL, 2, '355.20', '0.00', 'C', '2021-06-02 14:07:05', '2021-06-02 14:07:05'),
(438, 20, 138, NULL, 22, NULL, 2, '0.00', '2575.20', 'C', '2021-06-02 14:07:05', '2021-06-02 14:07:05'),
(439, 12, 139, 35, NULL, NULL, 2, '1110.00', '0.00', 'C', '2021-06-02 14:33:27', '2021-06-02 14:33:27'),
(440, 13, 139, 35, NULL, NULL, 2, '0.00', '1110.00', 'C', '2021-06-02 14:33:27', '2021-06-02 14:33:27'),
(441, 15, 139, 35, NULL, NULL, 2, '0.00', '1110.00', 'C', '2021-06-02 14:33:27', '2021-06-02 14:33:27'),
(442, 16, 139, 35, NULL, NULL, 2, '1110.00', '0.00', 'C', '2021-06-02 14:33:27', '2021-06-02 14:33:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `salary_types_id` bigint(20) UNSIGNED NOT NULL,
  `profession_id` bigint(20) UNSIGNED NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `municipio_id` bigint(20) UNSIGNED NOT NULL,
  `parroquia_id` bigint(20) UNSIGNED NOT NULL,
  `id_empleado` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `apellidos` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_egreso` date DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto_pago` double(64,2) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acumulado_prestaciones` double(64,2) NOT NULL,
  `acumulado_utilidades` double(64,2) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code_employee` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_utilities` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `position_id`, `salary_types_id`, `profession_id`, `estado_id`, `municipio_id`, `parroquia_id`, `id_empleado`, `branch_id`, `apellidos`, `nombres`, `fecha_ingreso`, `fecha_egreso`, `fecha_nacimiento`, `direccion`, `monto_pago`, `email`, `telefono1`, `acumulado_prestaciones`, `acumulado_utilidades`, `status`, `created_at`, `updated_at`, `code_employee`, `amount_utilities`) VALUES
(2, 1, 1, 1, 6, 601, 60104, '5464', NULL, 'asd', 'Carlos', '2021-04-14', NULL, '2021-04-18', 'aaaa', 11.00, 'dscds@asds.com', '6484', 16.00, 1651.00, '1', '2021-04-14 19:01:09', '2021-04-14 19:06:48', '777', 'Mi'),
(3, 1, 1, 2, 1, 101, 10116, 'V-11.212.322', NULL, 'prueba', 'prueba', '2021-05-03', NULL, '1983-06-08', 'plaza', 400.00, 'aaaa@aaaa.com', '06561561', 1.00, 80.00, '1', '2021-05-03 15:57:40', '2021-05-03 15:57:40', '23', 'Ma'),
(4, 1, 1, 1, 1, 101, 10104, 'V56151', NULL, 'asd', 'asd', '2021-05-03', NULL, '2021-05-07', 'Caracas', 6262.00, 'aa11aa@aaaa.com', '62662', 1.00, 1.00, '1', '2021-05-03 16:45:10', '2021-05-03 16:45:10', '1313', 'Ma'),
(5, 1, 1, 1, 1, 101, 10116, '84.407.589', 2, 'Freitas', 'Carlos', '2021-06-02', NULL, '1997-09-09', 'PLAZA VENEZUELA', 1561515.00, 'cefreitas.16@gmail.com', '0424 204-1615', 151561.56, 6516.51, '1', '2021-06-02 14:00:58', '2021-06-02 14:00:58', 'AF77', 'Ma');

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
(1, 'DISTRITO CAPITAL', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2, 'ANZOATEGUI', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(3, 'APURE', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(4, 'ARAGUA', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(5, 'BARINAS', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(6, 'BOLIVAR', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(7, 'CARABOBO', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(8, 'COJEDES', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(9, 'FALCON', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10, 'GUARICO', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(11, 'LARA', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(12, 'MERIDA', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(13, 'MIRANDA', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(14, 'MONAGAS', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(15, 'NUEVA ESPARTA', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(16, 'PORTUGUESA', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(17, 'SUCRE', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(18, 'TACHIRA', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(19, 'TRUJILLO', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20, 'YARACUY', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21, 'ZULIA', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(22, 'AMAZONAS', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(23, 'DELTA AMACURO', '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(24, 'LA GUAIRA', '2020-04-20 05:55:55', '2020-04-20 05:55:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses_and_purchases`
--

CREATE TABLE `expenses_and_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_provider` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `date_payment` date DEFAULT NULL,
  `anticipo` decimal(16,2) DEFAULT NULL,
  `iva_percentage` int(11) DEFAULT NULL,
  `credit_days` int(11) DEFAULT NULL,
  `base_imponible` decimal(32,2) DEFAULT NULL,
  `amount` decimal(32,2) DEFAULT NULL,
  `amount_iva` decimal(32,2) DEFAULT NULL,
  `amount_with_iva` decimal(32,2) DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `expenses_and_purchases`
--

INSERT INTO `expenses_and_purchases` (`id`, `id_provider`, `id_user`, `invoice`, `serie`, `observation`, `date`, `date_payment`, `anticipo`, `iva_percentage`, `credit_days`, `base_imponible`, `amount`, `amount_iva`, `amount_with_iva`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 'aaa', NULL, NULL, '2021-05-24', NULL, NULL, 16, NULL, '28249.00', '28919.00', '4519.84', '33438.84', '1', '2021-05-24 16:15:05', '2021-05-25 19:53:54'),
(3, 2, 2, NULL, NULL, NULL, '2021-05-25', '2021-05-28', '0.00', 16, NULL, '80300.00', '803.00', '128.48', '931.48', 'C', '2021-05-25 13:26:48', '2021-05-28 18:37:27'),
(4, 1, 2, NULL, NULL, NULL, '2021-05-25', '2021-05-28', '0.00', 16, NULL, '479000.00', '5690.00', '766.40', '6456.40', 'C', '2021-05-25 15:27:11', '2021-05-28 18:26:10'),
(5, 1, 2, '1414', '1515', NULL, '2021-05-26', NULL, NULL, 16, 4, '1650.00', '2250.00', '264.00', '2514.00', '1', '2021-05-26 16:41:11', '2021-05-26 18:51:51'),
(6, 1, 2, '1555', '15151515', 'azulado', '2021-05-27', NULL, NULL, 16, 7, '1344.00', '1344.00', '215.04', '1559.04', '1', '2021-05-27 18:06:39', '2021-05-27 18:09:28'),
(7, 1, 2, '999', '99999', 'excelente', '2021-05-27', '2021-05-28', '0.00', 16, NULL, '0.00', '2100.00', '0.00', '2100.00', 'C', '2021-05-27 19:25:06', '2021-05-28 14:01:31'),
(8, 2, 2, '1111', '1111', '1111', '2021-05-28', '2021-05-28', '0.00', 16, NULL, '90000.00', '900.00', '144.00', '1044.00', 'C', '2021-05-28 14:14:27', '2021-05-28 14:30:51'),
(9, 2, 2, '3333', '3333', '3333', '2021-05-28', '2021-05-28', '0.00', 16, NULL, '120000.00', '1200.00', '192.00', '1392.00', 'C', '2021-05-28 15:18:38', '2021-05-28 15:45:40'),
(10, 1, 2, '4444', '4444', '4444', '2021-05-28', '2021-05-28', '0.00', 16, NULL, '201000.00', '2010.00', '321.60', '2331.60', 'C', '2021-05-28 15:46:22', '2021-05-28 16:02:29'),
(11, 2, 2, '5555', '5555', '5555', '2021-05-28', '2021-05-28', '0.00', 16, NULL, '60000.00', '600.00', '96.00', '696.00', 'C', '2021-05-28 16:37:33', '2021-05-28 16:40:26'),
(12, 1, 2, '6666', '6666', '6666', '2021-05-28', '2021-05-28', '0.00', 16, NULL, '166500.00', '1665.00', '266.40', '1931.40', 'C', '2021-05-28 16:42:13', '2021-05-28 16:42:46'),
(13, 1, 2, '7777', '7777', '7777', '2021-05-28', '2021-05-28', '0.00', 16, NULL, '90000.00', '900.00', '144.00', '1044.00', 'C', '2021-05-28 16:45:24', '2021-05-28 16:45:59'),
(14, 2, 2, '8585', '8585', '8585', '2021-05-28', '2021-05-28', '0.00', 16, NULL, '120000.00', '1200.00', '192.00', '1392.00', 'C', '2021-05-28 16:51:48', '2021-05-28 16:52:17'),
(15, 2, 2, '99', '99', '99', '2021-05-28', '2021-05-28', '0.00', 16, NULL, '150000.00', '1500.00', '240.00', '1740.00', 'C', '2021-05-28 16:54:30', '2021-05-28 16:55:01'),
(16, 1, 2, '1212', '1212', '1212', '2021-05-28', '2021-05-28', '0.00', 16, NULL, '277500.00', '2775.00', '444.00', '3219.00', 'C', '2021-05-28 16:57:36', '2021-05-28 16:58:39'),
(17, 2, 2, '25', '25', '25', '2021-05-28', '2021-05-28', '0.00', 12, NULL, '300000.00', '3000.00', '360.00', '3360.00', 'C', '2021-05-28 17:39:13', '2021-05-28 17:42:15'),
(18, 2, 2, '34324', '23423', '23423', '2021-05-28', '2021-05-28', '0.00', 16, NULL, '300000.00', '3000.00', '480.00', '3480.00', 'C', '2021-05-28 17:43:37', '2021-05-28 17:44:08'),
(19, 2, 2, '8585', '8585', '8585', '2021-05-28', '2021-05-28', '0.00', 16, NULL, '277500.00', '2775.00', '444.00', '3219.00', 'C', '2021-05-28 17:45:47', '2021-05-28 17:51:45'),
(20, 1, 2, '2929', '2828', NULL, '2021-05-28', '2021-05-28', '0.00', 16, NULL, '180000.00', '2160.00', '288.00', '2448.00', 'C', '2021-05-28 18:00:28', '2021-05-28 18:03:35'),
(21, 2, 2, '4242', '434', NULL, '2021-05-28', '2021-05-28', '0.00', 16, 7, '222000.00', '2220.00', '355.20', '2575.20', 'C', '2021-05-28 19:06:52', '2021-05-28 19:23:14'),
(22, 1, 2, '962', '5161', NULL, '2021-06-02', NULL, NULL, 16, 6, '2220.00', '2220.00', '355.20', '2575.20', '1', '2021-06-02 14:05:21', '2021-06-02 14:07:05'),
(23, 1, 2, NULL, NULL, NULL, '2021-06-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-06-02 14:11:26', '2021-06-02 14:11:26'),
(24, 2, 2, NULL, NULL, NULL, '2021-06-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-06-02 14:24:39', '2021-06-02 14:24:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses_details`
--

CREATE TABLE `expenses_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_expense` bigint(20) UNSIGNED NOT NULL,
  `id_inventory` bigint(20) UNSIGNED DEFAULT NULL,
  `id_account` bigint(20) UNSIGNED DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `id_branch` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exento` tinyint(1) NOT NULL,
  `islr` tinyint(1) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(24,2) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `expenses_details`
--

INSERT INTO `expenses_details` (`id`, `id_expense`, `id_inventory`, `id_account`, `id_user`, `id_branch`, `description`, `exento`, `islr`, `amount`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 15, 2, NULL, 'Mercancia para la Venta', 0, 0, 53, '533.00', '1', '2021-05-25 14:47:43', '2021-05-25 14:47:43'),
(2, 2, NULL, 16, 2, 3, 'Costo de Mercancia', 1, 1, 67, '10.00', '1', '2021-05-25 14:53:52', '2021-05-25 14:53:52'),
(6, 3, NULL, 16, 2, 2, 'Costo de Mercancia', 0, 0, 23, '33.00', '1', '2021-05-25 15:25:19', '2021-05-25 15:25:19'),
(7, 3, NULL, 16, 2, NULL, 'Costo de Mercancia', 0, 0, 22, '2.00', '1', '2021-05-25 15:25:50', '2021-05-25 15:25:50'),
(9, 4, NULL, 16, 2, NULL, 'Costo de Mercancia', 0, 0, 58, '55.00', '1', '2021-05-25 15:37:34', '2021-05-25 15:37:34'),
(10, 4, NULL, 15, 2, NULL, 'Mercancia para la Venta', 0, 0, 4, '400.00', '1', '2021-05-25 17:50:12', '2021-05-25 17:50:12'),
(11, 4, NULL, 15, 2, NULL, 'Mercancia para la Venta', 1, 1, 9, '100.00', '1', '2021-05-25 17:50:30', '2021-05-25 17:50:30'),
(12, 5, 1, 15, 2, NULL, 'Cartucho Imp Hp 3221', 0, 0, 2, '555.00', '1', '2021-05-26 17:26:53', '2021-05-26 17:26:53'),
(13, 5, 2, 15, 2, NULL, 'Mercancia para la Venta', 0, 0, 12, '40.00', '1', '2021-05-26 18:18:22', '2021-05-26 18:18:22'),
(14, 5, 3, 15, 2, NULL, 'Mercancia para la Venta', 0, 0, 0, '300.00', '1', '2021-05-26 18:23:42', '2021-05-26 18:23:42'),
(15, 5, 2, 15, 2, NULL, 'Mercancia para la Venta', 0, 0, 2, '30.00', '1', '2021-05-26 18:26:02', '2021-05-26 18:26:02'),
(16, 5, 3, 15, 2, NULL, 'Mercancia para la Venta', 1, 1, 2, '300.00', '1', '2021-05-26 18:27:00', '2021-05-26 18:27:00'),
(17, 6, NULL, 16, 2, NULL, 'Costo de Mercancia', 0, 0, 4, '336.00', '1', '2021-05-27 18:08:42', '2021-05-27 18:08:42'),
(18, 7, 3, 15, 2, NULL, 'Mercancia para la Venta', 1, 1, 7, '300.00', '1', '2021-05-27 19:37:25', '2021-05-27 19:37:25'),
(19, 8, 3, 15, 2, NULL, 'Mercancia para la Venta', 0, 0, 3, '300.00', '1', '2021-05-28 14:29:51', '2021-05-28 14:29:51'),
(20, 9, 3, 15, 2, NULL, 'Mercancia para la Venta', 0, 0, 4, '300.00', '1', '2021-05-28 15:19:24', '2021-05-28 15:19:24'),
(21, 10, 1, 15, 2, NULL, 'Mercancia para la Venta', 0, 0, 2, '555.00', '1', '2021-05-28 15:46:40', '2021-05-28 15:46:40'),
(22, 10, 3, 15, 2, NULL, 'Alambre', 0, 0, 3, '300.00', '1', '2021-05-28 16:01:51', '2021-05-28 16:01:51'),
(23, 11, 3, 15, 2, NULL, 'Alambre', 0, 0, 2, '300.00', '1', '2021-05-28 16:37:53', '2021-05-28 16:37:53'),
(24, 12, 1, 15, 2, NULL, 'Cartucho Imp Hp 3221', 0, 0, 3, '555.00', '1', '2021-05-28 16:42:29', '2021-05-28 16:42:29'),
(25, 13, 3, 15, 2, NULL, 'Alambre', 0, 0, 3, '300.00', '1', '2021-05-28 16:45:38', '2021-05-28 16:45:38'),
(26, 14, 3, 15, 2, NULL, 'Alambre', 0, 0, 4, '300.00', '1', '2021-05-28 16:52:04', '2021-05-28 16:52:04'),
(27, 15, 3, 15, 2, NULL, 'Alambre', 0, 0, 5, '300.00', '1', '2021-05-28 16:54:43', '2021-05-28 16:54:43'),
(28, 16, 1, 15, 2, NULL, 'Cartucho Imp Hp 3221', 0, 0, 5, '555.00', '1', '2021-05-28 16:57:53', '2021-05-28 16:57:53'),
(29, 17, 3, 15, 2, NULL, 'Alambre', 0, 0, 10, '300.00', '1', '2021-05-28 17:41:25', '2021-05-28 17:41:25'),
(30, 18, 3, 15, 2, NULL, 'Alambre', 0, 0, 10, '300.00', '1', '2021-05-28 17:43:53', '2021-05-28 17:43:53'),
(31, 19, 1, 15, 2, NULL, 'Cartucho Imp Hp 3221', 0, 0, 5, '555.00', '1', '2021-05-28 17:46:00', '2021-05-28 17:46:00'),
(32, 20, 3, 15, 2, NULL, 'Alambre', 0, 0, 6, '300.00', '1', '2021-05-28 18:02:02', '2021-05-28 18:02:02'),
(33, 20, 2, 15, 2, NULL, 'lapices', 1, 0, 12, '30.00', '1', '2021-05-28 18:02:25', '2021-05-28 18:02:25'),
(34, 21, 1, 15, 2, NULL, 'Cartucho Imp Hp 3221', 0, 0, 4, '555.00', '1', '2021-05-28 19:07:22', '2021-05-28 19:07:22'),
(35, 22, 1, 15, 2, NULL, 'Cartucho Imp Hp 3221', 0, 0, 4, '555.00', '1', '2021-06-02 14:05:49', '2021-06-02 14:05:49'),
(36, 23, 3, 15, 2, NULL, 'Alambre', 0, 0, 3, '300.00', '1', '2021-06-02 14:11:51', '2021-06-02 14:11:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expense_payments`
--

CREATE TABLE `expense_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_expense` bigint(20) UNSIGNED NOT NULL,
  `id_account` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type` int(11) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `reference` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `expense_payments`
--

INSERT INTO `expense_payments` (`id`, `id_expense`, `id_account`, `payment_type`, `amount`, `reference`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, NULL, 2, '2100.00', NULL, '1', '2021-05-28 13:43:47', '2021-05-28 13:43:47'),
(2, 7, NULL, 2, '2100.00', NULL, '1', '2021-05-28 14:00:19', '2021-05-28 14:00:19'),
(3, 7, NULL, 2, '2100.00', NULL, '1', '2021-05-28 14:01:31', '2021-05-28 14:01:31'),
(4, 8, 8, 11, '1044.00', '1111', '1', '2021-05-28 14:30:51', '2021-05-28 14:30:51'),
(5, 9, NULL, 3, '1392.00', NULL, '1', '2021-05-28 15:34:07', '2021-05-28 15:34:07'),
(6, 9, NULL, 3, '1392.00', NULL, '1', '2021-05-28 15:35:34', '2021-05-28 15:35:34'),
(7, 9, NULL, 3, '1392.00', NULL, '1', '2021-05-28 15:35:54', '2021-05-28 15:35:54'),
(8, 9, NULL, 3, '1392.00', NULL, '1', '2021-05-28 15:36:45', '2021-05-28 15:36:45'),
(9, 9, NULL, 3, '1392.00', NULL, '1', '2021-05-28 15:37:13', '2021-05-28 15:37:13'),
(10, 9, NULL, 3, '1392.00', NULL, '1', '2021-05-28 15:37:29', '2021-05-28 15:37:29'),
(11, 9, NULL, 3, '1392.00', NULL, '1', '2021-05-28 15:37:48', '2021-05-28 15:37:48'),
(12, 9, NULL, 3, '1392.00', NULL, '1', '2021-05-28 15:37:57', '2021-05-28 15:37:57'),
(13, 9, NULL, 3, '1392.00', NULL, '1', '2021-05-28 15:38:38', '2021-05-28 15:38:38'),
(14, 9, NULL, 3, '1392.00', NULL, '1', '2021-05-28 15:45:39', '2021-05-28 15:45:39'),
(15, 10, 7, 11, '2331.60', '444', '1', '2021-05-28 16:02:29', '2021-05-28 16:02:29'),
(16, 11, NULL, 3, '696.00', NULL, '1', '2021-05-28 16:38:15', '2021-05-28 16:38:15'),
(17, 11, NULL, 3, '696.00', NULL, '1', '2021-05-28 16:39:03', '2021-05-28 16:39:03'),
(18, 11, NULL, 3, '696.00', NULL, '1', '2021-05-28 16:39:43', '2021-05-28 16:39:43'),
(19, 11, NULL, 3, '696.00', NULL, '1', '2021-05-28 16:40:26', '2021-05-28 16:40:26'),
(20, 12, NULL, 2, '1931.40', NULL, '1', '2021-05-28 16:42:45', '2021-05-28 16:42:45'),
(21, 13, NULL, 7, '1044.00', NULL, '1', '2021-05-28 16:45:59', '2021-05-28 16:45:59'),
(22, 14, NULL, 7, '1392.00', NULL, '1', '2021-05-28 16:52:17', '2021-05-28 16:52:17'),
(23, 15, 6, 5, '1740.00', '9999', '1', '2021-05-28 16:55:01', '2021-05-28 16:55:01'),
(24, 16, NULL, 2, '3000.00', NULL, '1', '2021-05-28 16:58:39', '2021-05-28 16:58:39'),
(25, 16, 6, 11, '219.00', '2626', '1', '2021-05-28 16:58:39', '2021-05-28 16:58:39'),
(26, 17, 8, 5, '1000.00', '111', '1', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(27, 17, NULL, 2, '1000.00', NULL, '1', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(28, 17, 7, 9, '1360.00', NULL, '1', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(29, 18, 7, 1, '3480.00', '1232', '1', '2021-05-28 17:44:08', '2021-05-28 17:44:08'),
(30, 19, NULL, 3, '3219.00', NULL, '1', '2021-05-28 17:46:10', '2021-05-28 17:46:10'),
(31, 19, NULL, 3, '3219.00', NULL, '1', '2021-05-28 17:46:21', '2021-05-28 17:46:21'),
(32, 19, NULL, 3, '3219.00', NULL, '1', '2021-05-28 17:46:46', '2021-05-28 17:46:46'),
(33, 19, NULL, 3, '3219.00', NULL, '1', '2021-05-28 17:50:29', '2021-05-28 17:50:29'),
(34, 19, NULL, 3, '3219.00', NULL, '1', '2021-05-28 17:51:13', '2021-05-28 17:51:13'),
(35, 19, NULL, 3, '3219.00', NULL, '1', '2021-05-28 17:51:45', '2021-05-28 17:51:45'),
(36, 20, NULL, 3, '1000.00', NULL, '1', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(37, 20, 6, 5, '1000.00', '1212', '1', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(38, 20, NULL, 7, '448.00', NULL, '1', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(39, 4, 6, 1, '6456.40', '8585', '1', '2021-05-28 18:26:10', '2021-05-28 18:26:10'),
(40, 3, NULL, 2, '931.48', NULL, '1', '2021-05-28 18:37:26', '2021-05-28 18:37:26'),
(41, 21, NULL, 2, '2575.20', NULL, '1', '2021-05-28 19:23:14', '2021-05-28 19:23:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `header_vouchers`
--

CREATE TABLE `header_vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` int(11) DEFAULT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `setting` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `centro_cos` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `header_vouchers`
--

INSERT INTO `header_vouchers` (`id`, `reference`, `description`, `date`, `setting`, `centro_cos`, `status`, `created_at`, `updated_at`) VALUES
(29, NULL, 'Cobro de Bienes o servicios.', '2021-05-18', NULL, NULL, '1', '2021-05-18 15:42:51', '2021-05-18 15:42:51'),
(30, NULL, 'Ventas de Bienes o servicios.', '2021-05-18', NULL, NULL, '1', '2021-05-18 15:42:51', '2021-05-18 15:42:51'),
(31, NULL, 'Cobro de Bienes o servicios.', '2021-05-18', NULL, NULL, '1', '2021-05-18 15:47:54', '2021-05-18 15:47:54'),
(32, NULL, 'Cobro de Bienes o servicios.', '2021-05-18', NULL, NULL, '1', '2021-05-18 15:49:47', '2021-05-18 15:49:47'),
(33, NULL, 'Ventas de Bienes o servicios.', '2021-05-18', NULL, NULL, '1', '2021-05-18 15:49:47', '2021-05-18 15:49:47'),
(34, NULL, 'Cobro de Bienes o servicios.', '2021-05-18', NULL, NULL, '1', '2021-05-18 16:15:32', '2021-05-18 16:15:32'),
(35, NULL, 'Ventas de Bienes o servicios.', '2021-05-18', NULL, NULL, '1', '2021-05-18 16:15:32', '2021-05-18 16:15:32'),
(36, NULL, 'Cobro de Bienes o servicios.', '2021-05-18', NULL, NULL, '1', '2021-05-18 16:17:57', '2021-05-18 16:17:57'),
(37, NULL, 'Ventas de Bienes o servicios.', '2021-05-18', NULL, NULL, '1', '2021-05-18 16:17:57', '2021-05-18 16:17:57'),
(38, NULL, 'Cobro de Bienes o servicios.', '2021-05-18', NULL, NULL, '1', '2021-05-18 18:27:49', '2021-05-18 18:27:49'),
(39, NULL, 'Ventas de Bienes o servicios.', '2021-05-18', NULL, NULL, '1', '2021-05-18 18:27:49', '2021-05-18 18:27:49'),
(40, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 16:30:15', '2021-05-19 16:30:15'),
(41, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 16:30:16', '2021-05-19 16:30:16'),
(42, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:24:47', '2021-05-19 17:24:47'),
(43, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:24:48', '2021-05-19 17:24:48'),
(44, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:29:07', '2021-05-19 17:29:07'),
(45, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:29:07', '2021-05-19 17:29:07'),
(46, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:29:28', '2021-05-19 17:29:28'),
(47, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:29:29', '2021-05-19 17:29:29'),
(48, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:34:08', '2021-05-19 17:34:08'),
(49, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:34:08', '2021-05-19 17:34:08'),
(50, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:54:20', '2021-05-19 17:54:20'),
(51, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:56:22', '2021-05-19 17:56:22'),
(52, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:57:04', '2021-05-19 17:57:04'),
(53, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:57:05', '2021-05-19 17:57:05'),
(54, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:57:44', '2021-05-19 17:57:44'),
(55, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:57:44', '2021-05-19 17:57:44'),
(56, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:58:02', '2021-05-19 17:58:02'),
(57, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 17:58:02', '2021-05-19 17:58:02'),
(58, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 18:00:49', '2021-05-19 18:00:49'),
(59, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 18:00:49', '2021-05-19 18:00:49'),
(60, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 18:03:50', '2021-05-19 18:03:50'),
(61, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 18:03:50', '2021-05-19 18:03:50'),
(62, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 18:08:53', '2021-05-19 18:08:53'),
(63, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 18:11:02', '2021-05-19 18:11:02'),
(64, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 18:11:02', '2021-05-19 18:11:02'),
(65, NULL, 'Cobro de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 18:16:07', '2021-05-19 18:16:07'),
(66, NULL, 'Ventas de Bienes o servicios.', '2021-05-19', NULL, NULL, '1', '2021-05-19 18:16:07', '2021-05-19 18:16:07'),
(67, NULL, 'Cobro de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 15:40:59', '2021-05-20 15:40:59'),
(68, NULL, 'Ventas de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 15:41:02', '2021-05-20 15:41:02'),
(69, NULL, 'Cobro de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 15:52:32', '2021-05-20 15:52:32'),
(70, NULL, 'Cobro de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 15:53:44', '2021-05-20 15:53:44'),
(71, NULL, 'Ventas de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 15:53:45', '2021-05-20 15:53:45'),
(72, NULL, 'Cobro de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 16:02:15', '2021-05-20 16:02:15'),
(73, NULL, 'Cobro de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 16:05:36', '2021-05-20 16:05:36'),
(74, NULL, 'Ventas de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 16:05:37', '2021-05-20 16:05:37'),
(75, NULL, 'Cobro de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 16:09:04', '2021-05-20 16:09:04'),
(76, NULL, 'Ventas de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 16:09:04', '2021-05-20 16:09:04'),
(77, NULL, 'Cobro de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 19:04:20', '2021-05-20 19:04:20'),
(78, NULL, 'Ventas de Bienes o servicios.', '2021-05-20', NULL, NULL, '1', '2021-05-20 19:04:20', '2021-05-20 19:04:20'),
(79, 15, 'Prueba', '2021-05-20', NULL, NULL, 'U', '2021-05-20 19:47:45', '2021-05-20 19:47:45'),
(80, NULL, 'Cobro de Bienes o servicios.', '2021-05-24', NULL, NULL, '1', '2021-05-24 13:33:32', '2021-05-24 13:33:32'),
(81, NULL, 'Ventas de Bienes o servicios.', '2021-05-24', NULL, NULL, '1', '2021-05-24 13:33:33', '2021-05-24 13:33:33'),
(82, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 13:43:47', '2021-05-28 13:43:47'),
(83, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 14:00:19', '2021-05-28 14:00:19'),
(84, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 14:01:31', '2021-05-28 14:01:31'),
(85, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 14:01:31', '2021-05-28 14:01:31'),
(86, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 14:30:51', '2021-05-28 14:30:51'),
(87, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 15:34:07', '2021-05-28 15:34:07'),
(88, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 15:35:34', '2021-05-28 15:35:34'),
(89, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 15:35:54', '2021-05-28 15:35:54'),
(90, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 15:36:45', '2021-05-28 15:36:45'),
(91, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 15:37:13', '2021-05-28 15:37:13'),
(92, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 15:37:29', '2021-05-28 15:37:29'),
(93, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 15:37:48', '2021-05-28 15:37:48'),
(94, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 15:37:57', '2021-05-28 15:37:57'),
(95, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 15:38:38', '2021-05-28 15:38:38'),
(96, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 15:45:39', '2021-05-28 15:45:39'),
(97, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:02:29', '2021-05-28 16:02:29'),
(98, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:38:14', '2021-05-28 16:38:14'),
(99, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:39:03', '2021-05-28 16:39:03'),
(100, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:39:43', '2021-05-28 16:39:43'),
(101, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:40:26', '2021-05-28 16:40:26'),
(102, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:42:45', '2021-05-28 16:42:45'),
(103, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:45:59', '2021-05-28 16:45:59'),
(104, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:52:17', '2021-05-28 16:52:17'),
(105, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:55:01', '2021-05-28 16:55:01'),
(106, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:55:01', '2021-05-28 16:55:01'),
(107, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:58:39', '2021-05-28 16:58:39'),
(108, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 16:58:39', '2021-05-28 16:58:39'),
(109, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(110, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:42:15', '2021-05-28 17:42:15'),
(111, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:44:08', '2021-05-28 17:44:08'),
(112, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:44:08', '2021-05-28 17:44:08'),
(113, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:46:10', '2021-05-28 17:46:10'),
(114, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:46:11', '2021-05-28 17:46:11'),
(115, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:46:20', '2021-05-28 17:46:20'),
(116, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:46:21', '2021-05-28 17:46:21'),
(117, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:46:46', '2021-05-28 17:46:46'),
(118, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:46:46', '2021-05-28 17:46:46'),
(119, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:50:29', '2021-05-28 17:50:29'),
(120, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:50:29', '2021-05-28 17:50:29'),
(121, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:51:13', '2021-05-28 17:51:13'),
(122, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:51:13', '2021-05-28 17:51:13'),
(123, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:51:45', '2021-05-28 17:51:45'),
(124, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 17:51:45', '2021-05-28 17:51:45'),
(125, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(126, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 18:03:35', '2021-05-28 18:03:35'),
(127, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 18:26:10', '2021-05-28 18:26:10'),
(128, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 18:26:10', '2021-05-28 18:26:10'),
(129, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 18:37:26', '2021-05-28 18:37:26'),
(130, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 18:37:26', '2021-05-28 18:37:26'),
(131, NULL, 'Compras de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 19:21:47', '2021-05-28 19:21:47'),
(132, NULL, 'Pago de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 19:23:14', '2021-05-28 19:23:14'),
(133, NULL, 'Ventas de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 19:49:40', '2021-05-28 19:49:40'),
(134, NULL, 'Cobro de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 19:53:34', '2021-05-28 19:53:34'),
(135, NULL, 'Cobro de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 19:54:37', '2021-05-28 19:54:37'),
(136, NULL, 'Ventas de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 19:55:03', '2021-05-28 19:55:03'),
(137, NULL, 'Cobro de Bienes o servicios.', '2021-05-28', NULL, NULL, '1', '2021-05-28 19:55:40', '2021-05-28 19:55:40'),
(138, NULL, 'Compras de Bienes o servicios.', '2021-06-02', NULL, NULL, '1', '2021-06-02 14:07:05', '2021-06-02 14:07:05'),
(139, NULL, 'Ventas de Bienes o servicios.', '2021-06-02', NULL, NULL, '1', '2021-06-02 14:33:27', '2021-06-02 14:33:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historic_transports`
--

CREATE TABLE `historic_transports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `transport_id` bigint(20) UNSIGNED NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historic_transports`
--

INSERT INTO `historic_transports` (`id`, `employee_id`, `transport_id`, `date_begin`, `date_end`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 2, 1, '2021-04-15', NULL, '2021-04-15 13:11:08', '2021-04-15 13:11:08', 2),
(2, 2, 1, '2021-04-15', NULL, '2021-04-15 13:13:40', '2021-04-15 13:13:40', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `index_bcvs`
--

CREATE TABLE `index_bcvs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `period` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `index_bcvs`
--

INSERT INTO `index_bcvs` (`id`, `period`, `month`, `rate`, `status`, `created_at`, `updated_at`) VALUES
(1, '2021', '3', '2.00', '1', '2021-04-09 19:15:45', '2021-04-09 19:15:45'),
(2, '2022', '1', '17.80', '1', '2021-04-09 19:16:05', '2021-04-09 19:16:05'),
(3, '2022', '10', '16.90', '1', '2021-04-09 19:19:54', '2021-04-09 19:22:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventary_types`
--

CREATE TABLE `inventary_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inventary_types`
--

INSERT INTO `inventary_types` (`id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PRECIO DE ULTIMA COMPRA', '1', '2021-06-02 15:38:06', '2021-06-02 15:38:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inventories`
--

INSERT INTO `inventories` (`id`, `product_id`, `code`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '666', 128, '1', '2021-04-15 13:34:58', '2021-05-28 19:55:40'),
(2, 2, '96369', 32, '1', '2021-05-07 18:46:45', '2021-05-28 19:54:37'),
(3, 6, '615asd1', 98, '1', '2021-05-19 13:56:36', '2021-05-28 18:03:35'),
(4, 7, 'AEU77', 60, '1', '2021-06-01 19:19:31', '2021-06-01 19:20:25'),
(5, 1, 'asd', 40, '1', '2021-06-01 19:24:43', '2021-06-02 14:18:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_03_31_125525_create_roles_table', 1),
(3, '2021_04_06_162758_create_positions_table', 1),
(4, '2021_04_06_165000_create_academiclevels_table', 1),
(5, '2021_04_06_173525_create_professions_table', 1),
(6, '2021_04_06_190904_create_salary_types_table', 1),
(7, '2021_03_31_125527_create_failed_jobs_table', 1),
(8, '2021_03_31_125526_create_users_table', 1),
(9, '2021_03_31_125528_create_password_resets_table', 1),
(10, '2021_04_07_142942_create_employees_table', 1),
(14, '2020_04_09_020000_create_estados_table', 1),
(15, '2020_04_09_020001_create_municipios_table', 1),
(16, '2020_04_09_020003_create_parroquias_table', 1),
(17, '2021_04_08_125017_create_segments_table', 4),
(19, '2021_04_08_130719_create_segment_subs_table', 5),
(20, '2021_04_08_105442_create_units_of_measure_table', 6),
(24, '2021_04_08_143248_create_provider_table', 9),
(25, '2021_04_08_143248_create_providers_table', 10),
(26, '2021_04_08_114150_create_branches_table', 11),
(28, '2021_04_09_115043_create_nomina_types_table', 12),
(30, '2021_04_09_133320_create_payment_types_table', 13),
(31, '2021_04_09_143916_create_index_bcvs_table', 14),
(33, '2021_04_12_113722_create_comision_types_table', 16),
(34, '2021_05_12_112909_create_vendors_table', 17),
(37, '2021_04_08_130719_create_subsegments_table', 20),
(38, '2021_04_09_113234_create_products_table', 21),
(39, '2021_04_13_141126_create_inventories_table', 21),
(40, '2021_04_14_111736_create_modelos_table', 22),
(41, '2021_04_14_114510_create_colors_table', 23),
(42, '2021_04_14_115422_create_transports_table', 24),
(43, '2021_04_12_085248_create_receipt_vacations_table', 25),
(44, '2021_04_14_141750_create_historic_transports_table', 25),
(45, '2021_04_15_112909_create_vendors_table', 1),
(49, '2021_04_20_133451_create_header_vouchers_table', 28),
(61, '2021_04_16_133858_create_accounts_table', 31),
(66, '2021_04_30_105311_create_nominas_table', 34),
(67, '2021_04_30_131037_create_nomina_concepts_table', 35),
(68, '2021_05_03_135853_create_nomina_calculations_table', 36),
(71, '2021_05_11_110634_create_tasas_table', 38),
(72, '2021_04_08_113124_create_clients_table', 39),
(73, '2021_04_22_153243_create_bank_movements_table', 39),
(74, '2021_04_23_094734_create_quotations_table', 39),
(76, '2021_04_26_140253_create_quotation_payments_table', 39),
(78, '2021_05_12_141114_create_anticipos_table', 40),
(79, '2021_04_20_151425_create_detail_vouchers_table', 41),
(80, '2021_04_26_112502_create_quotation_products_table', 42),
(82, '2021_05_24_102447_create_expenses_and_purchases_table', 43),
(85, '2021_05_24_105114_create_expenses_details_table', 44),
(86, '2021_05_27_135935_create_expense_payments_table', 45),
(87, '2021_05_31_110054_create_bank_vouchers_table', 46),
(88, '2021_04_06_150835_create_rate_types_table', 47),
(89, '2021_04_06_150836_create_inventary_types_table', 47),
(90, '2021_04_06_150837_create_companies_table', 48),
(91, '2021_06_02_144105_create_nomina_formulas_table', 49);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Comisión', '0', '2021-04-14 15:40:30', '2021-04-14 15:44:12'),
(2, 'Amarillo', '1', '2021-04-14 15:52:07', '2021-04-14 15:52:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `descripcion`, `estado_id`, `created_at`, `updated_at`) VALUES
(101, 'LIBERTADOR', 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(201, 'ANACO', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(202, 'ARAGUA', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(203, 'SIMON BOLIVAR', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(204, 'MANUEL EZEQUIEL BRUZUAL', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(205, 'JUAN MANUEL CAJIGAL', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(206, 'PEDRO MARIA FREITES', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(207, 'INDEPENDENCIA', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(208, 'LIBERTAD', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(209, 'FRANCISCO DE MIRANDA', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210, 'JOSE GREGORIO MONAGAS', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211, 'FERNANDO PEÑALVER', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(212, 'SIMON RODRIGUEZ', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(213, 'JUAN ANTONIO SOTILLO', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(214, 'SAN JOSE DE GUANIPA', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(215, 'GUANTA', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(216, 'PIRITU', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(217, 'DIEGO BAUTISTA URBANEJA', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(218, 'FRANCISCO DEL CARMEN CARVAJAL', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(219, 'SANTA ANA', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220, 'GENERAL SIR ARTHUR MCGREGOR', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(221, 'SAN JUAN DE CAPISTRANO', 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(301, 'ACHAGUAS', 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(302, 'MUÑOZ', 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(303, 'PAEZ', 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(304, 'PEDRO CAMEJO', 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(305, 'ROMULO GALLEGOS', 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(306, 'SAN FERNANDO', 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(307, 'BIRUACA', 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(401, 'GIRARDOT', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(402, 'SANTIAGO MARIÑO', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(403, 'JOSE FELIX RIBAS', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(404, 'SAN CASIMIRO', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(405, 'SAN SEBASTIAN', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(406, 'SUCRE', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(407, 'URDANETA', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(408, 'ZAMORA', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(409, 'LIBERTADOR', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(410, 'JOSE ANGEL LAMAS', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(411, 'BOLIVAR', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(412, 'SANTOS MICHELENA', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(413, 'MARIO BRICEÑO IRAGORRY', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(414, 'TOVAR', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(415, 'CAMATAGUA', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(416, 'JOSE RAFAEL REVENGA', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(417, 'FRANCISCO LINARES ALCANTARA', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(418, 'OCUMARE DE LA COSTA DE ORO', 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(501, 'ARISMENDI', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(502, 'BARINAS', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(503, 'BOLIVAR', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(504, 'EZEQUIEL ZAMORA', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(505, 'OBISPOS', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(506, 'PEDRAZA', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(507, 'ROJAS', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(508, 'SOSA', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(509, 'ALBERTO ARVELO TORREALBA', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(510, 'ANTONIO JOSE DE SUCRE', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(511, 'CRUZ PAREDES', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(512, 'ANDRES ELOY BLANCO', 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(601, 'CARONI', 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(602, 'CEDEÑO', 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(603, 'HERES', 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(604, 'PIAR', 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(605, 'ROSCIO', 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(606, 'SUCRE', 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(607, 'SIFONTES', 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(608, 'ANGOSTURA', 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(609, 'GRAN SABANA', 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(610, 'EL CALLAO', 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(611, 'PADRE PEDRO CHIEN', 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(701, 'BEJUMA', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(702, 'CARLOS ARVELO', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(703, 'DIEGO IBARRA', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(704, 'GUACARA', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(705, 'MONTALBAN', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(706, 'JUAN JOSE MORA', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(707, 'PUERTO CABELLO', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(708, 'SAN JOAQUIN', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(709, 'VALENCIA', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(710, 'MIRANDA', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(711, 'LOS GUAYOS', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(712, 'NAGUANAGUA', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(713, 'SAN DIEGO', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(714, 'LIBERTADOR', 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(801, 'ANZOATEGUI', 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(802, 'TINAQUILLO', 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(803, 'GIRARDOT', 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(804, 'PAO DE SAN JUAN BAUTISTA', 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(805, 'RICAURTE', 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(806, 'EZEQUIEL ZAMORA', 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(807, 'TINACO', 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(808, 'LIMA BLANCO', 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(809, 'ROMULO GALLEGOS', 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(901, 'ACOSTA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(902, 'BOLIVAR', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(903, 'BUCHIVACOA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(904, 'CARIRUBANA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(905, 'COLINA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(906, 'DEMOCRACIA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(907, 'FALCON', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(908, 'FEDERACION', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(909, 'MAUROA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(910, 'MIRANDA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(911, 'PETIT', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(912, 'JOSE LAURENCIO SILVA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(913, 'ZAMORA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(914, 'DABAJURO', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(915, 'MONSEÑOR ITURRIZA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(916, 'LOS TAQUES', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(917, 'PIRITU', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(918, 'UNION', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(919, 'SAN FRANCISCO', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(920, 'JACURA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(921, 'CACIQUE MANAURE', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(922, 'PALMASOLA', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(923, 'SUCRE', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(924, 'URUMACO', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(925, 'TOCOPERO', 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1001, 'LEONARDO INFANTE', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1002, 'JULIAN MELLADO', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1003, 'FRANCISCO DE MIRANDA', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1004, 'JOSE TADEO MONAGAS', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1005, 'JOSE FELIX RIBAS', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1006, 'JUAN GERMAN ROSCIO', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1007, 'PEDRO ZARAZA', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1008, 'CAMAGUAN', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1009, 'SAN JOSE DE GUARIBE', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1010, 'LAS MERCEDES', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1011, 'EL SOCORRO', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1012, 'ORTIZ', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1013, 'SANTA MARIA DE IPIRE', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1014, 'CHAGUARAMAS', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1015, 'SAN GERONIMO DE GUAYABAL', 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1101, 'CRESPO', 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1102, 'IRIBARREN', 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1103, 'JIMENEZ', 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1104, 'MORAN', 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1105, 'PALAVECINO', 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1106, 'TORRES', 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1107, 'URDANETA', 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1108, 'ANDRES ELOY BLANCO', 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1109, 'SIMON PLANAS', 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1201, 'ALBERTO ADRIANI', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1202, 'ANDRES BELLO', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1203, 'ARZOBISPO CHACON', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1204, 'CAMPO ELIAS', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1205, 'GUARAQUE', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1206, 'JULIO CESAR SALAS', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1207, 'JUSTO BRICEÑO', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1208, 'LIBERTADOR', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1209, 'SANTOS MARQUINA', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1210, 'MIRANDA', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1211, 'ANTONIO PINTO SALINAS', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1212, 'OBISPO RAMOS DE LORA', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1213, 'CARACCIOLO PARRA OLMEDO', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1214, 'CARDENAL QUINTERO', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1215, 'PUEBLO LLANO', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1216, 'RANGEL', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1217, 'RIVAS DAVILA', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1218, 'SUCRE', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1219, 'TOVAR', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1220, 'TULIO FEBRES CORDERO', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1221, 'PADRE NOGUERA', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1222, 'ARICAGUA', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1223, 'ZEA', 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1301, 'ACEVEDO', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1302, 'BRION', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1303, 'GUAICAIPURO', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1304, 'INDEPENDENCIA', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1305, 'LANDER', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1306, 'PAEZ', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1307, 'PAZ CASTILLO', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1308, 'PLAZA', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1309, 'SUCRE', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1310, 'URDANETA', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1311, 'ZAMORA', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1312, 'CRISTOBAL ROJAS', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1313, 'LOS SALIAS', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1314, 'ANDRES BELLO', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1315, 'SIMON BOLIVAR', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1316, 'BARUTA', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1317, 'CARRIZAL', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1318, 'CHACAO', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1319, 'EL HATILLO', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1320, 'BUROZ', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1321, 'PEDRO GUAL', 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1401, 'ACOSTA', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1402, 'BOLIVAR', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1403, 'CARIPE', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1404, 'CEDEÑO', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1405, 'EZEQUIEL ZAMORA', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1406, 'LIBERTADOR', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1407, 'MATURIN', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1408, 'PIAR', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1409, 'PUNCERES', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1410, 'SOTILLO', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1411, 'AGUASAY', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1412, 'SANTA BARBARA', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1413, 'URACOA', 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1501, 'ARISMENDI', 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1502, 'DIAZ', 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1503, 'GOMEZ', 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1504, 'MANEIRO', 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1505, 'MARCANO', 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1506, 'MARIÑO', 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1507, 'MACANAO', 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1508, 'VILLALBA', 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1509, 'TUBORES', 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1510, 'ANTOLIN DEL CAMPO', 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1511, 'GARCIA', 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1601, 'ARAURE', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1602, 'ESTELLER', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1603, 'GUANARE', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1604, 'GUANARITO', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1605, 'OSPINO', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1606, 'PAEZ', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1607, 'SUCRE', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1608, 'TUREN', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1609, 'MONSEÑOR JOSE VICENTE DE UNDA', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1610, 'AGUA BLANCA', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1611, 'PAPELON', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1612, 'SAN GENARO DE BOCONOITO', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1613, 'SAN RAFAEL DE ONOTO', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1614, 'SANTA ROSALIA', 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1701, 'ARISMENDI', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1702, 'BENITEZ', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1703, 'BERMUDEZ', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1704, 'CAJIGAL', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1705, 'MARIÑO', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1706, 'MEJIA', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1707, 'MONTES', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1708, 'RIBERO', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1709, 'SUCRE', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1710, 'VALDEZ', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1711, 'ANDRES ELOY BLANCO', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1712, 'LIBERTADOR', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1713, 'ANDRES MATA', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1714, 'BOLIVAR', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1715, 'CRUZ SALMERON ACOSTA', 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1801, 'AYACUCHO', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1802, 'BOLIVAR', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1803, 'INDEPENDENCIA', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1804, 'CARDENAS', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1805, 'JAUREGUI', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1806, 'JUNIN', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1807, 'LOBATERA', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1808, 'SAN CRISTOBAL', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1809, 'URIBANTE', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1810, 'CORDOBA', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1811, 'GARCIA DE HEVIA', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1812, 'GUASIMOS', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1813, 'MICHELENA', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1814, 'LIBERTADOR', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1815, 'PANAMERICANO', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1816, 'PEDRO MARIA UREÑA', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1817, 'SUCRE', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1818, 'ANDRES BELLO', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1819, 'FERNANDEZ FEO', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1820, 'LIBERTAD', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1821, 'SAMUEL DARIO MALDONADO', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1822, 'SEBORUCO', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1823, 'ANTONIO ROMULO COSTA', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1824, 'FRANCISCO DE MIRANDA', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1825, 'JOSE MARIA VARGAS', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1826, 'RAFAEL URDANETA', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1827, 'SIMON RODRIGUEZ', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1828, 'TORBES', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1829, 'SAN JUDAS TADEO', 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1901, 'RAFAEL RANGEL', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1902, 'BOCONO', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1903, 'CARACHE', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1904, 'ESCUQUE', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1905, 'TRUJILLO', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1906, 'URDANETA', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1907, 'VALERA', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1908, 'CANDELARIA', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1909, 'MIRANDA', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1910, 'MONTE CARMELO', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1911, 'MOTATAN', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1912, 'PAMPAN', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1913, 'SAN RAFAEL DE CARVAJAL', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1914, 'SUCRE', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1915, 'ANDRES BELLO', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1916, 'BOLIVAR', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1917, 'JOSE FELIPE MARQUEZ CAÑIZALES', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1918, 'JUAN VICENTE CAMPO ELIAS', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1919, 'LA CEIBA', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(1920, 'PAMPANITO', 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2001, 'BOLIVAR', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2002, 'BRUZUAL', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2003, 'NIRGUA', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2004, 'SAN FELIPE', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2005, 'SUCRE', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2006, 'URACHICHE', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2007, 'PEÑA', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2008, 'JOSE ANTONIO PAEZ', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2009, 'LA TRINIDAD', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2010, 'COCOROTE', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2011, 'INDEPENDENCIA', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2012, 'ARISTIDES BASTIDAS', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2013, 'MANUEL MONGE', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2014, 'JOSE JOAQUIN VEROES', 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2101, 'BARALT', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2102, 'SANTA RITA', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2103, 'COLON', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2104, 'MARA', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2105, 'MARACAIBO', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2106, 'MIRANDA', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2107, 'GUAJIRA', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2108, 'MACHIQUES DE PERIJA', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2109, 'SUCRE', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2110, 'LA CAÑADA DE URDANETA', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2111, 'LAGUNILLAS', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2112, 'CATATUMBO', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2113, 'ROSARIO DE PERIJA', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2114, 'CABIMAS', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2115, 'VALMORE RODRIGUEZ', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2116, 'JESUS ENRIQUE LOSSADA', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2117, 'ALMIRANTE PADILLA', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2118, 'SAN FRANCISCO', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2119, 'JESUS MARIA SEMPRUM', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2120, 'FRANCISCO JAVIER PULGAR', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2121, 'SIMON BOLIVAR', 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2201, 'ATURES', 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2202, 'ATABAPO', 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2203, 'MAROA', 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2204, 'RIO NEGRO', 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2205, 'AUTANA', 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2206, 'MANAPIARE', 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2207, 'ALTO ORINOCO', 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2301, 'TUCUPITA', 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2302, 'PEDERNALES', 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2303, 'ANTONIO DIAZ', 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2304, 'CASACOIMA', 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(2401, 'LA GUAIRA', 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nominas`
--

CREATE TABLE `nominas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_profession` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nominas`
--

INSERT INTO `nominas` (`id`, `id_profession`, `description`, `type`, `date_begin`, `date_end`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'Sueldo', 'Primera Quincena', '2021-04-30', '2021-05-01', '2021-04-30 16:05:53', '2021-04-30 17:02:08', '0'),
(2, 2, 'prueba2', 'Primera Quincena', '2021-05-03', NULL, '2021-05-03 15:59:57', '2021-05-03 15:59:57', '1'),
(3, 1, 'Nomina nue', 'Semanal', '2021-05-03', NULL, '2021-05-03 16:41:45', '2021-05-04 15:48:10', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina_calculations`
--

CREATE TABLE `nomina_calculations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_nomina` bigint(20) UNSIGNED NOT NULL,
  `id_nomina_concept` bigint(20) UNSIGNED NOT NULL,
  `id_employee` bigint(20) UNSIGNED NOT NULL,
  `number_receipt` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `hours` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `voucher` int(11) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nomina_calculations`
--

INSERT INTO `nomina_calculations` (`id`, `id_nomina`, `id_nomina_concept`, `id_employee`, `number_receipt`, `type`, `amount`, `hours`, `days`, `cantidad`, `voucher`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 2, 0, 'No', '60.00', 6, 6, 6, 0, '1', '2021-05-04 14:54:43', '2021-05-04 14:54:43'),
(2, 3, 3, 2, 0, 'No', '777.00', 777, 777, 777, 0, '1', '2021-05-04 14:56:24', '2021-05-04 14:56:24'),
(3, 3, 2, 2, 0, 'No', '450.00', 45, 45, 45, 0, '1', '2021-05-04 15:08:41', '2021-05-04 15:08:41'),
(4, 3, 2, 2, 0, 'No', '120.00', 12, 12, 12, 0, '1', '2021-05-04 15:09:57', '2021-05-04 15:09:57'),
(5, 3, 4, 2, 0, 'No', '550.00', 55, 55, 55, 0, '1', '2021-05-04 15:19:30', '2021-05-04 15:19:30'),
(6, 3, 1, 2, 0, 'No', '990.00', 999, 99, 9, 0, '1', '2021-05-04 15:31:21', '2021-05-04 15:31:21'),
(7, 3, 1, 2, 0, 'No', '78000.00', 7800, 7800, 7800, 0, '1', '2021-05-04 15:35:47', '2021-05-04 15:35:47'),
(8, 3, 4, 4, 0, 'No', '5550.00', 55, 5, 5, 0, '1', '2021-05-04 16:05:06', '2021-05-04 16:05:06'),
(9, 3, 1, 4, 0, 'No', '5000000.00', 5000, 5000, 5000, 0, '1', '2021-05-04 16:05:52', '2021-05-04 16:05:52'),
(10, 3, 3, 2, 0, 'No', '150.00', 6, 5, 15, 0, '1', '2021-06-02 18:16:36', '2021-06-02 18:16:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina_concepts`
--

CREATE TABLE `nomina_concepts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `abbreviation` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `description` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calculate` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formula_m` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formula_s` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formula_q` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimum` decimal(16,2) DEFAULT NULL,
  `maximum` decimal(16,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nomina_concepts`
--

INSERT INTO `nomina_concepts` (`id`, `abbreviation`, `order`, `description`, `type`, `sign`, `calculate`, `formula_m`, `formula_s`, `formula_q`, `minimum`, `maximum`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Prue2', 2, 'prueba2', 'Mensual', 'D', 'S', 'ab', 'ab', 'ab', '1000.00', '92349999.99', '2021-05-03 13:12:04', '2021-05-03 14:55:03', '1'),
(2, 'Prue', 2, 'prueba', 'Quincenal', 'A', 'S', NULL, NULL, NULL, '100.00', '999999.00', '2021-05-03 14:15:42', '2021-05-03 14:25:14', '1'),
(3, 'Prue3', 3, 'prueba3', 'Mensual', 'A', 'N', NULL, NULL, NULL, '33330.00', '9999999999.99', '2021-05-03 14:27:38', '2021-05-03 14:27:50', '1'),
(4, 'CT', 4, 'CESTATICKET', 'Primera Quincena', 'A', 'S', NULL, NULL, NULL, '0.00', '9999999999.99', '2021-05-03 18:29:24', '2021-05-03 18:29:49', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina_formulas`
--

CREATE TABLE `nomina_formulas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina_types`
--

CREATE TABLE `nomina_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nomina_types`
--

INSERT INTO `nomina_types` (`id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nomina nueva', '0', '2021-04-09 17:05:30', '2021-04-09 17:26:08'),
(2, 'AAA', '1', '2021-04-09 18:17:40', '2021-04-09 18:17:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquias`
--

CREATE TABLE `parroquias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipio_id` bigint(20) UNSIGNED NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parroquias`
--

INSERT INTO `parroquias` (`id`, `descripcion`, `municipio_id`, `estado_id`, `created_at`, `updated_at`) VALUES
(10101, 'ALTAGRACIA', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10102, 'CANDELARIA', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10103, 'CATEDRAL', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10104, 'LA PASTORA', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10105, 'SAN AGUSTIN', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10106, 'SAN JOSE', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10107, 'SAN JUAN', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10108, 'SANTA ROSALIA', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10109, 'SANTA TERESA', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10110, 'SUCRE', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10111, '23 DE ENERO', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10112, 'ANTIMANO', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10113, 'EL RECREO', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10114, 'EL VALLE', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10115, 'LA VEGA', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10116, 'MACARAO', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10117, 'CARICUAO', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10118, 'EL JUNQUITO', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10119, 'COCHE', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10120, 'SAN PEDRO', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10121, 'SAN BERNARDINO', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(10122, 'EL PARAISO', 101, 1, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20101, 'ANACO', 201, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20102, 'SAN JOAQUIN', 201, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20201, 'ARAGUA DE BARCELONA', 202, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20202, 'CACHIPO', 202, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20301, 'EL CARMEN', 203, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20302, 'SAN CRISTOBAL', 203, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20303, 'BERGANTIN', 203, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20304, 'CAIGUA', 203, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20305, 'EL PILAR', 203, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20306, 'NARICUAL', 203, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20401, 'CLARINES', 204, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20402, 'GUANAPE', 204, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20403, 'SABANA DE UCHIRE', 204, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20501, 'ONOTO', 205, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20502, 'SAN PABLO', 205, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20601, 'CANTAURA', 206, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20602, 'LIBERTADOR', 206, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20603, 'SANTA ROSA', 206, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20604, 'URICA', 206, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20701, 'SOLEDAD', 207, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20702, 'MAMO', 207, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20801, 'SAN MATEO', 208, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20802, 'EL CARITO', 208, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20803, 'SANTA INES', 208, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20901, 'PARIAGUAN', 209, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20902, 'ATAPIRIRE', 209, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20903, 'BOCA DEL PAO', 209, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(20904, 'EL PAO', 209, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21001, 'MAPIRE', 210, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21002, 'PIAR', 210, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21003, 'SAN DIEGO DE CABRUTICA', 210, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21004, 'SANTA CLARA', 210, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21005, 'UVERITO', 210, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21006, 'ZUATA', 210, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21101, 'PUERTO PIRITU', 211, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21102, 'SAN MIGUEL', 211, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21103, 'SUCRE', 211, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21201, 'EDMUNDO BARRIOS', 212, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21202, 'MIGUEL OTERO SILVA', 212, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21301, 'POZUELOS', 213, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21302, 'PUERTO LA CRUZ', 213, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21401, 'SAN JOSE DE GUANIPA', 214, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21501, 'GUANTA', 215, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21502, 'CHORRERON', 215, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21601, 'PIRITU', 216, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21602, 'SAN FRANCISCO', 216, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21701, 'LECHERIA', 217, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21702, 'EL MORRO', 217, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21801, 'VALLE DE GUANAPE', 218, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21802, 'SANTA BARBARA', 218, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21901, 'SANTA ANA', 219, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(21902, 'PUEBLO NUEVO', 219, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(22001, 'EL CHAPARRO', 220, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(22002, 'TOMAS ALFARO', 220, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(22101, 'BOCA DE UCHIRE', 221, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(22102, 'BOCA DE CHAVEZ', 221, 2, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30101, 'ACHAGUAS', 301, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30102, 'APURITO', 301, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30103, 'EL YAGUAL', 301, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30104, 'GUACHARA', 301, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30105, 'MUCURITAS', 301, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30106, 'QUESERAS DEL MEDIO', 301, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30201, 'BRUZUAL', 302, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30202, 'MANTECAL', 302, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30203, 'QUINTERO', 302, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30204, 'SAN VICENTE', 302, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30205, 'RINCON HONDO', 302, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30301, 'GUASDUALITO', 303, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30302, 'ARAMENDI', 303, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30303, 'EL AMPARO', 303, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30304, 'SAN CAMILO', 303, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30305, 'URDANETA', 303, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30401, 'SAN JUAN DE PAYARA', 304, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30402, 'CODAZZI', 304, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30403, 'CUNAVICHE', 304, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30501, 'ELORZA', 305, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30502, 'LA TRINIDAD', 305, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30601, 'SAN FERNANDO', 306, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30602, 'PEÑALVER', 306, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30603, 'EL RECREO', 306, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30604, 'SN RAFAEL DE ATAMAICA', 306, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(30701, 'BIRUACA', 307, 3, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40101, 'LAS DELICIAS', 401, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40102, 'CHORONI', 401, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40103, 'MADRE MARIA DE SAN JOSE', 401, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40104, 'JOAQUIN CRESPO', 401, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40105, 'PEDRO JOSE OVALLES', 401, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40106, 'JOSE CASANOVA GODOY', 401, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40107, 'ANDRES ELOY BLANCO', 401, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40108, 'LOS TACARIGUAS', 401, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40201, 'TURMERO', 402, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40202, 'SAMAN DE GUERE', 402, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40203, 'ALFREDO PACHECO M', 402, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40204, 'CHUAO', 402, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40205, 'AREVALO APONTE', 402, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40301, 'JUAN VICENTE BOLIVAR', 403, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40302, 'ZUATA', 403, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40303, 'PAO DE ZARATE', 403, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40304, 'CASTOR NIEVES RIOS', 403, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40305, 'LAS GUACAMAYAS', 403, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40401, 'SAN CASIMIRO', 404, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40402, 'VALLE MORIN', 404, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40403, 'GUIRIPA', 404, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40404, 'OLLAS DE CARAMACATE', 404, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40501, 'SAN SEBASTIAN', 405, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40601, 'CAGUA', 406, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40602, 'BELLA VISTA', 406, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40701, 'BARBACOAS', 407, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40702, 'SAN FRANCISCO DE CARA', 407, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40703, 'TAGUAY', 407, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40704, 'LAS PEÑITAS', 407, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40801, 'VILLA DE CURA', 408, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40802, 'MAGDALENO', 408, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40803, 'SAN FRANCISCO DE ASIS', 408, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40804, 'VALLES DE TUCUTUNEMO', 408, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40805, 'AUGUSTO MIJARES', 408, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40901, 'PALO NEGRO', 409, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(40902, 'SAN MARTIN DE PORRES', 409, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41001, 'SANTA CRUZ', 410, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41101, 'SAN MATEO', 411, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41201, 'LAS TEJERIAS', 412, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41202, 'TIARA', 412, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41301, 'EL LIMON', 413, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41302, 'CAÑA DE AZUCAR', 413, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41401, 'TOVAR', 414, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41501, 'CAMATAGUA', 415, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41502, 'CARMEN DE CURA', 415, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41601, 'EL CONSEJO', 416, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41701, 'SANTA RITA', 417, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41702, 'FRANCISCO DE MIRANDA', 417, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41703, 'MONS FELICIANO G', 417, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(41801, 'OCUMARE DE LA COSTA', 418, 4, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50101, 'ARISMENDI', 501, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50102, 'GUADARRAMA', 501, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50103, 'LA UNION', 501, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50104, 'SAN ANTONIO', 501, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50201, 'ALFREDO ARVELO LARRIVA', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50202, 'BARINAS', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50203, 'SAN SILVESTRE', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50204, 'SANTA INES', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50205, 'SANTA LUCIA', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50206, 'TORUNOS', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50207, 'EL CARMEN', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50208, 'ROMULO BETANCOURT', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50209, 'CORAZON DE JESUS', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50210, 'RAMON IGNACIO MENDEZ', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50211, 'ALTO BARINAS', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50212, 'MANUEL PALACIO FAJARDO', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50213, 'JUAN ANTONIO RODRIGUEZ DOMINGUEZ', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50214, 'DOMINGA ORTIZ DE PAEZ', 502, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50301, 'ALTAMIRA DE CACERES', 503, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50302, 'BARINITAS', 503, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50303, 'CALDERAS', 503, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50401, 'SANTA BARBARA', 504, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50402, 'JOSE IGNACIO DEL PUMAR', 504, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50403, 'RAMON IGNACIO MENDEZ', 504, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50404, 'PEDRO BRICEÑO MENDEZ', 504, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50501, 'EL REAL', 505, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50502, 'LA LUZ', 505, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50503, 'OBISPOS', 505, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50504, 'LOS GUASIMITOS', 505, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50601, 'CIUDAD BOLIVIA', 506, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50602, 'JOSE IGNACIO BRICEÑO', 506, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50603, 'PAEZ', 506, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50604, 'JOSE FELIX RIBAS', 506, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50701, 'DOLORES', 507, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50702, 'LIBERTAD', 507, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50703, 'PALACIO FAJARDO', 507, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50704, 'SANTA ROSA', 507, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50705, 'SIMÓN RODRÍGUEZ', 507, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50801, 'CIUDAD DE NUTRIAS', 508, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50802, 'EL REGALO', 508, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50803, 'PUERTO DE NUTRIAS', 508, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50804, 'SANTA CATALINA', 508, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50805, 'SIMÓN BOLÍVAR', 508, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50901, 'RODRIGUEZ DOMINGUEZ', 509, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(50902, 'SABANETA', 509, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(51001, 'TICOPORO', 510, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(51002, 'NICOLAS PULIDO', 510, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(51003, 'ANDRES BELLO', 510, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(51101, 'BARRANCAS', 511, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(51102, 'EL SOCORRO', 511, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(51103, 'MASPARRITO', 511, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(51201, 'EL CANTON', 512, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(51202, 'SANTA CRUZ DE GUACAS', 512, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(51203, 'PUERTO VIVAS', 512, 5, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60101, 'SIMON BOLIVAR', 601, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60102, 'ONCE DE ABRIL', 601, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60103, 'VISTA AL SOL', 601, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60104, 'CHIRICA', 601, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60105, 'DALLA COSTA', 601, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60106, 'CACHAMAY', 601, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60107, 'UNIVERSIDAD', 601, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60108, 'UNARE', 601, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60109, 'YOCOIMA', 601, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60110, 'POZO VERDE', 601, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60111, '5 DE JULIO', 601, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60201, 'CAICARA DEL ORINOCO', 602, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60202, 'ASCENSION FARRERAS', 602, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60203, 'ALTAGRACIA', 602, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60204, 'LA URBANA', 602, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60205, 'GUANIAMO', 602, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60206, 'PIJIGUAOS', 602, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60301, 'CATEDRAL', 603, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60302, 'AGUA SALADA', 603, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60303, 'LA SABANITA', 603, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60304, 'VISTA HERMOSA', 603, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60305, 'MARHUANTA', 603, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60306, 'JOSE ANTONIO PAEZ', 603, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60307, 'ORINOCO', 603, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60308, 'PANAPANA', 603, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60309, 'ZEA', 603, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60401, 'UPATA', 604, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60402, 'ANDRES ELOY BLANCO', 604, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60403, 'PEDRO COVA', 604, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60501, 'GUASIPATI', 605, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60502, 'SALOM', 605, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60601, 'MARIPA', 606, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60602, 'ARIPAO', 606, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60603, 'LAS MAJADAS', 606, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60604, 'MOITACO', 606, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60605, 'GUARATARO', 606, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60701, 'TUMEREMO', 607, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60702, 'DALLA COSTA', 607, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60703, 'SAN ISIDRO', 607, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60801, 'CIUDAD PIAR', 608, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60802, 'SAN FRANCISCO', 608, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60803, 'BARCELONETA', 608, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60804, 'SANTA BARBARA', 608, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60901, 'SANTA ELENA DE UAIREN', 609, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(60902, 'IKABARU', 609, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(61001, 'EL CALLAO', 610, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(61101, 'EL PALMAR', 611, 6, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70101, 'BEJUMA', 701, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70102, 'CANOABO', 701, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70103, 'SIMON BOLIVAR', 701, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70201, 'GUIGUE', 702, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70202, 'BELEN', 702, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70203, 'TACARIGUA', 702, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70301, 'MARIARA', 703, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70302, 'AGUAS CALIENTES', 703, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70401, 'GUACARA', 704, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70402, 'CIUDAD ALIANZA', 704, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70403, 'YAGUA', 704, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70501, 'MONTALBAN', 705, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70601, 'MORON', 706, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70602, 'URAMA', 706, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70701, 'DEMOCRACIA', 707, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70702, 'FRATERNIDAD', 707, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70703, 'GOAIGOAZA', 707, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70704, 'JUAN JOSE FLORES', 707, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70705, 'BARTOLOME SALOM', 707, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70706, 'UNION', 707, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70707, 'BORBURATA', 707, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70708, 'PATANEMO', 707, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70801, 'SAN JOAQUIN', 708, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70901, 'CANDELARIA', 709, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70902, 'CATEDRAL', 709, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70903, 'EL SOCORRO', 709, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70904, 'MIGUEL PEÑA', 709, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70905, 'SAN BLAS', 709, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70906, 'SAN JOSE', 709, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70907, 'SANTA ROSA', 709, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70908, 'RAFAEL URDANETA', 709, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(70909, 'NEGRO PRIMERO', 709, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(71001, 'MIRANDA', 710, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(71101, 'LOS GUAYOS', 711, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(71201, 'NAGUANAGUA', 712, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(71301, 'SAN DIEGO', 713, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(71401, 'TOCUYITO', 714, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(71402, 'INDEPENDENCIA', 714, 7, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80101, 'COJEDES', 801, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80102, 'JUAN DE MATA SUAREZ', 801, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80201, 'TINAQUILLO', 802, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80301, 'EL BAUL', 803, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80302, 'SUCRE', 803, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80401, 'EL PAO', 804, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80501, 'LIBERTAD DE COJEDES', 805, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80502, 'EL AMPARO', 805, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80601, 'SAN CARLOS DE AUSTRIA', 806, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80602, 'JUAN ANGEL BRAVO', 806, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80603, 'MANUEL MANRIQUE', 806, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80701, 'GENERAL EN JEFE JOSE LAURENCIO SILVA', 807, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80801, 'MACAPO', 808, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80802, 'LA AGUADITA', 808, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(80901, 'ROMULO GALLEGOS', 809, 8, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90101, 'SAN JUAN DE LOS CAYOS', 901, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90102, 'CAPADARE', 901, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90103, 'LA PASTORA', 901, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90104, 'LIBERTADOR', 901, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90201, 'SAN LUIS', 902, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90202, 'ARACUA', 902, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90203, 'LA PEÑA', 902, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90301, 'CAPATARIDA', 903, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90302, 'BOROJO', 903, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90303, 'SEQUE', 903, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90304, 'ZAZARIDA', 903, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90305, 'BARIRO', 903, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90306, 'GUAJIRO', 903, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90401, 'NORTE', 904, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90402, 'CARIRUBANA', 904, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90403, 'PUNTA CARDON', 904, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90404, 'SANTA ANA', 904, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90501, 'LA VELA DE CORO', 905, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90502, 'ACURIGUA', 905, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90503, 'GUAIBACOA', 905, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90504, 'MACORUCA', 905, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90505, 'LAS CALDERAS', 905, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90601, 'PEDREGAL', 906, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90602, 'AGUA CLARA', 906, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90603, 'AVARIA', 906, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90604, 'PIEDRA GRANDE', 906, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90605, 'PURURECHE', 906, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90701, 'PUEBLO NUEVO', 907, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90702, 'ADICORA', 907, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90703, 'BARAIVED', 907, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90704, 'BUENA VISTA', 907, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90705, 'JADACAQUIVA', 907, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90706, 'MORUY', 907, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90707, 'EL VINCULO', 907, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90708, 'EL HATO', 907, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90709, 'ADAURE', 907, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90801, 'CHURUGUARA', 908, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90802, 'AGUA LARGA', 908, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90803, 'INDEPENDENCIA', 908, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90804, 'MAPARARI', 908, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90805, 'EL PAUJI', 908, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90901, 'MENE DE MAUROA', 909, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90902, 'CASIGUA', 909, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(90903, 'SAN FELIX', 909, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91001, 'SAN ANTONIO', 910, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91002, 'SAN GABRIEL', 910, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91003, 'SANTA ANA', 910, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91004, 'GUZMAN GUILLERMO', 910, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91005, 'MITARE', 910, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91006, 'SABANETA', 910, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91007, 'RIO SECO', 910, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91101, 'CABURE', 911, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91102, 'CURIMAGUA', 911, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91103, 'COLINA', 911, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91201, 'TUCACAS', 912, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91202, 'BOCA DE AROA', 912, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91301, 'PUERTO CUMAREBO', 913, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91302, 'LA CIENAGA', 913, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91303, 'LA SOLEDAD', 913, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91304, 'PUEBLO CUMAREBO', 913, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91305, 'ZAZARIDA', 913, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91401, 'DABAJURO', 914, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91501, 'CHICHIRIVICHE', 915, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91502, 'BOCA DE TOCUYO', 915, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91503, 'TOCUYO DE LA COSTA', 915, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91601, 'LOS TAQUES', 916, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91602, 'JUDIBANA', 916, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91701, 'PIRITU', 917, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91702, 'SAN JOSE DE LA COSTA', 917, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91801, 'SANTA CRUZ DE BUCARAL', 918, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91802, 'EL CHARAL', 918, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91803, 'LAS VEGAS DEL TUY', 918, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(91901, 'MIRIMIRE', 919, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(92001, 'JACURA', 920, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(92002, 'AGUA LINDA', 920, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(92003, 'ARAURIMA', 920, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(92101, 'YARACAL', 921, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(92201, 'PALMA SOLA', 922, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(92301, 'SUCRE', 923, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(92302, 'PECAYA', 923, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(92401, 'URUMACO', 924, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(92402, 'BRUZUAL', 924, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(92501, 'TOCOPERO', 925, 9, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100101, 'VALLE DE LA PASCUA', 1001, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100102, 'ESPINO', 1001, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100201, 'EL SOMBRERO', 1002, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100202, 'SOSA', 1002, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100301, 'CALABOZO', 1003, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100302, 'EL CALVARIO', 1003, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100303, 'EL RASTRO', 1003, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100304, 'GUARDATINAJAS', 1003, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100401, 'ALTAGRACIA DE ORITUCO', 1004, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100402, 'LEZAMA', 1004, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100403, 'LIBERTAD DE ORITUCO', 1004, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100404, 'SAN FCO DE MACAIRA', 1004, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100405, 'SAN RAFAEL DE ORITUCO', 1004, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100406, 'SOUBLETTE', 1004, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100407, 'PASO REAL DE MACAIRA', 1004, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100501, 'TUCUPIDO', 1005, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100502, 'SAN RAFAEL DE LAYA', 1005, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100601, 'SAN JUAN DE LOS MORROS', 1006, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100602, 'PARAPARA', 1006, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100603, 'CANTAGALLO', 1006, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100701, 'ZARAZA', 1007, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100702, 'SAN JOSE DE UNARE', 1007, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100801, 'CAMAGUAN', 1008, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100802, 'PUERTO MIRANDA', 1008, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100803, 'UVERITO', 1008, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(100901, 'SAN JOSE DE GUARIBE', 1009, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101001, 'LAS MERCEDES', 1010, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101002, 'SANTA RITA DE MANAPIRE', 1010, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101003, 'CABRUTA', 1010, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101101, 'EL SOCORRO', 1011, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101201, 'ORTIZ', 1012, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101202, 'SAN FRANCISCO DE TIZNADOS', 1012, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101203, 'SAN JOSE DE TIZNADOS', 1012, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101204, 'S LORENZO DE TIZNADOS', 1012, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101301, 'SANTA MARIA DE IPIRE', 1013, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101302, 'ALTAMIRA', 1013, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101401, 'CHAGUARAMAS', 1014, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101501, 'GUAYABAL', 1015, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(101502, 'CAZORLA', 1015, 10, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110101, 'FREITEZ', 1101, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110102, 'JOSE MARIA BLANCO', 1101, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110201, 'CATEDRAL', 1102, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110202, 'LA CONCEPCION', 1102, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110203, 'SANTA ROSA', 1102, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110204, 'UNION', 1102, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110205, 'EL CUJI', 1102, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110206, 'TAMACA', 1102, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110207, 'JUAN DE VILLEGAS', 1102, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110208, 'AGUEDO FELIPE ALVARADO', 1102, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110209, 'BUENA VISTA', 1102, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110210, 'JUAREZ', 1102, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110301, 'JUAN BAUTISTA RODRIGUEZ', 1103, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110302, 'DIEGO DE LOZADA', 1103, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110303, 'SAN MIGUEL', 1103, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110304, 'CUARA', 1103, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110305, 'PARAISO DE SAN JOSE', 1103, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110306, 'TINTORERO', 1103, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110307, 'JOSE BERNARDO DORANTE', 1103, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110308, 'CRNEL. MARIANO PERAZA', 1103, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110401, 'BOLIVAR', 1104, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110402, 'ANZOATEGUI', 1104, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110403, 'GUARICO', 1104, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110404, 'HUMOCARO ALTO', 1104, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110405, 'HUMOCARO BAJO', 1104, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110406, 'MORAN', 1104, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110407, 'HILARIO LUNA Y LUNA', 1104, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110408, 'LA CANDELARIA', 1104, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110501, 'CABUDARE', 1105, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110502, 'JOSE GREGORIO BASTIDAS', 1105, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110503, 'AGUA VIVA', 1105, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110601, 'TRINIDAD SAMUEL', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110602, 'ANTONIO DIAZ', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110603, 'CAMACARO', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110604, 'CASTAÑEDA', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110605, 'CHIQUINQUIRA', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110606, 'ESPINOZA DE LOS MONTEROS', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110607, 'LARA', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110608, 'MANUEL MORILLO', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110609, 'MONTES DE OCA', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110610, 'TORRES', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110611, 'EL BLANCO', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110612, 'MONTAÑA VERDE', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110613, 'HERIBERTO ARROYO', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110614, 'LAS MERCEDES', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110615, 'CECILIO ZUBILLAGA', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110616, 'REYES DE VARGAS', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110617, 'ALTAGRACIA', 1106, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110701, 'SIQUISIQUE', 1107, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110702, 'SAN MIGUEL', 1107, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110703, 'XAGUAS', 1107, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110704, 'MOROTURO', 1107, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110801, 'PIO TAMAYO', 1108, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110802, 'YACAMBU', 1108, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110803, 'QUEBRADA HONDA DE GUACHE', 1108, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110901, 'SARARE', 1109, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110902, 'GUSTAVO VEGAS LEON', 1109, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(110903, 'BURIA', 1109, 11, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120101, 'GABRIEL PICON GONZALEZ', 1201, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120102, 'HECTOR AMABLE MORA', 1201, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120103, 'JOSE NUCETE SARDI', 1201, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120104, 'PULIDO MENDEZ', 1201, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120105, 'PRESIDENTE ROMULO GALLEGOS', 1201, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120106, 'PRESIDENTE BETANCOURT', 1201, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120107, 'PRESIDENTE PAEZ', 1201, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120201, 'LA AZULITA', 1202, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120301, 'CANAGUA', 1203, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120302, 'CAPURI', 1203, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120303, 'CHACANTA', 1203, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120304, 'EL MOLINO', 1203, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120305, 'GUAIMARAL', 1203, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120306, 'MUCUTUY', 1203, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120307, 'MUCUCHACHI', 1203, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120401, 'ACEQUIAS', 1204, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120402, 'JAJI', 1204, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120403, 'LA MESA', 1204, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120404, 'SAN JOSE', 1204, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120405, 'MONTALBAN', 1204, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120406, 'MATRIZ', 1204, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120407, 'FERNANDEZ PEÑA', 1204, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120501, 'GUARAQUE', 1205, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120502, 'MESA DE QUINTERO', 1205, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120503, 'RIO NEGRO', 1205, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120601, 'ARAPUEY', 1206, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120602, 'PALMIRA', 1206, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120701, 'TORONDOY', 1207, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120702, 'SAN CRISTOBAL DE T', 1207, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120801, 'ARIAS', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120802, 'SAGRARIO', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120803, 'MILLA', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120804, 'EL LLANO', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120805, 'JUAN RODRIGUEZ SUAREZ', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120806, 'JACINTO PLAZA', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120807, 'DOMINGO PEÑA', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120808, 'GONZALO PICON FEBRES', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120809, 'OSUNA RODRIGUEZ', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120810, 'LASSO DE LA VEGA', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120811, 'CARACCIOLO PARRA PEREZ', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120812, 'MARIANO PICON SALAS', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120813, 'ANTONIO SPINETTI DINI', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120814, 'EL MORRO', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120815, 'LOS NEVADOS', 1208, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(120901, 'TABAY', 1209, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121001, 'TIMOTES', 1210, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121002, 'ANDRES ELOY BLANCO', 1210, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121003, 'PIÑANGO', 1210, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121004, 'LA VENTA', 1210, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121101, 'SANTA CRUZ DE MORA', 1211, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121102, 'MESA BOLIVAR', 1211, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121103, 'MESA DE LAS PALMAS', 1211, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121201, 'SANTA ELENA DE ARENALES', 1212, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121202, 'ELOY PAREDES', 1212, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121203, 'SAN RAFAEL DE ALZAZAR', 1212, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121301, 'TUCANI', 1213, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121302, 'FLORENCIO RAMIREZ', 1213, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121401, 'SANTO DOMINGO', 1214, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121402, 'LAS PIEDRAS', 1214, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121501, 'PUEBLO LLANO', 1215, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121601, 'MUCUCHIES', 1216, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121602, 'MUCURUBA', 1216, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121603, 'SAN RAFAEL', 1216, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121604, 'CACUTE', 1216, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121605, 'LA TOMA', 1216, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121701, 'BAILADORES', 1217, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121702, 'GERONIMO MALDONADO', 1217, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121801, 'LAGUNILLAS', 1218, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121802, 'CHIGUARA', 1218, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121803, 'ESTANQUES', 1218, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121804, 'SAN JUAN', 1218, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121805, 'PUEBLO NUEVO DEL SUR', 1218, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121806, 'LA TRAMPA', 1218, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121901, 'EL LLANO', 1219, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121902, 'TOVAR', 1219, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121903, 'EL AMPARO', 1219, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(121904, 'SAN FRANCISCO', 1219, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(122001, 'NUEVA BOLIVIA', 1220, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(122002, 'INDEPENDENCIA', 1220, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(122003, 'MARIA C PALACIOS', 1220, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(122004, 'SANTA APOLONIA', 1220, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(122101, 'SANTA MARIA DE CAPARO', 1221, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(122201, 'ARICAGUA', 1222, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(122202, 'SAN ANTONIO', 1222, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(122301, 'ZEA', 1223, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(122302, 'CAÑO EL TIGRE', 1223, 12, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130101, 'CAUCAGUA', 1301, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130102, 'ARAGUITA', 1301, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130103, 'AREVALO GONZALEZ', 1301, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130104, 'CAPAYA', 1301, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130105, 'PANAQUIRE', 1301, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130106, 'RIBAS', 1301, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130107, 'EL CAFE', 1301, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130108, 'MARIZAPA', 1301, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130201, 'HIGUEROTE', 1302, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130202, 'CURIEPE', 1302, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130203, 'TACARIGUA', 1302, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130301, 'LOS TEQUES', 1303, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130302, 'CECILIO ACOSTA', 1303, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130303, 'PARACOTOS', 1303, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130304, 'SAN PEDRO', 1303, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130305, 'TACATA', 1303, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130306, 'EL JARILLO', 1303, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130307, 'ALTAGRACIA DE LA MONTAÑA', 1303, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130401, 'SANTA TERESA DEL TUY', 1304, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130402, 'EL CARTANAL', 1304, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130501, 'OCUMARE DEL TUY', 1305, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130502, 'LA DEMOCRACIA', 1305, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130503, 'SANTA BARBARA', 1305, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130601, 'RIO CHICO', 1306, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130602, 'EL GUAPO', 1306, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130603, 'TACARIGUA DE LA LAGUNA', 1306, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130604, 'PAPARO', 1306, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130605, 'SN FERNANDO DEL GUAPO', 1306, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130701, 'SANTA LUCIA DEL TUY', 1307, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130801, 'GUARENAS', 1308, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130901, 'PETARE', 1309, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130902, 'LEONCIO MARTINEZ', 1309, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130903, 'CAUCAGUITA', 1309, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130904, 'FILAS DE MARICHES', 1309, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(130905, 'LA DOLORITA', 1309, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131001, 'CUA', 1310, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131002, 'NUEVA CUA', 1310, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131101, 'GUATIRE', 1311, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131102, 'BOLIVAR', 1311, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131201, 'CHARALLAVE', 1312, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131202, 'LAS BRISAS', 1312, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131301, 'SAN ANTONIO LOS ALTOS', 1313, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131401, 'SAN JOSE DE BARLOVENTO', 1314, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131402, 'CUMBO', 1314, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131501, 'SAN FRANCISCO DE YARE', 1315, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131502, 'SAN ANTONIO DE YARE', 1315, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131601, 'NUESTRA SEÑORA DEL ROSARIO', 1316, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131602, 'EL CAFETAL', 1316, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131603, 'LAS MINAS', 1316, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131701, 'CARRIZAL', 1317, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131801, 'CHACAO', 1318, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(131901, 'EL HATILLO', 1319, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(132001, 'MAMPORAL', 1320, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(132101, 'CUPIRA', 1321, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(132102, 'MACHURUCUTO', 1321, 13, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140101, 'SAN ANTONIO DE MATURIN', 1401, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140102, 'SAN FRANCISCO DE MATURIN', 1401, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140201, 'CARIPITO', 1402, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140301, 'CARIPE', 1403, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140302, 'TERESEN', 1403, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140303, 'EL GUACHARO', 1403, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140304, 'SAN AGUSTIN', 1403, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140305, 'LA GUANOTA', 1403, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140306, 'SABANA DE PIEDRA', 1403, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140401, 'CAICARA', 1404, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140402, 'AREO', 1404, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140403, 'SAN FELIX', 1404, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140404, 'VIENTO FRESCO', 1404, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140501, 'PUNTA DE MATA', 1405, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140502, 'EL TEJERO', 1405, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55');
INSERT INTO `parroquias` (`id`, `descripcion`, `municipio_id`, `estado_id`, `created_at`, `updated_at`) VALUES
(140601, 'TEMBLADOR', 1406, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140602, 'TABASCA', 1406, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140603, 'LAS ALHUACAS', 1406, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140604, 'CHAGUARAMAS', 1406, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140701, 'EL FURRIAL', 1407, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140702, 'JUSEPIN', 1407, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140703, 'EL COROZO', 1407, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140704, 'SAN VICENTE', 1407, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140705, 'LA PICA', 1407, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140706, 'ALTO DE LOS GODOS', 1407, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140707, 'BOQUERON', 1407, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140708, 'LAS COCUIZAS', 1407, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140709, 'SANTA CRUZ', 1407, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140710, 'SAN SIMON', 1407, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140711, 'C.M. MATURIN', 1407, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140801, 'ARAGUA', 1408, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140802, 'CHAGUARAMAL', 1408, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140803, 'GUANAGUANA', 1408, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140804, 'APARICIO', 1408, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140805, 'TAGUAYA', 1408, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140806, 'EL PINTO', 1408, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140807, 'LA TOSCANA', 1408, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140901, 'QUIRIQUIRE', 1409, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(140902, 'CACHIPO', 1409, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(141001, 'BARRANCAS', 1410, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(141002, 'LOS BARRANCOS DE FAJARDO', 1410, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(141101, 'AGUASAY', 1411, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(141201, 'SANTA BARBARA', 1412, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(141301, 'URACOA', 1413, 14, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150101, 'LA ASUNCION', 1501, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150201, 'SAN JUAN BAUTISTA', 1502, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150202, 'ZABALA', 1502, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150301, 'SANTA ANA', 1503, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150302, 'GUEVARA', 1503, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150303, 'MATASIETE', 1503, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150304, 'BOLIVAR', 1503, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150305, 'SUCRE', 1503, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150401, 'PAMPATAR', 1504, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150402, 'AGUIRRE', 1504, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150501, 'JUAN GRIEGO', 1505, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150502, 'ADRIAN', 1505, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150601, 'PORLAMAR', 1506, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150701, 'BOCA DEL RIO', 1507, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150702, 'SAN FRANCISCO', 1507, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150801, 'SAN PEDRO DE COCHE', 1508, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150802, 'VICENTE FUENTES', 1508, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150901, 'PUNTA DE PIEDRAS', 1509, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(150902, 'LOS BARALES', 1509, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(151001, 'LA PLAZA DE PARAGUACHI', 1510, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(151101, 'VALLE ESP SANTO', 1511, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(151102, 'FRANCISCO FAJARDO', 1511, 15, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160101, 'ARAURE', 1601, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160102, 'RIO ACARIGUA', 1601, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160201, 'PIRITU', 1602, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160202, 'UVERAL', 1602, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160301, 'GUANARE', 1603, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160302, 'CORDOBA', 1603, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160303, 'SAN JUAN GUANAGUANARE', 1603, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160304, 'VIRGEN DE LA COROMOTO', 1603, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160305, 'SAN JOSE DE LA MONTAÑA', 1603, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160401, 'GUANARITO', 1604, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160402, 'TRINIDAD DE LA CAPILLA', 1604, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160403, 'DIVINA PASTORA', 1604, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160501, 'OSPINO', 1605, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160502, 'APARICION', 1605, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160503, 'LA ESTACION', 1605, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160601, 'ACARIGUA', 1606, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160602, 'PAYARA', 1606, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160603, 'PIMPINELA', 1606, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160604, 'RAMON PERAZA', 1606, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160701, 'BISCUCUY', 1607, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160702, 'CONCEPCION', 1607, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160703, 'SAN RAFAEL PALO ALZADO', 1607, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160704, 'UVENCIO A VELASQUEZ', 1607, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160705, 'SAN JOSE DE SAGUAZ', 1607, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160706, 'VILLA ROSA', 1607, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160801, 'VILLA BRUZUAL', 1608, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160802, 'CANELONES', 1608, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160803, 'SANTA CRUZ', 1608, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160804, 'SAN ISIDRO LABRADOR', 1608, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160901, 'CHABASQUEN', 1609, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(160902, 'PEÑA BLANCA', 1609, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(161001, 'AGUA BLANCA', 1610, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(161101, 'PAPELON', 1611, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(161102, 'CAÑO DELGADITO', 1611, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(161201, 'BOCONOITO', 1612, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(161202, 'ANTOLIN TOVAR AQUINO', 1612, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(161301, 'SAN RAFAEL DE ONOTO', 1613, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(161302, 'SANTA FE', 1613, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(161303, 'THERMO MORALES', 1613, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(161401, 'EL PLAYON', 1614, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(161402, 'FLORIDA', 1614, 16, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170101, 'RIO CARIBE', 1701, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170102, 'SAN JUAN GALDONAS', 1701, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170103, 'PUERTO SANTO', 1701, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170104, 'EL MORRO DE PUERTO SANTO', 1701, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170105, 'ANTONIO JOSE DE SUCRE', 1701, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170201, 'EL PILAR', 1702, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170202, 'EL RINCON', 1702, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170203, 'GUARAUNOS', 1702, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170204, 'TUNAPUICITO', 1702, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170205, 'UNION', 1702, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170206, 'GENERAL FRANCISCO ANTONIO VAZQUEZ', 1702, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170301, 'SANTA CATALINA', 1703, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170302, 'SANTA ROSA', 1703, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170303, 'SANTA TERESA', 1703, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170304, 'BOLIVAR', 1703, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170305, 'MACARAPANA', 1703, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170401, 'YAGUARAPARO', 1704, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170402, 'LIBERTAD', 1704, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170403, 'PAUJIL', 1704, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170501, 'IRAPA', 1705, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170502, 'CAMPO CLARO', 1705, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170503, 'SORO', 1705, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170504, 'SAN ANTONIO DE IRAPA', 1705, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170505, 'MARABAL', 1705, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170601, 'SAN ANT DEL GOLFO', 1706, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170701, 'CUMANACOA', 1707, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170702, 'ARENAS', 1707, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170703, 'ARICAGUA', 1707, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170704, 'COCOLLAR', 1707, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170705, 'SAN FERNANDO', 1707, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170706, 'SAN LORENZO', 1707, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170801, 'CARIACO', 1708, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170802, 'CATUARO', 1708, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170803, 'RENDON', 1708, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170804, 'SANTA CRUZ', 1708, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170805, 'SANTA MARIA', 1708, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170901, 'ALTAGRACIA', 1709, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170902, 'AYACUCHO', 1709, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170903, 'SANTA INES', 1709, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170904, 'VALENTIN VALIENTE', 1709, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170905, 'SAN JUAN', 1709, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170906, 'GRAN MARISCAL', 1709, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(170907, 'RAUL LEONI', 1709, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171001, 'GUIRIA', 1710, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171002, 'CRISTOBAL COLON', 1710, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171003, 'PUNTA DE PIEDRAS', 1710, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171004, 'BIDEAU', 1710, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171101, 'MARIÑO', 1711, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171102, 'ROMULO GALLEGOS', 1711, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171201, 'TUNAPUY', 1712, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171202, 'CAMPO ELIAS', 1712, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171301, 'SAN JOSE DE AREOCUAR', 1713, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171302, 'TAVERA ACOSTA', 1713, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171401, 'MARIGUITAR', 1714, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171501, 'ARAYA', 1715, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171502, 'MANICUARE', 1715, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(171503, 'CHACOPATA', 1715, 17, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180101, 'COLON', 1801, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180102, 'RIVAS BERTI', 1801, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180103, 'SAN PEDRO DEL RIO', 1801, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180201, 'SAN ANTONIO DEL TACHIRA', 1802, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180202, 'PALOTAL', 1802, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180203, 'JUAN VICENTE GOMEZ', 1802, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180204, 'ISAIAS MEDINA ANGARITA', 1802, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180301, 'CAPACHO NUEVO', 1803, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180302, 'JUAN GERMAN ROSCIO', 1803, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180303, 'ROMAN CARDENAS', 1803, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180401, 'TARIBA', 1804, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180402, 'LA FLORIDA', 1804, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180403, 'AMENODORO RANGEL LAMUS', 1804, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180501, 'LA GRITA', 1805, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180502, 'EMILIO CONSTANTINO GUERRERO', 1805, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180503, 'MONSEÑOR MIGUEL ANTONIO SALAS', 1805, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180601, 'RUBIO', 1806, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180602, 'BRAMON', 1806, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180603, 'LA PETROLEA', 1806, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180604, 'QUINIMARI', 1806, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180701, 'LOBATERA', 1807, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180702, 'CONSTITUCION', 1807, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180801, 'LA CONCORDIA', 1808, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180802, 'PEDRO MARIA MORANTES', 1808, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180803, 'SN JUAN BAUTISTA', 1808, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180804, 'SAN SEBASTIAN', 1808, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180805, 'DR. FCO. ROMERO LOBO', 1808, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180901, 'PREGONERO', 1809, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180902, 'CARDENAS', 1809, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180903, 'POTOSI', 1809, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(180904, 'JUAN PABLO PEÑALOZA', 1809, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181001, 'SANTA ANA  DEL TACHIRA', 1810, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181101, 'LA FRIA', 1811, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181102, 'BOCA DE GRITA', 1811, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181103, 'JOSE ANTONIO PAEZ', 1811, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181201, 'PALMIRA', 1812, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181301, 'MICHELENA', 1813, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181401, 'ABEJALES', 1814, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181402, 'SAN JOAQUIN DE NAVAY', 1814, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181403, 'DORADAS', 1814, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181404, 'EMETERIO OCHOA', 1814, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181501, 'COLONCITO', 1815, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181502, 'LA PALMITA', 1815, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181601, 'UREÑA', 1816, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181602, 'NUEVA ARCADIA', 1816, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181701, 'QUENIQUEA', 1817, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181702, 'SAN PABLO', 1817, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181703, 'ELEAZAR LOPEZ CONTRERAS', 1817, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181801, 'CORDERO', 1818, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181901, 'SAN RAFAEL DEL PINAL', 1819, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181902, 'SANTO DOMINGO', 1819, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(181903, 'ALBERTO ADRIANI', 1819, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182001, 'CAPACHO VIEJO', 1820, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182002, 'CIPRIANO CASTRO', 1820, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182003, 'MANUEL FELIPE RUGELES', 1820, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182101, 'LA TENDIDA', 1821, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182102, 'BOCONO', 1821, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182103, 'HERNANDEZ', 1821, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182201, 'SEBORUCO', 1822, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182301, 'LAS MESAS', 1823, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182401, 'SAN JOSE DE BOLIVAR', 1824, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182501, 'EL COBRE', 1825, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182601, 'DELICIAS', 1826, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182701, 'SAN SIMON', 1827, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182801, 'SAN JOSECITO', 1828, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(182901, 'UMUQUENA', 1829, 18, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190101, 'BETIJOQUE', 1901, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190102, 'JOSE G HERNANDEZ', 1901, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190103, 'LA PUEBLITA', 1901, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190104, 'EL CEDRO', 1901, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190201, 'BOCONO', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190202, 'EL CARMEN', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190203, 'MOSQUEY', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190204, 'AYACUCHO', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190205, 'BURBUSAY', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190206, 'GENERAL RIVAS', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190207, 'MONSEÑOR JAUREGUI', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190208, 'RAFAEL RANGEL', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190209, 'SAN JOSE', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190210, 'SAN MIGUEL', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190211, 'GUARAMACAL', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190212, 'LA VEGA DE GUARAMACAL', 1902, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190301, 'CARACHE', 1903, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190302, 'LA CONCEPCION', 1903, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190303, 'CUICAS', 1903, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190304, 'PANAMERICANA', 1903, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190305, 'SANTA CRUZ', 1903, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190401, 'ESCUQUE', 1904, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190402, 'SABANA LIBRE', 1904, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190403, 'LA UNION', 1904, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190404, 'SANTA RITA', 1904, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190501, 'CRISTOBAL MENDOZA', 1905, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190502, 'CHIQUINQUIRA', 1905, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190503, 'MATRIZ', 1905, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190504, 'MONSEÑOR CARRILLO', 1905, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190505, 'CRUZ CARRILLO', 1905, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190506, 'ANDRES LINARES', 1905, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190507, 'TRES ESQUINAS', 1905, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190601, 'LA QUEBRADA', 1906, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190602, 'JAJO', 1906, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190603, 'LA MESA', 1906, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190604, 'SANTIAGO', 1906, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190605, 'CABIMBU', 1906, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190606, 'TUÑAME', 1906, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190701, 'MERCEDES DIAZ', 1907, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190702, 'JUAN IGNACIO MONTILLA', 1907, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190703, 'LA BEATRIZ', 1907, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190704, 'MENDOZA', 1907, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190705, 'LA PUERTA', 1907, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190706, 'SAN LUIS', 1907, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190801, 'CHEJENDE', 1908, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190802, 'CARRILLO', 1908, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190803, 'CEGARRA', 1908, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190804, 'BOLIVIA', 1908, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190805, 'MANUEL SALVADOR ULLOA', 1908, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190806, 'SAN JOSE', 1908, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190807, 'ARNOLDO GABALDON', 1908, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190901, 'EL DIVIDIVE', 1909, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190902, 'AGUA CALIENTE', 1909, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190903, 'EL CENIZO', 1909, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190904, 'AGUA SANTA', 1909, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(190905, 'VALERITA', 1909, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191001, 'MONTE CARMELO', 1910, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191002, 'BUENA VISTA', 1910, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191003, 'STA MARIA DEL HORCON', 1910, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191101, 'MOTATAN', 1911, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191102, 'EL BAÑO', 1911, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191103, 'EL JALISCO', 1911, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191201, 'PAMPAN', 1912, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191202, 'SANTA ANA', 1912, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191203, 'LA PAZ', 1912, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191204, 'FLOR DE PATRIA', 1912, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191301, 'CARVAJAL', 1913, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191302, 'ANTONIO N BRICEÑO', 1913, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191303, 'CAMPO ALEGRE', 1913, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191304, 'JOSE LEONARDO SUAREZ', 1913, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191401, 'SABANA DE MENDOZA', 1914, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191402, 'JUNIN', 1914, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191403, 'VALMORE RODRIGUEZ', 1914, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191404, 'EL PARAISO', 1914, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191501, 'SANTA ISABEL', 1915, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191502, 'ARAGUANEY', 1915, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191503, 'EL JAGUITO', 1915, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191504, 'LA ESPERANZA', 1915, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191601, 'SABANA GRANDE', 1916, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191602, 'CHEREGUE', 1916, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191603, 'GRANADOS', 1916, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191701, 'EL SOCORRO', 1917, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191702, 'LOS CAPRICHOS', 1917, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191703, 'ANTONIO JOSE DE SUCRE', 1917, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191801, 'CAMPO ELIAS', 1918, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191802, 'ARNOLDO GABALDON', 1918, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191901, 'SANTA APOLONIA', 1919, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191902, 'LA CEIBA', 1919, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191903, 'EL PROGRESO', 1919, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(191904, 'TRES DE FEBRERO', 1919, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(192001, 'PAMPANITO', 1920, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(192002, 'PAMPANITO II', 1920, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(192003, 'LA CONCEPCION', 1920, 19, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200101, 'AROA', 2001, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200201, 'CHIVACOA', 2002, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200202, 'CAMPO ELIAS', 2002, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200301, 'NIRGUA', 2003, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200302, 'SALOM', 2003, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200303, 'TEMERLA', 2003, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200401, 'SAN FELIPE', 2004, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200402, 'ALBARICO', 2004, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200403, 'SAN JAVIER', 2004, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200501, 'GUAMA', 2005, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200601, 'URACHICHE', 2006, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200701, 'YARITAGUA', 2007, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200702, 'SAN ANDRES', 2007, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200801, 'SABANA DE PARRA', 2008, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(200901, 'BORAURE', 2009, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(201001, 'COCOROTE', 2010, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(201101, 'INDEPENDENCIA', 2011, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(201201, 'SAN PABLO', 2012, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(201301, 'YUMARE', 2013, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(201401, 'FARRIAR', 2014, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(201402, 'EL GUAYABO', 2014, 20, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210101, 'GENERAL URDANETA', 2101, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210102, 'LIBERTADOR', 2101, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210103, 'MANUEL GUANIPA MATOS', 2101, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210104, 'MARCELINO BRICEÑO', 2101, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210105, 'SAN TIMOTEO', 2101, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210106, 'PUEBLO NUEVO', 2101, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210201, 'PEDRO LUCAS URRIBARRI', 2102, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210202, 'SANTA RITA', 2102, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210203, 'JOSE CENOVIO URRIBARRI', 2102, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210204, 'EL MENE', 2102, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210301, 'SANTA CRUZ DEL ZULIA', 2103, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210302, 'URRIBARRI', 2103, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210303, 'MORALITO', 2103, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210304, 'SAN CARLOS DEL ZULIA', 2103, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210305, 'SANTA BARBARA', 2103, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210401, 'LUIS DE VICENTE', 2104, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210402, 'RICAURTE', 2104, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210403, 'MONS.MARCOS SERGIO G', 2104, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210404, 'SAN RAFAEL', 2104, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210405, 'LAS PARCELAS', 2104, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210406, 'TAMARE', 2104, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210407, 'LA SIERRITA', 2104, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210501, 'BOLIVAR', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210502, 'COQUIVACOA', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210503, 'CRISTO DE ARANZA', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210504, 'CHIQUINQUIRA', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210505, 'SANTA LUCIA', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210506, 'OLEGARIO VILLALOBOS', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210507, 'JUANA DE AVILA', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210508, 'CARACCIOLO PARRA PEREZ', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210509, 'IDELFONZO VASQUEZ', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210510, 'CACIQUE MARA', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210511, 'CECILIO ACOSTA', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210512, 'RAUL LEONI', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210513, 'FRANCISCO EUGENIO BUSTAMANTE', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210514, 'MANUEL DAGNINO', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210515, 'LUIS HURTADO HIGUERA', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210516, 'VENANCIO PULGAR', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210517, 'ANTONIO BORJAS ROMERO', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210518, 'SAN ISIDRO', 2105, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210601, 'FARIA', 2106, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210602, 'SAN ANTONIO', 2106, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210603, 'ANA MARIA CAMPOS', 2106, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210604, 'SAN JOSE', 2106, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210605, 'ALTAGRACIA', 2106, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210701, 'GOAJIRA', 2107, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210702, 'ELIAS SANCHEZ RUBIO', 2107, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210703, 'SINAMAICA', 2107, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210704, 'ALTA GUAJIRA', 2107, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210801, 'SAN JOSE DE PERIJA', 2108, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210802, 'BARTOLOME DE LAS CASAS', 2108, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210803, 'LIBERTAD', 2108, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210804, 'RIO NEGRO', 2108, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210901, 'GIBRALTAR', 2109, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210902, 'HERAS', 2109, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210903, 'M.ARTURO CELESTINO A', 2109, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210904, 'ROMULO GALLEGOS', 2109, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210905, 'BOBURES', 2109, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(210906, 'EL BATEY', 2109, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211001, 'ANDRES BELLO (KM 48)', 2110, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211002, 'POTRERITOS', 2110, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211003, 'EL CARMELO', 2110, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211004, 'CHIQUINQUIRA', 2110, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211005, 'CONCEPCION', 2110, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211101, 'ELEAZAR LOPEZ CONTRERAS', 2111, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211102, 'ALONSO DE OJEDA', 2111, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211103, 'VENEZUELA', 2111, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211104, 'CAMPO LARA', 2111, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211105, 'LIBERTAD', 2111, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211106, 'EL DANTO', 2111, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211201, 'UDON PEREZ', 2112, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211202, 'ENCONTRADOS', 2112, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211301, 'DONALDO GARCIA', 2113, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211302, 'SIXTO ZAMBRANO', 2113, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211303, 'EL ROSARIO', 2113, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211401, 'AMBROSIO', 2114, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211402, 'GERMAN RIOS LINARES', 2114, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211403, 'JORGE HERNANDEZ', 2114, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211404, 'LA ROSA', 2114, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211405, 'PUNTA GORDA', 2114, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211406, 'CARMEN HERRERA', 2114, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211407, 'SAN BENITO', 2114, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211408, 'ROMULO BETANCOURT', 2114, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211409, 'ARISTIDES CALVANI', 2114, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211501, 'RAUL CUENCA', 2115, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211502, 'LA VICTORIA', 2115, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211503, 'RAFAEL URDANETA', 2115, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211601, 'JOSE RAMON YEPEZ', 2116, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211602, 'LA CONCEPCION', 2116, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211603, 'SAN JOSE', 2116, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211604, 'MARIANO PARRA LEON', 2116, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211701, 'MONAGAS', 2117, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211702, 'ISLA DE TOAS', 2117, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211801, 'MARCIAL HERNANDEZ', 2118, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211802, 'FRANCISCO OCHOA', 2118, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211803, 'SAN FRANCISCO', 2118, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211804, 'EL BAJO', 2118, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211805, 'DOMITILA FLORES', 2118, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211806, 'LOS CORTIJOS', 2118, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211807, 'JOSE DOMINGO RUS', 2118, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211901, 'BARI', 2119, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(211902, 'JESUS M SEMPRUN', 2119, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(212001, 'SIMON RODRIGUEZ', 2120, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(212002, 'CARLOS QUEVEDO', 2120, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(212003, 'FRANCISCO J PULGAR', 2120, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(212004, 'AGUSTIN CODAZZI', 2120, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(212101, 'RAFAEL MARIA BARALT', 2121, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(212102, 'MANUEL MANRIQUE', 2121, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(212103, 'RAFAEL URDANETA', 2121, 21, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220101, 'FERNANDO GIRON TOVAR', 2201, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220102, 'LUIS ALBERTO GOMEZ', 2201, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220103, 'PARHUEÑA', 2201, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220104, 'PLATANILLAL', 2201, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220201, 'SAN FERNANDO DE ATABAPO', 2202, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220202, 'UCATA', 2202, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220203, 'YAPACANA', 2202, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220204, 'CANAME', 2202, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220301, 'MAROA', 2203, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220302, 'VICTORINO', 2203, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220303, 'COMUNIDAD', 2203, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220401, 'SAN CARLOS DE RIO NEGRO', 2204, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220402, 'SOLANO', 2204, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220403, 'CASIQUIARE', 2204, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220404, 'COCUY', 2204, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220501, 'ISLA DE RATON', 2205, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220502, 'SAMARIAPO', 2205, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220503, 'SIPAPO', 2205, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220504, 'MUNDUAPO', 2205, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220505, 'GUAYAPO', 2205, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220601, 'SAN JUAN DE MANAPIARE', 2206, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220602, 'ALTO VENTUARI', 2206, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220603, 'MEDIO VENTUARI', 2206, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220604, 'BAJO VENTUARI', 2206, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220701, 'LA ESMERALDA', 2207, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220702, 'HUACHAMACARE', 2207, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220703, 'MARAWAKA', 2207, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220704, 'MAVACA', 2207, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(220705, 'SIERRA PARIMA', 2207, 22, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230101, 'SAN JOSE', 2301, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230102, 'VIRGEN DEL VALLE', 2301, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230103, 'SAN RAFAEL', 2301, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230104, 'JOSE VIDAL MARCANO', 2301, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230105, 'LEONARDO RUIZ PINEDA', 2301, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230106, 'MONS. ARGIMIRO GARCIA', 2301, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230107, 'MCL. ANTONIO J DE SUCRE', 2301, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230108, 'JUAN MILLAN', 2301, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230201, 'PEDERNALES', 2302, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230202, 'LUIS B PRIETO FIGUERO', 2302, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230301, 'CURIAPO', 2303, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230302, 'SANTOS DE ABELGAS', 2303, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230303, 'MANUEL RENAUD', 2303, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230304, 'PADRE BARRAL', 2303, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230305, 'ANICETO LUGO', 2303, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230306, 'ALMIRANTE LUIS BRION', 2303, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230401, 'IMATACA', 2304, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230402, 'ROMULO GALLEGOS', 2304, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230403, 'JUAN BAUTISTA ARISMEN', 2304, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(230404, 'MANUEL PIAR', 2304, 23, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(240101, 'CARABALLEDA', 2401, 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(240102, 'CARAYACA', 2401, 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(240103, 'CARUAO', 2401, 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(240104, 'CATIA LA MAR', 2401, 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(240105, 'LA GUAIRA', 2401, 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(240106, 'MACUTO', 2401, 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(240107, 'MAIQUETIA', 2401, 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(240108, 'NAIGUATA', 2401, 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(240109, 'EL JUNKO', 2401, 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(240110, 'URIMARE', 2401, 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55'),
(240111, 'CARLOS SOUBLETTE', 2401, 24, '2020-04-20 05:55:55', '2020-04-20 05:55:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_types`
--

CREATE TABLE `payment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_days` int(11) NOT NULL,
  `pide_ref` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `small_box` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `payment_types`
--

INSERT INTO `payment_types` (`id`, `description`, `type`, `credit_days`, `pide_ref`, `small_box`, `nature`, `point`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AAABBB', 'Credito', 20, 'No', '20', 'Credito', 'No', '0', '2021-04-09 18:33:54', '2021-04-09 18:34:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `positions`
--

INSERT INTO `positions` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ingeniero', 'ing', '1', '2021-04-07 20:08:24', '2021-04-07 20:08:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `segment_id` bigint(20) UNSIGNED NOT NULL,
  `subsegment_id` bigint(20) UNSIGNED NOT NULL,
  `unit_of_measure_id` bigint(20) UNSIGNED NOT NULL,
  `code_comercial` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `price_buy` decimal(16,2) NOT NULL,
  `cost_average` decimal(16,2) NOT NULL,
  `photo_product` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `money` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exento` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `islr` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_impuesto` decimal(16,2) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `segment_id`, `subsegment_id`, `unit_of_measure_id`, `code_comercial`, `type`, `description`, `price`, `price_buy`, `cost_average`, `photo_product`, `money`, `exento`, `islr`, `special_impuesto`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, '777', 'MERCANCIA', 'Cartucho Imp Hp 3221', '555.00', '555.00', '5555.00', NULL, 'D', '1', '1', '55.00', '1', '2021-04-15 13:32:06', '2021-04-15 13:32:06'),
(2, 6, 1, 1, '13333', 'MERCANCIA', 'lapices', '40.00', '30.00', '35.00', NULL, 'D', '0', '0', '35.00', '1', '2021-04-26 15:00:05', '2021-04-26 15:00:05'),
(3, 9, 3, 1, '752456', 'MERCANCIA', 'focos', '1000.00', '1000.00', '1000.00', NULL, 'D', '0', '0', '1000.00', '1', '2021-05-13 19:04:08', '2021-05-13 19:04:08'),
(4, 1, 1, 1, '635', 'MERCANCIA', 'prueba producto', '1000.00', '300.00', '30.00', NULL, 'D', '0', '0', '1.00', '1', '2021-05-17 16:40:43', '2021-05-17 16:46:03'),
(5, 1, 1, 1, '1000', 'MERCANCIA', 'Prueba Exento', '500.00', '800.00', '850.00', NULL, 'D', '1', '0', '1.00', '1', '2021-05-17 16:43:10', '2021-05-17 16:45:48'),
(6, 6, 1, 1, 'ASD777', 'MERCANCIA', 'Alambre', '505.00', '300.00', '350.00', NULL, 'D', '0', '0', '90.00', '1', '2021-05-19 12:59:30', '2021-05-19 13:34:05'),
(7, 6, 1, 1, 'ASD1561', 'MERCANCIA', 'Pepsi', '6.00', '3.00', '4.00', NULL, 'D', '0', '0', '1.56', '1', '2021-06-01 19:11:57', '2021-06-01 19:11:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professions`
--

CREATE TABLE `professions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `professions`
--

INSERT INTO `professions` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'administrador', '1', '2021-04-07 20:38:37', '2021-04-07 20:38:37'),
(2, 'Chofer', 'Conduce autos', '1', '2021-05-03 15:53:54', '2021-05-03 15:53:54'),
(3, 'Conductor', 'chofer', '1', '2021-05-27 19:29:40', '2021-05-27 19:29:40'),
(4, 'Guardia', 'Guardia', '1', '2021-05-27 19:30:27', '2021-05-27 19:30:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_provider` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_credit` tinyint(1) NOT NULL,
  `days_credit` int(11) NOT NULL,
  `amount_max_credit` double(12,2) NOT NULL,
  `porc_retencion_iva` double(5,2) NOT NULL,
  `retiene_islr` tinyint(1) NOT NULL,
  `balance` double(16,2) NOT NULL,
  `select_balance` int(11) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `providers`
--

INSERT INTO `providers` (`id`, `code_provider`, `razon_social`, `direction`, `city`, `country`, `phone1`, `phone2`, `has_credit`, `days_credit`, `amount_max_credit`, `porc_retencion_iva`, `retiene_islr`, `balance`, `select_balance`, `status`, `created_at`, `updated_at`) VALUES
(1, '1515', '1515', 'asdas', 'caasd', 'Venezuela', '51651', '6151', 0, 1, 1.00, 1.00, 0, 1.00, 0, '1', '2021-04-09 12:58:01', '2021-04-09 12:58:01'),
(2, '3333', '555', 'asd', 'acs', 'Venezuela', '51651', '6156', 0, 2, 2.00, 1.00, 1, 2.00, 0, '0', '2021-04-09 12:58:37', '2021-04-09 13:13:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quotations`
--

CREATE TABLE `quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_client` bigint(20) UNSIGNED NOT NULL,
  `id_vendor` bigint(20) UNSIGNED NOT NULL,
  `id_transport` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `serie` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_quotation` date NOT NULL,
  `date_billing` date DEFAULT NULL,
  `date_delivery_note` date DEFAULT NULL,
  `anticipo` decimal(16,2) DEFAULT NULL,
  `iva_percentage` int(11) DEFAULT NULL,
  `observation` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_days` int(11) DEFAULT NULL,
  `note` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_imponible` decimal(32,2) DEFAULT NULL,
  `amount` decimal(32,2) DEFAULT NULL,
  `amount_iva` decimal(32,2) DEFAULT NULL,
  `amount_with_iva` decimal(32,2) DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `quotations`
--

INSERT INTO `quotations` (`id`, `id_client`, `id_vendor`, `id_transport`, `id_user`, `serie`, `date_quotation`, `date_billing`, `date_delivery_note`, `anticipo`, `iva_percentage`, `observation`, `credit_days`, `note`, `coin`, `base_imponible`, `amount`, `amount_iva`, `amount_with_iva`, `status`, `created_at`, `updated_at`) VALUES
(30, 1, 2, 1, 2, 'dsaf45', '2021-05-24', '2021-05-28', NULL, '0.00', 16, NULL, 9, NULL, NULL, '0.00', '1110.00', '0.00', '1110.00', 'C', '2021-05-24 13:20:53', '2021-05-28 19:55:40'),
(31, 1, 2, 1, 2, '424', '2021-05-24', '2021-05-24', NULL, '0.00', 16, NULL, 5, NULL, NULL, '404000.00', '4040.00', '646.40', '4686.40', 'C', '2021-05-24 13:21:35', '2021-05-24 13:33:33'),
(32, 1, 2, 1, 2, '7474', '2021-05-28', NULL, '2021-05-28', NULL, 16, NULL, NULL, NULL, 'Bolivares', NULL, NULL, NULL, NULL, '1', '2021-05-28 18:47:06', '2021-05-28 18:48:12'),
(33, 1, 2, 1, 2, '205200', '2021-05-28', '2021-05-28', NULL, '0.00', 16, NULL, 9, NULL, NULL, '80000.00', '800.00', '128.00', '928.00', 'C', '2021-05-28 19:47:05', '2021-05-28 19:54:37'),
(34, 2, 2, 1, 2, '9689', '2021-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-05-31 18:50:12', '2021-05-31 18:50:12'),
(35, 2, 2, 1, 2, '89456', '2021-06-02', '2021-06-02', NULL, NULL, 16, NULL, 7, NULL, NULL, '0.00', '1110.00', '0.00', '1110.00', '1', '2021-06-02 14:31:35', '2021-06-02 14:33:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quotation_payments`
--

CREATE TABLE `quotation_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_quotation` bigint(20) UNSIGNED NOT NULL,
  `id_account` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type` int(11) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `credit_days` int(11) DEFAULT NULL,
  `reference` int(11) DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `quotation_payments`
--

INSERT INTO `quotation_payments` (`id`, `id_quotation`, `id_account`, `payment_type`, `amount`, `credit_days`, `reference`, `status`, `created_at`, `updated_at`) VALUES
(84, 31, 6, 1, '1000.00', NULL, 6363, '1', '2021-05-24 13:33:32', '2021-05-24 13:33:32'),
(85, 31, NULL, 2, '1000.00', NULL, NULL, '1', '2021-05-24 13:33:32', '2021-05-24 13:33:32'),
(86, 31, NULL, 3, '1000.00', NULL, NULL, '1', '2021-05-24 13:33:32', '2021-05-24 13:33:32'),
(87, 31, 4, 6, '1000.00', NULL, NULL, '1', '2021-05-24 13:33:32', '2021-05-24 13:33:32'),
(88, 31, 8, 11, '686.40', NULL, 777, '1', '2021-05-24 13:33:32', '2021-05-24 13:33:32'),
(89, 33, NULL, 2, '928.00', NULL, NULL, '1', '2021-05-28 19:53:34', '2021-05-28 19:53:34'),
(90, 33, NULL, 2, '928.00', NULL, NULL, '1', '2021-05-28 19:54:37', '2021-05-28 19:54:37'),
(91, 30, NULL, 2, '1110.00', NULL, NULL, '1', '2021-05-28 19:55:40', '2021-05-28 19:55:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quotation_products`
--

CREATE TABLE `quotation_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_quotation` bigint(20) UNSIGNED NOT NULL,
  `id_inventory` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `discount` decimal(16,2) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `quotation_products`
--

INSERT INTO `quotation_products` (`id`, `id_quotation`, `id_inventory`, `amount`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(31, 31, 3, 8, '0.00', '1', '2021-05-24 13:24:23', '2021-05-24 13:25:00'),
(32, 30, 1, 2, '0.00', '1', '2021-05-27 19:55:57', '2021-05-27 19:55:57'),
(33, 32, 1, 3, '0.00', '1', '2021-05-28 18:47:19', '2021-05-28 18:47:19'),
(34, 33, 2, 20, '0.00', '1', '2021-05-28 19:49:10', '2021-05-28 19:49:10'),
(35, 35, 5, 2, '0.00', '1', '2021-06-02 14:32:08', '2021-06-02 14:32:08'),
(36, 34, 3, 3, '0.00', '1', '2021-06-02 14:34:47', '2021-06-02 14:34:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rate_types`
--

CREATE TABLE `rate_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rate_types`
--

INSERT INTO `rate_types` (`id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AUTOMATICA', '1', '2021-06-02 15:36:49', '2021-06-02 15:36:49'),
(2, 'FIJA', '1', '2021-06-02 15:37:16', '2021-06-02 15:37:16'),
(3, 'SIN TASA', '1', '2021-06-02 15:37:31', '2021-06-02 15:37:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receipt_vacations`
--

CREATE TABLE `receipt_vacations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date NOT NULL,
  `days_vacations` int(11) NOT NULL,
  `bono_vacations` int(11) NOT NULL,
  `days_feriados` int(11) NOT NULL,
  `lph` decimal(15,2) NOT NULL,
  `sso` decimal(15,2) NOT NULL,
  `seguro_paro_forzoso` decimal(15,2) NOT NULL,
  `ultimo_sueldo` decimal(15,2) NOT NULL,
  `total_pagar` decimal(15,2) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Master', '1', NULL, NULL),
(2, 'Usuario', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salary_types`
--

CREATE TABLE `salary_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `salary_types`
--

INSERT INTO `salary_types` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mayor', '600 a 800', '1', '2021-04-07 20:08:46', '2021-04-07 20:08:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segments`
--

CREATE TABLE `segments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `segments`
--

INSERT INTO `segments` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ENVIOS EXPORTACION', NULL, '2021-04-08 17:05:35'),
(2, 'ENVIO AEREO US', NULL, NULL),
(3, 'ENVIO MARITIMO USA', NULL, NULL),
(4, 'ENVIO AEREO ESPANA', NULL, NULL),
(5, 'ENVIO MARITIMO ESPANA', NULL, NULL),
(6, 'ADUANA', NULL, NULL),
(7, 'SEGURO', NULL, NULL),
(8, 'ALMACEN', NULL, NULL),
(9, 'CARGA', NULL, NULL),
(10, 'MATERIAL DE ENVIOS Y EMPAQUE', NULL, NULL),
(11, 'ENVIOS NACIONALES', NULL, NULL),
(12, 'ENTREGAS', NULL, NULL),
(13, 'GASTOS ADMINISTRATIVOS', NULL, NULL),
(14, 'ENVIO INTERNACIONAL', NULL, NULL),
(15, 'Sueldo y SALARIO', '2021-04-30 15:47:11', '2021-04-30 15:47:11'),
(16, 'prueba2', '2021-05-03 15:59:13', '2021-05-03 15:59:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subsegments`
--

CREATE TABLE `subsegments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `segment_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `subsegments`
--

INSERT INTO `subsegments` (`id`, `segment_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 'AAA', '1', '2021-04-14 14:52:29', '2021-04-14 14:52:29'),
(2, 8, '777', '1', '2021-04-14 14:52:36', '2021-04-14 14:52:36'),
(3, 9, 'Comisión 1', '1', '2021-04-14 14:52:42', '2021-04-14 14:52:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasas`
--

CREATE TABLE `tasas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `amount` decimal(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tasas`
--

INSERT INTO `tasas` (`id`, `id_user`, `date_begin`, `date_end`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, '2021-05-11', '2021-05-11', '5262110.00', '2021-05-11 15:27:45', '2021-05-11 15:34:22'),
(2, 2, '2021-05-11', NULL, '6651120.00', '2021-05-11 15:34:22', '2021-05-11 15:34:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transports`
--

CREATE TABLE `transports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modelo_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placa` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_transport` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `transports`
--

INSERT INTO `transports` (`id`, `modelo_id`, `color_id`, `user_id`, `type`, `placa`, `photo_transport`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Carro', 'AEU77N', 'sdf', '1', '2021-04-14 18:15:48', '2021-04-14 18:15:48'),
(2, 1, 1, 2, 'Carro', 'DSF5165', 'a', '1', '2021-06-02 14:41:45', '2021-06-02 14:41:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unit_of_measures`
--

CREATE TABLE `unit_of_measures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unit_of_measures`
--

INSERT INTO `unit_of_measures` (`id`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kgs', 'Kilogramos', '1', '2021-04-08 15:23:38', '2021-04-08 15:23:38'),
(2, 'Lts', 'Litros', '1', '2021-04-08 15:26:10', '2021-04-08 15:28:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'carlos', 'cefreitas.16@gmail.com', NULL, '$2y$10$NvfvmRMbU6KGGStZHAK9ServKzv/XWTun1S/hfFH1xhYKh30RLSnG', 1, '1', NULL, '2021-04-07 18:27:20', '2021-04-07 18:27:20'),
(3, 'usuario dos', 'usuario2@gmail.com', NULL, '$2y$10$Sh9HiLoMvtX07BO570wuA.NdLIwXZ.n5WWGdsRDL9xUv8Dno4/tIq', 1, '1', NULL, '2021-04-16 16:50:20', '2021-04-16 16:50:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parroquia_id` bigint(20) UNSIGNED NOT NULL,
  `comision_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula_rif` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comision` decimal(64,2) DEFAULT NULL,
  `instagram` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `especification` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vendors`
--

INSERT INTO `vendors` (`id`, `parroquia_id`, `comision_id`, `employee_id`, `user_id`, `code`, `cedula_rif`, `name`, `surname`, `email`, `phone`, `phone2`, `comision`, `instagram`, `facebook`, `twitter`, `especification`, `observation`, `status`, `created_at`, `updated_at`) VALUES
(2, 100801, 1, 2, 2, '561', '626561', 'carlos eduardo', 'asdasd', 'dscds@asdsasd.com', '65105616', '26626222654', '52.00', 'adasd561', 'sdfsdf', 'sdfsdf', 'dsfsdfds', 'sdfsdf', '1', '2021-04-16 14:00:17', '2021-04-16 14:00:17'),
(3, 220701, 2, 2, 2, '561236212', '4894849', 'Scarlet', 'Perez', 'car@car.com', '651561', '651651', '56123.00', 'asd', 'asd', 'asd', 'a', 'a', '1', '2021-05-19 19:14:59', '2021-05-19 19:14:59'),
(4, 230403, 1, 2, 2, 'SDF4156', '5.615.651', 'Giuseppe', 'Pino', 'Giuseppe@gmail.com', '0414 565-1651', '0212 651-5165', '5135351.00', 'a', 'a', 'a', 'a', 'a', '1', '2021-06-02 14:56:14', '2021-06-02 14:56:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `academiclevels`
--
ALTER TABLE `academiclevels`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anticipos`
--
ALTER TABLE `anticipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anticipos_id_client_foreign` (`id_client`),
  ADD KEY `anticipos_id_account_foreign` (`id_account`),
  ADD KEY `anticipos_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `bank_movements`
--
ALTER TABLE `bank_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_movements_id_account_foreign` (`id_account`),
  ADD KEY `bank_movements_id_counterpart_foreign` (`id_counterpart`),
  ADD KEY `bank_movements_id_client_foreign` (`id_client`),
  ADD KEY `bank_movements_id_vendor_foreign` (`id_vendor`),
  ADD KEY `bank_movements_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `bank_vouchers`
--
ALTER TABLE `bank_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_vouchers_id_client_foreign` (`id_client`),
  ADD KEY `bank_vouchers_id_vendor_foreign` (`id_vendor`),
  ADD KEY `bank_vouchers_id_provider_foreign` (`id_provider`),
  ADD KEY `bank_vouchers_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_company_id_foreign` (`company_id`),
  ADD KEY `branches_parroquia_id_foreign` (`parroquia_id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_id_vendor_foreign` (`id_vendor`);

--
-- Indices de la tabla `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comision_types`
--
ALTER TABLE `comision_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_login_unique` (`login`),
  ADD UNIQUE KEY `companies_email_unique` (`email`),
  ADD UNIQUE KEY `companies_razon_social_unique` (`razon_social`),
  ADD KEY `companies_tipoinv_id_foreign` (`tipoinv_id`),
  ADD KEY `companies_tiporate_id_foreign` (`tiporate_id`);

--
-- Indices de la tabla `detail_vouchers`
--
ALTER TABLE `detail_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_vouchers_id_account_foreign` (`id_account`),
  ADD KEY `detail_vouchers_id_header_voucher_foreign` (`id_header_voucher`),
  ADD KEY `detail_vouchers_id_invoice_foreign` (`id_invoice`),
  ADD KEY `detail_vouchers_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_parroquia_id_foreign` (`parroquia_id`),
  ADD KEY `employees_municipio_id_foreign` (`municipio_id`),
  ADD KEY `employees_estado_id_foreign` (`estado_id`),
  ADD KEY `employees_profession_id_foreign` (`profession_id`),
  ADD KEY `employees_salary_types_id_foreign` (`salary_types_id`),
  ADD KEY `employees_position_id_foreign` (`position_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estados_descripcion_unique` (`descripcion`);

--
-- Indices de la tabla `expenses_and_purchases`
--
ALTER TABLE `expenses_and_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_and_purchases_id_provider_foreign` (`id_provider`),
  ADD KEY `expenses_and_purchases_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `expenses_details`
--
ALTER TABLE `expenses_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_details_id_expense_foreign` (`id_expense`),
  ADD KEY `expenses_details_id_inventory_foreign` (`id_inventory`),
  ADD KEY `expenses_details_id_account_foreign` (`id_account`),
  ADD KEY `expenses_details_id_user_foreign` (`id_user`),
  ADD KEY `expenses_details_id_branch_foreign` (`id_branch`);

--
-- Indices de la tabla `expense_payments`
--
ALTER TABLE `expense_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_payments_id_expense_foreign` (`id_expense`),
  ADD KEY `expense_payments_id_account_foreign` (`id_account`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `header_vouchers`
--
ALTER TABLE `header_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historic_transports`
--
ALTER TABLE `historic_transports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historic_transports_employee_id_foreign` (`employee_id`),
  ADD KEY `historic_transports_transport_id_foreign` (`transport_id`);

--
-- Indices de la tabla `index_bcvs`
--
ALTER TABLE `index_bcvs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventary_types`
--
ALTER TABLE `inventary_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventary_types_description_unique` (`description`);

--
-- Indices de la tabla `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipios_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `nominas`
--
ALTER TABLE `nominas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nominas_id_profession_foreign` (`id_profession`);

--
-- Indices de la tabla `nomina_calculations`
--
ALTER TABLE `nomina_calculations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomina_calculations_id_nomina_foreign` (`id_nomina`),
  ADD KEY `nomina_calculations_id_nomina_concept_foreign` (`id_nomina_concept`),
  ADD KEY `nomina_calculations_id_employee_foreign` (`id_employee`);

--
-- Indices de la tabla `nomina_concepts`
--
ALTER TABLE `nomina_concepts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nomina_formulas`
--
ALTER TABLE `nomina_formulas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nomina_types`
--
ALTER TABLE `nomina_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parroquias_estado_id_foreign` (`estado_id`),
  ADD KEY `parroquias_municipio_id_foreign` (`municipio_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_segment_id_foreign` (`segment_id`),
  ADD KEY `products_subsegment_id_foreign` (`subsegment_id`),
  ADD KEY `products_unit_of_measure_id_foreign` (`unit_of_measure_id`);

--
-- Indices de la tabla `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotations_id_client_foreign` (`id_client`),
  ADD KEY `quotations_id_vendor_foreign` (`id_vendor`),
  ADD KEY `quotations_id_transport_foreign` (`id_transport`),
  ADD KEY `quotations_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `quotation_payments`
--
ALTER TABLE `quotation_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotation_payments_id_quotation_foreign` (`id_quotation`),
  ADD KEY `quotation_payments_id_account_foreign` (`id_account`);

--
-- Indices de la tabla `quotation_products`
--
ALTER TABLE `quotation_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotation_products_id_quotation_foreign` (`id_quotation`),
  ADD KEY `quotation_products_id_inventory_foreign` (`id_inventory`);

--
-- Indices de la tabla `rate_types`
--
ALTER TABLE `rate_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rate_types_description_unique` (`description`);

--
-- Indices de la tabla `receipt_vacations`
--
ALTER TABLE `receipt_vacations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_vacations_employee_id_foreign` (`employee_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salary_types`
--
ALTER TABLE `salary_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `segments`
--
ALTER TABLE `segments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subsegments`
--
ALTER TABLE `subsegments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subsegments_segment_id_foreign` (`segment_id`);

--
-- Indices de la tabla `tasas`
--
ALTER TABLE `tasas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasas_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transports_modelo_id_foreign` (`modelo_id`),
  ADD KEY `transports_color_id_foreign` (`color_id`),
  ADD KEY `transports_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `unit_of_measures`
--
ALTER TABLE `unit_of_measures`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendors_parroquia_id_foreign` (`parroquia_id`),
  ADD KEY `vendors_comision_id_foreign` (`comision_id`),
  ADD KEY `vendors_employee_id_foreign` (`employee_id`),
  ADD KEY `vendors_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `academiclevels`
--
ALTER TABLE `academiclevels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `anticipos`
--
ALTER TABLE `anticipos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `bank_movements`
--
ALTER TABLE `bank_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bank_vouchers`
--
ALTER TABLE `bank_vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comision_types`
--
ALTER TABLE `comision_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detail_vouchers`
--
ALTER TABLE `detail_vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `expenses_and_purchases`
--
ALTER TABLE `expenses_and_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `expenses_details`
--
ALTER TABLE `expenses_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `expense_payments`
--
ALTER TABLE `expense_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `header_vouchers`
--
ALTER TABLE `header_vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT de la tabla `historic_transports`
--
ALTER TABLE `historic_transports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `index_bcvs`
--
ALTER TABLE `index_bcvs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inventary_types`
--
ALTER TABLE `inventary_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2402;

--
-- AUTO_INCREMENT de la tabla `nominas`
--
ALTER TABLE `nominas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `nomina_calculations`
--
ALTER TABLE `nomina_calculations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `nomina_concepts`
--
ALTER TABLE `nomina_concepts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `nomina_formulas`
--
ALTER TABLE `nomina_formulas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nomina_types`
--
ALTER TABLE `nomina_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240112;

--
-- AUTO_INCREMENT de la tabla `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `professions`
--
ALTER TABLE `professions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `quotation_payments`
--
ALTER TABLE `quotation_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `quotation_products`
--
ALTER TABLE `quotation_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `rate_types`
--
ALTER TABLE `rate_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `receipt_vacations`
--
ALTER TABLE `receipt_vacations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `salary_types`
--
ALTER TABLE `salary_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `segments`
--
ALTER TABLE `segments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `subsegments`
--
ALTER TABLE `subsegments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tasas`
--
ALTER TABLE `tasas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `transports`
--
ALTER TABLE `transports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `unit_of_measures`
--
ALTER TABLE `unit_of_measures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anticipos`
--
ALTER TABLE `anticipos`
  ADD CONSTRAINT `anticipos_id_account_foreign` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `anticipos_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `anticipos_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `bank_movements`
--
ALTER TABLE `bank_movements`
  ADD CONSTRAINT `bank_movements_id_account_foreign` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `bank_movements_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `bank_movements_id_counterpart_foreign` FOREIGN KEY (`id_counterpart`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `bank_movements_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bank_movements_id_vendor_foreign` FOREIGN KEY (`id_vendor`) REFERENCES `vendors` (`id`);

--
-- Filtros para la tabla `bank_vouchers`
--
ALTER TABLE `bank_vouchers`
  ADD CONSTRAINT `bank_vouchers_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `bank_vouchers_id_provider_foreign` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id`),
  ADD CONSTRAINT `bank_vouchers_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bank_vouchers_id_vendor_foreign` FOREIGN KEY (`id_vendor`) REFERENCES `vendors` (`id`);

--
-- Filtros para la tabla `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `branches_parroquia_id_foreign` FOREIGN KEY (`parroquia_id`) REFERENCES `parroquias` (`id`);

--
-- Filtros para la tabla `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_id_vendor_foreign` FOREIGN KEY (`id_vendor`) REFERENCES `vendors` (`id`);

--
-- Filtros para la tabla `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_tipoinv_id_foreign` FOREIGN KEY (`tipoinv_id`) REFERENCES `inventary_types` (`id`),
  ADD CONSTRAINT `companies_tiporate_id_foreign` FOREIGN KEY (`tiporate_id`) REFERENCES `rate_types` (`id`);

--
-- Filtros para la tabla `detail_vouchers`
--
ALTER TABLE `detail_vouchers`
  ADD CONSTRAINT `detail_vouchers_id_account_foreign` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `detail_vouchers_id_header_voucher_foreign` FOREIGN KEY (`id_header_voucher`) REFERENCES `header_vouchers` (`id`),
  ADD CONSTRAINT `detail_vouchers_id_invoice_foreign` FOREIGN KEY (`id_invoice`) REFERENCES `quotations` (`id`),
  ADD CONSTRAINT `detail_vouchers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `employees_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `employees_parroquia_id_foreign` FOREIGN KEY (`parroquia_id`) REFERENCES `parroquias` (`id`),
  ADD CONSTRAINT `employees_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`),
  ADD CONSTRAINT `employees_profession_id_foreign` FOREIGN KEY (`profession_id`) REFERENCES `professions` (`id`),
  ADD CONSTRAINT `employees_salary_types_id_foreign` FOREIGN KEY (`salary_types_id`) REFERENCES `salary_types` (`id`);

--
-- Filtros para la tabla `expenses_and_purchases`
--
ALTER TABLE `expenses_and_purchases`
  ADD CONSTRAINT `expenses_and_purchases_id_provider_foreign` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id`),
  ADD CONSTRAINT `expenses_and_purchases_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `expenses_details`
--
ALTER TABLE `expenses_details`
  ADD CONSTRAINT `expenses_details_id_account_foreign` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `expenses_details_id_branch_foreign` FOREIGN KEY (`id_branch`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `expenses_details_id_expense_foreign` FOREIGN KEY (`id_expense`) REFERENCES `expenses_and_purchases` (`id`),
  ADD CONSTRAINT `expenses_details_id_inventory_foreign` FOREIGN KEY (`id_inventory`) REFERENCES `inventories` (`id`),
  ADD CONSTRAINT `expenses_details_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `expense_payments`
--
ALTER TABLE `expense_payments`
  ADD CONSTRAINT `expense_payments_id_account_foreign` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `expense_payments_id_expense_foreign` FOREIGN KEY (`id_expense`) REFERENCES `expenses_and_purchases` (`id`);

--
-- Filtros para la tabla `historic_transports`
--
ALTER TABLE `historic_transports`
  ADD CONSTRAINT `historic_transports_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `historic_transports_transport_id_foreign` FOREIGN KEY (`transport_id`) REFERENCES `transports` (`id`);

--
-- Filtros para la tabla `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `nominas`
--
ALTER TABLE `nominas`
  ADD CONSTRAINT `nominas_id_profession_foreign` FOREIGN KEY (`id_profession`) REFERENCES `professions` (`id`);

--
-- Filtros para la tabla `nomina_calculations`
--
ALTER TABLE `nomina_calculations`
  ADD CONSTRAINT `nomina_calculations_id_employee_foreign` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `nomina_calculations_id_nomina_concept_foreign` FOREIGN KEY (`id_nomina_concept`) REFERENCES `nomina_concepts` (`id`),
  ADD CONSTRAINT `nomina_calculations_id_nomina_foreign` FOREIGN KEY (`id_nomina`) REFERENCES `nominas` (`id`);

--
-- Filtros para la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD CONSTRAINT `parroquias_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parroquias_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_segment_id_foreign` FOREIGN KEY (`segment_id`) REFERENCES `segments` (`id`),
  ADD CONSTRAINT `products_subsegment_id_foreign` FOREIGN KEY (`subsegment_id`) REFERENCES `subsegments` (`id`),
  ADD CONSTRAINT `products_unit_of_measure_id_foreign` FOREIGN KEY (`unit_of_measure_id`) REFERENCES `unit_of_measures` (`id`);

--
-- Filtros para la tabla `quotations`
--
ALTER TABLE `quotations`
  ADD CONSTRAINT `quotations_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `quotations_id_transport_foreign` FOREIGN KEY (`id_transport`) REFERENCES `transports` (`id`),
  ADD CONSTRAINT `quotations_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `quotations_id_vendor_foreign` FOREIGN KEY (`id_vendor`) REFERENCES `vendors` (`id`);

--
-- Filtros para la tabla `quotation_payments`
--
ALTER TABLE `quotation_payments`
  ADD CONSTRAINT `quotation_payments_id_account_foreign` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `quotation_payments_id_quotation_foreign` FOREIGN KEY (`id_quotation`) REFERENCES `quotations` (`id`);

--
-- Filtros para la tabla `quotation_products`
--
ALTER TABLE `quotation_products`
  ADD CONSTRAINT `quotation_products_id_inventory_foreign` FOREIGN KEY (`id_inventory`) REFERENCES `inventories` (`id`),
  ADD CONSTRAINT `quotation_products_id_quotation_foreign` FOREIGN KEY (`id_quotation`) REFERENCES `quotations` (`id`);

--
-- Filtros para la tabla `receipt_vacations`
--
ALTER TABLE `receipt_vacations`
  ADD CONSTRAINT `receipt_vacations_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Filtros para la tabla `subsegments`
--
ALTER TABLE `subsegments`
  ADD CONSTRAINT `subsegments_segment_id_foreign` FOREIGN KEY (`segment_id`) REFERENCES `segments` (`id`);

--
-- Filtros para la tabla `tasas`
--
ALTER TABLE `tasas`
  ADD CONSTRAINT `tasas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `transports`
--
ALTER TABLE `transports`
  ADD CONSTRAINT `transports_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  ADD CONSTRAINT `transports_modelo_id_foreign` FOREIGN KEY (`modelo_id`) REFERENCES `modelos` (`id`),
  ADD CONSTRAINT `transports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_comision_id_foreign` FOREIGN KEY (`comision_id`) REFERENCES `comision_types` (`id`),
  ADD CONSTRAINT `vendors_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `vendors_parroquia_id_foreign` FOREIGN KEY (`parroquia_id`) REFERENCES `parroquias` (`id`),
  ADD CONSTRAINT `vendors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
