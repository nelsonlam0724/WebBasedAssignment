-- Database Backup
CREATE DATABASE IF NOT EXISTS `web_ass`;
USE `web_ass`;


CREATE TABLE `address` (
  `address_id` varchar(10) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0001', 'U0001', '1 Jalan Bintong', 'Kuala Lumpur', 'Wilayah Persekutuan', '50300', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0002', 'U0002', '2 Jalan Gurney', 'George Town', 'Penang', '10250', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0003', 'U0003', '3 Jalan Telawi', 'Bangsar', 'Kuala Lumpur', '59100', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0004', 'U0004', '4 Jalan Tunku Abdul Rahman', 'Kuala Lumpur', 'Wilayah Persekutuan', '50100', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0005', 'U0005', '5 Jalan Kampung Pandan', 'Kuala Lumpur', 'Wilayah Persekutuan', '55100', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0006', 'U0006', '6 Jalan Tun Razak', 'Kuala Lumpur', 'Wilayah Persekutuan', '50400', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0007', 'U0007', '7 Jalan Melaka', 'Kota Melaka', 'Melaka', '75000', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0008', 'U0008', '8 Jalan Bandar', 'Shah Alam', 'Selangor', '40000', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0009', 'U0009', '9 Jalan Bunga Raya', 'Malacca', 'Melaka', '75100', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0010', 'U0010', '10 Jalan Laksamana', 'Malacca', 'Melaka', '75000', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0011', 'U0011', '11 Jalan Pahlawan', 'Ipoh', 'Perak', '30000', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0012', 'U0012', '12 Jalan Dato Onn', 'Kota Bharu', 'Kelantan', '15000', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0013', 'U0013', '13 Jalan Setia', 'Petaling Jaya', 'Selangor', '47300', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0014', 'U0014', '14 Jalan Universiti', 'Kuantan', 'Pahang', '25100', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0015', 'U0015', '15 Jalan Pasir Mas', 'Kota Bharu', 'Kelantan', '15150', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0016', 'U0016', '16 Jalan Subang', 'Subang Jaya', 'Selangor', '47500', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0017', 'U0017', '17 Jalan Sri Hartamas', 'Kuala Lumpur', 'Wilayah Persekutuan', '50480', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0018', 'U0018', '18 Jalan Cheras', 'Kuala Lumpur', 'Wilayah Persekutuan', '56000', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0019', 'U0019', '19 Jalan Bukit Bintang', 'Kuala Lumpur', 'Wilayah Persekutuan', '55100', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0020', 'U0020', '20 Jalan Titiwangsa', 'Kuala Lumpur', 'Wilayah Persekutuan', '50460', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0021', 'U0021', '21 Jalan Sultan Ismail', 'Kuala Lumpur', 'Wilayah Persekutuan', '50200', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0022', 'U0022', '22 Jalan Mahameru', 'Kuala Lumpur', 'Wilayah Persekutuan', '50480', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0023', 'U0023', '23 Jalan Merdeka', 'Kota Kinabalu', 'Sabah', '88000', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0024', 'U0024', '24 Jalan Bangsar', 'Bangsar', 'Kuala Lumpur', '59100', 'Malaysia');
INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0025', 'U0025', '25 Jalan Kampung Melayu', 'Gombak', 'Selangor', '68100', 'Malaysia');
ALTER TABLE address ADD CONSTRAINT PRIMARY FOREIGN KEY (address_id) REFERENCES ();
ALTER TABLE address ADD CONSTRAINT address_ibfk_1 FOREIGN KEY (user_id) REFERENCES user(user_id);

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
ALTER TABLE bank ADD CONSTRAINT PRIMARY FOREIGN KEY (id) REFERENCES ();

CREATE TABLE `carts` (
  `id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `product_id` varchar(11) DEFAULT NULL,
  `unit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0001', 'U0023', 'P0008', '2');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0002', 'U0023', 'P0007', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0031', 'U0003', 'P0007', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0055', 'U0004', 'P0007', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0056', 'U0005', 'P0006', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0059', 'U0007', 'P0010', '2');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0060', 'U0008', 'P0007', '2');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0066', 'U0008', 'P0006', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0067', 'U0008', 'P0010', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0068', 'U0008', 'P0008', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0069', 'U0023', 'P0008', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0070', 'U0010', 'P0015', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0071', 'U0010', 'P0030', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0072', 'U0010', 'P0031', '5');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0075', 'U0016', 'P0031', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0076', 'U0009', 'P0008', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0077', 'U0015', 'P0009', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0078', 'U0015', 'P0012', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0079', 'U0017', 'P0014', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0080', 'U0017', 'P0015', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0081', 'U0017', 'P0007', '1');
