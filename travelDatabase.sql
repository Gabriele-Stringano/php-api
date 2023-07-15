-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              8.0.30 - MySQL Community Server - GPL
-- S.O. server:                  Win64
-- HeidiSQL Versione:            12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dump della struttura di tabella php_api.country
CREATE TABLE IF NOT EXISTS `country` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dump dei dati della tabella php_api.country: ~6 rows (circa)
INSERT INTO `country` (`Id`, `Name`) VALUES
	(3, 'Brazill'),
	(4, 'Cina'),
	(6, 'Corea'),
	(12, 'Germany'),
	(11, 'Italy'),
	(13, 'Jopon');

-- Dump della struttura di tabella php_api.itinerary
CREATE TABLE IF NOT EXISTS `itinerary` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Country_id` int NOT NULL,
  `Travel_id` int NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_itinerary_country` (`Country_id`),
  KEY `FK_itinerary_travel` (`Travel_id`),
  CONSTRAINT `FK_itinerary_country` FOREIGN KEY (`Country_id`) REFERENCES `country` (`Id`),
  CONSTRAINT `FK_itinerary_travel` FOREIGN KEY (`Travel_id`) REFERENCES `travel` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dump dei dati della tabella php_api.itinerary: ~1 rows (circa)
INSERT INTO `itinerary` (`Id`, `Country_id`, `Travel_id`) VALUES
	(7, 11, 1),
	(8, 13, 1);

-- Dump della struttura di tabella php_api.travel
CREATE TABLE IF NOT EXISTS `travel` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `AvailablePlaces` int DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dump dei dati della tabella php_api.travel: ~2 rows (circa)
INSERT INTO `travel` (`Id`, `AvailablePlaces`) VALUES
	(1, 14);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
