-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 04:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_ass`
--
CREATE DATABASE IF NOT EXISTS `web_ass` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `web_ass`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` varchar(10) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `user_id`, `street`, `city`, `state`, `postal_code`, `country`) VALUES
('A0001', 'U0001', '1 Jalan Bintong', 'Kuala Lumpur', 'Wilayah Persekutuan', '50300', 'Malaysia'),
('A0002', 'U0002', '2 Jalan Gurney', 'George Town', 'Penang', '10250', 'Malaysia'),
('A0003', 'U0003', '3 Jalan Telawi', 'Bangsar', 'Kuala Lumpur', '59100', 'Malaysia'),
('A0004', 'U0004', '4 Jalan Tunku Abdul Rahman', 'Kuala Lumpur', 'Wilayah Persekutuan', '50100', 'Malaysia'),
('A0005', 'U0005', '5 Jalan Kampung Pandan', 'Kuala Lumpur', 'Wilayah Persekutuan', '55100', 'Malaysia'),
('A0006', 'U0006', '6 Jalan Tun Razak', 'Kuala Lumpur', 'Wilayah Persekutuan', '50400', 'Malaysia'),
('A0007', 'U0007', '7 Jalan Melaka', 'Kota Melaka', 'Melaka', '75000', 'Malaysia'),
('A0008', 'U0008', '8 Jalan Bandar', 'Shah Alam', 'Selangor', '40000', 'Malaysia'),
('A0009', 'U0009', '9 Jalan Bunga Raya', 'Malacca', 'Melaka', '75100', 'Malaysia'),
('A0010', 'U0010', '10 Jalan Laksamana', 'Malacca', 'Melaka', '75000', 'Malaysia'),
('A0011', 'U0011', '11 Jalan Pahlawan', 'Ipoh', 'Perak', '30000', 'Malaysia'),
('A0012', 'U0012', '12 Jalan Dato Onn', 'Kota Bharu', 'Kelantan', '15000', 'Malaysia'),
('A0013', 'U0013', '13 Jalan Setia', 'Petaling Jaya', 'Selangor', '47300', 'Malaysia'),
('A0014', 'U0014', '14 Jalan Universiti', 'Kuantan', 'Pahang', '25100', 'Malaysia'),
('A0015', 'U0015', '15 Jalan Pasir Mas', 'Kota Bharu', 'Kelantan', '15150', 'Malaysia'),
('A0016', 'U0016', '16 Jalan Subang', 'Subang Jaya', 'Selangor', '47500', 'Malaysia'),
('A0017', 'U0017', '17 Jalan Sri Hartamas', 'Kuala Lumpur', 'Wilayah Persekutuan', '50480', 'Malaysia'),
('A0018', 'U0018', '18 Jalan Cheras', 'Kuala Lumpur', 'Wilayah Persekutuan', '56000', 'Malaysia'),
('A0019', 'U0019', '19 Jalan Bukit Bintang', 'Kuala Lumpur', 'Wilayah Persekutuan', '55100', 'Malaysia'),
('A0020', 'U0020', '20 Jalan Titiwangsa', 'Kuala Lumpur', 'Wilayah Persekutuan', '50460', 'Malaysia'),
('A0021', 'U0021', '21 Jalan Sultan Ismail', 'Kuala Lumpur', 'Wilayah Persekutuan', '50200', 'Malaysia'),
('A0022', 'U0022', '22 Jalan Mahameru', 'Kuala Lumpur', 'Wilayah Persekutuan', '50480', 'Malaysia'),
('A0023', 'U0023', '23 Jalan Merdeka', 'Kota Kinabalu', 'Sabah', '88000', 'Malaysia'),
('A0024', 'U0024', '24 Jalan Bangsar', 'Bangsar', 'Kuala Lumpur', '59100', 'Malaysia'),
('A0025', 'U0025', '25 Jalan Kampung Melayu', 'Gombak', 'Selangor', '68100', 'Malaysia');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` varchar(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ccv` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `card` varchar(50) NOT NULL,
  `expires` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `balance`, `name`, `ccv`, `phone`, `card`, `expires`) VALUES
