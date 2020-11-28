# Host: localhost  (Version 5.5.5-10.4.14-MariaDB)
# Date: 2020-11-28 07:09:09
# Generator: MySQL-Front 6.0  (Build 2.20)

CREATE DATABASE fma_csa;
USE fma_csa;

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;


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
# Structure for table "tab_marca"
#

DROP TABLE IF EXISTS `tab_marca`;
CREATE TABLE `tab_marca` (
  `marca_herramienta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tab_marca"
#

INSERT INTO `tab_marca` VALUES ('DEWALT'),('BLACK AND DECKER'),('BOSCH '),('MAKITA'),('MILWAUKEE'),('STANLEY'),('URREA'),('TRUPER'),('NACOBRE'),('IUSA'),('PHILLIPS'),('AUSTROMEX'),('3M'),('KNOVA'),('EINHELL'),('FESTOOL'),('HILTI');

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

#Folio actual
ALTER TABLE tab_orden AUTO_INCREMENT = 3500;

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

INSERT INTO `tab_users` VALUES (1,'Administrador','CSA','8cb2237d0679ca88db6464eac60da96345513964',1,'1',0);

#
# Procedure "Refacciones"
#

DROP PROCEDURE IF EXISTS Refacciones;
CREATE PROCEDURE Refacciones(IN id INT)
BEGIN
         SELECT R.cod_refaccion, R.desc_refaccion, R.marca_refaccion, R.costo_refaccion FROM tab_ordenrefaccion AS R
JOIN tab_orden AS O
ON R.id_orden = O.id_orden
WHERE O.id_orden = id;
       END;

#
# Procedure "ReporteStado"
#

DROP PROCEDURE IF EXISTS ReporteStado;
CREATE PROCEDURE ReporteStado(IN list VARCHAR(15), fechIn VARCHAR(10), fechaOut VARCHAR(10))
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

DROP PROCEDURE IF EXISTS ReporteTodos;
CREATE PROCEDURE ReporteTodos(IN fechIn VARCHAR(10), fechaOut VARCHAR(10))
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

DROP PROCEDURE IF EXISTS Servicios;
CREATE PROCEDURE Servicios(IN id INT)
BEGIN

         SELECT S.cod_servicio, S.desc_servicio, S.costo_servicio FROM tab_ordenservicio AS S
JOIN tab_orden AS O

ON S.id_orden = O.id_orden

WHERE O.id_orden = id;

END;
