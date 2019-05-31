-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 30, 2019 at 05:57 PM
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
  UNIQUE KEY `id_restaurante` (`id_restaurante`,`nombre`)
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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
