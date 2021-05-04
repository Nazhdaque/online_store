-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 04 2021 г., 10:40
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `store`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_row` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `order_row`) VALUES
(1, 'Женщинам', 10),
(2, 'Мужчинам', 9),
(3, 'Детям', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `core_articles`
--

CREATE TABLE `core_articles` (
  `id` int(11) NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mark` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `core_articles`
--

INSERT INTO `core_articles` (`id`, `photo`, `mark`, `title`, `text`) VALUES
(1, '/img/main/1.jpg', NULL, 'Джинсовые куртки', 'New Arrival'),
(2, NULL, '<div class=\"tiret\"></div>\r\n    <div class=\"round\">\r\n        <div class=\"ex_mark\"></div>\r\n        <div class=\"ex_mark\"></div>\r\n    </div>\r\n    <div class=\"tiret\"></div>', NULL, 'Каждый сезон мы подготавливаем для Вас исключительно лучшую модную одежду. Следите за нашими новинками.'),
(3, '/img/main/3.jpg', NULL, NULL, NULL),
(4, NULL, '<div class=\"arrow\"></div>', 'Элегантная обувь', 'ботинки, кроссовки'),
(5, '/img/main/2.jpg', NULL, 'Джинсы', 'от 3200 руб'),
(6, NULL, '<div class=\"tiret\"></div>\r\n    <div class=\"round\">\r\n        <div class=\"ex_mark\"></div>\r\n        <div class=\"ex_mark\"></div>\r\n    </div>\r\n    <div class=\"tiret\"></div>', NULL, 'Самые низкие цены в Москве. Нашли дешевле? Вернем разницу.'),
(7, '/img/main/4.jpg', NULL, 'Детская одежда', 'New Arrival'),
(8, '/img/main/5.jpg', NULL, NULL, NULL),
(9, NULL, '<div class=\"arrow\"></div>', 'Аксессуары', NULL),
(10, '/img/main/6.jpg', NULL, 'Спортивная одежда', 'от 590 руб.');

-- --------------------------------------------------------

--
-- Структура таблицы `core_goods`
--

CREATE TABLE `core_goods` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `vendor_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specification` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `goods_category_id` int(11) DEFAULT NULL,
  `new_arrival` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `core_goods`
--

