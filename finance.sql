-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 05 2017 г., 10:37
-- Версия сервера: 5.5.58-0ubuntu0.14.04.1
-- Версия PHP: 7.0.25-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `finance`
--

-- --------------------------------------------------------

--
-- Структура таблицы `O_User`
--

CREATE TABLE `O_User` (
  `Id` int(11) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `Balance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `O_User`
--

INSERT INTO `O_User` (`Id`, `Login`, `Pass`, `Balance`) VALUES
(1, 'Mgr138', '$2y$12$SRdH3VBI4C9wONfZG42fqOk3E.gXGrYN83c9u86vMJrXh9BJZ3Ex6', '1000.00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `O_User`
--
ALTER TABLE `O_User`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `O_User`
--
ALTER TABLE `O_User`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
