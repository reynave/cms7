-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table cms7.content
CREATE TABLE IF NOT EXISTS `content` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `pages_id` int(6) NOT NULL DEFAULT 0,
  `name` varchar(250) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `h1` text NOT NULL,
  `h2` text NOT NULL,
  `h3` text NOT NULL,
  `h4` text NOT NULL,
  `h5` text NOT NULL,
  `h6` text NOT NULL,
  `content` text NOT NULL,
  `img` varchar(250) NOT NULL DEFAULT '',
  `metadata_description` varchar(250) NOT NULL DEFAULT '',
  `metadata_keywords` varchar(250) NOT NULL DEFAULT '',
  `status` int(2) NOT NULL DEFAULT 1,
  `sorting` int(3) NOT NULL DEFAULT 999,
  `presence` int(1) NOT NULL DEFAULT 1,
  `publish_date` date NOT NULL DEFAULT '2023-01-01',
  `input_by` varchar(50) NOT NULL DEFAULT '',
  `update_by` varchar(50) NOT NULL DEFAULT '',
  `input_date` datetime NOT NULL DEFAULT '2023-01-01 00:00:00',
  `update_date` datetime NOT NULL DEFAULT '2023-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `url` (`url`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- Dumping data for table cms7.content: ~8 rows (approximately)
INSERT INTO `content` (`id`, `pages_id`, `name`, `url`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `content`, `img`, `metadata_description`, `metadata_keywords`, `status`, `sorting`, `presence`, `publish_date`, `input_by`, `update_by`, `input_date`, `update_date`) VALUES
	(153, 1, 'Market Forex', 'market-forex.html', '', '', '', '', '', '', '', '', 'content Market Forext Metdata', 'content Market Forext Metdata Keyword', 1, 3, 1, '2023-01-01', '', '', '2023-01-01 00:00:00', '2023-05-29 17:31:53'),
	(155, 1, 'Market Stock', 'market-stock.html', '<p>heading 1&nbsp; 123 123123</p>', '<p>headline 2</p>', '', '', '', '', '<div id="info-container" class="style-scope ytd-watch-metadata"><a class="yt-simple-endpoint style-scope yt-formatted-string bold" dir="auto" spellcheck="false" href="https://www.youtube.com/hashtag/stayrelevant">#stayrelevant</a> <a class="yt-simple-endpoint style-scope yt-formatted-string bold" dir="auto" spellcheck="false" href="https://www.youtube.com/hashtag/gunungagung">#gunungagung</a> <a class="yt-simple-endpoint style-scope yt-formatted-string bold" dir="auto" spellcheck="false" href="https://www.youtube.com/hashtag/tokobuku">#tokobuku</a></div>\n<p><span class="yt-core-attributed-string yt-core-attributed-string--white-space-pre-wrap">Toko buku adalah lambang orang masih mau berpikir. Apakah kini sebaliknya? Dulu ada toko buku Tropen, QB, Spektra, Scientific dan sebagainya. Kini satu persatu undur. Bagaimana anak-anak Indonesia belajar di masa depan?</span></p>', '', 'content Market Stock Metdata', 'content Market Forext Stock Keyword', 1, 1, 1, '2023-01-01', '', '', '2023-01-01 00:00:00', '2023-05-29 17:31:53'),
	(156, 1, 'Market Cyrpto', 'cyrpto.html', '', '', '', '', '', '', '', '', 'content Market Stock Metdata', 'content Market Forext Stock Keyword', 1, 2, 1, '2023-01-01', '', '', '2023-01-01 00:00:00', '2023-05-29 17:31:53'),
	(182, 1, 'Content 2023-05-29 09:14', 'content_535378982115200', '', '', '', '', '', '', '', '', '', '', 1, 4, 1, '2023-01-01', 'dev', '', '2023-05-29 09:14:12', '2023-05-29 10:08:20'),
	(183, 1, 'Content 2023-05-29 09:14', 'content_535379492938800', '', '', '', '', '', '', '', '', '', '', 1, 5, 1, '2023-01-01', 'dev', '', '2023-05-29 09:14:13', '2023-05-29 17:31:53'),
	(184, 1, 'Content 2023-05-29 09:14', 'content_535379921252400', '', '', '', '', '', '', '', '', '', '', 1, 6, 0, '2023-01-01', 'dev', '', '2023-05-29 09:14:13', '2023-05-29 09:39:30'),
	(185, 1, 'Content 2023-05-29 09:18', 'content_535644608318200', '', '', '', '', '', '', '', '', '', '', 1, 4, 0, '2023-01-01', 'dev', '', '2023-05-29 09:18:38', '2023-05-29 18:10:25'),
	(186, 1, 'Content 2023-05-29 09:40', 'content_536933401020200', '', '', '', '', '', '', '', '', '', '', 1, 6, 1, '2023-01-01', 'dev', '', '2023-05-29 09:40:07', '2023-05-29 17:31:53');

