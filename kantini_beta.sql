-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2014 at 04:03 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kantini_beta`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '{"admin":1,"users":1}', '2014-06-26 09:10:33', '2014-06-26 09:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(10) unsigned NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
`id` int(11) NOT NULL,
  `creator_username` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `organization_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `place` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_contact` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `creator_username`, `name`, `organization_date`, `place`, `auth`, `auth_contact`, `price`, `message`, `pass`, `created_at`, `updated_at`) VALUES
(10, 'barantr90', 'Deneme Etkinliği', '2014-07-18 14:01:58', 'Anadoluhisarı', 'Baran Şengül', '0531 722 32 21', 10, 'Bu bir deneme etkinliğidir.', 1, '2014-07-18 10:42:03', '2014-07-18 11:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post` text COLLATE utf8_unicode_ci NOT NULL,
  `member` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `username`, `gender`, `post`, `member`, `created_at`, `updated_at`) VALUES
(11, 'barantr90', 'male', 'lorem ipsum dolar sit amet.', 1, '2014-07-18 10:40:11', '2014-07-18 10:40:11'),
(12, 'dilem', 'female', 'lorem ipsum dolar sit amet. lorem ipsum dolar sit amet. lorem ipsum dolar sit amet. ', 1, '2014-07-18 11:00:35', '2014-07-18 11:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `twitter_username` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram_username` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `bio`, `twitter_username`, `instagram_username`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, '2014-07-18 13:36:26', '0000-00-00 00:00:00'),
(7, 9, 'Baran', 'Şengül', '', '', '', '2014-07-18 13:59:58', '2014-07-18 10:59:58'),
(8, 10, NULL, NULL, NULL, NULL, NULL, '2014-07-18 10:37:08', '2014-07-18 10:37:08'),
(9, 11, NULL, NULL, NULL, NULL, NULL, '2014-07-18 10:37:23', '2014-07-18 10:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(4) NOT NULL DEFAULT '0',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(11, 1, '::1', 0, 0, 0, NULL, NULL, NULL),
(12, 9, '::1', 0, 0, 0, NULL, NULL, NULL),
(13, 10, '::1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(4) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `school`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@kantini.com', '$2y$10$yyC5B2bRfV58L.t..uiVLusm26eyEnnOPX1ZxNQ37Mp.1HNnArqoC', '{"admin":1}', 1, NULL, NULL, '2014-07-18 14:01:29', '$2y$10$SLzQdnJjgrNsoti8fNxNI.XFdvLaTw/31fpsbeuiX1d7I/wzjZfHG', NULL, '1', 'male', '2014-07-18 10:27:08', '2014-07-18 11:01:29'),
(9, 'barantr90', 'baransengul@outlook.com', '$2y$10$58npj0rzba3ZeJfoGoIBQuRNxoAG1ngGwXtwQUMldAt4nKEY2u4/y', NULL, 1, NULL, NULL, '2014-07-18 13:51:26', '$2y$10$jsn.dYJ4ZdOXcs2QTeHST.KwuS27ht6l8LMHock/fDzGX8npHKDxm', NULL, '1', 'male', '2014-07-18 10:36:57', '2014-07-18 10:51:26'),
(10, 'dilem', 'dilembadali@hotmail.com', '$2y$10$v4ECX22C7cMSgzfDEl0oiOcoFTdSVi1/4qMxmRhgXGEwwnisinI66', NULL, 1, NULL, NULL, '2014-07-18 14:00:08', '$2y$10$lVo8aLLANvrZo2PKJ6f82uCd5yI6wrD2N3MkEqxe1.BvEDyZTcc5u', NULL, '2', 'female', '2014-07-18 10:37:08', '2014-07-18 11:00:08'),
(11, 'bora', 'boradan@hotmail.com', '$2y$10$.C.q2rINGsSR9E.R/bN8c.HQoJ/aYA9ww/G6nmunPPpxwF06JysEq', NULL, 1, NULL, NULL, NULL, NULL, NULL, '1', 'male', '2014-07-18 10:37:23', '2014-07-18 10:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `throttle`
--
ALTER TABLE `throttle`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD KEY `users_activation_code_index` (`activation_code`), ADD KEY `users_reset_password_code_index` (`reset_password_code`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `throttle`
--
ALTER TABLE `throttle`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
