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
UTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `is_active`, `nickname`, `password`, `nombre`, `email`, `rut`, `direccion`, `zona`, `telefono`, `apellido`, `fecha_de_nacimiento`, `end_perfil`, `created_at`, `descripcionRestaurante`, `updated_at`) VALUES
(1, 0, 'lucas', '1', 'lucas', 'lucasmontelongo@outlook.com', NULL, NULL, NULL, NULL, 'montelongo', '1996-03-13', 0, '2019-05-29', NULL, '2019-05-30'),
(2, 1, 'RussiaFood', '1', 'Vladimir', 'rusia@gob.ru', '666', 'Moscow', 'Kremlin', '66585521', 'Putin', '2019-05-01', NULL, '2019-05-27', 'Un lugar de acogida para todos los compatriotas rusos que deseen disfrutar de la gastronomia de la madre patria.', NULL),
(3, 0, 'rararaa', '1', 'pepapig', 'asdad@sdc', '656', 'asda', '65asd', '515', NULL, NULL, 0, '2019-05-30', NULL, NULL),
(4, 0, 'batlalalal', '', 'asda', 'asds@asf', '656', 'asdasd', 'asds', '5656', NULL, NULL, 0, '2019-05-30', NULL, NULL),
(5, 0, 'batman', '1', 'batman', 'asd@das', NULL, NULL, NULL, NULL, 'lala', '1111-11-11', 0, '2019-05-30', NULL, NULL),
(6, 0, 'superman', '5', 'superhombre35', 'superman@kripton.kr', NULL, NULL, NULL, NULL, 'deacero23', '1111-11-11', 0, '2019-05-30', NULL, '2019-05-30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