-- Dumping structure for table cms7.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `ilock` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1,
  `post` int(6) NOT NULL DEFAULT 0,
  `name` varchar(250) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `themes` varchar(250) NOT NULL DEFAULT '',
  `title` varchar(250) NOT NULL DEFAULT '',
  `metadata_description` mediumtext NOT NULL,
  `metadata_keywords` mediumtext NOT NULL,
  `pages_note1` mediumtext NOT NULL,
  `pages_note2` mediumtext NOT NULL,
  `pages_note3` mediumtext NOT NULL,
  `sorting` int(3) NOT NULL DEFAULT 999,
  `idefault` int(1) NOT NULL DEFAULT 0,
  `href` varchar(250) NOT NULL DEFAULT '',
  `href_target_blank` int(1) NOT NULL DEFAULT 0,
  `presence` int(1) NOT NULL DEFAULT 1,
  `img` varchar(250) NOT NULL DEFAULT '',
  `input_date` datetime NOT NULL DEFAULT '2023-01-01 00:00:00',
  `update_date` datetime NOT NULL DEFAULT '2023-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1006 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- Dumping data for table cms7.pages: ~6 rows (approximately)
INSERT INTO `pages` (`id`, `parent_id`, `ilock`, `status`, `post`, `name`, `url`, `themes`, `title`, `metadata_description`, `metadata_keywords`, `pages_note1`, `pages_note2`, `pages_note3`, `sorting`, `idefault`, `href`, `href_target_blank`, `presence`, `img`, `input_date`, `update_date`) VALUES
	(1, 0, 1, 1, 0, 'Home', 'home', 'home', 'home title', '', '', '', '', '', 1, 1, '', 0, 1, '', '2023-05-26 05:13:36', '2023-05-26 05:13:36'),
	(2, 1, 0, 1, 0, 'About Us', 'aboutus', 'aboutus', 'About Us', '', '', '', '', '', 24, 0, '', 0, 1, '', '2023-01-01 00:00:00', '2023-01-01 00:00:00'),
	(3, 1, 0, 1, 0, 'Products', 'products', 'products', 'product title', '', '', '', '', '', 24, 0, '', 0, 1, '', '2023-01-01 00:00:00', '2023-01-01 00:00:00'),
	(4, 2, 0, 1, 0, 'Products', 'products', 'products', 'product title', '', '', '', '', '', 24, 0, '', 0, 1, '', '2023-01-01 00:00:00', '2023-01-01 00:00:00'),
	(5, 2, 0, 1, 0, 'Products', 'products', 'products', 'product title', '', '', '', '', '', 24, 0, '', 0, 1, '', '2023-01-01 00:00:00', '2023-01-01 00:00:00'),
	(6, 3, 0, 1, 0, 'Products', 'products', 'products', 'product title', '', '', '', '', '', 24, 0, '', 0, 1, '', '2023-01-01 00:00:00', '2023-01-01 00:00:00');

