-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bases2
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1-log

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
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `usuario` varchar(50) NOT NULL,
  `accion` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_bitacora`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES ('prueba','insertar','2015-10-13 03:49:25',1),('admin','insertar','2015-10-13 04:33:20',2),('usuario1','insertar','2015-10-16 19:18:03',3),('usuario1','insertar','2015-10-16 19:19:06',4),('usuario1','insertar','2015-10-16 22:25:57',5),('usuario1','insertar','2015-10-16 22:26:13',6),('usuario1','insertar','2015-10-16 22:26:28',7),('usuario1','insertar','2015-10-16 22:26:46',8),('usuario1','insertar','2015-10-16 22:27:06',9),('usuario1','insertar','2015-10-16 22:27:14',10),('usuario1','insertar','2015-10-16 22:27:21',11),('usuario1','insertar','2015-10-16 22:27:30',12),('usuario1','insertar','2015-10-16 22:27:40',13),('admin','insertar','2015-10-16 22:33:35',14),('don mynor','insertar','2015-10-16 22:41:31',15),('don mynor','insertar','2015-10-16 22:41:55',16),('don mynor','insertar','2015-10-16 22:42:38',17),('usuario1','insertar','2015-10-17 08:13:24',18),('don mynor','insertar','2015-10-17 08:24:45',19),('u2','insertar','2015-10-17 08:33:30',20),('u2','insertar','2015-10-17 08:38:24',21),('u2','insertar','2015-10-17 08:39:02',22),('u2','insertar','2015-10-17 08:40:02',23),('u2','insertar','2015-10-17 08:46:13',24),('u2','insertar','2015-10-17 08:50:00',25),('u2','insertar','2015-10-17 08:53:16',26),('u2','insertar','2015-10-17 08:57:31',27),('u2','insertar','2015-10-17 09:03:42',28),('u2','insertar','2015-10-17 09:07:16',29),('don mynor','insertar','2015-10-17 17:33:35',30),('don mynor','insertar','2015-10-17 17:34:42',31),('don mynor','insertar','2015-10-17 17:40:55',32),('don mynor','insertar','2015-10-17 17:41:20',33),('don mynor','insertar','2015-10-17 17:41:55',34),('don mynor','insertar','2015-10-17 17:42:12',35),('don mynor','insertar','2015-10-17 17:42:58',36),('don mynor','insertar','2015-10-17 17:43:22',37),('don mynor','insertar','2015-10-17 17:46:34',38),('don mynor','insertar','2015-10-17 17:51:09',39),('don mynor','insertar','2015-10-17 17:51:44',40);
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracteristica`
--

