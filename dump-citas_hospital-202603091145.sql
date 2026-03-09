-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: citas_hospital
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cita` (
  `id_cita` int NOT NULL AUTO_INCREMENT,
  `id_doctor` int NOT NULL,
  `id_paciente` int NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_estado_cita` int NOT NULL,
  `pagado` tinyint(1) NOT NULL DEFAULT '0',
  `hora_cita` time NOT NULL,
  `dia_cita` date NOT NULL,
  PRIMARY KEY (`id_cita`),
  KEY `fk_cita_id_doctor` (`id_doctor`),
  KEY `fk_cita_id_paciente` (`id_paciente`),
  KEY `fk_cita_id_estado_cita` (`id_estado_cita`),
  CONSTRAINT `fk_cita_id_doctor` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`),
  CONSTRAINT `fk_cita_id_estado_cita` FOREIGN KEY (`id_estado_cita`) REFERENCES `estado_cita` (`id_estado_cita`),
  CONSTRAINT `fk_cita_id_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` VALUES (1,1,1,'2026-01-30 00:00:00',2,0,'08:00:00','2026-02-01'),(2,1,1,'2026-01-30 00:00:00',2,0,'09:00:00','2026-02-01'),(3,1,1,'2026-01-30 00:00:00',2,0,'10:00:00','2026-02-01'),(4,1,1,'2026-01-30 00:00:00',2,0,'11:00:00','2026-02-01'),(5,1,1,'2026-01-30 00:00:00',2,0,'12:00:00','2026-02-01'),(6,1,1,'2026-01-30 00:00:00',2,0,'13:00:00','2026-02-01'),(7,1,1,'2026-01-30 00:00:00',2,0,'07:00:00','2026-02-01'),(8,1,1,'2026-01-30 00:00:00',2,0,'06:00:00','2026-02-01'),(9,1,1,'2026-02-03 10:29:01',1,0,'07:00:00','2026-04-20'),(10,1,1,'2026-02-03 10:31:14',1,0,'08:00:00','2026-04-20'),(11,1,1,'2026-02-03 10:31:14',1,0,'09:00:00','2026-04-20'),(12,1,1,'2026-02-03 10:31:14',1,0,'10:00:00','2026-04-20'),(13,1,1,'2026-02-03 10:31:14',3,0,'11:00:00','2026-04-20'),(14,1,1,'2026-02-03 10:31:14',4,0,'12:00:00','2026-04-20'),(15,1,1,'2026-02-03 10:31:14',3,0,'13:00:00','2026-04-20'),(16,1,2,'2026-02-09 09:46:15',3,0,'18:00:00','2026-02-27'),(17,1,1,'2026-02-09 09:48:37',2,0,'07:00:00','2026-02-09'),(26,1,2,'2026-02-10 11:35:53',4,0,'19:00:00','2026-02-20'),(28,1,2,'2026-02-10 11:39:48',2,0,'19:00:00','2026-02-18'),(30,1,7,'2026-02-12 10:18:23',2,0,'17:00:00','2026-02-18'),(31,1,7,'2026-02-12 10:20:44',2,0,'17:00:00','2026-02-18'),(34,1,8,'2026-02-12 10:23:19',2,0,'18:00:00','2026-02-25'),(35,1,8,'2026-02-12 10:49:11',2,0,'18:00:00','2026-02-18'),(36,1,8,'2026-02-12 10:50:37',2,0,'18:00:00','2026-02-18'),(37,1,1,'2026-02-12 10:51:57',2,0,'22:00:00','2026-02-19'),(38,1,8,'2026-02-12 10:53:42',2,0,'08:00:00','2026-02-24'),(39,1,1,'2026-02-12 10:54:02',2,0,'20:00:00','2026-02-18'),(41,1,9,'2026-02-12 10:55:44',2,0,'18:00:00','2026-02-19'),(45,1,1,'2026-02-16 11:09:56',2,0,'16:00:00','2026-02-20'),(46,1,9,'2026-02-16 11:10:14',2,0,'21:00:00','2026-02-20'),(49,1,14,'2026-02-25 10:57:27',4,0,'20:00:00','2026-02-27'),(50,1,14,'2026-02-25 10:58:24',4,0,'09:00:00','2026-05-25'),(51,1,8,'2026-02-26 10:52:12',3,0,'18:00:00','2026-02-26'),(52,1,8,'2026-02-26 10:53:32',4,0,'16:00:00','2026-02-26'),(53,1,8,'2026-02-26 10:55:54',2,0,'20:00:00','2026-02-26'),(54,1,8,'2026-03-03 09:11:20',2,0,'11:00:00','2026-03-03'),(55,1,8,'2026-03-04 09:01:07',4,0,'19:00:00','2026-03-18'),(56,1,8,'2026-03-04 09:28:33',3,0,'18:00:00','2026-03-11'),(57,1,9,'2026-03-04 10:47:07',4,0,'19:00:00','2026-03-05'),(58,2,12,'2026-03-04 11:25:22',4,0,'12:00:00','2026-03-04');
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor` (
  `id_doctor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `ap_paterno` varchar(50) NOT NULL,
  `ap_materno` varchar(50) DEFAULT NULL,
  `id_especialidad` int NOT NULL,
  `id_estado_doctor` int NOT NULL,
  PRIMARY KEY (`id_doctor`),
  UNIQUE KEY `unique_nombre_completo` (`nombre`,`ap_paterno`,`ap_materno`),
  KEY `fk_doctor_id_especialidad` (`id_especialidad`),
  KEY `fk_doctor_id_estado_doctor` (`id_estado_doctor`),
  CONSTRAINT `fk_doctor_id_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id_especialidad`),
  CONSTRAINT `fk_doctor_id_estado_doctor` FOREIGN KEY (`id_estado_doctor`) REFERENCES `estado_doctor` (`id_estado_doctor`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (1,'Esa','Jac','Di',1,1),(2,'asdeo','gab','per',2,1),(4,'Rase','Vert','Zasr',3,1),(5,'Victor','Gideon','Requiem',3,1),(7,'esau','PLASD','VIRSA',1,1),(8,'PAPA DE NONIO','BARRIGA','BARUCH',1,1),(9,'C BKZXN','ZXC ZX,','ZXKLNC',1,3);
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `especialidad` (
  `id_especialidad` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidad`
--

LOCK TABLES `especialidad` WRITE;
/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
INSERT INTO `especialidad` VALUES (1,'general'),(2,'esp1'),(3,'esp2');
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_cita`
--

DROP TABLE IF EXISTS `estado_cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado_cita` (
  `id_estado_cita` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estado_cita`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_cita`
--

LOCK TABLES `estado_cita` WRITE;
/*!40000 ALTER TABLE `estado_cita` DISABLE KEYS */;
INSERT INTO `estado_cita` VALUES (1,'cancelado'),(2,'programada'),(3,'completada'),(4,'no_asistio');
/*!40000 ALTER TABLE `estado_cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_doctor`
--

DROP TABLE IF EXISTS `estado_doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado_doctor` (
  `id_estado_doctor` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estado_doctor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_doctor`
--

LOCK TABLES `estado_doctor` WRITE;
/*!40000 ALTER TABLE `estado_doctor` DISABLE KEYS */;
INSERT INTO `estado_doctor` VALUES (1,'disponible'),(2,'ocupado'),(3,'no_disponible');
/*!40000 ALTER TABLE `estado_doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario_doctor`
--

DROP TABLE IF EXISTS `horario_doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horario_doctor` (
  `id_horario_doctor` int NOT NULL AUTO_INCREMENT,
  `id_doctor` int NOT NULL,
  `dia_semana` tinyint NOT NULL COMMENT '1=Lunes - 7=Domingo',
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  PRIMARY KEY (`id_horario_doctor`),
  KEY `fk_horario_doctor_id_doctor` (`id_doctor`),
  CONSTRAINT `fk_horario_doctor_id_doctor` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario_doctor`
--

LOCK TABLES `horario_doctor` WRITE;
/*!40000 ALTER TABLE `horario_doctor` DISABLE KEYS */;
INSERT INTO `horario_doctor` VALUES (1,1,1,'07:00:00','14:00:00'),(2,1,2,'07:00:00','14:00:00'),(3,1,3,'07:00:00','14:00:00'),(4,1,4,'16:00:00','23:00:00'),(5,1,5,'16:00:00','23:00:00'),(6,1,6,'16:00:00','23:00:00'),(7,2,1,'06:00:00','14:00:00'),(8,2,2,'06:00:00','14:00:00'),(9,2,3,'06:00:00','14:00:00'),(10,2,4,'06:00:00','14:00:00'),(11,2,5,'06:00:00','14:00:00'),(12,2,6,'06:00:00','14:00:00'),(13,2,7,'06:00:00','14:00:00'),(16,7,0,'00:00:03','00:00:01'),(17,7,0,'00:00:03','00:00:17'),(18,8,0,'00:00:02','00:00:03'),(19,9,0,'00:00:02','00:00:03');
/*!40000 ALTER TABLE `horario_doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario_doctor_hora`
--

DROP TABLE IF EXISTS `horario_doctor_hora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horario_doctor_hora` (
  `id_horario_doctor_hora` int NOT NULL AUTO_INCREMENT,
  `id_doctor` int NOT NULL,
  `dia_semana` tinyint NOT NULL COMMENT '1=Domingo - 7=Sabado',
  `hora` time NOT NULL,
  PRIMARY KEY (`id_horario_doctor_hora`),
  UNIQUE KEY `uq_doctor_dia_hora` (`id_doctor`,`dia_semana`,`hora`),
  CONSTRAINT `fk_horario_doctor_hora_id_doctor` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario_doctor_hora`
--

LOCK TABLES `horario_doctor_hora` WRITE;
/*!40000 ALTER TABLE `horario_doctor_hora` DISABLE KEYS */;
INSERT INTO `horario_doctor_hora` VALUES (1,1,1,'07:00:00'),(2,1,1,'08:00:00'),(3,1,1,'09:00:00'),(4,1,1,'10:00:00'),(5,1,1,'11:00:00'),(6,1,1,'12:00:00'),(7,1,1,'13:00:00'),(8,1,2,'07:00:00'),(9,1,2,'08:00:00'),(10,1,2,'09:00:00'),(11,1,2,'10:00:00'),(12,1,2,'11:00:00'),(13,1,2,'12:00:00'),(14,1,2,'13:00:00'),(15,1,3,'07:00:00'),(16,1,3,'08:00:00'),(17,1,3,'09:00:00'),(18,1,3,'10:00:00'),(19,1,3,'11:00:00'),(20,1,3,'12:00:00'),(21,1,3,'13:00:00'),(39,1,4,'16:00:00'),(40,1,4,'17:00:00'),(41,1,4,'18:00:00'),(42,1,4,'19:00:00'),(43,1,4,'20:00:00'),(44,1,4,'21:00:00'),(45,1,4,'22:00:00'),(32,1,5,'16:00:00'),(33,1,5,'17:00:00'),(34,1,5,'18:00:00'),(35,1,5,'19:00:00'),(36,1,5,'20:00:00'),(37,1,5,'21:00:00'),(38,1,5,'22:00:00'),(25,1,6,'16:00:00'),(26,1,6,'17:00:00'),(27,1,6,'18:00:00'),(28,1,6,'19:00:00'),(29,1,6,'20:00:00'),(30,1,6,'21:00:00'),(31,1,6,'22:00:00'),(46,2,1,'06:00:00'),(47,2,1,'07:00:00'),(48,2,1,'08:00:00'),(49,2,1,'09:00:00'),(50,2,1,'10:00:00'),(51,2,1,'11:00:00'),(52,2,1,'12:00:00'),(53,2,1,'13:00:00'),(54,2,2,'06:00:00'),(55,2,2,'07:00:00'),(56,2,2,'08:00:00'),(57,2,2,'09:00:00'),(58,2,2,'10:00:00'),(59,2,2,'11:00:00'),(60,2,2,'12:00:00'),(61,2,2,'13:00:00'),(62,2,3,'06:00:00'),(63,2,3,'07:00:00'),(64,2,3,'08:00:00'),(65,2,3,'09:00:00'),(66,2,3,'10:00:00'),(67,2,3,'11:00:00'),(68,2,3,'12:00:00'),(69,2,3,'13:00:00'),(70,2,4,'06:00:00'),(71,2,4,'07:00:00'),(72,2,4,'08:00:00'),(73,2,4,'09:00:00'),(74,2,4,'10:00:00'),(75,2,4,'11:00:00'),(76,2,4,'12:00:00'),(77,2,4,'13:00:00'),(78,2,5,'06:00:00'),(79,2,5,'07:00:00'),(80,2,5,'08:00:00'),(81,2,5,'09:00:00'),(82,2,5,'10:00:00'),(83,2,5,'11:00:00'),(84,2,5,'12:00:00'),(85,2,5,'13:00:00'),(86,2,6,'06:00:00'),(87,2,6,'07:00:00'),(88,2,6,'08:00:00'),(89,2,6,'09:00:00'),(90,2,6,'10:00:00'),(91,2,6,'11:00:00'),(92,2,6,'12:00:00'),(93,2,6,'13:00:00'),(94,2,7,'06:00:00'),(95,2,7,'07:00:00'),(96,2,7,'08:00:00'),(97,2,7,'09:00:00'),(98,2,7,'10:00:00'),(99,2,7,'11:00:00'),(100,2,7,'12:00:00'),(101,2,7,'13:00:00'),(116,7,0,'00:00:03'),(117,7,0,'00:00:04'),(118,7,0,'00:00:05'),(119,7,0,'00:00:06'),(120,7,0,'00:00:07'),(121,7,0,'00:00:08'),(122,7,0,'00:00:09'),(123,7,0,'00:00:10'),(124,7,0,'00:00:11'),(125,7,0,'00:00:12'),(126,7,0,'00:00:13'),(127,7,0,'00:00:14'),(128,7,0,'00:00:15'),(129,7,0,'00:00:16'),(130,8,0,'00:00:02'),(131,9,0,'00:00:02');
/*!40000 ALTER TABLE `horario_doctor_hora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodo_pago`
--

DROP TABLE IF EXISTS `metodo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metodo_pago` (
  `id_metodo_pago` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_metodo_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodo_pago`
--

LOCK TABLES `metodo_pago` WRITE;
/*!40000 ALTER TABLE `metodo_pago` DISABLE KEYS */;
INSERT INTO `metodo_pago` VALUES (1,'efectivo'),(2,'credito'),(3,'debito');
/*!40000 ALTER TABLE `metodo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente` (
  `id_paciente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `ap_paterno` varchar(50) NOT NULL,
  `ap_materno` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_paciente`),
  UNIQUE KEY `unique_nombre_completo` (`nombre`,`ap_paterno`,`ap_materno`),
  UNIQUE KEY `unique_correo_paciente` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (1,'bran','die','pat','550321548','bran@hotmail'),(2,'dylan','res','mar','551425447','asdo@gmail.com'),(7,'esa','kjc','doa','5516546951','asd@gmail.com'),(8,'sadefgz','DSAeas','Deras','5512021463','paslkd@gmail.com'),(9,'edasd','easdas','deasd','5512013269','epasd@gmail.com'),(12,'ñoño','barriga','baruch','5512469851','nonio@gmail.com'),(14,'ramon','valdez','servin','5512469851','monchito@gmail.com');
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recibo`
--

DROP TABLE IF EXISTS `recibo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recibo` (
  `id_recibo` int NOT NULL AUTO_INCREMENT,
  `id_cita` int NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `id_metodo_pago` int NOT NULL,
  PRIMARY KEY (`id_recibo`),
  KEY `fk_recibo_id_cita` (`id_cita`),
  KEY `fk_recibo_id_metodo_pago` (`id_metodo_pago`),
  CONSTRAINT `fk_recibo_id_cita` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id_cita`),
  CONSTRAINT `fk_recibo_id_metodo_pago` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodo_pago` (`id_metodo_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recibo`
--

LOCK TABLES `recibo` WRITE;
/*!40000 ALTER TABLE `recibo` DISABLE KEYS */;
/*!40000 ALTER TABLE `recibo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'citas_hospital'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-09 11:45:55
