-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: ahsan_price
-- ------------------------------------------------------
-- Server version	8.0.44-0ubuntu0.24.04.2

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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sub_category_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brands_sub_category_id_foreign` (`sub_category_id`),
  KEY `brands_category_id_foreign` (`category_id`),
  CONSTRAINT `brands_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `brands_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,1,1,'iPhone 13',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(2,1,1,'iPhone 14',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(3,1,1,'iPhone 15',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(4,1,1,'iPad',NULL,NULL,1,0,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(5,2,1,'Galaxy S22',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(6,2,1,'Galaxy S23',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(7,2,1,'Galaxy A系列',NULL,NULL,1,0,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(8,3,1,'Redmi Note 12',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(9,3,1,'Poco X5',NULL,NULL,1,0,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(10,5,2,'LG',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(11,5,2,'Samsung',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(12,5,2,'Toshiba',NULL,NULL,1,0,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(13,7,2,'Sony',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(14,7,2,'LG',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(15,7,2,'TCL',NULL,NULL,1,0,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(16,12,5,'Toyota',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(17,12,5,'Hyundai',NULL,NULL,1,1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(18,12,5,'Kia',NULL,NULL,1,0,1,'2025-12-30 14:30:44','2025-12-30 14:30:44');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'جوالات وتابلت','mobiles','fa-mobile-screen',1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(2,'أجهزة كهربائية','electronics','fa-tv',1,2,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(3,'أثاث ومفروشات','furniture','fa-couch',1,3,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(4,'عقارات','real-estate','fa-house',1,4,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(5,'سيارات ودراجات','vehicles','fa-car',1,5,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(6,'كهرباء شمسية','solar-energy','fa-solar-panel',1,6,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(7,'خيام ومخيمات','tents','fa-campground',1,7,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(8,'ملابس وأحذية','clothing','fa-shirt',1,8,'2025-12-30 14:30:44','2025-12-30 14:30:44');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cities_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'غزة','gaza',1,1,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(2,'خانيونس','khan-younis',1,2,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(3,'رفح','rafah',1,3,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(4,'دير البلح','deir-al-balah',1,4,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(5,'النصيرات','al-nuseirat',1,5,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(6,'المغازي','al-maghazi',1,6,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(7,'جباليا','jabalia',1,7,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(8,'بيت لاهيا','beit-lahia',1,8,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(9,'بيت حانون','beit-hanoun',1,9,'2025-12-30 14:30:44','2025-12-30 14:30:44');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (31,'0001_01_01_000000_create_users_table',1),(32,'0001_01_01_000001_create_cache_table',1),(33,'0001_01_01_000002_create_jobs_table',1),(34,'2024_01_01_000000_create_cities_table',1),(35,'2024_01_01_000001_create_categories_table',1),(36,'2024_01_01_000002_create_sub_categories_table',1),(37,'2024_01_01_000003_create_brands_table',1),(38,'2024_01_01_000004_create_shops_table',1),(39,'2024_01_01_000005_create_products_table',1),(40,'2024_01_01_000006_create_product_entries_table',1),(41,'2024_01_01_add_fields_to_categories_table',1),(42,'2024_01_01_add_fields_to_users_table',1),(43,'2025_12_28_160957_create_settings_table',1),(44,'2025_12_29_090541_add_details_to_product_entries_table',1),(45,'2025_12_29_091138_add_manual_shop_name_to_entries',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_entries`
--

