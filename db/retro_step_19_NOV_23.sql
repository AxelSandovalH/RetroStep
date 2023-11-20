-- MariaDB dump 10.19-11.1.2-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: retro_step
-- ------------------------------------------------------
-- Server version	11.1.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand` (
  `brand_name` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`brand_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES
('Adidas','2023-10-15 02:02:42','2023-10-15 02:02:42'),
('Asics','2023-10-26 22:22:05','2023-10-26 22:22:05'),
('Charly','2023-10-26 22:24:04','2023-10-26 22:24:04'),
('DiegoKicks','2023-11-19 17:09:41','2023-11-19 17:09:41'),
('New Balance','2023-10-25 13:32:49','2023-10-25 13:32:49'),
('Nike','2023-10-14 22:53:16','2023-10-14 22:53:16'),
('Panam','2023-11-06 13:55:59','2023-11-06 13:55:59'),
('Pirma','2023-10-26 22:18:19','2023-10-26 22:18:19'),
('Puma','2023-10-25 13:26:27','2023-10-25 13:26:27');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES
('Basketball','2023-10-25 13:26:27','2023-10-25 13:26:27'),
('Lifestyle','2023-10-14 22:54:09','2023-10-14 22:54:09'),
('Tennis','2023-11-06 01:43:29','2023-11-06 01:43:29');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `rol_name` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'Admin','2023-09-09 23:44:41','2023-09-09 23:44:41'),
(2,'User','2023-09-09 23:45:13','2023-09-09 23:45:13');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `size`
--

