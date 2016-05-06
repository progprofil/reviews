-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost:8889
-- Время создания: Май 06 2016 г., 14:51
-- Версия сервера: 5.5.42
-- Версия PHP: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `users`
--
CREATE DATABASE IF NOT EXISTS `users` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `users`;

-- --------------------------------------------------------

--
-- Структура таблицы `rewievs`
--

CREATE TABLE `rewievs` (
  `user_name` char(50) COLLATE utf8_general_mysql500_ci NOT NULL,
  `email` char(50) COLLATE utf8_general_mysql500_ci NOT NULL,
  `theme` char(30) COLLATE utf8_general_mysql500_ci NOT NULL,
  `text` varchar(2048) COLLATE utf8_general_mysql500_ci NOT NULL,
  `pic_name` char(64) COLLATE utf8_general_mysql500_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Дамп данных таблицы `rewievs`
--

INSERT INTO `rewievs` (`user_name`, `email`, `theme`, `text`, `pic_name`, `id`) VALUES
('ASDASAS', 'ASASAS', 'Ð”ÐµÐ½ÑŒÐ³Ð¸', 'ASASFSAD', '', 1),
('ASDSASSS', 'ASASAS', 'Ð”ÐµÐ½ÑŒÐ³Ð¸', 'ASC`CASC', '', 2),
('qw', 'qw', 'Ð”ÐµÐ½ÑŒÐ³Ð¸', 'A', '', 3),
('privet', 'prive@p.com', 'Ð‘ÐµÐ·Ð¾Ð¿Ð°ÑÐ½Ð¾ÑÑ‚ÑŒ', 'nnnnnnnnn', '6160506075544160506123652.jpg', 4),
('For', 'for@mail.com', 'Security', 'Vay vay', '2160506082423160506124008.jpg', 5),
('second', 'second@nn.nn', 'Money', 'Lorem lip sum', '', 6),
('third', 'th@ndn.com', 'Business', 'dmnmxncmncxmncxmnxcn', 'bank160506124342.jpg', 7),
('vasya', 'vas@mail.ru', 'Money', 'vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas vas', 'vp-icon32160506124448.png', 8);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `rewievs`
--
ALTER TABLE `rewievs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `rewievs`
--
ALTER TABLE `rewievs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
