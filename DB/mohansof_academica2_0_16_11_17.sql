-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2017 at 08:31 PM
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
(1, 'actividad 1 EVALIACUON', 'evaluacion', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'psicologia_revolucionaria.pdf', 8, '2017-09-07 23:23:39', '2017-09-07 23:23:39', NULL),
(2, 'actividad 2', 'documento', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'psicologia_revolucionaria.pdf', 10, '2017-09-07 23:23:39', '2017-09-07 23:23:39', NULL),
(3, 'actividad 3', 'documento', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'psicologia_revolucionaria.pdf', 10, '2017-09-07 23:23:39', '2017-09-07 23:23:39', NULL),
(4, 'webiunar', 'evento', '2017-12-31 20:59:00', '2017-12-31 23:59:00', '1', 'https://www.youtube.com/user/mohan8915/live', 7, '2017-09-13 21:22:58', '2017-09-13 21:22:58', NULL),
(5, 'prueb ade web', 'evento', '2017-12-31 23:59:00', '2017-12-31 23:59:00', '1', 'mi casa', 9, '2017-09-14 08:58:11', '2017-09-14 08:58:11', NULL),
(6, 'a', 'documento', '2017-09-13 23:59:00', '2017-09-13 23:59:00', '1', 'psicologia_revolucionaria.pdf', 16, '2017-09-14 09:09:26', '2017-09-14 09:09:26', NULL),
(7, 'una pueba', 'video', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'NHcvL-GU08g', 16, '2017-09-14 21:14:08', '2017-09-14 21:14:08', NULL),
(8, 'aaaa', 'evento', '2017-09-18 05:59:00', '2017-09-18 09:59:00', '1', 'dddddddddd', 16, '2017-09-14 09:09:26', '2017-09-14 09:09:26', NULL),
(9, 'evaluacion final', 'evaluacion', '2017-12-30 23:59:00', '2017-12-31 23:59:00', '1', 'evento', 16, '2017-09-19 08:00:58', '2017-09-19 08:00:58', NULL),
(10, '', 'evento', '2017-09-20 23:00:00', '2017-01-01 23:00:00', '1', 'https://www.youtube.com/watch?v=iHn0oIfetq8', 9, '2017-09-20 04:30:07', '2017-09-20 04:30:07', NULL),
(11, 'NOMBRE DEL EVENTO', 'evento', '2017-09-19 23:00:00', '2017-09-19 23:00:00', '1', 'https://www.youtube.com/watch?v=iHn0oIfetq8', 9, '2017-09-20 04:31:30', '2017-09-20 04:31:30', NULL),
(12, 'EVALUACION FINAL', 'evaluacion', '2017-10-12 18:00:00', '2017-10-12 17:00:00', '1', 'https://www.youtube.com/watch?v=5WlCdiU9IzA', 16, '2017-10-12 04:35:32', '2017-10-12 04:35:32', NULL),
(13, 'actividad documento', 'documento', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'publicacion23-03-16.pptx', 17, '2017-11-04 03:17:57', '2017-11-04 03:17:57', NULL),
(14, 'contenido', 'video', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'OD3F7J2PeYU', 17, '2017-11-04 03:17:57', '2017-11-04 03:17:57', NULL),
(15, 'contenido 1 modulo 2', 'documento', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'detalle_facturacion_31_03_17.xlsx', 18, '2017-11-04 03:17:57', '2017-11-04 03:17:57', NULL),
(16, 'video introductvo', 'video', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'OD3F7J2PeYU', 18, '2017-11-04 03:17:57', '2017-11-04 03:17:57', NULL),
(17, 'ed', 'evento', '2017-12-31 23:59:00', '2017-12-31 23:59:00', '1', 'chrome-extension://bigefpfhnfcobdlfbedofhhaibnlghod/mega/secure.html#fm/g4dxECra', 7, '2017-11-04 03:55:37', '2017-11-04 03:55:37', NULL);

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
(1, 'Categoria 1', '', '1', NULL, NULL, NULL),
(2, 'Categoria 2', '', '1', NULL, NULL, NULL);

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
(15, 'Edgar el curso', 'es una chimba', '0.00', '2017-12-31 00:00:00', '2018-12-30 00:00:00', 1, 'gratis', '1', '2017-09-07 23:10:41', '2017-09-20 22:02:40', NULL),
(16, 'adrian el man tan aspero', 'adrian el aspero', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'pago', '1', '2017-09-07 23:13:27', '2017-09-07 23:13:27', NULL),
(17, 'p', 'p', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'gratis', '0', '2017-09-07 23:20:57', '2017-09-07 23:20:57', NULL),
(18, 'pss', 'p', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'gratis', '1', '2017-09-07 23:21:35', '2017-09-07 23:21:35', NULL),
(19, 'pssdd', 'p', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'gratis', '1', '2017-09-07 23:22:13', '2017-09-07 23:22:13', NULL),
(20, 'pssddd', 'p', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'gratis', '1', '2017-09-07 23:22:46', '2017-09-07 23:22:46', NULL),
(21, 'pues si', 'p', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'gratis', '1', '2017-09-07 23:23:11', '2017-09-07 23:23:11', NULL),
(22, 'pues si mi', 'p', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'gratis', '1', '2017-09-07 23:23:39', '2017-09-07 23:23:39', NULL),
(23, 'pues si mi D', 'p', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'gratis', '1', '2017-09-08 02:16:54', '2017-09-08 02:16:54', NULL),
(24, 'prueba de curso', 'edgar es una prueba', '0.00', '2017-09-14 00:00:00', '2017-09-15 00:00:00', 1, 'gratis', '1', '2017-09-14 21:14:08', '2017-09-15 02:16:29', NULL),
(25, 'ed curso', 'la descripcion', NULL, '2017-10-31 00:00:00', '2017-12-31 00:00:00', 2, 'gratis', '1', '2017-11-04 03:17:56', '2017-11-04 03:17:56', NULL);

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
(1, 24, 3, 'alumno', NULL, NULL, NULL),
(3, 16, 4, 'profesor', '2017-09-13 08:48:28', '2017-09-13 08:48:28', NULL),
(4, 16, 6, 'profesor', '2017-09-13 08:50:59', '2017-09-13 08:50:59', NULL),
(5, 16, 1, 'alumno', '2017-09-13 08:55:14', '2017-09-13 08:55:14', NULL),
(6, 15, 11, 'profesor', '2017-11-04 03:56:30', '2017-11-04 03:56:30', NULL);

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
(6, 'examen', 1, '2017-10-26 14:45:00', '2017-10-27 16:00:00', '1', '2017-10-26 23:36:53', '2017-10-26 23:36:53', NULL);

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
(7, 'm1', '', 15, '2017-12-31 00:00:00', '2018-01-01 00:00:00', 1, '2017-09-07 23:10:41', '2017-09-07 23:10:41', NULL),
(8, 'm1', '', 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2017-09-07 23:13:27', '2017-09-07 23:13:27', NULL),
(9, 'modulo 1', '', 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2017-09-07 23:20:57', '2017-09-07 23:20:57', NULL),
(10, 'modulo 2', '', 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2017-09-07 23:21:35', '2017-09-07 23:21:35', NULL),
(11, 'ss', '', 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2017-09-07 23:22:13', '2017-09-07 23:22:13', NULL),
(12, 'ss', '', 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2017-09-07 23:22:46', '2017-09-07 23:22:46', NULL),
(13, 'ss', '', 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2017-09-07 23:23:11', '2017-09-07 23:23:11', NULL),
(14, 'ss', '', 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2017-09-07 23:23:39', '2017-09-07 23:23:39', NULL),
(15, 'ss', '', 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2017-09-08 02:16:54', '2017-09-08 02:16:54', NULL),
(16, 'modulo 1', '', 24, '2017-09-14 00:00:00', '2017-09-14 00:00:00', 1, '2017-09-14 21:14:08', '2017-09-14 21:14:08', NULL),
(17, 'mo1', '', 25, '2017-10-31 00:00:00', '2017-11-04 00:00:00', 1, '2017-11-04 03:17:56', '2017-11-04 03:17:56', NULL),
(18, 'modulo 2', '', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, '2017-11-04 03:17:57', '2017-11-04 03:17:57', NULL);

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
(1, 'aaaaaaaaaaa', 'abierta', '0', '2017-10-25 03:08:51', '2017-10-25 20:09:08', NULL),
(2, 'pp', 'abierta', '0', '2017-10-25 03:10:54', '2017-10-25 21:03:38', NULL),
(3, 'ppp', 'cerrada', '1', '2017-10-25 03:11:40', '2017-10-25 03:11:40', NULL),
(4, 'p', 'cerrada', '1', '2017-10-25 04:11:03', '2017-10-27 08:40:20', NULL),
(5, 'dddd', 'abierta', '1', '2017-10-25 04:17:57', '2017-10-25 21:04:06', NULL),
(6, 'ggg', 'abierta', '1', '2017-10-25 04:23:36', '2017-10-25 20:52:36', NULL),
(7, 'pregunta cerrada', 'cerrada', '1', '2017-10-26 08:07:45', '2017-10-26 08:07:45', NULL),
(11, 'pregunta abierta º', 'abierta', '1', '2017-10-27 22:01:54', '2017-10-27 22:01:54', NULL),
(12, 'pregunta abierta ºª', 'abierta', '1', '2017-10-27 22:03:12', '2017-10-27 22:03:12', NULL);

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
(1, 12, 6, '2017-10-26 23:36:53', '2017-10-26 23:36:53', NULL),
(2, 3, 6, '2017-10-26 23:36:54', '2017-10-26 23:36:54', NULL),
(3, 6, 6, '2017-10-27 07:59:58', '2017-10-27 07:59:58', NULL),
(4, 5, 6, '2017-10-27 08:00:05', '2017-10-27 08:00:05', NULL);

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
(16, 'Respuesta:', '1', 0, 12, '2017-10-27 22:03:12', '2017-10-27 22:03:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `respuestas_del_usuarios`
--

CREATE TABLE `respuestas_del_usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `fk_id_usuario` int(11) UNSIGNED NOT NULL,
  `fk_id_det_pre_evaluacion` int(10) UNSIGNED NOT NULL,
  `fk_id_respuestas` int(10) UNSIGNED NOT NULL,
  `comentario_respuesta` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `respuestas_del_usuarios`
--

INSERT INTO `respuestas_del_usuarios` (`id`, `fk_id_usuario`, `fk_id_det_pre_evaluacion`, `fk_id_respuestas`, `comentario_respuesta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(24, 3, 1, 16, '1', NULL, NULL, NULL),
(25, 3, 2, 7, '', NULL, NULL, NULL),
(26, 3, 3, 1, '2', NULL, NULL, NULL),
(27, 3, 4, 5, '3', NULL, NULL, NULL),
(28, 3, 1, 16, 'EE', NULL, NULL, NULL),
(29, 3, 2, 7, '', NULL, NULL, NULL),
(30, 3, 3, 1, 'AA', NULL, NULL, NULL),
(31, 3, 4, 5, 'Aº', NULL, NULL, NULL);

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
  `red` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_red` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_id_rol` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `apellido_usuario`, `fecha_nacimiento`, `correo_usuario`, `documento_usuario`, `direccion_usuario`, `telefono_usuario`, `estado_usuario`, `red`, `id_red`, `fk_id_rol`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'adrian guzman', 'guzman', '0000-00-00', 'edgar@mohansoft.com', NULL, NULL, NULL, '0', '', '', 2, '12345', NULL, '2017-09-07 22:19:47', '2017-11-03 23:00:12', NULL),
(3, 'el esgar ', 'duzman', '2017-12-31', 'edgar.guzman21@gmail.com', '123', '23', '123', '0', '', '', 1, '123', NULL, '2017-09-13 08:38:32', '2017-11-03 23:16:03', NULL),
(4, 'theeeee', 'gathering', '2017-12-31', '123', '123', '123', '123', '0', '', '', 1, '', NULL, '2017-09-13 08:48:28', '2017-09-13 08:48:28', NULL),
(5, 'therrr', 'gathering', '2017-12-31', '123', '123', '123', '123', '0', '', '', 1, 'Array', NULL, '2017-09-13 08:50:34', '2017-09-13 08:50:34', NULL),
(6, 'thhhhe ', 'gathering', '2017-12-31', '123', '123', '123', '123', '0', '', '', 1, '123', NULL, '2017-09-13 08:50:58', '2017-09-13 08:50:58', NULL),
(7, 'stalin ', 'all you need si now', '2017-12-22', 'stalin@estudiante.com', '222', '222', '222', '0', '', '', 1, '123', NULL, '2017-09-13 08:55:14', '2017-09-13 08:55:14', NULL),
(8, 'stalin', 'el profe', '2017-12-31', 'stalin@elprofe.com', 'wwww', 'ww', 'www', '0', '', '', 2, '123', NULL, '2017-09-13 10:04:57', '2017-09-13 10:04:57', NULL),
(9, 'edgra', 'ddd', '2017-12-31', 'e', 'e', 'e', 'e', '0', '', '', 2, 'e', NULL, '2017-09-13 10:11:15', '2017-09-13 11:13:32', NULL),
(10, 'edgar', 'e', '0000-00-00', 'e', '', 'e', 'e', '0', '', '', 2, 'e', NULL, '2017-09-13 10:55:50', '2017-11-04 03:48:43', NULL),
(11, 'samael', 'ssss', '2017-12-31', 'dddd', '123', 'ddddddd', '123', '0', '', '', 1, '12345', NULL, '2017-11-04 03:56:30', '2017-11-04 03:57:49', NULL);

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
  ADD KEY `fk_id_usuario` (`fk_id_usuario`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `categorias_cursos`
--
ALTER TABLE `categorias_cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `detalle_permisos_rols`
--
ALTER TABLE `detalle_permisos_rols`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detalle__usuario__cursos`
--
ALTER TABLE `detalle__usuario__cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
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
-- AUTO_INCREMENT for table `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `preguntas_evaluacions`
--
ALTER TABLE `preguntas_evaluacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `respuestas_del_usuarios`
--
ALTER TABLE `respuestas_del_usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
