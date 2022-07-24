-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2021 a las 21:29:58
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
-- Base de datos: `sispro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametricas`
--

CREATE TABLE `parametricas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_padre` int(11) NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modificable` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json`)),
  `estado` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_create` bigint(20) UNSIGNED NOT NULL,
  `user_update` bigint(20) UNSIGNED DEFAULT NULL,
  `user_delete` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parametricas`
--

INSERT INTO `parametricas` (`id`, `id_padre`, `codigo`, `valor`, `grupo`, `descripcion`, `modificable`, `json`, `estado`, `user_create`, `user_update`, `user_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'ACT', 'ACTIVO', 'Estados', 'Estado de activado para campos de estado o similares', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(2, 0, 'DES', 'DESACTIVADO', 'Estados', 'Estado de inactividad o desactivado para campos de estado o similares', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(3, 0, 'SI', 'SI', 'Respuestas', 'Respuesta de tipo afirmativa', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(4, 0, 'NO', 'NO', 'Respuestas', 'Respuesta de tipo negativa', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(5, 0, 'TVZ', 'TALVEZ', 'Respuestas', 'Respuesta de tipo no concluyente', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(6, 0, 'CH', 'Chuquisaca', 'extenciones', 'Extencion para CI del departamento de Chuquisaca', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(7, 0, 'LP', 'La Paz', 'extenciones', 'Extencion para CI del departamento de La Paz', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(8, 0, 'CB', 'Cochabamba', 'extenciones', 'Extencion para CI del departamento de Cochabamba', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(9, 0, 'OR', 'Oruro', 'extenciones', 'Extencion para CI del departamento de Oruro', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(10, 0, 'PT', 'Potosí', 'extenciones', 'Extencion para CI del departamento de Potosí', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(11, 0, 'TJ', 'Tarija', 'extenciones', 'Extencion para CI del departamento de Tarija', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(12, 0, 'SC', 'Santa Cruz', 'extenciones', 'Extencion para CI del departamento de Santa Cruz', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(13, 0, 'BE', 'Beni', 'extenciones', 'Extencion para CI del departamento de Beni', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(14, 0, 'PD', 'Pando', 'extenciones', 'Extencion para CI del departamento de Pando', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(15, 0, 'M', 'Masculino', 'Genero  ', 'Tipo de sexo, Género Masculino', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL),
(16, 0, 'F', 'Femenino', 'Genero', 'Tipo de sexo, Género Femenino', 'NO', NULL, 'ACT', 1, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `parametricas`
--
ALTER TABLE `parametricas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parametricas_user_create_foreign` (`user_create`),
  ADD KEY `parametricas_user_update_foreign` (`user_update`),
  ADD KEY `parametricas_user_delete_foreign` (`user_delete`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `parametricas`
--
ALTER TABLE `parametricas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `parametricas`
--
ALTER TABLE `parametricas`
  ADD CONSTRAINT `parametricas_user_create_foreign` FOREIGN KEY (`user_create`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `parametricas_user_delete_foreign` FOREIGN KEY (`user_delete`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `parametricas_user_update_foreign` FOREIGN KEY (`user_update`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
