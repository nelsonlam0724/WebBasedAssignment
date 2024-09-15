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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('6', 'Root', '1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e16e9f590ec.jpg', 'Root', 'Active', '0', '2024-09-10 12:49:23', '', '2024-09-15 21:21:16', '1', '2024-09-15 21:21:16', '0000-00-00 00:00:00', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('7', 'Admin', '2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '2024-09-11', '66e164f231f73.jpg', 'Admin', 'Active', '0', '2024-09-07 17:04:47', '', '2024-09-15 21:11:44', '1', '2024-09-15 21:11:44', '2024-09-10 12:11:54', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('8', 'Emily Johnson', '3@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1992-12-05', '66dfc553b0989.jpg', 'Admin', 'Active', '0', '2024-09-05 22:04:02', '0000-00-00 00:00:00', '2024-09-07 17:05:00', '1', '2024-09-07 17:05:00', '2024-09-07 17:05:09', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('9', 'Micky Way', 'howjj-wm22@student.tarc.edu.my', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1991-10-16', '66e017b2e5a89.jpg', 'Admin', 'Active', '0', '2024-09-10 12:44:20', '', '2024-09-11 16:02:55', '1', '2024-09-11 16:02:55', '', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('10', 'Sophia Davis', '5@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1995-09-10', '66d915f72602f.jpg', 'Member', 'Active', '0', '2024-09-10 12:43:33', '', '2024-09-10 12:46:10', '1', '2024-09-10 12:46:10', '2024-09-10 12:30:02', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('14', 'pui', '101@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1991-11-11', '66d8270ce4079.jpg', 'Member', 'Active', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('15', 'Allen', 'all@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '1992-10-08', '66d8273379b6b.jpg', 'Member', 'Active', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('16', 'abc', 'abc@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'Other', '2024-09-09', '66d835c345a7f.jpg', 'Member', 'Active', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('100', 'test1', '100@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Female', '1991-10-20', '66d91c495c5a9.jpg', 'Member', 'Banned', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('114', 'Hoe', '11313@gmail.com', '05fe7461c607c33229772d402505601016a7d0ea', 'Male', '2024-09-05', '66da81782e4de.jpg', 'Member', 'Banned', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2024-09-06 12:14:38', '1', '2024-09-06 12:14:38', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('117', 'Hoe', 'test@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'Male', '2024-09-21', '66e1449837970.jpg', 'Member', 'Active', '0', '', '', '', '0', '', '', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('118', 'lim kah lok', 'h21322@student.tarc.edu.my', '601f1889667efaebb33b8c12572835da3f027f78', 'Male', '2024-09-21', '66e14bb04d9d4.jpg', 'Member', 'Active', '0', '', '', '', '0', '', '', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('119', 'Hoe', '123m22@student.tarc.edu.my', '601f1889667efaebb33b8c12572835da3f027f78', 'Female', '2024-09-10', '66e1599d38a7d.jpg', 'Member', 'Active', '0', '', '', '', '0', '', '', '', '');
INSERT INTO user (user_id, name, email, password, gender, birthday, photo, role, status, failed_attempts, last_failed_attempt, banned_until, last_login_time, login_count, last_login_event_time, deactivated_at, remember_token, remember_token_expiry) VALUES ('120', 'test123', 'test23@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Male', '2010-02-18', '66e165a356356.jpg', 'Member', 'Active', '0', '', '', '', '0', '', '', '', '');
