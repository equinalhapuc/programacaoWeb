-- MariaDB dump 10.19  Distrib 10.8.3-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: coisas
-- ------------------------------------------------------
-- Server version	10.8.3-MariaDB-1:10.8.3+maria~jammy

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
-- Current Database: `coisas`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `coisas` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `coisas`;

--
-- Table structure for table `emprestimo`
--

DROP TABLE IF EXISTS `emprestimo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emprestimo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idItem` int(11) NOT NULL,
  `idDestinatario` int(11) NOT NULL,
  `dataEmprestimo` varchar(30) NOT NULL,
  `dataCombinada` varchar(30) DEFAULT NULL,
  `dataDevolucao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idItem` (`idItem`),
  KEY `idDestinatario` (`idDestinatario`),
  CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`idItem`) REFERENCES `item` (`id`),
  CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`idDestinatario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emprestimo`
--

LOCK TABLES `emprestimo` WRITE;
/*!40000 ALTER TABLE `emprestimo` DISABLE KEYS */;
INSERT INTO `emprestimo` VALUES
(36,5,10,'2022-11-21',NULL,NULL),
(37,7,8,'2022-11-21','2022-11-23',NULL),
(38,8,7,'2022-11-21','2022-11-28',NULL),
(39,9,9,'2022-11-21',NULL,NULL),
(40,12,8,'2022-11-21','2022-11-16',NULL),
(41,14,8,'2022-11-21','2022-11-30',NULL);
/*!40000 ALTER TABLE `emprestimo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `proprietario` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proprietario` (`proprietario`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`proprietario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES
(5,'Prancha de surf','Prancha de surf tamanho 6,2 marca Mormaii',9,1),
(6,'Violão folk','Violão elétrico tipo folk com cordas de aço',9,0),
(7,'Máquina Fotográfica','Máquina semi-profissional DSLR marca Sony',9,1),
(8,'Carregador de bateria portátil','Carregador de bateria automotiva portátil 50Ah',8,1),
(9,'Furadeira Bosch','Furadeira Bosch com kit de brocas',8,1),
(10,'Serra circular','Serra circular para madeira e MDF',8,0),
(11,'Parafusadeira 12V','Parafusadeira Black & Decker 12V com jogo de bits',8,0),
(12,'Violão 12 cordas','Vilão eagle de 12 cordas',10,1),
(13,'Baixo Ibanez','Baixo Ibanez preto 4 cordas',10,0),
(14,'Microfone Shure','Microfone Shure SM57 com pedestal e cabo',10,1);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `sobrenome` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES
(7,'Admin','admin','admin@coisasemprestadas.com','$2y$10$BN38HvzZcdZrEPFVcOlb0uUn1PFjNKjL/kbuGYTfkIDhtz8wmNPgm',1),
(8,'João','da Silva','joao@hotmail.com','$2y$10$sGItpJ.0jmjlsPwECZR1huvUsdIHIQhdJs1WA1w7Nh28fs0p3SIji',0),
(9,'Pedro','Henrique','pedro@gmail.com','$2y$10$qxy6SUdid2b1WThFaAjPAuyUM80yP.RXPyXxzX3AkojkXgjwRRFxi',0),
(10,'Robert','Trujillo','robert@msn.com','$2y$10$0VL32MnOB799jeFBbdcwPuaF1ckCxfjpM3DSqODAnOfT2YTnRpDIW',0),
(11,'Renato','Russo','renatorusso@gmail.com','$2y$10$bbDj5RjOeT688pjGpfoQ5uku22iaR.1brBuuWyqgt4GtZsX7nuUGi',1),
(12,'Bruce','Dickinson','bruce@ironmaiden.com','$2y$10$pglVpjmFeovFXJ.q0kmki.B0gnONwYg6/aG.AOu0IQLnAtxdYC35S',0);
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

-- Dump completed on 2022-11-21  1:36:37