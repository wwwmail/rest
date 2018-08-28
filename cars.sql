-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 28 2018 г., 13:26
-- Версия сервера: 5.6.38
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cars`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auto_info`
--

CREATE TABLE `auto_info` (
  `id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `capasity` float NOT NULL,
  `colour` varchar(255) NOT NULL,
  `speed` int(11) NOT NULL,
  `price` float NOT NULL
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

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `model_to_brand` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `orders` (
  `auto_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment` varchar(255) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`auto_id`, `user_id`, `payment`, `status`) VALUES
(1, NULL, '100', 0),
(1, NULL, '100', 0),
(2, 17, '0', 0),
(4, 17, '0', 0),
(3, 17, '0', 0),
(3, 17, '0', 0),
(0, 18, '0', 0),
(1, 18, '0', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `token`, `expire`) VALUES
(5, 'www@mail.cz', '$2y$13$JDJ5JDEzJG8uRUNkYThiYu.xMIVxwiiltxG1zczofeuT7z8tkYCZG', 'yasinskiy1', 'tt', 'af9c482267513550bcb759c1ee2879b8', '2018-08-23 10:37:48'),
(17, 'sheva@mail.ru', '$2y$13$JDJ5JDEzJEdkU1hkYVdSMOe1FyJQLBym1kftqtKtrb1PXums/AQt.', '123456', '123456', '07239e15065813ce1750f2ea2e8bfd68', '2018-08-28 10:41:25'),
(18, '1@mail.cz', '$2y$13$JDJ5JDEzJGlSMHZjL3N6NO5DXzOILRs3rCaS3.VCQH4K.Y7NV4pZC', '1', '1', 'b2056633b35fa9626347f7f53a215e26', '2018-08-28 13:47:14');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auto_info`
--
ALTER TABLE `auto_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model_to_brand`
--
ALTER TABLE `model_to_brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `model_to_brand`
--
ALTER TABLE `model_to_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
