-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-06-2017 a las 14:39:55
-- Versión del servidor: 5.6.35
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnoint_dbPlatSource`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_registros_fiscales`
--

CREATE TABLE `cat_registros_fiscales` (
  `idregfis` int(10) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `curp` varchar(18) NOT NULL,
  `razon_social` varchar(200) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `num_ext` varchar(20) NOT NULL,
  `num_int` varchar(20) NOT NULL,
  `colonia` varchar(150) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `pais` varchar(10) NOT NULL DEFAULT '"MÉXICO"',
  `cp` varchar(10) NOT NULL,
  `email1` varchar(100) NOT NULL,
  `email2` varchar(100) NOT NULL,
  `is_email` int(2) NOT NULL DEFAULT '1',
  `is_extranjero` int(2) NOT NULL DEFAULT '0',
  `referencia` varchar(100) NOT NULL,
  `idfammig` int(10) NOT NULL DEFAULT '0',
  `valid_for_admin` int(2) NOT NULL DEFAULT '1' COMMENT '0=No, 1=Si',
  `status_regfis` int(2) NOT NULL DEFAULT '1' COMMENT '0=Inactivo, 1=Activo',
  `idemp` int(5) NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL,
  `host` varchar(100) NOT NULL,
  `creado_por` int(5) NOT NULL,
  `creado_el` datetime NOT NULL,
  `modi_por` int(5) NOT NULL,
  `modi_el` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Guarda los registros fiscales';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_registros_fiscales`
--
ALTER TABLE `cat_registros_fiscales`
  ADD PRIMARY KEY (`idregfis`),
  ADD UNIQUE KEY `rfcemp` (`rfc`,`idemp`),
  ADD KEY `rfc` (`rfc`),
  ADD KEY `curp` (`curp`),
  ADD KEY `is_email` (`is_email`),
  ADD KEY `is_extrajero` (`is_extranjero`),
  ADD KEY `status_regfis` (`status_regfis`),
  ADD KEY `idemp` (`idemp`),
  ADD KEY `statusemp` (`idemp`,`status_regfis`),
  ADD KEY `curpemp` (`curp`,`idemp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_registros_fiscales`
--
ALTER TABLE `cat_registros_fiscales`
  MODIFY `idregfis` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
