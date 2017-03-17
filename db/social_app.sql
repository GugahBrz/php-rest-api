-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 16-Mar-2017 às 19:07
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_app`
--
CREATE DATABASE IF NOT EXISTS `social_app` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `social_app`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `us_id` int(10) NOT NULL,
  `us_username` varchar(255) NOT NULL,
  `us_password` varchar(255) NOT NULL,
  `us_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_user`
--

INSERT INTO `tb_user` (`us_id`, `us_username`, `us_password`, `us_name`) VALUES
(1, 'everson', 'senha123', 'Everson Pereira'),
(2, 'gustavo', 'senha123', 'Gustavo Zanoni'),
(3, 'pedro', 'senha123', 'Pedro Silva'),
(4, 'joana', 'senha123', 'Joana P. Alves'),
(5, 'rodrigo', 'senha123', 'Rodrigo Rilbert');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user_friend`
--

CREATE TABLE `tb_user_friend` (
  `uf_id` int(10) NOT NULL,
  `uf_id_user` int(10) NOT NULL,
  `uf_id_friend` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_user_friend`
--

INSERT INTO `tb_user_friend` (`uf_id`, `uf_id_user`, `uf_id_friend`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 1, 3),
(4, 3, 1),
(5, 1, 4),
(6, 4, 1),
(7, 1, 5),
(8, 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user_post`
--

CREATE TABLE `tb_user_post` (
  `up_id` int(10) NOT NULL,
  `up_id_user` int(10) NOT NULL,
  `up_post` varchar(255) NOT NULL,
  `up_send_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_user_post`
--

INSERT INTO `tb_user_post` (`up_id`, `up_id_user`, `up_post`, `up_send_date`) VALUES
(1, 1, 'hello world1', '2017-03-01 12:22:57'),
(2, 2, 'hello world2', '2017-03-02 15:53:57'),
(3, 3, 'hello world3', '2017-03-03 06:13:57'),
(4, 4, 'hello world4', '2017-03-04 16:41:57'),
(5, 5, 'hello world5', '2017-03-05 19:23:57');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
