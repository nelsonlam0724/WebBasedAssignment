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

INSERT INTO address (address_id, user_id, street, city, state, postal_code, country) VALUES ('A0001', 'U0002', 'hello', 'byebye', 'hihi', 'haha', 'hoho');

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
  KEY `product_id` (`product_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0001', 'U0023', 'P0007', '2024-09-18 23:31:18', 'Middle', '3', '下载.jfif');
INSERT INTO comment (comment_id, user_id, product_id, datetime, comment, rate, photo) VALUES ('CM0002', 'U0023', 'P0008', '2024-09-18 23:36:22', 'I like this!!!', '5', 'wp3837749.jpg');

CREATE TABLE `favorite` (
  `id` varchar(11) NOT NULL,
  `product_id` varchar(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO favorite (id, product_id, user_id) VALUES ('F0001', 'P0007', 'U0023');
INSERT INTO favorite (id, product_id, user_id) VALUES ('F0002', 'P0009', 'U0023');

CREATE TABLE `order_details` (
  `order_id` varchar(11) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `unit` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `commment_status` varchar(20) NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0001', 'P0008', '1000', '5', '5000', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0002', 'P0008', '1000', '5', '5000', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0003', 'P0008', '1000', '5', '5000', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0003', 'P0009', '33', '1', '33', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0003', 'P0010', '25', '1', '25', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0004', 'P0008', '1000', '5', '5000', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0004', 'P0009', '33', '1', '33', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0004', 'P0010', '25', '1', '25', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0005', 'P0009', '33', '1', '33', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0005', 'P0010', '25', '1', '25', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0006', 'P0007', '12', '1', '12', 'Rated');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0006', 'P0008', '1000', '1', '1000', 'Rated');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0007', 'P0008', '1000', '2', '2000', 'Pending');
INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status) VALUES ('O0008', 'P0008', '1000', '2', '2000', 'Pending');

CREATE TABLE `orders` (
  `id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `ship_id` varchar(11) NOT NULL,
  `count` int(11) NOT NULL,
  `status` enum('Pending','Cancelled','Delivered','Shipped','Paid') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `ship_id` (`ship_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ship_id`) REFERENCES `shippers` (`ship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0001', 'U0023', '2024-09-18 22:56:17', '4851.60', 'S0002', '1', '', '2024-09-18 22:56:17');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0002', 'U0023', '2024-09-18 23:01:00', '4850.00', 'S0003', '1', '', '2024-09-18 23:01:00');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0003', 'U0023', '2024-09-18 23:05:07', '4907.86', 'S0004', '3', '', '2024-09-18 23:05:07');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0004', 'U0023', '2024-09-18 23:12:27', '4906.26', 'S0005', '3', 'Paid', '2024-09-18 23:12:27');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0005', 'U0023', '2024-09-18 23:18:28', '60.76', 'S0006', '2', 'Paid', '2024-09-18 23:18:28');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0006', 'U0023', '2024-09-18 23:29:17', '1033.84', 'S0007', '2', 'Paid', '2024-09-18 23:29:17');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0007', 'U0023', '2024-09-18 23:46:37', '2041.60', 'S0008', '1', '', '2024-09-18 23:46:37');
INSERT INTO orders (id, user_id, datetime, total, ship_id, count, status, created_at) VALUES ('O0008', 'U0023', '2024-09-18 23:48:25', '2041.60', 'S0009', '1', 'Paid', '2024-09-18 23:48:25');

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

INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0001', 'U0023', '0000-00-00 00:00:00', '4851.60', 'card', 'O0001');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0002', 'U0023', '0000-00-00 00:00:00', '4850.00', 'card', 'O0002');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0003', 'U0023', '0000-00-00 00:00:00', '4907.86', 'card', 'O0003');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0004', 'U0023', '2024-09-18 23:13:09', '4906.26', 'card', 'O0004');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0005', 'U0023', '2024-09-18 23:18:57', '60.76', 'card', 'O0005');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0006', 'U0023', '2024-09-18 23:29:58', '1033.84', 'card', 'O0006');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0007', 'U0023', '0000-00-00 00:00:00', '2041.60', 'card', 'O0007');
INSERT INTO payment_record (id, user_id, datetime, amount, method, order_id) VALUES ('PR0008', 'U0023', '2024-09-18 23:49:07', '2041.60', 'card', 'O0008');

CREATE TABLE `product` (
  `product_id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `product_photo` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `status` varchar(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0006', 'Keyboard', '12.00', 'CT0002', '5', '12', '122dd', '2.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0007', 'speaker', '12.00', 'CT0002', '1', '12', '122dd', '2.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0008', 'phone', '1000.00', 'CT0002', '1', '66a5386c41b21.jpg', 'wefewf', '12.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0009', 'table', '33.00', 'CT0002', '3', '', 'di samping itu', '23.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0010', 'chair', '25.00', 'CT0002', '5', '', 'comfortable chair', '10.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0011', 'sofa', '200.00', 'CT0002', '2', '', 'modern design sofa', '50.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0012', 'lamp', '15.00', 'CT0002', '10', '', 'LED table lamp', '2.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0013', 'shelf', '45.00', 'CT0002', '7', '', 'wooden shelf', '15.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0014', 'cabinet', '120.00', 'CT0002', '1', '', 'storage cabinet', '70.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0015', 'desk', '75.00', 'CT0002', '3', '', 'office desk', '35.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0016', 'bed', '300.00', 'CT0002', '1', '', 'king-size bed', '80.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0017', 'mirror', '60.00', 'CT0002', '4', '', 'wall-mounted mirror', '12.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0018', 'rug', '40.00', 'CT0002', '6', '', 'large living room rug', '5.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0019', 'dresser', '150.00', 'CT0002', '2', '', 'bedroom dresser', '40.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0020', 'coffee table', '80.00', 'CT0002', '3', '', 'glass coffee table', '20.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0021', 'bookshelf', '90.00', 'CT0002', '4', '', 'tall wooden bookshelf', '30.00', 'Unavailable');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0022', 'TV stand', '110.00', 'CT0002', '2', '', 'modern TV stand', '25.00', 'Unavailable');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0023', 'armchair', '120.00', 'CT0002', '2', '', 'luxury armchair', '15.00', 'Unavailable');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0024', 'nightstand', '35.00', 'CT0002', '6', '', 'wooden nightstand', '8.00', 'Unavailable');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0025', 'stool', '20.00', 'CT0002', '8', '', 'small round stool', '5.00', 'Unavailable');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0026', 'wardrobe', '250.00', 'CT0002', '1', '', 'large wardrobe', '90.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0027', 'ottoman', '50.00', 'CT0002', '5', '', 'comfortable ottoman', '10.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0028', 'bench', '75.00', 'CT0002', '4', '', 'entryway bench', '18.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0029', 'recliner', '220.00', 'CT0002', '1', '', 'leather recliner', '35.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0030', 'Musang King', '12.34', 'CT0002', '10', '', '123456789', '1.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0031', 'Musang King', '12.34', 'CT0002', '5', '', '123', '1.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0032', 'Lam Wei Hong', '12.34', 'CT0002', '1', '', '123', '1.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0033', 'Hacker', '12.34', 'CT0002', '1', '', '123', '1.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0034', 'Hacker', '12.34', 'CT0002', '1', '', '123', '1.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0035', 'Musang King', '12.34', 'CT0002', '1', '', '123', '1.00', 'Available');
