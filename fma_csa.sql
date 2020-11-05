/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : fma_csa

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 05/11/2020 14:10:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tab_cliente
-- ----------------------------
DROP TABLE IF EXISTS `tab_cliente`;
CREATE TABLE `tab_cliente`  (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cliente` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dir_cliente` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mun_cliente` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cp_cliente` int(11) NOT NULL,
  `tel_cliente` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rfc_cliente` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mail_cliente` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_cliente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tab_cliente
-- ----------------------------
INSERT INTO `tab_cliente` VALUES (1, 'Brandon Lechuga', 'Pino #6', 'Tlaquepaque', 45530, '3349682154', '0123456789', 'Brihand.lech@gmail.com');
INSERT INTO `tab_cliente` VALUES (2, 'Juan Scutia', 'Hidalgo 2055', '', 0, '3317202513', '0123456789', '');
INSERT INTO `tab_cliente` VALUES (3, 'Rafael Garcia', 'La paz 485', 'Tlaquepaque', 45530, '3385967412', '9867459865', 'NuevoCorreo@Correo.com');
INSERT INTO `tab_cliente` VALUES (4, 'Pedro González', 'Revolucion 45', '', 0, '3396849576', '78965415245', '');
INSERT INTO `tab_cliente` VALUES (5, 'Maria Luna', '8 de Julio', '', 0, '3395867485', '976284615324', '');
INSERT INTO `tab_cliente` VALUES (6, 'Luis Preciado', 'Guadalupe 35', '', 0, '3384965874', '9687452165', '');
INSERT INTO `tab_cliente` VALUES (7, 'Omar Gallegos Vazquez', 'Fray antonio de segovia 1244', '', 0, '3314278911', 'GAVO9112161VA', '');
INSERT INTO `tab_cliente` VALUES (8, '/*-+$·%&\"·ñÑ', '%$·%&', '435367%$&%$&', 45305, '\"·$\"·$%$&', '%&\"$\"·/*-+', 'NuevoCorreo@Correo.com');
INSERT INTO `tab_cliente` VALUES (9, 'Sin Nombre', 'Sin Domicilio', 'Sin Municipio', 0, 'Sin Teléfono', 'Sin Rfc', '');
INSERT INTO `tab_cliente` VALUES (10, 'Lorena Herrera', 'Su casa', 'Tlaquepaque', 45530, '3396849576', '78965415245', 'Test3@ejemplo.com');
INSERT INTO `tab_cliente` VALUES (11, 'Sara Maldonado', '---', '', 0, '---', '---', '');
INSERT INTO `tab_cliente` VALUES (12, 'Usuario1', 'Direccion1', '', 0, 'Telèfono1', 'Rfc1', '');
INSERT INTO `tab_cliente` VALUES (13, 'Usuario2', 'Direccion2', '', 0, 'Telefono2', 'Rfc2', '');
INSERT INTO `tab_cliente` VALUES (14, 'Usuario3', 'Direccion3', '', 0, 'Telefono3', 'Rfc3', '');
INSERT INTO `tab_cliente` VALUES (15, 'Nuevo Cliente', 'Nuevo Domicilio', 'Nuevo Municipio', 45530, '33-17-20-25-13', 'Nuevo RFC', '');
INSERT INTO `tab_cliente` VALUES (16, 'Nuevo Cliente', 'Nuevo Domicilio', 'Nuevo Municipio', 0, '3317202513', '9867459865', 'NuevoCorreo@Correo.com');
INSERT INTO `tab_cliente` VALUES (17, 'Test 3', 'Test 3', 'Test 3', 45530, '3317202513', 'Test 3', 'Test3@ejemplo.com');

-- ----------------------------
-- Table structure for tab_herramienta
-- ----------------------------
DROP TABLE IF EXISTS `tab_herramienta`;
CREATE TABLE `tab_herramienta`  (
  `cod_herramienta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc_herramienta` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `marca_herramienta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mod_herramienta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `obs_herramienta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cant_herramienta` int(11) NOT NULL,
  PRIMARY KEY (`cod_herramienta`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tab_herramienta
-- ----------------------------
INSERT INTO `tab_herramienta` VALUES ('DEW DWE4212-B3', '	MINIESMERILADORA INDUSTRIAL', 'DEWALT', 'DWE4212-B3', 'NUEVA', 1);

-- ----------------------------
-- Table structure for tab_marca
-- ----------------------------
DROP TABLE IF EXISTS `tab_marca`;
CREATE TABLE `tab_marca`  (
  `marca_herramienta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tab_marca
-- ----------------------------
INSERT INTO `tab_marca` VALUES ('DEWALT');
INSERT INTO `tab_marca` VALUES ('BLACK AND DECKER');
INSERT INTO `tab_marca` VALUES ('BOSCH ');
INSERT INTO `tab_marca` VALUES ('MAKITA');
INSERT INTO `tab_marca` VALUES ('MILWAUKEE');
INSERT INTO `tab_marca` VALUES ('STANLEY');
INSERT INTO `tab_marca` VALUES ('URREA');
INSERT INTO `tab_marca` VALUES ('TRUPPER');

-- ----------------------------
-- Table structure for tab_orden
-- ----------------------------
DROP TABLE IF EXISTS `tab_orden`;
CREATE TABLE `tab_orden`  (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `code_user` int(11) NOT NULL,
  `fech_entrada` date NOT NULL,
  `fech_salida` date NOT NULL,
  `status_orden` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'CSA.webp',
  `desc_herramienta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `marca_herramienta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mod_herramienta` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_herramienta` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_servicio` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detalle_servicio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tec_taller` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pago_orden` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `iva_orden` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_orden`) USING BTREE,
  INDEX `code_user`(`code_user`) USING BTREE,
  INDEX `id_cliente`(`id_cliente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tab_orden
-- ----------------------------
INSERT INTO `tab_orden` VALUES (1, 1, 2, '2020-10-01', '2020-10-28', 'ENTREGADA', 'CSA.webp', 'AMARRADORA DE VARILLA INALAMBRICA', 'MAKITA', 'DTR180Z', '0', 'Presupuesto', 'NO PRENDE, SE VE EN BUEN ESTADO\r\nFALLO EN UN CABLE INTERNO\r\nESTA ES OTRA LINEA\r\nOTRA ADIOS LINEA', 'Administrador', 'EFECTIVO', 'Si');
INSERT INTO `tab_orden` VALUES (7, 7, 2, '2020-10-07', '0000-00-00', 'EN TALLER', 'CSA.webp', 'TALADRO PERCUTOR/ATORNILLADOR ', 'DEWALT', 'DCD778D2-B2', '0', 'Presupuesto', 'NO PRENDE, SE VE EN BUEN ESTADO\r\nFALLO EN UN CABLE INTERNO\r\nTEST', 'Administrador', 'Sin Asignar', 'Sin Asignar');
INSERT INTO `tab_orden` VALUES (8, 2, 2, '2020-10-07', '0000-00-00', 'PxA', 'CSA.webp', 'TALADRO INALAMBRICO 1/2\"', 'MAKITA', 'PH02X2', '0', 'Garantia', 'Sin Observaciones', 'Administrador', 'Sin Asignar', 'Sin Asignar');
INSERT INTO `tab_orden` VALUES (9, 3, 2, '2020-10-07', '0000-00-00', 'CANCELADA', 'CSA.webp', '---', 'GENERICA', '---', '0', 'Ninguno', 'Sin observaciones', 'Administrador', 'Sin Asignar', 'Sin Asignar');
INSERT INTO `tab_orden` VALUES (10, 7, 2, '2020-10-10', '0000-00-00', 'EN ESPERA', 'CSA.webp', 'Gama plus', 'MAKITA', 'DCD778D2-B2', '0', 'Mantenimiento', 'NO PRENDE, SE VE EN BUEN ESTADO\r\nFALLO EN UN CABLE INTERNO', 'Sin Asignar', 'Sin Asignar', 'Sin Asignar');
INSERT INTO `tab_orden` VALUES (11, 1, 2, '2020-10-16', '2020-11-05', 'REPARADA', 'CSA.webp', 'Test', 'GENERICA', 'Test', 'Tipo 1', 'Mantenimiento/Garantía', 'Se hicieron cosas', 'Administrador', 'Sin Asignar', 'Sin Asignar');
INSERT INTO `tab_orden` VALUES (12, 1, 2, '2020-11-05', '0000-00-00', 'EN ESPERA', 'CSA.webp', 'Test Herramienta', 'GENERICA', 'Test', 'Test', 'Test', 'Mantenimiento', 'Sin Asignar', 'Sin Asignar', 'Sin Asignar');
INSERT INTO `tab_orden` VALUES (13, 3, 2, '2020-11-05', '0000-00-00', 'EN ESPERA', 'CSA.webp', 'Test Herramienta', 'DEWALT', 'DCD778D2-B2', 'Test Adicional', 'Mantenimiento', 'Diagnostico', 'Sin Asignar', 'Sin Asignar', 'Sin Asignar');
INSERT INTO `tab_orden` VALUES (14, 10, 2, '2020-11-05', '0000-00-00', 'EN ESPERA', 'CSA.webp', 'Test Herramienta', 'STANLEY', 'Test Modelo', 'Test Adicional', 'Mantenimiento/Garantía', 'Test Diagnostico', 'Sin Asignar', 'Sin Asignar', 'Sin Asignar');

-- ----------------------------
-- Table structure for tab_ordenrefaccion
-- ----------------------------
DROP TABLE IF EXISTS `tab_ordenrefaccion`;
CREATE TABLE `tab_ordenrefaccion`  (
  `id_orden` int(11) NULL DEFAULT NULL,
  `cod_refaccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `desc_refaccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `marca_refaccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `costo_refaccion` int(11) NULL DEFAULT NULL,
  INDEX `id_orden`(`id_orden`) USING BTREE,
  INDEX `id_refaccion`(`cod_refaccion`) USING BTREE,
  CONSTRAINT `tab_ordenrefaccion_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `tab_orden` (`id_orden`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tab_ordenrefaccion
-- ----------------------------
INSERT INTO `tab_ordenrefaccion` VALUES (1, '181019-9', 'JUEGO DE CARBONES CB-1 P/903', 'MAKITA', 120);
INSERT INTO `tab_ordenrefaccion` VALUES (1, '0011806160', 'TORNILLO M6X30 P/RBC411', 'MAKITA', 29);
INSERT INTO `tab_ordenrefaccion` VALUES (1, '001-173-020 ', 'FILTRO DE AIRE INTERIOR P/DPC7000', 'MAKITA', 24);
INSERT INTO `tab_ordenrefaccion` VALUES (11, '0011705200', 'TORNILLO M5X20 P/RBC320', 'MAKITA', 24);
INSERT INTO `tab_ordenrefaccion` VALUES (11, '0011705200', 'TORNILLO M5X20 P/RBC320', 'MAKITA', 24);
INSERT INTO `tab_ordenrefaccion` VALUES (11, '001-131-150 ', 'VALVULA DE DESCOMPRESION', 'MAKITA', 340);
INSERT INTO `tab_ordenrefaccion` VALUES (7, '90552433-01', 'FILTRO PARA ASPIRADORA', 'BLACK & DECKER', 85);
INSERT INTO `tab_ordenrefaccion` VALUES (8, '001-131-150 ', 'VALVULA DE DESCOMPRESION', 'MAKITA', 340);
INSERT INTO `tab_ordenrefaccion` VALUES (8, '001-173-020 ', 'FILTRO DE AIRE INTERIOR P/DPC7000', 'MAKITA', 24);

-- ----------------------------
-- Table structure for tab_ordenservicio
-- ----------------------------
DROP TABLE IF EXISTS `tab_ordenservicio`;
CREATE TABLE `tab_ordenservicio`  (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_orden` int(11) NOT NULL,
  `cod_servicio` int(11) NOT NULL,
  `desc_servicio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `costo_servicio` int(11) NOT NULL,
  PRIMARY KEY (`id_servicio`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tab_ordenservicio
-- ----------------------------
INSERT INTO `tab_ordenservicio` VALUES (1, 1, 1, 'REVISIÓN HERRRAMIENTA', 50);
INSERT INTO `tab_ordenservicio` VALUES (2, 8, 2, 'MANO DE OBRA', 300);
INSERT INTO `tab_ordenservicio` VALUES (3, 8, 1, 'REVISIÓN HERRRAMIENTA', 50);
INSERT INTO `tab_ordenservicio` VALUES (4, 7, 2, 'MANO DE OBRA', 300);
INSERT INTO `tab_ordenservicio` VALUES (8, 7, 1, 'REVISIÓN HERRRAMIENTA', 50);
INSERT INTO `tab_ordenservicio` VALUES (9, 7, 4, 'EJEMPLO DE SERVICIO', 1);
INSERT INTO `tab_ordenservicio` VALUES (10, 11, 1, 'REVISIÓN HERRRAMIENTA', 50);
INSERT INTO `tab_ordenservicio` VALUES (11, 11, 2, 'MANO DE OBRA', 300);

-- ----------------------------
-- Table structure for tab_prestamo
-- ----------------------------
DROP TABLE IF EXISTS `tab_prestamo`;
CREATE TABLE `tab_prestamo`  (
  `id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_herramienta` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `resp_prestamo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `obs_prestamo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fech_salida_prestamo` date NOT NULL,
  `fech_entrada_prestamo` date NOT NULL,
  `status_prestamo` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_prestamo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tab_refaccion
-- ----------------------------
DROP TABLE IF EXISTS `tab_refaccion`;
CREATE TABLE `tab_refaccion`  (
  `id_refaccion` int(11) NOT NULL AUTO_INCREMENT,
  `cod_refaccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc_refaccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `marca_refaccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cant_refaccion` int(11) NOT NULL,
  `costo_refaccion` int(11) NOT NULL,
  PRIMARY KEY (`id_refaccion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tab_refaccion
-- ----------------------------
INSERT INTO `tab_refaccion` VALUES (1, '181019-9', 'JUEGO DE CARBONES CB-1 P/903', 'MAKITA', 1, 100);
INSERT INTO `tab_refaccion` VALUES (2, '001-131-150 ', 'VALVULA DE DESCOMPRESION', 'MAKITA', 0, 340);
INSERT INTO `tab_refaccion` VALUES (3, '001-173-020 ', 'FILTRO DE AIRE INTERIOR P/DPC7000', 'MAKITA', 0, 24);
INSERT INTO `tab_refaccion` VALUES (4, '001118062', 'TUERCA P/DCS6000I,DCS6800I', 'MAKITA', 15, 31);
INSERT INTO `tab_refaccion` VALUES (5, '0011806160', 'TORNILLO M6X30 P/RBC411', 'MAKITA', 5, 29);
INSERT INTO `tab_refaccion` VALUES (6, '0011705200', 'TORNILLO M5X20 P/RBC320', 'MAKITA', 9, 24);
INSERT INTO `tab_refaccion` VALUES (7, '90552433-01', 'FILTRO PARA ASPIRADORA', 'BLACK & DECKER', 1, 85);
INSERT INTO `tab_refaccion` VALUES (8, '370009-00', 'VENTILADOR PARA ASPIRADORA', 'DEWALT', 2, 186);

-- ----------------------------
-- Table structure for tab_servicio
-- ----------------------------
DROP TABLE IF EXISTS `tab_servicio`;
CREATE TABLE `tab_servicio`  (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `cod_servicio` int(11) NOT NULL,
  `desc_servicio` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `costo_servicio` int(11) NOT NULL,
  PRIMARY KEY (`id_servicio`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tab_servicio
-- ----------------------------
INSERT INTO `tab_servicio` VALUES (1, 1, 'REVISIÓN HERRRAMIENTA', 50);
INSERT INTO `tab_servicio` VALUES (2, 2, 'MANO DE OBRA', 300);
INSERT INTO `tab_servicio` VALUES (3, 3, 'LIMPIEZA HERRAMIENTA', 60);
INSERT INTO `tab_servicio` VALUES (4, 4, 'EJEMPLO DE SERVICIO', 1);

-- ----------------------------
-- Table structure for tab_users
-- ----------------------------
DROP TABLE IF EXISTS `tab_users`;
CREATE TABLE `tab_users`  (
  `code_user` int(11) NOT NULL AUTO_INCREMENT,
  `name_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nick_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `priv_user` int(1) NOT NULL,
  `conf_user` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `taller` int(11) NOT NULL,
  PRIMARY KEY (`code_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tab_users
-- ----------------------------
INSERT INTO `tab_users` VALUES (1, 'Administrador', 'CSA', '123', 1, '1-1-1-1-1', 0);
INSERT INTO `tab_users` VALUES (2, 'Armando Rios', 'ARMRIO', '123', 2, '1-1-1-1-1', 0);
INSERT INTO `tab_users` VALUES (3, 'Emmanuel Luna', 'EMMLUN', '123', 3, '1-1-1-1-1', 0);
INSERT INTO `tab_users` VALUES (4, 'BRANDON LECHUGA', 'BRALEC', '123', 1, '1-1-1-1-1', 0);
INSERT INTO `tab_users` VALUES (5, 'Pedro Loza', 'PEDLOZ', '123', 2, '1-1-1-1-1', 0);
INSERT INTO `tab_users` VALUES (6, 'Rafael Garcia', 'RAFGAR', '123', 3, '1-1-1-1-1', 0);

-- ----------------------------
-- Procedure structure for Refacciones
-- ----------------------------
DROP PROCEDURE IF EXISTS `Refacciones`;
delimiter ;;
CREATE PROCEDURE `Refacciones`(IN id INT)
BEGIN
         SELECT R.cod_refaccion, R.desc_refaccion, R.marca_refaccion, R.costo_refaccion FROM tab_ordenrefaccion AS R
JOIN tab_orden AS O
ON R.id_orden = O.id_orden
WHERE O.id_orden = id;
       END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Servicios
-- ----------------------------
DROP PROCEDURE IF EXISTS `Servicios`;
delimiter ;;
CREATE PROCEDURE `Servicios`(IN id INT)
BEGIN
         SELECT S.cod_servicio, S.desc_servicio, S.costo_servicio FROM tab_ordenservicio AS S
JOIN tab_orden AS O
ON S.id_orden = O.id_orden
WHERE O.id_orden = id;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
