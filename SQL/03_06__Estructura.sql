CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_emicion` date NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `personas` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `evalacion` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `restaurante_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `id_categoria` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `restaurante_imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `img` varchar(250) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `nombre` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `usuario` (
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
  `descripcionRestaurante` TEXT DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `zona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

ALTER TABLE `restaurante_categoria`
  ADD CONSTRAINT `restaurante_categoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `restaurante_categoria_ibfk_2` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`);

ALTER TABLE `restaurante_imagen`
  ADD CONSTRAINT `restaurante_imagen_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `usuario` (`id`);
COMMIT;
