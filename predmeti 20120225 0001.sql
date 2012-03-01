
--
-- Definition of table `Predmeti_table`
--

DROP TABLE IF EXISTS `Predmeti_table`;
CREATE TABLE `Predmeti_table` (
  `Predmet_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ',
  `Name` text NOT NULL COMMENT 'Название',
  `chasi` int(4) unsigned DEFAULT NULL COMMENT 'Количество часов предмета',
  `tip` int(1) unsigned NOT NULL COMMENT 'Тип (Зачет 0, Экзамен 1, Практика 2, Курсовик 3)',
  `svyaz` int(10) unsigned DEFAULT NULL COMMENT 'Связь с ID',
  `semestr` int(1) unsigned NOT NULL COMMENT 'Семестр',
  `programma` int(1) unsigned NOT NULL COMMENT 'Программа обучения (Базовая 0, Непрерывная 1, оба направления 2)',
  PRIMARY KEY (`Predmet_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=217 DEFAULT CHARSET=cp1251 COMMENT='Таблица предметов';

--
-- Dumping data for table `Predmeti_table`
--

/*!40000 ALTER TABLE `Predmeti_table` DISABLE KEYS */;
INSERT INTO `Predmeti_table` (`Predmet_ID`,`Name`,`chasi`,`tip`,`svyaz`,`semestr`,`programma`) VALUES 
 (122,'Русский язык',0,0,NULL,1,2),
 (121,'Информатика',0,0,NULL,1,2),
 (120,'Физика',0,0,NULL,1,2),
 (119,'Математика',0,1,NULL,1,2),
 (118,'История',0,1,NULL,1,2),
 (123,'Литература',0,0,NULL,1,2),
 (124,'Иностранный язык',0,0,NULL,1,2),
 (125,'Химия',0,0,NULL,1,2),
 (126,'Биология',0,0,NULL,1,2),
 (127,'Обществознание',0,0,NULL,1,2),
 (128,'Основы безопасности жизнедеятельности',0,0,NULL,1,2),
 (129,'Физкультура',0,0,NULL,1,2),
 (130,'Литература',0,1,NULL,2,2),
 (131,'Математика',0,1,NULL,2,2),
 (132,'Физика',0,1,NULL,2,2),
 (133,'Русский язык',0,0,NULL,2,2),
 (134,'Информатика',0,0,NULL,2,2),
 (135,'Иностранный язык',0,0,NULL,2,2),
 (136,'История',0,0,NULL,2,2),
 (137,'Обществознание',0,0,NULL,2,2),
 (138,'Химия',0,0,NULL,2,2),
 (139,'Биология',0,0,NULL,2,2),
 (140,'Физкультура',0,0,NULL,2,2),
 (141,'Элементы высшей математика',0,1,NULL,3,2),
 (142,'Основы алгоритмизации и программирования',0,1,NULL,3,2),
 (143,'Операционные системы и среды',0,0,NULL,3,2),
 (144,'Архитектура ЭВМ',0,0,NULL,3,2),
 (145,'Русский язык и культура речи',0,0,NULL,3,2),
 (146,'Экологические основы природопользования',0,0,NULL,3,2),
 (147,'Иностранный язык',0,0,NULL,3,2),
 (148,'Основы экономики',0,0,NULL,3,2),
 (149,'Физкультура',0,0,NULL,3,2),
 (150,'Практика по освоению методики исследовательской работы',0,2,NULL,3,2),
 (151,'Отечественная история',0,0,NULL,3,0),
 (152,'Разработка мультимедийных презентаций',0,0,NULL,3,0),
 (153,'Основы политологии и социологии',0,1,NULL,4,2),
 (154,'Элементы высшей математики',0,1,NULL,4,2),
 (155,'Операционные системы и среды',0,1,NULL,4,2),
 (156,'Архитектура ЭВМ',0,1,NULL,4,2),
 (157,'Основы алгоритмизации и программирования',0,1,NULL,4,2),
 (158,'Русский язык и культура речи',0,0,NULL,4,2),
 (159,'Отечественная история',0,0,NULL,4,1),
 (160,'Информационные технологии',0,0,NULL,4,2),
 (161,'Метрология, стандартизация и сертификация',0,0,NULL,4,2),
 (162,'Теория вероятности и математическая статистика',0,0,NULL,4,2),
 (163,'Численные методы',0,0,NULL,4,2),
 (164,'Физкультура',0,0,NULL,4,2),
 (165,'Разработка приложений с использованием инструментальных средств',0,2,NULL,4,2),
 (166,'Разработка мультимедийных презентаций',0,2,NULL,4,1),
 (167,'Основы профессиональной психологии и этики',0,2,NULL,4,2),
 (168,'Теория вероятности и математическая статистика',0,1,NULL,5,2),
 (169,'Математические методы',0,1,NULL,5,1),
 (170,'Культурология',0,1,NULL,5,0),
 (171,'Объектно ориентированное программирование',0,0,NULL,5,1),
 (172,'Практика по ООП',0,2,NULL,5,1),
 (173,'Безопасность жизнедеятельности',0,0,NULL,5,2),
 (174,'Технические средства информатизации',0,0,NULL,5,2),
 (175,'Физкультура',0,0,NULL,5,2),
 (176,'Дискретная математика',0,0,NULL,5,2),
 (177,'Иностранный язык',0,0,NULL,5,2),
 (178,'Базы данных',0,0,NULL,5,2),
 (179,'Технологии разработки программного продукта',0,0,NULL,5,2),
 (180,'Элементы компьютерного дизайна',0,0,NULL,5,0),
 (181,'Пакеты прикладных программ',0,0,NULL,5,2),
 (182,'Основы филисофии',0,0,NULL,5,2),
 (183,'Технологии разработки программного продукта',0,1,NULL,6,2),
 (184,'Экономика отрасли',0,1,NULL,6,2),
 (185,'Культурология',0,1,NULL,6,1),
 (186,'Дискретная математика',0,1,NULL,6,2),
 (187,'Объектно ориентированное программирование',0,1,NULL,6,1),
 (188,'Математические методы',0,1,NULL,6,0),
 (189,'Основы права',0,1,NULL,6,0),
 (190,'Основы права',0,0,NULL,6,1),
 (191,'Иностранный язык',0,0,NULL,6,2),
 (192,'Базы данных',0,0,NULL,6,2),
 (193,'Компьютерные сети',0,0,NULL,6,2),
 (194,'Безопасность жизнедеятельности',0,0,NULL,6,2),
 (195,'Разработка удаленных баз данных',0,0,NULL,6,2),
 (196,'Информационная безопасность',0,0,NULL,6,2),
 (197,'Практика по ООП',0,2,NULL,6,1),
 (198,'Физкультура',0,0,NULL,6,2),
 (199,'Практика',0,2,NULL,6,0),
 (200,'Технологии разработки программного продукта КП',0,3,NULL,6,2),
 (201,'Математическая логика и теория алгоритмов',0,1,NULL,7,1),
 (202,'Программное обеспечение компьютерных сетей',0,1,NULL,7,2),
 (203,'Разработка удаленных баз данных',0,1,NULL,7,2),
 (204,'Электроника и электротехника',0,1,NULL,7,2),
 (205,'Компьютерная геометрия и графика',0,1,NULL,7,2),
 (206,'Информационная безопасность',0,0,NULL,7,2),
 (207,'Иностранный язык',0,0,NULL,7,2),
 (208,'Физкультура',0,0,NULL,7,2),
 (209,'Правовое обеспечение профессиональной деятельности',0,0,NULL,7,2),
 (210,'Менеджмент',0,0,NULL,7,2),
 (211,'Основы построения АИС',0,0,NULL,7,2),
 (212,'Математическая логика и теория алгоритмов',0,0,NULL,7,2),
 (213,'Пакеты прикладных программ',0,0,NULL,7,2),
 (214,'Экономика отрасли КП',0,3,NULL,7,2),
 (215,'Математические методы КП',0,3,NULL,7,2),
 (216,'Иностранный язык',0,0,NULL,4,2);
/*!40000 ALTER TABLE `Predmeti_table` ENABLE KEYS */;