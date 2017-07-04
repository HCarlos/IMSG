-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-06-2017 a las 14:15:46
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

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`iduser`, `username`, `password`, `apellidos`, `nombres`, `registro`, `especialidad`, `nombre`, `domicilio`, `colonia`, `municipio`, `estado`, `otrostel`, `teloficina`, `telpersonal`, `telfax`, `correoelectronico`, `idmunicipio`, `idestado`, `cedulaprofesional`, `registro_colegio`, `ip`, `host`, `creado_por`, `creado_el`, `modi_por`, `modi_el`, `foto`, `p1`, `p2`, `p3`, `p4`, `p5`, `p6`, `p7`, `p8`, `p9`, `p10`, `p11`, `p12`, `p13`, `p14`, `p15`, `p16`, `p17`, `p18`, `p19`, `p20`, `p21`, `p22`, `p23`, `p24`, `p25`, `p26`, `p27`, `p28`, `p29`, `p30`, `p31`, `p32`, `p33`, `p34`, `p35`, `p36`, `p37`, `p38`, `p39`, `p40`, `p41`, `p42`, `p43`, `p44`, `p45`, `p46`, `p47`, `p48`, `p49`, `p50`, `idper`, `idemp`, `idusernivelacceso`, `status_usuario`, `token`, `token_validated`, `token_source`, `registrosporpagina`, `param1`) VALUES
(1, 'devch', '68053af2923e00204c3ca7c6a3150cf7', 'Hidalgo', 'Carlos', 'mmmn', 'nnnn', '', '', '', '', '', '', '351-02-60 ext 504', 'no tengo', '', 'DevCH@arji.edu.mx', 0, 0, 'cedula', 'cvt', '189.133.198.203', 'dsl-189-133-198-203-dyn.prod-infinitum.com.mx', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '1.png', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1000, 1, 'c6918f2d97c2fac678b8c682e64b1e32', 1, 'c6918f2d97c2fac678b8c682e64b1e32', 7, ''),
(2, 'claude', '35d9ff1b201cbca867f70ba3c82bfdca', 'García Ovando', 'Claudia Margarita', '', '', '', '', '', '', '', '', '9933139471', '9931569660', '', 'claudefuchok@hotmail.com', 0, 0, '', '', '187.217.204.102', 'customer-187-217-204-102.uninet-ide.com.mx', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2.jpg', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 999, 1, '11dcf2e49a58211e902f5bd70909c6ff', 1, '11dcf2e49a58211e902f5bd70909c6ff', 10, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
