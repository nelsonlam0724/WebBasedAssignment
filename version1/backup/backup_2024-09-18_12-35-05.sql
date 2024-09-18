-- Database Backup
CREATE DATABASE IF NOT EXISTS `web_ass`;
USE `web_ass`;


CREATE TABLE `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `balance` decimal(10,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ccv` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `card` varchar(50) NOT NULL,
  `expires` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO bank (id, balance, name, ccv, phone, card, expires) VALUES ('1', '901.00', 'Sun Wu Kong ', '258', '010-7890123', '4010101010101010', '09/21');
INSERT INTO bank (id, balance, name, ccv, phone, card, expires) VALUES ('2', '3500.25', 'Lee Wen Hao ', '217', '018-3535893', '4999969938799999', '09/23');

CREATE TABLE `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(1) DEFAULT NULL,
  `unit` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('31', '3', '7', '1', '0');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('55', '4', '7', '1', '0');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('56', '5', '6', '1', '0');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('59', '7', '10', '2', '');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('60', '8', '7', '1', '');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('61', '26', '8', '8', '');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('62', '26', '9', '2', '');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('63', '26', '10', '1', '');

CREATE TABLE `category` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `product_id` int(10) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO category (category_id, category_name, product_id) VALUES ('2', 'keyboard train', '1');

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('4', '6', '7', '2024-09-09 13:11:35', 'Good', '2', 'fefwef');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('5', '10', '6', '2024-09-09 13:12:01', 'rubish!!!', '0', 'we');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('6', '14', '8', '2024-09-09 13:16:03', 'heheheheheheheh', '4', '');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('7', '7', '6', '0000-00-00 00:00:00', 'rubbish', '2', '7b73.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('8', '7', '6', '2024-09-09 23:58:51', 'not bad', '4', '7b73.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('9', '7', '6', '2024-09-10 00:13:56', 'zz', '3', '27ARISTOTLE-articleLarge.webp');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('10', '7', '6', '2024-09-10 00:14:39', 'axsx', '3', '27ARISTOTLE-articleLarge.webp');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('11', '7', '6', '2024-09-10 09:15:07', 'I  like this', '4', 'wp3837749.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('12', '7', '6', '2024-09-10 09:16:09', 'Very Excellent', '5', '下载 (1).jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('13', '7', '6', '2024-09-10 09:53:47', '111111111122222222222', '3', 'wp3837749.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('14', '7', '6', '2024-09-10 09:59:47', 'beautiful!!!', '3', '1074989.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('15', '7', '6', '2024-09-10 10:06:30', 'er', '3', '["1074989.jpg","wp3837749.jpg"]');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('16', '7', '6', '2024-09-10 10:07:13', 'er', '3', '["1074989.jpg","wp3837749.jpg"]');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('17', '7', '6', '2024-09-10 10:08:40', 'g', '5', '屏幕截图(9).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('18', '7', '6', '2024-09-10 10:48:09', 'apa ni??', '4', '屏幕截图(54).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('19', '7', '6', '2024-09-10 11:33:16', 'sohai', '2', '屏幕截图(9).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('20', '7', '6', '2024-09-13 18:49:30', 'Stupid', '4', '屏幕截图(34).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('21', '26', '8', '2024-09-18 08:06:56', 'Just ok', '2', '下载 (1).jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('22', '26', '8', '2024-09-18 11:28:56', 'wdwdwd', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('23', '26', '8', '2024-09-18 11:29:48', 'wdwdwd', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('24', '26', '9', '2024-09-18 12:11:22', 'trhrt', '2', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('25', '26', '8', '2024-09-18 12:13:20', 'reger', '3', '1074989.jpg');

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO favorite (id, product_id, user_id) VALUES ('192', '8', '7');
INSERT INTO favorite (id, product_id, user_id) VALUES ('193', '13', '7');
INSERT INTO favorite (id, product_id, user_id) VALUES ('195', '13', '8');
INSERT INTO favorite (id, product_id, user_id) VALUES ('196', '15', '8');

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `unit` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `order_status` enum('Pending','Cancelled','Delivered','Shipped') NOT NULL DEFAULT 'Pending',
  `commment_status` varchar(20) NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('11', '6', '12', '3', '36', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('11', '7', '12', '4', '48', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('12', '6', '12', '3', '36', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('12', '7', '12', '4', '48', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('13', '6', '12', '3', '36', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('13', '7', '12', '5', '60', 'Cancelled', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('14', '6', '12', '3', '36', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('14', '7', '12', '5', '60', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('15', '6', '12', '1', '12', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('16', '6', '12', '3', '36', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('17', '6', '12', '1', '12', 'Cancelled', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('17', '7', '12', '2', '24', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('17', '8', '1000', '2', '2000', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('18', '8', '1000', '3', '3000', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('19', '6', '12', '4', '48', 'Cancelled', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('19', '8', '1000', '3', '3000', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('20', '6', '12', '4', '48', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('20', '7', '12', '3', '36', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('20', '8', '1000', '3', '3000', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('21', '6', '12', '4', '48', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('21', '8', '1000', '3', '3000', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('22', '8', '1000', '10', '10000', 'Cancelled', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('23', '6', '12', '5', '60', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('23', '8', '1000', '5', '5000', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('24', '6', '12', '5', '60', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('24', '8', '1000', '6', '6000', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('25', '6', '12', '5', '60', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('25', '8', '1000', '6', '6000', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('26', '6', '12', '5', '60', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('27', '6', '12', '5', '60', 'Cancelled', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('28', '6', '12', '5', '60', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('29', '6', '12', '5', '60', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('29', '8', '1000', '6', '6000', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('30', '6', '12', '5', '60', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('30', '8', '1000', '6', '6000', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('31', '6', '12', '5', '60', 'Cancelled', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('32', '6', '12', '5', '60', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('32', '8', '1000', '1', '1000', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('33', '6', '12', '5', '60', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('34', '6', '12', '5', '60', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('34', '8', '1000', '2', '2000', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('35', '6', '12', '5', '60', 'Cancelled', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('36', '8', '1000', '2', '2000', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('37', '8', '1000', '2', '2000', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('38', '8', '1000', '2', '2000', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('39', '6', '12', '4', '48', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('41', '6', '12', '16', '192', 'Cancelled', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('42', '6', '12', '5', '60', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('42', '7', '12', '1', '12', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('42', '8', '1000', '2', '2000', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('43', '7', '12', '3', '36', 'Cancelled', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('43', '8', '1000', '4', '4000', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('44', '8', '1000', '2', '2000', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('44', '13', '45', '1', '45', 'Delivered', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('45', '8', '1000', '5', '5000', 'Shipped', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('45', '13', '45', '1', '45', 'Cancelled', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('46', '10', '25', '1', '25', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('47', '10', '25', '2', '50', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('48', '7', '12', '2', '24', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('49', '8', '1000', '2', '2000', 'Pending', 'Rated');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('50', '8', '1000', '3', '3000', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('51', '8', '1000', '5', '5000', 'Pending', 'Rated');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('52', '9', '33', '2', '66', 'Pending', 'Rated');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('53', '8', '1000', '7', '7000', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('54', '8', '1000', '8', '8000', 'Pending', 'Panding');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('55', '8', '1000', '8', '8000', 'Pending', 'Panding');

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `ship_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `status` varchar(22) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `ship_id` (`ship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('11', '7', '2024-09-07 22:37:17', '0.00', '13', '0', '', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('12', '7', '2024-09-07 22:37:57', '0.00', '14', '0', '', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('13', '7', '2024-09-07 22:40:46', '0.00', '15', '0', '', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('14', '7', '2024-09-07 22:51:29', '0.00', '16', '0', '', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('15', '7', '2024-09-07 22:54:24', '0.00', '17', '0', '', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('16', '7', '2024-09-07 22:59:07', '0.00', '18', '0', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('17', '7', '2024-09-07 23:13:42', '0.00', '19', '0', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('18', '7', '2024-09-07 23:27:01', '0.00', '20', '0', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('19', '7', '2024-09-07 23:33:15', '0.00', '22', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('20', '7', '2024-09-07 23:35:13', '0.00', '23', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('21', '7', '2024-09-07 23:37:35', '0.00', '24', '0', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('22', '7', '2024-09-08 14:33:37', '0.00', '25', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('23', '7', '2024-09-08 16:33:16', '0.00', '26', '3', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('24', '7', '2024-09-08 16:34:32', '0.00', '27', '3', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('25', '7', '2024-09-08 16:36:04', '0.00', '28', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('26', '7', '2024-09-08 18:18:50', '63.00', '29', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('27', '7', '2024-09-08 18:19:34', '66.00', '30', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('28', '7', '2024-09-08 18:22:31', '66.00', '31', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('29', '7', '2024-09-08 18:23:44', '5883.00', '32', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('30', '7', '2024-09-08 18:26:24', '5882.80', '33', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('31', '7', '2024-09-08 18:35:36', '65.80', '34', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('32', '7', '2024-09-08 19:55:39', '1082.80', '35', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('33', '7', '2024-09-08 20:32:40', '62.80', '36', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('34', '7', '2024-09-09 08:55:02', '2002.80', '37', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('35', '7', '2024-09-09 09:38:15', '65.80', '38', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('36', '7', '2024-09-09 09:40:09', '2044.60', '39', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('37', '7', '2024-09-09 09:40:54', '2044.60', '40', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('38', '7', '2024-09-09 09:45:04', '2041.60', '41', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('39', '7', '2024-09-09 09:46:03', '53.56', '42', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('40', '7', '2024-09-09 03:46:13', '34.00', '22', '3', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('41', '7', '2024-09-09 18:50:05', '200.44', '43', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('42', '7', '2024-09-09 22:23:04', '2011.44', '44', '3', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('43', '7', '2024-09-13 18:53:08', '3919.52', '45', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('44', '7', '2024-09-15 20:25:05', '1988.25', '46', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('45', '7', '2024-09-15 20:26:54', '4898.25', '47', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('46', '7', '2024-09-17 17:25:57', '27.10', '48', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('47', '7', '2024-09-17 17:29:19', '52.60', '49', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('48', '8', '2024-09-17 21:25:55', '26.08', '50', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('49', '26', '2024-09-17 23:05:48', '2041.60', '51', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('50', '26', '2024-09-18 08:46:04', '2911.60', '52', '1', 'Cancel', '2024-09-18 08:46:04');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('51', '26', '2024-09-18 11:51:02', '4851.60', '53', '1', 'Paid', '2024-09-18 11:51:02');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('52', '26', '2024-09-18 11:54:32', '68.92', '54', '1', 'Paid', '2024-09-18 11:54:32');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('53', '26', '2024-09-18 12:07:12', '6791.60', '55', '1', 'Paid', '2024-09-18 12:07:12');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('54', '26', '2024-09-18 12:30:49', '7761.60', '56', '1', 'Paid', '2024-09-18 12:30:49');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('55', '26', '2024-09-18 12:32:07', '7761.60', '57', '1', 'Cancel', '2024-09-18 12:32:07');

CREATE TABLE `payment_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` varchar(55) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `payment_record_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('1', '7', '2024-09-17 17:27:19', '27.10', 'card', '46');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('2', '7', '2024-09-17 17:31:05', '52.60', 'card', '47');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('3', '8', '2024-09-17 21:29:46', '26.08', 'card', '48');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('4', '26', '2024-09-18 08:02:32', '2041.60', 'card', '49');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('5', '26', '0000-00-00 00:00:00', '2911.60', 'card', '50');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('6', '26', '2024-09-18 11:51:26', '4851.60', 'card', '51');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('7', '26', '2024-09-18 11:54:59', '68.92', 'card', '52');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('8', '26', '2024-09-18 12:07:37', '6791.60', 'card', '53');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('9', '26', '2024-09-18 12:31:11', '7761.60', 'card', '54');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('10', '26', '0000-00-00 00:00:00', '7761.60', 'card', '55');

CREATE TABLE `product` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `product_photo` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('6', 'Keyboard', '12.00', '2', '0', '12', '122dd', '2.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('7', 'speaker', '12.00', '2', '1', '12', '122dd', '2.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('8', 'phone', '1000.00', '2', '1', '66a5386c41b21.jpg', 'wefewf', '12.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('9', 'table', '33.00', '2', '3', '', 'di samping itu', '23.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('10', 'chair', '25.00', '2', '5', '', 'comfortable chair', '10.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('11', 'sofa', '200.00', '2', '2', '', 'modern design sofa', '50.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('12', 'lamp', '15.00', '2', '10', '', 'LED table lamp', '2.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('13', 'shelf', '45.00', '2', '7', '', 'wooden shelf', '15.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('14', 'cabinet', '120.00', '2', '1', '', 'storage cabinet', '70.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('15', 'desk', '75.00', '2', '3', '', 'office desk', '35.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('16', 'bed', '300.00', '2', '1', '', 'king-size bed', '80.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('17', 'mirror', '60.00', '2', '4', '', 'wall-mounted mirror', '12.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('18', 'rug', '40.00', '2', '6', '', 'large living room rug', '5.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('19', 'dresser', '150.00', '2', '2', '', 'bedroom dresser', '40.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('20', 'coffee table', '80.00', '2', '3', '', 'glass coffee table', '20.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('21', 'bookshelf', '90.00', '2', '4', '', 'tall wooden bookshelf', '30.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('22', 'TV stand', '110.00', '2', '2', '', 'modern TV stand', '25.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('23', 'armchair', '120.00', '2', '2', '', 'luxury armchair', '15.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('24', 'nightstand', '35.00', '2', '6', '', 'wooden nightstand', '8.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('25', 'stool', '20.00', '2', '8', '', 'small round stool', '5.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('26', 'wardrobe', '250.00', '2', '1', '', 'large wardrobe', '90.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('27', 'ottoman', '50.00', '2', '5', '', 'comfortable ottoman', '10.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('28', 'bench', '75.00', '2', '4', '', 'entryway bench', '18.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('29', 'recliner', '220.00', '2', '1', '', 'leather recliner', '35.00');

CREATE TABLE `shippers` (
  `ship_id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `ship_method` varchar(50) NOT NULL,
  `status` varchar(12) NOT NULL,
  PRIMARY KEY (`ship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('8', 'werf', 'werwer', 'wer', 'werewr', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('11', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('13', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('14', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('15', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('16', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('17', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('18', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('19', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('20', 'Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('21', 'ggggggggghhhhhhhh Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('22', 'ggggggggghhhhhhhh Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('23', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Melaka', 'POS LAJU', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('24', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Perlis', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('25', 'gfh Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('26', 'gfh Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('27', 'gfh Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('28', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('29', 'erw Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('30', 'erw Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('31', 'Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('32', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('33', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('34', 'fd Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('35', 'Jalan Merbau, Kampung Bukit Hijau, Kuala Selangor, Selangor, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('36', 'Jalan Bukit Tunku, Kenny Hill, Taman Duta, Kuala Lumpur, 50580, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('37', 'Jalan Tuanku Abdul Halim, Duta, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'J&T', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('38', 'Elmina Green, Section U17, Desa Impian, Shah Alam, Petaling, Selangor, 47000, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('39', 'Ministry of Home Affairs, Jalan Sri Hartamas 1, Duta, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('40', 'Persiaran Tuanku Syed Sirajuddin, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('41', 'Mont Kiara International School, 22, Jalan Kiara, Mont Kiara, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('42', 'Jalan Sarawak, Kampung Dollah, Pudu, Kuala Lumpur, 55720, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('43', 'Guthrie Corridor Expressway, Kampung Setia, Kuang, Selayang Municipal Council, Gombak, 47000, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('44', 'Tinggian Tunku, Kenny Hill, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('45', 'Jalan SS 22/41, SS 22, Damansara Jaya, Petaling Jaya, Petaling, Selangor, 47400, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('46', 'Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Terengganu', 'NINJA VAN', '012-9394023', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('47', 'Jalan PJU 10/13D, Damansara Damai, PJU 10, Petaling Jaya, Petaling, Selangor, 47830, Malaysia Terengganu', 'NINJA VAN', '012-9394023', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('48', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Melaka', 'NINJA VAN', 'sad', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('49', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Melaka', 'NINJA VAN', 'sad', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('50', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Negeri Sembilan', 'POS LAJU', '012-29298321', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('51', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Kelantan', 'NINJA VAN', '012-29298321', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('52', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Selangor', 'NINJA VAN', '012-29298321', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('53', 'Jalan Pantai Permai 5, Kampung Tradisi Sri Pantai, Kuala Lumpur, 59200, Malaysia Selangor', 'NINJA VAN', '012-29298321', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('54', 'Jalan BU 10/5, PJU 6, Bandar Utama, Petaling Jaya, Petaling, Selangor, 47800, Malaysia Putrajaya', 'NINJA VAN', '012-29298321', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('55', 'Jalan Pantai Permai 5, Kampung Tradisi Sri Pantai, Kuala Lumpur, 59200, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'ss', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('56', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Terengganu', 'NINJA VAN', 'ss', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('57', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Sarawak', 'NINJA VAN', 'ss', 'pick', 'Pending');

CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `verification_code` char(6) NOT NULL,
  `expire` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`verification_code`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO token (id, email, verification_code, expire) VALUES ('45', '2@gmail.com', '822996', '2024-09-17 21:37:15');
INSERT INTO token (id, email, verification_code, expire) VALUES ('46', 'codeqiangod@gmail.com', '917203', '2024-09-17 22:05:36');
INSERT INTO token (id, email, verification_code, expire) VALUES ('47', 'codeqiangod@gmail.com', '478797', '2024-09-17 22:08:15');
INSERT INTO token (id, email, verification_code, expire) VALUES ('48', 'codeqiangod@gmail.com', '357530', '2024-09-17 22:08:18');
INSERT INTO token (id, email, verification_code, expire) VALUES ('49', 'codeqiangod@gmail.com', '349297', '2024-09-17 22:08:21');
INSERT INTO token (id, email, verification_code, expire) VALUES ('50', 'codeqiangod@gmail.com', '488409', '2024-09-17 22:12:03');

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `photo` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `last_failed_attempt` datetime DEFAULT NULL,
  `banned_until` datetime DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `login_count` int(11) DEFAULT 0,
  `last_login_event_time` datetime DEFAULT NULL,
  `deactivated_at` datetime DEFAULT NULL,
  `remember_token` varchar(64) DEFAULT NULL,
  `remember_token_expiry` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('1', 'Root', '1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e16e9f590ec.jpg', 'Root', 'Active', '0', '2024-09-10 12:49:23', '', '2024-09-18 12:34:46', '1', '2024-09-18 12:34:46', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('2', 'Admin', '2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e164f231f73.jpg', 'Admin', 'Active', '0', '2024-09-07 17:04:47', '', '2024-09-17 21:23:02', '1', '2024-09-17 21:23:02', '2024-09-10 12:11:54', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('3', 'Emily Johnson', '3@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1992-12-05', '66dfc553b0989.jpg', 'Admin', 'Active', '0', '2024-09-05 22:04:02', '', '2024-09-17 21:23:26', '1', '2024-09-17 21:23:26', '2024-09-07 17:05:09', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('4', 'Micky Way', '4@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1991-10-16', '66e017b2e5a89.jpg', 'Admin', 'Active', '0', '2024-09-10 12:44:20', '0000-00-00 00:00:00', '2024-09-11 16:02:55', '1', '2024-09-11 16:02:55', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('5', 'Sophia Davis', '5@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-09-10', '66d915f72602f.jpg', 'Member', 'Active', '0', '2024-09-10 12:43:33', '0000-00-00 00:00:00', '2024-09-10 12:46:10', '1', '2024-09-10 12:46:10', '2024-09-10 12:30:02', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('6', 'Liam Brown', 'liam.b@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1993-05-18', '66e82a2818964.jpg', 'Member', 'Active', '0', '2024-09-07 14:20:10', '0000-00-00 00:00:00', '2024-09-10 10:01:23', '1', '2024-09-10 10:01:23', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('7', 'Olivia Miller', 'olivia.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-07-25', '66e82a2fd5a52.jpg', 'Member', 'Active', '0', '2024-09-12 11:15:49', '', '2024-09-17 21:24:23', '1', '2024-09-17 21:24:23', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('8', 'Noah Smith', 'noah.s@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1996-11-02', '66e82a372cc9f.jpg', 'Member', 'Active', '0', '2024-09-08 09:30:17', '', '2024-09-17 21:25:04', '1', '2024-09-17 21:25:04', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('9', 'Emma Wilson', 'emma.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1999-03-15', '66ddc8a6f2098.jpg', 'Member', 'Active', '0', '2024-09-13 15:21:55', '0000-00-00 00:00:00', '2024-09-15 16:34:22', '1', '2024-09-15 16:34:22', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('10', 'William Jones', 'william.j@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1997-09-30', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-06 13:20:11', '0000-00-00 00:00:00', '2024-09-07 14:45:09', '1', '2024-09-07 14:45:09', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('11', 'Ava Garcia', 'ava.g@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2000-01-21', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-08 16:24:47', '0000-00-00 00:00:00', '2024-09-10 11:02:54', '1', '2024-09-10 11:02:54', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('12', 'James Martinez', 'james.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1994-08-17', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-14 08:22:13', '0000-00-00 00:00:00', '2024-09-15 17:00:10', '1', '2024-09-15 17:00:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('13', 'Sophia Anderson', 'sophia.a@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-06-13', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-13 17:55:22', '0000-00-00 00:00:00', '2024-09-14 12:45:10', '1', '2024-09-14 12:45:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('14', 'Lucas White', 'lucas.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1998-05-12', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-10 18:33:27', '0000-00-00 00:00:00', '2024-09-12 16:20:50', '1', '2024-09-12 16:20:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('15', 'Mia Clark', 'mia.c@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1996-04-28', '66e164f231f73.jpg', 'Member', 'Banned', '0', '2024-09-07 21:10:11', '0000-00-00 00:00:00', '2024-09-09 10:15:35', '1', '2024-09-09 10:15:35', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('16', 'Benjamin Lewis', 'benjamin.l@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1993-10-01', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 17:44:30', '0000-00-00 00:00:00', '2024-09-12 15:32:10', '1', '2024-09-12 15:32:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('17', 'Ella Rodriguez', 'ella.r@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2001-12-12', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-09 13:00:20', '0000-00-00 00:00:00', '2024-09-10 14:32:43', '1', '2024-09-10 14:32:43', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('18', 'Henry Walker', 'henry.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1995-11-27', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 14:45:13', '0000-00-00 00:00:00', '2024-09-14 11:30:15', '1', '2024-09-14 11:30:15', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('19', 'Amelia Young', 'amelia.y@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-08-14', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-12 20:02:16', '0000-00-00 00:00:00', '2024-09-15 17:55:32', '1', '2024-09-15 17:55:32', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('20', 'Ethan Harris', 'ethan.h@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1994-07-07', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-07 16:33:10', '0000-00-00 00:00:00', '2024-09-08 17:21:50', '1', '2024-09-08 17:21:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('21', 'Harper Green', 'harper.g@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1999-12-05', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-06 10:12:00', '0000-00-00 00:00:00', '2024-09-07 09:11:20', '1', '2024-09-07 09:11:20', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('22', 'Alexander Lee', 'alexander.l@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2000-03-08', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-13 11:00:15', '0000-00-00 00:00:00', '2024-09-14 13:05:44', '1', '2024-09-14 13:05:44', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('23', 'Isabella Scott', 'isabella.s@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1996-10-23', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 12:15:11', '0000-00-00 00:00:00', '2024-09-13 15:02:55', '1', '2024-09-13 15:02:55', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('24', 'Daniel Carter', 'daniel.c@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-02-18', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-12 09:40:23', '0000-00-00 00:00:00', '2024-09-13 17:11:47', '1', '2024-09-13 17:11:47', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('25', 'Emily King', 'emily.k@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2001-11-20', '66e164f231f73.jpg', 'Member', 'Banned', '0', '2024-09-10 08:33:18', '0000-00-00 00:00:00', '2024-09-12 10:00:22', '1', '2024-09-12 10:00:22', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('26', 'wei Liang', 'codeqiangod@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '2024-09-11', '66e98f5da4e7c.jpg', 'Member', 'Active', '0', '2024-09-17 22:06:20', '', '2024-09-18 10:58:59', '1', '2024-09-18 10:58:59', '', '', '');