-- Dumping structure for table cms7.widget
CREATE TABLE IF NOT EXISTS `widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itype` varchar(10) NOT NULL DEFAULT '',
  `themes` varchar(250) NOT NULL DEFAULT '',
  `section` varchar(250) NOT NULL DEFAULT '',
  `pages_id` varchar(10) NOT NULL DEFAULT '',
  `content_id` varchar(10) NOT NULL DEFAULT '',
  `href` mediumtext NOT NULL DEFAULT '',
  `h1` mediumtext NOT NULL DEFAULT 'h1',
  `h2` mediumtext NOT NULL DEFAULT 'h2',
  `h3` mediumtext NOT NULL DEFAULT 'h3',
  `h4` mediumtext NOT NULL DEFAULT 'h4',
  `h5` mediumtext NOT NULL DEFAULT 'h5',
  `h6` mediumtext NOT NULL DEFAULT 'h6',
  `img` text NOT NULL,
  `content` text NOT NULL,
  `sorting` int(5) NOT NULL DEFAULT 999,
  `status` int(1) NOT NULL DEFAULT 1,
  `presence` int(1) NOT NULL DEFAULT 1,
  `input_by` varchar(50) NOT NULL DEFAULT '',
  `input_date` datetime NOT NULL DEFAULT '2023-01-01 00:00:00',
  `update_by` varchar(50) NOT NULL DEFAULT '',
  `update_date` datetime NOT NULL DEFAULT '2023-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=100016 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- Dumping data for table cms7.widget: ~35 rows (approximately)
