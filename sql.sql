-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: petbook
-- ------------------------------------------------------
-- Server version	5.6.24

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
-- Table structure for table `adopcion`
--

DROP TABLE IF EXISTS `adopcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adopcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `concretado` tinyint(4) DEFAULT '0',
  `informado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `adopcion_ibfk_1` (`id_usuario`),
  KEY `adopcion_ibfk_2` (`id_mascota`),
  CONSTRAINT `adopcion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  CONSTRAINT `adopcion_ibfk_2` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adopcion`
--

LOCK TABLES `adopcion` WRITE;
/*!40000 ALTER TABLE `adopcion` DISABLE KEYS */;
INSERT INTO `adopcion` VALUES (11,1,6,'2017-06-21 00:23:43','2017-06-20 23:44:53',1,1);
/*!40000 ALTER TABLE `adopcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apto_adopcion`
--

DROP TABLE IF EXISTS `apto_adopcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apto_adopcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mascota` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `concretado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `apto_adopcion_ibfk_1` (`id_mascota`),
  CONSTRAINT `apto_adopcion_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apto_adopcion`
--

LOCK TABLES `apto_adopcion` WRITE;
/*!40000 ALTER TABLE `apto_adopcion` DISABLE KEYS */;
INSERT INTO `apto_adopcion` VALUES (9,6,'2017-06-21 00:09:49','2017-06-20 21:47:00',1),(10,5,'2017-06-21 00:01:35','2017-06-21 00:01:35',0);
/*!40000 ALTER TABLE `apto_adopcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apto_cita`
--

DROP TABLE IF EXISTS `apto_cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apto_cita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mascota` int(11) NOT NULL,
  `id_raza` smallint(6) DEFAULT NULL,
  `tamanio` int(11) DEFAULT NULL,
  `radio_km` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `concretado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_raza` (`id_raza`),
  KEY `id_mascota` (`id_mascota`),
  CONSTRAINT `apto_cita_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`),
  CONSTRAINT `apto_cita_ibfk_2` FOREIGN KEY (`id_raza`) REFERENCES `raza` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apto_cita`
--

LOCK TABLES `apto_cita` WRITE;
/*!40000 ALTER TABLE `apto_cita` DISABLE KEYS */;
INSERT INTO `apto_cita` VALUES (1,5,7,NULL,NULL,'2017-06-17 20:20:33','2017-06-17 19:37:55',1),(2,5,6,NULL,NULL,'2017-06-17 20:21:36','2017-06-17 20:21:36',0),(3,7,1,NULL,NULL,'2017-06-18 00:27:10','2017-06-17 20:32:25',1),(4,7,1,NULL,NULL,'2017-06-18 04:08:40','2017-06-18 01:03:56',1),(5,6,1,NULL,NULL,'2017-06-18 03:34:23','2017-06-18 02:35:03',1),(6,7,1,NULL,NULL,'2017-06-18 04:25:57','2017-06-18 04:09:48',1),(7,7,1,NULL,NULL,'2017-06-20 18:15:32','2017-06-18 04:29:12',1),(11,6,3,NULL,NULL,'2017-06-20 21:48:14','2017-06-20 21:48:14',0),(12,7,1,NULL,NULL,'2017-06-20 22:12:32','2017-06-20 22:12:32',0);
/*!40000 ALTER TABLE `apto_cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mascota` int(11) NOT NULL,
  `id_mascota2` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `concretado` tinyint(4) DEFAULT '0',
  `informado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` VALUES (1,5,7,'2017-06-20 18:17:59','2017-06-17 20:50:24',1,1),(3,5,7,'2017-06-20 18:17:59','2017-06-18 01:19:57',1,1),(4,5,6,'2017-06-18 03:34:43','2017-06-18 03:27:45',1,1),(6,5,7,'2017-06-20 18:17:59','2017-06-18 04:02:51',1,1),(7,5,7,'2017-06-20 18:17:59','2017-06-18 04:07:44',1,1),(8,5,7,'2017-06-20 18:17:59','2017-06-18 04:25:12',1,1),(9,5,7,'2017-06-20 18:17:59','2017-06-20 18:02:52',1,1);
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mascota` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comentario_FK1_idx` (`id_mascota`),
  KEY `comentario_FK1_idx1` (`id_post`),
  CONSTRAINT `comentario_FK1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `comentario_FK2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
INSERT INTO `comentario` VALUES (1,5,3,'hola loquito','2017-05-25 21:48:49','2017-05-25 21:48:49'),(2,5,11,'Hola gordo','2017-05-25 21:55:39','2017-05-25 21:55:39'),(3,5,3,'Hola maestro','2017-05-25 22:28:33','2017-05-25 22:28:33'),(4,5,3,'Hola loco Lindo!','2017-05-25 22:52:43','2017-05-25 22:52:43'),(6,5,12,'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años,','2017-05-25 23:07:09','2017-05-25 23:07:09'),(7,5,13,'No se que decir viste....','2017-05-26 00:02:06','2017-05-26 00:02:06'),(8,6,16,'Prueba','2017-05-26 00:09:33','2017-05-26 00:09:33'),(9,7,18,'si señor','2017-05-26 00:09:48','2017-05-26 00:09:48'),(10,5,13,'Segundo que va','2017-05-27 20:05:27','2017-05-27 20:05:27'),(11,5,16,'test','2017-05-27 23:10:13','2017-05-27 23:10:13'),(12,5,18,':)','2017-05-28 18:45:54','2017-05-28 18:45:54'),(13,6,14,'hola amigo','2017-05-28 20:49:00','2017-05-28 20:49:00'),(14,14,16,'que guapo!!','2017-06-24 23:10:09','2017-06-24 23:10:09');
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foto`
--

DROP TABLE IF EXISTS `foto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foto`
--

LOCK TABLES `foto` WRITE;
/*!40000 ALTER TABLE `foto` DISABLE KEYS */;
INSERT INTO `foto` VALUES (2,'post_images/rFK5vkJcjk7AsayYFspIblHUNm7aZYEaqn6mJZlz.jpeg','2017-05-20 22:43:50','2017-05-20 22:43:50'),(3,'post_images/y4sG7tOBSR7JDCblHbbUPMEgZtvhj1OlQY9tlOOH.jpeg','2017-05-20 22:48:43','2017-05-20 22:48:43'),(4,'post_images/l00nQjPGF8SbUafCsKstqM2NFwAQNMMvCUkSBjNv.jpeg','2017-05-20 22:55:56','2017-05-20 22:55:56'),(5,'post_images/sjOXCwlCXIPriYWBwpeXFM6JrQXMerzpTBubZQR2.jpeg','2017-05-23 23:39:41','2017-05-23 23:39:41'),(6,'post_images/65SHqzLdxRToaZdxnUGgtpyfpt2yx593nLUMueKf.jpeg','2017-05-24 00:09:18','2017-05-24 00:09:18'),(7,'post_images/3DYKA0zuOri86hh5b3U7nmPhs3DGzbCGidPY0g5q.jpeg','2017-06-17 17:56:38','2017-06-17 17:56:38');
/*!40000 ALTER TABLE `foto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foto_perfil`
--

DROP TABLE IF EXISTS `foto_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foto_perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `current` tinyint(4) DEFAULT '1',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foto_perfil_ibfk_1` (`id_usuario`),
  CONSTRAINT `foto_perfil_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foto_perfil`
--

LOCK TABLES `foto_perfil` WRITE;
/*!40000 ALTER TABLE `foto_perfil` DISABLE KEYS */;
INSERT INTO `foto_perfil` VALUES (1,4,'perfil_images/fdQzuT2mBlcgSkSgE5cryCeGrLpKymkUSmyQ1Xzm.jpeg',0,'2017-05-08 22:23:33','2017-05-08 22:22:51',NULL),(2,4,'perfil_images/8LU7Zijow5iU4qXUT1jmKxLa5QyaSt1jrVGU7cIo.jpeg',0,'2017-05-08 22:26:28','2017-05-08 22:23:33',NULL),(3,4,'perfil_images/10UwG3wrBIbyfnDumjz35gyZYVCI2fQADbVRkFtA.jpeg',1,'2017-05-08 22:26:28','2017-05-08 22:26:28',NULL),(4,1,'perfil_images/PV9a6fXpliZVaL4U9H9F0fhDo4Nu892oEikqHvbj.jpeg',0,'2017-05-14 01:39:52','2017-05-08 23:36:15',NULL),(5,1,'perfil_images/i7Ht2UKXQU9F81dxH9MxkY346a3uW9pwMNRQCDOv.jpeg',0,'2017-05-14 01:39:59','2017-05-14 01:39:53',NULL),(6,1,'perfil_images/jSUzDaXJEJXSiqrBBPjIllfKY47101w2E3QPxxHQ.jpeg',1,'2017-05-14 01:39:59','2017-05-14 01:39:59',NULL),(8,NULL,'perfil_images/UgpgucvE9l61ybkpr8S5IcK4R2qFxrqQC7nar2vF.jpeg',1,'2017-05-14 20:00:16','2017-05-14 20:00:16',6),(9,2,'perfil_images/LYK5MNPOdZwO4mWt8dpR362ombRI1aP7nFcblHGR.jpeg',1,'2017-05-14 21:48:07','2017-05-14 21:48:07',NULL),(10,NULL,'perfil_images/CghdrV7Ax4Wn5hmQk9ECq4v843B3860OS6dgnabE.jpeg',1,'2017-05-16 23:50:09','2017-05-16 23:50:09',11),(11,NULL,'perfil_images/pyPMqlT06UIO2DwHcUDs3Q819sXy9gEwIPtNa4U0.jpeg',0,'2017-05-22 00:10:44','2017-05-21 20:11:12',5),(12,NULL,'perfil_images/ZE64VGw0qFMZbss93EpaPvGMCoYlJ8XE0xNPRbEk.jpeg',1,'2017-05-22 00:10:44','2017-05-22 00:10:44',5),(13,NULL,'perfil_images/qLEZVa1aQAIMTCTm25bcB7SgsV1wF6ZOKCgOoWP8.jpeg',1,'2017-06-24 23:07:04','2017-06-24 23:07:04',14);
/*!40000 ALTER TABLE `foto_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `id_mascota` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_mascota`,`id_post`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`),
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (5,3,'2017-05-27 19:51:38','2017-05-27 19:51:38'),(5,12,'2017-05-27 20:12:49','2017-05-27 20:12:49'),(5,13,'2017-05-27 19:45:44','2017-05-27 19:45:44'),(5,17,'2017-05-28 20:54:07','2017-05-28 20:54:07'),(5,19,'2017-06-22 23:14:37','2017-06-22 23:14:37'),(7,14,'2017-06-22 23:19:46','2017-06-22 23:19:46'),(7,19,'2017-06-22 23:19:40','2017-06-22 23:19:40'),(14,20,'2017-06-24 23:09:48','2017-06-24 23:09:48');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mascota`
--

DROP TABLE IF EXISTS `mascota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mascota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_raza` smallint(6) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `edad` smallint(6) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `otras_caracteristicas` text,
  `apto_adopcion` tinyint(4) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mascota_ibfk_1_idx` (`id_usuario`),
  KEY `mascota_ibfk_2` (`id_raza`),
  CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `mascota_ibfk_2` FOREIGN KEY (`id_raza`) REFERENCES `raza` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mascota`
--

LOCK TABLES `mascota` WRITE;
/*!40000 ALTER TABLE `mascota` DISABLE KEYS */;
INSERT INTO `mascota` VALUES (5,1,1,'M',7,'Gordo','otras cosas',0,'2017-05-22 00:09:33','2017-05-14 03:41:16'),(6,1,3,'M',10,'Bingo','Descripción de Bingo',0,'2017-06-21 00:09:49','2017-05-14 15:14:09'),(7,4,1,'H',10,'Emma','Algo mas',1,'2017-06-18 04:10:03','2017-05-14 18:02:30'),(10,2,1,'M',4,'Rocky',NULL,1,'2017-05-14 21:40:40','2017-05-14 21:40:40'),(11,7,1,'H',1,'Rocko','asddd',1,'2017-05-16 23:49:49','2017-05-16 23:49:49'),(12,3,1,'M',8,'Rambo','Negro, con arco y flecha',0,'2017-05-27 21:13:06','2017-05-27 21:13:06'),(13,8,1,'M',1,'Perro Loco','Esta de la cabeza',0,'2017-06-17 17:51:55','2017-06-17 17:51:55'),(14,10,1,'H',4,'jackie',NULL,0,'2017-06-24 23:05:57','2017-06-24 23:05:57');
/*!40000 ALTER TABLE `mascota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perdida`
--

DROP TABLE IF EXISTS `perdida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perdida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mascota` int(11) NOT NULL,
  `descripcion` text,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mascota` (`id_mascota`),
  CONSTRAINT `perdida_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perdida`
--

LOCK TABLES `perdida` WRITE;
/*!40000 ALTER TABLE `perdida` DISABLE KEYS */;
/*!40000 ALTER TABLE `perdida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mascota` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mascota` (`id_mascota`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (3,5,NULL,'Mensaje de prueba','2017-05-20 21:56:20','2017-05-20 21:56:20'),(11,5,NULL,'Mensaje con imagen','2017-05-20 22:43:50','2017-05-20 22:43:50'),(12,5,NULL,'No se','2017-05-20 22:48:43','2017-05-20 22:48:43'),(13,5,NULL,'loco','2017-05-20 22:55:56','2017-05-20 22:55:56'),(14,5,NULL,'test','2017-05-23 22:19:22','2017-05-23 22:19:22'),(16,6,NULL,'asdas','2017-05-24 00:09:18','2017-05-24 00:09:18'),(17,7,NULL,'Emma','2017-05-24 00:09:36','2017-05-24 00:09:36'),(18,7,NULL,'Emma 2','2017-05-24 00:09:41','2017-05-24 00:09:41'),(19,5,NULL,'Test','2017-05-28 18:45:04','2017-05-28 18:45:04'),(20,13,NULL,'COmentando algo','2017-06-17 17:56:38','2017-06-17 17:56:38'),(21,14,NULL,'Busco novio doberman de 5 años =)','2017-06-24 23:09:15','2017-06-24 23:09:15');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_foto`
--

DROP TABLE IF EXISTS `post_foto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_foto` (
  `id_post` int(11) NOT NULL,
  `id_foto` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_post`,`id_foto`),
  KEY `id_foto` (`id_foto`),
  CONSTRAINT `post_foto_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`),
  CONSTRAINT `post_foto_ibfk_2` FOREIGN KEY (`id_foto`) REFERENCES `foto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_foto`
--

LOCK TABLES `post_foto` WRITE;
/*!40000 ALTER TABLE `post_foto` DISABLE KEYS */;
INSERT INTO `post_foto` VALUES (11,2,'2017-05-20 22:43:50','2017-05-20 22:43:50'),(12,3,'2017-05-20 22:48:43','2017-05-20 22:48:43'),(13,4,'2017-05-20 22:55:57','2017-05-20 22:55:57'),(16,6,'2017-05-24 00:09:18','2017-05-24 00:09:18'),(20,7,'2017-06-17 17:56:39','2017-06-17 17:56:39');
/*!40000 ALTER TABLE `post_foto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_video`
--

DROP TABLE IF EXISTS `post_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_video` (
  `id_post` int(11) NOT NULL,
  `id_video` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_post`,`id_video`),
  KEY `id_video` (`id_video`),
  CONSTRAINT `post_video_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`),
  CONSTRAINT `post_video_ibfk_2` FOREIGN KEY (`id_video`) REFERENCES `video` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_video`
--

LOCK TABLES `post_video` WRITE;
/*!40000 ALTER TABLE `post_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `raza`
--

DROP TABLE IF EXISTS `raza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `raza` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_tipo_mascota` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_mascota` (`id_tipo_mascota`),
  CONSTRAINT `raza_ibfk_1` FOREIGN KEY (`id_tipo_mascota`) REFERENCES `tipo_mascota` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `raza`
--

LOCK TABLES `raza` WRITE;
/*!40000 ALTER TABLE `raza` DISABLE KEYS */;
INSERT INTO `raza` VALUES (1,1,'Golden Retriever','2017-05-11 23:43:19','2017-05-11 23:43:19'),(2,2,'Siames','2017-05-11 23:44:53','2017-05-11 23:44:53'),(3,1,'Otra','2017-05-13 22:55:30','2017-05-13 22:55:30'),(4,2,'Otra','2017-05-13 22:55:30','2017-05-13 22:55:30'),(5,1,'Pequines','0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,1,'Dogo','0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,1,'Bulldog','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `raza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sigue`
--

DROP TABLE IF EXISTS `sigue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sigue` (
  `id_mascota` int(11) NOT NULL,
  `id_mascota2` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  KEY `id_mascota` (`id_mascota`),
  KEY `sigue_ibfk_2` (`id_mascota2`),
  CONSTRAINT `sigue_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sigue_ibfk_2` FOREIGN KEY (`id_mascota2`) REFERENCES `mascota` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sigue`
--

LOCK TABLES `sigue` WRITE;
/*!40000 ALTER TABLE `sigue` DISABLE KEYS */;
INSERT INTO `sigue` VALUES (11,6,'2017-05-23 23:36:30','2017-05-23 23:36:30'),(6,5,'2017-05-24 00:23:08','2017-05-24 00:23:08'),(5,11,'2017-05-27 22:53:48','2017-05-27 22:53:48'),(11,5,'2017-05-28 02:59:52','2017-05-28 02:59:52'),(5,7,'2017-05-28 17:14:31','2017-05-28 17:14:31'),(5,12,'2017-05-28 19:52:40','2017-05-28 19:52:40'),(14,6,'2017-06-24 23:09:36','2017-06-24 23:09:36'),(14,7,'2017-06-24 23:09:37','2017-06-24 23:09:37'),(14,13,'2017-06-24 23:09:39','2017-06-24 23:09:39');
/*!40000 ALTER TABLE `sigue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_mascota`
--

DROP TABLE IF EXISTS `tipo_mascota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_mascota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_mascota`
--

LOCK TABLES `tipo_mascota` WRITE;
/*!40000 ALTER TABLE `tipo_mascota` DISABLE KEYS */;
INSERT INTO `tipo_mascota` VALUES (1,'Canino','2017-05-11 23:33:08','2017-05-11 23:33:08'),(2,'Felino','2017-05-11 23:33:35','2017-05-11 23:33:35'),(3,'Otros','2017-05-13 22:55:30','2017-05-13 22:55:30');
/*!40000 ALTER TABLE `tipo_mascota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `ultima_conexion` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `provider_UNIQUE` (`provider`),
  UNIQUE KEY `provider_id_UNIQUE` (`provider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'leocab16@gmail.com','$2y$10$eP20OzOAORzT7bV.FOyieOOhd1oS8byiyOLrwU5z5DJ39lMzTYfMW','2017-07-03 21:19:43','2017-07-03 21:19:43','2017-04-30 17:26:22',NULL,NULL,'sNdFw7Ec4iZerR9Xt54KHo2Ddo9vVmCGxyL43F5oZSdIRpmrnnho4ZHjcbE9'),(2,'leocab16@hotmail.com','$2y$10$zSrTIsyoF6/g/ZAmdqk/1u1MsWdkCABWSRPcU8YKW/t65Lvs0tkfm','2017-05-14 21:33:28','2017-05-14 21:33:28','2017-05-07 14:23:07',NULL,NULL,'fDnuWT5CGVqWCiNrVcNPlsEbD8XCtMBvGlMFke9gcVgO1MDDy1MFEB0idtfi'),(3,'leocab16@hotmail2.com','$2y$10$HIZI8whXobIHTNpFDJJdtukyufveR/XTyIDMwq5copVaw50xMAemG','2017-05-27 21:12:11','2017-05-27 21:12:11','2017-05-07 17:11:43',NULL,NULL,'zzsA3FBMF2AmhuwxXb4Nlz9wzNOdSJjLdK7Ej2dMqVC5MDEgCSJvQDE4hMJS'),(4,'test@test.com','$2y$10$/Lv5YanXNCVtc5XOB.eVDezeurFjqHrzb6wB85q.XNsXh.ww2piPi','2017-06-24 21:09:07','2017-06-24 21:09:07','2017-05-07 17:48:51',NULL,NULL,'TKQNocZeKkAeqgMTBJppH7JMIo7bwjqLJntIFH3BD3ZwXyniJGfNcxRqQDO0'),(5,'test@gmail.com','$2y$10$8RkDRTvGDff2RSOOLZF9mus05.qqkWbxnWrS0i2l7PbskFCEiCZ4C','2017-05-27 21:11:24','2017-05-27 21:11:24','2017-05-16 23:12:29',NULL,NULL,'fv3xvRXXsQmLnH9Fl9ooQ6QfSNqj7J1JvpLq8xYfbFMrA89KJlMy0YScgkjt'),(6,'leocab16@gmail.com',NULL,NULL,'2017-06-17 17:33:09','2017-06-17 17:33:09','google','101194767963441274979','BcCvqfhNjkGduCI4jbg6sSzySaGLYofmFPp66ETIZ88OKKHkCmcSE9FYClwm'),(7,'leocab16@hotmail.com',NULL,NULL,'2017-06-17 17:49:33','2017-06-17 17:49:33','facebook','10154774350788358','ykrJhJOGMgMDjvsvarx4ELZKP5ybMXwedJmwsL6BKG2I0jkP54apkY1kmC8r'),(8,'vero171@hotmail.com','$2y$10$Vbk4SZrVOUfCxpvMcglgweZv8fqHlakpdqpVEnlPmnnhtF6hxokrO',NULL,'2017-06-24 22:59:44','2017-06-24 22:59:44',NULL,NULL,'wh7hY0zgsG0jIdYFQq1kcrSEJ4KE7GUIiiRAwojjIbgcJb77amgrfqILP3ff');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `domicilio` varchar(100) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `geoposicion` varchar(100) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `fecha_nacimiento` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'Leo Cabré','santamarina 18482','44883136',NULL,'M','1983-11-05 04:22:45','2017-05-08 21:26:44','2017-04-30 17:54:04'),(2,2,'Leo','calle 2',NULL,NULL,'M','1994-06-22 16:59:04','2017-05-07 16:59:04','2017-05-07 14:38:44'),(3,3,NULL,NULL,'',NULL,'M',NULL,'2017-05-07 17:43:26','2017-05-07 17:11:47'),(4,4,'Juancho',NULL,NULL,NULL,'M','2014-07-02 18:51:57','2017-06-18 02:25:07','2017-05-07 17:48:56'),(7,5,'Leo',NULL,NULL,NULL,NULL,NULL,'2017-05-16 23:53:12','2017-05-16 23:27:25'),(8,6,'Leo',NULL,NULL,NULL,NULL,NULL,'2017-06-17 17:35:11','2017-06-17 17:34:31'),(9,7,NULL,NULL,NULL,NULL,NULL,NULL,'2017-06-17 17:49:34','2017-06-17 17:49:34'),(10,8,NULL,NULL,NULL,NULL,NULL,NULL,'2017-06-24 22:59:45','2017-06-24 22:59:45');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visita`
--

DROP TABLE IF EXISTS `visita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visita`
--

LOCK TABLES `visita` WRITE;
/*!40000 ALTER TABLE `visita` DISABLE KEYS */;
/*!40000 ALTER TABLE `visita` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-03 18:20:18
