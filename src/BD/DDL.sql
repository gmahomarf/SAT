SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `sat` ;
USE `sat`;

-- -----------------------------------------------------
-- Table `sat`.`cuencas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`cuencas` ;

CREATE  TABLE IF NOT EXISTS `sat`.`cuencas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `UniqueCuenca` (`nombre` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`alertas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`alertas` ;

CREATE  TABLE IF NOT EXISTS `sat`.`alertas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `descripcion` VARCHAR(100) NOT NULL ,
  `umbral_nivel_verde` DOUBLE UNSIGNED NULL ,
  `umbral_nivel_amarilla` DOUBLE UNSIGNED NULL ,
  `umbral_nivel_roja` DOUBLE UNSIGNED NULL ,
  `umbral_lluvia_verde` DOUBLE UNSIGNED NULL ,
  `umbral_lluvia_amarilla` DOUBLE UNSIGNED NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `indId` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`responsables`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`responsables` ;

CREATE  TABLE IF NOT EXISTS `sat`.`responsables` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `uniqNombre` (`nombre` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`estaciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`estaciones` ;

CREATE  TABLE IF NOT EXISTS `sat`.`estaciones` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_satelital` CHAR(8) NOT NULL ,
  `nombre` VARCHAR(20) NOT NULL ,
  `cuenca_id` INT UNSIGNED NULL ,
  `responsable_id` INT UNSIGNED NULL ,
  `ciudad` VARCHAR(45) NULL ,
  `municipio` VARCHAR(45) NULL ,
  `departamento` VARCHAR(45) NULL ,
  `utm_x` DOUBLE NULL ,
  `utm_y` DOUBLE NULL ,
  `utm_z` DOUBLE NULL ,
  `tipo_estacion` VARCHAR(45) NULL ,
  `alerta_id` INT UNSIGNED NULL ,
  `activa` TINYINT(1) NOT NULL DEFAULT True ,
  UNIQUE INDEX `UniqueNombreEstacion` (`nombre` ASC) ,
  INDEX `fk_Estacion_Cuenca` (`cuenca_id` ASC) ,
  INDEX `fk_Estacion_Alerta1` (`alerta_id` ASC) ,
  INDEX `fk_Estacion_Responsable1` (`responsable_id` ASC) ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `UniqueIdSatelital` (`id_satelital` ASC) ,
  INDEX `indIdSat` (`id_satelital` ASC) ,
  INDEX `indNombre` (`nombre` ASC) ,
  INDEX `indId` (`id` ASC) ,
  CONSTRAINT `fk_Estacion_Cuenca`
    FOREIGN KEY (`cuenca_id` )
    REFERENCES `sat`.`cuencas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Estacion_Alerta1`
    FOREIGN KEY (`alerta_id` )
    REFERENCES `sat`.`alertas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Estacion_Responsable1`
    FOREIGN KEY (`responsable_id` )
    REFERENCES `sat`.`responsables` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`imagenes_estaciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`imagenes_estaciones` ;

CREATE  TABLE IF NOT EXISTS `sat`.`imagenes_estaciones` (
  `estacion_id` INT UNSIGNED NOT NULL ,
  `uri` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`uri`, `estacion_id`) ,
  INDEX `fk_imagenes_estaciones_estaciones1` (`estacion_id` ASC) ,
  CONSTRAINT `fk_imagenes_estaciones_estaciones1`
    FOREIGN KEY (`estacion_id` )
    REFERENCES `sat`.`estaciones` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`llamadas_alertas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`llamadas_alertas` ;

CREATE  TABLE IF NOT EXISTS `sat`.`llamadas_alertas` (
  `alerta_id` INT UNSIGNED NOT NULL ,
  `telefono` VARCHAR(8) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`alerta_id`, `telefono`) ,
  INDEX `fk_LlamadaAlerta_Alerta1` (`alerta_id` ASC) ,
  CONSTRAINT `fk_LlamadaAlerta_Alerta1`
    FOREIGN KEY (`alerta_id` )
    REFERENCES `sat`.`alertas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`correos_alertas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`correos_alertas` ;

CREATE  TABLE IF NOT EXISTS `sat`.`correos_alertas` (
  `alerta_id` INT UNSIGNED NOT NULL ,
  `direccion` VARCHAR(60) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`alerta_id`, `direccion`) ,
  INDEX `fk_CorreoAlerta_Alerta1` (`alerta_id` ASC) ,
  CONSTRAINT `fk_CorreoAlerta_Alerta1`
    FOREIGN KEY (`alerta_id` )
    REFERENCES `sat`.`alertas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`sms_alertas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`sms_alertas` ;

CREATE  TABLE IF NOT EXISTS `sat`.`sms_alertas` (
  `alerta_id` INT UNSIGNED NOT NULL ,
  `telefono` VARCHAR(8) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`alerta_id`, `telefono`) ,
  INDEX `fk_SMSAlerta_Alerta1` (`alerta_id` ASC) ,
  CONSTRAINT `fk_SMSAlerta_Alerta1`
    FOREIGN KEY (`alerta_id` )
    REFERENCES `sat`.`alertas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`ParametrosSistema`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`ParametrosSistema` ;

CREATE  TABLE IF NOT EXISTS `sat`.`ParametrosSistema` (
  `idParametrosSistema` INT NOT NULL AUTO_INCREMENT ,
  `intervalo_revision` TIME NOT NULL ,
  `servidor_correos` VARCHAR(150) NULL ,
  `usuario_correo` VARCHAR(45) NULL ,
  `contrasena_correo` VARCHAR(45) NULL ,
  `extension_salida` VARCHAR(10) NULL ,
  PRIMARY KEY (`idParametrosSistema`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`usuarios` ;

CREATE  TABLE IF NOT EXISTS `sat`.`usuarios` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre_usuario` VARCHAR(45) NOT NULL ,
  `contra` VARCHAR(45) NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `apellido` VARCHAR(45) NOT NULL ,
  `grupo` TINYINT NOT NULL DEFAULT 2 ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `uniqUsuario` (`nombre_usuario` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`historiales_alertas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`historiales_alertas` ;

CREATE  TABLE IF NOT EXISTS `sat`.`historiales_alertas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `estacion_id` INT UNSIGNED NOT NULL ,
  `alerta_id` INT UNSIGNED NOT NULL ,
  `color_alerta` VARCHAR(10) NOT NULL ,
  `fecha_hora` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_historiales_alertas_estaciones1` (`estacion_id` ASC) ,
  INDEX `fk_historiales_alertas_alertas1` (`alerta_id` ASC) ,
  CONSTRAINT `fk_historiales_alertas_estaciones1`
    FOREIGN KEY (`estacion_id` )
    REFERENCES `sat`.`estaciones` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_historiales_alertas_alertas1`
    FOREIGN KEY (`alerta_id` )
    REFERENCES `sat`.`alertas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`secciones_transversales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`secciones_transversales` ;

CREATE  TABLE IF NOT EXISTS `sat`.`secciones_transversales` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `estacion_id` INT UNSIGNED NOT NULL ,
  `cero_escala` DOUBLE UNSIGNED NULL DEFAULT 0.0 ,
  PRIMARY KEY (`id`, `estacion_id`) ,
  INDEX `fk_secciones_transversales_estaciones1` (`estacion_id` ASC) ,
  CONSTRAINT `fk_secciones_transversales_estaciones1`
    FOREIGN KEY (`estacion_id` )
    REFERENCES `sat`.`estaciones` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sat`.`puntos_secciones_transversales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sat`.`puntos_secciones_transversales` ;

CREATE  TABLE IF NOT EXISTS `sat`.`puntos_secciones_transversales` (
  `seccion_transversal_id` INT UNSIGNED NOT NULL ,
  `x` DOUBLE NOT NULL ,
  `y` DOUBLE NOT NULL ,
  PRIMARY KEY (`seccion_transversal_id`, `x`) ,
  INDEX `fk_puntos_secciones_transversales_secciones_transversales1` (`seccion_transversal_id` ASC) ,
  CONSTRAINT `fk_puntos_secciones_transversales_secciones_transversales1`
    FOREIGN KEY (`seccion_transversal_id` )
    REFERENCES `sat`.`secciones_transversales` (`id` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
