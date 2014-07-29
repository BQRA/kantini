-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 29, 2014 at 12:21 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kantini_v02`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commenter` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `member` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `commenter`, `member`, `post_id`, `comment`, `created_at`, `updated_at`) VALUES
(22, 'barantr90', 1, 32, 'yorum yorum yorum', '2014-07-27 08:12:54', '2014-07-27 08:12:54'),
(23, 'misafir49470', 0, 32, 'yorum yapiyorum', '2014-07-27 08:13:09', '2014-07-27 08:13:09'),
(24, 'barantr90', 1, 32, 'denem yorumu', '2014-07-27 08:17:29', '2014-07-27 08:17:29'),
(26, 'misafir6320', 0, 33, 'asdasdasdasdasdasda', '2014-07-27 16:36:09', '2014-07-27 16:36:09'),
(27, 'misafir74560', 0, 32, 'deneme deneme', '2014-07-27 19:39:37', '2014-07-27 19:39:37'),
(28, 'barantr90', 1, 33, 'dneme deneme deneme', '2014-07-28 12:57:30', '2014-07-28 12:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '{"admin":1,"users":1}', '2014-06-26 09:10:33', '2014-06-26 09:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liker` varchar(50) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=77 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `liker`, `post_id`, `ip_address`, `created_at`, `updated_at`) VALUES
(72, 'misafir90758', 38, '::1', '2014-07-27 20:04:21', '2014-07-27 20:04:21'),
(73, 'barantr90', 38, '::1', '2014-07-27 20:05:27', '2014-07-27 20:05:27'),
(74, 'barantr90', 37, '::1', '2014-07-28 12:54:19', '2014-07-28 12:54:19'),
(75, 'barantr90', 33, '::1', '2014-07-28 12:57:21', '2014-07-28 12:57:21'),
(76, 'misafir61583', 36, '::1', '2014-07-29 07:18:49', '2014-07-29 07:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `post` text COLLATE utf8_unicode_ci,
  `member` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `org_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_date` timestamp NULL DEFAULT NULL,
  `org_address` text COLLATE utf8_unicode_ci,
  `org_map` text COLLATE utf8_unicode_ci,
  `org_auth` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_auth_contact` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_price` int(11) DEFAULT NULL,
  `org_message` text COLLATE utf8_unicode_ci,
  `org_photo` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `username`, `gender`, `post`, `member`, `type`, `org_name`, `org_date`, `org_address`, `org_map`, `org_auth`, `org_auth_contact`, `org_price`, `org_message`, `org_photo`, `created_at`, `updated_at`) VALUES
(32, 'barantr90', 'male', 'naber bebek?', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-27 08:11:25', '2014-07-27 08:11:25'),
(33, 'barantr90', 'male', 'lorem ipsumd olar sit amet', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-27 08:42:56', '2014-07-27 08:42:56'),
(35, 'barantr90', 'male', NULL, 1, 1, 'deneme', '0000-00-00 00:00:00', 'deneme', NULL, 'deneme', 'deneme', 0, 'deneme', NULL, '2014-07-27 09:11:32', '2014-07-27 09:11:32'),
(36, 'dilem', 'female', 'gonderi gonderi', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-27 14:27:36', '2014-07-27 14:27:36'),
(37, 'misafir6320', 'male', 'habaubgadasdkjasda', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-27 16:07:23', '2014-07-27 16:07:23'),
(38, 'misafir6320', 'female', 'misafir gonderisi misafir', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-27 16:28:33', '2014-07-27 16:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instagram_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `full_name`, `twitter_username`, `instagram_username`, `facebook_username`, `avatar`, `created_at`, `updated_at`) VALUES
(3, 4, 'Baran Şengül', 'baransngl', 'baransengul', '', 'barantr90.jpg', '2014-07-22 07:22:10', '2014-07-28 14:04:41'),
(4, 5, 'Baran Şengül', 'baransngl', 'baransengul', '', 'dilem.jpg', '2014-07-22 09:00:26', '2014-07-28 13:39:25'),
(6, 7, 'Bora Dan', '', '', '', 'guest', '2014-07-26 08:30:37', '2014-07-27 11:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(4) NOT NULL DEFAULT '0',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(2, 4, '::1', 0, 0, 0, NULL, NULL, NULL),
(3, 5, '::1', 0, 0, 0, NULL, NULL, NULL),
(4, 6, '::1', 0, 0, 0, NULL, NULL, NULL),
(5, 7, '::1', 0, 0, 0, NULL, NULL, NULL),
(6, 23, '::1', 0, 0, 0, NULL, NULL, NULL),
(7, 25, '::1', 0, 0, 0, NULL, NULL, NULL),
(8, 30, '::1', 0, 0, 0, NULL, NULL, NULL),
(9, 31, '::1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(4) NOT NULL DEFAULT '1',
  `school` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `permissions`, `activated`, `school`, `gender`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `created_at`, `updated_at`) VALUES
(4, 'baransengul@outlook.com', 'barantr90', '$2y$10$7ZG0hFFx616GROcsXxCeNOcYR8Jjn/u4CjVkN8T9q8CwprZVRV8Ym', '{"admin":1}', 1, 'Beykent', 'male', NULL, NULL, '2014-07-28 16:52:16', '$2y$10$OCeOpq53aZYZckw7Qk7WCem5bHQWT.vOEOord1/Dk.SBKnbvSek92', NULL, '2014-07-22 07:22:10', '2014-07-28 13:52:16'),
(5, 'dilembadali@hotmail.com', 'dilem', '$2y$10$CaaZpfKx2Si0XET1HrEYVeK34U7A/apzg9rUA3PjaMX.zDIJA4xo2', NULL, 1, 'Bahçeşehir', 'female', NULL, NULL, '2014-07-27 20:39:40', '$2y$10$VGqvSSwel/Ts917KAdeFNeGzw0Uljtnm1uGX49ZTnJdkot/XxM5lq', NULL, '2014-07-22 09:00:26', '2014-07-27 17:39:40'),
(7, 'boradan@kantini.com', 'bora', '$2y$10$5R1WWzzQDD7LjFgpWS.xo.z.nvyCBTJXY5VyyAvD.YUZxzAL.e.2q', NULL, 1, 'Beykent', 'male', NULL, NULL, '2014-07-27 01:46:12', '$2y$10$L6M.QGfwhnj3ycVCD3bN/.yNqPhBZK37.WFpqrSDLR1qxs3MO9e2W', NULL, '2014-07-26 08:30:37', '2014-07-26 22:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
