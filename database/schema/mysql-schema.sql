/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `address_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `home_number` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alerts` (
  `alert_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `preference` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`alert_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `status` enum('scheduled','cancelled','completed') DEFAULT 'scheduled',
  `appointment_time` time NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `prescription_given` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`appointment_id`),
  KEY `user_id` (`user_id`),
  KEY `provider_id` (`provider_id`),
  CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `dbt_user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`provider_id`) REFERENCES `dbt_user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `compliance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compliance` (
  `compliance_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('healthcare regulation','standard','legal requirement') NOT NULL,
  `status` tinyint(1) NOT NULL,
  `issue` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`compliance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dbt_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dbt_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(100) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `activated` varchar(225) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(225) NOT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `speciality` varchar(225) DEFAULT NULL,
  `access_level` tinyint(1) NOT NULL DEFAULT 1,
  `qualification` varchar(255) DEFAULT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `dbt_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `excercise_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `excercise_data` (
  `excercise_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category` enum('running','walking','cycling','Gym') NOT NULL,
  `calories` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`excercise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facilities` (
  `facility_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `primary_care` tinyint(1) DEFAULT NULL,
  `special_care` tinyint(1) DEFAULT NULL,
  `emergency_care` tinyint(1) DEFAULT NULL,
  `diagnostic_service` tinyint(1) DEFAULT NULL,
  `operational_status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`facility_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_comments` (
  `comment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `post_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `forum_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `dbt_user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_topics` (
  `topic_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `posts` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `incidents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incidents` (
  `incident_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `incident_time` datetime NOT NULL,
  `description` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`incident_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `medical_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_history` (
  `history_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `summary` text NOT NULL,
  `date` date NOT NULL,
  `medical_condition` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `medication_dispensation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medication_dispensation` (
  `dispensation_id` int(11) NOT NULL AUTO_INCREMENT,
  `pharmacist_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `prescription_id` int(11) DEFAULT NULL,
  `dispensation_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`dispensation_id`),
  KEY `pharmacist_id` (`pharmacist_id`),
  KEY `user_id` (`user_id`),
  KEY `prescription_id` (`prescription_id`),
  CONSTRAINT `medication_dispensation_ibfk_1` FOREIGN KEY (`pharmacist_id`) REFERENCES `dbt_user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `medication_dispensation_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `dbt_user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `medication_dispensation_ibfk_3` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`prescription_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `patient_health_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_health_records` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `prescriptions` text DEFAULT NULL,
  `vital_signs` text DEFAULT NULL,
  `exercise_data` text DEFAULT NULL,
  PRIMARY KEY (`record_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `patient_health_records_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `dbt_user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `prescriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prescriptions` (
  `prescription_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `medication_name` varchar(100) DEFAULT NULL,
  `dosage` varchar(50) DEFAULT NULL,
  `frequency` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `summary` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `medicines` longtext DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `side_effects` varchar(255) DEFAULT NULL,
  `remainder` tinyint(1) NOT NULL DEFAULT 0,
  `provider_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`prescription_id`),
  KEY `provider_id` (`provider_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `dbt_user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `dbt_user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `report_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('user activity','system performance','health trends') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `secure_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secure_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message_content` text DEFAULT NULL,
  `send_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`message_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `secure_messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `dbt_user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `secure_messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `dbt_user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `symptoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `symptoms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `table_configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_configuration` (
  `config_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `config` varchar(255) DEFAULT NULL,
  `affected_data` varchar(255) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `severity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `table_vital_signs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_vital_signs` (
  `sign_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category` enum('blood_pressure','heart_beat','glucose','weight') NOT NULL,
  `value` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_resets_table',1);
INSERT INTO `migrations` VALUES (3,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` VALUES (4,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` VALUES (5,'2024_04_14_195537_create_appointments_table',0);
INSERT INTO `migrations` VALUES (6,'2024_04_14_195537_create_dbt_user_table',0);
INSERT INTO `migrations` VALUES (7,'2024_04_14_195537_create_failed_jobs_table',0);
INSERT INTO `migrations` VALUES (8,'2024_04_14_195537_create_forum_posts_table',0);
INSERT INTO `migrations` VALUES (9,'2024_04_14_195537_create_medication_dispensation_table',0);
INSERT INTO `migrations` VALUES (10,'2024_04_14_195537_create_password_resets_table',0);
INSERT INTO `migrations` VALUES (11,'2024_04_14_195537_create_patient_health_records_table',0);
INSERT INTO `migrations` VALUES (12,'2024_04_14_195537_create_personal_access_tokens_table',0);
INSERT INTO `migrations` VALUES (13,'2024_04_14_195537_create_prescriptions_table',0);
INSERT INTO `migrations` VALUES (14,'2024_04_14_195537_create_roles_table',0);
INSERT INTO `migrations` VALUES (15,'2024_04_14_195537_create_secure_messages_table',0);
INSERT INTO `migrations` VALUES (16,'2024_04_14_195540_add_foreign_keys_to_appointments_table',0);
INSERT INTO `migrations` VALUES (17,'2024_04_14_195540_add_foreign_keys_to_dbt_user_table',0);
INSERT INTO `migrations` VALUES (18,'2024_04_14_195540_add_foreign_keys_to_forum_posts_table',0);
INSERT INTO `migrations` VALUES (19,'2024_04_14_195540_add_foreign_keys_to_medication_dispensation_table',0);
INSERT INTO `migrations` VALUES (20,'2024_04_14_195540_add_foreign_keys_to_patient_health_records_table',0);
INSERT INTO `migrations` VALUES (21,'2024_04_14_195540_add_foreign_keys_to_prescriptions_table',0);
INSERT INTO `migrations` VALUES (22,'2024_04_14_195540_add_foreign_keys_to_secure_messages_table',0);
INSERT INTO `migrations` VALUES (23,'2024_03_25_115637_create_forum_comments_table',2);
INSERT INTO `migrations` VALUES (24,'2024_03_29_124314_create_symptoms_table',2);
INSERT INTO `migrations` VALUES (25,'2024_03_31_185420_add_timestamps_to_forum_posts_table',2);
INSERT INTO `migrations` VALUES (26,'2024_04_11_152632_change_phone_number_to_string_in_dbt_user_table',2);
INSERT INTO `migrations` VALUES (27,'2024_04_11_195741_create_forum_topics_table',2);
INSERT INTO `migrations` VALUES (28,'2024_04_12_195219_update_forum_posts_table',2);
INSERT INTO `migrations` VALUES (29,'2024_04_14_200914_add_prescription_given_to_appointments_table',3);
INSERT INTO `migrations` VALUES (30,'2024_04_14_212210_create_alerts_table',4);
INSERT INTO `migrations` VALUES (31,'2024_04_14_212817_update_alterts_table',5);
INSERT INTO `migrations` VALUES (32,'2024_04_14_215540_add_columns_to_dbt_user_table',6);
INSERT INTO `migrations` VALUES (33,'2024_04_14_220135_add_columns_to_dbt_user_table',7);
INSERT INTO `migrations` VALUES (34,'2024_04_14_220853_add_columns_to_dbt_user_table',8);
INSERT INTO `migrations` VALUES (35,'2024_04_14_220952_add_columns_to_dbt_user_table',9);
INSERT INTO `migrations` VALUES (36,'2024_04_14_221045_add_columns_to_dbt_user_table',9);
INSERT INTO `migrations` VALUES (37,'2024_04_14_221131_add_columns_to_dbt_user_table',10);
INSERT INTO `migrations` VALUES (38,'2024_04_14_221135_add_columns_to_dbt_user_table',10);
INSERT INTO `migrations` VALUES (39,'2024_04_14_221942_add_columns_to_dbt_user_table',11);
INSERT INTO `migrations` VALUES (40,'2024_04_14_222121_add_columns_to_dbt_user_table',12);
INSERT INTO `migrations` VALUES (41,'2024_04_14_222126_add_columns_to_dbt_user_table',12);
INSERT INTO `migrations` VALUES (42,'2024_04_14_222130_add_columns_to_dbt_user_table',12);
INSERT INTO `migrations` VALUES (43,'2024_04_14_222134_add_columns_to_dbt_user_table',12);
INSERT INTO `migrations` VALUES (44,'2024_04_14_222137_add_columns_to_dbt_user_table',12);
INSERT INTO `migrations` VALUES (45,'2024_04_14_223619_add_columns_to_dbt_user_table',13);
INSERT INTO `migrations` VALUES (46,'2024_04_14_223623_add_columns_to_dbt_user_table',13);
INSERT INTO `migrations` VALUES (47,'2024_04_14_223628_add_columns_to_dbt_user_table',13);
INSERT INTO `migrations` VALUES (48,'2024_04_14_223635_add_columns_to_dbt_user_table',13);
INSERT INTO `migrations` VALUES (49,'2024_04_15_214217_create_medical_history_table',14);
INSERT INTO `migrations` VALUES (50,'2024_04_16_065933_update_medical_history_table',15);
INSERT INTO `migrations` VALUES (51,'2024_04_16_082637_update_prescriptions_table',16);
INSERT INTO `migrations` VALUES (52,'2024_04_16_101212_create_table_vital_signs',17);
INSERT INTO `migrations` VALUES (53,'2024_04_16_105151_insert_values_into_dbt_users_table',18);
INSERT INTO `migrations` VALUES (54,'2024_04_18_114150_create_facilities_table',19);
INSERT INTO `migrations` VALUES (55,'2024_04_19_083928_create_table_compliance',20);
INSERT INTO `migrations` VALUES (56,'2024_04_19_140924_create_table_incidents',21);
INSERT INTO `migrations` VALUES (57,'2024_04_21_230053_update_dbt_user_table',22);
INSERT INTO `migrations` VALUES (58,'2024_04_21_230432_create_table_doctors',23);
INSERT INTO `migrations` VALUES (59,'2024_04_23_085833_create_adresses_table',24);
INSERT INTO `migrations` VALUES (60,'2024_04_24_003857_create_table_report',25);
INSERT INTO `migrations` VALUES (61,'2024_04_24_091504_create_table_configuration',26);