('1', 901.00, 'Sun Wu Kong ', '258', '010-7890123', '4010101010101010', '09/21'),
('2', 3500.25, 'Lee Wen Hao ', '217', '018-3535893', '4999969938799999', '09/23');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `product_id` varchar(11) DEFAULT NULL,
  `unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `unit`) VALUES
('C0001', 'U0023', 'P0008', 2),
('C0002', 'U0023', 'P0007', 1),
('C0031', 'U0003', 'P0007', 1),
('C0055', 'U0004', 'P0007', 1),
('C0056', 'U0005', 'P0006', 1),
('C0059', 'U0007', 'P0010', 2),
('C0060', 'U0008', 'P0007', 2),
('C0066', 'U0008', 'P0006', 1),
('C0067', 'U0008', 'P0010', 1),
('C0068', 'U0008', 'P0008', 1),
('C0069', 'U0023', 'P0008', 1),
('C0070', 'U0010', 'P0015', 1),
('C0071', 'U0010', 'P0030', 1),
('C0072', 'U0010', 'P0031', 5),
('C0075', 'U0016', 'P0031', 1),
('C0076', 'U0009', 'P0008', 1),
('C0077', 'U0015', 'P0009', 1),
('C0078', 'U0015', 'P0012', 1),
('C0079', 'U0017', 'P0014', 1),
('C0080', 'U0017', 'P0015', 1),
('C0081', 'U0017', 'P0007', 1),
('C0082', 'U0017', 'P0010', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` varchar(10) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES
('CT0002', 'Hello', 'Activate'),
('CT0003', 'Book', '2');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `product_id`, `datetime`, `comment`, `rate`, `photo`) VALUES
('CM0001', 'U0023', 'P0007', '2024-09-18 23:31:18', 'Middle', 3, '下载.jfif'),
('CM0002', 'U0023', 'P0008', '2024-09-18 23:36:22', 'I like this!!!', 5, 'wp3837749.jpg'),
('CM0004', 'U0006', 'P0007', '2024-09-09 13:11:35', 'Good', 2, 'fefwef'),
('CM0005', 'U0010', 'P0006', '2024-09-09 13:12:01', 'rubish!!!', 0, 'we'),
('CM0006', 'U0014', 'P0008', '2024-09-09 13:16:03', 'heheheheheheheh', 4, ''),
('CM0007', 'U0007', 'P0006', '0000-00-00 00:00:00', 'rubbish', 2, '7b73.jpg'),
('CM0008', 'U0007', 'P0006', '2024-09-09 23:58:51', 'not bad', 4, '7b73.jpg'),
('CM0009', 'U0007', 'P0006', '2024-09-10 00:13:56', 'zz', 3, '27ARISTOTLE-articleLarge.webp'),
('CM0010', 'U0007', 'P0006', '2024-09-10 00:14:39', 'axsx', 3, '27ARISTOTLE-articleLarge.webp'),
('CM0011', 'U0007', 'P0006', '2024-09-10 09:15:07', 'I  like this', 4, 'wp3837749.jpg'),
('CM0012', 'U0007', 'P0006', '2024-09-10 09:16:09', 'Very Excellent', 5, '下载 (1).jfif'),
('CM0013', 'U0007', 'P0006', '2024-09-10 09:53:47', '111111111122222222222', 3, 'wp3837749.jpg'),
('CM0014', 'U0007', 'P0006', '2024-09-10 09:59:47', 'beautiful!!!', 3, '1074989.jpg'),
('CM0015', 'U0007', 'P0006', '2024-09-10 10:06:30', 'er', 3, '[\"1074989.jpg\",\"wp3837749.jpg\"]'),
('CM0016', 'U0007', 'P0006', '2024-09-10 10:07:13', 'er', 3, '[\"1074989.jpg\",\"wp3837749.jpg\"]'),
('CM0017', 'U0007', 'P0006', '2024-09-10 10:08:40', 'g', 5, '屏幕截图(9).png'),
('CM0018', 'U0007', 'P0006', '2024-09-10 10:48:09', 'apa ni??', 4, '屏幕截图(54).png'),
('CM0019', 'U0007', 'P0006', '2024-09-10 11:33:16', 'sohai', 2, '屏幕截图(9).png'),
('CM0020', 'U0007', 'P0006', '2024-09-13 18:49:30', 'Stupid', 4, '屏幕截图(34).png'),
('CM0021', 'U0015', 'P0008', '2024-09-22 15:21:23', 'kimho', 4, '下载 (1).jfif'),
('CM0022', 'U0015', 'P0008', '2024-09-22 15:22:04', 'kimho', 4, '下载 (1).jfif'),
('CM0023', 'U0015', 'P0008', '2024-09-22 15:25:24', 'kimho', 4, '下载 (1).jfif'),
('CM0024', 'U0015', 'P0008', '2024-09-22 15:26:09', 'kimho', 3, '下载.jfif'),
('CM0025', 'U0015', 'P0008', '2024-09-22 15:26:29', 'kimho', 3, '下载.jfif'),
('CM0026', 'U0015', 'P0008', '2024-09-22 15:26:48', 'kimho', 3, '下载.jfif'),
('CM0027', 'U0015', 'P0008', '2024-09-22 15:27:38', 'kimho', 3, '下载.jfif'),
('CM0028', 'U0015', 'P0008', '2024-09-22 15:27:52', 'kimho', 3, '下载.jfif'),
('CM0029', 'U0015', 'P0008', '2024-09-22 15:27:56', 'kimho', 3, '下载.jfif'),
('CM0030', 'U0015', 'P0008', '2024-09-22 15:28:05', 'kimho', 3, '下载.jfif'),
('CM0031', 'U0015', 'P0008', '2024-09-22 15:28:27', 'kimho', 3, '下载.jfif'),
('CM0032', 'U0015', 'P0008', '2024-09-22 15:29:44', 'kimho', 3, '下载.jfif'),
('CM0033', 'U0015', 'P0008', '2024-09-22 15:30:16', 'kimho', 3, '下载.jfif'),
('CM0034', 'U0015', 'P0008', '2024-09-22 15:30:24', 'kimho', 3, '下载.jfif'),
('CM0035', 'U0015', 'P0009', '2024-09-22 15:34:10', 'Not like it', 2, 'wp3837749.jpg'),
('CM0036', 'U0015', 'P0031', '2024-09-22 15:42:48', 'it is ok', 3, 'wp3837749.jpg'),
('CM0037', 'U0015', 'P0030', '2024-09-22 15:56:14', 'ok!!! niceeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 5, '1074989.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` varchar(11) NOT NULL,
  `product_id` varchar(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `product_id`, `user_id`) VALUES
('F0001', 'P0007', 'U0023'),
('F0002', 'P0009', 'U0023'),
('F0192', 'P0008', 'U0007'),
('F0193', 'P0013', 'U0007'),
('F0195', 'P0013', 'U0008'),
('F0196', 'P0015', 'U0008'),
('F0197', 'P0007', 'U0008'),
('F0198', 'P0009', 'U0015'),
('F0199', 'P0010', 'U0015'),
('F0200', 'P0015', 'U0015'),
('F0202', 'P0008', 'U0015'),
('F0203', 'P0012', 'U0015'),
('F0204', 'P0011', 'U0015'),
('F0206', 'P0015', 'U0017');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `ship_id` varchar(11) NOT NULL,
  `count` int(11) NOT NULL,
  `status` enum('Pending','Cancelled','Delivered','Shipped','Paid') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `datetime`, `total`, `ship_id`, `count`, `status`, `created_at`) VALUES
('O0001', 'U0023', '2024-09-18 22:56:17', 4851.60, 'S0002', 1, 'Cancelled', '2024-09-18 14:56:17'),
('O0002', 'U0023', '2024-09-18 23:01:00', 4850.00, 'S0003', 1, 'Cancelled', '2024-09-18 15:01:00'),
('O0003', 'U0023', '2024-09-18 23:05:07', 4907.86, 'S0004', 3, 'Cancelled', '2024-09-18 15:05:07'),
('O0004', 'U0023', '2024-09-18 23:12:27', 4906.26, 'S0005', 3, 'Paid', '2024-09-18 15:12:27'),
('O0005', 'U0023', '2024-09-18 23:18:28', 60.76, 'S0006', 2, 'Paid', '2024-09-18 15:18:28'),
('O0006', 'U0023', '2024-09-18 23:29:17', 1033.84, 'S0007', 2, 'Paid', '2024-09-18 15:29:17'),
('O0007', 'U0023', '2024-09-18 23:46:37', 2041.60, 'S0008', 1, 'Cancelled', '2024-09-18 15:46:37'),
('O0008', 'U0023', '2024-09-18 23:48:25', 2041.60, 'S0009', 1, 'Paid', '2024-09-18 15:48:25'),
('O0009', 'U0016', '2024-09-22 08:12:09', 1021.60, 'S0010', 1, '', '2024-09-22 00:12:09'),
('O0010', 'U0016', '2024-09-22 08:13:15', 1021.60, 'S0011', 1, '', '2024-09-22 00:13:15'),
('O0011', 'U0016', '2024-09-22 08:13:56', 1021.60, 'S0013', 1, '', '2024-09-22 00:13:56'),
('O0012', 'U0016', '2024-09-22 08:14:29', 1021.60, 'S0014', 1, '', '2024-09-22 00:14:29'),
('O0013', 'U0016', '2024-09-22 08:14:48', 1021.60, 'S0015', 1, '', '2024-09-22 00:14:48'),
('O0014', 'U0016', '2024-09-22 08:16:15', 1021.60, 'S0016', 1, '', '2024-09-22 00:16:15'),
('O0015', 'U0016', '2024-09-22 08:16:49', 1021.60, 'S0017', 1, '', '2024-09-22 00:16:49'),
('O0016', 'U0016', '2024-09-22 08:17:02', 1020.00, 'S0018', 1, '', '2024-09-22 00:17:02'),
('O0017', 'U0016', '2024-09-22 08:20:40', 1020.00, 'S0019', 1, '', '2024-09-22 00:20:40'),
('O0018', 'U0016', '2024-09-22 08:30:57', 1021.60, 'S0020', 1, '', '2024-09-22 00:30:57'),
('O0019', 'U0016', '2024-09-22 08:36:40', 1021.60, 'S0021', 1, 'Cancelled', '2024-09-22 00:36:40'),
('O0020', 'U0016', '2024-09-22 08:37:49', 1021.60, 'S0023', 1, 'Cancelled', '2024-09-22 00:37:49'),
('O0021', 'U0016', '2024-09-22 08:38:05', 1021.60, 'S0024', 1, 'Paid', '2024-09-22 00:38:05'),
('O0022', 'U0016', '2024-09-22 08:45:23', 14.19, 'S0025', 1, 'Paid', '2024-09-22 00:45:23'),
('O0023', 'U0015', '2024-09-22 15:13:07', 2041.60, 'S0026', 1, 'Paid', '2024-09-22 07:13:07'),
('O0024', 'U0015', '2024-09-22 15:32:40', 35.26, 'S0027', 1, 'Paid', '2024-09-22 07:32:40'),
('O0025', 'U0015', '2024-09-22 15:37:23', 89.71, 'S0028', 1, 'Paid', '2024-09-22 07:37:23'),
('O0026', 'U0015', '2024-09-22 15:46:45', 14.19, 'S0029', 1, 'Paid', '2024-09-22 07:46:45'),
('O0027', 'U0015', '2024-09-22 16:32:39', 102.29, 'S0030', 2, 'Paid', '2024-09-22 08:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` varchar(11) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `unit` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `commment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `price`, `unit`, `subtotal`, `commment_status`) VALUES
('O0001', 'P0008', 1000, 5, 5000, 'Pending'),
('O0002', 'P0008', 1000, 5, 5000, 'Pending'),
('O0003', 'P0008', 1000, 5, 5000, 'Pending'),
('O0003', 'P0009', 33, 1, 33, 'Pending'),
('O0003', 'P0010', 25, 1, 25, 'Pending'),
('O0004', 'P0008', 1000, 5, 5000, 'Pending'),
('O0004', 'P0009', 33, 1, 33, 'Pending'),
('O0004', 'P0010', 25, 1, 25, 'Pending'),
('O0005', 'P0009', 33, 1, 33, 'Pending'),
('O0005', 'P0010', 25, 1, 25, 'Pending'),
('O0006', 'P0007', 12, 1, 12, 'Rated'),
('O0006', 'P0008', 1000, 1, 1000, 'Rated'),
('O0007', 'P0008', 1000, 2, 2000, 'Pending'),
('O0008', 'P0008', 1000, 2, 2000, 'Pending'),
('O0009', 'P0008', 1000, 1, 1000, 'Pending'),
('O0010', 'P0008', 1000, 1, 1000, 'Pending'),
('O0011', 'P0008', 1000, 1, 1000, 'Pending'),
('O0012', 'P0008', 1000, 1, 1000, 'Pending'),
('O0013', 'P0008', 1000, 1, 1000, 'Pending'),
('O0014', 'P0008', 1000, 1, 1000, 'Pending'),
('O0015', 'P0008', 1000, 1, 1000, 'Pending'),
('O0016', 'P0008', 1000, 1, 1000, 'Pending'),
('O0017', 'P0008', 1000, 1, 1000, 'Pending'),
('O0018', 'P0008', 1000, 1, 1000, 'Pending'),
('O0019', 'P0008', 1000, 1, 1000, 'Pending'),
('O0020', 'P0008', 1000, 1, 1000, 'Pending'),
('O0021', 'P0008', 1000, 1, 1000, 'Pending'),
('O0022', 'P0031', 12, 1, 12, 'Pending'),
('O0023', 'P0008', 1000, 2, 2000, 'Rated'),
('O0024', 'P0009', 33, 1, 33, 'Rated'),
('O0025', 'P0031', 12, 7, 84, 'Rated'),
('O0026', 'P0030', 12, 1, 12, 'Rated'),
('O0027', 'P0030', 12, 1, 12, 'Pending'),
('O0027', 'P0031', 12, 7, 84, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment_record`
--

CREATE TABLE `payment_record` (
  `id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` varchar(55) NOT NULL,
  `order_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_record`
--

INSERT INTO `payment_record` (`id`, `user_id`, `datetime`, `amount`, `method`, `order_id`) VALUES
('PR0001', 'U0023', '0000-00-00 00:00:00', 4851.60, 'card', 'O0001'),
('PR0002', 'U0023', '0000-00-00 00:00:00', 4850.00, 'card', 'O0002'),
('PR0003', 'U0023', '0000-00-00 00:00:00', 4907.86, 'card', 'O0003'),
('PR0004', 'U0023', '2024-09-18 23:13:09', 4906.26, 'card', 'O0004'),
('PR0005', 'U0023', '2024-09-18 23:18:57', 60.76, 'card', 'O0005'),
('PR0006', 'U0023', '2024-09-18 23:29:58', 1033.84, 'card', 'O0006'),
('PR0007', 'U0023', '0000-00-00 00:00:00', 2041.60, 'card', 'O0007'),
('PR0008', 'U0023', '2024-09-18 23:49:07', 2041.60, 'card', 'O0008'),
('PR0009', 'U0016', '0000-00-00 00:00:00', 1021.60, 'card', 'O0009'),
('PR0010', 'U0016', '0000-00-00 00:00:00', 1021.60, 'card', 'O0010'),
('PR0011', 'U0016', '0000-00-00 00:00:00', 1021.60, 'card', 'O0011'),
('PR0012', 'U0016', '0000-00-00 00:00:00', 1021.60, 'card', 'O0012'),
('PR0013', 'U0016', '0000-00-00 00:00:00', 1021.60, 'card', 'O0013'),
('PR0014', 'U0016', '0000-00-00 00:00:00', 1021.60, 'card', 'O0014'),
('PR0015', 'U0016', '0000-00-00 00:00:00', 1021.60, 'card', 'O0015'),
('PR0016', 'U0016', '0000-00-00 00:00:00', 1020.00, 'card', 'O0016'),
('PR0017', 'U0016', '0000-00-00 00:00:00', 1020.00, 'card', 'O0017'),
('PR0018', 'U0016', '0000-00-00 00:00:00', 1021.60, 'card', 'O0018'),
('PR0019', 'U0016', '0000-00-00 00:00:00', 1021.60, 'card', 'O0019'),
('PR0020', 'U0016', '2024-09-22 08:39:51', 1021.60, 'card', 'O0021'),
('PR0021', 'U0016', '2024-09-22 08:47:00', 14.19, 'card', 'O0022'),
('PR0022', 'U0015', '2024-09-22 15:13:52', 2041.60, 'card', 'O0023'),
('PR0023', 'U0015', '2024-09-22 15:33:17', 35.26, 'card', 'O0024'),
('PR0024', 'U0015', '2024-09-22 15:37:49', 89.71, 'card', 'O0025'),
('PR0025', 'U0015', '2024-09-22 15:47:10', 14.19, 'card', 'O0026'),
('PR0026', 'U0015', '2024-09-22 16:33:28', 102.29, 'card', 'O0027');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--
INSERT INTO `product` (`product_id`, `name`, `price`, `category_id`, `quantity`, `description`, `weight`, `status`) VALUES
('P0001', 'Ballpoint Pen', 1.20, 'CT0001', 250, 'Smooth writing ballpoint pen', 0.02, 'available'),
('P0002', 'Gel Pen', 1.50, 'CT0001', 200, 'Quick-drying gel pen', 0.03, 'available'),
('P0003', 'Fountain Pen', 15.00, 'CT0001', 50, 'Elegant fountain pen for writing', 0.1, 'available'),
('P0004', 'Pencil', 0.50, 'CT0001', 300, 'Standard wooden pencil', 0.01, 'available'),
('P0005', 'Mechanical Pencil', 2.00, 'CT0001', 180, 'Precision mechanical pencil', 0.05, 'available'),
('P0006', 'Marker', 2.50, 'CT0001', 150, 'Broad tip permanent marker', 0.04, 'available'),
('P0007', 'Highlighter', 1.75, 'CT0001', 220, 'Fluorescent highlighter pen', 0.03, 'available'),
('P0008', 'Whiteboard Marker', 1.80, 'CT0001', 130, 'Dry erase marker for whiteboards', 0.04, 'available'),
('P0009', 'Colored Pencil', 1.20, 'CT0001', 200, 'Set of colored pencils', 0.05, 'available'),
('P0010', 'Brush Pen', 3.00, 'CT0001', 100, 'Flexible brush tip pen', 0.06, 'available'),
('P0011', 'Erasable Gel Pen', 2.20, 'CT0001', 170, 'Gel pen with eraser tip', 0.03, 'available'),
('P0012', 'Mechanical Eraser', 1.00, 'CT0001', 240, 'Precision eraser for detailed work', 0.02, 'available'),
('P0013', 'Calligraphy Pen', 5.50, 'CT0001', 60, 'Pen for beautiful lettering', 0.08, 'available'),
('P0014', 'Ink Refill', 3.50, 'CT0001', 90, 'Refill for fountain pens', 0.02, 'available'),
('P0015', 'Art Marker', 2.80, 'CT0001', 140, 'Vibrant colors for art projects', 0.04, 'available'),
('P0016', 'Fine Tip Marker', 1.90, 'CT0001', 130, 'Precision fine tip marker', 0.03, 'available'),
('P0017', 'Sketch Pen', 1.50, 'CT0001', 160, 'Versatile sketching pen', 0.04, 'available'),
('P0018', 'Chalk Marker', 2.40, 'CT0001', 110, 'Liquid chalk marker for writing', 0.05, 'available'),
('P0019', 'Highlighter Tape', 2.00, 'CT0001', 150, 'Highlighting tape for documents', 0.03, 'available'),
('P0020', 'Stabilo Pen', 3.20, 'CT0001', 80, 'Quality pen for writing', 0.06, 'available');

INSERT INTO `product` (`product_id`, `name`, `price`, `category_id`, `quantity`, `description`, `weight`, `status`) VALUES
('P0021', 'Notebook', 5.00, 'CT0002', 250, 'Lined notebook for writing', 0.2, 'available'),
('P0022', 'Sticky Notes', 3.00, 'CT0002', 300, 'Colorful sticky notes', 0.1, 'available'),
('P0023', 'Notepad', 2.50, 'CT0002', 200, 'Compact notepad for quick notes', 0.15, 'available'),
('P0024', 'Printer Paper', 6.00, 'CT0002', 150, 'A4 printer paper pack', 1.0, 'available'),
('P0025', 'Copy Paper', 4.50, 'CT0002', 180, 'High-quality copy paper', 0.8, 'available'),
('P0026', 'Diary', 10.00, 'CT0002', 120, 'Daily diary for personal notes', 0.25, 'available'),
('P0027', 'Loose Leaf Paper', 3.50, 'CT0002', 200, 'A4 loose leaf paper', 0.15, 'available'),
('P0028', 'Drawing Paper', 5.50, 'CT0002', 80, 'Heavyweight drawing paper', 0.3, 'available'),
('P0029', 'Graph Paper', 4.00, 'CT0002', 150, 'Graph paper for technical drawings', 0.15, 'available'),
('P0030', 'Colored Paper', 3.20, 'CT0002', 220, 'Assorted colored paper', 0.2, 'available'),
('P0031', 'Sketchbook', 8.00, 'CT0002', 90, 'High-quality sketchbook', 0.5, 'available'),
('P0032', 'Note Cards', 3.00, 'CT0002', 250, 'Blank note cards for messages', 0.1, 'available'),
('P0033', 'Legal Pad', 4.00, 'CT0002', 140, 'Legal pad for legal notes', 0.25, 'available'),
('P0034', 'Sticky Tabs', 2.50, 'CT0002', 200, 'Assorted sticky tabs for organization', 0.05, 'available'),
('P0035', 'Cardstock', 6.00, 'CT0002', 80, 'Heavyweight cardstock for projects', 0.3, 'available'),
('P0036', 'Art Paper', 7.00, 'CT0002', 70, 'Specialty paper for art projects', 0.25, 'available'),
('P0037', 'Notebook Binder', 4.50, 'CT0002', 150, 'Binder for notebooks', 0.2, 'available'),
('P0038', 'Foldable Paper', 3.50, 'CT0002', 200, 'Pre-cut foldable paper sheets', 0.1, 'available'),
('P0039', 'Envelope', 3.00, 'CT0002', 250, 'Standard envelopes for mailing', 0.02, 'available'),
('P0040', 'Postcard', 2.00, 'CT0002', 300, 'Blank postcards for messages', 0.05, 'available');

INSERT INTO `product` (`product_id`, `name`, `price`, `category_id`, `quantity`, `description`, `weight`, `status`) VALUES
('P0041', 'Plastic Folder', 2.50, 'CT0003', 200, 'Durable plastic folder', 0.1, 'available'),
('P0042', 'Document Envelope', 1.80, 'CT0003', 150, 'Clear plastic document envelope', 0.05, 'available'),
('P0043', 'Lever Arch File', 5.00, 'CT0003', 100, 'Heavy-duty lever arch file', 0.4, 'available'),
('P0044', 'Ring Binder', 3.00, 'CT0003', 120, '3-ring binder for documents', 0.3, 'available'),
('P0045', 'Suspension File', 4.50, 'CT0003', 80, 'Suspension file for organization', 0.35, 'available'),
('P0046', 'File Box', 10.00, 'CT0003', 60, 'Storage box for files', 0.8, 'available'),
('P0047', 'Document Wallet', 2.20, 'CT0003', 150, 'Wallet for documents', 0.1, 'available'),
('P0048', 'A4 Display Book', 6.00, 'CT0003', 90, 'Display book for A4 documents', 0.3, 'available'),
('P0049', 'Plastic Sleeves', 1.50, 'CT0003', 200, 'Protective sleeves for documents', 0.05, 'available'),
('P0050', 'Index Tabs', 2.00, 'CT0003', 250, 'Self-adhesive index tabs', 0.02, 'available'),
('P0051', 'Binder Clips', 1.20, 'CT0003', 300, 'Strong binder clips for documents', 0.03, 'available'),
('P0052', 'Paper Fasteners', 1.50, 'CT0003', 200, 'Metal fasteners for papers', 0.04, 'available'),
('P0053', 'Document Shredder', 50.00, 'CT0003', 30, 'Shredder for secure document disposal', 5.0, 'available'),
('P0054', 'File Labels', 2.50, 'CT0003', 180, 'Labels for organizing files', 0.02, 'available'),
('P0055', 'Plastic Expanding File', 4.00, 'CT0003', 100, 'Expandable file organizer', 0.3, 'available'),
('P0056', 'Paper Clips', 1.00, 'CT0003', 400, 'Standard paper clips', 0.01, 'available'),
('P0057', 'Stapler', 5.50, 'CT0003', 90, 'Standard stapler for documents', 0.5, 'available'),
('P0058', 'Index Card Box', 3.00, 'CT0003', 120, 'Box for index cards', 0.2, 'available'),
('P0059', 'File Holder', 3.50, 'CT0003', 140, 'Holder for documents', 0.25, 'available'),
('P0060', 'Tack Pins', 2.00, 'CT0003', 300, 'Tack pins for bulletin boards', 0.01, 'available');

INSERT INTO `product` (`product_id`, `name`, `price`, `category_id`, `quantity`, `description`, `weight`, `status`) VALUES
('P0061', 'Watercolor Paper', 8.00, 'CT0004', 70, 'Special paper for watercolor painting', 0.5, 'available'),
('P0062', 'Sketchbook', 10.00, 'CT0004', 60, 'Heavyweight sketchbook for drawing', 0.4, 'available'),
('P0063', 'Oil Paint Set', 15.00, 'CT0004', 50, 'Set of oil paints', 0.6, 'available'),
('P0064', 'Watercolor Paint Set', 12.00, 'CT0004', 50, 'Set of watercolor paints', 0.5, 'available'),
('P0065', 'Acrylic Paint Set', 14.00, 'CT0004', 50, 'Set of acrylic paints', 0.7, 'available'),
('P0066', 'Colored Pencils', 10.00, 'CT0004', 80, 'High-quality colored pencils', 0.3, 'available'),
('P0067', 'Crayons', 3.00, 'CT0004', 200, 'Box of crayons for children', 0.2, 'available'),
('P0068', 'Pastels', 7.00, 'CT0004', 90, 'Soft pastels for artists', 0.3, 'available'),
('P0069', 'Oil Pastels', 8.00, 'CT0004', 70, 'Oil pastels for drawing', 0.4, 'available'),
('P0070', 'Paint Brushes', 5.00, 'CT0004', 100, 'Set of paint brushes', 0.2, 'available'),
('P0071', 'Palette', 4.00, 'CT0004', 120, 'Artist palette for mixing colors', 0.1, 'available'),
('P0072', 'Canvas', 12.00, 'CT0004', 40, 'Stretched canvas for painting', 1.0, 'available'),
('P0073', 'Drawing Charcoal', 5.00, 'CT0004', 60, 'Charcoal sticks for drawing', 0.1, 'available'),
('P0074', 'Graphite Pencils', 4.00, 'CT0004', 80, 'Set of graphite pencils', 0.3, 'available'),
('P0075', 'Art Markers', 6.00, 'CT0004', 90, 'Vibrant markers for art', 0.2, 'available'),
('P0076', 'Easel', 25.00, 'CT0004', 30, 'Adjustable easel for artists', 3.0, 'available'),
('P0077', 'Watercolor Set', 10.00, 'CT0004', 50, 'Set of watercolor paints', 0.5, 'available'),
('P0078', 'Sculpting Clay', 8.00, 'CT0004', 70, 'Modeling clay for sculpting', 0.4, 'available'),
('P0079', 'Canvas Board', 6.00, 'CT0004', 80, 'Canvas board for painting', 0.5, 'available'),
('P0080', 'Masking Tape', 2.00, 'CT0004', 150, 'Tape for masking during painting', 0.03, 'available');

INSERT INTO `product` (`product_id`, `name`, `price`, `category_id`, `quantity`, `description`, `weight`, `status`) VALUES
('P0081', 'Paper Clips', 1.20, 'CT0005', 300, 'Standard paper clips', 0.02, 'available'),
('P0082', 'Stapler', 5.50, 'CT0005', 120, 'Heavy-duty stapler', 0.4, 'available'),
('P0083', 'Staples', 2.00, 'CT0005', 200, 'Standard staples for stapler', 0.1, 'available'),
('P0084', 'Binder Clips', 1.80, 'CT0005', 250, 'Assorted binder clips', 0.03, 'available'),
('P0085', 'Hole Punch', 4.00, 'CT0005', 80, '3-hole punch for documents', 0.5, 'available'),
('P0086', 'Glue Stick', 1.50, 'CT0005', 150, 'Permanent glue stick', 0.05, 'available'),
('P0087', 'Transparent Tape', 2.00, 'CT0005', 200, 'Clear adhesive tape', 0.05, 'available'),
('P0088', 'Double-Sided Tape', 2.50, 'CT0005', 150, 'Double-sided adhesive tape', 0.05, 'available'),
('P0089', 'Scissors', 3.00, 'CT0005', 100, 'Standard scissors for cutting', 0.2, 'available'),
('P0090', 'Packing Tape', 3.50, 'CT0005', 90, 'Heavy-duty packing tape', 0.3, 'available'),
('P0091', 'Sticky Notes', 3.00, 'CT0005', 220, 'Colorful sticky notes', 0.1, 'available'),
('P0092', 'Correction Fluid', 2.00, 'CT0005', 150, 'Fluid for correcting mistakes', 0.1, 'available'),
('P0093', 'Post-it Flags', 2.20, 'CT0005', 200, 'Flags for marking pages', 0.02, 'available'),
('P0094', 'Ruler', 1.00, 'CT0005', 300, 'Standard ruler for measuring', 0.05, 'available'),
('P0095', 'Binder', 4.50, 'CT0005', 100, 'Durable binder for documents', 0.3, 'available'),
('P0096', 'Index Cards', 2.50, 'CT0005', 250, 'Blank index cards for notes', 0.1, 'available'),
('P0097', 'White-Out Tape', 1.80, 'CT0005', 120, 'Tape for correcting mistakes', 0.03, 'available'),
('P0098', 'Clipboard', 3.00, 'CT0005', 150, 'Clipboard for holding papers', 0.2, 'available'),
('P0099', 'Label Maker', 15.00, 'CT0005', 30, 'Machine for creating labels', 1.0, 'available'),
('P0100', 'Index Dividers', 2.00, 'CT0005', 200, 'Dividers for organizing binders', 0.02, 'available');

INSERT INTO `product` (`product_id`, `name`, `price`, `category_id`, `quantity`, `description`, `weight`, `status`) VALUES
('P0101', 'Calculator', 10.00, 'CT0006', 80, 'Basic calculator for math', 0.5, 'available'),
('P0102', 'Book Cover', 2.50, 'CT0006', 200, 'Clear book cover for protection', 0.1, 'available'),
('P0103', 'Magnetic Bookmark', 1.00, 'CT0006', 300, 'Bookmarks that stick to pages', 0.02, 'available'),
('P0104', 'Highlighter', 2.00, 'CT0006', 150, 'Fluorescent highlighter pen', 0.03, 'available'),
('P0105', 'Flash Cards', 3.00, 'CT0006', 100, 'Cards for studying', 0.1, 'available'),
('P0106', 'Notebook', 5.00, 'CT0006', 150, 'Spiral notebook for notes', 0.3, 'available'),
('P0107', 'Whiteboard', 20.00, 'CT0006', 40, 'Whiteboard for writing', 2.0, 'available'),
('P0108', 'Eraser', 1.00, 'CT0006', 200, 'Standard eraser for pencil', 0.02, 'available'),
('P0109', 'Pencil Case', 4.00, 'CT0006', 100, 'Case for storing pencils', 0.1, 'available'),
('P0110', 'Sticky Flags', 1.50, 'CT0006', 150, 'Flags for marking pages', 0.02, 'available'),
('P0111', 'Binder Paper', 2.50, 'CT0006', 200, 'Loose-leaf binder paper', 0.03, 'available'),
('P0112', 'Study Planner', 5.00, 'CT0006', 80, 'Planner for organizing study schedule', 0.2, 'available'),
('P0113', 'Desk Organizer', 8.00, 'CT0006', 70, 'Organizer for study materials', 0.4, 'available'),
('P0114', 'Study Guide', 15.00, 'CT0006', 50, 'Guide for exam preparation', 0.5, 'available'),
('P0115', 'Note Cards', 2.00, 'CT0006', 250, 'Cards for taking notes', 0.02, 'available'),
('P0116', 'Graph Paper', 3.00, 'CT0006', 150, 'Paper with grid for drawing', 0.1, 'available'),
('P0117', 'Laptop Stand', 20.00, 'CT0006', 30, 'Stand for laptop use', 1.5, 'available'),
('P0118', 'Portable Charger', 25.00, 'CT0006', 20, 'Charger for mobile devices', 0.5, 'available'),
('P0119', 'Whiteboard Markers', 3.50, 'CT0006', 100, 'Markers for whiteboard', 0.02, 'available'),
('P0120', 'Study Lamp', 15.00, 'CT0006', 30, 'Lamp for studying', 0.6, 'available');

INSERT INTO `product` (`product_id`, `name`, `price`, `category_id`, `quantity`, `description`, `weight`, `status`) VALUES
('P0121', 'USB Flash Drive', 15.00, 'CT0007', 100, '16GB USB flash drive', 0.02, 'available'),
('P0122', 'Wireless Mouse', 25.00, 'CT0007', 80, 'Wireless optical mouse', 0.1, 'available'),
('P0123', 'Bluetooth Headphones', 50.00, 'CT0007', 50, 'Over-ear Bluetooth headphones', 0.3, 'available'),
('P0124', 'Laptop Sleeve', 20.00, 'CT0007', 70, 'Protective sleeve for laptops', 0.4, 'available'),
('P0125', 'HDMI Cable', 10.00, 'CT0007', 150, 'High-speed HDMI cable', 0.1, 'available'),
('P0126', 'Portable Charger', 30.00, 'CT0007', 60, 'Portable power bank', 0.3, 'available'),
('P0127', 'Webcam', 40.00, 'CT0007', 40, 'HD webcam for video calls', 0.2, 'available'),
('P0128', 'Wireless Keyboard', 35.00, 'CT0007', 50, 'Wireless keyboard', 0.5, 'available'),
('P0129', 'Smartphone Stand', 15.00, 'CT0007', 100, 'Adjustable stand for smartphones', 0.1, 'available'),
('P0130', 'Screen Cleaner', 5.00, 'CT0007', 200, 'Cleaner for screens', 0.05, 'available'),
('P0131', 'Mouse Pad', 8.00, 'CT0007', 150, 'Comfortable mouse pad', 0.2, 'available'),
('P0132', 'Laptop Stand', 20.00, 'CT0007', 70, 'Ergonomic laptop stand', 1.0, 'available'),
('P0133', 'Cable Organizer', 4.00, 'CT0007', 300, 'Organizer for cables', 0.1, 'available'),
('P0134', 'Gaming Headset', 60.00, 'CT0007', 30, 'Headset for gaming', 0.3, 'available'),
('P0135', 'Wi-Fi Router', 45.00, 'CT0007', 40, 'Dual-band Wi-Fi router', 0.5, 'available'),
('P0136', 'Power Adapter', 20.00, 'CT0007', 50, 'Power adapter for devices', 0.3, 'available'),
('P0137', 'External Hard Drive', 70.00, 'CT0007', 30, '1TB external hard drive', 0.8, 'available'),
('P0138', 'VR Headset', 150.00, 'CT0007', 20, 'Virtual reality headset', 0.5, 'available'),
('P0139', 'Smartwatch', 120.00, 'CT0007', 25, 'Smartwatch with fitness tracker', 0.2, 'available'),
('P0140', 'Ethernet Cable', 5.00, 'CT0007', 250, 'Cat6 Ethernet cable', 0.1, 'available');

INSERT INTO `product` (`product_id`, `name`, `price`, `category_id`, `quantity`, `description`, `weight`, `status`) VALUES
('P0141', 'Office Chair', 150.00, 'CT0008', 30, 'Ergonomic office chair', 10.0, 'available'),
('P0142', 'Desk', 200.00, 'CT0008', 25, 'Wooden office desk', 30.0, 'available'),
('P0143', 'Filing Cabinet', 120.00, 'CT0008', 15, 'Three-drawer filing cabinet', 20.0, 'available'),
('P0144', 'Bookshelf', 100.00, 'CT0008', 20, 'Wooden bookshelf', 25.0, 'available'),
('P0145', 'Coffee Table', 75.00, 'CT0008', 40, 'Stylish coffee table', 15.0, 'available'),
('P0146', 'Dining Table', 250.00, 'CT0008', 15, 'Wooden dining table', 50.0, 'available'),
('P0147', 'Lounge Chair', 85.00, 'CT0008', 30, 'Comfortable lounge chair', 10.0, 'available'),
('P0148', 'Side Table', 45.00, 'CT0008', 50, 'Small side table', 5.0, 'available'),
('P0149', 'Bookshelf Unit', 150.00, 'CT0008', 25, 'Five-tier bookshelf unit', 20.0, 'available'),
('P0150', 'Desk Lamp', 30.00, 'CT0008', 100, 'Adjustable desk lamp', 3.0, 'available'),
('P0151', 'Armchair', 120.00, 'CT0008', 20, 'Comfortable armchair', 15.0, 'available'),
('P0152', 'Ottoman', 40.00, 'CT0008', 50, 'Soft ottoman', 5.0, 'available'),
('P0153', 'TV Stand', 70.00, 'CT0008', 30, 'Stand for TV', 20.0, 'available'),
('P0154', 'Sofa', 400.00, 'CT0008', 10, '3-seater sofa', 50.0, 'available'),
('P0155', 'Storage Bench', 90.00, 'CT0008', 20, 'Bench with storage', 25.0, 'available'),
('P0156', 'Console Table', 60.00, 'CT0008', 40, 'Narrow console table', 10.0, 'available'),
('P0157', 'Hallway Rack', 50.00, 'CT0008', 30, 'Rack for hallway storage', 15.0, 'available'),
('P0158', 'Wardrobe', 300.00, 'CT0008', 15, 'Large wardrobe for clothes', 80.0, 'available'),
('P0159', 'Nightstand', 45.00, 'CT0008', 50, 'Small nightstand', 10.0, 'available'),
('P0160', 'Dresser', 150.00, 'CT0008', 20, 'Dresser with mirror', 40.0, 'available');


-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `image_id` varchar(6) NOT NULL,
  `product_id` varchar(6) NOT NULL,
  `product_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`image_id`, `product_id`, `product_photo`) VALUES
('I0001', 'P0031', '66ebe8a3f0a79.jpg'),
('I0002', 'P0031', '66ebe8a4002ae.jpg'),
('I0003', 'P0031', '66ebe9fec7d7c.jpg'),
('I0004', 'P0031', '66ebea18d0e72.jpg'),
('I0008', 'P0032', '66ebee56bc4c0.jpg'),
('I0012', 'P0032', '66ebef650788d.jpg'),
('I0013', 'P0030', '66ece49eecf43.jpg'),
('I0014', 'P0030', '66ece127be741.jpg'),
('I0015', 'P0030', '66ece127c2467.jpg'),
('I0016', 'P0031', '66ece8b801f2b.jpg'),
('I0017', 'P0031', '66ece8b81a25f.jpg'),
('I0018', 'P0031', '66ece8b84469d.jpg'),
('I0019', 'P0032', '66ece8dbd1a66.jpg'),
('I0020', 'P0032', '66ece8dbd8d54.jpg'),
('I0021', 'P0032', '66ece8dbe48fc.jpg'),
('I0022', 'P0033', '66ece90b24821.jpg'),
('I0023', 'P0033', '66ece90b2a089.jpg'),
('I0024', 'P0033', '66ece90b3391d.jpg'),
('I0025', 'P0034', '66ecea5a69c88.jpg'),
('I0026', 'P0034', '66ecea5a6f7f6.jpg'),
('I0027', 'P0034', '66ecea5a7b7f3.jpg'),
('I0028', 'P0035', '66eceaf5bf794.jpg'),
('I0029', 'P0035', '66eceaf5c4919.jpg'),
('I0030', 'P0035', '66eceaf5d0ace.jpg'),
('I0031', 'P0036', '66eceb66287fc.jpg'),
('I0032', 'P0036', '66eceb662cd9b.jpg'),
('I0033', 'P0036', '66eceb6637c40.jpg'),
('I0034', 'P0036', '66eceb6643ac3.jpg'),
('I0035', 'P0030', '66ede590a4d3b.jpg'),
('I0036', 'P0030', '66ede590afe32.jpg'),
('I0037', 'P0030', '66ede590bc020.jpg'),
('I0038', 'P0030', '66ede590c8507.jpg'),
('I0039', 'P0031', '66ede5bed758f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shippers`
--

CREATE TABLE `shippers` (
  `ship_id` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `ship_method` varchar(50) NOT NULL,
  `status` enum('Pending','Cancelled','Delivered','Shipped','Arrive') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shippers`
--

INSERT INTO `shippers` (`ship_id`, `address`, `company_name`, `phone`, `ship_method`, `status`) VALUES
('S0001', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Penang', 'NINJA VAN', 'ewe', 'pick', 'Pending'),
('S0002', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Penang', 'POS LAJU', 'ewe', 'pick', 'Pending'),
('S0003', 'Jalan 5/5, Section 5, Section 6, Petaling Jaya, Petaling, Selangor, 46990, Malaysia Penang', 'POS LAJU', 'ewe', 'pick', 'Pending'),
('S0004', 'Jalan Pantai Permai Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'ewf', 'pick', 'Pending'),
('S0005', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'ewf', 'pick', 'Pending'),
('S0006', 'chi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Putrajaya', 'NINJA VAN', 'ewf', 'pick', 'Pending'),
('S0007', 'Jalan Penchala, Putrajaya', 'POS LAJU', 'ewf', 'pick', 'Arrive'),
('S0008', '12, Jalan 10/12, Section 10, Petaling Jaya, Petaling, Selangor, 46661, Malaysia Kelantan', 'POS LAJU', 'ewf', 'pick', 'Pending'),
('S0009', '9, Jalan 10/4, Section 10, Petaling Jaya, Petaling, Selangor, 46661, Malaysia Putrajaya', 'J&T', 'ewf', 'pick', 'Pending'),
('S0010', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending'),
('S0011', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending'),
('S0012', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending'),
('S0013', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending'),
('S0014', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending'),
('S0015', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending'),
('S0016', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending'),
('S0017', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending'),
('S0018', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'd', 'pick', 'Pending'),
('S0019', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'd', 'pick', 'Pending'),
('S0020', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'wdwd', 'pick', 'Pending'),
('S0021', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'wdwd', 'pick', 'Pending'),
('S0022', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'wdwd', 'pick', 'Pending'),
('S0023', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'wdwd', 'pick', 'Pending'),
('S0024', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'wdwd', 'pick', 'Pending'),
('S0025', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'wdwd', 'pick', 'Pending'),
('S0026', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Selangor', 'NINJA VAN', 'wed', 'pick', 'Arrive'),
('S0027', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Terengganu', 'NINJA VAN', 'ewf', 'pick', 'Arrive'),
('S0028', 'Jalan Metro Prima, Kepong Bahru, Kepong, Kuala Lumpur, 52100, Malaysia Selangor', 'NINJA VAN', 'sdf', 'pick', 'Arrive'),
('S0029', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'sdf', 'pick', 'Arrive'),
('S0030', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Terengganu', 'NINJA VAN', 'sdf', 'pick', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `verification_code` char(6) NOT NULL,
  `expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `email`, `verification_code`, `expire`) VALUES
(1, 'howjj-wm22@student.tarc.edu.my', '392542', '2024-09-22 22:10:54'),
(2, 'test@gmail.com', '734850', '2024-09-22 22:13:25'),
(3, 'howjj-wm22@student.tarc.edu.my', '194658', '2024-09-22 22:32:03'),
(4, 'jjoscar91165@gmail.com', '155970', '2024-09-22 22:32:16'),
(5, 'howjj-wm22@student.tarc.edu.my', '571974', '2024-09-22 22:36:44'),
(6, 'howjj-wm22@student.tarc.edu.my', '736476', '2024-09-22 22:37:48'),
(7, 'howjj-wm22@student.tarc.edu.my', '307891', '2024-09-22 22:38:01'),
(8, 'howjj-wm22@student.tarc.edu.my', '854664', '2024-09-22 22:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

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
  `contact_num` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `gender`, `birthday`, `photo`, `role`, `status`, `failed_attempts`, `last_failed_attempt`, `banned_until`, `last_login_time`, `login_count`, `last_login_event_time`, `deactivated_at`, `remember_token`, `remember_token_expiry`, `contact_num`) VALUES
('U0001', 'Root', '1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2004-02-03', '66e16e9f590ec.jpg', 'Root', 'Active', 0, '2024-09-22 20:58:51', NULL, '2024-09-22 22:39:49', 1, '2024-09-22 22:39:49', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-3316902'),
('U0002', 'William Jones', 'william.j@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1997-09-30', '66e164f231f73.jpg', 'Member', 'Banned', 0, '2024-09-06 13:20:11', '0000-00-00 00:00:00', '2024-09-07 14:45:09', 1, '2024-09-07 14:45:09', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-0123123'),
('U0003', 'Ava Garcia', 'ava.g@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2000-01-21', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-08 16:24:47', '0000-00-00 00:00:00', '2024-09-10 11:02:54', 1, '2024-09-10 11:02:54', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-5828912'),
('U0004', 'James Martinez', 'james.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1994-08-17', '66e164f231f73.jpg', 'Member', 'Banned', 0, '2024-09-14 08:22:13', '0000-00-00 00:00:00', '2024-09-15 17:00:10', 1, '2024-09-15 17:00:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-6828912'),
('U0005', 'Sophia Anderson', 'sophia.a@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-06-13', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-13 17:55:22', '0000-00-00 00:00:00', '2024-09-14 12:45:10', 1, '2024-09-14 12:45:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-7828912'),
('U0006', 'Lucas White', 'lucas.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1998-05-12', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-10 18:33:27', '0000-00-00 00:00:00', '2024-09-12 16:20:50', 1, '2024-09-12 16:20:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-8828912'),
('U0007', 'Mia Clark', 'mia.c@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1996-04-28', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-07 21:10:11', '0000-00-00 00:00:00', '2024-09-09 10:15:35', 1, '2024-09-09 10:15:35', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-9828912'),
('U0008', 'Benjamin Lewis', 'benjamin.l@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1993-10-01', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-11 17:44:30', '0000-00-00 00:00:00', '2024-09-18 17:11:12', 1, '2024-09-18 17:11:12', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-1128912'),
('U0009', 'Ella Rodriguez', 'ella.r@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2001-12-12', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-09 13:00:20', NULL, '2024-09-22 09:09:50', 1, '2024-09-22 09:09:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912'),
('U0010', 'Henry Walker', 'henry.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1995-11-27', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-11 14:45:13', NULL, '2024-09-22 00:15:02', 1, '2024-09-22 00:15:02', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912'),
('U0011', 'Amelia Young', 'amelia.y@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-08-14', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-12 20:02:16', '0000-00-00 00:00:00', '2024-09-15 17:55:32', 1, '2024-09-15 17:55:32', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912'),
('U0012', 'Admin', '2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e164f231f73.jpg', 'Admin', 'Active', 0, '2024-09-18 12:09:10', NULL, '2024-09-20 17:18:58', 1, '2024-09-20 17:18:58', '2024-09-10 12:11:54', '', '0000-00-00 00:00:00', ''),
('U0013', 'Ethan Harris', 'ethan.h@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1994-07-07', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-07 16:33:10', '0000-00-00 00:00:00', '2024-09-08 17:21:50', 1, '2024-09-08 17:21:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912'),
('U0014', 'Harper Green', 'harper.g@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1999-12-05', '66e164f231f73.jpg', 'Member', 'Banned', 0, '2024-09-06 10:12:00', '0000-00-00 00:00:00', '2024-09-07 09:11:20', 1, '2024-09-07 09:11:20', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912'),
('U0015', 'Alexander Lee', 'alexander.l@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2000-03-08', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-13 11:00:15', NULL, '2024-09-22 13:15:19', 1, '2024-09-22 13:15:19', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912'),
('U0016', 'Isabella Scott', 'isabella.s@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1996-10-23', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-11 12:15:11', NULL, '2024-09-22 08:04:34', 1, '2024-09-22 08:04:34', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912'),
('U0017', 'Daniel Carter', 'daniel.c@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-02-18', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-12 09:40:23', NULL, '2024-09-22 20:03:08', 1, '2024-09-22 20:03:08', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912'),
('U0018', 'Emily King', 'emily.k@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2001-11-20', '66e164f231f73.jpg', 'Member', 'Active', 0, '2024-09-10 08:33:18', '0000-00-00 00:00:00', '2024-09-12 10:00:22', 1, '2024-09-12 10:00:22', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912'),
('U0019', 'Emily Johnson', '3@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1992-12-05', '66dfc553b0989.jpg', 'Admin', 'Active', 0, '2024-09-18 12:06:06', '0000-00-00 00:00:00', '2024-09-18 12:07:53', 1, '2024-09-18 12:07:53', '2024-09-07 17:05:09', '', '0000-00-00 00:00:00', ''),
('U0020', 'Micky Way', '4@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1991-10-16', '66e017b2e5a89.jpg', 'Admin', 'Active', 0, '2024-09-10 12:44:20', '0000-00-00 00:00:00', '2024-09-11 16:02:55', 1, '2024-09-11 16:02:55', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
('U0021', 'Sophia Davis', '5@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-09-10', '66e92306b357a.jpg', 'Member', 'Banned', 0, '2024-09-10 12:43:33', '0000-00-00 00:00:00', '2024-09-10 12:46:10', 1, '2024-09-10 12:46:10', '2024-09-18 11:59:48', '', '0000-00-00 00:00:00', '012-2828912'),
('U0022', 'Liam Brown', 'liam.b@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1993-05-18', '66e82a2818964.jpg', 'Member', 'Banned', 0, '2024-09-07 14:20:10', '0000-00-00 00:00:00', '2024-09-10 10:01:23', 1, '2024-09-10 10:01:23', '2024-09-18 11:57:41', '', '0000-00-00 00:00:00', '012-2828912'),
('U0023', 'Olivia Miller', 'olivia.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-07-25', '66e82a2fd5a52.jpg', 'Member', 'Active', 0, '2024-09-12 11:15:49', NULL, '2024-09-22 22:22:37', 1, '2024-09-22 22:22:37', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912'),
('U0024', 'Noah Smith', 'noah.s@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1996-11-02', '66e82a372cc9f.jpg', 'Member', 'Banned', 0, '2024-09-08 09:30:17', '0000-00-00 00:00:00', '2024-09-09 12:45:02', 1, '2024-09-09 12:45:02', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912'),
('U0025', 'Emma Wilson', 'emma.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1999-03-15', '66ddc8a6f2098.jpg', 'Member', 'Active', 0, '2024-09-13 15:21:55', '0000-00-00 00:00:00', '2024-09-15 16:34:22', 1, '2024-09-15 16:34:22', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ship_id` (`ship_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payment_record`
--
ALTER TABLE `payment_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `shippers`
--
ALTER TABLE `shippers`
  ADD PRIMARY KEY (`ship_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`verification_code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ship_id`) REFERENCES `shippers` (`ship_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `payment_record`
--
ALTER TABLE `payment_record`
  ADD CONSTRAINT `payment_record_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
