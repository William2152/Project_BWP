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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_kastore` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

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
  `order_product_review` text null DEFAULT NULL,
  `order_product_rating` int(11) null DEFAULT NULL,
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
  `order_status` int(2) not null,
  `order_destination` text not null,
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
  `product_avg_rating` decimal null DEFAULT NULL,
  `product_jumlah_avg_data` int null DEFAULT NULL,
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
  `store_img` text NOT NULL,
  `store_address` text not null,
  `user_id` int(11) NOT NULL,
  `store_revenue` int(11) NOT NULL DEFAULT 0,
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
  `user_img` text NULL,
  `user_gender` varchar(5) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





/*Data for the table `users` */

insert  into `users`(`user_id`,`user_email`,`user_password`,`user_name`,`user_nama`,`user_money`,`user_role`,`user_img`,`user_gender`,`user_phone`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'admin@gmail.com','$2y$12$PTi99ULbUknumwIAiKb47.GblGx9YQrqMVM0GkZ.r1flE9fctrBAi','admin','Admin',0,'Admin',NULL,'P','0223421244','2023-12-28 14:20:29','2023-12-28 14:20:29',NULL);

INSERT INTO `store` (`store_name`, `store_email`, `store_img`, `store_address`, `user_id`, `store_revenue`, `created_at`, `updated_at`, `deleted_at`)
VALUES
  ('Chic Trends', 'chictrends@example.com', 'chic_trends_image.jpg', '123 Fashion Street, Styleville', 8, 3500, '2022-02-01 09:00:00', NULL, NULL),
  ('Gastronomic Delights', 'gastronomicdelights@example.com', 'gastronomic_delights_image.jpg', '456 Culinary Court, Foodland', 9, 5000, '2022-02-02 11:30:00', NULL, NULL),
  ('Innovative Electronics', 'innovativeelectronics@example.com', 'innovative_electronics_image.jpg', '789 Tech Terrace, Technoville', 8, 2000, '2022-02-03 14:45:00', NULL, NULL),
  ('Cozy Book Nook', 'cozybooknook@example.com', 'cozy_book_nook_image.jpg', '567 Literary Lane, Booksville', 10, 8000, '2022-02-04 16:20:00', NULL, NULL),
  ('Sports Haven', 'sportshaven@example.com', 'sports_haven_image.jpg', '234 Active Avenue, Fitness City', 11, 4500, '2022-02-05 10:10:00', NULL, NULL),
  ('Home Decor Hub', 'decorhub@example.com', 'decor_hub_image.jpg', '789 Homestead Street, Decor Town', 12, 6000, '2022-02-06 12:40:00', NULL, NULL),
  ('Pet Paradise', 'petparadise@example.com', 'pet_paradise_image.jpg', '123 Pet Haven, Animal City', 13, 2500, '2022-02-07 14:30:00', NULL, NULL),
  ('Tech Galaxy', 'techgalaxy@example.com', 'tech_galaxy_image.jpg', '456 Innovation Lane, Technocity', 14, 3000, '2022-02-08 18:15:00', NULL, NULL),
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
  ('Culinary Creations', 'culinarycreations@example.com', 'culinary_creations_image.jpg', '234 Culinary Court, Foodville', 34, 6000, '2022-02-28 09:45:00', NULL, NULL);
  -- Generate 30 dummy users with realistic names, updated gender codes, and new passwords
INSERT INTO `users` (`user_email`, `user_password`, `user_name`, `user_nama`, `user_money`, `user_role`, `user_img`, `user_gender`, `user_phone`, `created_at`, `updated_at`, `deleted_at`)
VALUES
  ('john.doe@example.com', '12345678', 'JohnDoe', 'John Doe', 5000, 'Customer', 'user1_image.jpg', 'P', '123-456-7890', '2022-03-01 09:00:00', NULL, NULL),
  ('jane.doe@example.com', '12345678', 'JaneDoe', 'Jane Doe', 7000, 'Customer', 'user2_image.jpg', 'W', '987-654-3210', '2022-03-02 11:30:00', NULL, NULL),
  ('bob.johnson@example.com', '12345678', 'BobJohnson', 'Bob Johnson', 3000, 'Customer', 'user3_image.jpg', 'P', '567-890-1234', '2022-03-03 14:45:00', NULL, NULL),
  ('samantha.white@example.com', '12345678', 'SamanthaWhite', 'Samantha White', 8000, 'Customer', 'user4_image.jpg', 'W', '345-678-9012', '2022-03-04 16:20:00', NULL, NULL),
  ('michael.smith@example.com', '12345678', 'MichaelSmith', 'Michael Smith', 4500, 'Customer', 'user5_image.jpg', 'P', '876-543-2109', '2022-03-05 10:10:00', NULL, NULL),
  ('ella.davis@example.com', '12345678', 'EllaDavis', 'Ella Davis', 6000, 'Customer', 'user6_image.jpg', 'W', '234-567-8901', '2022-03-06 12:40:00', NULL, NULL),
  ('matthew.brown@example.com', '12345678', 'MatthewBrown', 'Matthew Brown', 2500, 'Customer', 'user7_image.jpg', 'P', '789-012-3456', '2022-03-07 14:30:00', NULL, NULL),
  ('olivia.miller@example.com', '12345678', 'OliviaMiller', 'Olivia Miller', 3500, 'Customer', 'user8_image.jpg', 'W', '210-987-6543', '2022-03-08 18:15:00', NULL, NULL),
  ('david.taylor@example.com', '12345678', 'DavidTaylor', 'David Taylor', 7000, 'Customer', 'user9_image.jpg', 'P', '432-109-8765', '2022-03-09 08:45:00', NULL, NULL),
  ('sophia.wilson@example.com', '12345678', 'SophiaWilson', 'Sophia Wilson', 4000, 'Customer', 'user10_image.jpg', 'W', '109-876-5432', '2022-03-10 11:20:00', NULL, NULL),
  ('daniel.martinez@example.com', '12345678', 'DanielMartinez', 'Daniel Martinez', 6500, 'Customer', 'user11_image.jpg', 'P', '678-345-0123', '2022-03-11 13:40:00', NULL, NULL),
  ('ava.jackson@example.com', '12345678', 'AvaJackson', 'Ava Jackson', 3000, 'Customer', 'user12_image.jpg', 'W', '345-678-9012', '2022-03-12 15:30:00', NULL, NULL),
  ('josephine.garcia@example.com', '12345678', 'JosephineGarcia', 'Josephine Garcia', 5500, 'Customer', 'user13_image.jpg', 'W', '012-345-6789', '2022-03-13 09:10:00', NULL, NULL),
  ('lucas.rodriguez@example.com', '12345678', 'LucasRodriguez', 'Lucas Rodriguez', 4500, 'Customer', 'user14_image.jpg', 'P', '567-890-1234', '2022-03-14 12:35:00', NULL, NULL),
  ('isabella.lopez@example.com', '12345678', 'IsabellaLopez', 'Isabella Lopez', 6000, 'Customer', 'user15_image.jpg', 'W', '234-567-8901', '2022-03-15 14:20:00', NULL, NULL),
  ('benjamin.smith@example.com', '12345678', 'BenjaminSmith', 'Benjamin Smith', 3500, 'Customer', 'user16_image.jpg', 'P', '789-012-3456', '2022-03-16 16:45:00', NULL, NULL),
  ('mia.davis@example.com', '12345678', 'MiaDavis', 'Mia Davis', 5000, 'Customer', 'user17_image.jpg', 'W', '210-987-6543', '2022-03-17 10:30:00', NULL, NULL),
  ('elijah.johnson@example.com', '12345678', 'ElijahJohnson', 'Elijah Johnson', 2500, 'Customer', 'user18_image.jpg', 'P', '432-109-8765', '2022-03-18 12:15:00', NULL, NULL),
  ('scarlett.taylor@example.com', '12345678', 'ScarlettTaylor', 'Scarlett Taylor', 4500, 'Customer', 'user19_image.jpg', 'W', '109-876-5432', '2022-03-19 14:30:00', NULL, NULL),
  ('lucas.martinez@example.com', '12345678', 'LucasMartinez', 'Lucas Martinez', 6500, 'Customer', 'user20_image.jpg', 'P', '678-345-0123', '2022-03-20 16:20:00', NULL, NULL),
  ('aria.garcia@example.com', '12345678', 'AriaGarcia', 'Aria Garcia', 3000, 'Customer', 'user21_image.jpg', 'W', '345-678-9012', '2022-03-21 11:45:00', NULL, NULL),
  ('henry.wilson@example.com', '12345678', 'HenryWilson', 'Henry Wilson', 5500, 'Customer', 'user22_image.jpg', 'P', '012-345-6789', '2022-03-22 14:30:00', NULL, NULL),
  ('emma.jackson@example.com', '12345678', 'EmmaJackson', 'Emma Jackson', 4000, 'Customer', 'user23_image.jpg', 'W', '567-890-1234', '2022-03-23 17:00:00', NULL, NULL),
  ('liam.miller@example.com', '12345678', 'LiamMiller', 'Liam Miller', 3000, 'Customer', 'user24_image.jpg', 'P', '789-012-3456', '2022-03-24 09:30:00', NULL, NULL),
  ('olivia.smith@example.com', '12345678', 'OliviaSmith', 'Olivia Smith', 5000, 'Customer', 'user25_image.jpg', 'W', '210-987-6543', '2022-03-25 12:15:00', NULL, NULL),
  ('noah.taylor@example.com', '12345678', 'NoahTaylor', 'Noah Taylor', 3500, 'Customer', 'user26_image.jpg', 'P', '432-109-8765', '2022-03-26 14:45:00', NULL, NULL),
  ('ava.johnson@example.com', '12345678', 'AvaJohnson', 'Ava Johnson', 4500, 'Customer', 'user27_image.jpg', 'W', '109-876-5432', '2022-03-27 17:30:00', NULL, NULL),
  ('liam.davis@example.com', '12345678', 'LiamDavis', 'Liam Davis', 6000, 'Customer', 'user28_image.jpg', 'P', '678-345-0123', '2022-03-28 09:45:00', NULL, NULL),
  ('emma.martinez@example.com', '12345678', 'EmmaMartinez', 'Emma Martinez', 2500, 'Customer', 'user29_image.jpg', 'W', '012-345-6789', '2022-03-29 12:30:00', NULL, NULL),
  ('oliver.garcia@example.com', '12345678', 'OliverGarcia', 'Oliver Garcia', 'P', '567-890-1234', '2022-03-30 14:20:00', NULL, NULL);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
