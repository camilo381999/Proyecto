-- -----------------------------------------------------
-- Base de datos
-- -----------------------------------------------------
CREATE DATABASE tecniclick CHARACTER SET utf8;

-- -----------------------------------------------------
-- Table USUARIOS
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `USUARIOS` 
(
  `ID_USUARIO` INT(15) NOT NULL PRIMARY KEY,
  `NOMBRE` VARCHAR(60) NOT NULL,
  `APELLIDO` VARCHAR(60) NOT NULL,
  `PASSWORD` VARCHAR(255) NOT NULL,
  `CORREO` VARCHAR(45) NOT NULL,
  `TELEFONO` VARCHAR(45) NOT NULL,
  `LOCALIDAD` VARCHAR(60) NOT NULL
);


-- -----------------------------------------------------
-- Table `TECNICOS`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `TECNICOS` 
(
  `ID_TECNICO` INT(15) NOT NULL PRIMARY KEY,
  `NOMBRE` VARCHAR(60) NOT NULL,
  `APELLIDO` VARCHAR(60) NOT NULL,
  `PASSWORD` VARCHAR(255) NOT NULL,
  `CALIFICACION` VARCHAR(15) NOT NULL,
  `CORREO` VARCHAR(45) NOT NULL,
  `TELEFONO` VARCHAR(45) NOT NULL,
  `ESTADO` VARCHAR(40) NOT NULL,
  `LOCALIDAD` VARCHAR(60) NOT NULL
);

