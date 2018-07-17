-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: app
-- ------------------------------------------------------
-- Server version	5.7.20

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
-- Table structure for table `capacities`
--

DROP TABLE IF EXISTS `capacities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capacities` (
  `id_capacity` int(11) NOT NULL AUTO_INCREMENT,
  `capacity_number` int(11) DEFAULT NULL,
  `products_idproduct` int(11) NOT NULL,
  `additional_price` float DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_capacity`),
  KEY `fk_capacities_products1_idx` (`products_idproduct`),
  CONSTRAINT `fk_capacities_products1` FOREIGN KEY (`products_idproduct`) REFERENCES `products` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capacities`
--

LOCK TABLES `capacities` WRITE;
/*!40000 ALTER TABLE `capacities` DISABLE KEYS */;
/*!40000 ALTER TABLE `capacities` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `sites`;

CREATE TABLE `sites`
(
  id_site int PRIMARY KEY AUTO_INCREMENT,
  name varchar(255),
  logo varchar(255),
  main_site_color varchar(255),
  secondary_site_color varchar(255),
  main_font_color varchar(255),
  secondary_font_color varchar(255),
  is_use tinyint(4) NOT NULL,
  status tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `homepages`;

CREATE TABLE `homepages`
(
  id_homepage int PRIMARY KEY AUTO_INCREMENT,
  name varchar(255),
  description_top_banner varchar(255),
  description_images varchar(255),
  description_bottom_banner varchar(255),
  banner varchar(255),
  left_image varchar(255),
  right_image varchar(255),
  bottom_banner varchar(255),
  is_use tinyint(4) NOT NULL,
  status tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `legalnotices`;

CREATE TABLE `legalnotices`
(
  id_legalnotice int PRIMARY KEY AUTO_INCREMENT,
  name varchar(255),
  title varchar(255),
  details TEXT,
  is_use tinyint(4) NOT NULL,
  status tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cgvs`;

CREATE TABLE `cgvs`
(
  id_cgv int PRIMARY KEY AUTO_INCREMENT,
  name varchar(255),
  title varchar(255),
  details TEXT,
  is_use tinyint(4) NOT NULL,
  status tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts`
(
  id_contact int PRIMARY KEY AUTO_INCREMENT,
  name varchar(255),
  title varchar(255),
  details TEXT,
  is_use tinyint(4) NOT NULL,
  status tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id_cart` int(11) NOT NULL,
  `capacities_id_capacity` int(11) NOT NULL,
  `products_id_product` int(11) NOT NULL,
  `colors_id_color` int(11) NOT NULL,
  `users_id_user` int(11) NOT NULL,
  `orders_id_order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cart`),
  KEY `fk_Cart_capacities1` (`capacities_id_capacity`),
  KEY `fk_Cart_products1` (`products_id_product`),
  KEY `fk_Cart_colors1` (`colors_id_color`),
  KEY `fk_Cart_users1` (`users_id_user`),
  KEY `fk_carts_orders1` (`orders_id_order`),
  CONSTRAINT `fk_Cart_capacities1` FOREIGN KEY (`capacities_id_capacity`) REFERENCES `capacities` (`id_capacity`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cart_colors1` FOREIGN KEY (`colors_id_color`) REFERENCES `colors` (`id_color`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cart_products1` FOREIGN KEY (`products_id_product`) REFERENCES `products` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cart_users1` FOREIGN KEY (`users_id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_carts_orders1` FOREIGN KEY (`orders_id_order`) REFERENCES `orders` (`id_order`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colors` (
  `id_color` int(11) NOT NULL AUTO_INCREMENT,
  `color_hexa` varchar(35) DEFAULT NULL,
  `products_idproduct` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_color`),
  KEY `fk_colors_products1_idx` (`products_idproduct`),
  CONSTRAINT `fk_colors_products1` FOREIGN KEY (`products_idproduct`) REFERENCES `products` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `comment` longtext,
  `users_idusers` int(11) NOT NULL,
  `products_idproduct` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comment`),
  KEY `fk_comments_users1_idx` (`users_idusers`),
  KEY `fk_comments_products1_idx` (`products_idproduct`),
  CONSTRAINT `fk_comments_products1` FOREIGN KEY (`products_idproduct`) REFERENCES `products` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(75) DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `products_idproduct` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_image`),
  KEY `fk_images_products_idx` (`products_idproduct`),
  CONSTRAINT `fk_images_products` FOREIGN KEY (`products_idproduct`) REFERENCES `products` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `tracking_number` varchar(15) DEFAULT NULL,
  `users_idusers` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_order`),
  KEY `fk_orders_users1_idx` (`users_idusers`),
  CONSTRAINT `fk_orders_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(60) DEFAULT NULL,
  `categories_idcategory` int(11) NOT NULL,
  `description` longtext,
  `price` float DEFAULT NULL,
  `ram` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_product`),
  KEY `fk_products_categories1_idx` (`categories_idcategory`),
  CONSTRAINT `fk_products_categories1` FOREIGN KEY (`categories_idcategory`) REFERENCES `categories` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `sexe` tinyint(1) DEFAULT NULL,
  `birthday_date` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip_code` int(5) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pwd` char(60) NOT NULL,
  `token` char(32) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-24  7:54:13
