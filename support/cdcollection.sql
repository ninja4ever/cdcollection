-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08 Sty 2015, 15:24
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cdcollection`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cdinfo`
--

CREATE TABLE IF NOT EXISTS `cdinfo` (
  `idcdinfo` int(11) NOT NULL AUTO_INCREMENT,
  `nazwacd` varchar(200) NOT NULL,
  `wykonawca` varchar(200) NOT NULL,
  `data_dodania` datetime NOT NULL,
  `data_wydania` date NOT NULL,
  `opis` text NOT NULL,
  PRIMARY KEY (`idcdinfo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Zrzut danych tabeli `cdinfo`
--

INSERT INTO `cdinfo` (`idcdinfo`, `nazwacd`, `wykonawca`, `data_dodania`, `data_wydania`, `opis`) VALUES
(2, 'ssdsad', 'sss', '2015-01-07 17:38:49', '2015-01-03', '<p>asdasddsa</p>'),
(3, 'ssdsad', 'sss', '2015-01-07 17:39:21', '2015-01-01', '<p>asdasddsa</p>'),
(6, 'fff', 'ssdttttttt', '2015-01-07 17:44:33', '2015-01-02', '<p>tttttttttuuuuuuuuuuuuuuuu</p>\r\n<p>&nbsp;</p>\r\n<table style="height: 108px;" width="364">\r\n<tbody>\r\n<tr>\r\n<td><strong>1</strong></td>\r\n<td><strong>2</strong></td>\r\n<td><strong>3</strong></td>\r\n</tr>\r\n<tr>\r\n<td>5</td>\r\n<td>fff</td>\r\n<td>tttt</td>\r\n</tr>\r\n<tr>\r\n<td>6</td>\r\n<td>ggg</td>\r\n<td>aaaa</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p><img src="js/tinymce/plugins/emoticons/img/smiley-cool.gif" alt="" /></p>'),
(7, 'fff', 'ssdttttttt', '2015-01-07 17:44:33', '2015-01-02', '<p>tttttttttuuuuuuuuuuuuuuuu</p>\r\n<p>&nbsp;</p>\r\n<table style="height: 108px;" width="364">\r\n<tbody>\r\n<tr>\r\n<td>1</td>\r\n<td>2</td>\r\n<td>3</td>\r\n</tr>\r\n<tr>\r\n<td>5</td>\r\n<td>fff</td>\r\n<td>tttt</td>\r\n</tr>\r\n<tr>\r\n<td>6</td>\r\n<td>ggg</td>\r\n<td>aaaa</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p><img src="js/tinymce/plugins/emoticons/img/smiley-cool.gif" alt="" /></p>'),
(8, 'ssdsad', 'sss', '2015-01-07 17:39:21', '2015-01-01', '<p>asdasddsa</p>'),
(9, 'ssdsad', 'sss', '2015-01-07 17:38:49', '2015-01-03', '<p>asdasddsa</p>'),
(10, 'ssdsad', 'sss', '2015-01-07 17:38:49', '2015-01-03', '<p>asdasddsa</p>'),
(11, 'ssdsad', 'sss', '2015-01-07 17:38:49', '2015-01-03', '<p>asdasddsa</p>'),
(12, 'ssdsad', 'sss', '2015-01-07 17:38:49', '2015-01-03', '<p>asdasddsa</p>'),
(13, 'ssdsad', 'sss', '2015-01-07 17:38:49', '2015-01-03', '<p>asdasddsa</p>'),
(14, 'ssdsad', 'sss', '2015-01-07 17:39:21', '2015-01-01', '<p>asdasddsa</p>'),
(15, 'ssdsad', 'sss', '2015-01-07 17:39:21', '2015-01-01', '<p>asdasddsa</p>'),
(16, 'ssdsad', 'sss', '2015-01-07 17:39:21', '2015-01-01', '<p>asdasddsa</p>'),
(17, 'ssdsad', 'sss', '2015-01-07 17:39:21', '2015-01-01', '<p>asdasddsa</p>'),
(18, 'ssdsad', 'sss', '2015-01-07 17:39:21', '2015-01-01', '<p>asdasddsa</p>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