DROP TABLE IF EXISTS `product_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_entries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `shop_id` bigint unsigned DEFAULT NULL,
  `manual_shop_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` bigint unsigned NOT NULL,
  `condition` enum('new','used') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `featured_until` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_entries_product_id_foreign` (`product_id`),
  KEY `product_entries_user_id_foreign` (`user_id`),
  KEY `product_entries_shop_id_foreign` (`shop_id`),
  KEY `product_entries_city_id_foreign` (`city_id`),
  CONSTRAINT `product_entries_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `product_entries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_entries_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_entries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_entries`
--

LOCK TABLES `product_entries` WRITE;
/*!40000 ALTER TABLE `product_entries` DISABLE KEYS */;
INSERT INTO `product_entries` VALUES (1,1,6,NULL,'محل الزعيم',2335.00,'0593432111',NULL,9,'new','يوجد أكثر من قطعة بنفس السعر','approved',1,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(2,1,5,2,NULL,2862.00,'0598978438',NULL,1,'used','التوصيل متوفر لجميع مناطق غزة','approved',0,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(3,2,4,2,NULL,4664.00,'0597299827',NULL,7,'used','السعر نهائي وغير قابل للتفاوض','approved',1,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(4,2,7,NULL,'محل الزعيم',4807.00,'0592360590',NULL,4,'used','المنتج جديد بالكامل مع ضمان','approved',0,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(5,2,4,NULL,'محل الأفضل',2239.00,'0592535027',NULL,1,'new',NULL,'approved',0,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(6,3,4,NULL,'محل الذهبي',3804.00,'0595642956',NULL,3,'new',NULL,'approved',1,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(7,3,3,NULL,'محل الراقي',5034.00,'0593699804',NULL,3,'used','عرض لفترة محدودة','approved',0,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(8,3,9,3,NULL,3336.00,'0597210343',NULL,1,'used','يوجد أكثر من قطعة بنفس السعر','approved',0,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(9,3,2,2,NULL,3785.00,'0591370216',NULL,5,'new','السعر نهائي وغير قابل للتفاوض','approved',0,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(10,4,8,NULL,'محل المتميز',3510.00,'0593975728',NULL,9,'used','عرض لفترة محدودة','approved',1,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(11,4,1,2,NULL,3155.00,'0594089607',NULL,3,'new','مع الكرتونة والاكسسوارات الأصلية','approved',0,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(12,4,3,1,NULL,5108.00,'0596363372',NULL,2,'new',NULL,'approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(13,4,6,2,NULL,4262.00,'0593154403',NULL,7,'new','عرض لفترة محدودة','approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(14,5,1,3,NULL,1117.00,'0591195039',NULL,6,'used','يوجد أكثر من قطعة بنفس السعر','approved',1,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(15,5,8,2,NULL,1033.00,'0592789844',NULL,8,'new',NULL,'approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(16,5,7,NULL,'محل الزعيم',1296.00,'0593994758',NULL,7,'new',NULL,'approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(17,6,2,1,NULL,5181.00,'0594955101',NULL,3,'new','شبه جديد واستخدام بسيط','approved',1,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(18,6,1,NULL,'محل الزعيم',5493.00,'0595173256',NULL,2,'new','مع الكرتونة والاكسسوارات الأصلية','approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(19,6,9,NULL,'محل المتميز',6044.00,'0593523020',NULL,2,'new','السعر نهائي وغير قابل للتفاوض','approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(20,7,7,2,NULL,1132.00,'0595686651',NULL,3,'used',NULL,'approved',1,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(21,7,9,NULL,'محل الذهبي',2147.00,'0591112503',NULL,3,'new','التوصيل متوفر لجميع مناطق غزة','approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(22,7,3,NULL,'محل الزعيم',984.00,'0598782294',NULL,5,'used',NULL,'approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(23,8,9,NULL,'محل الأفضل',1171.00,'0591410603',NULL,5,'new','مع الكرتونة والاكسسوارات الأصلية','approved',1,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(24,8,7,1,NULL,796.00,'0595789640',NULL,6,'used','التوصيل متوفر لجميع مناطق غزة','approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(25,9,1,3,NULL,1042.00,'0592690083',NULL,4,'used','شبه جديد واستخدام بسيط','approved',1,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(26,9,8,NULL,'محل الزعيم',1647.00,'0597963480',NULL,2,'new',NULL,'approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(27,10,7,2,NULL,1528.00,'0596777038',NULL,4,'new',NULL,'approved',1,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(28,10,1,1,NULL,2033.00,'0599396261',NULL,8,'used','مع الكرتونة والاكسسوارات الأصلية','approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(29,10,7,1,NULL,1150.00,'0598565293',NULL,3,'new','شبه جديد واستخدام بسيط','approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(30,10,9,3,NULL,1280.00,'0597343697',NULL,9,'new',NULL,'approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(31,11,3,NULL,'محل الأفضل',1897.00,'0594762081',NULL,2,'used','شبه جديد واستخدام بسيط','approved',1,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(32,11,4,NULL,'محل الراقي',2128.00,'0596723163',NULL,4,'used','شبه جديد واستخدام بسيط','approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(33,12,6,1,NULL,2389.00,'0598953944',NULL,9,'used','يوجد أكثر من قطعة بنفس السعر','approved',1,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(34,12,4,2,NULL,2106.00,'0598123532',NULL,2,'new','المنتج جديد بالكامل مع ضمان','approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(35,13,6,2,NULL,1677.00,'0597860935',NULL,6,'new','المنتج جديد بالكامل مع ضمان','approved',1,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48'),(36,13,5,NULL,'محل المتميز',2995.00,'0597384857',NULL,1,'new',NULL,'approved',0,NULL,'2025-12-30 14:30:48','2025-12-30 14:30:48');
/*!40000 ALTER TABLE `product_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `sub_category_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specifications` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_sub_category_id_foreign` (`sub_category_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,6,1,2,'آيفون 13 برو','جوال آيفون 13 برو بشاشة 6.1 بوصة','MODEL-6285','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,1,1,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(2,3,1,1,'آيفون 14','جوال آيفون 14 بشاشة 6.1 بوصة','MODEL-1286','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,1,2,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(3,14,2,7,'سامسونج جالاكسي S22','جوال سامسونج بشاشة 6.1 بوصة','MODEL-2821','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,1,3,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(4,4,1,1,'سامسونج جالاكسي S23','جوال سامسونج بشاشة 6.2 بوصة','MODEL-9991','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,1,4,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(5,1,1,1,'شاومي ريدمي نوت 12','جوال شاومي بشاشة 6.67 بوصة','MODEL-1027','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,1,5,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(6,1,1,1,'ثلاجة LG 20 قدم','ثلاجة LG سعة 20 قدم','MODEL-8475','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,0,6,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(7,6,1,2,'غسالة سامسونج 10 كجم','غسالة أوتوماتيك سعة 10 كجم','MODEL-2970','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,0,7,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(8,9,1,3,'تلفزيون سوني 55 بوصة','تلفزيون سوني ذكي 4K','MODEL-4639','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,0,8,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(9,15,2,7,'مكيف سبليت 2 طن','مكيف سبليت بارد ساخن 2 طن','MODEL-6829','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,0,9,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(10,16,5,12,'هيونداي اكسنت 2018','سيارة هيونداي اكسنت موديل 2018','MODEL-3999','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,0,10,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(11,10,2,5,'تويوتا كورولا 2020','سيارة تويوتا كورولا موديل 2020','MODEL-9075','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,0,11,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(12,6,1,2,'كنبة 3 مقاعد','كنبة جلود 3 مقاعد','MODEL-9258','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,0,12,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(13,8,1,3,'طاولة طعام 6 كراسي','طاولة طعام خشب مع 6 كراسي','MODEL-4598','\"{\\\"color\\\":\\\"\\\\u0623\\\\u0633\\\\u0648\\\\u062f\\\",\\\"storage\\\":\\\"128GB\\\"}\"',NULL,NULL,1,0,13,'2025-12-30 14:30:47','2025-12-30 14:30:47');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `description` text COLLATE utf8mb4_unicode_ci,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_name','اسم الموقع','أحسن سعر','text',NULL,'general',1,1,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(2,'site_description','وصف الموقع','منصة مقارنة الأسعار في غزة','textarea',NULL,'general',1,2,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(3,'contact_email','البريد الإلكتروني','info@ahsensar.com','text',NULL,'general',1,3,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(4,'contact_phone','رقم الهاتف','0591234567','text',NULL,'general',1,4,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(5,'telegram_username','تليجرام','@shady2013','text',NULL,'general',1,5,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(6,'auto_approve_entries','الموافقة التلقائية على العروض','0','boolean',NULL,'system',0,1,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(7,'allow_guest_entries','السماح للزوار بإضافة عروض','1','boolean',NULL,'system',0,2,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(8,'ticker_text','نص الشريط الإخباري','للتواصل والاستفسار والإعلان عبر تليجرام: @shady2013 - موقع أحسن سعر يرحب بكم!','textarea',NULL,'ticker',1,1,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(9,'ticker_enabled','تفعيل الشريط الإخباري','1','boolean',NULL,'ticker',0,2,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(10,'meta_description','وصف الموقع لمحركات البحث','أحسن سعر - منصة مقارنة الأسعار في قطاع غزة، قارن أسعار الجوالات، الأجهزة الكهربائية، العقارات، السيارات والمزيد','textarea',NULL,'seo',0,1,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(11,'meta_keywords','كلمات دلالية','أسعار, غزة, مقارنة, جوالات, كهربائيات, عقارات, سيارات, أحسن سعر','text',NULL,'seo',0,2,'2025-12-30 14:30:45','2025-12-30 14:30:45');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shops` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `city_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `working_hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shops_slug_unique` (`slug`),
  KEY `shops_user_id_foreign` (`user_id`),
  KEY `shops_city_id_foreign` (`city_id`),
  CONSTRAINT `shops_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  CONSTRAINT `shops_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shops`
--

LOCK TABLES `shops` WRITE;
/*!40000 ALTER TABLE `shops` DISABLE KEYS */;
INSERT INTO `shops` VALUES (1,7,2,'متجر التقنية الذكية','mtgr-altkny-althky-762','0597654321',NULL,'عنوان المتجر 1','أفضل متجر للأجهزة الإلكترونية والجوالات في غزة',NULL,NULL,NULL,NULL,1,1,1,1,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(2,8,9,'الأمل للأثاث','alaml-llathath-306','0598765432',NULL,'عنوان المتجر 2','أثاث ومفروشات بجودة عالية وأسعار مناسبة',NULL,NULL,NULL,NULL,0,1,1,0,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(3,9,6,'سوق السيارات','sok-alsyarat-449','0599876543',NULL,'عنوان المتجر 3','متجر متخصص في بيع وشراء السيارات المستعملة',NULL,NULL,NULL,NULL,0,1,1,0,'2025-12-30 14:30:47','2025-12-30 14:30:47');
/*!40000 ALTER TABLE `shops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_categories_slug_unique` (`slug`),
  KEY `sub_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categories`
--

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
INSERT INTO `sub_categories` VALUES (1,1,'آبل','apple','fa-apple',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(2,1,'سامسونج','samsung','fa-mobile',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(3,1,'شاومي','xiaomi','fa-mobile',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(4,1,'هواوي','huawei','fa-mobile',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(5,2,'ثلاجات','refrigerators','fa-refrigerator',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(6,2,'غسالات','washing-machines','fa-soap',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(7,2,'تلفزيونات','tvs','fa-tv',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(8,2,'مكيفات','ac','fa-wind',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(9,3,'كنبات','sofas','fa-couch',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(10,3,'طاولات','tables','fa-table',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(11,3,'أسرة','beds','fa-bed',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(12,5,'سيارات سيدان','sedan','fa-car',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(13,5,'سيارات دفع رباعي','suv','fa-truck',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44'),(14,5,'دراجات نارية','motorcycles','fa-motorcycle',1,1,NULL,'2025-12-30 14:30:44','2025-12-30 14:30:44');
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_is_active_index` (`role`,`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'مدير النظام','admin@ahsensar.com','2025-12-30 14:30:45','$2y$12$FtmbwcAAlVHKwYwFu0NVUe9k/b.v9rOtHrGKsDEFJKTr3vwF0ffUK','0591234567',NULL,1,'admin',NULL,NULL,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(2,'مستخدم 1','user1@example.com','2025-12-30 14:30:45','$2y$12$bo0PjRmFA934VltNf/zNi.x5f5aE8GcBNgn2pr9t1LIhKuG4KYG0W','0593513125',NULL,1,'user',NULL,NULL,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(3,'مستخدم 2','user2@example.com','2025-12-30 14:30:45','$2y$12$zXjtKqOuuM3n9KbPEKf.KONcJqxukd2D9VodqbPUD.23Q9e0QeMfK','0594757663',NULL,1,'user',NULL,NULL,'2025-12-30 14:30:45','2025-12-30 14:30:45'),(4,'مستخدم 3','user3@example.com','2025-12-30 14:30:46','$2y$12$fYhKSZ.D9r1N1WA6vSkN..YcqpxQJMPLJQ5pPXfmg6Nx73qpMrqRG','0592771589',NULL,1,'user',NULL,NULL,'2025-12-30 14:30:46','2025-12-30 14:30:46'),(5,'مستخدم 4','user4@example.com','2025-12-30 14:30:46','$2y$12$Ex.QVkmXNbeON1tjJoUIl.YNBNG1notOHtG3649GBvnFOW7tMAcFm','0598129646',NULL,1,'user',NULL,NULL,'2025-12-30 14:30:46','2025-12-30 14:30:46'),(6,'مستخدم 5','user5@example.com','2025-12-30 14:30:46','$2y$12$sgHw4cDYUfh0k1SXJe1/BuritW6f0NESIiBXpx8wWhqwCFaFeACI2','0599044060',NULL,1,'user',NULL,NULL,'2025-12-30 14:30:46','2025-12-30 14:30:46'),(7,'صاحب متجر 1','shop1@example.com','2025-12-30 14:30:47','$2y$12$hhdfac1QaQuLrZwF.27SSOjIE6Z97wj2S449K0sSVAIplTAtEi0QC','0592299412',NULL,1,'shop',NULL,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(8,'صاحب متجر 2','shop2@example.com','2025-12-30 14:30:47','$2y$12$b0qokToPcyqHMoff2./EXOQHDs1DoaE7ROUoYs0shEC5IdcFjtOuq','0592381389',NULL,1,'shop',NULL,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47'),(9,'صاحب متجر 3','shop3@example.com','2025-12-30 14:30:47','$2y$12$LBObxQV73L8bkZ3kIBGYie6BqzdHiiRTWIGd.PbO9aAfsKp.XWGE6','0592171678',NULL,1,'shop',NULL,NULL,'2025-12-30 14:30:47','2025-12-30 14:30:47');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-04 18:01:31
