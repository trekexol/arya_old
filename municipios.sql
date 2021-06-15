-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-04-2021 a las 13:47:04
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
(101, 'LIBERTADOR', 1, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(201, 'ANACO', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(202, 'ARAGUA', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(203, 'SIMON BOLIVAR', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(204, 'MANUEL EZEQUIEL BRUZUAL', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(205, 'JUAN MANUEL CAJIGAL', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(206, 'PEDRO MARIA FREITES', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(207, 'INDEPENDENCIA', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(208, 'LIBERTAD', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(209, 'FRANCISCO DE MIRANDA', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(210, 'JOSE GREGORIO MONAGAS', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(211, 'FERNANDO PEÑALVER', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(212, 'SIMON RODRIGUEZ', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(213, 'JUAN ANTONIO SOTILLO', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(214, 'SAN JOSE DE GUANIPA', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(215, 'GUANTA', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(216, 'PIRITU', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(217, 'DIEGO BAUTISTA URBANEJA', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(218, 'FRANCISCO DEL CARMEN CARVAJAL', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(219, 'SANTA ANA', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(220, 'GENERAL SIR ARTHUR MCGREGOR', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(221, 'SAN JUAN DE CAPISTRANO', 2, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(301, 'ACHAGUAS', 3, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(302, 'MUÑOZ', 3, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(303, 'PAEZ', 3, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(304, 'PEDRO CAMEJO', 3, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(305, 'ROMULO GALLEGOS', 3, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(306, 'SAN FERNANDO', 3, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(307, 'BIRUACA', 3, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(401, 'GIRARDOT', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(402, 'SANTIAGO MARIÑO', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(403, 'JOSE FELIX RIBAS', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(404, 'SAN CASIMIRO', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(405, 'SAN SEBASTIAN', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(406, 'SUCRE', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(407, 'URDANETA', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(408, 'ZAMORA', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(409, 'LIBERTADOR', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(410, 'JOSE ANGEL LAMAS', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(411, 'BOLIVAR', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(412, 'SANTOS MICHELENA', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(413, 'MARIO BRICEÑO IRAGORRY', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(414, 'TOVAR', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(415, 'CAMATAGUA', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(416, 'JOSE RAFAEL REVENGA', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(417, 'FRANCISCO LINARES ALCANTARA', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(418, 'OCUMARE DE LA COSTA DE ORO', 4, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(501, 'ARISMENDI', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(502, 'BARINAS', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(503, 'BOLIVAR', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(504, 'EZEQUIEL ZAMORA', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(505, 'OBISPOS', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(506, 'PEDRAZA', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(507, 'ROJAS', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(508, 'SOSA', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(509, 'ALBERTO ARVELO TORREALBA', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(510, 'ANTONIO JOSE DE SUCRE', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(511, 'CRUZ PAREDES', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(512, 'ANDRES ELOY BLANCO', 5, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(601, 'CARONI', 6, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(602, 'CEDEÑO', 6, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(603, 'HERES', 6, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(604, 'PIAR', 6, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(605, 'ROSCIO', 6, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(606, 'SUCRE', 6, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(607, 'SIFONTES', 6, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(608, 'ANGOSTURA', 6, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(609, 'GRAN SABANA', 6, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(610, 'EL CALLAO', 6, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(611, 'PADRE PEDRO CHIEN', 6, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(701, 'BEJUMA', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(702, 'CARLOS ARVELO', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(703, 'DIEGO IBARRA', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(704, 'GUACARA', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(705, 'MONTALBAN', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(706, 'JUAN JOSE MORA', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(707, 'PUERTO CABELLO', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(708, 'SAN JOAQUIN', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(709, 'VALENCIA', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(710, 'MIRANDA', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(711, 'LOS GUAYOS', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(712, 'NAGUANAGUA', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(713, 'SAN DIEGO', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(714, 'LIBERTADOR', 7, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(801, 'ANZOATEGUI', 8, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(802, 'TINAQUILLO', 8, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(803, 'GIRARDOT', 8, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(804, 'PAO DE SAN JUAN BAUTISTA', 8, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(805, 'RICAURTE', 8, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(806, 'EZEQUIEL ZAMORA', 8, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(807, 'TINACO', 8, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(808, 'LIMA BLANCO', 8, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(809, 'ROMULO GALLEGOS', 8, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(901, 'ACOSTA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(902, 'BOLIVAR', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(903, 'BUCHIVACOA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(904, 'CARIRUBANA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(905, 'COLINA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(906, 'DEMOCRACIA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(907, 'FALCON', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(908, 'FEDERACION', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(909, 'MAUROA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(910, 'MIRANDA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(911, 'PETIT', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(912, 'JOSE LAURENCIO SILVA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(913, 'ZAMORA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(914, 'DABAJURO', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(915, 'MONSEÑOR ITURRIZA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(916, 'LOS TAQUES', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(917, 'PIRITU', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(918, 'UNION', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(919, 'SAN FRANCISCO', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(920, 'JACURA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(921, 'CACIQUE MANAURE', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(922, 'PALMASOLA', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(923, 'SUCRE', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(924, 'URUMACO', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(925, 'TOCOPERO', 9, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1001, 'LEONARDO INFANTE', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1002, 'JULIAN MELLADO', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1003, 'FRANCISCO DE MIRANDA', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1004, 'JOSE TADEO MONAGAS', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1005, 'JOSE FELIX RIBAS', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1006, 'JUAN GERMAN ROSCIO', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1007, 'PEDRO ZARAZA', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1008, 'CAMAGUAN', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1009, 'SAN JOSE DE GUARIBE', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1010, 'LAS MERCEDES', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1011, 'EL SOCORRO', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1012, 'ORTIZ', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1013, 'SANTA MARIA DE IPIRE', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1014, 'CHAGUARAMAS', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1015, 'SAN GERONIMO DE GUAYABAL', 10, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1101, 'CRESPO', 11, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1102, 'IRIBARREN', 11, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1103, 'JIMENEZ', 11, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1104, 'MORAN', 11, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1105, 'PALAVECINO', 11, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1106, 'TORRES', 11, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1107, 'URDANETA', 11, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1108, 'ANDRES ELOY BLANCO', 11, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1109, 'SIMON PLANAS', 11, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1201, 'ALBERTO ADRIANI', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1202, 'ANDRES BELLO', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1203, 'ARZOBISPO CHACON', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1204, 'CAMPO ELIAS', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1205, 'GUARAQUE', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1206, 'JULIO CESAR SALAS', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1207, 'JUSTO BRICEÑO', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1208, 'LIBERTADOR', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1209, 'SANTOS MARQUINA', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1210, 'MIRANDA', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1211, 'ANTONIO PINTO SALINAS', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1212, 'OBISPO RAMOS DE LORA', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1213, 'CARACCIOLO PARRA OLMEDO', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1214, 'CARDENAL QUINTERO', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1215, 'PUEBLO LLANO', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1216, 'RANGEL', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1217, 'RIVAS DAVILA', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1218, 'SUCRE', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1219, 'TOVAR', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1220, 'TULIO FEBRES CORDERO', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1221, 'PADRE NOGUERA', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1222, 'ARICAGUA', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1223, 'ZEA', 12, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1301, 'ACEVEDO', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1302, 'BRION', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1303, 'GUAICAIPURO', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1304, 'INDEPENDENCIA', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1305, 'LANDER', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1306, 'PAEZ', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1307, 'PAZ CASTILLO', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1308, 'PLAZA', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1309, 'SUCRE', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1310, 'URDANETA', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1311, 'ZAMORA', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1312, 'CRISTOBAL ROJAS', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1313, 'LOS SALIAS', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1314, 'ANDRES BELLO', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1315, 'SIMON BOLIVAR', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1316, 'BARUTA', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1317, 'CARRIZAL', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1318, 'CHACAO', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1319, 'EL HATILLO', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1320, 'BUROZ', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1321, 'PEDRO GUAL', 13, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1401, 'ACOSTA', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1402, 'BOLIVAR', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1403, 'CARIPE', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1404, 'CEDEÑO', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1405, 'EZEQUIEL ZAMORA', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1406, 'LIBERTADOR', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1407, 'MATURIN', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1408, 'PIAR', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1409, 'PUNCERES', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1410, 'SOTILLO', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1411, 'AGUASAY', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1412, 'SANTA BARBARA', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1413, 'URACOA', 14, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1501, 'ARISMENDI', 15, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1502, 'DIAZ', 15, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1503, 'GOMEZ', 15, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1504, 'MANEIRO', 15, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1505, 'MARCANO', 15, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1506, 'MARIÑO', 15, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1507, 'MACANAO', 15, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1508, 'VILLALBA', 15, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1509, 'TUBORES', 15, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1510, 'ANTOLIN DEL CAMPO', 15, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1511, 'GARCIA', 15, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1601, 'ARAURE', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1602, 'ESTELLER', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1603, 'GUANARE', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1604, 'GUANARITO', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1605, 'OSPINO', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1606, 'PAEZ', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1607, 'SUCRE', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1608, 'TUREN', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1609, 'MONSEÑOR JOSE VICENTE DE UNDA', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1610, 'AGUA BLANCA', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1611, 'PAPELON', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1612, 'SAN GENARO DE BOCONOITO', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1613, 'SAN RAFAEL DE ONOTO', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1614, 'SANTA ROSALIA', 16, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1701, 'ARISMENDI', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1702, 'BENITEZ', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1703, 'BERMUDEZ', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1704, 'CAJIGAL', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1705, 'MARIÑO', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1706, 'MEJIA', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1707, 'MONTES', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1708, 'RIBERO', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1709, 'SUCRE', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1710, 'VALDEZ', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1711, 'ANDRES ELOY BLANCO', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1712, 'LIBERTADOR', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1713, 'ANDRES MATA', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1714, 'BOLIVAR', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1715, 'CRUZ SALMERON ACOSTA', 17, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1801, 'AYACUCHO', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1802, 'BOLIVAR', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1803, 'INDEPENDENCIA', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1804, 'CARDENAS', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1805, 'JAUREGUI', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1806, 'JUNIN', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1807, 'LOBATERA', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1808, 'SAN CRISTOBAL', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1809, 'URIBANTE', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1810, 'CORDOBA', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1811, 'GARCIA DE HEVIA', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1812, 'GUASIMOS', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1813, 'MICHELENA', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1814, 'LIBERTADOR', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1815, 'PANAMERICANO', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1816, 'PEDRO MARIA UREÑA', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1817, 'SUCRE', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1818, 'ANDRES BELLO', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1819, 'FERNANDEZ FEO', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1820, 'LIBERTAD', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1821, 'SAMUEL DARIO MALDONADO', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1822, 'SEBORUCO', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1823, 'ANTONIO ROMULO COSTA', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1824, 'FRANCISCO DE MIRANDA', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1825, 'JOSE MARIA VARGAS', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1826, 'RAFAEL URDANETA', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1827, 'SIMON RODRIGUEZ', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1828, 'TORBES', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1829, 'SAN JUDAS TADEO', 18, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1901, 'RAFAEL RANGEL', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1902, 'BOCONO', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1903, 'CARACHE', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1904, 'ESCUQUE', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1905, 'TRUJILLO', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1906, 'URDANETA', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1907, 'VALERA', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1908, 'CANDELARIA', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1909, 'MIRANDA', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1910, 'MONTE CARMELO', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1911, 'MOTATAN', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1912, 'PAMPAN', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1913, 'SAN RAFAEL DE CARVAJAL', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1914, 'SUCRE', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1915, 'ANDRES BELLO', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1916, 'BOLIVAR', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1917, 'JOSE FELIPE MARQUEZ CAÑIZALES', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1918, 'JUAN VICENTE CAMPO ELIAS', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1919, 'LA CEIBA', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(1920, 'PAMPANITO', 19, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2001, 'BOLIVAR', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2002, 'BRUZUAL', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2003, 'NIRGUA', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2004, 'SAN FELIPE', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2005, 'SUCRE', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2006, 'URACHICHE', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2007, 'PEÑA', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2008, 'JOSE ANTONIO PAEZ', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2009, 'LA TRINIDAD', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2010, 'COCOROTE', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2011, 'INDEPENDENCIA', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2012, 'ARISTIDES BASTIDAS', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2013, 'MANUEL MONGE', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2014, 'JOSE JOAQUIN VEROES', 20, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2101, 'BARALT', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2102, 'SANTA RITA', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2103, 'COLON', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2104, 'MARA', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2105, 'MARACAIBO', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2106, 'MIRANDA', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2107, 'GUAJIRA', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2108, 'MACHIQUES DE PERIJA', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2109, 'SUCRE', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2110, 'LA CAÑADA DE URDANETA', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2111, 'LAGUNILLAS', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2112, 'CATATUMBO', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2113, 'ROSARIO DE PERIJA', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2114, 'CABIMAS', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2115, 'VALMORE RODRIGUEZ', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2116, 'JESUS ENRIQUE LOSSADA', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2117, 'ALMIRANTE PADILLA', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2118, 'SAN FRANCISCO', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2119, 'JESUS MARIA SEMPRUM', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2120, 'FRANCISCO JAVIER PULGAR', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2121, 'SIMON BOLIVAR', 21, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2201, 'ATURES', 22, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2202, 'ATABAPO', 22, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2203, 'MAROA', 22, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2204, 'RIO NEGRO', 22, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2205, 'AUTANA', 22, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2206, 'MANAPIARE', 22, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2207, 'ALTO ORINOCO', 22, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2301, 'TUCUPITA', 23, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2302, 'PEDERNALES', 23, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2303, 'ANTONIO DIAZ', 23, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2304, 'CASACOIMA', 23, '2020-04-20 01:55:55', '2020-04-20 01:55:55'),
(2401, 'LA GUAIRA', 24, '2020-04-20 01:55:55', '2020-04-20 01:55:55');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipios_estado_id_foreign` (`estado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2402;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
