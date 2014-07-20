-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost:8889
-- Üretim Zamanı: 20 Tem 2014, 18:59:36
-- Sunucu sürümü: 5.5.34
-- PHP Sürümü: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `kantini_beta`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `comment_username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `comment_username`, `post_id`, `comment`, `created_at`, `updated_at`) VALUES
(4, 18, 'dilem', 16, 'dilem kendi gonderisine yorum yapiyor', '2014-07-20 11:24:20', '2014-07-20 11:24:20'),
(6, 17, 'barantr90', 16, 'yorum yapmasam olur mu yaaa', '2014-07-20 12:37:26', '2014-07-20 12:37:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `groups`
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
-- Tablo döküm verisi `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '{"admin":1,"users":1}', '2014-06-26 09:10:33', '2014-06-26 09:10:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`id`, `fullname`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(2, 'Baran Şengül', 'baransengul@outlook.com', 'Tebrik', 'Bravo size!', '2014-07-20 12:50:48', '2014-07-20 12:50:48');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Tablo döküm verisi `organizations`
--

INSERT INTO `organizations` (`id`, `creator_username`, `name`, `organization_date`, `place`, `auth`, `auth_contact`, `price`, `message`, `pass`, `created_at`, `updated_at`) VALUES
(10, 'barantr90', 'Deneme Etkinliği', '2014-07-18 14:01:58', 'Anadoluhisarı', 'Baran Şengül', '0531 722 32 21', 10, 'Bu bir deneme etkinliğidir.', 1, '2014-07-18 10:42:03', '2014-07-18 11:01:58');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts`
--

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post` text COLLATE utf8_unicode_ci NOT NULL,
  `member` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Tablo döküm verisi `posts`
--

INSERT INTO `posts` (`id`, `username`, `gender`, `post`, `member`, `created_at`, `updated_at`) VALUES
(14, 'barantr90', 'male', 'lorem ipsum dolar sit amet.', 1, '2014-07-20 11:13:20', '2014-07-20 11:13:20'),
(15, 'barantr90', 'male', 'bir varmis bir yokmus', 1, '2014-07-20 11:13:30', '2014-07-20 11:13:30'),
(16, 'dilem', 'female', 'deneme gonderisi\r\n', 1, '2014-07-20 11:19:33', '2014-07-20 11:19:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `twitter_username` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram_username` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Tablo döküm verisi `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `bio`, `twitter_username`, `instagram_username`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'Admin', 'Kantini.com Admini', 'YOK', 'YOK', '2014-07-20 15:47:43', '2014-07-20 12:47:43'),
(15, 17, 'Baran', 'Şengül', 'Merhaba ben Baran!', 'baransngl', 'baransengul', '2014-07-20 11:13:06', '2014-07-20 11:13:06'),
(16, 18, 'dilem', 'badalioglu', '', '', '', '2014-07-20 11:14:01', '2014-07-20 11:14:01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `throttle`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Tablo döküm verisi `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(11, 1, '::1', 0, 0, 0, NULL, NULL, '2014-07-20 12:43:01'),
(16, 17, '::1', 0, 0, 0, NULL, NULL, '2014-07-20 12:46:54'),
(17, 18, '::1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `school`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@kantini.com', '$2y$10$yyC5B2bRfV58L.t..uiVLusm26eyEnnOPX1ZxNQ37Mp.1HNnArqoC', '{"admin":1}', 1, NULL, NULL, '2014-07-20 15:47:14', '$2y$10$pKnoHAa.mt4ZIaVd08FMO.1Pn28glSvMhnYleMdyiUtEzCBltTIIu', NULL, 'Beykent Üniversitesi', 'male', '2014-07-18 10:27:08', '2014-07-20 12:47:14'),
(17, 'barantr90', 'baransengul@outlook.com', '$2y$10$OEVzz8qc2uq5jHnlUSc2w.xUnTqa4RY0bKKyUR1fMY2gGTCTX0cGu', NULL, 1, NULL, NULL, '2014-07-20 16:45:03', '$2y$10$RilnadVkKlQxKI6IKH30Pul17iFBG6kATHvPf09L6v40TahJWE4nW', NULL, 'Beykent Üniversitesi', 'male', '2014-07-20 11:13:06', '2014-07-20 13:45:03'),
(18, 'dilem', 'dilembadali@hotmail.com', '$2y$10$.hY0OnYcNvdvD.zSmBR6g.NIWI.CLiV/5fS1ENVl2n5jgjKqvPETq', NULL, 1, NULL, NULL, '2014-07-20 14:15:30', '$2y$10$VzreEfgcZJJQV5DeijmV5Ornp379Tq4dJxKgBkw/Z763IjeyIIL/.', NULL, 'Bahçeşehir Üniversitesi', 'female', '2014-07-20 11:14:01', '2014-07-20 11:15:30');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users_groups`
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
