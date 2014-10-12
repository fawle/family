-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4152
-- Date/time:                    2014-10-12 12:34:25
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table family.marriage
CREATE TABLE IF NOT EXISTS `marriage` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date_started` date NOT NULL,
  `date_ended` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table family.marriage: ~3 rows (approximately)
/*!40000 ALTER TABLE `marriage` DISABLE KEYS */;
INSERT INTO `marriage` (`id`, `date_started`, `date_ended`) VALUES
	(1, '2000-03-20', '0000-00-00'),
	(2, '0000-00-00', '0000-00-00'),
	(3, '0000-00-00', '0000-00-00');
/*!40000 ALTER TABLE `marriage` ENABLE KEYS */;


-- Dumping structure for table family.people
CREATE TABLE IF NOT EXISTS `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patronymic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `married_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('F','M') COLLATE utf8_unicode_ci NOT NULL,
  `parent_1` int(11) DEFAULT NULL,
  `parent_2` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_death` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `P1` (`parent_1`),
  KEY `P2` (`parent_2`),
  CONSTRAINT `P1` FOREIGN KEY (`parent_1`) REFERENCES `people` (`id`),
  CONSTRAINT `P2` FOREIGN KEY (`parent_2`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table family.people: ~119 rows (approximately)
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` (`id`, `first_name`, `patronymic`, `last_name`, `married_name`, `gender`, `parent_1`, `parent_2`, `date_of_birth`, `date_of_death`) VALUES
	(1, 'Григорий', 'Трофимович', 'Широков', '', 'M', NULL, NULL, '1877-01-01', '1933-01-01'),
	(2, 'Елизавета', NULL, '', 'Широкова', 'F', NULL, NULL, '0000-00-00', '1906-01-01'),
	(3, 'Фекла', 'Григорьевна', 'Елисеева', 'Широкова', 'F', NULL, NULL, '1885-10-23', '1961-02-01'),
	(4, 'Константин', 'Григорьевич', 'Широков', '', 'M', 1, 2, '1900-06-01', '1966-02-01'),
	(5, 'Николай', 'Григорьевич', 'Широков', '', 'M', 1, 2, '1904-01-01', '0000-00-00'),
	(6, 'Павел', 'Григорьевич', 'Широков', '', 'M', 1, 3, '1907-01-01', NULL),
	(7, 'Алексей', 'Григорьевич', 'Широков', '', 'M', 1, 3, '1909-01-01', NULL),
	(8, 'Михаил', 'Григорьевич', 'Широков', '', 'M', 1, 3, '1911-01-01', NULL),
	(9, 'Мария', 'Григорьевна', 'Широкова', 'Чижова', 'F', 1, 3, '1914-02-14', NULL),
	(10, 'Нил', 'Григорьевич', 'Широков', '', 'M', 1, 3, '1918-09-27', NULL),
	(11, 'Владимир', 'Григорьевич', 'Широков', '', 'M', 1, 3, '1922-07-24', NULL),
	(12, 'Ирина', 'Григорьевна', 'Широкова', 'Прудниченко', 'F', 1, 3, '1924-01-01', NULL),
	(13, 'Клавдия', 'Григорьевна', 'Широкова', 'Раенко', 'F', 1, 3, '1931-02-23', NULL),
	(14, 'Александра ', 'Николаевна', 'Борисова', 'Широкова', 'F', NULL, NULL, '1913-03-06', NULL),
	(15, 'Лариса', 'Васильевна', '', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(16, 'Мария', 'Ивановна', 'Мызникова', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(17, 'Александра', NULL, '', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(18, 'Лидия ', 'Михайловна', 'Прускова', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(19, 'Сергей ', 'Александрович', 'Чижов', '', 'M', NULL, NULL, NULL, NULL),
	(20, 'Лидия ', 'Федоровна', 'Ефимова', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(21, 'Нина ', 'Степановна', '', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(22, 'Николай', 'Николаевич', 'Прудниченко', '', 'M', NULL, NULL, '1925-05-10', NULL),
	(23, 'Николай ', 'Савельевич', 'Раенко', '', 'M', NULL, NULL, '0000-00-00', '0000-00-00'),
	(24, 'Виталий', 'Константинович', 'Широков', '', 'M', 4, 14, '1936-08-01', NULL),
	(25, 'Григорий', 'Константинович', 'Широков', '', 'M', 4, 14, '1938-01-01', NULL),
	(26, 'Наталья', 'Константиновна', 'Широкова', 'Глухова', 'F', 4, 14, '1943-01-18', NULL),
	(27, 'Юрий', 'Николаевич', 'Широков', '', 'M', 5, 15, NULL, NULL),
	(28, 'Анатолий', 'Николаевич', 'Широков', '', 'M', 5, 15, NULL, NULL),
	(29, 'Леонид', 'Николаевич', 'Широков', '', 'M', 5, 15, NULL, NULL),
	(30, 'Юрий', 'Павлович', 'Широков', '', 'M', 6, 16, NULL, NULL),
	(31, 'Алла', 'Павловна', 'Широкова', 'Мансурова', 'F', 6, 16, NULL, NULL),
	(32, 'Лев', 'Алексеевич', 'Широков', '', 'M', 7, 17, NULL, NULL),
	(33, 'Игорь', 'Алексеевич', 'Широков', '', 'M', 7, 17, NULL, NULL),
	(34, 'Михаил ', 'Михайлович', 'Широков', '', 'M', 8, 18, NULL, NULL),
	(35, 'Римма ', 'Сергеевна', 'Чижова', 'Головтеева', 'F', 9, 19, NULL, NULL),
	(36, 'Галина', 'Сергеевна', 'Чижова', 'Ванчугова', 'F', 9, 19, NULL, NULL),
	(37, 'Валентина', 'Сергеевна', 'Чижова', 'Морозова', 'F', 9, 19, NULL, NULL),
	(38, 'Вадим', 'Сергеевич', 'Чижов', '', 'M', 9, 19, NULL, NULL),
	(39, 'Вера', 'Сергеевна', 'Чижова', 'Понтаненко', 'F', 9, 19, NULL, NULL),
	(40, 'Алексей', 'Нилович', 'Широков', '', 'M', 10, 20, NULL, NULL),
	(41, 'Наталья', 'Ниловна', 'Широкова', 'Семенова', 'F', 10, 20, NULL, NULL),
	(42, 'Наталья', 'Владимировна', 'Широкова', '', 'F', 11, 21, NULL, NULL),
	(43, 'Александр', 'Николаевич', 'Прудниченко', '', 'M', 12, 22, NULL, NULL),
	(44, 'Ольга', 'Николаевна', 'Прудниченко', 'Куртеева', 'F', 12, 22, NULL, NULL),
	(45, 'Александр', 'Николаевич', 'Раенко', '', 'M', 13, 23, NULL, NULL),
	(46, 'Ирина', 'Георгиевна', 'Мухина', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(47, 'Лариса', 'Владимировна', 'Кузнецова', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(48, 'Михаил', 'Семенович', 'Глухов', '', 'M', NULL, NULL, NULL, NULL),
	(49, 'Галина', NULL, '', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(50, 'Инга', NULL, '', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(51, '', NULL, '', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(52, 'Инга', NULL, '', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(53, 'Михаил', 'Васильевич', 'Мансуров', '', 'M', NULL, NULL, NULL, NULL),
	(54, 'Татьяна', NULL, '', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(55, 'Галина', NULL, '', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(56, 'Владимир', 'Иванович', 'Головтеев', '', 'M', NULL, NULL, NULL, NULL),
	(57, 'Юрий ', 'Александрович', 'Ванчугов', '', 'M', NULL, NULL, NULL, NULL),
	(58, 'Василий ', 'Михайлович', 'Морозов', '', 'M', NULL, NULL, NULL, NULL),
	(59, 'Евгений', 'Павлович', 'Понтоненко', '', 'M', NULL, NULL, NULL, NULL),
	(60, 'Галина', 'Александровна', 'Долгова', 'Широкова', 'M', NULL, NULL, NULL, NULL),
	(61, 'Александр', 'Васильевич', 'Селиванов', '', 'M', NULL, NULL, NULL, NULL),
	(62, '', NULL, '', '', 'M', NULL, NULL, NULL, NULL),
	(63, 'Наталья', '', 'Прудниченко', '', 'F', NULL, NULL, '0000-00-00', '0000-00-00'),
	(64, 'Виктор', 'Викторович', 'Куртеев', '', 'M', NULL, NULL, NULL, NULL),
	(65, 'Наталья', 'Степановна', 'Никифорова', 'Раенко', 'F', NULL, NULL, NULL, NULL),
	(66, 'Леонид ', 'Витальевич', 'Широков', '', 'M', 24, 46, NULL, NULL),
	(67, 'Александр', 'Витальевич', 'Широков', '', 'M', 24, 46, NULL, NULL),
	(68, 'Константин', 'Григорьевич', 'Широков', '', 'F', 25, 47, NULL, NULL),
	(69, 'Алексей', 'Михайлович', 'Глухов', '', 'M', 26, 48, '0000-00-00', '0000-00-00'),
	(70, 'Николай', 'Юрьевич', 'Широков', '', 'M', 27, 49, NULL, NULL),
	(71, '', 'Юрьевна', 'Широкова', '', 'F', 27, 49, NULL, NULL),
	(72, 'Андрей', 'Юрьевич', 'Широков', '', 'M', 30, 52, '0000-00-00', NULL),
	(73, 'Михаил', 'Юрьевич', 'Широков', '', 'M', 30, 52, '0000-00-00', NULL),
	(74, 'Елена', 'Михайловна', 'Мансурова', '', 'F', 31, 53, NULL, NULL),
	(75, 'Инга', 'Михайловна', 'Мансурова', '', 'F', 31, 53, NULL, NULL),
	(76, '', 'Игоревна', 'Широкова', '', 'F', 33, 54, NULL, NULL),
	(77, 'Алексей', 'Игоревич', 'Широков', '', 'F', 33, 54, NULL, NULL),
	(78, 'Кирилл', 'Михайлович', 'Широков', '', 'M', 34, 55, NULL, NULL),
	(79, 'Валерий', 'Михайлович', 'Широков', '', 'M', 34, 55, NULL, NULL),
	(80, 'Александр', 'Владимирович', 'Головтеев', '', 'M', 35, 56, NULL, NULL),
	(81, '', 'Владимирович', 'Головтеев', '', 'M', 35, 56, NULL, NULL),
	(82, 'Андрей', 'Юрьевич', 'Ванчугов', '', 'M', 36, 57, NULL, NULL),
	(83, 'Максим', 'Юрьевич', 'Ванчугов', '', 'M', 36, 57, NULL, NULL),
	(84, 'Игорь', 'Васильевич', 'Морозов', '', 'M', 37, 58, NULL, NULL),
	(85, 'Ирина', 'Евгеньевна', 'Понтоненко', '', 'F', 39, 59, NULL, NULL),
	(86, 'Марина', 'Евгеньевна', 'Понтоненко', '', 'F', 39, 59, NULL, NULL),
	(87, 'Алексей', 'Алексеевич', 'Широков', '', 'M', 40, 60, NULL, NULL),
	(88, 'Ирина', 'Алексеевна', 'Широкова', 'Челякова', 'F', 40, 60, NULL, NULL),
	(89, 'Юлия', 'Александровна', 'Кравченко', '', 'F', 41, 61, NULL, NULL),
	(90, 'Ольга', 'Александровна', 'Кравченко', 'Селиванова', 'F', 41, 61, NULL, NULL),
	(91, 'Владимир', 'Николаевич', 'Годин', '', 'M', 42, 62, NULL, NULL),
	(92, 'Ирина', NULL, '', '', 'F', 42, 62, NULL, NULL),
	(93, 'Ольга', 'Александровна', 'Прудниченко', '', 'F', 43, 63, NULL, NULL),
	(94, 'Екатерина', 'Викторовна', 'Куртеева', '', 'F', 44, 64, NULL, NULL),
	(95, 'Алексей', 'Александрович', 'Раенко', '', 'M', 45, 65, NULL, NULL),
	(96, 'Александр', 'Александрович', 'Раенко', '', 'M', 45, 65, NULL, NULL),
	(97, 'Наталья', NULL, '', 'Широкова', 'F', NULL, NULL, NULL, NULL),
	(98, 'Надежда', 'Павловна', 'Глухова', '', 'F', NULL, NULL, NULL, NULL),
	(99, '', NULL, '', '', 'F', NULL, NULL, NULL, NULL),
	(100, 'Наталья', '', 'Головтеева', '', 'F', NULL, NULL, NULL, NULL),
	(101, 'Елена', NULL, 'Ванчугова', '', 'F', NULL, NULL, NULL, NULL),
	(102, 'Ирина', NULL, 'Морозова', '', 'F', NULL, NULL, NULL, NULL),
	(103, 'Александр', NULL, '', '', 'M', NULL, NULL, NULL, NULL),
	(104, 'Анжела', NULL, '', '', 'F', NULL, NULL, NULL, NULL),
	(105, 'Александр', 'Евгеньевич', 'Челяков', '', 'M', NULL, NULL, NULL, NULL),
	(106, 'Дмитрий', 'Александрович', 'Кравченко', '', 'M', NULL, NULL, NULL, NULL),
	(107, 'Иван', 'Алексеевич', 'Глухов', '', 'M', 69, 98, NULL, NULL),
	(108, 'Елизавета', 'Алексеевна', 'Глухова', '', 'F', 69, 98, NULL, NULL),
	(109, '', NULL, '', '', 'F', 76, 99, NULL, NULL),
	(110, 'Мария', 'Александровна', 'Головтеева', '', 'F', 80, 100, NULL, NULL),
	(111, 'Владимир ', 'Андреевич', 'Ванчугов', '', 'M', 82, 101, NULL, NULL),
	(112, 'Валерия', 'Андреевна', 'Ванчугова', '', 'F', 82, 101, NULL, NULL),
	(113, 'Дмитрий', 'Игоревич', 'Морозов', '', 'M', 84, 102, NULL, NULL),
	(114, 'Екатерина', NULL, '', '', 'F', 86, 103, NULL, NULL),
	(115, 'Лидия', 'Алексеевна', 'Широкова', '', 'F', 87, 104, NULL, NULL),
	(116, 'Евгений ', 'Александрович', 'Челяков', '', 'M', 88, 105, NULL, NULL),
	(117, '', NULL, '', '', 'M', NULL, 92, NULL, NULL),
	(118, 'Евгения', NULL, 'Сябо', 'Раенко', 'F', NULL, NULL, NULL, NULL),
	(119, 'Наталья', '', 'Андреева', 'Раенко', 'F', NULL, NULL, NULL, NULL),
	(120, 'Алексей', 'Алексеевич', 'Раенко', '', 'M', 95, 118, NULL, NULL),
	(121, 'Сергей', 'Александрович', 'Раенко', '', 'M', 96, 119, NULL, NULL),
	(122, 'Тони', NULL, 'Фоул', '', 'M', NULL, NULL, '0000-00-00', NULL),
	(123, 'Николай', 'Александрович', 'Прудниченко', '', 'M', 43, 124, NULL, NULL),
	(124, 'Галина', NULL, '', 'Прудниченко', 'F', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `people` ENABLE KEYS */;


-- Dumping structure for table family.spouses
CREATE TABLE IF NOT EXISTS `spouses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marriage_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table family.spouses: ~6 rows (approximately)
/*!40000 ALTER TABLE `spouses` DISABLE KEYS */;
INSERT INTO `spouses` (`id`, `marriage_id`, `person_id`) VALUES
	(1, 1, 94),
	(2, 1, 122),
	(3, 2, 1),
	(4, 2, 2),
	(5, 3, 1),
	(6, 3, 3);
/*!40000 ALTER TABLE `spouses` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
