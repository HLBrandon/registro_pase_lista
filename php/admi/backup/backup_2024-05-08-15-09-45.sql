-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: pase_lista_itsmt
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Table structure for table `area_itsmt`
--

DROP TABLE IF EXISTS `area_itsmt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area_itsmt` (
  `cveArea` int(10) NOT NULL AUTO_INCREMENT,
  `area` varchar(40) NOT NULL,
  PRIMARY KEY (`cveArea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_itsmt`
--

LOCK TABLES `area_itsmt` WRITE;
/*!40000 ALTER TABLE `area_itsmt` DISABLE KEYS */;
/*!40000 ALTER TABLE `area_itsmt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignatura`
--

DROP TABLE IF EXISTS `asignatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignatura` (
  `cveAsignatura` varchar(8) NOT NULL,
  `nombre_asignatura` varchar(255) NOT NULL,
  PRIMARY KEY (`cveAsignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignatura`
--

LOCK TABLES `asignatura` WRITE;
/*!40000 ALTER TABLE `asignatura` DISABLE KEYS */;
INSERT INTO `asignatura` VALUES ('SCA-1026','Taller de Sistemas Operativos'),('SCB-1001','Administración de Base de Datos'),('SCC-1014','Lenguajes de Interfaz'),('SCD-1011','Ingeniería de Software'),('SCD-1015','Lenguajes y Autómatas I'),('SCD-1021','Redes de Compuradoras');
/*!40000 ALTER TABLE `asignatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignatura_alumnos`
--

DROP TABLE IF EXISTS `asignatura_alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignatura_alumnos` (
  `cveAsig_alum` int(10) NOT NULL AUTO_INCREMENT,
  `cveImpa_Asig` int(10) NOT NULL,
  `matricula` varchar(9) NOT NULL,
  `fecha_inicio_semestre` date NOT NULL,
  `fecha_fin_semestre` date NOT NULL,
  PRIMARY KEY (`cveAsig_alum`),
  KEY `cveImpa_Asig` (`cveImpa_Asig`),
  KEY `matricula` (`matricula`),
  CONSTRAINT `asignatura_alumnos_ibfk_1` FOREIGN KEY (`cveImpa_Asig`) REFERENCES `impartir_asignatura` (`cveImpa_Asig`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asignatura_alumnos_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `estudiante` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignatura_alumnos`
--

LOCK TABLES `asignatura_alumnos` WRITE;
/*!40000 ALTER TABLE `asignatura_alumnos` DISABLE KEYS */;
INSERT INTO `asignatura_alumnos` VALUES (1,1,'210I0001','2024-02-01','2024-07-01'),(2,2,'210I0001','2024-02-01','2024-07-01'),(3,3,'210I0001','2024-02-01','2024-07-01'),(4,4,'210I0001','2024-02-01','2024-07-01'),(5,5,'210I0001','2024-02-01','2024-07-01'),(6,6,'210I0001','2024-02-01','2024-07-01'),(7,1,'210I0013','2024-02-01','2024-07-01'),(8,2,'210I0013','2024-02-01','2024-07-01'),(9,3,'210I0013','2024-02-01','2024-07-01'),(10,4,'210I0013','2024-02-01','2024-07-01'),(11,5,'210I0013','2024-02-01','2024-07-01'),(12,6,'210I0013','2024-02-01','2024-07-01'),(13,1,'210I0015','2024-02-01','2024-07-01'),(14,2,'210I0015','2024-02-01','2024-07-01'),(15,3,'210I0015','2024-02-01','2024-07-01'),(16,4,'210I0015','2024-02-01','2024-07-01'),(17,5,'210I0015','2024-02-01','2024-07-01'),(18,6,'210I0015','2024-02-01','2024-07-01'),(19,2,'210I0059','2024-02-01','2024-07-01'),(20,3,'210I0059','2024-02-01','2024-07-01'),(21,4,'210I0059','2024-02-01','2024-07-01'),(22,5,'210I0059','2024-02-01','2024-07-01'),(23,6,'210I0059','2024-02-01','2024-07-01'),(24,1,'B220I0133','2024-02-01','2024-07-01'),(25,2,'B220I0133','2024-02-01','2024-07-01'),(26,3,'B220I0133','2024-02-01','2024-07-01'),(27,4,'B220I0133','2024-02-01','2024-07-01'),(28,5,'B220I0133','2024-02-01','2024-07-01'),(29,6,'B220I0133','2024-02-01','2024-07-01');
/*!40000 ALTER TABLE `asignatura_alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignatura_semestre`
--

DROP TABLE IF EXISTS `asignatura_semestre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignatura_semestre` (
  `cveAsig_seme` int(10) NOT NULL AUTO_INCREMENT,
  `cveAsignatura` varchar(8) NOT NULL,
  `cveSemestre` int(10) NOT NULL,
  `cveCarrera` varchar(8) NOT NULL,
  PRIMARY KEY (`cveAsig_seme`),
  KEY `cveAsignatura` (`cveAsignatura`),
  KEY `cveSemestre` (`cveSemestre`),
  KEY `cveCarrera` (`cveCarrera`),
  CONSTRAINT `asignatura_semestre_ibfk_1` FOREIGN KEY (`cveAsignatura`) REFERENCES `asignatura` (`cveAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asignatura_semestre_ibfk_2` FOREIGN KEY (`cveSemestre`) REFERENCES `semestre` (`cveSemestre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asignatura_semestre_ibfk_3` FOREIGN KEY (`cveCarrera`) REFERENCES `carrera` (`cveCarrera`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignatura_semestre`
--

LOCK TABLES `asignatura_semestre` WRITE;
/*!40000 ALTER TABLE `asignatura_semestre` DISABLE KEYS */;
/*!40000 ALTER TABLE `asignatura_semestre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asis_presente`
--

DROP TABLE IF EXISTS `asis_presente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asis_presente` (
  `cvePresente` int(10) NOT NULL AUTO_INCREMENT,
  `presente` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`cvePresente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asis_presente`
--

LOCK TABLES `asis_presente` WRITE;
/*!40000 ALTER TABLE `asis_presente` DISABLE KEYS */;
INSERT INTO `asis_presente` VALUES (1,'Presente'),(2,'No presente'),(3,'Retardo');
/*!40000 ALTER TABLE `asis_presente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencia` (
  `cveAsistencia` int(10) NOT NULL AUTO_INCREMENT,
  `cvePersona` int(10) NOT NULL,
  `cveImpa_Asig` int(10) NOT NULL,
  `fecha_asistencia` date NOT NULL,
  `hora_asistencia` time DEFAULT NULL,
  PRIMARY KEY (`cveAsistencia`),
  KEY `cvePersona` (`cvePersona`),
  KEY `cveImpa_Asig` (`cveImpa_Asig`),
  CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`cvePersona`) REFERENCES `profesor` (`cvePersona`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`cveImpa_Asig`) REFERENCES `impartir_asignatura` (`cveImpa_Asig`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia`
--

LOCK TABLES `asistencia` WRITE;
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrera` (
  `cveCarrera` varchar(8) NOT NULL,
  `nombre_carrera` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cveCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` VALUES ('IA','Ingeniería Ambiental',1),('IGE','Ingeniería en Gestión Empresarial',1),('IIA','Ingeniería en Industrial Alimentarias',1),('IMT','Ingeniería en Mecatrónica',1),('IP','Ingenieria Prueba',1),('ISC','Ingeniería en Sistemas Computacionales',1);
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_asistencia`
--

DROP TABLE IF EXISTS `detalle_asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_asistencia` (
  `cveDetalle` int(10) NOT NULL AUTO_INCREMENT,
  `cveAsistencia` int(10) NOT NULL,
  `matricula` varchar(9) NOT NULL,
  `cvePresente` int(10) NOT NULL,
  PRIMARY KEY (`cveDetalle`),
  KEY `cveAsistencia` (`cveAsistencia`),
  KEY `matricula` (`matricula`),
  KEY `cvePresente` (`cvePresente`),
  CONSTRAINT `detalle_asistencia_ibfk_1` FOREIGN KEY (`cveAsistencia`) REFERENCES `asistencia` (`cveAsistencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_asistencia_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `estudiante` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_asistencia_ibfk_3` FOREIGN KEY (`cvePresente`) REFERENCES `asis_presente` (`cvePresente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_asistencia`
--

LOCK TABLES `detalle_asistencia` WRITE;
/*!40000 ALTER TABLE `detalle_asistencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dia`
--

DROP TABLE IF EXISTS `dia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dia` (
  `cveDia` int(5) NOT NULL AUTO_INCREMENT,
  `nombre_dia` varchar(30) NOT NULL,
  PRIMARY KEY (`cveDia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dia`
--

LOCK TABLES `dia` WRITE;
/*!40000 ALTER TABLE `dia` DISABLE KEYS */;
/*!40000 ALTER TABLE `dia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encargar_carrera`
--

DROP TABLE IF EXISTS `encargar_carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encargar_carrera` (
  `cveEncargar` int(10) NOT NULL AUTO_INCREMENT,
  `cveCarrera` varchar(8) NOT NULL,
  `cvePersona` int(10) DEFAULT NULL,
  PRIMARY KEY (`cveEncargar`),
  KEY `cveCarrera` (`cveCarrera`),
  KEY `cvePersona` (`cvePersona`),
  CONSTRAINT `encargar_carrera_ibfk_1` FOREIGN KEY (`cveCarrera`) REFERENCES `carrera` (`cveCarrera`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `encargar_carrera_ibfk_2` FOREIGN KEY (`cvePersona`) REFERENCES `jefe_carrera` (`cvePersona`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encargar_carrera`
--

LOCK TABLES `encargar_carrera` WRITE;
/*!40000 ALTER TABLE `encargar_carrera` DISABLE KEYS */;
/*!40000 ALTER TABLE `encargar_carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudiante` (
  `matricula` varchar(9) NOT NULL,
  `cvePersona` int(10) NOT NULL,
  `cveGrupo` int(10) NOT NULL,
  `cveCarrera` varchar(10) NOT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  PRIMARY KEY (`matricula`),
  KEY `cvePersona` (`cvePersona`),
  KEY `cveGrupo` (`cveGrupo`),
  KEY `cveCarrera` (`cveCarrera`),
  CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`cvePersona`) REFERENCES `usuario` (`cvePersona`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `estudiante_ibfk_2` FOREIGN KEY (`cveGrupo`) REFERENCES `grupo` (`cveGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `estudiante_ibfk_3` FOREIGN KEY (`cveCarrera`) REFERENCES `carrera` (`cveCarrera`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiante`
--

LOCK TABLES `estudiante` WRITE;
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` VALUES ('210I0001',5,6,'ISC','2022-02-01'),('210I0013',7,6,'ISC','2022-02-01'),('210I0015',6,6,'ISC','2022-02-01'),('210I0059',8,6,'ISC','2021-02-01'),('B220I0133',9,6,'ISC','2023-02-01');
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo` (
  `cveGrupo` int(10) NOT NULL AUTO_INCREMENT,
  `cveSemestre` int(10) NOT NULL,
  `cveModalidad` char(1) NOT NULL,
  PRIMARY KEY (`cveGrupo`),
  KEY `cveSemestre` (`cveSemestre`),
  KEY `cveModalidad` (`cveModalidad`),
  CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`cveSemestre`) REFERENCES `semestre` (`cveSemestre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`cveModalidad`) REFERENCES `modalidad` (`cveModalidad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES (1,1,'A'),(2,2,'A'),(3,3,'A'),(4,4,'A'),(5,5,'A'),(6,6,'A'),(7,7,'A'),(8,8,'A'),(9,9,'A'),(10,1,'B'),(11,2,'B'),(12,3,'B'),(13,4,'B'),(14,5,'B'),(15,6,'B'),(16,7,'B'),(17,8,'B'),(18,9,'B');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horario` (
  `cveHorario` int(10) NOT NULL,
  `cveImpa_Asig` int(10) NOT NULL,
  `cveDia` int(5) DEFAULT NULL,
  `cveSalon` int(10) DEFAULT NULL,
  PRIMARY KEY (`cveHorario`),
  KEY `cveImpa_Asig` (`cveImpa_Asig`),
  KEY `cveDia` (`cveDia`),
  KEY `cveSalon` (`cveSalon`),
  CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`cveImpa_Asig`) REFERENCES `impartir_asignatura` (`cveImpa_Asig`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `horario_ibfk_2` FOREIGN KEY (`cveDia`) REFERENCES `dia` (`cveDia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `horario_ibfk_3` FOREIGN KEY (`cveSalon`) REFERENCES `salon` (`cveSalon`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impartir_asignatura`
--

DROP TABLE IF EXISTS `impartir_asignatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impartir_asignatura` (
  `cveImpa_Asig` int(10) NOT NULL AUTO_INCREMENT,
  `cvePersona` int(10) NOT NULL,
  `cveAsignatura` varchar(8) NOT NULL,
  `cveGrupo` int(10) NOT NULL,
  `cveCarrera` varchar(8) NOT NULL,
  `fecha_inicio_semestre` date NOT NULL,
  `fecha_fin_semestre` date DEFAULT NULL,
  PRIMARY KEY (`cveImpa_Asig`),
  KEY `cvePersona` (`cvePersona`),
  KEY `cveAsignatura` (`cveAsignatura`),
  KEY `cveGrupo` (`cveGrupo`),
  KEY `cveCarrera` (`cveCarrera`),
  CONSTRAINT `impartir_asignatura_ibfk_1` FOREIGN KEY (`cvePersona`) REFERENCES `profesor` (`cvePersona`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `impartir_asignatura_ibfk_2` FOREIGN KEY (`cveAsignatura`) REFERENCES `asignatura` (`cveAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `impartir_asignatura_ibfk_3` FOREIGN KEY (`cveGrupo`) REFERENCES `grupo` (`cveGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `impartir_asignatura_ibfk_4` FOREIGN KEY (`cveCarrera`) REFERENCES `carrera` (`cveCarrera`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impartir_asignatura`
--

LOCK TABLES `impartir_asignatura` WRITE;
/*!40000 ALTER TABLE `impartir_asignatura` DISABLE KEYS */;
INSERT INTO `impartir_asignatura` VALUES (1,1,'SCA-1026',6,'ISC','2024-02-01','2024-07-01'),(2,1,'SCD-1015',6,'ISC','2024-02-01','2024-07-01'),(3,2,'SCB-1001',6,'ISC','2024-02-01','2024-07-01'),(4,2,'SCD-1021',6,'ISC','2024-02-01','2024-07-01'),(5,3,'SCD-1011',6,'ISC','2024-02-01','2024-07-01'),(6,4,'SCC-1014',6,'ISC','2024-02-01','2024-07-01');
/*!40000 ALTER TABLE `impartir_asignatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jefe_carrera`
--

DROP TABLE IF EXISTS `jefe_carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jefe_carrera` (
  `cvePersona` int(10) NOT NULL,
  PRIMARY KEY (`cvePersona`),
  CONSTRAINT `jefe_carrera_ibfk_1` FOREIGN KEY (`cvePersona`) REFERENCES `personal_escolar` (`cvePersona`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jefe_carrera`
--

LOCK TABLES `jefe_carrera` WRITE;
/*!40000 ALTER TABLE `jefe_carrera` DISABLE KEYS */;
INSERT INTO `jefe_carrera` VALUES (10),(13);
/*!40000 ALTER TABLE `jefe_carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modalidad`
--

DROP TABLE IF EXISTS `modalidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modalidad` (
  `cveModalidad` char(1) NOT NULL,
  `modalidad` varchar(30) NOT NULL,
  PRIMARY KEY (`cveModalidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modalidad`
--

LOCK TABLES `modalidad` WRITE;
/*!40000 ALTER TABLE `modalidad` DISABLE KEYS */;
INSERT INTO `modalidad` VALUES ('A','Escolarizado'),('B','Mixto');
/*!40000 ALTER TABLE `modalidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_escolar`
--

DROP TABLE IF EXISTS `personal_escolar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_escolar` (
  `cvePersona` int(10) NOT NULL,
  `RFC` varchar(15) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `contra` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cvePersona`),
  CONSTRAINT `personal_escolar_ibfk_1` FOREIGN KEY (`cvePersona`) REFERENCES `usuario` (`cvePersona`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_escolar`
--

LOCK TABLES `personal_escolar` WRITE;
/*!40000 ALTER TABLE `personal_escolar` DISABLE KEYS */;
INSERT INTO `personal_escolar` VALUES (1,'GOMC880326H50','hlucas@example.com','$2y$10$xNSpqz7kTFANzc02ung29OnxK7MaQirZlWtNS7KQs1e5wauhtZyhO',1),(2,'GOMC880326H51','keila@example.com','$2y$10$nc7mmG3RG//M6gK3cOpIq.zv3nr7rSqvRpdxpKr23JV9c.WQNd0X6',1),(3,'GOMC880326H52','gerardo@example.com','$2y$10$no2mGLWfN3x4G4WSFRupZ.BtlWfBEuEVC38eUeVkXzrKidL6aTnQG',1),(4,'GOMC880326H53','franciscoJ@example.com','$2y$10$EUjHwpTCeLeQ059EL1lCIO52ne1vRwiUSRsXOy0U0ikdW6.XNHnT6',1),(10,'GOMC880326H54','avelino@martineztorre.tecnm.mx','$2y$10$R4XIzK7NA2CKXI3oVkbPW.e3tUAItmRDdlPjSQ5RJTVwW2HgKM3oa',1),(11,'GOMC880326H55','programador@martineztorre.tecnm.mx','$2y$10$JYYWioOdD5rM2GG0ghiOluO8NU5G5TmlMLUTGgUFTcw31k0STeQtG',1),(12,'GOMC880326H56','programador2@martineztorre.tecnm.mx','$2y$10$/dFygekk4BPQtCgxbNmAbec9uUCJrxDndiYezpWwCvZIEEQjOAMj2',1),(13,'GOMC880326H57','bentio@martineztorre.tecnm.mx','$2y$10$A66IA7lVqF9nenfndLgsv.bk8kFpI8ZSQd0ZSTr2EDkAuZzIbqBLi',1);
/*!40000 ALTER TABLE `personal_escolar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_oficina`
--

DROP TABLE IF EXISTS `personal_oficina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_oficina` (
  `cvePersona` int(10) NOT NULL,
  `cveArea` int(10) NOT NULL,
  PRIMARY KEY (`cvePersona`),
  KEY `cveArea` (`cveArea`),
  CONSTRAINT `personal_oficina_ibfk_1` FOREIGN KEY (`cvePersona`) REFERENCES `personal_escolar` (`cvePersona`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personal_oficina_ibfk_2` FOREIGN KEY (`cveArea`) REFERENCES `area_itsmt` (`cveArea`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_oficina`
--

LOCK TABLES `personal_oficina` WRITE;
/*!40000 ALTER TABLE `personal_oficina` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_oficina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesor` (
  `cvePersona` int(10) NOT NULL,
  PRIMARY KEY (`cvePersona`),
  CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`cvePersona`) REFERENCES `personal_escolar` (`cvePersona`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` VALUES (1),(2),(3),(4);
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salon`
--

DROP TABLE IF EXISTS `salon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salon` (
  `cveSalon` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_salon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cveSalon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salon`
--

LOCK TABLES `salon` WRITE;
/*!40000 ALTER TABLE `salon` DISABLE KEYS */;
/*!40000 ALTER TABLE `salon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semestre`
--

DROP TABLE IF EXISTS `semestre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semestre` (
  `cveSemestre` int(10) NOT NULL AUTO_INCREMENT,
  `num_semestre` varchar(5) NOT NULL,
  PRIMARY KEY (`cveSemestre`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semestre`
--

LOCK TABLES `semestre` WRITE;
/*!40000 ALTER TABLE `semestre` DISABLE KEYS */;
INSERT INTO `semestre` VALUES (1,'1°'),(2,'2°'),(3,'3°'),(4,'4°'),(5,'5°'),(6,'6°'),(7,'7°'),(8,'8°'),(9,'9°');
/*!40000 ALTER TABLE `semestre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_admin`
--

DROP TABLE IF EXISTS `user_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_admin` (
  `cvePersona` int(10) NOT NULL,
  PRIMARY KEY (`cvePersona`),
  CONSTRAINT `user_admin_ibfk_1` FOREIGN KEY (`cvePersona`) REFERENCES `personal_escolar` (`cvePersona`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_admin`
--

LOCK TABLES `user_admin` WRITE;
/*!40000 ALTER TABLE `user_admin` DISABLE KEYS */;
INSERT INTO `user_admin` VALUES (11),(12);
/*!40000 ALTER TABLE `user_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `cvePersona` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_persona` varchar(40) NOT NULL,
  `apellido_pa` varchar(40) NOT NULL,
  `apellido_ma` varchar(40) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  PRIMARY KEY (`cvePersona`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Hugo','Lucas','Alvarado','2323332211'),(2,'Keila Elena','Ocaña','Drouaillet','2323332211'),(3,'Gerardo','Gonzales','Gomez','2323332211'),(4,'Francisco Javier','Gutierrez','Hernandez','2323332211'),(5,'Brandon','Hernandez','Lopez','2323332211'),(6,'Kevin','Guevara','Quiroz','2323332211'),(7,'Alan','Guevara','Quiroz','2323332211'),(8,'Luis Alberto','Ceceña','Hernandez','2323332211'),(9,'Cesar de Jesus','Reyes','Ruiz','2323332211'),(10,'Avelino','Avelino','Avelino','2323332211'),(11,'Brandon','Hernandez','Lopez','2323332211'),(12,'Kevin','Guevara','Quiroz','2323332211'),(13,'Benito','Juarez','Hola','2323332211');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-08 15:09:46
