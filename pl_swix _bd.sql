-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 30-Maio-2018 às 22:13
-- Versão do servidor: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pl_swix`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `address_pl`
--

DROP TABLE IF EXISTS `address_pl`;
CREATE TABLE IF NOT EXISTS `address_pl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `address_line` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `address_pl`
--

INSERT INTO `address_pl` (`id`, `id_post`, `address_line`, `city`, `state`, `zip`, `country`) VALUES
(6, 43, 'Rua street view', 'Fortaleza', 'CE', '42636-536', 'Brazil'),
(8, 45, 'Rua qualquer bem aqui!', 'Fortaleza', 'CE', '45263-256', 'Brazil'),
(10, 47, 'Street time now', 'Laguna', 'AR', '12325-653', 'Uruguai'),
(11, 48, 'Rua qualquer bem aqui!', 'Rio de janeiro', 'RJ', '42536-536', 'Brazil'),
(13, 50, 'Rua copa, N300', 'Rio de janeiro', 'RJ', '45263-256', 'Brazil'),
(14, 57, 'Rua qualquer bem aqui!', 'Fortaleza', 'CE', '45365-565', 'Brazil'),
(23, 66, 'Rua Jose Gaudencio Moreira, 495', 'Fortaleza', 'CE', '45365-565', 'Brazil'),
(24, 67, 'Rua qualquer bem aqui!', 'Fortaleza', 'Ceara', '45263-256', 'Brazil'),
(30, 73, 'Rua aquwerr', 'Fortaleza', 'Ceara', '4525252', 'Brazil');

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'house'),
(2, 'hotel'),
(3, 'experience');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  KEY `user_one` (`user_one`),
  KEY `user_two` (`user_two`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `conversation`
--

INSERT INTO `conversation` (`c_id`, `user_one`, `user_two`, `ip`, `date_time`) VALUES
(22, 1, 2, '::1', '2018-03-30 02:40:53'),
(23, 1, 3, '::1', '2018-03-30 19:31:59'),
(24, 3, 2, '::1', '2018-04-23 18:56:40'),
(25, 1, 1, '::1', '2018-05-29 23:00:42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conversation_reply`
--

DROP TABLE IF EXISTS `conversation_reply`;
CREATE TABLE IF NOT EXISTS `conversation_reply` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `c_id_fk` int(11) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `reply` text,
  `ip` varchar(30) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`cr_id`),
  KEY `user_id_fk` (`user_id_fk`),
  KEY `c_id_fk` (`c_id_fk`),
  KEY `id_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `conversation_reply`
--

INSERT INTO `conversation_reply` (`cr_id`, `id_post`, `c_id_fk`, `user_id_fk`, `reply`, `ip`, `date_time`) VALUES
(2, 47, 22, 1, 'Olá Cicrano, fiquei interessado em sua proposta.', '::1', '2018-03-30 02:41:40'),
(3, 47, 22, 2, 'Olá tudo bem? Tá tudo 100?', '::1', '2018-03-30 14:56:15'),
(5, 47, 22, 2, 'Acho que chegou né a mensagem?', '::1', '2018-03-30 15:00:00'),
(6, 47, 22, 1, 'Chegou sim?', '::1', '2018-03-30 15:04:44'),
(7, 50, 23, 1, 'Mensagem de teste', '::1', '2018-03-30 20:28:38'),
(8, 50, 23, 1, 'Olá, tenho interesse em sua proposta como fazemos?', '::1', '2018-04-03 04:57:45'),
(9, 50, 23, 1, 'Está aí?', '::1', '2018-04-03 04:59:19'),
(10, 47, 22, 1, 'Olá tudo bem?', '::1', '2018-04-10 14:50:21'),
(11, 47, 22, 1, 'Tudo sim', '::1', '2018-04-10 14:50:31'),
(12, 50, 23, 1, 'Estou?', '::1', '2018-04-10 14:50:40'),
(13, 47, 22, 1, 'Mensagem de teste', '::1', '2018-04-10 14:57:21'),
(14, 50, 23, 1, 'Mensagem de teste', '::1', '2018-04-10 14:57:31'),
(15, 47, 23, 1, 'Olá Fulano', '::1', '2018-04-11 13:14:54'),
(16, 47, 23, 1, 'Olá fulano', '::1', '2018-04-11 13:15:17'),
(17, 47, 23, 1, 'Olá', '::1', '2018-04-11 13:15:34'),
(18, 47, 23, 1, 'Olá', '::1', '2018-04-11 13:15:46'),
(19, 47, 23, 1, 'ALOU', '::1', '2018-04-11 15:11:48'),
(20, 47, 22, 1, 'Olá', '127.0.0.1', '2018-04-11 16:47:16'),
(21, 47, 23, 1, 'Olá', '::1', '2018-04-11 16:47:25'),
(22, 43, 23, 3, 'Olá', '::1', '2018-05-29 13:06:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `date_pl`
--

DROP TABLE IF EXISTS `date_pl`;
CREATE TABLE IF NOT EXISTS `date_pl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `min_days` smallint(11) NOT NULL,
  `max_days` smallint(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `date_pl`
--

INSERT INTO `date_pl` (`id`, `id_post`, `min_days`, `max_days`) VALUES
(5, 43, 6, 16),
(7, 45, 3, 20),
(9, 47, 1, 10),
(10, 48, 3, 14),
(12, 50, 6, 18),
(21, 66, 3, 16),
(22, 67, 10, 23),
(28, 73, 3, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `events_pl`
--

DROP TABLE IF EXISTS `events_pl`;
CREATE TABLE IF NOT EXISTS `events_pl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(220) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `events_pl`
--

INSERT INTO `events_pl` (`id`, `id_post`, `id_user`, `title`, `color`, `check_in`, `check_out`) VALUES
(4, 43, 3, NULL, NULL, '2018-05-31 00:00:00', '2018-06-27 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `images_pl`
--

DROP TABLE IF EXISTS `images_pl`;
CREATE TABLE IF NOT EXISTS `images_pl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  `order_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `images_pl`
--

INSERT INTO `images_pl` (`id`, `id_post`, `title`, `url`, `order_by`) VALUES
(23, 45, NULL, 'bg-quote_trav3lling_324785b0b30ed39437.jpg', 0),
(24, 45, NULL, 'dublin_trav3lling_116395b0b30bb48be9.jpg', 1),
(25, 47, NULL, 'bg-quote_trav3lling_218555b0acfa454dc9.jpg', 0),
(26, 47, NULL, 'img1_trav3lling_65165b0acfc4e32f9.jpg', 1),
(27, 48, NULL, 'california_trav3lling_243335b0b37660dc9b.jpg', 0),
(28, 48, NULL, 'dublin_trav3lling_276355b0b378490c2f.jpg', 1),
(29, 48, NULL, 'paris_trav3lling_168595b0b37cbb7c5a.jpg', 2),
(30, 50, NULL, 'dublin_trav3lling_105625b0ad041c7e6c.jpg', 0),
(37, 57, NULL, 'b130f74271392e680bee4f43509dc27f.jpg', 0),
(47, 66, NULL, 'fc3e69be2bab5dbb8fd7b588be050a66.jpg', 0),
(48, 67, NULL, 'california_trav3lling_199405b0b37e8d53b9.jpg', 0),
(49, 67, NULL, 'trilha_trav3lling_210695b0b37f004e68.jpg', 0),
(50, 67, NULL, 'img-circle2_trav3lling_125465b0b37f889434.jpg', 0),
(51, 43, NULL, 'california_trav3lling_111965b0b3070dff28.jpg', 0),
(52, 43, NULL, 'dublin_trav3lling_88905b06f86388107.jpg', 0),
(53, 43, NULL, 'trilha_trav3lling_95795b06f86f6c733.jpg', 0),
(54, 43, NULL, 'paris_trav3lling_145365b06f877be58c.jpg', 0),
(55, 43, NULL, 'bg-quote_trav3lling_198095b06f8e4efa1c.jpg', 0),
(56, 43, NULL, 'paris_trav3lling_124225b06f9338bc9f.jpg', 0),
(57, 45, NULL, 'img1_trav3lling_111485b0b31bc6c9ac.jpg', 0),
(58, 45, NULL, 'img2_trav3lling_78345b0b31eb1cdd2.jpg', 0),
(59, 45, NULL, 'dublin_trav3lling_232545b0b320d184bf.jpg', 0),
(60, 45, NULL, 'img1_trav3lling_300065b0b325fa5189.jpg', 0),
(61, 48, NULL, 'dublin_trav3lling_96365b0b360d5cf47.jpg', 0),
(62, 48, NULL, 'img2_trav3lling_78745b0b377455384.jpg', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inbox_msg`
--

DROP TABLE IF EXISTS `inbox_msg`;
CREATE TABLE IF NOT EXISTS `inbox_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_user_to` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `message` text NOT NULL,
  `id_notifications` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `inbox_msg`
--

INSERT INTO `inbox_msg` (`id`, `id_post`, `id_user`, `id_user_to`, `date_time`, `message`, `id_notifications`) VALUES
(4, 47, 2, 1, '2018-03-27 02:55:14', 'Olá, tudo bem?', 2),
(6, 47, 1, 2, '2018-03-27 04:39:16', 'Tudo e com você?', 2),
(7, 47, 2, 1, '2018-03-27 04:49:32', 'Tudo bem também', 2),
(9, 47, 1, 2, '2018-03-27 04:50:48', 'Também tá tudo bem?', 2),
(10, 47, 2, 1, '2018-03-27 04:51:06', 'Ok, tudo bem também', 2),
(21, 47, 1, 2, '2018-03-27 22:02:00', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 2),
(22, 47, 1, 2, '2018-03-28 00:09:08', 'Ok', 2),
(23, 47, 2, 1, '2018-03-28 09:35:41', 'Olá tudo bem?', 2),
(27, 43, 3, 1, '2018-03-28 23:38:59', 'Olá tudo bem?', 1),
(36, 47, 1, 2, '2018-03-29 02:49:11', 'Funciona?', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=1350 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `languages`
--

INSERT INTO `languages` (`id`, `id_post`, `id_user`, `name`) VALUES
(82, 47, 2, 'Alemao'),
(84, 50, 3, 'Portugues'),
(85, 57, 2, 'English'),
(86, 66, 1, 'English'),
(161, 48, NULL, 'Spanish'),
(175, 45, NULL, 'Portugues'),
(196, 73, NULL, 'Portugues'),
(197, 73, NULL, 'English'),
(208, 67, NULL, 'English'),
(209, 67, NULL, 'Portugues'),
(1347, 43, NULL, 'Portugues'),
(1348, 43, NULL, 'English'),
(1349, 43, NULL, 'Frances');

-- --------------------------------------------------------

--
-- Estrutura da tabela `languages_user`
--

DROP TABLE IF EXISTS `languages_user`;
CREATE TABLE IF NOT EXISTS `languages_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `languages_user`
--

INSERT INTO `languages_user` (`id`, `id_user`, `name`) VALUES
(75, 1, 'English'),
(76, 1, 'Portugues'),
(79, 3, 'portugues'),
(80, 3, 'english');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `ready` tinyint(1) DEFAULT '0',
  `link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts_pl`
--

DROP TABLE IF EXISTS `posts_pl`;
CREATE TABLE IF NOT EXISTS `posts_pl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts_pl`
--

INSERT INTO `posts_pl` (`id`, `id_user`, `id_category`, `title`, `description`, `url`, `date_create`) VALUES
(43, 1, 1, 'Meu outro título qualquer aqui!', 'Meu lugar qualquer aqui!', 'b130f74271392e680bee4f43509dc27f.jpg', '2018-03-03 12:44:22'),
(45, 1, 2, 'Meu título de teste para testar', 'Meu título de teste para testar  Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar', 'f76a059ae1ed1b47142085bd25202665.jpg', '2018-03-03 19:20:51'),
(47, 2, 1, 'Apenas testando o update novamente e novamente', 'Apenas testando o update Apenas testando o update Apenas testando o update  Apenas testando o update  Apenas testando o update  Apenas testando o update ', '11239ad35c7c0584d8eaf06be8afc4f2.jpg', '2018-03-04 15:01:25'),
(48, 1, 1, 'Meu título de teste para testar', 'Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar', '0429b5beb9b3f471b50314bfb2b90faf.jpg', '2018-03-05 00:37:16'),
(50, 3, 1, 'Casa em Copacabana  ', 'Lorem ipsum facilisis leo faucibus volutpat per, egestas rutrum tristique mollis. nostra rhoncus tincidunt scelerisque consequat duis gravida dui arcu commodo pretium sagittis dictum cubilia nisi, bibendum orci mauris nulla et sociosqu urna ipsum torquent convallis ut eros. nunc potenti turpis ultricies felis varius consectetur porta molestie varius, luctus hendrerit rutrum molestie lorem ultricies vivamus primis, pellentesque habitant ligula malesuada nisl taciti feugiat etiam. velit aenean viverra diam gravida malesuada accumsan sem varius mi euismod curabitur etiam taciti semper vivamus, lorem risus aliquet molestie mauris taciti tincidunt arcu fusce ultrices amet pulvinar curabitur. ', '31abc0cb6e12e48b89afa6e8e84e4c51.jpg', '2018-03-08 13:17:54'),
(57, 2, 3, 'Meu título de teste para testar', 'Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar', 'b130f74271392e680bee4f43509dc27f.jpg', '2018-03-14 19:30:43'),
(66, 2, 1, 'Meu título de teste para testar', 'Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar Meu título de teste para testar', 'fc3e69be2bab5dbb8fd7b588be050a66.jpg', '2018-03-14 23:06:25'),
(67, 1, 1, 'New house in Canada', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'ccf5f174df782d8a5d3547fab96ed828.jpg', '2018-03-26 01:39:19'),
(73, 1, 1, 'Qualquer', 'Tu pode assinar ', NULL, '2018-04-10 22:38:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `relations`
--

DROP TABLE IF EXISTS `relations`;
CREATE TABLE IF NOT EXISTS `relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_from` int(11) NOT NULL,
  `id_user_to` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `relations`
--

INSERT INTO `relations` (`id`, `id_user_from`, `id_user_to`, `id_post`, `status`) VALUES
(39, 1, 2, 47, 0),
(40, 3, 1, 43, 1),
(41, 2, 1, 43, 0),
(43, 1, 3, 50, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relations_sub`
--

DROP TABLE IF EXISTS `relations_sub`;
CREATE TABLE IF NOT EXISTS `relations_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_relations` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `relations_sub`
--

INSERT INTO `relations_sub` (`id`, `id_user`, `id_relations`) VALUES
(1, 1, 39);

-- --------------------------------------------------------

--
-- Estrutura da tabela `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=1258 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `skills`
--

INSERT INTO `skills` (`id`, `id_post`, `id_user`, `name`) VALUES
(9, 47, NULL, 'Tomorrow'),
(10, 48, NULL, 'Skills, Skills, Skills'),
(12, 50, NULL, 'skils'),
(14, 57, NULL, 'Qualquer'),
(23, 66, NULL, 'Habilidades'),
(84, 45, NULL, 'Skill'),
(85, 45, NULL, 'habilidades'),
(104, 73, NULL, 'Skills'),
(105, 73, NULL, 'Habi'),
(116, 67, NULL, 'Skill'),
(117, 67, NULL, 'habilidade'),
(1255, 43, NULL, 'Habilidades'),
(1256, 43, NULL, 'Habilidades2'),
(1257, 43, NULL, 'Habilidades3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `skills_user`
--

DROP TABLE IF EXISTS `skills_user`;
CREATE TABLE IF NOT EXISTS `skills_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `skills_user`
--

INSERT INTO `skills_user` (`id`, `id_user`, `name`) VALUES
(40, 1, 'Master'),
(41, 1, 'Chef'),
(42, 1, 'Web'),
(45, 3, 'habilidades'),
(46, 3, 'skill');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `bio` text,
  `phone` varchar(50) DEFAULT NULL,
  `date_joined` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `url`, `bio`, `phone`, `date_joined`) VALUES
(1, 'Fulano Almeida de Souza', 'fulano@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'a462f8c334e328ba8f572ca0a51c4861.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '3233-5356', '2018-02-28 20:51:58'),
(2, 'Cicrano Irmão de Fulano', 'cicrano@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'c4064d11f1fe1da0ccffbf1a43f38b8c.jpg', '', NULL, '2018-03-01 02:28:31'),
(3, 'Beltrano Belina', 'beltrano@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', NULL, '2018-03-08 12:21:57'),
(4, 'Alba', 'alba@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2018-03-15 11:17:44');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `address_pl`
--
ALTER TABLE `address_pl`
  ADD CONSTRAINT `address_pl_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts_pl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`user_one`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`user_two`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `conversation_reply`
--
ALTER TABLE `conversation_reply`
  ADD CONSTRAINT `conversation_reply_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversation_reply_ibfk_2` FOREIGN KEY (`c_id_fk`) REFERENCES `conversation` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `date_pl`
--
ALTER TABLE `date_pl`
  ADD CONSTRAINT `date_pl_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts_pl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `images_pl`
--
ALTER TABLE `images_pl`
  ADD CONSTRAINT `images_pl_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts_pl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `languages_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts_pl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `languages_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `languages_user`
--
ALTER TABLE `languages_user`
  ADD CONSTRAINT `languages_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `posts_pl`
--
ALTER TABLE `posts_pl`
  ADD CONSTRAINT `posts_pl_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_pl_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

--
-- Limitadores para a tabela `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts_pl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skills_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `skills_user`
--
ALTER TABLE `skills_user`
  ADD CONSTRAINT `skills_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
