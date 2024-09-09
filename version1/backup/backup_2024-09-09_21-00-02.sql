-- Database Backup
CREATE DATABASE IF NOT EXISTS `web_ass`;
USE `web_ass`;


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
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('6', 'Admin', '1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1991-10-22', '66db06e1a0256.jpg', 'Admin', 'Active', '0', '2024-09-06 22:01:12', '', '2024-09-09 20:59:30', '1', '2024-09-09 20:59:30', '', 'f0d38f52852e57fc42f8d9da8ab4552e', '2024-09-23 20:59:30');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('7', 'Jane Smith', '2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1985-07-22', '66db0dea24e37.jpg', 'Member', 'Banned', '0', '2024-09-07 17:04:47', '', '2024-09-07 21:50:20', '1', '2024-09-07 21:50:20', '2024-09-07 17:05:46', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('8', 'Emily Johnson', '3@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1992-12-05', '66d915f0909d1.jpg', 'Member', 'Active', '0', '2024-09-05 22:04:02', '', '2024-09-07 17:05:00', '1', '2024-09-07 17:05:00', '2024-09-07 17:05:09', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('9', 'Micky Way', 'howjj-wm22@student.tarc.edu.my', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1991-10-16', '66d99ae81397c.jpg', 'Member', 'Active', '0', '2024-09-06 21:57:44', '', '2024-09-08 21:38:29', '1', '2024-09-08 21:38:29', '2024-09-07 16:58:37', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('10', 'Sophia Davis', '5@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-09-10', '66d915f72602f.jpg', 'Member', 'Active', '0', '', '', '2024-09-07 17:09:18', '1', '2024-09-07 17:09:18', '', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('14', 'pui', '101@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1991-11-11', '66d8270ce4079.jpg', 'Member', 'Active', '0', '', '', '', '0', '', '', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('15', 'Allen', 'all@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1992-10-08', '66d8273379b6b.jpg', 'Member', 'Active', '0', '', '', '', '0', '', '', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('16', 'abc', 'abc@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'Other', '2024-09-09', '66d835c345a7f.jpg', 'Member', 'Active', '0', '', '', '', '0', '', '', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('100', 'test1', '100@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1991-10-20', '66d91c495c5a9.jpg', 'Member', 'Active', '0', '', '', '', '0', '', '', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('114', 'Hoe', '11313@gmail.com', '05fe7461c607c33229772d402505601016a7d0ea', 'Male', '2024-09-05', '66da81782e4de.jpg', 'Member', 'Active', '0', '', '', '2024-09-06 12:14:38', '1', '2024-09-06 12:14:38', '', '', '');

CREATE TABLE `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(1) DEFAULT NULL,
  `unit` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `carts_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `unit` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`)
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

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `ship_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `status` varchar(22) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ship_id` (`ship_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ship_id`) REFERENCES `shippers` (`ship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('8', '3', '2024-09-07 16:13:11', '0', '8', '2', 'ef');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('11', '7', '2024-09-07 22:37:17', '0', '13', '0', '');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('12', '7', '2024-09-07 22:37:57', '0', '14', '0', '');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('13', '7', '2024-09-07 22:40:46', '0', '15', '0', '');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('14', '7', '2024-09-07 22:51:29', '0', '16', '0', '');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('15', '7', '2024-09-07 22:54:24', '0', '17', '0', '');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('16', '7', '2024-09-07 22:59:07', '0', '18', '0', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('17', '7', '2024-09-07 23:13:42', '0', '19', '0', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('18', '7', '2024-09-07 23:27:01', '0', '20', '0', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('19', '7', '2024-09-07 23:33:15', '0', '22', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('20', '7', '2024-09-07 23:35:13', '0', '23', '1', 'Pending');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status) VALUES ('21', '7', '2024-09-07 23:37:35', '0', '24', '0', 'Pending');

CREATE TABLE `payment_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `method` varchar(55) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `payment_record_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
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
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('6', 'Keyboard', '12.00', '2', '0', '12', '122dd', '2.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('7', 'speaker', '12.00', '2', '1', '12', '122dd', '2.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('8', 'phone', '1000.00', '2', '1', '66a5386c41b21.jpg', 'wefewf', '12.00');

CREATE TABLE `shippers` (
  `ship_id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `ship_method` varchar(50) NOT NULL,
  PRIMARY KEY (`ship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `verification_code` char(6) NOT NULL,
  `expire` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`verification_code`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO token (id, email, verification_code, expire) VALUES ('37', 'howjj-wm22@student.tarc.edu.my', '734422', '2024-09-06 21:03:23');
INSERT INTO token (id, email, verification_code, expire) VALUES ('38', 'howjj-wm22@student.tarc.edu.my', '376501', '2024-09-06 23:17:17');
INSERT INTO token (id, email, verification_code, expire) VALUES ('39', 'test222@gmail.com', '172526', '2024-09-06 23:18:23');
INSERT INTO token (id, email, verification_code, expire) VALUES ('41', 'howjj-wm22@student.tarc.edu.my', '853796', '2024-09-07 13:18:49');
INSERT INTO token (id, email, verification_code, expire) VALUES ('42', 'howjj-wm22@student.tarc.edu.my', '427895', '2024-09-07 13:24:02');
INSERT INTO token (id, email, verification_code, expire) VALUES ('43', 'howjj-wm22@student.tarc.edu.my', '630954', '2024-09-07 17:13:09');
INSERT INTO token (id, email, verification_code, expire) VALUES ('44', '2@gmail.com', '347567', '2024-09-07 17:16:54');
