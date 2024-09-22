-- Database Backup
CREATE DATABASE IF NOT EXISTS `web_ass`;
USE `web_ass`;


CREATE TABLE `product_image` (
  `image_id` varchar(6) NOT NULL,
  `product_id` varchar(6) NOT NULL,
  `product_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `shippers` (
  `ship_id` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `ship_method` varchar(50) NOT NULL,
  `status` enum('Pending','Cancelled','Delivered','Shipped','Arrive') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`ship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `verification_code` char(6) NOT NULL,
  `expire` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`verification_code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
  `contact_num` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0001', 'P0031', '66ebe8a3f0a79.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0002', 'P0031', '66ebe8a4002ae.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0003', 'P0031', '66ebe9fec7d7c.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0004', 'P0031', '66ebea18d0e72.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0008', 'P0032', '66ebee56bc4c0.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0012', 'P0032', '66ebef650788d.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0013', 'P0030', '66ece49eecf43.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0014', 'P0030', '66ece127be741.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0015', 'P0030', '66ece127c2467.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0016', 'P0031', '66ece8b801f2b.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0017', 'P0031', '66ece8b81a25f.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0018', 'P0031', '66ece8b84469d.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0019', 'P0032', '66ece8dbd1a66.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0020', 'P0032', '66ece8dbd8d54.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0021', 'P0032', '66ece8dbe48fc.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0022', 'P0033', '66ece90b24821.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0023', 'P0033', '66ece90b2a089.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0024', 'P0033', '66ece90b3391d.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0025', 'P0034', '66ecea5a69c88.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0026', 'P0034', '66ecea5a6f7f6.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0027', 'P0034', '66ecea5a7b7f3.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0028', 'P0035', '66eceaf5bf794.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0029', 'P0035', '66eceaf5c4919.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0030', 'P0035', '66eceaf5d0ace.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0031', 'P0036', '66eceb66287fc.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0032', 'P0036', '66eceb662cd9b.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0033', 'P0036', '66eceb6637c40.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0034', 'P0036', '66eceb6643ac3.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0035', 'P0030', '66ede590a4d3b.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0036', 'P0030', '66ede590afe32.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0037', 'P0030', '66ede590bc020.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0038', 'P0030', '66ede590c8507.jpg');
INSERT INTO product_image (image_id, product_id, product_photo) VALUES ('I0039', 'P0031', '66ede5bed758f.jpg');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0001', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Penang', 'NINJA VAN', 'ewe', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0002', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Penang', 'POS LAJU', 'ewe', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0003', 'Jalan 5/5, Section 5, Section 6, Petaling Jaya, Petaling, Selangor, 46990, Malaysia Penang', 'POS LAJU', 'ewe', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0004', 'Jalan Pantai Permai Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'ewf', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0005', 'Jalan Pantai Permai 12, Taman Desa Kerinchi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'ewf', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0006', 'chi, Pantai Dalam, Kuala Lumpur, 59200, Malaysia Putrajaya', 'NINJA VAN', 'ewf', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0007', 'Jalan Penchala, Putrajaya', 'POS LAJU', 'ewf', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0008', '12, Jalan 10/12, Section 10, Petaling Jaya, Petaling, Selangor, 46661, Malaysia Kelantan', 'POS LAJU', 'ewf', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0009', '9, Jalan 10/4, Section 10, Petaling Jaya, Petaling, Selangor, 46661, Malaysia Putrajaya', 'J&T', 'ewf', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0010', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0011', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0012', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0013', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0014', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0015', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0016', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0017', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0018', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0019', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0020', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'wdwd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0021', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'wdwd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0022', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'wdwd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0023', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'wdwd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0024', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'POS LAJU', 'wdwd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0025', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'wdwd', 'pick', 'Pending');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0026', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Selangor', 'NINJA VAN', 'wed', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0027', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Terengganu', 'NINJA VAN', 'ewf', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0028', 'Jalan Metro Prima, Kepong Bahru, Kepong, Kuala Lumpur, 52100, Malaysia Selangor', 'NINJA VAN', 'sdf', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0029', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Kuala Lumpur,Wilayah Persekutuan', 'NINJA VAN', 'sdf', 'pick', 'Arrive');
INSERT INTO shippers (ship_id, address, company_name, phone, ship_method, status) VALUES ('S0030', 'AEON Metro Prima Shopping Centre, Jalan Kepong, Kepong Garden, Kepong, Kuala Lumpur, 52100, Malaysia Terengganu', 'NINJA VAN', 'sdf', 'pick', 'Pending');
INSERT INTO token (id, email, verification_code, expire) VALUES ('1', 'howjj-wm22@student.tarc.edu.my', '392542', '2024-09-22 22:10:54');
INSERT INTO token (id, email, verification_code, expire) VALUES ('2', 'test@gmail.com', '734850', '2024-09-22 22:13:25');
INSERT INTO token (id, email, verification_code, expire) VALUES ('3', 'howjj-wm22@student.tarc.edu.my', '194658', '2024-09-22 22:32:03');
INSERT INTO token (id, email, verification_code, expire) VALUES ('4', 'jjoscar91165@gmail.com', '155970', '2024-09-22 22:32:16');
INSERT INTO token (id, email, verification_code, expire) VALUES ('5', 'howjj-wm22@student.tarc.edu.my', '571974', '2024-09-22 22:36:44');
INSERT INTO token (id, email, verification_code, expire) VALUES ('6', 'howjj-wm22@student.tarc.edu.my', '736476', '2024-09-22 22:37:48');
INSERT INTO token (id, email, verification_code, expire) VALUES ('7', 'howjj-wm22@student.tarc.edu.my', '307891', '2024-09-22 22:38:01');
INSERT INTO token (id, email, verification_code, expire) VALUES ('8', 'howjj-wm22@student.tarc.edu.my', '854664', '2024-09-22 22:38:45');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0001', 'Root', '1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2004-02-03', '66e16e9f590ec.jpg', 'Root', 'Active', '0', '2024-09-22 20:58:51', '', '2024-09-22 22:39:49', '1', '2024-09-22 22:39:49', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-3316902');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0002', 'William Jones', 'william.j@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1997-09-30', '66e164f231f73.jpg', 'Member', 'Banned', '0', '2024-09-06 13:20:11', '0000-00-00 00:00:00', '2024-09-07 14:45:09', '1', '2024-09-07 14:45:09', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-0123123');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0003', 'Ava Garcia', 'ava.g@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2000-01-21', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-08 16:24:47', '0000-00-00 00:00:00', '2024-09-10 11:02:54', '1', '2024-09-10 11:02:54', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-5828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0004', 'James Martinez', 'james.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1994-08-17', '66e164f231f73.jpg', 'Member', 'Banned', '0', '2024-09-14 08:22:13', '0000-00-00 00:00:00', '2024-09-15 17:00:10', '1', '2024-09-15 17:00:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-6828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0005', 'Sophia Anderson', 'sophia.a@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-06-13', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-13 17:55:22', '0000-00-00 00:00:00', '2024-09-14 12:45:10', '1', '2024-09-14 12:45:10', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-7828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0006', 'Lucas White', 'lucas.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1998-05-12', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-10 18:33:27', '0000-00-00 00:00:00', '2024-09-12 16:20:50', '1', '2024-09-12 16:20:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-8828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0007', 'Mia Clark', 'mia.c@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1996-04-28', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-07 21:10:11', '0000-00-00 00:00:00', '2024-09-09 10:15:35', '1', '2024-09-09 10:15:35', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-9828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0008', 'Benjamin Lewis', 'benjamin.l@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1993-10-01', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 17:44:30', '0000-00-00 00:00:00', '2024-09-18 17:11:12', '1', '2024-09-18 17:11:12', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-1128912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0009', 'Ella Rodriguez', 'ella.r@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2001-12-12', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-09 13:00:20', '', '2024-09-22 09:09:50', '1', '2024-09-22 09:09:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0010', 'Henry Walker', 'henry.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1995-11-27', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 14:45:13', '', '2024-09-22 00:15:02', '1', '2024-09-22 00:15:02', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0011', 'Amelia Young', 'amelia.y@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-08-14', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-12 20:02:16', '0000-00-00 00:00:00', '2024-09-15 17:55:32', '1', '2024-09-15 17:55:32', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0012', 'Admin', '2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e164f231f73.jpg', 'Admin', 'Active', '0', '2024-09-18 12:09:10', '', '2024-09-20 17:18:58', '1', '2024-09-20 17:18:58', '2024-09-10 12:11:54', '', '0000-00-00 00:00:00', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0013', 'Ethan Harris', 'ethan.h@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1994-07-07', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-07 16:33:10', '0000-00-00 00:00:00', '2024-09-08 17:21:50', '1', '2024-09-08 17:21:50', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0014', 'Harper Green', 'harper.g@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1999-12-05', '66e164f231f73.jpg', 'Member', 'Banned', '0', '2024-09-06 10:12:00', '0000-00-00 00:00:00', '2024-09-07 09:11:20', '1', '2024-09-07 09:11:20', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0015', 'Alexander Lee', 'alexander.l@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2000-03-08', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-13 11:00:15', '', '2024-09-22 13:15:19', '1', '2024-09-22 13:15:19', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0016', 'Isabella Scott', 'isabella.s@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1996-10-23', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-11 12:15:11', '', '2024-09-22 08:04:34', '1', '2024-09-22 08:04:34', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0017', 'Daniel Carter', 'daniel.c@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-02-18', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-12 09:40:23', '', '2024-09-22 20:03:08', '1', '2024-09-22 20:03:08', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0018', 'Emily King', 'emily.k@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2001-11-20', '66e164f231f73.jpg', 'Member', 'Active', '0', '2024-09-10 08:33:18', '0000-00-00 00:00:00', '2024-09-12 10:00:22', '1', '2024-09-12 10:00:22', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0019', 'Emily Johnson', '3@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1992-12-05', '66dfc553b0989.jpg', 'Admin', 'Active', '0', '2024-09-18 12:06:06', '0000-00-00 00:00:00', '2024-09-18 12:07:53', '1', '2024-09-18 12:07:53', '2024-09-07 17:05:09', '', '0000-00-00 00:00:00', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0020', 'Micky Way', '4@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1991-10-16', '66e017b2e5a89.jpg', 'Admin', 'Active', '0', '2024-09-10 12:44:20', '0000-00-00 00:00:00', '2024-09-11 16:02:55', '1', '2024-09-11 16:02:55', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0021', 'Sophia Davis', '5@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-09-10', '66e92306b357a.jpg', 'Member', 'Banned', '0', '2024-09-10 12:43:33', '0000-00-00 00:00:00', '2024-09-10 12:46:10', '1', '2024-09-10 12:46:10', '2024-09-18 11:59:48', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0022', 'Liam Brown', 'liam.b@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1993-05-18', '66e82a2818964.jpg', 'Member', 'Banned', '0', '2024-09-07 14:20:10', '0000-00-00 00:00:00', '2024-09-10 10:01:23', '1', '2024-09-10 10:01:23', '2024-09-18 11:57:41', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0023', 'Olivia Miller', 'olivia.m@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1998-07-25', '66e82a2fd5a52.jpg', 'Member', 'Active', '0', '2024-09-12 11:15:49', '', '2024-09-22 22:22:37', '1', '2024-09-22 22:22:37', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0024', 'Noah Smith', 'noah.s@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1996-11-02', '66e82a372cc9f.jpg', 'Member', 'Banned', '0', '2024-09-08 09:30:17', '0000-00-00 00:00:00', '2024-09-09 12:45:02', '1', '2024-09-09 12:45:02', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry, contact_num) VALUES ('U0025', 'Emma Wilson', 'emma.w@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1999-03-15', '66ddc8a6f2098.jpg', 'Member', 'Active', '0', '2024-09-13 15:21:55', '0000-00-00 00:00:00', '2024-09-15 16:34:22', '1', '2024-09-15 16:34:22', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '012-2828912');
