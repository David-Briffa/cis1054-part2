CREATE DATABASE  IF NOT EXISTS `menu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `menu`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: menu
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `menuitems`
--

DROP TABLE IF EXISTS `menuitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menuitems` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Price` decimal(15,2) NOT NULL,
  `Type` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menuitems`
--

LOCK TABLES `menuitems` WRITE;
/*!40000 ALTER TABLE `menuitems` DISABLE KEYS */;
INSERT INTO `menuitems` VALUES (1,'Champagne-Battered prawns','Deep fried local prawns served on a bed of petite salad with zesty lemon dressing',9.50,'Starter'),(2,'Homemade ravioli','Aubergine and Scamorza ravioli tossed in a tomato fondue',8.90,'Starter'),(3,'Mushroom tart','Wild Mushroom, pancetta and blue cheese baked tart, served with charred leeks',7.50,'Starter'),(4,'Saffron risotto','Vegetarian saffron risotto served with garden vegetables and grilled tortilla ',13.90,'Starter'),(5,'Soup of the day','Please ask your server for our daily soup',6.00,'Starter'),(6,'Fiocchi gorgonzola and pears','Tossed in a blue cheese and honey cream sauce. Topped with toasted walnuts',15.90,'Pasta'),(7,'Venison Ravioli','Slow braised venison homemade ravioli served with a shallot, herb and cherry tomato fondue. Dusted with pecorino and rocket leaves',18.50,'Pasta'),(8,'Pan-seared Octopus','Served with charred leeks, fried lotus root and pickled radish',23.50,'Main'),(9,'Salmon four-way','Pistachio powder, paprika, sesame seed and honey, asparagus. Served with carrot puree and crispy skin chips',21.50,'Main'),(10,'Seabass roulade','Stuffed with prawns, tomatoes and olives, served with balsamic glaze and beetroot reduction',19.80,'Main'),(11,'Slow braised lamb','Served with feta, roasted aubergine, buttered vegetables and beetroot puree. Drizzled with red with reduction',24.90,'Main'),(12,'Pork loin croquette','Stuffed with smoked Applewood cheddar and served with grilled vegetables and sweet potato fries',22.50,'Main'),(13,'Chicken roulade','Corn-fed chicken breast stuffed with sundried tomatoes and cream cheese and wrapped in pancetta. Served on a sweet potato puree and truffle mash',17.50,'Main'),(14,'Crispy duck breast','Served on pumpkin puree and drizzled with plum reduction. Accompanied by buttered garden vegetables',23.50,'Main'),(15,'Rack o\' Ribs','6-hour smoked BBQ pork ribs with crispy onion crust',21.00,'Main'),(16,'Chocolate Fondant','served with vanilla ice cream',6.50,'Dessert'),(17,'Crème brûlée','creamy baked custard served with caramelised walnuts',7.00,'Dessert'),(18,'Apple crumble','served warm with vanilla ice cream',7.50,'Dessert'),(19,'Ice creams','Kindly ask the server for our flavours',3.00,'Dessert'),(20,'Sorbet','lemon, strawberry, honey or liqeur',3.00,'Dessert');
/*!40000 ALTER TABLE `menuitems` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-11 14:32:30
