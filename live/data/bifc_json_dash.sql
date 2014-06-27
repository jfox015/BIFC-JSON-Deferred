-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 09, 2013 at 03:14 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bifc_json_dash`
--

-- --------------------------------------------------------

--
-- Table structure for table `compensation`
--

CREATE TABLE IF NOT EXISTS `compensation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` tinyint(4) NOT NULL,
  `base_salary` decimal(10,0) NOT NULL,
  `bonus` decimal(10,0) NOT NULL,
  `vacation` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hire_date` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `emp_type_id` tinyint(2) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `name`, `location`, `hire_date`, `emp_type_id`) VALUES
(1, 'Jeff Fox', '2', '6/20/2012', 1),
(2, 'Zishan Ahmad', '1', '5/19/2012', 1),
(3, 'Alex Bachuk', '3', '5/30/2013', 4),
(4, 'Anthony Cintron', '3', '5/2/2011', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_types`
--

CREATE TABLE IF NOT EXISTS `employee_types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `employee_types`
--

INSERT INTO `employee_types` (`type_id`, `type_code`, `type_name`, `level_id`) VALUES
(1, 'ft', 'Full Time Employee', 1),
(2, 'pt', 'Part Time Employee', 2),
(3, 'cslt', 'Consultant', 5),
(4, 'fl', 'Freelancer', 5),
(5, 'int', 'Intern', 5);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_code` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `city_code`, `city_name`, `active`) VALUES
(1, 'nwk', 'Norwalk, CT', 1),
(2, 'nyc', 'New York, NY', 1),
(3, 'stm', 'Stamford, CT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `from` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(5000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `employee_id`, `date`, `from`, `subject`, `message`) VALUES
(1, 1, '2013-06-10 00:00:00', 'Jim Jones <jim.jones@email.com>', 'Call me!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam egestas nulla ut ipsum semper non placerat enim ullamcorper. Suspendisse potenti. In hac habitasse platea dictumst.'),
(2, 1, '2013-06-07 00:00:00', 'Tim Wilkins <tim.wilkins@email.com>', 'Parking Ticket', 'Suspendisse potenti. In hac habitasse platea dictumst.');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `content` varchar(5000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `reviewed_by` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `employee_id`, `date`, `reviewed_by`, `status`, `notes`) VALUES
(1, 1, '2012-07-01 00:00:00', 'Zishan Ahmad', 'Make this guy the CEO!!!', ''),
(2, 1, '2011-07-01 00:00:00', 'Alex Bachuk', 'Outstanding', ''),
(3, 1, '2010-07-01 00:00:00', 'Anthony Cintron', 'Also Good', ''),
(4, 1, '2009-07-01 00:00:00', 'Anthony Cintron', 'Great!', 'Funny how the padawan has become the master!');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
