-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.33 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para shopping_info
CREATE DATABASE IF NOT EXISTS `shopping_info` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;
USE `shopping_info`;

-- Volcando estructura para tabla shopping_info.compras
CREATE TABLE IF NOT EXISTS `compras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cedula` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `plan_pago` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `niveles_id` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `planes_id` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `vendedores_id` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `representante` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `registro` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tomo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `year` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `persona` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `band` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla shopping_info.compras: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` (`id`, `cedula`, `nombre`, `email`, `telefono`, `plan_pago`, `niveles_id`, `planes_id`, `vendedores_id`, `fecha`, `representante`, `registro`, `numero`, `tomo`, `year`, `persona`, `band`) VALUES
	(1, '20025623', 'Yonathan Castillo', 'leothan522@gmail.com', '04243386600', '6 meses', '1', '2', '', '2022-08-29', 'yonathan castillo', 'registro', '25', '2', '2022', 'Persona Natural', 1);
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;

-- Volcando estructura para tabla shopping_info.niveles
CREATE TABLE IF NOT EXISTS `niveles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `band` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla shopping_info.niveles: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `niveles` DISABLE KEYS */;
INSERT INTO `niveles` (`id`, `nombre`, `band`) VALUES
	(1, 'NIVEL BÁLTICO I', 1),
	(2, 'NIVEL MEDITERRANEO', 1),
	(3, 'NIVEL CARIBE', 1),
	(4, 'NIVEL ATLANTICO', 1),
	(5, 'NIVEL PACIFICO', 1);
/*!40000 ALTER TABLE `niveles` ENABLE KEYS */;

-- Volcando estructura para tabla shopping_info.planes
CREATE TABLE IF NOT EXISTS `planes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_firma` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `marketing` text COLLATE utf8_spanish_ci,
  `design` text COLLATE utf8_spanish_ci,
  `promocion_calle` text COLLATE utf8_spanish_ci,
  `promocion_digital` text COLLATE utf8_spanish_ci,
  `capacidad` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `niveles_id` bigint(20) unsigned DEFAULT NULL,
  `band` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_planes_niveles` (`niveles_id`),
  CONSTRAINT `FK_planes_niveles` FOREIGN KEY (`niveles_id`) REFERENCES `niveles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla shopping_info.planes: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `planes` DISABLE KEYS */;
