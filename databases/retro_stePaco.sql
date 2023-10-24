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
('Nike','2023-10-14 22:53:16','2023-10-14 22:53:16');
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
('Lifestyle','2023-10-14 22:54:09','2023-10-14 22:54:09');
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
(10.00,'2023-10-23 02:16:04','2023-10-23 02:16:04'),
(11.00,'2023-10-23 00:51:31','2023-10-23 00:51:31'),
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sneaker_id`),
  KEY `sneaker_brand_name_foreign` (`brand_name`),
  KEY `sneaker_category_name_foreign` (`category_name`),
  KEY `sneaker_size_number_foreign_idx` (`size_number`),
  CONSTRAINT `sneaker_brand_name_foreign` FOREIGN KEY (`brand_name`) REFERENCES `brand` (`brand_name`),
  CONSTRAINT `sneaker_category_name_foreign` FOREIGN KEY (`category_name`) REFERENCES `category` (`category_name`),
  CONSTRAINT `sneaker_size_number_foreign` FOREIGN KEY (`size_number`) REFERENCES `size` (`size_number`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sneaker`
--

LOCK TABLES `sneaker` WRITE;
/*!40000 ALTER TABLE `sneaker` DISABLE KEYS */;
INSERT INTO `sneaker` VALUES
(59,'Jordan 3','Nike','Lifestyle',20.00,3200.00,'2023-10-23 02:13:36','2023-10-23 02:13:36','2023-10-23 02:25:18'),
(60,'Jordan 3','Nike','Lifestyle',20.00,3200.00,'2023-10-23 02:15:17','2023-10-23 02:15:17','2023-10-24 16:06:13'),
(61,'Jordan 3','Nike','Lifestyle',10.00,3200.00,'2023-10-23 02:16:04','2023-10-23 02:16:04','2023-10-24 16:06:16'),
(62,'Jordan 2','Adidas','Lifestyle',11.00,3200.00,'2023-10-23 02:17:32','2023-10-23 02:17:32',NULL),
(63,'Yeezy 350 ','Adidas','Lifestyle',6.00,4500.00,'2023-10-23 02:29:05','2023-10-23 02:29:05','2023-10-24 16:31:44'),
(64,'Jordan 5','Adidas','Lifestyle',10.00,3200.00,'2023-10-24 16:07:28','2023-10-24 16:07:28',NULL);
/*!40000 ALTER TABLE `sneaker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sneakers`
--

DROP TABLE IF EXISTS `sneakers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sneakers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Modelo` varchar(255) NOT NULL,
  `Marca` varchar(255) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Size` decimal(4,1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sneakers`
--

LOCK TABLES `sneakers` WRITE;
/*!40000 ALTER TABLE `sneakers` DISABLE KEYS */;
INSERT INTO `sneakers` VALUES
(25,'Air Jordan 7','Mike',3230.00,21,6.0),
(26,'Air Jordan 4','Nike',3512.00,43,6.0),
(27,'Air Jordan 20','Nike',3210.00,20,12.0),
(28,'Air Jordan 1','Nike',3200.00,19,10.0),
(29,'Air Jordan 1','Nike',3200.00,20,11.0);
/*!40000 ALTER TABLE `sneakers` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES
(24,59,20.00,20,'2023-10-23 02:13:36','2023-10-23 02:13:36'),
(25,60,20.00,20,'2023-10-23 02:15:17','2023-10-23 02:15:17'),
(26,61,10.00,20,'2023-10-23 02:16:04','2023-10-23 02:16:04'),
(27,62,11.00,12,'2023-10-23 02:17:32','2023-10-23 02:17:32'),
(28,63,6.00,22,'2023-10-23 02:29:05','2023-10-23 02:29:05'),
(29,64,10.00,11,'2023-10-24 16:07:28','2023-10-24 16:07:28');
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
  `rol` int(11) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `rol_roles_foreign` (`rol`),
  CONSTRAINT `rol_roles_foreign` FOREIGN KEY (`rol`) REFERENCES `roles` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'pacoadmin',1,'044a23cadb567653eb51d4eb40acaa88','frodriguez25@ucol.mx','2023-09-10 00:07:25','2023-09-10 00:07:25'),
(3,'vendedor2',2,'044a23cadb567653eb51d4eb40acaa88','vendedor1@gmail.com','2023-10-09 17:12:46','2023-10-09 17:12:46'),
(4,'pacousuario',1,'2754','pacodiego@23m.com','2023-10-20 17:02:36','2023-10-20 17:02:36'),
(5,'usuario',1,'usuario','h11','2023-10-20 17:41:38','2023-10-20 17:41:38');
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

-- Dump completed on 2023-10-24 10:37:04
