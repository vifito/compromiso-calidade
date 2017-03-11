-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: enquisa_2017
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `opcion`
--

DROP TABLE IF EXISTS `opcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta_id` int(11) DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_97486F9631A5801E` (`pregunta_id`),
  CONSTRAINT `FK_97486F9631A5801E` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opcion`
--

LOCK TABLES `opcion` WRITE;
/*!40000 ALTER TABLE `opcion` DISABLE KEYS */;
INSERT INTO `opcion` VALUES (1,9,'Amigos/Familia',32,32,1005,66),(2,9,'Prensa/TV',32,32,1162,66),(3,9,'Internet/Redes sociais',32,32,1404,66),(4,9,'Outros',32,32,1535,66),(5,10,'Comarca de Deza',32,32,1019,201),(6,10,'Provincia Pontevedra',32,32,1238,201),(7,10,'Resto de Galicia',32,32,1417,201),(8,10,'Fóra de Galicia',32,32,1576,201),(9,11,'Sí',32,32,896,340),(10,11,'Non',32,32,1013,340),(11,11,'Ns/Nc',32,32,1130,340),(12,12,'4 (Moi alta)',32,32,889,550),(13,12,'3 (Alta)',32,32,989,550),(14,12,'2 (Normal)',32,32,1089,550),(15,12,'1 (Moi baixa)',32,32,1189,550),(16,13,'4 (Moi bo)',32,32,889,643),(17,13,'3 (Bo)',32,32,989,643),(18,13,'2 (Normal)',32,32,1089,643),(19,13,'1 (Moi mal)',32,32,1189,643),(20,14,'4 (Moi boa)',32,32,889,730),(21,14,'3 (Boa)',32,32,989,730),(22,14,'2 (Normal)',32,32,1089,730),(23,14,'1 (Moi mal)',32,32,1189,730),(24,15,'4 (Moi ben)',32,32,889,821),(25,15,'3 (Ben)',32,32,989,821),(26,15,'2 (Normal)',32,32,1089,821),(27,15,'1 (Moi mal)',32,32,1189,821),(28,16,'4 (Moi boas)',32,32,889,907),(29,16,'3 (Boas)',32,32,989,907),(30,16,'2 (Normal)',32,32,1089,907),(31,16,'1 (Malas/Mellorables)',32,32,1189,907);
/*!40000 ALTER TABLE `opcion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-11 20:13:04
