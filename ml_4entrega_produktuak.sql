-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: ml_4entrega
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `produktuak`
--

DROP TABLE IF EXISTS `produktuak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produktuak` (
  `ProduktuID` int NOT NULL AUTO_INCREMENT,
  `Izena` varchar(100) NOT NULL,
  `Mota` varchar(50) NOT NULL,
  `Prezioa` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ProduktuID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produktuak`
--

LOCK TABLES `produktuak` WRITE;
/*!40000 ALTER TABLE `produktuak` DISABLE KEYS */;
INSERT INTO `produktuak` VALUES (1,'iPhone 14','Telefonoa',999.99),(2,'Samsung Galaxy S23','Telefonoa',799.99),(3,'Google Pixel 7','Telefonoa',599.99),(4,'iPad Pro','Tableta',1099.99),(5,'Samsung Galaxy Tab S8','Tableta',699.99),(6,'Amazon Fire HD 10','Tableta',149.99),(7,'Dell XPS 13','Ordenagailua',1299.99),(8,'MacBook Air M2','Ordenagailua',1199.99),(9,'Lenovo ThinkPad X1 Carbon','Ordenagailua',1399.99),(10,'LG OLED C2 55\"','Telebista',1299.99),(11,'Samsung QN90A 50\"','Telebista',999.99),(12,'Sony A80J OLED 65\"','Telebista',1799.99),(13,'Sony WH-1000XM5','Aurikularrak',349.99),(14,'Bose QuietComfort 45','Aurikularrak',329.99),(15,'Apple AirPods Pro','Aurikularrak',249.99),(16,'JBL Flip 6','Bozgorailua',129.99),(17,'Sonos One SL','Bozgorailua',199.99),(18,'Marshall Emberton II','Bozgorailua',179.99),(19,'Canon EOS R6','Kamera',2499.99),(20,'Sony Alpha a7 IV','Kamera',2799.99),(21,'Nikon Z6 II','Kamera',1999.99),(22,'Amazon Echo Dot (5th Gen)','Smart Device',49.99),(23,'Google Nest Hub','Smart Device',99.99),(24,'Apple HomePod Mini','Smart Device',99.99),(25,'Apple Watch Series 8','Smart Watch',399.99),(26,'Samsung Galaxy Watch 5','Smart Watch',279.99),(27,'Garmin Fenix 7','Smart Watch',699.99),(28,'Xbox Wireless Controller','Gamepad',59.99),(29,'Sony DualSense','Gamepad',69.99),(30,'Nintendo Switch Pro Controller','Gamepad',69.99);
/*!40000 ALTER TABLE `produktuak` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-26 11:49:29
