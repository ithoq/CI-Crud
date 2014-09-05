-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2014 at 12:50 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `pubdate` date NOT NULL,
  `summary` text NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `pubdate`, `summary`, `body`, `created`, `modified`) VALUES
(37, 'Lorem ipsum dolor sit amet', 'Lorem-ipsum-dolor-sit-amet', '2014-09-05', '<p><span>Lorem ipsum dolor sit amet, consectetur a...</p>', '<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse molestie ut est rhoncus molestie. Mauris in purus sollicitudin felis porttitor semper. Nulla facilisi. Mauris risus elit, accumsan id facilisis nec, mollis nec enim. Ut in tortor a lorem fringilla egestas. Quisque et neque ut purus vestibulum dignissim vitae eu neque. Praesent consectetur risus id purus convallis dapibus. Praesent facilisis, velit at egestas venenatis, neque est ullamcorper enim, id pellentesque libero ligula id ipsum. Vestibulum vitae elit eu turpis porttitor elementum in eget erat. Ut suscipit tempus ipsum, ut ultricies felis scelerisque sagittis. Suspendisse potenti.</span></p>', '2014-09-05 12:46:24', '2014-09-05 12:46:24'),
(38, 'Phasellus ultricies lectus', 'Phasellus-ultricies-lectus', '2014-09-05', '<p><span>Phasellus ultricies lectus ut nunc blandi...</p>', '<p><span>Phasellus ultricies lectus ut nunc blandit vestibulum. Suspendisse potenti. Pellentesque cursus scelerisque tincidunt. Aliquam erat volutpat. Morbi sed lorem eros. In eget lacinia tellus. Nulla laoreet lobortis lectus molestie sagittis. Quisque pellentesque elit vitae lectus sollicitudin, eget convallis orci dictum. Suspendisse sit amet libero feugiat purus eleifend eleifend et ac quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin egestas erat eros, in feugiat velit pretium commodo. Vestibulum blandit, metus cursus porta lobortis, justo urna blandit enim, venenatis dignissim lectus ipsum in augue.</span></p>', '2014-09-05 12:48:35', '2014-09-05 12:48:35'),
(39, 'Porttitor Elementum', 'Porttitor-Elementum', '2014-09-05', '<p><span>In pretium lacus ut porttitor elementum. ...</p>', '<p><span>In pretium lacus ut porttitor elementum. Donec mattis lacus sed consectetur rhoncus. Etiam vitae ultricies libero. Ut enim est, pulvinar vitae tellus maximus, vulputate aliquet eros. Duis ornare lobortis convallis. Integer vel tincidunt ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</span></p>', '2014-09-05 12:49:16', '2014-09-05 12:49:16'),
(40, 'Morbi Luctus Condimentum Lacus', 'Morbi-Luctus-Condimentum-Lacus', '2014-09-05', '<p><span>Morbi luctus condimentum lacus, ut blandi...</p>', '<p><span>Morbi luctus condimentum lacus, ut blandit nulla suscipit eget. Nam quam lorem, tincidunt ut sem vitae, vulputate ullamcorper felis. Aenean et imperdiet ex, a consequat leo. Vivamus id commodo lectus, quis convallis nisl. Integer elit tellus, ultrices ac maximus vel, fermentum vel ligula. Fusce sapien nunc, facilisis a commodo ac, euismod in turpis. Ut dignissim imperdiet velit, eget varius nunc.</span></p>', '2014-09-05 12:49:50', '2014-09-05 12:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_title`, `slug`) VALUES
(8, 'General', ''),
(9, 'News', ''),
(10, 'Archive', ''),
(11, 'PHP', ''),
(12, 'Codeigniter', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories_articles`
--

CREATE TABLE IF NOT EXISTS `categories_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_id` (`category_id`),
  KEY `fk_article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `categories_articles`
--

INSERT INTO `categories_articles` (`id`, `category_id`, `article_id`) VALUES
(54, 4, 37),
(55, 5, 37),
(56, 6, 37),
(57, 8, 38),
(58, 11, 38),
(59, 12, 38),
(60, 10, 39),
(61, 9, 40),
(62, 11, 40),
(63, 12, 40);

-- --------------------------------------------------------

--
-- Table structure for table `taggable`
--

CREATE TABLE IF NOT EXISTS `taggable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taggable_id` int(11) NOT NULL,
  `tag_type` varchar(100) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `taggable`
--

INSERT INTO `taggable` (`id`, `taggable_id`, `tag_type`, `tag_id`) VALUES
(61, 37, 'articles', 123),
(62, 37, 'articles', 124),
(63, 37, 'articles', 125),
(64, 38, 'articles', 126),
(65, 38, 'articles', 127),
(66, 38, 'articles', 128),
(67, 39, 'articles', 128),
(68, 39, 'articles', 127),
(69, 39, 'articles', 126),
(70, 40, 'articles', 129),
(71, 40, 'articles', 130);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag_title`) VALUES
(123, 'lorem'),
(124, 'ipsum'),
(125, 'dolor'),
(126, 'tag1'),
(127, 'tag2'),
(128, 'tag3'),
(129, 'morbi'),
(130, 'luctus');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
