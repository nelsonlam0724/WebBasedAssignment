-- Database Backup
CREATE DATABASE IF NOT EXISTS `web_ass`;
USE `web_ass`;


CREATE TABLE `bank` (
  `id` varchar(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ccv` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `card` varchar(50) NOT NULL,
  `expires` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO bank (id, balance, name, ccv, phone, card, expires) VALUES ('1', '901.00', 'Sun Wu Kong ', '258', '010-7890123', '4010101010101010', '09/21');
INSERT INTO bank (id, balance, name, ccv, phone, card, expires) VALUES ('2', '3500.25', 'Lee Wen Hao ', '217', '018-3535893', '4999969938799999', '09/23');

CREATE TABLE `carts` (
  `id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `product_id` varchar(1) DEFAULT NULL,
  `unit` int(11) NOT NULL,
  `category_id` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('C0031', 'U0003', 'P', '1', 'CT0002');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('C0055', 'U0004', 'P', '1', 'CT0002');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('C0056', 'U0005', 'P', '1', 'CT0002');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('C0059', 'U0007', 'P', '2', 'CT0002');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('C0060', 'U0008', 'P', '1', 'CT0002');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('C0061', 'U00026', 'P', '8', 'CT0002');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('C0062', 'U00026', 'P', '2', 'CT0002');
INSERT INTO carts (id, user_id, product_id, unit, category_id) VALUES ('C0063', 'U00026', 'P', '1', 'CT0002');

CREATE TABLE `category` (
  `category_id` varchar(10) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO category (category_id, category_name, product_id) VALUES ('CT0002', 'keyboard train', 'P0001');

CREATE TABLE `comment` (
  `comment_id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0004', 'U0006', 'P0007', '2024-09-09 13:11:35', 'Good', '2', 'fefwef');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0005', 'U0010', 'P0006', '2024-09-09 13:12:01', 'rubish!!!', '0', 'we');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0006', 'U0014', 'P0008', '2024-09-09 13:16:03', 'heheheheheheheh', '4', '');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0007', 'U0007', 'P0006', '0000-00-00 00:00:00', 'rubbish', '2', '7b73.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0008', 'U0007', 'P0006', '2024-09-09 23:58:51', 'not bad', '4', '7b73.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0009', 'U0007', 'P0006', '2024-09-10 00:13:56', 'zz', '3', '27ARISTOTLE-articleLarge.webp');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0010', 'U0007', 'P0006', '2024-09-10 00:14:39', 'axsx', '3', '27ARISTOTLE-articleLarge.webp');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0011', 'U0007', 'P0006', '2024-09-10 09:15:07', 'I  like this', '4', 'wp3837749.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0012', 'U0007', 'P0006', '2024-09-10 09:16:09', 'Very Excellent', '5', '下载 (1).jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0013', 'U0007', 'P0006', '2024-09-10 09:53:47', '111111111122222222222', '3', 'wp3837749.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0014', 'U0007', 'P0006', '2024-09-10 09:59:47', 'beautiful!!!', '3', '1074989.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0015', 'U0007', 'P0006', '2024-09-10 10:06:30', 'er', '3', '["1074989.jpg","wp3837749.jpg"]');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0016', 'U0007', 'P0006', '2024-09-10 10:07:13', 'er', '3', '["1074989.jpg","wp3837749.jpg"]');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0017', 'U0007', 'P0006', '2024-09-10 10:08:40', 'g', '5', '屏幕截图(9).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0018', 'U0007', 'P0006', '2024-09-10 10:48:09', 'apa ni??', '4', '屏幕截图(54).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0019', 'U0007', 'P0006', '2024-09-10 11:33:16', 'sohai', '2', '屏幕截图(9).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0020', 'U0007', 'P0006', '2024-09-13 18:49:30', 'Stupid', '4', '屏幕截图(34).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0021', 'U0026', 'P0008', '2024-09-18 08:06:56', 'Just ok', '2', '下载 (1).jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0022', 'U0026', 'P0008', '2024-09-18 11:28:56', 'wdwdwd', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0023', 'U0026', 'P0008', '2024-09-18 11:29:48', 'wdwdwd', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0024', 'U0026', 'P0009', '2024-09-18 12:11:22', 'trhrt', '2', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0025', 'U0026', 'P0008', '2024-09-18 12:13:20', 'reger', '3', '1074989.jpg');

CREATE TABLE `favorite` (
  `id` varchar(11) NOT NULL,
  `product_id` varchar(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO favorite (id, product_id, user_id) VALUES ('F0192', 'P0008', 'U0007');
INSERT INTO favorite (id, product_id, user_id) VALUES ('F0193', 'P0013', 'U0007');
INSERT INTO favorite (id, product_id, user_id) VALUES ('F0195', 'P0013', 'U0008');
INSERT INTO favorite (id, product_id, user_id) VALUES ('F0196', 'P0015', 'U0008');

CREATE TABLE `order_details` (
  `order_id` varchar(11) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `unit` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `order_status` enum('Pending','Cancelled','Delivered','Shipped') NOT NULL DEFAULT 'Pending',
  `commment_status` varchar(20) NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0011', 'P0006', '12', '3', '36', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0011', 'P0007', '12', '4', '48', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0012', 'P0006', '12', '3', '36', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0012', 'P0007', '12', '4', '48', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0013', 'P0006', '12', '3', '36', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0013', 'P0007', '12', '5', '60', 'Cancelled', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0014', 'P0006', '12', '3', '36', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0014', 'P0007', '12', '5', '60', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0015', 'P0006', '12', '1', '12', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0016', 'P0006', '12', '3', '36', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0017', 'P0006', '12', '1', '12', 'Cancelled', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0017', 'P0007', '12', '2', '24', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0017', 'P0008', '1000', '2', '2000', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0018', 'P0008', '1000', '3', '3000', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0019', 'P0006', '12', '4', '48', 'Cancelled', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0019', 'P0008', '1000', '3', '3000', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0020', 'P0006', '12', '4', '48', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0020', 'P0007', '12', '3', '36', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0020', 'P0008', '1000', '3', '3000', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0021', 'P0006', '12', '4', '48', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0021', 'P0008', '1000', '3', '3000', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0022', 'P0008', '1000', '10', '10000', 'Cancelled', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0023', 'P0006', '12', '5', '60', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0023', 'P0008', '1000', '5', '5000', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0024', 'P0006', '12', '5', '60', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0024', 'P0008', '1000', '6', '6000', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0025', 'P0006', '12', '5', '60', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0025', 'P0008', '1000', '6', '6000', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0026', 'P0006', '12', '5', '60', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0027', 'P0006', '12', '5', '60', 'Cancelled', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0028', 'P0006', '12', '5', '60', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0029', 'P0006', '12', '5', '60', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0029', 'P0008', '1000', '6', '6000', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0030', 'P0006', '12', '5', '60', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0030', 'P0008', '1000', '6', '6000', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0031', 'P0006', '12', '5', '60', 'Cancelled', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0032', 'P0006', '12', '5', '60', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0032', 'P0008', '1000', '1', '1000', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0033', 'P0006', '12', '5', '60', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0034', 'P0006', '12', '5', '60', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0034', 'P0008', '1000', '2', '2000', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0035', 'P0006', '12', '5', '60', 'Cancelled', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0036', 'P0008', '1000', '2', '2000', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0037', 'P0008', '1000', '2', '2000', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0038', 'P0008', '1000', '2', '2000', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0039', 'P0006', '12', '4', '48', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0041', 'P0006', '12', '16', '192', 'Cancelled', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0042', 'P0006', '12', '5', '60', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0042', 'P0007', '12', '1', '12', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0042', 'P0008', '1000', '2', '2000', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0043', 'P0007', '12', '3', '36', 'Cancelled', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0043', 'P0008', '1000', '4', '4000', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0044', 'P0008', '1000', '2', '2000', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0044', 'P0013', '45', '1', '45', 'Delivered', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0045', 'P0008', '1000', '5', '5000', 'Shipped', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0045', 'P0013', '45', '1', '45', 'Cancelled', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0046', 'P0010', '25', '1', '25', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0047', 'P0010', '25', '2', '50', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0048', 'P0007', '12', '2', '24', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0049', 'P0008', '1000', '2', '2000', 'Pending', 'Rated');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0050', 'P0008', '1000', '3', '3000', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0051', 'P0008', '1000', '5', '5000', 'Pending', 'Rated');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0052', 'P0009', '33', '2', '66', 'Pending', 'Rated');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0053', 'P0008', '1000', '7', '7000', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0054', 'P0008', '1000', '8', '8000', 'Pending', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, order_status, commment_status) VALUES ('O0055', 'P0008', '1000', '8', '8000', 'Pending', 'Pending');

CREATE TABLE `orders` (
  `id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `ship_id` varchar(11) NOT NULL,
  `count` int(11) NOT NULL,
  `status` varchar(22) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `ship_id` (`ship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0011', 'U0007', '2024-09-07 22:37:17', '0.00', '13', '0', '', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0012', 'U0007', '2024-09-07 22:37:57', '0.00', '14', '0', '', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0013', 'U0007', '2024-09-07 22:40:46', '0.00', '15', '0', '', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0014', 'U0007', '2024-09-07 22:51:29', '0.00', '16', '0', '', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0015', 'U0007', '2024-09-07 22:54:24', '0.00', '17', '0', '', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0016', 'U0007', '2024-09-07 22:59:07', '0.00', '18', '0', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0017', 'U0007', '2024-09-07 23:13:42', '0.00', '19', '0', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0018', 'U0007', '2024-09-07 23:27:01', '0.00', '20', '0', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0019', 'U0007', '2024-09-07 23:33:15', '0.00', '22', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0020', 'U0007', '2024-09-07 23:35:13', '0.00', '23', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0021', 'U0007', '2024-09-07 23:37:35', '0.00', '24', '0', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0022', 'U0007', '2024-09-08 14:33:37', '0.00', '25', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0023', 'U0007', '2024-09-08 16:33:16', '0.00', '26', '3', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0024', 'U0007', '2024-09-08 16:34:32', '0.00', '27', '3', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0025', 'U0007', '2024-09-08 16:36:04', '0.00', '28', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0026', 'U0007', '2024-09-08 18:18:50', '63.00', '29', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0027', 'U0007', '2024-09-08 18:19:34', '66.00', '30', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0028', 'U0007', '2024-09-08 18:22:31', '66.00', '31', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0029', 'U0007', '2024-09-08 18:23:44', '5883.00', '32', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0030', 'U0007', '2024-09-08 18:26:24', '5882.80', '33', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0031', 'U0007', '2024-09-08 18:35:36', '65.80', '34', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0032', 'U0007', '2024-09-08 19:55:39', '1082.80', '35', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0033', 'U0007', '2024-09-08 20:32:40', '62.80', '36', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0034', 'U0007', '2024-09-09 08:55:02', '2002.80', '37', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0035', 'U0007', '2024-09-09 09:38:15', '65.80', '38', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0036', 'U0007', '2024-09-09 09:40:09', '2044.60', '39', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0037', 'U0007', '2024-09-09 09:40:54', '2044.60', '40', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0038', 'U0007', '2024-09-09 09:45:04', '2041.60', '41', '1', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0039', 'U0007', '2024-09-09 09:46:03', '53.56', '42', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0040', 'U0007', '2024-09-09 03:46:13', '34.00', '22', '3', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0041', 'U0007', '2024-09-09 18:50:05', '200.44', '43', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0042', 'U0007', '2024-09-09 22:23:04', '2011.44', '44', '3', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0043', 'U0007', '2024-09-13 18:53:08', '3919.52', '45', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0044', 'U0007', '2024-09-15 20:25:05', '1988.25', '46', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0045', 'U0007', '2024-09-15 20:26:54', '4898.25', '47', '2', 'Cancel', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0046', 'U0007', '2024-09-17 17:25:57', '27.10', '48', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0047', 'U0007', '2024-09-17 17:29:19', '52.60', '49', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0048', 'U0008', '2024-09-17 21:25:55', '26.08', '50', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0049', 'U0026', '2024-09-17 23:05:48', '2041.60', '51', '1', 'Paid', '2024-09-18 08:40:11');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0050', 'U0026', '2024-09-18 08:46:04', '2911.60', '52', '1', 'Cancel', '2024-09-18 08:46:04');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0051', 'U0026', '2024-09-18 11:51:02', '4851.60', '53', '1', 'Paid', '2024-09-18 11:51:02');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0052', 'U0026', '2024-09-18 11:54:32', '68.92', '54', '1', 'Paid', '2024-09-18 11:54:32');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0053', 'U0026', '2024-09-18 12:07:12', '6791.60', '55', '1', 'Paid', '2024-09-18 12:07:12');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0054', 'U0026', '2024-09-18 12:30:49', '7761.60', '56', '1', 'Paid', '2024-09-18 12:30:49');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0055', 'U0026', '2024-09-18 12:32:07', '7761.60', '57', '1', 'Cancel', '2024-09-18 12:32:07');

CREATE TABLE `payment_record` (
  `id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` varchar(55) NOT NULL,
  `order_id` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `payment_record_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0001', 'U0007', '2024-09-17 17:27:19', '27.10', 'card', 'O0046');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0002', 'U0007', '2024-09-17 17:31:05', '52.60', 'card', 'O0047');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0003', 'U0008', '2024-09-17 21:29:46', '26.08', 'card', 'O0048');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0004', 'U0026', '2024-09-18 08:02:32', '2041.60', 'card', 'O0049');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0005', 'U0026', '0000-00-00 00:00:00', '2911.60', 'card', 'O0050');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0006', 'U0026', '2024-09-18 11:51:26', '4851.60', 'card', 'O0051');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0007', 'U0026', '2024-09-18 11:54:59', '68.92', 'card', 'O0052');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0008', 'U0026', '2024-09-18 12:07:37', '6791.60', 'card', 'O0053');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0009', 'U0026', '2024-09-18 12:31:11', '7761.60', 'card', 'O0054');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0010', 'U0026', '0000-00-00 00:00:00', '7761.60', 'card', 'O0055');

