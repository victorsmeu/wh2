-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: wh2
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `specialty_id` int(10) unsigned NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `document_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `target_ehr_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_user_id_foreign` (`user_id`),
  KEY `documents_specialty_id_foreign` (`specialty_id`),
  CONSTRAINT `documents_specialty_id_foreign` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`id`) ON DELETE CASCADE,
  CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `history_action_index` (`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medic_specialties`
--

DROP TABLE IF EXISTS `medic_specialties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medic_specialties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `specialty_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medic_specialties_user_id_foreign` (`user_id`),
  KEY `medic_specialties_specialty_id_foreign` (`specialty_id`),
  CONSTRAINT `medic_specialties_specialty_id_foreign` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`id`) ON DELETE CASCADE,
  CONSTRAINT `medic_specialties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medic_specialties`
--

LOCK TABLES `medic_specialties` WRITE;
/*!40000 ALTER TABLE `medic_specialties` DISABLE KEYS */;
INSERT INTO `medic_specialties` VALUES (1,2,1,NULL,NULL),(2,2,2,NULL,NULL),(3,2,3,NULL,NULL),(4,4,1,NULL,NULL),(5,4,4,NULL,NULL);
/*!40000 ALTER TABLE `medic_specialties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_05_16_204943_create_all_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient_data`
--

DROP TABLE IF EXISTS `patient_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_data_patient_id_foreign` (`patient_id`),
  CONSTRAINT `patient_data_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_data`
--

LOCK TABLES `patient_data` WRITE;
/*!40000 ALTER TABLE `patient_data` DISABLE KEYS */;
INSERT INTO `patient_data` VALUES (3,2,'first_diagnostic','&lt;p&gt;adsa&lt;/p&gt;','2016-05-30 08:48:57','2016-05-30 08:50:21'),(4,2,'reason_for_investigation','&lt;p&gt;lorem ipsum dolor sit amanet aa&lt;/p&gt;','2016-05-30 08:48:57','2016-05-30 11:45:31'),(6,2,'physical_exploration','&lt;p&gt;&amp;nbsp;aaa&lt;/p&gt;\r\n&lt;p&gt;bbb&lt;/p&gt;\r\n&lt;p&gt;ccc&lt;/p&gt;','2016-05-30 09:46:11','2016-05-30 09:46:11'),(7,2,'medical_history','&lt;p&gt;wedwd&lt;/p&gt;\r\n&lt;p&gt;wedwe&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;','2016-05-30 09:57:12','2016-05-30 09:57:12'),(11,2,'first_diagnostic_file','{\"filename\":\"9358d38fc65d6bf91defa3ce6d237165.png\",\"originalName\":\"scr1.png\"}','2016-05-30 10:43:31','2016-05-30 10:43:31'),(12,2,'first_diagnostic_file','{\"filename\":\"61c47b1fcc7f92da8d96ac6e5535417c.png\",\"originalName\":\"scr2.png\"}','2016-05-30 10:45:19','2016-05-30 10:45:19'),(13,2,'medical_history_file','{\"filename\":\"ce16a98414c513c4021d07ba3409c6d9.jpg\",\"originalName\":\"Koala.jpg\"}','2016-05-30 11:30:24','2016-05-30 11:30:24'),(14,2,'current_treatment','&lt;p&gt;gdfd&lt;/p&gt;','2016-05-30 11:35:38','2016-05-30 11:35:38'),(19,2,'physical_exploration_file','{\"filename\":\"a90375e8f7773cb6a0e35a8a972cc825.jpg\",\"originalName\":\"Lighthouse.jpg\"}','2016-05-30 12:18:27','2016-05-30 12:18:27'),(20,2,'lab_analysis','&lt;p&gt;fvd&lt;/p&gt;','2016-05-30 12:18:42','2016-05-30 12:18:42'),(21,2,'lab_analysis_file','{\"filename\":\"0e70b59a6d740feb5e4aee5d3135a29f.jpg\",\"originalName\":\"Jellyfish.jpg\"}','2016-05-30 12:18:52','2016-05-30 12:18:52');
/*!40000 ALTER TABLE `patient_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year_of_birth` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,1,'Ion','Popescu','M',1985,'2016-05-25 11:21:53','2016-05-25 11:21:53'),(2,3,'Mark','Gerald','M',1974,'2016-05-27 09:22:26','2016-05-27 09:22:26'),(3,3,'Lorem','Ipsum1','F',1990,'2016-05-27 09:34:02','2016-05-27 09:45:30'),(4,2,'My','Patient','F',1988,'2016-05-31 08:45:00','2016-05-31 08:45:00');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `study_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `active` int(10) unsigned DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `viewed` int(10) unsigned DEFAULT NULL,
  `viewed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reports_study_id_foreign` (`study_id`),
  KEY `reports_user_id_foreign` (`user_id`),
  CONSTRAINT `reports_study_id_foreign` FOREIGN KEY (`study_id`) REFERENCES `studies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (1,1,2,'Dummy data',1,'2016-05-01 15:55:47',1,'2016-05-05 15:12:30','2016-04-30 21:00:00','2016-04-30 21:00:00');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Root','Full admin','2016-05-25 05:54:04','2016-05-25 05:54:04'),(2,'Admin','Full access to create, edit, and update.','2016-05-25 05:54:04','2016-05-25 05:54:04'),(3,'Medic','Can view patients, EHRs, write reports','2016-05-25 05:54:04','2016-05-25 05:54:04'),(4,'Patient','','2016-05-25 05:54:04','2016-05-25 05:54:04');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialties`
--

DROP TABLE IF EXISTS `specialties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialties`
--

LOCK TABLES `specialties` WRITE;
/*!40000 ALTER TABLE `specialties` DISABLE KEYS */;
INSERT INTO `specialties` VALUES (1,'General Surgery',NULL,NULL),(2,'Thoracic Surgery',NULL,NULL),(3,'Neurosurgery',NULL,NULL),(4,'Gynecology',NULL,NULL),(5,'Orthopedics',NULL,NULL),(6,'Urology',NULL,NULL),(7,'Neurology',NULL,NULL),(8,'Medical Imaging',NULL,NULL);
/*!40000 ALTER TABLE `specialties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studies`
--

DROP TABLE IF EXISTS `studies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `study_id_dicom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `study_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `specialty_id` int(10) unsigned NOT NULL,
  `upload_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `upload_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `institution` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bodyPart` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creationDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `studies_user_id_foreign` (`user_id`),
  CONSTRAINT `studies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studies`
--

LOCK TABLES `studies` WRITE;
/*!40000 ALTER TABLE `studies` DISABLE KEYS */;
INSERT INTO `studies` VALUES (1,3,'21312e21324','Study 1',1,'','done','1','Clinic WH','Rec','Head','2016-05-02','Lorem ipsum dolor sit amanet','M',33,'2016-05-01 21:00:00','2016-05-01 21:00:00'),(2,2,'23123d12r4r','Study By Medic',2,'','done','4','Clinic WH','Rec','Shoulder','2016-04-21','Lorem ipsum dolor sit amanet','F',28,'2016-05-01 21:00:00','2016-05-01 21:00:00');
/*!40000 ALTER TABLE `studies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studies_users`
--

DROP TABLE IF EXISTS `studies_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studies_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `study_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `invited_at` datetime DEFAULT NULL,
  `accepted` tinyint(4) DEFAULT NULL,
  `viewed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `studies_users_study_id_foreign` (`study_id`),
  KEY `studies_users_user_id_foreign` (`user_id`),
  CONSTRAINT `studies_users_study_id_foreign` FOREIGN KEY (`study_id`) REFERENCES `studies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `studies_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studies_users`
--

LOCK TABLES `studies_users` WRITE;
/*!40000 ALTER TABLE `studies_users` DISABLE KEYS */;
INSERT INTO `studies_users` VALUES (1,1,2,'2016-05-31 12:23:52',NULL,NULL,'2016-05-31 09:22:30','2016-05-31 09:23:52');
/*!40000 ALTER TABLE `studies_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `study_comments`
--

DROP TABLE IF EXISTS `study_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `study_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `study_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `study_comments_study_id_foreign` (`study_id`),
  KEY `study_comments_user_id_foreign` (`user_id`),
  CONSTRAINT `study_comments_study_id_foreign` FOREIGN KEY (`study_id`) REFERENCES `studies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `study_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `study_comments`
--

LOCK TABLES `study_comments` WRITE;
/*!40000 ALTER TABLE `study_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `study_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `study_details`
--

DROP TABLE IF EXISTS `study_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `study_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `study_id` int(10) unsigned NOT NULL,
  `study_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mrn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `center` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pni` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `study_details_study_id_foreign` (`study_id`),
  CONSTRAINT `study_details_study_id_foreign` FOREIGN KEY (`study_id`) REFERENCES `studies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `study_details`
--

LOCK TABLES `study_details` WRITE;
/*!40000 ALTER TABLE `study_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `study_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Victor','Smeu','victor@victorsmeu.com','$2y$10$uK9TIhSXfAfI1rBbsT0fQODnhqWnwT8pzJGLHugNGPgiYx3FzLZ4y',1,'obgnD4adJgvHD10mLoAb8R8SORJ3PWW8ok8WR59tHdtDyqWaKIgTVz3w8lSE',1,'2016-05-25 05:59:17','2016-05-31 05:58:42'),(2,'Demo','Medic','demo@webhippocrates.com','$2y$10$u3t/zlqBykLAORJSLl91EupLyqmioMhNBE1.CNjPEvLJ10vIpF55G',3,'f0K87CNXKi8ycoxpUyztmTXhaXLQCrzcV4Ux2Md52TU1aQT33oKPvUCDie5Q',1,'2016-05-25 10:41:32','2016-05-31 06:11:18'),(3,'Ion','Popescu','Ion.popescu1@demo.com','$2y$10$uHOEszVEkuKhIq0o0WZW7OKJ4rxRCCJQOsasOuwpSxNeSvWv1nzMC',4,'z0UXfMJL6pWg2d8NjfGDAozDTy5lgLSS8gkdfqxHjgJarC1FT3GdxPSCdmqc',1,'2016-05-25 12:29:59','2016-05-31 05:54:10'),(4,'Medical','Doctor','medical.doctor@wh2.com','$2y$10$1N0UeeYmoC8Z9dQKkegjV.O6RAH9CB7RTvk811lw8mIdZKMPbLXCy',3,NULL,1,'2016-05-31 05:57:37','2016-05-31 06:10:26'),(5,'Radu','Alexandru','radu.alexandru@demo.com','$2y$10$L5k4.zYYVBvtndOK10LIvOqGjzqkckskWOqQRBFShb1bU7KFYFzRG',4,'54UCh10yKIs1soVr8mMx20ZPYcFm4PefgRC6h4W4FqtrGtEzHevxOvNfijRy',1,'2016-05-31 05:58:13','2016-05-31 06:05:06');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `viewers`
--

DROP TABLE IF EXISTS `viewers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viewers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `viewers`
--

LOCK TABLES `viewers` WRITE;
/*!40000 ALTER TABLE `viewers` DISABLE KEYS */;
INSERT INTO `viewers` VALUES (1,'Weasis','http://is.webhippocrates.com:8080/weasis-pacs-connector/viewer.jnlp?studyUID='),(2,'Oviyam','https://www.webhippocrates.com/webviewer/viewer.html?studyUID='),(3,'Osirix','https://www.webhippocrates.com/dicom/downloadData?study='),(4,'Download','https://www.webhippocrates.com/dicom/downloadArchive?study=');
/*!40000 ALTER TABLE `viewers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-31 18:07:16