INSERT INTO `widget` (`id`, `itype`, `themes`, `section`, `pages_id`, `content_id`, `href`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `img`, `content`, `sorting`, `status`, `presence`, `input_by`, `input_date`, `update_by`, `update_date`) VALUES
	(152, 'galleries', '', '155', '', '', '', 'h1', 'h2', 'h3', '', '', '', 'https://64.media.tumblr.com/db4e65e421bd7bf43504b3fd308d7a57/de0e18554d27a944-32/s640x960/2b432b44cbc9b58a6fe187705bb45ab88d56bbd0.jpg', 'Welcome to TinyMCE! 123123123', 3, 1, 1, '', '2023-01-01 00:00:00', '', '2023-05-29 18:30:44'),
	(153, 'galleries', '', '155', '', '', 'hahaha', 'h1', 'h2', 'h3', '', '', '', 'https://i.pinimg.com/736x/7c/9f/e8/7c9fe8c49f57001cd57600484bcc6125.jpg', 'content ho', 1, 1, 1, '', '2023-01-01 00:00:00', '', '2023-05-29 18:30:44'),
	(154, 'widget', '', '155', '', '', '', 'h1', 'h2', 'h3', '', '', '', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVxNXIv43Bu9hY8PZZC4ggDotnoq9PzR1QmKTpTuO05vXCVhRar24N0aGLXutpHmjIKzg&usqp=CAU', 'content ho', 4, 1, 1, '', '2023-01-01 00:00:00', '', '2023-05-29 18:13:04'),
	(155, 'widget', '', '155', '', '', '', 'h1', 'h2', 'h3', '', '', '', 'https://i.ebayimg.com/images/g/7MMAAOSwMXVkAJxT/s-l1600.jpg', 'content ho', 1, 1, 1, '', '2023-01-01 00:00:00', '', '2023-05-29 18:13:04'),
	(156, 'widget', 'home', 'banner', '', '', '', 'haha', 'h2h2h', 'h3h3h', '', '', '', '', '<p>ini yang di edit</p>', 999, 1, 1, '', '2023-01-01 00:00:00', '', '2023-05-29 10:06:10'),
	(157, 'widget', 'home', 'banner', '', '', '', 'haha', 'h2h2h', 'h3h3h', '', '', '', '', 'content h32', 999, 1, 1, '', '2023-01-01 00:00:00', '', '2023-01-01 00:00:00'),
	(158, 'widget', 'home', 'banner', '', '', '', 'haha', 'h2h2h', 'h3h3h', '', '', '', '', 'content h32', 999, 1, 1, '', '2023-01-01 00:00:00', '', '2023-01-01 00:00:00'),
	(159, 'widget', 'home', 'homeInfo', '', '', '', 'haha', 'h2h2h', 'h3h3h', '', '', '', '', 'content h32', 999, 1, 1, '', '2023-01-01 00:00:00', '', '2023-01-01 00:00:00'),
	(160, 'widget', 'home', 'homeInfo', '', '', '', 'haha', 'h2h2h', 'h3h3h', '', '', '', '', 'content h32', 999, 1, 1, '', '2023-01-01 00:00:00', '', '2023-01-01 00:00:00'),
	(161, 'widget', 'home', 'homeInfo', '', '', '', 'haha', 'h2h2h', 'h3h3h', '', '', '', '', 'content h32', 999, 1, 1, '', '2023-01-01 00:00:00', '', '2023-01-01 00:00:00'),
	(162, 'widget', 'home', 'footer', '', '', '', 'haha', 'h2h2h', 'h3h3h', '', '', '', '', 'content h32', 999, 1, 1, '', '2023-01-01 00:00:00', '', '2023-01-01 00:00:00'),
	(164, 'widget', 'home', 'haha', '', '', '', 'headline 1', 'headline 2', 'headline 3', 'headline 4', 'headline 5', 'headline 6', '', '', 5, 1, 0, '', '2023-01-01 00:00:00', '', '2023-05-28 17:47:54'),
	(165, 'widget', 'home', 'haha', '', '', '', 'headline 12', '<p>headline 2 123123</p>', 'headline 3', 'headline 4', 'headline 5', 'headline 6', '', '', 2, 1, 0, '', '2023-01-01 00:00:00', '', '2023-05-29 07:24:15'),
	(174, 'widget', 'home', 'haha', '', '', '', 'h1', '<p>h2 1 123123 123123123123</p>', 'h3', 'h4', 'h5', 'h6', '', '', 4, 1, 1, 'dev', '2023-05-28 16:59:53', '', '2023-05-29 17:31:42'),
	(175, 'widget', 'home', 'haha', '', '', '', 'h1', '<p>h2 nnanananan asdfasdf</p>', 'h3', 'h4', 'h5', 'h6', '', '', 1, 1, 1, 'dev', '2023-05-28 17:11:09', '', '2023-05-29 17:31:42'),
	(176, 'widget', 'home', 'haha', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '', '', 9, 1, 0, 'dev', '2023-05-28 17:11:09', '', '2023-05-28 17:45:09'),
	(177, 'widget', 'home', 'haha', '', '', '', 'h1', '<p>h2 123123 12 3</p>', 'h3', 'h4', 'h5', 'h6', '', '', 6, 1, 1, 'dev', '2023-05-28 17:11:12', '', '2023-05-29 17:31:42'),
	(178, 'widget', 'home', 'haha', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '', '', 6, 1, 0, 'dev', '2023-05-28 17:19:17', '', '2023-05-28 17:47:14'),
	(179, 'widget', 'home', 'haha', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '', '', 8, 1, 0, 'dev', '2023-05-28 17:19:35', '', '2023-05-28 17:46:27'),
	(180, 'widget', 'home', 'haha', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '', '', 7, 1, 0, 'dev', '2023-05-28 17:40:37', '', '2023-05-28 17:46:50'),
	(181, 'widget', 'home', 'haha', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '', '', 999, 1, 0, 'dev', '2023-05-28 17:41:04', '', '2023-05-28 17:45:07'),
	(182, 'widget', 'home', 'haha', '', '', '', 'h1', '<p>h2 nnn 123123 123123 asdfasdf</p>', 'h3', 'h4', 'h5', 'h6', '', '', 5, 1, 1, 'dev', '2023-05-28 17:48:08', '', '2023-05-29 17:31:42'),
	(183, 'widget', 'home', 'haha', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '', '', 7, 1, 1, 'dev', '2023-05-28 17:56:06', '', '2023-05-29 17:31:42'),
	(184, 'widget', 'home', 'haha', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '', '', 8, 1, 0, 'dev', '2023-05-28 17:56:09', '', '2023-05-28 17:58:23'),
	(185, 'widget', 'home', 'haha', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '', '', 9, 1, 0, 'dev', '2023-05-28 17:57:08', '', '2023-05-28 17:58:21'),
	(186, 'widget', 'home', 'haha', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '', '', 8, 1, 1, 'dev', '2023-05-28 17:57:50', '', '2023-05-29 17:31:42'),
	(187, 'widget', 'home', 'haha', '', '', '', 'h1', '<p>h2 123123123123 123123123 asdfasdfas dasdf asfasdf</p>', 'h3', 'h4', 'h5', 'h6', '', '', 2, 1, 1, 'dev', '2023-05-28 18:01:05', '', '2023-05-29 17:31:42'),
	(188, 'widget', 'home', 'haha', '', '', '', 'h1', '<p>h2 123123</p>', 'h3', 'h4', 'h5', 'h6', '', '', 3, 1, 1, 'dev', '2023-05-29 06:12:36', '', '2023-05-29 17:31:42'),
	(189, 'widget', 'home', 'haha', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '', '', 10, 1, 0, 'dev', '2023-05-29 06:12:44', '', '2023-05-29 07:25:26'),
	(100007, 'galleries', '', '155', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'https://dummyimage.com/600x400/30a2ff/ffffff.jpg&text=dummy+images', '', 3, 1, 0, 'dev', '2023-05-29 11:42:20', '', '2023-05-29 17:34:34'),
	(100008, 'galleries', '', '155', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'https://dummyimage.com/600x400/30a2ff/ffffff.jpg&text=dummy+images', '', 2, 1, 0, 'dev', '2023-05-29 11:42:21', '', '2023-05-29 17:34:37'),
	(100009, 'galleries', '', '155', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'https://dummyimage.com/600x400/30a2ff/ffffff.jpg&text=dummy+images', '', 2, 1, 1, 'dev', '2023-05-29 11:48:18', '', '2023-05-29 18:30:44'),
	(100010, 'galleries', '', '155', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'https://dummyimage.com/600x400/30a2ff/ffffff.jpg&text=dummy+images', '', 4, 1, 1, 'dev', '2023-05-29 11:48:21', '', '2023-05-29 18:30:44'),
	(100011, 'widget', 'aboutus', 'aboutus1', '', '', '', 'headline 1', 'headline 2', 'headline 3', 'headline 4', 'headline 5', 'headline 6', '', '', 999, 1, 1, '', '2023-01-01 00:00:00', '', '2023-01-01 00:00:00'),
	(100012, 'galleries', '', '155', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'https://dummyimage.com/600x400/30a2ff/ffffff.jpg&text=dummy+images', '', 5, 1, 1, 'dev', '2023-05-29 17:34:03', '', '2023-05-29 18:30:44'),
	(100013, 'galleries', '', '155', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'https://dummyimage.com/600x400/30a2ff/ffffff.jpg&text=dummy+images', '', 6, 1, 1, 'dev', '2023-05-29 17:37:41', '', '2023-05-29 18:30:44'),
	(100014, 'widget', '', '155', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '', '', 2, 1, 1, 'dev', '2023-05-29 17:38:34', '', '2023-05-29 18:13:04'),
	(100015, 'widget', '', '155', '', '', '', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'https://dummyimage.com/600x400/30a2ff/ffffff.jpg&text=dummy+images', '', 3, 1, 1, 'dev', '2023-05-29 17:39:54', '', '2023-05-29 18:13:04');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
