-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-06-2017 a las 09:49:53
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
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `idconfig` int(11) NOT NULL,
  `llave` varchar(100) NOT NULL,
  `valor` varchar(100) NOT NULL,
  `observaciones` varchar(150) NOT NULL,
  `idemp` int(5) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `host` varchar(100) NOT NULL,
  `creado_por` int(5) NOT NULL DEFAULT '0',
  `creado_el` datetime NOT NULL,
  `modi_por` int(5) NOT NULL DEFAULT '0',
  `modi_el` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Configuraciones';

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`idconfig`, `llave`, `valor`, `observaciones`, `idemp`, `ip`, `host`, `creado_por`, `creado_el`, `modi_por`, `modi_el`) VALUES
(1, 'iva', '0.16', '', 1, '', '0', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'edk', '3', 'Eval Pred Kinder', 1, '', '0', 0, '0000-00-00 00:00:00', 4741, '2017-04-10 10:55:04'),
(3, 'emk', '3', '', 1, '', '0', 0, '0000-00-00 00:00:00', 4741, '2017-04-10 10:55:04'),
(4, 'edp', '5', 'Eval Pred Primaria', 1, '', '0', 0, '0000-00-00 00:00:00', 1292, '2017-06-27 13:10:47'),
(5, 'emp', '1', '', 1, '', '0', 0, '0000-00-00 00:00:00', 1292, '2017-06-27 13:10:47'),
(6, 'eds', '5', 'Eval Pred Secundaria', 1, '', '0', 0, '0000-00-00 00:00:00', 1291, '2017-06-26 08:19:34'),
(7, 'ems', '4', '', 1, '', '0', 0, '0000-00-00 00:00:00', 1291, '2017-06-26 08:19:34'),
(8, 'edr', '4', 'Eval Pred Preparatoria', 1, '', '0', 0, '0000-00-00 00:00:00', 1290, '2017-06-24 08:18:02'),
(9, 'emr', '3', '', 1, '', '0', 0, '0000-00-00 00:00:00', 1290, '2017-06-24 08:18:02'),
(10, 'edn', '1', 'Eval Pred 1ro Ingles', 1, '', '0', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 'emn', '1', '', 1, '', '0', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 'logo-emp-rep', 'logo-arji.gif', 'Se utiliza para diversos formatos. El nombre \'logo-emp-rep\' no se debe cambiar', 1, '', '0', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 'logo-ib-emp', 'ib_school.jpeg', 'Se utiliza en diversos reportes para Bachillerato Internacional. El Nombre \'logo-ib-emp\' no se debe cambiar.', 1, '', '0', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 'ciclo_largo_predeterminado', '1', 'Ciclo en Turno Predeterminado', 1, '', '0', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 'ciclo_largo_modificable', '1', 'Ciclo Largo en Turno Modificable', 1, '', '0', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 'ciclo_corto_predeterminado', '1', 'Ciclo Corto al cual aún se puede mofificar. Debe tener permiso el usuario.', 1, '', '0', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(17, 'ciclo_corto_modificable', '1', 'Ciclo corto modificable. Previa autorización', 1, '', '0', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(18, 'prepare_bol_1', 'prepare-calif-kinder-interna-arji/', 'Prepara la Boleta de Kinder', 1, '', '0', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(19, 'prepare_bol_2', 'prepara-calif-primaria-interna-arji/', 'Prepara la Boleta de Primaria', 1, '', '0', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 'prepare_bol_3', 'prepara-calif-primaria-interna-arji/', 'Prepara la boleta de Primaria', 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(21, 'prepare_bol_4', 'prepara-calif-secundaria-interna-arji/', 'Prepara la boleta de Secundaria', 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(22, 'prepare_bol_5', 'prepara-calif-prepa-interna-arji/', 'Prepara Boleta Preparatoria', 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(23, 'logo-firma-reinscripcion', 'firma_tarjeta_reinscripcion_arji_2.gif', 'Se utiliza para colocar en los formatos de reinscripción.', 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(24, 'proximo-ciclo', '2016 - 2017', 'Se coloca el Próximo ciclo ya que se ocupa en algunos formatos', 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(25, 'logo-top-head-preinscripcion', 'franja-horizontal-solicitud-ingreso-arji-1.gif', 'Es el logo que lleva el Formato de Preinscripción', 1, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(26, 'epai', '5', 'Evaluación PAI', 1, '', '', 1, '0000-00-00 00:00:00', 1292, '2017-06-27 13:10:47'),
(27, 'iva', '0.16', '', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(28, 'edk', '2', 'Eval Pred Kinder', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(29, 'emk', '2', '', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(30, 'edp', '4', 'Eval Pred Primaria', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(31, 'emp', '3', '', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(32, 'eds', '3', 'Eval Pred Secundaria', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(33, 'ems', '2', '', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(34, 'edr', '1', 'Eval Pred Preparatoria', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(35, 'emr', '1', '', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(36, 'edn', '1', 'Eval Pred 1ro Ingles', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(37, 'emn', '1', '', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(38, 'logo-emp-rep', 'logo-arji.gif', 'Se utiliza para diversos formatos. El nombre \'logo-emp-rep\' no se debe cambiar', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(39, 'logo-ib-emp', 'ib_school.jpeg', 'Se utiliza en diversos reportes para Bachillerato Internacional. El Nombre \'logo-ib-emp\' no se debe cambiar.', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(40, 'ciclo_largo_predeterminado', '1', 'Ciclo en Turno Predeterminado', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(41, 'ciclo_largo_modificable', '1', 'Ciclo Largo en Turno Modificable', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(42, 'ciclo_corto_predeterminado', '1', 'Ciclo Corto al cual aún se puede mofificar. Debe tener permiso el usuario.', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(43, 'ciclo_corto_modificable', '1', 'Ciclo corto modificable. Previa autorización', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(44, 'prepare_bol_1', 'prepare-calif-kinder-interna-arji/', 'Prepara la Boleta de Kinder', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(45, 'prepare_bol_2', 'prepara-calif-primaria-interna-arji/', 'Prepara la Boleta de Primaria', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(46, 'prepare_bol_3', 'prepara-calif-primaria-interna-arji/', 'Prepara la boleta de Primaria', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(47, 'prepare_bol_4', 'prepara-calif-secundaria-interna-arji/', 'Prepara la boleta de Secundaria', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(48, 'prepare_bol_5', 'prepara-calif-prepa-interna-arji/', 'Prepara Boleta Preparatoria', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(49, 'logo-firma-reinscripcion', 'firma_tarjeta_reinscripcion_arji_2.gif', 'Se utiliza para colocar en los formatos de reinscripción.', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(50, 'proximo-ciclo', '2016 - 2017', 'Se coloca el Próximo ciclo ya que se ocupa en algunos formatos', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(51, 'logo-top-head-preinscripcion', 'franja-horizontal-solicitud-ingreso-arji-1.gif', 'Es el logo que lleva el Formato de Preinscripción', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(52, 'epai', '1', 'Evaluación PAI', 2, '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

--
-- Disparadores `config`
--
DELIMITER $$
CREATE TRIGGER `BEFORE_UPDATE_config` BEFORE UPDATE ON `config` FOR EACH ROW Begin

INSERT INTO logs(iduser,date_mov,typemov,table_mov,idkey,fieldkey)
VALUES(new.modi_por,NOW(),'Update','Config',new.valor,new.llave);


End
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`idconfig`),
  ADD UNIQUE KEY `keyempcnf` (`llave`,`idemp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `idconfig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