-- -----------------------------------------------------
-- Table `FACTURA`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `FACTURA` 
(
  `ID_FACTURA` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `FECHA` VARCHAR(45) NOT NULL,
  `COSTO` INT(10) NOT NULL,
  `USUARIOS_ID_USUARIO` INT NOT NULL,
  `TECNICOS_ID_TECNICO` INT NOT NULL,
  INDEX `fk_FACTURA_USUARIOS1_idx` (`USUARIOS_ID_USUARIO` ASC),
  INDEX `fk_FACTURA_TECNICOS1_idx` (`TECNICOS_ID_TECNICO` ASC),
  CONSTRAINT `fk_FACTURA_USUARIOS1`
    FOREIGN KEY (`USUARIOS_ID_USUARIO`)
    REFERENCES `USUARIOS` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FACTURA_TECNICOS1`
    FOREIGN KEY (`TECNICOS_ID_TECNICO`)
    REFERENCES `TECNICOS` (`ID_TECNICO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `REQUERIMIENTOS`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `REQUERIMIENTOS` 
(
  `ID_PUBLICACION` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `DIRECCION` VARCHAR(80) NOT NULL,
  `DESCRIPCION` VARCHAR(200) NOT NULL,
  `SERVICIO` VARCHAR(60) NOT NULL,
  `MARCA` VARCHAR(45) NOT NULL,
  `TIPO` VARCHAR(45) NOT NULL,
  `FECHA` VARCHAR(45) NOT NULL,
  `HORA` VARCHAR(45) NOT NULL,
  `USUARIOS_ID_USUARIO` INT NOT NULL,
  INDEX `fk_REQUERIMIENTOS_USUARIOS1_idx` (`USUARIOS_ID_USUARIO` ASC),
  CONSTRAINT `fk_REQUERIMIENTOS_USUARIOS1`
    FOREIGN KEY (`USUARIOS_ID_USUARIO`)
    REFERENCES `USUARIOS` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `PENDIENTE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PENDIENTE` 
(
  `ID_PENDIENTE` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `NOMBRE_TECNICO` VARCHAR(45) NOT NULL,
  `LOCALIDAD` VARCHAR(45) NOT NULL,
  `TIPO_SERVICIO` VARCHAR(45) NOT NULL,
  `ESTADO_SERVICIO` VARCHAR(45) NOT NULL,
  `ID_TECNICO` VARCHAR(45) NOT NULL,
  `ID_CLIENTE` VARCHAR(45) NOT NULL,
  `CORREO_TECNICO` VARCHAR(45) NOT NULL,
  `CAMBIOS_TECNICO` VARCHAR(45) NOT NULL,
  `FECHA` VARCHAR(45) NOT NULL,
  `HORA` VARCHAR(45) NOT NULL,
  `REQUERIMIENTOS_ID_PUBLICACION` INT NOT NULL,
  INDEX `fk_PENDIENTE_REQUERIMIENTOS1_idx` (`REQUERIMIENTOS_ID_PUBLICACION` ASC),
  CONSTRAINT `fk_PENDIENTE_REQUERIMIENTOS1`
    FOREIGN KEY (`REQUERIMIENTOS_ID_PUBLICACION`)
    REFERENCES `REQUERIMIENTOS` (`ID_PUBLICACION`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `AGENDA`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `AGENDA` 
(
  `ID_CITA` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `FECHA` VARCHAR(45) NOT NULL,
  `HORA` VARCHAR(45) NOT NULL,
  `UBICACION` VARCHAR(45) NOT NULL,
  `TECNICOS_ID_TECNICO` INT NOT NULL,
  `ESTADO` VARCHAR(60) NOT NULL,
  `CALIFICADO` VARCHAR(45) NOT NULL,
  `PENDIENTE_ID_PENDIENTE` INT NOT NULL,
  `COSTO` INT(10) NOT NULL,
  INDEX `fk_AGENDA_TECNICOS1_idx` (`TECNICOS_ID_TECNICO` ASC),
  INDEX `fk_AGENDA_PENDIENTE1_idx` (`PENDIENTE_ID_PENDIENTE` ASC),
  CONSTRAINT `fk_AGENDA_TECNICOS1`
    FOREIGN KEY (`TECNICOS_ID_TECNICO`)
    REFERENCES `TECNICOS` (`ID_TECNICO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AGENDA_PENDIENTE1`
    FOREIGN KEY (`PENDIENTE_ID_PENDIENTE`)
    REFERENCES `PENDIENTE` (`ID_PENDIENTE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `CALIFICACION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CALIFICACION` 
(
  `ID_CALIFICACION` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `TECNICOS_ID_TECNICO` INT NOT NULL,
  `ID_CLIENTE` VARCHAR(45) NOT NULL,
  `COMENTARIO` VARCHAR(300) NOT NULL,
  `CALIFICACION` VARCHAR(45) NOT NULL,
  `TIPO_SERVICIO` VARCHAR(45) NOT NULL,
  INDEX `fk_CALIFICACION_TECNICOS1_idx` (`TECNICOS_ID_TECNICO` ASC),
  CONSTRAINT `fk_CALIFICACION_TECNICOS1`
    FOREIGN KEY (`TECNICOS_ID_TECNICO`)
    REFERENCES `TECNICOS` (`ID_TECNICO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
  );

 ALTER TABLE `usuarios` ADD UNIQUE(`ID_USUARIO`);
 ALTER TABLE `usuarios` ADD UNIQUE(`CORREO`);
 ALTER TABLE `usuarios` ADD UNIQUE(`TELEFONO`);

 -- -----------------------------------------------------
-- Table `RECUPERACION_PASSWORD`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RECUPERACION_PASSWORD`(
  `ID_RECUPERACION` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `ID_USUARIO` INT NOT NULL,
  `URL_SECRETA` VARCHAR(255) NOT NULL,
  `FECHA` DATE NOT NULL
);

-- -----------------------------------------------------
-- Table `PQR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PQR` (
  `ID_PQR` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `ID_USUARIO` INT NOT NULL,
  `CORREO` VARCHAR(45) NOT NULL,
  `SELECCION_AYUDA` VARCHAR(45) NOT NULL,
  `DESCRIPCION` VARCHAR(200) NOT NULL,
  `NOMBRE` VARCHAR(45) NOT NULL
);

-- -----------------------------------------------------
-- Insertar Usuario
-- -----------------------------------------------------

INSERT INTO `usuarios` (`ID_USUARIO`, `NOMBRE`, `APELLIDO`,
 `PASSWORD`, `CORREO`, `TELEFONO`,`LOCALIDAD`)
  VALUES ('1020763742', 'Manuel Santiago', 'Martinez Oses',
  '$2y$10$VdfnF/XzPoIdRFmPgVRn8O2GkKUXgV4E1nFc/21UEJtqinDnzRn0W', 'manuel@gmail.com', '3121443252','Usaquén');

-- -----------------------------------------------------
-- Insertar Tecnico
-- -----------------------------------------------------

INSERT INTO `tecnicos` (`ID_TECNICO`, `NOMBRE`, `APELLIDO`,
 `PASSWORD`, `CALIFICACION`, `CORREO`, `TELEFONO`, `ESTADO`,`LOCALIDAD`)
  VALUES ('1029847735', 'Diego', 'Palacio','$2y$10$VdfnF/XzPoIdRFmPgVRn8O2GkKUXgV4E1nFc/21UEJtqinDnzRn0W',
   '3', 'diego@gmail.com', '2345245345','Inactivo','Usaquén');


