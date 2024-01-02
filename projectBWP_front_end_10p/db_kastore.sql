/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 10.4.27-MariaDB : Database - db_kastore
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE or REPLACE DATABASE `db_kastore` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_kastore`;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `category` */

/*Table structure for table `order_product` */

DROP TABLE IF EXISTS `order_product`;

CREATE TABLE `order_product` (
  `order_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_product_quantity` int(11) NOT NULL,
  `order_product_review` text DEFAULT NULL,
  `order_product_rating` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_product_id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `order_product` */

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_total_amount` int(11) NOT NULL,
  `order_status` int(2) NOT NULL,
  `order_destination` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `orders` */

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `product_img` text NOT NULL,
  `product_detail` text DEFAULT NULL,
  `product_price` int(11) NOT NULL,
  `product_stock` int(11) NOT NULL DEFAULT 0,
  `product_avg_rating` decimal(10,0) DEFAULT NULL,
  `product_jumlah_avg_data` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `store_id` (`store_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  CONSTRAINT `product_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `product` */

/*Table structure for table `store` */

DROP TABLE IF EXISTS `store`;

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(50) NOT NULL,
  `store_email` varchar(50) NOT NULL,
  `store_img` text NULL DEFAULT NULL,
  `store_address` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_revenue` int(11) NOT NULL DEFAULT 0,
  `store_status` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`store_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `store_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `store` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_nama` varchar(50) NOT NULL,
  `user_money` int(11) NOT NULL DEFAULT 0,
  `user_role` varchar(50) NOT NULL DEFAULT 'Customer',
  `user_img` text DEFAULT NULL,
  `user_gender` varchar(5) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`user_id`,`user_email`,`user_password`,`user_name`,`user_nama`,`user_money`,`user_role`,`user_img`,`user_gender`,`user_phone`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'admin@gmail.com','$2y$12$PTi99ULbUknumwIAiKb47.GblGx9YQrqMVM0GkZ.r1flE9fctrBAi','admin','Admin',0,'Admin',NULL,'P','0223421244','2023-12-28 14:20:29','2023-12-28 14:20:29',NULL),