INSERT INTO carts (id, user_id, product_id, unit) VALUES ('C0082', 'U0017', 'P0010', '1');
ALTER TABLE carts ADD CONSTRAINT PRIMARY FOREIGN KEY (id) REFERENCES ();
ALTER TABLE carts ADD CONSTRAINT carts_ibfk_1 FOREIGN KEY (product_id) REFERENCES product(product_id);
ALTER TABLE carts ADD CONSTRAINT carts_ibfk_2 FOREIGN KEY (user_id) REFERENCES user(user_id);

CREATE TABLE `category` (
  `category_id` varchar(10) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_status` varchar(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO category (category_id, category_name, category_status) VALUES ('CT0002', 'Hello', 'Activate');
INSERT INTO category (category_id, category_name, category_status) VALUES ('CT0003', 'Book', '2');
ALTER TABLE category ADD CONSTRAINT PRIMARY FOREIGN KEY (category_id) REFERENCES ();

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
  KEY `product_id` (`product_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0001', 'U0023', 'P0007', '2024-09-18 23:31:18', 'Middle', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0002', 'U0023', 'P0008', '2024-09-18 23:36:22', 'I like this!!!', '5', 'wp3837749.jpg');
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
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0015', 'U0007', 'P0006', '2024-09-10 10:06:30', 'er', '3', '[\"1074989.jpg\",\"wp3837749.jpg\"]');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0016', 'U0007', 'P0006', '2024-09-10 10:07:13', 'er', '3', '[\"1074989.jpg\",\"wp3837749.jpg\"]');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0017', 'U0007', 'P0006', '2024-09-10 10:08:40', 'g', '5', '屏幕截图(9).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0018', 'U0007', 'P0006', '2024-09-10 10:48:09', 'apa ni??', '4', '屏幕截图(54).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0019', 'U0007', 'P0006', '2024-09-10 11:33:16', 'sohai', '2', '屏幕截图(9).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0020', 'U0007', 'P0006', '2024-09-13 18:49:30', 'Stupid', '4', '屏幕截图(34).png');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0021', 'U0015', 'P0008', '2024-09-22 15:21:23', 'kimho', '4', '下载 (1).jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0022', 'U0015', 'P0008', '2024-09-22 15:22:04', 'kimho', '4', '下载 (1).jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0023', 'U0015', 'P0008', '2024-09-22 15:25:24', 'kimho', '4', '下载 (1).jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0024', 'U0015', 'P0008', '2024-09-22 15:26:09', 'kimho', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0025', 'U0015', 'P0008', '2024-09-22 15:26:29', 'kimho', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0026', 'U0015', 'P0008', '2024-09-22 15:26:48', 'kimho', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0027', 'U0015', 'P0008', '2024-09-22 15:27:38', 'kimho', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0028', 'U0015', 'P0008', '2024-09-22 15:27:52', 'kimho', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0029', 'U0015', 'P0008', '2024-09-22 15:27:56', 'kimho', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0030', 'U0015', 'P0008', '2024-09-22 15:28:05', 'kimho', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0031', 'U0015', 'P0008', '2024-09-22 15:28:27', 'kimho', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0032', 'U0015', 'P0008', '2024-09-22 15:29:44', 'kimho', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0033', 'U0015', 'P0008', '2024-09-22 15:30:16', 'kimho', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0034', 'U0015', 'P0008', '2024-09-22 15:30:24', 'kimho', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0035', 'U0015', 'P0009', '2024-09-22 15:34:10', 'Not like it', '2', 'wp3837749.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0036', 'U0015', 'P0031', '2024-09-22 15:42:48', 'it is ok', '3', 'wp3837749.jpg');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0037', 'U0015', 'P0030', '2024-09-22 15:56:14', 'ok!!! niceeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '5', '1074989.jpg');
ALTER TABLE comment ADD CONSTRAINT PRIMARY FOREIGN KEY (comment_id) REFERENCES ();
ALTER TABLE comment ADD CONSTRAINT comment_ibfk_1 FOREIGN KEY (product_id) REFERENCES product(product_id);
ALTER TABLE comment ADD CONSTRAINT comment_ibfk_2 FOREIGN KEY (user_id) REFERENCES user(user_id);
