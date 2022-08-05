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
CREATE DATABASE IF NOT EXISTS `shopping_info` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `shopping_info`;

-- Volcando estructura para tabla shopping_info.compras
CREATE TABLE IF NOT EXISTS `compras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `plan_pago` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `niveles_id` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `planes_id` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `vendedores_id` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `band` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla shopping_info.compras: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
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
INSERT INTO `planes` (`id`, `tipo`, `marketing`, `design`, `promocion_calle`, `promocion_digital`, `capacidad`, `niveles_id`, `band`) VALUES
	(1, 'Mini tienda Estandar', 'Revisión 1 Propuesta  ', 'Revisión 1 Propuesta  ', '1 evento Material gráfico y muestra de productos e insumos por cuenta del locatario.', '1 Promoción mensual digital', '1 - 5', 1, 1),
	(2, 'Mini tienda Medium', 'Evaluación de estrategia 2 propuestas comercializacion 1 propuesta de promoción ', 'Revisión y Evaluación de imagen 2 propuestas  1 refrescamiento Logo  ', '2 eventos en corredores de consumo Material gráfico y muestra de productos e insumos por cuenta del locatario.', '2 Promoción mensual en plataformas digital', '8 -12', 1, 1),
	(3, 'Mini tienda Premium', 'Evaluación de estrategia 3 propuestas comercializacion 2 propuesta de promoción ', 'Revisión y Evaluación  3 propuestas 1 refrescamiento Logo. 1 refrescamiento Imagen ', '3 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '3 Promoción mensual digital', '14 - 20', 1, 1),
	(4, 'Tiendas Medium', 'Revisión y Evaluación  2 propuestas  1 propuesta de promoción ', 'Revisión Evaluación  2 propuestas 1 refrescamiento Logo  ', '2 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '2 Promoción mensual digital', '22 - 30', 2, 1),
	(5, 'Tiendas Premium', 'Revisión Evaluación 4 propuestas 3 propuesta de promoción', 'Revisión Evaluación  4 propuestas 1 refrescamiento Logo. 1 refrescamiento Imagen ', '3 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '3 Promoción mensual digital', '32 - 40', 2, 1),
	(6, 'Tiendas Medium', 'Revisión Evaluación  2 propuestas  1 propuesta de promoción ', 'Revisión Evaluación  2 propuestas 1 refrescamiento Logo  ', '2 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '2 Promoción mensual digital', '44 - 50', 3, 1),
	(7, 'Tiendas  Premium', 'Revisión Evaluación  4 propuestas  3 propuesta de promoción', 'Revisión Evaluación  4 propuestas 1 refrescamiento Logo. 1 refrescamiento Imagen ', '3 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '3 Promoción mensual digital', '55 - 70', 3, 1),
	(8, 'Tiendas  Premium', 'Revisión Evaluación  4 propuestas  3 propuesta de promoción', 'Revisión Evaluación  4 propuestas 1 refrescamiento Logo. 1 refrescamiento Imagen ', '3 eventos  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '3 Promoción mensual digital', '150 -250', 4, 1),
	(9, 'Tienda Especializada AAA', 'Revisión Evaluación  4 propuestas  3 propuesta de promoción', 'Revisión Evaluación  4 propuestas 1 refrescamiento Logo. 1 refrescamiento Imagen ', 'Todos los  evento  Material gráfico y muestra de productos e insumos por cuenta del locatario.', '3 Promoción mensual digital', '300 -400', 5, 1);
/*!40000 ALTER TABLE `planes` ENABLE KEYS */;

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
