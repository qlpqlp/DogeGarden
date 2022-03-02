-- Adminer 4.8.1 MySQL 5.5.68-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  `id_cat` bigint(20) DEFAULT NULL,
  `id_prod` bigint(20) DEFAULT NULL,
  `id_page` bigint(20) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `ord` bigint(20) NOT NULL,
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_shibe` bigint(20) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `session` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) DEFAULT 'en',
  `icon` varchar(50) DEFAULT 'ellipsis-v',
  `id_cat` bigint(20) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `img` varchar(255) DEFAULT NULL,
  `ord` int(1) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_shibe` bigint(20) NOT NULL,
  `doge_in_address` varchar(255) DEFAULT NULL,
  `doge_out_address` varchar(255) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `total_doge` decimal(20,8) DEFAULT NULL,
  `doge_transaction_id` text,
  `confirmations` bigint(20) NOT NULL DEFAULT '0',
  `shipping` decimal(20,8) DEFAULT NULL,
  `products_json` longtext,
  `status` int(1) NOT NULL,
  `email_sent` int(1) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  `id_page` bigint(20) NOT NULL DEFAULT '0',
  `type` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `ord` bigint(20) DEFAULT '0',
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_cat` bigint(20) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `doge` decimal(20,8) NOT NULL,
  `moon_new` decimal(10,2) DEFAULT '0.00',
  `moon_full` decimal(10,2) DEFAULT NULL,
  `qty` bigint(11) DEFAULT '0',
  `weight` decimal(10,2) DEFAULT '0.00',
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `imgs` longtext,
  `highlighted` tinyint(1) DEFAULT '0',
  `ord` bigint(20) DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shibes`;
CREATE TABLE `shibes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `doge_address` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shipping`;
CREATE TABLE `shipping` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country` varchar(2) NOT NULL DEFAULT 'en',
  `title` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `doge` decimal(20,8) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2022-02-10 14:59:18