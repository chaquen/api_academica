-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2017 at 09:53 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mohansof_academica2_0`
--

-- --------------------------------------------------------

--
-- Table structure for table `actividades`
--

CREATE TABLE `actividades` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_actividad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_actividad` enum('documento','video','evento','evaluacion') COLLATE utf8_unicode_ci NOT NULL,
  `activo_desde` datetime DEFAULT NULL,
  `activo_hasta` datetime DEFAULT NULL,
  `estado_actividad` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `actividad_recurso` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_id_modulo_curso` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `actividades`
--

INSERT INTO `actividades` (`id`, `nombre_actividad`, `tipo_actividad`, `activo_desde`, `activo_hasta`, `estado_actividad`, `actividad_recurso`, `fk_id_modulo_curso`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 'paso para crear curso', 'documento', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'COMO CREAR UN CURSO EN HYPATIA.pdf', 27, '2017-12-29 10:23:11', '2017-12-29 10:23:11', NULL),
(28, 'pasos para redimir pin', 'documento', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'COMO REDIMIR UN PIN.pdf', 30, '2017-12-29 10:23:55', '2017-12-29 10:23:55', NULL),
(30, 'Mi primera evaluacion?', 'evaluacion', '2017-12-29 17:00:00', '2017-12-30 17:00:00', '1', '', 27, '2017-12-30 01:47:38', '2017-12-30 01:47:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categorias_cursos`
--

CREATE TABLE `categorias_cursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_categoria` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_categoria` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado_categoria` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorias_cursos`
--

INSERT INTO `categorias_cursos` (`id`, `nombre_categoria`, `descripcion_categoria`, `estado_categoria`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Capacitación plataforma', 'Esta categoría contiene cursos de capacitación de la plataforma', '1', '2017-12-27 22:26:01', '2017-12-27 22:26:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE `cursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_curso` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_curso` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor_curso` decimal(10,2) DEFAULT NULL,
  `fecha_inicio_curso` datetime NOT NULL,
  `fecha_fin_curso` datetime NOT NULL,
  `fk_id_categoria_curso` int(10) UNSIGNED NOT NULL,
  `tipo_curso` enum('pago','gratis','otro') COLLATE utf8_unicode_ci NOT NULL,
  `estado_curso` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id`, `nombre_curso`, `descripcion_curso`, `valor_curso`, `fecha_inicio_curso`, `fecha_fin_curso`, `fk_id_categoria_curso`, `tipo_curso`, `estado_curso`, `created_at`, `updated_at`, `deleted_at`) VALUES
