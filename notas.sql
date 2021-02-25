-- -----------------------------------------------------
-- Tabla `USUARIOS`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `USUARIOS`
(
  `ID_USUARIO` INT(15) NOT NULL PRIMARY KEY,
  `NOMBRE` VARCHAR(60) NOT NULL,
  `APELLIDO` VARCHAR(60) NOT NULL,
  `PASSWORD` VARCHAR(60) NOT NULL,
  `CORREO` VARCHAR(45) NOT NULL,
  `TELEFONO` VARCHAR(45) NOT NULL
);

-- -----------------------------------------------------
-- Tabla `TECNICOS`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `TECNICOS` 
(
  `ID_TECNICO` INT(15) NOT NULL PRIMARY KEY,
  `NOMBRE` VARCHAR(60) NOT NULL,
  `APELLIDO` VARCHAR(60) NOT NULL,
  `PASSWORD` VARCHAR(60) NOT NULL,
  `CALIFICACION` VARCHAR(15) NOT NULL,
  `CORREO` VARCHAR(45) NOT NULL,
  `TELEFONO` VARCHAR(45) NOT NULL,
  `ESTADO` VARCHAR(40) NOT NULL
);

-- -----------------------------------------------------
-- Table `PRODUCTOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRODUCTOS` 
(
  `ID_PRODUCTOS` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `NOMBRE` VARCHAR(45) NOT NULL
);

-- -----------------------------------------------------
-- Table `MARCAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MARCAS` 
(
  `ID_MARCA` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `MARCA` VARCHAR(45) NOT NULL
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
  `PRODUCTOS_ID_PRODUCTOS` INT NOT NULL,
  `MARCAS_ID_MARCA` INT NOT NULL,
  INDEX `fk_FACTURA_USUARIOS1_idx` (`USUARIOS_ID_USUARIO` ASC),
  INDEX `fk_FACTURA_TECNICOS1_idx` (`TECNICOS_ID_TECNICO` ASC),
  INDEX `fk_FACTURA_PRODUCTOS1_idx` (`PRODUCTOS_ID_PRODUCTOS` ASC),
  INDEX `fk_FACTURA_MARCAS1_idx` (`MARCAS_ID_MARCA` ASC),
  CONSTRAINT `fk_FACTURA_USUARIOS1`
    FOREIGN KEY (`USUARIOS_ID_USUARIO`)
    REFERENCES `USUARIOS` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FACTURA_TECNICOS1`
    FOREIGN KEY (`TECNICOS_ID_TECNICO`)
    REFERENCES `TECNICOS` (`ID_TECNICO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FACTURA_PRODUCTOS1`
    FOREIGN KEY (`PRODUCTOS_ID_PRODUCTOS`)
    REFERENCES `PRODUCTOS` (`ID_PRODUCTOS`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FACTURA_MARCAS1`
    FOREIGN KEY (`MARCAS_ID_MARCA`)
    REFERENCES `MARCAS` (`ID_MARCA`)
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

-- -----------------------------------------------------
-- Insertar Productos
-- -----------------------------------------------------

INSERT INTO `productos` (`ID_PRODUCTOS`, `NOMBRE`)
 VALUES (NULL, 'Estufa'), (NULL, 'Lavadora'), (NULL, 'Horno'),
  (NULL, 'Microondas'), (NULL, 'Lavaplatos'),(NULL, 'Refrigerador'),
   (NULL, 'Campana extractora'), (NULL, 'Secadora'),
    (NULL, 'Calefactor'), (NULL, 'Aire acondicionado');

-- -----------------------------------------------------
-- Insertar Marcas
-- -----------------------------------------------------

INSERT INTO `marcas` (`ID_MARCA`, `MARCA`)
 VALUES (NULL, 'Whirpool'), (NULL, 'LG'), (NULL, 'Samsung'),
  (NULL, 'Bosch'), (NULL, 'Electrolux'),(NULL, 'Panasonic'),
   (NULL, 'Black&Decker'), (NULL, 'Toshiba'),
    (NULL, 'Sanyo'), (NULL, 'Neff');