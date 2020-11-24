# Host: localhost  (Version 5.5.5-10.4.14-MariaDB)
# Date: 2020-11-23 20:31:02
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "tab_cliente"
#

DROP TABLE IF EXISTS `tab_cliente`;
CREATE TABLE `tab_cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cliente` varchar(50) NOT NULL,
  `dir_cliente` varchar(70) NOT NULL,
  `mun_cliente` varchar(25) NOT NULL,
  `cp_cliente` int(11) NOT NULL,
  `tel_cliente` varchar(20) NOT NULL,
  `rfc_cliente` varchar(15) NOT NULL,
  `mail_cliente` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cliente`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tab_cliente"
#

INSERT INTO `tab_cliente` VALUES (1,'Brandon Lechuga','Pino #6','Tlaquepaque',45530,'3349682154','0123456789','Brihand.lech@gmail.com'),(2,'Juan Scutia','Hidalgo 2055','Tlaquepaque',45530,'3317202513','0123456789','cchenriquez2@yopmail.com'),(3,'Rafael Garcia','La paz 485','Tlaquepaque',45530,'3385967412','9867459865','embeltranz12@yopmail.com'),(4,'Pedro González','Revolucion 45','Tlaquepaque',45530,'3396849576','78965415245','ccsmaili2@yopmail.com'),(5,'Maria Luna','8 de Julio','Tlaquepaque',45530,'3395867485','976284615324','hjpaolo9@yopmail.com'),(6,'Luis Preciado','Guadalupe 35','Tlaquepaque',45530,'3384965874','9687452165','buromanf20@yopmail.com'),(7,'Omar Gallegos Vazquez','Fray antonio de segovia 1244','Tlaquepaque',45530,'3314278911','GAVO9112161VA','ddmurguia3@yopmail.com'),(8,'/*-+$·%&\"·ñÑ','%$·%&','Tlaquepaque',45305,'Sin Capturar','Sin Capturar','NuevoCorreo@Correo.com'),(9,'Ismael Belisario Barreu Aliques','Privada Bors No. 680','Veracruz',75598,'2423770117','41796707636','cpismaelbelisario15@yopmail.com Check Email\r\n\r\ncpi'),(10,'Magdalena Tina Bareas Corne','Avenida Franconetti No. 111','Tlaquepaque',45530,'4530928537','78965415245','idcornes3@yopmail.com'),(11,'Perla G. Fadli Edesa','Bulevar Khouya No. 572','Tlaquepaque',87765,'0304339385','37601093344','adedesa3@yopmail.com'),(12,'Sahul Asier Vila Cenusa','Privada Bouzian No. 125','Chihuahua',36035,'7370227506','34642272407','jksahulasier10@yopmail.com'),(13,'Alejandro Flavio Aberasturi Saña','Boulevard Lamolda No. 418','Sinaloa',24066,'4448566390','41026136456','gssana18@yopmail.com '),(14,'Merce Hodar Ruiz de Erenchun','Privada Varden No. 606','Nayarit',97414,'7478009080','42129090283','eyruizdeerenchun24@yopmail.com'),(15,'Liliana Lamuño Cango','De Roman No. 491','Nayarit',83808,'3202664255','37843346425','fdcango3@yopmail.com'),(16,'Tina Solano Viñaspre','Bulevar Pastaza No. 391','Tlaxcala',64290,'9494993737','41807739846','dvvinaspre21@yopmail.com'),(17,'Atila B. Lojan Mandingorra','Calle Tomasa No. 81','Michoacán',45530,'3317202513','32326004794','alatilab11@yopmail.com'),(18,'Remigio F. Santaya Aydillo','Privada Diedhiou No. 674','Quintana Roo',45357,'9497882522','41809228075','bsremigiof18@yopmail.com'),(19,'Dalmiro F. Rael Cioban','Avenida Ciriaco No. 536','Tlaxcala',67907,'4340224253','37874342201','fjcioban9@yopmail.com'),(20,'José Aaron Chávez Soto','Luis J. Jiménez 577','1o. de Mayo',44979,'3330300900','0123456789','aaron.chavez@utj.edu.mx');

#
# Structure for table "tab_herramienta"
#

DROP TABLE IF EXISTS `tab_herramienta`;
CREATE TABLE `tab_herramienta` (
  `Id_herramienta` int(11) NOT NULL AUTO_INCREMENT,
  `cod_herramienta` varchar(50) NOT NULL,
  `desc_herramienta` varchar(100) NOT NULL,
  `marca_herramienta` varchar(50) NOT NULL,
  `status_herramienta` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_herramienta`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tab_herramienta"
