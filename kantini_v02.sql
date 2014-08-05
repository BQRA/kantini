-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 05 Ağu 2014, 11:14:04
-- Sunucu sürümü: 5.6.16
-- PHP Sürümü: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `kantini_v02`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(10) unsigned NOT NULL,
  `commenter` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `commenter`, `gender`, `member`, `post_id`, `comment`, `type`, `created_at`, `updated_at`) VALUES
(17, 'misafir10692', NULL, 0, 30, 'misafir yorum denemesi', NULL, '2014-08-04 08:27:09', '2014-08-04 08:27:09'),
(18, 'barantr90', 'male', 1, 30, 'üye olarak yorum denemesi', 'dedikod', '2014-08-04 08:27:31', '2014-08-04 08:27:31'),
(19, 'barantr90', 'male', 1, 29, 'yorum yorum yorum', 'dedikod', '2014-08-04 08:41:50', '2014-08-04 08:41:50'),
(20, 'barantr90', 'male', 1, 29, 'lorem ipsum dolar sit amet.', 'dedikod', '2014-08-04 08:41:59', '2014-08-04 08:41:59'),
(21, 'dilem', 'female', 1, 30, 'bence de süper bir site!', 'dedikod', '2014-08-05 04:24:42', '2014-08-05 04:24:42'),
(22, 'dilem', 'female', 1, 29, 'deneme yorumu', 'dedikod', '2014-08-05 05:34:30', '2014-08-05 05:34:30'),
(24, 'dilem', 'female', 1, 34, 'deneme deneme', 'event', '2014-08-05 05:43:28', '2014-08-05 05:43:28'),
(25, 'dilem', 'female', 1, 36, 'deneme 123', 'dedikod', '2014-08-05 05:48:11', '2014-08-05 05:48:11'),
(26, 'dilem', 'female', 1, 34, 'deneme 123', 'event', '2014-08-05 05:48:23', '2014-08-05 05:48:23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '{"admin":1,"users":1}', '2014-06-26 09:10:33', '2014-06-26 09:10:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
`id` int(11) NOT NULL,
  `liker` varchar(50) NOT NULL,
  `post_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `type` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Tablo döküm verisi `likes`
--

INSERT INTO `likes` (`id`, `liker`, `post_id`, `ip_address`, `type`, `created_at`, `updated_at`) VALUES
(50, 'misafir87477', 35, '::1', NULL, '2014-08-05 06:05:16', '2014-08-05 06:05:16'),
(51, 'barantr90', 36, '::1', 'dedikod', '2014-08-05 06:05:28', '2014-08-05 06:05:28'),
(52, 'barantr90', 30, '::1', 'dedikod', '2014-08-05 06:05:29', '2014-08-05 06:05:29'),
(53, 'barantr90', 29, '::1', 'dedikod', '2014-08-05 06:05:30', '2014-08-05 06:05:30'),
(54, 'barantr90', 34, '::1', 'event', '2014-08-05 06:05:32', '2014-08-05 06:05:32');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `post` text COLLATE utf8_unicode_ci,
  `member` int(11) NOT NULL,
  `type` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `org_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_date` timestamp NULL DEFAULT NULL,
  `org_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_map` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `org_auth` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_auth_contact` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_price` int(11) DEFAULT NULL,
  `org_message` text COLLATE utf8_unicode_ci,
  `org_photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Tablo döküm verisi `posts`
--

INSERT INTO `posts` (`id`, `username`, `gender`, `post`, `member`, `type`, `org_name`, `org_date`, `org_address`, `org_map`, `org_auth`, `org_auth_contact`, `org_price`, `org_message`, `org_photo`, `created_at`, `updated_at`) VALUES
(28, 'barantr90', 'male', 'In the previous lesson, we used Codeception to build a helpful command class generator', 1, 'dedikod', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', '2014-08-04 06:38:56', '2014-08-04 06:38:56'),
(29, 'barantr90', 'male', 'Been using Laravel for some time, and now feel ready to build a well-architected application from scratch? Excellent! Together, let''s build a light version of Facebook, called Larabook.', 1, 'dedikod', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', '2014-08-04 06:39:05', '2014-08-04 06:39:05'),
(30, 'barantr90', 'male', '#twitter süper bir site!..', 1, 'dedikod', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', '2014-08-04 06:40:22', '2014-08-04 06:40:22'),
(34, 'barantr90', 'male', NULL, 1, 'event', 'deneme', '0000-00-00 00:00:00', '', '', '', '', 0, '', 'barantr90_$2y$10$1yEyY5d85DS3861KrQY91uQaJGdYiwAimyVy4vr.jpqI6Ui85rkwa.jpg', '2014-08-05 04:22:51', '2014-08-05 04:22:51'),
(35, 'dilem', 'female', 'lorem ipsum dolar sit amet.', 1, 'dedikod', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', '2014-08-05 04:24:51', '2014-08-05 04:24:51'),
(36, 'dilem', 'female', 'Apple’ın Dünya Geliştiriciler Konferansı’nın bu yılki etkinliğinde görücüye çıkardığı ve gerek arayüzü gerek fonksiyonel özellikleriyle büyük beğeni toplayan iOS 8′in 5. betası geliştiriciler için yayınlandı. Her yeni sürümde olduğu gibi bu güncellemede de açıkları kapatarak sistemi revize eden firmanın asıl önemli sürprizi, işlevselliği artıran ufak çaplı dokunuşları oldu.', 1, 'dedikod', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', '2014-08-05 04:25:18', '2014-08-05 04:25:18'),
(37, 'barantr90', 'male', 'Tartışmasız en popüler mesajlaşma servisi olan WhatsApp, vazgeçilemeyen bir bağımlılık gibi. Pek çok benzer uygulama olmasına karşın popülerliğini yitirmeyen mesajlaşma uygulaması, giyilebilir teknolojiye ayak uyduracak şekilde kendini geliştirmeye devam ediyor. WhatsApp’ın yeni güncellemesi Android Wear‘li cihazları hedef alıyor.', 1, 'dedikod', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', '2014-08-05 06:10:42', '2014-08-05 06:10:42'),
(38, 'misafir87477', 'female', 'iPhone 6‘nın tasarım ve donanımı hakkında resmi bilgi ve görüntülerin gelmesine daha tahminen 1,5-2 ay gibi bir süre olsa da, 5-6 aydır farklı kaynaklardan gelen benzer görseller, cihazın yuvarlak hatlı ve konturlu bir tasarıma sahip olacağını gösteriyor. Daha Apple iPhone 6′ya dair tek bir kelime etmemiş olsa da, ekim ayına kadar bekleyemeyenlerin imdadına yine kopya ürünlerin anavatanı Çin‘deki üreticiler yetişiyor.', 0, 'dedikod', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', '2014-08-05 06:10:56', '2014-08-05 06:10:56'),
(39, 'misafir87477', 'male', 'Akıllı telefonlar vazgeçilmez cihazlarımız oldu. Her yeni modelle biraz daha gelişen telefonlar zaafları da beraberinde getirdi.', 0, 'dedikod', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', '2014-08-05 06:11:15', '2014-08-05 06:11:15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Tablo döküm verisi `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `full_name`, `twitter_username`, `instagram_username`, `facebook_username`, `avatar`, `created_at`, `updated_at`) VALUES
(7, 10, 'Baran Şengül', 'baransngl', NULL, NULL, 'guest', '2014-08-04 06:36:49', '2014-08-04 06:36:49'),
(8, 11, 'Dİlem', NULL, NULL, NULL, 'dilem.jpg', '2014-08-05 04:23:58', '2014-08-05 04:23:58');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `throttle`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Tablo döküm verisi `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(5, 10, '::1', 0, 0, 0, NULL, NULL, NULL),
(6, 11, '::1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `permissions`, `activated`, `school`, `gender`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `created_at`, `updated_at`) VALUES
(10, 'baransengul@outlook.com', 'barantr90', '$2y$10$oZnSnOmLeaXAw7Ka8m5fU.JgDbsHUCTJ1qsrIFf9ifEYHgqtdlIc2', NULL, 1, 'Beykent', 'male', NULL, NULL, '2014-08-05 09:05:25', '$2y$10$RmYCZVws/m6MSP8gtvCpxOzd.T31PMbHczFqNe4viTWRRDrjs1hta', NULL, '2014-08-04 06:36:49', '2014-08-05 06:05:25'),
(11, 'dilembadali@hotmail.com', 'dilem', '$2y$10$CSsHI4wU1vMUTtza6lJ5medjkJmfSdh1HkvdySjyLyfEuceD4sOOC', NULL, 1, 'Bahçeşehir', 'female', NULL, NULL, '2014-08-05 07:24:13', '$2y$10$uqDNNF3lGzaxYfuVG60t9OG20XSlMxPsaFA8hyvBUE0jVP6l3Qqcy', NULL, '2014-08-05 04:23:58', '2014-08-05 04:24:13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Tablo için indeksler `likes`
--
ALTER TABLE `likes`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `profiles`
--
ALTER TABLE `profiles`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `throttle`
--
ALTER TABLE `throttle`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_user_id` (`user_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD KEY `users_activation_code_index` (`activation_code`), ADD KEY `users_reset_password_code_index` (`reset_password_code`);

--
-- Tablo için indeksler `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- Tablo için AUTO_INCREMENT değeri `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `likes`
--
ALTER TABLE `likes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- Tablo için AUTO_INCREMENT değeri `profiles`
--
ALTER TABLE `profiles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `throttle`
--
ALTER TABLE `throttle`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Tablo için AUTO_INCREMENT değeri `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
