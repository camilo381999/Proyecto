-- -----------------------------------------------------
-- Tabla `USUARIOS`
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
-- Tabla `TECNICOS`
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
-- Tabla `FACTURA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `FACTURA` 
(
  `ID_FACTURA` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `FECHA` VARCHAR(45) NOT NULL,
  `COSTO` VARCHAR(45) NOT NULL,
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
-- Tabla `AGENDA`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `AGENDA` 
(
  `ID_CITA` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `FECHA` VARCHAR(45) NOT NULL,
  `HORA` VARCHAR(45) NOT NULL,
  `UBICACION` VARCHAR(45) NOT NULL,
  `USUARIOS_ID_USUARIO` INT(15) NOT NULL,
  `TECNICOS_ID_TECNICO` INT(15) NOT NULL,
  INDEX `fk_AGENDA_USUARIOS_idx` (`USUARIOS_ID_USUARIO` ASC),
  INDEX `fk_AGENDA_TECNICOS1_idx` (`TECNICOS_ID_TECNICO` ASC),
  CONSTRAINT `fk_AGENDA_USUARIOS`
    FOREIGN KEY (`USUARIOS_ID_USUARIO`)
    REFERENCES `USUARIOS` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AGENDA_TECNICOS1`
    FOREIGN KEY (`TECNICOS_ID_TECNICO`)
    REFERENCES `TECNICOS` (`ID_TECNICO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Insertar Usuario
-- -----------------------------------------------------

INSERT INTO `usuarios` (`ID_USUARIO`, `NOMBRE`, `APELLIDO`,
 `PASSWORD`, `CORREO`, `TELEFONO`)
  VALUES ('1020763742', 'Manuel Santiago', 'Martinez Oses',
  'admin123', 'manuel@gmail.com', '3121443252');

-- -----------------------------------------------------
-- Insertar Tecnico
-- -----------------------------------------------------

INSERT INTO `tecnicos` (`ID_TECNICO`, `NOMBRE`, `APELLIDO`,
 `PASSWORD`, `CALIFICACION`, `CORREO`, `TELEFONO`, `ESTADO`)
  VALUES ('1029847735', 'Diego', 'Palacio','12345',
   '3', 'diego@gmail.com', '2345245345','Inactivo');


 ALTER TABLE `usuarios` ADD UNIQUE(`ID_USUARIO`);
 ALTER TABLE `usuarios` ADD UNIQUE(`CORREO`);
 ALTER TABLE `usuarios` ADD UNIQUE(`TELEFONO`);