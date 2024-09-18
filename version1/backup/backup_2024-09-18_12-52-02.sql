-- Database Backup
CREATE DATABASE IF NOT EXISTS `web_ass`;
USE `web_ass`;


CREATE TABLE `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `balance` decimal(10,0) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ccv` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('31', '3', '7', '1', '');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('55', '4', '7', '1', '');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('56', '5', '6', '1', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO favorite (id, product_id, user_id) VALUES ('192', '8', '7');
INSERT INTO favorite (id, product_id, user_id) VALUES ('193', '13', '7');

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `unit` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('11', '6', '12', '3', '36');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('11', '7', '12', '4', '48');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('12', '6', '12', '3', '36');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('12', '7', '12', '4', '48');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('13', '6', '12', '3', '36');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('13', '7', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('14', '6', '12', '3', '36');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('14', '7', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('15', '6', '12', '1', '12');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('16', '6', '12', '3', '36');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('17', '6', '12', '1', '12');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('17', '7', '12', '2', '24');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('17', '8', '1000', '2', '2000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('18', '8', '1000', '3', '3000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('19', '6', '12', '4', '48');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('19', '8', '1000', '3', '3000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('20', '6', '12', '4', '48');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('20', '7', '12', '3', '36');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('20', '8', '1000', '3', '3000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('21', '6', '12', '4', '48');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('21', '8', '1000', '3', '3000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('22', '8', '1000', '10', '10000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('23', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('23', '8', '1000', '5', '5000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('24', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('24', '8', '1000', '6', '6000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('25', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('25', '8', '1000', '6', '6000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('26', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('27', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('28', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('29', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('29', '8', '1000', '6', '6000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('30', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('30', '8', '1000', '6', '6000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('31', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('32', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('32', '8', '1000', '1', '1000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('33', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('34', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('34', '8', '1000', '2', '2000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('35', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('36', '8', '1000', '2', '2000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('37', '8', '1000', '2', '2000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('38', '8', '1000', '2', '2000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('39', '6', '12', '4', '48');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('41', '6', '12', '16', '192');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('42', '6', '12', '5', '60');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('42', '7', '12', '1', '12');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('42', '8', '1000', '2', '2000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('43', '7', '12', '3', '36');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('43', '8', '1000', '4', '4000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('44', '8', '1000', '2', '2000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('44', '13', '45', '1', '45');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('45', '8', '1000', '5', '5000');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal) VALUES ('45', '13', '45', '1', '45');

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `ship_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `status` varchar(22) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ship_id` (`ship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('11', '7', '2024-09-07 22:37:17', '0.00', '13', '0', '');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('12', '7', '2024-09-07 22:37:57', '0.00', '14', '0', '');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('13', '7', '2024-09-07 22:40:46', '0.00', '15', '0', '');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('14', '7', '2024-09-07 22:51:29', '0.00', '16', '0', '');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('15', '7', '2024-09-07 22:54:24', '0.00', '17', '0', '');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('16', '7', '2024-09-07 22:59:07', '0.00', '18', '0', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('17', '7', '2024-09-07 23:13:42', '0.00', '19', '0', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('18', '7', '2024-09-07 23:27:01', '0.00', '20', '0', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('19', '7', '2024-09-07 23:33:15', '0.00', '22', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('20', '7', '2024-09-07 23:35:13', '0.00', '23', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('21', '7', '2024-09-07 23:37:35', '0.00', '24', '0', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('22', '7', '2024-09-08 14:33:37', '0.00', '25', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('23', '7', '2024-09-08 16:33:16', '0.00', '26', '3', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('24', '7', '2024-09-08 16:34:32', '0.00', '27', '3', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('25', '7', '2024-09-08 16:36:04', '0.00', '28', '2', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('26', '7', '2024-09-08 18:18:50', '63.00', '29', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('27', '7', '2024-09-08 18:19:34', '66.00', '30', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('28', '7', '2024-09-08 18:22:31', '66.00', '31', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('29', '7', '2024-09-08 18:23:44', '5883.00', '32', '2', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('30', '7', '2024-09-08 18:26:24', '5882.80', '33', '2', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('31', '7', '2024-09-08 18:35:36', '65.80', '34', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('32', '7', '2024-09-08 19:55:39', '1082.80', '35', '2', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('33', '7', '2024-09-08 20:32:40', '62.80', '36', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('34', '7', '2024-09-09 08:55:02', '2002.80', '37', '2', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('35', '7', '2024-09-09 09:38:15', '65.80', '38', '1', 'Paid');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('36', '7', '2024-09-09 09:40:09', '2044.60', '39', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('37', '7', '2024-09-09 09:40:54', '2044.60', '40', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('38', '7', '2024-09-09 09:45:04', '2041.60', '41', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('39', '7', '2024-09-09 09:46:03', '53.56', '42', '1', 'Paid');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('40', '7', '2024-09-09 03:46:13', '34.00', '22', '3', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('41', '7', '2024-09-09 18:50:05', '200.44', '43', '1', 'Paid');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('42', '7', '2024-09-09 22:23:04', '2011.44', '44', '3', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('43', '7', '2024-09-13 18:53:08', '3919.52', '45', '2', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('44', '7', '2024-09-15 20:25:05', '1988.25', '46', '2', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('45', '7', '2024-09-15 20:26:54', '4898.25', '47', '2', 'Pending');

CREATE TABLE `payment_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `method` varchar(55) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
  PRIMARY KEY (`ship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('8', 'werf', 'werwer', 'wer', 'werewr');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('11', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('13', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('14', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('15', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('16', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('17', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('18', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('19', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('20', 'Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('21', 'ggggggggghhhhhhhh Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('22', 'ggggggggghhhhhhhh Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('23', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Melaka', 'POS LAJU', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('24', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Perlis', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('25', 'gfh Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('26', 'gfh Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('27', 'gfh Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('28', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('29', 'erw Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('30', 'erw Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('31', 'Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('32', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('33', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('34', 'fd Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('35', 'Jalan Merbau, Kampung Bukit Hijau, Kuala Selangor, Selangor, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('36', 'Jalan Bukit Tunku, Kenny Hill, Taman Duta, Kuala Lumpur, 50580, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('37', 'Jalan Tuanku Abdul Halim, Duta, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'J&T', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('38', 'Elmina Green, Section U17, Desa Impian, Shah Alam, Petaling, Selangor, 47000, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('39', 'Ministry of Home Affairs, Jalan Sri Hartamas 1, Duta, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('40', 'Persiaran Tuanku Syed Sirajuddin, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('41', 'Mont Kiara International School, 22, Jalan Kiara, Mont Kiara, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('42', 'Jalan Sarawak, Kampung Dollah, Pudu, Kuala Lumpur, 55720, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('43', 'Guthrie Corridor Expressway, Kampung Setia, Kuang, Selayang Municipal Council, Gombak, 47000, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('44', 'Tinggian Tunku, Kenny Hill, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('45', 'Jalan SS 22/41, SS 22, Damansara Jaya, Petaling Jaya, Petaling, Selangor, 47400, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('46', 'Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Terengganu', 'NINJA VAN', '012-9394023', 'door');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method) VALUES ('47', 'Jalan PJU 10/13D, Damansara Damai, PJU 10, Petaling Jaya, Petaling, Selangor, 47830, Malaysia Terengganu', 'NINJA VAN', '012-9394023', 'door');

CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `verification_code` char(6) NOT NULL,
  `expire` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`verification_code`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('1', 'Root', '1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e16e9f590ec.jpg', 'Root', 'Active', '0', '2024-09-10 12:49:23', '', '2024-09-18 12:10:03', '1', '2024-09-18 12:10:03', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('2', 'Admin', '2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e164f231f73.jpg', 'Admin', 'Active', '0', '2024-09-18 12:09:10', '', '2024-09-18 12:50:19', '1', '2024-09-18 12:50:19', '2024-09-10 12:11:54', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('3', 'Emily Johnson', '3@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1992-12-05', '66dfc553b0989.jpg', 'Admin', 'Active', '0', '2024-09-18 12:06:06', '', '2024-09-18 12:07:53', '1', '2024-09-18 12:07:53', '2024-09-07 17:05:09', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('4', 'Micky Way', '4@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1991-10-16', '66e017b2e5a89.jpg', 'Admin', 'Active', '0', '2024-09-10 12:44:20', '0000-00-00 00:00:00', '2024-09-11 16:02:55', '1', '2024-09-11 16:02:55', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('5', 'Sophia Davis', '5@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-09-10', '66e92306b357a.jpg', 'Member', 'Banned', '0', '2024-09-10 12:43:33', '0000-00-00 00:00:00', '2024-09-10 12:46:10', '1', '2024-09-10 12:46:10', '2024-09-18 11:59:48', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('6', 'Liam Brown', 'liam.b@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1993-05-18', '66e82a2818964.jpg', 'Member', 'Banned', '0', '2024-09-07 14:20:10', '0000-00-00 00:00:00', '2024-09-10 10:01:23', '1', '2024-09-10 10:01:23', '2024-09-18 11:57:41', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('7', 'Olivia Miller', 'olivia.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-07-25', '66e82a2fd5a52.jpg', 'Member', 'Banned', '0', '2024-09-12 11:15:49', '0000-00-00 00:00:00', '2024-09-15 14:05:20', '1', '2024-09-15 14:05:20', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('8', 'Noah Smith', 'noah.s@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1996-11-02', '66e82a372cc9f.jpg', 'Member', 'Banned', '0', '2024-09-08 09:30:17', '0000-00-00 00:00:00', '2024-09-09 12:45:02', '1', '2024-09-09 12:45:02', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('9', 'Emma Wilson', 'emma.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1999-03-15', '66ddc8a6f2098.jpg', 'Member', 'Active', '0', '2024-09-13 15:21:55', '0000-00-00 00:00:00', '2024-09-15 16:34:22', '1', '2024-09-15 16:34:22', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('10', 'William Jones', 'william.j@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1997-09-30', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-06 13:20:11', '0000-00-00 00:00:00', '2024-09-07 14:45:09', '1', '2024-09-07 14:45:09', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('11', 'Ava Garcia', 'ava.g@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2000-01-21', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-08 16:24:47', '0000-00-00 00:00:00', '2024-09-10 11:02:54', '1', '2024-09-10 11:02:54', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('12', 'James Martinez', 'james.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1994-08-17', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-14 08:22:13', '0000-00-00 00:00:00', '2024-09-15 17:00:10', '1', '2024-09-15 17:00:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('13', 'Sophia Anderson', 'sophia.a@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-06-13', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-13 17:55:22', '0000-00-00 00:00:00', '2024-09-14 12:45:10', '1', '2024-09-14 12:45:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('14', 'Lucas White', 'lucas.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1998-05-12', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-10 18:33:27', '0000-00-00 00:00:00', '2024-09-12 16:20:50', '1', '2024-09-12 16:20:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('15', 'Mia Clark', 'mia.c@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1996-04-28', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-07 21:10:11', '0000-00-00 00:00:00', '2024-09-09 10:15:35', '1', '2024-09-09 10:15:35', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('16', 'Benjamin Lewis', 'benjamin.l@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1993-10-01', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 17:44:30', '0000-00-00 00:00:00', '2024-09-12 15:32:10', '1', '2024-09-12 15:32:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('17', 'Ella Rodriguez', 'ella.r@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2001-12-12', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-09 13:00:20', '0000-00-00 00:00:00', '2024-09-10 14:32:43', '1', '2024-09-10 14:32:43', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('18', 'Henry Walker', 'henry.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1995-11-27', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 14:45:13', '0000-00-00 00:00:00', '2024-09-14 11:30:15', '1', '2024-09-14 11:30:15', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('19', 'Amelia Young', 'amelia.y@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-08-14', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-12 20:02:16', '0000-00-00 00:00:00', '2024-09-15 17:55:32', '1', '2024-09-15 17:55:32', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('20', 'Ethan Harris', 'ethan.h@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1994-07-07', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-07 16:33:10', '0000-00-00 00:00:00', '2024-09-08 17:21:50', '1', '2024-09-08 17:21:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('21', 'Harper Green', 'harper.g@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1999-12-05', '66e164f231f73.jpg', 'Member', 'Banned', '0', '2024-09-06 10:12:00', '0000-00-00 00:00:00', '2024-09-07 09:11:20', '1', '2024-09-07 09:11:20', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('22', 'Alexander Lee', 'alexander.l@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2000-03-08', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-13 11:00:15', '0000-00-00 00:00:00', '2024-09-14 13:05:44', '1', '2024-09-14 13:05:44', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('23', 'Isabella Scott', 'isabella.s@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1996-10-23', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 12:15:11', '0000-00-00 00:00:00', '2024-09-13 15:02:55', '1', '2024-09-13 15:02:55', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('24', 'Daniel Carter', 'daniel.c@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-02-18', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-12 09:40:23', '0000-00-00 00:00:00', '2024-09-13 17:11:47', '1', '2024-09-13 17:11:47', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('25', 'Emily King', 'emily.k@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2001-11-20', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-10 08:33:18', '0000-00-00 00:00:00', '2024-09-12 10:00:22', '1', '2024-09-12 10:00:22', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