CREATE TABLE `product` (
  `product_id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `product_photo` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0006', 'Keyboard', '12.00', 'CT0002', '0', '12', '122dd', '2.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0007', 'speaker', '12.00', 'CT0002', '1', '12', '122dd', '2.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0008', 'phone', '1000.00', 'CT0002', '1', '66a5386c41b21.jpg', 'wefewf', '12.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0009', 'table', '33.00', 'CT0002', '3', '', 'di samping itu', '23.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0010', 'chair', '25.00', 'CT0002', '5', '', 'comfortable chair', '10.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0011', 'sofa', '200.00', 'CT0002', '2', '', 'modern design sofa', '50.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0012', 'lamp', '15.00', 'CT0002', '10', '', 'LED table lamp', '2.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0013', 'shelf', '45.00', 'CT0002', '7', '', 'wooden shelf', '15.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0014', 'cabinet', '120.00', 'CT0002', '1', '', 'storage cabinet', '70.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0015', 'desk', '75.00', 'CT0002', '3', '', 'office desk', '35.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0016', 'bed', '300.00', 'CT0002', '1', '', 'king-size bed', '80.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0017', 'mirror', '60.00', 'CT0002', '4', '', 'wall-mounted mirror', '12.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0018', 'rug', '40.00', 'CT0002', '6', '', 'large living room rug', '5.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0019', 'dresser', '150.00', 'CT0002', '2', '', 'bedroom dresser', '40.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0020', 'coffee table', '80.00', 'CT0002', '3', '', 'glass coffee table', '20.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0021', 'bookshelf', '90.00', 'CT0002', '4', '', 'tall wooden bookshelf', '30.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0022', 'TV stand', '110.00', 'CT0002', '2', '', 'modern TV stand', '25.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0023', 'armchair', '120.00', 'CT0002', '2', '', 'luxury armchair', '15.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0024', 'nightstand', '35.00', 'CT0002', '6', '', 'wooden nightstand', '8.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0025', 'stool', '20.00', 'CT0002', '8', '', 'small round stool', '5.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0026', 'wardrobe', '250.00', 'CT0002', '1', '', 'large wardrobe', '90.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0027', 'ottoman', '50.00', 'CT0002', '5', '', 'comfortable ottoman', '10.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0028', 'bench', '75.00', 'CT0002', '4', '', 'entryway bench', '18.00');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight) VALUES ('P0029', 'recliner', '220.00', 'CT0002', '1', '', 'leather recliner', '35.00');

CREATE TABLE `shippers` (
  `ship_id` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `ship_method` varchar(50) NOT NULL,
  `status` varchar(12) NOT NULL,
  PRIMARY KEY (`ship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0008', 'werf', 'werwer', 'wer', 'werewr', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0011', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0013', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0014', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0015', 'sdf Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0016', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0017', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0018', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0019', 'Kuala Lumour Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0020', 'Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0021', 'ggggggggghhhhhhhh Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0022', 'ggggggggghhhhhhhh Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0023', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Melaka', 'POS LAJU', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0024', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Perlis', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0025', 'gfh Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0026', 'gfh Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0027', 'gfh Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0028', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'on', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0029', 'erw Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0030', 'erw Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0031', 'Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0032', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0033', 'The Chicken Rice Shop, Jalan Metro 2, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0034', 'fd Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0035', 'Jalan Merbau, Kampung Bukit Hijau, Kuala Selangor, Selangor, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0036', 'Jalan Bukit Tunku, Kenny Hill, Taman Duta, Kuala Lumpur, 50580, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0037', 'Jalan Tuanku Abdul Halim, Duta, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'J&T', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0038', 'Elmina Green, Section U17, Desa Impian, Shah Alam, Petaling, Selangor, 47000, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0039', 'Ministry of Home Affairs, Jalan Sri Hartamas 1, Duta, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0040', 'Persiaran Tuanku Syed Sirajuddin, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0041', 'Mont Kiara International School, 22, Jalan Kiara, Mont Kiara, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0042', 'Jalan Sarawak, Kampung Dollah, Pudu, Kuala Lumpur, 55720, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0043', 'Guthrie Corridor Expressway, Kampung Setia, Kuang, Selayang Municipal Council, Gombak, 47000, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0044', 'Tinggian Tunku, Kenny Hill, Taman Duta, Kuala Lumpur, 50480, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0045', 'Jalan SS 22/41, SS 22, Damansara Jaya, Petaling Jaya, Petaling, Selangor, 47400, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', '0122323232', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0046', 'Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Terengganu', 'NINJA VAN', '012-9394023', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0047', 'Jalan PJU 10/13D, Damansara Damai, PJU 10, Petaling Jaya, Petaling, Selangor, 47830, Malaysia Terengganu', 'NINJA VAN', '012-9394023', 'door', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0048', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Melaka', 'NINJA VAN', 'sad', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0049', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Melaka', 'NINJA VAN', 'sad', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0050', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Negeri Sembilan', 'POS LAJU', '012-29298321', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0051', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Kelantan', 'NINJA VAN', '012-29298321', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0052', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Selangor', 'NINJA VAN', '012-29298321', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0053', 'Jalan Pantai Permai 5, Kampung Tradisi Sri Pantai, Kuala Lumpur, 59200, Malaysia Selangor', 'NINJA VAN', '012-29298321', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0054', 'Jalan BU 10/5, PJU 6, Bandar Utama, Petaling Jaya, Petaling, Selangor, 47800, Malaysia Putrajaya', 'NINJA VAN', '012-29298321', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0055', 'Jalan Pantai Permai 5, Kampung Tradisi Sri Pantai, Kuala Lumpur, 59200, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'ss', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0056', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Terengganu', 'NINJA VAN', 'ss', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0057', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Sarawak', 'NINJA VAN', 'ss', 'pick', 'Pending');

CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `verification_code` char(6) NOT NULL,
  `expire` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`verification_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `user` (
  `user_id` varchar(5) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0001', 'Root', '1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e16e9f590ec.jpg', 'Root', 'Active', '0', '2024-09-10 12:49:23', '0000-00-00 00:00:00', '2024-09-18 14:24:49', '1', '2024-09-18 14:24:49', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0002', 'William Jones', 'william.j@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1997-09-30', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-06 13:20:11', '0000-00-00 00:00:00', '2024-09-07 14:45:09', '1', '2024-09-07 14:45:09', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0003', 'Ava Garcia', 'ava.g@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2000-01-21', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-08 16:24:47', '0000-00-00 00:00:00', '2024-09-10 11:02:54', '1', '2024-09-10 11:02:54', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0004', 'James Martinez', 'james.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1994-08-17', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-14 08:22:13', '0000-00-00 00:00:00', '2024-09-15 17:00:10', '1', '2024-09-15 17:00:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0005', 'Sophia Anderson', 'sophia.a@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-06-13', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-13 17:55:22', '0000-00-00 00:00:00', '2024-09-14 12:45:10', '1', '2024-09-14 12:45:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0006', 'Lucas White', 'lucas.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1998-05-12', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-10 18:33:27', '0000-00-00 00:00:00', '2024-09-12 16:20:50', '1', '2024-09-12 16:20:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0007', 'Mia Clark', 'mia.c@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1996-04-28', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-07 21:10:11', '0000-00-00 00:00:00', '2024-09-09 10:15:35', '1', '2024-09-09 10:15:35', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0008', 'Benjamin Lewis', 'benjamin.l@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1993-10-01', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 17:44:30', '0000-00-00 00:00:00', '2024-09-12 15:32:10', '1', '2024-09-12 15:32:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0009', 'Ella Rodriguez', 'ella.r@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2001-12-12', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-09 13:00:20', '0000-00-00 00:00:00', '2024-09-10 14:32:43', '1', '2024-09-10 14:32:43', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0010', 'Henry Walker', 'henry.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1995-11-27', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 14:45:13', '0000-00-00 00:00:00', '2024-09-14 11:30:15', '1', '2024-09-14 11:30:15', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0011', 'Amelia Young', 'amelia.y@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-08-14', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-12 20:02:16', '0000-00-00 00:00:00', '2024-09-15 17:55:32', '1', '2024-09-15 17:55:32', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0012', 'Admin', '2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e164f231f73.jpg', 'Admin', 'Active', '0', '2024-09-18 12:09:10', '0000-00-00 00:00:00', '2024-09-18 14:33:59', '1', '2024-09-18 14:33:59', '2024-09-10 12:11:54', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0013', 'Ethan Harris', 'ethan.h@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1994-07-07', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-07 16:33:10', '0000-00-00 00:00:00', '2024-09-08 17:21:50', '1', '2024-09-08 17:21:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0014', 'Harper Green', 'harper.g@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1999-12-05', '66e164f231f73.jpg', 'Member', 'Banned', '0', '2024-09-06 10:12:00', '0000-00-00 00:00:00', '2024-09-07 09:11:20', '1', '2024-09-07 09:11:20', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0015', 'Alexander Lee', 'alexander.l@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2000-03-08', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-13 11:00:15', '0000-00-00 00:00:00', '2024-09-14 13:05:44', '1', '2024-09-14 13:05:44', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0016', 'Isabella Scott', 'isabella.s@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1996-10-23', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 12:15:11', '0000-00-00 00:00:00', '2024-09-13 15:02:55', '1', '2024-09-13 15:02:55', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0017', 'Daniel Carter', 'daniel.c@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-02-18', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-12 09:40:23', '0000-00-00 00:00:00', '2024-09-13 17:11:47', '1', '2024-09-13 17:11:47', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0018', 'Emily King', 'emily.k@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2001-11-20', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-10 08:33:18', '0000-00-00 00:00:00', '2024-09-12 10:00:22', '1', '2024-09-12 10:00:22', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0019', 'Emily Johnson', '3@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1992-12-05', '66dfc553b0989.jpg', 'Admin', 'Active', '0', '2024-09-18 12:06:06', '0000-00-00 00:00:00', '2024-09-18 12:07:53', '1', '2024-09-18 12:07:53', '2024-09-07 17:05:09', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0020', 'Micky Way', '4@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1991-10-16', '66e017b2e5a89.jpg', 'Admin', 'Active', '0', '2024-09-10 12:44:20', '0000-00-00 00:00:00', '2024-09-11 16:02:55', '1', '2024-09-11 16:02:55', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0021', 'Sophia Davis', '5@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-09-10', '66e92306b357a.jpg', 'Member', 'Banned', '0', '2024-09-10 12:43:33', '0000-00-00 00:00:00', '2024-09-10 12:46:10', '1', '2024-09-10 12:46:10', '2024-09-18 11:59:48', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0022', 'Liam Brown', 'liam.b@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1993-05-18', '66e82a2818964.jpg', 'Member', 'Banned', '0', '2024-09-07 14:20:10', '0000-00-00 00:00:00', '2024-09-10 10:01:23', '1', '2024-09-10 10:01:23', '2024-09-18 11:57:41', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0023', 'Olivia Miller', 'olivia.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-07-25', '66e82a2fd5a52.jpg', 'Member', 'Banned', '0', '2024-09-12 11:15:49', '0000-00-00 00:00:00', '2024-09-15 14:05:20', '1', '2024-09-15 14:05:20', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0024', 'Noah Smith', 'noah.s@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1996-11-02', '66e82a372cc9f.jpg', 'Member', 'Banned', '0', '2024-09-08 09:30:17', '0000-00-00 00:00:00', '2024-09-09 12:45:02', '1', '2024-09-09 12:45:02', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0025', 'Emma Wilson', 'emma.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1999-03-15', '66ddc8a6f2098.jpg', 'Member', 'Active', '0', '2024-09-13 15:21:55', '0000-00-00 00:00:00', '2024-09-15 16:34:22', '1', '2024-09-15 16:34:22', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
