SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `imagen` (
  `id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_emicion` date NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `personas` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `evalacion` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `restaurante_categoria` (
  `id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `id_categoria` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `restaurante_imagen` (
  `id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `img` varchar(250) NOT NULL,
  `id_restaurante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `nombre` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `imagen` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
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
  `cantidadMesas` int DEFAULT NULL,
  `avatar` varchar(250) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `zona` (
  `id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `reservas_servicio` (
  `id` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_restaurante` (`id_restaurante`),
  ADD KEY `id_usuario` (`id_usuario`);

ALTER TABLE `restaurante_categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_restaurante` (`id_restaurante`,`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

ALTER TABLE `restaurante_imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_restaurante` (`id_restaurante`);

ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `zona`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reservas_servicio`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `restaurante_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `restaurante_imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `zona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `reservas_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

ALTER TABLE `restaurante_categoria`
  ADD CONSTRAINT `restaurante_categoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `restaurante_categoria_ibfk_2` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`);

ALTER TABLE `restaurante_imagen`
  ADD CONSTRAINT `restaurante_imagen_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`);

ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`);

ALTER TABLE `reservas_servicio`
  ADD CONSTRAINT `reservas_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`);
  ADD CONSTRAINT `reservas_servicio_ibfk_2` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
