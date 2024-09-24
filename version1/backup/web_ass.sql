-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2024 at 05:49 PM
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
('A0002', 'U0002', '25 Jalan Sari', 'Petaling Jaya', 'Selangor', '46000', 'Malaysia'),
('A0003', 'U0003', '8 Jalan PJU 1/4', 'Petaling Jaya', 'Selangor', '47301', 'Malaysia'),
('A0004', 'U0004', '21 Jalan Semarak', 'Kuala Lumpur', 'Wilayah Persekutuan', '50460', 'Malaysia'),
('A0005', 'U0005', '10 Jalan Kebun Nenas', 'Klang', 'Selangor', '41200', 'Malaysia'),
('A0006', 'U0006', '5 Jalan Pantai Dalam', 'Kuala Lumpur', 'Wilayah Persekutuan', '59200', 'Malaysia'),
('A0007', 'U0007', '12 Jalan Alor', 'Kuala Lumpur', 'Wilayah Persekutuan', '50200', 'Malaysia'),
('A0008', 'U0008', '30 Jalan Wangsa Delima', 'Kuala Lumpur', 'Wilayah Persekutuan', '53300', 'Malaysia'),
('A0009', 'U0009', '40 Jalan Gombak', 'Kuala Lumpur', 'Wilayah Persekutuan', '53000', 'Malaysia'),
('A0010', 'U0010', '15 Jalan Maktab', 'Kota Bharu', 'Kelantan', '15000', 'Malaysia'),
('A0011', 'U0011', '3 Jalan Medan Tuanku', 'Kuala Lumpur', 'Wilayah Persekutuan', '50300', 'Malaysia'),
('A0012', 'U0012', '27 Jalan 3/62A', 'Batu Caves', 'Selangor', '68100', 'Malaysia'),
('A0013', 'U0013', '19 Jalan Kampung Pandan', 'Kuala Lumpur', 'Wilayah Persekutuan', '55100', 'Malaysia'),
('A0014', 'U0014', '24 Jalan Titiwangsa', 'Kuala Lumpur', 'Wilayah Persekutuan', '54000', 'Malaysia'),
('A0015', 'U0015', '6 Jalan Kiara', 'Mont Kiara', 'Kuala Lumpur', '50480', 'Malaysia'),
('A0016', 'U0016', '17 Jalan Bukit Bintang', 'Kuala Lumpur', 'Wilayah Persekutuan', '55100', 'Malaysia'),
('A0017', 'U0017', '22 Jalan Setia', 'Shah Alam', 'Selangor', '40170', 'Malaysia'),
('A0018', 'U0018', '14 Jalan Damansara', 'Petaling Jaya', 'Selangor', '46000', 'Malaysia'),
('A0019', 'U0019', '9 Jalan Bunga Raya', 'Melaka', 'Melaka', '75100', 'Malaysia'),
('A0020', 'U0020', '11 Jalan Pahlawan', 'Kota Kinabalu', 'Sabah', '88000', 'Malaysia'),
('A0021', 'U0021', '33 Jalan Sultan Ahmad', 'Kuantan', 'Pahang', '25000', 'Malaysia'),
('A0022', 'U0022', '50 Jalan Dato Abdullah', 'Kuala Terengganu', 'Terengganu', '20000', 'Malaysia'),
('A0023', 'U0023', '4 Jalan Limau', 'Ipoh', 'Perak', '31400', 'Malaysia'),
('A0024', 'U0024', '7 Jalan Meru', 'Ipoh', 'Perak', '30020', 'Malaysia'),
('A0025', 'U0025', '29 Jalan Sejahtera', 'Seremban', 'Negeri Sembilan', '70000', 'Malaysia'),
('A0026', 'U0026', '25 Jalan Kampung Melayu', 'Gombak', 'Selangor', '68100', 'Malaysia');

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
('CT0001', 'Writing Instruments', 'Available'),
('CT0002', 'Paper Products', 'Available'),
('CT0003', 'File Management', 'Available'),
('CT0004', 'Art Supplies', 'Available'),
('CT0005', 'Office Supplies', 'Available'),
('CT0006', 'Study Aids', 'Available'),
('CT0007', 'Decorative Items and Stickers', 'Available'),
('CT0008', 'Correction Tools', 'Available');

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
  `photo` varchar(255) NOT NULL,
  `reply` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` varchar(11) NOT NULL,
  `product_id` varchar(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('P0001', 'Ballpoint Pen', 1.20, 'CT0001', 250, 'Smooth writing ballpoint pen', 0.02, 'Available'),
('P0002', 'Gel Pen', 1.50, 'CT0001', 200, 'Quick-drying gel pen', 0.03, 'Available'),
('P0003', 'Fountain Pen', 15.00, 'CT0001', 50, 'Elegant fountain pen for writing', 0.10, 'Available'),
('P0004', 'Pencil', 0.50, 'CT0001', 300, 'Standard wooden pencil', 0.01, 'Available'),
('P0005', 'Mechanical Pencil', 2.00, 'CT0001', 180, 'Precision mechanical pencil', 0.05, 'Available'),
('P0006', 'Marker', 2.50, 'CT0001', 150, 'Broad tip permanent marker', 0.04, 'Available'),
('P0007', 'Highlighter', 1.75, 'CT0001', 220, 'Fluorescent highlighter pen', 0.03, 'Available'),
('P0008', 'Whiteboard Marker', 1.80, 'CT0001', 130, 'Dry erase marker for whiteboards', 0.04, 'Available'),
('P0009', 'Colored Pencil', 1.20, 'CT0001', 200, 'Set of colored pencils', 0.05, 'Available'),
('P0010', 'Brush Pen', 3.00, 'CT0001', 100, 'Flexible brush tip pen', 0.06, 'Available'),
('P0011', 'Erasable Gel Pen', 2.20, 'CT0001', 170, 'Gel pen with eraser tip', 0.03, 'Available'),
('P0012', 'Mechanical Eraser', 1.00, 'CT0001', 240, 'Precision eraser for detailed work', 0.02, 'Available'),
('P0013', 'Calligraphy Pen', 5.50, 'CT0001', 60, 'Pen for beautiful lettering', 0.08, 'Available'),
('P0014', 'Ink Refill', 3.50, 'CT0001', 90, 'Refill for fountain pens', 0.02, 'Available'),
('P0015', 'Art Marker', 2.80, 'CT0001', 140, 'Vibrant colors for art projects', 0.04, 'Available'),
('P0016', 'Fine Tip Marker', 1.90, 'CT0001', 130, 'Precision fine tip marker', 0.03, 'Available'),
('P0017', 'Sketch Pen', 1.50, 'CT0001', 160, 'Versatile sketching pen', 0.04, 'Available'),
('P0018', 'Chalk Marker', 2.40, 'CT0001', 110, 'Liquid chalk marker for writing', 0.05, 'Available'),
('P0019', 'Highlighter Tape', 2.00, 'CT0001', 150, 'Highlighting tape for documents', 0.03, 'Available'),
('P0020', 'Stabilo Pen', 3.20, 'CT0001', 80, 'Quality pen for writing', 0.06, 'Available'),
('P0021', 'Notebook', 5.00, 'CT0002', 250, 'Lined notebook for writing', 0.20, 'Available'),
('P0022', 'Sticky Notes', 3.00, 'CT0002', 300, 'Colorful sticky notes', 0.10, 'Available'),
('P0023', 'Notepad', 2.50, 'CT0002', 200, 'Compact notepad for quick notes', 0.15, 'Available'),
('P0024', 'Printer Paper', 6.00, 'CT0002', 150, 'A4 printer paper pack', 1.00, 'Available'),
('P0025', 'Copy Paper', 4.50, 'CT0002', 180, 'High-quality copy paper', 0.80, 'Available'),
('P0026', 'Diary', 10.00, 'CT0002', 120, 'Daily diary for personal notes', 0.25, 'Available'),
('P0027', 'Loose Leaf Paper', 3.50, 'CT0002', 200, 'A4 loose leaf paper', 0.15, 'Available'),
('P0028', 'Drawing Paper', 5.50, 'CT0002', 80, 'Heavyweight drawing paper', 0.30, 'Available'),
('P0029', 'Graph Paper', 4.00, 'CT0002', 150, 'Graph paper for technical drawings', 0.15, 'Available'),
('P0030', 'Colored Paper', 3.20, 'CT0002', 220, 'Assorted colored paper', 0.20, 'Available'),
('P0031', 'Sketchbook', 8.00, 'CT0002', 90, 'High-quality sketchbook', 0.50, 'Available'),
('P0032', 'Note Cards', 3.00, 'CT0002', 250, 'Blank note cards for messages', 0.10, 'Available'),
('P0033', 'Legal Pad', 4.00, 'CT0002', 140, 'Legal pad for legal notes', 0.25, 'Available'),
('P0034', 'Sticky Tabs', 2.50, 'CT0002', 200, 'Assorted sticky tabs for organization', 0.05, 'Available'),
('P0035', 'Cardstock', 6.00, 'CT0002', 80, 'Heavyweight cardstock for projects', 0.30, 'Available'),
('P0036', 'Art Paper', 7.00, 'CT0002', 70, 'Specialty paper for art projects', 0.25, 'Available'),
('P0037', 'Notebook Binder', 4.50, 'CT0002', 150, 'Binder for notebooks', 0.20, 'Available'),
('P0038', 'Foldable Paper', 3.50, 'CT0002', 200, 'Pre-cut foldable paper sheets', 0.10, 'Available'),
('P0039', 'Envelope', 3.00, 'CT0002', 250, 'Standard envelopes for mailing', 0.02, 'Available'),
('P0040', 'Postcard', 2.00, 'CT0002', 300, 'Blank postcards for messages', 0.05, 'Available'),
('P0041', 'Plastic Folder', 2.50, 'CT0003', 200, 'Durable plastic folder', 0.10, 'Available'),
('P0042', 'Document Envelope', 1.80, 'CT0003', 150, 'Clear plastic document envelope', 0.05, 'Available'),
('P0043', 'Lever Arch File', 5.00, 'CT0003', 100, 'Heavy-duty lever arch file', 0.40, 'Available'),
('P0044', 'Ring Binder', 3.00, 'CT0003', 120, '3-ring binder for documents', 0.30, 'Available'),
('P0045', 'Suspension File', 4.50, 'CT0003', 80, 'Suspension file for organization', 0.35, 'Available'),
('P0046', 'File Box', 10.00, 'CT0003', 60, 'Storage box for files', 0.80, 'Available'),
('P0047', 'Document Wallet', 2.20, 'CT0003', 150, 'Wallet for documents', 0.10, 'Available'),
('P0048', 'A4 Display Book', 6.00, 'CT0003', 90, 'Display book for A4 documents', 0.30, 'Available'),
('P0049', 'Plastic Sleeves', 1.50, 'CT0003', 200, 'Protective sleeves for documents', 0.05, 'Available'),
('P0050', 'Index Tabs', 2.00, 'CT0003', 250, 'Self-adhesive index tabs', 0.02, 'Available'),
('P0051', 'Binder Clips', 1.20, 'CT0003', 300, 'Strong binder clips for documents', 0.03, 'Available'),
('P0052', 'Paper Fasteners', 1.50, 'CT0003', 200, 'Metal fasteners for papers', 0.04, 'Available'),
('P0053', 'Document Shredder', 50.00, 'CT0003', 30, 'Shredder for secure document disposal', 5.00, 'Available'),
('P0054', 'File Labels', 2.50, 'CT0003', 180, 'Labels for organizing files', 0.02, 'Available'),
('P0055', 'Plastic Expanding File', 4.00, 'CT0003', 100, 'Expandable file organizer', 0.30, 'Available'),
('P0056', 'Paper Clips', 1.00, 'CT0003', 400, 'Standard paper clips', 0.01, 'Available'),
('P0057', 'Stapler', 5.50, 'CT0003', 90, 'Standard stapler for documents', 0.50, 'Available'),
('P0058', 'Index Card Box', 3.00, 'CT0003', 120, 'Box for index cards', 0.20, 'Available'),
('P0059', 'File Holder', 3.50, 'CT0003', 140, 'Holder for documents', 0.25, 'Available'),
('P0060', 'Tack Pins', 2.00, 'CT0003', 300, 'Tack pins for bulletin boards', 0.01, 'Available'),
('P0061', 'Watercolor Paper', 8.00, 'CT0004', 70, 'Special paper for watercolor painting', 0.50, 'Available'),
('P0062', 'Sketchbook', 10.00, 'CT0004', 60, 'Heavyweight sketchbook for drawing', 0.40, 'Available'),
('P0063', 'Oil Paint Set', 15.00, 'CT0004', 50, 'Set of oil paints', 0.60, 'Available'),
('P0064', 'Watercolor Paint Set', 12.00, 'CT0004', 50, 'Set of watercolor paints', 0.50, 'Available'),
('P0065', 'Acrylic Paint Set', 14.00, 'CT0004', 50, 'Set of acrylic paints', 0.70, 'Available'),
('P0066', 'Colored Pencils', 10.00, 'CT0004', 80, 'High-quality colored pencils', 0.30, 'Available'),
('P0067', 'Crayons', 3.00, 'CT0004', 200, 'Box of crayons for children', 0.20, 'Available'),
('P0068', 'Pastels', 7.00, 'CT0004', 90, 'Soft pastels for artists', 0.30, 'Available'),
('P0069', 'Oil Pastels', 8.00, 'CT0004', 70, 'Oil pastels for drawing', 0.40, 'Available'),
('P0070', 'Paint Brushes', 5.00, 'CT0004', 100, 'Set of paint brushes', 0.20, 'Available'),
('P0071', 'Palette', 4.00, 'CT0004', 120, 'Artist palette for mixing colors', 0.10, 'Available'),
('P0072', 'Canvas', 12.00, 'CT0004', 40, 'Stretched canvas for painting', 1.00, 'Available'),
('P0073', 'Drawing Charcoal', 5.00, 'CT0004', 60, 'Charcoal sticks for drawing', 0.10, 'Available'),
('P0074', 'Graphite Pencils', 4.00, 'CT0004', 80, 'Set of graphite pencils', 0.30, 'Available'),
('P0075', 'Art Markers', 6.00, 'CT0004', 90, 'Vibrant markers for art', 0.20, 'Available'),
('P0076', 'Easel', 25.00, 'CT0004', 30, 'Adjustable easel for artists', 3.00, 'Available'),
('P0077', 'Watercolor Set', 10.00, 'CT0004', 50, 'Set of watercolor paints', 0.50, 'Available'),
('P0078', 'Sculpting Clay', 8.00, 'CT0004', 70, 'Modeling clay for sculpting', 0.40, 'Available'),
('P0079', 'Canvas Board', 6.00, 'CT0004', 80, 'Canvas board for painting', 0.50, 'Available'),
('P0080', 'Masking Tape', 2.00, 'CT0004', 150, 'Tape for masking during painting', 0.03, 'Available'),
('P0081', 'Paper Clips', 1.20, 'CT0005', 300, 'Standard paper clips', 0.02, 'Available'),
('P0082', 'Stapler', 5.50, 'CT0005', 120, 'Heavy-duty stapler', 0.40, 'Available'),
('P0083', 'Staples', 2.00, 'CT0005', 200, 'Standard staples for stapler', 0.10, 'Available'),
('P0084', 'Binder Clips', 1.80, 'CT0005', 250, 'Assorted binder clips', 0.03, 'Available'),
('P0085', 'Hole Punch', 4.00, 'CT0005', 80, '3-hole punch for documents', 0.50, 'Available'),
('P0086', 'Glue Stick', 1.50, 'CT0005', 150, 'Permanent glue stick', 0.05, 'Available'),
('P0087', 'Transparent Tape', 2.00, 'CT0005', 200, 'Clear adhesive tape', 0.05, 'Available'),
('P0088', 'Double-Sided Tape', 2.50, 'CT0005', 150, 'Double-sided adhesive tape', 0.05, 'Available'),
('P0089', 'Scissors', 3.00, 'CT0005', 100, 'Standard scissors for cutting', 0.20, 'Available'),
('P0090', 'Packing Tape', 3.50, 'CT0005', 90, 'Heavy-duty packing tape', 0.30, 'Available'),
('P0091', 'Sticky Notes', 3.00, 'CT0005', 220, 'Colorful sticky notes', 0.10, 'Available'),
('P0092', 'Correction Fluid', 2.00, 'CT0005', 150, 'Fluid for correcting mistakes', 0.10, 'Available'),
('P0093', 'Post-it Flags', 2.20, 'CT0005', 200, 'Flags for marking pages', 0.02, 'Available'),
('P0094', 'Ruler', 1.00, 'CT0005', 300, 'Standard ruler for measuring', 0.05, 'Available'),
('P0095', 'Binder', 4.50, 'CT0005', 100, 'Durable binder for documents', 0.30, 'Available'),
('P0096', 'Index Cards', 2.50, 'CT0005', 250, 'Blank index cards for notes', 0.10, 'Available'),
('P0097', 'White-Out Tape', 1.80, 'CT0005', 120, 'Tape for correcting mistakes', 0.03, 'Available'),
('P0098', 'Clipboard', 3.00, 'CT0005', 150, 'Clipboard for holding papers', 0.20, 'Available'),
('P0099', 'Label Maker', 15.00, 'CT0005', 30, 'Machine for creating labels', 1.00, 'Available'),
('P0100', 'Index Dividers', 2.00, 'CT0005', 200, 'Dividers for organizing binders', 0.02, 'Available'),
('P0101', 'Calculator', 10.00, 'CT0006', 80, 'Basic calculator for math', 0.50, 'Available'),
('P0102', 'Book Cover', 2.50, 'CT0006', 200, 'Clear book cover for protection', 0.10, 'Available'),
('P0103', 'Magnetic Bookmark', 1.00, 'CT0006', 300, 'Bookmarks that stick to pages', 0.02, 'Available'),
('P0104', 'Highlighter', 2.00, 'CT0006', 150, 'Fluorescent highlighter pen', 0.03, 'Available'),
('P0105', 'Flash Cards', 3.00, 'CT0006', 100, 'Cards for studying', 0.10, 'Available'),
('P0106', 'Notebook', 5.00, 'CT0006', 150, 'Spiral notebook for notes', 0.30, 'Available'),
('P0107', 'Whiteboard', 20.00, 'CT0006', 40, 'Whiteboard for writing', 2.00, 'Available'),
('P0108', 'Eraser', 1.00, 'CT0006', 200, 'Standard eraser for pencil', 0.02, 'Available'),
('P0109', 'Pencil Case', 4.00, 'CT0006', 100, 'Case for storing pencils', 0.10, 'Available'),
('P0110', 'Sticky Flags', 1.50, 'CT0006', 150, 'Flags for marking pages', 0.02, 'Available'),
('P0111', 'Binder Paper', 2.50, 'CT0006', 200, 'Loose-leaf binder paper', 0.03, 'Available'),
('P0112', 'Study Planner', 5.00, 'CT0006', 80, 'Planner for organizing study schedule', 0.20, 'Available'),
('P0113', 'Desk Organizer', 8.00, 'CT0006', 70, 'Organizer for study materials', 0.40, 'Available'),
('P0114', 'Study Guide', 15.00, 'CT0006', 50, 'Guide for exam preparation', 0.50, 'Available'),
('P0115', 'Note Cards', 2.00, 'CT0006', 250, 'Cards for taking notes', 0.02, 'Available'),
('P0116', 'Graph Paper', 3.00, 'CT0006', 150, 'Paper with grid for drawing', 0.10, 'Available'),
('P0117', 'Laptop Stand', 20.00, 'CT0006', 30, 'Stand for laptop use', 1.50, 'Available'),
('P0118', 'Portable Charger', 25.00, 'CT0006', 20, 'Charger for mobile devices', 0.50, 'Available'),
('P0119', 'Whiteboard Markers', 3.50, 'CT0006', 100, 'Markers for whiteboard', 0.02, 'Available'),
('P0120', 'Study Lamp', 15.00, 'CT0006', 30, 'Lamp for studying', 0.60, 'Available'),
('P0121', 'USB Flash Drive', 15.00, 'CT0007', 100, '16GB USB flash drive', 0.02, 'Available'),
('P0122', 'Wireless Mouse', 25.00, 'CT0007', 80, 'Wireless optical mouse', 0.10, 'Available'),
('P0123', 'Bluetooth Headphones', 50.00, 'CT0007', 50, 'Over-ear Bluetooth headphones', 0.30, 'Available'),
('P0124', 'Laptop Sleeve', 20.00, 'CT0007', 70, 'Protective sleeve for laptops', 0.40, 'Available'),
('P0125', 'HDMI Cable', 10.00, 'CT0007', 150, 'High-speed HDMI cable', 0.10, 'Available'),
('P0126', 'Portable Charger', 30.00, 'CT0007', 60, 'Portable power bank', 0.30, 'Available'),
('P0127', 'Webcam', 40.00, 'CT0007', 40, 'HD webcam for video calls', 0.20, 'Available'),
('P0128', 'Wireless Keyboard', 35.00, 'CT0007', 50, 'Wireless keyboard', 0.50, 'Available'),
('P0129', 'Smartphone Stand', 15.00, 'CT0007', 100, 'Adjustable stand for smartphones', 0.10, 'Available'),
('P0130', 'Screen Cleaner', 5.00, 'CT0007', 200, 'Cleaner for screens', 0.05, 'Available'),
('P0131', 'Mouse Pad', 8.00, 'CT0007', 150, 'Comfortable mouse pad', 0.20, 'Available'),
('P0132', 'Laptop Stand', 20.00, 'CT0007', 70, 'Ergonomic laptop stand', 1.00, 'Available'),
('P0133', 'Cable Organizer', 4.00, 'CT0007', 300, 'Organizer for cables', 0.10, 'Available'),
('P0134', 'Gaming Headset', 60.00, 'CT0007', 30, 'Headset for gaming', 0.30, 'Available'),
('P0135', 'Wi-Fi Router', 45.00, 'CT0007', 40, 'Dual-band Wi-Fi router', 0.50, 'Available'),
('P0136', 'Power Adapter', 20.00, 'CT0007', 50, 'Power adapter for devices', 0.30, 'Available'),
('P0137', 'External Hard Drive', 70.00, 'CT0007', 30, '1TB external hard drive', 0.80, 'Available'),
('P0138', 'VR Headset', 150.00, 'CT0007', 20, 'Virtual reality headset', 0.50, 'Available'),
('P0139', 'Smartwatch', 120.00, 'CT0007', 25, 'Smartwatch with fitness tracker', 0.20, 'Available'),
('P0140', 'Ethernet Cable', 5.00, 'CT0007', 250, 'Cat6 Ethernet cable', 0.10, 'Available'),
('P0141', 'Office Chair', 150.00, 'CT0008', 30, 'Ergonomic office chair', 10.00, 'Available'),
('P0142', 'Desk', 200.00, 'CT0008', 25, 'Wooden office desk', 30.00, 'Available'),
('P0143', 'Filing Cabinet', 120.00, 'CT0008', 15, 'Three-drawer filing cabinet', 20.00, 'Available'),
('P0144', 'Bookshelf', 100.00, 'CT0008', 20, 'Wooden bookshelf', 25.00, 'Available'),
('P0145', 'Coffee Table', 75.00, 'CT0008', 40, 'Stylish coffee table', 15.00, 'Available'),
('P0146', 'Dining Table', 250.00, 'CT0008', 15, 'Wooden dining table', 50.00, 'Available'),
('P0147', 'Lounge Chair', 85.00, 'CT0008', 30, 'Comfortable lounge chair', 10.00, 'Available'),
('P0148', 'Side Table', 45.00, 'CT0008', 50, 'Small side table', 5.00, 'Available'),
('P0149', 'Bookshelf Unit', 150.00, 'CT0008', 25, 'Five-tier bookshelf unit', 20.00, 'Available'),
('P0150', 'Desk Lamp', 30.00, 'CT0008', 100, 'Adjustable desk lamp', 3.00, 'Available'),
('P0151', 'Armchair', 120.00, 'CT0008', 20, 'Comfortable armchair', 15.00, 'Available'),
('P0152', 'Ottoman', 40.00, 'CT0008', 50, 'Soft ottoman', 5.00, 'Available'),
('P0153', 'TV Stand', 70.00, 'CT0008', 30, 'Stand for TV', 20.00, 'Available'),
('P0154', 'Sofa', 400.00, 'CT0008', 10, '3-seater sofa', 50.00, 'Available'),
('P0155', 'Storage Bench', 90.00, 'CT0008', 20, 'Bench with storage', 25.00, 'Available'),
('P0156', 'Console Table', 60.00, 'CT0008', 40, 'Narrow console table', 10.00, 'Available'),
('P0157', 'Hallway Rack', 50.00, 'CT0008', 30, 'Rack for hallway storage', 15.00, 'Available'),
('P0158', 'Wardrobe', 300.00, 'CT0008', 15, 'Large wardrobe for clothes', 80.00, 'Available'),
('P0159', 'Nightstand', 45.00, 'CT0008', 50, 'Small nightstand', 10.00, 'Available'),
('P0160', 'Dresser', 150.00, 'CT0008', 20, 'Dresser with mirror', 40.00, 'Available');

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
('I0001', 'P0001', '66f29c39e0e31.jpg'),
('I0002', 'P0001', '66f29c39e93c2.jpg'),
('I0003', 'P0001', '66f29c39ecb94.jpg'),
('I0004', 'P0001', '66f29c39ef9ea.jpg'),
('I0005', 'P0001', '66f29c39f2f37.jpg'),
('I0006', 'P0002', '66f29c96ebaac.jpg'),
('I0007', 'P0002', '66f29c96f2ceb.jpg'),
('I0008', 'P0002', '66f29c9701cae.jpg'),
('I0009', 'P0002', '66f29c97050fb.jpg'),
('I0010', 'P0002', '66f29c9708326.jpg'),
('I0011', 'P0003', '66f29cc66cf6c.jpg'),
('I0012', 'P0003', '66f29cc670ef2.jpg'),
('I0013', 'P0003', '66f29cc673fc1.jpg'),
('I0014', 'P0003', '66f29cc67726b.jpg'),
('I0015', 'P0003', '66f29cc67a9a1.jpg'),
('I0016', 'P0004', '66f29e23ecdc2.jpg'),
('I0017', 'P0004', '66f29e23f40cd.jpg'),
('I0018', 'P0004', '66f29e2402db7.jpg'),
('I0019', 'P0004', '66f29e2405d9e.jpg'),
('I0020', 'P0004', '66f29e2408c2d.jpg'),
('I0021', 'P0005', '66f29e4ab0f5a.jpg'),
('I0022', 'P0005', '66f29e4ab7b05.jpg'),
('I0023', 'P0005', '66f29e4abaadd.jpg'),
('I0024', 'P0005', '66f29e4abdb1e.jpg'),
('I0025', 'P0005', '66f29e4ac1013.jpg'),
('I0026', 'P0006', '66f29e6bda1ef.jpg'),
('I0027', 'P0006', '66f29e6be113c.jpg'),
('I0028', 'P0006', '66f29e6be4c27.jpg'),
('I0029', 'P0006', '66f29e6be8855.jpg'),
('I0030', 'P0006', '66f29e6bebe21.jpg'),
('I0031', 'P0007', '66f29ea82d6f3.jpg'),
('I0032', 'P0007', '66f29ea834c53.jpg'),
('I0033', 'P0007', '66f29ea837c43.jpg'),
('I0034', 'P0007', '66f29ea83aaa2.jpg'),
('I0035', 'P0007', '66f29ea83dc71.jpg'),
('I0036', 'P0008', '66f29ec587a64.jpg'),
('I0037', 'P0008', '66f29ec58e980.jpg'),
('I0038', 'P0008', '66f29ec592207.jpg'),
('I0039', 'P0008', '66f29ec59520f.jpg'),
('I0040', 'P0008', '66f29ec598278.jpg'),
('I0041', 'P0009', '66f29f089a504.jpg'),
('I0042', 'P0009', '66f29f08a1564.jpg'),
('I0043', 'P0009', '66f29f08a50ce.jpg'),
('I0044', 'P0009', '66f29f08a8da9.jpg'),
('I0045', 'P0009', '66f29f08ad2ac.jpg'),
('I0046', 'P0010', '66f29f274a67e.jpg'),
('I0047', 'P0010', '66f29f274e269.jpg'),
('I0048', 'P0010', '66f29f275155a.jpg'),
('I0049', 'P0010', '66f29f2754507.jpg'),
('I0050', 'P0010', '66f29f2757730.jpg'),
('I0051', 'P0011', '66f29f7c4f568.jpg'),
('I0052', 'P0011', '66f29f7c55b53.jpg'),
('I0053', 'P0011', '66f29f7c58cdb.jpg'),
('I0054', 'P0011', '66f29f7c5be9f.jpg'),
('I0055', 'P0011', '66f29f7c5ec80.jpg'),
('I0056', 'P0012', '66f29fb17b8fb.jpg'),
('I0057', 'P0012', '66f29fb180e90.jpg'),
('I0058', 'P0012', '66f29fb1849b6.jpg'),
('I0059', 'P0012', '66f29fb187a71.jpg'),
('I0060', 'P0012', '66f29fb18acfb.jpg'),
('I0061', 'P0013', '66f29fc9b8189.jpg'),
('I0062', 'P0013', '66f29fc9bf12a.jpg'),
('I0063', 'P0013', '66f29fc9c2d65.jpg'),
('I0064', 'P0013', '66f29fc9c6592.jpg'),
('I0065', 'P0013', '66f29fc9c9575.jpg'),
('I0066', 'P0014', '66f2a02dbf281.jpg'),
('I0067', 'P0014', '66f2a02dc2ed9.jpg'),
('I0068', 'P0014', '66f2a02dc61c8.jpg'),
('I0069', 'P0014', '66f2a02dc9357.jpg'),
('I0070', 'P0014', '66f2a02dcc449.jpg'),
('I0071', 'P0015', '66f2a046d7232.jpg'),
('I0072', 'P0015', '66f2a046ddcba.jpg'),
('I0073', 'P0015', '66f2a046e0df5.jpg'),
('I0074', 'P0015', '66f2a046e3d9c.jpg'),
('I0075', 'P0015', '66f2a046e6d06.jpg'),
('I0076', 'P0016', '66f2a060024ae.jpg'),
('I0077', 'P0016', '66f2a0600a3e4.jpg'),
('I0078', 'P0016', '66f2a0600d3f5.jpg'),
('I0079', 'P0016', '66f2a06011223.jpg'),
('I0080', 'P0016', '66f2a06014044.jpg'),
('I0081', 'P0017', '66f2a83c18d04.jpg'),
('I0082', 'P0017', '66f2a83c1fa6c.jpg'),
('I0083', 'P0017', '66f2a83c22ae6.jpg'),
('I0084', 'P0017', '66f2a83c2602e.jpg'),
('I0085', 'P0017', '66f2a83c293b6.jpg'),
('I0086', 'P0018', '66f2a88332e84.jpg'),
('I0087', 'P0018', '66f2a88339c25.jpg'),
('I0088', 'P0018', '66f2a8833cc26.jpg'),
('I0089', 'P0018', '66f2a8833fe16.jpg'),
('I0090', 'P0018', '66f2a88342c08.jpg'),
('I0091', 'P0019', '66f2a89855a4d.jpg'),
('I0092', 'P0019', '66f2a89859b20.jpg'),
('I0093', 'P0019', '66f2a8985ca35.jpg'),
('I0094', 'P0019', '66f2a8985fa74.jpg'),
('I0095', 'P0019', '66f2a89863393.jpg'),
('I0096', 'P0020', '66f2a8aed1bc3.jpg'),
('I0097', 'P0020', '66f2a8aed894c.jpg'),
('I0098', 'P0020', '66f2a8aedbcab.jpg'),
('I0099', 'P0020', '66f2a8aedec1f.jpg'),
('I0100', 'P0020', '66f2a8aee1801.jpg'),
('I0101', 'P0021', '66f2a8fa20f34.jpg'),
('I0102', 'P0021', '66f2a8fa245f5.jpg'),
('I0103', 'P0021', '66f2a8fa27c1a.jpg'),
('I0104', 'P0021', '66f2a8fa2b060.jpg'),
('I0105', 'P0021', '66f2a8fa2e43d.jpg'),
('I0106', 'P0022', '66f2a90f5af23.jpg'),
('I0107', 'P0022', '66f2a90f5ef2c.jpg'),
('I0108', 'P0022', '66f2a90f61fbb.jpg'),
('I0109', 'P0022', '66f2a90f64f7a.jpg'),
('I0110', 'P0022', '66f2a90f6800c.jpg'),
('I0111', 'P0023', '66f2a96f48bc5.jpg'),
('I0112', 'P0023', '66f2a96f4c5ee.jpg'),
('I0113', 'P0023', '66f2a96f4f7aa.jpg'),
('I0114', 'P0023', '66f2a96f526b2.jpg'),
('I0115', 'P0023', '66f2a96f5563c.jpg'),
('I0116', 'P0024', '66f2a9879f80a.jpg'),
('I0117', 'P0024', '66f2a987a3647.jpg'),
('I0118', 'P0024', '66f2a987a6eca.jpg'),
('I0119', 'P0025', '66f2a99750b73.jpg'),
('I0120', 'P0025', '66f2a99757b8f.jpg'),
('I0121', 'P0025', '66f2a9975ae8d.jpg'),
('I0122', 'P0026', '66f2a9ae28ffa.jpg'),
('I0123', 'P0026', '66f2a9ae306f8.jpg'),
('I0124', 'P0026', '66f2a9ae3418b.jpg'),
('I0125', 'P0026', '66f2a9ae36f6e.jpg'),
('I0126', 'P0027', '66f2a9c238855.jpg'),
('I0127', 'P0027', '66f2a9c23effa.jpg'),
('I0128', 'P0027', '66f2a9c2421fc.jpg'),
('I0129', 'P0028', '66f2a9fa33745.jpg'),
('I0130', 'P0028', '66f2a9fa37131.jpg'),
('I0131', 'P0028', '66f2a9fa3a0ef.jpg'),
('I0132', 'P0029', '66f2aa0fdab07.jpg'),
('I0133', 'P0029', '66f2aa0fdef9c.jpg'),
('I0134', 'P0029', '66f2aa0fe263f.jpg'),
('I0135', 'P0030', '66f2aa3261d9a.jpg'),
('I0136', 'P0030', '66f2aa3266a11.jpg'),
('I0137', 'P0030', '66f2aa326a233.jpg'),
('I0138', 'P0030', '66f2aa326d632.jpg'),
('I0139', 'P0031', '66f2aa4c553c5.jpg'),
('I0140', 'P0031', '66f2aa4c5bf86.jpg'),
('I0141', 'P0031', '66f2aa4c5f33b.jpg'),
('I0142', 'P0031', '66f2aa4c62705.jpg'),
('I0143', 'P0032', '66f2aa5f4a1ec.jpg'),
('I0144', 'P0032', '66f2aa5f4e13c.jpg'),
('I0145', 'P0032', '66f2aa5f52114.jpg'),
('I0146', 'P0032', '66f2aa5f5575b.jpg'),
('I0147', 'P0033', '66f2aa7be7207.jpg'),
('I0148', 'P0033', '66f2aa7bedf90.jpg'),
('I0149', 'P0033', '66f2aa7bf0d9f.jpg'),
('I0150', 'P0033', '66f2aa7bf3e4d.jpg'),
('I0151', 'P0034', '66f2aa9626eda.jpg'),
('I0152', 'P0034', '66f2aa962ddc4.jpg'),
('I0153', 'P0034', '66f2aa9630b75.jpg'),
('I0154', 'P0034', '66f2aa9633bc2.jpg'),
('I0155', 'P0034', '66f2aa96374ad.jpg'),
('I0156', 'P0035', '66f2aaaaf1ff1.jpg'),
('I0157', 'P0035', '66f2aaab04da7.jpg'),
('I0158', 'P0035', '66f2aaab07f98.jpg'),
('I0159', 'P0035', '66f2aaab0b0bd.jpg'),
('I0160', 'P0036', '66f2aaccc0647.jpg'),
('I0161', 'P0036', '66f2aaccc76d4.jpg'),
('I0162', 'P0036', '66f2aaccca4dd.jpg'),
('I0163', 'P0037', '66f2aae0f1ad5.jpg'),
('I0164', 'P0037', '66f2aae103fc0.jpg'),
('I0165', 'P0037', '66f2aae1070df.jpg'),
('I0166', 'P0038', '66f2ab63748c8.jpg'),
('I0167', 'P0038', '66f2ab6378453.jpg'),
('I0168', 'P0038', '66f2ab637b3b7.jpg'),
('I0169', 'P0038', '66f2ab637e2cb.jpg'),
('I0170', 'P0038', '66f2ab6381d59.jpg'),
('I0171', 'P0039', '66f2abad2a771.jpg'),
('I0172', 'P0039', '66f2abad2f23d.jpg'),
('I0173', 'P0039', '66f2abad32c4c.jpg'),
('I0174', 'P0039', '66f2abad35a5b.jpg'),
('I0175', 'P0039', '66f2abad39026.jpg'),
('I0176', 'P0040', '66f2abbeac1d7.jpg'),
('I0177', 'P0040', '66f2abbeafcfb.jpg'),
('I0178', 'P0040', '66f2abbeb2f64.jpg'),
('I0179', 'P0040', '66f2abbeb691b.jpg'),
('I0180', 'P0041', '66f2ac4e038ab.jpg'),
('I0181', 'P0041', '66f2ac4e05be3.jpg'),
('I0182', 'P0041', '66f2ac4e08971.jpg'),
('I0183', 'P0041', '66f2ac4e0b8b9.jpg'),
('I0184', 'P0042', '66f2aca6069c5.jpg'),
('I0185', 'P0042', '66f2aca60d94c.jpg'),
('I0186', 'P0042', '66f2aca610ea0.jpg'),
('I0187', 'P0042', '66f2aca613e8b.jpg'),
('I0188', 'P0043', '66f2acba35829.jpg'),
('I0189', 'P0043', '66f2acba38f70.jpg'),
('I0190', 'P0043', '66f2acba3f87e.jpg'),
('I0191', 'P0043', '66f2acba425ca.jpg'),
('I0192', 'P0044', '66f2acd151868.jpg'),
('I0193', 'P0044', '66f2acd1554b0.jpg'),
('I0194', 'P0044', '66f2acd1583bb.jpg'),
('I0195', 'P0044', '66f2acd15b6e7.jpg'),
('I0196', 'P0044', '66f2acd15e7d2.jpg'),
('I0197', 'P0045', '66f2ace7b0b8a.jpg'),
('I0198', 'P0045', '66f2ace7b4b55.jpg'),
('I0199', 'P0045', '66f2ace7c0a10.jpg'),
('I0200', 'P0045', '66f2ace7c3ae5.jpg'),
('I0201', 'P0045', '66f2ace7c6ab6.jpg'),
('I0202', 'P0046', '66f2ad3aeed09.jpg'),
('I0203', 'P0046', '66f2ad3b0128d.jpg'),
('I0204', 'P0046', '66f2ad3b04818.jpg'),
('I0205', 'P0046', '66f2ad3b07815.jpg'),
('I0206', 'P0046', '66f2ad3b0ad0f.jpg'),
('I0207', 'P0047', '66f2ad5237af3.jpg'),
('I0208', 'P0047', '66f2ad523b771.jpg'),
('I0209', 'P0047', '66f2ad523f501.jpg'),
('I0210', 'P0047', '66f2ad5242502.jpg'),
('I0211', 'P0047', '66f2ad5247290.jpg'),
('I0212', 'P0048', '66f2ad8bd3155.jpg'),
('I0213', 'P0048', '66f2ad8bd9eca.jpg'),
('I0214', 'P0048', '66f2ad8bdd0d5.jpg'),
('I0215', 'P0048', '66f2ad8be60dd.jpg'),
('I0216', 'P0049', '66f2ad9bbcbe5.jpg'),
('I0217', 'P0049', '66f2ad9bc10b0.jpg'),
('I0218', 'P0049', '66f2ad9bc45e2.jpg'),
('I0219', 'P0050', '66f2ade590088.jpg'),
('I0220', 'P0050', '66f2ade593bb3.jpg'),
('I0221', 'P0050', '66f2ade596b21.jpg'),
('I0222', 'P0050', '66f2ade599df8.jpg'),
('I0223', 'P0050', '66f2ade59cfe2.jpg'),
('I0224', 'P0051', '66f2ae07bee97.jpg'),
('I0225', 'P0051', '66f2ae07c274c.jpg'),
('I0226', 'P0051', '66f2ae07c5674.jpg'),
('I0227', 'P0051', '66f2ae07c96cc.jpg'),
('I0228', 'P0051', '66f2ae07cccb8.jpg'),
('I0229', 'P0052', '66f2ae1fddaa3.jpg'),
('I0230', 'P0052', '66f2ae1fe4886.jpg'),
('I0231', 'P0052', '66f2ae1fe7b3e.jpg'),
('I0232', 'P0052', '66f2ae1feab40.jpg'),
('I0233', 'P0052', '66f2ae1fedbf5.jpg'),
('I0234', 'P0053', '66f2ae4410d14.jpg'),
('I0235', 'P0053', '66f2ae4415a71.jpg'),
('I0236', 'P0053', '66f2ae4419542.jpg'),
('I0237', 'P0053', '66f2ae441cac0.jpg'),
('I0238', 'P0053', '66f2ae441f96e.jpg'),
('I0239', 'P0054', '66f2ae5b5750b.jpg'),
('I0240', 'P0054', '66f2ae5b5ad9c.jpg'),
('I0241', 'P0054', '66f2ae5b5de49.jpg'),
('I0242', 'P0054', '66f2ae5b60f0a.jpg'),
('I0243', 'P0055', '66f2ae7cbc6a5.jpg'),
('I0244', 'P0055', '66f2ae7cc00db.jpg'),
('I0245', 'P0055', '66f2ae7cc3053.jpg'),
('I0246', 'P0055', '66f2ae7cc607a.jpg'),
('I0247', 'P0055', '66f2ae7cc97c7.jpg'),
('I0248', 'P0056', '66f2af94f3f33.jpg'),
('I0249', 'P0056', '66f2af9503c10.jpg'),
('I0250', 'P0056', '66f2af9506f01.jpg'),
('I0251', 'P0056', '66f2af9509cc1.jpg'),
('I0252', 'P0056', '66f2af950cb32.jpg'),
('I0253', 'P0057', '66f2afcc5a9a1.jpg'),
('I0254', 'P0057', '66f2afcc61495.jpg'),
('I0255', 'P0057', '66f2afcc67ae8.jpg'),
('I0256', 'P0057', '66f2afcc6af3e.jpg'),
('I0257', 'P0058', '66f2aff4e4296.jpg'),
('I0258', 'P0058', '66f2aff4eb5eb.jpg'),
('I0259', 'P0058', '66f2aff4eea92.jpg'),
('I0260', 'P0058', '66f2aff4f1f4d.jpg'),
('I0261', 'P0059', '66f2b0bfdcf06.jpg'),
('I0262', 'P0059', '66f2b0bfe42f5.jpg'),
('I0263', 'P0059', '66f2b0bff173a.jpg'),
('I0264', 'P0059', '66f2b0c00039f.jpg'),
('I0265', 'P0060', '66f2b0d2a23e3.jpg'),
('I0266', 'P0060', '66f2b0d2a915e.jpg'),
('I0267', 'P0060', '66f2b0d2ac6c9.jpg'),
('I0268', 'P0060', '66f2b0d2af9f2.jpg'),
('I0269', 'P0060', '66f2b0d2bb01b.jpg'),
('I0270', 'P0061', '66f2bf4fa4bfd.jpg'),
('I0271', 'P0061', '66f2bf4fac58f.jpg'),
('I0272', 'P0061', '66f2bf4fb8065.jpg'),
('I0273', 'P0061', '66f2bf4fc3e82.jpg'),
('I0274', 'P0061', '66f2bf4fc6dae.jpg'),
('I0275', 'P0062', '66f2bf9f75d8c.jpg'),
('I0276', 'P0062', '66f2bf9f79db0.jpg'),
('I0277', 'P0062', '66f2bf9f7dded.jpg'),
('I0278', 'P0062', '66f2bf9f8a107.jpg'),
('I0279', 'P0062', '66f2bf9f9331a.jpg'),
('I0280', 'P0063', '66f2bfba32a5d.jpg'),
('I0281', 'P0063', '66f2bfba362ce.jpg'),
('I0282', 'P0063', '66f2bfba39310.jpg'),
('I0283', 'P0063', '66f2bfba3c4e3.jpg'),
('I0284', 'P0063', '66f2bfba3f70e.jpg'),
('I0285', 'P0064', '66f2bfccc3c28.jpg'),
('I0286', 'P0064', '66f2bfcccabf6.jpg'),
('I0287', 'P0064', '66f2bfccce4e8.jpg'),
('I0288', 'P0064', '66f2bfccd171e.jpg'),
('I0289', 'P0065', '66f2bfded8983.jpg'),
('I0290', 'P0065', '66f2bfdeefd5e.jpg'),
('I0291', 'P0065', '66f2bfdef31c2.jpg'),
('I0292', 'P0065', '66f2bfdf021a6.jpg'),
('I0293', 'P0066', '66f2c04ccacde.jpg'),
('I0294', 'P0066', '66f2c04ccebae.jpg'),
('I0295', 'P0066', '66f2c04cd2cea.jpg'),
('I0296', 'P0066', '66f2c05d91121.jpg'),
('I0297', 'P0066', '66f2c05d947eb.jpg'),
('I0298', 'P0066', '66f2c05d9886c.jpg'),
('I0299', 'P0067', '66f2c06de15b9.jpg'),
('I0300', 'P0067', '66f2c06de50f0.jpg'),
('I0301', 'P0067', '66f2c06de86a3.jpg'),
('I0302', 'P0067', '66f2c06deb9bb.jpg'),
('I0303', 'P0068', '66f2c081d4d2e.jpg'),
('I0304', 'P0068', '66f2c081d96d1.jpg'),
('I0305', 'P0068', '66f2c081dd661.jpg'),
('I0306', 'P0068', '66f2c081e11e1.jpg'),
('I0307', 'P0068', '66f2c0a571e71.jpg'),
('I0308', 'P0068', '66f2c0a576623.jpg'),
('I0309', 'P0068', '66f2c0a57a3e0.jpg'),
('I0310', 'P0068', '66f2c0a57e058.jpg'),
('I0311', 'P0068', '66f2c0a581824.jpg'),
('I0312', 'P0069', '66f2c0b5e7b14.jpg'),
('I0313', 'P0069', '66f2c0b5ee34d.jpg'),
('I0314', 'P0069', '66f2c0b5f16f5.jpg'),
('I0315', 'P0070', '66f2c0cc0ec33.jpg'),
('I0316', 'P0070', '66f2c0cc1286b.jpg'),
('I0317', 'P0070', '66f2c0cc16518.jpg'),
('I0318', 'P0070', '66f2c0cc198d7.jpg'),
('I0319', 'P0071', '66f2c0efdff94.jpg'),
('I0320', 'P0071', '66f2c0efe3b87.jpg'),
('I0321', 'P0071', '66f2c0efe7033.jpg'),
('I0322', 'P0071', '66f2c0efea508.jpg'),
('I0323', 'P0072', '66f2c1048fe1f.jpg'),
('I0324', 'P0072', '66f2c10493eb4.jpg'),
('I0325', 'P0072', '66f2c10497253.jpg'),
('I0326', 'P0072', '66f2c1049a4a1.jpg'),
('I0327', 'P0073', '66f2c11518e5a.jpg'),
('I0328', 'P0073', '66f2c1151c5eb.jpg'),
('I0329', 'P0073', '66f2c1151fd43.jpg'),
('I0330', 'P0073', '66f2c11523335.jpg'),
('I0331', 'P0074', '66f2c13c81956.jpg'),
('I0332', 'P0074', '66f2c13c98be7.jpg'),
('I0333', 'P0074', '66f2c13ca2607.jpg'),
('I0334', 'P0074', '66f2c13ca5afe.jpg'),
('I0335', 'P0074', '66f2c13ca9045.jpg'),
('I0336', 'P0075', '66f2c14c7793f.jpg'),
('I0337', 'P0075', '66f2c14c7e7b5.jpg'),
('I0338', 'P0075', '66f2c14c81b25.jpg'),
('I0339', 'P0075', '66f2c14c850d5.jpg'),
('I0340', 'P0076', '66f2c16fda312.jpg'),
('I0341', 'P0076', '66f2c16fddf46.jpg'),
('I0342', 'P0076', '66f2c16fe1948.jpg'),
('I0343', 'P0076', '66f2c16fe4e9d.jpg'),
('I0344', 'P0077', '66f2c1896976c.jpg'),
('I0345', 'P0077', '66f2c1896d244.jpg'),
('I0346', 'P0077', '66f2c189708b7.jpg'),
('I0347', 'P0077', '66f2c18973e75.jpg'),
('I0348', 'P0078', '66f2c1a13201b.jpg'),
('I0349', 'P0078', '66f2c1a135e6a.jpg'),
('I0350', 'P0078', '66f2c1a1392a9.jpg'),
('I0351', 'P0078', '66f2c1a13ccd8.jpg'),
('I0352', 'P0079', '66f2c1b86005b.jpg'),
('I0353', 'P0079', '66f2c1b8638f6.jpg'),
('I0354', 'P0079', '66f2c1b866f13.jpg'),
('I0355', 'P0079', '66f2c1b869f52.jpg'),
('I0356', 'P0079', '66f2c1b86d6fc.jpg'),
('I0357', 'P0080', '66f2c1d100ac3.jpg'),
('I0358', 'P0080', '66f2c1d1079a7.jpg'),
('I0359', 'P0080', '66f2c1d10bf7e.jpg'),
('I0360', 'P0080', '66f2c1d10efbf.jpg'),
('I0361', 'P0080', '66f2c1d112288.jpg'),
('I0362', 'P0101', '66f2d5c36dce7.jpg'),
('I0363', 'P0101', '66f2d5c371821.jpg'),
('I0364', 'P0101', '66f2d5c374dde.jpg'),
('I0365', 'P0101', '66f2d5c37822c.jpg'),
('I0366', 'P0101', '66f2d5c37af77.jpg'),
('I0367', 'P0102', '66f2d5d4235c1.jpg'),
('I0368', 'P0102', '66f2d5d427129.jpg'),
('I0369', 'P0102', '66f2d5d429e71.jpg'),
('I0370', 'P0102', '66f2d5d42cdf5.jpg'),
('I0371', 'P0102', '66f2d5d4301a5.jpg'),
('I0372', 'P0103', '66f2d6016f212.jpg'),
('I0373', 'P0103', '66f2d60175d8e.jpg'),
('I0374', 'P0103', '66f2d60178afc.jpg'),
('I0375', 'P0103', '66f2d6017b995.jpg'),
('I0376', 'P0103', '66f2d6017ed89.jpg'),
('I0377', 'P0104', '66f2d640bb802.jpg'),
('I0378', 'P0104', '66f2d640c24bb.jpg'),
('I0379', 'P0104', '66f2d640c5212.jpg'),
('I0380', 'P0104', '66f2d640c82ab.jpg'),
('I0381', 'P0105', '66f2d65f7cfd3.jpg'),
('I0382', 'P0105', '66f2d65f8455e.jpg'),
('I0383', 'P0105', '66f2d65f8742f.jpg'),
('I0384', 'P0105', '66f2d65f8b43d.jpg'),
('I0385', 'P0105', '66f2d65f8f923.jpg'),
('I0386', 'P0106', '66f2d67ddcce4.jpg'),
('I0387', 'P0106', '66f2d67de0bd3.jpg'),
('I0388', 'P0106', '66f2d67de38c5.jpg'),
('I0389', 'P0106', '66f2d67de69a7.jpg'),
('I0390', 'P0106', '66f2d67de991f.jpg'),
('I0391', 'P0107', '66f2d6a583683.jpg'),
('I0392', 'P0107', '66f2d6a587894.jpg'),
('I0393', 'P0107', '66f2d6a58ad9b.jpg'),
('I0394', 'P0107', '66f2d6a58e785.jpg'),
('I0395', 'P0107', '66f2d6a591b46.jpg'),
('I0396', 'P0108', '66f2d6b86bcf0.jpg'),
('I0397', 'P0108', '66f2d6b87273e.jpg'),
('I0398', 'P0108', '66f2d6b875420.jpg'),
('I0399', 'P0108', '66f2d6b878dca.jpg'),
('I0400', 'P0109', '66f2d6cff2a8b.jpg'),
('I0401', 'P0109', '66f2d6d00206c.jpg'),
('I0402', 'P0109', '66f2d6d0057c0.jpg'),
('I0403', 'P0109', '66f2d6d008ab9.jpg'),
('I0404', 'P0110', '66f2d6ece3c41.jpg'),
('I0405', 'P0110', '66f2d6ece7a58.jpg'),
('I0406', 'P0110', '66f2d6ecea978.jpg'),
('I0407', 'P0110', '66f2d6ecedcc7.jpg'),
('I0408', 'P0111', '66f2d70abc88e.jpg'),
('I0409', 'P0111', '66f2d70ac0430.jpg'),
('I0410', 'P0111', '66f2d70ac366f.jpg'),
('I0411', 'P0111', '66f2d70ac640e.jpg'),
('I0412', 'P0111', '66f2d70ac9556.jpg'),
('I0413', 'P0112', '66f2d726eefb2.jpg'),
('I0414', 'P0112', '66f2d726f2853.jpg'),
('I0415', 'P0112', '66f2d72701c8d.jpg'),
('I0416', 'P0112', '66f2d727051b0.jpg'),
('I0417', 'P0112', '66f2d72707f18.jpg'),
('I0418', 'P0113', '66f2d74cab7f3.jpg'),
('I0419', 'P0113', '66f2d74cb217d.jpg'),
('I0420', 'P0113', '66f2d74cb4fc6.jpg'),
('I0421', 'P0113', '66f2d74cb81c0.jpg'),
('I0422', 'P0113', '66f2d74cbb298.jpg'),
('I0423', 'P0114', '66f2d765961b6.jpg'),
('I0424', 'P0114', '66f2d7659d75a.jpg'),
('I0425', 'P0114', '66f2d765a075d.jpg'),
('I0426', 'P0114', '66f2d765a387b.jpg'),
('I0427', 'P0115', '66f2d77d09124.jpg'),
('I0428', 'P0115', '66f2d77d10485.jpg'),
('I0429', 'P0115', '66f2d77d137d7.jpg'),
('I0430', 'P0115', '66f2d77d17b15.jpg'),
('I0431', 'P0115', '66f2d77d1a700.jpg'),
('I0432', 'P0116', '66f2d7978a593.jpg'),
('I0433', 'P0116', '66f2d7978e23f.jpg'),
('I0434', 'P0116', '66f2d79790f08.jpg'),
('I0435', 'P0116', '66f2d7979490a.jpg'),
('I0436', 'P0116', '66f2d79797fb9.jpg'),
('I0437', 'P0117', '66f2d7b3477b1.jpg'),
('I0438', 'P0117', '66f2d7b34edfd.jpg'),
('I0439', 'P0117', '66f2d7b351d50.jpg'),
('I0440', 'P0117', '66f2d7b355242.jpg'),
('I0441', 'P0117', '66f2d7b3587d3.jpg'),
('I0442', 'P0118', '66f2d7eb2f67c.jpg'),
('I0443', 'P0118', '66f2d7eb36549.jpg'),
('I0444', 'P0118', '66f2d7eb393b9.jpg'),
('I0445', 'P0118', '66f2d7eb3c02c.jpg'),
('I0446', 'P0119', '66f2d8274b261.jpg'),
('I0447', 'P0119', '66f2d8275130d.jpg'),
('I0448', 'P0119', '66f2d82754da6.jpg'),
('I0449', 'P0119', '66f2d82757eaf.jpg'),
('I0450', 'P0120', '66f2d8445e0f3.jpg'),
('I0451', 'P0120', '66f2d84461b29.jpg'),
('I0452', 'P0120', '66f2d84464dac.jpg'),
('I0453', 'P0120', '66f2d8446862b.jpg'),
('I0454', 'P0121', '66f2d8790cb8d.jpg'),
('I0455', 'P0121', '66f2d8791068d.jpg'),
('I0456', 'P0121', '66f2d87913762.jpg'),
('I0457', 'P0121', '66f2d87916e0c.jpg'),
('I0458', 'P0121', '66f2d87919c4a.jpg'),
('I0459', 'P0122', '66f2d89f22806.jpg'),
('I0460', 'P0122', '66f2d89f263ad.jpg'),
('I0461', 'P0122', '66f2d89f29644.jpg'),
('I0462', 'P0122', '66f2d89f2c659.jpg'),
('I0463', 'P0122', '66f2d89f3000d.jpg'),
('I0464', 'P0123', '66f2d8af34bca.jpg'),
('I0465', 'P0123', '66f2d8af385a0.jpg'),
('I0466', 'P0123', '66f2d8af3b98b.jpg'),
('I0467', 'P0123', '66f2d8af3e948.jpg'),
('I0468', 'P0123', '66f2d8af41691.jpg'),
('I0469', 'P0124', '66f2d8c627aae.jpg'),
('I0470', 'P0124', '66f2d8c62e26a.jpg'),
('I0471', 'P0124', '66f2d8c631700.jpg'),
('I0472', 'P0124', '66f2d8c6352e3.jpg'),
('I0473', 'P0124', '66f2d8c638c3f.jpg'),
('I0474', 'P0125', '66f2d91eec2c6.jpg'),
('I0475', 'P0125', '66f2d91ef1767.jpg'),
('I0476', 'P0125', '66f2d91f00a79.jpg'),
('I0477', 'P0125', '66f2d91f03721.jpg'),
('I0478', 'P0125', '66f2d91f068a6.jpg'),
('I0479', 'P0126', '66f2d955a5c17.jpg'),
('I0480', 'P0126', '66f2d955a95ce.jpg'),
('I0481', 'P0126', '66f2d955ac3a6.jpg'),
('I0482', 'P0126', '66f2d955b03f5.jpg'),
('I0483', 'P0127', '66f2d97929396.jpg'),
('I0484', 'P0127', '66f2d9792fd56.jpg'),
('I0485', 'P0127', '66f2d979330e3.jpg'),
('I0486', 'P0127', '66f2d979365cc.jpg'),
('I0487', 'P0128', '66f2d9955ad30.jpg'),
('I0488', 'P0128', '66f2d9955f167.jpg'),
('I0489', 'P0128', '66f2d99562954.jpg'),
('I0490', 'P0128', '66f2d99566421.jpg'),
('I0491', 'P0128', '66f2d99569234.jpg'),
('I0492', 'P0129', '66f2d9ab0dfc4.jpg'),
('I0493', 'P0129', '66f2d9ab145f3.jpg'),
('I0494', 'P0129', '66f2d9ab174ff.jpg'),
('I0495', 'P0129', '66f2d9ab1a3e2.jpg'),
('I0496', 'P0130', '66f2d9d32b895.jpg'),
('I0497', 'P0130', '66f2d9d32f92f.jpg'),
('I0498', 'P0130', '66f2d9d332cb1.jpg'),
('I0499', 'P0130', '66f2d9d335a6b.jpg'),
('I0500', 'P0130', '66f2d9d338c47.jpg'),
('I0501', 'P0131', '66f2d9f0d8172.jpg'),
('I0502', 'P0131', '66f2d9f0db78a.jpg'),
('I0503', 'P0131', '66f2d9f0de656.jpg'),
('I0504', 'P0131', '66f2d9f0e1a9a.jpg'),
('I0505', 'P0132', '66f2da0cd88f4.jpg'),
('I0506', 'P0132', '66f2da0cdfc35.jpg'),
('I0507', 'P0132', '66f2da0ce2a4c.jpg'),
('I0508', 'P0132', '66f2da0ce5b57.jpg'),
('I0509', 'P0133', '66f2da1eea23a.jpg'),
('I0510', 'P0133', '66f2da1ef0b2b.jpg'),
('I0511', 'P0133', '66f2da1ef3e51.jpg'),
('I0512', 'P0133', '66f2da1f02bb9.jpg'),
('I0513', 'P0133', '66f2da1f05cf4.jpg'),
('I0514', 'P0134', '66f2da432b568.jpg'),
('I0515', 'P0134', '66f2da432ef78.jpg'),
('I0516', 'P0134', '66f2da4332328.jpg'),
('I0517', 'P0134', '66f2da4335914.jpg'),
('I0518', 'P0134', '66f2da4338b1c.jpg'),
('I0519', 'P0135', '66f2da710cd77.jpg'),
('I0520', 'P0135', '66f2da71148f4.jpg'),
('I0521', 'P0135', '66f2da711a322.jpg'),
('I0522', 'P0135', '66f2da711d390.jpg'),
('I0523', 'P0135', '66f2da712110c.jpg'),
('I0524', 'P0136', '66f2da967771e.jpg'),
('I0525', 'P0136', '66f2da967b26e.jpg'),
('I0526', 'P0136', '66f2da967f175.jpg'),
('I0527', 'P0136', '66f2da9681e0a.jpg'),
('I0528', 'P0136', '66f2da9685307.jpg'),
('I0529', 'P0137', '66f2daa8617be.jpg'),
('I0530', 'P0137', '66f2daa865268.jpg'),
('I0531', 'P0137', '66f2daa86829f.jpg'),
('I0532', 'P0137', '66f2daa86b91e.jpg'),
('I0533', 'P0137', '66f2daa86f001.jpg'),
('I0534', 'P0138', '66f2daca48779.jpg'),
('I0535', 'P0138', '66f2daca4c9ee.jpg'),
('I0536', 'P0138', '66f2daca50588.jpg'),
('I0537', 'P0138', '66f2daca53480.jpg'),
('I0538', 'P0138', '66f2daca56b29.jpg'),
('I0539', 'P0139', '66f2dae137550.jpg'),
('I0540', 'P0139', '66f2dae13b186.jpg'),
('I0541', 'P0139', '66f2dae13e642.jpg'),
('I0542', 'P0139', '66f2dae1413ef.jpg'),
('I0543', 'P0140', '66f2daff69021.jpg'),
('I0544', 'P0140', '66f2daff6cefd.jpg'),
('I0545', 'P0140', '66f2daff6fe49.jpg'),
('I0546', 'P0140', '66f2daff7304a.jpg'),
('I0547', 'P0140', '66f2daff761ed.jpg'),
('I0548', 'P0151', '66f2db1e219b0.jpg'),
('I0549', 'P0151', '66f2db1e253a9.jpg'),
('I0550', 'P0151', '66f2db1e284d5.jpg'),
('I0551', 'P0151', '66f2db1e2b295.jpg'),
('I0552', 'P0151', '66f2db1e2ed28.jpg'),
('I0553', 'P0144', '66f2db2d08d48.jpg'),
('I0554', 'P0144', '66f2db2d0c84d.jpg'),
('I0555', 'P0144', '66f2db2d0f8f7.jpg'),
('I0556', 'P0144', '66f2db2d131b5.jpg'),
('I0557', 'P0144', '66f2db2d16551.jpg'),
('I0558', 'P0149', '66f2db38f274c.jpg'),
('I0559', 'P0149', '66f2db3902434.jpg'),
('I0560', 'P0149', '66f2db390558b.jpg'),
('I0561', 'P0149', '66f2db3908ae8.jpg'),
('I0562', 'P0149', '66f2db390bbbc.jpg'),
('I0563', 'P0145', '66f2db58304e1.jpg'),
('I0564', 'P0145', '66f2db5833f45.jpg'),
('I0565', 'P0145', '66f2db58376e7.jpg'),
('I0566', 'P0145', '66f2db583a3aa.jpg'),
('I0567', 'P0145', '66f2db583e095.jpg'),
('I0568', 'P0156', '66f2db7ba661a.jpg'),
('I0569', 'P0156', '66f2db7baa1d6.jpg'),
('I0570', 'P0156', '66f2db7bad2e1.jpg'),
('I0571', 'P0156', '66f2db7bb093a.jpg'),
('I0572', 'P0142', '66f2db979ad56.jpg'),
('I0573', 'P0142', '66f2db979e20c.jpg'),
('I0574', 'P0142', '66f2db97a1100.jpg'),
('I0575', 'P0142', '66f2db97a3f4a.jpg'),
('I0576', 'P0142', '66f2db97a73c1.jpg'),
('I0577', 'P0150', '66f2dbb51ee46.jpg'),
('I0578', 'P0150', '66f2dbb5229c5.jpg'),
('I0579', 'P0150', '66f2dbb52612b.jpg'),
('I0580', 'P0150', '66f2dbb529182.jpg'),
('I0581', 'P0150', '66f2dbb52c025.jpg'),
('I0582', 'P0146', '66f2dbd025961.jpg'),
('I0583', 'P0146', '66f2dbd02932b.jpg'),
('I0584', 'P0146', '66f2dbd02c2f7.jpg'),
('I0585', 'P0146', '66f2dbd0307e4.jpg'),
('I0586', 'P0146', '66f2dbd0339a7.jpg'),
('I0587', 'P0143', '66f2dbe541a01.jpg'),
('I0588', 'P0143', '66f2dbe545710.jpg'),
('I0589', 'P0143', '66f2dbe548a3d.jpg'),
('I0590', 'P0143', '66f2dbe54bcc6.jpg'),
('I0591', 'P0143', '66f2dbe54ebac.jpg'),
('I0592', 'P0157', '66f2dc088aa5c.jpg'),
('I0593', 'P0157', '66f2dc08918ff.jpg'),
('I0594', 'P0157', '66f2dc0894aef.jpg'),
('I0595', 'P0157', '66f2dc0897ad4.jpg'),
('I0596', 'P0147', '66f2dc1c2eee0.jpg'),
('I0597', 'P0147', '66f2dc1c3596e.jpg'),
('I0598', 'P0147', '66f2dc1c38e48.jpg'),
('I0599', 'P0147', '66f2dc1c3bcbd.jpg'),
('I0600', 'P0147', '66f2dc1c3e9ef.jpg'),
('I0601', 'P0159', '66f2dc33867c9.jpg'),
('I0602', 'P0159', '66f2dc338a08a.jpg'),
('I0603', 'P0159', '66f2dc338cfd7.jpg'),
('I0604', 'P0159', '66f2dc338ff04.jpg'),
('I0605', 'P0159', '66f2dc3392e4c.jpg'),
('I0606', 'P0141', '66f2dc51c0a48.jpg'),
('I0607', 'P0141', '66f2dc51c45f6.jpg'),
('I0608', 'P0141', '66f2dc51c7529.jpg'),
('I0609', 'P0152', '66f2dc80179e3.jpg'),
('I0610', 'P0152', '66f2dc801b277.jpg'),
('I0611', 'P0152', '66f2dc801e5bd.jpg'),
('I0612', 'P0152', '66f2dc8021dac.jpg'),
('I0613', 'P0152', '66f2dc8025759.jpg'),
('I0614', 'P0148', '66f2dcb23bca0.jpg'),
('I0615', 'P0148', '66f2dcb23f362.jpg'),
('I0616', 'P0148', '66f2dcb2420e6.jpg'),
('I0617', 'P0148', '66f2dcb244e2c.jpg'),
('I0618', 'P0154', '66f2dcbf969e8.jpg'),
('I0619', 'P0154', '66f2dcbf9a5cd.jpg'),
('I0620', 'P0154', '66f2dcbf9d55d.jpg'),
('I0621', 'P0154', '66f2dcbfa0253.jpg'),
('I0622', 'P0154', '66f2dcbfa421d.jpg'),
('I0623', 'P0155', '66f2dcea48e2c.jpg'),
('I0624', 'P0155', '66f2dcea4d90b.jpg'),
('I0625', 'P0155', '66f2dcea50bc9.jpg'),
('I0626', 'P0155', '66f2dcea54865.jpg'),
('I0627', 'P0155', '66f2dcea57663.jpg'),
('I0628', 'P0153', '66f2dcf7061ad.jpg'),
('I0629', 'P0153', '66f2dcf709fc5.jpg'),
('I0630', 'P0153', '66f2dcf70d0af.jpg'),
('I0631', 'P0153', '66f2dcf71093a.jpg'),
('I0632', 'P0153', '66f2dcf71439b.jpg'),
('I0633', 'P0158', '66f2dd04d5924.jpg'),
('I0634', 'P0158', '66f2dd04dc474.jpg'),
('I0635', 'P0158', '66f2dd04df64d.jpg'),
('I0636', 'P0158', '66f2dd04e26e3.jpg'),
('I0637', 'P0081', '66f2dd71f4177.jpg'),
('I0638', 'P0081', '66f2dd7203403.jpg'),
('I0639', 'P0081', '66f2dd720631a.jpg'),
('I0640', 'P0081', '66f2dd72097c3.jpg'),
('I0641', 'P0082', '66f2dd9171c8a.jpg'),
('I0642', 'P0082', '66f2dd917518d.jpg'),
('I0643', 'P0082', '66f2dd9178786.jpg'),
('I0644', 'P0082', '66f2dd917b82d.jpg'),
('I0645', 'P0082', '66f2dd917e54c.jpg'),
('I0646', 'P0083', '66f2dda5e11c0.jpg'),
('I0647', 'P0083', '66f2dda5e78d7.jpg'),
('I0648', 'P0083', '66f2dda5eafc0.jpg'),
('I0649', 'P0083', '66f2dda5ee667.jpg'),
('I0650', 'P0083', '66f2dda5f16d8.jpg'),
('I0651', 'P0084', '66f2ddb6a6a04.jpg'),
('I0652', 'P0084', '66f2ddb6ad414.jpg'),
('I0653', 'P0084', '66f2ddb6b042e.jpg'),
('I0654', 'P0084', '66f2ddb6b3966.jpg'),
('I0655', 'P0085', '66f2ddc66e423.jpg'),
('I0656', 'P0085', '66f2ddc674dcf.jpg'),
('I0657', 'P0085', '66f2ddc676649.jpg'),
('I0658', 'P0085', '66f2ddc679578.jpg'),
('I0659', 'P0086', '66f2dddf828b0.jpg'),
('I0660', 'P0086', '66f2dddf85e1e.jpg'),
('I0661', 'P0086', '66f2dddf88c10.jpg'),
('I0662', 'P0086', '66f2dddf8bafe.jpg'),
('I0663', 'P0086', '66f2dddf8e90e.jpg'),
('I0664', 'P0087', '66f2ddf8db2ca.jpg'),
('I0665', 'P0087', '66f2ddf8df588.jpg'),
('I0666', 'P0087', '66f2ddf8e25e4.jpg'),
('I0667', 'P0087', '66f2ddf8e54df.jpg'),
('I0668', 'P0087', '66f2ddf8e8f58.jpg'),
('I0669', 'P0088', '66f2de0a6738d.jpg'),
('I0670', 'P0088', '66f2de0a6d9e0.jpg'),
('I0671', 'P0088', '66f2de0a7097c.jpg'),
('I0672', 'P0088', '66f2de0a7388f.jpg'),
('I0673', 'P0088', '66f2de0a76e72.jpg'),
('I0674', 'P0089', '66f2de2587ca3.jpg'),
('I0675', 'P0089', '66f2de258e822.jpg'),
('I0676', 'P0089', '66f2de25917b0.jpg'),
('I0677', 'P0089', '66f2de259444d.jpg'),
('I0678', 'P0089', '66f2de259750e.jpg'),
('I0679', 'P0090', '66f2de3e98222.jpg'),
('I0680', 'P0090', '66f2de3e9c804.jpg'),
('I0681', 'P0090', '66f2de3e9fbe7.jpg'),
('I0682', 'P0090', '66f2de3ea2e91.jpg'),
('I0683', 'P0090', '66f2de3ea5ea6.jpg'),
('I0684', 'P0091', '66f2de610ec22.jpg'),
('I0685', 'P0091', '66f2de6112c2e.jpg'),
('I0686', 'P0091', '66f2de61163b8.jpg'),
('I0687', 'P0091', '66f2de611945d.jpg'),
('I0688', 'P0091', '66f2de611c4eb.jpg'),
('I0689', 'P0092', '66f2de6fec770.jpg'),
('I0690', 'P0092', '66f2de6feff52.jpg'),
('I0691', 'P0092', '66f2de6ff2e99.jpg'),
('I0692', 'P0092', '66f2de700204c.jpg'),
('I0693', 'P0092', '66f2de7005534.jpg'),
('I0694', 'P0093', '66f2de8711f20.jpg'),
('I0695', 'P0093', '66f2de8716733.jpg'),
('I0696', 'P0093', '66f2de87199d5.jpg'),
('I0697', 'P0093', '66f2de871c887.jpg'),
('I0698', 'P0094', '66f2de9b06fb2.jpg'),
('I0699', 'P0094', '66f2de9b0a449.jpg'),
('I0700', 'P0094', '66f2de9b0d286.jpg'),
('I0701', 'P0094', '66f2de9b10585.jpg'),
('I0702', 'P0094', '66f2de9b13562.jpg'),
('I0703', 'P0095', '66f2dea89a532.jpg'),
('I0704', 'P0095', '66f2dea89ee68.jpg'),
('I0705', 'P0095', '66f2dea8a1d87.jpg'),
('I0706', 'P0095', '66f2dea8a4e7f.jpg'),
('I0707', 'P0095', '66f2dea8a7d97.jpg'),
('I0708', 'P0096', '66f2debcc0007.jpg'),
('I0709', 'P0096', '66f2debcc77f2.jpg'),
('I0710', 'P0096', '66f2debcca60e.jpg'),
('I0711', 'P0096', '66f2debccda9e.jpg'),
('I0712', 'P0096', '66f2debcd0e12.jpg'),
('I0713', 'P0097', '66f2dece594d6.jpg'),
('I0714', 'P0097', '66f2dece5cb3c.jpg'),
('I0715', 'P0097', '66f2dece5f7b9.jpg'),
('I0716', 'P0097', '66f2dece628ce.jpg'),
('I0717', 'P0097', '66f2dece6589d.jpg'),
('I0718', 'P0098', '66f2dedf52d8f.jpg'),
('I0719', 'P0098', '66f2dedf5675e.jpg'),
('I0720', 'P0098', '66f2dedf59fec.jpg'),
('I0721', 'P0098', '66f2dedf5d336.jpg'),
('I0722', 'P0099', '66f2deef07417.jpg'),
('I0723', 'P0099', '66f2deef0a9da.jpg'),
('I0724', 'P0099', '66f2deef0da45.jpg'),
('I0725', 'P0099', '66f2deef10fcf.jpg'),
('I0726', 'P0100', '66f2defd00a4b.jpg'),
('I0727', 'P0100', '66f2defd047c2.jpg'),
('I0728', 'P0100', '66f2defd079a5.jpg'),
('I0729', 'P0100', '66f2defd0ae81.jpg');

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
(1, '1@gmail.com', '652699', '2024-09-24 13:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact_num` varchar(20) NOT NULL,
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
  `remember_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `contact_num`, `gender`, `birthday`, `photo`, `role`, `status`, `failed_attempts`, `last_failed_attempt`, `banned_until`, `last_login_time`, `login_count`, `last_login_event_time`, `deactivated_at`, `remember_token`, `remember_token_expiry`) VALUES
('U0001', 'Root User', 'root@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1234567890', 'Male', '1980-01-01', '66f257846220e.jpg', 'Root', 'Active', 0, NULL, NULL, '2024-09-24 21:24:57', 1, '2024-09-24 21:24:57', NULL, NULL, NULL),
('U0002', 'Alice Johnson', '1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '012-1231234', 'Male', '1990-02-02', '66f25797c1ebe.jpg', 'Admin', 'Active', 0, NULL, NULL, '2024-09-24 18:26:25', 1, '2024-09-24 18:26:25', NULL, NULL, NULL),
('U0003', 'Bob Smith', '2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '012-0987891', 'Male', '1991-03-03', '66f257a569d3b.jpg', 'Admin', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0004', 'Carol Davis', '3@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '013-0231412', 'Female', '1992-04-04', '66f257b080313.jpg', 'Admin', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0005', 'David Wilson', '4@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '011-23134312', 'Male', '1993-05-05', '66f257c414165.jpg', 'Admin', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0006', 'Eva Brown', '5@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '019-0231123', 'Female', '1994-06-06', '66f257cf7d404.jpg', 'Admin', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0007', 'Frank Green', 'frank@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '012-3123888', 'Female', '1995-07-07', '66f257dd53d57.jpg', 'Member', 'Active', 0, NULL, NULL, '2024-09-24 23:48:39', 1, '2024-09-24 23:48:39', NULL, NULL, NULL),
('U0008', 'Grace Lee', 'grace@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '012-3124123', 'Male', '1996-08-08', '66f257ec73679.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0009', 'Henry Clark', 'henry@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '015-2314441', 'Female', '1997-09-09', '66f257fea2aec.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0010', 'Ivy Harris', 'ivy@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '019-0992123', 'Male', '1998-10-10', '66f2581176c70.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0011', 'Jack Walker', 'jack@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '016-1231333', 'Male', '1999-11-11', '66f2582147de4.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0012', 'Karen King', 'karen@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '014-0213887', 'Female', '2000-12-12', '66f258403757f.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0013', 'Liam Young', 'liam@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '014-0988123', 'Female', '2001-01-13', '66f2584fa7389.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0014', 'Mia Perez', 'mia@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '019-0987771', 'Male', '2002-02-14', '66f2586f8e879.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0015', 'Noah Hall', 'noah@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '017-0912334', 'Male', '2003-03-15', '66f2587c2fac9.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0016', 'Olivia Allen', 'olivia@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '014-1230999', 'Female', '2004-04-16', '66f25889216ad.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0017', 'Paul Wright', 'paul@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '018-8887322', 'Male', '2005-05-17', '66f25895c57db.jpg', 'Member', 'Banned', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0018', 'Quinn Scott', 'quinn@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '014-1299874', 'Male', '2006-06-18', '66f258a2d8c71.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0019', 'Ryan Green', 'ryan@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '016-6671231', 'Female', '2007-07-19', '66f258b2871ee.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0020', 'Sophia Nelson', 'sophia@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '014-2317741', 'Male', '2008-08-20', '66f258be6f62e.jpg', 'Member', 'Active', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0021', 'Thomas Carter', 'thomas@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '011-23111123', 'Male', '2009-09-21', '66f258cad6869.jpg', 'Member', 'Banned', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0022', 'Uma Reed', 'uma@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '011-23449876', 'Female', '2010-10-22', '66f258da437b5.jpg', 'Member', 'Banned', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0023', 'Victor Cooper', 'victor@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '013-1333091', 'Female', '2011-11-23', '66f258e78c317.jpg', 'Member', 'Banned', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0024', 'Wendy Murphy', 'wendy@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '019-9822101', 'Female', '2012-12-24', '66f258ff35465.jpg', 'Member', 'Banned', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0025', 'Xander Price', 'xander@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '012-2319881', 'Male', '2013-01-25', '66f25909994cc.jpg', 'Member', 'Banned', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
('U0026', 'Yara King', 'yara@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '019-2311231', 'Female', '2014-02-26', '66f2591de1fc9.jpg', 'Member', 'Banned', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `wallet_id` varchar(5) NOT NULL,
  `PIN` int(11) NOT NULL,
  `user_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`image_id`);

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
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`wallet_id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