(26, 'COMO USAR LA PLATAFORMA HYPATIA', 'EN ESTE CURSO APRENDERAS USAR LA PLATAFORMA HYPATIA', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'gratis', '1', '2017-12-28 04:05:44', '2017-12-29 10:54:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_permisos_rols`
--

CREATE TABLE `detalle_permisos_rols` (
  `id` int(10) UNSIGNED NOT NULL,
  `fk_id_rol` int(10) UNSIGNED NOT NULL,
  `fk_id_permiso` int(10) UNSIGNED NOT NULL,
  `consultar` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `editar` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `crear` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `eliminar` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalle__usuario__cursos`
--

CREATE TABLE `detalle__usuario__cursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `fk_id_curso` int(10) UNSIGNED NOT NULL,
  `fk_id_usuario` int(10) UNSIGNED NOT NULL,
  `rol` enum('profesor','alumno') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detalle__usuario__cursos`
--

INSERT INTO `detalle__usuario__cursos` (`id`, `fk_id_curso`, `fk_id_usuario`, `rol`, `created_at`, `updated_at`, `deleted_at`) VALUES
(23, 26, 16, 'profesor', '2017-12-28 04:11:03', '2017-12-28 04:11:03', NULL),
(24, 26, 17, 'profesor', '2017-12-28 04:46:37', '2017-12-28 04:46:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_evaluacion` enum('examen','encuesta') COLLATE utf8_unicode_ci NOT NULL,
  `fk_id_actividad` int(10) UNSIGNED NOT NULL,
  `fecha_evaluacion_inicio` datetime NOT NULL,
  `fecha_evaluacion_fin` datetime NOT NULL,
  `estado_evaluacion` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `evaluaciones`
--

INSERT INTO `evaluaciones` (`id`, `tipo_evaluacion`, `fk_id_actividad`, `fecha_evaluacion_inicio`, `fecha_evaluacion_fin`, `estado_evaluacion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'examen', 30, '2017-12-29 17:00:00', '2017-12-30 18:00:00', '1', '2017-12-30 01:50:34', '2017-12-30 01:50:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2017_09_06_034621_create_categorias_cursos_table', 1),
('2017_09_06_035534_create_roles_table', 1),
('2017_09_06_164915_create_usuarios_table', 1),
('2017_09_06_164931_create_cursos_table', 1),
('2017_09_06_164943_create_modulos_table', 1),
('2017_09_06_164952_create_actividades_table', 1),
('2017_09_06_165038_create_evaluaciones_table', 1),
('2017_09_06_165046_create_preguntas_table', 1),
('2017_09_06_165055_create_respuestas_table', 1),
('2017_09_06_165125_create_detalle__usuario__cursos_table', 1),
('2017_09_06_165137_create_notas_table', 1),
('2017_09_06_172322_create_preguntas_evaluacions_table', 1),
('2017_09_06_172336_create_respuestas_del_usuarios_table', 1),
('2017_09_07_035556_create_permisos_table', 1),
('2017_09_07_035622_create_detalle_permisos_rols_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modulos`
--

CREATE TABLE `modulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_modulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_modulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_id_curso` int(10) UNSIGNED NOT NULL,
  `fecha_inicio_modulo` datetime NOT NULL,
  `fecha_fin_modulo` datetime NOT NULL,
  `numero_de_modulo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modulos`
--

INSERT INTO `modulos` (`id`, `nombre_modulo`, `descripcion_modulo`, `fk_id_curso`, `fecha_inicio_modulo`, `fecha_fin_modulo`, `numero_de_modulo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 'Como crear un curso', 'Como crear un curso', 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2017-12-29 09:46:18', '2017-12-29 09:46:18', NULL),
(30, 'Como redimir pin', 'Como redimir pin', 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2017-12-29 10:23:25', '2017-12-29 10:23:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notas`
--

CREATE TABLE `notas` (
  `id` int(10) UNSIGNED NOT NULL,
  `fk_id_dt_curso_usuario` int(10) UNSIGNED NOT NULL,
  `fk_id_actividad` int(10) UNSIGNED NOT NULL,
  `nota_esperada` int(11) NOT NULL,
  `nota_final` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permisos`
--

CREATE TABLE `permisos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_permiso` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_permiso` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado_permiso` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pines`
--

CREATE TABLE `pines` (
  `id` int(11) NOT NULL,
  `fk_id_curso` int(10) UNSIGNED NOT NULL,
  `pin` varchar(256) NOT NULL,
  `estado` enum('activo','redimido','cancelado') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pines`
--

INSERT INTO `pines` (`id`, `fk_id_curso`, `pin`, `estado`, `created_at`, `updated_at`) VALUES
(23, 26, 'V1UeJ6', 'activo', '2017-12-29 13:03:10', '2017-12-29 13:03:10'),
(24, 26, 'GydrQj', 'activo', '2017-12-29 13:10:01', '2017-12-29 13:10:01'),
(25, 26, '7B6WWb', 'activo', '2017-12-29 13:10:01', '2017-12-29 13:10:01'),
(26, 26, 'lbF3LO', 'activo', '2017-12-29 13:10:01', '2017-12-29 13:10:01'),
(27, 26, 'yz3l6r', 'activo', '2017-12-29 13:10:30', '2017-12-29 13:10:30'),
(28, 26, '4JOdWt', 'activo', '2017-12-29 13:10:30', '2017-12-29 13:10:30'),
(29, 26, 'XK5lWv', 'activo', '2017-12-29 13:10:30', '2017-12-29 13:10:30'),
(30, 26, 'XOc9Jc', 'activo', '2017-12-29 13:10:30', '2017-12-29 13:10:30'),
(31, 26, 'kr290h', 'activo', '2017-12-29 13:11:20', '2017-12-29 13:11:20'),
(32, 26, 'Odz7Yw', 'activo', '2017-12-29 13:11:20', '2017-12-29 13:11:20'),
(33, 26, 'TC5su5', 'activo', '2017-12-29 13:11:20', '2017-12-29 13:11:20'),
(34, 26, '1xBQVw', 'activo', '2017-12-29 13:11:20', '2017-12-29 13:11:20'),
(35, 26, 'hfPKDe', 'activo', '2017-12-29 13:11:56', '2017-12-29 13:11:56'),
(36, 26, 'Y1OcZw', 'activo', '2017-12-29 13:11:56', '2017-12-29 13:11:56'),
(37, 26, 'QQjKT6', 'activo', '2017-12-29 13:11:56', '2017-12-29 13:11:56'),
(38, 26, 'pyNQVP', 'activo', '2017-12-29 13:11:56', '2017-12-29 13:11:56'),
(39, 26, 'tNPMIN', 'activo', '2017-12-29 13:15:18', '2017-12-29 13:15:18'),
(40, 26, '6SzImJ', 'activo', '2017-12-29 13:15:18', '2017-12-29 13:15:18'),
(41, 26, 'NVIlJH', 'activo', '2017-12-29 13:15:18', '2017-12-29 13:15:18'),
(42, 26, 'vRYL8l', 'activo', '2017-12-29 13:15:18', '2017-12-29 13:15:18'),
(43, 26, 'pS546b', 'activo', '2017-12-29 13:16:21', '2017-12-29 13:16:21'),
(44, 26, 'yKrqMH', 'activo', '2017-12-29 13:16:21', '2017-12-29 13:16:21'),
(45, 26, 'tY8Fww', 'activo', '2017-12-29 13:16:21', '2017-12-29 13:16:21'),
(46, 26, 'vjId1X', 'activo', '2017-12-29 13:16:21', '2017-12-29 13:16:21'),
(47, 26, '9uVxRv', 'activo', '2017-12-29 13:17:26', '2017-12-29 13:17:26'),
(48, 26, 'Zk64IO', 'activo', '2017-12-29 13:17:26', '2017-12-29 13:17:26'),
(49, 26, 'Ds31LT', 'activo', '2017-12-29 13:17:26', '2017-12-29 13:17:26'),
(50, 26, '2w6gP9', 'activo', '2017-12-29 13:17:26', '2017-12-29 13:17:26'),
(51, 26, 'Lf6sfw', 'activo', '2017-12-29 13:18:07', '2017-12-29 13:18:07'),
(52, 26, 'n9P3NY', 'activo', '2017-12-29 13:18:07', '2017-12-29 13:18:07'),
(53, 26, '8zd0PB', 'activo', '2017-12-29 13:18:07', '2017-12-29 13:18:07'),
(54, 26, 'ybuNWV', 'activo', '2017-12-29 13:18:07', '2017-12-29 13:18:07'),
(55, 26, 'C2xYTR', 'activo', '2017-12-29 13:18:51', '2017-12-29 13:18:51'),
(56, 26, 'cGlRnd', 'activo', '2017-12-29 13:18:51', '2017-12-29 13:18:51'),
(57, 26, 'Oa0aDw', 'activo', '2017-12-29 13:18:51', '2017-12-29 13:18:51'),
(58, 26, 'sKoSum', 'activo', '2017-12-29 13:18:51', '2017-12-29 13:18:51'),
(59, 26, 'h4lKRX', 'activo', '2017-12-29 13:20:02', '2017-12-29 13:20:02'),
(60, 26, 'H5KTIe', 'activo', '2017-12-29 13:20:02', '2017-12-29 13:20:02'),
(61, 26, 'eYtbOt', 'activo', '2017-12-29 13:20:02', '2017-12-29 13:20:02'),
(62, 26, 'pL9K1Y', 'activo', '2017-12-29 13:20:02', '2017-12-29 13:20:02'),
(63, 26, 'F1iZHI', 'activo', '2017-12-29 13:20:50', '2017-12-29 13:20:50'),
(64, 26, 'f0c7hg', 'activo', '2017-12-29 13:20:50', '2017-12-29 13:20:50'),
(65, 26, 'vJpNoH', 'activo', '2017-12-29 13:20:50', '2017-12-29 13:20:50'),
(66, 26, 'Kug1sG', 'activo', '2017-12-29 13:20:50', '2017-12-29 13:20:50'),
(67, 26, '0TyQdv', 'activo', '2017-12-29 13:21:18', '2017-12-29 13:21:18'),
(68, 26, '0CZUV2', 'activo', '2017-12-29 13:21:18', '2017-12-29 13:21:18'),
(69, 26, 'Iy5q54', 'activo', '2017-12-29 13:21:18', '2017-12-29 13:21:18'),
(70, 26, 'uLKl2f', 'activo', '2017-12-29 13:21:18', '2017-12-29 13:21:18'),
(71, 26, 'DwbhE8', 'activo', '2017-12-29 14:10:01', '2017-12-29 14:10:01'),
(72, 26, 'b4JCfH', 'activo', '2017-12-29 14:10:01', '2017-12-29 14:10:01'),
(73, 26, 'NyLjzI', 'activo', '2017-12-29 14:10:01', '2017-12-29 14:10:01'),
(74, 26, 'kn0b2U', 'activo', '2017-12-29 14:10:01', '2017-12-29 14:10:01'),
(75, 26, 'uJiU3w', 'activo', '2017-12-29 14:10:01', '2017-12-29 14:10:01'),
(76, 26, 'IjqlkS', 'activo', '2017-12-29 14:12:00', '2017-12-29 14:12:00'),
(77, 26, 'Gc7crM', 'activo', '2017-12-29 14:12:00', '2017-12-29 14:12:00'),
(78, 26, 'Ugn87B', 'activo', '2017-12-29 14:12:00', '2017-12-29 14:12:00'),
(79, 26, 'LnQadN', 'activo', '2017-12-29 14:12:00', '2017-12-29 14:12:00'),
(80, 26, '1EvdNQ', 'activo', '2017-12-29 14:12:00', '2017-12-29 14:12:00'),
(81, 26, 'lNFd6Q', 'activo', '2017-12-29 14:12:22', '2017-12-29 14:12:22'),
(82, 26, 'QnxksV', 'activo', '2017-12-29 14:12:22', '2017-12-29 14:12:22'),
(83, 26, 'RSthc0', 'activo', '2017-12-29 14:12:22', '2017-12-29 14:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(10) UNSIGNED NOT NULL,
  `argumento_pregunta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_pregunta` enum('cerrada','abierta','cerrada_multiple','cerrada_comentario') COLLATE utf8_unicode_ci NOT NULL,
  `estado_pregunta` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `preguntas`
--

INSERT INTO `preguntas` (`id`, `argumento_pregunta`, `tipo_pregunta`, `estado_pregunta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'aaaaaaaaaaa1111', 'cerrada', '0', '2017-10-25 03:08:51', '2017-12-30 01:23:21', NULL),
(2, 'pp', 'abierta', '0', '2017-10-25 03:10:54', '2017-10-25 21:03:38', NULL),
(3, 'ppp', 'cerrada', '1', '2017-10-25 03:11:40', '2017-10-25 03:11:40', NULL),
(4, 'p', 'cerrada', '1', '2017-10-25 04:11:03', '2017-10-27 08:40:20', NULL),
(5, 'dddd', 'abierta', '1', '2017-10-25 04:17:57', '2017-10-25 21:04:06', NULL),
(6, 'ggg', 'abierta', '1', '2017-10-25 04:23:36', '2017-10-25 20:52:36', NULL),
(7, 'pregunta cerrada', 'cerrada', '1', '2017-10-26 08:07:45', '2017-10-26 08:07:45', NULL),
(11, 'pregunta abierta º', 'abierta', '1', '2017-10-27 22:01:54', '2017-10-27 22:01:54', NULL),
(12, 'pregunta abierta ºª', 'abierta', '1', '2017-10-27 22:03:12', '2017-10-27 22:03:12', NULL),
(13, 'Cuales son los tipos de cursos', 'cerrada', '1', '2017-12-30 01:39:03', '2017-12-30 01:39:03', NULL),
(14, 'Debes crear el primero el modulo y despues la actividad', 'cerrada', '1', '2017-12-30 01:42:19', '2017-12-30 01:42:19', NULL),
(15, 'Debes crear primero la actividad y luego la evaluacion', 'cerrada', '1', '2017-12-30 01:50:18', '2017-12-30 01:50:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `preguntas_evaluacions`
--

CREATE TABLE `preguntas_evaluacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `fk_id_pregunta` int(10) UNSIGNED NOT NULL,
  `fk_id_evaluacion` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `preguntas_evaluacions`
--

INSERT INTO `preguntas_evaluacions` (`id`, `fk_id_pregunta`, `fk_id_evaluacion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 1, '2017-12-30 01:50:34', '2017-12-30 01:50:34', NULL),
(2, 14, 1, '2017-12-30 01:50:34', '2017-12-30 01:50:34', NULL),
(3, 15, 1, '2017-12-30 01:50:34', '2017-12-30 01:50:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(10) UNSIGNED NOT NULL,
  `argumento_respuesta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `es_correcta` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `valor_respuesta` int(11) NOT NULL,
  `fk_id_pregunta` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `respuestas`
--

INSERT INTO `respuestas` (`id`, `argumento_respuesta`, `es_correcta`, `valor_respuesta`, `fk_id_pregunta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', '0', 0, 6, '2017-10-25 04:25:25', '2017-10-25 19:23:04', NULL),
(4, 'aaaaaaaaaaaaa', '1', 0, 6, '2017-10-25 19:59:44', '2017-10-25 20:06:57', NULL),
(5, 'aaaa', '0', 0, 5, '2017-10-25 20:07:40', '2017-10-25 20:08:46', NULL),
(7, 'r1111', '0', 0, 3, '2017-10-25 20:11:39', '2017-10-25 20:11:39', NULL),
(8, 'si', '1', 0, 7, '2017-10-26 08:07:46', '2017-10-26 08:07:46', NULL),
(9, 'no', '0', 0, 7, '2017-10-26 08:07:46', '2017-10-26 08:07:46', NULL),
(10, 'b', '0', 0, 4, '2017-10-27 08:40:34', '2017-10-27 08:40:34', NULL),
(11, 'a', '0', 0, 4, '2017-10-27 08:40:51', '2017-10-27 08:40:51', NULL),
(15, 'Respuesta:', '1', 0, 11, '2017-10-27 22:01:54', '2017-10-27 22:01:54', NULL),
(16, 'Respuesta:', '1', 0, 12, '2017-10-27 22:03:12', '2017-10-27 22:03:12', NULL),
(17, 'gratis y de pago', '1', 0, 13, '2017-12-30 01:39:03', '2017-12-30 01:39:03', NULL),
(18, 'gratis', '0', 0, 13, '2017-12-30 01:39:03', '2017-12-30 01:39:03', NULL),
(19, 'de pago', '0', 0, 13, '2017-12-30 01:39:03', '2017-12-30 01:39:03', NULL),
(20, 'ninguno de los anteriores', '0', 0, 13, '2017-12-30 01:39:03', '2017-12-30 01:39:03', NULL),
(21, 'SI', '1', 0, 14, '2017-12-30 01:42:20', '2017-12-30 01:42:20', NULL),
(22, 'NO', '0', 0, 14, '2017-12-30 01:42:20', '2017-12-30 01:42:20', NULL),
(23, 'Si', '1', 0, 15, '2017-12-30 01:50:18', '2017-12-30 01:50:18', NULL),
(24, 'No', '0', 0, 15, '2017-12-30 01:50:18', '2017-12-30 01:50:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `respuestas_del_usuarios`
--

CREATE TABLE `respuestas_del_usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `fk_id_usuario` int(11) UNSIGNED NOT NULL,
  `fk_id_evaluaciones` int(11) UNSIGNED NOT NULL,
  `fk_id_det_pre_evaluacion` int(10) UNSIGNED NOT NULL,
  `fk_id_respuestas` int(10) UNSIGNED NOT NULL,
  `comentario_respuesta` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_rol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre_rol`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'alumno', NULL, NULL, NULL),
(2, 'profesor', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `correo_usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `documento_usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion_usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_usuario` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `fk_id_rol` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cambio_pass` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `apellido_usuario`, `fecha_nacimiento`, `correo_usuario`, `documento_usuario`, `direccion_usuario`, `telefono_usuario`, `estado_usuario`, `fk_id_rol`, `password`, `remember_token`, `cambio_pass`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'adrian guzman', 'guzman', '0000-00-00', 'edgar@mohansoft.com', NULL, NULL, NULL, '0', 2, '12345', NULL, 'inacti', '2017-09-07 22:19:47', '2017-11-03 23:00:12', NULL),
(3, 'el esgar ', 'duzman', '2017-12-31', 'edgar.guzman21@gmail.co', '123', '23', '123', '0', 1, '123', NULL, 'inacti', '2017-09-13 08:38:32', '2017-12-27 22:12:01', NULL),
(4, 'theeeee', 'gathering', '2017-12-31', '123', '123', '123', '123', '0', 1, '', NULL, 'inacti', '2017-09-13 08:48:28', '2017-09-13 08:48:28', NULL),
(5, 'therrr', 'gathering', '2017-12-31', '123', '123', '123', '123', '0', 1, 'Array', NULL, 'inacti', '2017-09-13 08:50:34', '2017-09-13 08:50:34', NULL),
(6, 'thhhhe ', 'gathering', '2017-12-31', '123', '123', '123', '123', '0', 1, '123', NULL, 'inacti', '2017-09-13 08:50:58', '2017-09-13 08:50:58', NULL),
(7, 'stalin ', 'chacon', '2017-12-22', 'stalin@estudiante.com', '123', '321', '123', '0', 1, '123', NULL, 'inacti', '2017-09-13 08:55:14', '2017-12-28 20:45:31', NULL),
(8, 'stalin', 'el profe', '2017-12-31', 'stalin@elprofe.com', 'wwww', 'ww', 'www', '0', 2, '123', NULL, 'inacti', '2017-09-13 10:04:57', '2017-12-29 17:45:58', NULL),
(9, 'edgra', 'ddd', '2017-12-31', 'e', 'e', 'e', 'e', '0', 2, 'e', NULL, 'inacti', '2017-09-13 10:11:15', '2017-09-13 11:13:32', NULL),
(10, 'edgar', 'e', '0000-00-00', 'e', '', 'e', 'e', '0', 2, 'e', NULL, 'inacti', '2017-09-13 10:55:50', '2017-11-04 03:48:43', NULL),
(11, 'samael', 'ssss', '2017-12-31', 'dddd', '123', 'ddddddd', '123', '0', 1, '12345', NULL, 'inacti', '2017-11-04 03:56:30', '2017-11-04 03:57:49', NULL),
(12, 'edgar', 'eddd', '2017-12-30', 'e', '123456321', 'na gg', '898989', '0', 1, '123', NULL, 'inacti', '2017-12-19 09:00:29', '2017-12-19 09:00:29', NULL),
(13, 'adrian', 'hhh', '1998-12-31', 'e', '333', 'mia casa', '333', '0', 1, '123', NULL, 'inacti', '2017-12-19 09:25:56', '2017-12-19 09:25:56', NULL),
(14, 'el pepe', 'mojica', '2008-12-31', 'e', '666', 'calle mia', '767676', '0', 1, '981', NULL, 'inacti', '2017-12-19 09:51:42', '2017-12-19 09:51:42', NULL),
(15, 'esgar', 'duzman', '2017-12-31', 'stalin@moansoft.comn', '10736842334', '7323251 mi casa', '7323251', '0', 1, '123', NULL, 'inacti', '2017-12-27 05:38:18', '2017-12-27 05:45:30', NULL),
(16, 'Edgar ', 'Allan Peo', '1989-11-15', 'edgar.guzman21@gmail.com', '1073684233', 'cale 9 # 10-21', '7323251', '0', 1, '4321', NULL, '', '2017-12-28 04:11:03', '2017-12-28 21:56:27', NULL),
(17, 'edgar', 'el guzman vargas', '2017-12-31', 'edgar@sos.com', '1234', 'poopop', '1234', '0', 1, '1234', NULL, '', '2017-12-28 04:46:37', '2017-12-29 20:50:42', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actividades_fk_id_modulo_curso_foreign` (`fk_id_modulo_curso`);

--
-- Indexes for table `categorias_cursos`
--
ALTER TABLE `categorias_cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cursos_fk_id_categoria_curso_foreign` (`fk_id_categoria_curso`);

--
-- Indexes for table `detalle_permisos_rols`
--
ALTER TABLE `detalle_permisos_rols`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_permisos_rols_fk_id_rol_foreign` (`fk_id_rol`),
  ADD KEY `detalle_permisos_rols_fk_id_permiso_foreign` (`fk_id_permiso`);

--
-- Indexes for table `detalle__usuario__cursos`
--
ALTER TABLE `detalle__usuario__cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle__usuario__cursos_fk_id_curso_foreign` (`fk_id_curso`),
  ADD KEY `detalle__usuario__cursos_fk_id_usuario_foreign` (`fk_id_usuario`);

--
-- Indexes for table `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluaciones_fk_id_actividad_foreign` (`fk_id_actividad`);

--
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulos_fk_id_curso_foreign` (`fk_id_curso`);

--
-- Indexes for table `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notas_fk_id_dt_curso_usuario_foreign` (`fk_id_dt_curso_usuario`),
  ADD KEY `notas_fk_id_actividad_foreign` (`fk_id_actividad`);

--
-- Indexes for table `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pines`
--
ALTER TABLE `pines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_curso` (`fk_id_curso`);

--
-- Indexes for table `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preguntas_evaluacions`
--
ALTER TABLE `preguntas_evaluacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preguntas_evaluacions_fk_id_pregunta_foreign` (`fk_id_pregunta`),
  ADD KEY `preguntas_evaluacions_fk_id_evaluacion_foreign` (`fk_id_evaluacion`);

--
-- Indexes for table `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respuestas_fk_id_pregunta_foreign` (`fk_id_pregunta`);

--
-- Indexes for table `respuestas_del_usuarios`
--
ALTER TABLE `respuestas_del_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respuestas_del_usuarios_fk_id_det_pre_evaluacion_foreign` (`fk_id_det_pre_evaluacion`),
  ADD KEY `respuestas_del_usuarios_fk_id_respuestas_foreign` (`fk_id_respuestas`),
  ADD KEY `fk_id_usuario` (`fk_id_usuario`),
  ADD KEY `fk_id_evaluaciones` (`fk_id_evaluaciones`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_fk_id_rol_foreign` (`fk_id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `categorias_cursos`
--
ALTER TABLE `categorias_cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `detalle_permisos_rols`
--
ALTER TABLE `detalle_permisos_rols`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detalle__usuario__cursos`
--
ALTER TABLE `detalle__usuario__cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pines`
--
ALTER TABLE `pines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `preguntas_evaluacions`
--
ALTER TABLE `preguntas_evaluacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `respuestas_del_usuarios`
--
ALTER TABLE `respuestas_del_usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_fk_id_modulo_curso_foreign` FOREIGN KEY (`fk_id_modulo_curso`) REFERENCES `modulos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_fk_id_categoria_curso_foreign` FOREIGN KEY (`fk_id_categoria_curso`) REFERENCES `categorias_cursos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detalle_permisos_rols`
--
ALTER TABLE `detalle_permisos_rols`
  ADD CONSTRAINT `detalle_permisos_rols_fk_id_permiso_foreign` FOREIGN KEY (`fk_id_permiso`) REFERENCES `permisos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_permisos_rols_fk_id_rol_foreign` FOREIGN KEY (`fk_id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detalle__usuario__cursos`
--
ALTER TABLE `detalle__usuario__cursos`
  ADD CONSTRAINT `detalle__usuario__cursos_fk_id_curso_foreign` FOREIGN KEY (`fk_id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle__usuario__cursos_fk_id_usuario_foreign` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `evaluaciones_fk_id_actividad_foreign` FOREIGN KEY (`fk_id_actividad`) REFERENCES `actividades` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `modulos`
--
ALTER TABLE `modulos`
  ADD CONSTRAINT `modulos_fk_id_curso_foreign` FOREIGN KEY (`fk_id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_fk_id_actividad_foreign` FOREIGN KEY (`fk_id_actividad`) REFERENCES `actividades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notas_fk_id_dt_curso_usuario_foreign` FOREIGN KEY (`fk_id_dt_curso_usuario`) REFERENCES `detalle__usuario__cursos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pines`
--
ALTER TABLE `pines`
  ADD CONSTRAINT `curso_pin` FOREIGN KEY (`fk_id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preguntas_evaluacions`
--
ALTER TABLE `preguntas_evaluacions`
  ADD CONSTRAINT `preguntas_evaluacions_fk_id_evaluacion_foreign` FOREIGN KEY (`fk_id_evaluacion`) REFERENCES `evaluaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `preguntas_evaluacions_fk_id_pregunta_foreign` FOREIGN KEY (`fk_id_pregunta`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_fk_id_pregunta_foreign` FOREIGN KEY (`fk_id_pregunta`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `respuestas_del_usuarios`
--
ALTER TABLE `respuestas_del_usuarios`
  ADD CONSTRAINT `respuestas_del_usuario_fk_id_evaluacion` FOREIGN KEY (`fk_id_evaluaciones`) REFERENCES `evaluaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_del_usuario_fk_usuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_del_usuarios_fk_id_det_pre_evaluacion_foreign` FOREIGN KEY (`fk_id_det_pre_evaluacion`) REFERENCES `preguntas_evaluacions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_del_usuarios_fk_id_respuestas_foreign` FOREIGN KEY (`fk_id_respuestas`) REFERENCES `respuestas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_fk_id_rol_foreign` FOREIGN KEY (`fk_id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