INSERT INTO `core_goods` (`id`, `title`, `price`, `vendor_code`, `specification`, `photo`, `category_id`, `goods_category_id`, `new_arrival`) VALUES
(1, 'Куртка синяя', 5400, '999233', 'Синяя демисезонная куртка.', 'img/catalog/1.jpg', 2, 1, 0),
(2, 'Кожаная куртка', 22500, '7008833', 'Модная кожаная куртка.', 'img/catalog/4.jpg', 2, 1, 0),
(3, 'Куртка с карманами', 9200, '983287326', 'Куртка с накладными карманами', 'img/catalog/3.png', 2, 1, 0),
(4, 'Куртка с капюшоном', 6100, '9395925', 'Куртка осенняя с капюшоном.', 'img/catalog/2.jpg', 2, 1, 0),
(5, 'Куртка Casual', 8800, '2382', 'Легкая куртка-ветровка.', 'img/catalog/5.jpg', 2, 1, 0),
(6, 'Стильная кожаная куртка', 12800, '1112321', 'Куртка из натуральной кожи.', 'img/catalog/6.jpg', 2, 1, 0),
(7, 'Кеды серые', 2900, '775400', 'Легкие стильные кеды.', 'img/catalog/7.jpg', 2, 3, 0),
(8, 'Кеды черные', 4500, '9332', 'Повседневные кеды.', 'img/catalog/8.jpg', 2, 3, 0),
(9, 'Кеды Casual', 5900, '385904', 'Отличные кеды из водонепроницаемого материала. Подходят для любой погоды.\r\nПриятно сидят на ноге, стильные и комфортные', 'img/catalog/9.jpg', 2, 3, 1),
(10, 'Кеды всепогодные', 9200, '8878', 'Кеды на любой случай.', 'img/catalog/10.jpg', 2, 3, 0),
(11, 'Джинсы', 4800, '99988', 'Практичные джинсы синего цвета.', 'img/catalog/11.jpg', 2, 2, 0),
(12, 'Джинсы голубые', 4200, '992', 'Классическая модель.', 'img/catalog/12.jpg', 2, 2, 0),
(13, 'Кеды Fred Perry', 8990, '848009', 'Кожаные кеды с логотипом бренда', 'img/catalog/13.jpg', 1, 3, 0),
(14, 'Кроссовки New Balance', 11990, 'JJAA990', 'Кожаные кроссовки золотистого цвета 574', 'img/catalog/14.jpg', 1, 3, 1),
(15, 'Толстовка Tommy Jeans', 8990, 'DW0DW07798 XA9 racing red', 'Толстовка красного цвета с золотистым принтом', 'img/catalog/15.jpg', 1, 1, 0),
(16, 'Куртка Liu Jo', 18999, 'W69121E0493 51512', 'Розовая куртка косуха', 'img/catalog/19.jpg', 1, 1, 0),
(17, 'Пуховик Decathlon', 2899, NULL, 'Самая теплая куртка в коллекции.', 'img/catalog/16.jpg', 3, 1, 0),
(18, 'Брюки утепленные Decathlon', 1999, NULL, 'Брюки для очень холодной погоды...', 'img/catalog/17.jpg', 3, 7, 0),
(19, 'Утеплённые ботинки BJÖRKA', 2799, '15852293', 'Верх изготовлен из...', 'img/catalog/18.jpg', 3, 3, 0),
(20, 'Резиновые сапоги со съемным носком BJÖRKA ', 1390, '14079267', 'Сапоги выполнены из легкого материала...', 'img/catalog/20.jpg', 3, 3, 0),
(21, 'Куртка спортивная Lonsdale Gentlemen Mens Green Check', 8700, 'GKK_L 3300992L', 'Точные копии костюмов из фильма Джентельмены/THE GENTLEMEN выпущены совместно Lonsdale и MIRAMAX LLC.', 'img/catalog/21.jpg', 2, 4, 1),
(22, 'Костюм Lonsdale Gentlemen Mens Navy Check', 15800, 'GKPX_Y 4400992LX', 'Точные копии костюмов из фильма Джентельмены/THE GENTLEMEN выпущены совместно Lonsdale и MIRAMAX LLC.', 'img/catalog/22.jpg', 2, 4, 1),
(23, 'Dsquared2 Джинсовая куртка ', 61750, 'S75AM0822/S30342 ', 'Синяя куртка с крупными потертостями и функциональной молнией справа поможет любой образ сделать более дерзким.', 'img/catalog/23.jpg', 1, 6, 1),
(24, 'Zilli Двусторонний ремень из кожи крокодила ', 429000, 'MJL-REVRE-A0145/0071/CP0R ', 'Для изготовления двустороннего ремня мастера марки использовали мягкую кожу гребнистого крокодила. Аксессуар раскроили из цельного куска материала, который обработали по особой технологии: после дубления и хромирования на поверхность нанесли отбеливающий воск, а затем окрасили разными оттенками для получения голубого цвета.', 'img/catalog/24.jpg', 2, 5, 1),
(25, 'Zilli Солнцезащитные очки ', 96750, 'MIP-65010-00ACE/0001 ', 'Черные солнцезащитные очки изготовлены мастерами марки вручную из легкого полированного ацетата. Модель с литыми носоупорами дополнена темно-коричневыми прямоугольными стеклами, которые обеспечивают 100% защиту от вредного воздействия УФ-лучей. На широких дужках – вставки из фактурной кожи в тон и золотистого металла.', 'img/catalog/25.jpg', 2, 5, 1),
(26, 'Dolce & Gabbana Текстильный ремень', 52200, 'BE1434/A0621 ', 'Параметры изделия для размера 70: Длина 85 см, ширина 7,8 см. В комплект входит: пыльник.', 'img/catalog/28.jpg', 1, 5, 1),
(27, 'Givenchy Джинсовая куртка ', 92350, 'BW00BT50D1 ', 'В коллекции сезона весна-лето 2021 года дизайнеры марки усилили расслабленное настроение повседневной джинсовой куртки. Их приемами стали не только искусственно созданные потертости на плотном хлопке. Сзади укороченную свободную модель украсили будто выцветшим со временем принтом, в котором зашифрован адрес штаб-квартиры бренда, основанного Юбером де Живанши.', 'img/catalog/26.jpg', 1, 6, 1),
(28, 'Dolce & Gabbana Джинсы ', 94100, 'FTBXGD/GDZ32', 'Многообразие красок Сицилии стало лейтмотивом весенне-летней коллекции 2021 года. Яркий пример такого подхода – эти синие джинсы с высокой посадкой. Задние карманы модели из плотного хлопка с фактурными потертостями украсили жаккардовыми аппликациями в технике пэчворк. На показе Доменико Дольче и Стефано Габбана сочетали изделие с белой рубашкой и яркими кедами и пальто, а наши стилисты предлагают подобрать однотонные лаконичные вещи.', 'img/catalog/27.jpg', 1, 2, 1),
(29, 'Dsquared2 Джинсовая куртка', 62300, 'S74AM1060/S30342 ', 'В создании расслабленного повседневного образа джинсовой куртке из осенне-зимней коллекции 2020 года почти нет равных. Дин и Дэн Кейтены сформировали правильное настроение декоративными потертостями и брызгами краски. Идею поддержали и материалом. Модель сшили из плотного хлопка, в котором обесцвеченные нити переплели с окрашенными в синий оттенок.', 'img/catalog/29.jpg', 2, 6, 1),
(30, 'Versace Хлопковые джоггеры ', 83300, 'A88512/1F00627 ', 'Джоггеры из круизной коллекции 2021 года получились в равной мере красивыми и комфортными. За первое отвечает крупный мотив Barocco Patchwork, выполненный в яркий оттенках, а за второе — мягкий шелковистый на ощупь хлопок, который сохраняет комфортную для тела температуру, не перегревая кожу. Широкий эластичный пояс обеспечивает идеальную посадку по фигуре.', 'img/catalog/30.jpg', 1, 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `core_orders`
--

CREATE TABLE `core_orders` (
  `id` int(11) NOT NULL,
  `delivery_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_list` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed_at` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `core_orders`
--

INSERT INTO `core_orders` (`id`, `delivery_type`, `name`, `surname`, `adress`, `city`, `postcode`, `phone`, `email`, `payment_method`, `order_list`, `order_status`, `created_at`, `processed_at`) VALUES
(1, 'courier', 'Васисуалий', 'Иванов', 'Марьина роща, д. 12, кв. 22', 'Москва', '123322', '+7 965 412-34-10', 'vasya@mail.ru', 'cash', '{\"13\":{\"5\":2},\"2\":{\"16\":1},\"15\":{\"12\":1}}', 1, '2021-04-24 15:58:04', NULL),
(2, 'parcel_machine', 'Васисуалий', 'Иванов', 'Марьина роща, д. 12, кв. 22', 'Москва', '123322', '+7 965 412-34-10', 'vasya@mail.ru', 'bank_card', '{\"13\":{\"5\":1},\"1\":{\"15\":1}}', 2, '2021-04-24 16:47:52', '1'),
(3, 'parcel_machine', 'Васисуалий', 'Иванов', 'Марьина роща, д. 12, кв. 22', 'Москва', '123322', '+7 965 412-34-10', 'vasya@mail.ru', 'bank_card', '{\"13\":{\"5\":1},\"1\":{\"15\":1}}', 1, '2021-04-24 19:18:00', NULL),
(4, 'courier', 'Васисуалий', 'Иванов', 'Марьина роща, д. 12, кв. 22', 'Москва', '123322', '+7 965 412-34-10', 'vasya@mail.ru', 'bank_card', '{\"14\":{\"5\":1,\"4\":1},\"15\":{\"13\":2},\"26\":{\"15\":1}}', 1, '2021-04-24 19:26:30', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `core_stores`
--

CREATE TABLE `core_stores` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `core_stores`
--

INSERT INTO `core_stores` (`id`, `title`, `about`, `adress`, `photo`, `latitude`, `longitude`) VALUES
(1, 'На Кузмосте', 'Хороший магазин', 'улица Кузнецкий Мост, 24\r\nМосква, Россия, 107031', 'https://wikishopping.ru//cache/multithumb_mob/thumb_uploads_sz260708_sz_lime-shop-ins.jpg', 55.7615, 37.6266),
(2, 'В Люберах', 'Отличный магазин', 'Волковская улица, 43\r\nЛюберцы, Московская область, Россия, 140000', 'https://m.stepclub.ru/upload/resize_cache/iblock/00a/420_420_1/19b2e56ebfdf9b104d53305243da1175.jpg', 55.68, 37.8981);

-- --------------------------------------------------------

--
-- Структура таблицы `core_users`
--

CREATE TABLE `core_users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_group` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `core_users`
--

INSERT INTO `core_users` (`id`, `name`, `surname`, `adress`, `city`, `postcode`, `phone`, `email`, `login`, `password`, `user_group`) VALUES
(1, 'Васисуалий', 'Иванов', 'Остоженка, 16', 'Москва', '100202', '8 (916) 244-18-22', 'vasya@gmail.com', 'vasya', '$2y$10$Glc2cSepokibI7GFrKegd.8EEF159mVnf.OLAZFx5zo8bdC0zrAXm', 1),
(2, 'Админ', 'Админыч', 'Кремль', 'Москва', '111111', '111-11-11', 'admin@kremlin.ru', 'admin', '$2y$10$suWFK0W1cyh2YaYzhsSPPeELQuqgHqRRV5QIXcJ32Uf0BmuMg/xn2', 2),
(3, 'Васяндр', 'Петров', 'Москва, второй этаж', 'Москва', '543234', '+7 090 908-23-09', 'vasyandr@mail.ru', 'vasyandr', '$2y$10$m.gQ7pdIPjU8uzLKyqAVde.r3OQ9rBySmKc8vCqTEtlArpxMZT7YS', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_type`
--

CREATE TABLE `delivery_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `value` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `delivery_type`
--

INSERT INTO `delivery_type` (`id`, `type`, `price`, `value`) VALUES
(1, 'Курьерская служба', 500, 'courier'),
(2, 'Почтомат', 300, 'parcel_machine'),
(3, 'Самовывоз', 0, 'pickup_itself');

-- --------------------------------------------------------

--
-- Структура таблицы `goods_categories`
--

CREATE TABLE `goods_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `goods_categories`
--

INSERT INTO `goods_categories` (`id`, `title`) VALUES
(1, 'Верхняя одежда'),
(2, 'Джинсы'),
(3, 'Обувь'),
(4, 'Спортивная одежда'),
(5, 'Аксессуары'),
(6, 'Джинсовые куртки'),
(7, 'Брюки');

-- --------------------------------------------------------

--
-- Структура таблицы `goods_sizes`
--

CREATE TABLE `goods_sizes` (
  `id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `goods_sizes`
--

INSERT INTO `goods_sizes` (`id`, `good_id`, `size_id`) VALUES
(1, 1, 14),
(2, 1, 15),
(3, 1, 16),
(4, 2, 14),
(5, 2, 15),
(6, 2, 16),
(7, 3, 15),
(8, 3, 16),
(9, 4, 15),
(10, 5, 16),
(11, 6, 15),
(12, 6, 16),
(13, 7, 8),
(14, 7, 9),
(15, 7, 10),
(16, 8, 7),
(17, 8, 9),
(18, 9, 9),
(19, 9, 10),
(20, 10, 11),
(21, 11, 13),
(22, 11, 14),
(23, 11, 15),
(24, 12, 14),
(25, 12, 15),
(26, 12, 16),
(27, 13, 3),
(28, 13, 5),
(29, 14, 2),
(30, 14, 3),
(31, 14, 4),
(32, 14, 5),
(33, 15, 12),
(34, 15, 13),
(35, 16, 13),
(36, 16, 16),
(37, 17, 3),
(38, 17, 4),
(39, 18, 2),
(40, 18, 3),
(41, 18, 5),
(42, 18, 6),
(43, 19, 1),
(44, 19, 2),
(45, 19, 4),
(46, 20, 1),
(47, 20, 2),
(48, 20, 3),
(49, 21, 14),
(50, 21, 15),
(51, 21, 16),
(52, 22, 15),
(53, 22, 16),
(54, 23, 4),
(55, 23, 5),
(56, 23, 6),
(57, 23, 7),
(58, 23, 8),
(59, 24, 15),
(60, 24, 16),
(61, 25, 15),
(62, 25, 16),
(63, 26, 14),
(64, 26, 15),
(65, 27, 12),
(66, 27, 13),
(67, 27, 14),
(68, 28, 3),
(69, 28, 4),
(70, 28, 5),
(71, 29, 13),
(72, 29, 14),
(73, 29, 15),
(74, 29, 16),
(75, 30, 14),
(76, 30, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `created_at`) VALUES
(1, 'vasya@gmail.com', '2021-03-14 17:17:40'),
(2, 'vassa@gmail.com', '2021-03-26 11:50:40');

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`id`, `title`, `color`, `background`) VALUES
(1, 'не обработан', '#ad0505', '#e3d510'),
(2, 'обработан', 'white', '#10e314');

-- --------------------------------------------------------

--
-- Структура таблицы `price_range`
--

CREATE TABLE `price_range` (
  `id` int(11) NOT NULL,
  `price_from` int(11) NOT NULL,
  `price_up_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `price_range`
--

INSERT INTO `price_range` (`id`, `price_from`, `price_up_to`) VALUES
(1, 1000, 3000),
(2, 3000, 6000),
(3, 6000, 9000),
(4, 9000, 30000),
(5, 30000, 500000);

-- --------------------------------------------------------

--
-- Структура таблицы `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `size` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sizes`
--

INSERT INTO `sizes` (`id`, `size`) VALUES
(1, '34'),
(2, '35'),
(3, '36'),
(4, '37'),
(5, '38'),
(6, '39'),
(7, '40'),
(8, '41'),
(9, '42'),
(10, '43'),
(11, '44'),
(12, 'XS'),
(13, 'S'),
(14, 'M'),
(15, 'L'),
(16, 'XL');

-- --------------------------------------------------------

--
-- Структура таблицы `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tables`
--

INSERT INTO `tables` (`id`, `title`) VALUES
(1, 'Заказы'),
(2, 'Товары'),
(3, 'Пользователи');

-- --------------------------------------------------------

--
-- Структура таблицы `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_groups`
--

INSERT INTO `user_groups` (`id`, `title`, `color`) VALUES
(1, 'Customer', 'grey'),
(2, 'Manager', 'blue');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `core_articles`
--
ALTER TABLE `core_articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `core_goods`
--
ALTER TABLE `core_goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `core_orders`
--
ALTER TABLE `core_orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `core_stores`
--
ALTER TABLE `core_stores`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `core_users`
--
ALTER TABLE `core_users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `delivery_type`
--
ALTER TABLE `delivery_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods_categories`
--
ALTER TABLE `goods_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods_sizes`
--
ALTER TABLE `goods_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `price_range`
--
ALTER TABLE `price_range`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `core_articles`
--
ALTER TABLE `core_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `core_goods`
--
ALTER TABLE `core_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `core_orders`
--
ALTER TABLE `core_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `core_stores`
--
ALTER TABLE `core_stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `core_users`
--
ALTER TABLE `core_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `delivery_type`
--
ALTER TABLE `delivery_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `goods_categories`
--
ALTER TABLE `goods_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `goods_sizes`
--
ALTER TABLE `goods_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT для таблицы `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `price_range`
--
ALTER TABLE `price_range`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
