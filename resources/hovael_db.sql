-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: hovael
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `drc`
--

DROP TABLE IF EXISTS `drc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventory` int(11) NOT NULL,
  `idsite` int(11) NOT NULL,
  `officer` varchar(45) DEFAULT NULL,
  `driver` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `journey` varchar(45) DEFAULT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `startmeter` double DEFAULT NULL,
  `endmeter` double DEFAULT NULL,
  `officialkm` double DEFAULT NULL,
  `privatekm` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_drc_inventory1_idx` (`idinventory`),
  KEY `fk_drc_site1_idx` (`idsite`),
  CONSTRAINT `fk_drc_inventory1` FOREIGN KEY (`idinventory`) REFERENCES `inventory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_drc_site1` FOREIGN KEY (`idsite`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drc`
--

LOCK TABLES `drc` WRITE;
/*!40000 ALTER TABLE `drc` DISABLE KEYS */;
INSERT INTO `drc` VALUES (1,3,2,'O','D','2015-07-29','Jrtyetyrtyrty','00:00:00','00:00:00',1000,2000,10,20,1),(2,4,3,'Officer','DDD','2015-07-31','Journey','00:00:00','00:00:00',1000,2000,750,250,1),(3,3,2,'Lakmal','Chanaka','2015-07-31','Head Office - Dompe','14:00:00','19:00:00',2750,3500,500,100,2),(4,3,1,'A','A','2015-08-19','A','08:22:00','14:52:00',1520,2000,10,0,1),(5,3,1,'A','A','2015-08-19','A','08:00:00','10:00:00',1234,6522,1000,32,1),(7,33,1,'tyj','ujjt','2015-08-20','fghfg','13:01:00','01:01:00',1256,1289,2,5,1);
/*!40000 ALTER TABLE `drc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drme`
--

DROP TABLE IF EXISTS `drme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventory` int(11) NOT NULL,
  `idsite` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `helper` varchar(45) DEFAULT NULL,
  `startmeter` double DEFAULT NULL,
  `endmeter` double DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_drme_site1_idx` (`idsite`),
  KEY `fk_drme_inventory1_idx` (`idinventory`),
  CONSTRAINT `fk_drme_inventory1` FOREIGN KEY (`idinventory`) REFERENCES `inventory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_drme_site1` FOREIGN KEY (`idsite`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drme`
--

LOCK TABLES `drme` WRITE;
/*!40000 ALTER TABLE `drme` DISABLE KEYS */;
INSERT INTO `drme` VALUES (3,7,4,'2015-08-01','Oper','Hel',1000,2000,'R',2),(4,9,2,'2015-08-01','Operator','Helper',2555,3500,'Remarks',1),(31,5,1,'2015-08-15','Operator Name','Helper Name',1234,5678,'Remarks',1);
/*!40000 ALTER TABLE `drme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drmeactivity`
--

DROP TABLE IF EXISTS `drmeactivity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drmeactivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddrme` int(11) NOT NULL,
  `activityno` varchar(45) DEFAULT NULL,
  `worktype` varchar(45) DEFAULT NULL,
  `areacut` varchar(45) DEFAULT NULL,
  `areafill` varchar(45) DEFAULT NULL,
  `material` varchar(45) DEFAULT NULL,
  `hours` varchar(45) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_drmeinfo_drme1_idx` (`iddrme`),
  CONSTRAINT `fk_drmeinfo_drme1` FOREIGN KEY (`iddrme`) REFERENCES `drme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drmeactivity`
--

LOCK TABLES `drmeactivity` WRITE;
/*!40000 ALTER TABLE `drmeactivity` DISABLE KEYS */;
INSERT INTO `drmeactivity` VALUES (1,3,'1','W1','10','20','M1','10','R1'),(2,3,'2','W2','30','40','M2','50','R2'),(3,4,'1','Work1','22','55','Material1','12','Re1'),(4,4,'2','Work2','27','63','Material2','29','Re2'),(5,4,'3','Work3','54','65','Material3','13','Remarks'),(6,4,'4','Work4','65','83','Mat4','34','Re4'),(56,31,'1','Work Type 1','Area (cut) 1','Area (fill) 1','Material 1','10','Remarks 1'),(57,31,'2','Work Type 2','Area (cut) 2','Area (fill) 2','Material 2','20','Remarks 2');
/*!40000 ALTER TABLE `drmeactivity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuelbook`
--

DROP TABLE IF EXISTS `fuelbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuelbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventory` int(11) NOT NULL,
  `idsite` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `meterreading` double DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fuelbook_fuelstock1_idx` (`idsite`),
  KEY `fk_fuelbook_inventory1_idx` (`idinventory`),
  CONSTRAINT `fk_fuelbook_inventory1` FOREIGN KEY (`idinventory`) REFERENCES `inventory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fuelbook_site1` FOREIGN KEY (`idsite`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuelbook`
--

LOCK TABLES `fuelbook` WRITE;
/*!40000 ALTER TABLE `fuelbook` DISABLE KEYS */;
INSERT INTO `fuelbook` VALUES (1,3,2,'Petrol','2015-07-26',10,1258.2,'Re',1),(2,3,5,'Petrol','2015-08-03',25,1500,'Remarks',1),(3,4,5,'Petrol','2015-08-03',15,100,'Rem',1),(4,2,5,'Diesel','2015-08-03',12,500,'',1),(5,3,4,'Petrol','2015-08-12',10,1000,'',1),(6,6,1,'Diesel','2015-08-16',15,1234,'RRR',1),(7,3,1,'Petrol','2015-08-16',10,12345,'R1',1),(8,3,1,'Petrol','2015-08-16',20,12345,'R2',1),(9,3,1,'Petrol','2015-08-16',30,12345,'R3',1),(10,3,1,'Petrol','2015-08-16',50,12345,'R3',1),(11,3,1,'Petrol','2015-08-16',9875,12345,'R4',1),(12,3,1,'Petrol','2015-08-16',1,123456,'R5',1),(13,3,1,'Petrol','2015-08-16',14,12345,'R6',1),(14,5,1,'Diesel','2015-08-16',14000,12,'R7',1),(15,1,1,'Petrol','2015-08-19',50,1253,'',1),(16,6,1,'Diesel','2015-08-19',1000,5000,'',1),(17,5,1,'Diesel','2015-08-19',500,5500,'',1),(18,4,1,'Petrol','2015-08-19',100,5000,'',1);
/*!40000 ALTER TABLE `fuelbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuelconsumptionrate`
--

DROP TABLE IF EXISTS `fuelconsumptionrate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuelconsumptionrate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventorytype` int(11) NOT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `hirerate` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fuelconsumptionrate_inventorytype1_idx` (`idinventorytype`),
  CONSTRAINT `fk_fuelconsumptionrate_inventorytype1` FOREIGN KEY (`idinventorytype`) REFERENCES `inventorytype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuelconsumptionrate`
--

LOCK TABLES `fuelconsumptionrate` WRITE;
/*!40000 ALTER TABLE `fuelconsumptionrate` DISABLE KEYS */;
INSERT INTO `fuelconsumptionrate` VALUES (1,1,'1','','6.00#0',1),(5,2,'0','','8.00#0',1),(6,3,'1','','5.0',1),(9,8,'0','','2.0',1),(10,18,'1','','6.0#6.5',1),(11,17,'1','','6.0#6.5',1);
/*!40000 ALTER TABLE `fuelconsumptionrate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuelstock`
--

DROP TABLE IF EXISTS `fuelstock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuelstock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsite` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fuelstock_site1_idx` (`idsite`),
  CONSTRAINT `fk_fuelstock_site1` FOREIGN KEY (`idsite`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuelstock`
--

LOCK TABLES `fuelstock` WRITE;
/*!40000 ALTER TABLE `fuelstock` DISABLE KEYS */;
INSERT INTO `fuelstock` VALUES (1,3,'2015-06-18','Petrol',125.15,150.75,1),(2,2,'2015-06-27','Diesel',110.1,500,1),(3,2,'2015-06-30','Petrol',112,1000,1),(4,1,'2015-06-30','Petrol',112,10000,1),(5,1,'2015-07-10','Diesel',108.5,10000,1),(6,1,'2015-07-23','Diesel',95.75,5000,1),(7,8,'2015-06-30','Petrol',130,1000,1),(8,4,'2015-08-16','Petrol',125,20000,1),(9,5,'2015-08-18','Petrol',125,10000,1),(10,5,'2015-08-18','Diesel',118.75,5000,1),(11,1,'2015-08-19','Petrol',132,10000,1),(12,1,'2015-08-19','Diesel',125,5000,1),(13,3,'2015-08-19','Petrol',132,10000,1),(14,3,'2015-08-19','Diesel',125,10000,1),(15,4,'2015-08-19','Diesel',125,10000,1),(16,6,'2015-08-19','Petrol',132,10000,1),(17,6,'2015-08-19','Diesel',125,5000,1),(18,8,'2015-08-19','Diesel',125,7000,1),(19,9,'2015-08-19','Petrol',132,10000,1),(20,9,'2015-08-19','Diesel',125,10000,1);
/*!40000 ALTER TABLE `fuelstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interface`
--

DROP TABLE IF EXISTS `interface`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interface`
--

LOCK TABLES `interface` WRITE;
/*!40000 ALTER TABLE `interface` DISABLE KEYS */;
/*!40000 ALTER TABLE `interface` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `internalhirerate`
--

DROP TABLE IF EXISTS `internalhirerate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `internalhirerate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventorytype` int(11) NOT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `estimatedhrs` double(20,0) DEFAULT NULL,
  `rate` double(10,0) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_internalhirerate_inventorytype1_idx` (`idinventorytype`),
  CONSTRAINT `fk_internalhirerate_inventorytype1` FOREIGN KEY (`idinventorytype`) REFERENCES `inventorytype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internalhirerate`
--

LOCK TABLES `internalhirerate` WRITE;
/*!40000 ALTER TABLE `internalhirerate` DISABLE KEYS */;
INSERT INTO `internalhirerate` VALUES (11,1,'1',8,3000,1),(12,2,'1',8,3000,1),(13,8,'0',4,3500,1),(15,22,'1',45,76,1);
/*!40000 ALTER TABLE `internalhirerate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventorytype` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `regno` varchar(45) DEFAULT NULL,
  `engno` varchar(45) DEFAULT NULL,
  `sno` varchar(45) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hireinternal` varchar(20) DEFAULT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inventory_inventorytype1_idx` (`idinventorytype`),
  CONSTRAINT `fk_inventory_inventorytype1` FOREIGN KEY (`idinventorytype`) REFERENCES `inventorytype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,3,'HAC/17','qwe-234151','','B4-6C12644',2015,'2015-03-07','INTERNAL','',1),(2,3,'HAC/18','','234','B4-6C12645',2010,'2014-06-09','INTERNAL',' A. ANURA BANDARA',1),(3,1,'HAC/06','65-3040','1KZ 0624193','JT111GJ950-0107938',1998,'2011-09-05','INTERNAL','',1),(4,2,'HCA/07','65-3779','2C3278291','CT215-0001452',1996,'2013-08-20','INTERNAL','D.G.G. KARUNARATHNA',1),(5,5,'HAP/01','',NULL,'1023',2005,'2014-01-22','INTERNAL',NULL,1),(6,6,'HAP/02','',NULL,'ANP',2008,'2014-06-30','INTERNAL',NULL,1),(7,6,'HAP/03','',NULL,'BMP 100368',NULL,'2011-09-05','INTERNAL',NULL,1),(8,7,'HCS/01','','','23258',2014,'2009-04-06','INTERNAL',' ',0),(9,8,'HBS/01','LA-1956','TDE 411455','TDR 137022',2005,'2015-01-07','INTERNAL`','M.N.P.RAJLIYAR',1),(10,9,'HAC/30',NULL,'87352876',NULL,2012,'2014-06-29','INTERNAL',NULL,1),(11,9,'HAC/31',NULL,'87352866',NULL,2012,'2014-06-04','INTERNAL',NULL,1),(12,10,'HBC/09',NULL,NULL,NULL,2014,'2014-05-02','INTERNAL',NULL,1),(13,10,'HBC/10',NULL,NULL,NULL,2014,'2014-05-07','INTERNAL',NULL,1),(14,10,'HBC/11',NULL,NULL,NULL,2014,'2014-05-07','INTERNAL',NULL,1),(15,10,'HBC/12',NULL,NULL,NULL,2014,'2014-06-30','INTERNAL',NULL,1),(16,10,'HBC/13',NULL,NULL,NULL,2014,'2014-10-30','INTERNAL',NULL,1),(17,11,'HBS2/21',NULL,'8 hourse power',NULL,2014,'2014-09-16','INTERNAL',NULL,1),(18,11,'HBS2/22',NULL,'8 hourse power',NULL,2014,'2015-02-10','INTERNAL',NULL,1),(19,12,'HBA/07',NULL,NULL,'181V309',NULL,'2013-11-15','INTERNAL',NULL,1),(20,12,'HBA/08',NULL,NULL,'18V283',NULL,'2011-03-02','INTERNAL',NULL,1),(21,13,'HMS/54',NULL,'','1272 N',2014,'2015-03-06','INTERNAL',NULL,1),(22,14,'HPJ/02',NULL,NULL,'6124',2010,'2014-05-05','INTERNAL',NULL,1),(23,15,'HCP/72',NULL,NULL,NULL,2013,'2015-03-17','INTERNAL',NULL,1),(24,15,'HCP/73',NULL,NULL,NULL,2013,'2014-11-21','INTERNAL',NULL,1),(25,15,'HCP/74',NULL,NULL,NULL,2012,'2015-01-29','INTERNAL',NULL,1),(26,16,'HCA/09','65-8785','2C-2525626','CE 106-6015111',1997,'2014-03-24','INTERNAL','W.M SUSANTHA WIJEPALA',1),(27,17,'HTC/02','41-1773','10PC-1946358','CXZ190-2010537',NULL,'2011-09-06','INTERNAL','B.H.N SUNIL',1),(28,18,'HTC/03','43-1341','FD35-0111739','SH40-D06679',NULL,'2015-01-13','INTERNAL',NULL,1),(29,19,'HBB/01',NULL,'161843',NULL,NULL,'2015-01-22','INTERNAL',NULL,1),(30,20,'HBB/02',NULL,'PH 2129210',NULL,NULL,'2015-01-22','INTERNAL',NULL,1),(31,21,'HBP/03',NULL,NULL,NULL,NULL,'2014-07-25','INTERNAL',NULL,1),(32,22,'HBT/01','48-2522','4BEI-21899','NKK58E-7192739',NULL,'2014-04-10','INTERNAL',NULL,1),(33,23,'HBT/02','68-6192','6WA1112267','CYM50V2W-3000388',1997,'2014-04-10','INTERNAL',NULL,1);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventorycat`
--

DROP TABLE IF EXISTS `inventorycat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventorycat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `service` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventorycat`
--

LOCK TABLES `inventorycat` WRITE;
/*!40000 ALTER TABLE `inventorycat` DISABLE KEYS */;
INSERT INTO `inventorycat` VALUES (1,'Air Compressor','Machine','250',1),(2,'Asphalt Cutter','Machine','250',1),(3,'Asphalt Plant','Machine','250',1),(4,'Baby Compressor','Machine','250',1),(5,'Bar Bender','Machine','250',1),(6,'Batching Plant','Machine','250',1),(7,'Bitumen Hand Sprayer','Machine','250',1),(8,'Bitumen Heating Tank','Machine','250',1),(9,'Bitumen Sprayer','Machine','250',1),(10,'Boom Truck','Vehicle','5000',1),(11,'Breaking Attachment','Machine','250',1),(12,'Broom Atachment','Machine','250',1),(13,'Butt Fushion Machine','Machine','250',1),(14,'Cable Pump','Machine','250',1),(15,'Car','Vehicle','5000',1),(16,'Cargo Truck','Vehicle','5000',1),(17,'Chip Spreader','Machine','250',1),(18,'Bus','Equipment','123',1);
/*!40000 ALTER TABLE `inventorycat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventorytype`
--

DROP TABLE IF EXISTS `inventorytype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventorytype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventorycat` int(11) NOT NULL,
  `model` varchar(45) DEFAULT NULL,
  `make` varchar(45) DEFAULT NULL,
  `capacity` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inventorytype_inventorycat1_idx` (`idinventorycat`),
  CONSTRAINT `fk_inventorytype_inventorycat1` FOREIGN KEY (`idinventorycat`) REFERENCES `inventorycat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventorytype`
--

LOCK TABLES `inventorytype` WRITE;
/*!40000 ALTER TABLE `inventorytype` DISABLE KEYS */;
INSERT INTO `inventorytype` VALUES (1,15,'PRADO','TOYOTA','4SEATER','JAPAN',1),(2,15,'CORONA CT-215','TOYOTA','4SEATER','JAPAN',1),(3,1,'PDS185 S-6C1','AIRMAN','','JAPAN',1),(4,2,'GX 390','HONDA','389cm3','CHINA',1),(5,3,'DMX 60','APOLLO','60 TON','INDIA',1),(6,3,'ANP 1500 BATCH','APOLLO','140 TON PH','INDIA',1),(7,17,'HOPPER GRITTER','PHONIX','12.6\' FEET','UK',1),(8,9,'TUSKER SUPER','LAYLAND','4000 lts','INDIA',1),(9,1,'HG 400 M-13','DENAIR','400','CHINA',1),(10,4,'V-025/8','WINS LANKA','100 L','CHINA',1),(11,7,'JR 180 N','HOVAEL FITTING','200 L','SRI LANKA',1),(12,11,'180 V','D&A','1360 KG','KOREA',1),(13,12,'HTS 180','HOWARD TRAMACS',NULL,'CHINA',1),(14,13,'AL-800','TURAN','','TURKEY',1),(15,14,'ENGINE DRIVEN','N/A','2 Inch','CHINA',1),(16,15,'COROLLA CE-106','TOYOTA','4SEATER','JAPAN',1),(17,16,'SXZ 19 Q','ISUZU','20TON','JAPAN',1),(18,16,'ATLES','NISSAN','1.5TON','JAPAN',1),(19,5,'BAR BENDER','PETTER','6.3 hp','ENGLAND',1),(20,5,'BAR BENDER','LISTER',NULL,'ENGLAND',1),(21,6,'HZS 25','N/A',NULL,NULL,1),(22,10,'ELF250','ISUZU','2.5TON','JAPAN',1),(23,10,'GVW22','ISUZU','3TON','JAPAN ',1),(24,18,'Leland','Asok Leyland','50','India',1);
/*!40000 ALTER TABLE `inventorytype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobcard`
--

DROP TABLE IF EXISTS `jobcard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobcard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventory` int(11) NOT NULL,
  `idsite` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `docjobno` varchar(45) DEFAULT NULL,
  `presentmeter` double DEFAULT NULL,
  `nextmeter` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_jobcard_inventory1_idx` (`idinventory`),
  KEY `fk_jobcard_site1_idx` (`idsite`),
  CONSTRAINT `fk_jobcard_inventory1` FOREIGN KEY (`idinventory`) REFERENCES `inventory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_jobcard_site1` FOREIGN KEY (`idsite`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobcard`
--

LOCK TABLES `jobcard` WRITE;
/*!40000 ALTER TABLE `jobcard` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobcard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `un` varchar(45) DEFAULT NULL,
  `pw` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,'admin','202cb962ac59075b964b07152d234b70'),(2,'swethe','3043d11f724809dda2a9eb92c4990482'),(3,'janaka','1b46f82f0dacf493219b27f9a6e7e198'),(4,'chandu','e0f02ccac2830a65efe681c4fe66c6ce'),(5,'sachi','50aa11e75ea77cc494109cc782834a49'),(6,'keet','11c00a50658dc20749a74ef76934f727'),(7,'dimuthu','4f23603c65b6dcbfea9c4fcbbadb828e'),(8,'dulaj','99c250a61a4a159def54c2957f51fc9c'),(9,'chathurka','d11a7bbb8208c1cda2da4757d08fe8bd'),(11,'chamin','1af133466d84bc61704ddb421763d623'),(14,'abc','202cb962ac59075b964b07152d234b70');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginsession`
--

DROP TABLE IF EXISTS `loginsession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loginsession` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intime` timestamp NULL DEFAULT NULL,
  `outtime` timestamp NULL DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `descrip` varchar(45) DEFAULT NULL,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_loginsession_user1_idx` (`iduser`),
  CONSTRAINT `fk_loginsession_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginsession`
--

LOCK TABLES `loginsession` WRITE;
/*!40000 ALTER TABLE `loginsession` DISABLE KEYS */;
INSERT INTO `loginsession` VALUES (5,'2015-06-26 10:28:59','0000-00-00 00:00:00','127.0.0.1',NULL,1),(6,'2015-06-26 10:45:27','2015-06-26 10:45:35','127.0.0.1',NULL,1),(7,'2015-06-26 10:46:14','2015-06-26 10:46:25','127.0.0.1',NULL,2),(8,'2015-06-26 10:49:54','2015-06-26 10:51:00','127.0.0.1',NULL,2),(9,'2015-06-26 10:50:18','2015-06-26 10:51:14','127.0.0.1',NULL,1),(10,'2015-06-26 10:51:36',NULL,'127.0.0.1',NULL,1),(11,'2015-06-26 14:21:46','2015-06-26 14:21:54','127.0.0.1',NULL,1),(12,'2015-06-26 14:22:08','2015-06-26 15:52:06','127.0.0.1',NULL,1),(13,'2015-06-26 16:23:41','2015-06-26 16:27:07','127.0.0.1',NULL,1),(14,'2015-06-26 16:29:31','2015-06-27 12:31:32','127.0.0.1',NULL,1),(15,'2015-06-27 12:32:18',NULL,'127.0.0.1',NULL,1),(16,'2015-06-28 22:25:40','2015-06-28 22:25:43','127.0.0.1',NULL,1),(17,'2015-06-28 22:25:45','2015-06-28 22:27:35','127.0.0.1',NULL,1),(18,'2015-06-28 22:29:17','2015-06-29 01:04:31','127.0.0.1',NULL,1),(19,'2015-06-29 09:47:56','2015-06-29 10:06:10','127.0.0.1',NULL,1),(20,'2015-06-29 11:55:02','2015-06-29 12:57:58','127.0.0.1',NULL,1),(21,'2015-06-29 13:09:26','2015-06-30 01:08:58','127.0.0.1',NULL,1),(22,'2015-06-30 01:09:09','2015-06-30 01:11:24','127.0.0.1',NULL,1),(23,'2015-06-30 01:11:29','2015-06-30 01:12:50','127.0.0.1',NULL,1),(24,'2015-06-30 01:12:55','2015-07-01 11:25:05','127.0.0.1',NULL,1),(25,'2015-07-01 11:25:37','2015-07-01 13:31:56','127.0.0.1',NULL,1),(26,'2015-07-01 22:24:11','2015-07-01 23:25:25','127.0.0.1',NULL,1),(27,'2015-07-01 23:25:31',NULL,'127.0.0.1',NULL,1),(28,'2015-07-02 20:47:22',NULL,'127.0.0.1',NULL,1),(29,'2015-07-02 20:47:43','2015-07-02 20:48:26','127.0.0.1',NULL,1),(30,'2015-07-02 20:48:31','2015-07-02 20:51:48','127.0.0.1',NULL,1),(31,'2015-07-02 20:51:58','2015-07-02 20:52:08','127.0.0.1',NULL,1),(32,'2015-07-02 20:52:11','2015-07-02 20:57:16','127.0.0.1',NULL,1),(33,'2015-07-02 20:58:45','2015-07-02 21:00:22','127.0.0.1',NULL,2),(34,'2015-07-02 21:19:46','2015-07-03 16:41:25','127.0.0.1',NULL,2),(35,'2015-07-05 13:52:40','2015-07-05 14:05:04','127.0.0.1',NULL,1),(36,'2015-07-05 14:05:13','2015-07-05 14:05:25','127.0.0.1',NULL,2),(37,'2015-07-05 14:05:35','2015-07-05 14:05:49','127.0.0.1',NULL,3),(38,'2015-07-05 14:05:55','2015-07-05 14:06:33','127.0.0.1',NULL,4),(39,'2015-07-05 14:07:00','2015-07-05 14:07:14','127.0.0.1',NULL,7),(40,'2015-07-05 14:07:24','2015-07-07 20:30:29','127.0.0.1',NULL,1),(41,'2015-07-07 23:53:46',NULL,'127.0.0.1',NULL,1),(42,'2015-07-08 13:03:14','2015-07-08 21:06:13','127.0.0.1',NULL,1),(43,'2015-07-08 21:06:28','2015-07-08 21:06:39','127.0.0.1',NULL,5),(44,'2015-07-08 21:06:43','2015-07-08 21:14:54','127.0.0.1',NULL,1),(45,'2015-07-08 21:15:00','2015-07-08 21:15:16','127.0.0.1',NULL,5),(46,'2015-07-08 21:15:20','2015-07-08 23:55:24','127.0.0.1',NULL,1),(47,'2015-07-08 23:55:31','2015-07-09 09:48:29','127.0.0.1',NULL,4),(48,'2015-07-09 09:48:33',NULL,'127.0.0.1',NULL,1),(49,'2015-07-16 15:04:40','2015-07-17 23:16:14','127.0.0.1',NULL,1),(50,'2015-07-17 23:16:20','2015-07-17 23:29:02','127.0.0.1',NULL,5),(51,'2015-07-17 23:29:07',NULL,'127.0.0.1',NULL,1),(52,'2015-07-23 18:52:46',NULL,'127.0.0.1',NULL,1),(53,'2015-07-24 20:32:11','2015-07-25 18:28:20','127.0.0.1',NULL,1),(54,'2015-07-25 18:28:27','2015-07-25 18:29:08','127.0.0.1',NULL,5),(55,'2015-07-25 18:29:14','2015-07-25 23:28:24','127.0.0.1',NULL,1),(56,'2015-07-25 23:28:35','2015-07-25 23:38:21','127.0.0.1',NULL,5),(57,'2015-07-25 23:38:24',NULL,'127.0.0.1',NULL,1),(58,'2015-07-27 14:25:26','2015-07-28 00:02:38','127.0.0.1',NULL,1),(59,'2015-07-29 10:05:19',NULL,'127.0.0.1',NULL,1),(60,'2015-07-31 12:17:56',NULL,'127.0.0.1',NULL,1),(61,'2015-07-31 20:44:11','2015-08-01 15:04:21','127.0.0.1',NULL,1),(62,'2015-08-01 15:04:27','2015-08-01 16:02:06','127.0.0.1',NULL,5),(63,'2015-08-01 16:02:10','2015-08-01 16:03:49','127.0.0.1',NULL,1),(64,'2015-08-01 16:03:54','2015-08-01 16:04:45','127.0.0.1',NULL,5),(65,'2015-08-01 16:04:52','2015-08-01 17:16:17','127.0.0.1',NULL,1),(66,'2015-08-01 17:17:10','2015-08-01 17:17:43','127.0.0.1',NULL,1),(67,'2015-08-01 17:17:49','2015-08-01 17:20:00','127.0.0.1',NULL,1),(68,'2015-08-01 17:20:05',NULL,'127.0.0.1',NULL,1),(69,'2015-08-03 10:23:07','2015-08-03 22:34:12','127.0.0.1',NULL,1),(70,'2015-08-04 11:38:55',NULL,'127.0.0.1',NULL,1),(71,'2015-08-06 20:19:58',NULL,'127.0.0.1',NULL,1),(72,'2015-08-07 16:09:35',NULL,'127.0.0.1',NULL,1),(73,'2015-08-11 19:28:56','2015-08-11 19:30:18','127.0.0.1',NULL,1),(74,'2015-08-11 19:42:00',NULL,'127.0.0.1',NULL,1),(75,'2015-08-14 16:27:58','2015-08-14 16:34:06','127.0.0.1',NULL,1),(76,'2015-08-14 16:34:43','2015-08-14 16:36:58','127.0.0.1',NULL,5),(77,'2015-08-14 16:37:26','2015-08-14 16:37:29','127.0.0.1',NULL,5),(78,'2015-08-14 16:37:51','2015-08-14 16:41:24','127.0.0.1',NULL,1),(79,'2015-08-14 16:50:07',NULL,'127.0.0.1',NULL,1),(80,'2015-08-16 22:23:54','2015-08-17 01:34:10','127.0.0.1',NULL,1),(81,'2015-08-17 01:34:15','2015-08-17 01:35:15','127.0.0.1',NULL,1),(82,'2015-08-17 01:35:18','2015-08-17 01:35:29','127.0.0.1',NULL,1),(83,'2015-08-17 01:35:34','2015-08-17 01:36:11','127.0.0.1',NULL,1),(84,'2015-08-17 01:36:15','2015-08-17 01:38:17','127.0.0.1',NULL,1),(85,'2015-08-17 01:38:28','2015-08-17 01:38:45','127.0.0.1',NULL,1),(86,'2015-08-17 01:38:50','2015-08-17 01:39:48','127.0.0.1',NULL,1),(87,'2015-08-17 01:39:54','2015-08-17 01:40:28','127.0.0.1',NULL,1),(88,'2015-08-17 01:40:33','2015-08-17 01:43:01','127.0.0.1',NULL,1),(89,'2015-08-17 01:43:05','2015-08-17 01:45:12','127.0.0.1',NULL,1),(90,'2015-08-17 01:45:17','2015-08-17 01:45:50','127.0.0.1',NULL,1),(91,'2015-08-17 01:45:54','2015-08-17 01:46:48','127.0.0.1',NULL,1),(92,'2015-08-17 01:46:52','2015-08-17 01:48:09','127.0.0.1',NULL,1),(93,'2015-08-17 01:48:13','2015-08-17 02:04:18','127.0.0.1',NULL,1),(94,'2015-08-17 02:04:25','2015-08-17 10:40:52','127.0.0.1',NULL,1),(95,'2015-08-17 10:41:23','2015-08-17 10:42:07','127.0.0.1',NULL,2),(96,'2015-08-17 10:42:20','2015-08-17 10:44:02','127.0.0.1',NULL,4),(97,'2015-08-17 10:44:31','2015-08-17 11:07:34','127.0.0.1',NULL,4),(98,'2015-08-17 11:07:39','2015-08-17 17:26:24','127.0.0.1',NULL,1),(99,'2015-08-17 17:26:31','2015-08-18 18:12:41','127.0.0.1',NULL,5),(100,'2015-08-18 18:12:47','2015-08-18 20:41:35','127.0.0.1',NULL,1),(101,'2015-08-18 20:41:41','2015-08-18 23:46:20','127.0.0.1',NULL,1),(102,'2015-08-18 23:47:55','2015-08-19 22:18:59','127.0.0.1',NULL,1),(103,'2015-08-19 22:44:04','2015-08-19 22:44:18','127.0.0.1',NULL,1),(104,'2015-08-19 22:44:25','2015-08-19 22:57:22','127.0.0.1',NULL,9),(105,'2015-08-19 22:57:26','2015-08-20 00:34:00','127.0.0.1',NULL,1),(106,'2015-08-20 00:35:03','2015-08-20 13:32:25','127.0.0.1',NULL,1),(107,'2015-08-20 14:47:01','2015-08-20 14:52:29','127.0.0.1',NULL,1),(108,'2015-08-20 14:55:08','2015-08-20 14:56:20','127.0.0.1',NULL,1),(109,'2015-08-20 14:56:25','2015-08-20 14:56:31','127.0.0.1',NULL,1),(110,'2015-08-20 14:56:35','2015-08-20 14:56:41','127.0.0.1',NULL,1),(111,'2015-08-20 14:57:13','2015-08-20 14:57:21','127.0.0.1',NULL,5),(112,'2015-08-20 14:57:25','2015-08-20 17:22:20','127.0.0.1',NULL,1),(113,'2015-08-20 17:22:28','2015-08-20 17:24:30','127.0.0.1',NULL,5),(114,'2015-08-20 17:24:34','2015-08-20 17:25:10','127.0.0.1',NULL,1),(115,'2015-08-20 17:25:54','2015-08-20 17:26:02','127.0.0.1',NULL,1),(116,'2015-08-20 17:26:12','2015-08-20 17:28:00','127.0.0.1',NULL,4),(117,'2015-08-20 17:28:04','2015-08-20 17:55:00','127.0.0.1',NULL,1),(118,'2015-08-20 17:55:06','2015-08-20 17:55:09','127.0.0.1',NULL,1),(119,'2015-08-20 18:05:08','2015-08-20 18:14:16','127.0.0.1',NULL,1),(120,'2015-08-20 18:16:53','2015-08-20 19:00:37','127.0.0.1',NULL,1),(121,'2015-08-20 19:02:20','2015-08-20 19:02:23','127.0.0.1',NULL,1),(122,'2015-08-20 19:08:37','2015-08-20 19:34:21','127.0.0.1',NULL,1),(123,'2015-08-20 19:34:30',NULL,'127.0.0.1',NULL,5),(124,'2015-09-12 23:13:31','2015-09-12 23:16:31','127.0.0.1',NULL,1),(125,'2015-09-12 23:16:39','2015-09-12 23:16:45','127.0.0.1',NULL,1),(126,'2015-09-28 23:26:04',NULL,'::1',NULL,1),(127,'2015-09-28 23:26:05',NULL,'::1',NULL,1),(128,'2015-11-04 15:41:22',NULL,'::1',NULL,1),(129,'2015-12-08 14:23:15',NULL,'::1',NULL,1);
/*!40000 ALTER TABLE `loginsession` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lubricant`
--

DROP TABLE IF EXISTS `lubricant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lubricant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idjobcard` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lubricant_jobcard1_idx` (`idjobcard`),
  CONSTRAINT `fk_lubricant_jobcard1` FOREIGN KEY (`idjobcard`) REFERENCES `jobcard` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lubricant`
--

LOCK TABLES `lubricant` WRITE;
/*!40000 ALTER TABLE `lubricant` DISABLE KEYS */;
/*!40000 ALTER TABLE `lubricant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lubricantbook`
--

DROP TABLE IF EXISTS `lubricantbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lubricantbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventory` int(11) NOT NULL,
  `idlubricantstock` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lubricantbook_inventory1_idx` (`idinventory`),
  KEY `fk_lubricantbook_lubricantstock1_idx` (`idlubricantstock`),
  CONSTRAINT `fk_lubricantbook_inventory1` FOREIGN KEY (`idinventory`) REFERENCES `inventory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lubricantbook_lubricantstock1` FOREIGN KEY (`idlubricantstock`) REFERENCES `lubricantstock` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lubricantbook`
--

LOCK TABLES `lubricantbook` WRITE;
/*!40000 ALTER TABLE `lubricantbook` DISABLE KEYS */;
/*!40000 ALTER TABLE `lubricantbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lubricantstock`
--

DROP TABLE IF EXISTS `lubricantstock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lubricantstock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsite` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `ststus` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lubricantstock_site1_idx` (`idsite`),
  CONSTRAINT `fk_lubricantstock_site1` FOREIGN KEY (`idsite`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lubricantstock`
--

LOCK TABLES `lubricantstock` WRITE;
/*!40000 ALTER TABLE `lubricantstock` DISABLE KEYS */;
/*!40000 ALTER TABLE `lubricantstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `other`
--

DROP TABLE IF EXISTS `other`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idjobcard` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_other_jobcard1_idx` (`idjobcard`),
  CONSTRAINT `fk_other_jobcard1` FOREIGN KEY (`idjobcard`) REFERENCES `jobcard` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `other`
--

LOCK TABLES `other` WRITE;
/*!40000 ALTER TABLE `other` DISABLE KEYS */;
/*!40000 ALTER TABLE `other` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plantrate`
--

DROP TABLE IF EXISTS `plantrate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plantrate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventorytype` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `mincharge` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_plantrate_inventorytype1_idx` (`idinventorytype`),
  CONSTRAINT `fk_plantrate_inventorytype1` FOREIGN KEY (`idinventorytype`) REFERENCES `inventorytype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plantrate`
--

LOCK TABLES `plantrate` WRITE;
/*!40000 ALTER TABLE `plantrate` DISABLE KEYS */;
INSERT INTO `plantrate` VALUES (1,5,'1 MT Rate',500,1),(2,6,'1 MT Rate',700,2);
/*!40000 ALTER TABLE `plantrate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaseitem`
--

DROP TABLE IF EXISTS `purchaseitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchaseitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpurchaserequisitionform` int(11) NOT NULL,
  `stockcode` varchar(45) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `qtyavailable` double DEFAULT NULL,
  `qtyrequired` double DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchaseitem_purchaserequisitionform1_idx` (`idpurchaserequisitionform`),
  CONSTRAINT `fk_purchaseitem_purchaserequisitionform1` FOREIGN KEY (`idpurchaserequisitionform`) REFERENCES `purchaserequisitionform` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaseitem`
--

LOCK TABLES `purchaseitem` WRITE;
/*!40000 ALTER TABLE `purchaseitem` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaserequisitionform`
--

DROP TABLE IF EXISTS `purchaserequisitionform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchaserequisitionform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsite` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchaserequisitionform_site1_idx` (`idsite`),
  CONSTRAINT `fk_purchaserequisitionform_site1` FOREIGN KEY (`idsite`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaserequisitionform`
--

LOCK TABLES `purchaserequisitionform` WRITE;
/*!40000 ALTER TABLE `purchaserequisitionform` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaserequisitionform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idjobcard` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `mechanic` varchar(255) DEFAULT NULL,
  `starttime` timestamp NULL DEFAULT NULL,
  `endtime` timestamp NULL DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_service_jobcard1_idx` (`idjobcard`),
  CONSTRAINT `fk_service_jobcard1` FOREIGN KEY (`idjobcard`) REFERENCES `jobcard` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(45) DEFAULT NULL,
  `permanent` tinyint(4) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `projectmanager` varchar(45) DEFAULT NULL,
  `sitemanager` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site`
--

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;
INSERT INTO `site` VALUES (1,'Head Office',1,'2015-01-01','0000-00-00','Swethe','Janaka',1),(2,'Dompe',1,'2015-06-03','2016-12-01','Kamal','B',1),(3,'Kurunegala',1,'2015-06-18','2016-08-18','Sunil','C',1),(4,'Kandy',1,'2015-06-03','2017-06-30','Ranil','D',1),(5,'Galle',1,'2015-06-10','2015-12-31','Nimal','E',1),(6,'Jaffna',0,'2015-06-16','2015-08-31','Kasun','F',0),(7,'Colombo',0,'2015-07-20','2015-08-10','Chanaka','Lakmal',0),(8,'Badulla',1,'2015-07-25','2015-08-23','ABC','DEF',0),(9,'Trincomalee',1,'2015-08-17','2016-10-26','A','B',1);
/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spare`
--

DROP TABLE IF EXISTS `spare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idjobcard` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `sno` varchar(45) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `unitprice` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_spare_jobcard1_idx` (`idjobcard`),
  CONSTRAINT `fk_spare_jobcard1` FOREIGN KEY (`idjobcard`) REFERENCES `jobcard` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spare`
--

LOCK TABLES `spare` WRITE;
/*!40000 ALTER TABLE `spare` DISABLE KEYS */;
/*!40000 ALTER TABLE `spare` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transferitem`
--

DROP TABLE IF EXISTS `transferitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transferitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventory` int(11) NOT NULL,
  `idtransfernote` int(11) NOT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transferitem_transfernote1_idx` (`idtransfernote`),
  KEY `fk_transferitem_inventory1_idx` (`idinventory`),
  CONSTRAINT `fk_transferitem_inventory1` FOREIGN KEY (`idinventory`) REFERENCES `inventory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transferitem_transfernote1` FOREIGN KEY (`idtransfernote`) REFERENCES `transfernote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transferitem`
--

LOCK TABLES `transferitem` WRITE;
/*!40000 ALTER TABLE `transferitem` DISABLE KEYS */;
/*!40000 ALTER TABLE `transferitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfernote`
--

DROP TABLE IF EXISTS `transfernote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transfernote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idinventory` int(11) NOT NULL,
  `idsitefrom` int(11) NOT NULL,
  `idsiteto` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `departuretime` time DEFAULT NULL,
  `arrivaltime` time DEFAULT NULL,
  `driver` varchar(45) DEFAULT NULL,
  `cleaner` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transfernote_inventory1_idx` (`idinventory`),
  KEY `fk_transfernote_site1_idx` (`idsitefrom`),
  KEY `fk_transfernote_site2_idx` (`idsiteto`),
  CONSTRAINT `fk_transfernote_inventory1` FOREIGN KEY (`idinventory`) REFERENCES `inventory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transfernote_site1` FOREIGN KEY (`idsitefrom`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transfernote_site2` FOREIGN KEY (`idsiteto`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfernote`
--

LOCK TABLES `transfernote` WRITE;
/*!40000 ALTER TABLE `transfernote` DISABLE KEYS */;
INSERT INTO `transfernote` VALUES (1,3,1,2,'2015-07-31','12:00:00','13:00:00','C','CC',2),(2,6,1,5,'2015-07-29','13:00:00','14:00:00','Driver','Cleaner',1),(3,1,1,5,'2015-08-13','01:10:00','02:00:00','Driver','',1),(4,3,2,4,'2015-08-14','15:28:00','16:00:00','XYZ','ABC',1),(7,29,1,3,'2015-08-19','11:11:00','12:11:00','D','CC',1);
/*!40000 ALTER TABLE `transfernote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `iduserinfo` int(11) NOT NULL,
  `idlog` int(11) NOT NULL,
  `idusertype` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_userinfo_idx` (`iduserinfo`),
  KEY `fk_user_log1_idx` (`idlog`),
  KEY `fk_user_usertype1_idx` (`idusertype`),
  CONSTRAINT `fk_user_log1` FOREIGN KEY (`idlog`) REFERENCES `log` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_userinfo` FOREIGN KEY (`iduserinfo`) REFERENCES `userinfo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_usertype1` FOREIGN KEY (`idusertype`) REFERENCES `usertype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Chanaka','Lakmal','ldclakmal@gmail.com',1,1,1,1),(2,'Swethe','Feldano','swethe@hovael.com',1,2,2,2),(3,'Janaka','Perera','janaka@hovael.com',1,3,3,3),(4,'Chandu','Herath','chandu@gmail.com',1,4,4,6),(5,'Sachithra','Dangalla','sachithra@gmail.com',1,5,5,5),(6,'Keet','Malin','keet@gmail.com',0,6,6,6),(7,'Dimuthu','Lakmal','kjtdimuthu@gmail.com',0,7,7,6),(8,'Dulaj','Perera','dulaj@hovael.com',0,8,8,6),(9,'Chathurka','Madhushan','chathurka@hovael.com',0,9,9,6),(11,'Chamin','Lakmal','chamin@hovael.com',1,11,11,6),(14,'Chanaka','Lakmal','chana@jj',1,14,14,6);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(45) DEFAULT NULL,
  `work` int(11) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_site` (`work`),
  CONSTRAINT `fk_site` FOREIGN KEY (`work`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfo`
--

LOCK TABLES `userinfo` WRITE;
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
INSERT INTO `userinfo` VALUES (1,'System Developer',1,'0775962256'),(2,'Senior Manager',1,'0711234567'),(3,'Manager',1,'0773771826'),(4,'Operator',1,'0717189255'),(5,'Project Manager',2,'0713700656'),(6,'Data Entry Operator',2,'0717894561'),(7,'Data Entry Operator',1,'0712924287'),(8,'Data Entry Operator',3,'0715624892'),(9,'Operator',8,'0713265987'),(11,'Operator',8,'0777777777'),(14,'Operator',5,'0775962256');
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userprivi`
--

DROP TABLE IF EXISTS `userprivi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userprivi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusertype` int(11) NOT NULL,
  `idinterface` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usertype_has_interface_interface1_idx` (`idinterface`),
  KEY `fk_usertype_has_interface_usertype1_idx` (`idusertype`),
  CONSTRAINT `fk_usertype_has_interface_interface1` FOREIGN KEY (`idinterface`) REFERENCES `interface` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usertype_has_interface_usertype1` FOREIGN KEY (`idusertype`) REFERENCES `usertype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userprivi`
--

LOCK TABLES `userprivi` WRITE;
/*!40000 ALTER TABLE `userprivi` DISABLE KEYS */;
/*!40000 ALTER TABLE `userprivi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usertype`
--

DROP TABLE IF EXISTS `usertype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usertype`
--

LOCK TABLES `usertype` WRITE;
/*!40000 ALTER TABLE `usertype` DISABLE KEYS */;
INSERT INTO `usertype` VALUES (1,'Super Admin'),(2,'Admin'),(3,'Manager'),(4,'Site Manager'),(5,'Project Manager'),(6,'Operator');
/*!40000 ALTER TABLE `usertype` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-05  9:07:01
