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
