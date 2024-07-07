-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 01:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sistema_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `logo_light` text DEFAULT NULL,
  `logo_sm` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `nombre`, `logo_light`, `logo_sm`, `created_at`, `updated_at`) VALUES
(1, 'Velzon', 'http://localhost/laravel/sistema_test/public/imgconfig/logo_5Mt28lBtfG.png', 'http://localhost/laravel/sistema_test/public/imgconfig/logo_NqJudcLTG5.png', NULL, '2023-10-19 18:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `color` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `descripcion`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Bases de Datos', 'Este curso se centra en la gestión de datos, incluyendo diseño de bases de datos, SQL (Structured Query Language) y conceptos de almacenamiento y recuperación de información.', 'success', '2023-10-05 01:09:09', '2023-10-15 16:01:44'),
(2, 'Programación', 'Este curso generalmente abarca varios lenguajes de programación, como Python, Java, C++ o JavaScript, y enseña los fundamentos de la escritura de código, la resolución de problemas algorítmicos y la programación orientada a objetos.', 'warning', '2023-10-05 04:02:14', '2023-10-15 16:01:06'),
(3, 'Redes de Computadoras', 'En este curso, los estudiantes aprenden sobre la configuración, mantenimiento y administración de redes de computadoras', 'info', '2023-10-12 20:25:11', '2023-10-15 16:02:12'),
(4, 'Sistemas Operativos', 'Este curso explora cómo funcionan los sistemas operativos, incluyendo la administración de recursos, la programación de bajo nivel y la gestión de procesos.', 'secondary', '2023-10-12 20:29:47', '2023-10-15 16:02:43'),
(6, 'Seguridad Informática', 'Este curso se enfoca en la protección de sistemas y datos contra amenazas cibernéticas.', 'primary', '2023-10-13 04:59:03', '2023-10-19 18:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `examen`
--

CREATE TABLE `examen` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `temas` text NOT NULL DEFAULT '[]',
  `descripcion` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tiempo_limite` varchar(20) NOT NULL,
  `fecha_hora_inicio` varchar(50) NOT NULL,
  `fecha_hora_fin` varchar(50) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examen`
--

INSERT INTO `examen` (`id`, `id_user`, `curso_id`, `temas`, `descripcion`, `cantidad`, `tiempo_limite`, `fecha_hora_inicio`, `fecha_hora_fin`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '[\"1\"]', 'examen de SQL (Structured Query Language)', 5, '00:10:00', '2023-10-16T12:10', '2023-10-16T13:10', 0, '2023-10-16 17:11:16', '2023-10-26 21:42:09'),
(2, 1, 2, '[\"4\"]', 'examen de Introducción a la Programación', 6, '00:04:00', '2023-10-16T12:12', '2023-10-16T13:12', 0, '2023-10-16 17:12:18', '2023-10-26 21:42:09'),
(3, 1, 1, '[\"3\"]', 'test de base de datos Diseño de Bases de Datos Relacionales', 5, '00:01:00', '2023-10-16T13:12', '2023-10-16T14:12', 0, '2023-10-16 17:13:04', '2023-10-26 21:42:09'),
(4, 1, 1, '[\"1\",\"3\"]', 'examen de base de datos mixto', 5, '00:01:00', '2023-10-16T15:13', '2023-10-16T16:13', 0, '2023-10-16 17:13:52', '2023-10-26 21:42:09'),
(5, 1, 1, '[\"1\"]', 'examen de programación', 6, '00:02:00', '2023-10-17T16:19', '2023-10-17T17:19', 0, '2023-10-17 21:19:30', '2023-10-26 21:42:09'),
(6, 1, 2, '[\"4\"]', 'examen de programación', 6, '00:02:00', '2023-10-17T16:19', '2023-10-17T17:19', 0, '2023-10-17 21:27:24', '2023-10-26 21:42:09'),
(7, 1, 2, '[\"4\"]', 'examen de sistemas', 6, '00:05:00', '2023-10-19T15:00', '2023-10-19T16:00', 0, '2023-10-19 18:44:46', '2023-10-26 21:42:09'),
(8, 1, 1, '[\"1\",\"3\"]', 'examen ttsd mix', 8, '00:10:00', '2023-10-19T14:40', '2023-10-19T15:40', 0, '2023-10-19 19:40:20', '2023-10-26 21:42:09'),
(9, 11, 2, '[\"4\"]', 'examen test II', 5, '00:10:00', '2023-10-20T15:04', '2023-10-20T16:05', 0, '2023-10-20 20:05:16', '2023-10-26 21:42:09'),
(10, 11, 2, '[\"4\"]', 'examen test de programación', 5, '00:10:00', '2023-10-21T17:20', '2023-10-21T18:20', 0, '2023-10-21 22:20:18', '2023-10-26 21:42:09'),
(11, 11, 1, '[\"1\",\"3\"]', 'examen new test', 6, '00:14:00', '2023-10-23T13:39', '2023-10-23T15:39', 0, '2023-10-23 18:39:44', '2023-10-26 21:42:09'),
(12, 11, 2, '[\"4\"]', 'aaaaaa', 5, '00:15:00', '2023-10-23T14:40', '2023-10-23T15:40', 0, '2023-10-23 18:40:11', '2023-10-26 21:42:09'),
(13, 11, 1, '[\"1\",\"3\"]', 'examen wwwwwwwww', 6, '00:03:00', '2023-10-26T16:34', '2023-10-26T17:34', 1, '2023-10-26 21:34:06', '2023-10-26 21:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `examen_alumno`
--

CREATE TABLE `examen_alumno` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_examen` int(11) NOT NULL,
  `preguntas_ids` text DEFAULT '\'[]\'',
  `tiempo` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'sin_iniciar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examen_alumno`
--

INSERT INTO `examen_alumno` (`id`, `id_user`, `id_examen`, `preguntas_ids`, `tiempo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 12, 4, '[19,17,16,11,9]', '00:00:00', 'completado', '2023-10-16 18:45:03', '2023-10-16 18:46:08'),
(2, 12, 3, '[9,6,7,8,10]', '00:00:00', 'completado', '2023-10-16 18:46:59', '2023-10-16 18:48:02'),
(3, 12, 1, '[16,14,11,13,17]', '00:02:27', 'completado', '2023-10-16 18:48:15', '2023-10-16 18:57:49'),
(4, 12, 2, '[27,23,26,22,25,21]', '00:02:12', 'completado', '2023-10-16 20:39:28', '2023-10-16 20:41:17'),
(5, 13, 1, '[15,20,19,17,12]', '00:06:40', 'completado', '2023-10-16 20:45:32', '2023-10-16 20:48:53'),
(6, 12, 5, '[17,15,12,16,18,13]', '00:01:47', 'completado', '2023-10-17 21:24:28', '2023-10-17 21:24:42'),
(7, 14, 6, '[26,30,22,21,23,29]', '00:01:43', 'completado', '2023-10-17 21:29:01', '2023-10-17 21:29:18'),
(8, 15, 6, '[29,26,30,23,25,27]', '00:00:52', 'completado', '2023-10-17 21:29:54', '2023-10-17 21:31:02'),
(9, 16, 6, '[23,24,28,29,22,26]', '00:00:45', 'completado', '2023-10-17 21:31:24', '2023-10-17 21:32:39'),
(10, 12, 6, '[25,26,27,28,24,29]', '00:01:38', 'completado', '2023-10-17 21:32:59', '2023-10-17 21:33:21'),
(11, 13, 6, '[29,22,23,27,25,30]', '00:01:48', 'completado', '2023-10-17 21:33:41', '2023-10-17 21:33:53'),
(12, 22, 6, '[28,26,22,21,23,24]', '00:01:37', 'completado', '2023-10-17 21:40:34', '2023-10-17 21:40:58'),
(13, 17, 6, '[25,24,30,26,29,27]', '00:01:48', 'completado', '2023-10-17 21:41:18', '2023-10-17 21:41:31'),
(14, 18, 6, '[22,25,29,24,26,30]', '00:01:50', 'completado', '2023-10-17 21:41:51', '2023-10-17 21:42:02'),
(15, 20, 6, '[26,24,21,29,30,28]', '00:01:50', 'completado', '2023-10-17 21:42:27', '2023-10-17 21:42:38'),
(16, 21, 6, '[25,30,21,28,27,26]', '00:01:48', 'completado', '2023-10-17 21:42:59', '2023-10-17 21:43:12'),
(17, 23, 6, '[23,30,24,26,27,29]', '00:01:51', 'completado', '2023-10-18 16:25:56', '2023-10-18 16:26:06'),
(18, 24, 6, '[24,26,29,27,22,28]', '00:01:58', 'completado', '2023-10-18 16:26:23', '2023-10-18 16:26:25'),
(19, 25, 6, '[25,22,30,28,24,26]', '00:01:59', 'completado', '2023-10-18 16:26:39', '2023-10-18 16:26:41'),
(20, 12, 10, '[24,23,29,21,25]', '00:08:33', 'completado', '2023-10-21 22:20:41', '2023-10-21 22:22:09'),
(21, 13, 10, '[23,22,21,25,28]', '00:09:42', 'completado', '2023-10-21 22:35:16', '2023-10-21 22:35:35'),
(22, 22, 10, '[23,26,22,27,24]', '00:09:50', 'completado', '2023-10-23 17:59:20', '2023-10-23 17:59:31'),
(23, 12, 13, '[18,16,20,6,17,14]', '00:02:31', 'completado', '2023-10-26 21:34:44', '2023-10-26 21:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `exame_resultados`
--

CREATE TABLE `exame_resultados` (
  `id` int(11) NOT NULL,
  `id_examen_alumno` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `respuesta` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exame_resultados`
--

INSERT INTO `exame_resultados` (`id`, `id_examen_alumno`, `id_pregunta`, `respuesta`, `created_at`, `updated_at`) VALUES
(1, 3, 16, 'a) FROM', '2023-10-16 18:57:49', '2023-10-16 18:57:49'),
(2, 3, 14, '[\"a) JOIN\"]', '2023-10-16 18:57:49', '2023-10-16 18:57:49'),
(3, 3, 11, '[\"a) WHERE\",\"b) FROM\"]', '2023-10-16 18:57:49', '2023-10-16 18:57:49'),
(4, 3, 13, '[\"a) SUM\"]', '2023-10-16 18:57:49', '2023-10-16 18:57:49'),
(5, 3, 17, 'c) COUNT', '2023-10-16 18:57:49', '2023-10-16 18:57:49'),
(6, 4, 27, 'a) Ejecutar el programa y ver los resultados.', '2023-10-16 20:41:17', '2023-10-16 20:41:17'),
(7, 4, 23, '[\"a) C++\"]', '2023-10-16 20:41:17', '2023-10-16 20:41:17'),
(8, 4, 26, 'b) Dar instrucciones a una computadora para realizar tareas específicas.', '2023-10-16 20:41:17', '2023-10-16 20:41:17'),
(9, 4, 22, '[\"a) Un lenguaje de programaci\\u00f3n.\"]', '2023-10-16 20:41:17', '2023-10-16 20:41:17'),
(10, 4, 25, '[\"b) Eval\\u00faa una condici\\u00f3n y ejecuta un bloque de c\\u00f3digo si la condici\\u00f3n es verdadera.\"]', '2023-10-16 20:41:17', '2023-10-16 20:41:17'),
(11, 4, 21, '[\"b) Python\",\"c) JavaScript\"]', '2023-10-16 20:41:17', '2023-10-16 20:41:17'),
(12, 5, 15, '[\"a) DELETE FROM\"]', '2023-10-16 20:48:52', '2023-10-16 20:48:52'),
(13, 5, 20, 'a) DROP TABLE', '2023-10-16 20:48:52', '2023-10-16 20:48:52'),
(14, 5, 19, 'b) UPDATE', '2023-10-16 20:48:52', '2023-10-16 20:48:52'),
(15, 5, 17, 'c) COUNT', '2023-10-16 20:48:52', '2023-10-16 20:48:52'),
(16, 5, 12, '[\"a) INSERT INTO\"]', '2023-10-16 20:48:52', '2023-10-16 20:48:52'),
(17, 6, 17, 'a) SUM', '2023-10-17 21:24:42', '2023-10-17 21:24:42'),
(18, 6, 15, '[\"b) TRUNCATE TABLE\"]', '2023-10-17 21:24:42', '2023-10-17 21:24:42'),
(19, 6, 12, '[\"a) INSERT INTO\",\"c) DELETE\"]', '2023-10-17 21:24:42', '2023-10-17 21:24:42'),
(20, 6, 16, 'b) ORDER BY', '2023-10-17 21:24:42', '2023-10-17 21:24:42'),
(21, 6, 18, 'a) WHERE', '2023-10-17 21:24:42', '2023-10-17 21:24:42'),
(22, 6, 13, '[\"a) SUM\"]', '2023-10-17 21:24:42', '2023-10-17 21:24:42'),
(23, 7, 26, 'b) Dar instrucciones a una computadora para realizar tareas específicas.', '2023-10-17 21:29:18', '2023-10-17 21:29:18'),
(24, 7, 30, 'a) Un tipo de código fuente que se ejecuta en un navegador web.', '2023-10-17 21:29:18', '2023-10-17 21:29:18'),
(25, 7, 22, '[\"a) Un lenguaje de programaci\\u00f3n.\",\"d) Un tipo de error en el c\\u00f3digo fuente.\"]', '2023-10-17 21:29:18', '2023-10-17 21:29:18'),
(26, 7, 21, '[\"b) Python\"]', '2023-10-17 21:29:18', '2023-10-17 21:29:18'),
(27, 7, 23, '[\"a) C++\"]', '2023-10-17 21:29:18', '2023-10-17 21:29:18'),
(28, 7, 29, 'a) Almacenar datos de forma permanente en la memoria de la computadora.', '2023-10-17 21:29:18', '2023-10-17 21:29:18'),
(29, 8, 29, 'a) Almacenar datos de forma permanente en la memoria de la computadora.', '2023-10-17 21:31:02', '2023-10-17 21:31:02'),
(30, 8, 26, 'b) Dar instrucciones a una computadora para realizar tareas específicas.', '2023-10-17 21:31:02', '2023-10-17 21:31:02'),
(31, 8, 30, 'c) Un enfoque para describir algoritmos utilizando lenguaje natural y estructuras de control simples.', '2023-10-17 21:31:02', '2023-10-17 21:31:02'),
(32, 8, 23, '[\"a) C++\"]', '2023-10-17 21:31:02', '2023-10-17 21:31:02'),
(33, 8, 25, '[\"b) Eval\\u00faa una condici\\u00f3n y ejecuta un bloque de c\\u00f3digo si la condici\\u00f3n es verdadera.\"]', '2023-10-17 21:31:02', '2023-10-17 21:31:02'),
(34, 8, 27, 'c) Depurar el código en busca de errores.', '2023-10-17 21:31:02', '2023-10-17 21:31:02'),
(35, 9, 23, '[\"a) C++\"]', '2023-10-17 21:32:39', '2023-10-17 21:32:39'),
(36, 9, 24, '[\"b) Bucle (Loop)\"]', '2023-10-17 21:32:39', '2023-10-17 21:32:39'),
(37, 9, 28, 'c) Un bucle que nunca termina y ejecuta continuamente.', '2023-10-17 21:32:39', '2023-10-17 21:32:39'),
(38, 9, 29, 'a) Almacenar datos de forma permanente en la memoria de la computadora.', '2023-10-17 21:32:39', '2023-10-17 21:32:39'),
(39, 9, 22, '[\"b) Una secuencia de pasos para realizar una tarea.\"]', '2023-10-17 21:32:39', '2023-10-17 21:32:39'),
(40, 9, 26, 'b) Dar instrucciones a una computadora para realizar tareas específicas.', '2023-10-17 21:32:39', '2023-10-17 21:32:39'),
(41, 10, 25, '[\"a) Realiza una suma.\",\"d) Muestra una ventana emergente en la pantalla.\"]', '2023-10-17 21:33:21', '2023-10-17 21:33:21'),
(42, 10, 26, 'b) Dar instrucciones a una computadora para realizar tareas específicas.', '2023-10-17 21:33:21', '2023-10-17 21:33:21'),
(43, 10, 27, 'c) Depurar el código en busca de errores.', '2023-10-17 21:33:21', '2023-10-17 21:33:21'),
(44, 10, 28, 'a) Un error que causa que el programa se cierre inmediatamente.', '2023-10-17 21:33:21', '2023-10-17 21:33:21'),
(45, 10, 24, '[\"b) Bucle (Loop)\"]', '2023-10-17 21:33:21', '2023-10-17 21:33:21'),
(46, 10, 29, 'c) Almacenar y manipular datos temporalmente durante la ejecución del programa.', '2023-10-17 21:33:21', '2023-10-17 21:33:21'),
(47, 11, 29, 'c) Almacenar y manipular datos temporalmente durante la ejecución del programa.', '2023-10-17 21:33:53', '2023-10-17 21:33:53'),
(48, 11, 22, '[\"b) Una secuencia de pasos para realizar una tarea.\"]', '2023-10-17 21:33:53', '2023-10-17 21:33:53'),
(49, 11, 23, '[\"a) C++\"]', '2023-10-17 21:33:53', '2023-10-17 21:33:53'),
(50, 11, 27, 'b) Traducir el código fuente del programa a un lenguaje que la computadora pueda entender.', '2023-10-17 21:33:53', '2023-10-17 21:33:53'),
(51, 11, 25, '[\"a) Realiza una suma.\"]', '2023-10-17 21:33:53', '2023-10-17 21:33:53'),
(52, 11, 30, 'b) Un lenguaje de programación muy complejo.', '2023-10-17 21:33:53', '2023-10-17 21:33:53'),
(53, 12, 28, 'c) Un bucle que nunca termina y ejecuta continuamente.', '2023-10-17 21:40:58', '2023-10-17 21:40:58'),
(54, 12, 26, 'a) Realizar cálculos matemáticos.', '2023-10-17 21:40:58', '2023-10-17 21:40:58'),
(55, 12, 22, '[\"a) Un lenguaje de programaci\\u00f3n.\",\"b) Una secuencia de pasos para realizar una tarea.\",\"d) Un tipo de error en el c\\u00f3digo fuente.\"]', '2023-10-17 21:40:58', '2023-10-17 21:40:58'),
(56, 12, 21, '[\"b) Python\"]', '2023-10-17 21:40:58', '2023-10-17 21:40:58'),
(57, 12, 23, '[\"a) C++\"]', '2023-10-17 21:40:58', '2023-10-17 21:40:58'),
(58, 12, 24, '[\"a) Condici\\u00f3n\"]', '2023-10-17 21:40:58', '2023-10-17 21:40:58'),
(59, 13, 25, '[\"a) Realiza una suma.\"]', '2023-10-17 21:41:31', '2023-10-17 21:41:31'),
(60, 13, 24, '[\"a) Condici\\u00f3n\",\"d) Variable\"]', '2023-10-17 21:41:31', '2023-10-17 21:41:31'),
(61, 13, 30, 'a) Un tipo de código fuente que se ejecuta en un navegador web.', '2023-10-17 21:41:31', '2023-10-17 21:41:31'),
(62, 13, 26, 'b) Dar instrucciones a una computadora para realizar tareas específicas.', '2023-10-17 21:41:31', '2023-10-17 21:41:31'),
(63, 13, 29, 'b) Cambiar la velocidad de la CPU.', '2023-10-17 21:41:31', '2023-10-17 21:41:31'),
(64, 13, 27, 'a) Ejecutar el programa y ver los resultados.', '2023-10-17 21:41:31', '2023-10-17 21:41:31'),
(65, 14, 22, '[\"b) Una secuencia de pasos para realizar una tarea.\"]', '2023-10-17 21:42:02', '2023-10-17 21:42:02'),
(66, 14, 25, '[\"b) Eval\\u00faa una condici\\u00f3n y ejecuta un bloque de c\\u00f3digo si la condici\\u00f3n es verdadera.\"]', '2023-10-17 21:42:02', '2023-10-17 21:42:02'),
(67, 14, 29, 'b) Cambiar la velocidad de la CPU.', '2023-10-17 21:42:02', '2023-10-17 21:42:02'),
(68, 14, 24, '[\"b) Bucle (Loop)\"]', '2023-10-17 21:42:02', '2023-10-17 21:42:02'),
(69, 14, 26, 'a) Realizar cálculos matemáticos.', '2023-10-17 21:42:02', '2023-10-17 21:42:02'),
(70, 14, 30, 'b) Un lenguaje de programación muy complejo.', '2023-10-17 21:42:02', '2023-10-17 21:42:02'),
(71, 15, 26, 'b) Dar instrucciones a una computadora para realizar tareas específicas.', '2023-10-17 21:42:38', '2023-10-17 21:42:38'),
(72, 15, 24, '[\"b) Bucle (Loop)\"]', '2023-10-17 21:42:38', '2023-10-17 21:42:38'),
(73, 15, 21, '[\"b) Python\",\"c) JavaScript\"]', '2023-10-17 21:42:38', '2023-10-17 21:42:38'),
(74, 15, 29, 'b) Cambiar la velocidad de la CPU.', '2023-10-17 21:42:38', '2023-10-17 21:42:38'),
(75, 15, 30, 'b) Un lenguaje de programación muy complejo.', '2023-10-17 21:42:38', '2023-10-17 21:42:38'),
(76, 15, 28, 'a) Un error que causa que el programa se cierre inmediatamente.', '2023-10-17 21:42:38', '2023-10-17 21:42:38'),
(77, 16, 25, '[\"a) Realiza una suma.\"]', '2023-10-17 21:43:12', '2023-10-17 21:43:12'),
(78, 16, 30, 'b) Un lenguaje de programación muy complejo.', '2023-10-17 21:43:12', '2023-10-17 21:43:12'),
(79, 16, 21, '[\"b) Python\"\"]', '2023-10-17 21:43:12', '2023-10-17 21:43:12'),
(80, 16, 28, 'a) Un error que causa que el programa se cierre inmediatamente.', '2023-10-17 21:43:12', '2023-10-17 21:43:12'),
(81, 16, 27, 'b) Traducir el código fuente del programa a un lenguaje que la computadora pueda entender.', '2023-10-17 21:43:12', '2023-10-17 21:43:12'),
(82, 16, 26, 'a) Realizar cálculos matemáticos.', '2023-10-17 21:43:12', '2023-10-17 21:43:12'),
(83, 20, 24, '[\"a) Condici\\u00f3n\",\"c) Funci\\u00f3n\"]', '2023-10-21 22:22:08', '2023-10-21 22:22:08'),
(84, 20, 23, '[\"a) C++\",\"d) HTML\"]', '2023-10-21 22:22:09', '2023-10-21 22:22:09'),
(85, 20, 29, 'b) Cambiar la velocidad de la CPU.', '2023-10-21 22:22:09', '2023-10-21 22:22:09'),
(86, 20, 21, '[\"a) HTML\"]', '2023-10-21 22:22:09', '2023-10-21 22:22:09'),
(87, 21, 23, '[\"a) C++\"]', '2023-10-21 22:35:35', '2023-10-21 22:35:35'),
(88, 21, 22, '[\"b) Una secuencia de pasos para realizar una tarea.\",\"d) Un tipo de error en el c\\u00f3digo fuente.\"]', '2023-10-21 22:35:35', '2023-10-21 22:35:35'),
(89, 21, 21, '[\"b) Python\",\"c) JavaScript\"]', '2023-10-21 22:35:35', '2023-10-21 22:35:35'),
(90, 21, 28, 'a) Un error que causa que el programa se cierre inmediatamente.', '2023-10-21 22:35:35', '2023-10-21 22:35:35'),
(91, 22, 23, '[\"a) C++\"]', '2023-10-23 17:59:31', '2023-10-23 17:59:31'),
(92, 22, 26, 'b) Dar instrucciones a una computadora para realizar tareas específicas.', '2023-10-23 17:59:31', '2023-10-23 17:59:31'),
(93, 22, 22, '[\"a) Un lenguaje de programaci\\u00f3n.\"]', '2023-10-23 17:59:31', '2023-10-23 17:59:31'),
(94, 22, 27, 'd) Copiar y pegar código de un programa a otro.', '2023-10-23 17:59:31', '2023-10-23 17:59:31'),
(95, 22, 24, '[\"a) Condici\\u00f3n\"]', '2023-10-23 17:59:31', '2023-10-23 17:59:31'),
(96, 23, 18, 'a) WHERE', '2023-10-26 21:35:14', '2023-10-26 21:35:14'),
(97, 23, 16, 'a) FROM', '2023-10-26 21:35:14', '2023-10-26 21:35:14'),
(98, 23, 20, 'b) DELETE', '2023-10-26 21:35:14', '2023-10-26 21:35:14'),
(99, 23, 6, '[\"a) Facilita la administraci\\u00f3n de datos.\",\"d) Facilita la expansi\\u00f3n y escalabilidad del sistema.\"]', '2023-10-26 21:35:14', '2023-10-26 21:35:14'),
(100, 23, 17, 'c) COUNT', '2023-10-26 21:35:14', '2023-10-26 21:35:14'),
(101, 23, 14, '[\"b) WHERE\",\"c) GROUP BY\"]', '2023-10-26 21:35:14', '2023-10-26 21:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matricula`
--

CREATE TABLE `matricula` (
  `id` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_09_01_174421_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `tema_id` int(11) DEFAULT NULL,
  `pregunta` text NOT NULL,
  `tipo_pregunta` enum('Unica','Multiple') NOT NULL,
  `alternativa` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preguntas`
--

INSERT INTO `preguntas` (`id`, `tema_id`, `pregunta`, `tipo_pregunta`, `alternativa`, `created_at`, `updated_at`) VALUES
(1, 10, '¿Qué es un diagrama de entidad-relación (ER)?', 'Unica', 'Una forma de representar visualmente la estructura de una base de datos.', '2023-10-15 16:10:08', '2023-10-15 16:17:50'),
(2, 10, '¿Cuál es el propósito de la normalización en el diseño de bases de datos?', 'Unica', 'Mejorar la integridad de los datos y reducir la duplicación.', '2023-10-15 16:10:58', '2023-10-15 16:18:11'),
(3, 10, '¿Qué representan las claves primarias en una tabla de base de datos?', 'Unica', 'Valores que garantizan la unicidad de cada fila y permiten la identificación de registros.', '2023-10-15 16:11:45', '2023-10-15 16:18:14'),
(4, 10, '¿Cuáles de las siguientes son ventajas de la normalización en el diseño de bases de datos? (Selecciona todas las que apliquen)', 'Multiple', '[\"Reducci\\u00f3n de la redundancia de datos.\",\"Mayor integridad de datos.\"]', '2023-10-15 16:17:15', '2023-10-15 16:17:15'),
(5, 10, 'Selecciona los tipos de relaciones en el modelado de datos (Selecciona todas las que apliquen)', 'Multiple', '[\"a) Relaci\\u00f3n uno a cero o uno (1:0-1).\",\"c) Relaci\\u00f3n uno a uno (1:1).\",\"d) Relaci\\u00f3n uno a muchos (1:N).\"]', '2023-10-15 16:20:17', '2023-10-15 16:20:17'),
(6, 3, '¿Cuáles de las siguientes son ventajas del diseño de bases de datos relacionales? (Selecciona todas las que apliquen)', 'Multiple', '[\"a) Facilita la administraci\\u00f3n de datos.\",\"b) Permite un acceso r\\u00e1pido a los datos.\",\"d) Facilita la expansi\\u00f3n y escalabilidad del sistema.\"]', '2023-10-15 16:23:50', '2023-10-15 16:23:50'),
(7, 3, 'En el diseño de bases de datos relacionales, ¿qué es una \"clave primaria\"?', 'Multiple', '[\"b) Un campo que no puede tener valores nulos y garantiza la unicidad de cada fila.\"]', '2023-10-15 16:24:38', '2023-10-15 16:24:38'),
(8, 3, '¿Cuáles de las siguientes son consideraciones importantes al diseñar tablas en una base de datos relacional? (Selecciona todas las que apliquen)', 'Multiple', '[\"a) Definir claves primarias.\",\"c) Utilizar tipos de datos adecuados.\"]', '2023-10-15 16:25:45', '2023-10-15 16:25:45'),
(9, 3, '¿Qué es la normalización en el diseño de bases de datos?', 'Unica', 'a) Un proceso para reducir la redundancia de datos y mejorar la integridad.', '2023-10-15 16:26:22', '2023-10-15 16:26:22'),
(10, 3, '¿Cuál es la importancia de los índices en una base de datos relacional?', 'Unica', 'c) Mejoran el rendimiento de las consultas al acelerar la búsqueda de datos.', '2023-10-15 16:26:53', '2023-10-15 16:26:53'),
(11, 1, 'En SQL, ¿cuáles de las siguientes cláusulas se utilizan para filtrar datos en una consulta SELECT? (Selecciona todas las que apliquen)', 'Multiple', '[\"a) WHERE\",\"c) GROUP BY\",\"d) HAVING\"]', '2023-10-15 16:32:34', '2023-10-15 16:32:34'),
(12, 1, '¿Cuál de las siguientes sentencias SQL se utiliza para agregar nuevos registros a una tabla? (Selecciona todas las que apliquen)', 'Multiple', '[\"a) INSERT INTO\"]', '2023-10-15 16:33:16', '2023-10-15 16:33:16'),
(13, 1, '¿Cuáles de las siguientes funciones SQL se utilizan comúnmente para realizar cálculos en columnas de una tabla? (Selecciona todas las que apliquen)', 'Multiple', '[\"a) SUM\",\"b) COUNT\"]', '2023-10-15 16:34:04', '2023-10-15 16:34:04'),
(14, 1, 'En SQL, ¿cuál de las siguientes cláusulas se utiliza para combinar filas de dos o más tablas en una sola consulta? (Selecciona todas las que apliquen)', 'Multiple', '[\"a) JOIN\"]', '2023-10-15 16:34:40', '2023-10-15 16:34:40'),
(15, 1, '¿Cuál de las siguientes declaraciones SQL se utiliza para eliminar datos de una tabla? (Selecciona todas las que apliquen)', 'Multiple', '[\"a) DELETE FROM\"]', '2023-10-15 16:35:17', '2023-10-15 16:35:17'),
(16, 1, '¿Qué cláusula SQL se utiliza para ordenar el resultado de una consulta en orden ascendente o descendente?', 'Unica', 'b) ORDER BY', '2023-10-15 16:35:51', '2023-10-15 16:35:51'),
(17, 1, '¿Cuál es la función SQL que se utiliza para contar el número de filas en una tabla?', 'Unica', 'c) COUNT', '2023-10-15 16:36:25', '2023-10-15 16:36:25'),
(18, 1, 'En SQL, ¿cuál es la cláusula que se utiliza para limitar el número de filas devueltas por una consulta?', 'Unica', 'b) LIMIT', '2023-10-15 16:37:00', '2023-10-15 16:37:00'),
(19, 1, '¿Cuál es la declaración SQL que se utiliza para modificar los datos existentes en una tabla?', 'Unica', 'b) UPDATE', '2023-10-15 16:37:32', '2023-10-15 16:37:32'),
(20, 1, '¿Cuál de las siguientes sentencias SQL se utiliza para eliminar una tabla y todos sus datos?', 'Unica', 'a) DROP TABLE', '2023-10-15 16:38:08', '2023-10-15 16:38:08'),
(21, 4, '¿Cuáles de las siguientes son ejemplos de lenguajes de programación? (Selecciona todas las que apliquen)', 'Multiple', 'null', '2023-10-15 16:42:07', '2023-10-15 16:42:07'),
(22, 4, '¿Qué es un algoritmo en el contexto de la programación? (Selecciona todas las que apliquen)', 'Multiple', '[\"b) Una secuencia de pasos para realizar una tarea.\"]', '2023-10-15 16:42:48', '2023-10-15 16:42:48'),
(23, 4, '¿Cuál de los siguientes es un ejemplo de un lenguaje de programación de alto nivel? (Selecciona una respuesta)', 'Multiple', '[\"a) C++\"]', '2023-10-15 16:43:22', '2023-10-15 16:43:22'),
(24, 4, '¿Qué tipo de estructura de control se utiliza para repetir una porción de código un número específico de veces? (Selecciona una respuesta)', 'Multiple', '[\"b) Bucle (Loop)\"]', '2023-10-15 16:43:57', '2023-10-15 16:43:57'),
(25, 4, '¿Qué hace la declaración \"if\" en programación? (Selecciona todas las que apliquen)', 'Multiple', '[\"b) Eval\\u00faa una condici\\u00f3n y ejecuta un bloque de c\\u00f3digo si la condici\\u00f3n es verdadera.\"]', '2023-10-15 16:44:35', '2023-10-15 16:44:35'),
(26, 4, '¿Cuál es el propósito de un lenguaje de programación?', 'Unica', 'b) Dar instrucciones a una computadora para realizar tareas específicas.', '2023-10-15 16:45:12', '2023-10-15 16:45:12'),
(27, 4, '¿Qué significa \"compilar\" un programa en el contexto de la programación?', 'Unica', 'b) Traducir el código fuente del programa a un lenguaje que la computadora pueda entender.', '2023-10-15 16:45:54', '2023-10-15 16:45:54'),
(28, 4, '¿Qué es un \"bucle infinito\" en programación?', 'Unica', 'c) Un bucle que nunca termina y ejecuta continuamente.', '2023-10-15 16:46:33', '2023-10-15 16:46:33'),
(29, 4, '¿Cuál es la función principal de una variable en programación?', 'Unica', 'c) Almacenar y manipular datos temporalmente durante la ejecución del programa.', '2023-10-15 16:47:11', '2023-10-15 16:47:11'),
(30, 4, '¿Qué es el \"pseudocódigo\" en programación?', 'Unica', 'c) Un enfoque para describir algoritmos utilizando lenguaje natural y estructuras de control simples.', '2023-10-15 16:47:59', '2023-10-15 16:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `pregunta_alternativa`
--

CREATE TABLE `pregunta_alternativa` (
  `id` int(18) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `respuesta` text NOT NULL,
  `es_correcta` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pregunta_alternativa`
--

INSERT INTO `pregunta_alternativa` (`id`, `pregunta_id`, `respuesta`, `es_correcta`, `created_at`, `updated_at`) VALUES
(17, 1, 'Una técnica de optimización de consultas.', 0, '2023-10-15 16:17:50', '2023-10-15 16:17:50'),
(18, 1, 'Una forma de representar visualmente la estructura de una base de datos.', 1, '2023-10-15 16:17:50', '2023-10-15 16:17:50'),
(19, 1, 'Un lenguaje de programación para bases de datos.', 0, '2023-10-15 16:17:50', '2023-10-15 16:17:50'),
(20, 1, 'Una restricción que garantiza la unicidad de datos en una tabla.', 0, '2023-10-15 16:17:50', '2023-10-15 16:17:50'),
(21, 2, 'Aumentar la redundancia de datos.', 0, '2023-10-15 16:18:11', '2023-10-15 16:18:11'),
(22, 2, 'Reducir la eficiencia de las consultas.', 0, '2023-10-15 16:18:11', '2023-10-15 16:18:11'),
(23, 2, 'Mejorar la integridad de los datos y reducir la duplicación.', 1, '2023-10-15 16:18:11', '2023-10-15 16:18:11'),
(24, 2, 'Añadir complejidad innecesaria al modelo de datos.', 0, '2023-10-15 16:18:11', '2023-10-15 16:18:11'),
(25, 3, 'Los valores que se pueden repetir en varias filas.', 0, '2023-10-15 16:18:14', '2023-10-15 16:18:14'),
(26, 3, 'Valores que garantizan la unicidad de cada fila y permiten la identificación de registros.', 1, '2023-10-15 16:18:14', '2023-10-15 16:18:14'),
(27, 3, 'Valores que se utilizan para realizar cálculos matemáticos.', 0, '2023-10-15 16:18:14', '2023-10-15 16:18:14'),
(28, 3, 'Los valores que no son importantes en una tabla.', 0, '2023-10-15 16:18:14', '2023-10-15 16:18:14'),
(29, 4, 'Reducción de la redundancia de datos.', 1, '2023-10-15 16:18:31', '2023-10-15 16:18:31'),
(30, 4, 'Mayor velocidad en la recuperación de datos.', 0, '2023-10-15 16:18:31', '2023-10-15 16:18:31'),
(31, 4, 'Mayor facilidad para realizar consultas complejas.', 0, '2023-10-15 16:18:31', '2023-10-15 16:18:31'),
(32, 4, ' Mayor integridad de datos.', 1, '2023-10-15 16:18:31', '2023-10-15 16:18:31'),
(33, 5, 'a) Relación uno a cero o uno (1:0-1).', 1, '2023-10-15 16:20:17', '2023-10-15 16:20:17'),
(34, 5, 'b) Relación muchos a todos (N:All).', 0, '2023-10-15 16:20:17', '2023-10-15 16:20:17'),
(35, 5, 'c) Relación uno a uno (1:1).', 1, '2023-10-15 16:20:17', '2023-10-15 16:20:17'),
(36, 5, 'd) Relación uno a muchos (1:N).', 1, '2023-10-15 16:20:17', '2023-10-15 16:20:17'),
(37, 6, 'a) Facilita la administración de datos.', 1, '2023-10-15 16:23:50', '2023-10-15 16:23:50'),
(38, 6, 'b) Permite un acceso rápido a los datos.', 1, '2023-10-15 16:23:50', '2023-10-15 16:23:50'),
(39, 6, 'c) Minimiza la necesidad de integridad de datos.', 0, '2023-10-15 16:23:50', '2023-10-15 16:23:50'),
(40, 6, 'd) Facilita la expansión y escalabilidad del sistema.', 1, '2023-10-15 16:23:50', '2023-10-15 16:23:50'),
(41, 7, 'a) Un campo que puede tener valores duplicados en una tabla.', 0, '2023-10-15 16:24:38', '2023-10-15 16:24:38'),
(42, 7, 'b) Un campo que no puede tener valores nulos y garantiza la unicidad de cada fila.', 1, '2023-10-15 16:24:38', '2023-10-15 16:24:38'),
(43, 7, 'c) Un campo que contiene datos en formato de texto.', 0, '2023-10-15 16:24:38', '2023-10-15 16:24:38'),
(44, 7, 'd) Un campo utilizado para realizar cálculos matemáticos en la base de datos.', 0, '2023-10-15 16:24:38', '2023-10-15 16:24:38'),
(45, 8, 'a) Definir claves primarias.', 1, '2023-10-15 16:25:45', '2023-10-15 16:25:45'),
(46, 8, 'b) Evitar la normalización para reducir la complejidad.', 0, '2023-10-15 16:25:45', '2023-10-15 16:25:45'),
(47, 8, 'c) Utilizar tipos de datos adecuados.', 1, '2023-10-15 16:25:45', '2023-10-15 16:25:45'),
(48, 8, 'd) Minimizar el uso de restricciones de integridad.', 0, '2023-10-15 16:25:45', '2023-10-15 16:25:45'),
(49, 9, 'a) Un proceso para reducir la redundancia de datos y mejorar la integridad.', 1, '2023-10-15 16:26:22', '2023-10-15 16:26:22'),
(50, 9, 'b) Un proceso para duplicar datos en varias tablas.', 0, '2023-10-15 16:26:22', '2023-10-15 16:26:22'),
(51, 9, 'c) Un método para acelerar el acceso a los datos.', 0, '2023-10-15 16:26:22', '2023-10-15 16:26:22'),
(52, 9, 'd) Un enfoque para permitir la redundancia de datos en una base de datos.', 0, '2023-10-15 16:26:22', '2023-10-15 16:26:22'),
(53, 10, 'a) Añaden seguridad adicional a la base de datos.', 0, '2023-10-15 16:26:53', '2023-10-15 16:26:53'),
(54, 10, 'b) Facilitan la eliminación de registros duplicados.', 0, '2023-10-15 16:26:53', '2023-10-15 16:26:53'),
(55, 10, 'c) Mejoran el rendimiento de las consultas al acelerar la búsqueda de datos.', 1, '2023-10-15 16:26:53', '2023-10-15 16:26:53'),
(56, 10, 'd) Reducen la necesidad de utilizar claves primarias en las tablas.', 0, '2023-10-15 16:26:53', '2023-10-15 16:26:53'),
(57, 11, 'a) WHERE', 1, '2023-10-15 16:32:34', '2023-10-15 16:32:34'),
(58, 11, 'b) FROM', 0, '2023-10-15 16:32:34', '2023-10-15 16:32:34'),
(59, 11, 'c) GROUP BY', 1, '2023-10-15 16:32:34', '2023-10-15 16:32:34'),
(60, 11, 'd) HAVING', 1, '2023-10-15 16:32:34', '2023-10-15 16:32:34'),
(61, 12, 'a) INSERT INTO', 1, '2023-10-15 16:33:16', '2023-10-15 16:33:16'),
(62, 12, 'b) UPDATE', 0, '2023-10-15 16:33:16', '2023-10-15 16:33:16'),
(63, 12, 'c) DELETE', 0, '2023-10-15 16:33:16', '2023-10-15 16:33:16'),
(64, 12, 'd) SELECT', 0, '2023-10-15 16:33:16', '2023-10-15 16:33:16'),
(65, 13, 'a) SUM', 1, '2023-10-15 16:34:04', '2023-10-15 16:34:04'),
(66, 13, 'b) COUNT', 1, '2023-10-15 16:34:04', '2023-10-15 16:34:04'),
(67, 13, 'c) AVERAGE', 0, '2023-10-15 16:34:04', '2023-10-15 16:34:04'),
(68, 13, 'd) CONCATENATE', 0, '2023-10-15 16:34:04', '2023-10-15 16:34:04'),
(69, 14, 'a) JOIN', 1, '2023-10-15 16:34:40', '2023-10-15 16:34:40'),
(70, 14, 'b) WHERE', 0, '2023-10-15 16:34:40', '2023-10-15 16:34:40'),
(71, 14, 'c) GROUP BY', 0, '2023-10-15 16:34:40', '2023-10-15 16:34:40'),
(72, 14, 'd) ORDER BY', 0, '2023-10-15 16:34:40', '2023-10-15 16:34:40'),
(73, 15, 'a) DELETE FROM', 1, '2023-10-15 16:35:17', '2023-10-15 16:35:17'),
(74, 15, 'b) TRUNCATE TABLE', 0, '2023-10-15 16:35:17', '2023-10-15 16:35:17'),
(75, 15, 'c) DROP TABLE', 0, '2023-10-15 16:35:17', '2023-10-15 16:35:17'),
(76, 15, 'd) UPDATE', 0, '2023-10-15 16:35:17', '2023-10-15 16:35:17'),
(77, 16, 'a) FROM', 0, '2023-10-15 16:35:51', '2023-10-15 16:35:51'),
(78, 16, 'b) ORDER BY', 1, '2023-10-15 16:35:51', '2023-10-15 16:35:51'),
(79, 16, 'c) GROUP BY', 0, '2023-10-15 16:35:51', '2023-10-15 16:35:51'),
(80, 16, 'd) HAVING', 0, '2023-10-15 16:35:51', '2023-10-15 16:35:51'),
(81, 17, 'a) SUM', 0, '2023-10-15 16:36:25', '2023-10-15 16:36:25'),
(82, 17, 'b) AVG', 0, '2023-10-15 16:36:25', '2023-10-15 16:36:25'),
(83, 17, 'c) COUNT', 1, '2023-10-15 16:36:25', '2023-10-15 16:36:25'),
(84, 17, 'd) MAX', 0, '2023-10-15 16:36:25', '2023-10-15 16:36:25'),
(85, 18, 'a) WHERE', 0, '2023-10-15 16:37:00', '2023-10-15 16:37:00'),
(86, 18, 'b) LIMIT', 1, '2023-10-15 16:37:00', '2023-10-15 16:37:00'),
(87, 18, 'c) HAVING', 0, '2023-10-15 16:37:00', '2023-10-15 16:37:00'),
(88, 18, 'd) GROUP BY', 0, '2023-10-15 16:37:00', '2023-10-15 16:37:00'),
(89, 19, 'a) INSERT INTO', 0, '2023-10-15 16:37:32', '2023-10-15 16:37:32'),
(90, 19, 'b) UPDATE', 1, '2023-10-15 16:37:32', '2023-10-15 16:37:32'),
(91, 19, 'c) DELETE', 0, '2023-10-15 16:37:32', '2023-10-15 16:37:32'),
(92, 19, 'd) ALTER TABLE', 0, '2023-10-15 16:37:32', '2023-10-15 16:37:32'),
(93, 20, 'a) DROP TABLE', 1, '2023-10-15 16:38:08', '2023-10-15 16:38:08'),
(94, 20, 'b) DELETE', 0, '2023-10-15 16:38:08', '2023-10-15 16:38:08'),
(95, 20, 'c) TRUNCATE TABLE', 0, '2023-10-15 16:38:08', '2023-10-15 16:38:08'),
(96, 20, 'd) REMOVE TABLE', 0, '2023-10-15 16:38:08', '2023-10-15 16:38:08'),
(97, 21, 'a) HTML', 0, '2023-10-15 16:42:07', '2023-10-15 16:42:07'),
(98, 21, 'b) Python', 0, '2023-10-15 16:42:07', '2023-10-15 16:42:07'),
(99, 21, 'c) JavaScript', 0, '2023-10-15 16:42:07', '2023-10-15 16:42:07'),
(100, 21, 'd) JPEG', 0, '2023-10-15 16:42:07', '2023-10-15 16:42:07'),
(101, 21, 'e) SQL', 0, '2023-10-15 16:42:07', '2023-10-15 16:42:07'),
(102, 22, 'a) Un lenguaje de programación.', 0, '2023-10-15 16:42:48', '2023-10-15 16:42:48'),
(103, 22, 'b) Una secuencia de pasos para realizar una tarea.', 1, '2023-10-15 16:42:48', '2023-10-15 16:42:48'),
(104, 22, 'c) Un conjunto de datos almacenados en la memoria de la computadora.', 0, '2023-10-15 16:42:48', '2023-10-15 16:42:48'),
(105, 22, 'd) Un tipo de error en el código fuente.', 0, '2023-10-15 16:42:48', '2023-10-15 16:42:48'),
(106, 23, 'a) C++', 1, '2023-10-15 16:43:22', '2023-10-15 16:43:22'),
(107, 23, 'b) Binario', 0, '2023-10-15 16:43:22', '2023-10-15 16:43:22'),
(108, 23, 'c) Assembly', 0, '2023-10-15 16:43:22', '2023-10-15 16:43:22'),
(109, 23, 'd) HTML', 0, '2023-10-15 16:43:22', '2023-10-15 16:43:22'),
(110, 24, 'a) Condición', 0, '2023-10-15 16:43:57', '2023-10-15 16:43:57'),
(111, 24, 'b) Bucle (Loop)', 1, '2023-10-15 16:43:57', '2023-10-15 16:43:57'),
(112, 24, 'c) Función', 0, '2023-10-15 16:43:57', '2023-10-15 16:43:57'),
(113, 24, 'd) Variable', 0, '2023-10-15 16:43:57', '2023-10-15 16:43:57'),
(114, 25, 'a) Realiza una suma.', 0, '2023-10-15 16:44:35', '2023-10-15 16:44:35'),
(115, 25, 'b) Evalúa una condición y ejecuta un bloque de código si la condición es verdadera.', 1, '2023-10-15 16:44:35', '2023-10-15 16:44:35'),
(116, 25, 'c) Crea una variable.', 0, '2023-10-15 16:44:35', '2023-10-15 16:44:35'),
(117, 25, 'd) Muestra una ventana emergente en la pantalla.', 0, '2023-10-15 16:44:35', '2023-10-15 16:44:35'),
(118, 26, 'a) Realizar cálculos matemáticos.', 0, '2023-10-15 16:45:12', '2023-10-15 16:45:12'),
(119, 26, 'b) Dar instrucciones a una computadora para realizar tareas específicas.', 1, '2023-10-15 16:45:12', '2023-10-15 16:45:12'),
(120, 26, 'c) Organizar archivos en una computadora.', 0, '2023-10-15 16:45:12', '2023-10-15 16:45:12'),
(121, 26, 'd) Enviar correos electrónicos.', 0, '2023-10-15 16:45:12', '2023-10-15 16:45:12'),
(122, 27, 'a) Ejecutar el programa y ver los resultados.', 0, '2023-10-15 16:45:54', '2023-10-15 16:45:54'),
(123, 27, 'b) Traducir el código fuente del programa a un lenguaje que la computadora pueda entender.', 1, '2023-10-15 16:45:54', '2023-10-15 16:45:54'),
(124, 27, 'c) Depurar el código en busca de errores.', 0, '2023-10-15 16:45:54', '2023-10-15 16:45:54'),
(125, 27, 'd) Copiar y pegar código de un programa a otro.', 0, '2023-10-15 16:45:54', '2023-10-15 16:45:54'),
(126, 28, 'a) Un error que causa que el programa se cierre inmediatamente.', 0, '2023-10-15 16:46:33', '2023-10-15 16:46:33'),
(127, 28, 'b) Un bucle que se repite un número fijo de veces.', 0, '2023-10-15 16:46:33', '2023-10-15 16:46:33'),
(128, 28, 'c) Un bucle que nunca termina y ejecuta continuamente.', 1, '2023-10-15 16:46:33', '2023-10-15 16:46:33'),
(129, 28, 'd) Un bucle que solo se ejecuta una vez.', 0, '2023-10-15 16:46:33', '2023-10-15 16:46:33'),
(130, 29, 'a) Almacenar datos de forma permanente en la memoria de la computadora.', 0, '2023-10-15 16:47:11', '2023-10-15 16:47:11'),
(131, 29, 'b) Cambiar la velocidad de la CPU.', 0, '2023-10-15 16:47:11', '2023-10-15 16:47:11'),
(132, 29, 'c) Almacenar y manipular datos temporalmente durante la ejecución del programa.', 1, '2023-10-15 16:47:11', '2023-10-15 16:47:11'),
(133, 29, 'd) Conectar dos dispositivos de red.', 0, '2023-10-15 16:47:11', '2023-10-15 16:47:11'),
(134, 30, 'a) Un tipo de código fuente que se ejecuta en un navegador web.', 0, '2023-10-15 16:47:59', '2023-10-15 16:47:59'),
(135, 30, 'b) Un lenguaje de programación muy complejo.', 0, '2023-10-15 16:47:59', '2023-10-15 16:47:59'),
(136, 30, 'c) Un enfoque para describir algoritmos utilizando lenguaje natural y estructuras de control simples.', 1, '2023-10-15 16:47:59', '2023-10-15 16:47:59'),
(137, 30, 'd) Un lenguaje de programación utilizado principalmente para aplicaciones móviles.', 0, '2023-10-15 16:47:59', '2023-10-15 16:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0cPikddLqKoeYagwGLK276lhvk22xmJ7yNNjx9x0', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0hoUjdMa2toMGpROHpicjQxdzg0Z1ZXTGV3UTJMUkdrV1BOV0FuQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9zaXN0ZW1hX3Rlc3QvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1698355958),
('QcwfacbqZkwE9JPPG3L5TFlWYn94PhFh7tXSHWwT', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia0NvSlRVTjFYMkhoOUtjOHNYNVVFQjhCS016RFl3Y3VYd0RXUEROSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9zaXN0ZW1hX3Rlc3QvcHVibGljL2xvZ2luIjt9czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0OToiaHR0cDovL2xvY2FsaG9zdC9sYXJhdmVsL3Npc3RlbWFfdGVzdC9wdWJsaWMvaG9tZSI7fX0=', 1698357532);

-- --------------------------------------------------------

--
-- Table structure for table `temas`
--

CREATE TABLE `temas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temas`
--

INSERT INTO `temas` (`id`, `nombre`, `curso_id`, `created_at`, `updated_at`) VALUES
(1, 'SQL (Structured Query Language)', 1, '2023-10-05 20:32:46', '2023-10-15 16:05:38'),
(3, 'Diseño de Bases de Datos Relacionales', 1, '2023-10-05 20:46:33', '2023-10-15 16:05:47'),
(4, 'Introducción a la Programación', 2, '2023-10-05 20:48:29', '2023-10-15 16:39:04'),
(5, 'Estructuras de Control', 2, '2023-10-05 20:48:43', '2023-10-15 16:39:11'),
(6, 'Estructuras de Datos', 2, '2023-10-05 20:48:54', '2023-10-15 16:39:22'),
(7, 'matematica', 4, '2023-10-12 20:30:04', '2023-10-12 20:30:04'),
(8, 'fisica', 4, '2023-10-12 20:30:17', '2023-10-12 20:30:17'),
(9, 'IA', 4, '2023-10-12 20:30:31', '2023-10-12 20:30:31'),
(10, 'Modelado de Datos', 1, '2023-10-15 16:05:27', '2023-10-15 16:05:27'),
(11, 'Integridad de Datos', 1, '2023-10-15 16:05:58', '2023-10-15 16:05:58'),
(12, 'Índices y Optimización de Consultas', 1, '2023-10-15 16:06:09', '2023-10-15 16:06:09'),
(13, 'Modelo de Datos Lógico y Físico', 1, '2023-10-15 16:06:17', '2023-10-15 16:06:17'),
(14, 'Transacciones y Control de Concurrencia', 1, '2023-10-15 16:06:27', '2023-10-15 16:06:27'),
(15, 'Almacenamiento y Recuperación de Datos', 1, '2023-10-15 16:06:40', '2023-10-15 16:06:40'),
(16, 'Programación Orientada a Objetos', 2, '2023-10-15 16:39:33', '2023-10-15 16:39:33'),
(17, 'Lenguajes de Programación', 2, '2023-10-15 16:39:42', '2023-10-15 16:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `genero` varchar(25) DEFAULT NULL,
  `curso_id` text NOT NULL DEFAULT '[]',
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `rol`, `genero`, `curso_id`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$t9AKApfnykEhPAEnVHcCEurj3wyWQYFG22vpN5cat54XFiavDCVP2', 'Admin', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-04 21:20:57', '2023-10-04 23:27:25'),
(6, 'ales', 'aasdsd@gmail.com', NULL, '$2y$10$fc828bJlpPs8NMhIv2mEBOe015VuuKx.llPQiAp9FgmIjjNCXImCC', 'Profesor', NULL, '[\"2\",\"3\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-11 00:59:45', '2023-10-12 20:26:10'),
(7, 'alfred', 'alfred@gmail.com', NULL, '$2y$10$3H1MsyD/6iGJSKGknKM1mOqGyPxCE86rwNgoVBovv/ADRWpoahGKK', 'Profesor', NULL, '[\"1\",\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-11 01:12:05', '2023-10-12 20:24:52'),
(11, 'profesor', 'profesor@gmail.com', NULL, '$2y$10$qQ3uwW8cdsL0f80L52Gy3.Ops/ipygQw3iEiFrMBKYZLXYOslNijm', 'Profesor', NULL, '[\"1\",\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-14 18:07:40', '2023-10-23 18:15:29'),
(12, 'alumno', 'alumno@gmail.com', NULL, '$2y$10$KWaDcUCnysjYSeVjyljkgOofyxo3ZRL4u2k5OmPneMhL7oXRzjxMy', 'Alumno', 'Masculino', '[\"1\",\"2\",\"3\",\"4\",\"6\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-14 18:08:10', '2023-10-14 18:13:30'),
(13, 'alumno 1', 'alumno1@gmail.com', NULL, '$2y$10$VuMg7qf5Vh5og5uyS4jPreJ.blbzVBRaiNfq4MEfmd2.BG8p7.vvO', 'Alumno', 'Masculino', '[\"1\",\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-16 16:59:35', '2023-10-26 21:43:01'),
(14, 'alumno 2', 'alumno2@gmail.com', NULL, '$2y$10$DwfLSyYGEeviCxh64E3uiuc0/JbsgW5ZYjOQRZDpl0qyd6si6ijOy', 'Alumno', 'Masculino', '[\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-17 21:20:47', '2023-10-17 21:23:17'),
(15, 'alumno 4', 'alumno4@gmail.com', NULL, '$2y$10$aW99xmzX9pNHokk41ZKKtu16Z.1JAWLKh6kdOeBMxyBvCBUXBqGXC', 'Alumno', 'Masculino', '[\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-17 21:21:01', '2023-10-17 21:23:21'),
(16, 'alumno 5', 'alumno5@gmail.com', NULL, '$2y$10$x9KXmav4XMHWebXnv8cvyudrNRmBhjH2VZcEe.2mUyzh8/vviMkMi', 'Alumno', 'Masculino', '[\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-17 21:21:32', '2023-10-17 21:23:30'),
(17, 'alumno 6', 'alumno6@gmail.com', NULL, '$2y$10$jZN0qkrXAo3H0duRY43R8uiOPf28q1a6Nwh8cvm7s7lcfBJHOZDbm', 'Alumno', 'Masculino', '[\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-17 21:21:46', '2023-10-17 21:23:39'),
(18, 'alumno 7', 'alumno7@gmail.com', NULL, '$2y$10$izCBKgRAoNlQVVMPSNEp3.ybig4RntmsUE/jW9lQScwzWzjGwUvsK', 'Alumno', 'Masculino', '[\"1\",\"2\",\"3\",\"4\",\"6\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-17 21:22:10', '2023-10-17 21:23:35'),
(19, 'anel', 'alumno8@gmail.com', NULL, '$2y$10$b7xenMmlcqE7K9m3RScCZeR6aPpeZuynaMK0.VmItHFsQjB.TlXne', 'Alumno', 'Masculino', '[\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-17 21:37:57', '2023-10-17 21:39:34'),
(20, 'luis mendez', 'alumno9@gmail.com', NULL, '$2y$10$1DLmMq6WbwWKcq/Km8ndt.Bg5HKjgth98T3IuKIdGyGfXxDM89IQ.', 'Alumno', 'Masculino', '[\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-17 21:38:13', '2023-10-17 21:39:40'),
(21, 'pedro luis', 'alumno10@gmail.com', NULL, '$2y$10$ClGd2nHDyPOyZs.432Iut.EK3sGmzERzZk6RGsYqq5uxr3X8JyI8C', 'Alumno', 'Masculino', '[\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-17 21:38:30', '2023-10-17 21:39:45'),
(22, 'frank lopez', 'alumno3@gmail.com', NULL, '$2y$10$HIt0MoBQf/gjoEWq3jtLbe.2ngg7lz5utgtkJp4ZVfk8YyOb5/yfm', 'Alumno', 'Masculino', '[\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-17 21:38:51', '2023-10-17 21:38:51'),
(23, 'leo', 'alumno11@gmail.com', NULL, '$2y$10$Pp9qub/U2TzSkcqOzmNLxOpbLYkhUNIjjHwYolRr0AKIwDEAN9FEy', 'Alumno', 'Masculino', '[\"1\",\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-18 16:24:06', '2023-10-18 16:25:13'),
(24, 'andrea', 'alumno12@gmail.com', NULL, '$2y$10$8NE21SEiT4ASBsOdSi0JKOjgrixgrK6CrPIjljVTestR0GKLiQ3ZW', 'Alumno', 'Femenino', '[\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-18 16:24:21', '2023-10-18 16:25:26'),
(25, 'Angela mendez', 'alumno13@gmail.com', NULL, '$2y$10$T6hcLm8dmDAeOpEKoCxCZev6LybyKtWvzPI3ChP2/fQlJGu9ZM41K', 'Alumno', 'Femenino', '[\"2\"]', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-18 16:24:49', '2023-10-18 16:25:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examen_alumno`
--
ALTER TABLE `examen_alumno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exame_resultados`
--
ALTER TABLE `exame_resultados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tema_id` (`tema_id`);

--
-- Indexes for table `pregunta_alternativa`
--
ALTER TABLE `pregunta_alternativa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `examen_alumno`
--
ALTER TABLE `examen_alumno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `exame_resultados`
--
ALTER TABLE `exame_resultados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pregunta_alternativa`
--
ALTER TABLE `pregunta_alternativa`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `temas`
--
ALTER TABLE `temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);

--
-- Constraints for table `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_2` FOREIGN KEY (`tema_id`) REFERENCES `temas` (`id`);

--
-- Constraints for table `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
