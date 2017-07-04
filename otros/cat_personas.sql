-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-06-2017 a las 14:39:16
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
-- Estructura de tabla para la tabla `cat_personas`
--

CREATE TABLE `cat_personas` (
  `idpersona` int(10) NOT NULL,
  `idusuario` int(10) DEFAULT NULL,
  `curp` varchar(18) NOT NULL,
  `ap_paterno` varchar(50) NOT NULL,
  `ap_materno` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tel1` varchar(100) NOT NULL,
  `tel2` varchar(100) NOT NULL,
  `cel1` varchar(100) NOT NULL,
  `cel2` varchar(100) NOT NULL,
  `email1` varchar(250) NOT NULL,
  `email2` varchar(250) NOT NULL,
  `lugar_nacimiento` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` int(2) NOT NULL DEFAULT '0' COMMENT '0=Mujer, 1=Hombre',
  `profesion` varchar(150) NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `domicilio_generico` text NOT NULL,
  `calle` varchar(100) NOT NULL,
  `num_ext` varchar(20) NOT NULL,
  `num_int` varchar(20) NOT NULL,
  `colonia` varchar(100) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `pais` varchar(20) NOT NULL,
  `cp` varchar(6) NOT NULL,
  `lugar_trabajo` varchar(250) NOT NULL,
  `iddomicilio` int(10) NOT NULL DEFAULT '0',
  `idpermig` int(10) NOT NULL,
  `status_persona` int(2) NOT NULL DEFAULT '1',
  `idemp` int(5) NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL,
  `host` varchar(100) NOT NULL,
  `creado_por` int(5) NOT NULL,
  `creado_el` datetime NOT NULL,
  `modi_por` int(5) NOT NULL,
  `modi_el` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Catálogo de Personas';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_personas`
--
ALTER TABLE `cat_personas`
  ADD PRIMARY KEY (`idpersona`),
  ADD UNIQUE KEY `appapmnomemp` (`ap_paterno`,`ap_materno`,`nombre`,`idemp`),
  ADD UNIQUE KEY `useremp` (`idusuario`,`idemp`),
  ADD KEY `idemp` (`idemp`),
  ADD KEY `status_persona` (`status_persona`),
  ADD KEY `geemp` (`genero`,`idemp`),
  ADD KEY `idpermig` (`idpermig`);
ALTER TABLE `cat_personas` ADD FULLTEXT KEY `domicilio_generico` (`domicilio_generico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_personas`
--
ALTER TABLE `cat_personas`
  MODIFY `idpersona` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