DROP TABLE IF EXISTS `size`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `size` (
  `size_number` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`size_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `size`
--

LOCK TABLES `size` WRITE;
/*!40000 ALTER TABLE `size` DISABLE KEYS */;
INSERT INTO `size` VALUES
(6.00,'2023-10-23 02:29:05','2023-10-23 02:29:05'),
(6.50,'2023-11-20 06:03:28','2023-11-20 06:03:28'),
(7.00,'2023-11-20 06:03:50','2023-11-20 06:03:50'),
(7.50,'2023-11-20 06:04:15','2023-11-20 06:04:15'),
(8.00,'2023-11-20 06:04:33','2023-11-20 06:04:33'),
(8.50,'2023-10-25 23:50:37','2023-10-25 23:50:37'),
(9.00,'2023-10-25 13:26:27','2023-10-25 13:26:27'),
(9.50,'2023-10-25 13:32:49','2023-10-25 13:32:49'),
(10.00,'2023-10-23 02:16:04','2023-10-23 02:16:04'),
(10.50,'2023-11-20 06:05:37','2023-11-20 06:05:37'),
(11.00,'2023-10-23 00:51:31','2023-10-23 00:51:31'),
(11.50,'2023-10-25 23:17:37','2023-10-25 23:17:37'),
(12.00,'2023-11-20 06:05:45','2023-11-20 06:05:45'),
(12.50,'2023-11-20 06:05:48','2023-11-20 06:05:48'),
(13.00,'2023-11-20 06:05:51','2023-11-20 06:05:51');
/*!40000 ALTER TABLE `size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sneaker`
--

DROP TABLE IF EXISTS `sneaker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sneaker` (
  `sneaker_id` int(10) NOT NULL AUTO_INCREMENT,
  `sneaker_name` varchar(35) NOT NULL,
  `brand_name` varchar(15) NOT NULL,
  `category_name` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sneaker_id`),
  KEY `sneaker_category_name_foreign` (`category_name`),
  KEY `sneaker_brand_name_foreign` (`brand_name`),
  CONSTRAINT `sneaker_brand_name_foreign` FOREIGN KEY (`brand_name`) REFERENCES `brand` (`brand_name`),
  CONSTRAINT `sneaker_category_name_foreign` FOREIGN KEY (`category_name`) REFERENCES `category` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sneaker`
--

LOCK TABLES `sneaker` WRITE;
/*!40000 ALTER TABLE `sneaker` DISABLE KEYS */;
INSERT INTO `sneaker` VALUES
(146,'Yeezy 350 V2 Bred','Adidas','Lifestyle',4500.00,'img/yeezy350v2.png','2023-11-20 05:57:28','2023-11-20 05:57:28',NULL),
(147,'Blazer Low Triple Black','Nike','Lifestyle',2300.00,'img/blazerNegro.jpg','2023-11-20 06:00:50','2023-11-20 06:00:50',NULL),
(148,'Air Force 1 Low BW','Nike','Lifestyle',3000.00,'img/airForceOneLowbw.jpg','2023-11-20 06:08:38','2023-11-20 06:08:38',NULL),
(149,'Puma Suede Black','Puma','Lifestyle',2400.00,'img/puma suede blck.png','2023-11-20 06:10:49','2023-11-20 06:10:49',NULL);
/*!40000 ALTER TABLE `sneaker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sneaker_size`
--

DROP TABLE IF EXISTS `sneaker_size`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sneaker_size` (
  `sneaker_id` int(10) NOT NULL,
  `size_number` decimal(10,2) NOT NULL,
  PRIMARY KEY (`size_number`,`sneaker_id`),
  CONSTRAINT `sneaker_size_ibfk_2` FOREIGN KEY (`size_number`) REFERENCES `size` (`size_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sneaker_size`
--

LOCK TABLES `sneaker_size` WRITE;
/*!40000 ALTER TABLE `sneaker_size` DISABLE KEYS */;
INSERT INTO `sneaker_size` VALUES
(147,6.00),
(149,6.50),
(149,7.00),
(149,7.50),
(149,8.00),
(146,8.50),
(146,9.00),
(146,9.50),
(147,9.50),
(147,10.00),
(148,10.50),
(148,11.00),
(147,11.50),
(148,12.00),
(148,13.00);
/*!40000 ALTER TABLE `sneaker_size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `sneaker_id` int(10) NOT NULL,
  `size_number` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_stock`),
  KEY `stock_sneaker_id_foreign_idx` (`sneaker_id`),
  KEY `stock_size_number_foreign_idx` (`size_number`),
  CONSTRAINT `stock_size_number_foreign` FOREIGN KEY (`size_number`) REFERENCES `size` (`size_number`),
  CONSTRAINT `stock_sneaker_id_foreign` FOREIGN KEY (`sneaker_id`) REFERENCES `sneaker` (`sneaker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES
(1,146,8.50,40,'2023-11-20 05:57:28','2023-11-20 05:57:28','2023-11-20 13:17:53'),
(2,146,9.00,40,'2023-11-20 05:57:28','2023-11-20 05:57:28',NULL),
(3,146,9.50,40,'2023-11-20 05:57:28','2023-11-20 05:57:28',NULL),
(4,147,6.00,80,'2023-11-20 06:00:50','2023-11-20 06:00:50',NULL),
(5,147,9.50,80,'2023-11-20 06:00:50','2023-11-20 06:00:50',NULL),
(6,147,10.00,80,'2023-11-20 06:00:50','2023-11-20 06:00:50','2023-11-20 13:17:56'),
(7,147,11.50,80,'2023-11-20 06:00:50','2023-11-20 06:00:50',NULL),
(8,148,10.50,78,'2023-11-20 06:08:38','2023-11-20 06:08:38',NULL),
(9,148,11.00,78,'2023-11-20 06:08:38','2023-11-20 06:08:38',NULL),
(10,148,12.00,78,'2023-11-20 06:08:38','2023-11-20 06:08:38',NULL),
(11,148,13.00,78,'2023-11-20 06:08:38','2023-11-20 06:08:38',NULL),
(12,149,6.50,45,'2023-11-20 06:10:49','2023-11-20 06:10:49',NULL),
(13,149,7.00,45,'2023-11-20 06:10:49','2023-11-20 06:10:49',NULL),
(14,149,7.50,45,'2023-11-20 06:10:49','2023-11-20 06:10:49',NULL),
(15,149,8.00,45,'2023-11-20 06:10:49','2023-11-20 06:10:49',NULL);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `rol` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_roles_foreign` (`rol`),
  CONSTRAINT `rol_roles_foreign` FOREIGN KEY (`rol`) REFERENCES `roles` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'pacoadmin',1,'044a23cadb567653eb51d4eb40acaa88','frodriguez25@ucol.mx','2023-09-10 00:07:25','2023-09-10 00:07:25',NULL),
(3,'vendedor2',2,'044a23cadb567653eb51d4eb40acaa88','vendedor1@gmail.com','2023-10-09 17:12:46','2023-10-09 17:12:46',NULL),
(7,'ProfeUser',1,'044a23cadb567653eb51d4eb40acaa88','profe@gmail.com','2023-10-31 17:33:27','2023-10-31 17:33:27',NULL),
(9,'ewt',1,'764faf06be097ea1007776f48318a31f','wtrw','2023-11-17 04:38:33','2023-11-17 04:38:33',NULL),
(10,'ewtqrfwexa',1,'3cf384e58f84503cbfa247d58554ecb6','wtrwerfe','2023-11-17 04:38:39','2023-11-17 04:38:39',NULL),
(11,'ewtqrfweqrq',2,'084852b4cb1cd09cf926b19da43185fc','d1','2023-11-17 04:38:51','2023-11-17 04:38:51','2023-11-17 14:09:50'),
(12,'hola',1,'044a23cadb567653eb51d4eb40acaa88','1323','2023-11-17 16:18:46','2023-11-17 16:18:46',NULL),
(13,'pacousuario',2,'044a23cadb567653eb51d4eb40acaa88','pacouser@gmail.com','2023-11-17 17:51:26','2023-11-17 17:51:26',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-20  0:21:20