INSERT INTO product (product_id, name, price, category_id, quantity, product_photo, description, weight, status) VALUES ('P0036', 'ing', '12.34', 'CT0002', '1', '', '1', '1.00', 'Available');

CREATE TABLE `product_image` (
  `image_id` varchar(6) NOT NULL,
  `product_id` varchar(6) NOT NULL,
  `product_photo` varchar(255) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0001', 'P0031', '66ebe8a3f0a79.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0002', 'P0031', '66ebe8a4002ae.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0003', 'P0031', '66ebe9fec7d7c.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0004', 'P0031', '66ebea18d0e72.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0008', 'P0032', '66ebee56bc4c0.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0012', 'P0032', '66ebef650788d.jpg');

CREATE TABLE `shippers` (
  `ship_id` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `ship_method` varchar(50) NOT NULL,
  `status` varchar(12) NOT NULL,
  PRIMARY KEY (`ship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0001', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Penang', 'NINJA VAN', 'ewe', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0002', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Penang', 'POS LAJU', 'ewe', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0003', 'Jalan 5/5, Section 5, Section 6, Petaling Jaya, Petaling, Selangor, 46990, Malaysia Penang', 'POS LAJU', 'ewe', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0004', 'Jalan Pantai Permai Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'ewf', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0005', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'ewf', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0006', 'chi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Putrajaya', 'NINJA VAN', 'ewf', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0007', 'Jalan Penchala, Putrajaya', 'POS LAJU', 'ewf', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0008', '12, Jalan 10/12, Section 10, Petaling Jaya, Petaling, Selangor, 46661, Malaysia Kelantan', 'POS LAJU', 'ewf', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0009', '9, Jalan 10/4, Section 10, Petaling Jaya, Petaling, Selangor, 46661, Malaysia Putrajaya', 'J&T', 'ewf', 'pick', 'Pending');

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

INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0001', 'Root', '1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e16e9f590ec.jpg', 'Root', 'Active', '0', '2024-09-10 12:49:23', '', '2024-09-20 13:23:31', '1', '2024-09-20 13:23:31', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0002', 'William Jones', 'william.j@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1997-09-30', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-06 13:20:11', '0000-00-00 00:00:00', '2024-09-07 14:45:09', '1', '2024-09-07 14:45:09', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0003', 'Ava Garcia', 'ava.g@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2000-01-21', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-08 16:24:47', '0000-00-00 00:00:00', '2024-09-10 11:02:54', '1', '2024-09-10 11:02:54', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0004', 'James Martinez', 'james.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1994-08-17', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-14 08:22:13', '0000-00-00 00:00:00', '2024-09-15 17:00:10', '1', '2024-09-15 17:00:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0005', 'Sophia Anderson', 'sophia.a@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-06-13', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-13 17:55:22', '0000-00-00 00:00:00', '2024-09-14 12:45:10', '1', '2024-09-14 12:45:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0006', 'Lucas White', 'lucas.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1998-05-12', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-10 18:33:27', '0000-00-00 00:00:00', '2024-09-12 16:20:50', '1', '2024-09-12 16:20:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0007', 'Mia Clark', 'mia.c@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1996-04-28', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-07 21:10:11', '0000-00-00 00:00:00', '2024-09-09 10:15:35', '1', '2024-09-09 10:15:35', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0008', 'Benjamin Lewis', 'benjamin.l@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1993-10-01', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 17:44:30', '0000-00-00 00:00:00', '2024-09-18 17:11:12', '1', '2024-09-18 17:11:12', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0009', 'Ella Rodriguez', 'ella.r@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2001-12-12', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-09 13:00:20', '0000-00-00 00:00:00', '2024-09-10 14:32:43', '1', '2024-09-10 14:32:43', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0010', 'Henry Walker', 'henry.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1995-11-27', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 14:45:13', '0000-00-00 00:00:00', '2024-09-14 11:30:15', '1', '2024-09-14 11:30:15', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0011', 'Amelia Young', 'amelia.y@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-08-14', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-12 20:02:16', '0000-00-00 00:00:00', '2024-09-15 17:55:32', '1', '2024-09-15 17:55:32', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0012', 'Admin', '2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e164f231f73.jpg', 'Admin', 'Active', '0', '2024-09-18 12:09:10', '0000-00-00 00:00:00', '2024-09-18 17:25:36', '1', '2024-09-18 17:25:36', '2024-09-10 12:11:54', '', '0000-00-00 00:00:00');
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
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0023', 'Olivia Miller', 'olivia.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-07-25', '66e82a2fd5a52.jpg', 'Member', 'Active', '0', '2024-09-12 11:15:49', '', '2024-09-18 21:31:26', '1', '2024-09-18 21:31:26', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0024', 'Noah Smith', 'noah.s@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1996-11-02', '66e82a372cc9f.jpg', 'Member', 'Banned', '0', '2024-09-08 09:30:17', '0000-00-00 00:00:00', '2024-09-09 12:45:02', '1', '2024-09-09 12:45:02', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('U0025', 'Emma Wilson', 'emma.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1999-03-15', '66ddc8a6f2098.jpg', 'Member', 'Active', '0', '2024-09-13 15:21:55', '0000-00-00 00:00:00', '2024-09-15 16:34:22', '1', '2024-09-15 16:34:22', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
