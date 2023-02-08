-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 08 2023 г., 10:20
-- Версия сервера: 8.0.31
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `red_promo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(255) DEFAULT NULL COMMENT 'Category name',
  `date_c` datetime DEFAULT NULL COMMENT 'Дата создания',
  PRIMARY KEY (`id`),
  KEY `category_id_index` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COMMENT='Categories table';

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `date_c`) VALUES
(4, 'Ecology', NULL),
(3, 'Politic', NULL),
(5, 'Medicine', NULL),
(6, 'Sport', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `username` varchar(255) DEFAULT NULL COMMENT 'Username',
  `content` text COMMENT 'Content',
  `news_id` int DEFAULT NULL COMMENT 'Parent news',
  `date_c` datetime DEFAULT NULL COMMENT 'Дата создания',
  PRIMARY KEY (`id`),
  KEY `comments_news_id_index` (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COMMENT='Comments table';

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `username`, `content`, `news_id`, `date_c`) VALUES
(1, 'qefreqr1', 'qfr q34f q32f 324qr', 1, '2023-02-07 10:50:36'),
(9, 'agribova', 'Very good', 12, '2023-02-08 10:00:37'),
(10, 'agribova', 'ewrvwer', 12, '2023-02-08 10:13:28'),
(8, 'agribova', 'nice!', 8, '2023-02-08 10:00:07'),
(11, 'Alice', 'Nice', 8, '2023-02-08 10:13:55'),
(7, 'agribova', 'Oh no!!', 9, '2023-02-08 09:59:39');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1675766824),
('m230207_072044_create_news_table', 1675766826),
('m230207_072113_create_comments_table', 1675766826),
('m230207_072128_create_categories_table', 1675766826);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `label` varchar(255) NOT NULL COMMENT 'News label',
  `content` text COMMENT 'News content',
  `img_path` varchar(255) DEFAULT NULL COMMENT 'Path yo img',
  `category_id` int DEFAULT NULL COMMENT 'Category',
  `date_c` datetime DEFAULT NULL COMMENT 'Дата создания',
  PRIMARY KEY (`id`),
  KEY `news_category_id_index` (`category_id`),
  KEY `news_id_index` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COMMENT='News table';

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `label`, `content`, `img_path`, `category_id`, `date_c`) VALUES
(1, 'Zelensky to meet Sunak in London today', 'President Zelensky will visit Britain today for the first time since Russia invaded Ukraine. The Ukrainian president will meet Rishi Sunak in Downing Street then address MPs and peers in Westminster Hall, the government announced this morning. In a mark of how critical the UK has become to...', '/images/1.jpg', 3, '2023-02-08 13:17:17'),
(12, 'Professor Sara Linse presents new data on protein interactions in Alzheimer’s disease using the Fluidity One-W at FEBS 2019', 'Fluidic Analytics Ltd, experts in protein analysis and the company behind in-solution diffusional sizing, will host an extended Q&A session with Professor Linse at their booth (number 7) at 3pm following her plenary talk. Visitors to the Fluidic Analytics booth will also be able to have an early look at the Fluidity One-W before its official launch later this year. This instrument has the ability to assess on-target protein interactions in solution and in crude biological backgrounds – opening up the ', '/images/1.jpg', 5, '2023-02-08 13:17:10'),
(8, 'Sunak’s reshuffle is biggest Whitehall shake-up since Brexit', 'Sunak’s reshuffle is biggest Whitehall shake-up since Brexit', '/images/1.jpg', 3, '2022-02-08 13:17:21'),
(9, 'Let me finish the job, says Biden in upbeat state of the union', 'President Biden urged American voters and his Republican opponents to let him “finish the job” of rebuilding the country as he delivered his second state of the union address last night, laying out a blueprint for his re-election campaign in 2024. In a lively, sometimes combative speech that brought jeers from some...', '/images/1.jpg', 6, '2023-02-08 13:17:13'),
(10, 'Plastic Bottle Deposit Return Scheme Finally Looks Set to Start in England', 'The English government has given the go-ahead for a deposit return scheme for plastic bottles.\nThe program will begin in 2024.\nScotland’s deposit return scheme will begin in August and will include plastic, glass, and cans.', '/images/1.jpg', 4, '2023-02-08 13:14:23'),
(11, 'Beans in Toast: UK Should Switch to Broad Bean Bread, Say Researchers', 'Researchers say Britain should switch to eating bread made from broad beans as it would be more sustainable and efficiently deliver key nutrients.\nBroad beans, also known as fava beans, can be grown in the UK and are high in protein, fibre and iron.\nThe researchers are working with farmers to encourage them to switch from wheat-producing land to fava bean.', '/images/1.jpg', 4, '2023-02-08 13:17:14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
