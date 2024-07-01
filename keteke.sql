-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 67.222.38.91    Database: ketekene_ketekenet
-- ------------------------------------------------------
-- Server version	5.7.23-23

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
-- Table structure for table `add_to_cart`
--

DROP TABLE IF EXISTS `add_to_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `add_to_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` longtext COLLATE utf8_unicode_ci,
  `product_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mrp` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `final_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `add_to_cart`
--

LOCK TABLES `add_to_cart` WRITE;
/*!40000 ALTER TABLE `add_to_cart` DISABLE KEYS */;
INSERT INTO `add_to_cart` VALUES (13,'145','3','Cillum dolore plant','2','140','2.8','137.2','2024-06-13 06:02','product-2.jpg'),(14,'160','1',NULL,'1','80','16','64','2024-06-14 03:41:36',NULL),(15,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL),(16,NULL,NULL,NULL,NULL,'80','16','64',NULL,NULL),(17,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL),(18,NULL,NULL,NULL,NULL,'80','16','64',NULL,NULL),(19,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL),(20,NULL,NULL,NULL,NULL,'80','16','64',NULL,NULL),(21,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL),(22,NULL,NULL,NULL,NULL,'80','16','64',NULL,NULL),(23,'160','2',NULL,'1','50','5.5','44.5','2024-06-14 05:27:29',NULL),(24,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL),(25,NULL,NULL,NULL,NULL,'80','16','64',NULL,NULL),(26,NULL,'1',NULL,'2','80','16','64','2024-06-18 12:19:15',NULL),(27,NULL,'1',NULL,'1','80','16','64','2024-06-18 12:19:43',NULL),(28,NULL,'1',NULL,'1','80','16','64','2024-06-18 12:20:00',NULL),(29,NULL,'4',NULL,'2','80','8','72','2024-06-18 12:20:56',NULL),(30,NULL,'2',NULL,'2','50','5.5','44.5','2024-06-18 13:57:19',NULL),(31,NULL,'4',NULL,'2','80','8','72','2024-06-19 00:04:08',NULL),(32,NULL,'1',NULL,'1','80','16','64','2024-06-19 00:12:55',NULL),(33,NULL,'3',NULL,'2','70','1.4','68.6','2024-06-19 00:13:04',NULL),(34,NULL,'2',NULL,'1','50','5.5','44.5','2024-06-19 00:13:05',NULL),(35,NULL,'2',NULL,'1','50','5.5','44.5','2024-06-19 00:13:06',NULL),(36,NULL,'1',NULL,'1','80','16','64','2024-06-19 00:13:14',NULL),(37,NULL,'2',NULL,'1','50','5.5','44.5','2024-06-19 00:13:17',NULL),(38,NULL,'3',NULL,'2','70','1.4','68.6','2024-06-19 00:13:54',NULL),(39,NULL,'4',NULL,'1','80','8','72','2024-06-19 00:14:05',NULL),(40,NULL,'1',NULL,'1','80','16','64','2024-06-19 00:14:09',NULL),(41,NULL,'2',NULL,'1','50','5.5','44.5','2024-06-19 00:15:22',NULL),(42,NULL,'2',NULL,'1','50','5.5','44.5','2024-06-19 00:15:54',NULL),(43,NULL,'3',NULL,'1','70','1.4','68.6','2024-06-19 00:16:21',NULL),(44,NULL,'4',NULL,'1','80','8','72','2024-06-19 00:16:42',NULL),(45,NULL,'2',NULL,'1','50','5.5','44.5','2024-06-19 00:17:00',NULL),(46,NULL,'3',NULL,'1','70','1.4','68.6','2024-06-19 00:17:11',NULL),(47,NULL,'2',NULL,'1','50','5.5','44.5','2024-06-19 00:17:20',NULL),(48,NULL,'1',NULL,'2','80','16','64','2024-06-19 00:17:43',NULL),(49,'147','1',NULL,'2','80','16','64','2024-06-19 00:24:14',NULL),(50,NULL,'1',NULL,'1','80','16','64','2024-06-19 18:43:19',NULL),(51,NULL,'2',NULL,'1','50','5.5','44.5','2024-06-23 08:22:59',NULL),(52,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:23:27',NULL),(53,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:31:28',NULL),(54,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:31:49',NULL),(55,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:31:51',NULL),(56,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:31:54',NULL),(57,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:32:13',NULL),(58,NULL,'1',NULL,'2','80','16','64','2024-06-23 08:32:18',NULL),(59,NULL,'1',NULL,'2','80','16','64','2024-06-23 08:32:33',NULL),(60,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:33:26',NULL),(61,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:33:28',NULL),(62,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:33:43',NULL),(63,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:33:45',NULL),(64,NULL,'1',NULL,'6','80','16','64','2024-06-23 08:37:25',NULL),(65,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:37:55',NULL),(66,NULL,'4',NULL,'1','80','8','72','2024-06-23 08:37:59',NULL),(67,NULL,'4',NULL,'1','80','8','72','2024-06-23 08:38:57',NULL),(68,NULL,'4',NULL,'1','80','8','72','2024-06-23 08:39:00',NULL),(69,NULL,'1',NULL,'1','80','16','64','2024-06-23 08:44:14',NULL),(70,'142','1',NULL,'1','80','16','64','2024-06-28 00:10:33',NULL),(71,NULL,'1',NULL,'1','80','16','64','2024-06-28 05:37:04',NULL),(72,NULL,'1',NULL,'1','80','16','64','2024-06-28 05:37:16',NULL),(73,NULL,'1',NULL,'1','80','16','64','2024-06-28 05:37:32',NULL),(74,'2','5',NULL,'1',NULL,'0',NULL,'2024-06-28 05:40:15',NULL),(75,NULL,'1',NULL,'1','80','16','64','2024-06-28 05:40:37',NULL),(76,NULL,'5',NULL,'1',NULL,'0',NULL,'2024-06-28 05:42:13',NULL),(77,NULL,'5',NULL,'1',NULL,'0',NULL,'2024-06-28 05:42:16',NULL),(78,NULL,'5',NULL,'1',NULL,'0',NULL,'2024-06-28 05:42:20',NULL),(79,NULL,'5',NULL,'1',NULL,'0',NULL,'2024-06-28 05:42:21',NULL),(80,'2','1',NULL,'1','80','16','64','2024-06-28 05:42:38',NULL),(81,NULL,'5',NULL,'1',NULL,'0',NULL,'2024-06-28 05:42:57',NULL),(82,NULL,'1',NULL,'1','80','16','64','2024-06-28 05:43:05',NULL),(83,NULL,'1',NULL,'1','80','16','64','2024-06-28 05:43:13',NULL),(84,NULL,'4','Hand Bag','1',NULL,NULL,NULL,'2024-06-28 05:45','product-3.jpg'),(85,'827E51A1-D70D-42FA-8CEB-102166E291A1','1',NULL,'1','80','16','64','2024-06-28 06:10:30',NULL),(86,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL),(87,NULL,NULL,NULL,NULL,'80','16','64',NULL,NULL),(88,'827E51A1-D70D-42FA-8CEB-102166E291A1','2',NULL,'1','50','5.5','44.5','2024-06-28 06:18:48',NULL),(89,'827E51A1-D70D-42FA-8CEB-102166E291A1','3',NULL,'1','70','1.4','68.6','2024-06-28 06:18:59',NULL),(90,NULL,'1',NULL,'3','80','16','64','2024-06-29 00:28:29',NULL),(91,'344375c2e18f493c','28',NULL,'1','80','16','64','2024-06-29 00:28:42',NULL),(92,NULL,'1',NULL,'1','80','16','64','2024-06-29 00:35:32',NULL),(93,'344375c2e18f493c','1',NULL,'1','80','16','64','2024-06-29 06:04:42',NULL),(94,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL),(95,NULL,NULL,NULL,NULL,'80','16','64',NULL,NULL),(96,'344375c2e18f493c','2',NULL,'1','50','5.5','44.5','2024-06-29 06:07:24',NULL),(97,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL),(98,NULL,NULL,NULL,NULL,'80','16','64',NULL,NULL);
/*!40000 ALTER TABLE `add_to_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_id` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','admin@admin.com','e10adc3949ba59abbe56e057f20f883e',1,1,'2021-01-13 10:31:14');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_accounts`
--

DROP TABLE IF EXISTS `admin_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_accounts` (
  `admin_id` int(10) NOT NULL,
  `admin_name` text NOT NULL,
  `admin_emailid` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_emailid` (`admin_emailid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_accounts`
--

LOCK TABLES `admin_accounts` WRITE;
/*!40000 ALTER TABLE `admin_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner_text` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` VALUES (1,'mbanner','slider13.jpg','Latest Camera','https://keteke.net/shop',1,'2021-01-15 23:07:49'),(2,'mbanner','slider14.jpg','Amazing Console','https://keteke.net/shop',1,'2021-01-15 23:08:25'),(3,'adv','banner6.jpg','Roma  Chair from $36.39','https://keteke.net/shop',1,'2021-04-17 17:54:33'),(4,'adv','banner7.jpg','The Original Toby Chair from $50','https://keteke.net/shop',1,'2021-07-12 21:38:46'),(5,'adv','IMG_20211006_204244.jpg','Keteke Market Place Banner Test','https://keteke.net/shop',1,'2021-10-17 07:40:30');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_details`
--

DROP TABLE IF EXISTS `business_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `business_details` (
  `business_id` int(10) NOT NULL,
  `business_name` text NOT NULL,
  `business_website_url` varchar(255) DEFAULT NULL,
  `business_information` text NOT NULL,
  `business_logo` varchar(50) NOT NULL DEFAULT 'logos/default.png',
  `business_emailid` varchar(255) NOT NULL,
  `business_phonenumber` varchar(11) NOT NULL,
  `business_location` varchar(50) NOT NULL,
  `business_state` text NOT NULL,
  `business_city` text NOT NULL,
  `business_country` text NOT NULL,
  `business_keyword` varchar(500) DEFAULT NULL,
  `business_owner_id` int(10) NOT NULL,
  `business_status` varchar(50) NOT NULL,
  `b_comments` varchar(255) NOT NULL,
  PRIMARY KEY (`business_id`),
  UNIQUE KEY `business_emailid` (`business_emailid`),
  UNIQUE KEY `business_phonenumber` (`business_phonenumber`),
  UNIQUE KEY `business_owner_id` (`business_owner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_details`
--

LOCK TABLES `business_details` WRITE;
/*!40000 ALTER TABLE `business_details` DISABLE KEYS */;
INSERT INTO `business_details` VALUES (1,'Mc Donalds','','short not of my business','default.png','support@mcdonalds.world','9948526346','1400 Breadthway','Toronto','Toronto','USA','restaurent,burger,drinks,food',2,'',''),(2,'Apple','https://www.apple.com','short notes on business','1602081800-app.png','support@apple.com','6303477840','1500 Broadway','Toronto','Toronto','Canada','mobile phones,laptops',1,'','');
/*!40000 ALTER TABLE `business_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_message`
--

DROP TABLE IF EXISTS `business_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `business_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `descr` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_message`
--

LOCK TABLES `business_message` WRITE;
/*!40000 ALTER TABLE `business_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `business_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_owner_accounts`
--

DROP TABLE IF EXISTS `business_owner_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `business_owner_accounts` (
  `business_owner_id` int(10) NOT NULL,
  `business_owner_name` text NOT NULL,
  `business_owner_emailid` varchar(255) NOT NULL,
  `business_owner_phonenumber` varchar(11) NOT NULL,
  `business_owner_password` varchar(255) NOT NULL,
  PRIMARY KEY (`business_owner_id`),
  UNIQUE KEY `business_owner_emailid` (`business_owner_emailid`),
  UNIQUE KEY `business_owner_phonenumber` (`business_owner_phonenumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_owner_accounts`
--

LOCK TABLES `business_owner_accounts` WRITE;
/*!40000 ALTER TABLE `business_owner_accounts` DISABLE KEYS */;
INSERT INTO `business_owner_accounts` VALUES (1,'Steve Jobs','steve@apple.com','9636801325','steve@2020'),(2,'Owner of Mc d','owner@mcdonalds.world','7013283505','md.dad');
/*!40000 ALTER TABLE `business_owner_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_ratings`
--

DROP TABLE IF EXISTS `business_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `business_ratings` (
  `rating_id` int(10) NOT NULL,
  `user_name` text NOT NULL,
  `business_id` int(10) NOT NULL,
  `rating` float NOT NULL,
  `rating_feedback_text` text NOT NULL,
  `rating_created_date` date NOT NULL,
  PRIMARY KEY (`rating_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_ratings`
--

LOCK TABLES `business_ratings` WRITE;
/*!40000 ALTER TABLE `business_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `business_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Other',1),(2,'Entertainment and leisure',1),(3,'Artisan/Service Provider',1),(4,'Social/Religious groups',1),(5,'Professional groups',1),(6,'Churches and Mosques',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms`
--

DROP TABLE IF EXISTS `cms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms`
--

LOCK TABLES `cms` WRITE;
/*!40000 ALTER TABLE `cms` DISABLE KEYS */;
INSERT INTO `cms` VALUES (3,'Privacy Policy','Privacy Policy','privacy-policy','','    <div class=\"mb-7\">\r\n        Global Galaxxy operates the http://globalgalaxxy.com/ website, which provides the SERVICE.\r\n\r\nThis page is used to inform website visitors regarding our policies with the collection, use, and disclosure of Personal Information if anyone decided to use our Service, the Global Galaxxy website.\r\n\r\nIf you choose to use our Service, then you agree to the collection and use of information in relation with this policy. The Personal Information that we collect are used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy.\r\n\r\nThe terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at http://globalgalaxxy.com/, unless otherwise defined in this Privacy Policy. Our Privacy Policy was created with the help of the Privacy Policy Template and the Online Privacy Policy Template.\r\n    </div>\r\n    <div id=\"privacy-policy\" class=\"section-privacy-policy pb-8 pb-12\">\r\n        <div class=\"mb-7\">\r\n            <div class=\"font-size-lg text-dark font-weight-semibold mb-4\">\r\n                Information Collection and Use\r\n            </div>\r\n           For a better experience while using our Service, we may require you to provide us with certain personally identifiable information, including but not limited to your name, phone number, and postal address. The information that we collect will be used to contact or identify you.\r\n        </div>\r\n        <div class=\"mb-7\">\r\n            <div class=\"font-size-lg text-dark font-weight-semibold mb-4\">\r\n                Log Data\r\n            </div>\r\n           We want to inform you that whenever you visit our Service, we collect information that your browser sends to us that is called Log Data. This Log Data may include information such as your computer’s Internet Protocol (\"IP\") address, browser version, pages of our Service that you visit, the time and date of your visit, the time spent on those pages, and other statistics.\r\n        </div>\r\n        <div class=\"mb-7\">\r\n            <div class=\"font-size-lg text-dark font-weight-semibold mb-4\">\r\n                Cookies\r\n            </div>\r\n            Cookies are files with small amount of data that is commonly used an anonymous unique identifier. These are sent to your browser from the website that you visit and are stored on your computer’s hard drive.\r\n\r\n            Our website uses these \"cookies\" to collection information and to improve our Service. You have the option to either accept or refuse these cookies, and know when a cookie is being sent to your computer. If you choose to refuse our cookies, you may not be able to use some portions of our Service.\r\n        </div>\r\n        <div class=\"mb-7\">\r\n            <div class=\"font-size-lg text-dark font-weight-semibold mb-4\">\r\n                Service Providers\r\n            </div>\r\n            <p class=\"mb-4\">We may employ third-party companies and individuals due to the following reasons:\r\n            </p>\r\n            <span class=\"d-block font-italic\">– To facilitate our Service;</span>\r\n            <span class=\"d-block font-italic\">– To provide the Service on our behalf;</span>\r\n            \r\n            <span class=\"d-block font-italic\">– To perform Service-related services; or</span>\r\n            \r\n            <span class=\"d-block font-italic\">– To assist us in analyzing how our Service is used.</span>\r\n          \r\n           We want to inform our Service users that these third parties have access to your Personal Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.\r\n        </div>\r\n        <div class=\"mb-7\">\r\n            <div class=\"font-size-lg text-dark font-weight-semibold mb-4\">\r\n                Security\r\n            </div>\r\n            <p class=\"mb-4\">\r\n              We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.\r\n            </p>\r\n            \r\n        </div>\r\n        <div>\r\n            <div class=\"font-size-lg text-dark font-weight-semibold mb-4\">\r\n                Links to Other Sites\r\n            </div>\r\n            Our Service may contain links to other sites. If you click on a third-party link, you will be directed to that site. Note that these external sites are not operated by us. Therefore, we strongly advise you to review the Privacy Policy of these websites. We have no control over, and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.\r\n\r\n          Children’s Privacy\r\n\r\nOur Services do not address anyone under the age of 13. We do not knowingly collect personal identifiable information from children under 13. In the case we discover that a child under 13 has provided us with personal information, we immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we will be able to do necessary actions.\r\n        </div>\r\n        <div>\r\n            <div class=\"font-size-lg text-dark font-weight-semibold mb-4\">\r\n                Changes to This Privacy Policy\r\n            </div>\r\n            We may update our Privacy Policy from time to time. Thus, we advise you to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately, after they are posted on this page.\r\n        </div>\r\n        <div>\r\n            <div class=\"font-size-lg text-dark font-weight-semibold mb-4\">\r\n                Contact us\r\n            </div>\r\n            If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us.\r\n        </div>\r\n    </div>','',1,'2020-03-18 09:34:33'),(4,'Terms And Conditions','Terms And Conditions','terms-and-conditions','','    <div class=\"mb-7\">\r\n        These terms and conditions outline the rules and regulations for the use of Global Galaxxy\'s Website, located at http://globalgalaxxy.com/.\r\n\r\nBy accessing this website we assume you accept these terms and conditions. Do not continue to use Global Galaxxy if you do not agree to take all of the terms and conditions stated on this page. Our Terms and Conditions were created with the help of the Terms And Conditions Generator and the Free Terms & Conditions Generator.\r\n\r\nThe following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: \"Client\", \"You\" and \"Your\" refers to you, the person log on this website and compliant to the Company’s terms and conditions. \"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to our Company. \"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.\r\n    </div>\r\n    <div id=\"privacy-policy\" class=\"section-privacy-policy pb-8 pb-12\">\r\n        <div class=\"mb-7\">\r\n            <div class=\"font-size-lg text-dark font-weight-semibold mb-4\">\r\n                Cookies\r\n            </div>\r\n          We employ the use of cookies. By accessing Global Galaxxy, you agreed to use cookies in agreement with the Global Galaxxy\'s Privacy Policy.\r\n\r\nMost interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.\r\n        </div>\r\n        <div class=\"mb-7\">\r\n            <div class=\"font-size-lg text-dark font-weight-semibold mb-4\">\r\n                License\r\n            </div>\r\n          Unless otherwise stated, Global Galaxxy and/or its licensors own the intellectual property rights for all material on Global Galaxxy. All intellectual property rights are reserved. You may access this from Global Galaxxy for your own personal use subjected to restrictions set in these terms and conditions.\r\n\r\nGlobal Galaxxy reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.\r\n\r\nAs long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.\r\n        </div>\r\n        \r\n   \r\n        \r\n        \r\n       \r\n    </div>','',1,'2020-03-18 09:34:55'),(6,'Refund Policy','','refund-policy','','Once we receive your cancel request , we will inspect it and notify you that we have received your refund request We will immediately notify you on the status of your refund after inspecting the request.\r\n\r\nIf your return is approved, we will initiate a refund to your credit card (or original method of payment).\r\n\r\nYou will receive the credit within a certain amount of days, depending on your card issuer\'s policies.','',1,'2020-04-28 10:46:41'),(7,'Our Story','Short Story','our-story','',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at tortor lacus. Vestibulum molestie turpis maximus turpis sollicitudin, ac lacinia diam vehicula. Integer dolor ex, pharetra condimentum erat a, hendrerit consectetur erat. Donec blandit lorem nec neque ultrices viverra. Quisque at vehicula tellus, id mollis turpis. ','',0,'2021-07-23 10:36:58'),(8,'not convinced yet?','Why Choose Us','not-convinced-yet','',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at tortor lacus. <br>Vestibulum molestie turpis maximus turpis sollicitudin, ac lacinia diam vehicula.','',0,'2021-07-23 10:36:58');
/*!40000 ALTER TABLE `cms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'Vania Buxton','vania.buxton23@msn.com','keteke.net app for $50!','Hi,\r\n\r\nThis is crazy, we are building mobile Apps for $50.\r\n\r\nGet your iOS and Android App!\r\n\r\nWhy are we doing this? Well, we are building a lot for cheap.\r\n\r\nVisit us PCXLeads.com','2024-06-11 14:28:23'),(2,'Louvenia Baylor','baylor.louvenia37@googlemail.com','To the keteke.net Owner.','The Vetted Business Directory has completed its May 2024 updates with 7,358 new businesses added.\r\n\r\nYour business was unfortunately NOT ABLE TO BE INCLUDED :-(\r\n\r\nDon’t worry, this is easy to fix.\r\n \r\nUse the link in my signature to add or update your Vetted business details and realize the powerful benefits of being a Vetted Business in your local market, your service category and your business specialty.\r\n\r\nYours in trust & transparency,\r\n\r\nSarah McCormick\r\nVetted Business Specialist\r\n295 Seven Farms Drive Suite C-201\r\nCharleston, SC 29492\r\nSarah.McCormick@VettedPros.com\r\nhttps://vettedpros.com/1-2/?a=Get-Your-Business-Vetted!\r\n\r\nVetted is a game changing platform used by over 85,000 USA based businesses to share & prove their business credentials to amplify trust & transparency with shoppers and close up to 60% more sales than businesses not listed on the Vetted platform.','2024-06-11 19:19:10'),(3,'Sarah Mitchell','sarah@profinanceloans.biz','Good Morning,','Need fast cash for your business without all the red tape?\r\n\r\nGet an instant approval in less than 30 seconds without pulling your credit\r\nby clicking on this link https://profinanceloans.biz\r\n\r\nIf you accept our offer we will fund you the next day.\r\n\r\nApplying does NOT affect your credit and NO collateral or personal\r\nguarantees are required.\r\n\r\n\r\n\r\nThanks again,\r\n\r\nSarah Mitchell\r\n\r\nPro Finance','2024-06-12 15:47:08'),(4,'Belle Stopford','stopford.belle@msn.com','High-impact Contact Form Campaigns','Just like you\'ve received this message:\r\n\r\nSend your message to numerous  email inboxes from just 9$. We\'ll broadcast your message using numerous website contact forms, making sure all messages land the inbox. Produce leads, site visits, purchasers, and brand awareness.\r\n\r\nVisit https://bit.ly/cformmarketing\r\n\r\n\r\n\r\nUnsubscribe here if you don\'t want to get these great offers: https://bynd.li/unsubscribe\r\nWaterlelie 189, Buitenpost, FRANCE, Netherlands, 9285 Lb','2024-06-12 21:29:07'),(5,'Frederick Delong','delong.frederick@gmail.com','Dear keteke.net Owner!','Finally, an easy way to offer affordable payments to ALL customers and credit grades Don\'t leave money on the table, now you\'ll be able to turn people with low credit scores into paying customers!\r\n\r\n++ This Offer Only For Businesses In The USA ++\r\n\r\nGet in touch with me below for more info\r\n\r\nJessica Snyder\r\njessica.snyder@helloratespros.com\r\nhttps://helloratespros.com/5-6/','2024-06-12 22:53:00'),(6,'Emily Jones','emilyjones2250@gmail.com','Growing your Youtube channel','Hi there,\r\n\r\nWe run a YouTube growth service, which increases your number of subscribers both safely and practically.\r\n\r\nWe go beyond just subscriber numbers. We focus on attracting viewers genuinely interested in your niche, leading to long-term engagement with your content. Our approach leverages optimization, community building, and content promotion for sustainable growth, not quick fixes. Additionally, a dedicated team analyzes your channel and creates a personalized plan to unlock your full potential, all without relying on bots.\r\n\r\nOur packages start from just $60 (USD) per month.\r\n\r\nWould this be of interest?\r\n\r\nKind Regards,\r\nEmily\r\n\r\nUnsubscribe: https://removeme.click/yt/unsubscribe.php?d=keteke.net','2024-06-13 00:07:55'),(7,'Linnea Folingsby','linnea.folingsby@gmail.com','Affordable Hosting Solution for keteke.net','Hi there,\r\n\r\nAre you tired of paying monthly fees for website hosting, cloud storage, and funnels?\r\n\r\nWe offer a revolutionary solution: host unlimited websites, files, and videos for a single, low one-time fee. No more monthly payments.\r\n\r\nLearn more: https://furtherinfo.org/0wg3\r\n\r\nHere\'s what you get:\r\n\r\nUltra-fast hosting powered by Intel® Xeon® CPU technology\r\nUnlimited website hosting\r\nUnlimited cloud storage\r\nUnlimited video hosting\r\nUnlimited funnel creation\r\nFree SSL certificates for all domains and files\r\n99.999% uptime guarantee\r\n24/7 customer support\r\nEasy-to-use cPanel\r\n365-day money-back guarantee\r\n\r\nPlus, get these exclusive bonuses when you act now:\r\n\r\n60+ reseller licenses (sell hosting to your clients!)\r\n10 Fast-Action Bonuses worth over $19,997 (including AI tools, traffic generation, and more!)\r\n\r\nDon\'t miss out on this limited-time offer! The price is about to increase, and this one-time fee won\'t last forever.\r\n\r\nClick here to learn more: https://furtherinfo.org/0wg3\r\n\r\nLinnea','2024-06-13 16:04:42'),(8,'Sammy Barone','barone.keira@hotmail.com','Transform Your Sales with a Custom E-commerce Website!','Hi, \r\n\r\nStruggling to reach more customers and boost your sales in the competitive online market?\r\n\r\nWithout a user-friendly and attractive e-commerce website, you might be missing out on significant opportunities to grow your business and enhance your brand visibility.\r\n\r\nAt OutsourceBPO, we create stunning, custom e-commerce websites designed to meet your unique business needs. Here\'s how we can help:\r\n\r\n- **Custom Design:** Reflects your brand’s identity.\r\n- **User-Friendly:** Easy navigation on all devices.\r\n- **Essential Features:** Secure checkout, customer accounts, and more.\r\n- **SEO & Marketing:** Optimized and integrated to drive sales.\r\n- **Ongoing Support:** Continuous maintenance and updates.\r\n- **Affordable Pricing:** Packages to fit your budget.\r\n\r\nLet’s schedule a free consultation to discuss your goals and how we can help you achieve them. Visit https://outsource-bpo.com/website/?keteke.net for more details .\r\n\r\nBest regards,\r\nSam','2024-06-14 10:27:56'),(9,'Emily Thompson','emily@reachoutcapital.biz','Hello,','Need a Business Loan to take your business to the next level?\r\n\r\nInstantly see how much you qualify for without having your credit pulled or submitting a single document.\r\n\r\nJust visit https://reachoutcapital.biz to get your decision in less than 30 seconds. Applying\r\ndoes NOT affect your credit!\r\n\r\n\r\n\r\nBest regards,\r\n\r\nEmily Thompson\r\n\r\nReachout Capital','2024-06-14 16:16:45'),(10,'Ricardo Yirawala','ricardo.yirawala@gmail.com','To the keteke.net Webmaster!','Getting your business Vetted could help you close 60% more leads allowing you to reduce your advertising and lead generation  budget\r\nStart Your 30 Day Free Trial & See The Results for yourself. \r\nUSA Businesses Only\r\n\r\nSarah McCormick\r\nVetted Business Specialist\r\n295 Seven Farms Drive Suite C-201\r\nCharleston, SC 29492\r\nSarah.McCormick@VettedPros.com\r\nhttps://vettedpros.com/1-2/?a=Get-Your-Vetted-30-DAY-FREE-TRIAL! \r\n\r\nVetted is a game changing platform used by over 85,000 USA based businesses to share & prove their business credentials to amplify trust & transparency with shoppers and close up to 60% more sales than businesses not listed on the Vetted platform.','2024-06-15 16:12:50'),(11,'Mvhwwi','game.rebbeca@hotmail.com','Reduce Consumption and the Planet with Allecoearth','At Allecoearth, we\'re dedicated to offering eco-friendly products which benefit both you and the planet. Our range includes energy-efficient LEDs, solar-powered devices, and long-lasting products ideal for home and business use.\r\n\r\nWhether you\'re looking for something to improve your home, meet personal needs, or support outdoor activities, you\'ll find eco-friendly solutions for you. Additionally, if you are passionate about presentation, explore our Photography section, where you can discover innovative products to enhance your work.\r\n\r\nTo explore our products and uncover new ideas to help save and sustain the environment:\r\n\r\nCheck us out: bit.ly/45nfog3\r\n\r\nWant to learn more about creating an eco-friendly home? Reply to this email with \"3 ways\" to receive our free write-up, \"3 Simple Ways to Make Your Home Eco-Friendly.\" This guide is packed with valuable tips and is completely free.\r\n\r\n\r\n\r\nUnsubscribe here if you don\'t want to get these amazing offers: https://bit.ly/unsubscribecfl\r\n1460 Edwards Street, North Tonawanda, New York, US, 28560','2024-06-16 06:07:08'),(12,'Mark Harless','harless.iona@gmail.com','Hello keteke.net Webmaster.','If you are reading this message, That means my marketing is working. I can make your ad message reach 5 million sites in the same manner for just $50. It\'s the most affordable way to market your business or services. Contact me by email virgo.t3@gmail.com or skype me at live:.cid.dbb061d1dcb9127a','2024-06-17 17:27:05'),(13,'Randolph McAuley','mcauley.randolph25@hotmail.com','keteke.net This Secret Weapon is Getting EVERYONE Page 1 Rankings (Even Beginners!)','Hey Keteke,\r\n,\r\nThere\'s a silent revolution happening online. People (even those with ZERO SEO experience! ) are crushing it on Google, dominating search results, and attracting a flood of free traffic.\r\n\r\nHow? They\'re using a secret weapon...\r\n(Don\'t worry, it\'s not some shady black-hat trick!)\r\nIntroducing SEOBUDDY AI : The key to effortless page one rankings for even the most competitive keywords.\r\n\r\nRank Now =>> https://seobuddy-ranks-any-sites.blogspot.com/\r\n\r\nHere\'s why SEOBUDDY is different:\r\n\r\nAutomatic Optimization: Our powerful AI takes care of the technical SEO mumbo jumbo, putting you at the top of search results without lifting a finger.\r\nContent Made Easy: We provide data-driven content strategies so you can attract high-converting traffic.\r\nLong-Term Success: Forget temporary spikes. [Your Solution] delivers sustainable growth that keeps your website thriving.\r\n\r\nStill skeptical?  Here\'s what real people are saying:\r\n\r\n\"SEOBuddy helped my website jump from page three to number one in just a few weeks! It\'s amazing!\" - Sarah Lee, Business Owner\r\n\"I never thought I\'d understand SEO, but SEOBuddy made it easy. Now my website gets tons of organic traffic!\" - John Smith, Entrepreneur\r\n\r\nReady to join the page one revolution?\r\n\r\nClick here to learn more =>> https://seobuddy-ranks-any-sites.blogspot.com/\r\n\r\nP.S.  Spots are limited! Don\'t wait to unlock the power of automatic page one rankings and watch your website explode with organic traffic.\r\n\r\nMake it happen today!\r\n\r\n\r\n[Randolph McAuley]','2024-06-18 01:05:00'),(14,'Krish','outsourcedigitalmarketing@outlook.com','Content Writing Services','Are you looking for a content writer or copywriter who can write according to your ideas, follow your specific tone and style, and keep your audience in mind? I specialize in crafting content that is easy to read and consistent from start to finish. I currently work with many clients, interacting with their teams via video calls to ensure everything runs smoothly. Sometimes, clients ask me to conduct keyword research and plan content topics and points to cover. I also ensure all content is SEO-friendly. My experience includes writing blogs, articles, website copy, e-commerce product descriptions, e-books, and SEO content. I am happy to work within your budget. \r\n\r\nFeel free to reach out to me at outsourcedigitalmarketing@outlook.com','2024-06-18 20:38:01'),(15,'Izetta Petrie','izetta.petrie@gmail.com','Find Out How to Make Your Users Stick on keteke.net!','Hi to keteke.net Webmaster!\r\n\r\nNice website!\r\n\r\n name’s Izetta, and I recently found your site - keteke.net - when browsing the net. Your site popped up at the top of the search results, so I looked you out. Seems like what you’re doing is really interesting.\r\n\r\nBut if you don’t mind me asking – after someone like me lands across keteke.net, what normally happens?\r\n\r\nDoes your site create leads for your business?\r\n\r\nI’m thinking some, but I also guess you’d love more… data show that 7 out 10 people that land on a site wind up leaving without a trace.\r\n\r\nNot good.\r\n\r\nHere’s a thought – what if there\'s an easy way for every visitor to signal interest to get a phone call from you RIGHT AWAY… the moment they hit your site and expressed, “call me now.”\r\n\r\nYou can –\r\n\r\nWeb Visitors Into Leads is a tool widget that’s works on your site, set to grab any visitor’s Name, Email address and Phone Number. It lets you be informed IMMEDIATELY – so that you can speak to that lead while they’re actually looking over your site.\r\n\r\nCLICK HERE https://advanceleadgeneration.com to check out a Live Demo with Web Visitors Into Leads today to understand exactly how it functions.\r\n\r\nTiming is essential when it comes to connecting with leads – the difference between reaching out to someone in just 5 minutes compared to 30 minutes later can be huge – like 100 times better!\r\n\r\nThat’s why we created out our new SMS Text With Lead function… since after you’ve grabbed the visitor’s phone number, you can automatically start a text message (SMS) chat.\r\n\r\nImagine about the opportunities – even if you don’t close a deal then and there, you can stay connected with text messages for new deals, content links, or even just “how you doing?” notes to build a relationship.\r\n\r\nWouldn’t that be awesome?\r\n\r\nCLICK HERE https://advanceleadgeneration.com to discover what Web Visitors Into Leads can do for your business.\r\n\r\nYou could be converting up to 100X more leads right now!\r\nIzetta\r\n\r\nPS: Web Visitors Into Leads offers a FREE 14 days trial – and it even comes with International Long Distance Calling. \r\nYou have customers eager to chat with you at this moment… don’t leave them waiting. \r\nCLICK HERE https://advanceleadgeneration.com to try Web Visitors Into Leads today.\r\n\r\nIf you\'d prefer to unsubscribe click here https://advanceleadgeneration.com/unsubscribe.aspx?d=keteke.net\r\n\r\n\r\nJust a brief note - the names and email used in this email, Izetta and Petrie, are placeholders and not actual contact information. We cherish transparency and wanted to make sure you’re aware! If you want to get in touch with the real person responsible for this message, please go to our website, and we’ll associate you with the right individual.','2024-06-19 00:23:50'),(16,'Tyrone Kurtz','tyrone.kurtz@gmail.com','Hi keteke.net Admin.','The Vetted Business Directory has completed its May 2024 updates with 7,358 new businesses added.\r\n\r\nYour business was unfortunately NOT ABLE TO BE INCLUDED :-(\r\n\r\nDon’t worry, this is easy to fix.\r\n \r\nUse the link in my signature to add or update your Vetted business details and realize the powerful benefits of being a Vetted Business in your local market, your service category and your business specialty.\r\n\r\nYours in trust & transparency,\r\n\r\nSarah McCormick\r\nVetted Business Specialist\r\n295 Seven Farms Drive Suite C-201\r\nCharleston, SC 29492\r\nSarah.McCormick@VettedPros.com\r\nhttps://vettedpros.com/1-2/?a=Get-Your-Business-Vetted!\r\n\r\nVetted is a game changing platform used by over 85,000 USA based businesses to share & prove their business credentials to amplify trust & transparency with shoppers and close up to 60% more sales than businesses not listed on the Vetted platform.','2024-06-19 04:17:49'),(17,'Beau Briseno','beau.briseno@msn.com','To the keteke.net Owner!','Finally, an all in one customer financing solution for ANY credit score between 500-850 FICO More approvals = More Profits\r\n\r\n++ This Offer Only For Businesses In The USA ++\r\n\r\nSend me a message at my contact info below for info\r\n\r\nJessica Snyder\r\njessica.snyder@helloratespros.com\r\nhttps://helloratespros.com/5-6/','2024-06-19 05:54:16'),(18,'Ella Williams','ella@capitalboosting.biz','Quick question','Are you ready to elevate your business to the next level? \r\n\r\nOur working capital loans provide the financial boost you need to seize new opportunities, \r\nmanage cash flow, and expand your operations.\r\n\r\nCheck out what we can offer you today at www.capitalboosting.biz','2024-06-19 22:52:11'),(19,'Rolland Hinz','rolland.hinz@googlemail.com','Dear keteke.net Webmaster!','Hi there, I apologize for using your contact form, \r\nbut I wasn\'t sure who the right person was to speak with in your company. \r\nWe have a patented application that creates Local Area pages that rank on \r\ntop of Google within weeks, we call it Local Magic.  Here is a link to the \r\nproduct page https://www.mrmarketingres.com/local-magic/ . The product \r\nleverages technology where these pages are managed dynamically by AI and \r\nit is ideal for promoting any type of business that gets customers from Google.  Can I share a testimonial \r\nfrom one of our clients in the same industry?  I\'d prefer to do a short zoom to \r\nillustrate their full case study if you have time for it? \r\nYou can reach me at marketing@mrmarketingres.com or 843-720-7301. And if this isn\'t a fit please feel free to email me and I\'ll be sure not to reach out again.  Thanks!','2024-06-20 16:34:25'),(20,'Uuxmcpoag G Qn','kirch.andra@msn.com','Leveraging Wikipedia for Enhanced Brand Visibility','My name is Jared Michaels, and I am Senior Business Consultant with Wiki Crafter. \r\n\r\nAs you\'re aware, Wikipedia is a well-recognized and respected platform. It\'s considered among the most influential sources of information available globally. Listings often appears at the top of Google search results, making it a potent tool for any individual, business visibility, and credibility.\r\n\r\nHaving a well-crafted Wikipedia page can greatly benefit your brand or personal biography by:\r\n\r\n- Improving your search engine rankings,\r\n- Enhancing your reputation and credibility,\r\n- Providing a reliable source of information about your achievements and history,\r\n\r\nWe specialize in Crafting Wikipedia pages, Editing and updating pages on demand, and regularly monitoring, and maintaining them. We additionally offer PR services for individual or business branding.\r\n\r\nOur team of experts is dedicated to ensuring your Wikipedia page is accurate, well-maintained, and adheres to Wikipedia\'s strict guidelines. We handle everything from page creation to continuous updates, information procurement, and monitoring.\r\n\r\nIf you are looking forward to having a professional Wikipedia page listed for yourself or your brand, please send an email or contact me at jared@wikicrafter.com or just visit our website: https://bit.ly/4cmCbeA\r\n\r\n\r\n\r\nUnsubscribe here if you don\'t want to get these fantastic offers: https://bit.ly/unsubscribecfl\r\n1234 Shaughnessy St, Saratoga Springs, NY, US, V3c 4s7','2024-06-21 13:04:48'),(21,'Olivia Davis','olivia@swiftcapitalsolutions.biz','Discussing Next Steps','Looking for a financial partner to support your business ambitions? \r\n\r\nOur working capital loans offer the perfect solution to help you expand, innovate, and thrive.\r\n\r\nSee what we have to offer you today at www.swiftcapitalsolutions.biz','2024-06-21 15:19:16'),(22,'Rene Tichenor','rene.tichenor32@msn.com','Change Your Web Presence with This Latest Tool!','To the keteke.net Admin.\r\n\r\nCool website!\r\n\r\nMy name’s Rene, and I just discovered your site - keteke.net - when surfing the net. Your site appeared up on the very top of the search results, so I checked you out. Looks like what you’re doing is amazing.\r\n\r\nBut if you don’t mind me asking – after someone like me lands across keteke.net, what usually happens?\r\n\r\nDoes your site create leads for your business?\r\n\r\nI’m assuming some, but I also bet you’d like more… research show that 7 out 10 people that land on a site end up leaving without any interaction.\r\n\r\nNot good.\r\n\r\nHere’s a suggestion – what if there\'s an easy way for every visitor to signal interest to get a phone call from you RIGHT AWAY… the moment they hit your site and expressed, “call me now.”\r\n\r\nGuess what, you can –\r\n\r\nWeb Visitors Into Leads is a tool widget that’s works on your site, prepared to capture any visitor’s Name, Email address and Phone Number. It allows you know RIGHT AWAY – so that you can speak to that lead as they’re actually looking over your site.\r\n\r\nCLICK HERE https://advanceleadgeneration.com to try out a Live Demo with Web Visitors Into Leads now to see exactly how it works.\r\n\r\nTiming is money when it comes to connecting with leads – the difference between connecting with someone in just 5 minutes compared to 30 minutes later can be huge – like 100 times better!\r\n\r\nAnd that\'s why we created out our new SMS Text With Lead function… because after you’ve captured the visitor’s phone number, you can automatically start a text message (SMS) discussion.\r\n\r\nConsider about the opportunities – even if you don’t seal a deal right away, you can stay connected with text messages for new deals, content links, or even just “how you doing?” notes to build a relationship.\r\n\r\nWouldn’t that be awesome?\r\n\r\nCLICK HERE https://advanceleadgeneration.com to discover what Web Visitors Into Leads can do for your business.\r\n\r\nYou could be converting up to 100X more leads as we speak!\r\nRene\r\n\r\nPS: Web Visitors Into Leads offers a FREE 14 days trial – and it also includes International Long Distance Calls. \r\nYou have customers eager to talk with you right now… don’t leave them waiting. \r\nCLICK HERE https://advanceleadgeneration.com to test Web Visitors Into Leads now.\r\n\r\nIf you\'d want to unsubscribe click here https://advanceleadgeneration.com/unsubscribe.aspx?d=keteke.net\r\n\r\n\r\nOnly a short note - the name and email used in this email, Rene and Tichenor, are dummy data and not real contact details. We value transparency and wish to ensure that you’re informed! If you desire to come in contact with the real person responsible for this message, please go to our site, and we’ll connect you with the appropriate individual.','2024-06-21 20:28:00'),(23,'Rosalie Biggs','rosalie.biggs@gmail.com','Came across something concerning about keteke.net - should I be concerned?','hi there!\r\n\r\nIt\'s been a while, but I just got emailed a warning article online about keteke.net and felt it necessary to reach out to validate this nonsense. \r\n\r\nIt seems like there\'s some negative press that could be detrimental. \r\nKnowing how quickly rumors can spiral and hoping not you to be caught off guard, I decided to notify you.\r\n\r\nHere\'s where I came across the info:\r\n\r\nhttps://ibit.ly/lcuSU		\r\n\r\nI hope it\'s all a simple confusion, but I thought it best you should know!\r\n\r\nAll the best to you,\r\nRosalie','2024-06-21 23:16:46'),(24,'Valarie','valarieburgoyne@foxmail.com','Reach Us | Keteke','World\'s Best Neck Massager Get it Now 50% OFF + Free Shipping!\r\n\r\nWellness Enthusiasts! There has never been a better time to take care of your neck pain! \r\nOur clinical-grade TENS technology will ensure you have neck relief in as little as 20 minutes.\r\n\r\nGet Yours: https://hineck.co\r\n\r\nMany Thanks,\r\n\r\nValarie\r\nReach Us | Keteke','2024-06-23 17:39:36'),(25,'Ella Williams','ella@nextdayworkingcapital.com','Needing Working Capital-Solution','If you’re like most business owners, you know how hard it can be to get working capital when you need it most.\r\n\r\nNext Day Working Capital loans eliminate the stress by providing same day approvals for both our Lines of Credit and Term Loans. \r\n\r\nOur loans are unsecured and NOT based on personal credit.\r\n \r\nIf you’re in need of additional working capital just shoot me a text at 770-742-8548 and I’ll share some amazing options. \r\n\r\n\r\nWarm Regards,\r\nElla Williams\r\nNext Day Working Capital','2024-06-24 22:19:48'),(26,'Ella Williams','ella@nextdayworkingcapital.com','Needing Working Capital-Solution','If you’re like most business owners, you know how hard it can be to get working capital when you need it most.\r\n\r\nNext Day Working Capital loans eliminate the stress by providing same day approvals for both our Lines of Credit and Term Loans. \r\n\r\nOur loans are unsecured and NOT based on personal credit.\r\n \r\nIf you’re in need of additional working capital just shoot me a text at 770-742-8548 and I’ll share some amazing options. \r\n\r\n\r\nWarm Regards,\r\nElla Williams\r\nNext Day Working Capital','2024-06-25 16:11:02'),(27,'Oman Rivers','hubert.rivers75@yahoo.com','Need Business Capital Funding??','Hello,\r\n\r\nOne of the most significant hurdles for startups and existing businesses is securing the necessary funding to fuel their growth and bring their ideas to fruition. Our company specializes in providing tailored financing solutions to both startups and existing businesses. We offer debt financing with a competitive interest rate designed to support capital growth without burdening the business owners.\r\n\r\nOur loan interest rate is set at a favorable 3% annually, and with no early payment penalties, giving you the flexibility to manage your finances with ease. For those seeking equity financing, our venture capital funding option provides the capital you need to fuel your expansion. With just a modest 10% equity stake, you can access the resources necessary to scale your business while retaining control and ownership. We recognize these challenges and are committed to providing startups with flexible financing options tailored to their unique needs.\r\nWe are happy to review your pitch deck or executive summary to better understand your business and this will assist in determining the best possible investment structure that we can pursue and discuss extensively.\r\n\r\nI look forward to further communication.\r\n\r\nBest Regard,\r\n\r\nOman Rook\r\n\r\nExecutive Investment Consultant/Director\r\nCateus Investment Company (CIC)\r\n2401 AlMoayyed Tower Seef District\r\nManama - Kingdom of Bahrain\r\nPhone: +973-17-585338\r\nEmail: oman.rook@cateusinvestmentgroup.com, cateusgroup@gmail.com','2024-06-25 16:56:33'),(28,'Dong Hellyer','dong.hellyer@gmail.com','Hi keteke.net Admin.','Work From Home With This...You Will Never Look Back\r\n$500+ per day, 100% Free Training, go here:\r\n\r\nezwayto1000aday.com','2024-06-25 23:16:39'),(29,'Damon Marcantel','damon.marcantel57@msn.com','Hi keteke.net Owner.','Vetted is a powerful sales multiplier that helps you close 60 % more deals. \r\nThat’s a game changer.\r\nStart your 30 Day FREE trial & see the results for yourself. \r\nUSA Businesses Only\r\n\r\nSarah McCormick\r\nVetted Business Specialist\r\n295 Seven Farms Drive Suite C-201\r\nCharleston, SC 29492\r\nSarah.McCormick@VettedPros.com\r\nhttps://vettedpros.com/1-2/?a=Are-You-Ready-To-Dominate-Your-Local-Market?\r\n\r\nVetted is a game changing platform used by over 85,000 USA based businesses to share & prove their business credentials to amplify trust & transparency with shoppers and close up to 60% more sales than businesses not listed on the Vetted platform.','2024-06-26 00:29:46'),(30,'Maribel Poltpalingada','maribel.poltpalingada@icloud.com','Came across something alarming about keteke.net - should i be worried','hey, jsut a warning\r\n\r\nWe haven\'t spoken in a while, but I just got emailed a warning article online about keteke.net and felt it necessary to message you guys to validate this article. \r\n\r\nIt appears like there\'s some rumors circulating that could be harmful to your reputation. \r\nBeing aware of how fast misinformation can spread and hoping not you to be unprepared, I decided to warn you.\r\n\r\nHere\'s where I found the info:\r\n\r\nhttps://ibit.ly/CfT9H		\r\n\r\nI hope it\'s all a mix-up, but I believed it necessary you should know!\r\n\r\nWishing you all the best,\r\nMaribel','2024-06-26 02:49:48'),(31,'Penni Dieter','penni.dieter@gmail.com','Dear keteke.net Admin!','Finally, an easy way to offer affordable payments to ALL customers and credit grades Don\'t leave money on the table, now you\'ll be able to turn people with low credit scores into paying customers!\r\n\r\n** USA Based Businesses Only! **\r\n\r\nSend me a message at my contact info below for info\r\n\r\nJessica Snyder\r\njessica.snyder@helloratespros.com\r\nhttps://helloratespros.com/5-6/','2024-06-26 11:43:50'),(32,'Ella Williams','ella@nextdayworkingcapital.com','Hello','If you’re like most business owners, you know how hard it can be to get working capital when you need it most.\r\n\r\nNext Day Working Capital loans eliminate the stress by providing same day approvals for both our Lines of Credit and Term Loans. \r\n\r\nOur loans are unsecured and NOT based on personal credit.\r\n \r\nIf you’re in need of additional working capital just  text INFO to  770-742-8548 and I’ll share some amazing options with you.\r\n\r\n\r\nWarm Regards,\r\nElla Williams\r\nNext Day Working Capital\r\nnextdayworkingcapital.com','2024-06-26 15:07:52'),(33,'Eric Jones','ericjonesmyemail@gmail.com','Strike when the iron’s hot','To the keteke.net Owner. I just found your site, quick question…\r\n\r\nMy name’s Eric, I found keteke.net after doing a quick search – you showed up near the top of the rankings, so whatever you’re doing for SEO, looks like it’s working well.\r\n\r\nSo here’s my question – what happens AFTER someone lands on your site?  Anything?\r\n\r\nResearch tells us at least 70% of the people who find your site, after a quick once-over, they disappear… forever.\r\n\r\nThat means that all the work and effort you put into getting them to show up, goes down the tubes.\r\n\r\nWhy would you want all that good work – and the great site you’ve built – go to waste?\r\n\r\nBecause the odds are they’ll just skip over calling or even grabbing their phone, leaving you high and dry.\r\n\r\nBut here’s a thought… what if you could make it super-simple for someone to raise their hand, say, okay, let’s talk without requiring them to even pull their cell phone from their pocket?\r\n  \r\nYou can – thanks to revolutionary new software that can literally make that first call happen NOW.\r\n\r\nWeb Visitors Into Leads is a software widget that sits on your site, ready and waiting to capture any visitor’s Name, Email address and Phone Number.  It lets you know IMMEDIATELY – so that you can talk to that lead while they’re still there at your site.\r\n  \r\nYou know, strike when the iron’s hot!\r\n\r\nCLICK HERE https://rushleadgeneration.com to try out a Live Demo with Web Visitors Into Leads now to see exactly how it works.\r\n\r\nWhen targeting leads, you HAVE to act fast – the difference between contacting someone within 5 minutes versus 30 minutes later is huge – like 100 times better!\r\n\r\nThat’s why you should check out our new SMS Text With Lead feature as well… once you’ve captured the phone number of the website visitor, you can automatically kick off a text message (SMS) conversation with them. \r\n \r\nImagine how powerful this could be – even if they don’t take you up on your offer immediately, you can stay in touch with them using text messages to make new offers, provide links to great content, and build your credibility.\r\n\r\nJust this alone could be a game changer to make your website even more effective.\r\n\r\nStrike when  the iron’s hot!\r\n\r\nCLICK HERE https://rushleadgeneration.com to learn more about everything Web Visitors Into Leads can do for your business – you’ll be amazed.\r\n\r\nThanks and keep up the great work!\r\n\r\nEric\r\nPS: Web Visitors Into Leads offers a FREE 14 days trial – you could be converting up to 100x more leads immediately!   \r\nIt even includes International Long Distance Calling. \r\nStop wasting money chasing eyeballs that don’t turn into paying customers. \r\nCLICK HERE https://rushleadgeneration.com to try Web Visitors Into Leads now.\r\n\r\nIf you\'d like to unsubscribe click here https://rushleadgeneration.com/unsubscribe.aspx?d=keteke.net','2024-06-26 16:49:33'),(34,'Jannes Welman','jannes@pcxgroup.com','An app for your business','Hello keteke.net\r\n\r\nWe noticed your website keteke.net doesn\'t have a Mobile App for iOS and Android.\r\n\r\nWe are building Android and iOS Apps for $99 each a combo deal of $149 for both\r\n\r\nYou can get a free preview on PCXLeads or email us back and we will send you a mockup for your apps.\r\n\r\nThis promo is valid till end of June 2024.\r\n\r\nRegards,\r\nPCXLeads','2024-06-27 13:20:35'),(35,'Victor McGahan','mcgahan.victor@yahoo.com','Hello keteke.net Owner!','Hi, I was searching through Siri on my phone and I couldn’t find you.\r\n\r\nWe know how to flood your business with customers from Siri and the 4 other voice search platforms (Amazon Alexa, Google Assistant, Microsoft Copilot, and Samsung Bixby).\r\n\r\nNot only do we know how to register your business on these platforms, we know how to rank your business within the top 3 reach results to flood your business with high intent customers looking to buy.\r\n\r\nWould it be a bad idea to have your business be in the top 3 search results?\r\n\r\nI didn’t think so :)\r\n\r\n\r\nYou can learn more here:\r\n\r\nhttps://vocalseek.com/','2024-06-27 20:57:18'),(36,'Phil Stewart','noreplyhere@aol.com','??','Quick question for you, would you like me to blast your ad to millions of contact forms? I posted my ad to your contact form just now and you\'re reading it so there\'s proof it works. Take a look at my site below for more info\r\n\r\nhttp://y2lgzq.blast-to-forms.xyz','2024-06-27 23:11:54'),(37,'Joanna Riggs','joannariggs278@gmail.com','Explainer Video for keteke.net?','Hi,\r\n\r\nI just visited keteke.net and wondered if you\'d ever thought about having an engaging video to explain what you do?\r\n\r\nOur videos cost just $195 for a 30 second video ($239 for 60 seconds) and include a full script, voice-over and video.\r\n\r\nI can show you some previous videos we\'ve done if you want me to send some over. Let me know if you\'re interested in seeing samples of our previous work.\r\n\r\nRegards,\r\nJoanna\r\n\r\nUnsubscribe: https://removeme.click/ev/unsubscribe.php?d=keteke.net','2024-06-28 06:52:43'),(38,'Reyna Aston','reyna.aston@gmail.com','Hello keteke.net Owner!','Looking for a Great Job? \r\n75% of resumes aren’t even seen by hiring managers!  \r\n \r\nIs your resume keyword rich and ATS ready? \r\n \r\nFind out with our FREE consultation with a certified, trained resume writing. \r\nSend your resume to resumes@razoredgeresumes.com to make sure you are not missing out!\r\n  \r\nSend your resume now and we will reach out to you to speak at your convenience.\r\n\r\nQuick and easy. Start today!','2024-06-28 12:50:56'),(39,'Olivia Davis','olivia@nextdayworkingcapital.com','Thoughts?','Do you sometimes struggle with inconsistent cash flow? \r\n\r\nLike a temporary drop in sales or invoices not being paid on time.\r\n\r\nHere at Next Day Working Capital, we’ve helped businesses throughout the country deal with this problem \r\nby providing them a Business Line of Credit or Term Loan that is approved and funded within 48 hours.\r\n\r\nText LOAN to 770-742-8548 and I’ll show you how simple the process is. You can also visit our website \r\nat www.nextdayworkingcapital.com and see how much you qualify for in under 30 seconds. \r\n\r\n\r\n\r\nWarm Regards,\r\nOlivia Davis\r\nNext Day Working Capital\r\nnextdayworkingcapital.com','2024-06-28 15:21:17'),(40,'Kelvin Ritchey','kelvin.ritchey@yahoo.com','Free Business Data','Want Free business data?\r\n\r\nUsage:\r\n\r\nhttps://leadsbox.biz\r\n\r\n(Lawyers in New york for example)\r\n\r\n71 Million business records in 202 countries\r\n\r\nUpdated Daily\r\n\r\nCompany Name\r\ncountryCode\r\ncountryName\r\nstate\r\ncounty\r\ncity\r\nstreet\r\npostalCode\r\nbuilding\r\nlat\r\nlng\r\nCategory\r\nSecondary Category\r\nPersonal contacts\r\nPhones\r\nFax\r\nEmails\r\nReviews\r\nopening hours\r\n\r\nand more\r\n\r\nLeadsBox.biz','2024-06-28 18:44:25'),(41,'Gabriela Easterby','gabriela.easterby37@hotmail.com','Seize Conversions Right Away with The Revolutionary Tool!','Hi to keteke.net Owner.\r\n\r\nAwesome website!\r\n\r\nMy name’s Gabriela, and I recently came across your site - keteke.net - when browsing the net. You appeared up on the very top of the search engine results, so I looked you out. Looks like what you’re doing is amazing.\r\n\r\nBut just in case you don’t mind me asking – after someone like me stumbles across keteke.net, what usually happens?\r\n\r\nDoes your site produce leads for your business?\r\n\r\nI’m guessing some, but I also guess you’d like more… research show that 7 out 10 people that land on a site wind up leaving without leaving any trace.\r\n\r\nThat\'s unfortunate.\r\n\r\nHere is a idea – what if there was an effortless way for every visitor to signal interest to get a phone call from you RIGHT AWAY… the moment they hit your site and expressed, “call me now.”\r\n\r\nYou can –\r\n\r\nWeb Visitors Into Leads is a software widget that’s operates on your site, prepared to collect every visitor’s Name, Email address and Phone Number. It lets you know INSTANTLY – so that you can chat to that lead while they’re literally looking over your site.\r\n\r\nCLICK HERE https://advanceleadgeneration.com to experience a Live Demo with Web Visitors Into Leads now to understand exactly how it operates.\r\n\r\nTime is essential when it comes to engaging with leads – the difference between connecting with someone in just 5 minutes compared to 30 minutes later can be significant – like 100 times more effective!\r\n\r\nThat’s why we built out our new SMS Text With Lead capability… since once you’ve collected the visitor’s phone number, you can automatically start a text message (SMS) discussion.\r\n\r\nConsider about the potential – even if you don’t close a deal right away, you can keep in touch with text messages for fresh deals, content links, or even just “how you doing?” notes to establish a relationship.\r\n\r\nWould not that be fantastic?\r\n\r\nCLICK HERE https://advanceleadgeneration.com to learn what Web Visitors Into Leads can do for your business.\r\n\r\nYou could be turning up to 100X more leads right now!\r\nGabriela\r\n\r\nPS: Web Visitors Into Leads provides a FREE 14 days trial – and it even features International Long Distance Calling. \r\nYou have customers eager to speak with you right now… don’t keep them waiting. \r\nCLICK HERE https://advanceleadgeneration.com to experience Web Visitors Into Leads now.\r\n\r\nIf you\'d want to unsubscribe click here https://advanceleadgeneration.com/unsubscribe.aspx?d=keteke.net\r\n\r\n\r\nJust a short note - the names and email used here, Gabriela and Easterby, are for representation and not genuine contact information. We value transparency and wanted to make sure you’re aware! If you want to get in contact with the real person behind this message, please visit our website, and we’ll associate you with the right individual.','2024-06-30 16:22:31'),(42,'Cameron Thiele','thiele.cameron@yahoo.com','To the keteke.net Webmaster!','The Vetted Business Directory has completed its May 2024 updates with 7,358 new businesses added.\r\n\r\nYour business was unfortunately NOT ABLE TO BE INCLUDED :-(\r\n\r\nDon’t worry, this is easy to fix.\r\n \r\nUse the link in my signature to add or update your Vetted business details and realize the powerful benefits of being a Vetted Business in your local market, your service category and your business specialty.\r\n\r\nYours in trust & transparency,\r\n\r\nSarah McCormick\r\nVetted Business Specialist\r\n295 Seven Farms Drive Suite C-201\r\nCharleston, SC 29492\r\nSarah.McCormick@VettedPros.com\r\nhttps://vettedpros.com/1-2/?a=Get-Your-Business-Vetted!\r\n\r\nVetted is a game changing platform used by over 85,000 USA based businesses to share & prove their business credentials to amplify trust & transparency with shoppers and close up to 60% more sales than businesses not listed on the Vetted platform.','2024-07-01 02:32:33');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (1,'United States',1),(2,'Canada',1),(3,'Ghana',1);
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_details`
--

DROP TABLE IF EXISTS `coupon_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupon_details` (
  `coupon_id` int(10) NOT NULL AUTO_INCREMENT,
  `coupon_type` varchar(100) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `created_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `coupon_amount` varchar(50) NOT NULL,
  `coupon_img` text NOT NULL,
  `coupon_status` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`coupon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_details`
--

LOCK TABLES `coupon_details` WRITE;
/*!40000 ALTER TABLE `coupon_details` DISABLE KEYS */;
INSERT INTO `coupon_details` VALUES (1,'amount','BUCKET250','2021-07-16','2021-07-31','100','pvr.png',1,NULL,'2022-01-11 16:34:42'),(2,'percent','SAVE50','2021-07-16','2022-08-10','50','md.png',1,NULL,'2022-01-11 16:34:42'),(3,'amount','SAVEURE','2021-10-08','2021-12-03','15','kfc.png',1,NULL,'2022-01-11 16:34:42'),(4,'amount','FLAT150','2021-07-30','2021-08-28','150','sb1.png',1,NULL,'2022-01-11 16:34:42'),(5,'percent','FLAT25','2021-05-01','2021-07-28','25','app.png',1,NULL,'2022-01-11 16:34:42'),(6,'percent','RAINY85','2021-04-28','2021-08-28','850','sms.png',1,NULL,'2022-01-11 16:34:42'),(7,'percent','zcxzc','2021-12-10','2021-12-30','12','Capture.PNG',1,NULL,'2022-01-11 16:34:42'),(8,'amount','BUCKET50','2022-01-11','2022-01-28','10','',1,NULL,'2022-01-11 16:34:42'),(10,'amount','SAVEURE56','2022-01-12','2022-01-13','15','',1,NULL,'2022-01-11 16:34:42');
/*!40000 ALTER TABLE `coupon_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_billing_addrs`
--

DROP TABLE IF EXISTS `customer_billing_addrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_billing_addrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) DEFAULT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `billing_fname` varchar(255) DEFAULT NULL,
  `billing_lname` varchar(255) NOT NULL,
  `billing_email` varchar(255) DEFAULT NULL,
  `billing_phone` varchar(50) DEFAULT NULL,
  `billing_address` varchar(50) DEFAULT NULL,
  `billing_city` varchar(50) DEFAULT NULL,
  `billing_state` varchar(50) DEFAULT NULL,
  `billing_country` varchar(50) DEFAULT NULL,
  `billing_zip` varchar(50) DEFAULT NULL,
  `default_address` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 =default 0=normal',
  `status` tinyint(4) DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created` datetime DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_billing_addrs`
--

LOCK TABLES `customer_billing_addrs` WRITE;
/*!40000 ALTER TABLE `customer_billing_addrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_billing_addrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_shipping_addrs`
--

DROP TABLE IF EXISTS `customer_shipping_addrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_shipping_addrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) DEFAULT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `shipping_fname` varchar(100) DEFAULT NULL,
  `shipping_lname` varchar(255) NOT NULL,
  `shipping_email` varchar(255) DEFAULT NULL,
  `shipping_phone` varchar(100) DEFAULT NULL,
  `shipping_address` varchar(50) DEFAULT NULL,
  `shipping_city` varchar(50) DEFAULT NULL,
  `shipping_state` varchar(50) DEFAULT NULL,
  `shipping_country` varchar(50) DEFAULT NULL,
  `shipping_zip` varchar(50) DEFAULT NULL,
  `default_address` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 =default 0=normal',
  `status` tinyint(4) DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created` datetime DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_shipping_addrs`
--

LOCK TABLES `customer_shipping_addrs` WRITE;
/*!40000 ALTER TABLE `customer_shipping_addrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_shipping_addrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `draft_orders`
--

DROP TABLE IF EXISTS `draft_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `draft_orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `draftpayment_orderid` int(11) NOT NULL COMMENT 'primary key draftorders_payment table',
  `product_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_charge` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `order_status` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'seller creator ID',
  `created_at` datetime DEFAULT NULL,
  `billing_addr` int(11) DEFAULT NULL,
  `shipping_addr` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `draft_orders`
--

LOCK TABLES `draft_orders` WRITE;
/*!40000 ALTER TABLE `draft_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `draft_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `draftorders_payment`
--

DROP TABLE IF EXISTS `draftorders_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `draftorders_payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pay_user_id` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `txn_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cardholder_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_gross` int(11) NOT NULL,
  `payment_status` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `tran_date` datetime DEFAULT NULL,
  `payment_created_by` int(11) NOT NULL,
  `payment_created_date` datetime DEFAULT NULL,
  `email_sent` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `draftorders_payment`
--

LOCK TABLES `draftorders_payment` WRITE;
/*!40000 ALTER TABLE `draftorders_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `draftorders_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'1. How to contact with providers on Thedir?','','<p>It all depends on how many negative inaccurate, obsolete, misleading or duplicate items are on your credit reports. It also depends on the credit bureaus properly doing their job by heeding the federal law, Fair Credit Reporting Act. You will usually see results from all 3 credit bureaus in as little as 35-45 days. The credit bureaus can respond faster if they gather all of the information back from your creditors in a timely manner, which by law is no more than 30 days.</p>\r\n',1,'2020-01-16 07:35:06'),(2,'2. How to write review on Thedir?','','<p>We can guarantee that we can improve your credit and credit scores within the 4 months time. But you must have done at least two rounds of disputes through each of the credit bureaus and not have any new items appear on your credit reports. We cannot guarantee that a certain item will be deleted or corrected in a certain period of time. That would be against the law. We do know that with determination and persistence, this process does work.</p>\r\n',1,'2020-01-16 07:44:05'),(3,'3. How to become a provider on Thedir?','','<p>Any information on a credit report can be removed, but it has to be removed due to a violation of some type (which you will find described in the Fair Credit Reporting Act) (FCRA). There are many laws written to protect you (the consumer), so anything that violates these laws will cause a removal of any accounts including judgments, liens, collections, charge-offs, bankruptcies and late payments that are incorrect, misleading, obsolete or inaccurate.</p>\r\n',1,'2020-01-16 07:45:31'),(4,'4. What benefits that i will get when become provider?','','<p>No, there is more to the credit repair/restoration/rebuilding process than just sending letters or proper documents to the Credit Bureaus. Yes, you could have prepared the necessary documents yourself, but if you do not do them properly, request your investigation properly or send the correct requested items, then you risk the chance of being ignored, receive a rejection letter in the mail or have something deleted when you really wanted it corrected, etc. Also, when the results come back to you, it is very difficult to read them or understand what the credit bureaus did. For example, the credit bureaus can delete or correct an item but did not list it in the results section. Our job is to decipher these results and to correct their mistakes, know what to do if they ignore you and how to continue. With our years of experience and expertise, we can help the credit repair/restoration/rebuilding process to continue smoothly. Also, most consumers just don&#39;t know their credit rights and what they can do to improve their credit and raise their scores. It is very similar to doing your own taxes. If you don&#39;t know how then you hire a professional CPA. You can also represent yourself in a court of law, but if you want a professional, then you hire an attorney. Experience and knowledge count for a lot in this line of work. You want to get the best results possible and not spend a lot of money doing it!</p>\r\n',1,'2020-01-16 07:46:12'),(5,'5. What i have to when my listing has been reported by somone?','','<p>If you receive something from a bank, creditor or a collection agency, make sure that you read the entire letter and the BACK of the letter. You don&#39;t have to respond to it unless it is a collection letter*. Most letters are just AUTOMATIC FORM letters that they send out to see if you are a victim of Identity Theft. If you are really a victim of Identity Theft, by all means, fill the form out and send it into them. Otherwise, it usually is not important. Please do not throw it away, just file it in your educational folder. *(If the letter is a collection letter, then you do want to respond to it with a &#39;Debt Validation Letter&#39;. Contact us for more information on this).</p>\r\n',1,'2020-01-16 07:46:48'),(6,'6. Where i can find a support from your team?','','<p>For the most part, you will receive results back from each of the three credit bureaus. There has been an occasion that one of the credit bureaus will ignore your request to investigate your credit report. This may be a stall tactic on their part. Keep in mind they don&#39;t make any money by investigating your items on your credit reports. So there is no real benefit to them to do this, only a benefit to you! If this does happen, and you have waited at least 60 days from the date that you mailed the original letters/documents to them, then please forward what you did receive from the other two credit bureaus and call our office to advise us of the situation. We will note your file and take a stronger stance on the next action and will not let the credit bureaus get away with it!!!</p>\r\n',0,'2020-01-16 07:47:09'),(7,'7. How much comission that i can earn when use Thedir’s Affiliate?','','<p>Each of the credit bureaus is three separate companies. They are not government offices or have some superior authority. So if one credit bureau deletes an account, it doesn&#39;t mean the other two have to. Each of the credit bureaus does not know what the other ones are doing. They don&#39;t have the time or the benefit to compare notes.</p>\r\n',1,'2020-01-16 07:47:39'),(8,'8. How about secure and payment on Thedir?','','<p>Yes, most definitely. We try to wait at least 70 days (more is better) in between disputes. This way we are hoping that the credit bureaus will take the previous request to investigate the items out of their computer system. There really way of telling this for sure as they will not discuss their internal procedures. This information comes from years of experience in getting great results for our clients.</p>\r\n',1,'2020-01-16 07:48:07');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keys`
--

DROP TABLE IF EXISTS `keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(11) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keys`
--

LOCK TABLES `keys` WRITE;
/*!40000 ALTER TABLE `keys` DISABLE KEYS */;
INSERT INTO `keys` VALUES (1,0,'ca1c2864f4fed155f8cdbe9c551b2b3a',0,0,0,NULL,'2021-08-16 13:34:33');
/*!40000 ALTER TABLE `keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listing`
--

DROP TABLE IF EXISTS `listing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `listing` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `busi_classi` varchar(255) NOT NULL,
  `other_classi` varchar(225) DEFAULT NULL,
  `street_addr` varchar(355) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `website` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `lati` double NOT NULL,
  `longi` double NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `slug` varchar(500) NOT NULL,
  `fblink` varchar(255) NOT NULL,
  `twlink` varchar(255) NOT NULL,
  `prefer_list` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listing`
--

LOCK TABLES `listing` WRITE;
/*!40000 ALTER TABLE `listing` DISABLE KEYS */;
INSERT INTO `listing` VALUES (2,145,'Test Business','','test','1, DN Block, Sector V, Bidhannagar, Kolkata, West Bengal 700091, India','Kolkata',3,1,0,'Test','','test@gmail.com','1234567890','Blue+Waters+Cabinets+Angle+square1.png',22.5764753,88.4306861,1,'2024-06-13 07:55:14','','','',0),(4,145,'Test Business','','test','1, DN Block, Sector V, Bidhannagar, Kolkata, West Bengal 700091, India','Kolkata',3,1,0,'Test','','test@gmail.com','1234567890','',22.5764753,88.4306861,1,'2024-06-13 08:06:03','','','',0);
/*!40000 ALTER TABLE `listing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listing_category`
--

DROP TABLE IF EXISTS `listing_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `listing_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listing_category`
--

LOCK TABLES `listing_category` WRITE;
/*!40000 ALTER TABLE `listing_category` DISABLE KEYS */;
INSERT INTO `listing_category` VALUES (1,1,'Restaurant',1,'2021-04-07 10:50:59'),(2,1,'Bars',1,'2021-04-07 10:54:09'),(3,2,'Lawn mover',1,'2021-04-07 10:54:20'),(4,3,'Churches',1,'2021-04-07 10:54:23'),(5,2,'Electricians',1,'2021-04-07 10:54:27'),(6,3,'Mosque',1,'2021-04-07 10:54:30'),(7,3,'National/Ethnic gps',1,'2021-04-07 10:54:34'),(8,2,'Plumber',1,'2021-04-12 13:57:09'),(9,4,'Lawyers',1,'2021-04-12 13:57:16'),(10,4,'Accountants',1,'2021-04-12 13:57:23'),(11,4,'Clinics/Hospitals',1,'2021-04-12 13:57:31'),(12,1,'night club',1,'2021-10-17 02:41:17'),(13,1,'Concert',1,'2022-01-18 08:17:38'),(14,3,'Methodist Church',1,'2022-01-18 08:22:13'),(15,1,'Night Club',1,'2022-01-25 05:22:14'),(16,7,'Methodist Church',1,'2022-04-07 03:36:10');
/*!40000 ALTER TABLE `listing_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marketplace_submenu`
--

DROP TABLE IF EXISTS `marketplace_submenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marketplace_submenu` (
  `submenuId` bigint(20) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`submenuId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marketplace_submenu`
--

LOCK TABLES `marketplace_submenu` WRITE;
/*!40000 ALTER TABLE `marketplace_submenu` DISABLE KEYS */;
INSERT INTO `marketplace_submenu` VALUES (1,2,'Men',1,'2021-11-11 15:48:33'),(2,2,'Women',1,'2021-11-11 15:48:33'),(3,2,'Kids',1,'2021-11-11 15:49:18'),(4,2,'Unisex',1,'2022-03-31 04:17:48'),(5,3,'Men',1,'2022-03-31 04:34:24'),(6,3,'Unisex',1,'2022-03-31 04:34:45');
/*!40000 ALTER TABLE `marketplace_submenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrkt_category`
--

DROP TABLE IF EXISTS `mrkt_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mrkt_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrkt_category`
--

LOCK TABLES `mrkt_category` WRITE;
/*!40000 ALTER TABLE `mrkt_category` DISABLE KEYS */;
INSERT INTO `mrkt_category` VALUES (1,'Art & Craft',1,'2021-05-26 12:33:00'),(2,'Clothing',1,'2021-05-26 12:33:00'),(3,'Bags',1,'2021-05-26 12:33:00'),(4,'Jewellery',1,'2021-05-26 12:33:00'),(5,'Health & Beauty',1,'2021-05-26 12:33:00'),(6,'Food & Drinks',1,'2021-05-26 12:33:00'),(7,'Books & Electronics',1,'2021-05-26 12:33:00'),(8,'Miscellaneous',1,'2021-05-26 12:33:00'),(9,'Sporting Goods',1,'2021-10-17 02:30:49'),(10,'Grocery Shops',1,'2022-01-20 08:21:34');
/*!40000 ALTER TABLE `mrkt_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter`
--

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
INSERT INTO `newsletter` VALUES (1,'Paige930_Schaefer.1994@alabamahomenetwoks.com','0000-00-00 00:00:00'),(2,'Agustina768Torphy.2005@alabamahomenetwoks.com','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `options` (
  `option_id` bigint(20) unsigned NOT NULL,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext,
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'logo','https://keteke.net/fassets/images/logos/headertransparentlogo.png');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(11) NOT NULL,
  `txn_id` varchar(155) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `cardholder_name` varchar(255) DEFAULT NULL,
  `payment_gross` int(11) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,'30','txn_3Jbip5DJ6lyRa0Rw0vL3XD2g','KETEKEPR615179499c12e27-09-2021','kunulaxmi das',30,'succeeded','2021-10-22 22:27:04'),(2,'30','txn_3JcrwQJjDckR426H0HjzH55b','KETEKEPR614c8062df8f023-09-2021','kunulaxmi das',30,'succeeded','2021-10-22 22:42:49'),(3,'guest','txn_3LnFiNJjDckR426H0FLnp2EJ','KETEKEPR6335331225d9128-09-2022','jyoti',30,'succeeded','2022-09-29 17:25:20'),(4,'67','txn_3OmF87JjDckR426H1j6Dgx0h','KETEKEPR65d5ef984feb621-02-2024','test',70,'succeeded','2024-02-22 01:12:32'),(5,'69','txn_3OmcshJjDckR426H12y5ikrG','KETEKEPR65d7544e3ea8722-02-2024','test',10,'succeeded','2024-02-23 02:34:11'),(6,'67','txn_3OmctyJjDckR426H1vu6uN5J','KETEKEPR65d7549f23ca722-02-2024','test',10,'succeeded','2024-02-23 02:35:31'),(7,'guest','txn_3OqVsuJjDckR426H1Xql9ch2','KETEKEPR65e57722c72ee04-03-2024','test',30,'succeeded','2024-03-04 19:54:29'),(8,'67','txn_3OqWbfJjDckR426H0rj1tJRi','KETEKEPR65e581fc4443004-03-2024','test',30,'succeeded','2024-03-04 20:40:44');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_brand`
--

DROP TABLE IF EXISTS `product_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` text COLLATE utf8_unicode_ci,
  `brand_image` text COLLATE utf8_unicode_ci,
  `status` enum('1','2') COLLATE utf8_unicode_ci DEFAULT '1',
  `is_delete` enum('1','2') COLLATE utf8_unicode_ci DEFAULT '1' COMMENT 'status 1 => active\\nstatus 2 => inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_brand`
--

LOCK TABLES `product_brand` WRITE;
/*!40000 ALTER TABLE `product_brand` DISABLE KEYS */;
INSERT INTO `product_brand` VALUES (1,'Zara','png-transparent-zara-hd-logo-thumbnail1.png','1','1'),(2,'Gucci','1971-gucci-logo-600x319.png','1','1'),(3,'calvin klein','Calvin-Klein-Logo.jpg','1','1'),(4,'Nike','455d7b33b9cbca8fbf7d91c7e3c9add4.jpg','1','1');
/*!40000 ALTER TABLE `product_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `productImageId` bigint(20) NOT NULL AUTO_INCREMENT,
  `productImage` text NOT NULL,
  `productId` bigint(20) NOT NULL,
  PRIMARY KEY (`productImageId`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,'product-2.jpg',3),(2,'product-3.jpg',4),(3,'product-4.jpg',2),(4,'product-5.jpg',1),(5,'product-2.jpg',28),(6,'product-3.jpg',29),(7,'product-4.jpg',30),(8,'product-5.jpg',31);
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_review`
--

DROP TABLE IF EXISTS `product_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_review` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `message` text NOT NULL,
  `add_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_review`
--

LOCK TABLES `product_review` WRITE;
/*!40000 ALTER TABLE `product_review` DISABLE KEYS */;
INSERT INTO `product_review` VALUES (1,4,0,3,'kunu','fdsdyhu','sdewrt fghytyu','2021-06-30 09:43:30'),(2,4,0,3,'dfrfyt6udftfgttyhtu','fgtfguytg','tytgu87yyhj  hello','2021-06-30 09:47:00'),(3,2,0,4,'ghtfuyy','yhgy7i','hgguiyh','2021-06-30 09:49:18'),(4,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(5,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(6,3,0,3,'Pravat','Good','It\'s the best product ','2024-05-07 06:18:07'),(7,3,0,3,'Pravat','Good','It\'s the best product ','2024-05-07 06:21:53'),(8,3,0,3,'Pravat','Good','It\'s the best product ','2024-05-07 06:22:18'),(9,2,0,3,'Pravat','Review ','Nice ine','2024-05-07 06:24:16'),(10,3,0,4,'pravin','bad product','its not good at all','2024-05-13 06:46:41'),(11,2,0,1,'xyz','dsfg','dsfgdfs','2024-05-13 06:51:21'),(12,2,145,4,'Demo user','','good product','2024-06-12 08:09:04'),(13,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(14,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(15,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(16,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(17,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(18,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(19,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(20,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(21,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(22,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(23,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(24,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(25,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(26,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(27,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(28,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(29,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(30,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(31,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(32,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(33,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(34,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(35,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(36,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(37,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(38,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(39,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(40,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(41,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(42,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(43,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(44,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(45,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(46,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(47,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(48,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(49,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(50,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(51,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(52,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(53,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(54,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(55,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(56,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(57,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(58,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(59,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(60,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(61,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(62,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(63,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(64,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(65,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(66,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(67,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(68,1,0,3,'Amit kumar','Test subject','Test hello msg','2024-05-07 04:58:07'),(69,1,0,3,'Pravatgfh','Gfhgfh','Gfhfghghf','2024-05-07 05:48:26'),(70,1,0,4,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18'),(71,1,0,5,'Fiifi','Test ','This is a sample review','2024-06-23 08:34:18');
/*!40000 ALTER TABLE `product_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productorders`
--

DROP TABLE IF EXISTS `productorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productorders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prd_title` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `billing_addr` varchar(5) DEFAULT NULL,
  `shipping_addr` varchar(5) DEFAULT NULL,
  `shipping_charge` varchar(45) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` varchar(155) DEFAULT NULL,
  `order_complete_date` datetime DEFAULT NULL,
  `return_reason` text,
  `return_date` datetime DEFAULT NULL,
  `refund_status` varchar(255) DEFAULT NULL,
  `refund_date` datetime DEFAULT NULL,
  `payment_status` int(11) NOT NULL,
  `pay_th` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productorders`
--

LOCK TABLES `productorders` WRITE;
/*!40000 ALTER TABLE `productorders` DISABLE KEYS */;
INSERT INTO `productorders` VALUES (1,'guest','KETEKEPR614854848eb9020-09-2021',4,'watch',1,15,'1',NULL,NULL,'2021-09-20 20:59:40','shipped',NULL,NULL,NULL,NULL,NULL,1,'stripe'),(10,'guest','KETEKEPR6148590c820b020-09-2021',6,'gvghhh',1,25,'1',NULL,NULL,'2021-09-20 21:19:00','processing',NULL,NULL,NULL,NULL,NULL,0,'stripe'),(11,'30','KETEKEPR614c8062df8f023-09-2021',4,'watch',1,15,'1',NULL,NULL,'2021-09-24 00:55:55','returned','2021-10-15 05:13:58','product is in dispute','2021-10-22 05:15:31',NULL,NULL,1,'stripe'),(12,'30','KETEKEPR615179499c12e27-09-2021',9,'vbvghh',1,35,'1',NULL,NULL,'2021-09-27 19:26:57','processing',NULL,'dsawefr','2021-10-22 03:56:48','refunded','2021-10-22 04:59:04',1,'stripe'),(13,'guest','KETEKEPR61517a0e9719a27-09-2021',6,'gvghhh',1,25,'1',NULL,NULL,'2021-09-27 19:30:14','processing',NULL,NULL,NULL,NULL,NULL,0,'stripe'),(14,'guest','KETEKEPR615e4bb61ec6106-10-2021',6,'gvghhh',2,25,'1',NULL,NULL,'2021-09-10 12:51:58','processing',NULL,NULL,NULL,NULL,NULL,1,'stripe'),(15,'guest','KETEKEPR614854848eb9020-09-2021',3,'head phone',1,10,'1',NULL,NULL,'2021-10-13 20:59:40','shipped',NULL,NULL,NULL,NULL,NULL,1,'stripe'),(16,'guest','KETEKEPR62c64000c2a2406-07-2022',22,'my full name',4,60,'1',NULL,NULL,'2022-07-07 13:38:00',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(17,'guest','KETEKEPR633528500522128-09-2022',4,'watch',1,15,'1',NULL,NULL,'2022-09-29 16:38:32',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(18,'guest','KETEKEPR6335331225d9128-09-2022',4,'watch',1,15,'1',NULL,NULL,'2022-09-29 17:24:26',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(19,'guest','KETEKEPR6335336bcb39128-09-2022',4,'watch',1,15,'1',NULL,NULL,'2022-09-29 17:25:55',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(20,'guest','KETEKEPR63355768ddf8029-09-2022',4,'watch',1,15,'1',NULL,NULL,'2022-09-29 19:59:28',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(21,'guest','KETEKEPR6335586c7166b29-09-2022',4,'watch',1,15,'1',NULL,NULL,'2022-09-29 20:03:48',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(22,'39','KETEKEPR64e0db9b7210c19-08-2023',25,'Ghana T shirt',1,20,'1',NULL,NULL,'2023-08-20 02:41:23',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(23,'67','KETEKEPR65d5ef984feb621-02-2024',9,'BOAT EAR PHONE',1,35,'1',NULL,NULL,'2024-02-22 01:12:00',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(24,'67','KETEKEPR65d5ef984feb621-02-2024',12,'Wireless',1,10,'1',NULL,NULL,'2024-02-22 01:12:00',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(25,'67','KETEKEPR65d5ef984feb621-02-2024',5,'Cillum dolore ipsum plant',1,10,'1',NULL,NULL,'2024-02-22 01:12:00',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(26,'67','KETEKEPR65d5efdf463dd21-02-2024',5,'Cillum dolore ipsum plant',1,10,'1',NULL,NULL,'2024-02-22 01:13:11',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(27,'69','KETEKEPR65d7544e3ea8722-02-2024',12,'Wireless',1,10,'1',NULL,NULL,'2024-02-23 02:33:58',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(28,'67','KETEKEPR65d7549f23ca722-02-2024',12,'Wireless',1,10,'1',NULL,NULL,'2024-02-23 02:35:19',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(29,'guest','KETEKEPR65e57722c72ee04-03-2024',4,'watch',1,15,'1',NULL,NULL,'2024-03-04 19:54:18',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe'),(30,'67','KETEKEPR65e581fc4443004-03-2024',4,'watch',1,15,'1',NULL,NULL,'2024-03-04 20:40:36',NULL,NULL,NULL,NULL,NULL,NULL,0,'stripe');
/*!40000 ALTER TABLE `productorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `productId` bigint(20) NOT NULL AUTO_INCREMENT,
  `prcode` text NOT NULL,
  `category` text,
  `prsubmenuId` text NOT NULL COMMENT 'PK of marketplace_submenu',
  `productName` text,
  `description` longtext,
  `keywords` text,
  `offprice` text,
  `maxPrice` double DEFAULT NULL,
  `disc_percent` text,
  `brand_name` text,
  `shipping_charge` text,
  `stockAvailability` text COMMENT 'Available(1), Not available (0)',
  `status` text COMMENT 'Active(1), Deactive(0)',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` text,
  `slug` text NOT NULL,
  `prefer_list` text NOT NULL,
  `product_type` text,
  `sku` text,
  `inventory` text,
  `collections` text,
  `tags` text,
  `shipping_info` text,
  `return_day` text NOT NULL,
  `seo_title` text,
  `seo_descr` text,
  `variants` text,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'head_phone','2','0','Head Phone','',NULL,'64',80,'20','4','',NULL,'1','2021-05-19 11:26:53','2024-06-11 14:08:12','0','head-phone','0','','','','','','','10','','',NULL),(2,'watch','5','0','Watch','',NULL,'44.5',50,'11','1','15',NULL,'1','2021-10-23 00:17:34','2024-06-11 14:08:51','0','watch','1','fgcg455665','','','','','','5','','',''),(3,'cillum_dolore_ipsum_plant','3','0','Cillum dolore plant','',NULL,'68.6',70,'2','3','5',NULL,'1','2021-05-19 11:38:22','2024-06-11 14:10:02','0','cillum-dolore-plant','1','','','','','fgfcy,ear','','7','','',NULL),(4,'hand_bag','4','0','Hand Bag','',NULL,'72',80,'10','2','20',NULL,'1','2021-05-19 12:01:48','2024-06-11 14:10:29','0','hand-bag','1','','','','','','','10','','',NULL),(28,'head_phone','2','0','Head Phone','',NULL,'64',80,'20','4','',NULL,'1','2021-05-19 11:26:53','2024-06-11 14:08:12','0','head-phone','0','','','','','','','10','','',NULL),(29,'watch','5','0','Watch','',NULL,'44.5',50,'11','1','15',NULL,'1','2021-10-23 00:17:34','2024-06-11 14:08:51','0','watch','1','fgcg455665','','','','','','5','','',''),(30,'cillum_dolore_ipsum_plant','3','0','Cillum dolore plant','',NULL,'68.6',70,'2','3','5',NULL,'1','2021-05-19 11:38:22','2024-06-11 14:10:02','0','cillum-dolore-plant','1','','','','','fgfcy,ear','','7','','',NULL),(31,'hand_bag','4','0','Hand Bag','',NULL,'72',80,'10','2','20',NULL,'1','2021-05-19 12:01:48','2024-06-11 14:10:29','0','hand-bag','1','','','','','','','10','','',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_history`
--

DROP TABLE IF EXISTS `search_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `search_history` (
  `search_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `business_id` int(10) DEFAULT NULL,
  `search_date` datetime DEFAULT NULL,
  `search_input_name` varchar(255) NOT NULL,
  `business_page` text NOT NULL,
  PRIMARY KEY (`search_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_history`
--

LOCK TABLES `search_history` WRITE;
/*!40000 ALTER TABLE `search_history` DISABLE KEYS */;
INSERT INTO `search_history` VALUES (1,131,6,'2024-06-23 08:46:50','','');
/*!40000 ALTER TABLE `search_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seosetting`
--

DROP TABLE IF EXISTS `seosetting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seosetting` (
  `option_id` bigint(20) NOT NULL,
  `option_name` varchar(200) NOT NULL,
  `option_value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seosetting`
--

LOCK TABLES `seosetting` WRITE;
/*!40000 ALTER TABLE `seosetting` DISABLE KEYS */;
INSERT INTO `seosetting` VALUES (1,'hiwh','Global Galaxxy Tracker |  How it Works'),(2,'hiwd',''),(3,'spth','Global Galaxxy Tracker |  Support'),(4,'spthd',''),(5,'fqh','Global Galaxxy Tracker |  Faqs'),(6,'fqhd',''),(7,'blh','Global Galaxxy Tracker |  Listing'),(8,'blhd',''),(9,'sph','Global Galaxxy Tracker |  Search'),(10,'spd',''),(11,'ccph','Global Galaxxy Tracker |  Country'),(12,'ccpd',''),(13,'b1',NULL),(14,'bd1',NULL),(15,'b2',NULL),(16,'bd2',NULL),(17,'b3',NULL),(18,'bd3',NULL),(1,'hiwh','Global Galaxxy Tracker |  How it Works'),(2,'hiwd',''),(3,'spth','Global Galaxxy Tracker |  Support'),(4,'spthd',''),(5,'fqh','Global Galaxxy Tracker |  Faqs'),(6,'fqhd',''),(7,'blh','Global Galaxxy Tracker |  Listing'),(8,'blhd',''),(9,'sph','Global Galaxxy Tracker |  Search'),(10,'spd',''),(11,'ccph','Global Galaxxy Tracker |  Country'),(12,'ccpd',''),(13,'b1',NULL),(14,'bd1',NULL),(15,'b2',NULL),(16,'bd2',NULL),(17,'b3',NULL),(18,'bd3',NULL);
/*!40000 ALTER TABLE `seosetting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_accounts`
--

DROP TABLE IF EXISTS `user_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_accounts` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_fname` text NOT NULL,
  `user_lname` text NOT NULL,
  `user_emailid` varchar(50) NOT NULL,
  `user_pasword` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `u_type` int(11) NOT NULL COMMENT '1="business owner",2="service provider",3="seller",4="user"',
  `messageType` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_accounts`
--

LOCK TABLES `user_accounts` WRITE;
/*!40000 ALTER TABLE `user_accounts` DISABLE KEYS */;
INSERT INTO `user_accounts` VALUES (11,'impact','global','igi@goigi.in','MTIzNDU2',1,'6638cb83b2109.JPG',NULL,2,'hello msg',0),(12,'markin','keli','markin@goigi.in','MTIzNDU2',1,'',NULL,1,'',0),(14,'matin','doe','matin@goigi.in','MTIzNDU2',1,'banner-bg1.jpg',NULL,2,'Text',0),(15,'Fiifi','markin','donvintino@gmail.com','MTIzNA==',1,'','2021-01-24 07:35:06',1,'',0),(16,'Nat','Markin','uhuru98@yahoo.com','MTIzNA==',1,'','2021-01-24 07:36:25',2,'',0),(17,'Fiifi','no name','donvintino@yahoo.com','MTIzNDU2',1,'IMG_20190709_164634.jpg','2021-01-24 07:36:45',1,'',0),(18,'peter','das','peter@goigi.in','MTIzNDU2',1,'','2021-01-26 11:48:24',3,'',0),(19,'Amber Atkinson','April Branch','rylatoqe@mailinator.com','UGEkJHcwcmQh',1,'','2021-02-10 06:13:27',2,'',0),(20,'Fiifi1','Ma1','fmarkin@gmail.com','MTIzNA==',1,'IMG_6282.JPG','2021-03-27 01:19:14',2,'Text',0),(21,'Kyekyeku','Opoku-Pong','opokupongkyekyeku@yahoo.com','ZG9taU5pb24zMzM=',1,'','2021-03-27 01:19:15',1,'',0),(22,'Kyeky','Opoku','opokupongkyekyeku@yahoo','MTIz',1,'','2021-03-27 01:20:11',4,'',0),(23,'User','User','user@yahoo.com','dXNlcjE=',1,'','2021-04-16 01:30:33',4,'Email',0),(24,'Nat','Markin','serviceprovider@yahoo.com','dXNlcjE=',1,'','2021-04-16 01:54:47',2,'',0),(25,'kunu','das','igi8@goigi.in','MTIzNDU2',1,'6_b.jpg','2021-07-31 09:19:29',4,'',0),(26,'Prithwiraj','Bhattacharjee','care@goigi.com','MTIzNDU2',1,'','2021-07-31 12:14:00',3,'',0),(28,'kunudas@gmail.com','das','kunu@gmail.com','MTIzNDU2',1,'','2021-09-07 01:35:44',4,'',0),(29,'Kaye Erickson','Kasimir Dean','xiqo@mailinator.com','UGEkJHcwcmQh',1,'','2021-09-08 10:21:07',4,'',0),(30,'krish','sen','igi127@goigi.in','MTIzNDU2',1,'','2024-02-23 05:56:50',4,'',18),(32,'seema','das','seema@gmail.com','MTIzNDU2',1,'','2021-10-22 05:34:18',4,'',0),(33,'seema','das','igi67@goigi.in','MTIzNDU2',1,'','2021-10-22 05:36:54',4,'',0),(34,'sdfs','sdfsdf','fiifi@keteke.net','MTIzNDU2Nzg5',1,'','2022-02-26 06:31:29',3,'',0),(35,'Kojo','Poku','opokupon@yahoo.com','MTIzNDU2',1,'','2022-03-13 04:41:31',3,'',0),(36,'Seller','Seller','info@keteke.net','bWFLb2xhMTIz',1,'','2022-03-16 06:27:11',3,'',0),(37,'Kojo','Kojo','kojo@keteke','MTIzNA==',1,'','2022-03-16 06:30:17',4,'',36),(38,'kofi','kofi','kofi@keteke','MTIzNA==',1,'','2022-03-16 06:32:07',4,'',36),(39,'keteke','seller','seller@keteke.net','bWFLb2xhMTIz',1,'','2022-05-20 04:39:53',3,'',0),(40,'grace','markin','grace@grace','MTIzNDU=',1,'','2022-10-06 05:27:06',4,'',39),(41,'Hello World! https://apel.top/go/gu4winrshe5dgoju?hs=a305d0896260e78a5b0052e41e2b3669&','5853fp','uxoky@mailto.plus','bU5jSTZRcWw0V0k=',1,'','2023-03-11 02:04:55',4,'',0),(42,'Hello World! https://prize-sense.life/?u=2vtpd0d&o=ywzbvvy&m=1?hs=a305d0896260e78a5b0052e41e2b3669&','6i1bb5','ayfkuh@tofeat.com','MFFXLHtOYmZrMQ==',1,'','2023-04-06 07:23:07',4,'',0),(43,'???? Hello World! https://national-team.top/go/hezwgobsmq5dinbw?hs=a305d0896260e78a5b0052e41e2b3669 ????','effm9u','guuema@mailto.plus','Y3tyX0shV3Aq',1,'','2023-07-21 01:24:48',4,'',0),(44,'Alchemy','Coffee','alchemycoffee@keteke.net','YWxjaGVteWNvZmZlZQ==',1,'','2023-10-01 08:39:35',1,'',0),(45,'MHIRpjsjKqWJRAr','MHIRpjsjKqWJRAr','bBCFtK.tmjhbp@silesia.life','bDRGU0hoTE42Iw==',1,'','2023-11-15 12:18:13',1,'',0),(46,'whyjDvwTjd','whyjDvwTjd','ekjiEI.hdcwqbj@zetetic.sbs','Vk1KSlFjcks0QA==',1,'','2023-11-25 04:28:01',1,'',0),(47,'Dash','Dash','IKJaJv.qbmwmwd@wheelry.boats','OW9QeWxXWkozIw==',1,'','2023-12-06 05:02:53',1,'',0),(48,'Robin','Robin','QOKyIu.hhqmptw@anaphora.team','U1VQWWlOUE42QA==',1,'','2023-12-20 09:25:15',1,'',0),(49,'Gracie','Gracie','PvdcDj.cwpwwcd@virilia.life','SE92SkwzNUw1Iw==',1,'','2023-12-29 08:35:52',1,'',0),(50,'Felix','Felix','wphilldixon@gmail.com','M0RVaDRub0o2IQ==',1,'','2023-12-29 08:37:31',1,'',0),(51,'Linda','Linda','stcollins44@gmail.com','ZWpPcXhac0I2IQ==',1,'','2023-12-29 08:29:51',1,'',0),(52,'Aarav','Aarav','rbertone@dtpd.org','dDU0OFV3QkY1IQ==',1,'','2023-12-30 02:18:46',1,'',0),(53,'Liberty','Liberty','wBJOeo.qqpwjccj@spinapp.bar','TTR6MmZvT0gzIQ==',1,'','2024-01-09 10:01:14',1,'',0),(54,'Lola','Lola','jQckCP.pphcdmj@flexduck.click','UlBOcWpCekg2QA==',1,'','2024-01-13 03:07:47',1,'',0),(55,'Jovie','Jovie','HiiTiV.mtqdbbq@carnana.art','bHZiOEVtcEI2QA==',1,'','2024-01-13 10:59:52',1,'',0),(56,'Casey','Casey','rYEhPd.qqjbccbq@paravane.biz','Um9TVGlid0w1QA==',1,'','2024-01-17 03:35:36',1,'',0),(57,'Mercy','Mercy','UvKLiD.qqhcphtj@paravane.biz','U0JVa21vMU04Iw==',1,'','2024-01-18 06:05:59',1,'',0),(58,'Roberto','Roberto','ljBMMc.cjhdqpq@bakling.click','QnZPZGg3RkkzQA==',1,'','2024-02-04 12:34:09',1,'',0),(59,'Capri','Capri','mariz_fady2009@yahoo.com','Sm5YdVpmZlQzIQ==',1,'','2024-02-04 06:45:52',1,'',0),(60,'Jeffrey','Jeffrey','baronnightwolf@msn.com','VDlGZmN5WFg2Iw==',1,'','2024-02-04 10:13:07',1,'',0),(61,'Elina','Elina','flanagans_99@yahoo.com','MndLZUhLTk0zQA==',1,'','2024-02-04 11:07:22',1,'',0),(62,'Poppy','Poppy','acjmpemar@gmail.com','UEozTTZmeUY1QA==',1,'','2024-02-04 12:37:07',1,'',0),(63,'Aubriella','Aubriella','turtlemermaid@gmail.com','dUxweDdEQk05Iw==',1,'','2024-02-04 04:28:42',1,'',0),(64,'Neriah','Neriah','saWrrT.pcjmcqd@spectrail.world','VzVSYWVVcE44Iw==',1,'','2024-02-06 04:32:08',1,'',0),(65,'hickson','hickson','qpdpbcpw.t@monochord.xyz','MzFMSTJLakw1QA==',1,'','2024-02-11 05:22:34',1,'',0),(67,'test','user','testuser@gmail.com','MTIzNDU2',1,'','2024-02-13 02:44:23',4,'',0),(68,'business','user','businessuser@gmail.com','MTIzNDU2',1,'','2024-02-13 02:45:05',1,'',0),(69,'service','user','serviceuser@gmail.com','MTIzNDU2',1,'','2024-02-13 02:45:38',2,'',0),(70,'seller','user','selleruser@gmail.com','MTIzNDU2',1,'','2024-02-13 02:46:07',3,'',0),(72,'Lala','Kele','lkelemen@kolumbus.fi','TWFydGlua2swMA==',1,'66727776f26dc.jpg','2024-02-20 01:16:15',3,'',0),(73,'Kweku','Markin','kweku.markin@gmail.com','MTIzNGJ1enp5',1,'','2024-02-21 02:09:47',2,'Email',0),(74,'Victor','Gyasi','vigyow@gmail.com','MTIzNHZpZ3lvbw==',1,'','2024-02-21 03:35:59',2,'Text',0),(75,'buFqULmnQfD','NyaOcTBxWAFG','sheilalp_millerom@outlook.com','UnZNMzVFb0cyMUpqIQ==',1,'','2024-02-23 12:40:25',4,'',0),(76,'first1','costumer1','lll@qqq','Y29zdDE=',1,'','2024-02-23 01:30:49',4,'',72),(77,'Kason','Kason','DyUWjv.qtdbpbj@rushlight.cfd','ZFBSZHBseUI1IQ==',1,'','2024-03-02 03:08:49',1,'',0),(78,'Nala','Nala','admin@binaryinvesttrades.com','V243bFNYd0ozIw==',1,'','2024-03-03 03:28:00',1,'',0),(79,'Paula','Paula','edward@edtime.nl','SUFPam1ZWE0xIw==',1,'','2024-03-03 10:57:41',1,'',0),(80,'Adan','Adan','ejhilbert@tecbuilds.com','MVNmeWZzWkk2QA==',1,'','2024-03-03 12:30:04',1,'',0),(81,'Lillian','Lillian','sevans@advantagesecurityinc.com','aFdVdlFYbUQ4IQ==',1,'','2024-03-03 02:32:21',1,'',0),(82,'Hayes','Hayes','j.farrell@scaec.com','bnhJSmE5ZUk0IQ==',1,'','2024-03-03 03:03:58',1,'',0),(83,'Freyja','Freyja','claudette18@hotmail.com','b3phZHZVRVYxIw==',1,'','2024-03-03 03:07:32',1,'',0),(84,'Nala','Nala','peggymh@cox.net','SHY2aTlFNFAyQA==',1,'','2024-03-03 04:18:56',1,'',0),(85,'Owen','Owen','clmckenney@gmail.com','SXVkUUJNc1UyQA==',1,'','2024-03-03 04:45:29',1,'',0),(86,'Danny','Danny','zdiamond@diamondtechnicalservices.com','T3RqSkVaTUI5QA==',1,'','2024-03-03 07:02:42',1,'',0),(87,'Casen','Casen','kanisha_md@yahoo.com','RkNkckN1ZlE5IQ==',1,'','2024-03-03 07:03:18',1,'',0),(88,'Rodrigo','Rodrigo','anne_niemiec@yahoo.com','QmM4SWFxVlg3IQ==',1,'','2024-03-03 09:01:28',1,'',0),(89,'Amina','Amina','ryans698@yahoo.com','bTZqWU41SUQxIw==',1,'','2024-03-04 07:11:29',1,'',0),(90,'Kathryn','Kathryn','doug456@outlook.com','b0htcXp2alU3Iw==',1,'','2024-03-04 08:27:03',1,'',0),(91,'Jaxton','Jaxton','andrew.jae.yi@gmail.com','SmxxQ2VaU0g0Iw==',1,'','2024-03-04 08:52:32',1,'',0),(92,'Omar','Omar','lincolncityclerk@nckcn.com','ZWpmUTRRWk05Iw==',1,'','2024-03-04 09:53:22',1,'',0),(93,'Paloma','Paloma','vikoterronf@gmail.com','MXFmbTZlWVc3Iw==',1,'','2024-03-04 12:25:27',1,'',0),(94,'Maxwell','Maxwell','andrewssrl@gmail.com','WnNUb1N1dk40Iw==',1,'','2024-03-04 12:50:20',1,'',0),(95,'Matteo','Matteo','msking.literacy@gmail.com','VFltSEx4Tko4Iw==',1,'','2024-03-04 02:57:11',1,'',0),(96,'Loretta','Loretta','cmtabuso12@gmail.com','UjE5RndCRlg2QA==',1,'','2024-03-04 03:15:35',1,'',0),(97,'Averie','Averie','alexav@rea-alp.com','MXNLSFdmdU4yQA==',1,'','2024-03-04 05:14:44',1,'',0),(98,'Brock','Brock','abassani@inthyme.com','b2E2QVh5TkE4IQ==',1,'','2024-03-04 05:53:37',1,'',0),(99,'Dorothy','Dorothy','exulboutique@gmail.com','elNYakhJcko5QA==',1,'','2024-03-04 06:14:44',1,'',0),(100,'Ezequiel','Ezequiel','martharuiz1@yahoo.com','ekVsSmhNNU41Iw==',1,'','2024-03-04 07:21:56',1,'',0),(101,'Maximilian','Maximilian','info@gogloballimo.com','SWpzbkNXNU05Iw==',1,'','2024-03-04 08:30:30',1,'',0),(102,'Bowen','Bowen','greenbergjodi@yahoo.com','RWFaOXNhcFQ0QA==',1,'','2024-03-04 11:28:27',1,'',0),(103,'Ariella','Ariella','cyonlick@gmail.com','OUx2ZnpyUVQ3Iw==',1,'','2024-03-05 12:43:09',1,'',0),(104,'Jemma','Jemma','rcox@udhgroup.com','NUE1TGRoY0YxIw==',1,'','2024-03-05 05:22:44',1,'',0),(105,'Elina','Elina','floydding@gmail.com','RE10YVVsNkMzIw==',1,'','2024-03-05 09:18:59',1,'',0),(106,'Amelia','Amelia','elpris@seychelles.net','dDZhUHBYVFcyQA==',1,'','2024-03-05 09:42:28',1,'',0),(107,'Kase','Kase','lsc088@gmail.com','WDJVdWtXbVc3Iw==',1,'','2024-03-05 10:10:15',1,'',0),(108,'Dream','Dream','kjason5757@gmail.com','clk2QUhpbU8xQA==',1,'','2024-03-05 11:07:09',1,'',0),(109,'Adalee','Adalee','schizszlerovaeva@azet.sk','YmpVUnJDY0M2IQ==',1,'','2024-03-05 11:45:18',1,'',0),(110,'Journee','Journee','jeffrey_he0114@hotmail.com','YVl2cmRNWVc5Iw==',1,'','2024-03-05 12:05:34',1,'',0),(111,'Cassius','Cassius','lueling@gmx.net','SHQzTEoxN0k2QA==',1,'','2024-03-05 02:12:31',1,'',0),(112,'Harley','Harley','ldwildgoose@gmail.com','dVhrY1dxSUU4Iw==',1,'','2024-03-05 02:32:03',1,'',0),(113,'Belle','Belle','clarkj@pattersonharbor.com','VVEyU3ZKelYxIQ==',1,'','2024-03-05 03:32:35',1,'',0),(114,'Serena','Serena','restaurantfurn@bellsouth.net','bG9yVnVNWUk0Iw==',1,'','2024-03-05 05:56:16',1,'',0),(115,'Noemi','Noemi','ddexter@adisotx.com','em80SVBMNEo0IQ==',1,'','2024-03-05 06:22:01',1,'',0),(116,'Lochlan','Lochlan','jclark@pattersonharbor.com','NVQ5VmwxNk01QA==',1,'','2024-03-05 11:14:07',1,'',0),(117,'Malachi','Malachi','alohaabigail@gmail.com','ZkwxQnpUTE8yIQ==',1,'','2024-03-06 06:57:54',1,'',0),(118,'Leila','Leila','jcyoung2416@yahoo.com','SENVUFp6eVQ5Iw==',1,'','2024-03-06 07:43:15',1,'',0),(119,'Hattie','Hattie','douglas.deyoung@cmsenergy.com','U2luZmNZQVE3QA==',1,'','2024-03-06 08:23:05',1,'',0),(120,'Caleb','Caleb','clark@recsportsonline.com','MmFlaWZsYUI4Iw==',1,'','2024-03-06 08:48:48',1,'',0),(121,'Madalyn','Madalyn','deanna_rollins@yahoo.com','SEoxazcxQVg1IQ==',1,'','2024-03-06 09:28:45',1,'',0),(122,'OxPIRkpBQh','CtjGQIFiEqHxTy','belinda_hernandezmhux@outlook.com','b3YzUlkxQjBjRlhNIQ==',1,'','2024-03-08 11:01:35',4,'',0),(123,'XcqeWhUrGuC','mlCFZUbSJjpe','douglas_emmons82os@outlook.com','Vk14SDBQRllwMEd1IQ==',1,'','2024-03-13 11:57:29',4,'',0),(124,'HkZDcmeIA','GYkOMuarojPD','jerry_hildrethqf7f@outlook.com','MDJ6cEJlRWdjVGtpIQ==',1,'','2024-03-18 04:51:59',4,'',0),(125,'qterIYaHBXkuyNxU','icGDOSTbtsm','anthony13remillard9pc@outlook.com','Y1RJSFAwazNkaFp6IQ==',1,'','2024-03-21 11:59:21',4,'',0),(126,'James','Markin','jamesmarken@yahoo.com','MTIzNE1BUktJTg==',1,'','2024-03-23 11:30:52',2,'Email',0),(127,'bwxpUBGqQHfkFIP','SwmjZNqfxszrEbM','mario_hasspemv@outlook.com','RlhyU0k1QkptQzJmIQ==',1,'','2024-04-05 07:32:32',4,'',0),(128,'Nelson','Nelson','udRafh.qwmbwmb@borasca.xyz','SUNEeWpoQ0g4QA==',1,'','2024-04-05 11:24:48',1,'',0),(129,'David','Essien','david@yahoo.com','MTIzNGRhdmlk',1,'','2024-04-06 01:13:23',2,'Email',0),(130,'Kyekyeku','Opoku-Pong','user@keteke.net','dXNlcg==',1,'','2024-04-13 08:19:55',4,'',0),(131,'Guest','User','guestuser@keteke.net','Z3VzZXI=',1,'','2024-04-13 09:01:26',4,'',0),(132,'tkfalYIzSGeZ','BzSmAHOolkgu','fbradleya391@gmail.com','OU1zY1JrVHlIajVwIQ==',1,'','2024-04-14 06:59:37',4,'',0),(133,'* * * Apple iPhone 15 Free: https://betweenpercentages.pt/recrutamento/upload/go.php * * * hs=a305d0896260e78a5b0052e41e2b3669*','i8ltwx','okebepu@merepost.com','R2Q2SXdkdEow',1,'','2024-04-19 04:42:44',4,'',0),(134,'VuFhDmZQin','CjVQPMgsNrDqaXz','matkovalenko4192@aol.com','OFh6bEJkaWZqbnBlIQ==',1,'','2024-04-20 05:07:13',4,'',0),(135,'hNFAdJjcPpW','hDGakXdtWCfr','glindseyee257@gmail.com','Y28zQU9Ealc2S0NZIQ==',1,'','2024-04-23 08:10:35',4,'',0),(136,'HZYvuIJdzTLsmtAk','qljcCHyhWNZkz','maryettalan89@outlook.com','WEQ1dU5JODBoM25iIQ==',1,'','2024-04-27 10:13:57',4,'',0),(137,'Iglobal','Impact','igi203@goigi.in','Nzg2NjM4',1,'','2024-04-29 05:23:53',2,'',0),(138,'Test','test','test@gmail.com','MTIzNDU2',1,'','2024-04-29 23:36:29',2,'',0),(139,'PravatUser','12345678','PravatUser@yopmail.com','MTIzNDU2Nzg=',1,'','2024-05-01 01:40:33',4,'',0),(140,'TestUser','12345678','Test@yopmail.com','MTIzNDU2Nzg=',1,'','2024-05-03 00:02:28',3,'',0),(141,'FWXbxgVfsPjlez','IqZDVJuFwjaGM','bob_collins6442@aol.com','TDkxb3pCMHhpdjZHIQ==',1,'','2024-05-03 06:37:14',4,'',0),(142,'Pravat','Kumar','Pravat@yopmail.com','OTY4NTA5',1,'6641c11796d68.jpg','2024-05-05 23:45:24',4,'email',0),(143,'GXeIiaYTgHurk','eOjBflrK','jenniferwestbrook1979@yahoo.com','aTRXZXgyWEk3ejl1IQ==',1,'','2024-05-06 09:24:00',4,'',0),(144,'oHhsCDOcm','uBjMhZOyIP','chris.clanton1982@yahoo.com','NmxrdG1jTjJpS1Y0IQ==',1,'','2024-05-10 04:26:11',4,'',0),(145,'Sayantan','Bhakta','sayantan2@goigi.in','MTExMTEx',1,'',NULL,2,'Email',0),(146,'Pravat','Behera','pravat123@yopmail.com','ODg2MzI2',1,'66445acc3699e.jpg','2024-05-13 23:48:57',4,'',0),(147,'Laja','leja','lkelemen@kolumbus.fi','TWFydGlua2swMA==',1,'6672e34e9199d.jpg','2024-05-14 04:43:35',4,'text',0),(148,'Gopa','Barik','gopa@yopmail.com','NjIxNDc0',1,'664dde0eb4ad3.jpg','2024-05-15 05:18:26',4,'',0),(149,'Pravat','Behera','Pravat45@yopmail.com','MTIzNDU2',1,'','2024-05-17 05:56:50',4,'',0),(150,'DMpKbiOXom','xbwenEBk','possinscott5915@yahoo.com','R3dQNlhUUWdPTGhwIQ==',1,'','2024-05-20 11:10:05',4,'',0),(151,'dDZjCzpfPclhGwM','JabsHhVEr','bensondd1990@gmail.com','Z3NZSVI1MTNrWkNLIQ==',1,'','2024-05-24 06:05:18',4,'',0),(152,'KIGCeghLdaUknE','PkKEsVReBhSnNFUm','shirley_hesscfwg@outlook.com','REJLUmxRRVBBdkkwIQ==',1,'','2024-05-27 10:06:36',4,'',0),(153,'bFyzKCcRWTjkU','emgxGojtpZK','mary_labountyjzop@outlook.com','MzU2NDlNcDE3T1EyIQ==',1,'','2024-06-01 02:22:11',4,'',0),(154,'YlcvOBaI','mPbEcJvfNkspn','connerkorinnap583@gmail.com','QmdZS2k5MmFWTkdoIQ==',1,'','2024-06-05 12:22:47',4,'',0),(155,'xTCWGeLkZmyp','PJkhNfIpCW','valorie13muzzarelliaq7@outlook.com','TGV6a2REaGptWm9OIQ==',1,'','2024-06-08 06:17:08',4,'',0),(156,'edjxhGwQpI','KCZchNiMApIdsuX','valcsirumsey5@hotmail.com','NncwdWxRb1lGcWt0IQ==',1,'','2024-06-11 10:07:32',4,'',0),(157,'Sayantan','Bhakta','sayantan1@goigi.in','MTExMTEx',1,'',NULL,1,'Email',0),(158,'Sayantan','Bhakta','sayantan3@goigi.in','MTExMTEx',1,'',NULL,3,'Email',0),(159,'Sayantan','Bhakta','sayantan4@goigi.in','MTExMTEx',1,'',NULL,4,'Email',0),(160,'pravat','Behera','pravat3001@yopmail.com','MTIzNDU2Nzg5',1,'','2024-06-14 03:35:11',4,'',0),(161,'shoJydpNHAKfQjvD','fvJsGmgLnXhT','deankinastdm33@gmail.com','cTNYTnJudEhXMjRqIQ==',1,'','2024-06-15 06:14:29',4,'',0),(162,'pravat','Behera','pravat987@yopmail.com','MTIzNDU2',1,'667ffa049e3b8.jpg','2024-06-29 06:10:27',4,'',0);
/*!40000 ALTER TABLE `user_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bfull_name` text COLLATE utf8_unicode_ci,
  `bemail` text COLLATE utf8_unicode_ci,
  `bphno` text COLLATE utf8_unicode_ci,
  `baddress` text COLLATE utf8_unicode_ci,
  `bcountry` text COLLATE utf8_unicode_ci,
  `bcity` text COLLATE utf8_unicode_ci,
  `bstate` text COLLATE utf8_unicode_ci,
  `bzip` text COLLATE utf8_unicode_ci,
  `shiptodifferadd` text COLLATE utf8_unicode_ci,
  `sfull_name` text COLLATE utf8_unicode_ci,
  `semail` text COLLATE utf8_unicode_ci,
  `sphno` text COLLATE utf8_unicode_ci,
  `saddress` text COLLATE utf8_unicode_ci,
  `scountry` text COLLATE utf8_unicode_ci,
  `scity` text COLLATE utf8_unicode_ci,
  `sstate` text COLLATE utf8_unicode_ci,
  `szip` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_address`
--

LOCK TABLES `user_address` WRITE;
/*!40000 ALTER TABLE `user_address` DISABLE KEYS */;
INSERT INTO `user_address` VALUES (1,'1','Sayantan Bhakta','sayantan@goigi.in','7896542512','Webel Tower-1, Saltlake, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091','1','Pravat Behera','pravat@goigi.com','7894585210','Biswa Bangla, New Town, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091'),(2,'1','Sayantan Bhakta','sayantan@goigi.in','7896542512','Webel Tower-1, Saltlake, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091','0','Sayantan Bhakta','sayantan@goigi.in','7896542512','Webel Tower-1, Saltlake, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091'),(3,NULL,'Sayantan Bhakta','sayantan@goigi.in','7896542512','Webel Tower-1, Saltlake, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091','1','Pravat Behera','pravat@goigi.in','7894585210','Biswa Bangla, New Town, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091'),(4,'guest_1151155223','Sayantan Bhakta','sayantan@goigi.in','7896542512','Webel Tower-1, Saltlake, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091','1','Pravat Behera','pravat@goigi.in','7894585210','Biswa Bangla, New Town, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091'),(5,'145','Sayantan Bhakta','sayantan@goigi.in','7896542512','Webel Tower-1, Saltlake, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091','1','Pravat Behera','pravat@goigi.in','7894585210','Biswa Bangla, New Town, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091'),(6,'145','Sayantan Bhakta','sayantan@goigi.in','7896542512','Webel Tower-1, Saltlake, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091','1','Pravat Behera','pravat@goigi.in','7894585210','Biswa Bangla, New Town, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091'),(7,'1','Sayantan Bhakta','sayantan@goigi.in','7896542512','Webel Tower-1, Saltlake, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091','1','Pravat Behera','pravat@goigi.in','7894585210','Biswa Bangla, New Town, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091'),(8,'1','Sayantan Bhakta','sayantan@goigi.in','7896542512','Webel Tower-1, Saltlake, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091','1','Pravat Behera','pravat@goigi.in','7894585210','Biswa Bangla, New Town, Kolkata, West Bengal, 700091','India','Kolkata','West Bengal','700091'),(9,'160',' ','','','','','','','','1',' ','','','','','','',''),(10,'160',' ','','','','','','','','1',' ','','','','','','','');
/*!40000 ALTER TABLE `user_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_favourites`
--

DROP TABLE IF EXISTS `user_favourites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_favourites` (
  `favourite_id` int(10) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `business_id` varchar(255) NOT NULL,
  `added_date` date NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_favourites`
--

LOCK TABLES `user_favourites` WRITE;
/*!40000 ALTER TABLE `user_favourites` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_favourites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_listreview`
--

DROP TABLE IF EXISTS `user_listreview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_listreview` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `business_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `comments` text NOT NULL,
  `added_date` datetime DEFAULT NULL,
  `response_text` text NOT NULL,
  `response_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_listreview`
--

LOCK TABLES `user_listreview` WRITE;
/*!40000 ALTER TABLE `user_listreview` DISABLE KEYS */;
INSERT INTO `user_listreview` VALUES (1,'','1','kunulaxmi',1,'hello subject','hello kunu','2021-06-30 00:00:00','',NULL),(2,'','1','kunulaxmi',2,'dfdgrtr subject','frtgfyh','2021-06-30 00:00:00','xcvdcf','2021-07-12 17:12:44'),(3,'','1','rt5t6u7y6t7u',3,'yt6uuyi subject','yhgy78y7u','2021-06-30 00:00:00','sdzfcfdrgtt','2021-07-12 17:12:44'),(4,'','1','fcgvfrchy',4,'fvtfujyg sub','fhygi88','2021-06-30 00:00:00','grftfuy','2021-07-12 17:12:44'),(6,'','1','',5,'','','2022-06-14 06:46:14','',NULL),(7,'70','1','Arunaksha Sautya',3,'Test for design review','Test comments for design review. For mobile app.','2024-02-16 05:09:44','',NULL);
/*!40000 ALTER TABLE `user_listreview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whychooseus`
--

DROP TABLE IF EXISTS `whychooseus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `whychooseus` (
  `option_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(200) NOT NULL,
  `option_value` longtext,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whychooseus`
--

LOCK TABLES `whychooseus` WRITE;
/*!40000 ALTER TABLE `whychooseus` DISABLE KEYS */;
INSERT INTO `whychooseus` VALUES (24,'hth1','Why Choose Us'),(25,'hd1','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at tortor lacus.'),(26,'hth2','Lorem ipsum'),(27,'hd2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at tortor lacus.'),(28,'hth3','Lorem ipsum'),(29,'hd3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at tortor lacus.'),(30,'hth4','Lorem ipsum'),(31,'hd4','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at tortor lacus.'),(32,'hth5',NULL),(33,'hd5',NULL);
/*!40000 ALTER TABLE `whychooseus` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-01 11:02:37