(2,'john.doe@example.com','$2y$12$FH.zrmGpehpsfLUZdfDq0uZ1w1YAMSn82kX1QPitfcy8vZ/OlrNN6','JohnDoe','John Doe',0,'Customer',NULL,'P','123-456-7890','2024-01-02 16:12:39','2024-01-02 16:12:39',NULL),
(3,'jane.doe@example.com','$2y$12$SI5cFE/PBh6oPek489gTEe1hK1cCftkue8MbOS.iHp9f66UuLwj/y','JaneDoe','Jane Doe',0,'Customer',NULL,'W','987-654-3210','2024-01-02 16:18:41','2024-01-02 16:18:41',NULL),
(4,'bob.johnson@example.com','$2y$12$Kk2QlxSYjiz9ArH1Il4Dz.Pf8uq5M4qVU.qYaJu7EnKM8mMTVAEyS','bobjohnson','Bob Johnson',0,'Customer',NULL,'P','567-890-1234','2024-01-02 16:19:59','2024-01-02 16:19:59',NULL),
(5,'samantha.white@example.com','$2y$12$8mBfUECOWJ5X6HSiKuSbEOSvEMgdEL3xb9DtmH6Ji/pe/vq1NH7Dq','samanthawhite','Samantha White',0,'Customer',NULL,'W','345-678-9012','2024-01-02 16:22:36','2024-01-02 16:22:36',NULL),
(6,'michael.smith@example.com','$2y$12$o6e0t0HnuDbDZcIB0zozAu3chtpkM0EDjmzD7FnfnA/VWwRLSyJZG','michaelsmith','Michael Smith',0,'Customer',NULL,'W','876-543-2109','2024-01-02 16:25:28','2024-01-02 16:25:28',NULL),
(7,'ella.davis@example.com','$2y$12$WOH2S1AeS8R.BL64n.KJl.3SekPBWx872FchdVOLu2D/2Seh6S5cq','elladavis','Ella Davis',0,'Customer',NULL,'W','234-567-8901','2024-01-02 16:26:59','2024-01-02 16:26:59',NULL),
(8,'matthew.brown@example.com','$2y$12$hIdds0ONL2ivDXcskIlmr.QV2i1kb8F8aqLlkmmPqaKx2snuEoojG','matthewbrown','Matthew Brown',0,'Customer',NULL,'P','789-012-3456','2024-01-02 16:28:36','2024-01-02 16:28:36',NULL),
(9,'olivia.miller@example.com','$2y$12$SZMRfMuycESS/Y/92KvkPOUB5D0sPTOeuWLpwVUAXNAQL/Nqs948S','oliviamiller','Olivia Miller',0,'Customer',NULL,'W','210-987-6543','2024-01-02 16:29:58','2024-01-02 16:29:58',NULL),
(10,'david.taylor@example.com','$2y$12$tPzvqVK8DqhmaSpcndslCOPQQjTEtLYYrurIljz6HwIt2mAVm/EnC','davidtaylor','David Taylor',0,'Customer',NULL,'P','432-109-8765','2024-01-02 16:31:09','2024-01-02 16:31:09',NULL),
(11,'sophia.wilson@example.com','$2y$12$0phOpIm9b.JMm.HIJx2ps.syjo3Qc1ycayMyzKHcigOx5apwM6L5a','sophiawilson','Sophia Wilson',0,'Customer',NULL,'W','109-876-5432','2024-01-02 16:32:03','2024-01-02 16:32:03',NULL),
(12,'daniel.martinez@example.com','$2y$12$KYVGOgCd0ufQFym9NALRkO8zSgPiFm3sTYhpLVR4WNM/9UsuktV0G','danielmartinez','Daniel Martinez',0,'Customer',NULL,'P','678-345-0123','2024-01-02 16:32:41','2024-01-02 16:32:41',NULL),
(13,'ava.jackson@example.com','$2y$12$5o09MOCgblez5CHdEcLR4.eLKFzFsCVwqxt67d56a21oZTBn5Q3ju','avajackson','Ava Jackson',0,'Customer',NULL,'W','345-678-9012','2024-01-02 16:33:24','2024-01-02 16:33:24',NULL),
(14,'josephine.garcia@example.com','$2y$12$LQThDTAG26oqO5LgrwMlOO3M/ciyYtaOjqx/WWGgX445Si8X3uOEO','josephinegarcia','Josephine Garcia',0,'Customer',NULL,'W','012-345-6789','2024-01-02 16:34:52','2024-01-02 16:34:52',NULL),
(15,'lucas.rodriguez@example.com','$2y$12$cCUxmj6xxvSaRO1I6tElAOkvH8z/7Rd.rZ7sFYm7EpzAzmPgZCTai','lucasrodriguez','Lucas Rodriguez',0,'Customer',NULL,'P','567-890-1234','2024-01-02 16:35:37','2024-01-02 16:35:37',NULL),
(16,'isabella.lopez@example.com','$2y$12$sWKQnGVDzdOFUReFhiFuG./ozvyCY3BUlWi2aMHNZT0SeulUcka5u','isabellalopez','Isabella Lopez',0,'Customer',NULL,'W','234-567-8901','2024-01-02 16:37:11','2024-01-02 16:37:11',NULL),
(17,'benjamin.smith@example.com','$2y$12$O9sLmkERkqJayejFjfVmQuAO8aWBSeL0pkYEqtuWn0LZqph3pGgPS','benjaminsmith','Benjamin Smith',0,'Customer',NULL,'P','789-012-3456','2024-01-02 16:37:45','2024-01-02 16:37:45',NULL),
(18,'mia.davis@example.com','$2y$12$Ku1990hwLrbFGI6B2bwnWuIb24FmUs3gXDkNNe5JClA6I8GfnWKwe','miadavis','Mia Davis',0,'Customer',NULL,'W','210-987-6543','2024-01-02 16:38:39','2024-01-02 16:38:39',NULL),
(19,'elijah.johnson@example.com','$2y$12$8yC.3zmYRWzTsCuSuT.0zOV4EGqgpX2TFjuAGfaoJtCBe2rBZL7O6','elijahjohnson','Elijah Johnson',0,'Customer',NULL,'W','432-109-8765','2024-01-02 16:40:14','2024-01-02 16:40:14',NULL),
(20,'scarlett.taylor@example.com','$2y$12$6qE6FtjT1ROA2hqvZeaLde6RjlKapJZkXBQk25.Z0UBguowQZI8om','scarletttaylor','Scarlett Taylor',0,'Customer',NULL,'W','109-876-5432','2024-01-02 16:41:11','2024-01-02 16:41:11',NULL),
(21,'lucas.martinez@example.com','$2y$12$NgFSJk.68/2KUjTwvbqJuuLdyDM2422zUMG4X9I02F8JpFDecgCtK','lucasmartinez','Lucas Martinez',0,'Customer',NULL,'P','678-345-0123','2024-01-02 16:42:10','2024-01-02 16:42:10',NULL),
(22,'aria.garcia@example.com','$2y$12$4XLbYmViOHzzjx.aJOMaTuQgbZWv14xcm70W.6T4cLHSYZ9NOueSe','ariagarcia','Aria Garcia',0,'Customer',NULL,'W','345-678-9012','2024-01-02 16:43:42','2024-01-02 16:43:42',NULL),
(23,'henry.wilson@example.com','$2y$12$dOdxaFYjLXsXKzbXc/Yu7uC9TPH2D6d4WtJM8q19VcocnnS1sozQi','henrywilson','Henry Wilson',0,'Customer',NULL,'P','012-345-6789','2024-01-02 16:45:06','2024-01-02 16:45:06',NULL),
(24,'emma.jackson@example.com','$2y$12$LkTScVtyxEUVo2WVdnhFWe66J8Kw4dQpcWSnezbADzKNYdDmQjp2e','emmajackson','Emma Jackson',0,'Customer',NULL,'W','567-890-1234','2024-01-02 16:45:53','2024-01-02 16:45:53',NULL),
(25,'liam.miller@example.com','$2y$12$HJklDw3rg8SFLq.Uo6KRde9T5qzHYvM2ziAD4KS4sDOFqe8POnRWO','liammiller','Liam Miller',0,'Customer',NULL,'P','789-012-3456','2024-01-02 16:46:50','2024-01-02 16:46:50',NULL),
(26,'olivia.smith@example.com','$2y$12$ApHTCvttnIGO.MdpM6Qvkei9nsupgvG/n0NyRTegZ2H46TVI9G1vi','oliviasmith','Olivia Smith',0,'Customer',NULL,'W','210-987-6543','2024-01-02 16:47:30','2024-01-02 16:47:30',NULL),
(27,'noah.taylor@example.com','$2y$12$Xfrw1z.4pjHxh1.vwLeB4ODgQ8SHYN/4pBsOsT60yvjKkST5cZ5TS','noahtaylor','Noah Taylor',0,'Customer',NULL,'W','432-109-8765','2024-01-02 16:48:13','2024-01-02 16:48:13',NULL),
(28,'ava.johnson@example.com','$2y$12$fPu65YhW16F2PeVjU8pphOK.ggRYiJjsOFVryQ8irpdi8ndCC5kBG','avajohnson','Ava Johnson',0,'Customer',NULL,'W','109-876-5432','2024-01-02 16:49:17','2024-01-02 16:49:17',NULL),
(29,'liam.davis@example.com','$2y$12$d1UBgBEJ/eQ1Sbq8MWISsu19athTu4Ujdf7tglME1QrSz9Eb1HIYe','liamdavis','Liam Davis',0,'Customer',NULL,'P','678-345-0123','2024-01-02 16:50:25','2024-01-02 16:50:25',NULL),
(30,'emma.martinez@example.com','$2y$12$kPwQq69i9GP/v7KjdnksmuTf6UY7mmQGisA6XHcs2JhdE6JvU45bK','emmamartinez','Emma Martinez',0,'Customer',NULL,'W','012-345-6789','2024-01-02 16:51:03','2024-01-02 16:51:03',NULL),
(31,'emma.miller@example.com','$2y$12$mxG.2ZCfTAg25P2nYxFn.uzXOcmGYilQJKLWRu5cRJ2Q1vc6UXeqW','emmamiller','Emma Miller',0,'Customer',NULL,'W','234-567-8901','2024-01-02 16:54:04','2024-01-02 16:54:04',NULL),
(32,'oliver.taylor@example.com','$2y$12$kTTGUwnTGvXn7/twYt7bD.uG9Ns9aaQ8F4hn2G9iphZER5T5eO4za','olivertaylor','Oliver Taylor',0,'Customer',NULL,'W','789-012-3456','2024-01-02 16:54:38','2024-01-02 16:54:38',NULL),
(33,'mia.rodriguez@example.com','$2y$12$2vGxyqsRvzB67RSXc6pwner0i351HzEzy8VX7A68z3Y3fR9n8em0q','miarodriguez','Mia Rodriguez',0,'Customer',NULL,'W','210-987-6543','2024-01-02 16:55:53','2024-01-02 16:55:53',NULL),
(34,'daniel.jones@example.com','$2y$12$8KeOnKCOVywNkJwDXxHYB.gQM2ITZGltp1XDBSR/.dcdcUY0xlMKu','danieljones','Daniel Jones',0,'Customer',NULL,'P','432-109-8765','2024-01-02 16:56:41','2024-01-02 16:56:41',NULL),
(35,'olivia.jackson@example.com','$2y$12$0S88JO7lmNYkuMeBrwLIkuQkL3nUdLZNx4sP.nh4TbSWuSB06IiHO','oliviajackson','Olivia Jackson',0,'Customer',NULL,'W','109-876-5432','2024-01-02 16:57:30','2024-01-02 16:57:30',NULL),
(36,'william.wilson@example.com','$2y$12$t28gMI.0XD/GAAWjpPBW6efbo.K4RLbgve7ylWizk0i6aOU6G9I.2','williamwilson','William Wilson',0,'Customer',NULL,'P','876-543-2109','2024-01-02 16:58:11','2024-01-02 16:58:11',NULL),
(37,'mia.hernandez@example.com','$2y$12$zEy.1U9ct39qgjDxQF7SBuYO8rZ3oRh9RdVl1Ck5qFhMwh3iEQW2.','miahernandez','Mia Hernandez',0,'Customer',NULL,'W','345-678-9012','2024-01-02 16:58:39','2024-01-02 16:58:39',NULL),
(38,'jackson.martin@example.com','$2y$12$pHJPT8HerajdIkiswCd0z.Mbe2j5sJAq8of/8MwixNW/30mNYGhbG','jacksonmartin','Jackson Martin',0,'Customer',NULL,'P','678-345-0123','2024-01-02 16:59:31','2024-01-02 16:59:31',NULL),
(39,'ava.hernandez@example.com','$2y$12$.w5WR/4McUQ9Ea2Y77Oql..BlFV8Pk0xWs.Y.HttrNnLEbHrevqia','avahernandez','Ava Hernandez',0,'Customer',NULL,'W','345-678-9012','2024-01-02 17:00:54','2024-01-02 17:00:54',NULL),
(40,'oliver.martinez@example.com','$2y$12$.BdouEN3HoBVSCCvrRx7kerUE7rCT5F3UJ/SXEE.jppqAkKg6vbWS','olivermartinez','Oliver Martinez',0,'Customer',NULL,'W','012-345-6789','2024-01-02 17:01:27','2024-01-02 17:01:27',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
