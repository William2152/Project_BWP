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
  `product_price` int(11) NOT NULL check(product_price > 0),
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

/*Table structure for table `saldo` */

DROP TABLE IF EXISTS `topup`;

CREATE TABLE `topup` (
  `topup_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL REFERENCES users(user_id),
  `topup_saldo` int(11) NOT NULL check(topup_saldo > 0),
  `topup_status` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`topup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

INSERT INTO `store` (`store_name`, `store_email`, `store_img`, `store_address`, `user_id`, `store_revenue`, `created_at`, `updated_at`, `deleted_at`)
VALUES
  ('Chic Trends', 'chictrends@example.com', 'chic_trends_image.jpg', '123 Fashion Street, Styleville', 8, 3500, '2022-02-01 09:00:00', NULL, NULL),
  ('Gastronomic Delights', 'gastronomicdelights@example.com', 'gastronomic_delights_image.jpg', '456 Culinary Court, Foodland', 9, 5000, '2022-02-02 11:30:00', NULL, NULL),
  ('Innovative Electronics', 'innovativeelectronics@example.com', 'innovative_electronics_image.jpg', '789 Tech Terrace, Technoville', 8, 2000, '2022-02-03 14:45:00', NULL, NULL),
  ('Cozy Book Nook', 'cozybooknook@example.com', 'cozy_book_nook_image.jpg', '567 Literary Lane, Booksville', 10, 8000, '2022-02-04 16:20:00', NULL, NULL),
  ('Sports Haven', 'sportshaven@example.com', 'sports_haven_image.jpg', '234 Active Avenue, Fitness City', 11, 4500, '2022-02-05 10:10:00', NULL, NULL),
  ('Home Decor Hub', 'decorhub@example.com', 'decor_hub_image.jpg', '789 Homestead Street, Decor Town', 12, 6000, '2022-02-06 12:40:00', NULL, NULL),
  ('Pet Paradise', 'petparadise@example.com', 'pet_paradise_image.jpg', '123 Pet Haven, Animal City', 13, 2500, '2022-02-07 14:30:00', NULL, NULL),
  ('Urban Bag Trends', 'urbanbagtrends@example.com', 'tech_galaxy_image.jpg', '456 Urban Lane, Urbancity', 14, 3000, '2022-02-08 18:15:00', NULL, NULL),
  ('Outdoor Adventure Gear', 'outdooradventure@example.com', 'outdoor_adventure_image.jpg', '567 Exploration Street, Adventureland', 15, 8000, '2022-02-09 08:45:00', NULL, NULL),
  ('Vintage Treasures', 'vintagetreasures@example.com', 'vintage_treasures_image.jpg', '890 Retro Road, Nostalgia City', 16, 3500, '2022-02-10 11:20:00', NULL, NULL),
  ('Luxury Living', 'luxuryliving@example.com', 'luxury_living_image.jpg', '123 Opulence Avenue, Elegance Town', 17, 5000, '2022-02-11 13:40:00', NULL, NULL),
  ('Healthy Bites', 'healthybites@example.com', 'healthy_bites_image.jpg', '456 Nutritional Street, Wellness City', 18, 2000, '2022-02-12 15:30:00', NULL, NULL),
  ('Artistic Expressions', 'artisticexpressions@example.com', 'artistic_expressions_image.jpg', '789 Creativity Court, Artland', 19, 8000, '2022-02-13 09:10:00', NULL, NULL),
  ('Fashion Forward', 'fashionforward@example.com', 'fashion_forward_image.jpg', '567 Trendy Terrace, Style City', 20, 4500, '2022-02-14 12:35:00', NULL, NULL),
  ('Culinary Crafts', 'culinarycrafts@example.com', 'culinary_crafts_image.jpg', '234 Culinary Court, Foodville', 21, 6000, '2022-02-15 14:20:00', NULL, NULL),
  ('Digital Dreams', 'digitaldreams@example.com', 'digital_dreams_image.jpg', '789 Tech Terrace, Technoville', 22, 2500, '2022-02-16 16:45:00', NULL, NULL),
  ('Cozy Corner Bookstore', 'cozycorner@example.com', 'cozy_corner_bookstore_image.jpg', '567 Literary Lane, Booksville', 23, 3000, '2022-02-17 10:30:00', NULL, NULL),
  ('Spirited Sports', 'spiritedsports@example.com', 'spirited_sports_image.jpg', '123 Active Avenue, Fitness City', 24, 8000, '2022-02-18 12:15:00', NULL, NULL),
  ('Elegant Homeware', 'eleganthomeware@example.com', 'elegant_homeware_image.jpg', '456 Homestead Street, Decor Town', 25, 3500, '2022-02-19 14:30:00', NULL, NULL),
  ('Pet Palace', 'petpalace@example.com', 'pet_palace_image.jpg', '789 Pet Haven, Animal City', 26, 5000, '2022-02-20 16:20:00', NULL, NULL),
  ('Tech Trends', 'techtrends@example.com', 'tech_trends_image.jpg', '234 Innovation Lane, Technocity', 27, 2000, '2022-02-21 11:45:00', NULL, NULL),
  ('Outdoor Oasis', 'outdooroasis@example.com', 'outdoor_oasis_image.jpg', '567 Exploration Street, Adventureland', 28, 4500, '2022-02-22 14:30:00', NULL, NULL),
  ('Vintage Values', 'vintagevalues@example.com', 'vintage_values_image.jpg', '890 Retro Road, Nostalgia City', 29, 6000, '2022-02-23 17:00:00', NULL, NULL),
  ('Luxe Living', 'luxeliving@example.com', 'luxe_living_image.jpg', '123 Opulence Avenue, Elegance Town', 30, 2500, '2022-02-24 09:30:00', NULL, NULL),
  ('Healthy Hub', 'healthyhub@example.com', 'healthy_hub_image.jpg', '456 Nutritional Street, Wellness City', 31, 3000, '2022-02-25 12:15:00', NULL, NULL),
  ('Artistic Inspirations', 'artisticinspirations@example.com', 'artistic_inspirations_image.jpg', '789 Creativity Court, Artland', 32, 8000, '2022-02-26 14:45:00', NULL, NULL),
  ('Chic Couture', 'chiccouture@example.com', 'chic_couture_image.jpg', '567 Trendy Terrace, Style City', 33, 4500, '2022-02-27 17:30:00', NULL, NULL),
  ('Culinary Creations', 'culinarycreations@example.com', 'culinary_creations_image.jpg', '234 Culinary Court, Foodville', 34, 6000, '2022-02-28 09:45:00', NULL, NULL),
  ('GreenThumb Garden Supplies', 'greenthumbgardensupplies@example.com', 'culinary_creations_image.jpg', '234 garden Court, Gardenville', 35, 6600, '2022-02-28 09:45:00', NULL, NULL),
  ('Footwear Haven', 'footwearhaven@example.com', 'culinary_creations_image.jpg', '234 foot Court, Footville', 36, 6900, '2022-02-28 09:45:00', NULL, NULL),
  ('Ella Fashion Store', 'ellasfashion@example.com', 'https://i.pinimg.com/474x/ec/0d/31/ec0d31d5c31b84f10072ab90dbde9934.jpg', '234 Fashion Show street, Sydney', 7, 0, '2024-01-04 07:04:20', '2024-01-04 07:36:48', NULL)
  ;

INSERT INTO `category` (`category_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
  ('electronic', '2022-01-01 08:00:00', NULL, NULL),
  ('clothes', '2022-01-01 08:00:00', NULL, NULL),
  ('jewelry', '2022-01-01 08:00:00', NULL, NULL),
  ('medicine', '2022-01-01 08:00:00', NULL, NULL),
  ('shoes', '2022-01-01 08:00:00', NULL, NULL),
  ('bag', '2022-01-01 08:00:00', NULL, NULL),
  ('book', '2022-01-01 08:00:00', NULL, NULL),
  ('cook', '2022-01-01 08:00:00', NULL, NULL),
  ('toys', '2022-01-01 08:00:00', NULL, NULL),
  ('sport', '2022-01-01 08:00:00', NULL, NULL),
  ('pediatric', '2022-01-01 08:00:00', NULL, NULL),
  ('headphone', '2022-01-01 08:00:00', NULL, NULL),
  ('phone', '2022-01-01 08:00:00', NULL, NULL),
  ('art', '2022-01-01 08:00:00', NULL, NULL),
  ('food', '2022-01-01 08:00:00', NULL, NULL),
  ('keyboard', '2022-01-01 08:00:00', NULL, NULL),
  ('pets', '2022-01-01 08:00:00', NULL, NULL),
  ('garden', '2022-01-01 08:00:00', NULL, NULL),
  ('furniture', '2022-01-01 08:00:00', NULL, NULL);


-- insert buat product data

INSERT INTO product (product_name, product_img, product_detail, product_price, product_stock, category_id, store_id, created_at, updated_at, deleted_at)
VALUES
('Laptop ASUS XYZ', 'https://i.pinimg.com/564x/59/a8/bb/59a8bba433ff9d5905700c1759c2396f.jpg', 'High-performance laptop with Intel Core i7 processor', 1200, 50, 1, 3, '2024-01-03 12:00:00', NULL, NULL),
('Smart TV Samsung 55"', 'https://i.pinimg.com/564x/e5/fe/f8/e5fef8d8aef1354b9ed9b023c3cab25b.jpg', '4K Ultra HD resolution, Smart features', 800, 30, 1, 3, '2024-01-03 12:05:00', NULL, NULL),
('Smartphone Galaxy S21', 'https://i.pinimg.com/564x/43/ca/92/43ca92fda4ce2635e897ef27c65cb592.jpg','Ultra HD smartphone with Great Features' , 900, 100, 1, 3, '2024-01-03 12:10:00', NULL, NULL),
('Wireless Headphones Baseus', 'https://i.pinimg.com/564x/89/b3/07/89b3075b58ede531493806050bb433cc.jpg', 'Noise-canceling, Bluetooth connectivity', 150, 80, 1, 3, '2024-01-03 12:15:00', NULL, NULL),
('Gaming PC AMD Ryzen', 'https://i.pinimg.com/736x/37/46/5e/37465e0768b74b36062b595f58e007de.jpg', 'High-end gaming PC with AMD Ryzen processor', 2000, 20, 1, 3, '2024-01-03 12:20:00', NULL, NULL),
('Soundbar Sony', 'https://i.pinimg.com/564x/6c/5c/e1/6c5ce1f86101721aff75c415a2ff17a1.jpg', 'Dolby Atmos support, Wireless subwoofer', 300, 40, 1, 3, '2024-01-03 12:25:00', NULL, NULL),
('Digital Camera Nikon', 'https://i.pinimg.com/564x/2b/2d/b4/2b2db471d0fa987ede58c09dece5e0ef.jpg', '24MP sensor, 4K video recording', 700, 15, 1, 3, '2024-01-03 12:30:00', NULL, NULL),
('Home Theater System', 'https://i.pinimg.com/736x/b1/01/43/b1014326f211187c667784a7534287b9.jpg', '5.1 surround sound, Blu-ray player', 500, 25, 1, 3, '2024-01-03 12:35:00', NULL, NULL),
('Smart Watch Fitbit', 'https://i.pinimg.com/564x/30/57/b1/3057b1b3ab7cef512d9169844695e8ba.jpg', 'Fitness tracking, Heart rate monitor', 120, 60, 1, 3, '2024-01-03 12:40:00', NULL, NULL),
('Portable Bluetooth Speaker', 'https://i.pinimg.com/564x/bd/ab/c4/bdabc47e32d0770253c1899894e30648.jpg', 'Waterproof, 10 hours battery life', 50, 70, 1, 3, '2024-01-03 12:45:00', NULL, NULL),
('4K Action Camera GoPro', 'https://i.pinimg.com/564x/c2/33/20/c23320eaae9eb0c9b6738e4c23701427.jpg', 'Waterproof, Wide-angle lens', 300, 10, 1, 3, '2024-01-03 12:50:00', NULL, NULL),
('Electric Toothbrush', 'https://i.pinimg.com/564x/d3/b1/ea/d3b1ea6524572c79c3dc85dc565b8905.jpg', 'Sonic cleaning technology', 80, 50, 1, 3, '2024-01-03 12:55:00', NULL, NULL),
('Wireless Mouse Logitech', 'https://i.pinimg.com/736x/15/7b/30/157b3009d15daf34de312cf8e6555c79.jpg', 'Ergonomic design, Long battery life', 30, 90, 1, 3, '2024-01-03 13:00:00', NULL, NULL),
('32-inch Monitor', 'https://i.pinimg.com/564x/36/c7/83/36c78383a3a87041b03dae53bdeec872.jpg', 'Full HD resolution, IPS panel', 250, 35, 1, 3, '2024-01-03 13:05:00', NULL, NULL),
('External SSD 1TB San Disk', 'https://i.pinimg.com/564x/b1/5b/f9/b15bf9a6188edf47e5cfe0b116d195ef.jpg', 'High-speed data transfer, USB-C', 180, 55, 1, 3, '2024-01-03 13:10:00', NULL, NULL),
('Men Casual T-Shirt', 'https://i.pinimg.com/736x/e3/c3/54/e3c3540d20e5f781afd45060cadcfb59.jpg', 'Comfortable cotton t-shirt for casual wear', 20, 100, 2, 1, '2024-01-03 14:00:00', NULL, NULL),
('Women Skinny Jeans', 'https://i.pinimg.com/564x/22/a9/40/22a94034f5ebcdecfdf0e4c7e81d09fd.jpg', 'Stylish and slim-fit denim jeans for women', 40, 80, 2, 1, '2024-01-03 14:05:00', NULL, NULL),
('Men Hooded Sweatshirt', 'https://i.pinimg.com/564x/4f/d9/8f/4fd98f3292d82f024ca17bea3efd7a63.jpg', 'Warm and cozy hooded sweatshirt for men', 35, 70, 2, 1, '2024-01-03 14:10:00', NULL, NULL),
('Women Floral Dress', 'https://i.pinimg.com/736x/88/8f/b7/888fb7e49deded245d36f8f4f393cd4f.jpg', 'Elegant floral pattern dress for women', 55, 60, 2, 1, '2024-01-03 14:15:00', NULL, NULL),
('Men Formal Shirt', 'https://i.pinimg.com/564x/cd/a2/4a/cda24a9da43f3723ed4cfe55434faeba.jpg', 'Classic formal shirt for men', 30, 90, 2, 1, '2024-01-03 14:20:00', NULL, NULL),
('Women Active Leggings', 'https://i.pinimg.com/564x/96/6b/56/966b56ad568f41f1a9f0bd358294fdc7.jpg', 'Stretchable and comfortable leggings for women', 25, 110, 2, 1, '2024-01-03 14:25:00', NULL, NULL),
('Men Denim Jacket', 'https://i.pinimg.com/564x/ab/f6/b1/abf6b13a69580174e63281c6432f8176.jpg', 'Stylish denim jacket for men', 60, 50, 2, 1, '2024-01-03 14:30:00', NULL, NULL),
('Women Cardigan Sweater', 'https://i.pinimg.com/564x/7d/b5/e8/7db5e8a7bf38ba8bdc424661510bbf01.jpg', 'Cozy and fashionable cardigan sweater for women', 45, 75, 2, 1, '2024-01-03 14:35:00', NULL, NULL),
('Men Jogger Pants', 'https://i.pinimg.com/564x/29/90/76/2990764bab606cbde6f53e44cea3b74f.jpg', 'Comfortable jogger pants for men', 30, 85, 2, 1, '2024-01-03 14:40:00', NULL, NULL),
('Women Puffer Jacket', 'https://i.pinimg.com/564x/69/19/8d/69198da3b16e8b6ea022544dfd517085.jpg', 'Warm and stylish puffer jacket for women', 75, 40, 2, 1, '2024-01-03 14:45:00', NULL, NULL),
('Gold Pendant Necklace', 'https://i.pinimg.com/736x/5b/da/eb/5bdaeb150ae103c35d6c40fd49178662.jpg', 'Elegant gold pendant necklace for a classic look', 150, 30, 3, 10, '2024-01-03 15:00:00', NULL, NULL),
('Diamond Stud Earrings', 'https://i.pinimg.com/736x/67/35/b1/6735b13f39497a3c9526c0f154c922cb.jpg', 'Sparkling diamond stud earrings for a glamorous touch', 200, 20, 3, 10, '2024-01-03 15:05:00', NULL, NULL),
('Silver Bracelet', 'https://i.pinimg.com/564x/c0/ea/c7/c0eac713ca41c32e1ed1dd4989d00d5f.jpg', 'Stylish silver bracelet for a modern and trendy look', 80, 50, 3, 10, '2024-01-03 15:10:00', NULL, NULL),
('Pearl Drop Earrings', 'https://i.pinimg.com/564x/68/79/c4/6879c48e924f92205de153caf6822515.jpg', 'Timeless pearl drop earrings for a classic and elegant style', 120, 40, 3, 10, '2024-01-03 15:15:00', NULL, NULL),
('Gemstone Ring', 'https://i.pinimg.com/564x/42/8d/c1/428dc19990bd98d0c6bd255d27942b26.jpg', 'Colorful gemstone ring for a vibrant and unique appearance', 100, 35, 3, 10, '2024-01-03 15:20:00', NULL, NULL),
('Rose Gold Bangle', 'https://i.pinimg.com/736x/f2/ab/c7/f2abc71884914d6818814eec77ef5e50.jpg', 'Chic rose gold bangle for a feminine touch', 90, 45, 3, 10, '2024-01-03 15:25:00', NULL, NULL),
('Emerald Necklace', 'https://i.pinimg.com/564x/01/17/8e/01178ebccf8c9edf1c5ee65561e7827a.jpg', 'Striking emerald necklace for a touch of luxury', 180, 25, 3, 10, '2024-01-03 15:30:00', NULL, NULL),
('Sapphire Tennis Bracelet', 'https://i.pinimg.com/736x/1d/11/41/1d1141791d29b7a8b6bd90668b140450.jpg', 'Exquisite sapphire tennis bracelet for a refined look', 250, 15, 3, 10, '2024-01-03 15:35:00', NULL, NULL),
('Diamond Solitaire Ring', 'https://i.pinimg.com/736x/55/57/a8/5557a8472592b780ae6b7c2f7c53bd71.jpg', 'Classic diamond solitaire ring for a timeless appeal', 300, 10, 3, 10, '2024-01-03 15:40:00', NULL, NULL),
('Citrine Stud Earrings', 'https://i.pinimg.com/564x/cb/20/d5/cb20d528c979373fbd78da60e88da336.jpg', 'Radiant citrine stud earrings for a vibrant and warm style', 120, 30, 3, 10, '2024-01-03 15:45:00', NULL, NULL),
('Aspirin Tablets Geri Care', 'https://i.pinimg.com/564x/da/cb/b2/dacbb21efdd9168e794ab91b2de50b77.jpg', 'Pain reliever and fever reducer', 10, 100, 4, 12, '2024-01-03 16:00:00', NULL, NULL),
('Ibuprofen Capsules A+ Health', 'https://i.pinimg.com/564x/0b/80/0c/0b800c8bbb36afbfbe4baeab3eecc4e8.jpg', 'Nonsteroidal anti-inflammatory drug (NSAID)', 15, 80, 4, 12, '2024-01-03 16:05:00', NULL, NULL),
('Antacid Chewable Tablets Equate', 'https://i.pinimg.com/564x/f4/2a/aa/f42aaa2b2493bc530a9b3e76ec7d41b0.jpg', 'Relieves heartburn and indigestion', 8, 120, 4, 12, '2024-01-03 16:10:00', NULL, NULL),
('Cough Syrup No Cough', 'https://i.pinimg.com/564x/fe/dc/c0/fedcc02a41dc0badb1e6e2d81fe55d30.jpg', 'Relieves cough and cold symptoms', 12, 90, 4, 12, '2024-01-03 16:15:00', NULL, NULL),
('Allergy Relief Tablets Hylands', 'https://i.pinimg.com/564x/b7/43/94/b74394549b4634396daa5c3dd1d225c9.jpg', 'Antihistamine for allergy relief', 20, 60, 4, 12, '2024-01-03 16:20:00', NULL, NULL),
('Vitamin C Supplement Natural Made', 'https://i.pinimg.com/564x/d7/26/86/d72686e2dc3691fe28de9cf7fbd8bce4.jpg', 'Boosts immune system and supports overall health', 18, 70, 4, 12, '2024-01-03 16:25:00', NULL, NULL),
('Pain Relief Cream', 'https://i.pinimg.com/564x/05/89/03/058903d725809fc720037be832631dcb.jpg', 'Topical analgesic for localized pain relief', 25, 40, 4, 12, '2024-01-03 16:30:00', NULL, NULL),
('Sleep Aid Tablets Basic Care', 'https://www.gosupps.com/media/catalog/product/6/1/61IR8K0uRAL_2.jpg', 'Helps promote restful sleep', 30, 50, 4, 12, '2024-01-03 16:35:00', NULL, NULL),
('Antibacterial Hand Sanitizer', 'https://i.pinimg.com/564x/17/b0/33/17b03361fa43491d667499698988a874.jpg', 'Kills germs and bacteria without water', 8, 110, 4, 12, '2024-01-03 16:40:00', NULL, NULL),
('Digestive Enzyme Supplement Webber Naturals', 'https://i.pinimg.com/564x/78/b5/56/78b55603da814af8a87db7ed2765e1d8.jpg', 'Aids in digestion and nutrient absorption', 22, 30, 4, 12, '2024-01-03 16:45:00', NULL, NULL)
;

-- shoes
INSERT INTO `product` (`product_name`, `product_img`, `product_detail`, `product_price`, `product_stock`, `category_id`, `store_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Running Shoes - Men', 'https://i.pinimg.com/736x/29/70/9d/29709ded93d15c472d75d18bcd94dbe4.jpg', 'Comfortable and lightweight running shoes for men.', 75, 50, 5, 30, current_timestamp(), NULL, NULL),
('High Heels - Women', 'https://i.pinimg.com/736x/4e/a6/6e/4ea66e52239d6bc956b0e08ec2655ad5.jpg', 'Elegant high heels for women.', 90, 30, 5, 30, current_timestamp(), NULL, NULL),
('Sneakers - Unisex', 'https://i.pinimg.com/564x/5a/ce/e7/5acee7b0a54f5c0fef6d1ab05b64f7ea.jpg', 'Versatile sneakers suitable for both men and women.', 60, 40, 5, 30, current_timestamp(), NULL, NULL),
('Casual Loafers - Men', 'https://i.pinimg.com/736x/1f/59/7f/1f597fae6446ccea15c7bb3f1642d4f8.jpg', 'Stylish and comfortable loafers for men.', 70, 45, 5, 30, current_timestamp(), NULL, NULL),
('Ankle Boots - Women', 'https://i.pinimg.com/564x/43/cc/cf/43cccf4c47f3cd8d3e17affbf06cfc75.jpg', 'Fashionable ankle boots for women.', 85, 25, 5, 30, current_timestamp(), NULL, NULL),
('Skateboard Shoes - Unisex', 'https://i.pinimg.com/564x/ea/a9/73/eaa973a459a57d31e6e13be643ebb906.jpg', 'Durable shoes designed for skateboarding.', 55, 35, 5, 30, current_timestamp(), NULL, NULL),
('Formal Oxfords - Men', 'https://i.pinimg.com/564x/f9/bb/fb/f9bbfb68633e911b2814c247b0ed8aad.jpg', 'Classic formal oxfords for men.', 80, 20, 5, 30, current_timestamp(), NULL, NULL),
('Sandals - Women', 'https://i.pinimg.com/736x/76/66/51/7666514fa55c1ab48eb1cc035f0bce57.jpg', 'Comfortable and stylish sandals for women.', 40, 60, 5, 30, current_timestamp(), NULL, NULL),
('Basketball Sneakers - Unisex', 'https://i.pinimg.com/736x/3b/c1/9b/3bc19b28d66185e01b05349299c56903.jpg', 'Performance sneakers for basketball enthusiasts.', 95, 15, 5, 30, current_timestamp(), NULL, NULL),
('Slip-On Shoes - Unisex', 'https://i.pinimg.com/564x/a7/05/66/a70566e1c08aeedfc0d292b4b66d626a.jpg', 'Convenient and easy-to-wear slip-on shoes for both men and women.', 50, 50, 5, 30, current_timestamp(), NULL, NULL);

-- bag
INSERT INTO `product` (`product_name`, `product_img`, `product_detail`, `product_price`, `product_stock`, `category_id`, `store_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Leather Tote Bag', 'https://i.pinimg.com/564x/71/74/6c/71746cf5a3d81bf0633e2ec7e8105cd0.jpg', 'Stylish and spacious leather tote bag.', 120, 30, 6, 8, current_timestamp(), NULL, NULL),
('Canvas Backpack', 'https://i.pinimg.com/564x/1e/4a/69/1e4a69d791646eec6b76608e019c5ec4.jpg', 'Durable and versatile canvas backpack.', 60, 50, 6, 8, current_timestamp(), NULL, NULL),
('Designer Handbag', 'https://i.pinimg.com/564x/e6/4f/18/e64f18b0f074780b0a67b092d789a01a.jpg', 'Luxurious designer handbag for special occasions.', 250, 15, 6, 8, current_timestamp(), NULL, NULL),
('Crossbody Sling Bag', 'https://i.pinimg.com/736x/02/2a/b8/022ab88ce21c8ef224584600bf21239c.jpg', 'Compact and comfortable crossbody sling bag.', 80, 40, 6, 8, current_timestamp(), NULL, NULL),
('Travel Duffel Bag', 'https://i.pinimg.com/564x/1d/4a/3e/1d4a3e46bc667a2168bd2e245f6b9600.jpg', 'Spacious and durable travel duffel bag.', 100, 25, 6, 8, current_timestamp(), NULL, NULL),
('Clutch Purse', 'https://i.pinimg.com/564x/64/8d/80/648d8049d33329fb2a08bcee8c112f4b.jpg', 'Elegant and compact clutch purse for evening events.', 50, 35, 6, 8, current_timestamp(), NULL, NULL),
('Weekender Trolley', 'https://i.pinimg.com/564x/03/73/23/03732309214e9dcf695ee80e9b4a04b4.jpg', 'Rolling weekender trolley for travel convenience.', 150, 20, 6, 8, current_timestamp(), NULL, NULL),
('Fashionable Hobo Bag', 'https://i.pinimg.com/564x/f4/ff/b7/f4ffb72d8696370901cd6ca2c775b84d.jpg', 'Trendy and spacious hobo bag for everyday use.', 90, 45, 6, 8, current_timestamp(), NULL, NULL),
('Classic Shoulder Bag', 'https://i.pinimg.com/736x/51/a2/8b/51a28b742a037cb3e567cbaa039caa45.jpg', 'Timeless and versatile shoulder bag for any occasion.', 70, 40, 6, 8, current_timestamp(), NULL, NULL),
('Sporty Waist Pack', 'https://i.pinimg.com/564x/4b/36/07/4b360756d9e6a809b6a9106c9658bfc1.jpg', 'Compact and sporty waist pack for on-the-go activities.', 40, 60, 6, 8, current_timestamp(), NULL, NULL);

-- book
INSERT INTO `product` (`product_name`, `product_img`, `product_detail`, `product_price`, `product_stock`, `category_id`, `store_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('The Great Gatsby', 'https://i.pinimg.com/564x/74/05/51/740551c3cec86af92fb97ffcf78404cf.jpg', 'Classic novel by F. Scott Fitzgerald.', 15, 50, 7, 4, current_timestamp(), NULL, NULL),
('Educated: A Memoir', 'https://i.pinimg.com/736x/00/0c/4a/000c4ad73f0f7930c1240dba7f2f50d0.jpg', 'Memoir by Tara Westover about her quest for knowledge.', 20, 40, 7, 4, current_timestamp(), NULL, NULL),
('Sapiens: A Brief History of Humankind', 'https://i.pinimg.com/564x/3d/cb/f1/3dcbf106135ea84b56ec9079197d8ef4.jpg', 'Historical exploration by Yuval Noah Harari.', 25, 35, 7, 4, current_timestamp(), NULL, NULL),
('The Silent Patient', 'https://i.pinimg.com/564x/c5/85/ce/c585ce0ea039b1e689f5744045099974.jpg', 'Psychological thriller by Alex Michaelides.', 18, 45, 7, 4, current_timestamp(), NULL, NULL),
('Atomic Habits', 'https://i.pinimg.com/564x/d5/d4/da/d5d4da1ae3925d6151acdf6e0458f3b0.jpg', 'Self-help book on building good habits by James Clear.', 30, 30, 7, 4, current_timestamp(), NULL, NULL),
('To Kill a Mockingbird', 'https://i.pinimg.com/736x/d6/66/5f/d6665f5f592fe6f1442c2123a5f45902.jpg', 'Classic novel by Harper Lee addressing racial injustice.', 16, 55, 7, 4, current_timestamp(), NULL, NULL),
('The Alchemist', 'https://i.pinimg.com/736x/05/0d/8c/050d8c9d7be040c067bd8e54f6f60cea.jpg', 'Philosophical novel by Paulo Coelho.', 22, 25, 7, 4, current_timestamp(), NULL, NULL),
('Becoming', 'https://i.pinimg.com/736x/92/16/37/921637f51d3277cd154db14f27965970.jpg', 'Memoir by Michelle Obama, former First Lady of the United States.', 28, 20, 7, 4, current_timestamp(), NULL, NULL),
('The Hobbit', 'https://i.pinimg.com/736x/b3/da/6c/b3da6c61f387e12ada45eb885552f00d.jpg', 'Fantasy novel by J.R.R. Tolkien.', 14, 60, 7, 4, current_timestamp(), NULL, NULL),
('The Girl on the Train', 'https://i.pinimg.com/736x/40/a9/28/40a928fd94976858d0af49e6ad3bbd3a.jpg', 'Mystery thriller by Paula Hawkins.', 24, 15, 7, 4, current_timestamp(), NULL, NULL)
;


-- cook

-- toys

-- sport

-- pediatric

-- headphone

-- phone

-- art

-- food 

-- keyboard

-- pets
INSERT INTO `product` (`product_name`, `product_img`, `product_detail`, `product_price`, `product_stock`, `category_id`, `store_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Pet Food - Premium Mix', 'https://i.pinimg.com/564x/1a/a2/c3/1aa2c36fc739c273196db7b531ab66b9.jpg', 'Nutrient-rich premium pet food mix.', 30, 50, 18, 7, current_timestamp(), NULL, NULL),
('Dog Leash with Reflectors', 'https://i.pinimg.com/564x/fc/d9/69/fcd969027a672661f920c4df3b6a05ae.jpg', 'Durable leash with reflective strips for safety.', 15, 40, 18, 7, current_timestamp(), NULL, NULL),
('Cat Scratching Post', 'https://i.pinimg.com/564x/b2/93/28/b29328ff2b891fcc50ddec074f369f87.jpg', 'Interactive scratching post for cats.', 20, 30, 18, 7, current_timestamp(), NULL, NULL),
('Aquarium Starter Kit', 'https://i.pinimg.com/564x/71/fc/f8/71fcf834d72131b64278dd1214d4d752.jpg', 'Complete kit for starting your aquarium.', 50, 20, 18, 7, current_timestamp(), NULL, NULL),
('Small Animal Cage', 'https://i.pinimg.com/564x/27/20/e7/2720e761962e40a2cfb130fa455f7577.jpg', 'Spacious cage for small pets like hamsters.', 25, 25, 18, 7, current_timestamp(), NULL, NULL),
('Bird Cage with Perch', 'https://i.pinimg.com/564x/86/d2/63/86d2631e2dbcaf92dfb2eff6dd787254.jpg', 'Comfortable cage with perch for birds.', 35, 15, 18, 7, current_timestamp(), NULL, NULL),
('Pet Grooming Kit', 'https://i.pinimg.com/564x/15/6b/ce/156bce1ab86ca4f4acba292baf52fb89.jpg', 'Complete grooming kit for dogs and cats.', 40, 20, 18, 7, current_timestamp(), NULL, NULL),
('Reptile Heating Lamp', 'https://i.pinimg.com/564x/cb/ed/7c/cbed7cb913a598d0a3cdb2248927eb61.jpg', 'Heat lamp for reptile terrariums.', 18, 30, 18, 7, current_timestamp(), NULL, NULL),
('Fish Tank Decorations', 'https://i.pinimg.com/564x/a1/67/9f/a1679f39859dd3bcfc7a3a2ccbf90296.jpg', 'Colorful decorations for your fish tank.', 12, 40, 18, 7, current_timestamp(), NULL, NULL),
('Pet Travel Carrier', 'https://i.pinimg.com/736x/93/52/14/9352140c60e529721a55a4a6f0a48b45.jpg', 'Portable carrier for pets on the go.', 35, 10, 18, 7, current_timestamp(), NULL, NULL);

-- gardening
INSERT INTO `product` (`product_name`, `product_img`, `product_detail`, `product_price`, `product_stock`, `category_id`, `store_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Gardening Tool Set', 'https://i.pinimg.com/736x/8b/62/29/8b6229f2a569a323ffe41e7e5293d4a6.jpg', 'Complete set for your gardening needs.', 29, 50, 19, 29, current_timestamp(), NULL, NULL),
('Floral Pruning Shears', 'https://i.pinimg.com/564x/c8/56/27/c856279b5f7fd76b3076866615db4fe9.jpg', 'High-quality shears for precise pruning.', 15, 30, 19, 29, current_timestamp(), NULL, NULL),
('Decorative Flower Pots', 'https://i.pinimg.com/564x/72/8e/a2/728ea2a5a01db5bdf44c9383b461a65b.jpg', 'Colorful pots to enhance your garden.', 12, 100, 19, 29, current_timestamp(), NULL, NULL),
('Garden Soil Fertilizer', 'https://i.pinimg.com/564x/ee/30/fa/ee30fa2b46a1007ae5dc21dfd41489c2.jpg', 'Enriched fertilizer for healthy plants.', 20, 40, 19, 29, current_timestamp(), NULL, NULL),
('LED Solar Garden Lights', 'https://i.pinimg.com/564x/8c/37/a0/8c37a03926b4ec9f80596d584ec7578e.jpg', 'Energy-efficient lights for your garden.', 35, 25, 19, 29, current_timestamp(), NULL, NULL),
('Garden Hose with Nozzle', 'https://i.pinimg.com/564x/a6/aa/7c/a6aa7c6c83bfd56486bc97d8874f96d2.jpg', 'Durable hose with adjustable nozzle.', 18, 60, 19, 29, current_timestamp(), NULL, NULL),
('Rustic Wooden Plant Stand', 'https://i.pinimg.com/564x/49/1e/f4/491ef42132e41ec53bf3f37896912657.jpg', 'Elevate your plants with this stylish stand.', 25, 20, 19, 29, current_timestamp(), NULL, NULL),
('Garden Gloves with Grips', 'https://i.pinimg.com/564x/8b/30/5b/8b305b38a766edafdcef34018194aa1d.jpg', 'Comfortable gloves with non-slip grips.', 10, 75, 19, 29, current_timestamp(), NULL, NULL),
('Garden Kneeler and Seat', 'https://i.pinimg.com/564x/bb/fa/72/bbfa728c29de03e879112c269f58992e.jpg', 'Convenient kneeler for comfortable gardening.', 30, 15, 19, 29, current_timestamp(), NULL, NULL),
('Hanging Flower Basket', 'https://i.pinimg.com/564x/cb/57/13/cb5713fdf1404ae8406c64514ce58071.jpg', 'Attractive baskets for hanging plants.', 22, 35, 19, 29, current_timestamp(), NULL, NULL);

-- furniture
INSERT INTO `product` (`product_name`, `product_img`, `product_detail`, `product_price`, `product_stock`, `category_id`, `store_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Wooden Dining Table', 'https://i.pinimg.com/564x/28/6c/31/286c3172c5ecaef8bdb74a970b477239.jpg', 'Solid wood dining table with elegant design.', 250, 15, 19, 6, current_timestamp(), NULL, NULL),
('Leather Sofa Set', 'https://i.pinimg.com/564x/fe/22/ae/fe22ae1581157504dee9a280c9252d73.jpg', 'Luxurious leather sofa set for your living room.', 600, 8, 19, 6, current_timestamp(), NULL, NULL),
('Modern Coffee Table', 'https://i.pinimg.com/564x/51/06/59/51065945203dcaed51eedc02e606ad7b.jpg', 'Sleek and stylish coffee table for your lounge.', 120, 20, 19, 6, current_timestamp(), NULL, NULL),
('Wardrobe with Mirror', 'https://i.pinimg.com/564x/b5/e1/86/b5e1869fe7281e4d119197753a784043.jpg', 'Spacious wardrobe with full-length mirror.', 350, 10, 19, 6, current_timestamp(), NULL, NULL),
('Bedroom Dresser', 'https://i.pinimg.com/564x/bb/f2/4f/bbf24f0b58fc6cf48a7c8b14f1fd6db0.jpg', 'Elegant dresser for your bedroom storage needs.', 180, 18, 19, 6, current_timestamp(), NULL, NULL),
('L-shaped Office Desk', 'https://i.pinimg.com/736x/93/3f/f8/933ff80ef94a406b97928369e3b41b57.jpg', 'Functional L-shaped desk for your home office.', 280, 12, 19, 6, current_timestamp(), NULL, NULL),
('Bookshelf with Cabinets', 'https://i.pinimg.com/564x/04/26/b8/0426b8c1c4deff1df18ecfa3ca93afda.jpg', 'Versatile bookshelf with additional storage cabinets.', 150, 25, 19, 6, current_timestamp(), NULL, NULL),
('Recliner Lounge Chair', 'https://i.pinimg.com/736x/ae/3b/da/ae3bda54d4e9d24fba0d3323a9b54cc4.jpg', 'Comfortable recliner chair for relaxation.', 200, 10, 19, 6, current_timestamp(), NULL, NULL),
('Outdoor Patio Set', 'https://i.pinimg.com/564x/ee/cc/5a/eecc5a84b3314af41e7b6f9219eccf27.jpg', 'Weather-resistant patio furniture set.', 450, 6, 19, 6, current_timestamp(), NULL, NULL),
('Ergonomic Office Chair', 'https://i.pinimg.com/736x/ea/5f/4e/ea5f4e02ad11234e2c328f51da9b20a1.jpg', 'Adjustable and supportive office chair.', 120, 15, 19, 6, current_timestamp(), NULL, NULL),

('Elegant Dark Purple Dress Size L', 'https://i.pinimg.com/474x/b8/a9/0a/b8a90ae51fa3eeedb8d9942239270548.jpg', 'Elegant Dark Purple Dress, Size : L, Material : Silk', 2000000, 4, 2, 31, '2024-01-04 08:13:11', NULL, NULL),
('Red White Dress Size M', 'https://i.pinimg.com/474x/06/13/ff/0613ffa2fc99e6e7ba59945b2e54e089.jpg', 'In good conditions, for cosplay', 1500000, 1, 2, 31, '2024-01-04 08:32:29', NULL, NULL),
('Floral Red Elegant Dress Size M', 'https://i.pinimg.com/474x/05/80/d7/0580d7fe79c690fc768c69162dfffdb8.jpg', 'Magnificent Beautiful Floral Red Dress, Size M, Material Silk', 3000000, 2, 2, 31, '2024-01-04 08:49:01', NULL, NULL)
;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