DROP TABLE IF EXISTS `caracteristica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caracteristica` (
  `id_caracteristica` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `valor` varchar(50) DEFAULT NULL,
  `id_servicio` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_caracteristica`),
  KEY `id_servicio` (`id_servicio`),
  CONSTRAINT `caracteristica_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracteristica`
--

LOCK TABLES `caracteristica` WRITE;
/*!40000 ALTER TABLE `caracteristica` DISABLE KEYS */;
INSERT INTO `caracteristica` VALUES (3,'caracteristica1','500',1),(4,'Rapido','200',5),(5,'Reparado','400',6),(6,'Shukos','50',10),(7,'Tortillas con carne','50',10);
/*!40000 ALTER TABLE `caracteristica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id_categoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Costoso',NULL),(2,'Barato',NULL),(3,'Accesible',NULL),(5,'Una estrella',NULL),(6,'Dos estrellas',NULL),(7,'Tres estrellas',NULL),(8,'Cuatro estrellas',NULL),(9,'Cinco estrellas',NULL),(10,'Pequeno',NULL),(11,'Mediano',NULL),(12,'Grande',NULL);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentario` (
  `id_comentario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contenido` varchar(250) DEFAULT NULL,
  `calificacion` int(1) DEFAULT NULL,
  `id_establecimiento_servicio` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_comentario`),
  KEY `id_establecimiento_servicio` (`id_establecimiento_servicio`),
  CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_establecimiento_servicio`) REFERENCES `establecimiento_servicio` (`id_establecimiento_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
INSERT INTO `comentario` VALUES (2,'Buen Hospedaje',5,2),(3,'Buena Lavanderia',6,3),(5,'Mal Hospedaje',1,2),(6,'Mal Hospedaje',3,3),(7,'Excelente Hospedaje',7,2),(8,'Buena Lavanderia',6,3),(9,'Excelente',7,2),(10,'Bueno',5,4),(11,'Regular',2,4),(12,'Deliciosa Comida',6,5),(13,'Malo',1,5),(14,'Malo',1,2),(15,'Regular',3,2),(16,'Bueno',6,2),(17,'Malo',1,3),(18,'Excelente',7,5),(19,'Regular',3,2),(20,'Excelente',4,2),(21,'Excelente',3,2),(23,'Deliciosa Comida',6,12),(24,'Malo',2,2),(25,'Malo',1,3),(26,'Malo',1,3);
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dimension`
--

DROP TABLE IF EXISTS `dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dimension` (
  `id_dimension` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_dimension`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dimension`
--

LOCK TABLES `dimension` WRITE;
/*!40000 ALTER TABLE `dimension` DISABLE KEYS */;
INSERT INTO `dimension` VALUES (1,'Precio',NULL),(3,'Estrellas',NULL),(4,'Tamano',NULL);
/*!40000 ALTER TABLE `dimension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento`
--

DROP TABLE IF EXISTS `establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento` (
  `id_establecimiento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `longitud` float(15,10) DEFAULT NULL,
  `latitud` float(6,6) DEFAULT NULL,
  `oficial` int(1) NOT NULL,
  `calificacion_general` float DEFAULT NULL,
  PRIMARY KEY (`id_establecimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento`
--

LOCK TABLES `establecimiento` WRITE;
/*!40000 ALTER TABLE `establecimiento` DISABLE KEYS */;
INSERT INTO `establecimiento` VALUES (1,'The Westin Camino Real','14 Calle 0-20, Guatemala','Hotel',-90.5160980225,14.597500,1,3.4091),(2,'Hostal Villa Toscana','16 Calle 8-20, Zona 13, Aurora I, Guatemala','Hotel',-90.5321502686,14.583535,1,NULL),(3,'Cabana Suiza','Km. 20.8 Carretera a San Lucas Sacatepequez, Mixco Guatemala','Hotel',-90.6115722656,14.617693,0,NULL),(4,'Casa San Lazaro','Calle Bartolome Becerra No. 8 Barrio San Lazaro Antigua Guatemala, Sacatepequez','Hotel',-90.7415618896,14.555274,0,NULL),(5,'Monoloco','5 Avenida Sur 6,Antigua Guatemala, Sacatepequez','Restaurante',-90.7342376709,14.556051,1,NULL),(6,'Vista Real','Interamerican Hwy','Hotel',-90.4849319458,14.572171,0,NULL),(12,'Barcelo','7 Avenida, 15-45. Zona 9, Guatemala','Hotel',-90.5185241699,14.597034,1,NULL),(13,'Holiday Inn','Primera Avenida 13-22 Zona 10, Guatemala','Hotel',-90.5166015625,14.633300,1,NULL),(14,'Pizza Vesuvio','Paseo Cayalá, Bulevar Rafael Landivar 10-05, Guatemala','Restaurante',-90.4868087769,14.608725,1,NULL),(15,'La Media Cancha','13 C 4-71 Z-9 Guatemala, Guatemala','Restaurante',-90.5223464966,14.600741,1,NULL),(16,'Conquistador','Via 5, 4-68 zona 4, Guatemala','Hotel',-90.5160598755,14.619985,1,NULL),(17,'Grand Tikal Futura Hotel','Calzada Roosevelt 22-43 Zona 11, Guatemala','Hotel',-90.5538864136,14.622683,1,NULL),(18,'Radisson','1a. Avenida 12-46, Zona 10 Guatemala','Hotel',-90.5232391357,14.636574,1,NULL),(19,'La Estancia','Plazuela  12 calle 7-69 zona 9','Restaurante',-90.5174407959,14.601469,1,NULL),(20,'Hooters','Plaza Obelisco, Avenida La Reforma 16, Guatemala','Restaurante',-90.5166397095,14.595264,1,NULL),(21,'Taller Periférico',' 21 Calle 29-60, Guatemala, Guatemala','Taller',14.6440010071,-90.542320,1,NULL),(22,'Taller Automotriz Auto Seco','Col las victorias, Guatemala','Taller',14.6459522247,-90.499031,1,NULL),(23,'Taller Don Mynor','6 avenida San Francisco 1, zona 6 de mixco, Guatemala','Taller',14.6641807556,-90.583038,1,NULL),(24,'SPC soluciones para carros SA','Procurador de los derechos humanos anexo, 10-74, Guatemala','Taller',14.6324996948,-90.567986,1,NULL),(25,'Taller Cojulun','Bulevar Principal de Ciudada San Cristobal, 01008, Guatemala','Taller',14.6092329025,-90.588791,1,NULL),(26,'Servicios Mecanicos Juanito','8 avenida 1-23, Guatemala','Taller',14.6319570541,-90.581322,1,NULL),(27,'Asistec S&S','11 avenida Bulevar el caminero, zona 6 de mixco, Guatemala','Taller',14.6590509415,-90.588799,1,NULL),(28,'Carlos Electricidad','11 avenida 13 calle, zona 12, Guatemala','Taller',14.6030302048,-90.541176,1,NULL),(29,'GoAuto','10 avenida, zona 11, Guatemala','Taller',14.5934467316,-90.564491,1,NULL),(30,'Taller Hyundai','Avenida Petapa, Guatemala','Taller',14.5825548172,-90.545128,1,NULL),(31,'Casa San Lazaro','Antigua','Hotel',-5.6599998474,40.959999,0,4),(32,'Hooters','Obelisco','Restaurante',-5.6599998474,40.959999,0,6),(33,'Hotel Museo Casa Santo Domingo','3a calle oriente 28 A, Antigua Guatemala, Guatemala','Hotel',14.5585632324,-90.726814,1,NULL),(34,'Hotel y Restaurante Viña Española','Calle de los duelos final, Alameda del virrey No. 17, Antigua Guatemala, Guatemala','Hotel',14.5600538254,-90.724632,1,NULL),(35,'Hotel Posada de Don Rodrigo','7a avenida Norte, Antigua Guatemala, Guatemala','Hotel',14.5586643219,-90.734131,1,NULL),(36,'Caseta Verde de Agronomi','Cerca de agro','Restaurante',3.0000028610,5.002200,1,NULL),(37,'caseta verde de farmacia','cerca de farmacia','Restaurante',4.2220997810,3.002000,0,4);
/*!40000 ALTER TABLE `establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento_dimension`
--

DROP TABLE IF EXISTS `establecimiento_dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento_dimension` (
  `id_establecimiento` int(10) unsigned NOT NULL DEFAULT '0',
  `id_dimension` int(10) unsigned NOT NULL DEFAULT '0',
  `id_categoria` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_dimension`,`id_establecimiento`),
  KEY `id_establecimiento` (`id_establecimiento`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `establecimiento_dimension_ibfk_1` FOREIGN KEY (`id_dimension`) REFERENCES `dimension` (`id_dimension`),
  CONSTRAINT `establecimiento_dimension_ibfk_2` FOREIGN KEY (`id_establecimiento`) REFERENCES `establecimiento` (`id_establecimiento`),
  CONSTRAINT `establecimiento_dimension_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento_dimension`
--

LOCK TABLES `establecimiento_dimension` WRITE;
/*!40000 ALTER TABLE `establecimiento_dimension` DISABLE KEYS */;
INSERT INTO `establecimiento_dimension` VALUES (1,1,1),(6,1,1),(2,1,2),(3,1,3),(23,1,3),(2,3,7),(5,3,7),(1,3,8),(4,4,10),(6,4,11),(5,4,12);
/*!40000 ALTER TABLE `establecimiento_dimension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento_servicio`
--

DROP TABLE IF EXISTS `establecimiento_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento_servicio` (
  `id_establecimiento_servicio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_establecimiento` int(10) unsigned DEFAULT NULL,
  `id_servicio` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_establecimiento_servicio`),
  KEY `id_servicio` (`id_servicio`),
  KEY `id_establecimiento` (`id_establecimiento`),
  CONSTRAINT `establecimiento_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`),
  CONSTRAINT `establecimiento_servicio_ibfk_2` FOREIGN KEY (`id_establecimiento`) REFERENCES `establecimiento` (`id_establecimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento_servicio`
--

LOCK TABLES `establecimiento_servicio` WRITE;
/*!40000 ALTER TABLE `establecimiento_servicio` DISABLE KEYS */;
INSERT INTO `establecimiento_servicio` VALUES (2,1,1),(3,1,2),(4,2,1),(5,2,4),(6,21,5),(7,23,6),(8,25,7),(9,26,8),(10,23,7),(11,21,7),(12,5,3),(13,5,4),(14,20,9),(15,20,3),(16,15,3),(17,36,10),(18,37,11),(19,36,11);
/*!40000 ALTER TABLE `establecimiento_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento_usuario`
--

DROP TABLE IF EXISTS `establecimiento_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento_usuario` (
  `id_usuario` int(10) unsigned DEFAULT NULL,
  `id_establecimiento` int(10) unsigned DEFAULT NULL,
  KEY `id_establecimiento` (`id_establecimiento`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `establecimiento_usuario_ibfk_1` FOREIGN KEY (`id_establecimiento`) REFERENCES `establecimiento` (`id_establecimiento`),
  CONSTRAINT `establecimiento_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento_usuario`
--

LOCK TABLES `establecimiento_usuario` WRITE;
/*!40000 ALTER TABLE `establecimiento_usuario` DISABLE KEYS */;
INSERT INTO `establecimiento_usuario` VALUES (8,1),(14,16),(8,5),(14,22),(14,14),(14,5);
/*!40000 ALTER TABLE `establecimiento_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prereserva`
--

DROP TABLE IF EXISTS `prereserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prereserva` (
  `id_preresrva` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `horayfecha` datetime DEFAULT NULL,
  `cantpersonas` int(11) DEFAULT NULL,
  `id_establecimiento_servicio` int(10) unsigned DEFAULT NULL,
  `id_usuario` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_preresrva`),
  KEY `id_establecimiento_servicio` (`id_establecimiento_servicio`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `prereserva_ibfk_1` FOREIGN KEY (`id_establecimiento_servicio`) REFERENCES `establecimiento_servicio` (`id_establecimiento_servicio`),
  CONSTRAINT `prereserva_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prereserva`
--

LOCK TABLES `prereserva` WRITE;
/*!40000 ALTER TABLE `prereserva` DISABLE KEYS */;
INSERT INTO `prereserva` VALUES (10,'2015-10-15 17:00:00',4,2,11),(11,'2015-10-15 17:00:00',2,2,11),(12,'2014-12-31 12:59:00',2,5,8),(13,'2011-10-28 11:57:00',1,5,8),(14,'2013-10-31 22:57:00',2,3,8),(15,'2016-02-02 14:01:00',3,13,14),(16,'2015-10-22 15:02:00',3,13,13),(17,'2015-10-31 20:08:00',9,16,13),(18,'2015-12-16 15:01:00',5,16,13),(19,'2015-10-29 14:01:00',1,5,13),(20,'2015-11-25 14:01:00',6,16,13),(21,'2015-10-31 21:00:00',2,16,13),(22,'2016-01-28 15:00:00',6,13,13),(23,'2016-02-24 13:04:00',2,3,13),(24,'2015-10-31 07:07:00',2,13,13),(25,'2015-10-30 02:02:00',1,5,13),(26,'2015-10-18 14:01:00',2,3,14),(27,'2015-10-25 12:57:00',5,13,14);
/*!40000 ALTER TABLE `prereserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicio` (
  `id_servicio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicio`
--

LOCK TABLES `servicio` WRITE;
/*!40000 ALTER TABLE `servicio` DISABLE KEYS */;
INSERT INTO `servicio` VALUES (1,'Hospedaje',NULL),(2,'Lavanderia',NULL),(3,'Buffet',NULL),(4,'Comida a la Carta',NULL),(5,'Mecanica General','Mecanica general en vehiculos japoneses.'),(6,'Electromecanica','Servicio al sistema electrico de los autos.'),(7,'Balanceo','Alineacion y balanceo de autos'),(8,'Enderazado y pintura','Enderazado y pintura'),(9,'Bar',NULL),(10,'Comida Rapida','Comida rapoda'),(11,'Almuerzos','almuerzo');
/*!40000 ALTER TABLE `servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL,
  `id_establecimiento` int(10) unsigned DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_establecimiento` (`id_establecimiento`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_establecimiento`) REFERENCES `establecimiento` (`id_establecimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (8,'usuario1','user1@correo.com',11223344,'especial',1,'123'),(11,'usuario2','user2@ggg.c',123456,'normal',NULL,'321'),(12,'admin','a@correo.com',555555,'administrador',NULL,'admin'),(13,'u2','correo@correo.com',4,'normal',NULL,'55'),(14,'don mynor','mynor@c.com',4443322,'especial',23,'123');
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

-- Dump completed on 2015-11-12 18:30:53
