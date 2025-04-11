/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `crud_aprendices` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `crud_aprendices`;

CREATE TABLE IF NOT EXISTS `aprendices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_persona` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_aprendices_personas` (`id_persona`),
  CONSTRAINT `FK_aprendices_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `aprendices_programa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_aprendiz` int NOT NULL,
  `id_programa_ficha` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__aprendices` (`id_aprendiz`),
  KEY `FK__programas_fichas` (`id_programa_ficha`),
  CONSTRAINT `FK__aprendices` FOREIGN KEY (`id_aprendiz`) REFERENCES `aprendices` (`id`),
  CONSTRAINT `FK__programas_fichas` FOREIGN KEY (`id_programa_ficha`) REFERENCES `programas_fichas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `factores_sanguineos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `factor` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `factores_sanguineos` (`id`, `factor`) VALUES
	(1, '+'),
	(2, '-');

CREATE TABLE IF NOT EXISTS `grupos_sanguineos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grupo` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `grupos_sanguineos` (`id`, `grupo`) VALUES
	(1, 'A'),
	(2, 'B'),
	(3, 'AB'),
	(4, 'O');

CREATE TABLE IF NOT EXISTS `personas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) DEFAULT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id_tipo_documento` int NOT NULL DEFAULT '0',
  `n_documento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_g_sanguineo` int NOT NULL DEFAULT '0',
  `id_f_sanguineo` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `n_documento` (`n_documento`),
  KEY `FK_aprendices_tipos_documento` (`id_tipo_documento`),
  KEY `FK_aprendices_grupos_sanguineos` (`id_g_sanguineo`),
  KEY `FK_aprendices_factores_sanguineos` (`id_f_sanguineo`),
  CONSTRAINT `FK_aprendices_factores_sanguineos` FOREIGN KEY (`id_f_sanguineo`) REFERENCES `factores_sanguineos` (`id`),
  CONSTRAINT `FK_aprendices_grupos_sanguineos` FOREIGN KEY (`id_g_sanguineo`) REFERENCES `grupos_sanguineos` (`id`),
  CONSTRAINT `FK_aprendices_tipos_documento` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipos_documento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `programas_fichas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_programa` int NOT NULL,
  `fecha_inicio` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__programas_formacion` (`id_programa`),
  CONSTRAINT `FK__programas_formacion` FOREIGN KEY (`id_programa`) REFERENCES `programas_formacion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `programas_formacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `programa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_tipo_programa` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_programas_formacion_tipos_programas` (`id_tipo_programa`),
  CONSTRAINT `FK_programas_formacion_tipos_programas` FOREIGN KEY (`id_tipo_programa`) REFERENCES `tipos_programas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `tipos_documento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tipos_documento` (`id`, `tipo`) VALUES
	(1, 'CÉDULA DE CIUDADANÍA'),
	(2, 'TARJETA DE IDENTIDAD'),
	(3, 'REGISTRO CIVIL '),
	(4, 'CÉDULA DE EXTRANJERÍA'),
	(5, 'PASAPORTE'),
	(6, 'PEP'),
	(7, 'DIE');

CREATE TABLE IF NOT EXISTS `tipos_programas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
