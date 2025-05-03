CREATE DATABASE  IF NOT EXISTS `admn-surat` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `admn-surat`;
-- MySQL dump 10.13  Distrib 8.0.41, for Linux (x86_64)
--
-- Host: localhost    Database: admn-surat
-- ------------------------------------------------------
-- Server version	8.0.41-0ubuntu0.22.04.1

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
-- Table structure for table `S_Aktif`
--

DROP TABLE IF EXISTS `S_Aktif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `S_Aktif` (
  `id` varchar(10) NOT NULL,
  `nrp` varchar(15) DEFAULT NULL,
  `semester` varchar(25) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `keperluan` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `file` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_S_Aktif_1_idx` (`nrp`),
  CONSTRAINT `fk_S_Aktif_1` FOREIGN KEY (`nrp`) REFERENCES `users` (`username`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `S_Aktif`
--

LOCK TABLES `S_Aktif` WRITE;
/*!40000 ALTER TABLE `S_Aktif` DISABLE KEYS */;
/*!40000 ALTER TABLE `S_Aktif` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_insert_s_aktif` BEFORE INSERT ON `S_Aktif` FOR EACH ROW BEGIN
  DECLARE last_id INT;
  DECLARE new_id VARCHAR(10);

  -- Ambil ID terakhir yang ada dan ubah ke angka
  SELECT IFNULL(MAX(CAST(SUBSTRING(id, 7) AS UNSIGNED)), 0)
  INTO last_id
  FROM S_Aktif
  WHERE id LIKE 'SKAKT-%';

  -- Format ID baru
  SET new_id = CONCAT('SKAKT-', LPAD(last_id + 1, 3, '0'));

  -- Isi kolom id dengan ID baru
  SET NEW.id = new_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `S_LHS`
--

DROP TABLE IF EXISTS `S_LHS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `S_LHS` (
  `id` varchar(10) NOT NULL,
  `nrp` varchar(15) DEFAULT NULL,
  `keperluan` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `file` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_S_LHS_1_idx` (`nrp`),
  CONSTRAINT `fk_S_LHS_1` FOREIGN KEY (`nrp`) REFERENCES `users` (`username`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `S_LHS`
--

LOCK TABLES `S_LHS` WRITE;
/*!40000 ALTER TABLE `S_LHS` DISABLE KEYS */;
/*!40000 ALTER TABLE `S_LHS` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_insert_s_lhs` BEFORE INSERT ON `S_LHS` FOR EACH ROW BEGIN
  DECLARE last_id INT;
  DECLARE new_id VARCHAR(10);

  -- Ambil ID terakhir yang ada dan ubah ke angka
  SELECT IFNULL(MAX(CAST(SUBSTRING(id, 7) AS UNSIGNED)), 0)
  INTO last_id
  FROM S_LHS
  WHERE id LIKE 'SKLHS-%';

  -- Format ID baru
  SET new_id = CONCAT('SKLHS-', LPAD(last_id + 1, 3, '0'));

  -- Isi kolom id dengan ID baru
  SET NEW.id = new_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `S_Lulus`
--

DROP TABLE IF EXISTS `S_Lulus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `S_Lulus` (
  `id` varchar(10) NOT NULL,
  `nrp` varchar(15) DEFAULT NULL,
  `tanggal_lulus` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_S_Lulus_1_idx` (`nrp`),
  CONSTRAINT `fk_S_Lulus_1` FOREIGN KEY (`nrp`) REFERENCES `users` (`username`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `S_Lulus`
--

LOCK TABLES `S_Lulus` WRITE;
/*!40000 ALTER TABLE `S_Lulus` DISABLE KEYS */;
/*!40000 ALTER TABLE `S_Lulus` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_insert_s_lulus` BEFORE INSERT ON `S_Lulus` FOR EACH ROW BEGIN
  DECLARE last_id INT;
  DECLARE new_id VARCHAR(10);

  -- Cari ID terakhir yang formatnya SKLLS-XXX
  SELECT IFNULL(MAX(CAST(SUBSTRING(id, 7) AS UNSIGNED)), 0)
  INTO last_id
  FROM S_Lulus
  WHERE id LIKE 'SKLLS-%';

  -- Buat ID baru
  SET new_id = CONCAT('SKLLS-', LPAD(last_id + 1, 3, '0'));

  -- Set kolom id dengan ID baru
  SET NEW.id = new_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `S_Pengantar`
--

DROP TABLE IF EXISTS `S_Pengantar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `S_Pengantar` (
  `id` varchar(10) NOT NULL,
  `nrp` varchar(15) DEFAULT NULL,
  `tujuan_surat` varchar(45) DEFAULT NULL,
  `mata_kuliah` varchar(50) DEFAULT NULL,
  `semester` varchar(25) DEFAULT NULL,
  `data_mahasiswa` varchar(255) DEFAULT NULL,
  `keperluan` varchar(255) DEFAULT NULL,
  `topik` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `file` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_S_Pengantar_1_idx` (`nrp`),
  CONSTRAINT `fk_S_Pengantar_1` FOREIGN KEY (`nrp`) REFERENCES `users` (`username`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `S_Pengantar`
--

LOCK TABLES `S_Pengantar` WRITE;
/*!40000 ALTER TABLE `S_Pengantar` DISABLE KEYS */;
/*!40000 ALTER TABLE `S_Pengantar` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_insert_s_pengantarmk` BEFORE INSERT ON `S_Pengantar` FOR EACH ROW BEGIN
  DECLARE last_id INT;
  DECLARE new_id VARCHAR(10);

  -- Ambil ID terakhir dari tabel yang berformat SKPMK-XXX
  SELECT IFNULL(MAX(CAST(SUBSTRING(id, 7) AS UNSIGNED)), 0)
  INTO last_id
  FROM S_Pengantar
  WHERE id LIKE 'SKPMK-%';

  -- Buat ID baru
  SET new_id = CONCAT('SKPMK-', LPAD(last_id + 1, 3, '0'));

  -- Isi kolom id dengan ID baru
  SET NEW.id = new_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `prodi`
--

DROP TABLE IF EXISTS `prodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prodi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_prodi` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodi`
--

LOCK TABLES `prodi` WRITE;
/*!40000 ALTER TABLE `prodi` DISABLE KEYS */;
INSERT INTO `prodi` (`id`, `nama_prodi`, `created_at`, `updated_at`) VALUES (1,'FTI',NULL,NULL),(2,'Teknik Informatika',NULL,NULL),(3,'Sistem Informasi',NULL,NULL),(4,'Magister Ilmu Komputer',NULL,NULL);
/*!40000 ALTER TABLE `prodi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id` int NOT NULL,
  `role_name` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `role_name`, `created_at`, `updated_at`) VALUES (0,'admin','2025-03-16 07:30:00','2025-03-16 07:30:00'),(1,'kaprodi','2025-03-16 07:30:00','2025-03-16 07:30:00'),(2,'tu','2025-03-16 07:30:00','2025-03-16 07:30:00'),(3,'mahasiswa','2025-03-16 07:30:00','2025-03-16 07:30:00');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_role` int NOT NULL,
  `id_prodi` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_tlp` varchar(15) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_users_role` (`id_role`),
  CONSTRAINT `fk_users_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`username`, `password`, `id_role`, `id_prodi`, `nama`, `alamat`, `email`, `no_tlp`, `status`, `created_at`, `updated_at`) VALUES ('admin','$2y$12$FDK3bnBTHfLLRe7HB2Wp/eHF9e0zI2.qT8f8A3pYrQKqZcupZP6rS',0,1,'ADmin','GWM Lantai 8','dummy@gmail.com','111','Aktif','2025-04-26 07:26:43','2025-04-26 07:26:43');
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

-- Dump completed on 2025-05-03 14:43:17
