-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: rc_computers_ventas
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Table structure for table `carrito_usuario`
--

DROP TABLE IF EXISTS `carrito_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrito_usuario` (
  `id_cart` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsuario` tinyint(3) unsigned NOT NULL,
  `idPrd` int(10) unsigned NOT NULL,
  `cantidadPc` tinyint(3) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_cart`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idPrd` (`idPrd`),
  CONSTRAINT `carrito_usuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  CONSTRAINT `carrito_usuario_ibfk_2` FOREIGN KEY (`idPrd`) REFERENCES `pc_venta` (`idPrd`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito_usuario`
--

LOCK TABLES `carrito_usuario` WRITE;
/*!40000 ALTER TABLE `carrito_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idCategoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(45) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Microprocesador'),(2,'Motherboard'),(3,'Memoria RAM'),(4,'Disco Duro'),(5,'Disco Sólido'),(6,'Placa de video'),(7,'Gabinete'),(8,'Fuente'),(9,'Mouse'),(10,'Teclado'),(11,'Cooler'),(12,'Parlante'),(13,'Webcam'),(14,'Placa WiFi'),(15,'Computadora Escritorio');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `idCli` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsuario` tinyint(3) unsigned DEFAULT NULL,
  `CliProvincia` varchar(100) NOT NULL,
  `CliCiudad` varchar(100) NOT NULL,
  `CliCalle` varchar(100) NOT NULL,
  `CliAltura` tinyint(3) unsigned NOT NULL,
  `CliPiso` tinyint(3) unsigned NOT NULL,
  `CliDepto` tinyint(3) unsigned NOT NULL,
  `CliTorre` tinyint(3) unsigned NOT NULL,
  `CliLocalidad` varchar(100) NOT NULL,
  `CliPostal` tinyint(3) unsigned NOT NULL,
  `CliObser` varchar(400) DEFAULT NULL,
  `telefono` int(10) unsigned DEFAULT NULL,
  `dniCuit` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idCli`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (16,22,'Entre Rios','La guampa seca','la guampetasecota',12,2,3,22,'Villa General Belgrano',255,'GUARDA CHANGO QUE AHI VIENE :O',32131,232322),(17,28,'Corrientes','coshientes','calle coshientes',12,2,3,2,'juan domingo peron',255,'Soy peron jeje',123321312,10229931);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca` (
  `idMarca` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreMarca` varchar(100) NOT NULL,
  PRIMARY KEY (`idMarca`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'AMD'),(2,'Intel'),(3,'MagnumTech'),(4,'CoolerMaster'),(5,'Cromax'),(6,'Thermaltake'),(7,'MSI'),(8,'Aureox'),(9,'Gigabyte'),(10,'ASUS'),(11,'AsRock'),(12,'Kingston'),(13,'Crucial'),(14,'Corsair'),(15,'Patriot'),(16,'HP'),(17,'Adata'),(18,'Netac'),(19,'Seagate'),(20,'Western Digital'),(21,'EVGA'),(22,'Trust Ziva'),(23,'TP-Link'),(24,'Nvidia'),(25,'Id Cooling');
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orden__venta`
--

DROP TABLE IF EXISTS `orden__venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden__venta` (
  `idOrdenVenta` int(11) NOT NULL AUTO_INCREMENT,
  `nroVenta` int(10) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `importe` float unsigned NOT NULL,
  `cantidad` int(10) unsigned NOT NULL,
  `condicionPago` varchar(250) NOT NULL,
  `idPrd` int(10) unsigned NOT NULL,
  `envio` int(11) NOT NULL,
  `transporte` varchar(45) NOT NULL,
  `comprobantePago` varchar(200) DEFAULT 'Aun sin emitir',
  `factura` varchar(200) DEFAULT 'Aun sin emitir',
  `idUsuario` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`idOrdenVenta`),
  KEY `idPrd` (`idPrd`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `idPrd` FOREIGN KEY (`idPrd`) REFERENCES `productos` (`idPrd`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `orden__venta_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden__venta`
--

LOCK TABLES `orden__venta` WRITE;
/*!40000 ALTER TABLE `orden__venta` DISABLE KEYS */;
INSERT INTO `orden__venta` VALUES (13,1700164859,'2023-11-16',70963,1,'Transf/Depo Bancario',3,2300,'Andreani','Comprobante Orden NRO  - Diego Maradona.pdf','Aun sin emitir',22),(14,1700164859,'2023-11-16',85600,1,'Transf/Depo Bancario',6,2300,'Andreani','Comprobante Orden NRO  - Diego Maradona.pdf','Aun sin emitir',22),(15,1700164859,'2023-11-16',31500,1,'Transf/Depo Bancario',7,2300,'Andreani','Comprobante Orden NRO  - Diego Maradona.pdf','Aun sin emitir',22),(16,1700164859,'2023-11-16',125960,1,'Transf/Depo Bancario',10,2300,'Andreani','Comprobante Orden NRO  - Diego Maradona.pdf','Aun sin emitir',22),(17,1700189542,'2023-11-16',335600,1,'Transf/Depo Bancario',25,4300,'Oca','Aun sin emitir','Aun sin emitir',22),(18,1700189542,'2023-11-16',76399,1,'Transf/Depo Bancario',28,4300,'Oca','Aun sin emitir','Aun sin emitir',22),(19,1700276561,'2023-11-18',70963,1,'Transf/Depo Bancario',3,2300,'Andreani','Aun sin emitir','Aun sin emitir',22),(20,1700777326,'2023-11-23',570699,1,'Transf/Depo Bancario',17,2300,'Andreani','Comprobante Orden NRO 1700777326 - Juan Peron.pdf','Aun sin emitir',28),(21,1700777816,'2023-11-23',70963,1,'Transf/Depo Bancario',3,2300,'Andreani','Comprobante Orden NRO 1700777816 - Juan Peron.pdf','Aun sin emitir',28),(22,1700777816,'2023-11-23',125960,1,'Transf/Depo Bancario',10,2300,'Andreani','Comprobante Orden NRO 1700777816 - Juan Peron.pdf','Aun sin emitir',28);
/*!40000 ALTER TABLE `orden__venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(6) NOT NULL,
  `usuEmail` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES (1,'699mid','','2023-11-24 23:08:15',1),(2,'rz14Nn','','2023-11-24 23:08:17',1),(3,'zF9Y1b','','2023-11-24 23:08:19',1),(4,'eLDHGS','','2023-11-24 23:08:21',1),(5,'bTnY4D','','2023-11-24 23:08:23',1),(6,'7oARw9','','2023-11-24 23:08:25',1),(7,'3GwhlE','','2023-11-24 23:08:28',1),(8,'lXpP2p','','2023-11-24 23:08:41',1),(9,'xt7Vz7','','2023-11-24 23:10:49',1),(10,'pL2TAM','','2023-11-24 23:11:01',1),(11,'L1LaG5','','2023-11-24 23:11:39',1),(12,'5eai4G','','2023-11-24 23:49:09',1),(13,'vndjjn','diegote@gmail.com','2023-11-24 23:50:13',1),(14,'4Gjx75','diegote@gmail.com','2023-11-24 23:51:20',1);
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `idPrd` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idMarca` int(10) unsigned NOT NULL,
  `idCategoria` int(10) unsigned NOT NULL,
  `nombrePrd` varchar(300) NOT NULL,
  `precioPrd` float unsigned NOT NULL,
  `stockPrd` int(10) unsigned NOT NULL,
  `descPrd` varchar(500) DEFAULT NULL,
  `estadoPrd` tinyint(4) NOT NULL DEFAULT 1,
  `microPc` varchar(150) DEFAULT '-',
  `motherPc` varchar(150) DEFAULT '-',
  `ramPc` varchar(150) DEFAULT '-',
  `videoPc` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '-',
  `hddPc` varchar(150) DEFAULT '-',
  `ssdPc` varchar(150) DEFAULT '-',
  `fuentePc` varchar(150) DEFAULT '-',
  `gabinetePc` varchar(150) DEFAULT '-',
  `monitorPc` varchar(150) DEFAULT '-',
  `img1` varchar(300) DEFAULT 'sinImagen',
  `img2` varchar(300) DEFAULT 'sinImagen',
  `img3` varchar(300) DEFAULT 'sinImagen',
  `img4` varchar(300) DEFAULT 'sinImagen',
  `nucleosMicro` int(11) DEFAULT NULL,
  `hilosMicro` int(11) DEFAULT NULL,
  `socketMicro` varchar(45) DEFAULT '-',
  `frecuenciaBaseMicro` float DEFAULT NULL,
  `frecuenciaMaxMicro` float DEFAULT NULL,
  `cacheL1Micro` int(11) DEFAULT NULL,
  `cacheL2Micro` int(11) DEFAULT NULL,
  `cacheL3Micro` int(11) DEFAULT NULL,
  `graficosIntegrados` tinyint(1) DEFAULT NULL,
  `modeloGraficosIntegradosMicro` varchar(100) DEFAULT '-',
  `cooler` tinyint(1) DEFAULT NULL,
  `tdpMicro` varchar(45) DEFAULT '-',
  `tempMaximaMicro` varchar(45) DEFAULT '-',
  `litografiaMicro` varchar(45) DEFAULT '-',
  `socketMother` varchar(400) DEFAULT '-',
  `chipsetMother` varchar(45) DEFAULT '-',
  `factorFormaMother` varchar(45) DEFAULT '-',
  `slotsRamMother` int(11) DEFAULT NULL,
  `cantMaxRamMother` int(11) DEFAULT NULL,
  `velocidadMaxRamMother` int(11) DEFAULT NULL,
  `cantCanalesRamMother` int(11) DEFAULT NULL,
  `slotsExpasionMother` varchar(1000) DEFAULT '-',
  `cantSataMother` int(11) DEFAULT NULL,
  `interfazm2Mother` tinyint(1) DEFAULT NULL,
  `cantPuertosM2Mother` int(11) DEFAULT NULL,
  `lanMother` tinyint(1) DEFAULT NULL,
  `wifiMother` tinyint(1) DEFAULT NULL,
  `bluetoothMother` tinyint(1) DEFAULT NULL,
  `chipsetAudioMother` varchar(150) DEFAULT '-',
  `puertosUsb20Mother` int(11) DEFAULT NULL,
  `puertosUsb30Mother` int(11) DEFAULT NULL,
  `cantDisplayPortMother` int(11) DEFAULT NULL,
  `cantHdmiMother` int(11) DEFAULT NULL,
  `cantVgaMother` int(11) DEFAULT NULL,
  `flashBiosButtonMother` tinyint(1) DEFAULT NULL,
  `ddrMemoriaRam` varchar(45) DEFAULT '-',
  `tamanioMemoriaRam` int(11) DEFAULT NULL,
  `velocidadMemoriaRam` int(11) DEFAULT NULL,
  `latenciaMemoriaRam` int(11) DEFAULT NULL,
  `disipadorMemoriaRam` tinyint(1) DEFAULT NULL,
  `colorMemoriaRam` varchar(45) DEFAULT '-',
  `compatibilidadMemoriaRam` varchar(45) DEFAULT '-',
  `microarquitecturaPlacaVideo` varchar(45) DEFAULT '-',
  `frecuenciaBasePlacaVideo` int(11) DEFAULT NULL,
  `frecuenciaMaximaPlacaVideo` int(11) DEFAULT NULL,
  `tipoPciePlacaVideo` varchar(45) DEFAULT '-',
  `gddrPlacaVideo` varchar(45) DEFAULT '-',
  `tamanioMemoriaPlacaVideo` int(11) DEFAULT NULL,
  `busPlacaVideo` int(11) DEFAULT NULL,
  `multiplesPantallasPlacaVideo` tinyint(1) DEFAULT NULL,
  `numeroFanCoolersPlacaVideo` int(11) DEFAULT NULL,
  `displayPortPlacaVideo` int(11) DEFAULT NULL,
  `hdmiPlacaVideo` int(11) DEFAULT NULL,
  `dviPlacaVideo` int(11) DEFAULT NULL,
  `anchoPlacaVideo` int(11) DEFAULT NULL,
  `largoPlacaVideo` int(11) DEFAULT NULL,
  `pesoPlacaVideo` int(11) DEFAULT NULL,
  `factorFormaDiscoDuro` float DEFAULT NULL,
  `interfazDiscoDuro` varchar(45) DEFAULT NULL,
  `capacidadDiscoDuro` int(11) DEFAULT NULL,
  `rpmDiscoDuro` int(11) DEFAULT NULL,
  `memoriaCacheDiscoDuro` int(11) DEFAULT NULL,
  `lecturaEscrituraDiscoDuro` int(11) DEFAULT NULL,
  `factorFormaDiscoSolido` int(11) DEFAULT NULL,
  `interfazDiscoSolido` varchar(45) DEFAULT '-',
  `capacidadDiscoSolido` int(11) DEFAULT NULL,
  `lecturaDiscoSolido` int(11) DEFAULT NULL,
  `escrituraDiscoSolido` int(11) DEFAULT NULL,
  `certificacionFuente` varchar(45) DEFAULT '-',
  `potenciaFuente` int(11) DEFAULT NULL,
  `factorFormaFuente` varchar(45) DEFAULT '-',
  `tamanioFanCoolerFuente` int(11) DEFAULT NULL,
  `conectorMother204PinFuente` int(11) DEFAULT NULL,
  `conectorCpu44PinFuente` int(11) DEFAULT NULL,
  `conectorCpu8PinFuente` int(11) DEFAULT NULL,
  `conectorSataFuente` int(11) DEFAULT NULL,
  `conectorMolex4PinFuente` int(11) DEFAULT NULL,
  `conectorFloppy4PinFuente` int(11) DEFAULT NULL,
  `conectorPcie62PinFuente` int(11) DEFAULT NULL,
  `conectorPcie124Pin` int(11) DEFAULT NULL,
  `iluminacionCoolerFuente` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idPrd`),
  KEY `idMarca` (`idMarca`),
  KEY `idCategoria` (`idCategoria`),
  CONSTRAINT `idCategoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idMarca` FOREIGN KEY (`idMarca`) REFERENCES `marca` (`idMarca`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (3,2,1,'Celeron G6900',70963,1,'Procesador Intel de 4 núcleos y 4 hilos con una secuencia base de 3.4GHz.',1,'-','-','-','-','-','-','-','-','-','celeron 6900.jpg','1699414992.png','sinImagen.png','sinImagen.png',2,2,'FCLGA1700',3.4,3.4,4,2,0,1,'Gráficos UHD Intel 710',1,'46W','100°C','Intel 7','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',0,0,0,NULL,'-','-','-',0,0,'-','-',0,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,'-',0,0,0,0,0,'-',0,0,NULL,'-',0,'-',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,10,2,'Prime A320M-K',85600,3,'Motherboard para uso de procesadores AMD',1,'-','-','-','-','-','-','-','-','-','asus prime a320m k.jpg','sinImagen.png','sinImagen.png','sinImagen.png',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','AM4','AMD A320','Micro ATX',2,32,2666,2,' x PCI Express 3.0 x16 (x16 mode), 1 x PCI Express 3.0 x16 (x4 mode), 1 x PCI Express 3.0 x16 (x8 mode), 2 x PCI Express 2.0 x1',4,1,1,1,0,0,'Realtek ALC887 8-Channel High Definition Audio CODEC',2,4,0,1,1,0,'-',0,0,0,NULL,'-','-','-',0,0,'-','-',0,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,'-',0,0,0,0,0,'-',0,0,NULL,'-',0,'-',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,14,3,'Vengeance LPX Black 8GB DDR4 3000MHz',31500,6,'Memoria RAM para equipos orientados al gaming',1,'-','-','-','-','-','-','-','-','-','corsairmemo.png','sinImagen.png','sinImagen.png','sinImagen.png',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'DDR4',8,3000,16,1,'Negro','DIMM','-',0,0,'-','-',0,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,'-',0,0,0,0,0,'-',0,0,NULL,'-',0,'-',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,1,6,'Radeon RX 550 2GB DDR5 BULK',125960,1,'Placa de video AMD tipo BULK ideal para equipos orientados al gaming casual',1,'-','-','-','-','-','-','-','-','-','Radeon RX 550 2GB GDDDR5 BULK.png','sinImagen.png','sinImagen.png','sinImagen.png',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,'-','-','-',1135,1230,'PCI-Express 3.0','GDDR5',2,64,0,1,0,1,0,170,112,598,0,'-',0,0,0,0,0,'-',0,0,NULL,'-',0,'-',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,20,4,'Blue 1TB SATA',45660,1,'Disco duro SATA con 1000GB de capacidad y 7200RPM',1,'-','-','-','-','-','-','-','-','-','1699626882.png','1699626858.jpg','1699626858.jpg','1699626858.jpg',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,'-','-','-',NULL,NULL,'-','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3.5,'SATA',1000,7200,64,NULL,0,'-',0,0,NULL,'-',0,'-',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,9,5,'240GB SATA',18000,1,'Disco solido SATA con capacidad de 240GB',1,'-','-','-','-','-','-','-','-','-','ssd 240 kingston a400.png','sinImagen.png','sinImagen.png','sinImagen.png',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,'-','-','-',NULL,NULL,'-','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,'SATA',240,500,350,'-',0,'-',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,9,8,'P650B 650W 80 Plus Bronze',73950,2,'Fuente con certificacion 80 plus bronze ideal para gaming',1,'-','-','-','-','-','-','-','-','-','fuente giga 650w.jpg','sinImagen.png','sinImagen.png','sinImagen.png',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,'-','-','-',NULL,NULL,'-','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,'80 Plus Bronze',650,'ATX',120,1,1,1,6,3,1,4,1,0),(14,1,1,'Ryzen 3 3200G',93400,2,'',1,'-','-','-','-','-','-','-','-','-','1698689948.jpg','sinImagen.png','sinImagen.png','sinImagen.png',4,4,'AM4',3.6,4,384,2,0,1,'VEGA 8',1,'65','95','12nm','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,'-','-','-',NULL,NULL,'-','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,'-',NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,2,1,'Core i3 12100',194299,2,'',1,'-','-','-','-','-','-','-','-','-','1698882875.jpg','1698882875.jpg','sinImagen.png','sinImagen.png',4,8,'FCLGA1700',3.3,4.3,12,5,0,1,'Intel HD Graphics 730',1,'89','100','x86-64','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,'-','-','-',NULL,NULL,'-','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,'-',NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,1,15,'Pc Gamer Amd Nueva Ryzen 3 3200g 16gb 1tb Fortnite Gta Lol',570699,3,'Computadora hogareña/gamer de gama media con una excelente relación precio/calidad/rendimiento, optimizada para poder correr cualquier juego en calidades espectaculares, al mismo tiempo que nos permite pensar en su mejora y actualización a mediano y largo plazo.',1,'AMD Ryzen 3 3200G 3.6GHZ AM4 C/Video','ASUS Prime A320M-K','2 x Corsair Vengeance LPX Black 8GB DDR4 3000MHz','Gráficos integrados VEGA 8','HDD Western Digital Blue 1TB','','600w Kit Kelyx','Modelo LC728-12 Fuente 500W Tec/Mouse','','1699413321.png','1699413382.jpg','1698939675.jpg','1698939675.png',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,'-','-','-',NULL,NULL,'-','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,'-',NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,1,2,'PRO H610M-G DDR4',82100,1,'Motherboard con socket para procesadores Intel.',1,'-','-','-','-','-','-','-','-','-','1698971126.png','sinImagen.png','sinImagen.png','sinImagen.png',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','LGA1700','Intel® H610 Chipset','M-ATX',2,64,3200,NULL,'1x PCIe 4.0/3.0 x16,1x PCIe 3.0 x1',4,1,1,1,0,0,'Realtek® ALC892/ ALC897 Codec',6,4,1,1,1,0,'-',NULL,NULL,NULL,NULL,'-','-','-',NULL,NULL,'-','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,'-',NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,12,3,'Fury Beast 8GB DDR4 3200MHz',17700,2,'Memoria ram ddr4 8gb 3200MHz',1,'-','-','-','-','-','-','-','-','-','1699227417.jpg','sinImagen.png','sinImagen.png','sinImagen.png',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'DDR4',8,3200,16,1,'Negro','UDIMM','-',NULL,NULL,'-','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,'-',NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,10,6,'GeForce GTX 1660 SUPER 6GB GDDR6 OC TUF',335600,1,'Placa de video orientada al gaming para equipos de gama alta.',1,'-','-','-','-','-','-','-','-','-','1699238566.jpg','sinImagen.png','sinImagen.png','sinImagen.png',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,'-','-','-',1400,1845,'PCIe 3.0','GDDR6',6,192,1,2,1,1,1,124,206,1277,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,'-',NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,9,5,'240GB SATA Interno 7mm',12400,1,'Disco solido SATA con capacidad de 240GB',1,'-','-','-','-','-','-','-','-','-','1699326703.jpg','sinImagen.png','sinImagen.png','sinImagen.png',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,'-','-','-',NULL,NULL,'-','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,'SATA',240,500,420,'-',NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,6,8,'Smart White 500w 80 Plus',76399,1,'Fuente certificada 80 Plus White',1,'-','-','-','-','-','-','-','-','-','1699383173.jpg','sinImagen.png','sinImagen.png','sinImagen.png',NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,'-','-','-','-','-','-',NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,NULL,'-','-','-',NULL,NULL,'-','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'-',NULL,NULL,NULL,'80 Plus White',500,'ATX',120,1,0,0,6,0,1,2,NULL,0);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `idRol` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) NOT NULL,
  PRIMARY KEY (`idRol`),
  UNIQUE KEY `rol` (`rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'Usuario');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idUsuario` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `usuNombre` varchar(100) NOT NULL,
  `usuApellido` varchar(100) NOT NULL,
  `usuEmail` varchar(100) NOT NULL,
  `usuClave` varchar(72) NOT NULL,
  `idRol` tinyint(3) unsigned NOT NULL DEFAULT 2,
  `usuActivo` tinyint(1) DEFAULT 1,
  `usuImg` varchar(200) DEFAULT 'userIconDefault.png',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `usuEmail` (`usuEmail`),
  KEY `idRol` (`idRol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (3,'Ramiro','Unrein','unreinramiro2000@gmail.com','$2y$10$Wgbx4kYDfTFQPrnbhQKyrOMOfcGhFZ6coS9b3TK7SXr3aKKXiulzC',1,1,'1700245306.JPG'),(22,'Diego','Maradona','diegote@gmail.com','$2y$10$IJnnS/PqqpyVBMMckciJme/xQKdNaZKTFoPhSfef7VE040LGSpiRW',2,1,'1700245339.jpg'),(25,'Wanchope','Abila','wancho@gmail.com','$2y$10$RIWhlkr1CypOnU2xtvl4puvnguj2A08SvcnrHMn47DjmsmwL/AQwm',2,1,'userIconDefault.png'),(28,'Juan','Peron','peroncho@gmail.com','$2y$10$.q03pxv0T9qUQLcljNPrzeuINPtDtvqDwbX9rX.owZuC6TcZPNlbO',2,1,'userIconDefault.png');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-24 20:55:43
