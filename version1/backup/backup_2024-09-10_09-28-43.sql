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

