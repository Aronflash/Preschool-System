-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2024 a las 16:56:32
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comunitario_pagina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentes_paranatales`
--

CREATE TABLE `antecedentes_paranatales` (
  `codigo_antecedentes` int(3) NOT NULL,
  `enfermedad` varchar(50) NOT NULL,
  `hospitalizado` varchar(50) NOT NULL,
  `alergias` varchar(50) NOT NULL,
  `condicion` varchar(50) NOT NULL,
  `informe` varchar(50) NOT NULL,
  `limitacion` varchar(50) NOT NULL,
  `especialista` varchar(50) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `enfermar_facilidad` varchar(50) NOT NULL,
  `cedula_escolar` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caso_emergencia`
--

CREATE TABLE `caso_emergencia` (
  `codigo_emergencia` int(3) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `foto_emergencia` longblob DEFAULT NULL,
  `parentesco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `codigo_estado` int(3) NOT NULL,
  `estado` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`codigo_estado`, `estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_civil`
--

CREATE TABLE `estado_civil` (
  `codigo_estadocivil` int(3) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `estado_civil`
--

INSERT INTO `estado_civil` (`codigo_estadocivil`, `descripcion`) VALUES
(1, 'Casado(a)'),
(2, 'Divorciado(a)'),
(3, 'Soltero(a)'),
(4, 'Viudo(a)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `cedula_escolar` varchar(15) NOT NULL,
  `Nacionalidad` char(2) NOT NULL,
  `nombres` varchar(35) NOT NULL,
  `apellidos` varchar(35) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `lugar_nacimiento` varchar(80) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `codigo_nacionalidad` int(3) NOT NULL,
  `estado_hermano` varchar(3) NOT NULL,
  `cantidad_hermano` int(3) NOT NULL,
  `sexo_hermano` varchar(3) NOT NULL,
  `lugar_hermano` varchar(20) NOT NULL,
  `cedula_representante` varchar(10) NOT NULL,
  `cedula_papa` varchar(10) NOT NULL,
  `cedula_mama` varchar(10) NOT NULL,
  `caso_emergencia` int(3) NOT NULL,
  `foto_estudiante` longblob DEFAULT NULL,
  `procedencia` varchar(30) NOT NULL,
  `estado_estudiante` int(3) NOT NULL DEFAULT 1,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_antecedentes`
--

CREATE TABLE `historico_antecedentes` (
  `codigo_antecedentes` int(11) NOT NULL,
  `enfermedad` varchar(50) NOT NULL,
  `hospitalizado` varchar(50) NOT NULL,
  `alergias` varchar(50) NOT NULL,
  `condicion` varchar(50) NOT NULL,
  `informe` varchar(50) NOT NULL,
  `limitacion` varchar(50) NOT NULL,
  `especialista` varchar(50) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `enfermar_facilidad` varchar(50) NOT NULL,
  `cedula_escolar` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_caso`
--

CREATE TABLE `historico_caso` (
  `codigo_emergencia` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `foto_emergencia` longblob NOT NULL,
  `parentesco` int(11) NOT NULL,
  `periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_estudiante`
--

CREATE TABLE `historico_estudiante` (
  `cedula_escolar` varchar(15) NOT NULL,
  `Nacionalidad` char(2) NOT NULL,
  `nombres` varchar(35) NOT NULL,
  `apellidos` varchar(35) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `lugar_nacimiento` varchar(80) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `codigo_nacionalidad` int(3) NOT NULL,
  `estado_hermano` varchar(3) NOT NULL,
  `cantidad_hermano` int(3) NOT NULL,
  `sexo_hermano` varchar(3) NOT NULL,
  `lugar_hermano` varchar(20) NOT NULL,
  `cedula_representante` varchar(10) NOT NULL,
  `cedula_papa` varchar(10) NOT NULL,
  `cedula_mama` varchar(10) NOT NULL,
  `caso_emergencia` int(3) NOT NULL,
  `foto_estudiante` longblob NOT NULL,
  `procedencia` varchar(30) NOT NULL,
  `estado_estudiante` int(3) NOT NULL,
  `periodo` int(11) NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_inscripcion`
--

CREATE TABLE `historico_inscripcion` (
  `codigo_inscripcion` varchar(50) NOT NULL,
  `cedula_escolar` varchar(15) NOT NULL,
  `codigo_nivelseccion` int(11) NOT NULL,
  `codigo_periodo` int(3) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_mama`
--

CREATE TABLE `historico_mama` (
  `cedula_mama` varchar(10) NOT NULL,
  `nombres` varchar(20) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `codigo_estadocivil` int(3) NOT NULL,
  `codigo_nacionalidad` int(3) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion_habitacion` varchar(80) NOT NULL,
  `telefono_habitacion` varchar(11) NOT NULL,
  `direccion_trabajo` varchar(80) NOT NULL,
  `telefono_trabajo` varchar(11) NOT NULL,
  `codigo_nivelacademico` int(3) NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `profesion` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `datos_extras` varchar(150) NOT NULL,
  `foto_mama` longblob NOT NULL,
  `codigo_estado` int(3) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `periodo` int(11) NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_nivel_seccion`
--

CREATE TABLE `historico_nivel_seccion` (
  `codigo_nivelseccion` int(11) NOT NULL,
  `codigo_niveles` int(5) NOT NULL,
  `codigo_seccion` int(5) NOT NULL,
  `estado` int(3) NOT NULL,
  `periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historico_nivel_seccion`
--

INSERT INTO `historico_nivel_seccion` (`codigo_nivelseccion`, `codigo_niveles`, `codigo_seccion`, `estado`, `periodo`) VALUES
(115, 1, 1, 1, 13),
(116, 2, 2, 1, 13),
(117, 2, 3, 1, 13),
(118, 3, 4, 1, 13),
(119, 3, 5, 1, 13),
(120, 4, 6, 1, 13),
(121, 4, 7, 1, 13),
(122, 1, 1, 1, 14),
(123, 2, 2, 1, 14),
(124, 2, 3, 1, 14),
(125, 3, 4, 1, 14),
(126, 3, 5, 1, 14),
(127, 4, 6, 1, 14),
(128, 4, 7, 1, 14),
(129, 1, 1, 1, 15),
(130, 2, 2, 1, 15),
(131, 2, 3, 1, 15),
(132, 3, 4, 1, 15),
(133, 3, 5, 1, 15),
(134, 4, 6, 1, 15),
(135, 4, 7, 1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_papa`
--

CREATE TABLE `historico_papa` (
  `cedula_papa` int(10) NOT NULL,
  `nombres` varchar(25) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `codigo_estadocivil` int(3) NOT NULL,
  `codigo_nacionalidad` int(3) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion_habitacion` varchar(80) NOT NULL,
  `telefono_habitacion` varchar(11) NOT NULL,
  `direccion_trabajo` varchar(80) NOT NULL,
  `telefono_trabajo` varchar(11) NOT NULL,
  `codigo_nivelacademico` int(3) NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `profesion` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `datos_extras` varchar(150) NOT NULL,
  `foto_papa` longblob NOT NULL,
  `codigo_estado` int(3) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `periodo` int(11) NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_representante`
--

CREATE TABLE `historico_representante` (
  `cedula_representante` varchar(10) NOT NULL,
  `nombres` varchar(25) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `codigo_parentesco` int(3) NOT NULL,
  `foto_representante` longblob NOT NULL,
  `codigo_estado` int(3) NOT NULL,
  `nacionalidad` int(3) NOT NULL,
  `periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_secciones`
--

CREATE TABLE `historico_secciones` (
  `codigo_seccion` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historico_secciones`
--

INSERT INTO `historico_secciones` (`codigo_seccion`, `nombre`, `periodo`) VALUES
(1, 'UNICA', 13),
(1, 'UNICA', 14),
(1, 'UNICA', 15),
(2, 'A', 13),
(2, 'A', 14),
(2, 'A', 15),
(3, 'B', 13),
(3, 'B', 14),
(3, 'B', 15),
(4, 'C', 13),
(4, 'C', 14),
(4, 'C', 15),
(5, 'D', 13),
(5, 'D', 14),
(5, 'D', 15),
(6, 'E', 13),
(6, 'E', 14),
(6, 'E', 15),
(7, 'F', 13),
(7, 'F', 14),
(7, 'F', 15),
(8, 'G', 13),
(8, 'G', 14),
(8, 'G', 15),
(9, 'H', 13),
(9, 'H', 14),
(9, 'H', 15),
(10, 'I', 13),
(10, 'I', 14),
(10, 'I', 15),
(11, 'J', 13),
(11, 'J', 14),
(11, 'J', 15),
(12, 'K', 13),
(12, 'K', 14),
(12, 'K', 15),
(13, 'L', 13),
(13, 'L', 14),
(13, 'L', 15),
(14, 'M', 13),
(14, 'M', 14),
(14, 'M', 15),
(15, 'N', 13),
(15, 'N', 14),
(15, 'N', 15),
(16, 'Ñ', 13),
(16, 'Ñ', 14),
(16, 'Ñ', 15),
(17, 'O', 13),
(17, 'O', 14),
(17, 'O', 15),
(18, 'P', 13),
(18, 'P', 14),
(18, 'P', 15),
(19, 'Q', 13),
(19, 'Q', 14),
(19, 'Q', 15),
(20, 'R', 13),
(20, 'R', 14),
(20, 'R', 15),
(21, 'S', 13),
(21, 'S', 14),
(21, 'S', 15),
(22, 'T', 13),
(22, 'T', 14),
(22, 'T', 15),
(23, 'U', 13),
(23, 'U', 14),
(23, 'U', 15),
(24, 'V', 13),
(24, 'V', 14),
(24, 'V', 15),
(25, 'W', 13),
(25, 'W', 14),
(25, 'W', 15),
(26, 'X', 13),
(26, 'X', 14),
(26, 'X', 15),
(27, 'Y', 13),
(27, 'Y', 14),
(27, 'Y', 15),
(28, 'Z', 13),
(28, 'Z', 14),
(28, 'Z', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `codigo_inscripcion` varchar(50) NOT NULL,
  `cedula_escolar` varchar(15) NOT NULL,
  `codigo_nivelseccion` int(11) NOT NULL,
  `codigo_periodo` int(3) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mama`
--

CREATE TABLE `mama` (
  `cedula_mama` varchar(10) NOT NULL,
  `nombres` varchar(20) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `codigo_estadocivil` int(3) NOT NULL,
  `codigo_nacionalidad` int(3) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion_habitacion` varchar(80) NOT NULL,
  `telefono_habitacion` varchar(11) NOT NULL,
  `direccion_trabajo` varchar(80) NOT NULL,
  `telefono_trabajo` varchar(11) NOT NULL,
  `codigo_nivelacademico` int(3) NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `profesion` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `datos_extras` varchar(150) NOT NULL,
  `foto_mama` longblob DEFAULT NULL,
  `codigo_estado` int(3) NOT NULL DEFAULT 1,
  `telefono` varchar(20) DEFAULT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidad`
--

CREATE TABLE `nacionalidad` (
  `codigo_nacionalidad` int(3) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `nacionalidad`
--

INSERT INTO `nacionalidad` (`codigo_nacionalidad`, `descripcion`) VALUES
(1, 'Venezolano'),
(2, 'Extranjero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `codigo_niveles` int(5) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `codigo_estado` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`codigo_niveles`, `descripcion`, `codigo_estado`) VALUES
(1, 'Maternal', 1),
(2, 'Grupo A', 1),
(3, 'Grupo B', 1),
(4, 'Grupo C', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_academico`
--

CREATE TABLE `nivel_academico` (
  `codigo_nivelacademico` int(3) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `nivel_academico`
--

INSERT INTO `nivel_academico` (`codigo_nivelacademico`, `descripcion`) VALUES
(1, 'Educación Inicial'),
(2, 'Primaria'),
(3, 'Bachillerato'),
(4, 'Técnico Superior Universitario (TSU)'),
(5, 'Universitario'),
(6, 'Postgrado'),
(7, 'Doctorado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_seccion`
--

CREATE TABLE `nivel_seccion` (
  `codigo_nivelseccion` int(11) NOT NULL,
  `codigo_niveles` int(5) NOT NULL,
  `codigo_seccion` int(5) NOT NULL,
  `estado` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nivel_seccion`
--

INSERT INTO `nivel_seccion` (`codigo_nivelseccion`, `codigo_niveles`, `codigo_seccion`, `estado`) VALUES
(115, 1, 1, 1),
(116, 2, 2, 1),
(117, 2, 3, 1),
(118, 3, 4, 1),
(119, 3, 5, 1),
(120, 4, 6, 1),
(121, 4, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papa`
--

CREATE TABLE `papa` (
  `cedula_papa` varchar(10) NOT NULL,
  `nombres` varchar(25) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `codigo_estadocivil` int(3) NOT NULL,
  `codigo_nacionalidad` int(3) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion_habitacion` varchar(80) NOT NULL,
  `telefono_habitacion` varchar(11) NOT NULL,
  `direccion_trabajo` varchar(80) NOT NULL,
  `telefono_trabajo` varchar(11) NOT NULL,
  `codigo_nivelacademico` int(3) NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `profesion` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `datos_extras` varchar(150) NOT NULL,
  `foto_papa` longblob DEFAULT NULL,
  `codigo_estado` int(3) NOT NULL DEFAULT 1,
  `telefono` varchar(20) NOT NULL,
  `edad` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentesco`
--

CREATE TABLE `parentesco` (
  `codigo_parentesco` int(3) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `parentesco`
--

INSERT INTO `parentesco` (`codigo_parentesco`, `descripcion`) VALUES
(1, 'Padre'),
(2, 'Madre'),
(3, 'Abuelo/a'),
(4, 'Tio/a'),
(5, 'Hermano/a'),
(6, 'Primo/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_academico`
--

CREATE TABLE `periodo_academico` (
  `codigo_periodo` int(3) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `actual` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `periodo_academico`
--

INSERT INTO `periodo_academico` (`codigo_periodo`, `nombre`, `fecha_inicio`, `fecha_fin`, `actual`) VALUES
(13, '2024-2025', '2024-01-01', '2025-01-01', 1),
(14, '2025-2026', '2025-01-01', '2026-01-01', 0),
(15, '2026-2027', '2026-01-01', '2027-01-01', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representante_legal`
--

CREATE TABLE `representante_legal` (
  `cedula_representante` varchar(10) NOT NULL,
  `nombres` varchar(20) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `codigo_parentesco` int(3) NOT NULL,
  `foto_representante` longblob DEFAULT NULL,
  `codigo_estado` int(3) NOT NULL DEFAULT 1,
  `nacionalidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `codigo_seccion` int(5) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`codigo_seccion`, `nombre`) VALUES
(1, 'UNICA'),
(2, 'A'),
(3, 'B'),
(4, 'C'),
(5, 'D'),
(6, 'E'),
(7, 'F'),
(8, 'G'),
(9, 'H'),
(10, 'I'),
(11, 'J'),
(12, 'K'),
(13, 'L'),
(14, 'M'),
(15, 'N'),
(16, 'Ñ'),
(17, 'O'),
(18, 'P'),
(19, 'Q'),
(20, 'R'),
(21, 'S'),
(22, 'T'),
(23, 'U'),
(24, 'V'),
(25, 'W'),
(26, 'X'),
(27, 'Y'),
(28, 'Z');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_usuario`
--

CREATE TABLE `tipo_de_usuario` (
  `codigo_tusuario` int(3) NOT NULL,
  `Tipodeusuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_de_usuario`
--

INSERT INTO `tipo_de_usuario` (`codigo_tusuario`, `Tipodeusuario`) VALUES
(1, 'Director'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codigo_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(10) NOT NULL,
  `contrasena` varchar(21) NOT NULL,
  `tipodeusuario` int(3) NOT NULL,
  `codigo_estado` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo_usuario`, `nombre_usuario`, `contrasena`, `tipodeusuario`, `codigo_estado`) VALUES
(1, 'admin', 'admin', 1, 1),
(2, 'Jhosmar', '1234', 2, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_estudiantesactivos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_estudiantesactivos` (
`cedula_escolar` varchar(15)
,`nombres` varchar(35)
,`apellidos` varchar(35)
,`fecha_nacimiento` date
,`edad` int(11)
,`lugar_nacimiento` varchar(80)
,`estado` varchar(20)
,`codigo_nacionalidad` int(3)
,`estado_hermano` varchar(3)
,`cantidad_hermano` int(3)
,`sexo_hermano` varchar(3)
,`lugar_hermano` varchar(20)
,`cedula_representante` varchar(10)
,`cedula_papa` varchar(10)
,`cedula_mama` varchar(10)
,`caso_emergencia` int(3)
,`foto_estudiante` longblob
,`procedencia` varchar(30)
,`estado_estudiante` int(3)
,`cedula_escolar_b` varchar(15)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_planillainscripcion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_planillainscripcion` (
`codigo_inscripcion` varchar(50)
,`cedula_estudiante` varchar(15)
,`apellidos_b` varchar(35)
,`nacionalidad_b` char(2)
,`nombres_b` varchar(35)
,`fna_b` date
,`edad_b` int(11)
,`lna_b` varchar(80)
,`estado_b` varchar(20)
,`procedencia_b` varchar(30)
,`estadoHermano_b` varchar(3)
,`cantidadHermano_b` int(3)
,`lugarHermano_b` varchar(20)
,`cedula_r` varchar(10)
,`nacionalidad_r` int(3)
,`nombres_r` varchar(20)
,`apellidos_r` varchar(25)
,`telefono_r` varchar(11)
,`parentesco_r` varchar(50)
,`cedula_m` varchar(10)
,`nacionalidad_m` int(3)
,`nombres_m` varchar(20)
,`apellidos_m` varchar(25)
,`telefono_m` varchar(20)
,`estadoCivil_m` int(3)
,`fecha_m` date
,`edad_m` int(11)
,`dh_m` varchar(80)
,`th_m` varchar(11)
,`dt_m` varchar(80)
,`tt_m` varchar(11)
,`nivelAcademico_m` int(3)
,`ocupacion_m` varchar(100)
,`profesion_m` varchar(100)
,`correo_m` varchar(50)
,`datos_extra_m` varchar(150)
,`cedula_pp` varchar(10)
,`nacionalidad_pp` int(3)
,`nombres_pp` varchar(25)
,`apellidos_pp` varchar(25)
,`telefono_pp` varchar(20)
,`estadoCivil_pp` int(3)
,`fecha_pp` date
,`edad_pp` int(11)
,`dh_pp` varchar(80)
,`th_pp` varchar(11)
,`dt_pp` varchar(80)
,`tt_pp` varchar(11)
,`nivelAcademico_pp` int(3)
,`ocupacion_pp` varchar(100)
,`profesion_pp` varchar(100)
,`correo_pp` varchar(50)
,`datos_extra_pp` varchar(150)
,`enfermedad_AP` varchar(50)
,`hospitalizado_AP` varchar(50)
,`alergias_AP` varchar(50)
,`condicion_AP` varchar(50)
,`informe_AP` varchar(50)
,`limitacion_AP` varchar(50)
,`especialista_AP` varchar(50)
,`doctor_AP` varchar(50)
,`enfermar_facilidad_AP` varchar(50)
,`fecha` date
,`caso_emergencia` varchar(15)
,`parentesco_emergencia` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_estudiantesactivos`
--
DROP TABLE IF EXISTS `v_estudiantesactivos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_estudiantesactivos`  AS   (select `a`.`cedula_escolar` AS `cedula_escolar`,`a`.`nombres` AS `nombres`,`a`.`apellidos` AS `apellidos`,`a`.`fecha_nacimiento` AS `fecha_nacimiento`,`a`.`edad` AS `edad`,`a`.`lugar_nacimiento` AS `lugar_nacimiento`,`a`.`estado` AS `estado`,`a`.`codigo_nacionalidad` AS `codigo_nacionalidad`,`a`.`estado_hermano` AS `estado_hermano`,`a`.`cantidad_hermano` AS `cantidad_hermano`,`a`.`sexo_hermano` AS `sexo_hermano`,`a`.`lugar_hermano` AS `lugar_hermano`,`a`.`cedula_representante` AS `cedula_representante`,`a`.`cedula_papa` AS `cedula_papa`,`a`.`cedula_mama` AS `cedula_mama`,`a`.`caso_emergencia` AS `caso_emergencia`,`a`.`foto_estudiante` AS `foto_estudiante`,`a`.`procedencia` AS `procedencia`,`a`.`estado_estudiante` AS `estado_estudiante`,`b`.`cedula_escolar` AS `cedula_escolar_b` from ((`estudiante` `a` join `inscripcion` `b` on(`a`.`cedula_escolar` = `b`.`cedula_escolar`)) join `periodo_academico` `c` on(`c`.`codigo_periodo` = `b`.`codigo_periodo`)) where `c`.`actual` = 1)  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_planillainscripcion`
--
DROP TABLE IF EXISTS `v_planillainscripcion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_planillainscripcion`  AS   (select `a`.`codigo_inscripcion` AS `codigo_inscripcion`,`b`.`cedula_escolar` AS `cedula_estudiante`,`b`.`apellidos` AS `apellidos_b`,`b`.`Nacionalidad` AS `nacionalidad_b`,`b`.`nombres` AS `nombres_b`,`b`.`fecha_nacimiento` AS `fna_b`,`b`.`edad` AS `edad_b`,`b`.`lugar_nacimiento` AS `lna_b`,`b`.`estado` AS `estado_b`,`b`.`procedencia` AS `procedencia_b`,`b`.`estado_hermano` AS `estadoHermano_b`,`b`.`cantidad_hermano` AS `cantidadHermano_b`,`b`.`lugar_hermano` AS `lugarHermano_b`,`r`.`cedula_representante` AS `cedula_r`,`r`.`nacionalidad` AS `nacionalidad_r`,`r`.`nombres` AS `nombres_r`,`r`.`apellidos` AS `apellidos_r`,`r`.`telefono` AS `telefono_r`,`p`.`descripcion` AS `parentesco_r`,`m`.`cedula_mama` AS `cedula_m`,`m`.`codigo_nacionalidad` AS `nacionalidad_m`,`m`.`nombres` AS `nombres_m`,`m`.`apellidos` AS `apellidos_m`,`m`.`telefono` AS `telefono_m`,`m`.`codigo_estadocivil` AS `estadoCivil_m`,`m`.`fecha_nacimiento` AS `fecha_m`,`m`.`edad` AS `edad_m`,`m`.`direccion_habitacion` AS `dh_m`,`m`.`telefono_habitacion` AS `th_m`,`m`.`direccion_trabajo` AS `dt_m`,`m`.`telefono_trabajo` AS `tt_m`,`m`.`codigo_nivelacademico` AS `nivelAcademico_m`,`m`.`ocupacion` AS `ocupacion_m`,`m`.`profesion` AS `profesion_m`,`m`.`correo` AS `correo_m`,`m`.`datos_extras` AS `datos_extra_m`,`pp`.`cedula_papa` AS `cedula_pp`,`pp`.`codigo_nacionalidad` AS `nacionalidad_pp`,`pp`.`nombres` AS `nombres_pp`,`pp`.`apellidos` AS `apellidos_pp`,`pp`.`telefono` AS `telefono_pp`,`pp`.`codigo_estadocivil` AS `estadoCivil_pp`,`pp`.`fecha_nacimiento` AS `fecha_pp`,`pp`.`edad` AS `edad_pp`,`pp`.`direccion_habitacion` AS `dh_pp`,`pp`.`telefono_habitacion` AS `th_pp`,`pp`.`direccion_trabajo` AS `dt_pp`,`pp`.`telefono_trabajo` AS `tt_pp`,`pp`.`codigo_nivelacademico` AS `nivelAcademico_pp`,`pp`.`ocupacion` AS `ocupacion_pp`,`pp`.`profesion` AS `profesion_pp`,`pp`.`correo` AS `correo_pp`,`pp`.`datos_extras` AS `datos_extra_pp`,`ap`.`enfermedad` AS `enfermedad_AP`,`ap`.`hospitalizado` AS `hospitalizado_AP`,`ap`.`alergias` AS `alergias_AP`,`ap`.`condicion` AS `condicion_AP`,`ap`.`informe` AS `informe_AP`,`ap`.`limitacion` AS `limitacion_AP`,`ap`.`especialista` AS `especialista_AP`,`ap`.`doctor` AS `doctor_AP`,`ap`.`enfermar_facilidad` AS `enfermar_facilidad_AP`,`a`.`fecha` AS `fecha`,`ce`.`nombre` AS `caso_emergencia`,`p1`.`descripcion` AS `parentesco_emergencia` from ((((((((`inscripcion` `a` join `estudiante` `b` on(`a`.`cedula_escolar` = `b`.`cedula_escolar`)) join `representante_legal` `r` on(`b`.`cedula_representante` = `r`.`cedula_representante`)) join `parentesco` `p` on(`p`.`codigo_parentesco` = `r`.`codigo_parentesco`)) join `mama` `m` on(`m`.`cedula_mama` = `b`.`cedula_mama`)) join `papa` `pp` on(`pp`.`cedula_papa` = `b`.`cedula_papa`)) join `antecedentes_paranatales` `ap` on(`ap`.`cedula_escolar` = `b`.`cedula_escolar`)) join `caso_emergencia` `ce` on(`ce`.`codigo_emergencia` = `b`.`caso_emergencia`)) join `parentesco` `p1` on(`ce`.`parentesco` = `p1`.`codigo_parentesco`)))  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedentes_paranatales`
--
ALTER TABLE `antecedentes_paranatales`
  ADD PRIMARY KEY (`codigo_antecedentes`),
  ADD KEY `cedula_escolar` (`cedula_escolar`);

--
-- Indices de la tabla `caso_emergencia`
--
ALTER TABLE `caso_emergencia`
  ADD PRIMARY KEY (`codigo_emergencia`),
  ADD KEY `parentesco` (`parentesco`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`codigo_estado`);

--
-- Indices de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
  ADD PRIMARY KEY (`codigo_estadocivil`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`cedula_escolar`),
  ADD KEY `codigo_nacionalidad` (`codigo_nacionalidad`),
  ADD KEY `cedula_representante` (`cedula_representante`),
  ADD KEY `cedula_papa` (`cedula_papa`),
  ADD KEY `cedula_mama` (`cedula_mama`),
  ADD KEY `caso_emergencia` (`caso_emergencia`);

--
-- Indices de la tabla `historico_antecedentes`
--
ALTER TABLE `historico_antecedentes`
  ADD PRIMARY KEY (`cedula_escolar`,`periodo`);

--
-- Indices de la tabla `historico_caso`
--
ALTER TABLE `historico_caso`
  ADD PRIMARY KEY (`codigo_emergencia`,`periodo`),
  ADD KEY `parentesco` (`parentesco`);

--
-- Indices de la tabla `historico_estudiante`
--
ALTER TABLE `historico_estudiante`
  ADD PRIMARY KEY (`cedula_escolar`,`periodo`);

--
-- Indices de la tabla `historico_inscripcion`
--
ALTER TABLE `historico_inscripcion`
  ADD PRIMARY KEY (`cedula_escolar`,`codigo_periodo`);

--
-- Indices de la tabla `historico_mama`
--
ALTER TABLE `historico_mama`
  ADD PRIMARY KEY (`cedula_mama`,`periodo`),
  ADD KEY `periodo` (`periodo`);

--
-- Indices de la tabla `historico_nivel_seccion`
--
ALTER TABLE `historico_nivel_seccion`
  ADD PRIMARY KEY (`codigo_nivelseccion`,`periodo`);

--
-- Indices de la tabla `historico_papa`
--
ALTER TABLE `historico_papa`
  ADD PRIMARY KEY (`cedula_papa`,`periodo`),
  ADD KEY `periodo` (`periodo`);

--
-- Indices de la tabla `historico_representante`
--
ALTER TABLE `historico_representante`
  ADD PRIMARY KEY (`periodo`,`cedula_representante`);

--
-- Indices de la tabla `historico_secciones`
--
ALTER TABLE `historico_secciones`
  ADD PRIMARY KEY (`codigo_seccion`,`periodo`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`codigo_inscripcion`),
  ADD KEY `cedula_escolar` (`cedula_escolar`),
  ADD KEY `codigo_periodo` (`codigo_periodo`),
  ADD KEY `codigo_nivelseccion` (`codigo_nivelseccion`);

--
-- Indices de la tabla `mama`
--
ALTER TABLE `mama`
  ADD PRIMARY KEY (`cedula_mama`),
  ADD KEY `codigo_estadocivil` (`codigo_estadocivil`),
  ADD KEY `codigo_nacionalidad` (`codigo_nacionalidad`),
  ADD KEY `codigo_nivelacademico` (`codigo_nivelacademico`),
  ADD KEY `codigo_estado` (`codigo_estado`);

--
-- Indices de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  ADD PRIMARY KEY (`codigo_nacionalidad`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`codigo_niveles`),
  ADD KEY `codigo_estado` (`codigo_estado`);

--
-- Indices de la tabla `nivel_academico`
--
ALTER TABLE `nivel_academico`
  ADD PRIMARY KEY (`codigo_nivelacademico`);

--
-- Indices de la tabla `nivel_seccion`
--
ALTER TABLE `nivel_seccion`
  ADD PRIMARY KEY (`codigo_nivelseccion`),
  ADD KEY `codigo_niveles` (`codigo_niveles`),
  ADD KEY `codigo_seccion` (`codigo_seccion`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `papa`
--
ALTER TABLE `papa`
  ADD PRIMARY KEY (`cedula_papa`),
  ADD KEY `codigo_estadocivil` (`codigo_estadocivil`),
  ADD KEY `codigo_nacionalidad` (`codigo_nacionalidad`),
  ADD KEY `codigo_nivelacademico` (`codigo_nivelacademico`),
  ADD KEY `codigo_estado` (`codigo_estado`);

--
-- Indices de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  ADD PRIMARY KEY (`codigo_parentesco`);

--
-- Indices de la tabla `periodo_academico`
--
ALTER TABLE `periodo_academico`
  ADD PRIMARY KEY (`codigo_periodo`);

--
-- Indices de la tabla `representante_legal`
--
ALTER TABLE `representante_legal`
  ADD PRIMARY KEY (`cedula_representante`),
  ADD KEY `codigo_parentesco` (`codigo_parentesco`),
  ADD KEY `codigo_estado` (`codigo_estado`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`codigo_seccion`);

--
-- Indices de la tabla `tipo_de_usuario`
--
ALTER TABLE `tipo_de_usuario`
  ADD PRIMARY KEY (`codigo_tusuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo_usuario`),
  ADD KEY `tipodeusuario` (`tipodeusuario`),
  ADD KEY `codigo_estado` (`codigo_estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedentes_paranatales`
--
ALTER TABLE `antecedentes_paranatales`
  MODIFY `codigo_antecedentes` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `caso_emergencia`
--
ALTER TABLE `caso_emergencia`
  MODIFY `codigo_emergencia` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `codigo_estado` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historico_nivel_seccion`
--
ALTER TABLE `historico_nivel_seccion`
  MODIFY `codigo_nivelseccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `nivel_seccion`
--
ALTER TABLE `nivel_seccion`
  MODIFY `codigo_nivelseccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `periodo_academico`
--
ALTER TABLE `periodo_academico`
  MODIFY `codigo_periodo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `codigo_seccion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antecedentes_paranatales`
--
ALTER TABLE `antecedentes_paranatales`
  ADD CONSTRAINT `antecedentes_paranatales_ibfk_1` FOREIGN KEY (`cedula_escolar`) REFERENCES `estudiante` (`cedula_escolar`);

--
-- Filtros para la tabla `caso_emergencia`
--
ALTER TABLE `caso_emergencia`
  ADD CONSTRAINT `caso_emergencia_ibfk_1` FOREIGN KEY (`parentesco`) REFERENCES `parentesco` (`codigo_parentesco`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`codigo_nacionalidad`) REFERENCES `nacionalidad` (`codigo_nacionalidad`),
  ADD CONSTRAINT `estudiante_ibfk_2` FOREIGN KEY (`cedula_representante`) REFERENCES `representante_legal` (`cedula_representante`),
  ADD CONSTRAINT `estudiante_ibfk_3` FOREIGN KEY (`cedula_papa`) REFERENCES `papa` (`cedula_papa`),
  ADD CONSTRAINT `estudiante_ibfk_4` FOREIGN KEY (`cedula_mama`) REFERENCES `mama` (`cedula_mama`),
  ADD CONSTRAINT `estudiante_ibfk_5` FOREIGN KEY (`caso_emergencia`) REFERENCES `caso_emergencia` (`codigo_emergencia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historico_caso`
--
ALTER TABLE `historico_caso`
  ADD CONSTRAINT `historico_caso_ibfk_1` FOREIGN KEY (`parentesco`) REFERENCES `parentesco` (`codigo_parentesco`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_3` FOREIGN KEY (`codigo_periodo`) REFERENCES `periodo_academico` (`codigo_periodo`),
  ADD CONSTRAINT `inscripcion_ibfk_4` FOREIGN KEY (`codigo_nivelseccion`) REFERENCES `nivel_seccion` (`codigo_nivelseccion`),
  ADD CONSTRAINT `inscripcion_ibfk_5` FOREIGN KEY (`cedula_escolar`) REFERENCES `estudiante` (`cedula_escolar`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `mama`
--
ALTER TABLE `mama`
  ADD CONSTRAINT `mama_ibfk_1` FOREIGN KEY (`codigo_estadocivil`) REFERENCES `estado_civil` (`codigo_estadocivil`),
  ADD CONSTRAINT `mama_ibfk_2` FOREIGN KEY (`codigo_nacionalidad`) REFERENCES `nacionalidad` (`codigo_nacionalidad`),
  ADD CONSTRAINT `mama_ibfk_3` FOREIGN KEY (`codigo_nivelacademico`) REFERENCES `nivel_academico` (`codigo_nivelacademico`),
  ADD CONSTRAINT `mama_ibfk_4` FOREIGN KEY (`codigo_estado`) REFERENCES `estado` (`codigo_estado`);

--
-- Filtros para la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD CONSTRAINT `niveles_ibfk_1` FOREIGN KEY (`codigo_estado`) REFERENCES `estado` (`codigo_estado`);

--
-- Filtros para la tabla `nivel_seccion`
--
ALTER TABLE `nivel_seccion`
  ADD CONSTRAINT `nivel_seccion_ibfk_1` FOREIGN KEY (`codigo_niveles`) REFERENCES `niveles` (`codigo_niveles`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nivel_seccion_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `estado` (`codigo_estado`);

--
-- Filtros para la tabla `papa`
--
ALTER TABLE `papa`
  ADD CONSTRAINT `papa_ibfk_1` FOREIGN KEY (`codigo_estadocivil`) REFERENCES `estado_civil` (`codigo_estadocivil`),
  ADD CONSTRAINT `papa_ibfk_2` FOREIGN KEY (`codigo_nacionalidad`) REFERENCES `nacionalidad` (`codigo_nacionalidad`),
  ADD CONSTRAINT `papa_ibfk_3` FOREIGN KEY (`codigo_nivelacademico`) REFERENCES `nivel_academico` (`codigo_nivelacademico`),
  ADD CONSTRAINT `papa_ibfk_4` FOREIGN KEY (`codigo_estado`) REFERENCES `estado` (`codigo_estado`);

--
-- Filtros para la tabla `representante_legal`
--
ALTER TABLE `representante_legal`
  ADD CONSTRAINT `representante_legal_ibfk_1` FOREIGN KEY (`codigo_parentesco`) REFERENCES `parentesco` (`codigo_parentesco`),
  ADD CONSTRAINT `representante_legal_ibfk_2` FOREIGN KEY (`codigo_estado`) REFERENCES `estado` (`codigo_estado`),
  ADD CONSTRAINT `representante_legal_ibfk_3` FOREIGN KEY (`codigo_estado`) REFERENCES `estado` (`codigo_estado`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`tipodeusuario`) REFERENCES `tipo_de_usuario` (`codigo_tusuario`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`codigo_estado`) REFERENCES `estado` (`codigo_estado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
