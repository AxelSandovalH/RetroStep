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
use retro_step;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'Administrador','2023-09-09 23:44:41','2023-09-09 23:44:41'),
(2,'Vendedor','2023-09-09 23:45:13','2023-09-09 23:45:13');
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
(8.50,'2023-10-25 23:50:37','2023-10-25 23:50:37'),
(9.00,'2023-10-25 13:26:27','2023-10-25 13:26:27'),
(9.50,'2023-10-25 13:32:49','2023-10-25 13:32:49'),
(10.00,'2023-10-23 02:16:04','2023-10-23 02:16:04'),
(11.00,'2023-10-23 00:51:31','2023-10-23 00:51:31'),
(11.50,'2023-10-25 23:17:37','2023-10-25 23:17:37'),
(20.00,'2023-10-23 00:56:34','2023-10-23 00:56:34');
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
  `size_number` decimal(10,2) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sneaker_id`),
  KEY `sneaker_category_name_foreign` (`category_name`),
  KEY `sneaker_size_number_foreign_idx` (`size_number`),
  KEY `sneaker_brand_name_foreign` (`brand_name`),
  CONSTRAINT `sneaker_brand_name_foreign` FOREIGN KEY (`brand_name`) REFERENCES `brand` (`brand_name`),
  CONSTRAINT `sneaker_category_name_foreign` FOREIGN KEY (`category_name`) REFERENCES `category` (`category_name`),
  CONSTRAINT `sneaker_size_number_foreign` FOREIGN KEY (`size_number`) REFERENCES `size` (`size_number`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sneaker`
--

LOCK TABLES `sneaker` WRITE;
/*!40000 ALTER TABLE `sneaker` DISABLE KEYS */;
INSERT INTO `sneaker` VALUES
(70,'Yeezy 350 ','Adidas','Lifestyle',11.00,3200.00,'../img/','2023-10-25 23:33:31','2023-10-25 23:33:31','2023-10-25 23:41:16'),
(71,'Yeezy 350 1','Adidas','Lifestyle',6.00,3200.00,'../img/','2023-10-25 23:35:42','2023-10-25 23:35:42','2023-10-25 23:35:47'),
(72,'Yeezy 350 2','Adidas','Lifestyle',9.00,3200.00,'img/yeezy350v2.jpg','2023-10-25 23:40:58','2023-10-25 23:40:58',NULL),
(73,'Jordan 1','Nike','Lifestyle',11.00,3202.00,'img/AirJordanOne.png','2023-10-25 23:50:37','2023-10-25 23:50:37',NULL),
(74,'Jordan 2','Nike','Basketball',10.00,3200.00,'img/klpkkgao.png','2023-10-31 18:50:33','2023-10-31 18:50:33',NULL),
(75,'Jordan 1 C','Nike','Basketball',10.00,3300.00,'img/AirJordanOne.png','2023-10-25 23:50:37','2023-10-25 23:50:37','2023-11-12 00:22:34'),
(76,'Jordan 4','Nike','Basketball',6.00,3200.00,'img/klpkkgao.png','2023-11-07 23:17:06','2023-11-07 23:17:06',NULL),
(77,'Yeezy 350 v2','Adidas','Lifestyle',6.00,3200.00,'img/yeezy350v2.jpg','2023-11-07 23:22:06','2023-11-07 23:22:06','2023-11-08 22:16:25'),
(78,'Jordan 1 TS','Nike','Lifestyle',6.00,3200.00,'img/Jordan1_Travis.jpeg','2023-11-07 23:26:37','2023-11-07 23:26:37','2023-11-08 16:07:33'),
(113,'Jordan 5','Nike','Basketball',9.50,3200.00,'img/img01.jpg','2023-11-10 13:35:44','2023-11-10 13:35:44',NULL),
(120,'Jordan 1 TS','Nike','Basketball',9.50,3200.00,'img/Jordan1_Travis.jpeg','2023-11-10 18:57:48','2023-11-10 18:57:48',NULL);
/*!40000 ALTER TABLE `sneaker` ENABLE KEYS */;
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
  PRIMARY KEY (`id_stock`),
  KEY `stock_sneaker_id_foreign_idx` (`sneaker_id`),
  KEY `stock_size_number_foreign_idx` (`size_number`),
  CONSTRAINT `stock_size_number_foreign` FOREIGN KEY (`size_number`) REFERENCES `size` (`size_number`),
  CONSTRAINT `stock_sneaker_id_foreign` FOREIGN KEY (`sneaker_id`) REFERENCES `sneaker` (`sneaker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES
(35,70,11.00,67,'2023-10-25 23:33:31','2023-10-25 23:33:31'),
(36,71,6.00,67,'2023-10-25 23:35:42','2023-10-25 23:35:42'),
(37,72,9.00,67,'2023-10-25 23:40:58','2023-10-25 23:40:58'),
(38,73,11.00,61,'2023-10-25 23:50:37','2023-10-25 23:50:37'),
(39,74,10.00,32,'2023-10-31 18:50:33','2023-10-31 18:50:33'),
(40,75,10.00,32,'2023-10-25 23:50:37','2023-10-25 23:50:37'),
(41,76,6.00,12,'2023-11-07 23:17:06','2023-11-07 23:17:06'),
(42,77,6.00,12,'2023-11-07 23:22:06','2023-11-07 23:22:06'),
(43,78,6.00,12,'2023-11-07 23:26:37','2023-11-07 23:26:37'),
(45,113,9.50,32,'2023-11-10 13:35:44','2023-11-10 13:35:44'),
(52,120,9.50,12,'2023-11-10 18:57:48','2023-11-10 18:57:48');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(8,'pacouser',2,'044a23cadb567653eb51d4eb40acaa88','pacouser@gmail.com','2023-11-02 22:28:53','2023-11-02 22:28:53','2023-11-12 00:32:07');
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

-- Dump completed on 2023-11-11 20:09:50
