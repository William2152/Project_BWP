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
CREATE OR REPLACE DATABASE `db_kastore` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `category` */

insert  into `category`(`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'electronic','2022-01-01 08:00:00',NULL,NULL),
(2,'clothes','2022-01-01 08:00:00',NULL,NULL),
(3,'jewelry','2022-01-01 08:00:00',NULL,NULL),
(4,'medicine','2022-01-01 08:00:00',NULL,NULL),
(5,'shoes','2022-01-01 08:00:00',NULL,NULL),
(6,'bag','2022-01-01 08:00:00',NULL,NULL),
(7,'book','2022-01-01 08:00:00',NULL,NULL),
(8,'cook','2022-01-01 08:00:00',NULL,NULL),
(9,'toys','2022-01-01 08:00:00',NULL,NULL),
(10,'sport','2022-01-01 08:00:00',NULL,NULL),
(11,'pediatric','2022-01-01 08:00:00',NULL,NULL),
(12,'headphone','2022-01-01 08:00:00',NULL,NULL),
(13,'phone','2022-01-01 08:00:00',NULL,NULL),
(14,'art','2022-01-01 08:00:00',NULL,NULL),
(15,'food','2022-01-01 08:00:00',NULL,NULL),
(16,'keyboard','2022-01-01 08:00:00',NULL,NULL),
(17,'pets','2022-01-01 08:00:00',NULL,NULL),
(18,'garden','2022-01-01 08:00:00',NULL,NULL),
(19,'furniture','2022-01-01 08:00:00',NULL,NULL),
(20,'music','2022-01-01 08:00:00',NULL,NULL);
/*Table structure for table `category` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE messages (
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    content TEXT NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    FOREIGN KEY (sender_id) REFERENCES users(user_id),
    FOREIGN KEY (receiver_id) REFERENCES users(user_id)
);

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
  `voucher_id` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `kurir_id` int(11) DEFAULT NULL,
  `order_total_no_disc` int(11) NOT NULL,
  `order_total_amount` int(11) NOT NULL,
  `order_status` int(2) NOT NULL DEFAULT 0,
  `order_destination` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `voucher_id` (`voucher_id`),
  KEY `store_id` (`store_id`),
  KEY `kurir_id` (`kurir_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `orders_kurir` FOREIGN KEY (`kurir_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `orders_store` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`),
  CONSTRAINT `orders_voucher` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `orders` */

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `product_img` text NOT NULL,
  `product_detail` text DEFAULT NULL,
  `product_price` int(11) NOT NULL CHECK (`product_price` > 0),
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
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `messages`;

CREATE TABLE messages (
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    content TEXT NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    FOREIGN KEY (sender_id) REFERENCES users(user_id),
    FOREIGN KEY (receiver_id) REFERENCES users(user_id)
);

/*Data for the table `product` */

insert  into `product`(`product_id`,`product_name`,`product_img`,`product_detail`,`product_price`,`product_stock`,`product_avg_rating`,`product_jumlah_avg_data`,`category_id`,`store_id`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Laptop ASUS XYZ','https://i.pinimg.com/564x/59/a8/bb/59a8bba433ff9d5905700c1759c2396f.jpg','High-performance laptop with Intel Core i7 processor',1200,50,NULL,NULL,1,3,'2024-01-03 12:00:00',NULL,NULL),
(2,'Smart TV Samsung 55\"','https://i.pinimg.com/564x/e5/fe/f8/e5fef8d8aef1354b9ed9b023c3cab25b.jpg','4K Ultra HD resolution, Smart features',800,30,NULL,NULL,1,3,'2024-01-03 12:05:00',NULL,NULL),
(3,'Smartphone Galaxy S21','https://i.pinimg.com/564x/43/ca/92/43ca92fda4ce2635e897ef27c65cb592.jpg','Ultra HD smartphone with Great Features',900,100,NULL,NULL,1,3,'2024-01-03 12:10:00',NULL,NULL),
(4,'Wireless Headphones Baseus','https://i.pinimg.com/564x/89/b3/07/89b3075b58ede531493806050bb433cc.jpg','Noise-canceling, Bluetooth connectivity',150,80,NULL,NULL,1,3,'2024-01-03 12:15:00',NULL,NULL),
(5,'Gaming PC AMD Ryzen','https://i.pinimg.com/736x/37/46/5e/37465e0768b74b36062b595f58e007de.jpg','High-end gaming PC with AMD Ryzen processor',2000,20,NULL,NULL,1,3,'2024-01-03 12:20:00',NULL,NULL),
(6,'Soundbar Sony','https://i.pinimg.com/564x/6c/5c/e1/6c5ce1f86101721aff75c415a2ff17a1.jpg','Dolby Atmos support, Wireless subwoofer',300,40,NULL,NULL,1,3,'2024-01-03 12:25:00',NULL,NULL),
(7,'Digital Camera Nikon','https://i.pinimg.com/564x/2b/2d/b4/2b2db471d0fa987ede58c09dece5e0ef.jpg','24MP sensor, 4K video recording',700,15,NULL,NULL,1,3,'2024-01-03 12:30:00',NULL,NULL),
(8,'Home Theater System','https://i.pinimg.com/736x/b1/01/43/b1014326f211187c667784a7534287b9.jpg','5.1 surround sound, Blu-ray player',500,25,NULL,NULL,1,3,'2024-01-03 12:35:00',NULL,NULL),
(9,'Smart Watch Fitbit','https://i.pinimg.com/564x/30/57/b1/3057b1b3ab7cef512d9169844695e8ba.jpg','Fitness tracking, Heart rate monitor',120,60,NULL,NULL,1,3,'2024-01-03 12:40:00',NULL,NULL),
(10,'Portable Bluetooth Speaker','https://i.pinimg.com/564x/bd/ab/c4/bdabc47e32d0770253c1899894e30648.jpg','Waterproof, 10 hours battery life',50,70,NULL,NULL,1,3,'2024-01-03 12:45:00',NULL,NULL),
(11,'4K Action Camera GoPro','https://i.pinimg.com/564x/c2/33/20/c23320eaae9eb0c9b6738e4c23701427.jpg','Waterproof, Wide-angle lens',300,10,NULL,NULL,1,3,'2024-01-03 12:50:00',NULL,NULL),
(12,'Electric Toothbrush','https://i.pinimg.com/564x/d3/b1/ea/d3b1ea6524572c79c3dc85dc565b8905.jpg','Sonic cleaning technology',80,50,NULL,NULL,1,3,'2024-01-03 12:55:00',NULL,NULL),
(13,'Wireless Mouse Logitech','https://i.pinimg.com/736x/15/7b/30/157b3009d15daf34de312cf8e6555c79.jpg','Ergonomic design, Long battery life',30,90,NULL,NULL,1,3,'2024-01-03 13:00:00',NULL,NULL),
(14,'32-inch Monitor','https://i.pinimg.com/564x/36/c7/83/36c78383a3a87041b03dae53bdeec872.jpg','Full HD resolution, IPS panel',250,35,NULL,NULL,1,3,'2024-01-03 13:05:00',NULL,NULL),
(15,'External SSD 1TB San Disk','https://i.pinimg.com/564x/b1/5b/f9/b15bf9a6188edf47e5cfe0b116d195ef.jpg','High-speed data transfer, USB-C',180,55,NULL,NULL,1,3,'2024-01-03 13:10:00',NULL,NULL),
(16,'Men Casual T-Shirt','https://i.pinimg.com/736x/e3/c3/54/e3c3540d20e5f781afd45060cadcfb59.jpg','Comfortable cotton t-shirt for casual wear',20,100,NULL,NULL,2,1,'2024-01-03 14:00:00',NULL,NULL),
(17,'Women Skinny Jeans','https://i.pinimg.com/564x/22/a9/40/22a94034f5ebcdecfdf0e4c7e81d09fd.jpg','Stylish and slim-fit denim jeans for women',40,80,NULL,NULL,2,1,'2024-01-03 14:05:00',NULL,NULL),
(18,'Men Hooded Sweatshirt','https://i.pinimg.com/564x/4f/d9/8f/4fd98f3292d82f024ca17bea3efd7a63.jpg','Warm and cozy hooded sweatshirt for men',35,70,NULL,NULL,2,1,'2024-01-03 14:10:00',NULL,NULL),
(19,'Women Floral Dress','https://i.pinimg.com/736x/88/8f/b7/888fb7e49deded245d36f8f4f393cd4f.jpg','Elegant floral pattern dress for women',55,60,NULL,NULL,2,1,'2024-01-03 14:15:00',NULL,NULL),
(20,'Men Formal Shirt','https://i.pinimg.com/564x/cd/a2/4a/cda24a9da43f3723ed4cfe55434faeba.jpg','Classic formal shirt for men',30,90,NULL,NULL,2,1,'2024-01-03 14:20:00',NULL,NULL),
(21,'Women Active Leggings','https://i.pinimg.com/564x/96/6b/56/966b56ad568f41f1a9f0bd358294fdc7.jpg','Stretchable and comfortable leggings for women',25,110,NULL,NULL,2,1,'2024-01-03 14:25:00',NULL,NULL),
(22,'Men Denim Jacket','https://i.pinimg.com/564x/ab/f6/b1/abf6b13a69580174e63281c6432f8176.jpg','Stylish denim jacket for men',60,50,NULL,NULL,2,1,'2024-01-03 14:30:00',NULL,NULL),
(23,'Women Cardigan Sweater','https://i.pinimg.com/564x/7d/b5/e8/7db5e8a7bf38ba8bdc424661510bbf01.jpg','Cozy and fashionable cardigan sweater for women',45,75,NULL,NULL,2,1,'2024-01-03 14:35:00',NULL,NULL),
(24,'Men Jogger Pants','https://i.pinimg.com/564x/29/90/76/2990764bab606cbde6f53e44cea3b74f.jpg','Comfortable jogger pants for men',30,85,NULL,NULL,2,1,'2024-01-03 14:40:00',NULL,NULL),
(25,'Women Puffer Jacket','https://i.pinimg.com/564x/69/19/8d/69198da3b16e8b6ea022544dfd517085.jpg','Warm and stylish puffer jacket for women',75,40,NULL,NULL,2,1,'2024-01-03 14:45:00',NULL,NULL),
(26,'Gold Pendant Necklace','https://i.pinimg.com/736x/5b/da/eb/5bdaeb150ae103c35d6c40fd49178662.jpg','Elegant gold pendant necklace for a classic look',150,30,NULL,NULL,3,10,'2024-01-03 15:00:00',NULL,NULL),
(27,'Diamond Stud Earrings','https://i.pinimg.com/736x/67/35/b1/6735b13f39497a3c9526c0f154c922cb.jpg','Sparkling diamond stud earrings for a glamorous touch',200,20,NULL,NULL,3,10,'2024-01-03 15:05:00',NULL,NULL),
(28,'Silver Bracelet','https://i.pinimg.com/564x/c0/ea/c7/c0eac713ca41c32e1ed1dd4989d00d5f.jpg','Stylish silver bracelet for a modern and trendy look',80,50,NULL,NULL,3,10,'2024-01-03 15:10:00',NULL,NULL),
(29,'Pearl Drop Earrings','https://i.pinimg.com/564x/68/79/c4/6879c48e924f92205de153caf6822515.jpg','Timeless pearl drop earrings for a classic and elegant style',120,40,NULL,NULL,3,10,'2024-01-03 15:15:00',NULL,NULL),
(30,'Gemstone Ring','https://i.pinimg.com/564x/42/8d/c1/428dc19990bd98d0c6bd255d27942b26.jpg','Colorful gemstone ring for a vibrant and unique appearance',100,35,NULL,NULL,3,10,'2024-01-03 15:20:00',NULL,NULL),
(31,'Rose Gold Bangle','https://i.pinimg.com/736x/f2/ab/c7/f2abc71884914d6818814eec77ef5e50.jpg','Chic rose gold bangle for a feminine touch',90,45,NULL,NULL,3,10,'2024-01-03 15:25:00',NULL,NULL),
(32,'Emerald Necklace','https://i.pinimg.com/564x/01/17/8e/01178ebccf8c9edf1c5ee65561e7827a.jpg','Striking emerald necklace for a touch of luxury',180,25,NULL,NULL,3,10,'2024-01-03 15:30:00',NULL,NULL),
(33,'Sapphire Tennis Bracelet','https://i.pinimg.com/736x/1d/11/41/1d1141791d29b7a8b6bd90668b140450.jpg','Exquisite sapphire tennis bracelet for a refined look',250,15,NULL,NULL,3,10,'2024-01-03 15:35:00',NULL,NULL),
(34,'Diamond Solitaire Ring','https://i.pinimg.com/736x/55/57/a8/5557a8472592b780ae6b7c2f7c53bd71.jpg','Classic diamond solitaire ring for a timeless appeal',300,10,NULL,NULL,3,10,'2024-01-03 15:40:00',NULL,NULL),
(35,'Citrine Stud Earrings','https://i.pinimg.com/564x/cb/20/d5/cb20d528c979373fbd78da60e88da336.jpg','Radiant citrine stud earrings for a vibrant and warm style',120,30,NULL,NULL,3,10,'2024-01-03 15:45:00',NULL,NULL),
(36,'Aspirin Tablets Geri Care','https://i.pinimg.com/564x/da/cb/b2/dacbb21efdd9168e794ab91b2de50b77.jpg','Pain reliever and fever reducer',10,100,NULL,NULL,4,12,'2024-01-03 16:00:00',NULL,NULL),
(37,'Ibuprofen Capsules A+ Health','https://i.pinimg.com/564x/0b/80/0c/0b800c8bbb36afbfbe4baeab3eecc4e8.jpg','Nonsteroidal anti-inflammatory drug (NSAID)',15,80,NULL,NULL,4,12,'2024-01-03 16:05:00',NULL,NULL),
(38,'Antacid Chewable Tablets Equate','https://i.pinimg.com/564x/f4/2a/aa/f42aaa2b2493bc530a9b3e76ec7d41b0.jpg','Relieves heartburn and indigestion',8,120,NULL,NULL,4,12,'2024-01-03 16:10:00',NULL,NULL),
(39,'Cough Syrup No Cough','https://i.pinimg.com/564x/fe/dc/c0/fedcc02a41dc0badb1e6e2d81fe55d30.jpg','Relieves cough and cold symptoms',12,90,NULL,NULL,4,12,'2024-01-03 16:15:00',NULL,NULL),
(40,'Allergy Relief Tablets Hylands','https://i.pinimg.com/564x/b7/43/94/b74394549b4634396daa5c3dd1d225c9.jpg','Antihistamine for allergy relief',20,60,NULL,NULL,4,12,'2024-01-03 16:20:00',NULL,NULL),
(41,'Vitamin C Supplement Natural Made','https://i.pinimg.com/564x/d7/26/86/d72686e2dc3691fe28de9cf7fbd8bce4.jpg','Boosts immune system and supports overall health',18,70,NULL,NULL,4,12,'2024-01-03 16:25:00',NULL,NULL),
(42,'Pain Relief Cream','https://i.pinimg.com/564x/05/89/03/058903d725809fc720037be832631dcb.jpg','Topical analgesic for localized pain relief',25,40,NULL,NULL,4,12,'2024-01-03 16:30:00',NULL,NULL),
(43,'Sleep Aid Tablets Basic Care','https://www.gosupps.com/media/catalog/product/6/1/61IR8K0uRAL_2.jpg','Helps promote restful sleep',30,50,NULL,NULL,4,12,'2024-01-03 16:35:00',NULL,NULL),
(44,'Antibacterial Hand Sanitizer','https://i.pinimg.com/564x/17/b0/33/17b03361fa43491d667499698988a874.jpg','Kills germs and bacteria without water',8,110,NULL,NULL,4,12,'2024-01-03 16:40:00',NULL,NULL),
(45,'Digestive Enzyme Supplement Webber Naturals','https://i.pinimg.com/564x/78/b5/56/78b55603da814af8a87db7ed2765e1d8.jpg','Aids in digestion and nutrient absorption',22,30,NULL,NULL,4,12,'2024-01-03 16:45:00',NULL,NULL),
(46,'Running Shoes - Men','https://i.pinimg.com/736x/29/70/9d/29709ded93d15c472d75d18bcd94dbe4.jpg','Comfortable and lightweight running shoes for men.',75,50,NULL,NULL,5,30,'2024-01-07 12:59:20',NULL,NULL),
(47,'High Heels - Women','https://i.pinimg.com/736x/4e/a6/6e/4ea66e52239d6bc956b0e08ec2655ad5.jpg','Elegant high heels for women.',90,30,NULL,NULL,5,30,'2024-01-07 12:59:20',NULL,NULL),
(48,'Sneakers - Unisex','https://i.pinimg.com/564x/5a/ce/e7/5acee7b0a54f5c0fef6d1ab05b64f7ea.jpg','Versatile sneakers suitable for both men and women.',60,40,NULL,NULL,5,30,'2024-01-07 12:59:20',NULL,NULL),
(49,'Casual Loafers - Men','https://i.pinimg.com/736x/1f/59/7f/1f597fae6446ccea15c7bb3f1642d4f8.jpg','Stylish and comfortable loafers for men.',70,45,NULL,NULL,5,30,'2024-01-07 12:59:20',NULL,NULL),
(50,'Ankle Boots - Women','https://i.pinimg.com/564x/43/cc/cf/43cccf4c47f3cd8d3e17affbf06cfc75.jpg','Fashionable ankle boots for women.',85,25,NULL,NULL,5,30,'2024-01-07 12:59:20',NULL,NULL),
(51,'Skateboard Shoes - Unisex','https://i.pinimg.com/564x/ea/a9/73/eaa973a459a57d31e6e13be643ebb906.jpg','Durable shoes designed for skateboarding.',55,35,NULL,NULL,5,30,'2024-01-07 12:59:20',NULL,NULL),
(52,'Formal Oxfords - Men','https://i.pinimg.com/564x/f9/bb/fb/f9bbfb68633e911b2814c247b0ed8aad.jpg','Classic formal oxfords for men.',80,20,NULL,NULL,5,30,'2024-01-07 12:59:20',NULL,NULL),
(53,'Sandals - Women','https://i.pinimg.com/736x/76/66/51/7666514fa55c1ab48eb1cc035f0bce57.jpg','Comfortable and stylish sandals for women.',40,60,NULL,NULL,5,30,'2024-01-07 12:59:20',NULL,NULL),
(54,'Basketball Sneakers - Unisex','https://i.pinimg.com/736x/3b/c1/9b/3bc19b28d66185e01b05349299c56903.jpg','Performance sneakers for basketball enthusiasts.',95,15,NULL,NULL,5,30,'2024-01-07 12:59:20',NULL,NULL),
(55,'Slip-On Shoes - Unisex','https://i.pinimg.com/564x/a7/05/66/a70566e1c08aeedfc0d292b4b66d626a.jpg','Convenient and easy-to-wear slip-on shoes for both men and women.',50,50,NULL,NULL,5,30,'2024-01-07 12:59:20',NULL,NULL),
(56,'Leather Tote Bag','https://i.pinimg.com/564x/71/74/6c/71746cf5a3d81bf0633e2ec7e8105cd0.jpg','Stylish and spacious leather tote bag.',120,30,NULL,NULL,6,8,'2024-01-07 12:59:20',NULL,NULL),
(57,'Canvas Backpack','https://i.pinimg.com/564x/1e/4a/69/1e4a69d791646eec6b76608e019c5ec4.jpg','Durable and versatile canvas backpack.',60,50,NULL,NULL,6,8,'2024-01-07 12:59:20',NULL,NULL),
(58,'Designer Handbag','https://i.pinimg.com/564x/e6/4f/18/e64f18b0f074780b0a67b092d789a01a.jpg','Luxurious designer handbag for special occasions.',250,15,NULL,NULL,6,8,'2024-01-07 12:59:20',NULL,NULL),
(59,'Crossbody Sling Bag','https://i.pinimg.com/736x/02/2a/b8/022ab88ce21c8ef224584600bf21239c.jpg','Compact and comfortable crossbody sling bag.',80,40,NULL,NULL,6,8,'2024-01-07 12:59:20',NULL,NULL),
(60,'Travel Duffel Bag','https://i.pinimg.com/564x/1d/4a/3e/1d4a3e46bc667a2168bd2e245f6b9600.jpg','Spacious and durable travel duffel bag.',100,25,NULL,NULL,6,8,'2024-01-07 12:59:20',NULL,NULL),
(61,'Clutch Purse','https://i.pinimg.com/564x/64/8d/80/648d8049d33329fb2a08bcee8c112f4b.jpg','Elegant and compact clutch purse for evening events.',50,35,NULL,NULL,6,8,'2024-01-07 12:59:20',NULL,NULL),
(62,'Weekender Trolley','https://i.pinimg.com/564x/03/73/23/03732309214e9dcf695ee80e9b4a04b4.jpg','Rolling weekender trolley for travel convenience.',150,20,NULL,NULL,6,8,'2024-01-07 12:59:20',NULL,NULL),
(63,'Fashionable Hobo Bag','https://i.pinimg.com/564x/f4/ff/b7/f4ffb72d8696370901cd6ca2c775b84d.jpg','Trendy and spacious hobo bag for everyday use.',90,45,NULL,NULL,6,8,'2024-01-07 12:59:20',NULL,NULL),
(64,'Classic Shoulder Bag','https://i.pinimg.com/736x/51/a2/8b/51a28b742a037cb3e567cbaa039caa45.jpg','Timeless and versatile shoulder bag for any occasion.',70,40,NULL,NULL,6,8,'2024-01-07 12:59:20',NULL,NULL),
(65,'Sporty Waist Pack','https://i.pinimg.com/564x/4b/36/07/4b360756d9e6a809b6a9106c9658bfc1.jpg','Compact and sporty waist pack for on-the-go activities.',40,60,NULL,NULL,6,8,'2024-01-07 12:59:20',NULL,NULL),
(66,'The Great Gatsby','https://i.pinimg.com/564x/74/05/51/740551c3cec86af92fb97ffcf78404cf.jpg','Classic novel by F. Scott Fitzgerald.',15,50,NULL,NULL,7,4,'2024-01-07 12:59:20',NULL,NULL),
(67,'Educated: A Memoir','https://i.pinimg.com/736x/00/0c/4a/000c4ad73f0f7930c1240dba7f2f50d0.jpg','Memoir by Tara Westover about her quest for knowledge.',20,40,NULL,NULL,7,4,'2024-01-07 12:59:20',NULL,NULL),
(68,'Sapiens: A Brief History of Humankind','https://i.pinimg.com/564x/3d/cb/f1/3dcbf106135ea84b56ec9079197d8ef4.jpg','Historical exploration by Yuval Noah Harari.',25,35,NULL,NULL,7,4,'2024-01-07 12:59:20',NULL,NULL),
(69,'The Silent Patient','https://i.pinimg.com/564x/c5/85/ce/c585ce0ea039b1e689f5744045099974.jpg','Psychological thriller by Alex Michaelides.',18,45,NULL,NULL,7,4,'2024-01-07 12:59:20',NULL,NULL),
(70,'Atomic Habits','https://i.pinimg.com/564x/d5/d4/da/d5d4da1ae3925d6151acdf6e0458f3b0.jpg','Self-help book on building good habits by James Clear.',30,30,NULL,NULL,7,4,'2024-01-07 12:59:20',NULL,NULL),
(71,'To Kill a Mockingbird','https://i.pinimg.com/736x/d6/66/5f/d6665f5f592fe6f1442c2123a5f45902.jpg','Classic novel by Harper Lee addressing racial injustice.',16,55,NULL,NULL,7,4,'2024-01-07 12:59:20',NULL,NULL),
(72,'The Alchemist','https://i.pinimg.com/736x/05/0d/8c/050d8c9d7be040c067bd8e54f6f60cea.jpg','Philosophical novel by Paulo Coelho.',22,25,NULL,NULL,7,4,'2024-01-07 12:59:20',NULL,NULL),
(73,'Becoming','https://i.pinimg.com/736x/92/16/37/921637f51d3277cd154db14f27965970.jpg','Memoir by Michelle Obama, former First Lady of the United States.',28,20,NULL,NULL,7,4,'2024-01-07 12:59:20',NULL,NULL),
(74,'The Hobbit','https://i.pinimg.com/736x/b3/da/6c/b3da6c61f387e12ada45eb885552f00d.jpg','Fantasy novel by J.R.R. Tolkien.',14,60,NULL,NULL,7,4,'2024-01-07 12:59:20',NULL,NULL),
(75,'The Girl on the Train','https://i.pinimg.com/736x/40/a9/28/40a928fd94976858d0af49e6ad3bbd3a.jpg','Mystery thriller by Paula Hawkins.',24,15,NULL,NULL,7,4,'2024-01-07 12:59:20',NULL,NULL),
(76,'Stainless Steel Cookware Set','https://i.pinimg.com/564x/a5/49/c9/a549c9ef996ebd4c8b8a40a980c348b3.jpg','Durable stainless steel cookware set for your kitchen.',150,20,NULL,NULL,8,16,'2024-01-07 12:59:20',NULL,NULL),
(77,'Non-Stick Frying Pan','https://i.pinimg.com/736x/ad/f6/df/adf6dfe69a33009272246c41de78e0f5.jpg','Versatile non-stick frying pan for cooking various dishes.',30,40,NULL,NULL,8,16,'2024-01-07 12:59:20',NULL,NULL),
(78,'Chef Knife Set','https://i.pinimg.com/564x/1f/0e/87/1f0e872a3db1ec7b1a3610f756ae8528.jpg','High-quality knife set for professional chefs and home cooks.',80,25,NULL,NULL,8,16,'2024-01-07 12:59:20',NULL,NULL),
(79,'Electric Stand Mixer','https://i.pinimg.com/564x/e0/3f/74/e03f74e54fcc9f21b7265d23f81b60ea.jpg','Powerful electric stand mixer for baking and cooking.',120,15,NULL,NULL,8,16,'2024-01-07 12:59:20',NULL,NULL),
(80,'Copper Bottom Saucepan','https://i.pinimg.com/564x/12/3b/54/123b543493caa22f940b6f254880168d.jpg','Classic copper bottom saucepan for even heat distribution.',50,30,NULL,NULL,8,16,'2024-01-07 12:59:20',NULL,NULL),
(81,'Silicone Cooking Utensil Set','https://i.pinimg.com/564x/ed/95/6d/ed956db0289e26d2944834dcedb5da2d.jpg','Flexible and heat-resistant silicone cooking utensil set.',40,35,NULL,NULL,8,16,'2024-01-07 12:59:20',NULL,NULL),
(82,'Bamboo Cutting Board','https://i.pinimg.com/564x/9d/7e/9f/9d7e9f44d72fc941bc6beba4dca89430.jpg','Eco-friendly bamboo cutting board for kitchen prep.',25,50,NULL,NULL,8,16,'2024-01-07 12:59:20',NULL,NULL),
(83,'Cast Iron Skillet','https://i.pinimg.com/564x/f9/8c/ca/f98ccaecd6b1c9de9390163edb319745.jpg','Durable cast iron skillet for searing and frying.',60,20,NULL,NULL,8,16,'2024-01-07 12:59:20',NULL,NULL),
(84,'Digital Kitchen Scale','https://i.pinimg.com/564x/76/b8/fd/76b8fd16eb94886b9884b16078eecd5f.jpg','Accurate digital kitchen scale for precise measurements.',20,40,NULL,NULL,8,16,'2024-01-07 12:59:20',NULL,NULL),
(85,'Glass Baking Dish Set','https://i.pinimg.com/564x/b1/82/41/b182414847f000367b2819b600e7a87c.jpg','Versatile glass baking dish set for oven cooking.',35,25,NULL,NULL,8,16,'2024-01-07 12:59:20',NULL,NULL),
(86,'LEGO Classic Creative Bricks','https://i.pinimg.com/564x/5f/f7/fa/5ff7fab15f70cd8f0c4239a962f5a50b.jpg','Build endless creations with this LEGO Classic set.',25,50,NULL,NULL,9,21,'2024-01-07 12:59:20',NULL,NULL),
(87,'Barbie Dreamhouse','https://i.pinimg.com/736x/93/34/cf/9334cf3e3c38b9b526b6bffd79f38791.jpg','Classic Barbie Dreamhouse for imaginative play.',80,15,NULL,NULL,9,21,'2024-01-07 12:59:20',NULL,NULL),
(88,'Nerf N-Strike Elite Disruptor','https://i.pinimg.com/736x/14/ec/72/14ec72ad01348e7ec404f2e549303a5e.jpg','Nerf N-Strike Elite Disruptor for action-packed fun.',20,30,NULL,NULL,9,21,'2024-01-07 12:59:20',NULL,NULL),
(89,'Dollhouse with Furniture','https://i.pinimg.com/564x/b4/5d/27/b45d27375cb804c624f4406c29dded7b.jpg','Complete dollhouse set with miniature furniture.',50,20,NULL,NULL,9,21,'2024-01-07 12:59:20',NULL,NULL),
(90,'Remote Control Car','https://i.pinimg.com/564x/3e/e9/55/3ee955dd884bbf71df9b6d927730179a.jpg','Fast and fun remote control car for racing.',35,25,NULL,NULL,9,21,'2024-01-07 12:59:20',NULL,NULL),
(91,'Board Game Bundle','https://i.pinimg.com/564x/e3/ba/5c/e3ba5c092ec32add9f46923ee124c40c.jpg','Bundle of classic board games for family game night.',60,15,NULL,NULL,9,21,'2024-01-07 12:59:20',NULL,NULL),
(92,'Puzzle Set for Kids','https://i.pinimg.com/564x/77/69/2d/77692dd0bb7632bab5c7aea1ac22357f.jpg','Educational puzzle set for kids of all ages.',15,40,NULL,NULL,9,21,'2024-01-07 12:59:20',NULL,NULL),
(93,'Stuffed Animal Collection','https://i.pinimg.com/564x/00/9b/25/009b25997481203565fbba7a67324918.jpg','Adorable stuffed animal collection for cuddling.',30,35,NULL,NULL,9,21,'2024-01-07 12:59:20',NULL,NULL),
(94,'Art Supplies Kit for Kids','https://i.pinimg.com/564x/19/1d/84/191d842e19f57f058c9a5c8c44fefed4.jpg','Complete art supplies kit for creative expression.',25,30,NULL,NULL,9,21,'2024-01-07 12:59:20',NULL,NULL),
(95,'Educational STEM Kit','https://i.pinimg.com/564x/4c/45/76/4c457625390e1309977a5116d6e6fe8e.jpg','STEM educational kit for hands-on learning.',40,20,NULL,NULL,9,21,'2024-01-07 12:59:20',NULL,NULL),
(96,'Running Shoes','https://i.pinimg.com/564x/39/94/61/399461d8af4337ffaa8dbf41232ba779.jpg','Comfortable running shoes for all types of runners.',80,30,NULL,NULL,10,18,'2024-01-07 12:59:20',NULL,NULL),
(97,'Yoga Mat','https://i.pinimg.com/564x/91/d0/28/91d028dd7f7bf0708c6561a355f1aef8.jpg','Non-slip yoga mat for a comfortable and stable practice.',25,40,NULL,NULL,10,18,'2024-01-07 12:59:20',NULL,NULL),
(98,'Dumbbell Set','https://i.pinimg.com/564x/46/0f/4f/460f4f839251a0ef6432f02eba649c1c.jpg','Adjustable dumbbell set for strength training at home.',120,15,NULL,NULL,10,18,'2024-01-07 12:59:20',NULL,NULL),
(99,'Fitness Tracker','https://i.pinimg.com/564x/45/09/2d/45092d28962b6f5dd4432dbe58928e19.jpg','Smart fitness tracker to monitor your daily activities.',50,25,NULL,NULL,10,18,'2024-01-07 12:59:20',NULL,NULL),
(100,'Basketball','https://i.pinimg.com/564x/57/27/01/5727019819ba23255fee48e641afbc39.jpg','Official size and weight basketball for indoor and outdoor play.',30,20,NULL,NULL,10,18,'2024-01-07 12:59:20',NULL,NULL),
(101,'Jump Rope','https://i.pinimg.com/736x/1f/47/2e/1f472e7a0b8f908255cc7fed24bbee6d.jpg','Durable jump rope for cardio and fitness workouts.',15,35,NULL,NULL,10,18,'2024-01-07 12:59:20',NULL,NULL),
(102,'Tennis Racket','https://i.pinimg.com/564x/90/be/01/90be0114b0b254c33459f97594cc23fd.jpg','Professional tennis racket for tennis enthusiasts.',90,10,NULL,NULL,10,18,'2024-01-07 12:59:20',NULL,NULL),
(103,'Bike Helmet','https://i.pinimg.com/564x/54/27/fc/5427fc03332089fa9838f24cf2d5c765.jpg','Safety-first bike helmet for cycling enthusiasts.',40,30,NULL,NULL,10,18,'2024-01-07 12:59:20',NULL,NULL),
(104,'Resistance Bands Set','https://i.pinimg.com/564x/e9/e6/80/e9e68014c1938c739ab30f1b4513add1.jpg','Versatile resistance bands set for full-body workouts.',35,25,NULL,NULL,10,18,'2024-01-07 12:59:20',NULL,NULL),
(105,'Soccer Ball','https://i.pinimg.com/564x/83/8c/05/838c053793b37b28da06e39633d7c59d.jpg','High-quality soccer ball for soccer enthusiasts.',25,15,NULL,NULL,10,18,'2024-01-07 12:59:20',NULL,NULL),
(106,'Baby Formula','https://i.pinimg.com/736x/95/93/2a/95932a23b38263d52d733dfdeb785a7c.jpg','Nutritious baby formula for infants.',30,50,NULL,NULL,11,27,'2024-01-07 12:59:20',NULL,NULL),
(107,'Baby Diapers Pack','https://i.pinimg.com/564x/da/8d/64/da8d6408a4958f52280a03323c29064e.jpg','High-quality baby diapers for comfort and dryness.',20,100,NULL,NULL,11,27,'2024-01-07 12:59:20',NULL,NULL),
(108,'Baby Onesie Set','https://i.pinimg.com/736x/90/81/a7/9081a7f69914dd46d592736aba5dcb19.jpg','Cute onesie set for newborns and infants.',15,30,NULL,NULL,11,27,'2024-01-07 12:59:20',NULL,NULL),
(109,'Baby Stroller','https://i.pinimg.com/736x/0b/fc/71/0bfc71133be1bf3773bb5d36f461a997.jpg','Lightweight and easy-to-use baby stroller for parents.',80,20,NULL,NULL,11,27,'2024-01-07 12:59:20',NULL,NULL),
(110,'Baby Bath Tub','https://i.pinimg.com/564x/30/95/19/309519c1d5a20a8ab96753d7b5a6b1bc.jpg','Comfortable baby bath tub for a safe and enjoyable bath time.',25,25,NULL,NULL,11,27,'2024-01-07 12:59:20',NULL,NULL),
(111,'Children Vitamins','https://i.pinimg.com/564x/4c/94/ae/4c94aeacbb912fd17b04ecd6bc99af90.jpg','Nutrient-rich vitamins for growing children.',15,40,NULL,NULL,11,27,'2024-01-07 12:59:20',NULL,NULL),
(112,'Kids Toy Set','https://i.pinimg.com/564x/97/3e/96/973e965f311b6060e974a13aec2916e9.jpg','Assortment of safe and entertaining toys for kids.',40,35,NULL,NULL,11,27,'2024-01-07 12:59:20',NULL,NULL),
(113,'Children Books Bundle','https://i.pinimg.com/564x/0e/5c/c0/0e5cc02fc3ff829a4a3a171f293a66c1.jpg','Collection of educational and fun books for children.',30,30,NULL,NULL,11,27,'2024-01-07 12:59:20',NULL,NULL),
(114,'Baby Clothes Bundle','https://i.pinimg.com/564x/d5/19/47/d519475874127678a3e828472f4ae30f.jpg','Bundle of adorable baby clothes for boys and girls.',50,15,NULL,NULL,11,27,'2024-01-07 12:59:20',NULL,NULL),
(115,'Baby Monitor','https://i.pinimg.com/736x/08/48/5d/08485d6ceda01f69c448d99888b2c128.jpg','Digital baby monitor for peace of mind.',60,10,NULL,NULL,11,27,'2024-01-07 12:59:20',NULL,NULL),
(116,'Wireless Over-Ear Headphones','https://i.pinimg.com/564x/14/66/1f/14661f5f4375ca159224561f579d7173.jpg','High-quality wireless over-ear headphones with noise cancellation.',120,30,NULL,NULL,12,27,'2024-01-07 12:59:20',NULL,NULL),
(117,'In-Ear Earphones with Mic','https://i.pinimg.com/564x/40/bf/20/40bf20368329172163d91963e22c297b.jpg','Comfortable in-ear earphones with built-in microphone.',30,50,NULL,NULL,12,27,'2024-01-07 12:59:20',NULL,NULL),
(118,'Bluetooth Sports Headset','https://i.pinimg.com/736x/60/9b/63/609b6378c1fd139f840160efc23566a5.jpg','Sweat-resistant Bluetooth sports headset for active users.',50,40,NULL,NULL,12,27,'2024-01-07 12:59:20',NULL,NULL),
(119,'Gaming Headset with RGB Lights','https://i.pinimg.com/564x/d5/50/fb/d550fb2340f01da2f7e46a4ddea67284.jpg','Immersive gaming headset with RGB lights and surround sound.',80,20,NULL,NULL,12,27,'2024-01-07 12:59:20',NULL,NULL),
(120,'Noise-Canceling On-Ear Headphones','https://i.pinimg.com/564x/97/9d/3e/979d3e6bccfc02533b7fe78dd39db958.jpg','Compact noise-canceling on-ear headphones for travel and commuting.',100,25,NULL,NULL,12,27,'2024-01-07 12:59:20',NULL,NULL),
(121,'Studio Monitor Headphones','https://i.pinimg.com/564x/04/56/83/045683615820bc0a7da61df72bb6dd8b.jpg','Professional studio monitor headphones for audio production.',150,15,NULL,NULL,12,27,'2024-01-07 12:59:20',NULL,NULL),
(122,'Kids Headphones with Volume Limiting','https://i.pinimg.com/736x/c8/d0/61/c8d0612a8513b98ecf0b61169c6d4136.jpg','Safe and comfortable headphones designed for kids with volume limiting.',35,30,NULL,NULL,12,27,'2024-01-07 12:59:20',NULL,NULL),
(123,'Foldable DJ Headphones','https://i.pinimg.com/736x/c4/15/5c/c4155c3f28d326e72b4fc51dd4bff4de.jpg','Foldable DJ headphones with swiveling earcups for easy storage.',70,35,NULL,NULL,12,27,'2024-01-07 12:59:20',NULL,NULL),
(124,'True Wireless Earbuds','https://i.pinimg.com/736x/dd/9b/c6/dd9bc67dae4623389906178bb096a724.jpg','Compact and cable-free true wireless earbuds for on-the-go use.',60,45,NULL,NULL,12,27,'2024-01-07 12:59:20',NULL,NULL),
(125,'Open-Back Audiophile Headphones','https://i.pinimg.com/736x/66/44/10/664410db192b250f4d578c9f72f8fbcf.jpg','Premium open-back audiophile headphones for high-fidelity audio.',200,10,NULL,NULL,12,27,'2024-01-07 12:59:20',NULL,NULL),
(126,'Smartphone XYZ','https://i.pinimg.com/564x/6f/58/d6/6f58d6cbe47e655d4af4f1519459084d.jpg','High-performance smartphone with XYZ features.',700,50,NULL,NULL,13,11,'2024-01-07 12:59:20',NULL,NULL),
(127,'Flagship Android Phone','https://i.pinimg.com/564x/f8/00/5f/f8005fcca3c8313418c511d9d5060bd5.jpg','Top-of-the-line Android smartphone with cutting-edge technology.',900,30,NULL,NULL,13,11,'2024-01-07 12:59:20',NULL,NULL),
(128,'Budget-Friendly Smartphone','https://i.pinimg.com/564x/65/12/33/651233ae8d12e11b76a96b369041d1eb.jpg','Affordable smartphone with essential features for everyday use.',300,80,NULL,NULL,13,11,'2024-01-07 12:59:20',NULL,NULL),
(129,'iOS-powered iPhone','https://i.pinimg.com/736x/cb/5a/a9/cb5aa9630759829d2e4da149eec9ade5.jpg','Elegant iPhone running the latest iOS software.',800,40,NULL,NULL,13,11,'2024-01-07 12:59:20',NULL,NULL),
(130,'5G-enabled Mobile Device','https://i.pinimg.com/736x/ee/b9/52/eeb9526f64a659c3f5cf22344c8a030d.jpg','Fast and reliable 5G-enabled mobile device for high-speed connectivity.',1000,20,NULL,NULL,13,11,'2024-01-07 12:59:20',NULL,NULL),
(131,'Compact Flip Phone','https://i.pinimg.com/564x/35/f3/a8/35f3a8130cc578305ea00d2ba2c8cf53.jpg','Classic flip phone design with modern features in a compact form factor.',400,60,NULL,NULL,13,11,'2024-01-07 12:59:20',NULL,NULL),
(132,'Camera-centric Smartphone','https://i.pinimg.com/564x/54/62/36/546236cd3ee2144b19f90f6f1d6d8747.jpg','Smartphone optimized for photography enthusiasts with advanced camera features.',600,45,NULL,NULL,13,11,'2024-01-07 12:59:20',NULL,NULL),
(133,'Business-oriented Mobile Device','https://i.pinimg.com/564x/14/47/d9/1447d951c29930fd34b04ec0f548e78b.jpg','Mobile device tailored for business professionals with productivity tools.',1200,25,NULL,NULL,13,11,'2024-01-07 12:59:20',NULL,NULL),
(134,'Rugged Outdoor Phone','https://i.pinimg.com/736x/04/09/4f/04094f1dcb48f3f78fa8bea418717db4.jpg','Durable and rugged phone designed for outdoor and adventurous use.',500,35,NULL,NULL,13,11,'2024-01-07 12:59:20',NULL,NULL),
(135,'Foldable Smartphone','https://i.pinimg.com/564x/1e/a9/fd/1ea9fd408409f4cfecd2dae407ff7194.jpg','Cutting-edge foldable smartphone with a flexible display.',1500,15,NULL,NULL,13,11,'2024-01-07 12:59:20',NULL,NULL),
(136,'Acrylic Paint Set','https://i.pinimg.com/564x/09/ae/ff/09aeffd9694e2c075c93c8922407167b.jpg','Complete set of high-quality acrylic paints for artists.',40,50,NULL,NULL,14,26,'2024-01-07 12:59:20',NULL,NULL),
(137,'Sketching Pencils Kit','https://i.pinimg.com/564x/c6/8a/19/c68a197dec4850fdafbc8f484862e315.jpg','Assorted sketching pencils for various shading techniques.',20,70,NULL,NULL,14,26,'2024-01-07 12:59:20',NULL,NULL),
(138,'Watercolor Palette','https://i.pinimg.com/564x/85/7b/44/857b4440637887406e8b606cfdd6debb.jpg','Compact watercolor palette with a range of vibrant colors.',30,60,NULL,NULL,14,26,'2024-01-07 12:59:20',NULL,NULL),
(139,'Canvas Pack','https://i.pinimg.com/564x/07/1a/11/071a11259221faf0675c2572083ab6d7.jpg','High-quality canvas pack for artists to create their masterpieces.',25,40,NULL,NULL,14,26,'2024-01-07 12:59:20',NULL,NULL),
(140,'Oil Paint Set','https://i.pinimg.com/564x/1c/e4/bc/1ce4bc1734ddcee4cd2e01374efd0b78.jpg','Comprehensive set of oil paints for professional artists.',50,30,NULL,NULL,14,26,'2024-01-07 12:59:20',NULL,NULL),
(141,'Artist Easel','https://i.pinimg.com/564x/6c/97/7d/6c977dfab7734c44371134c0ea986931.jpg','Sturdy and adjustable easel for comfortable painting.',60,20,NULL,NULL,14,26,'2024-01-07 12:59:20',NULL,NULL),
(142,'Mixed Media Art Supplies','https://i.pinimg.com/564x/92/af/0e/92af0e8b120f0bd77473c76ae02734b6.jpg','Assorted art supplies for mixed media artwork.',35,55,NULL,NULL,14,26,'2024-01-07 12:59:20',NULL,NULL),
(143,'Pastel Colors Set','https://i.pinimg.com/564x/3d/77/5f/3d775f7b33d0a1c37416b29aa581fce9.jpg','Soft pastel colors set for delicate and nuanced artwork.',45,25,NULL,NULL,14,26,'2024-01-07 12:59:20',NULL,NULL),
(144,'Art Brushes Collection','https://i.pinimg.com/736x/88/ba/58/88ba58fb0e5b039424373e379aeafd2a.jpg','Various brushes for different painting techniques.',15,75,NULL,NULL,14,26,'2024-01-07 12:59:20',NULL,NULL),
(145,'Charcoal Drawing Kit','https://i.pinimg.com/564x/1b/8a/e2/1b8ae2064aaf1f284c33556446c1296c.jpg','Complete kit for charcoal drawing and sketching.',30,35,NULL,NULL,14,26,'2024-01-07 12:59:20',NULL,NULL),
(146,'Premium Olive Oil','https://i.pinimg.com/736x/f1/01/d9/f101d9345f8dc226cfd99e12a8e4dc28.jpg','High-quality extra virgin olive oil for cooking and dressing.',20,100,NULL,NULL,15,28,'2024-01-07 12:59:20',NULL,NULL),
(147,'Organic Quinoa (1kg)','https://i.pinimg.com/564x/b5/16/8b/b5168b3132e9c19df49dc7a560bc9f9a.jpg','Certified organic quinoa for a nutritious and versatile grain option.',15,80,NULL,NULL,15,28,'2024-01-07 12:59:20',NULL,NULL),
(148,'Assorted Nuts and Dried Fruits','https://i.pinimg.com/564x/60/5c/87/605c87d45e6221015ff25d13f362a9d7.jpg','Mix of assorted nuts and dried fruits for a healthy snack.',25,120,NULL,NULL,15,28,'2024-01-07 12:59:20',NULL,NULL),
(149,'Natural Honey (500g)','https://i.pinimg.com/564x/8b/ac/70/8bac70502bd0a211223cc211979d35b4.jpg','Pure and natural honey for sweetening and culinary use.',18,90,NULL,NULL,15,28,'2024-01-07 12:59:20',NULL,NULL),
(150,'Organic Green Tea (50 Bags)','https://i.pinimg.com/564x/80/de/ca/80deca16fb89c23c255e091f96b0f728.jpg','Organic green tea bags for a refreshing and antioxidant-rich beverage.',12,60,NULL,NULL,15,28,'2024-01-07 12:59:20',NULL,NULL),
(151,'Whole Grain Pasta (2kg)','https://i.pinimg.com/564x/fe/2c/e9/fe2ce9e596e36f30569d4fdb93f86784.jpg','Whole grain pasta for a healthier alternative to traditional pasta.',22,70,NULL,NULL,15,28,'2024-01-07 12:59:20',NULL,NULL),
(152,'Gourmet Chocolate Assortment','https://i.pinimg.com/564x/4d/52/4e/4d524eb680d39f9501a014f7b2330311.jpg','Assortment of gourmet chocolates for indulgent treats.',30,50,NULL,NULL,15,28,'2024-01-07 12:59:20',NULL,NULL),
(153,'Organic Coconut Oil (750ml)','https://i.pinimg.com/736x/f6/68/ef/f668efad78dc6033c120b187f1f56589.jpg','Certified organic coconut oil for cooking and skincare.',25,110,NULL,NULL,15,28,'2024-01-07 12:59:20',NULL,NULL),
(154,'Artisanal Bread Selection','https://i.pinimg.com/564x/a4/1a/33/a41a33e5748b689aca7d66e1b80e2f3c.jpg','Selection of artisanal bread for a delicious and hearty meal.',15,40,NULL,NULL,15,28,'2024-01-07 12:59:20',NULL,NULL),
(155,'Premium Coffee Beans (1kg)','https://i.pinimg.com/564x/73/42/3b/73423b19855f1244f0f7f1b7e64d91c8.jpg','High-quality premium coffee beans for a rich and flavorful brew.',28,75,NULL,NULL,15,28,'2024-01-07 12:59:20',NULL,NULL),
(156,'Mechanical Gaming Keyboard','https://i.pinimg.com/564x/d5/2f/be/d52fbe0e4c5e589f7dba32c466c96c74.jpg','RGB backlit mechanical gaming keyboard with customizable keys.',75,50,NULL,NULL,16,24,'2024-01-07 12:59:20',NULL,NULL),
(157,'Wireless Bluetooth Keyboard','https://i.pinimg.com/564x/e5/63/ec/e563ec022edc58d70bba4274771a25be.jpg','Slim and portable wireless Bluetooth keyboard for tablets and smartphones.',30,80,NULL,NULL,16,24,'2024-01-07 12:59:20',NULL,NULL),
(158,'Mechanical Typing Keyboard','https://i.pinimg.com/736x/89/78/4b/89784b08c903d1640c62d3fee2a2fcd4.jpg','Classic mechanical keyboard with tactile switches for comfortable typing.',60,60,NULL,NULL,16,24,'2024-01-07 12:59:20',NULL,NULL),
(159,'Programmable Gaming Keypad','https://i.pinimg.com/564x/dc/4d/1f/dc4d1f457939b710d28bf97a7ed34487.jpg','Programmable gaming keypad with customizable macro keys for enhanced gameplay.',45,40,NULL,NULL,16,24,'2024-01-07 12:59:20',NULL,NULL),
(160,'Ergonomic Split Keyboard','https://i.pinimg.com/564x/c8/53/a4/c853a41bba4768782daed6a7e2038b3e.jpg','Ergonomic split keyboard design for improved comfort and reduced strain.',80,30,NULL,NULL,16,24,'2024-01-07 12:59:20',NULL,NULL),
(161,'Compact Mechanical Keyboard','https://i.pinimg.com/736x/d8/52/51/d852518aebb7beae7ed406b192dda527.jpg','Compact and space-saving mechanical keyboard for efficient desk use.',50,70,NULL,NULL,16,24,'2024-01-07 12:59:20',NULL,NULL),
(162,'Wireless Mechanical Keypad','https://i.pinimg.com/564x/c1/e0/ed/c1e0edca365f8f6b1f551674eff62894.jpg','Wireless mechanical keypad for convenient number input and calculations.',35,55,NULL,NULL,16,24,'2024-01-07 12:59:20',NULL,NULL),
(163,'Backlit Gaming Keypad','https://i.pinimg.com/564x/6a/0a/2f/6a0a2f833f8358c75cbc3c5af527a923.jpg','Backlit gaming keypad with customizable RGB lighting for a stylish setup.',55,45,NULL,NULL,16,24,'2024-01-07 12:59:20',NULL,NULL),
(164,'Numeric Keypad with USB','https://i.pinimg.com/564x/c2/10/4a/c2104a6603eae8d15c7e0775eaccd546.jpg','Numeric keypad with USB connectivity for quick and easy number entry.',25,75,NULL,NULL,16,24,'2024-01-07 12:59:20',NULL,NULL),
(165,'Ultra-Thin Bluetooth Keyboard','https://i.pinimg.com/564x/70/be/f5/70bef595868833e163e5d35e221a48c0.jpg','Ultra-thin Bluetooth keyboard with responsive keys for on-the-go use.',40,65,NULL,NULL,16,24,'2024-01-07 12:59:20',NULL,NULL),
(166,'Pet Food - Premium Mix','https://i.pinimg.com/564x/1a/a2/c3/1aa2c36fc739c273196db7b531ab66b9.jpg','Nutrient-rich premium pet food mix.',30,50,NULL,NULL,17,7,'2024-01-07 12:59:20',NULL,NULL),
(167,'Dog Leash with Reflectors','https://i.pinimg.com/564x/fc/d9/69/fcd969027a672661f920c4df3b6a05ae.jpg','Durable leash with reflective strips for safety.',15,40,NULL,NULL,17,7,'2024-01-07 12:59:20',NULL,NULL),
(168,'Cat Scratching Post','https://i.pinimg.com/564x/b2/93/28/b29328ff2b891fcc50ddec074f369f87.jpg','Interactive scratching post for cats.',20,30,NULL,NULL,17,7,'2024-01-07 12:59:20',NULL,NULL),
(169,'Aquarium Starter Kit','https://i.pinimg.com/564x/71/fc/f8/71fcf834d72131b64278dd1214d4d752.jpg','Complete kit for starting your aquarium.',50,20,NULL,NULL,17,7,'2024-01-07 12:59:20',NULL,NULL),
(170,'Small Animal Cage','https://i.pinimg.com/564x/27/20/e7/2720e761962e40a2cfb130fa455f7577.jpg','Spacious cage for small pets like hamsters.',25,25,NULL,NULL,17,7,'2024-01-07 12:59:20',NULL,NULL),
(171,'Bird Cage with Perch','https://i.pinimg.com/564x/86/d2/63/86d2631e2dbcaf92dfb2eff6dd787254.jpg','Comfortable cage with perch for birds.',35,15,NULL,NULL,17,7,'2024-01-07 12:59:20',NULL,NULL),
(172,'Pet Grooming Kit','https://i.pinimg.com/564x/15/6b/ce/156bce1ab86ca4f4acba292baf52fb89.jpg','Complete grooming kit for dogs and cats.',40,20,NULL,NULL,17,7,'2024-01-07 12:59:20',NULL,NULL),
(173,'Reptile Heating Lamp','https://i.pinimg.com/564x/cb/ed/7c/cbed7cb913a598d0a3cdb2248927eb61.jpg','Heat lamp for reptile terrariums.',18,30,NULL,NULL,17,7,'2024-01-07 12:59:20',NULL,NULL),
(174,'Fish Tank Decorations','https://i.pinimg.com/564x/a1/67/9f/a1679f39859dd3bcfc7a3a2ccbf90296.jpg','Colorful decorations for your fish tank.',12,40,NULL,NULL,17,7,'2024-01-07 12:59:20',NULL,NULL),
(175,'Pet Travel Carrier','https://i.pinimg.com/736x/93/52/14/9352140c60e529721a55a4a6f0a48b45.jpg','Portable carrier for pets on the go.',35,10,NULL,NULL,17,7,'2024-01-07 12:59:20',NULL,NULL),
(176,'Gardening Tool Set','https://i.pinimg.com/736x/8b/62/29/8b6229f2a569a323ffe41e7e5293d4a6.jpg','Complete set for your gardening needs.',29,50,NULL,NULL,18,29,'2024-01-07 12:59:20',NULL,NULL),
(177,'Floral Pruning Shears','https://i.pinimg.com/564x/c8/56/27/c856279b5f7fd76b3076866615db4fe9.jpg','High-quality shears for precise pruning.',15,30,NULL,NULL,18,29,'2024-01-07 12:59:20',NULL,NULL),
(178,'Decorative Flower Pots','https://i.pinimg.com/564x/72/8e/a2/728ea2a5a01db5bdf44c9383b461a65b.jpg','Colorful pots to enhance your garden.',12,100,NULL,NULL,18,29,'2024-01-07 12:59:20',NULL,NULL),
(179,'Garden Soil Fertilizer','https://i.pinimg.com/564x/ee/30/fa/ee30fa2b46a1007ae5dc21dfd41489c2.jpg','Enriched fertilizer for healthy plants.',20,40,NULL,NULL,18,29,'2024-01-07 12:59:20',NULL,NULL),
(180,'LED Solar Garden Lights','https://i.pinimg.com/564x/8c/37/a0/8c37a03926b4ec9f80596d584ec7578e.jpg','Energy-efficient lights for your garden.',35,25,NULL,NULL,18,29,'2024-01-07 12:59:20',NULL,NULL),
(181,'Garden Hose with Nozzle','https://i.pinimg.com/564x/a6/aa/7c/a6aa7c6c83bfd56486bc97d8874f96d2.jpg','Durable hose with adjustable nozzle.',18,60,NULL,NULL,18,29,'2024-01-07 12:59:20',NULL,NULL),
(182,'Rustic Wooden Plant Stand','https://i.pinimg.com/564x/49/1e/f4/491ef42132e41ec53bf3f37896912657.jpg','Elevate your plants with this stylish stand.',25,20,NULL,NULL,18,29,'2024-01-07 12:59:20',NULL,NULL),
(183,'Garden Gloves with Grips','https://i.pinimg.com/564x/8b/30/5b/8b305b38a766edafdcef34018194aa1d.jpg','Comfortable gloves with non-slip grips.',10,75,NULL,NULL,18,29,'2024-01-07 12:59:20',NULL,NULL),
(184,'Garden Kneeler and Seat','https://i.pinimg.com/564x/bb/fa/72/bbfa728c29de03e879112c269f58992e.jpg','Convenient kneeler for comfortable gardening.',30,15,NULL,NULL,18,29,'2024-01-07 12:59:20',NULL,NULL),
(185,'Hanging Flower Basket','https://i.pinimg.com/564x/cb/57/13/cb5713fdf1404ae8406c64514ce58071.jpg','Attractive baskets for hanging plants.',22,35,NULL,NULL,18,29,'2024-01-07 12:59:20',NULL,NULL),
(186,'Wooden Dining Table','https://i.pinimg.com/564x/28/6c/31/286c3172c5ecaef8bdb74a970b477239.jpg','Solid wood dining table with elegant design.',250,15,NULL,NULL,19,6,'2024-01-07 12:59:20',NULL,NULL),
(187,'Leather Sofa Set','https://i.pinimg.com/564x/fe/22/ae/fe22ae1581157504dee9a280c9252d73.jpg','Luxurious leather sofa set for your living room.',600,8,NULL,NULL,19,6,'2024-01-07 12:59:20',NULL,NULL),
(188,'Modern Coffee Table','https://i.pinimg.com/564x/51/06/59/51065945203dcaed51eedc02e606ad7b.jpg','Sleek and stylish coffee table for your lounge.',120,20,NULL,NULL,19,6,'2024-01-07 12:59:20',NULL,NULL),
(189,'Wardrobe with Mirror','https://i.pinimg.com/564x/b5/e1/86/b5e1869fe7281e4d119197753a784043.jpg','Spacious wardrobe with full-length mirror.',350,10,NULL,NULL,19,6,'2024-01-07 12:59:20',NULL,NULL),
(190,'Bedroom Dresser','https://i.pinimg.com/564x/bb/f2/4f/bbf24f0b58fc6cf48a7c8b14f1fd6db0.jpg','Elegant dresser for your bedroom storage needs.',180,18,NULL,NULL,19,6,'2024-01-07 12:59:20',NULL,NULL),
(191,'L-shaped Office Desk','https://i.pinimg.com/736x/93/3f/f8/933ff80ef94a406b97928369e3b41b57.jpg','Functional L-shaped desk for your home office.',280,12,NULL,NULL,19,6,'2024-01-07 12:59:20',NULL,NULL),
(192,'Bookshelf with Cabinets','https://i.pinimg.com/564x/04/26/b8/0426b8c1c4deff1df18ecfa3ca93afda.jpg','Versatile bookshelf with additional storage cabinets.',150,25,NULL,NULL,19,6,'2024-01-07 12:59:20',NULL,NULL),
(193,'Recliner Lounge Chair','https://i.pinimg.com/736x/ae/3b/da/ae3bda54d4e9d24fba0d3323a9b54cc4.jpg','Comfortable recliner chair for relaxation.',200,10,NULL,NULL,19,6,'2024-01-07 12:59:20',NULL,NULL),
(194,'Outdoor Patio Set','https://i.pinimg.com/564x/ee/cc/5a/eecc5a84b3314af41e7b6f9219eccf27.jpg','Weather-resistant patio furniture set.',450,6,NULL,NULL,19,6,'2024-01-07 12:59:20',NULL,NULL),
(195,'Ergonomic Office Chair','https://i.pinimg.com/736x/ea/5f/4e/ea5f4e02ad11234e2c328f51da9b20a1.jpg','Adjustable and supportive office chair.',120,15,NULL,NULL,19,6,'2024-01-07 12:59:20',NULL,NULL),
(196,'Elegant Dark Purple Dress Size L','https://i.pinimg.com/474x/b8/a9/0a/b8a90ae51fa3eeedb8d9942239270548.jpg','Elegant Dark Purple Dress, Size : L, Material : Silk',2000000,4,NULL,NULL,2,31,'2024-01-04 08:13:11',NULL,NULL),
(197,'Red White Dress Size M','https://i.pinimg.com/474x/06/13/ff/0613ffa2fc99e6e7ba59945b2e54e089.jpg','In good conditions, for cosplay',1500000,1,NULL,NULL,2,31,'2024-01-04 08:32:29',NULL,NULL),
(198,'Floral Red Elegant Dress Size M','https://i.pinimg.com/474x/05/80/d7/0580d7fe79c690fc768c69162dfffdb8.jpg','Magnificent Beautiful Floral Red Dress, Size M, Material Silk',3000000,2,NULL,NULL,2,31,'2024-01-04 08:49:01',NULL,NULL),
(199,'Guitar','https://i.pinimg.com/564x/37/7c/71/377c71088694d6d71bec12dea5c66ddd.jpg','High-quality acoustic guitar for professionals',500,10,NULL,NULL,20,25,'2024-01-07 12:59:20',NULL,NULL),
(200,'Piano','https://i.pinimg.com/564x/f6/56/f1/f656f1d120da13b2cde9211a9f822522.jpg','Digital piano with weighted keys',800,15,NULL,NULL,20,25,'2024-01-07 12:59:20',NULL,NULL),
(201,'Violin','https://i.pinimg.com/736x/3a/11/0d/3a110d92a6d2a894a792db4dca88c0c8.jpg','Handcrafted violin with bow and case',300,20,NULL,NULL,20,25,'2024-01-07 12:59:20',NULL,NULL),
(202,'Drum Set','https://i.pinimg.com/736x/29/2b/06/292b06a448605bffc25b1d1fa85a1d2c.jpg','Complete drum set with cymbals',700,12,NULL,NULL,20,25,'2024-01-07 12:59:20',NULL,NULL),
(203,'Trumpet','https://i.pinimg.com/736x/42/6f/8b/426f8b32d45fbc387c200cce771031ab.jpg','Brass trumpet for beginners and intermediates',250,18,NULL,NULL,20,25,'2024-01-07 12:59:20',NULL,NULL),
(204,'Saxophone','https://i.pinimg.com/564x/48/f4/03/48f4032e2a5849a64ecf24e5d597c9e5.jpg','Alto saxophone with case and accessories',600,8,NULL,NULL,20,25,'2024-01-07 12:59:20',NULL,NULL),
(205,'Keyboard','https://i.pinimg.com/564x/54/7a/3f/547a3fdba8a1ef0a70942efc4f1f85f2.jpg','Portable electronic keyboard with touch-sensitive keys',400,25,NULL,NULL,20,25,'2024-01-07 12:59:20',NULL,NULL),
(206,'Flute','https://i.pinimg.com/736x/16/41/41/1641413f873c0f14e040f5e069d58ba3.jpg','Silver-plated flute for classical music enthusiasts',350,22,NULL,NULL,20,25,'2024-01-07 12:59:20',NULL,NULL),
(207,'Electric Guitar','https://i.pinimg.com/564x/2d/1a/d8/2d1ad86826bd9d4c2f7eb3e3b09d9381.jpg','Solid body electric guitar for rock and metal',450,14,NULL,NULL,20,25,'2024-01-07 12:59:20',NULL,NULL),
(208,'Cello','https://i.pinimg.com/564x/d7/bd/1a/d7bd1aa94ee00efcf5a962b2a5aa9f37.jpg','Full-size cello for advanced players',900,10,NULL,NULL,20,25,'2024-01-07 12:59:20',NULL,NULL);

/*Table structure for table `store` */

DROP TABLE IF EXISTS `store`;

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(50) NOT NULL,
  `store_email` varchar(50) NOT NULL,
  `store_img` text DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `store` */

insert  into `store`(`store_id`,`store_name`,`store_email`,`store_img`,`store_address`,`user_id`,`store_revenue`,`store_status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Chic Trends','chictrends@example.com','https://i.pinimg.com/564x/56/7f/e3/567fe35fe2ac8b7c3f66567fa9c32194.jpg','123 Fashion Street, Styleville',31,3500,1,'2022-02-01 09:00:00',NULL,NULL),
(2,'Gastronomic Delights','gastronomicdelights@example.com','https://i.pinimg.com/564x/a5/11/bc/a511bccf15b4fc2fe542ede50fd1d950.jpg','456 Culinary Court, Foodland',2,5000,1,'2022-02-02 11:30:00',NULL,NULL),
(3,'Innovative Electronics','innovativeelectronics@example.com','https://i.pinimg.com/564x/3d/30/ea/3d30eae83fcbc6453dbf23c0acd94e27.jpg','789 Tech Terrace, Technoville',3,2000,1,'2022-02-03 14:45:00',NULL,NULL),
(4,'Cozy Book Nook','cozybooknook@example.com','https://i.pinimg.com/564x/d4/56/b4/d456b4e55d999a4c4bf34e5e3324be58.jpg','567 Literary Lane, Booksville',4,8000,1,'2022-02-04 16:20:00',NULL,NULL),
(5,'Sports Haven','sportshaven@example.com','https://i.pinimg.com/564x/ca/f5/7e/caf57e0296a8329e657d540d3f68a477.jpg','234 Active Avenue, Fitness City',5,4500,1,'2022-02-05 10:10:00',NULL,NULL),
(6,'Home Decor Hub','decorhub@example.com','https://i.pinimg.com/564x/ed/b9/ee/edb9eea05fd4e3e0d4ce0b7d99c3ff40.jpg','789 Homestead Street, Decor Town',6,6000,1,'2022-02-06 12:40:00',NULL,NULL),
(7,'Pet Paradise','petparadise@example.com','https://i.pinimg.com/564x/a8/9d/00/a89d00aeb784f5b59b7e8564014c055c.jpg','123 Pet Haven, Animal City',7,2500,1,'2022-02-07 14:30:00',NULL,NULL),
(8,'Urban Bag Trends','urbanbagtrends@example.com','https://i.pinimg.com/564x/49/5b/5f/495b5fd1d799959e34362eed9ece8720.jpg','456 Urban Lane, Urbancity',8,3000,1,'2022-02-08 18:15:00',NULL,NULL),
(9,'Outdoor Adventure Gear','outdooradventure@example.com','https://i.pinimg.com/564x/b8/47/a6/b847a65beeef6a4d9f553bed10f87d25.jpg','567 Exploration Street, Adventureland',9,8000,1,'2022-02-09 08:45:00',NULL,NULL),
(10,'Vintage Treasures','vintagetreasures@example.com','https://i.pinimg.com/736x/dc/14/3e/dc143e618120277ee04a342491ce4b5f.jpg','890 Retro Road, Nostalgia City',10,3500,1,'2022-02-10 11:20:00',NULL,NULL),
(11,'Luxury Living','luxuryliving@example.com','https://i.pinimg.com/564x/e2/c4/cd/e2c4cd79206f8539da4afe964774d80a.jpg','123 Opulence Avenue, Elegance Town',11,5000,1,'2022-02-11 13:40:00',NULL,NULL),
(12,'Healthy Bites','healthybites@example.com','https://i.pinimg.com/736x/3c/aa/28/3caa28fa5d82b6ecd52ebb0e7dc73000.jpg','456 Nutritional Street, Wellness City',12,2000,1,'2022-02-12 15:30:00',NULL,NULL),
(13,'Artistic Expressions','artisticexpressions@example.com','https://i.pinimg.com/736x/48/fa/ac/48faac51155b35b641aff583dc2f734d.jpg','789 Creativity Court, Artland',13,8000,1,'2022-02-13 09:10:00',NULL,NULL),
(14,'Fashion Forward','fashionforward@example.com','https://i.pinimg.com/564x/d7/27/80/d72780fd79c484f64e9bde4ed03715e1.jpg','567 Trendy Terrace, Style City',14,4500,1,'2022-02-14 12:35:00',NULL,NULL),
(15,'Culinary Crafts','culinarycrafts@example.com','https://i.pinimg.com/564x/fc/aa/fa/fcaafa7d3c00c9aba2c844e407027a17.jpg','234 Culinary Court, Foodville',15,6000,1,'2022-02-15 14:20:00',NULL,NULL),
(16,'Cooking Paradise','cookingparadise@example.com','https://i.pinimg.com/564x/5e/98/8f/5e988ff496d71d18a98b9752f7640c06.jpg','789 Tech Terrace, Technoville',16,2500,1,'2022-02-16 16:45:00',NULL,NULL),
(17,'Cozy Corner Bookstore','cozycorner@example.com','https://i.pinimg.com/564x/e9/60/a0/e960a07ea0673ef42ae944b3143ee51e.jpg','567 Literary Lane, Booksville',17,3000,1,'2022-02-17 10:30:00',NULL,NULL),
(18,'Spirited Sports','spiritedsports@example.com','https://i.pinimg.com/564x/8e/f5/85/8ef585f2c4ca653138cb70bb07b25322.jpg','123 Active Avenue, Fitness City',18,8000,1,'2022-02-18 12:15:00',NULL,NULL),
(19,'Elegant Homeware','eleganthomeware@example.com','https://i.pinimg.com/564x/14/d9/57/14d957c8e9428305a3976a25d7051aab.jpg','456 Homestead Street, Decor Town',19,3500,1,'2022-02-19 14:30:00',NULL,NULL),
(20,'Pet Palace','petpalace@example.com','https://i.pinimg.com/564x/75/1e/05/751e051f5498d537b2426ee1c35c0882.jpg','789 Pet Haven, Animal City',20,5000,1,'2022-02-20 16:20:00',NULL,NULL),
(21,'Toys Trends','toystrends@example.com','https://i.pinimg.com/564x/38/72/af/3872af5b9b94796b7ff4ed5c25fcf207.jpg','234 Innovation Lane, Technocity',21,2000,1,'2022-02-21 11:45:00',NULL,NULL),
(22,'Outdoor Oasis','outdooroasis@example.com','https://i.pinimg.com/564x/38/15/cf/3815cf638531a4d97b2c71ecc2fda51f.jpg','567 Exploration Street, Adventureland',22,4500,1,'2022-02-22 14:30:00',NULL,NULL),
(23,'Vintage Values','vintagevalues@example.com','https://i.pinimg.com/564x/21/13/73/211373642d27db792880c6ba5a01d815.jpg','890 Retro Road, Nostalgia City',23,6000,1,'2022-02-23 17:00:00',NULL,NULL),
(24,'Keyboard Kingdom','keyboardkingdom@example.com','https://i.pinimg.com/564x/f2/3b/21/f23b218dcefa06d734e593b2d80b6555.jpg','123 Opulence Avenue, Elegance Town',24,2500,1,'2022-02-24 09:30:00',NULL,NULL),
(25,'Music Hub','musichub@example.com','https://i.pinimg.com/736x/c8/1c/53/c81c530de359208a60adc245382d1e75.jpg','456 Nutritional Street, Wellness City',25,3000,1,'2022-02-25 12:15:00',NULL,NULL),
(26,'Artistic Inspirations','artisticinspirations@example.com','https://i.pinimg.com/564x/0c/ec/e6/0cece6d7749bac9a07a64d2f59ce5c05.jpg','789 Creativity Court, Artland',26,8000,1,'2022-02-26 14:45:00',NULL,NULL),
(27,'Chic Couture','chiccouture@example.com','https://i.pinimg.com/564x/7c/ce/91/7cce91171ce9e290635527470b434ade.jpg','567 Trendy Terrace, Style City',27,4500,1,'2022-02-27 17:30:00',NULL,NULL),
(28,'Culinary Creations','culinarycreations@example.com','https://i.pinimg.com/564x/9f/45/22/9f4522804779ac9a22032ec02adea640.jpg','234 Culinary Court, Foodville',28,6000,1,'2022-02-28 09:45:00',NULL,NULL),
(29,'GreenThumb Garden Supplies','greenthumbgardensupplies@example.com','https://i.pinimg.com/736x/1e/ba/4d/1eba4d3933dd1e0ad1578a05444ba263.jpg','234 garden Court, Gardenville',35,6600,1,'2022-02-28 09:45:00',NULL,NULL),
(30,'Footwear Haven','footwearhaven@example.com','https://i.pinimg.com/564x/50/98/0c/50980c03b2e1238431c084e4001dcf57.jpg','234 foot Court, Footville',29,6900,1,'2022-02-28 09:45:00',NULL,NULL),
(31,'Ella Fashion Store','ellasfashion@example.com','https://i.pinimg.com/474x/ec/0d/31/ec0d31d5c31b84f10072ab90dbde9934.jpg','234 Fashion Show street, Sydney',30,0,1,'2024-01-04 07:04:20','2024-01-04 07:36:48',NULL);

/*Table structure for table `topup` */

DROP TABLE IF EXISTS `topup`;

CREATE TABLE `topup` (
  `topup_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `topup_saldo` int(11) NOT NULL CHECK (`topup_saldo` > 0),
  `topup_status` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`topup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `topup` */

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`user_id`,`user_email`,`user_password`,`user_name`,`user_nama`,`user_money`,`user_role`,`user_img`,`user_gender`,`user_phone`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'admin@gmail.com','$2y$12$PTi99ULbUknumwIAiKb47.GblGx9YQrqMVM0GkZ.r1flE9fctrBAi','admin','Admin',0,'Admin',NULL,'P','0223421244','2023-12-28 14:20:29','2023-12-28 14:20:29',NULL),
(2,'john.doe@example.com','$2y$12$FH.zrmGpehpsfLUZdfDq0uZ1w1YAMSn82kX1QPitfcy8vZ/OlrNN6','JohnDoe','John Doe',0,'storeOwner',NULL,'P','123-456-7890','2024-01-02 16:12:39','2024-01-02 16:12:39',NULL),
(3,'jane.doe@example.com','$2y$12$SI5cFE/PBh6oPek489gTEe1hK1cCftkue8MbOS.iHp9f66UuLwj/y','JaneDoe','Jane Doe',0,'storeOwner',NULL,'W','987-654-3210','2024-01-02 16:18:41','2024-01-02 16:18:41',NULL),
(4,'bob.johnson@example.com','$2y$12$Kk2QlxSYjiz9ArH1Il4Dz.Pf8uq5M4qVU.qYaJu7EnKM8mMTVAEyS','bobjohnson','Bob Johnson',0,'storeOwner',NULL,'P','567-890-1234','2024-01-02 16:19:59','2024-01-02 16:19:59',NULL),
(5,'samantha.white@example.com','$2y$12$8mBfUECOWJ5X6HSiKuSbEOSvEMgdEL3xb9DtmH6Ji/pe/vq1NH7Dq','samanthawhite','Samantha White',0,'storeOwner',NULL,'W','345-678-9012','2024-01-02 16:22:36','2024-01-02 16:22:36',NULL),
(6,'michael.smith@example.com','$2y$12$o6e0t0HnuDbDZcIB0zozAu3chtpkM0EDjmzD7FnfnA/VWwRLSyJZG','michaelsmith','Michael Smith',0,'storeOwner',NULL,'W','876-543-2109','2024-01-02 16:25:28','2024-01-02 16:25:28',NULL),
(7,'ella.davis@example.com','$2y$12$WOH2S1AeS8R.BL64n.KJl.3SekPBWx872FchdVOLu2D/2Seh6S5cq','elladavis','Ella Davis',0,'storeOwner',NULL,'W','234-567-8901','2024-01-02 16:26:59','2024-01-02 16:26:59',NULL),
(8,'matthew.brown@example.com','$2y$12$hIdds0ONL2ivDXcskIlmr.QV2i1kb8F8aqLlkmmPqaKx2snuEoojG','matthewbrown','Matthew Brown',0,'storeOwner',NULL,'P','789-012-3456','2024-01-02 16:28:36','2024-01-02 16:28:36',NULL),
(9,'olivia.miller@example.com','$2y$12$SZMRfMuycESS/Y/92KvkPOUB5D0sPTOeuWLpwVUAXNAQL/Nqs948S','oliviamiller','Olivia Miller',0,'storeOwner',NULL,'W','210-987-6543','2024-01-02 16:29:58','2024-01-02 16:29:58',NULL),
(10,'david.taylor@example.com','$2y$12$tPzvqVK8DqhmaSpcndslCOPQQjTEtLYYrurIljz6HwIt2mAVm/EnC','davidtaylor','David Taylor',0,'storeOwner',NULL,'P','432-109-8765','2024-01-02 16:31:09','2024-01-02 16:31:09',NULL),
(11,'sophia.wilson@example.com','$2y$12$0phOpIm9b.JMm.HIJx2ps.syjo3Qc1ycayMyzKHcigOx5apwM6L5a','sophiawilson','Sophia Wilson',0,'storeOwner',NULL,'W','109-876-5432','2024-01-02 16:32:03','2024-01-02 16:32:03',NULL),
(12,'daniel.martinez@example.com','$2y$12$KYVGOgCd0ufQFym9NALRkO8zSgPiFm3sTYhpLVR4WNM/9UsuktV0G','danielmartinez','Daniel Martinez',0,'storeOwner',NULL,'P','678-345-0123','2024-01-02 16:32:41','2024-01-02 16:32:41',NULL),
(13,'ava.jackson@example.com','$2y$12$5o09MOCgblez5CHdEcLR4.eLKFzFsCVwqxt67d56a21oZTBn5Q3ju','avajackson','Ava Jackson',0,'storeOwner',NULL,'W','345-678-9012','2024-01-02 16:33:24','2024-01-02 16:33:24',NULL),
(14,'josephine.garcia@example.com','$2y$12$LQThDTAG26oqO5LgrwMlOO3M/ciyYtaOjqx/WWGgX445Si8X3uOEO','josephinegarcia','Josephine Garcia',0,'storeOwner',NULL,'W','012-345-6789','2024-01-02 16:34:52','2024-01-02 16:34:52',NULL),
(15,'lucas.rodriguez@example.com','$2y$12$cCUxmj6xxvSaRO1I6tElAOkvH8z/7Rd.rZ7sFYm7EpzAzmPgZCTai','lucasrodriguez','Lucas Rodriguez',0,'storeOwner',NULL,'P','567-890-1234','2024-01-02 16:35:37','2024-01-02 16:35:37',NULL),
(16,'isabella.lopez@example.com','$2y$12$sWKQnGVDzdOFUReFhiFuG./ozvyCY3BUlWi2aMHNZT0SeulUcka5u','isabellalopez','Isabella Lopez',0,'storeOwner',NULL,'W','234-567-8901','2024-01-02 16:37:11','2024-01-02 16:37:11',NULL),
(17,'benjamin.smith@example.com','$2y$12$O9sLmkERkqJayejFjfVmQuAO8aWBSeL0pkYEqtuWn0LZqph3pGgPS','benjaminsmith','Benjamin Smith',0,'storeOwner',NULL,'P','789-012-3456','2024-01-02 16:37:45','2024-01-02 16:37:45',NULL),
(18,'mia.davis@example.com','$2y$12$Ku1990hwLrbFGI6B2bwnWuIb24FmUs3gXDkNNe5JClA6I8GfnWKwe','miadavis','Mia Davis',0,'storeOwner',NULL,'W','210-987-6543','2024-01-02 16:38:39','2024-01-02 16:38:39',NULL),
(19,'elijah.johnson@example.com','$2y$12$8yC.3zmYRWzTsCuSuT.0zOV4EGqgpX2TFjuAGfaoJtCBe2rBZL7O6','elijahjohnson','Elijah Johnson',0,'storeOwner',NULL,'W','432-109-8765','2024-01-02 16:40:14','2024-01-02 16:40:14',NULL),
(20,'scarlett.taylor@example.com','$2y$12$6qE6FtjT1ROA2hqvZeaLde6RjlKapJZkXBQk25.Z0UBguowQZI8om','scarletttaylor','Scarlett Taylor',0,'storeOwner',NULL,'W','109-876-5432','2024-01-02 16:41:11','2024-01-02 16:41:11',NULL),
(21,'lucas.martinez@example.com','$2y$12$NgFSJk.68/2KUjTwvbqJuuLdyDM2422zUMG4X9I02F8JpFDecgCtK','lucasmartinez','Lucas Martinez',0,'storeOwner',NULL,'P','678-345-0123','2024-01-02 16:42:10','2024-01-02 16:42:10',NULL),
(22,'aria.garcia@example.com','$2y$12$4XLbYmViOHzzjx.aJOMaTuQgbZWv14xcm70W.6T4cLHSYZ9NOueSe','ariagarcia','Aria Garcia',0,'storeOwner',NULL,'W','345-678-9012','2024-01-02 16:43:42','2024-01-02 16:43:42',NULL),
(23,'henry.wilson@example.com','$2y$12$dOdxaFYjLXsXKzbXc/Yu7uC9TPH2D6d4WtJM8q19VcocnnS1sozQi','henrywilson','Henry Wilson',0,'storeOwner',NULL,'P','012-345-6789','2024-01-02 16:45:06','2024-01-02 16:45:06',NULL),
(24,'emma.jackson@example.com','$2y$12$LkTScVtyxEUVo2WVdnhFWe66J8Kw4dQpcWSnezbADzKNYdDmQjp2e','emmajackson','Emma Jackson',0,'storeOwner',NULL,'W','567-890-1234','2024-01-02 16:45:53','2024-01-02 16:45:53',NULL),
(25,'liam.miller@example.com','$2y$12$HJklDw3rg8SFLq.Uo6KRde9T5qzHYvM2ziAD4KS4sDOFqe8POnRWO','liammiller','Liam Miller',0,'storeOwner',NULL,'P','789-012-3456','2024-01-02 16:46:50','2024-01-02 16:46:50',NULL),
(26,'olivia.smith@example.com','$2y$12$ApHTCvttnIGO.MdpM6Qvkei9nsupgvG/n0NyRTegZ2H46TVI9G1vi','oliviasmith','Olivia Smith',0,'storeOwner',NULL,'W','210-987-6543','2024-01-02 16:47:30','2024-01-02 16:47:30',NULL),
(27,'noah.taylor@example.com','$2y$12$Xfrw1z.4pjHxh1.vwLeB4ODgQ8SHYN/4pBsOsT60yvjKkST5cZ5TS','noahtaylor','Noah Taylor',0,'storeOwner',NULL,'W','432-109-8765','2024-01-02 16:48:13','2024-01-02 16:48:13',NULL),
(28,'ava.johnson@example.com','$2y$12$fPu65YhW16F2PeVjU8pphOK.ggRYiJjsOFVryQ8irpdi8ndCC5kBG','avajohnson','Ava Johnson',0,'storeOwner',NULL,'W','109-876-5432','2024-01-02 16:49:17','2024-01-02 16:49:17',NULL),
(29,'liam.davis@example.com','$2y$12$d1UBgBEJ/eQ1Sbq8MWISsu19athTu4Ujdf7tglME1QrSz9Eb1HIYe','liamdavis','Liam Davis',0,'storeOwner',NULL,'P','678-345-0123','2024-01-02 16:50:25','2024-01-02 16:50:25',NULL),
(30,'emma.martinez@example.com','$2y$12$kPwQq69i9GP/v7KjdnksmuTf6UY7mmQGisA6XHcs2JhdE6JvU45bK','emmamartinez','Emma Martinez',0,'storeOwner',NULL,'W','012-345-6789','2024-01-02 16:51:03','2024-01-02 16:51:03',NULL),
(31,'emma.miller@example.com','$2y$12$mxG.2ZCfTAg25P2nYxFn.uzXOcmGYilQJKLWRu5cRJ2Q1vc6UXeqW','emmamiller','Emma Miller',0,'storeOwner',NULL,'W','234-567-8901','2024-01-02 16:54:04','2024-01-02 16:54:04',NULL),
(32,'oliver.taylor@example.com','$2y$12$kTTGUwnTGvXn7/twYt7bD.uG9Ns9aaQ8F4hn2G9iphZER5T5eO4za','olivertaylor','Oliver Taylor',0,'Customer',NULL,'W','789-012-3456','2024-01-02 16:54:38','2024-01-02 16:54:38',NULL),
(33,'mia.rodriguez@example.com','$2y$12$2vGxyqsRvzB67RSXc6pwner0i351HzEzy8VX7A68z3Y3fR9n8em0q','miarodriguez','Mia Rodriguez',0,'Customer',NULL,'W','210-987-6543','2024-01-02 16:55:53','2024-01-02 16:55:53',NULL),
(34,'daniel.jones@example.com','$2y$12$8KeOnKCOVywNkJwDXxHYB.gQM2ITZGltp1XDBSR/.dcdcUY0xlMKu','danieljones','Daniel Jones',0,'Customer',NULL,'P','432-109-8765','2024-01-02 16:56:41','2024-01-02 16:56:41',NULL),
(35,'olivia.jackson@example.com','$2y$12$0S88JO7lmNYkuMeBrwLIkuQkL3nUdLZNx4sP.nh4TbSWuSB06IiHO','oliviajackson','Olivia Jackson',0,'Customer',NULL,'W','109-876-5432','2024-01-02 16:57:30','2024-01-02 16:57:30',NULL),
(36,'william.wilson@example.com','$2y$12$t28gMI.0XD/GAAWjpPBW6efbo.K4RLbgve7ylWizk0i6aOU6G9I.2','williamwilson','William Wilson',0,'Customer',NULL,'P','876-543-2109','2024-01-02 16:58:11','2024-01-02 16:58:11',NULL),
(37,'mia.hernandez@example.com','$2y$12$zEy.1U9ct39qgjDxQF7SBuYO8rZ3oRh9RdVl1Ck5qFhMwh3iEQW2.','miahernandez','Mia Hernandez',0,'Customer',NULL,'W','345-678-9012','2024-01-02 16:58:39','2024-01-02 16:58:39',NULL),
(38,'jackson.martin@example.com','$2y$12$pHJPT8HerajdIkiswCd0z.Mbe2j5sJAq8of/8MwixNW/30mNYGhbG','jacksonmartin','Jackson Martin',0,'Customer',NULL,'P','678-345-0123','2024-01-02 16:59:31','2024-01-02 16:59:31',NULL),
(39,'ava.hernandez@example.com','$2y$12$.w5WR/4McUQ9Ea2Y77Oql..BlFV8Pk0xWs.Y.HttrNnLEbHrevqia','avahernandez','Ava Hernandez',0,'Customer',NULL,'W','345-678-9012','2024-01-02 17:00:54','2024-01-02 17:00:54',NULL),
(40,'oliver.martinez@example.com','$2y$12$.BdouEN3HoBVSCCvrRx7kerUE7rCT5F3UJ/SXEE.jppqAkKg6vbWS','olivermartinez','Oliver Martinez',0,'Customer',NULL,'W','012-345-6789','2024-01-02 17:01:27','2024-01-02 17:01:27',NULL),
(41,'adminkurir@gmail.com','$2y$12$Pu6yFbg0VNF5ZKGOOUrWyeiHL2EfrzQ75zD01a/6SOWtXqSU9kdmm','adminkurir','Admin Kurir',0,'AdminKurir',NULL,'W','123-444-2234','2024-01-07 06:00:26','2024-01-07 06:00:26',NULL);

/*Table structure for table `users_voucher` */

DROP TABLE IF EXISTS `users_voucher`;

CREATE TABLE `users_voucher` (
  `user_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `users_voucher_status` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`voucher_id`),
  KEY `voucher_id` (`voucher_id`),
  CONSTRAINT `users_voucher_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `users_voucher_ibfk_2` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users_voucher` */

/*Table structure for table `voucher` */

DROP TABLE IF EXISTS `voucher`;

CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_nama` varchar(255) NOT NULL,
  `voucher_img` text DEFAULT NULL,
  `voucher_potongan` int(11) NOT NULL CHECK (`voucher_potongan` > 0),
  `voucher_tgl_berlaku` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `voucher` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