#

INSERT INTO `tab_herramienta` VALUES (1,'EW3051H','Motobomba 60.000 L/h','MAKITA','DISPONIBLE'),(2,'EG6050A','Generador 6.0kVA','MAKITA','DISPONIBLE'),(3,'5008MG','Sierra circular 210 mm','MAKITA','DISPONIBLE'),(4,'EW3051H','Motobomba 60.000 L/h','MAKITA','EN PRESTAMO');

#
# Structure for table "tab_marca"
#

DROP TABLE IF EXISTS `tab_marca`;
CREATE TABLE `tab_marca` (
  `marca_herramienta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tab_marca"
#

INSERT INTO `tab_marca` VALUES ('DEWALT'),('BLACK AND DECKER'),('BOSCH '),('MAKITA'),('MILWAUKEE'),('STANLEY'),('URREA'),('TRUPPER');

#
# Structure for table "tab_orden"
#

DROP TABLE IF EXISTS `tab_orden`;
CREATE TABLE `tab_orden` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `code_user` int(11) NOT NULL,
  `fech_entrada` date NOT NULL,
  `fech_salida` date NOT NULL,
  `status_orden` varchar(30) NOT NULL,
  `img` varchar(30) NOT NULL DEFAULT 'CSA.webp',
  `desc_herramienta` varchar(50) NOT NULL,
  `marca_herramienta` varchar(50) NOT NULL,
  `mod_herramienta` varchar(20) NOT NULL,
  `tipo_herramienta` varchar(20) NOT NULL,
  `tipo_servicio` varchar(25) NOT NULL,
  `detalle_servicio` varchar(100) NOT NULL,
  `tec_taller` varchar(30) NOT NULL,
  `pago_orden` varchar(15) NOT NULL,
  `iva_orden` varchar(15) NOT NULL,
  PRIMARY KEY (`id_orden`) USING BTREE,
  KEY `code_user` (`code_user`) USING BTREE,
  KEY `id_cliente` (`id_cliente`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tab_orden"
#

INSERT INTO `tab_orden` VALUES (1,1,2,'2020-10-01','2020-10-28','ENTREGADA','CSA.webp','AMARRADORA DE VARILLA INALAMBRICA','MAKITA','DTR180Z','0','Presupuesto','NO PRENDE, SE VE EN BUEN ESTADO\r\nFALLO EN UN CABLE INTERNO\r\nESTA ES OTRA LINEA\r\nOTRA ADIOS LINEA','Administrador','EFECTIVO','Si'),(7,7,2,'2020-10-07','2020-11-14','ENTREGADA','CSA.webp','TALADRO PERCUTOR/ATORNILLADOR ','DEWALT','DCD778D2-B2','0','Presupuesto','NO PRENDE, SE VE EN BUEN ESTADO\r\nFALLO EN UN CABLE INTERNO\r\nTEST','Administrador','TARJETA','Si'),(8,2,2,'2020-10-07','0000-00-00','CANCELADA','CSA.webp','TALADRO INALAMBRICO 1/2\"','MAKITA','PH02X2','0','Garantia','Sin Observaciones','Emmanuel Luna','Sin Asignar','Sin Asignar'),(9,3,2,'2020-10-07','0000-00-00','CANCELADA','CSA.webp','---','GENERICA','---','0','Ninguno','Sin observaciones','Administrador','Sin Asignar','Sin Asignar'),(10,7,2,'2020-10-10','2020-11-22','ENTREGADA','CSA.webp','Gama plus','MAKITA','DCD778D2-B2','0','Mantenimiento','NO PRENDE, SE VE EN BUEN ESTADO\r\nFALLO EN UN CABLE INTERNO','Emmanuel Luna','EFECTIVO','Si'),(11,1,2,'2020-10-16','2020-11-05','ENTREGADA','CSA.webp','Test','GENERICA','Test','Tipo 1','Mantenimiento/Garantía','Se hicieron cosas','Administrador','EFECTIVO','Si'),(12,1,2,'2020-11-05','2020-11-16','ENTREGADA','CSA.webp','Test Herramienta','GENERICA','Test','Test','Test','Mantenimiento','Emmanuel Luna','EFECTIVO','Si'),(13,3,2,'2020-11-05','2020-11-15','ENTREGADA','CSA.webp','Test Herramienta','DEWALT','DCD778D2-B2','Test Adicional','Mantenimiento','Diagnostico','Administrador','EFECTIVO','Si'),(14,10,2,'2020-11-05','0000-00-00','EN TALLER','CSA.webp','Test Herramienta','STANLEY','Test Modelo','Test Adicional','Mantenimiento/Garantía','Test Diagnostico','Administrador','Sin Asignar','Sin Asignar'),(15,1,1,'2020-11-11','0000-00-00','EN ESPERA','CSA.webp','asdasd','MILWAUKEE','asdasd','asdas','Presupuesto','asdasd','Emmanuel Luna','Sin Asignar','Sin Asignar'),(16,3,1,'2020-11-15','0000-00-00','EN ESPERA','CSA.webp','asdasd','GENERICA','asdasd','asdas','Presupuesto','Xd','Sin Asignar','Sin Asignar','Sin Asignar'),(17,1,5,'2020-11-16','0000-00-00','EN TALLER','CSA.webp','asdasd','GENERICA','asdasd','asdas','Garantia','Test de serivicio','Emmanuel Luna','Sin Asignar','Sin Asignar'),(18,1,1,'2020-11-23','2020-11-23','ENTREGADA','CSA.webp','asdf','GENERICA','asd','asd','Mantenimiento','asdasdasd','Emmanuel Luna','EFECTIVO','Si'),(19,3,1,'2020-11-22','2020-11-22','ENTREGADA','CSA.webp','asdsadasd','BOSCH ','asdasdad','asdadadsd','Presupuesto','adasdasd','Administrador','EFECTIVO','Si'),(20,1,1,'2020-11-23','2020-11-23','ENTREGADA','CSA.webp','Rotomartillo','MAKITA','MD-354s','Tipo 1','Garantia','La herramienta funciona','Administrador','EFECTIVO','Si'),(21,20,1,'2020-11-23','2020-11-23','REPARADA','CSA.webp','Rotomartillo','MAKITA','MD-354s','Tipo 1','Garantia','No enciende','Administrador','Sin Asignar','Sin Asignar');

#
# Structure for table "tab_ordenrefaccion"
#

DROP TABLE IF EXISTS `tab_ordenrefaccion`;
CREATE TABLE `tab_ordenrefaccion` (
  `id_orden` int(11) DEFAULT NULL,
  `cod_refaccion` varchar(50) DEFAULT NULL,
  `desc_refaccion` varchar(50) DEFAULT NULL,
  `marca_refaccion` varchar(50) DEFAULT NULL,
  `costo_refaccion` int(11) DEFAULT NULL,
  KEY `id_orden` (`id_orden`) USING BTREE,
  KEY `id_refaccion` (`cod_refaccion`) USING BTREE,
  CONSTRAINT `tab_ordenrefaccion_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `tab_orden` (`id_orden`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tab_ordenrefaccion"
#

INSERT INTO `tab_ordenrefaccion` VALUES (1,'181019-9','JUEGO DE CARBONES CB-1 P/903','MAKITA',120),(1,'0011806160','TORNILLO M6X30 P/RBC411','MAKITA',29),(1,'001-173-020 ','FILTRO DE AIRE INTERIOR P/DPC7000','MAKITA',24),(11,'0011705200','TORNILLO M5X20 P/RBC320','MAKITA',24),(11,'0011705200','TORNILLO M5X20 P/RBC320','MAKITA',24),(11,'001-131-150 ','VALVULA DE DESCOMPRESION','MAKITA',340),(7,'90552433-01','FILTRO PARA ASPIRADORA','BLACK & DECKER',85),(13,'90552433-01','FILTRO PARA ASPIRADORA','BLACK & DECKER',85),(12,'370009-00','VENTILADOR PARA ASPIRADORA','DEWALT',186),(18,'001-131-150 ','VALVULA DE DESCOMPRESION','MAKITA',340),(19,'370009-00','VENTILADOR PARA ASPIRADORA','DEWALT',186),(10,'001-173-020 ','FILTRO DE AIRE INTERIOR P/DPC7000','MAKITA',24),(20,'181019-9','JUEGO DE CARBONES CB-1 P/903','MAKITA',100),(21,'001-131-150 ','VALVULA DE DESCOMPRESION','MAKITA',340);

#
# Structure for table "tab_ordenservicio"
#

DROP TABLE IF EXISTS `tab_ordenservicio`;
CREATE TABLE `tab_ordenservicio` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_orden` int(11) NOT NULL,
  `cod_servicio` int(11) NOT NULL,
  `desc_servicio` varchar(50) NOT NULL,
  `costo_servicio` int(11) NOT NULL,
  PRIMARY KEY (`id_servicio`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tab_ordenservicio"
#

INSERT INTO `tab_ordenservicio` VALUES (1,1,1,'REVISIÓN HERRRAMIENTA',50),(4,7,2,'MANO DE OBRA',300),(8,7,1,'REVISIÓN HERRRAMIENTA',50),(9,7,4,'EJEMPLO DE SERVICIO',1),(10,11,1,'REVISIÓN HERRRAMIENTA',50),(11,11,2,'MANO DE OBRA',300),(12,13,1,'REVISIÓN HERRRAMIENTA',50),(13,12,2,'MANO DE OBRA',300),(14,12,1,'REVISIÓN HERRRAMIENTA',50),(15,18,3,'LIMPIEZA HERRAMIENTA',60),(16,18,1,'REVISIÓN HERRRAMIENTA',50),(17,19,2,'MANO DE OBRA',300),(18,10,2,'MANO DE OBRA',300),(19,20,1,'REVISIÓN HERRRAMIENTA',50),(20,20,2,'MANO DE OBRA',300),(21,21,1,'REVISIÓN HERRRAMIENTA',50),(22,21,2,'MANO DE OBRA',300);

#
# Structure for table "tab_prestamo"
#

DROP TABLE IF EXISTS `tab_prestamo`;
CREATE TABLE `tab_prestamo` (
  `id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `id_herramienta` int(11) NOT NULL DEFAULT 0,
  `cod_herramienta` varchar(25) NOT NULL,
  `desc_prestamo` varchar(50) NOT NULL,
  `marca_prestamo` varchar(50) NOT NULL,
  `id_cliente` int(11) NOT NULL DEFAULT 0,
  `cliente_prestamo` varchar(50) NOT NULL DEFAULT '',
  `fech_salida_prestamo` date NOT NULL,
  `fech_entrada_prestamo` date NOT NULL,
  `status_prestamo` varchar(15) NOT NULL,
  PRIMARY KEY (`id_prestamo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tab_prestamo"
#

INSERT INTO `tab_prestamo` VALUES (1,2,'EG6050A','Generador 6.0kVA','MAKITA',1,'Brandon Lechuga','2020-11-14','2020-11-15','CANCELADA'),(2,1,'EW3051H','Motobomba 60.000 L/h','MAKITA',2,'Juan Scutia','2020-11-14','2020-11-15','FINALIZADA'),(3,3,'5008MG','Sierra circular 210 mm','MAKITA',10,'Lorena Herrera','2020-11-14','2020-11-15','FINALIZADA'),(4,4,'EW3051H','Motobomba 60.000 L/h','MAKITA',7,'Omar Gallegos Vazquez','2020-11-15','0000-00-00','EN PRESTAMO');

#
# Structure for table "tab_refaccion"
#

DROP TABLE IF EXISTS `tab_refaccion`;
CREATE TABLE `tab_refaccion` (
  `id_refaccion` int(11) NOT NULL AUTO_INCREMENT,
  `cod_refaccion` varchar(50) NOT NULL,
  `desc_refaccion` varchar(50) NOT NULL,
  `marca_refaccion` varchar(50) NOT NULL,
  `cant_refaccion` int(11) NOT NULL,
  `costo_refaccion` int(11) NOT NULL,
  PRIMARY KEY (`id_refaccion`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tab_refaccion"
#

INSERT INTO `tab_refaccion` VALUES (1,'181019-9','JUEGO DE CARBONES CB-1 P/903','MAKITA',0,100),(2,'001-131-150 ','VALVULA DE DESCOMPRESION','MAKITA',1,340),(3,'001-173-020 ','FILTRO DE AIRE INTERIOR P/DPC7000','MAKITA',0,24),(4,'001118062','TUERCA P/DCS6000I,DCS6800I','MAKITA',15,31),(5,'0011806160','TORNILLO M6X30 P/RBC411','MAKITA',5,29),(6,'0011705200','TORNILLO M5X20 P/RBC320','MAKITA',9,24),(7,'90552433-01','FILTRO PARA ASPIRADORA','BLACK & DECKER',0,85),(8,'370009-00','VENTILADOR PARA ASPIRADORA','DEWALT',0,186);

#
# Structure for table "tab_servicio"
#

DROP TABLE IF EXISTS `tab_servicio`;
CREATE TABLE `tab_servicio` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `cod_servicio` int(11) NOT NULL,
  `desc_servicio` varchar(30) NOT NULL,
  `costo_servicio` int(11) NOT NULL,
  PRIMARY KEY (`id_servicio`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tab_servicio"
#

INSERT INTO `tab_servicio` VALUES (1,1,'REVISIÓN HERRRAMIENTA',50),(2,2,'MANO DE OBRA',300),(3,3,'LIMPIEZA HERRAMIENTA',60),(4,4,'EJEMPLO DE SERVICIO',1);

#
# Structure for table "tab_users"
#

DROP TABLE IF EXISTS `tab_users`;
CREATE TABLE `tab_users` (
  `code_user` int(11) NOT NULL AUTO_INCREMENT,
  `name_user` varchar(50) NOT NULL,
  `nick_user` varchar(50) NOT NULL,
  `pass_user` varchar(50) NOT NULL,
  `priv_user` int(1) NOT NULL,
  `conf_user` varchar(15) NOT NULL,
  `taller` int(11) NOT NULL,
  PRIMARY KEY (`code_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tab_users"
#

INSERT INTO `tab_users` VALUES (1,'Administrador','CSA','8cb2237d0679ca88db6464eac60da96345513964',1,'10',0),(2,'Armando Cruz','ARMCRU','3b3d55eebac28f87bf6d04adf85f9c9782fb7a2e',2,'1',0),(3,'Emmanuel Luna','EMMLUN','40bd001563085fc35165329ea1ff5c5ecbdbbeef',3,'7',17),(4,'Brandon Lechuga','BRALEC','40bd001563085fc35165329ea1ff5c5ecbdbbeef',1,'1',0),(5,'Pedro Loza','PEDLOZ','40bd001563085fc35165329ea1ff5c5ecbdbbeef',2,'1',0),(6,'Rafael Garcia','RAFGAR','40bd001563085fc35165329ea1ff5c5ecbdbbeef',3,'1',0),(7,'Ivanitza Ponce','IVAPON','3b3d55eebac28f87bf6d04adf85f9c9782fb7a2e',1,'2',0);

#
# Procedure "Refacciones"
#

DROP PROCEDURE IF EXISTS `Refacciones`;
CREATE PROCEDURE `Refacciones`(IN id INT)
BEGIN
         SELECT R.cod_refaccion, R.desc_refaccion, R.marca_refaccion, R.costo_refaccion FROM tab_ordenrefaccion AS R
JOIN tab_orden AS O
ON R.id_orden = O.id_orden
WHERE O.id_orden = id;
       END;

#
# Procedure "ReporteStado"
#

DROP PROCEDURE IF EXISTS `ReporteStado`;
CREATE PROCEDURE `ReporteStado`(IN list VARCHAR(15), fechIn VARCHAR(10), fechaOut VARCHAR(10))
BEGIN
SELECT O.id_orden, C.nom_cliente, O.tipo_servicio, O.desc_herramienta, O.fech_entrada, U.name_user, O.status_orden FROM tab_orden AS O
JOIN tab_cliente AS C
ON O.id_cliente = C.id_cliente
JOIN tab_users AS U
ON O.code_user = U.code_user
WHERE O.status_orden = list AND (O.fech_entrada BETWEEN fechIn AND fechaOut);
END;

#
# Procedure "ReporteTodos"
#

DROP PROCEDURE IF EXISTS `ReporteTodos`;
CREATE PROCEDURE `ReporteTodos`(IN fechIn VARCHAR(10), fechaOut VARCHAR(10))
BEGIN
SELECT O.id_orden, C.nom_cliente, O.tipo_servicio, O.desc_herramienta, O.fech_entrada, U.name_user, O.status_orden FROM tab_orden AS O
JOIN tab_cliente AS C
ON O.id_cliente = C.id_cliente
JOIN tab_users AS U
ON O.code_user = U.code_user
WHERE O.fech_entrada BETWEEN fechIn AND fechaOut;
END;

#
# Procedure "Servicios"
#

DROP PROCEDURE IF EXISTS `Servicios`;
CREATE PROCEDURE `Servicios`(IN id INT)
BEGIN

         SELECT S.cod_servicio, S.desc_servicio, S.costo_servicio FROM tab_ordenservicio AS S
JOIN tab_orden AS O

ON S.id_orden = O.id_orden

WHERE O.id_orden = id;

END;
