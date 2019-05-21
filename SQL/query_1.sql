SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE TABLE IF NOT EXISTS `mydb`.`Usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nick` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `is_active` BOOLEAN DEFAULT TRUE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`imagen` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `img` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Cliente` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `apellido` VARCHAR(45) NULL DEFAULT NULL,
  `fecha_nac` VARCHAR(45) NULL DEFAULT NULL,
  `Usuario_id` INT(11) NOT NULL,
  `imagen_id` INT(11) NOT NULL,
  `is_active` BOOLEAN DEFAULT TRUE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Cliente_Usuario1_idx` (`Usuario_id` ASC),
  INDEX `fk_Cliente_imagen1_idx` (`imagen_id` ASC),
  CONSTRAINT `fk_Cliente_Usuario1`
    FOREIGN KEY (`Usuario_id`)
    REFERENCES `mydb`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_imagen1`
    FOREIGN KEY (`imagen_id`)
    REFERENCES `mydb`.`imagen` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Reservas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `fecha_creacion` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `personas` VARCHAR(45) NOT NULL,
  `orden` VARCHAR(45) NOT NULL,
  `total` VARCHAR(45) NOT NULL,
  `calificacion` INT(11) NOT NULL,
  `Cliente_id` INT(11) NOT NULL,
  `is_active` BOOLEAN DEFAULT TRUE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Reservas_Cliente1_idx` (`Cliente_id` ASC),
  CONSTRAINT `fk_Reservas_Cliente1`
    FOREIGN KEY (`Cliente_id`)
    REFERENCES `mydb`.`Cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Restaurante` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `RUT` VARCHAR(45) NULL DEFAULT NULL,
  `direccion` VARCHAR(45) NULL DEFAULT NULL,
  `zona` VARCHAR(45) NULL DEFAULT NULL,
  `telefono` VARCHAR(45) NULL DEFAULT NULL,
  `Usuario_id` INT(11) NOT NULL,
  `is_active` BOOLEAN DEFAULT TRUE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Restaurante_Usuario_idx` (`Usuario_id` ASC),
  CONSTRAINT `fk_Restaurante_Usuario`
    FOREIGN KEY (`Usuario_id`)
    REFERENCES `mydb`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Servicio` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripción` VARCHAR(45) NOT NULL,
  `precio` VARCHAR(45) NOT NULL,
  `imagen_id` INT(11) NOT NULL,
  `is_active` BOOLEAN DEFAULT TRUE NOT NULL,
  INDEX `fk_Servicio_Restaurante1_idx` (`id` ASC),
  INDEX `fk_Servicio_imagen1_idx` (`imagen_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Servicio_Restaurante1`
    FOREIGN KEY (`id`)
    REFERENCES `mydb`.`Restaurante` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Servicio_imagen1`
    FOREIGN KEY (`imagen_id`)
    REFERENCES `mydb`.`imagen` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Categoria` (
  `nombre` INT(11) NOT NULL,
  `is_active` BOOLEAN DEFAULT TRUE NOT NULL,
  PRIMARY KEY (`nombre`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `mydb`.`imagen_restaurante` (
  `Restaurante_id` INT(11) NOT NULL,
  `imagen_id` INT(10) UNSIGNED NOT NULL,
  `is_active` BOOLEAN DEFAULT TRUE NOT NULL,
  INDEX `fk_imagen_restaurante_Restaurante1_idx` (`Restaurante_id` ASC),
  INDEX `fk_imagen_restaurante_imagen1_idx` (`imagen_id` ASC),
  CONSTRAINT `fk_imagen_restaurante_Restaurante1`
    FOREIGN KEY (`Restaurante_id`)
    REFERENCES `mydb`.`Restaurante` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_imagen_restaurante_imagen1`
    FOREIGN KEY (`imagen_id`)
    REFERENCES `mydb`.`imagen` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Categoria_restaurante` (
  `Restaurante_id` INT(11) NOT NULL,
  `Categoria_nombre` INT(11) NOT NULL,
  `is_active` BOOLEAN DEFAULT TRUE NOT NULL,
  INDEX `fk_Categoria_restaurante_Restaurante1_idx` (`Restaurante_id` ASC),
  INDEX `fk_Categoria_restaurante_Categoria1_idx` (`Categoria_nombre` ASC),
  CONSTRAINT `fk_Categoria_restaurante_Restaurante1`
    FOREIGN KEY (`Restaurante_id`)
    REFERENCES `mydb`.`Restaurante` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Categoria_restaurante_Categoria1`
    FOREIGN KEY (`Categoria_nombre`)
    REFERENCES `mydb`.`Categoria` (`nombre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
