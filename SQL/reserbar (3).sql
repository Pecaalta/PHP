-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 06, 2019 at 11:25 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reserbar`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_emicion` datetime DEFAULT NULL,
  `personas` int(11) DEFAULT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  `evalacion` int(11) DEFAULT NULL,
  `id_restaurante` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_total` datetime DEFAULT NULL,
  `tarjeta` int(11) DEFAULT NULL,
  `titularTarjeta` varchar(200) DEFAULT NULL,
  `cvc` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_restaurante` (`id_restaurante`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservas`
--
-- --------------------------------------------------------

--
-- Table structure for table `reservas_servicio`
--

DROP TABLE IF EXISTS `reservas_servicio`;
CREATE TABLE IF NOT EXISTS `reservas_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `reservas_servicio_ibfk_1` (`id_servicio`),
  KEY `reservas_servicio_ibfk_2` (`id_reserva`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservas_servicio`
--

INSERT INTO `reservas_servicio` (`id`, `id_servicio`, `id_reserva`, `cantidad`, `is_active`) VALUES
(186, 13, 220, 1, 1),
(187, 8, 220, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restaurante_categoria`
--

DROP TABLE IF EXISTS `restaurante_categoria`;
CREATE TABLE IF NOT EXISTS `restaurante_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `id_categoria` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_restaurante` (`id_restaurante`,`id_categoria`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restaurante_imagen`
--

DROP TABLE IF EXISTS `restaurante_imagen`;
CREATE TABLE IF NOT EXISTS `restaurante_imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `img` varchar(250) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_restaurante` (`id_restaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE IF NOT EXISTS `servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `nombre` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `servicio_ibfk_1` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicio`
--

INSERT INTO `servicio` (`id`, `is_active`, `nombre`, `descripcion`, `precio`, `id_restaurante`, `imagen`) VALUES
(7, 1, 'asdasd', 'afvcxvv', '545', 2, NULL),
(8, 1, 'cocacola', 'adasd', '12', 2, NULL),
(9, 1, 'dfd', 'fff', '234', 2, NULL),
(10, 1, 'pepito', 'lala', '56', 2, NULL),
(11, 1, 'pepitogdfgdfg', 'lala', '56', 2, NULL),
(12, 1, 'cvcvcvc', 'fsg', '334', 2, NULL),
(13, 1, 'lololo', 'lala', '12', 2, NULL),
(14, 1, 'lololofdfdf', 'lala', '12', 2, NULL),
(15, 1, 'ccvcvvc', 'fdfs', '345', 2, NULL),
(17, 1, 'ccvcvvcooo', 'fdfs', '345', 2, NULL),
(18, 1, 'ccvcvvcoooccvc', 'fdfs', '345', 2, NULL),
(19, 1, 'pizzaconlala', '56', '22', 2, NULL),
(20, 1, 'Coca Cola', 'Rica', '23', 2, NULL),
(21, 1, '*&@*(@', '', '0', 2, NULL),
(22, 1, 'ccvssda', '', '0', 2, NULL),
(23, 1, 'pepapig', 'lala', '56', 2, NULL),
(24, 1, 'carajo', 'xvxv', '0', 2, NULL),
(25, 1, 'asd', 'dd', '23', 2, NULL),
(26, 1, 'sd', 'xc', '34', 2, NULL),
(28, 1, 'asdbatman', 'sd', '234', 2, NULL),
(29, 1, '', '', '0', 2, NULL),
(30, 1, 'erer', 'ere', '23', 2, NULL),
(32, 1, 'pizza', 'rica', '100', 3, NULL),
(33, 1, 'Caraio', 'Filodaputa', '65', 3, NULL),
(34, 1, 'xc', 'sd', '2', 3, NULL),
(35, 1, 'jajajaj', 'eee', '23', 3, NULL),
(36, 1, 'as', 'www', '23', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `nickname` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `rut` varchar(10) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `zona` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `end_perfil` tinyint(1) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `descripcionRestaurante` varchar(250) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `cantidadMesas` int(11) DEFAULT NULL,
  `avatar` varchar(250) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `tiempoReserva` time NOT NULL DEFAULT '02:00:00',
  `apertura` time DEFAULT NULL,
  `clausura` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

-- --------------------------------------------------------

--
-- Table structure for table `zona`
--

DROP TABLE IF EXISTS `zona`;
CREATE TABLE IF NOT EXISTS `zona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Constraints for table `reservas_servicio`
--
ALTER TABLE `reservas_servicio`
  ADD CONSTRAINT `reservas_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `reservas_servicio_ibfk_2` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id`);

--
-- Constraints for table `restaurante_categoria`
--
ALTER TABLE `restaurante_categoria`
  ADD CONSTRAINT `restaurante_categoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `restaurante_categoria_ibfk_2` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`);

--
-- Constraints for table `restaurante_imagen`
--
ALTER TABLE `restaurante_imagen`
  ADD CONSTRAINT `restaurante_imagen_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`);

--
-- Constraints for table `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
