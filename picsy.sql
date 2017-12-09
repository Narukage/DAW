-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2017 a las 23:16:09
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `picsy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE `albumes` (
  `idAlbum` int(11) NOT NULL,
  `Titulo` varchar(11) COLLATE utf16_spanish_ci NOT NULL,
  `Descripcion` varchar(11) COLLATE utf16_spanish_ci NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Pais` int(11) DEFAULT NULL,
  `Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`idAlbum`, `Titulo`, `Descripcion`, `Fecha`, `Pais`, `Usuario`) VALUES
(2, 'Misvacas ', 'Que bien ', '2017-11-07', 2, 1),
(3, 'Mispenas', 'Llorando', '2017-11-08', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `IdFoto` int(11) NOT NULL,
  `Titulo` varchar(11) COLLATE utf16_spanish_ci NOT NULL,
  `Descripcion` varchar(11) COLLATE utf16_spanish_ci NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Pais` int(11) DEFAULT NULL,
  `Album` int(11) NOT NULL,
  `Fichero` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `Fregistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`IdFoto`, `Titulo`, `Descripcion`, `Fecha`, `Pais`, `Album`, `Fichero`, `Fregistro`) VALUES
(1, 'Playa', 'La playica', '2017-11-16', 1, 3, '/PARALUJAN/dec/p1.jpg', '2017-11-29 02:18:18'),
(2, 'El mar', 'malviviendo', '2017-11-04', 1, 3, '/PARALUJAN/dec/paisaje2.jpg', '2017-11-15 00:00:00'),
(3, 'Mi vida', 'te quiero', '2017-11-10', 2, 3, '/PARALUJAN/dec/paisaje3.jpg', '2017-11-11 00:00:00'),
(4, 'El amor', 'Navegando', '2017-11-10', 1, 3, '/PARALUJAN/dec/paisaje3.jpg', '2017-11-11 00:00:00'),
(5, 'El verano', 'Veraneando', '2017-11-05', 1, 3, '/PARALUJAN/dec/paisaje4.jpg', '2017-11-08 00:00:00'),
(6, 'Mi novia', 'Guapisima', '2017-11-02', 2, 3, '/PARALUJAN/dec/paisaje5.jpg', '2017-11-05 00:00:00'),
(7, 'Nueva', 'Demo', '2017-11-23', 1, 3, '/PARALUJAN/dec/paisaje4.jpg', '2017-11-23 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `IdPais` int(11) NOT NULL,
  `NomPais` varchar(11) COLLATE utf16_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`IdPais`, `NomPais`) VALUES
(1, 'España'),
(2, 'Francia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `IdSolicitud` int(11) NOT NULL,
  `Album` int(11) NOT NULL,
  `Nombre` varchar(200) COLLATE utf16_spanish_ci NOT NULL,
  `Titulo` varchar(200) COLLATE utf16_spanish_ci NOT NULL,
  `Descripcion` varchar(4000) COLLATE utf16_spanish_ci NOT NULL,
  `Email` varchar(200) COLLATE utf16_spanish_ci NOT NULL,
  `Direccion` varchar(11) COLLATE utf16_spanish_ci NOT NULL,
  `Color` varchar(11) COLLATE utf16_spanish_ci NOT NULL,
  `Copias` int(11) NOT NULL,
  `Resolucion` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `IColor` tinyint(1) NOT NULL,
  `Fregistro` datetime NOT NULL,
  `Coste` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `NomUsuario` varchar(15) COLLATE utf16_spanish_ci NOT NULL,
  `Clave` varchar(15) COLLATE utf16_spanish_ci NOT NULL,
  `Email` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `Sexo` smallint(6) NOT NULL,
  `FNacimiento` date NOT NULL,
  `Ciudad` varchar(20) COLLATE utf16_spanish_ci NOT NULL,
  `Pais` int(11) NOT NULL,
  `Foto` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `FRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `NomUsuario`, `Clave`, `Email`, `Sexo`, `FNacimiento`, `Ciudad`, `Pais`, `Foto`, `FRegistro`) VALUES
(1, 'BlancaVazquez', 'picsy', 'blanca_v_p@hotmail.com', 1, '2017-11-02', 'Valladolor', 1, 'mifoto.jpg', '2017-11-15 05:39:27'),
(2, 'yol', 'jeje', 'yolanda.cswag@gmail.com', 0, '2017-11-09', 'ALICANTECAPITAL', 1, '', '2017-11-20 03:15:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`idAlbum`),
  ADD KEY `album_fk_1` (`Pais`),
  ADD KEY `album_fk_2` (`Usuario`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`IdFoto`),
  ADD KEY `fotos_fk_1` (`Pais`),
  ADD KEY `fotos_fk_2` (`Album`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`IdPais`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`IdSolicitud`),
  ADD KEY `solicitud_fk_1` (`Album`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `NomUsuario` (`NomUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `idAlbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `IdFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `IdPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `IdSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD CONSTRAINT `album_fk_1` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`),
  ADD CONSTRAINT `album_fk_2` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`IdUsuario`);

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_fk_1` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`),
  ADD CONSTRAINT `fotos_fk_2` FOREIGN KEY (`Album`) REFERENCES `albumes` (`idAlbum`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitud_fk_1` FOREIGN KEY (`Album`) REFERENCES `albumes` (`idAlbum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
