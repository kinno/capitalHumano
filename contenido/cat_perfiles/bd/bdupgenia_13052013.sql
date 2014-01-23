-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-05-2013 a las 15:53:57
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bdupgenia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblreclut`
--

CREATE TABLE IF NOT EXISTS `tblreclut` (
  `idReclut` int(11) NOT NULL AUTO_INCREMENT,
  `nomReclut` varchar(30) NOT NULL,
  `appReclut` varchar(30) NOT NULL,
  `apmReclut` varchar(30) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecalta` date NOT NULL,
  `fecbaja` date NOT NULL,
  PRIMARY KEY (`idReclut`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `tblreclut`
--

INSERT INTO `tblreclut` (`idReclut`, `nomReclut`, `appReclut`, `apmReclut`, `idusuario`, `fecalta`, `fecbaja`) VALUES
(3, 'ARTURO ', 'AVILES', 'MARTINEZ', 1, '1988-02-15', '1988-02-15'),
(4, 'Carlos', 'Martinez', 'Rodriguez Fer', 1, '1988-02-15', '1988-02-15'),
(5, 'mauel', 'martinez', 'fernandez', 1, '1988-02-15', '1988-02-15'),
(6, 'Adrian ', 'Martinez', '$#', 1, '1988-02-15', '1988-02-15'),
(7, 'FER', 'FER', 'FER', 1, '1988-02-15', '1988-02-15'),
(8, 'GG', 'GG', 'GG', 1, '1988-02-15', '1988-02-15'),
(9, 'WW', 'WW', 'Romero de Shamp', 1, '1988-02-15', '1988-02-15'),
(10, 'qqq', 'qqq', 'qqq', 1, '1988-02-15', '1988-02-15'),
(11, 'Fernado', 'Fernandez', 'Fermin', 1, '1988-02-15', '1988-02-15'),
(12, 'Carmen', 'Gonzaless', 'Fernandez', 1, '1988-02-15', '1988-02-15'),
(13, 'Adolfo', 'Guzman', 'Diaz', 1, '1988-02-15', '2013-05-13');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
