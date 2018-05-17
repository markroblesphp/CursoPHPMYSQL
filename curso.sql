-- phpMyAdmin SQL Dump
-- version 4.0.10.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2018 at 12:56 PM
-- Server version: 5.1.73
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `curso`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_publicacion` int(11) NOT NULL,
  `fechahora` datetime DEFAULT NULL,
  `textocomentario` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_publicacion` (`id_publicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `email` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `a_paterno` varchar(255) NOT NULL,
  `a_materno` varchar(255) NOT NULL,
  `nacio` date NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`email`, `pass`, `nombre`, `a_paterno`, `a_materno`, `nacio`) VALUES
('corre@gmail.com', '$2y$10$jdz985pP0Y9BLlmD9yFJcu9KSmmEyfv44pqmp3JqnV4Sb1K1PELWy', 'nombresito 2', 'paterno 2', 'materno 2', '2000-01-01'),
('correo3@gmail.com', '$2y$10$Fa.oDD.zEUbDJBiSbHtP2e851v3xaRLKLG/3gA5KTB2jKAZKzjK/G', 'Nombre3', 'paterno3', 'materno3', '2017-06-09'),
('correofinal@gmail.com', '$2y$10$hvBoRw4aCeVi5QhM2DNYcO8kMu/qo5FfLUUgw64QoZ8ehbUwDEjDW', 'nombresito final', 'apellido final', 'materno final', '1998-10-10'),
('correox@x.com', '$2y$10$ae6lsQaZl2MCBcq9iR637eTTkbEsISgcyA58koU7QEqJ.DnV7WBQu', 'kldaksdfk', 'kldajksdf', 'kdaksdf', '1900-10-10'),
('editor2@gmail.com', '$2y$10$K0r.S4ZtTgR70L1AHdDfmOmaRCF95oli4Zahi3HlUxEl2ntXYRUW6', 'nombre 2', 'apellido paterno 2', 'apellido matero 2', '2005-10-10'),
('editor5@lalala.com', '$2y$10$8ddp7qcPtCsGMmGDvUW8f.sS9tHnAq1YW99CB2VPqUDReZrPrTgwa', 'nombre 5', 'paterno 5', 'materno 5', '1990-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `publicacion`
--

CREATE TABLE IF NOT EXISTS `publicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_autor` varchar(255) NOT NULL,
  `fechahora` datetime DEFAULT NULL,
  `titulo` text NOT NULL,
  `textopublicacion` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email_autor` (`email_autor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `publicacion`
--

INSERT INTO `publicacion` (`id`, `email_autor`, `fechahora`, `titulo`, `textopublicacion`) VALUES
(4, 'corre@gmail.com', '2018-05-17 08:30:15', 'Funciono', 'funciono '),
(5, 'editor2@gmail.com', '2018-05-17 09:01:16', 'nota nueva', 'del numero editor 2 nota agregada'),
(6, 'correo3@gmail.com', '2018-05-17 09:30:19', 'script de java', '&lt;script&gt;\r\n    alert(&quot;I am an alert box!&quot;);\r\n&lt;/script&gt;'),
(7, 'editor5@lalala.com', '2018-05-17 10:56:40', 'aaaa', 'ddddd'),
(8, 'corre@gmail.com', '2018-05-17 11:37:32', 'noticia otra', 'noticiaaaaaaa'),
(9, 'corre@gmail.com', '2018-05-17 11:55:02', 'lalala', 'kdakjsdfasdf'),
(10, 'corre@gmail.com', '2018-05-17 11:56:39', 'asdfasfdf', 'asdfasdfdf'),
(11, 'correo3@gmail.com', '2018-05-17 12:06:30', 'ddddddddddddddddd', 'dddddddddddddddddddddd'),
(12, 'corre@gmail.com', '2018-05-17 12:28:57', 'aaaaaaaaaaaaaaaaaaaaaaaa', 'dddddddddddddddddddaleeeeeeeeee');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `id_publicacion_fk` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `email_autor_fk` FOREIGN KEY (`email_autor`) REFERENCES `persona` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
