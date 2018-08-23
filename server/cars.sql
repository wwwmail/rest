-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 19 2018 г., 21:14
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cars`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auto_info`
--

CREATE TABLE IF NOT EXISTS `auto_info` (
  `id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `capasity` float NOT NULL,
  `colour` varchar(255) NOT NULL,
  `speed` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `auto_info`
--

INSERT INTO `auto_info` (`id`, `year`, `capasity`, `colour`, `speed`, `price`) VALUES
(1, 1999, 1.6, 'yellow', 180, 8900),
(2, 2000, 1.8, 'orange', 185, 9200),
(3, 2001, 2.2, 'black', 200, 10100),
(4, 2005, 2.4, 'blue', 210, 12000),
(5, 2009, 2.6, 'red', 230, 12000),
(6, 2013, 1.9, 'green', 220, 11500),
(7, 2016, 3.2, 'pink', 180, 14000),
(8, 2017, 2.4, 'gray', 240, 15000);

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'lexus'),
(2, 'skoda'),
(3, 'bmw'),
(4, 'mitsubishi');

-- --------------------------------------------------------

--
-- Структура таблицы `model`
--

CREATE TABLE IF NOT EXISTS `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `model`
--

INSERT INTO `model` (`id`, `model`) VALUES
(1, 'ct'),
(2, 'is'),
(3, '3'),
(4, 'x5'),
(5, 'octavia'),
(6, 'fabia'),
(7, 'lancer'),
(8, 'outlander');

-- --------------------------------------------------------

--
-- Структура таблицы `model_to_brand`
--

CREATE TABLE IF NOT EXISTS `model_to_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `model_to_brand`
--

INSERT INTO `model_to_brand` (`id`, `brand_id`, `model_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 5),
(4, 2, 6),
(5, 3, 3),
(6, 3, 4),
(7, 4, 7),
(8, 4, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `auto_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`auto_id`, `first_name`, `last_name`, `payment`) VALUES
(1, 'ivan4', 'yasinskiy1', '100'),
(1, 'ivan4', 'yasinskiy1', '100');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `token`, `expire`) VALUES
(1, '1', 'ivan4', 'yasinskiy1', '100', NULL, NULL),
(2, 'www@mail.cz', '123456', 'yasinskiy1', 'tt', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