INSERT INTO `planes` (`id`, `tipo`, `precio_firma`, `marketing`, `design`, `promocion_calle`, `promocion_digital`, `capacidad`, `niveles_id`, `band`) VALUES
	(1, 'Mini tienda Estandar', '$162', 'Revisión 1 Propuesta  ', 'Revisión 1 Propuesta  ', '1 evento Material gráfico y muestra de productos e insumos por cuenta del locatario.', '1 Promoción mensual digital', '1 - 5', 1, 1),
	(2, 'Mini tienda Medium', '$270', 'Evaluación de estrategia 2 propuestas comercializacion 1 propuesta de promoción ', 'Revisión y Evaluación de imagen 2 propuestas  1 refrescamiento Logo  ', '2 eventos en corredores de consumo Material gráfico y muestra de productos e insumos por cuenta del locatario.', '2 Promoción mensual en plataformas digital', '8 -12', 1, 1),
	(3, 'Mini tienda Premium', '$387', 'Evaluación de estrategia 3 propuestas comercializacion 2 propuesta de promoción ', 'Revisión y Evaluación  3 propuestas 1 refrescamiento Logo. 1 refrescamiento Imagen ', '3 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '3 Promoción mensual digital', '14 - 20', 1, 1),
	(4, 'Tiendas Medium', '$486', 'Revisión y Evaluación  2 propuestas  1 propuesta de promoción ', 'Revisión Evaluación  2 propuestas 1 refrescamiento Logo  ', '2 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '2 Promoción mensual digital', '22 - 30', 2, 1),
	(5, 'Tiendas Premium', '$549', 'Revisión Evaluación 4 propuestas 3 propuesta de promoción', 'Revisión Evaluación  4 propuestas 1 refrescamiento Logo. 1 refrescamiento Imagen ', '3 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '3 Promoción mensual digital', '32 - 40', 2, 1),
	(6, 'Tiendas Medium', '$648', 'Revisión Evaluación  2 propuestas  1 propuesta de promoción ', 'Revisión Evaluación  2 propuestas 1 refrescamiento Logo  ', '2 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '2 Promoción mensual digital', '44 - 50', 3, 1),
	(7, 'Tiendas  Premium', '$765', 'Revisión Evaluación  4 propuestas  3 propuesta de promoción', 'Revisión Evaluación  4 propuestas 1 refrescamiento Logo. 1 refrescamiento Imagen ', '3 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '3 Promoción mensual digital', '55 - 70', 3, 1),
	(8, 'Tiendas  Premium', '$900', 'Revisión Evaluación  4 propuestas  3 propuesta de promoción', 'Revisión Evaluación  4 propuestas 1 refrescamiento Logo. 1 refrescamiento Imagen ', '3 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '3 Promoción mensual digital', '150 -250', 4, 1),
	(9, 'Tienda Especializada AAA', '$3.600', 'Revisión Evaluación  4 propuestas  3 propuesta de promoción', 'Revisión Evaluación  4 propuestas 1 refrescamiento Logo. 1 refrescamiento Imagen ', 'Todos los  evento  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '3 Promoción mensual digital', '300 -400', 5, 1);
/*!40000 ALTER TABLE `planes` ENABLE KEYS */;

-- Volcando estructura para tabla shopping_info.precios
CREATE TABLE IF NOT EXISTS `precios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `planes_id` bigint(20) unsigned NOT NULL,
  `mes` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `precio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ahorro` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pagar_total` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pago_mes` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_precios_planes` (`planes_id`),
  CONSTRAINT `FK_precios_planes` FOREIGN KEY (`planes_id`) REFERENCES `planes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla shopping_info.precios: ~34 rows (aproximadamente)
/*!40000 ALTER TABLE `precios` DISABLE KEYS */;
INSERT INTO `precios` (`id`, `planes_id`, `mes`, `precio`, `ahorro`, `pagar_total`, `pago_mes`) VALUES
	(1, 1, '1 mes', '$60,00', NULL, '$60,00', '$60,00'),
	(2, 1, '3 meses', '$180,00', '25%', '$135,00', '$45,00'),
	(3, 1, '6 meses', '$360,00', '15%', '$306,00', '$51,00'),
	(4, 1, '12 meses', '$720,00', '10%', '$648,00', '$54,00'),
	(5, 2, '1 mes', '$120,00', NULL, '$120,00', '$120,00'),
	(6, 2, '3 meses', '$360,00', '25%', '$270,00', '$90,00'),
	(7, 2, '6 meses', '$720,00', '15%', '$612,00', '$102,00'),
	(8, 2, '12 meses', '$1.440,00', '10%', '$1.296,00', '$108,00'),
	(9, 3, '1 mes', '$180,00', NULL, '$180,00', '$180,00'),
	(10, 3, '3 meses', '$540,00', '25%', '$405,00', '$135,00'),
	(11, 3, '6 meses', '$1.080,00', '15%', '$918,00', '$153,00'),
	(12, 3, '12 meses', '$2.160,00', '10%', '$1.944,00', '$162,00'),
	(13, 4, '1 meses', '$260,00', NULL, '$260,00', '$260,00'),
	(14, 4, '3 meses', '$780,00', '10%', '$702,00', '$234,00'),
	(15, 4, '6 meses', '$1.560,00', '25%', '$1.170,00', '$195'),
	(16, 4, '12 meses', '$3.120,00', '15%', '$2.652,00', '$221,00'),
	(17, 5, '1 meses', '$300,00', NULL, '$300,00', '$300,00'),
	(18, 5, '3 meses', '$900,00', '10%', '$810,00', '$270,00'),
	(19, 5, '6 meses', '$1.800,00', '25%', '$1.350,00', '$225,00'),
	(20, 5, '12 meses', '$3.600,00', '15%', '$3.060,00', '$255,00'),
	(21, 6, '1 mes', '$340,00', NULL, '$340,00', '$340,00'),
	(22, 6, '3 meses', '$1020,00', '10%', '$918,00', '$306,00'),
	(23, 6, '6 meses', '$2.040,00', '15%', '$1.734,00', '$289,00'),
	(24, 6, '12 meses', '$4.080,00', '25%', '$3.060,00', '$255,00'),
	(25, 7, '1 mes', '$380,00', NULL, '$380,00', '$380,00'),
	(26, 7, '3 meses', '$1140,00', '10%', '$1026,00', '$342,00'),
	(27, 7, '6 meses', '$2.280,00', '15%', '$1.938,00', '$323,00'),
	(28, 7, '12 meses', '$4.560,00', '25%', '$3.420,00', '$285,00'),
	(29, 8, '1 mes', '$500,00', NULL, '$500,00', '$500,00'),
	(30, 8, '3 meses', '$1500,00', '10%', '$1350,00', '$450,00'),
	(31, 8, '6 meses', '$3.000,00', '15%', '$2.550,00', '$425,00'),
	(32, 8, '12 meses', '$6.000,00', '25%', '$4.500,00', '$375,00'),
	(33, 9, '1 mes', '$1.000,00', NULL, '$1.000,00', '$1.000,00'),
	(34, 9, '3 meses', '$3000,00', '10%', '$2700,00', '$900,00'),
	(35, 9, '6 meses', '$6.000,00', '15%', '$5.100,00', '$850,00'),
	(36, 9, '12 meses', '$12.000,00', '25%', '$9.000,00', '$750,00');
/*!40000 ALTER TABLE `precios` ENABLE KEYS */;

-- Volcando estructura para tabla shopping_info.vendedores
CREATE TABLE IF NOT EXISTS `vendedores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla shopping_info.vendedores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
