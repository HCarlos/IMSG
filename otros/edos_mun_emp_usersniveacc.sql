-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-06-2017 a las 14:23:25
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
-- Estructura de tabla para la tabla `cat_estados`
--

CREATE TABLE `cat_estados` (
  `idestado` int(10) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `status_estado` int(2) NOT NULL DEFAULT '1' COMMENT '0=Inactivo, 1=Activo',
  `idemp` int(10) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `host` varchar(100) NOT NULL,
  `creado_por` int(10) NOT NULL,
  `creado_el` datetime NOT NULL,
  `modi_por` int(10) NOT NULL,
  `modi_el` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Catálogo de Estados';

--
-- Volcado de datos para la tabla `cat_estados`
--

INSERT INTO `cat_estados` (`idestado`, `clave`, `estado`, `status_estado`, `idemp`, `ip`, `host`, `creado_por`, `creado_el`, `modi_por`, `modi_el`) VALUES
(1, '27', 'TABASCO', 1, 1, '177.233.67.90', 'host-177-233-67-90.static.metrored.net.mx', 0, '0000-00-00 00:00:00', 3, '2014-05-23 10:30:15'),
(3, 'CHP', 'CHIAPAS', 1, 1, '189.133.203.0', '189.133.203.0', 1, '2014-08-21 15:29:12', 1, '2014-08-21 15:29:21'),
(4, 'DF', 'MEXICO D.F.', 1, 1, '189.133.206.66', 'dsl-189-133-206-66-dyn.prod-infinitum.com.mx', 2, '2015-02-19 08:03:57', 1, '2015-02-19 08:06:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_municipios`
--

CREATE TABLE `cat_municipios` (
  `idmunicipio` int(10) NOT NULL,
  `idestado` varchar(10) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `status_municipio` int(2) NOT NULL DEFAULT '1' COMMENT '0=Inactivo, 1=Activo',
  `idemp` int(5) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `host` varchar(100) NOT NULL,
  `creado_por` int(10) NOT NULL,
  `creado_el` datetime NOT NULL,
  `modi_por` int(10) NOT NULL,
  `modi_el` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Catálogo de Municipios';

--
-- Volcado de datos para la tabla `cat_municipios`
--

INSERT INTO `cat_municipios` (`idmunicipio`, `idestado`, `clave`, `municipio`, `status_municipio`, `idemp`, `ip`, `host`, `creado_por`, `creado_el`, `modi_por`, `modi_el`) VALUES
(1, '1', '001', 'Balancán', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, '1', '002', 'Cárdenas', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, '1', '003', 'Centla', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, '1', '04', 'CENTRO', 1, 1, '189.133.155.62', 'dsl-189-133-155-62-dyn.prod-infinitum.com.mx', 0, '0000-00-00 00:00:00', 3, '2014-07-17 12:54:16'),
(5, '1', '005', 'Comalcalco', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, '1', '006', 'Cunduacán', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, '1', '007', 'Emiliano Zapata', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, '1', '008', 'Huimanguillo', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, '1', '009', 'Jalapa', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, '1', '010', 'Jalpa de Méndez', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, '1', '011', 'Jonuta', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, '1', '012', 'Macuspana', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, '1', '013', 'Nacajuca', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, '1', '014', 'Paraiso', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, '1', '015', 'Tacotalp', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, '1', '016', 'Teapa', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(17, '1', '017', 'Tenosique', 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(19, '1', '01', 'BALANCAN', 0, 1, '189.133.196.4', 'dsl-189-133-196-4-dyn.prod-infinitum.com.mx', 3, '2014-05-07 14:03:47', 1, '2014-05-09 18:36:38'),
(20, '1', '02', 'CARDENAS', 0, 1, '189.133.196.4', 'dsl-189-133-196-4-dyn.prod-infinitum.com.mx', 3, '2014-05-07 14:04:20', 1, '2014-05-09 18:36:49'),
(21, '1', '01', 'BALANCAN', 1, 1, '189.133.155.62', 'dsl-189-133-155-62-dyn.prod-infinitum.com.mx', 3, '2014-07-16 17:48:44', 3, '2014-07-17 12:53:00'),
(22, '1', '02', 'CARDENAS', 1, 1, '189.133.155.62', 'dsl-189-133-155-62-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:53:31', 0, '0000-00-00 00:00:00'),
(23, '1', '03', 'CENTLA', 1, 1, '189.133.183.246', 'dsl-189-133-183-246-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:53:52', 0, '0000-00-00 00:00:00'),
(24, '1', '05', 'COMALCALCO', 1, 1, '189.133.155.62', 'dsl-189-133-155-62-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:54:30', 0, '0000-00-00 00:00:00'),
(25, '1', '06', 'CUNDUACAN', 1, 1, '189.133.183.246', 'dsl-189-133-183-246-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:54:58', 0, '0000-00-00 00:00:00'),
(26, '1', '07', 'EMILIANO ZAPATA', 1, 1, '189.133.183.246', 'dsl-189-133-183-246-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:55:14', 0, '0000-00-00 00:00:00'),
(27, '1', '08', 'HUIMANGUILLO', 1, 1, '189.133.183.246', 'dsl-189-133-183-246-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:55:28', 0, '0000-00-00 00:00:00'),
(28, '1', '09', 'JALAPA', 1, 1, '189.133.183.246', 'dsl-189-133-183-246-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:56:00', 0, '0000-00-00 00:00:00'),
(29, '1', '10', 'JALPA DE MENDEZ', 1, 1, '189.133.183.246', 'dsl-189-133-183-246-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:56:11', 0, '0000-00-00 00:00:00'),
(30, '1', '11', 'JONUTA', 1, 1, '189.133.183.246', 'dsl-189-133-183-246-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:56:21', 0, '0000-00-00 00:00:00'),
(31, '1', '12', 'MACUSPANA', 1, 1, '189.133.125.117', 'dsl-189-133-125-117-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:56:32', 63, '2014-08-05 15:25:57'),
(32, '1', '11', 'NACAJUCA', 1, 1, '189.133.183.246', 'dsl-189-133-183-246-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:56:49', 0, '0000-00-00 00:00:00'),
(33, '1', '12', 'PARAISO', 1, 1, '189.133.155.62', 'dsl-189-133-155-62-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:57:00', 0, '0000-00-00 00:00:00'),
(34, '1', '15', 'TACOTALPA', 1, 1, '189.133.155.62', 'dsl-189-133-155-62-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:57:38', 0, '0000-00-00 00:00:00'),
(35, '1', '16', 'TEAPA', 1, 1, '189.133.155.62', 'dsl-189-133-155-62-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:57:49', 0, '0000-00-00 00:00:00'),
(36, '1', '17', 'TENOSIQUE', 1, 1, '189.133.155.62', 'dsl-189-133-155-62-dyn.prod-infinitum.com.mx', 3, '2014-07-17 12:57:58', 0, '0000-00-00 00:00:00'),
(37, '3', 'RFM', 'REFORMA', 1, 1, '189.133.203.0', '189.133.203.0', 1, '2014-08-21 15:34:08', 1, '2014-08-21 15:34:19'),
(38, '1', '001', 'CARDENAS', 1, 1, '187.217.204.107', 'customer-187-217-204-107.uninet-ide.com.mx', 66, '2014-09-26 07:54:27', 0, '0000-00-00 00:00:00'),
(39, '4', 'DF', 'MEXICO D.F.', 1, 1, '189.133.206.66', 'dsl-189-133-206-66-dyn.prod-infinitum.com.mx', 2, '2015-02-19 08:04:34', 1, '2015-02-19 08:06:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idemp` int(10) NOT NULL,
  `rs` varchar(150) NOT NULL DEFAULT '',
  `ncomer` varchar(100) NOT NULL DEFAULT '',
  `df` varchar(200) NOT NULL DEFAULT '',
  `rfc` varchar(20) NOT NULL DEFAULT '',
  `logo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Catálogo de Empresas';

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idemp`, `rs`, `ncomer`, `df`, `rfc`, `logo`) VALUES
(1, 'Colegio Arjí, A.C.', 'Colegio Arjí, A.C.', 'Prueba', 'Prueba', ''),
(2, 'Test Emp', 'Test Emp', 'Test Emp', 'TE', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `idlog` int(10) NOT NULL,
  `iduser` int(10) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `date_mov` datetime NOT NULL,
  `typemov` varchar(20) NOT NULL,
  `table_mov` varchar(50) NOT NULL,
  `idkey` int(10) NOT NULL,
  `fieldkey` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Guarda el log de operaciones';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_conectados`
--

CREATE TABLE `usuarios_conectados` (
  `iduserconnect` int(10) NOT NULL,
  `iduser` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `ultima_conexion` datetime NOT NULL,
  `isconectado` int(2) NOT NULL DEFAULT '0' COMMENT '0=No; 1=SI',
  `idemp` int(5) NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL,
  `host` varchar(100) NOT NULL,
  `creado_por` int(10) NOT NULL DEFAULT '0',
  `creado_el` datetime NOT NULL,
  `modi_por` int(10) NOT NULL DEFAULT '0',
  `modi_el` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Guarda los usuarios conectados';

--
-- Volcado de datos para la tabla `usuarios_conectados`
--

--
-- Disparadores `usuarios_conectados`
--
DELIMITER $$
CREATE TRIGGER `AFTER_INSERT_usuarios_conectados` AFTER INSERT ON `usuarios_conectados` FOR EACH ROW Begin

	INSERT INTO logs(iduser,date_mov,typemov,table_mov,idkey,fieldkey)
	VALUES(new.iduser,NOW(),'Init','Usuarios Conectados',new.iduser,'iduser') ; 

End
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AFTER_UPDATE_usuarios_conectados` AFTER UPDATE ON `usuarios_conectados` FOR EACH ROW Begin

	if new.isconectado = 1 then
		set @conn = "Conectado";
	else
		set @conn = "Desconectado";
	end if;

	INSERT INTO logs(iduser,date_mov,typemov,table_mov,idkey,fieldkey)
	VALUES(new.iduser,NOW(),@conn,'Usuarios Conectados',new.iduser,'iduser') ; 


End
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_niveldeacceso`
--

CREATE TABLE `usuarios_niveldeacceso` (
  `idusernivelacceso` int(10) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `nivel_de_acceso` varchar(50) NOT NULL,
  `movible` int(2) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Si',
  `visible_in_com` int(2) NOT NULL DEFAULT '0',
  `tabla_filtrado` varchar(50) NOT NULL,
  `idemp` int(10) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `host` varchar(100) NOT NULL,
  `creado_por` int(10) NOT NULL,
  `creado_el` datetime NOT NULL,
  `modi_por` int(10) NOT NULL,
  `modi_el` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Catálogo de Nivel de Acceso de Usuarios';

--
-- Volcado de datos para la tabla `usuarios_niveldeacceso`
--

--
-- Indices de la tabla `cat_estados`
--
ALTER TABLE `cat_estados`
  ADD PRIMARY KEY (`idestado`),
  ADD UNIQUE KEY `cveempedo` (`clave`,`idemp`),
  ADD KEY `idemp` (`idemp`);

--
-- Indices de la tabla `cat_municipios`
--
ALTER TABLE `cat_municipios`
  ADD PRIMARY KEY (`idmunicipio`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idemp`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`idlog`);

--
-- Indices de la tabla `usuarios_conectados`
--
ALTER TABLE `usuarios_conectados`
  ADD PRIMARY KEY (`iduserconnect`),
  ADD UNIQUE KEY `useremp` (`iduser`,`idemp`),
  ADD KEY `iduseremp` (`iduser`,`idemp`,`isconectado`),
  ADD KEY `useremp_ndx` (`username`,`idemp`,`isconectado`),
  ADD KEY `unameemp` (`username`,`idemp`);

--
-- Indices de la tabla `usuarios_niveldeacceso`
--
ALTER TABLE `usuarios_niveldeacceso`
  ADD PRIMARY KEY (`idusernivelacceso`),
  ADD UNIQUE KEY `cveempnivacc` (`clave`,`idemp`),
  ADD KEY `movible` (`movible`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_estados`
--
ALTER TABLE `cat_estados`
  MODIFY `idestado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `cat_municipios`
--
ALTER TABLE `cat_municipios`
  MODIFY `idmunicipio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idemp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `idlog` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8234;
--
-- AUTO_INCREMENT de la tabla `usuarios_conectados`
--
ALTER TABLE `usuarios_conectados`
  MODIFY `iduserconnect` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2395;
--
-- AUTO_INCREMENT de la tabla `usuarios_niveldeacceso`
--
ALTER TABLE `usuarios_niveldeacceso`
  MODIFY `idusernivelacceso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
