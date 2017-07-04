-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-06-2017 a las 14:10:44
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
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `iduser` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `registro` varchar(15) NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `domicilio` varchar(150) NOT NULL,
  `colonia` varchar(100) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `otrostel` varchar(100) NOT NULL,
  `teloficina` varchar(50) NOT NULL,
  `telpersonal` varchar(50) NOT NULL,
  `telfax` varchar(50) NOT NULL,
  `correoelectronico` varchar(100) NOT NULL,
  `idmunicipio` int(5) NOT NULL,
  `idestado` int(5) NOT NULL,
  `cedulaprofesional` varchar(20) NOT NULL,
  `registro_colegio` varchar(20) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `host` varchar(100) NOT NULL,
  `creado_por` int(5) NOT NULL,
  `creado_el` datetime NOT NULL,
  `modi_por` int(5) NOT NULL,
  `modi_el` datetime NOT NULL,
  `foto` varchar(100) NOT NULL,
  `p1` int(2) NOT NULL DEFAULT '0',
  `p2` int(2) NOT NULL DEFAULT '0',
  `p3` int(2) NOT NULL DEFAULT '0',
  `p4` int(2) NOT NULL DEFAULT '0',
  `p5` int(2) NOT NULL DEFAULT '0',
  `p6` int(2) NOT NULL DEFAULT '0',
  `p7` int(2) NOT NULL DEFAULT '0',
  `p8` int(2) NOT NULL DEFAULT '0',
  `p9` int(2) NOT NULL DEFAULT '0',
  `p10` int(2) NOT NULL DEFAULT '0',
  `p11` int(2) NOT NULL DEFAULT '0',
  `p12` int(2) NOT NULL DEFAULT '0',
  `p13` int(2) NOT NULL DEFAULT '0',
  `p14` int(2) NOT NULL DEFAULT '0',
  `p15` int(2) NOT NULL DEFAULT '0',
  `p16` int(2) NOT NULL DEFAULT '0',
  `p17` int(2) NOT NULL DEFAULT '0',
  `p18` int(2) NOT NULL DEFAULT '0',
  `p19` int(2) NOT NULL DEFAULT '0',
  `p20` int(2) NOT NULL DEFAULT '0',
  `p21` int(2) NOT NULL DEFAULT '0',
  `p22` int(2) NOT NULL DEFAULT '0',
  `p23` int(2) NOT NULL DEFAULT '0',
  `p24` int(2) NOT NULL DEFAULT '0',
  `p25` int(2) NOT NULL DEFAULT '0',
  `p26` int(2) NOT NULL DEFAULT '0',
  `p27` int(2) NOT NULL DEFAULT '0',
  `p28` int(2) NOT NULL DEFAULT '0',
  `p29` int(2) NOT NULL DEFAULT '0',
  `p30` int(2) NOT NULL DEFAULT '0',
  `p31` int(2) NOT NULL DEFAULT '0',
  `p32` int(2) NOT NULL DEFAULT '0',
  `p33` int(2) NOT NULL DEFAULT '0',
  `p34` int(2) NOT NULL DEFAULT '0',
  `p35` int(2) NOT NULL DEFAULT '0',
  `p36` int(2) NOT NULL DEFAULT '0',
  `p37` int(2) NOT NULL DEFAULT '0',
  `p38` int(2) NOT NULL DEFAULT '0',
  `p39` int(2) NOT NULL DEFAULT '0',
  `p40` int(2) NOT NULL DEFAULT '0',
  `p41` int(2) NOT NULL DEFAULT '0',
  `p42` int(2) NOT NULL DEFAULT '0',
  `p43` int(2) NOT NULL DEFAULT '0',
  `p44` int(2) NOT NULL DEFAULT '0',
  `p45` int(2) NOT NULL DEFAULT '0',
  `p46` int(2) NOT NULL DEFAULT '0',
  `p47` int(2) NOT NULL DEFAULT '0',
  `p48` int(2) NOT NULL DEFAULT '0',
  `p49` int(2) NOT NULL DEFAULT '0',
  `p50` int(2) NOT NULL DEFAULT '0',
  `idper` int(10) NOT NULL DEFAULT '0' COMMENT 'Id del Catalogo de Personal con quien esta relacionado',
  `idemp` int(10) NOT NULL DEFAULT '0',
  `idusernivelacceso` int(10) NOT NULL DEFAULT '1',
  `status_usuario` int(2) NOT NULL DEFAULT '0' COMMENT '0=Inactivo, 1=Activo',
  `token` varchar(60) DEFAULT NULL,
  `token_validated` int(2) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Si',
  `token_source` varchar(60) NOT NULL,
  `registrosporpagina` int(3) NOT NULL DEFAULT '10',
  `param1` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `BEFORE_INSERTE_usuarios` BEFORE INSERT ON `usuarios` FOR EACH ROW Begin

	
	
    	set new.token_source = md5( concat( new.username,NOW() ) );
    
    

End
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BEFORE_UPDATE_usuarios` BEFORE UPDATE ON `usuarios` FOR EACH ROW Begin

	if new.token_source = "" then
	
    	set new.token_source = md5( concat( new.username,now() ) );
    
    end if;

End
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `up` (`username`,`password`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `useremp` (`username`,`idemp`),
  ADD KEY `idemp` (`idemp`),
  ADD KEY `idusernivelacceso` (`idusernivelacceso`),
  ADD KEY `idper` (`idper`),
  ADD KEY `status_usuario` (`status_usuario`),
  ADD KEY `userpassstatus` (`username`,`password`,`status_usuario`),
  ADD KEY `emostatu` (`idemp`,`status_usuario`),
  ADD KEY `upes` (`username`,`password`,`idemp`,`status_usuario`),
  ADD KEY `valid_token` (`token_validated`),
  ADD KEY `token` (`token`);
ALTER TABLE `usuarios` ADD FULLTEXT KEY `apps` (`apellidos`);
ALTER TABLE `usuarios` ADD FULLTEXT KEY `nombresFull` (`nombres`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `iduser` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
