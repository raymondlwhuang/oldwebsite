-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2012 at 10:35 PM
-- Server version: 5.1.52
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `raymondl_home`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `with` varchar(30) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE IF NOT EXISTS `advertisement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(2550) NOT NULL,
  `msg_flag` tinyint(1) NOT NULL DEFAULT '1',
  `display` varchar(255) NOT NULL,
  `disp_flag` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `expire_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `arts_entertainment`
--

CREATE TABLE IF NOT EXISTS `arts_entertainment` (
  `id` int(11) NOT NULL,
  `music` varchar(255) NOT NULL,
  `books` varchar(255) NOT NULL,
  `movies` varchar(255) NOT NULL,
  `television` varchar(255) NOT NULL,
  `games` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `basic_infor`
--

CREATE TABLE IF NOT EXISTS `basic_infor` (
  `id` int(11) NOT NULL,
  `city` varchar(30) NOT NULL,
  `hometown` varchar(30) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `birthday` date NOT NULL,
  `show_bd` tinyint(4) NOT NULL,
  `intereste_in` tinyint(4) NOT NULL,
  `languages` char(30) NOT NULL,
  `about_me` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category_item`
--

CREATE TABLE IF NOT EXISTS `category_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `category_item` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `category_item`
--

INSERT INTO `category_item` (`id`, `user_id`, `category_id`, `category_item`) VALUES
(1, 0, 7, 'Lunch at work'),
(2, 0, 7, 'Dining Out'),
(3, 0, 7, 'Drink'),
(4, 0, 7, 'Snack'),
(5, 0, 2, 'Gas'),
(6, 0, 2, 'Parking'),
(7, 0, 2, 'Maintenance'),
(8, 0, 2, 'Toll Fee'),
(9, 0, 2, 'Auto Loan/Lease'),
(10, 0, 2, 'Insurance '),
(11, 0, 2, 'Taxi/Bus'),
(12, 0, 2, 'Registration/Inspection'),
(13, 0, 2, 'Other'),
(14, 0, 7, 'Other'),
(15, 0, 3, 'Mortgage'),
(16, 0, 3, 'Rent'),
(17, 0, 3, 'Maintenance'),
(18, 0, 3, 'Insurance'),
(19, 0, 3, 'Furniture'),
(20, 0, 3, 'Household Supplies'),
(21, 0, 3, 'Property Tax'),
(22, 0, 3, 'Other'),
(23, 0, 4, 'Phone - Home'),
(24, 0, 4, 'Phone - Cell'),
(25, 0, 4, 'TV'),
(26, 0, 4, 'Gas'),
(27, 0, 4, 'Water'),
(28, 0, 4, 'Electricity'),
(29, 0, 4, 'Internet'),
(30, 0, 4, 'Printer Ink'),
(31, 0, 4, 'Other'),
(32, 0, 5, 'Dental'),
(33, 0, 5, 'Medical'),
(34, 0, 5, 'Medication'),
(35, 0, 5, 'Vision/contacts'),
(36, 0, 5, 'Life Insurance'),
(37, 0, 5, 'Other'),
(38, 0, 6, 'Memberships'),
(39, 0, 6, 'Events'),
(40, 0, 6, 'Subscriptions'),
(41, 0, 6, 'Movies'),
(42, 0, 6, 'Music'),
(43, 0, 6, 'Hobbies'),
(44, 0, 6, 'Travel/ Vacation'),
(45, 0, 6, 'Entering Ticket'),
(46, 0, 6, 'Other'),
(47, 0, 8, 'Clothes,Pants,Shoes'),
(48, 0, 8, 'Child care'),
(49, 0, 8, 'School expenses'),
(50, 0, 8, 'Baby Sitter'),
(51, 0, 8, 'Tuition'),
(52, 0, 8, 'Kids reward'),
(53, 0, 8, 'Music lessons'),
(54, 0, 8, 'Club fee'),
(55, 0, 8, 'Other'),
(56, 0, 9, 'Clothes, Pants, Shoes'),
(57, 0, 9, 'Skin Care Product'),
(58, 0, 9, 'Electronic Product'),
(59, 0, 9, 'Other'),
(60, 0, 11, 'Hair Cut'),
(61, 0, 11, 'Donations'),
(62, 0, 11, 'Dry Cleaning'),
(63, 0, 11, 'Party & Gifts'),
(64, 0, 11, 'Other'),
(65, 0, 8, 'C.S.T. Plan Fee'),
(66, 0, 11, 'RRSP'),
(67, 0, 10, 'food'),
(68, 0, 10, 'with household Supplies'),
(69, 0, 10, 'other'),
(70, 0, 12, 'other'),
(72, 15, 7, 'Breakfast'),
(74, 0, 1, 'Salary'),
(75, 0, 1, 'Wage'),
(76, 0, 1, 'Rental'),
(77, 0, 1, 'Transfer'),
(78, 0, 1, 'Gift'),
(79, 0, 1, 'Other'),
(80, 0, 2, 'Car Depreciation'),
(81, 3, 1, 'CHILD TAX BENEFIT '),
(82, 3, 7, 'Breakfast'),
(83, 3, 9, 'Sockes'),
(84, 3, 8, 'lunch'),
(85, 3, 11, 'SAFE DEP BOX FEE'),
(86, 3, 2, 'Driver license renewal'),
(87, 3, 11, 'pet'),
(88, 3, 11, 'Lotto 6/49'),
(89, 3, 1, 'Tax Return');

-- --------------------------------------------------------

--
-- Table structure for table `contact_address`
--

CREATE TABLE IF NOT EXISTS `contact_address` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `neighborhood` varchar(30) NOT NULL,
  `website` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_email`
--

CREATE TABLE IF NOT EXISTS `contact_email` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_name`
--

CREATE TABLE IF NOT EXISTS `contact_name` (
  `id` int(11) NOT NULL,
  `screen_name` varchar(30) NOT NULL,
  `aim` varchar(30) NOT NULL,
  PRIMARY KEY (`id`,`screen_name`,`aim`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_phone`
--

CREATE TABLE IF NOT EXISTS `contact_phone` (
  `id` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `prefix` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`,`phone`,`prefix`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `education_work`
--

CREATE TABLE IF NOT EXISTS `education_work` (
  `id` int(11) NOT NULL,
  `employer` char(60) NOT NULL,
  `college_university` char(60) NOT NULL,
  `high_school` char(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ImportSource`
--

CREATE TABLE IF NOT EXISTS `ImportSource` (
  `SortDesc` varchar(100) NOT NULL,
  `SourceCode` varchar(40000) NOT NULL,
  `RunName` char(25) NOT NULL,
  PRIMARY KEY (`SortDesc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE IF NOT EXISTS `interests` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `with` varchar(30) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_frequency`
--

CREATE TABLE IF NOT EXISTS `item_frequency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `spender_id` tinyint(1) NOT NULL,
  `category_id` tinyint(2) NOT NULL,
  `item_id` int(11) NOT NULL,
  `frequency_id` tinyint(2) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `type_id` tinyint(2) NOT NULL,
  `bank_id` tinyint(2) NOT NULL,
  `to_bank_id` tinyint(2) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `activated` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `item_frequency`
--

INSERT INTO `item_frequency` (`id`, `user_id`, `spender_id`, `category_id`, `item_id`, `frequency_id`, `amount`, `type_id`, `bank_id`, `to_bank_id`, `start_date`, `activated`) VALUES
(3, 3, 1, 3, 15, 5, 'w25414', 1, 3, 0, '2011-12-10', '2012-07-10'),
(4, 3, 1, 1, 81, 5, 'p2e414u25443', 1, 3, 0, '2011-12-18', '2012-06-18'),
(5, 3, 1, 5, 36, 8, 's2c414', 1, 3, 0, '2012-11-29', '2012-11-29'),
(6, 3, 1, 3, 18, 5, 'v284', 1, 3, 0, '2011-12-16', '2012-06-16'),
(7, 3, 1, 2, 10, 5, 'q29464', 1, 3, 0, '2011-12-16', '2012-06-16'),
(8, 3, 1, 1, 74, 5, 'p2a474230443', 1, 3, 0, '2011-12-15', '2012-06-15'),
(9, 3, 1, 1, 74, 5, 'p2a474230443', 1, 3, 0, '2011-12-31', '2012-06-30'),
(11, 3, 1, 1, 77, 5, 'p27414', 1, 3, 7, '2012-01-01', '2012-07-01'),
(12, 3, 1, 1, 77, 5, 't254', 1, 3, 9, '2012-01-01', '2012-07-01'),
(14, 3, 1, 3, 21, 5, 'q2c414u2a463', 1, 3, 0, '2012-05-01', '2012-07-01'),
(15, 3, 1, 1, 76, 5, 'u2a414', 1, 3, 0, '2012-06-01', '2012-07-01'),
(16, 3, 1, 1, 76, 5, 'u2a414', 1, 3, 0, '2012-06-02', '2012-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `kidsreward`
--

CREATE TABLE IF NOT EXISTS `kidsreward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rewardid` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `signature` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=254 ;

--
-- Dumping data for table `kidsreward`
--

INSERT INTO `kidsreward` (`id`, `rewardid`, `amount`, `signature`, `description`, `date`) VALUES
(11, 1, 7.25, 10, 'from my recording', '2011-09-25'),
(13, 2, 3.00, 5, 'from my recording', '2011-09-25'),
(16, 2, 1.00, 0, 'sleep on time but talk after sleep, next time will deduct', '2011-09-25'),
(17, 1, -1.00, 0, 'more then 10 min late on sleep time', '2011-09-25'),
(18, 1, 1.00, 0, 'disc wash', '2011-09-25'),
(19, 1, -1.00, 0, 'over 15 min late', '2011-09-26'),
(20, 2, 1.00, 0, 'sleep on time', '2011-09-26'),
(21, 2, -1.00, 0, 'sleep on time but talk till 11:50pm', '2011-09-26'),
(22, 1, 0.00, 3, 'quiz reward ', '2011-09-27'),
(23, 1, 1.00, 0, 'disc wash', '2011-09-27'),
(24, 2, 0.25, 0, 'sweep floor', '2011-09-27'),
(25, 1, 1.00, 0, 'sleep on time', '2011-09-27'),
(26, 2, 1.00, 0, 'sleep on time', '2011-09-27'),
(27, 2, 0.50, 0, 'sweep floor and clean table', '2011-09-28'),
(28, 1, 1.00, 0, 'sleep on time', '2011-09-28'),
(29, 2, 1.00, 0, 'sleep on time', '2011-09-28'),
(30, 2, 0.25, 0, 'sweep floor', '2011-09-29'),
(31, 1, 1.00, 0, 'sleep on time', '2011-09-29'),
(32, 2, -1.00, 0, 'forget home work sleep very late', '2011-09-29'),
(33, 1, -17.00, 0, 'withdraw for cloth', '2011-10-01'),
(34, 1, 1.00, 0, 'sleep on time', '2011-10-02'),
(35, 2, 1.00, 0, 'sleep on time', '2011-10-02'),
(36, 1, -1.00, 0, 'talk after 10:30pm', '2011-10-02'),
(37, 2, -1.00, 0, 'talk after 10:30pm', '2011-10-02'),
(38, 1, -1.00, 0, 'sleep late and talk', '2011-10-03'),
(39, 2, 1.00, 0, 'sleep on time', '2011-10-03'),
(40, 1, -1.00, 0, 'sleep 15 min late', '2011-10-04'),
(41, 2, -1.00, 0, 'sleep 15 min late ', '2011-10-04'),
(42, 1, -50.00, 0, '1/2 price for the guitar', '2011-10-06'),
(44, 1, 1.00, 0, 'sleep on time', '2011-10-06'),
(45, 2, 1.00, 0, 'sleep on time', '2011-10-06'),
(46, 1, 0.00, 2, '', '2011-10-11'),
(47, 1, -1.00, 0, 'sleep late', '2011-10-13'),
(48, 2, -1.00, 0, 'sleep late', '2011-10-13'),
(49, 1, 1.00, 0, 'disc wash', '2011-10-15'),
(50, 1, 1.00, 0, 'sleep on time', '2011-10-16'),
(51, 2, 1.00, 0, 'sleep on time', '2011-10-16'),
(52, 2, 1.00, 0, 'disc wash', '2011-10-18'),
(53, 2, 1.00, 0, 'sleep on time', '2011-10-18'),
(54, 1, 1.00, 0, 'sleep on time', '2011-10-18'),
(55, 1, 1.00, 0, 'sleep on time', '2011-10-19'),
(56, 2, 1.00, 0, 'sleep on time', '2011-10-19'),
(57, 1, 1.00, 0, 'sleep on time', '2011-10-20'),
(58, 2, 1.00, 0, 'sleep on time', '2011-10-20'),
(59, 1, 1.00, 0, 'disc wash', '2011-10-23'),
(60, 1, -1.00, 0, 'sleep late', '2011-10-23'),
(61, 2, -1.00, 0, 'sleep late', '2011-10-23'),
(62, 1, 1.00, 0, 'sleep on time', '2011-10-26'),
(63, 2, 1.00, 0, 'sleep on time', '2011-10-26'),
(64, 1, 0.00, -5, '$21 book gift card ', '2011-10-29'),
(65, 1, 1.00, 0, 'disc wash', '2011-11-01'),
(66, 2, 1.00, 0, 'sleep on time', '2011-11-01'),
(67, 1, 1.00, 0, 'sleep on time', '2011-11-01'),
(69, 2, 1.00, 0, 'sleep on time', '2011-11-02'),
(70, 2, 0.00, 1, 'A+ project', '2011-11-03'),
(71, 2, -5.00, 0, 'will game', '2011-11-06'),
(72, 2, 1.00, 0, 'sleep on time', '2011-11-06'),
(73, 1, 1.00, 0, 'disc wash', '2011-11-07'),
(74, 2, 1.00, 0, 'sleep on time', '2011-11-07'),
(75, 1, 1.00, 0, 'sleep on time', '2011-11-07'),
(76, 1, 1.00, 0, 'disk wastuh', '2011-11-08'),
(77, 1, 1.00, 0, 'sleep on time', '2011-11-08'),
(78, 2, 1.00, 0, 'sleep on time', '2011-11-08'),
(79, 1, 1.00, 0, 'sleep on time', '2011-11-09'),
(80, 2, 1.00, 0, 'sleep on time', '2011-11-09'),
(81, 1, 1.00, 0, 'disk wash', '2011-11-09'),
(82, 1, 1.00, 0, 'sleep on time', '2011-11-10'),
(83, 2, 1.00, 0, 'sleep on time', '2011-11-10'),
(84, 2, 1.00, 0, 'disc wash', '2011-11-10'),
(85, 2, 0.00, 1, 'chinese test', '2011-11-11'),
(86, 1, 1.00, 0, 'disc wash', '2011-11-14'),
(87, 2, 1.00, 0, 'sleep on time', '2011-11-14'),
(88, 1, 1.00, 0, 'sleep on time', '2011-11-14'),
(89, 1, -1.00, 0, 'heard talking at 10:30pm', '2011-11-14'),
(90, 1, 1.00, 0, 'disc wash', '2011-11-15'),
(91, 2, 1.00, 0, 'sleep on time', '2011-11-15'),
(92, 1, 1.00, 0, 'sleep on time', '2011-11-15'),
(93, 1, -1.00, 0, 'wake up and get turtle at 10:12pm', '2011-11-15'),
(94, 2, -1.00, 0, 'talk after 10:15pm', '2011-11-15'),
(95, 2, 1.00, 0, 'sleep on time', '2011-11-16'),
(96, 2, 1.00, 0, 'disc wash', '2011-11-17'),
(97, 1, 2.00, 0, 'disk wash', '2011-11-20'),
(98, 2, 2.00, 0, 'disk wash', '2011-11-20'),
(99, 2, 1.00, 0, 'sleep on time', '2011-11-20'),
(100, 2, 1.00, 0, '', '2011-11-24'),
(101, 2, 0.00, -3, '', '2011-11-26'),
(102, 2, 0.00, -5, '', '2011-11-26'),
(103, 1, 0.00, -2, '', '2011-11-26'),
(104, 2, 0.00, 1, 'A+', '2011-11-27'),
(105, 1, 1.00, 0, 'disk wash', '2011-11-27'),
(106, 1, 1.00, 0, 'sleep on time', '2011-11-27'),
(107, 2, 1.00, 0, 'sleep on time', '2011-11-27'),
(108, 1, 1.00, 0, 'sleep on time', '2011-11-28'),
(109, 2, 1.00, 0, 'sleep on time', '2011-11-28'),
(111, 1, 1.00, 0, 'sleep on time', '2011-11-29'),
(112, 2, 1.00, 0, '', '2011-11-29'),
(113, 2, 1.00, 0, 'sleep on time yesterday', '2011-12-05'),
(114, 1, -1.00, 0, 'talk at 11:00pm', '2011-12-05'),
(115, 2, 1.00, 0, 'sleep on time', '2011-12-06'),
(116, 1, -1.00, 0, 'sleep late', '2011-12-06'),
(117, 2, 1.00, 0, 'sleep on time', '2011-12-07'),
(118, 1, 1.00, 0, 'disk wash', '2011-12-07'),
(119, 1, 1.00, 0, 'sleep on time', '2011-12-07'),
(120, 2, 1.00, 0, 'sleep on time', '2011-12-11'),
(121, 1, 1.00, 0, 'disk wash', '2011-12-12'),
(122, 1, 1.00, 0, 'sleep on time', '2011-12-12'),
(123, 2, 1.00, 0, 'sleep on time', '2011-12-12'),
(124, 1, 1.00, 0, 'sleep on time', '2011-12-14'),
(125, 2, 1.00, 0, 'sleep on time', '2011-12-14'),
(126, 1, 0.00, -2, 'bird food', '2011-12-16'),
(127, 2, 0.00, -2, 'bird food', '2011-12-16'),
(128, 1, 1.00, 0, 'disk wash', '2011-12-16'),
(129, 1, 1.00, 0, 'sleep on time', '2011-12-16'),
(130, 2, 1.00, 0, 'sleep on time', '2011-12-16'),
(131, 1, 1.00, 0, 'sleep on time', '2011-12-18'),
(132, 2, 1.00, 0, 'sleep on time', '2011-12-18'),
(133, 1, -1.00, 0, 'talk when sleep', '2011-12-18'),
(134, 2, -1.00, 0, 'talk when sleep', '2011-12-18'),
(135, 2, 1.00, 0, 'sleep on time', '2011-12-21'),
(136, 2, 1.00, 0, 'sleep on time', '2011-12-22'),
(137, 1, 1.00, 0, 'sleep on time yesterday', '2012-01-09'),
(138, 2, 1.00, 0, 'sleep on time yesterday', '2012-01-09'),
(139, 1, -1.00, 0, 'sleep late', '2012-01-09'),
(140, 2, 1.00, 0, 'sleep on time', '2012-01-09'),
(141, 1, 1.00, 0, 'sleep on time', '2012-01-10'),
(142, 2, 1.00, 0, 'sleep on time', '2012-01-10'),
(143, 1, 1.00, 0, 'sleep on time yesterday', '2012-01-13'),
(144, 2, 1.00, 0, 'sleep on time the day before yesterday', '2012-01-13'),
(145, 1, -1.00, 0, 'sleep late', '2012-01-17'),
(146, 2, 1.00, 0, 'sleep on time', '2012-01-18'),
(147, 1, 20.00, 0, '', '2012-01-23'),
(148, 2, 20.00, 0, '', '2012-01-23'),
(149, 1, 1.00, 0, 'sleep on time', '2012-01-23'),
(150, 2, 1.00, 0, 'sleep on time', '2012-01-23'),
(151, 1, 1.00, 0, 'sleep on time yesterday', '2012-01-30'),
(152, 2, 1.00, 0, 'sleep on time yesterday', '2012-01-30'),
(153, 1, -1.00, 0, 'sleep late', '2012-01-30'),
(154, 2, -1.00, 0, 'sleep late', '2012-01-30'),
(155, 1, 1.00, 0, 'sleep on time', '2012-01-31'),
(156, 2, 1.00, 0, '', '2012-01-31'),
(157, 1, 1.00, 0, 'sleep on time', '2012-02-01'),
(158, 2, 1.00, 0, 'sleep on time', '2012-02-01'),
(159, 2, 2.00, 0, 'good mark on test', '2012-02-01'),
(160, 1, -1.00, 0, 'talk when sleep', '2012-02-01'),
(161, 2, -1.00, 0, 'talk when sleep', '2012-02-01'),
(162, 1, 10.00, 0, '5 test good mark', '2012-02-02'),
(163, 1, 0.00, 0, '', '2012-02-02'),
(164, 2, 1.00, 0, 'sleep on time', '2012-02-02'),
(165, 1, 1.00, 0, 'sleep on time', '2012-02-05'),
(166, 2, 1.00, 0, 'sleep on time', '2012-02-05'),
(167, 1, -1.00, 0, 'talk when sleep', '2012-02-08'),
(168, 2, -1.00, 0, 'talk when sleep', '2012-02-08'),
(169, 1, -1.00, 0, 'sleep late 2 days ago', '2012-02-15'),
(170, 1, -1.00, 0, 'sleep late yesterday', '2012-02-15'),
(171, 2, -1.00, 0, 'sleep late 2 days ago', '2012-02-15'),
(172, 2, -1.00, 0, 'sleep late yesterday', '2012-02-15'),
(173, 2, 2.00, 0, 'good mark on test', '2012-02-15'),
(174, 2, 1.00, 0, 'sleep on time', '2012-02-23'),
(175, 2, 1.00, 0, 'sleep on time yesterday', '2012-02-23'),
(176, 2, 2.00, 0, 'good mark on test', '2012-02-26'),
(177, 1, 1.00, 0, 'sleep on time', '2012-02-26'),
(178, 2, 1.00, 0, 'sleep on time', '2012-02-26'),
(179, 2, -4.00, 0, 'buy with signature', '2012-02-27'),
(180, 1, 1.00, 0, 'sleep on time', '2012-02-27'),
(181, 1, -1.00, 0, 'sleep late', '2012-02-28'),
(182, 2, -1.00, 0, 'sleep late', '2012-02-28'),
(183, 2, 1.00, 0, 'sleep on time', '2012-02-29'),
(184, 1, -1.00, 0, 'sleep late', '2012-02-29'),
(185, 1, 1.00, 0, 'sleep on time', '2012-03-01'),
(186, 2, 1.00, 0, 'sleep on time', '2012-03-01'),
(187, 2, 1.00, 0, 'sleep on time', '2012-03-04'),
(188, 1, 1.00, 0, 'sleep on time', '2012-03-04'),
(189, 1, 1.00, 0, 'sleep on time', '2012-03-06'),
(190, 2, 1.00, 0, 'sleep on time', '2012-03-06'),
(191, 2, 1.00, 0, 'sleep on time', '2012-03-07'),
(192, 1, -1.00, 0, 'sleep late', '2012-03-07'),
(193, 2, 1.00, 0, 'sleep on time', '2012-03-08'),
(194, 1, 1.00, 0, 'sleep on time', '2012-03-08'),
(195, 1, 3.00, 0, 'trick for bird', '2012-03-10'),
(196, 2, -3.00, 0, 'trick for bird', '2012-03-10'),
(197, 1, -5.00, 0, 'trick for bird', '2012-03-10'),
(198, 2, 0.00, -3, 'Neil polishing', '2012-03-18'),
(199, 1, -4.00, 0, 'pencil', '2012-03-19'),
(200, 1, -1.00, 0, 'sleep late', '2012-03-29'),
(201, 1, -1.00, 0, 'sleep late', '2012-04-04'),
(202, 2, -1.00, 0, 'sleep late', '2012-04-04'),
(203, 1, -4.00, 0, 'shopping', '2012-04-07'),
(204, 2, 0.00, -5, 'shopping', '2012-04-07'),
(205, 1, 1.00, 0, 'sleep on time', '2012-04-09'),
(206, 2, 1.00, 0, 'sleep on time', '2012-04-09'),
(207, 1, -1.00, 0, 'sleep late', '2012-04-11'),
(208, 2, -1.00, 0, 'sleep late', '2012-04-11'),
(209, 1, 4.00, 0, 'good mark on test', '2012-04-12'),
(210, 2, 1.00, 0, 'sleep on time', '2012-04-16'),
(211, 1, 1.00, 0, 'sleep on time', '2012-04-16'),
(212, 2, 1.00, 0, 'sleep on time', '2012-04-17'),
(213, 1, 0.00, 0, 'sleep a bit late no money subtracted', '2012-04-17'),
(214, 1, 1.00, 0, 'sleep on time', '2012-04-18'),
(215, 2, 1.00, 0, 'sleep on time', '2012-04-18'),
(216, 1, 12.00, 0, '6 good marks', '2012-04-19'),
(217, 1, 1.00, 0, 'sleep on time', '2012-04-19'),
(218, 2, 1.00, 0, 'sleep on time', '2012-04-19'),
(219, 1, -5.00, 0, 'shoping', '2012-04-21'),
(220, 1, -1.00, 0, 'shoping', '2012-04-21'),
(221, 2, -2.00, 0, 'shoping', '2012-04-21'),
(222, 1, 1.00, 0, 'sleep on time', '2012-04-23'),
(223, 2, -1.00, 0, 'play while sleeping', '2012-04-23'),
(224, 1, 1.00, 0, 'sleep on time', '2012-04-24'),
(225, 2, 1.00, 0, 'sleep on time', '2012-04-24'),
(226, 2, 1.00, 0, 'sleep on time', '2012-04-26'),
(227, 1, -1.00, 0, 'sleep late', '2012-04-26'),
(228, 1, -1.00, 0, 'sleep late', '2012-04-28'),
(229, 1, 1.00, 0, 'sleep on time yesterday', '2012-04-30'),
(230, 2, 1.00, 0, 'sleep on time yesterday', '2012-04-30'),
(231, 2, 1.00, 0, 'sleep on time', '2012-04-30'),
(232, 1, -2.00, 0, 'talk at 11:00pm', '2012-05-01'),
(233, 2, -2.00, 0, 'talk at 11:00pm', '2012-05-01'),
(234, 1, -1.00, 0, 'sleep late', '2012-05-03'),
(235, 2, 0.00, 0, 'sleep late', '2012-05-03'),
(236, 2, -1.00, 0, 'sleep late', '2012-05-03'),
(237, 1, 1.00, 0, 'sleep on time', '2012-05-06'),
(238, 2, 1.00, 0, 'sleep on time', '2012-05-06'),
(239, 2, 1.00, 0, 'sleep on time', '2012-05-07'),
(240, 1, 1.00, 0, 'sleep on time', '2012-05-09'),
(241, 2, 1.00, 0, 'sleep on time', '2012-05-09'),
(242, 2, 1.00, 0, 'sleep on time', '2012-05-10'),
(243, 1, 4.00, 0, '2 good marks', '2012-05-16'),
(244, 1, 1.00, 0, 'sleep on time', '2012-05-17'),
(245, 2, 1.00, 0, 'sleep on time', '2012-05-17'),
(246, 1, -1.00, 0, 'sleep late', '2012-05-27'),
(247, 2, -1.00, 0, 'sleep late', '2012-05-27'),
(248, 1, -1.00, 0, 'sleep late', '2012-05-28'),
(249, 2, 1.00, 0, 'sleep on time', '2012-05-28'),
(250, 1, -1.00, 0, 'talk when sleep', '2012-06-06'),
(251, 2, -1.00, 0, 'talk when sleep', '2012-06-06'),
(252, 1, 1.00, 0, 'sleep on time', '2012-06-06'),
(253, 2, 1.00, 0, 'sleep on time', '2012-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `main`
--

CREATE TABLE IF NOT EXISTS `main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ShortDesc` varchar(200) NOT NULL,
  `Source` varchar(40000) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Ext` char(4) NOT NULL,
  `SearchGroup` char(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ShortDesc` (`ShortDesc`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=242 ;

--
-- Dumping data for table `main`
--

INSERT INTO `main` (`id`, `ShortDesc`, `Source`, `Name`, `Ext`, `SearchGroup`) VALUES
(9, 'Make the background faded', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n<title>Disable and fade out background</title>\r\n\r\n<style type="text/css">\r\n.black_overlay {\r\nbackground-image: url(../images/dim_transparent_red.png);\r\ndisplay:none;\r\nheight:100%;\r\npadding:750px 0;\r\nleft:0;\r\nopacity:0.7;\r\nposition:fixed;\r\n_position:absolute;\r\ntop:0;\r\nwidth:100%;\r\nposition:absolute;\r\nz-index:1;\r\n}\r\n.content_overlay {\r\n	background:#fff;\r\n	width:440px;\r\n	position:absolute;\r\n	left:50%;\r\n	margin-left:-253px;\r\n	z-index:10;\r\n	top:125px;\r\n	border:3px solid #12465e;\r\n	padding:25px 25px 10px;\r\n	display:none;\r\n}\r\n</style>\r\n</head>\r\n\r\n<body>\r\n<div id="fade" class="unitPng black_overlay" style="display:none;">\r\n</div> <!--- end black --->\r\n<div id="wrapper" style="display:block;" align="center">\r\n    <table width="175" height="156" border="0">\r\n      <tr>\r\n        <td width="150" align="center"><img src="../images/next_green.jpg" /></td>\r\n      </tr>\r\n      <tr>\r\n        <td height="30" align="center" class="profilenames">DimondBubbles <span class="profileages">29/F</span></td>\r\n      </tr>\r\n    </table>\r\n</div>\r\n\r\n<div class="content_overlay" id="step1overlay" style="display: none;">\r\n\r\n	<div class="form trueLpForm">\r\n		<form method="post" id="register_form" action="index2.php"  onsubmit="return validateZip_postal();">\r\n			<div id="fieldzip" class="field" style="display: block;">\r\n				<label for="zip_postal">Postal Code:</label>\r\n				<input id="zip_postal" name="zip_postal" type="text" maxlength="7">\r\n			</div>\r\n		</form>\r\n	</div>\r\n\r\n</div>\r\n<script type="text/javascript">\r\n\r\nfunction showForm() {\r\ndocument.getElementById(''fade'').style.display = "block";\r\ndocument.getElementById(''step1overlay'').style.display = "block";\r\n}\r\n\r\ndocument.getElementById(''step1overlay'').style.display = "none";\r\ndocument.getElementById(''wrapper'').style.display = "block";\r\nsetTimeout("showForm()",3800);\r\n</script>\r\n</body>\r\n</html>', 'fadeBackground', 'html', ''),
(6, 'Date Display format (Friday, August 5, 2011 )', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml"><head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\r\n<title>Display today''s date!</title>\r\n</head>\r\n<body>\r\n     <div style="padding: 6px; background-color: rgb(112, 158, 207); color: rgb(255, 255, 255); font-size: 12px;" align="center">\r\n		<script type="text/javascript">\r\n\r\n						var d=new Date();\r\n						var weekday=new Array(7);\r\n						weekday[0]="Sunday";\r\n						weekday[1]="Monday";\r\n						weekday[2]="Tuesday";\r\n						weekday[3]="Wednesday";\r\n						weekday[4]="Thursday";\r\n						weekday[5]="Friday";\r\n						weekday[6]="Saturday";\r\n						document.write("" + weekday[d.getDay()]);\r\n		</script>,\r\n\r\n		<script type="text/javascript">\r\n		var month = new Array();\r\n		month[0] = "January";month[1] = "February";month[2] = "March";month[3] = "April";month[4] = "May";\r\n		month[5] = "June";month[6] = "July";month[7] = "August";month[8] = "September";month[9] = "October";month[10] = "November";\r\n		month[11] = "December";\r\n		//Array starting at 0 since javascript dates start at 0 instead of 1\r\n		var mydate= new Date()\r\n		mydate.setDate(mydate.getDate())\r\n		document.write(""+month[mydate.getMonth()]+" "+mydate.getDate()+", "+mydate.getFullYear());\r\n\r\n		</script>\r\n	</div>\r\n</body>\r\n</html>', 'DisplayDate', 'html', ''),
(7, 'insert Javascript work inside php coding, echo', '<?php\r\necho <<<_END\r\n<script type="text/javascript">\r\ndocument.write(''This message is display with the php echo function that is calling the javascript wirte function'');\r\n</script>\r\n_END;', 'EchoJavascript', 'php', ''),
(8, 'Display a pop up message when refresh or unload the page/website', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<script language="JavaScript" src="http://j.maxmind.com/app/geoip.js"></script>\r\n<script type="text/javascript">\r\n    //Landing Pops [page1]\r\n    var landingPopAlert = "ALERT:\\n\\n One Of Your Friends From " + geoip_city()  + " Thinks You''re Hot! \\n\\n";\r\n    var landingPop ="\\n________________________\\n\\n Click ''CANCEL'' Below To Find Out Who! \\n\\n________________________\\n";\r\n    var landingPopLink ="";\r\n\r\n\r\n    //Exit Pops  [page2 - pageX]\r\n    var exitPopAlert = "ALERT:\\n\\n One Of Your Friends From " + geoip_city()  + " Thinks You''re Hot! \\n\\n";\r\n    var exitPop ="\\n________________________\\n\\n Click ''CANCEL'' Below To Find Out Who! \\n\\n________________________\\n";\r\n    var exitPopLink ='''';\r\n    /*\r\n\r\n    //Exit Pops [Cell Page]\r\n    var cellPopAlert ="IQ ALERT:\\n\\n YOUR CRUSH SCORED 103 ON THE IQ QUIZ. \\n\\n";\r\n    var cellPop ="\\n________________________\\n\\n CLICK ''CANCEL'' BELOW TO CALCULATE YOUR IQ! \\n\\n________________________\\n";\r\n    var cellPopLink ="";\r\n\r\n\r\n    //Exit Pops [Pin Page]\r\n    var pinPopAlert ="IQ ALERT:\\n\\n YOUR CRUSH SCORED 103 ON THE IQ QUIZ. \\n\\n";\r\n    var pinPop ="\\n________________________\\n\\n CLICK ''CANCEL'' BELOW TO CALCULATE YOUR IQ! \\n\\n________________________\\n";\r\n    var pinPopLink ="";\r\n\r\n\r\n    //Exit Pops [Thank You Page]\r\n    */\r\n    \r\n    var confPopAlert ="ALERT:\\n\\n YOUR FREE TRIAL OFFER IS READY. \\n\\n";\r\n    var confPop ="\\n________________________\\n\\n CLICK ''CANCEL'' BELOW TO GET YOUR FREE TRIAL! \\n\\n________________________\\n";\r\n    var confPopLink =""\r\n            // fget gets called whenever a user tries to leave the page.\r\n        window.onbeforeunload = fget\r\n\r\n        /* The two statements below and the function below is needed to allow the exitpops to work\r\n         * when the user tries to close the window.\r\n         */\r\n        var mouseX,mouseY;\r\n        document.onmousemove=mtrack;\r\n        function mtrack(e) {\r\n            if (!e) {e=event}\r\n\r\n            if (e.clientX!=null){\r\n                mouseX=e.clientX;\r\n                mouseY=e.clientY;\r\n            }\r\n        }\r\n	    /*\r\n     * The iframe variable, the checkPop function, and the resetPop function determine when the exit pops get fired.\r\n     * For example, they should not fire when the user clicks the continue button.  This will not happen when iframe is\r\n     * greater than one.\r\n     */\r\n    var iframe = 1;\r\n    var crn_loc = window.location.href;\r\n    function checkPop() {\r\n        iframe = 100;\r\n    }\r\n\r\n    function resetPop() {\r\n        iframe = 1;\r\n    }\r\n    \r\n    function fget(){\r\n        if (iframe < 2)\r\n        {\r\n            if (typeof(event)=="object")\r\n            {\r\n                mouseX=event.clientX;\r\n                mouseY=event.clientY;\r\n            }\r\n            if (mouseY<10 && mouseX>400){\r\n                alert(landingPopAlert);\r\n                if (landingPopLink != ""){\r\n                   window.location = landingPopLink;\r\n                }\r\n				return landingPop;\r\n            }\r\n        }\r\n    }\r\n\r\n    function onClickQuestion(){\r\n        checkPop();\r\n    }\r\n\r\n    function exitpopRedir() {\r\n        if(window.location.href == crn_loc) {\r\n            window.onbeforeunload='''';\r\n            window.location.href=landingPopLink;\r\n        }\r\n    }\r\n</script>\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<title>Exit Popup  -</title>\r\n<style type="text/css" media="screen">\r\n<!--\r\n@import url( css/style2.css );\r\n-->\r\n</style>\r\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\r\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\r\n</head>\r\n<body>\r\n	Refresh the screen will get a exit popup.\r\n</body>\r\n</html>', 'ExitPopUP', 'html', ''),
(10, 'Make background faded, overylay', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml"><head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\r\n<title>Disable and fade out background</title>\r\n\r\n<style type="text/css">\r\n<!--\r\n.black_overlay {\r\nbackground-image: url(../images/dim_transparent_red.png);\r\ndisplay:none;\r\nheight:100%;\r\npadding:750px 0;\r\nleft:0;\r\nopacity:0.7;\r\nposition:fixed;\r\n_position:absolute;\r\ntop:0;\r\nwidth:100%;\r\nposition:absolute;\r\nz-index:1;\r\n}\r\n.content_overlay {\r\n	background:#fff;\r\n	width:440px;\r\n	position:absolute;\r\n	z-index:999;\r\n	left:50%;\r\n	margin-left:-253px;\r\n	top:125px;\r\n	border:3px solid #12465e;\r\n	padding:25px 25px 10px;\r\n	display:none;\r\n}\r\n-->\r\n</style>\r\n</head>\r\n<body>\r\n<div id="fade" class="black_overlay" style="display:block;">\r\n</div> <!--- end black --->\r\n<div id="wrapper" style="display:block;" align="center">\r\n    <table width="175" height="156" border="0">\r\n      <tr>\r\n        <td width="150" align="center"><img src="../images/next_green.jpg"/></td>\r\n      </tr>\r\n      <tr>\r\n        <td height="30" align="center" class="profilenames">DimondBubbles <span class="profileages">29/F</span></td>\r\n      </tr>\r\n    </table>\r\n</div>\r\n<div class="content_overlay" id="TB_window" style="display: block;position:fixed;top:150px;">\r\n	<label for="zip_postal">Postal Code:</label>\r\n	<input id="zip_postal" name="zip_postal" maxlength="7" type="text">\r\n</div>\r\n</body>\r\n</html>', 'fadeBackground2', 'html', ''),
(11, 'Get User''s Location (city,province,state,country,postal code, zip code, latitude,longitude', '<!-- http://www.maxmind.com/app/javascript_city -->\r\n<script language="JavaScript" src="http://j.maxmind.com/app/geoip.js"></script>\r\n\r\n<br>Country Code:\r\n<script language="JavaScript">document.write(geoip_country_code());</script>\r\n<br>Country Name:\r\n<script language="JavaScript">document.write(geoip_country_name());</script>\r\n<br>City:\r\n<script language="JavaScript">document.write(geoip_city());</script>\r\n<br>Region:\r\n<script language="JavaScript">document.write(geoip_region());</script>\r\n<br>Region Name:\r\n<script language="JavaScript">document.write(geoip_region_name());</script>\r\n<br>Latitude:\r\n<script language="JavaScript">document.write(geoip_latitude());</script>\r\n<br>Longitude:\r\n<script language="JavaScript">document.write(geoip_longitude());</script>\r\n<br>Postal Code:\r\n<script language="JavaScript">document.write(geoip_postal_code());</script>', 'GetYourLoaction', 'html', ''),
(12, 'Input Handling (insert selected item into a input box) get select item option value and text', '<html>\r\n\r\n<head>\r\n\r\n<title>Input handling</title>\r\n<script type="text/javascript">\r\nfunction setnametorun() {\r\n	var select_list_field = document.getElementById(''country'');\r\n	var select_list_selected_index = select_list_field.selectedIndex;\r\n\r\n	var text = select_list_field.options[select_list_selected_index].text;\r\n	alert(text);\r\n	var value = select_list_field.value;\r\n	alert(value);\r\n}\r\n</script>\r\n</head>\r\n\r\n<body>\r\n<form>\r\n<select name="country" class="formfielddropdown" id="country" onchange="document.getElementById(''CountryName'').value = this.options[selectedIndex].text" style="width: 200px;">\r\n<option value="A option">Asia/Pacific Region</option>\r\n<option value="B option">Andorra</option>\r\n</select>\r\n<input type="text" name="CountryName" id=''CountryName''>\r\n<input type="button" name="Example" value="Click here"  onClick="setnametorun();return false;">\r\n</form>\r\n</body>\r\n\r\n</html>', 'InputHandle', 'html', ''),
(15, 'Moving a site to an iframe', '<html>\r\n<body>\r\n\r\n<iframe src="http://raymondlwhuang.host56.com/MyHelpFile.php" width="30%" height="40%">\r\n  <p>Your browser does not support iframes.</p>\r\n</iframe>\r\n\r\n</body>\r\n</html>', 'MoveSiteToFrame', 'html', ''),
(18, 'Sorting Number', '<html>\r\n <head>\r\n\r\n\r\n </head>\r\n <body>\r\n <script>\r\n// Ascending numerical sort\r\nnumbers = [7, 23, 6, 74]\r\nnumbers.sort(function(a,b){return a - b})\r\ndocument.write(numbers + "<br />")\r\n\r\n// Descending numerical sort\r\nnumbers = [7, 23, 6, 74]\r\nnumbers.sort(function(a,b){return b - a})\r\ndocument.write(numbers + "<br />")\r\n</script> \r\n \r\n</body> \r\n</html>', 'NumberSort', 'html', ''),
(19, 'Redirect to other page if direct calling', '<html>\r\n<head>\r\n<meta http-equiv="content-type" content="text/html; charset=UTF-8">\r\n<script type="text/javascript">\r\n<!--\r\n	if (window.top === window.self) {\r\n		window.location = "http://raymondlwhuang.host56.com/MyHelpFile.php";\r\n	}\r\n//-->\r\n</script>\r\n</head>\r\n<body>\r\nThis site will redirect to other site if you straight calling it!\r\n</body>\r\n</html>', 'redirect', 'html', ''),
(87, 'Captcha Security Images', '<?php\r\nsession_start();\r\n\r\n/*\r\n* File: CaptchaSecurityImages.php\r\n* Author: Simon Jarvis\r\n* Copyright: 2006 Simon Jarvis\r\n* Date: 03/08/06\r\n* Updated: 07/02/07\r\n* Requirements: PHP 4/5 with GD and FreeType libraries\r\n* Link: http://www.white-hat-web-design.co.uk/articles/php-captcha.php\r\n* \r\n* This program is free software; you can redistribute it and/or \r\n* modify it under the terms of the GNU General Public License \r\n* as published by the Free Software Foundation; either version 2 \r\n* of the License, or (at your option) any later version.\r\n* \r\n* This program is distributed in the hope that it will be useful, \r\n* but WITHOUT ANY WARRANTY; without even the implied warranty of \r\n* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the \r\n* GNU General Public License for more details: \r\n* http://www.gnu.org/licenses/gpl.html\r\n*\r\n*/\r\n\r\nclass CaptchaSecurityImages {\r\n\r\n	var $font = ''monofont.ttf'';\r\n\r\n	function generateCode($characters) {\r\n		/* list all possible characters, similar looking characters and vowels have been removed */\r\n		$possible = ''23456789bcdfghjkmnpqrstvwxyz'';\r\n		$code = '''';\r\n		$i = 0;\r\n		while ($i < $characters) { \r\n			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);\r\n			$i++;\r\n		}\r\n		return $code;\r\n	}\r\n\r\n	function CaptchaSecurityImages($width=''120'',$height=''40'',$characters=''6'') {\r\n		$code = $this->generateCode($characters);\r\n		/* font size will be 75% of the image height */\r\n		$font_size = $height * 0.75;\r\n		$image = @imagecreate($width, $height) or die(''Cannot initialize new GD image stream'');\r\n		/* set the colours */\r\n		$background_color = imagecolorallocate($image, 255, 255, 255);\r\n		$text_color = imagecolorallocate($image, 20, 40, 100);\r\n		$noise_color = imagecolorallocate($image, 100, 120, 180);\r\n		/* generate random dots in background */\r\n		for( $i=0; $i<($width*$height)/3; $i++ ) {\r\n			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);\r\n		}\r\n		/* generate random lines in background */\r\n		for( $i=0; $i<($width*$height)/150; $i++ ) {\r\n			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);\r\n		}\r\n		/* create textbox and add text */\r\n		$textbox = imagettfbbox($font_size, 0, $this->font, $code) or die(''Error in imagettfbbox function'');\r\n		$x = ($width - $textbox[4])/2;\r\n		$y = ($height - $textbox[5])/2;\r\n		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code) or die(''Error in imagettftext function'');\r\n		/* output captcha image to browser */\r\n		header(''Content-Type: image/jpeg'');\r\n		imagejpeg($image);\r\n		imagedestroy($image);\r\n		$_SESSION[''security_code''] = $code;\r\n	}\r\n\r\n}\r\n\r\n$width = isset($_GET[''width'']) ? $_GET[''width''] : ''120'';\r\n$height = isset($_GET[''height'']) ? $_GET[''height''] : ''40'';\r\n$characters = isset($_GET[''characters'']) && $_GET[''characters''] > 1 ? $_GET[''characters''] : ''6'';\r\n\r\n$captcha = new CaptchaSecurityImages($width,$height,$characters);\r\n\r\n?>		', 'CaptchaSecurityImages', 'php', 'php'),
(20, 'Image Roll Over', '<html>\r\n\r\n<head>\r\n\r\n<title></title>\r\n<script type="text/javascript" src="../scripts/jquery-1.4.2.js"></script>\r\n<script language="javascript" type="text/javascript">\r\n$(document).ready(function() {\r\n	\r\n	$(''#login_btn'').mouseover(function () {\r\n		$(this).attr(''src'', ''../images/go-btn-over.jpg'');\r\n	});\r\n\r\n	$(''#login_btn'').mouseout(function () {\r\n		$(this).attr(''src'', ''../images/go-btn.jpg'');\r\n	});\r\n\r\n	\r\n});\r\n</script>\r\n</head>\r\n\r\n<body>\r\n<img src="../images/go-btn.jpg" width="107" height="27" id="login_btn">\r\n<form>\r\n<input type="image" onMouseOver="this.src=''../images/go-btn-over.jpg''" onMouseOut="this.src=''../images/go-btn.jpg''" src="../images/go-btn.jpg" name="Image6" width=107 height=27 border="0">\r\n</form>\r\n</body>\r\n\r\n</html>', 'RollOver', 'html', ''),
(21, 'Moving title', '<html>\r\n<head>\r\n<title>moving title</title>\r\n<script type="text/javascript" src="../scripts/movingtitle.js"></script>\r\n</head>\r\n<body>\r\n  <p>The title is moveing</p>\r\n</body>\r\n</html>', 'movingtitle', 'html', ''),
(22, 'array handling', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">\r\n  <head>\r\n    <title>Using array_splice()</title>\r\n    <link rel="stylesheet" type="text/css" href="common.css" />\r\n    <style type="text/css">\r\n      h2, pre { margin: 1px; }\r\n      table { margin: 0; border-collapse: collapse; width: 100%; }\r\n      th { text-align: left; }\r\n      th, td { text-align: left; padding: 4px; vertical-align: top; border: 1px solid gray; }\r\n    </style>\r\n  </head>\r\n  <body>\r\n    <h1>Using array_splice()</h1>\r\n\r\n<?php\r\necho "1. Adding two new elements to the middle</br>";\r\n$authors = array( "Steinbeck", "Kafka", "Tolkien" );\r\n$arrayToAdd = array( "Melville", "Hardy" );\r\nprint_r( $authors );\r\necho "</br>";\r\narray_splice( $authors, 2, 0, $arrayToAdd );\r\nprint_r( $authors );\r\necho "</br>";\r\necho "2. Replacing two elements with a new element";\r\necho "</br>";\r\n$authors = array( "Steinbeck", "Kafka", "Tolkien" );\r\n$arrayToAdd = array( "Bronte" );\r\nprint_r( $authors );\r\necho "</br>";\r\narray_splice( $authors, 0, 2, $arrayToAdd );\r\nprint_r( $authors );\r\necho "</br>";\r\necho "3. Removing the last two elements";\r\necho "</br>";\r\n$authors = array( "Steinbeck", "Kafka", "Tolkien" );\r\nprint_r( $authors );\r\narray_splice( $authors, 1 );\r\nprint_r( $authors );\r\necho "</br>";\r\necho "4. Inserting a string instead of an array";\r\necho "</br>";\r\n$authors = array( "Steinbeck", "Kafka", "Tolkien" );\r\nprint_r( $authors );\r\narray_splice( $authors, 1, 0, "Orwell" );\r\nprint_r( $authors );\r\necho "<p>The current element is: " . current( $authors ) . ".</p>";\r\necho "<p>The next element is: " . next( $authors ) . ".</p>";\r\necho "<p>...and its index is: " . key( $authors ) . ".</p>";\r\necho "<p>The next element is: " . next( $authors ) . ".</p>";\r\necho "<p>The previous element is: " . prev( $authors ) . ".</p>";\r\necho "<p>The first element is: " . reset( $authors ) . ".</p>";\r\necho "<p>The last element is: " . end( $authors ) . ".</p>";\r\necho "<p>The previous element is: " . prev( $authors ) . ".</p>";\r\n?>\r\n\r\n  </body>\r\n</html>', 'ArrayHandling', 'php', ''),
(23, 'Captcha Refresh/reload', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n<title>Catcha Refreshing</title>\r\n<script type="text/javascript">\r\nfunction reload()    {        \r\n	var img = new Image();        \r\n	img.src = ''../PHP/CaptchaSecurityImages.php?rand='' + Math.random();        \r\n	var x = document.getElementById(''captcha'');        \r\n	x.src = img.src;    \r\n}\r\n</script>\r\n</head>\r\n<body>\r\n        seems we need to install the ''gd libraries'' to make it works\r\n	<?php echo "need to upload to the server to make it works"; ?>\r\n	<a href="" onclick="reload();return false;">Reload</a></br>\r\n	<img src="../PHP/CaptchaSecurityImages.php" alt="captcha image" id="captcha">\r\n\r\n</body>\r\n</html>', 'captchaRefresh', 'php', ''),
(24, 'Cookie Handling with php', '<?php\r\n\r\nif ( isset( $_POST["sendInfo"] ) ) {\r\n  storeInfo();\r\n} elseif ( isset( $_GET["action"] ) and $_GET["action"] == "forget" ) {\r\n  forgetInfo();\r\n} else {\r\n  displayPage();\r\n}\r\n\r\nfunction storeInfo() {\r\n  if ( isset( $_POST["firstName"] ) ) {\r\n    setcookie( "firstName", $_POST["firstName"], time() + 60 * 60 * 24 * 365, "", "", false, true );\r\n  }\r\n\r\n  if ( isset( $_POST["location"] ) ) {\r\n    setcookie( "location", $_POST["location"], time() + 60 * 60 * 24 * 365, "", "", false, true );\r\n  }\r\n  header( "Location: CookieHandling.php" );\r\n}\r\n\r\nfunction forgetInfo() {\r\n//  setcookie( "firstName", "", time() - 3600, "", "", false, true ); /* not working in firefox */\r\n  setcookie(''firstName'', FALSE, 1, "", "", false, true); /* works in both firefox an IE */\r\n//  setcookie( "location", "", time() - 3600, "", "", false, true );\r\n  setcookie(''location'', FALSE, 1, "", "", false, true);\r\n  header( "Location: CookieHandling.php" );\r\n}\r\n\r\nfunction displayPage() {\r\n  $firstName = ( isset( $_COOKIE["firstName"] ) ) ? $_COOKIE["firstName"] : "";\r\n  $location = ( isset( $_COOKIE["location"] ) ) ? $_COOKIE["location"] : "";\r\n\r\n?>\r\n\r\n<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"\r\n  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">\r\n  <head>\r\n    <title>Remembering user information with cookies</title>\r\n    <link rel="stylesheet" type="text/css" href="common.css" />\r\n  </head>\r\n  <body>\r\n\r\n    <h2>Remembering user information with cookies</h2>\r\n\r\n<?php if ( $firstName or $location ) { ?>\r\n\r\n    <p>Hi, <?php echo $firstName ? $firstName : "visitor" ?><?php echo\r\n    $location ? " in $location" : "" ?>!</p>\r\n\r\n    <p>Here''s a little nursery rhyme I know:</p>\r\n\r\n    <p><em>Hey diddle diddle,<br />\r\n    The cat played the fiddle,<br />\r\n    The cow jumped over the moon.<br />\r\n    The little dog laughed to see such sport,<br />\r\n    And the dish ran away with the spoon.</em></p>\r\n\r\n    <p><a href="CookieHandling.php?action=forget">Forget about me!</a></p>\r\n \r\n<?php } else { ?>\r\n\r\n    <form action="CookieHandling.php" method="post">\r\n      <div style="width: 30em;">\r\n        <label for="firstName">What''s your first name?</label>\r\n        <input type="text" name="firstName" id="firstName" value="" />\r\n        <label for="location">Where do you live?</label>\r\n        <input type="text" name="location" id="location" value="" />\r\n        <div style="clear: both;">\r\n          <input type="submit" name="sendInfo" value="Send Info" />\r\n        </div>\r\n      </div>\r\n    </form>\r\n\r\n<?php } ?>\r\n\r\n<?php\r\n}\r\n?>\r\n\r\n  </body>\r\n</html>', 'CookieHandling', 'php', ''),
(4, 'Automaticly tab to other input box when the length of input is reach', '<html>\r\n <head>\r\n <script type="text/javascript">\r\n function autoTab(a,b)\r\n {\r\n	if(a.value.length == a.maxLength){\r\n		document.getElementById(b).focus();\r\n	}\r\n }\r\n </script>\r\n </head>\r\n <body>\r\n \r\nEnter your name: <input type="text" id="fname" maxlength = 10 onkeyup="autoTab(this,''tohere'');">\r\n<input type="text" id="tohere">\r\n \r\n</body> </html>', 'autoTab', 'html', ''),
(2, 'Count down timer', '<html>\r\n<head>\r\n<title>Count Down</title>\r\n\r\n</head>\r\n<body>\r\n<font color=#ff8000 id="timerID"></font>\r\n</body>\r\n<script type="text/javascript"> \r\nvar CountdownID = null;\r\n	var start_min = 0;\r\n	var start_sec = 30;\r\n\r\nwindow.onload = countDown(start_min, start_sec, "timerID");\r\n\r\nfunction countDown(pminute, psecond, timerID) {\r\n	var minute = ((pminute < 1) ? "" : "") + pminute;\r\n	var second = ((psecond < 10) ? "0": "") + psecond;\r\n\r\n	document.getElementById(timerID).innerHTML = minute+":"+second;\r\n\r\n	if (pminute == 0 && (psecond-1) < 0) { //Recurse timer\r\n		clearTimeout(CountdownID);\r\n\r\n		var command = "countDown("+start_min+", "+start_sec+", ''"+timerID+"'')";\r\n		CountdownID = window.setTimeout(command, 1000);\r\n\r\n		alert("Time is Up! Enter your PIN now to subscribe!");\r\n	}\r\n	else { //Decrease time by one second\r\n		--psecond;\r\n		if (psecond == 0) {\r\n    		psecond=start_sec;\r\n	       	if (pminute == 0){pminute = start_min;}\r\n	       	else {--pminute;}\r\n		}\r\n\r\n		var command = "countDown("+pminute+", "+psecond+", ''"+timerID+"'')";\r\n		CountdownID = window.setTimeout(command, 1000);\r\n	}\r\n}\r\n</script>\r\n</html>', 'countdown', 'html', ''),
(3, 'Loading page without refresh the site. Ajax load function', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<title>Page loading with Ajax</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />\r\n<link href="css/style.css" rel="stylesheet" type="text/css" />\r\n<script type="text/javascript" src="../scripts/ajaxload.js"></script>\r\n</head>\r\n  <div id="maincontent">\r\n    <div id="startbutton"><a href="../HTML/ajaxload2.html" onClick="SendRequest (''../HTML/ajaxload2.html'',''maincontent'');return false;">\r\n    <img src="../images/startbtn.png" border="0" /></a> </div>\r\n  </div>\r\n</body>\r\n</html>', 'ajaxload', 'html', ''),
(5, 'Cookie Handling with Javascript', '<html>\r\n<head>\r\n<title>Cookie Handling</title>\r\n<script type="text/javascript"> \r\nfunction makeCookie(name,value,days) {\r\n  var expires = "";\r\n  if (days){\r\n    var date = new Date();\r\n    date.setTime(date.getTime()+(days*24*60*60*1000));\r\n    expires = "; expires="+date.toGMTString();\r\n  }\r\n  document.cookie = name+"="+value+expires+"; path=/";\r\n  alert("Cookie had been set");\r\n}\r\n\r\nfunction readCookie(name) {\r\n	var thisCookie = document.cookie.split(";");\r\n	for (var i=0; i<thisCookie.length; i++) {\r\n		if(thisCookie[i].split("=")[0].indexOf(name) > -1)\r\n		{\r\n			return thisCookie[i].split("=")[1];\r\n			break;\r\n		}\r\n	}	\r\n\r\n  return null;\r\n}\r\n\r\nfunction killCookie(name){\r\n  makeCookie(name,'''',-1);\r\n}\r\n</script>\r\n</head>\r\n<body>\r\n<input type="text" name="myCookie" id="myCookie">\r\n<input type="button" value="set cookie" onclick="makeCookie(''myCookie'',document.getElementById(''myCookie'').value,3);"> \r\n<input type="button" value="read cookie" onclick="alert(readCookie(''myCookie''));"> \r\n</body>\r\n\r\n</html>', 'CookieHandling', 'html', ''),
(14, 'Input Handling(validate on required field)', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml"><head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\r\n<title>Thank you for participating!</title>\r\n<script src="../scripts/livevalidation_standalone.js"></script>       \r\n\r\n\r\n<style type="text/css">\r\nbody {\r\n    margin-left: 0px;\r\n    margin-top: 0px;\r\n    margin-right: 0px;\r\n    margin-bottom: 0px;\r\n    font-size:16px;    \r\n    font-family: Arial, Helvetica, sans-serif;\r\n}    \r\n\r\np {\r\n    margin:0px 0px 13px;\r\n}\r\n\r\n.main {\r\n    width:750px;\r\n    margin:auto;\r\n}\r\n\r\n.survey-container {\r\n    text-align:center;\r\n    overflow:hidden;\r\n}\r\n\r\nfieldset {\r\n    padding:5px 0px;\r\n    margin:5px 0px;\r\n    border:0px;                        \r\n}\r\n\r\n fieldset legend {\r\n    background-color:#E6E6E6;\r\n    padding:1px 2px;\r\n    font-weight:bold;\r\n}\r\n\r\n\r\n.survey-right{\r\n    float:right;        \r\n    width:360px;\r\n	padding-left:20px;\r\n    text-align:left;\r\n}\r\n\r\n#signup_form label {\r\n    float:left;\r\n    width:100px;\r\n}\r\n\r\n#signup_form input[type=text]:focus {\r\n    border-color:#0000b3!important;\r\n}\r\n\r\n.LV_valid {\r\n    padding-left: 18px;\r\n    color:#00CC00;\r\n    font-size: 12px;\r\n}\r\n    \r\n.LV_invalid {\r\n    padding-left: 18px;\r\n    color:#CC0000;\r\n    font-size: 12px;\r\n}\r\n\r\n.mobile-container {\r\n    padding-bottom:15px;\r\n}\r\n\r\n.mobile-container .LV_valid {\r\n    padding-left: 5px;\r\n    color:#00CC00;\r\n    font-size: 12px;\r\n    position:absolute;\r\n    margin-left:-60px;\r\n    margin-top:25px;\r\n}\r\n\r\n.mobile-container .LV_invalid {\r\n    padding-left: 5px;\r\n    color:#CC0000;\r\n    font-size: 12px;\r\n    position:absolute;\r\n    margin-left:-60px;\r\n    margin-top:25px;\r\n    \r\n}\r\n\r\n.style1 {\r\n    font-family: Arial, Helvetica, sans-serif;\r\n    color: #FFFFFF;\r\n    font-size: 16px;\r\n    font-weight: bold;\r\n}\r\n\r\n\r\n\r\n    .header{    \r\n        border-bottom-color:#949494;  \r\n        background-color:#CC0000;\r\n    }\r\n    .congratsmessage {\r\n        border-bottom-color:#949494;\r\n    }\r\n.style2 {\r\n	font-size: 18px;\r\n	font-weight: bold;\r\n}\r\n.mobile-container .LV_valid {\r\n    padding-left: 5px;\r\n    color:#00CC00;\r\n    font-size: 12px;\r\n    position:absolute;\r\n    margin-left:-60px;\r\n    margin-top:37px;\r\n}\r\n\r\n.mobile-container .LV_invalid {\r\n    padding-left: 5px;\r\n    color:#CC0000;\r\n    font-size: 12px;\r\n    position:absolute;\r\n    margin-left:-60px;\r\n    margin-top:37px;\r\n    \r\n}\r\n</style>\r\n\r\n\r\n</head>\r\n<body>\r\n\r\n<div class="main" style="padding-top:10px;">\r\n        <form id="signup_form" action="" method="post" onsubmit="return onsubmitForm(this)">                         \r\n                                              \r\n            <input name="dest_url" id="dest_url" value="winner2.php?t202kw=&amp;subid2=&amp;c1=" type="hidden">                                               \r\n            <input name="url" id="url" value="dailytipsnow.com" type="hidden">\r\n          \r\n      \r\n               <center> <div id="form" style="width:400px; text-align:left;">\r\n                <fieldset>\r\n                    <label for="my_testing"> My Testing*:</label>\r\n                     <input class="mreq" id="my_testing" name="my_testing" size="18" maxlength="30" msg=" " style="border: 1px solid rgb(130, 130, 130); padding: 4px; font-size: 20px;" type="text">  \r\n                <script type="text/javascript"> \r\n                      var my_testing = new LiveValidation(''my_testing'', { validMessage: "OK", wait: 1100 });\r\n                      my_testing.add(Validate.Presence, {failureMessage: "Required"});\r\n                    </script> \r\n                </fieldset> \r\n                <fieldset>\r\n                    <label for="email"> Email*:</label>\r\n                  \r\n                      <input class="mreq" id="email" name="email" size="18" maxlength="40" msg=" " style="border: 1px solid rgb(130, 130, 130); padding: 4px; font-size: 20px;" type="text">\r\n                      \r\n                <script type="text/javascript"> \r\n                      var email = new LiveValidation(''email'', { validMessage: "OK", wait: 1100 });\r\n                      email.add(Validate.Email, {failureMessage: "Invalid"});\r\n                      email.add(Validate.Presence, {failureMessage: "Required"});\r\n                    </script>\r\n                </fieldset>                             \r\n                <fieldset class="mobile-container">\r\n\r\n                    <label for="mobile_number1">Cell Phone*:</label>\r\n                      <input class="mreq" id="mobile_number1" name="mobile_number1" maxlength="3" size="1" msg=" " style="border: 1px solid rgb(130, 130, 130); padding: 4px; font-size: 20px;" onkeyup="nextfield(this)" type="text">\r\n                      <input class="mreq" id="mobile_number2" name="mobile_number2" maxlength="3" size="1" msg=" " style="border: 1px solid rgb(130, 130, 130); padding: 4px; font-size: 20px;" onkeyup="nextfield(this)" type="text">\r\n                      <input class="mreq" id="mobile_number3" name="mobile_number3" maxlength="4" size="2" msg=" " style="border: 1px solid rgb(130, 130, 130); padding: 4px; font-size: 20px;" type="text">\r\n                  \r\n                <script type="text/javascript"> \r\n                      var mobile_number1 = new LiveValidation(''mobile_number1'', { validMessage: "OK", wait: 1100 });\r\n                      mobile_number1.add(Validate.Numericality , {notANumberMessage: "Not Numeric"});\r\n                      mobile_number1.add(Validate.Presence, {failureMessage: "Required"});\r\n                      mobile_number1.add( Validate.Length, { is: 3, wrongLengthMessage: "Not 3-digits"} );\r\n                      var mobile_number2 = new LiveValidation(''mobile_number2'', { validMessage: "OK", wait: 1100 });\r\n                      mobile_number2.add(Validate.Numericality , {notANumberMessage: "Not Numeric"});\r\n                      mobile_number2.add(Validate.Presence, {failureMessage: "Required"});\r\n                      mobile_number2.add( Validate.Length, { is: 3, wrongLengthMessage: "Not 3-digits"} );\r\n                      var mobile_number3 = new LiveValidation(''mobile_number3'', { validMessage: "OK", wait: 1100 });\r\n                      mobile_number3.add(Validate.Numericality , {notANumberMessage: "Not Numeric"});\r\n                      mobile_number3.add(Validate.Presence, {failureMessage: "Required"});\r\n                      mobile_number3.add( Validate.Length, { is: 4, wrongLengthMessage: "Not 4-digits"} );\r\n                    </script>\r\n                </fieldset>\r\n			\r\n                <fieldset style="width:430px;text-align:center;"> \r\n                        <input name="submit" src="../images/next_green.jpg" type="image">\r\n &nbsp;  &nbsp; &nbsp;\r\n                </fieldset>  \r\n  \r\n\r\n\r\n                                        \r\n<!-- End Content -->         \r\n\r\n</div>      \r\n\r\n\r\n<div id="bottom">\r\n  <span style="color: rgb(66, 66, 66);">\r\n    \r\n    \r\n  </span>\r\n\r\n  <center>\r\n  </center> \r\n</div>\r\n\r\n \r\n\r\n<!--- Footer Begin ----->\r\n\r\n\r\n\r\n<!--- Footer End ----->\r\n\r\n\r\n\r\n</center></form></div></body></html>', 'livevalidation_standalone', 'html', '');
INSERT INTO `main` (`id`, `ShortDesc`, `Source`, `Name`, `Ext`, `SearchGroup`) VALUES
(25, 'Get Province/State base on country you selected', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n<?php\r\nsession_start();\r\n?>\r\n<html>\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">\r\n<title>Get Province/State base on country you selected</title>\r\n<script type="text/javascript" src="../scripts/jquery-1.4.2.js"></script>\r\n<script type="text/javascript">\r\n$(document).ready(function() {\r\n	$(''#country'').change(function () {\r\n		var country = $(this).val();\r\n		$.ajax({\r\n		    type: ''POST'',\r\n		    url: ''signup.php'',\r\n		    data: ''change_state='' + country,\r\n		    success: function(data) {\r\n				$(''#state_data'').html(data);\r\n			}\r\n		});\r\n	});\r\n});\r\n</script>\r\n</head>\r\n<body>\r\nYOU NEED TO UPLOAD THIS INTO THE SERVER TO HAVE IT WORKED\r\n<table width="100%" border="0" cellpadding="5" cellspacing="0" class="FormPubText">\r\n<tr>\r\n<td>\r\n              <select name="country" class="FieldPub" id="country">\r\n                  <option value="1" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="1") echo "selected"; ?> >Asia/Pacific Region</option>\r\n                  <option value="3" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="3") echo "selected"; ?> >Andorra</option>\r\n                  <option value="4" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="4") echo "selected"; ?> >United Arab Emirates</option>\r\n                  <option value="5" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="5") echo "selected"; ?> >Afghanistan</option>\r\n                  <option value="6" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="6") echo "selected"; ?> >Antigua and Barbuda</option>\r\n                  <option value="7" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="7") echo "selected"; ?> >Anguilla</option>\r\n                  <option value="8" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="8") echo "selected"; ?> >Albania</option>\r\n                  <option value="9" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="9") echo "selected"; ?> >Armenia</option>\r\n                  <option value="10" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="10") echo "selected"; ?> >Netherlands Antilles</option>\r\n                  <option value="11" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="11") echo "selected"; ?> >Angola</option>\r\n                  <option value="12" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="12") echo "selected"; ?> >Antarctica</option>\r\n                  <option value="13" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="13") echo "selected"; ?> >Argentina</option>\r\n                  <option value="14" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="14") echo "selected"; ?> >American Samoa</option>\r\n                  <option value="15" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="15") echo "selected"; ?> >Austria</option>\r\n                  <option value="16" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="16") echo "selected"; ?> >Australia</option>\r\n                  <option value="17" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="17") echo "selected"; ?> >Aruba</option>\r\n                  <option value="18" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="18") echo "selected"; ?> >Azerbaijan</option>\r\n                  <option value="19" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="19") echo "selected"; ?> >Bosnia and Herzegovina</option>\r\n                  <option value="20" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="20") echo "selected"; ?> >Barbados</option>\r\n                  <option value="21" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="21") echo "selected"; ?> >Bangladesh</option>\r\n                  <option value="22" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="22") echo "selected"; ?> >Belgium</option>\r\n                  <option value="23" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="23") echo "selected"; ?> >Burkina Faso</option>\r\n                  <option value="24" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="24") echo "selected"; ?> >Bulgaria</option>\r\n                  <option value="25" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="25") echo "selected"; ?> >Bahrain</option>\r\n                  <option value="26" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="26") echo "selected"; ?> >Burundi</option>\r\n                  <option value="27" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="27") echo "selected"; ?> >Benin</option>\r\n                  <option value="28" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="28") echo "selected"; ?> >Bermuda</option>\r\n                  <option value="29" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="29") echo "selected"; ?> >Brunei Darussalam</option>\r\n                  <option value="30" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="30") echo "selected"; ?> >Bolivia</option>\r\n                  <option value="31" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="31") echo "selected"; ?> >Brazil</option>\r\n                  <option value="32" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="32") echo "selected"; ?> >Bahamas</option>\r\n                  <option value="33" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="33") echo "selected"; ?> >Bhutan</option>\r\n                  <option value="34" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="37") echo "selected"; ?> >Bouvet Island</option>\r\n                  <option value="35" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="35") echo "selected"; ?> >Botswana</option>\r\n                  <option value="36" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="36") echo "selected"; ?> >Belarus</option>\r\n                  <option value="37" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="37") echo "selected"; ?> >Belize</option>\r\n                  <option value="38" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="38") echo "selected"; ?> >Canada</option>\r\n                  <option value="39" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="39") echo "selected"; ?> >Cocos (Keeling) Islands</option>\r\n                  <option value="40" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="40") echo "selected"; ?> >Congo, The Democratic Republic of the</option>\r\n                  <option value="41" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="41") echo "selected"; ?> >Central African Republic</option>\r\n                  <option value="42" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="42") echo "selected"; ?> >Congo</option>\r\n                  <option value="43" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="43") echo "selected"; ?> >Switzerland</option>\r\n                  <option value="44" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="44") echo "selected"; ?> >Cote D''Ivoire</option>\r\n                  <option value="45" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="45") echo "selected"; ?> >Cook Islands</option>\r\n                  <option value="46" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="46") echo "selected"; ?> >Chile</option>\r\n                  <option value="47" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="47") echo "selected"; ?> >Cameroon</option>\r\n                  <option value="48" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="48") echo "selected"; ?> >China</option>\r\n                  <option value="49" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="49") echo "selected"; ?> >Colombia</option>\r\n                  <option value="50" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="50") echo "selected"; ?> >Costa Rica</option>\r\n                  <option value="51" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="51") echo "selected"; ?> >Cuba</option>\r\n                  <option value="52" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="52") echo "selected"; ?> >Cape Verde</option>\r\n                  <option value="53" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="53") echo "selected"; ?> >Christmas Island</option>\r\n                  <option value="54" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="54") echo "selected"; ?> >Cyprus</option>\r\n                  <option value="55" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="55") echo "selected"; ?> >Czech Republic</option>\r\n                  <option value="56" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="56") echo "selected"; ?> >Germany</option>\r\n                  <option value="57" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="57") echo "selected"; ?> >Djibouti</option>\r\n                  <option value="58" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="58") echo "selected"; ?> >Denmark</option>\r\n                  <option value="59" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="59") echo "selected"; ?> >Dominica</option>\r\n                  <option value="60" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="60") echo "selected"; ?> >Dominican Republic</option>\r\n                  <option value="61" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="61") echo "selected"; ?> >Algeria</option>\r\n                  <option value="62" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="62") echo "selected"; ?> >Ecuador</option>\r\n                  <option value="63" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="63") echo "selected"; ?> >Estonia</option>\r\n                  <option value="64" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="64") echo "selected"; ?> >Egypt</option>\r\n                  <option value="65" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="65") echo "selected"; ?> >Western Sahara</option>\r\n                  <option value="66" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="66") echo "selected"; ?> >Eritrea</option>\r\n                  <option value="67" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="67") echo "selected"; ?> >Spain</option>\r\n                  <option value="68" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="68") echo "selected"; ?> >Ethiopia</option>\r\n                  <option value="69" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="69") echo "selected"; ?> >Finland</option>\r\n                  <option value="70" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="70") echo "selected"; ?> >Fiji</option>\r\n                  <option value="71" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="71") echo "selected"; ?> >Falkland Islands (Malvinas)</option>\r\n                  <option value="72" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="72") echo "selected"; ?> >Micronesia, Federated States of</option>\r\n                  <option value="73" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="73") echo "selected"; ?> >Faroe Islands</option>\r\n                  <option value="74" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="74") echo "selected"; ?> >France</option>\r\n                  <option value="75" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="75") echo "selected"; ?> >France, Metropolitan</option>\r\n                  <option value="76" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="76") echo "selected"; ?> >Gabon</option>\r\n                  <option value="77" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="77") echo "selected"; ?> >United Kingdom</option>\r\n                  <option value="78" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="78") echo "selected"; ?> >Grenada</option>\r\n                  <option value="79" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="79") echo "selected"; ?> >Georgia</option>\r\n                  <option value="80" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="80") echo "selected"; ?> >French Guiana</option>\r\n                  <option value="81" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="81") echo "selected"; ?> >Ghana</option>\r\n                  <option value="82" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="82") echo "selected"; ?> >Gibraltar</option>\r\n                  <option value="83" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="83") echo "selected"; ?> >Greenland</option>\r\n                  <option value="84" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="84") echo "selected"; ?> >Gambia</option>\r\n                  <option value="85" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="85") echo "selected"; ?> >Guinea</option>\r\n                  <option value="86" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="86") echo "selected"; ?> >Guadeloupe</option>\r\n                  <option value="87" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="87") echo "selected"; ?> >Equatorial Guinea</option>\r\n                  <option value="88" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="88") echo "selected"; ?> >Greece</option>\r\n                  <option value="89" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="89") echo "selected"; ?> >South Georgia and the South Sandwich Islands</option>\r\n                  <option value="90" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="90") echo "selected"; ?> >Guatemala</option>\r\n                  <option value="91" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="91") echo "selected"; ?> >Guam</option>\r\n                  <option value="92" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="92") echo "selected"; ?> >Guinea-Bissau</option>\r\n                  <option value="93" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="93") echo "selected"; ?> >Guyana</option>\r\n                  <option value="94" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="94") echo "selected"; ?> >Hong Kong</option>\r\n                  <option value="95" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="95") echo "selected"; ?> >Heard Island and McDonald Islands</option>\r\n                  <option value="96" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="96") echo "selected"; ?> >Honduras</option>\r\n                  <option value="97" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="97") echo "selected"; ?> >Croatia</option>\r\n                  <option value="98" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="98") echo "selected"; ?> >Haiti</option>\r\n                  <option value="99" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="99") echo "selected"; ?> >Hungary</option>\r\n                  <option value="100" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="100") echo "selected"; ?> >Indonesia</option>\r\n                  <option value="101" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="101") echo "selected"; ?> >Ireland</option>\r\n                  <option value="102" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="102") echo "selected"; ?> >Israel</option>\r\n                  <option value="103" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="103") echo "selected"; ?> >India</option>\r\n                  <option value="104" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="104") echo "selected"; ?> >British Indian Ocean Territory</option>\r\n                  <option value="105" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="105") echo "selected"; ?> >Iraq</option>\r\n                  <option value="106" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="106") echo "selected"; ?> >Iran, Islamic Republic of</option>\r\n                  <option value="107" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="107") echo "selected"; ?> >Iceland</option>\r\n                  <option value="108" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="108") echo "selected"; ?> >Italy</option>\r\n                  <option value="109" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="109") echo "selected"; ?> >Jamaica</option>\r\n                  <option value="110" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="110") echo "selected"; ?> >Jordan</option>\r\n                  <option value="111" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="111") echo "selected"; ?> >Japan</option>\r\n                  <option value="112" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="112") echo "selected"; ?> >Kenya</option>\r\n                  <option value="113" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="113") echo "selected"; ?> >Kyrgyzstan</option>\r\n                  <option value="114" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="114") echo "selected"; ?> >Cambodia</option>\r\n                  <option value="115" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="115") echo "selected"; ?> >Kiribati</option>\r\n                  <option value="116" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="116") echo "selected"; ?> >Comoros</option>\r\n                  <option value="117" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="117") echo "selected"; ?> >Saint Kitts and Nevis</option>\r\n                  <option value="118" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="118") echo "selected"; ?> >Korea, Democratic People''s Republic of</option>\r\n                  <option value="119" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="119") echo "selected"; ?> >Korea, Republic of</option>\r\n                  <option value="120" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="120") echo "selected"; ?> >Kuwait</option>\r\n                  <option value="121" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="121") echo "selected"; ?> >Cayman Islands</option>\r\n                  <option value="122" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="122") echo "selected"; ?> >Kazakhstan</option>\r\n                  <option value="123" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="123") echo "selected"; ?> >Lao People''s Democratic Republic</option>\r\n                  <option value="124" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="124") echo "selected"; ?> >Lebanon</option>\r\n                  <option value="125" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="125") echo "selected"; ?> >Saint Lucia</option>\r\n                  <option value="126" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="126") echo "selected"; ?> >Liechtenstein</option>\r\n                  <option value="127" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="127") echo "selected"; ?> >Sri Lanka</option>\r\n                  <option value="128" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="128") echo "selected"; ?> >Liberia</option>\r\n                  <option value="129" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="129") echo "selected"; ?> >Lesotho</option>\r\n                  <option value="130" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="130") echo "selected"; ?> >Lithuania</option>\r\n                  <option value="131" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="131") echo "selected"; ?> >Luxembourg</option>\r\n                  <option value="132" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="132") echo "selected"; ?> >Latvia</option>\r\n                  <option value="133" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="133") echo "selected"; ?> >Libyan Arab Jamahiriya</option>\r\n                  <option value="134" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="134") echo "selected"; ?> >Morocco</option>\r\n                  <option value="135" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="135") echo "selected"; ?> >Monaco</option>\r\n                  <option value="136" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="136") echo "selected"; ?> >Moldova, Republic of</option>\r\n                  <option value="137" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="137") echo "selected"; ?> >Madagascar</option>\r\n                  <option value="138" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="138") echo "selected"; ?> >Marshall Islands</option>\r\n                  <option value="139" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="139") echo "selected"; ?> >Macedonia</option>\r\n                  <option value="140" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="140") echo "selected"; ?> >Mali</option>\r\n                  <option value="141" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="141") echo "selected"; ?> >Myanmar</option>\r\n                  <option value="142" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="142") echo "selected"; ?> >Mongolia</option>\r\n                  <option value="143" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="143") echo "selected"; ?> >Macau</option>\r\n                  <option value="144" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="144") echo "selected"; ?> >Northern Mariana Islands</option>\r\n                  <option value="145" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="145") echo "selected"; ?> >Martinique</option>\r\n                  <option value="146" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="146") echo "selected"; ?> >Mauritania</option>\r\n                  <option value="147" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="147") echo "selected"; ?> >Montserrat</option>\r\n                  <option value="148" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="148") echo "selected"; ?> >Malta</option>\r\n                  <option value="149" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="149") echo "selected"; ?> >Mauritius</option>\r\n                  <option value="150" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="150") echo "selected"; ?> >Maldives</option>\r\n                  <option value="151" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="151") echo "selected"; ?> >Malawi</option>\r\n                  <option value="152" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="152") echo "selected"; ?> >Mexico</option>\r\n                  <option value="153" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="153") echo "selected"; ?> >Malaysia</option>\r\n                  <option value="154" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="154") echo "selected"; ?> >Mozambique</option>\r\n                  <option value="155" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="155") echo "selected"; ?> >Namibia</option>\r\n                  <option value="156" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="156") echo "selected"; ?> >New Caledonia</option>\r\n                  <option value="157" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="157") echo "selected"; ?> >Niger</option>\r\n                  <option value="158" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="158") echo "selected"; ?> >Norfolk Island</option>\r\n                  <option value="159" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="159") echo "selected"; ?> >Nigeria</option>\r\n                  <option value="160" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="160") echo "selected"; ?> >Nicaragua</option>\r\n                  <option value="161" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="161") echo "selected"; ?> >Netherlands</option>\r\n                  <option value="162" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="162") echo "selected"; ?> >Norway</option>\r\n                  <option value="163" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="163") echo "selected"; ?> >Nepal</option>\r\n                  <option value="164" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="164") echo "selected"; ?> >Nauru</option>\r\n                  <option value="165" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="165") echo "selected"; ?> >Niue</option>\r\n                  <option value="166" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="166") echo "selected"; ?> >New Zealand</option>\r\n                  <option value="167" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="167") echo "selected"; ?> >Oman</option>\r\n                  <option value="168" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="168") echo "selected"; ?> >Panama</option>\r\n                  <option value="169" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="169") echo "selected"; ?> >Peru</option>\r\n                  <option value="170" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="170") echo "selected"; ?> >French Polynesia</option>\r\n                  <option value="171" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="171") echo "selected"; ?> >Papua New Guinea</option>\r\n                  <option value="172" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="172") echo "selected"; ?> >Philippines</option>\r\n                  <option value="173" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="173") echo "selected"; ?> >Pakistan</option>\r\n                  <option value="174" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="174") echo "selected"; ?> >Poland</option>\r\n                  <option value="175" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="175") echo "selected"; ?> >Saint Pierre and Miquelon</option>\r\n                  <option value="176" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="176") echo "selected"; ?> >Pitcairn Islands</option>\r\n                  <option value="177" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="177") echo "selected"; ?> >Puerto Rico</option>\r\n                  <option value="178" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="178") echo "selected"; ?> >Palestinian Territory</option>\r\n                  <option value="179" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="179") echo "selected"; ?> >Portugal</option>\r\n                  <option value="180" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="180") echo "selected"; ?> >Palau</option>\r\n                  <option value="181" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="181") echo "selected"; ?> >Paraguay</option>\r\n                  <option value="182" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="182") echo "selected"; ?> >Qatar</option>\r\n                  <option value="183" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="183") echo "selected"; ?> >Reunion</option>\r\n                  <option value="184" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="184") echo "selected"; ?> >Romania</option>\r\n                  <option value="185" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="185") echo "selected"; ?> >Russian Federation</option>\r\n                  <option value="186" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="186") echo "selected"; ?> >Rwanda</option>\r\n                  <option value="187" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="187") echo "selected"; ?> >Saudi Arabia</option>\r\n                  <option value="188" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="188") echo "selected"; ?> >Solomon Islands</option>\r\n                  <option value="189" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="189") echo "selected"; ?> >Seychelles</option>\r\n                  <option value="190" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="190") echo "selected"; ?> >Sudan</option>\r\n                  <option value="191" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="191") echo "selected"; ?> >Sweden</option>\r\n                  <option value="192" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="192") echo "selected"; ?> >Singapore</option>\r\n                  <option value="193" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="193") echo "selected"; ?> >Saint Helena</option>\r\n                  <option value="194" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="194") echo "selected"; ?> >Slovenia</option>\r\n                  <option value="195" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="195") echo "selected"; ?> >Svalbard and Jan Mayen</option>\r\n                  <option value="196" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="196") echo "selected"; ?> >Slovakia</option>\r\n                  <option value="197" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="197") echo "selected"; ?> >Sierra Leone</option>\r\n                  <option value="198" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="198") echo "selected"; ?> >San Marino</option>\r\n                  <option value="199" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="199") echo "selected"; ?> >Senegal</option>\r\n                  <option value="200" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="200") echo "selected"; ?> >Somalia</option>\r\n                  <option value="201" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="201") echo "selected"; ?> >Suriname</option>\r\n                  <option value="202" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="202") echo "selected"; ?> >Sao Tome and Principe</option>\r\n                  <option value="203" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="203") echo "selected"; ?> >El Salvador</option>\r\n                  <option value="204" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="204") echo "selected"; ?> >Syrian Arab Republic</option>\r\n                  <option value="205" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="205") echo "selected"; ?> >Swaziland</option>\r\n                  <option value="206" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="206") echo "selected"; ?> >Turks and Caicos Islands</option>\r\n                  <option value="207" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="207") echo "selected"; ?> >Chad</option>\r\n                  <option value="208" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="208") echo "selected"; ?> >French Southern Territories</option>\r\n                  <option value="209" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="209") echo "selected"; ?> >Togo</option>\r\n                  <option value="210" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="210") echo "selected"; ?> >Thailand</option>\r\n                  <option value="211" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="211") echo "selected"; ?> >Tajikistan</option>\r\n                  <option value="212" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="212") echo "selected"; ?> >Tokelau</option>\r\n                  <option value="213" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="213") echo "selected"; ?> >Turkmenistan</option>\r\n                  <option value="214" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="214") echo "selected"; ?> >Tunisia</option>\r\n                  <option value="215" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="215") echo "selected"; ?> >Tonga</option>\r\n                  <option value="216" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="216") echo "selected"; ?> >Timor-Leste</option>\r\n                  <option value="217" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="217") echo "selected"; ?> >Turkey</option>\r\n                  <option value="218" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="218") echo "selected"; ?> >Trinidad and Tobago</option>\r\n                  <option value="219" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="219") echo "selected"; ?> >Tuvalu</option>\r\n                  <option value="220" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="220") echo "selected"; ?> >Taiwan</option>\r\n                  <option value="221" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="221") echo "selected"; ?> >Tanzania, United Republic of</option>\r\n                  <option value="222" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="222") echo "selected"; ?> >Ukraine</option>\r\n                  <option value="223" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="223") echo "selected"; ?> >Uganda</option>\r\n                  <option value="224" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="224") echo "selected"; ?> >United States Minor Outlying Islands</option>\r\n                  <option value="225" <?php if((isset($_SESSION[''country'']) && $_SESSION[''country'']=="225") or !isset($_SESSION[''country''])) echo "selected"; ?> >United States</option>\r\n                  <option value="226" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="226") echo "selected"; ?> >Uruguay</option>\r\n                  <option value="227" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="227") echo "selected"; ?> >Uzbekistan</option>\r\n                  <option value="228" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="228") echo "selected"; ?> >Holy See (Vatican City State)</option>\r\n                  <option value="229" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="229") echo "selected"; ?> >Saint Vincent and the Grenadines</option>\r\n                  <option value="230" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="230") echo "selected"; ?> >Venezuela</option>\r\n                  <option value="231" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="231") echo "selected"; ?> >Virgin Islands, British</option>\r\n                  <option value="232" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="232") echo "selected"; ?> >Virgin Islands, U.S.</option>\r\n                  <option value="233" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="233") echo "selected"; ?> >Vietnam</option>\r\n                  <option value="234" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="234") echo "selected"; ?> >Vanuatu</option>\r\n                  <option value="235" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="235") echo "selected"; ?> >Wallis and Futuna</option>\r\n                  <option value="236" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="236") echo "selected"; ?> >Samoa</option>\r\n                  <option value="237" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="237") echo "selected"; ?> >Yemen</option>\r\n                  <option value="238" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="238") echo "selected"; ?> >Mayotte</option>\r\n                  <option value="239" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="239") echo "selected"; ?> >Serbia</option>\r\n                  <option value="240" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="240") echo "selected"; ?> >South Africa</option>\r\n                  <option value="241" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="241") echo "selected"; ?> >Zambia</option>\r\n                  <option value="242" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="242") echo "selected"; ?> >Montenegro</option>\r\n                  <option value="243" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="243") echo "selected"; ?> >Zimbabwe</option>\r\n                  <option value="244" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="244") echo "selected"; ?> >Anonymous Proxy</option>\r\n                  <option value="245" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="245") echo "selected"; ?> >Satellite Provider</option>\r\n                  <option value="246" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="246") echo "selected"; ?> >Other</option>\r\n                  <option value="247" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="247") echo "selected"; ?> >Aland Islands</option>\r\n                  <option value="248" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="248") echo "selected"; ?> >Guernsey</option>\r\n                  <option value="249" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="249") echo "selected"; ?> >Isle of Man</option>\r\n                  <option value="250" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="250") echo "selected"; ?> >Jersey</option>\r\n                  <option value="251" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="251") echo "selected"; ?> >Saint Barthelemy</option>\r\n                  <option value="252" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="252") echo "selected"; ?> >Saint Martin</option>\r\n                  <option value="253" <?php if(isset($_SESSION[''country'']) && $_SESSION[''country'']=="253") echo "selected"; ?> >Kosovo</option>\r\n                </select>\r\n                </td>\r\n                </tr>\r\n            <td id="state_data">\r\n            <select name="select_state" id="select_state"  class="FieldPub">\r\n				<option value="AK">Alaska</option>\r\n				<option value="AL">Alabama</option>\r\n				<option value="AR">Arkansas</option>\r\n				<option value="AS">American Samoa</option>\r\n				<option value="AZ">Arizona</option>\r\n				<option value="CA">California</option>\r\n				<option value="CO">Colorado</option>\r\n				<option value="CT">Connecticut</option>\r\n				<option value="DC">D.C.</option>\r\n				<option value="DE">Delaware</option>\r\n				<option value="FL">Florida</option>\r\n				<option value="FM">Micronesia</option>\r\n				<option value="GA">Georgia</option>\r\n				<option value="GU">Guam</option>\r\n				<option value="HI">Hawaii</option>\r\n				<option value="IA">Iowa</option>\r\n				<option value="ID">Idaho</option>\r\n				<option value="IL">Illinois</option>\r\n				<option value="IN">Indiana</option>\r\n				<option value="KS">Kansas</option>\r\n				<option value="KY">Kentucky</option>\r\n				<option value="LA">Louisiana</option>\r\n				<option value="MA">Massachusetts</option>\r\n				<option value="MD">Maryland</option>\r\n				<option value="ME">Maine</option>\r\n				<option value="MH">Marshall Islands</option>\r\n				<option value="MI">Michigan</option>\r\n				<option value="MN">Minnesota</option>\r\n				<option value="MO">Missouri</option>\r\n				<option value="MP">Marianas</option>\r\n				<option value="MS">Mississip', 'CountryProvince', 'php', ''),
(26, 'e-mail valification in php (validate boolean,float,int,ip,regexp, url', '<?php\r\nIF(isset($_POST[''EMail'']))\r\n{\r\n	$EMail = mysql_real_escape_string($_POST[''EMail'']);;\r\n	if(!filter_var((String) $EMail, FILTER_VALIDATE_EMAIL)) $ErrorMessage = "Invalide e-mail address"; else $ErrorMessage = "This is a valid e-mail address";\r\n	\r\n}\r\n//FILTER_VALIDATE_BOOLEAN, FILTER_VALIDATE_FLOAT, FILTER_VALIDATE_INT,FILTER_VALIDATE_IP,FILTER_VALIDATE_REGEXP,FILTER_VALIDATE_URL\r\n?>\r\n<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n<html>\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">\r\n<title>e-mail valification</title>\r\n</head>\r\n<body>\r\n\r\n<form name="ValidateUser" action="<?php echo $_SERVER[''SCRIPT_NAME'']; ?>" method="Post">\r\n<div align="center"><center>\r\n<font color=#ff8000 id="ErrorMessage"><?php if (isset($ErrorMessage)){ echo ''**''.htmlspecialchars($ErrorMessage).''**   ''; } else ''''; ?></font>\r\n<br>\r\n<br>\r\n  <table border="0">\r\n    <tr>\r\n      <td><p>E-Mail Address:</p></td>\r\n      <td><input type="text"  name="EMail" size="30"  maxlength="50" id="EMail" class="email" value="<?php if (isset($_POST[''EMail''])){ echo htmlspecialchars($EMail); } else ''''; ?>" /></td>\r\n    </tr>\r\n  </table>\r\n  </form>\r\n</center></div>\r\n</body>\r\n</html>', 'emailValidate', 'php', ''),
(27, 'Listing the contents of a directory', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"\r\n  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">\r\n  <head>\r\n    <title>Listing the contents of a directory</title>\r\n    <link rel="stylesheet" type="text/css" href="common.css" />\r\n  </head>\r\n  <body>\r\n    <h1>Listing the contents of a directory</h1>\r\n\r\n<?php\r\n\r\n$dirPath = ".";\r\n\r\nfunction traverseDir( $dir ) {\r\n  echo "<h2>Listing $dir ...</h2>";\r\n  if ( !( $handle = opendir( $dir ) ) ) die( "Cannot open $dir." );\r\n\r\n  $files = array();\r\n\r\n  while ( $file = readdir( $handle ) ) {\r\n    if ( $file != "." && $file != ".." ) {\r\n      if ( is_dir( $dir . "/" . $file ) ) $file .= "/";\r\n      $files[] = $file;\r\n    }\r\n  }\r\n\r\n  sort( $files );\r\n  echo "<ul>";\r\n  foreach ( $files as $file ) echo "<li>$file</li>";\r\n  echo "</ul>";\r\n\r\n  foreach ( $files as $file ) {\r\n    if ( substr( $file, -1 )  == "/" ) traverseDir( "$dir/" . substr( $file, 0, -1 ) );\r\n  }\r\n\r\n  closedir( $handle );\r\n}\r\n\r\ntraverseDir( $dirPath );\r\n\r\n?>\r\n  </body>\r\n</html>', 'FileDirListing', 'php', ''),
(28, 'upload files', '<?php \r\necho <<<_END\r\n<html><head><title>PHP Form Upload</title></head><body>\r\n<form method=''post'' enctype=''multipart/form-data''>\r\nSelect a File:\r\n<input type=''file'' name=''filename'' size=''10'' />\r\n<input type=''submit'' value=''Upload'' /></form>\r\n_END;\r\n\r\nif ($_FILES)\r\n{\r\n	$name = $_FILES[''filename''][''name''];\r\n	$ext = substr($name,strpos($name,".") + 1);\r\n	if ($ext == ''pdf'') $n = "pdf/".$name;\r\n	else if ($ext == ''txt'') $n = "txt/".$name;\r\n	else if ($ext == ''zip'') $n = "zip/".$name;\r\n	else if ($ext == ''sql'') $n = "sql/".$name;\r\n	else if ($ext == ''php'') $n = "PHP/".$name;\r\n	else if ($ext == ''js'') $n = "scripts/".$name;\r\n	else if ($ext == ''html'') $n = "HTML/".$name;\r\n	else if ($ext == ''htm'') $n = "HTML/".$name;\r\n	else $n = "images/".$name;\r\n	if(!move_uploaded_file($_FILES[''filename''][''tmp_name''], $n))\r\n	echo  "$ext Upload failed!";\r\n	else echo  "$ext Uploaded file ''$name'' as ''$n'':<br />";\r\n}\r\nelse echo "No file has been uploaded";\r\necho "</body></html>";\r\n/*\r\nif ($_FILES)\r\n{\r\n	$name = $_FILES[''filename''][''name''];\r\n\r\n	switch($_FILES[''filename''][''type''])\r\n	{\r\n		case ''image/jpeg'': $ext = ''jpg''; break;\r\n		case ''image/gif'':  $ext = ''gif''; break;\r\n		case ''image/png'':  $ext = ''png''; break;\r\n		case ''image/tiff'': $ext = ''tif''; break;\r\n		default:		   $ext = '''';    break;\r\n	}\r\n	if ($ext)\r\n	{\r\n		//$n = "image.$ext";\r\n		$n = "../images/".$name;\r\n		move_uploaded_file($_FILES[''filename''][''tmp_name''], $n);\r\n		echo "Uploaded image ''$name'' as ''$n'':<br />";\r\n		echo "<img src=''$n'' />";\r\n	}\r\n	else echo "''$name'' is not an accepted image file";\r\n}\r\nelse echo "No image has been uploaded";\r\n*/\r\n?>', 'fileUpload', 'php', ''),
(29, 'Find the Browser Name', '<?php $brwsr = strtolower($_SERVER[''HTTP_USER_AGENT'']); \r\necho "This is the browser your current running: ".$brwsr;\r\n?>', 'FindBrowserName', 'php', ''),
(30, 'Find specified type of files, Current working directory', '<?php\r\nIF(isset($_POST[''find'']))\r\n{\r\n	$dir = $_POST[''target_path''];\r\n	chdir($dir);\r\n	$files = glob(''*.{php,txt}'', GLOB_BRACE);  \r\n	$files = array_map(''realpath'',$files);    \r\n	var_dump($files);\r\n}\r\n?>\r\n<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n<html>\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">\r\n<title></title>\r\n</head>\r\n<body>\r\n<?php echo "YOUR CURRENT WORKING DIRECTORY IS: ".substr(getcwd(),0); ?>\r\n<form action="<?php echo $_SERVER[''SCRIPT_NAME'']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">\r\nFind Files in Which Directory?<input type="text" name="target_path" value="<?php if (isset($_POST[''target_path''])){ echo $_POST[''target_path'']; } else echo substr(getcwd(),0); ?>" size="116" maxlength="200"><br/>\r\n<input type="Submit" name="find" value="Display Result" />\r\n\r\n</form>\r\n</body>\r\n</html>', 'FindFiles', 'php', ''),
(31, 'Find letter/word in a string', '<?php\r\n\r\n$myString = "Hello, world!";\r\n$pos = 0;\r\nwhile ( ( $pos = strpos( $myString, "l", $pos ) ) !== false ) {\r\n  echo "The letter ''l'' was found at position: $pos<br/>";\r\n  $pos++;\r\n}', 'FindLetterInString', 'php', ''),
(32, 'Php constants(APPLICATION_ROOT,line,file,dir,function.class,method,namespace)', '<?php\r\ndefine(''APPLICATION_ROOT'', dirname(__FILE__));\r\necho "APPLICATION_ROOT : ".APPLICATION_ROOT."<br/>";\r\necho "LINE : ".__LINE__."<br/>";\r\necho "FILE : ". __FILE__."<br/>";\r\necho "DIR : ". __DIR__."<br/>";\r\necho "FUNCTION : ". __FUNCTION__."<br/>";\r\necho "CLASS : ". __CLASS__."<br/>";\r\necho "METHOD : ". __METHOD__."<br/>";\r\necho "NAMESPACE : ". __NAMESPACE__."<br/>";\r\n// need to know the following\r\n//chdir($dir);\r\n//$dh = opendir($dir);\r\n//getdir($dir)\r\n?>', 'getCurrDir', 'php', ''),
(33, 'Get user''s IP address', '<?php\r\nfunction getIpAddr(){\r\n\r\n    // Check the IP from share internet.\r\n    if (!empty($_SERVER[''HTTP_CLIENT_IP''])){\r\n        $ip=$_SERVER[''HTTP_CLIENT_IP''];\r\n    }\r\n    // Check if the IP is passed from a proxy.\r\n    elseif (!empty($_SERVER[''HTTP_X_FORWARDED_FOR''])){\r\n        $ip=$_SERVER[''HTTP_X_FORWARDED_FOR''];\r\n    }\r\n    else{\r\n        $ip=$_SERVER[''REMOTE_ADDR''];\r\n    }\r\n    return $ip;\r\n}\r\n$ip = getIpAddr();\r\necho "YOUR IP ADDRESS IS: ".$ip;\r\n?>', 'GetIpAddr', 'php', '');
INSERT INTO `main` (`id`, `ShortDesc`, `Source`, `Name`, `Ext`, `SearchGroup`) VALUES
(34, 'login form', '<?php\r\nsession_start();\r\ndefine( "USERNAME", "john" );\r\ndefine( "PASSWORD", "secret" );\r\n\r\nif ( isset( $_POST["login"] ) ) {\r\n  login();\r\n} elseif ( isset( $_GET["action"] ) and $_GET["action"] == "logout" ) {\r\n  logout();\r\n} elseif ( isset( $_SESSION["username"] ) ) {\r\n  displayPage();\r\n} else {\r\n  displayLoginForm();\r\n}\r\n\r\nfunction login() {\r\n  if ( isset( $_POST["username"] ) and isset( $_POST["password"] ) ) {\r\n    if ( $_POST["username"] == USERNAME and $_POST["password"] == PASSWORD ) {\r\n      $_SESSION["username"] = USERNAME;\r\n      session_write_close();\r\n      header( "Location: login.php" );\r\n    } else {\r\n      displayLoginForm( "Sorry, that username/password could not be found. Please try again." );\r\n    }\r\n  }\r\n}\r\n\r\nfunction logout() {\r\n  unset( $_SESSION["username"] );\r\n  session_write_close();\r\n  header( "Location: login.php" );\r\n}\r\n\r\nfunction displayPage() {\r\n  displayPageHeader();\r\n?>\r\n    <p>Welcome, <strong><?php echo $_SESSION["username"] ?></strong>! You are currently logged in.</p>\r\n    <p><a href="login.php?action=logout">Logout</a></p>\r\n  </body>\r\n</html>\r\n<?php\r\n}\r\n\r\nfunction displayLoginForm( $message="" ) {\r\n  displayPageHeader();\r\n?>\r\n    <?php if ( $message ) echo ''<p class="error">'' . $message . ''</p>'' ?>\r\n\r\n    <form action="login.php" method="post">\r\n      <div style="width: 30em;">\r\n        <label for="username">Username</label>\r\n        <input type="text" name="username" id="username" value="" />\r\n        <label for="password">Password</label>\r\n        <input type="password" name="password" id="password" value="" />\r\n        <div style="clear: both;">\r\n          <input type="submit" name="login" value="Login" />\r\n        </div>\r\n      </div>\r\n    </form>\r\n  </body>\r\n</html>\r\n<?php\r\n}\r\n\r\nfunction displayPageHeader() {\r\n?>\r\n<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"\r\n  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">\r\n  <head>\r\n    <title>A login/logout system</title>\r\n    <link rel="stylesheet" type="text/css" href="common.css" />\r\n    <style type="text/css">\r\n      .error { background: #d33; color: white; padding: 0.2em; }\r\n    </style>\r\n  </head>\r\n  <body>\r\n    <h1>A login/logout system</h1>\r\n<?php\r\n}\r\n?>', 'login', 'php', ''),
(35, 'Other login form', '<?php // formtest2.php\r\n$username = ''admin'';\r\n$password = ''letmein'';\r\n\r\nif (isset($_SERVER[''PHP_AUTH_USER'']) &&\r\n	isset($_SERVER[''PHP_AUTH_PW'']))\r\n{\r\n	if ($_SERVER[''PHP_AUTH_USER''] == $username &&\r\n		$_SERVER[''PHP_AUTH_PW'']   == $password)\r\n		echo "You are now logged in";\r\n	else die("Invalid username / password combination");\r\n}\r\nelse\r\n{\r\n	header(''WWW-Authenticate: Basic realm="Restricted Section"'');\r\n	header(''HTTP/1.0 401 Unauthorized'');\r\n	die ("Please enter your username and password");\r\n}\r\n?>', 'login2', 'php', ''),
(45, 'Ways that declear XML inside php', '<?php\r\n$xml=rawurldecode(''%3C%3Fxml%20version%3D%221.0%22%3F%3E'');\r\necho($xml);\r\n?>\r\n\r\n<?php echo ''<?xml version="1.0" ?''.''>'' ?>\r\n\r\n<?php echo "<?xml version=\\"1.0\\"\\x3F>" ?>\r\n<?php \r\n  include("xmlheader.txt"); \r\n?>', 'XMLdeclaration', 'txt', ''),
(36, 'general SQL coding used in php', '<?php\r\n$db_hostname = ''localhost'';\r\n$db_database = ''publications'';\r\n$db_username = ''username'';\r\n$db_password = ''password'';\r\n$db_server = mysql_connect($db_hostname, $db_username, $db_password);\r\n\r\nif (!$db_server) die("Unable to connect to MySQL: " . mysql_error());\r\n/*********************************************/\r\nmysql_select_db($db_database) or die("Unable to select database: " . mysql_error());\r\n/*********************************************/\r\n$query = sprintf(''SELECT USERNAME, PASSWORD, EMAIL_ADDR, IS_ACTIVE '' . ''FROM %sUSER WHERE USER_ID = %d'', DB_TBL_PREFIX, $uid);\r\n$query = "SELECT * FROM classics";\r\n$result = mysql_query($query);\r\nif (!$result) die ("Database access failed: " . mysql_error());\r\n$rows = mysql_num_rows($result);\r\nif( mysql_num_rows( mysql_query("SHOW TABLES LIKE ''".$table."''")))\r\nfor ($j = 0 ; $j < $rows ; ++$j)\r\n{\r\n	echo ''Author: ''   . mysql_result($result,$j,''author'')   . ''<br />'';\r\n	echo ''Title: ''    . mysql_result($result,$j,''title'')    . ''<br />'';\r\n	echo ''Category: '' . mysql_result($result,$j,''category'') . ''<br />'';\r\n	echo ''Year: ''     . mysql_result($result,$j,''year'')     . ''<br />'';\r\n	echo ''ISBN: ''     . mysql_result($result,$j,''isbn'')     . ''<br /><br />'';\r\n}\r\n/*********************************************/\r\nfor ($j = 0 ; $j < $rows ; ++$j)\r\n{\r\n	$row = mysql_fetch_row($result);\r\n	echo ''Author: '' .	$row[0] . ''<br />'';\r\n	echo ''Title: '' .	$row[1] . ''<br />'';\r\n	echo ''Category: '' .	$row[2] . ''<br />'';\r\n	echo ''Year: '' .		$row[3] . ''<br />'';\r\n	echo ''ISBN: '' .		$row[4] . ''<br /><br />'';\r\n}\r\n/*********************************************/\r\nmysql_close($db_server);\r\n/*********************************************/\r\n$query = ''PREPARE statement FROM "INSERT INTO classics\r\n	VALUES(?,?,?,?,?)"'';\r\nmysql_query($query);\r\n\r\n$query = ''SET @author = "Emily Brontë",'' .\r\n		 ''@title = "Wuthering Heights",'' .\r\n		 ''@category = "Classic Fiction",'' .\r\n		 ''@year = "1847",'' .\r\n		 ''@isbn = "9780553212587"'';\r\nmysql_query($query);\r\n\r\n$query = ''EXECUTE statement USING @author,@title,@category,@year,@isbn'';\r\nmysql_query($query);\r\n\r\n$query = ''DEALLOCATE PREPARE statement'';\r\nmysql_query($query);\r\n/*********************************************/\r\n$result = mysql_query("SHOW TABLES LIKE ''$name''");', 'PHPSqlUse', 'txt', ''),
(37, 'Redirecting a site', '/* This must install into the server to have it works */\r\n<?php /* this programe is calling http://raymondlwhuang.host56.com/MyHelpFile.htm but display as ../redirect.php */\r\n$sub_req_url = "http://raymondlwhuang.host56.com/MyHelpFile.php";\r\n$ch = curl_init($sub_req_url);\r\n$encoded = '''';\r\n// include GET as well as POST variables; your needs may vary.\r\nforeach($_GET as $name => $value) {\r\n  $encoded .= urlencode($name).''=''.urlencode($value).''&'';\r\n}\r\nforeach($_POST as $name => $value) {\r\n  $encoded .= urlencode($name).''=''.urlencode($value).''&'';\r\n}\r\n// chop off last ampersand\r\n$encoded = substr($encoded, 0, strlen($encoded)-1);\r\ncurl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);\r\ncurl_setopt($ch, CURLOPT_HEADER, 0);\r\ncurl_setopt($ch, CURLOPT_POST, 1);\r\ncurl_exec($ch);\r\ncurl_close($ch);\r\n?>', 'redirect', 'php', ''),
(38, 'Sending e-mail', '/* This must install into the server to have it works */\r\n<html>\r\n <body>\r\n \r\n<?php\r\n if (isset($_REQUEST[''email'']))\r\n //if "email" is filled out, send email\r\n   {\r\n   //send email\r\n   $email = $_REQUEST[''email''] ;\r\n   $subject = $_REQUEST[''subject''] ;\r\n   $message = $_REQUEST[''message''] ;\r\n   mail("someone@example.com", "$subject",\r\n   $message, "From:" . $email);\r\n   echo "Thank you for using our mail form";\r\n   }\r\n else\r\n //if "email" is not filled out, display the form\r\n   {\r\n   echo "<form method=''post'' action=''SendMail.php''>\r\n   Email: <input name=''email'' type=''text'' /><br />\r\n   Subject: <input name=''subject'' type=''text'' /><br />\r\n   Message:<br />\r\n   <textarea name=''message'' rows=''15'' cols=''40''>\r\n   </textarea><br />\r\n   <input type=''submit'' value=''Send'' />\r\n   </form>";\r\n   }\r\n ?>\r\n \r\n</body>\r\n </html>', 'SendMail', 'php', ''),
(39, 'Sending e-mail', '/* install to server to make it works */\r\n<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">\r\n  <head>\r\n    <title>Sending an HTML email message</title>\r\n    <link rel="stylesheet" type="text/css" href="common.css" />\r\n  </head>\r\n  <body>\r\n    <h1>Sending an HTML email message</h1>\r\n<?php\r\n\r\n$message = <<<END_HTML\r\n<html>\r\n  <body>\r\n    <h1 style="color: #AA3333;">Thank You</h1>\r\n    <p>Thank you for contacting <a href="http://www.example.com/">The Widget Company</a>. We''ll be in touch shortly.</p>\r\n  </body>\r\n</html>\r\nEND_HTML;\r\n\r\n  $headers = "From: The Widget Company <raymondlwhuang@yahoo.com>\\r\\n";\r\n  $headers .= "MIME-Version: 1.0\\r\\n";\r\n  $headers .= "Content-type: text/html; charset=utf-8\\r\\n";\r\n  $recipient = "raymond <raymondlwhuang@yahoo.com>";\r\n  $subject = "Thank you for contacting us";\r\n  mail( $recipient, $subject, $message, $headers );\r\n\r\n?>\r\n  </body>\r\n</html>', 'SendMail2', 'php', ''),
(40, 'Sending e-mail with protection injection checked', '/* install into the server to have it work example link http://dev.mundomediainc.com/www.mundomedia.com/publisher-signup.php */\r\n<?php\r\n$referrer = $_SERVER[''HTTP_REFERER''];\r\n\r\n// Sanity check to make sure we got the data from mundomedia.com website and from the contact-us page\r\nif ((strpos($referrer, "mundomedia.com") !== FALSE || strpos($referrer, "dev.mundomediainc.com") !== FALSE) && (strpos($referrer, "contact-us") !== FALSE || strpos($referrer, "advertiser-signup") !== FALSE || strpos($referrer, "check-status") !== FALSE)) {\r\n\r\n    // Record the ip and date of the submission\r\n    $sender_ip = $_SERVER[''REMOTE_ADDR''];\r\n    $todaydate = date("l, F j, Y, g:i a");\r\n\r\n    if(isset($_REQUEST[''checkApplication'']) && $_REQUEST[''checkApplication''] != "") {\r\n        // Change this email to whomever it should go to\r\n        // Separate addresses by comma (eg: email1@domain.com, email2@domain.com)\r\n		$to = ''raymondlwhuang@yahoo.com'';\r\n		$cc = "raymondlwhuang@gmail.com";\r\n        //$cc = "";\r\n\r\n        $email = $_REQUEST[''email''];\r\n        $subject = "Publisher Application Status Request";\r\n\r\n        $message = "Publisher Application Status Request\\n===================================\\n\\n" .\r\n            "Email: $email\\n" .\r\n            "\\n\\n===================================\\nSent from: $sender_ip ($todaydate)\\n";\r\n\r\n        $headers = "CC: $cc\\nX-Sender-IP: $sender_ip\\nFrom: $email\\nReply-To: $email";\r\n\r\n        $sent = mail($to, $subject, $message, $headers) ;\r\n        if($sent) {\r\n            echo ''<script type="text/javascript">alert("Your mail was sent successfully")</script>'';\r\n            echo ''<script type="text/javascript">window.location="index.html"</script>'';\r\n        } else {\r\n            echo ''<script type="text/javascript">alert("We encountered an error sending your mail")</script>'';\r\n            echo ''<script type="text/javascript">window.location="status-check.html"</script>'';\r\n        }\r\n    } elseif(isset($_REQUEST[''name'']) && $_REQUEST[''name''] != "") {\r\n        // Change this email to whomever it should go to\r\n        // Separate addresses by comma (eg: email1@domain.com, email2@domain.com)\r\n		$to = ''raymondlwhuang@yahoo.com'';\r\n		$cc = "raymondlwhuang@gmail.com";\r\n        //$cc = "";\r\n\r\n        $subject = "Advertiser Signup";\r\n        $name = $_REQUEST[''name''] ;\r\n        $link_creatives = $_REQUEST[''creatives''];\r\n\r\n        $__tmp = $subject . " " . $name . " " . $link_creatives;\r\n\r\n        // This check is done to ensure no spam injected message gets sent with the email form\r\n        if (preg_match("/bcc:/i", $__tmp) == 0 &&          /* check for injected ''bcc'' field */\r\n            preg_match("/Content-Type:/i", $__tmp) == 0 && /* check for injected ''content-type'' field */\r\n            preg_match("/cc:/i", $__tmp) == 0 &&           /* check for injected ''cc'' field */\r\n            preg_match("/to:/i", $__tmp) == 0) {           /* check for injected ''to'' field */\r\n\r\n            // Format the body of the email\r\n            $message = "Advertiser Signup Sheet\\n=========================\\n\\nFirst/Last Name: $name\\n" .\r\n                ((isset($aim) && $aim != "") ? "HTTP Link Creatives: $link_creatives\\n" : "") .\r\n                "\\n\\n=========================\\nSent from: $sender_ip ($todaydate)\\n";\r\n\r\n            // Set the header, include the ip and set the reply-to field for convenience when replying to the email\r\n            $headers = "CC: $cc\\nX-Sender-IP: $sender_ip\\nFrom: $email\\nReply-To: $email";\r\n\r\n            // Send the email and check the result whether the function call was successful or not\r\n            $sent = mail($to, $subject, $message, $headers) ;\r\n            if($sent) {\r\n                echo ''<script type="text/javascript">alert("Your mail was sent successfully")</script>'';\r\n                echo ''<script type="text/javascript">window.location="index.php"</script>'';\r\n            } else {\r\n                echo ''<script type="text/javascript">alert("We encountered an error sending your mail")</script>'';\r\n                echo ''<script type="text/javascript">window.location="index.php"</script>'';\r\n            }\r\n        } else  {\r\n            echo ''<script type="text/javascript">alert("We encountered an error sending your mail")</script>'';\r\n            echo ''<script type="text/javascript">window.location="index.php"</script>'';\r\n        }\r\n    } else {\r\n        // Change this email to whomever it should go to\r\n        // Separate addresses by comma (eg: email1@domain.com, email2@domain.com)\r\n        //$to = "jason@mundomedia.com";\r\n        \r\n		$to = ''raymondlwhuang@yahoo.com'';\r\n		$cc = "raymondlwhuang@gmail.com";\r\n        $subject = $_REQUEST[''subject''];\r\n        $recipient = $_REQUEST[''recipient''];\r\n        $firstname = $_REQUEST[''sender_fname''] ;\r\n        $lastname = $_REQUEST[''sender_lname''] ;\r\n        $email = $_REQUEST[''sender_email''] ;\r\n        $phone = $_REQUEST[''sender_phone''];\r\n        $message = $_REQUEST[''message''];\r\n\r\n        // This check is done to ensure no spam injected message gets sent with the email form\r\n        if (preg_match("/bcc:/i", $email . " " . $firstname . " " . $lastname . " " . $message) == 0 &&          /* check for injected ''bcc'' field */\r\n            preg_match("/Content-Type:/i", $email . " " . $firstname . " " . $lastname . " " . $message) == 0 && /* check for injected ''content-type'' field */\r\n            preg_match("/cc:/i", $email . " " . $firstname . " " . $lastname . " " . $message) == 0 &&           /* check for injected ''cc'' field */\r\n            preg_match("/to:/i", $email . " " . $firstname . " " . $lastname . " " . $message) == 0) {           /* check for injected ''to'' field */\r\n\r\n            // Format the body of the email\r\n            $message = "Contact Name: $lastname, $firstname\\nEmail: $email\\nPhone: $phone\\n\\nAddressed to: $recipient\\n\\n" . $message . "\\n\\nSent from: $sender_ip ($todaydate)\\n";\r\n\r\n            // Set the header, include the ip and set the reply-to field for convenience when replying to the email\r\n            $headers = "CC: $cc\\nX-Sender-IP: $sender_ip\\nFrom: $email\\nReply-To: $email";\r\n\r\n            // Send the email and check the result whether the function call was successful or not\r\n            $sent = mail($to, $subject, $message, $headers) ;\r\n            if($sent) {\r\n                echo ''<script type="text/javascript">alert("Your mail was sent successfully")</script>'';\r\n                echo ''<script type="text/javascript">window.location="index.html"</script>'';\r\n            } else {\r\n                echo ''<script type="text/javascript">alert("We encountered an error sending your mail")</script>'';\r\n                echo ''<script type="text/javascript">window.location="contact-us.html"</script>'';\r\n            }\r\n        } else  {\r\n            echo ''<script type="text/javascript">alert("We encountered an error sending your mail")</script>'';\r\n            echo ''<script type="text/javascript">window.location="contact-us.html"</script>'';\r\n        }\r\n    }\r\n} else {\r\n    echo ''<script type="text/javascript">alert("We encountered an error sending your mail")</script>'';\r\n    echo ''<script type="text/javascript">window.location="contact-us.html"</script>'';\r\n}\r\n\r\n?>', 'SendMail1', 'php', ''),
(41, 'Server Information', '<?php\r\necho "<table border=\\"1\\">";\r\necho "<tr><td>" .$_SERVER[''argv''] ."</td><td>argv</td></tr>";\r\necho "<tr><td>" .$_SERVER[''argc''] ."</td><td>argc</td></tr>";\r\necho "<tr><td>" .$_SERVER[''GATEWAY_INTERFACE''] ."</td><td>GATEWAY_INTERFACE</td></tr>";\r\necho "<tr><td>" .$_SERVER[''SERVER_ADDR''] ."</td><td>SERVER_ADDR</td></tr>";\r\necho "<tr><td>" .$_SERVER[''SERVER_NAME''] ."</td><td>SERVER_NAME</td></tr>";\r\necho "<tr><td>" .$_SERVER[''SERVER_SOFTWARE''] ."</td><td>SERVER_SOFTWARE</td></tr>";\r\necho "<tr><td>" .$_SERVER[''SERVER_PROTOCOL''] ."</td><td>SERVER_PROTOCOL</td></tr>";\r\necho "<tr><td>" .$_SERVER[''REQUEST_METHOD''] ."</td><td>REQUEST_METHOD</td></tr>";\r\necho "<tr><td>" .$_SERVER[''REQUEST_TIME''] ."</td><td>REQUEST_TIME</td></tr>";\r\necho "<tr><td>" .$_SERVER[''QUERY_STRING''] ."</td><td>QUERY_STRING</td></tr>";\r\necho "<tr><td>" .$_SERVER[''DOCUMENT_ROOT''] ."</td><td>DOCUMENT_ROOT</td></tr>";\r\necho "<tr><td>" .$_SERVER[''HTTP_ACCEPT''] ."</td><td>HTTP_ACCEPT</td></tr>";\r\necho "<tr><td>" .$_SERVER[''HTTP_ACCEPT_CHARSET''] ."</td><td>HTTP_ACCEPT_CHARSET</td></tr>";\r\necho "<tr><td>" .$_SERVER[''HTTP_ACCEPT_ENCODING''] ."</td><td>HTTP_ACCEPT_ENCODING</td></tr>";\r\necho "<tr><td>" .$_SERVER[''HTTP_ACCEPT_LANGUAGE''] ."</td><td>HTTP_ACCEPT_LANGUAGE</td></tr>";\r\necho "<tr><td>" .$_SERVER[''HTTP_CONNECTION''] ."</td><td>HTTP_CONNECTION</td></tr>";\r\necho "<tr><td>" .$_SERVER[''HTTP_HOST''] ."</td><td>HTTP_HOST</td></tr>";\r\necho "<tr><td>" .$_SERVER[''HTTP_REFERER''] ."</td><td>HTTP_REFERER</td></tr>";\r\necho "<tr><td>" .$_SERVER[''HTTP_USER_AGENT''] ."</td><td>HTTP_USER_AGENT</td></tr>";\r\necho "<tr><td>" .$_SERVER[''HTTPS''] ."</td><td>HTTPS</td></tr>";\r\necho "<tr><td>" .$_SERVER[''REMOTE_ADDR''] ."</td><td>REMOTE_ADDR</td></tr>";\r\necho "<tr><td>" .$_SERVER[''REMOTE_HOST''] ."</td><td>REMOTE_HOST</td></tr>";\r\necho "<tr><td>" .$_SERVER[''REMOTE_PORT''] ."</td><td>REMOTE_PORT</td></tr>";\r\necho "<tr><td>" .$_SERVER[''SCRIPT_FILENAME''] ."</td><td>SCRIPT_FILENAME</td></tr>";\r\necho "<tr><td>" .$_SERVER[''SERVER_ADMIN''] ."</td><td>SERVER_ADMIN</td></tr>";\r\necho "<tr><td>" .$_SERVER[''SERVER_PORT''] ."</td><td>SERVER_PORT</td></tr>";\r\necho "<tr><td>" .$_SERVER[''SERVER_SIGNATURE''] ."</td><td>SERVER_SIGNATURE</td></tr>";\r\necho "<tr><td>" .$_SERVER[''PATH_TRANSLATED''] ."</td><td>PATH_TRANSLATED</td></tr>";\r\necho "<tr><td>" .$_SERVER[''SCRIPT_NAME''] ."</td><td>SCRIPT_NAME</td></tr>";\r\necho "<tr><td>" .$_SERVER[''REQUEST_URI''] ."</td><td>REQUEST_URI</td></tr>";\r\necho "<tr><td>" .$_SERVER[''PHP_AUTH_DIGEST''] ."</td><td>PHP_AUTH_DIGEST</td></tr>";\r\necho "<tr><td>" .$_SERVER[''PHP_AUTH_USER''] ."</td><td>PHP_AUTH_USER</td></tr>";\r\necho "<tr><td>" .$_SERVER[''PHP_AUTH_PW''] ."</td><td>PHP_AUTH_PW</td></tr>";\r\necho "<tr><td>" .$_SERVER[''AUTH_TYPE''] ."</td><td>AUTH_TYPE</td></tr>";\r\necho "</table>"\r\n?>', 'ServerInfo', 'php', ''),
(42, 'Redirecting a site', '/* Save this file into php file and it is used by the CountryProvince.php */\r\n<?php\r\n//$sub_req_url = "http://www.raymondlwhuang.com/signup.php"; //http://www.pixeltrack66.com/affiliate/signup.php\r\n$ch = curl_init($sub_req_url);\r\n$encoded = '''';\r\n// include GET as well as POST variables; your needs may vary.\r\nforeach($_GET as $name => $value) {\r\n  $encoded .= urlencode($name).''=''.urlencode($value).''&'';\r\n}\r\nforeach($_POST as $name => $value) {\r\n  $encoded .= urlencode($name).''=''.urlencode($value).''&'';\r\n}\r\n// chop off last ampersand\r\n$encoded = substr($encoded, 0, strlen($encoded)-1);\r\ncurl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);\r\ncurl_setopt($ch, CURLOPT_HEADER, 0);\r\ncurl_setopt($ch, CURLOPT_POST, 1);\r\ncurl_exec($ch);\r\ncurl_close($ch);\r\n?>', 'signup', 'txt', ''),
(43, 'String Clean Up', '<?php\r\nfunction clean_text ( $strVar )\r\n{\r\n	$strVar = strip_tags ( $strVar );\r\n	$strVar = htmlentities ( $strVar, ENT_QUOTES );\r\n	$strVar = stripslashes ( $strVar );\r\n\r\n	return $strVar;\r\n}\r\n\r\n$text = ''<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>'';\r\necho strip_tags($text);\r\necho "\\n";\r\n\r\n// Allow <p> and <a>\r\necho strip_tags($text, ''<p><a>'');\r\n$str = "A ''quote'' is <b>bold</b>";\r\n\r\n// Outputs: A ''quote'' is &lt;b&gt;bold&lt;/b&gt;\r\necho htmlentities($str);\r\n\r\n// Outputs: A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt;\r\necho htmlentities($str, ENT_QUOTES);\r\n$str = "Is your name O\\''reilly?";\r\n\r\n// Outputs: Is your name O''reilly?\r\necho stripslashes($str);\r\n?>', 'stringCleanUp', 'php', ''),
(44, 'Excute/Use of Dos Command', '<?php // exec.php\r\n$cmd = "dir";   // Windows\r\n// $cmd = "ls"; // Linux, Unix & Mac\r\n\r\nexec(escapeshellcmd($cmd), $output, $status);\r\n\r\nif ($status) echo "Exec command failed";\r\nelse\r\n{\r\n	echo "<pre>";\r\n	foreach($output as $line) echo "$line\\n";\r\n}\r\n?>', 'UseDosCommand', 'php', ''),
(46, 'xml header', '/* used by XMLdeclaration.php */\r\n<?xml version="1.0"?>		', 'xmlheader', 'txt', ''),
(47, 'Text editor in php', '<?php\r\n\r\ndefine( "PATH_TO_FILES", "." );\r\n\r\nif ( isset( $_POST["saveFile"] ) ) {\r\n  saveFile();\r\n} elseif ( isset( $_GET["filename"] ) ) {\r\n  displayEditForm();\r\n} elseif ( isset( $_POST["createFile"] ) ) {\r\n  createFile();\r\n} else {\r\n  displayFileList();\r\n}\r\n\r\nfunction displayFileList( $message="" ) {\r\n  displayPageHeader();\r\n  if ( !file_exists( PATH_TO_FILES ) ) die( "Directory not found" );\r\n  if ( !( $dir = dir( PATH_TO_FILES ) ) ) die( "Can''t open directory" );\r\n\r\n?>\r\n    <?php if ( $message ) echo ''<p class="error">'' . $message . ''</p>'' ?>\r\n    <h2>Choose a file to edit:</h2>\r\n    <table cellspacing="0" border="0" style="width: 40em; border: 1px solid #666;">\r\n      <tr>\r\n        <th>Filename</th>\r\n        <th>Size (bytes)</th>\r\n        <th>Last Modified</th>\r\n      </tr>\r\n<?php\r\n\r\n  while ( $filename = $dir->read() ) {\r\n    $filepath = PATH_TO_FILES . "/$filename";\r\n    if ( $filename != "." && $filename != ".." && !is_dir( $filepath ) && strrchr( $filename, "." ) == ".txt" ) {\r\n       echo ''<tr><td><a href="text_editor.php?filename='' . urlencode( $filename ) . ''">'' . $filename . ''</a></td>'';\r\n       echo ''<td>'' . filesize( $filepath ) . ''</td>'';\r\n       echo ''<td>'' . date( "M j, Y H:i:s", filemtime( $filepath ) ) . ''</td></tr>'';\r\n    }\r\n  }\r\n\r\n  $dir->close();\r\n?>\r\n    </table>\r\n    <h2>...or create a new file:</h2>\r\n    <form action="text_editor.php" method="post">\r\n      <div style="width: 20em;">\r\n        <label for="filename">Filename</label>\r\n        <div style="float: right; width: 7%; margin-top: 0.7em;"> .txt</div>\r\n        <input type="text" name="filename" id="filename" style="width: 50%;" value="" />\r\n        <div style="clear: both;">\r\n          <input type="submit" name="createFile" value="Create File" />\r\n        </div>\r\n      </div>\r\n    </form>\r\n  </body>\r\n</html>\r\n<?php\r\n}\r\n\r\nfunction displayEditForm( $filename="" ) {\r\n  if ( !$filename ) $filename = basename( $_GET["filename"] );\r\n  if ( !$filename ) die( "Invalid filename" );\r\n  $filepath = PATH_TO_FILES . "/$filename";\r\n  if ( !file_exists( $filepath ) ) die( "File not found" );\r\n  displayPageHeader();\r\n?>\r\n    <h2>Editing <?php echo $filename ?></h2>\r\n    <form action="text_editor.php" method="post">\r\n      <div style="width: 40em;">\r\n        <input type="hidden" name="filename" value="<?php echo htmlspecialchars( $filename ) ?>" />\r\n        <textarea name="fileContents" id="fileContents" rows="20" cols="80" style="width: 100%;"><?php\r\n           echo clean_text (  file_get_contents( $filepath ) );\r\n        ?></textarea>\r\n        <div style="clear: both;">\r\n          <input type="submit" name="saveFile" value="Save File" />\r\n          <input type="submit" name="cancel" value="Cancel" style="margin-right: 20px;" />\r\n        </div>\r\n      </div>\r\n    </form>\r\n  </body>\r\n</html>\r\n<?php\r\n}\r\n\r\nfunction saveFile() {\r\n  $filename = basename( $_POST["filename"] );\r\n  $filepath = PATH_TO_FILES . "/$filename";\r\n  if ( file_exists( $filepath ) ) {\r\n    if ( file_put_contents( $filepath, clean_text ( $_POST["fileContents"] )) === false ) die( "Couldn''t save file" );\r\n    displayFileList();\r\n  } else {\r\n    die( "File not found" );\r\n  }\r\n}\r\n    \r\nfunction createFile() {\r\n  $filename = basename( $_POST["filename"] );\r\n  $filename = preg_replace( "/[^A-Za-z0-9_\\- ]/", "", $filename );\r\n\r\n  if ( !$filename ) {\r\n    displayFileList( "Invalid filename - please try again" );\r\n    return;\r\n  }\r\n\r\n  $filename .= ".txt";\r\n  $filepath = PATH_TO_FILES . "/$filename";\r\n  if ( file_exists( $filepath ) ) {\r\n    displayFileList( "The file $filename already exists!" );\r\n  } else {\r\n    if ( file_put_contents( $filepath, "" ) === false ) die( "Couldn''t create file" );\r\n    chmod( $filepath, 0666 );\r\n    displayEditForm( "$filename" );\r\n  }\r\n}\r\nfunction clean_text ( $strVar )\r\n{\r\n	$strVar = strip_tags ( $strVar );\r\n	$strVar = htmlentities ( $strVar, ENT_QUOTES );\r\n	$strVar = stripslashes ( $strVar );\r\n\r\n	return $strVar;\r\n} \r\nfunction displayPageHeader() {\r\n?>\r\n<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"\r\n  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">\r\n  <head>\r\n    <title>A simple text editor</title>\r\n    <link rel="stylesheet" type="text/css" href="common.css" />\r\n    <style type="text/css">\r\n      .error { background: #d33; color: white; padding: 0.2em; }\r\n      th { text-align: left; background-color: #999; }\r\n      th, td { padding: 0.4em; }\r\n    </style>\r\n  </head>\r\n  <body>\r\n    <h1>A simple text editor</h1>\r\n<?php\r\n}\r\n?>', 'text_editor', 'php', ''),
(48, 'Cripting text', '<?php  /* seems not working */\r\n$text = "boggles the inivisble monkey will rule the world";\r\n$key = "This is a very secret key";\r\n\r\n$iv_size = mcrypt_get_iv_size(MCRYPT_XTEA, MCRYPT_MODE_ECB);\r\n$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);\r\necho strlen($text) . "<br>";\r\n\r\n$enc = mcrypt_encrypt(MCRYPT_XTEA, $key, $text, MCRYPT_MODE_ECB, $iv);\r\necho strlen($enc) . "<br>";\r\n   \r\n$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);\r\n$key = "This is a very secret key";\r\n$text = "Meet me at 11 o''clock behind the monument.";\r\necho strlen($text) . "<br>";\r\n\r\n$crypttext = mcrypt_decrypt(MCRYPT_XTEA, $key, $enc, MCRYPT_MODE_ECB, $iv);\r\necho "$crypttext<br>";\r\n?>', 'cript', 'php', ''),
(49, 'Blender Redirect, getting phone number', 'http://dev.mundomediainc.com/www.mymindquiz.com/hv1chk/blender_redirect.php', 'blenderRedirect', 'link', ''),
(50, 'Special character converting with microsoftword', 'Open the file you want to convert in Microsoft Word document\r\nsave it to plain text file\r\nchoose other encoding in the dialog box that is displayed\r\nchoose view in the menu of the word document\r\nclick on Macros and select ''view Macros''\r\nselect a Macros and click run\r\nsave the converted document to a html file\r\nclose the document\r\nopen it with notepad++\r\nreplace ''&amp;'' with ''&''\r\nDone', 'conver', 'txt', ''),
(51, 'My notes enabled the rewrite_module on Apache server ', 'Tool we needed: WinMerge,FileZilla,NotePad++,IETester,Web Developer Toolbar,7-zip,httpd.conf\r\n\r\nRequired resolution: 1024x768\r\npin.php?resendpin=true&e=1&f=1\r\nhttp://dev.mundomediainc.com/popularproducts/frontend_dev.php/reserveDev/t8563/09401\r\n/var/www/html/dev.mundomediainc.com/opularproducts_core/apps/frontend/modules/users/templates/reserveDevSuccess.php\r\nhttp://dev.mundomediainc.com/popularproducts/frontend_dev.php/gift\r\nThe scripts will need this added to the top of them to get them to work on our dev version:\r\n<?php\r\n                if (stripos($_SERVER[''HTTP_HOST''],''dev.mundomediainc.com'') !== FALSE){\r\n                                require ''/var/www/html/dev.mundomediainc.com/popularproductsonline_production/ppo_vars.php'';\r\n                }              \r\n?>\r\n\r\n.htaccess\r\nblender_redirect.php\r\necho <<<_END\r\n_END;\r\n\r\nconf.php,cellpage.php after pin.php (disable helloAds_control.php for testing)\r\n\r\n<!--[if IE]>\r\n<![endif]-->\r\n\r\nsubscribe_hello();\r\n\r\nhttps://addresscheck.melissadata.net/v2/REST/Service.svc/doAddressCheck?$get_params\r\n\r\n<script language="javascript">var emailfield = "emailfield", reqdfield = "namefield", invalid = "invalid",MessageTag = "";</script>\r\n<script language="javascript" src="/popularproducts/js/ValidateInfo.js"></script>\r\n\r\nLoadModule rewrite_module modules/mod_rewrite.so	', 'note', 'txt', ''),
(56, 'Web site relationship', 'This is a relationship I get from browsing the files', 'Website Relation', 'pdf', ''),
(57, 'verify phone cell network with hello id', '$api_call = "http://www.helloadz.com/super/api/prelookup.php?format=JSON&hello_id={$_SESSION[''hello_id'']}&network={$_REQUEST[''network'']}";\r\n$api_call = "http://www.helloadz.com/super/api/send_pin.php?format=JSON&hello_id={$_SESSION[''hello_id'']}&mobile={$mobile}&sign={$sign}&gender={$gender}&ip={$ip}{$sc_param}";\r\n		', 'helloidValify', 'txt', ''),
(58, 'The basic step to creat a symfony project', 'The basic step to creat a symfony project\r\nexample site:http://www.popularproductsonline.com/', 'SimpleCreationStepSymfony', 'pdf', ''),
(55, 'Setting up the hello id', 'USE helloadz_params.php to setting up the hello id		', 'helloid', 'txt', ''),
(52, 'Insert/use Javascript', '<script type="text/javascript" src="Welcome.js"></script>\r\n<script type="text/javascript">                 </script>\r\n<?php use_javascript(''jquery-1.4.2.min.js'') ?>\r\n<?php include_javascripts() ?>\r\n', 'useJavascript', 'txt', ''),
(53, 'Insert/use Style sheet css', '<link rel="stylesheet" type="text/css" href="external.css" >\r\n<style type="text/css" media="screen">\r\n<?php use_stylesheet(''admin.css'') ?>\r\n<?php include_stylesheets() ?>', 'useStyleSheet', 'txt', ''),
(54, 'USE DOCTYPE ', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"	"http://www.w3.org/TR/html4/loose.dtd">\r\n<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">		', 'DOCTYPE', 'txt', ''),
(59, 'Basic SQL Example', '/* Code here is not tested and is my own idea of it could has bud in it */\r\n\r\nUSE publications;\r\nCREATE TABLE classics (\r\n author VARCHAR(128),\r\n title VARCHAR(128),\r\n category VARCHAR(16),\r\n year SMALLINT,\r\n INDEX(author(20)),\r\n INDEX(title(20)),\r\n INDEX(category(4)),\r\n INDEX(year),\r\n id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,\r\n PRIMARY KEY (isbn)) ENGINE MyISAM;\r\n\r\nDESCRIBE classics;\r\nALTER TABLE classics ADD FULLTEXT(author,title);\r\nALTER TABLE classics ADD id INT UNSIGNED\r\n  NOT NULL AUTO_INCREMENT KEY;\r\nALTER TABLE classics DROP id;\r\nALTER TABLE classics ADD isbn CHAR(13);\r\nUPDATE classics SET isbn=''9781598184891'' WHERE year=''1876'';\r\nALTER TABLE classics ADD PRIMARY KEY(isbn);\r\n\r\nINSERT INTO classics(author, title, type, year)\r\n VALUES(''Mark Twain'',''The Adventures of Tom Sawyer'',''Fiction'',''1876'');\r\n \r\nALTER TABLE classics ADD INDEX(category(4));\r\nALTER TABLE classics ADD INDEX(year);\r\nCREATE INDEX category ON classics (category(4)); \r\n\r\nSELECT COUNT(*) FROM classics;\r\nSELECT author FROM classics;\r\nSELECT DISTINCT author FROM classics;\r\nSELECT author,title FROM classics WHERE title NOT LIKE "%and%";\r\nSELECT author,title FROM classics LIMIT 3,1;\r\nSELECT author,title FROM classics\r\n WHERE MATCH(author,title) AGAINST(''and'');\r\nSELECT author,title FROM classics\r\n WHERE MATCH(author,title)\r\n AGAINST(''+charles -species'' IN BOOLEAN MODE);\r\nSELECT author,title FROM classics\r\n WHERE MATCH(author,title)\r\n AGAINST(''"origin of"'' IN BOOLEAN MODE);\r\nSELECT author,title FROM classics ORDER BY title DESC;\r\nSELECT name,author,title from customers,classics\r\n WHERE customers.isbn=classics.isbn;\r\nSELECT m.gender, sum( al.numVisits ) FROM members m, accessLog al WHERE m.id = al.memberId GROUP BY m.gender;\r\n\r\nEXPLAIN SELECT * FROM accounts WHERE number=''12345'';\r\n \r\nDELETE FROM classics WHERE title=''Little Dorrit'';\r\n\r\nBEGIN;\r\nUPDATE accounts SET balance=balance+25.11 WHERE number=12345;\r\nROLLBACK;\r\nCOMMIT;\r\nSELECT * FROM accounts;\r\n\r\nmysqldump -u user -ppassword publications\r\nmysqldump -u user -ppassword publications > publications.sql\r\nmysqldump -u user -ppassword --all-databases > all_databases.sql\r\nmysql -u user -ppassword < all_databases.sql\r\nmysql -u user -ppassword -D publications < publications.sql\r\nmysqldump -u user -ppassword --no-create-info --tab=c:/web  --fields-terminated-by='','' publications\r\n\r\n/*******************************************/\r\nPREPARE statement FROM "INSERT INTO classics VALUES(?,?,?,?,?)";\r\n\r\nSET @author   = "Emily Brontë",\r\n	@title    = "Wuthering Heights",\r\n	@category = "Classic Fiction",\r\n	@year     = "1847",\r\n	@isbn     = "9780553212587";\r\n\r\nEXECUTE statement USING @author,@title,@category,@year,@isbn;\r\n\r\nDEALLOCATE PREPARE statement;\r\n/*******************************************/		', 'SqlSample', 'txt', ''),
(60, 'Basic Doctrine database control', 'Doctrine_Core::getTable(''JobeetJob'')->createQuery(''a'')->execute();		\r\nDoctrine_Core::getTable(''JobeetJob'')->find(array($request->getParameter(''id'')));', 'doctrine', 'txt', ''),
(61, 'YAML', '1.Applicable YAML files: all files with a .yml extension. \r\n2.Tabs are NOT allowed, use spaces ONLY. \r\n3.You MUST indent your properties and lists with 1 or more spaces. \r\n4.All keys/properties are Case-Sensitive. ("ThIs", is not the same as "thiS") \r\n5.Boolean and integer values don''t need quotes any other value must be inside single quotes\r\n6. List marker "-" must be indented at least 1 or more spaces and the items must be indented by 1 space after the "-"', 'yaml', 'txt', ''),
(64, 'Convert binary data into hexadecimal representation', '<?php \r\nfunction hex4email ($string,$charset) \r\n{ \r\n    $string=bin2hex ($string); \r\n    $encoded = chunk_split($string, 2, ''=''); \r\n    $encoded=preg_replace ("/=$/","",$encoded); \r\n    $string="=?$charset?Q?".$encoded."?="; \r\n    \r\nreturn $string; \r\n} \r\necho hex4email(''raymondlwhuang@yahoo.com'',''='');\r\n?>', 'M_bin2hex', 'php', 'phpmenu'),
(62, 'Quote string with slashes in a C style', '<?php\r\necho addcslashes(''foo[ ]'', ''A..z'');\r\n// output:  \\f\\o\\o\\[ \\]\r\n// All upper and lower-case letters will be escaped\r\n// ... but so will the [\\]^_`', 'M_addcslashes', 'php', 'phpmenu'),
(63, 'Quote string with slashes', '<?php\r\n$str = "Is your name O''reilly?";\r\n\r\n// Outputs: Is your name O\\''reilly?\r\necho addslashes($str);', 'M_addslashes', 'php', 'phpmenu'),
(65, 'Returns a one-character string containing the character specified by ascii, complements ord(), convert ascii key to character', '<?php\r\necho ord(''A'');\r\necho "</br>";\r\n$str = "The string ends in a letter ''A'': ";\r\n$str .= chr(65); \r\necho $str;\r\necho "</br>";\r\n$str = sprintf("The string ends in a letter ''A'': %c", 65);\r\necho $str;\r\n\r\n?>', 'M_chr', 'php', 'phpmenu'),
(66, 'Verify e-mail, website', '<html>\r\n\r\n<head>\r\n\r\n<title>Input handling</title>\r\n<script type="text/javascript">\r\n	function validWebsite(website) {\r\n		var re = /^(http:\\/\\/([\\-\\w]+\\.)+\\w{2,3}(\\/[%\\-\\w]+(\\.\\w{2,})?)*(([\\w\\-\\.\\?\\\\/+@&#;`~=%!]*)(\\.\\w{2,})?)*\\/?)/i;\r\n\r\n		if (!re.test(website)){\r\n			alert("Invalid website");\r\n		}\r\n		else\r\n		alert("website is valid!");\r\n		return re.test(website);			\r\n	}\r\n	function validEMail(email) {\r\n		var re = /^\\w+([\\.-]?\\w+)*@\\w+([\\.-]?\\w+)*(\\.\\w{2,3})+$/;\r\n\r\n		if (!re.test(email)){\r\n			alert("Invalid e-mail address!");\r\n		}\r\n		else\r\n		alert("e-mail address is valid!");\r\n		return re.test(email);			\r\n	}	\r\n</script>\r\n</head>\r\n\r\n<body>\r\n<form>\r\nWebsite:<input type="text" name="website" id=''website''>\r\n<input type="submit" name="Verify" value="Verify"  onClick="validWebsite(document.getElementById(''website'').value);return false;">\r\ne-mail <input type="text" name="email" id=''email''>\r\n<input type="submit" name="Verify" value="Verify"  onClick="validEMail(document.getElementById(''email'').value);return false;">\r\n</form>\r\n</body>\r\n\r\n</html>', 'eMailWebsitVerify', 'html', 'html'),
(67, 'Split a string into smaller chunks/string', 'echo chunk_split(''FF99FF'', 2, '':''); \r\necho "</br>";\r\necho substr(chunk_split(''FF99FF'', 2, '':''),0,8);', 'M_chunk_split', 'php', 'phpmenu'),
(68, 'Return information about characters used in a string / Count character', '<?php\r\n$data = "Two Ts and one F.";\r\n\r\nforeach (count_chars($data, 1) as $i => $val) {\r\n   echo "There were $val instance(s) of \\"" , chr($i) , "\\" in the string.\\n";\r\n}\r\n?>', 'M_count_chars', 'php', 'phpmenu'),
(69, 'Split a string by string', '<?php\r\n// Example 1\r\n$pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";\r\n$pieces = explode(" ", $pizza);\r\necho $pieces[0]; // piece1\r\necho $pieces[1]; // piece2\r\n\r\n// Example 2\r\n$data = "foo:*:1023:1000::/home/foo:/bin/sh";\r\nlist($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);\r\necho $user; // foo\r\necho $pass; // *\r\n\r\n?>', 'M_explode', 'php', 'phpmenu'),
(70, 'Write a formatted string to a stream/ write to a file', '<?php\r\nif (!($fp = fopen(''date.txt'', ''w''))) {\r\n    return;\r\n}\r\n\r\nfprintf($fp, "%04d-%02d-%02d", 2011, 08, 09);\r\necho "write to date.txt";\r\n?>', 'M_fprintf', 'php', 'phpmenu'),
(71, 'Returns the translation table used by htmlspecialchars() and htmlentities()', '<?php\r\n$trans = get_html_translation_table(HTML_ENTITIES);\r\n$str = "Hallo & <Frau> & Krämer";\r\n$encoded = strtr($str, $trans);\r\n\r\necho $encoded;\r\n?>', 'M_get_html_translation_ta', 'php', 'phpmenu'),
(72, 'Convert all HTML entities to their applicable characters', '<?php\r\n$orig = "I''ll \\"walk\\" the <b>dog</b> now";\r\n\r\n$a = htmlentities($orig);\r\n\r\n$b = html_entity_decode($a);\r\necho $orig;\r\necho "</br>";\r\necho $a; // I''ll &quot;walk&quot; the &lt;b&gt;dog&lt;/b&gt; now\r\necho "</br>";\r\necho $b; // I''ll "walk" the <b>dog</b> now', 'M_html_entity_decode', 'php', 'phpmenu'),
(73, 'Convert all applicable characters to HTML entities', '<?php\r\n$str = "A ''quote'' is <b>bold</b>";\r\n\r\n// Outputs: A ''quote'' is &lt;b&gt;bold&lt;/b&gt;\r\necho htmlentities($str);\r\necho "</br>";\r\n// Outputs: A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt;\r\necho htmlentities($str, ENT_QUOTES);\r\necho "</br>";\r\n?>\r\n<pre>\r\nENT_COMPAT 	Will convert double-quotes and leave single-quotes alone.\r\nENT_QUOTES 	Will convert both double and single quotes.\r\nENT_NOQUOTES 	Will leave both double and single quotes unconverted.\r\nENT_IGNORE 	Silently discard invalid code unit sequences instead of returning an empty string. Added in PHP 5.3.0. \r\n                This is provided for backwards compatibility; avoid using it as it may have security implications.\r\n</pre>', 'htmlentities', 'php', 'phpmenu'),
(74, 'Convert special HTML entities back to characters ', '<?php\r\n$str = ''<p>this -&gt; &quot;</p>'';\r\n\r\necho htmlspecialchars_decode($str);\r\necho "</br>";\r\n// note that here the quotes aren''t converted\r\necho htmlspecialchars_decode($str, ENT_NOQUOTES);\r\n?>', 'm_htmlspecialchars_decode', 'php', 'phpmenu'),
(75, 'Convert special characters to HTML entities', '<?php\r\n$new = htmlspecialchars("<a href=''test''>Test</a>", ENT_QUOTES);\r\necho $new; // &lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;\r\n?>', 'M_htmlspecialchars', 'php', 'phpmenu'),
(76, 'Join array elements with a string. convert array to list', '<?php\r\n\r\n$array = array(''lastname'', ''email'', ''phone'');\r\n$comma_separated = implode(",", $array);\r\n\r\necho $comma_separated; // lastname,email,phone\r\n\r\n// Empty string when using an empty array:\r\nvar_dump(implode(''hello'', array())); // string(0) ""\r\n// or you can use join\r\n$array = array(''lastname'', ''email'', ''phone'');\r\n$comma_separated = join(",", $array);\r\n\r\necho $comma_separated; // lastname,email,phone\r\n?>', 'M_implode', 'php', 'phpmenu'),
(77, 'Make/convert a string''s first character lowercase', '<?php\r\n$foo = ''HelloWorld'';\r\n$foo = lcfirst($foo);             // helloWorld\r\necho $foo;\r\necho "</br>";\r\n$bar = ''HELLO WORLD!'';\r\n$bar = lcfirst($bar);             // hELLO WORLD!\r\necho $bar;\r\necho "</br>";\r\n$bar = lcfirst(strtoupper($bar)); // hELLO WORLD!\r\necho $bar;\r\n?>', 'M_lcfirst', 'php', 'phpmenu'),
(78, 'Calculate Levenshtein distance between two strings/Find the most match word', '<?php\r\n// input misspelled word\r\n$input = ''carrrot'';\r\n\r\n// array of words to check against\r\n$words  = array(''apple'',''pineapple'',''banana'',''orange'',\r\n                ''radish'',''carrot'',''pea'',''bean'',''potato'');\r\n\r\n// no shortest distance found, yet\r\n$shortest = -1;\r\n\r\n// loop through words to find the closest\r\nforeach ($words as $word) {\r\n\r\n    // calculate the distance between the input word,\r\n    // and the current word\r\n    $lev = levenshtein($input, $word);\r\n\r\n    // check for an exact match\r\n    if ($lev == 0) {\r\n\r\n        // closest word is this one (exact match)\r\n        $closest = $word;\r\n        $shortest = 0;\r\n\r\n        // break out of the loop; we''ve found an exact match\r\n        break;\r\n    }\r\n\r\n    // if this distance is less than the next found shortest\r\n    // distance, OR if a next shortest word has not yet been found\r\n    if ($lev <= $shortest || $shortest < 0) {\r\n        // set the closest match, and shortest distance\r\n        $closest  = $word;\r\n        $shortest = $lev;\r\n    }\r\n}\r\n\r\necho "Input word: $input</br>";\r\nif ($shortest == 0) {\r\n    echo "Exact match found: $closest</br>";\r\n} else {\r\n    echo "Did you mean: $closest?</br>";\r\n}\r\n\r\n?>', 'M_levenshtein', 'php', 'phpmenu'),
(79, 'Strip whitespace (or other characters) from the beginning of a string, left trim', '<?php\r\n\r\n$text = "\\t\\tThese are a few words :) ...  ";\r\n$binary = "\\x09Example string\\x0A";\r\n$hello  = "Hello World";\r\nvar_dump($text, $binary, $hello);\r\n\r\nprint "\\n";\r\n\r\n\r\n$trimmed = ltrim($text);\r\nvar_dump($trimmed);\r\n\r\n$trimmed = ltrim($text, " \\t.");\r\nvar_dump($trimmed);\r\n\r\n$trimmed = ltrim($hello, "Hdle");\r\nvar_dump($trimmed);\r\n\r\n// trim the ASCII control characters at the beginning of $binary\r\n// (from 0 to 31 inclusive)\r\n$clean = ltrim($binary, "\\x00..\\x1F");\r\nvar_dump($clean);\r\n\r\n?>', 'M_ltrim', 'php', 'phpmenu'),
(80, 'hash of a string,sha1', '<?php\r\n$str = ''apple'';\r\n\r\nif (md5($str) === ''1f3870be274f6c49b3e31a0c6728957f'') {\r\n    echo "Would you like a green or red apple?</br>";\r\n}\r\n?>		\r\nIt is not recommended to use this function to secure passwords, due to the fast nature of this hashing algorithm.', 'M_md5', 'php', 'phpmenu'),
(81, 'Formats a number as a currency string', 'money_format() is only defined if the system has strfmon capabilities. For example, Windows does not, so money_format() is undefined in Windows.\r\n<?php\r\n\r\n$number = 1234.56;\r\n\r\n// let''s print the international format for the en_US locale\r\nsetlocale(LC_MONETARY, ''en_US'');\r\necho money_format(''%i'', $number) . "</br>";\r\n// USD 1,234.56\r\n\r\n// Italian national format with 2 decimals`\r\nsetlocale(LC_MONETARY, ''it_IT'');\r\necho money_format(''%.2n'', $number) . "</br>";\r\n// Eu 1.234,56\r\n\r\n// Using a negative number\r\n$number = -1234.5672;\r\n\r\n// US national format, using () for negative numbers\r\n// and 10 digits for left precision\r\nsetlocale(LC_MONETARY, ''en_US'');\r\necho money_format(''%(#10n'', $number) . "</br>";\r\n// ($        1,234.57)\r\n\r\n// Similar format as above, adding the use of 2 digits of right\r\n// precision and ''*'' as a fill character\r\necho money_format(''%=*(#10.2n'', $number) . "</br>";\r\n// ($********1,234.57)\r\n\r\n// Let''s justify to the left, with 14 positions of width, 8 digits of\r\n// left precision, 2 of right precision, withouth grouping character\r\n// and using the international format for the de_DE locale.\r\nsetlocale(LC_MONETARY, ''de_DE'');\r\necho money_format(''%=*^-14#8.2i'', 1234.56) . "</br>";\r\n// Eu 1234,56****\r\n\r\n// Let''s add some blurb before and after the conversion specification\r\nsetlocale(LC_MONETARY, ''en_GB'');\r\n$fmt = ''The final value is %i (after a 10%% discount)'';\r\necho money_format($fmt, 1234.56) . "</br>";\r\n// The final value is  GBP 1,234.56 (after a 10% discount)\r\n\r\n?>', 'M_money_format', 'php', 'phpmenu'),
(82, 'Inserts HTML line breaks before all newlines in a string, add', '<?php \r\n      $string_text=file_get_contents("../robots.txt"); // load text file in var\r\n      $new_text=nl2br($string_text); // convert CR & LF in <br> in newvar\r\n      echo $new_text; // print out HTML formatted text\r\n      unset($string_text, $new_text); // clear all vars to unload memory\r\n ?>', 'M_nl2br', 'php', 'phpmenu'),
(83, 'Format a number', '<?php \r\necho ''number_format(number,decimals,decimalpoint,separator)'';\r\n\r\n$number = 1234.56;\r\n\r\necho ''english notation (default): '';\r\n$english_format_number = number_format($number);\r\necho $english_format_number."<br/>";\r\necho ''French notation: '';\r\n$nombre_format_francais = number_format($number, 2, '','', '' '');\r\necho $nombre_format_francais."<br/>";\r\n\r\n$number = 1234.5678;\r\n\r\necho ''english notation without thousands separator: '';\r\n$english_format_number = number_format($number, 2, ''.'', '''');\r\necho $english_format_number."<br/>";\r\n\r\n?>', 'M_number_format', 'php', 'phpmenu'),
(84, 'Return/display/get ASCII value of character, Clean String, Random String', '<?php\r\nfunction asciiEncodeEmail($strEmail,$strDisplay,$blnCreateLink) {\r\n    $strMailto = "&#109;&#097;&#105;&#108;&#116;&#111;&#058;";\r\n    for ($i=0; $i < strlen($strEmail); $i++) {\r\n        $strEncodedEmail .= "&#".ord(substr($strEmail,$i)).";";\r\n    }\r\n    if(strlen(trim($strDisplay))>0) {\r\n        $strDisplay = $strDisplay;\r\n    }\r\n    else {\r\n        $strDisplay = $strEncodedEmail;\r\n    }\r\n    if($blnCreateLink) {\r\n        return "<a href=\\"".$strMailto.$strEncodedEmail."\\">".$strDisplay."</a>";\r\n    }\r\n    else {\r\n        return $strDisplay;\r\n    }\r\n}\r\n\r\n#examples:\r\necho "yourname@yourdomain.com will display as :<br/>";\r\necho asciiEncodeEmail("yourname@yourdomain.com","Your Name",true);\r\necho "<br />";\r\necho asciiEncodeEmail("yourname@yourdomain.com","",true);\r\necho "<br />";\r\necho asciiEncodeEmail("yourname@yourdomain.com","",false);\r\necho "<br />";\r\nfunction cleanstr($string){\r\n    $len = strlen($string);\r\n    for($a=0; $a<$len; $a++){\r\n        $p = ord($string[$a]);\r\n        # chr(32) is space, it is preserved..\r\n        (($p > 64 && $p < 123) || $p == 32) ? $ret .= $string[$a] : $ret .= "";\r\n    }\r\n    return $ret;\r\n}\r\necho "cleaning a string: @@@@ !!!## abc@d <br/>";\r\n$tst = "@@@@ !!!## abc@d";\r\necho cleanstr($tst);\r\necho "<br />";\r\necho "generate a random string";\r\necho "<br />";\r\n$x = 1;  //minimum length\r\n$y = 10;  //maximum length\r\n\r\n$len = rand($x,$y);  //get a random string length\r\n\r\nfor ($i = 0; $i < $len; $i++) {  //loop $len no. of times\r\n   $whichChar = rand(1,3);  //choose if its a caps, lcase or num\r\n   if ($whichChar == 1) { //it''s a number\r\n      $string .= chr(rand(48,57));  //randomly generate a num\r\n   }\r\n   elseif ($whichChar == 2) { //it''s a small letter\r\n      $string .= chr(rand(65,90));  //randomly generate an lcase\r\n   }\r\n   else { //it''s a capital letter\r\n      $string .= chr(rand(97,122));  //randomly generate a ucase\r\n   }\r\n}\r\necho $string;\r\necho "<br />";\r\n?>', 'M_ord', 'php', 'phpmenu'),
(85, 'Parses the string into variables,', '<?php\r\n$prevVars["foo"] = "foovalue";\r\n$queryString = "bar=barvalue&stuff=stuffval";\r\n$newVars = array();\r\nparse_str($queryString, $newVars);\r\n\r\n$vars = array_merge($prevVars, $newVars);\r\necho "<pre>";\r\nprint_r($vars);\r\necho "</pre>";\r\n?>		', 'M_parse_str', 'php', 'phpmenu');
INSERT INTO `main` (`id`, `ShortDesc`, `Source`, `Name`, `Ext`, `SearchGroup`) VALUES
(86, 'call by ajaxload.html', '  <div id="cta">\r\n    <h2>Question 1 of 10</h2>\r\n     <p class="question">Frank is taller than John, Ralph is taller than Frank.  Therefore, John is the shortest.</p>\r\n      <form method="get" id="form1" onSubmit="return validate(); " action="index3.htm">\r\n\r\n      <ol>\r\n       <li><a href="index3.htm?ans1=a"  onClick="return false;" class="answer"><p name="ans1" class="ansrtxt">True</p></a></li>\r\n       <li><a href="index3.htm?ans1=b"  onClick="return false;" class="answer"><p name="ans1" class="ansrtxt">False</p></a></li>\r\n         </ol>\r\n\r\n        <div id="button">\r\n          <input name="contbtn" type="image" id="contbtn" src="../images/submit.png" onClick="return false;"/>\r\n        </div>\r\n      </form>\r\n    </div>\r\n  </div>\r\n		', 'ajaxload2', 'html', 'html'),
(88, 'Output a formatted string,sprintf, vprintf, vfprintf, sscanf, fscanf,vsprintf', '<?php\r\necho ''sprintf()-Writes a formatted string to a variable,<br/>\r\nvprintf()-Outputs a formatted string, <br/>\r\nsscanf()-Parses input from a string according to a format, <br/>\r\nfscanf()-Parses input from a file according to a format,  <br/>\r\nvsprintf()-Return a formatted string\r\nvfprintf()-Write a formatted string to a stream <br/>'';\r\necho "<br/>";\r\n$file = "test.txt"; $lines = 7;\r\necho ''$file = "test.txt"; $lines = 7'';\r\necho "<br/>"; \r\necho ''printf("The file %s consists of %d lines\\n", $file, $lines)'';\r\necho "<br/>"; \r\nprintf("The file %s consists of %d lines\\n", $file, $lines);\r\n// returns --> The file test.txt consists of 7 lines\r\necho "<br/>"; \r\n \r\n// padding something, prefix a string with "_"\r\n$word = ''foobar'';\r\necho ''$word = "foobar";'';\r\necho "<br/>"; \r\necho ''printf("%\\''_10s\\n", $word)'';\r\necho "<br/>"; \r\nprintf("%''_10s\\n", $word);\r\n// returns --> ____foobar\r\n echo "<br/>"; \r\n \r\n// format a number:\r\n$number = 100.85995;\r\necho ''$number = 100.85995;'';\r\necho "<br/>"; \r\necho ''printf("%03d\\n", $number);'';\r\necho "<br/>"; \r\nprintf("%03d\\n", $number); // returns --> 100\r\necho "<br/>"; \r\necho ''printf("%01.2f\\n", $number);'';\r\necho "<br/>"; \r\nprintf("%01.2f\\n", $number); // returns --> 100.86\r\necho "<br/>"; \r\necho ''printf("%01.3f\\n", $number);'';\r\necho "<br/>"; \r\nprintf("%01.3f\\n", $number); // returns --> 100.860\r\n echo "<br/>"; \r\n \r\n// parse a string with sscanf #1\r\nlist($number) = sscanf("ID/1234567","ID/%d");\r\necho ''list($number) = sscanf("ID/1234567","ID/%d");'';\r\necho "<br/>"; \r\necho ''print "$number\\n";'';\r\necho "<br/>"; \r\nprint "$number\\n";\r\n// returns --> 1234567\r\n echo "<br/>"; \r\n \r\n// parse a string with sscanf #2\r\n$test = "string 1234 string 5678";\r\n$result = sscanf($test, "%s %d %s %d");\r\necho ''$test = "string 1234 string 5678";'';\r\necho "<br/>"; \r\necho ''$result = sscanf($test, "%s %d %s %d");'';\r\necho "<br/>";\r\necho ''print_r($result);'';\r\necho "<br/>";\r\nprint_r($result);\r\n \r\n/*\r\n \r\n--> returns:\r\n \r\nArray\r\n(\r\n    [0] => string\r\n    [1] => 1234\r\n    [2] => string\r\n    [3] => 5678\r\n)\r\n \r\n*/\r\necho <<<_END\r\n<pre>\r\n    % - a literal percent character. No argument is required.\r\n    b - the argument is treated as an integer, and presented as a binary number.\r\n    c - the argument is treated as an integer, and presented as the character with that ASCII value.\r\n    d - the argument is treated as an integer, and presented as a (signed) decimal number.\r\n    e - the argument is treated as scientific notation (e.g. 1.2e+2). The precision specifier stands for the number of digits after the decimal point since PHP 5.2.1. In earlier versions, it was taken as number of significant digits (one less).\r\n    E - like %e but uses uppercase letter (e.g. 1.2E+2).\r\n    u - the argument is treated as an integer, and presented as an unsigned decimal number.\r\n    f - the argument is treated as a float, and presented as a floating-point number (locale aware).\r\n    F - the argument is treated as a float, and presented as a floating-point number (non-locale aware). Available since PHP 4.3.10 and PHP 5.0.3.\r\n    g - shorter of %e and %f.\r\n    G - shorter of %E and %f.\r\n    o - the argument is treated as an integer, and presented as an octal number.\r\n    s - the argument is treated as and presented as a string.\r\n    x - the argument is treated as an integer and presented as a hexadecimal number (with lowercase letters).\r\n    X - the argument is treated as an integer and presented as a hexadecimal number (with uppercase letters).\r\n</pre>\r\n_END;\r\necho "<br/>"; ', 'M_printf', 'php', 'phpmenu'),
(89, 'Strip whitespace (or other characters) from the end of a string, right trim', 'This shows how rtrim works when using the optional charlist parameter:\r\nrtrim reads a character, one at a time, from the optional charlist parameter and compares it to the end of the str string. If the characters match, it trims it off and starts over again, looking at the "new" last character in the str string and compares it to the first character in the charlist again. If the characters do not match, it moves to the next character in the charlist parameter comparing once again. It continues until the charlist parameter has been completely processed, one at a time, and the str string no longer contains any matches. The newly "rtrimmed" string is returned.\r\n<?php\r\n  // Example 1:\r\necho "<br/>";\r\n  echo rtrim(''This is a short short sentence'', ''short sentence'');\r\n  echo "<br/>";\r\n  // returns ''This is a''\r\n  // If you were expecting the result to be ''This is a short '',\r\n  // then you''re wrong; the exact string, ''short sentence'',\r\n  // isn''t matched.  Remember, character-by-character comparison!\r\n  // Example 2:\r\n  echo rtrim(''This is a short short sentence'', ''cents'');\r\n  // returns ''This is a short short ''\r\necho "<br/>";\r\n?>', 'M_rtrim', 'php', 'phpmenu'),
(90, 'new index file', '<?php\r\ninclude("config.php");\r\nif(isset($_COOKIE[''searchID2'']) or isset($_REQUEST[''searchID2'']))\r\n{\r\n	if(isset($_COOKIE[''searchID2''])) {$searchID2=(int)$_COOKIE[''searchID2''];}\r\n	ELSEIF(isset($_REQUEST[''searchID2''])){$searchID2=(int)$_REQUEST[''searchID2''];}\r\n	$GetDisplay = "SELECT *	FROM main WHERE id = $searchID2 ORDER BY id LIMIT 1";\r\n	include("RecordSet.php");\r\n	setcookie("searchID2","",time() + 3600);\r\n }\r\nELSEIF(isset($_POST[''searchID'']))\r\n{\r\n	$searchID2 = (int)$_POST[''searchID''];\r\n	$GetDisplay = "SELECT * FROM main WHERE id = $searchID2 ORDER BY id  LIMIT 1";\r\n	include("RecordSet.php");\r\n}\r\n\r\n?>\r\n<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<script type="text/javascript">\r\nfunction setnametorun() {\r\n	var text = document.getElementById(''Ext'').value;\r\n	if(text == "php") var value = "PHP/"+document.getElementById("Name").value+''.''+text;\r\n	else var value = "HTML/"+document.getElementById("Name").value+''.''+text;\r\n	if(text == "php" || text == "html" || text == "pdf") document.getElementById(''loaddisp'').src = value;\r\n	else if(text == "link") window.open(document.getElementById("Source").innerHTML);\r\n\r\n}\r\n</script>\r\n<link type="text/css" rel="stylesheet" href="css/MyResource.css" />\r\n<script type="text/javascript" src="scripts/AjaxGetData.js"></script>\r\n\r\n<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">\r\n<title>Result Display</title>\r\n<style type="text/css">\r\ntextarea { width: 100%; margin: 0; padding: 1%; border: 1px solid #38c; }\r\n</style>\r\n</head>\r\n<body>\r\n<form name="DescSearch" method="POST">\r\n<input type="hidden" name="searchID" id="searchID"  value="<?php if (isset($searchID)){ echo $searchID; } else ''''; ?>"/>\r\n<div align="left">\r\n  <table border="0">\r\n    <tr>\r\n      <td><p>SEARCH:</p></td>\r\n      <td><input type="text"  id="searchField" autocomplete="off" name="ShortDesc" size="90"  maxlength="200" id="ShortDesc" style="border: 1px solid #38c;" onFocus = "clearChoice();" onKeyUp="SendRequest(''SearchShortDesc.php'',document.getElementById(''SearchGroup'').value);" /></td>\r\n      <td><img id="loader" src="images/loader.gif" style="vertical-align: middle; display: none" />\r\n	  <input type="hidden" name="Submit" id="searchDone" value="Search" style="background : #AFDCEC ; width : 5em ;color:#04B404;"></td>\r\n    </tr>\r\n    <tr>\r\n    <td colspan="3" align="left"><div id="popups"> </div></td>\r\n    </tr>\r\n  </table>\r\n  </div>\r\n</form>\r\n<form action="<?php echo $_SERVER[''SCRIPT_NAME'']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">\r\n<table width="39%">\r\n  <tr>\r\n	<td colspan="6"></td>\r\n  </tr>\r\n  <tr>\r\n    <td><p></p></td>\r\n    <td colspan="5"><input type="text" name="ShortDesc" size="100" maxlength="200" style="font-weight:bold;border: 0px #38c;position : fixed ; top: 2em ; right: 0em;"  value="<?php if (isset($ShortDesc)){ echo htmlspecialchars($ShortDesc); } else ''''; ?>" readonly="readonly"></td>\r\n    </tr>\r\n	<tr>\r\n    <td colspan="6">\r\n	<div class="container">\r\n    <label class="textareaContainer">\r\n	<textarea name="Source" id="Source" rows="35" readonly="readonly"><?php if (isset($Source)){ echo trim(htmlspecialchars($Source)); } else ''''; ?></textarea>\r\n	</label>\r\n	</div>\r\n	</td>	\r\n   </tr>\r\n  <tr>\r\n    <td>\r\n	<select name="SearchGroup" id="SearchGroup" class="reqd" >\r\n	   <option value="" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "") echo "selected"; ?>>ALL</option>\r\n	   <option value="php" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "php") echo "selected"; ?>>php</option>\r\n	   <option value="phpmenu" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "phpmenu") echo "selected"; ?>>php menu</option>\r\n	   <option value="html" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "html") echo "selected"; ?>>html</option>\r\n	   <option value="htm" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "htm") echo "selected"; ?>>htm</option>\r\n	   <option value="pdf" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "pdf") echo "selected"; ?>>pdf</option>\r\n	   <option value="js" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "js") echo "selected"; ?>>js</option>\r\n	   <option value="txt" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "txt") echo "selected"; ?>>txt</option>\r\n	   <option value="link" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "link") echo "selected"; ?>>link</option>\r\n	 </select>		\r\n	</td>\r\n    <td align="right"><p></p></td>\r\n    <td width="20"><input type="hidden" name="Name" id="Name" size="15" maxlength="50" style="border: 1px solid #38c;"  value="<?php if (isset($Name)){ echo htmlspecialchars($Name); } else ''''; ?>"></td>\r\n    <td align="left" width="10"><p></p></td>\r\n    <td align="left" width="20">\r\n		<input type="hidden" name="Ext" id = "Ext" size="100" maxlength="200" style="border: 1px solid #38c;"  value="<?php if (isset($Ext)){ echo htmlspecialchars($Ext); } else ''''; ?>">\r\n	</td>\r\n	<td align="left" width="15"><p></p></td>\r\n</tr>  \r\n</table>    \r\n</form>\r\n<iframe src="" width="60%" height="94%" id="loaddisp" style="position : fixed ; bottom: 0em ; right: 0em ;">\r\n  <p>Your browser does not support iframes.</p>\r\n</iframe>\r\n<iframe src="http://raymondlwhuang.host56.com/MyHelpFile.php" width="30%" height="29%" style="position : fixed ; bottom: 0em ; left: 10em ;">\r\n  <p>Your browser does not support iframes.</p>\r\n</iframe>\r\n</body>\r\n</html>\r\n<script type="text/javascript">\r\n	var text = document.getElementById(''Ext'').value;\r\n	if(text == "php") var value = "PHP/"+document.getElementById("Name").value+''.''+text;\r\n	else var value = "HTML/"+document.getElementById("Name").value+''.''+text;\r\n	if(text == "php" || text == "html" || text == "pdf") document.getElementById(''loaddisp'').src = value;\r\n	else if(text == "link") window.open(document.getElementById("Source").innerHTML);\r\n</script>\r\n		', 'index', 'php', 'php'),
(91, 'Get Data with ajax', 'var xhr = false;\r\nvar statesArray = new Array();\r\nfunction SendRequest (url,SearchGroup) {\r\n	var str = document.getElementById("searchField").value;\r\n	document.getElementById("searchField").className = "";\r\n	if (str != "") {\r\n		document.getElementById("popups").innerHTML = "";\r\n		document.getElementById("popups").style.display = ''block'';\r\n		for (var i=0; i<statesArray.length; i++) {\r\n			var thisState = statesArray[i];\r\n\r\n			if (thisState.toLowerCase().indexOf(str.toLowerCase()) >= 0) {\r\n				var tempDiv = document.createElement("div");\r\n				tempDiv.innerHTML = thisState;\r\n				tempDiv.onclick = makeChoice;\r\n				tempDiv.className += " suggestions";\r\n				document.getElementById("popups").appendChild(tempDiv);\r\n			}\r\n		}\r\n		var foundCt = document.getElementById("popups").childNodes.length;\r\n		if (foundCt == 0) {\r\n			document.getElementById("searchField").className += " error";\r\n		}\r\n		if (foundCt == 1) {\r\n			document.getElementById("searchID").value = document.getElementById("popups").firstChild.innerHTML.substring(0,7);\r\n			document.getElementById("searchField").value = document.getElementById("popups").firstChild.innerHTML;\r\n			document.getElementById("popups").innerHTML = "";\r\n			document.getElementById("popups").style.display = ''none'';\r\n			document.DescSearch.submit();\r\n		}\r\n	}\r\n	var forceActiveX = (window.ActiveXObject && location.protocol === "file:");\r\n    if (window.XMLHttpRequest && !forceActiveX) {\r\n        xhr = new XMLHttpRequest();\r\n    }\r\n    else {\r\n        try {\r\n            xhr = new ActiveXObject("Microsoft.XMLHTTP");\r\n        } catch(e) {}\r\n    }	\r\n	if (xhr) {\r\n		xhr.onreadystatechange = setStatesArray;\r\n		var queryString = url + "?SearchGroup=" + SearchGroup;\r\n		xhr.open("GET", queryString, true);\r\n		xhr.send(null);\r\n	}\r\n	else {\r\n		alert("Sorry, but I couldn''t create an XMLHttpRequest");\r\n	}\r\n}\r\nfunction setStatesArray() {\r\n	if (xhr.readyState == 4) {\r\n       if (xhr.status == 0 || (xhr.status >= 200 && xhr.status < 300) \r\n        || xhr.status == 304 \r\n        || xhr.status == 1223) {    // defined in ajax.js\r\n       var allStates=xhr.responseText;\r\n       statesArray = allStates.split(":::");\r\n		}\r\n		else {\r\n			alert("There was a problem with the request " + xhr.status);\r\n		}\r\n	}\r\n}\r\nfunction makeChoice(evt) {\r\n	if (evt) {	\r\n		var thisDiv = evt.target;\r\n	}\r\n	else {\r\n		var thisDiv = window.event.srcElement;\r\n	}\r\n	document.getElementById("searchID").value = thisDiv.innerHTML.substring(0,7);\r\n	document.getElementById("searchField").value = thisDiv.innerHTML;\r\n	document.getElementById("popups").innerHTML = "";\r\n	document.getElementById("popups").style.display = ''none'';\r\n	document.DescSearch.submit();\r\n}\r\nfunction clearChoice() {\r\n	document.getElementById("searchField").value = "";\r\n	document.getElementById("popups").innerHTML = "";\r\n}\r\n		', 'AjaxGetData', 'js', 'js'),
(92, 'other image roll over', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"\r\n        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n	<title>Three-state Rollovers</title>\r\n	<script type="text/javascript" src="../scripts/RollOver.js"></script>\r\n</head>\r\n<body bgcolor="#FFFFFF">\r\n	<a href="next1.html"><img src="../images/button1_off.gif" width="113" height="33" border="0" alt="button1" id="button1" /></a>&nbsp;&nbsp;\r\n	<a href="next2.html"><img src="../images/button2_off.gif" width="113" height="33" border="0" alt="button2" id="button2" /></a>\r\n</body>\r\n</html>', 'RollOver2', 'html', 'html'),
(93, 'Image Roll Over', 'window.onload = rolloverInit;\r\n\r\nfunction rolloverInit() {\r\n	for (var i=0; i<document.images.length; i++) {\r\n		if (document.images[i].parentNode.tagName == "A") {\r\n			setupRollover(document.images[i]);\r\n		}\r\n	}\r\n}\r\n\r\nfunction setupRollover(thisImage) {\r\n	thisImage.outImage = new Image();\r\n	thisImage.outImage.src = thisImage.src;\r\n	thisImage.onmouseout = function() {\r\n		this.src = this.outImage.src;\r\n	}\r\n\r\n	thisImage.clickImage = new Image();\r\n	thisImage.clickImage.src = "../images/" + thisImage.id + "_click.gif";\r\n	thisImage.onclick = function() {\r\n		this.src = this.clickImage.src;\r\n	}\r\n\r\n	thisImage.overImage = new Image();\r\n	thisImage.overImage.src = "../images/" + thisImage.id + "_on.gif";\r\n	thisImage.onmouseover = function() {\r\n		this.src = this.overImage.src;\r\n	}\r\n}\r\n		', 'RollOver', 'js', 'js'),
(94, 'Image Rotation, Cycling Banners', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"\r\n        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n	<title>Rotating Banner</title>\r\n	<script type="text/javascript" src="../scripts/ImageRotate.js"></script>\r\n</head>\r\n<body bgcolor="#FFFFFF">\r\n	<div align="center">\r\n		<img src="images/reading1.gif" width="400" height="75" id="adBanner" alt="Ad Banner" />\r\n	</div>\r\n</body>\r\n</html>\r\n		', 'ImageRotate', 'html', 'html'),
(95, 'Force Numeric Input', '<html>\r\n <head>\r\n <script type="text/javascript">\r\nfunction ForceNumericInput(field,DotIncl) {\r\n	if (DotIncl == true) {var regExpr = /^[0-9]*([\\.]?)[0-9]*$/;} else var regExpr = /^[0-9]*$/;\r\n	if (!regExpr.test(field.value)) {field.value = field.value.substr(0,field.value.length-1);}\r\n}\r\n </script>\r\n </head>\r\n <body>\r\nThe fill in box only allow numbers<br/>\r\nAccept only Integer: <input type="text"  maxlength = 10 onkeyup="ForceNumericInput(this,false);"><br/>\r\nAccept decimal: <input type="text"  maxlength = 10 onkeyup="ForceNumericInput(this,true);">\r\n</body> \r\n</html>		', 'ForceNumericInput', 'html', 'html'),
(96, 'Adding And Subtracting Dates', '<?php\r\n$date = "1998-08-14";\r\necho $date;\r\necho "<br/>";\r\necho "subtracting 3 days from the date: ";\r\n$newdate = strtotime ( ''-3 day'' , strtotime ( $date ) ) ;\r\n$newdate = date ( ''Y-m-j'' , $newdate );\r\n \r\necho $newdate;		\r\necho "<br/>";\r\necho "subtracting 3 weeks from the date: ";\r\n$newdate = strtotime ( ''-3 week'' , strtotime ( $date ) ) ;\r\n$newdate = date ( ''Y-m-j'' , $newdate );\r\n \r\necho $newdate;\r\necho "<br/>";\r\necho "subtracting 3 months from the date: ";\r\n$newdate = strtotime ( ''-3 month'' , strtotime ( $date ) ) ;\r\n$newdate = date ( ''Y-m-j'' , $newdate );\r\n \r\necho $newdate;\r\necho "<br/>";\r\necho "subtracting 3 years from the date: ";\r\n$newdate = strtotime ( ''-3 year'' , strtotime ( $date ) ) ;\r\n$newdate = date ( ''Y-m-j'' , $newdate );\r\n \r\necho $newdate;', 'DateHandle', 'php', 'php'),
(97, 'Pass variable to Javascript', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n<title>Pass Variable To Javascript</title>\r\n</head>\r\n<body>\r\n<form class="cmxform" name="signup" id="signup_form" method="post" action="../PHP/PassVarToJavascript2.php">\r\n<table width="860" border="0" cellspacing="0" cellpadding="0">\r\n	  <tr>\r\n		<td align="right"><label for="first_name">First Name:</label></td>\r\n		<td><input name="first_name" type="text" class="FieldPubreq" id="first_name" minlength="2"></td>\r\n	  </tr>\r\n	  <tr>\r\n		<td align="right"><label for="last_name">Last Name:</label></td>\r\n		<td><input name="last_name" type="text" class="FieldPubreq" id="last_name" minlength="2"></td>\r\n	  </tr>\r\n</table>\r\n<input type="submit" name="submit" value="submit">\r\n</form>\r\n</body>\r\n</html>\r\n		', 'PassVarToJavascript', 'php', 'php'),
(98, 'Pass variable to Javascript sub-program', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n<script type="text/javascript">\r\n\r\nfunction validForm() {\r\n var MessageTag = document.getElementById("ErrorMessage");\r\n var signature = document.getElementById("signatureCheck").value.toLowerCase();\r\n var FirstLast = signature.split(" ");\r\n var FinalName = new Array(" "," "), j = 0;\r\nvar CheckName = "";\r\n	 if(signature == "")\r\n	 {\r\n       MessageTag.innerHTML = "** Name that you entered is not the same as you entered in last page **";\r\n       document.getElementById("signatureCheck").className = "invalid";\r\n	   document.getElementById("signatureCheck").focus();\r\n	   return false;\r\n	 }	\r\n	 for (var i=0; i< FirstLast.length; i++) {\r\n		if(FirstLast[i] != "") {\r\n			FinalName[j] = FirstLast[i];\r\n			CheckName = CheckName + FirstLast[i];\r\n			j++;\r\n		}\r\n	}\r\n 	 <?php $first_name = $_REQUEST[''first_name'']; ?>\r\n	var first_name = "<?php echo strtolower($first_name); ?>";\r\n	var FirstNameOrg = first_name.split(" ");\r\n	var FirstNameSplit = new Array(" "," "), j = 0;\r\n	var FirstNameFinal = "";\r\n	for (var i=0; i< FirstNameOrg.length; i++) {\r\n		if(FirstNameOrg[i] != "") {\r\n			FirstNameSplit[j] = FirstNameOrg[i];\r\n			FirstNameFinal = FirstNameFinal + FirstNameSplit[j];\r\n			j++;\r\n		}\r\n	}\r\n	var FirstNameLen = j;\r\n	 <?php $last_name = $_REQUEST[''last_name'']; ?>\r\n	var last_name = "<?php echo strtolower($last_name); ?>";\r\n	var LastNameOrg = last_name.split(" ");\r\n	var LastNameSplit = new Array(" "," "), j = 0;\r\n	var LastNameFinal = "";\r\n	for (var i=0; i< LastNameOrg.length; i++) {\r\n		if(LastNameOrg[i] != "") {\r\n			LastNameSplit[j] = LastNameOrg[i];\r\n			LastNameFinal = LastNameFinal + LastNameSplit[j];\r\n			j++;\r\n		}\r\n	}\r\n	var LastNameLen = j;\r\n	var CheckFirstName1 = "";\r\n	var CheckLastName1 = "";\r\n	for (var i=0; i< FirstNameLen; i++) {\r\n		CheckFirstName1 = CheckFirstName1 + FinalName[i];\r\n	}	\r\n	for (var i=0; i< LastNameLen; i++) {\r\n		CheckLastName1 = CheckLastName1 + FinalName[FirstNameLen + i];\r\n	}	\r\n	var CheckFirstName2 = "";\r\n	var CheckLastName2 = "";\r\n	for (var i=0; i< LastNameLen; i++) {\r\n		CheckLastName2 = CheckLastName2 + FinalName[i];\r\n	}	\r\n	for (var i=0; i< FirstNameLen; i++) {\r\n		CheckFirstName2 = CheckFirstName2 + FinalName[LastNameLen + i];\r\n	}	\r\n	var CheckName2 = FirstNameFinal + LastNameFinal;\r\n	if(CheckName2.length != CheckName.length) {\r\n		MessageTag.innerHTML = "** Name that you entered is not the same as you entered in last page **";\r\n		document.getElementById("signatureCheck").className = "invalid";\r\n		document.getElementById("signatureCheck").focus();\r\n		return false;	\r\n	}\r\n	\r\n	if (!((CheckFirstName1 == FirstNameFinal && CheckLastName1 == LastNameFinal) || (CheckFirstName2 == FirstNameFinal && CheckLastName2 == LastNameFinal))){\r\n		MessageTag.innerHTML = "** Name that you entered is not the same as you entered in last page **";\r\n		document.getElementById("signatureCheck").className = "invalid";\r\n		document.getElementById("signatureCheck").focus();\r\n		return false;\r\n	}\r\n	MessageTag.innerHTML = "** The name you entered are accepted! **";\r\n	return false;\r\n\r\n}\r\n</script>\r\n\r\n</head>\r\n\r\n<body>\r\n<form name="agreement_form" id="agreement_form"  method="post" onsubmit="return validForm();">\r\n<table cellpadding="0" cellspacing="0" border="0">\r\n<tr>\r\n<td>Enter your name: <input type="text" size="50" name="signatureCheck" id="signatureCheck" value=""  autocomplete="off"/></td>\r\n</tr>\r\n	<tr>\r\n		<td><input type="submit" value="Submit" name="finalsubmit" /><br/><b><font color="red" id="ErrorMessage"></font></b></td>\r\n	</tr>\r\n</table>\r\n</form>\r\n\r\n</body>\r\n</html>', 'PassVarToJavascript2', 'php', 'php'),
(99, 'hash of a string', 'Note that the sha1 algorithm has been compromised and is no longer being used by government agencies.\r\nAs of PHP 5.1.2 a new set of hashing functions are available.\r\nhttp://www.php.net/manual/en/function.hash.php\r\nThe new function hash() supports a new range of hashing methods.\r\necho hash(''sha256'', ''The quick brown fox jumped over the lazy dog.'');\r\nIt is recommended that developers start to future proof their applications by using the stronger sha-2, hashing methods such as sha256, sha384, sha512 or better.\r\nAs of PHP 5.1.2 hash_algos() returns an array of system specific or registered hashing algorithms methods that are available to PHP.\r\nprint_r(hash_algos());<br/>\r\n==============================================================<br/>\r\n\r\n<?php\r\necho hash(''sha256'', ''The quick brown fox jumped over the lazy dog.'');\r\necho "<br/>";\r\necho hash(''sha256'', ''The quick brown fox jumped over the lazy dog.'');\r\necho "<br/>";\r\n\r\nprint_r(hash_algos());', 'M_sha1', 'php', 'phpmenu'),
(100, 'compare/Calculate the similarity between two strings', '<?php\r\n$string1 = "raymond";\r\n$string2 = "ray";\r\nsimilar_text($string1, $string2, $p);\r\necho "''raymond'' and ''ray'' are $p% similar";\r\n?>', 'M_similar_text', 'php', 'phpmenu'),
(101, 'Search words that pronounced similarly, Spelling Correction', '<?php\r\nfunction train($file = ''../big.txt'') {\r\n        $contents = file_get_contents($file);\r\n        // get all strings of word letters\r\n        preg_match_all(''/\\w+/'', $contents, $matches);\r\n        unset($contents);\r\n        $dictionary = array();\r\n        foreach($matches[0] as $word) {\r\n                $word = strtolower($word);\r\n                $soundex_key = soundex($word);\r\n                if(!isset($dictionary[$soundex_key][$word])) {\r\n                    $dictionary[$soundex_key][$word] = 0;\r\n                }\r\n \r\n                $dictionary[$soundex_key][$word] += 1;\r\n        }\r\n        unset($matches);\r\n        return $dictionary;\r\n}\r\nfunction train2($file = ''../big.txt'') {\r\n        $contents = file_get_contents($file);\r\n        // get all strings of word letters\r\n        preg_match_all(''/\\w+/'', $contents, $matches);\r\n        unset($contents);\r\n        $dictionary = array();\r\n        foreach($matches[0] as $word) {\r\n                $word = strtolower($word);\r\n                if(!isset($dictionary[$word])) {\r\n                        $dictionary[$word] = 0;\r\n                }\r\n                $dictionary[$word] += 1;\r\n        }\r\n        unset($matches);\r\n        return $dictionary;\r\n}\r\nfunction correct($word) {\r\n	$dic = train2();\r\n    if (array_key_exists($word, $dic)) {\r\n        return $word;\r\n    }  \r\n	$dic = train();\r\n    if (array_key_exists($word, $dic)) {\r\n        return $word;\r\n    }  	\r\n	if (isset($dic[soundex($word)])) $search_result = $dic[soundex($word)]; else return '''';\r\n \r\n    foreach ($search_result as $key => &$res) {\r\n        $dist = levenshtein($key,$word);\r\n        // consider just distance equals to 1 (the best) or 2\r\n        if ($dist == 1 || $dist == 2) {\r\n            $res = $res / $dist;\r\n        }\r\n        // discard all the other candidates that have distances other than 1 and 2\r\n        // from the original word\r\n        else {\r\n            unset($search_result[$key]);\r\n        }\r\n    }\r\n \r\n    // reverse sorting of the words by frequence\r\n    arsort($search_result);\r\n \r\n    // return the first key of the array (which will be the word suggested)\r\n    foreach ($search_result as $key => $res) {\r\n        return $key;\r\n    }\r\n}\r\nIF(isset($_POST[''submit'']))\r\n{\r\n	$wrongs = $_POST[''secondword''];\r\n	$good = $bad = 0;\r\n	$wrongs = explode('' '', $wrongs);\r\n	foreach($wrongs as $wrong) {\r\n		$CorrectWord = correct($wrong);\r\n		if($CorrectWord != '''') {\r\n			if($wrong == $CorrectWord){\r\n				echo "You spell it correctly!";\r\n				echo "<br/>";\r\n			}\r\n			else {\r\n			echo "The correct spelling of this word is: ";\r\n			echo $CorrectWord;\r\n			echo "<br/>";\r\n			}\r\n		} else {\r\n			echo "Can not valify this word";\r\n			echo "<br/>";\r\n		}\r\n\r\n	}\r\n}\r\n\r\n?>\r\n<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n</head>\r\n\r\n<body>\r\nThis spelling correct program is about 80% correct! <br/>\r\n<form name="validate" id="validate"  method="post">\r\n<table cellpadding="0" cellspacing="0" border="0">\r\n<tr>\r\n<td>Enter a word: <input type="text" size="50" name="secondword" id="secondword" value=""  /></td>\r\n</tr>\r\n	<tr>\r\n		<td><input type="submit" value="Click to find the correct spelling" name="submit" /><br/><b><font color="red" id="ErrorMessage"></font></b></td>\r\n	</tr>\r\n</table>\r\n</form>\r\n</body>\r\n</html>', 'M_soundex', 'php', 'phpmenu'),
(102, 'Search words that pronounced similarly', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n<script type="text/javascript">\r\nfunction soundex (str) {\r\n    // Calculate the soundex key of a string  \r\n    // \r\n    // version: 1107.2516\r\n    // discuss at: http://phpjs.org/functions/soundex    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)\r\n    // +    tweaked by: Jack\r\n    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)\r\n    // +   bugfixed by: Onno Marsman\r\n    // +      input by: Brett Zamir (http://brett-zamir.me)    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)\r\n    // +   original by: Arnout Kazemier (http://www.3rd-Eden.com)\r\n    // +    revised by: Rafal Kukawski (http://blog.kukawski.pl)\r\n    // *     example 1: soundex(''Kevin'');\r\n    // *     returns 1: ''K150''    // *     example 2: soundex(''Ellery'');\r\n    // *     returns 2: ''E460''\r\n    // *     example 3: soundex(''Euler'');\r\n    // *     returns 3: ''E460''\r\n    str = (str + '''').toUpperCase();    if (!str) {\r\n        return '''';\r\n    }\r\n    var sdx = [0, 0, 0, 0],\r\n        m = {            B: 1,\r\n            F: 1,\r\n            P: 1,\r\n            V: 1,\r\n            C: 2,            G: 2,\r\n            J: 2,\r\n            K: 2,\r\n            Q: 2,\r\n            S: 2,            X: 2,\r\n            Z: 2,\r\n            D: 3,\r\n            T: 3,\r\n            L: 4,            M: 5,\r\n            N: 5,\r\n            R: 6\r\n        },\r\n        i = 0,        j, s = 0,\r\n        c, p;\r\n \r\n    while ((c = str.charAt(i++)) && s < 4) {\r\n        if (j = m[c]) {            if (j !== p) {\r\n                sdx[s++] = p = j;\r\n            }\r\n        } else {\r\n            s += i === 1;            p = 0;\r\n        }\r\n    }\r\n \r\n    sdx[0] = str.charAt(0);    return sdx.join('''');\r\n}\r\nfunction compare(str1,str2) {\r\n  if (soundex(str1) == soundex(str2)){ alert(''Both word sounds similarly'');} else alert(''They sounds different'');\r\n}		\r\n</script>\r\n\r\n</head>\r\n\r\n<body>\r\n<form name="validate" id="validate"  method="post">\r\n<table cellpadding="0" cellspacing="0" border="0">\r\n<tr>\r\n<td>Enter the first word: <input type="text" size="50" name="firstword" id="firstword" value="" /></td>\r\n</tr>\r\n<tr>\r\n<td>Enter the first word: <input type="text" size="50" name="secondword" id="secondword" value=""  /></td>\r\n</tr>\r\n	<tr>\r\n		<td><input type="submit" value="Test the sound" name="submit" onClick = "compare(firstword.value,secondword.value);return false;"/><br/><b><font color="red" id="ErrorMessage"></font></b></td>\r\n	</tr>\r\n</table>\r\n</form>\r\n</body>\r\n</html>', 'soundex', 'html', 'html'),
(103, 'Parses input from a string according to a format, testing sscanf() function', '<?php\r\n\r\n\r\nfunction print_value($val,$postfix="<br>") {\r\n	if (is_array($val)) {\r\n		for ($i = 0;$i< count($val);$i++) {\r\n			echo $val[$i] . $postfix;\r\n		}\r\n	} else {\r\n		echo $val . $postfix;\r\n	}\r\n}\r\n\r\nfunction do_sscanf($string, $format) {\r\n	$s = "sscanf(\\"" . $string . ",\\"" . $format ."\\").";\r\n	echo "$s<br>";\r\n	$s = str_repeat("-", strlen($s));\r\n	echo "$s<br>";\r\n	$output = sscanf($string,$format);\r\n	echo "Result : ";\r\n	print_value( $output );\r\n	echo "$s<br><br>";\r\n}\r\n\r\n\r\nfunction run_sscanf_test_cases($filename="test.txt")\r\n{\r\n\r\n	echo "<h3><em><br>Running Test Cases from $filename<br></em></h3>"; \r\n	$arr = file($filename);\r\n	for ($i=0;$i < count($arr);$i++) {\r\n		$line_arr = explode("|",$arr[$i]);\r\n		\r\n		$format = $line_arr[0];\r\n		$string = $line_arr[1];\r\n		if (count($arr) > 2) {\r\n			$comment = $line_arr[2];\r\n		} else {\r\n			$comment = "";\r\n		}\r\n		if ( empty($format) || empty($string) ) {\r\n			continue;\r\n		}\r\n		print("<h4>** Case : $comment ******************************</h4>");\r\n		do_sscanf($string,$format);\r\n	}\r\n}\r\n\r\nfunction simple_tests() {\r\n	echo "Testing sscanf with standard ANSI syntax (values returned by\r\nreference)-<br>";\r\n	$decimal = -1;\r\n	$string  = "";\r\n	$hex	 = 0;\r\n	$float	 = 0.0;	\r\n	$octal	 = 0.0;\r\n	$int	 = -1;\r\n				\r\n	echo "<h3><em><br>Simple Test<br></em></h3>"; \r\n	echo "sscanf(''10'',''%d'',&\\$decimal) <br>";\r\n	echo "<br>BEFORE : <br> decimal = $decimal.";\r\n	$foo = sscanf("10","%d",&$decimal);\r\n	echo "<br>AFTER  : <br> decimal = $decimal <br>";\r\n\r\n\r\n	echo "<h3><em><br>Simple Test 2<br></em></h3>"; \r\n	echo "sscanf(\\"ghost 0xface\\",\\"%s %x\\",&\\$string, &\\$int)<br>";\r\n	echo "<br>BEFORE : <br> string = $string, int = $int<br>";\r\n	$foo = sscanf("ghost 0xface","%s %x",&$string, &$int);\r\n	echo "<br>AFTER  : <br> string = $string, int = $int<br>";\r\n	echo " sscan reports : ";\r\n	print_value( $foo,"");\r\n	echo " conversions <br>";\r\n\r\n	echo "<h3><em><br>Multiple specifiers<br></em></h3>"; \r\n	echo "sscanf(\\"jabberwocky 1024 0xFF 1.024 644 10\\",\r\n			\\"%s %d  %x %f %o %i\\",\r\n			&\\$string,&\\$decimal,&\\$hex,&\\$float,&\\$octal,&\\$int);<br>";\r\n	echo "<br>BEFORE : <br>";\r\n	echo "Decimal = $decimal, String = $string, Hex = $hex<br>";\r\n	echo "Octal = $octal , Float = $float, Int = $int<br>"; \r\n	$foo = sscanf(	"jabberwocky 1024 0xFF 1.024 644 10",\r\n			"%s %d  %x %f %o %i",\r\n			&$string,&$decimal,&$hex,&$float,&$octal,&$int);\r\n	echo "<br>AFTER :<br>";\r\n	echo "decimal = $decimal, string = $string, hex = $hex<br>";\r\n	echo "octal = $octal , float = $float, int = $int<br>"; \r\n				\r\n	echo " sscan reports : ";\r\n	print_value( $foo,"");\r\n	echo " conversions <br>";\r\n	echo "----------------------------------------<br>";\r\n}\r\n\r\n\r\n\r\n?>\r\n<html>\r\n	<head>\r\n		<title>Test of sscanf()</title>\r\n	</head>\r\n	<body>\r\n		<strong><h1>Testing sscanf() support in PHP</h1></strong><br>	\r\n		<?php\r\n			if (!function_exists(''sscanf'')) {\r\n				echo "<strong>I''m sorry but sscanf() does not exist !i</strong><br>";\r\n			} else {\r\n				simple_tests();\r\n				run_sscanf_test_cases(); \r\n			}\r\n		?>\r\n	</body>	\r\n</html>', 'M_sscanf', 'php', 'phpmenu'),
(104, 'Parse a CSV string into an array', '<?php\r\n//\r\n// Convert csv file to associative array:\r\n//\r\n\r\nfunction csv_to_array($input, $delimiter=''|'')\r\n{\r\n    $header = null;\r\n    $data = array();\r\n    $csvData = str_getcsv($input, "\r\n");\r\n   \r\n    foreach($csvData as $csvLine){\r\n        if(is_null($header)) $header = explode($delimiter, $csvLine);\r\n        else{\r\n           \r\n            $items = explode($delimiter, $csvLine);\r\n           \r\n            for($n = 0, $m = count($header); $n < $m; $n++){\r\n                $prepareData[$header[$n]] = $items[$n];\r\n            }\r\n           \r\n            $data[] = $prepareData;\r\n        }\r\n    }\r\n   \r\n    return $data;\r\n}\r\n\r\n//-----------------------------------\r\n//\r\n//Usage:\r\n\r\n$csvArr = csv_to_array(file_get_contents(''M_rtrim.php''));\r\nvar_dump($csvArr);\r\n?>', 'M_str_getcsv', 'php', 'phpmenu'),
(105, 'replaces some characters with some other characters in a string, case insensitive', '<?php\r\necho ''str_ireplace("WORLD","Peter","Hello world!");'';\r\necho ''<br/>'';\r\n\r\necho str_ireplace("WORLD","Peter","Hello world!");\r\necho ''<br/>----------------------------------<br/>'';\r\necho ''$arr = array("blue","red","green","yellow");'';\r\necho ''<br/>'';\r\necho ''print_r(str_ireplace("RED","pink",$arr,$i));'';\r\necho ''<br/>'';\r\n$arr = array("blue","red","green","yellow");\r\nprint_r(str_ireplace("RED","pink",$arr,$i));\r\necho "Replacements: $i";\r\necho ''<br/>----------------------------------<br/>'';\r\necho ''$find = array("HELLO","WORLD");'';\r\necho ''<br/>'';echo ''$replace = array("B");'';\r\necho ''<br/>'';echo ''$arr = array("Hello","world","!");'';\r\necho ''<br/>'';echo ''print_r(str_ireplace($find,$replace,$arr));'';\r\necho ''<br/>'';\r\n$find = array("HELLO","WORLD");\r\n$replace = array("B");\r\n$arr = array("Hello","world","!");\r\nprint_r(str_ireplace($find,$replace,$arr));\r\n?>', 'M_str_ireplace', 'php', 'phpmenu'),
(106, 'Pad a string to a certain length with another string', '<?php\r\n\r\n$str = "test";\r\n\r\nfunction str_pad_right ( $string , $padchar , $int ) {\r\n    $i = strlen ( $string ) + $int;\r\n    $str = str_pad ( $string , $i , $padchar , STR_PAD_RIGHT );\r\n    return $str;\r\n}\r\n   \r\nfunction str_pad_left ( $string , $padchar , $int ) {\r\n    $i = strlen ( $string ) + $int;\r\n    $str = str_pad ( $string , $i , $padchar , STR_PAD_LEFT );\r\n    return $str;\r\n}\r\n   \r\nfunction str_pad_both ( $string , $padchar , $int ) {\r\n    $i = strlen ( $string ) + ( $int * 2 );\r\n    $str = str_pad ( $string , $i , $padchar , STR_PAD_BOTH );\r\n    return $str;\r\n}\r\n\r\necho str_pad_left ( $str , "-" , 3 ); // Produces: ---test\r\necho ''<br/>'';\r\necho str_pad_right ( $str , "-" , 3 ); // Produces: test---\r\necho ''<br/>'';\r\necho str_pad_both ( $str , "-" , 3 ); // Produces: ---test---\r\n?>		', 'M_str_pad', 'php', 'phpmenu'),
(107, 'Repeat a string', '<?php\r\nfunction str_repeat_extended($input, $multiplier, $separator='''')\r\n{\r\n    return $multiplier==0 ? '''' : str_repeat($input.$separator, $multiplier-1).$input;\r\n}\r\n\r\n$tst = str_repeat_extended(''this is a testing'', 3, '';'');\r\necho $tst;\r\n?>		', 'M_str_repeat', 'php', 'phpmenu'),
(108, 'Replace the search string with the replacement string,Compress a string''s internal spaces', 'Be careful when replacing characters (or repeated patterns in the FROM and TO arrays)\r\n<?php\r\necho ''<pre>'';\r\necho ''<br/>'';\r\n$bodytag = str_replace("%body%", "black", "<body text=''%body%''>");\r\n\r\n// Provides: Hll Wrld f PHP\r\n$vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");\r\n$onlyconsonants = str_replace($vowels, "", "Hello World of PHP");\r\n\r\n// Provides: You should eat pizza, beer, and ice cream every day\r\n$phrase  = "You should eat fruits, vegetables, and fiber every day.";\r\n$healthy = array("fruits", "vegetables", "fiber");\r\n$yummy   = array("pizza", "beer", "ice cream");\r\n$newphrase = str_replace($healthy, $yummy, $phrase);\r\necho $newphrase ;\r\necho ''<br/>'';\r\n// Provides: 2\r\n$str = str_replace("ll", "", "good golly miss molly!", $count);\r\necho $count;\r\necho ''<br/>'';\r\n$str = '' This is    a    test   '';\r\necho $str ;\r\necho ''<br/>'';\r\n$count = 1;\r\nwhile($count)\r\n    $str = str_replace(''  '', '' '', $str, $count);\r\n\r\necho $str ;\r\necho ''<br/>'';\r\necho ''</pre>'';\r\n?>', 'M_str_replace', 'php', 'phpmenu'),
(109, 'shifts every letter by 13 places in the alphabet while leaving non-alpha characters untouched', 'You can use the function here to replace str_rot13<br/>\r\n<?php\r\nfunction str_rot($s, $n = 13) {\r\n    $n = (int)$n % 26;\r\n    if (!$n) return $s;\r\n    for ($i = 0, $l = strlen($s); $i < $l; $i++) {\r\n        $c = ord($s[$i]);\r\n        if ($c >= 97 && $c <= 122) {\r\n            $s[$i] = chr(($c - 71 + $n) % 26 + 97);\r\n        } else if ($c >= 65 && $c <= 90) {\r\n            $s[$i] = chr(($c - 39 + $n) % 26 + 65);\r\n        }\r\n    }\r\n    return $s;\r\n}\r\necho ''str_rot13("Hello World")'';\r\necho "<br />";\r\necho str_rot13("Hello World");\r\necho "<br />";\r\necho ''str_rot13("Uryyb Jbeyq")'';\r\necho "<br />";\r\necho str_rot13("Uryyb Jbeyq");\r\necho "<br />";\r\necho ''str_rot("Hello World",14);'';\r\necho "<br />";\r\necho str_rot("Hello World",14);\r\necho "<br />";\r\necho ''str_rot("Vszzc Kcfzr",-14);'';\r\necho "<br />";\r\necho str_rot("Vszzc Kcfzr",-14);\r\n?>', 'M_str_rot13', 'php', 'phpmenu'),
(110, 'Convert a string to an array,', '<?php\r\nfunction str_rsplit($str, $sz)\r\n{\r\n    // splits a string "starting" at the end, so any left over (small chunk) is at the beginning of the array.   \r\n    if ( !$sz ) { return false; }\r\n    if ( $sz > 0 ) { return str_split($str,$sz); }    // normal split\r\n   \r\n    $l = strlen($str);\r\n    $sz = min(-$sz,$l);\r\n    $mod = $l % $sz;\r\n   \r\n    if ( !$mod ) { return str_split($str,$sz); }    // even/max-length split\r\n\r\n    // split\r\n    return array_merge(array(substr($str,0,$mod)), str_split(substr($str,$mod),$sz));\r\n}\r\n\r\n$str = ''aAbBcCdDeEfFg'';\r\nstr_split($str,5); // return: {''aAbBc'',''CdDeE'',''fFg''}\r\nstr_rsplit($str,5); // return: {''aAbBc'',''CdDeE'',''fFg''}\r\nstr_rsplit($str,-5); // return: {''aAb'',''BcCdD'',''eEfFg''}\r\n\r\n?>		', 'M_str_split ', 'php', 'phpmenu'),
(111, 'Return information about words used in a string ,Counts the number of words inside string', 'We can also specify a range of values for charlist.\r\n\r\n<?php\r\n$str = "Hello fri3nd, you''re\r\n       looking          good today!\r\n       look1234ing";\r\necho str_word_count($str);\r\necho ''<br/>'';\r\necho str_word_count($str,1);\r\necho ''<br/>'';\r\necho str_word_count($str,2);\r\necho ''<br/>'';\r\nprint_r(str_word_count($str, 1, ''0..3''));\r\n?> 		', 'M_str_word_count', 'php', 'phpmenu');
INSERT INTO `main` (`id`, `ShortDesc`, `Source`, `Name`, `Ext`, `SearchGroup`) VALUES
(112, 'passing php date to sql ', '<?php\r\ninclude("../config.php");\r\nIF(isset($_POST[''submit'']))\r\n{\r\n	$fmdate = (float)($_POST[''fmyear''].$_POST[''fmmonth''].$_POST[''fmday'']."000000");\r\n	$todate = (float)($_POST[''toyear''].$_POST[''tomonth''].$_POST[''today'']."000000");\r\n$query="SELECT date, UNIX_TIMESTAMP(date) AS ut_date FROM spending where date between $fmdate and $todate";  // query string stored in a variable\r\n$rt=mysql_query($query);          // query executed \r\necho mysql_error();              // if any error is there that will be printed to the screen \r\necho ''<table border=1>\r\n	<tr>\r\n    <th>\r\n	<p>Date</p>\r\n	</th>'';\r\nwhile($nt=mysql_fetch_array($rt)){\r\necho "\r\n<tr>\r\n    <td>\r\n	$nt[date]\r\n	</td>\r\n</tr>\r\n	";\r\n}\r\n}\r\n/*\r\n$fmdate = "2011-08-18";\r\n$todate = "2011-08-22";\r\n$fmdate = strtotime( $fmdate );\r\n$fmdate = date( ''Y-m-d H:i:s'', $fmdate );\r\n$replaceStr = array("-", ":", " ");\r\n$todate = strtotime( $todate );\r\n$todate = date( ''Y-m-d H:i:s'', $todate );\r\n$fmdate1 = (float)str_replace($replaceStr,"",$fmdate);\r\n$todate1 = (float)str_replace($replaceStr,"",$todate);\r\n\r\n$query="SELECT date, UNIX_TIMESTAMP(date) AS ut_date FROM spending where date between $fmdate1 and $todate1";  // query string stored in a variable\r\n$rt=mysql_query($query);          // query executed \r\necho mysql_error();              // if any error is there that will be printed to the screen \r\n*/\r\n?>    		   \r\n\r\n<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n<form action="" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">\r\nDate Range From:<br/>\r\n	<select name="fmmonth" id="fmmonth">\r\n		<option value="01" <?php if(date("m") == "01"){ echo "selected"; } ?>>January</option>\r\n		<option value="02" <?php if(date("m") == "02"){ echo "selected"; } ?>>February</option>\r\n		<option value="03" <?php if(date("m") == "03"){ echo "selected"; } ?>>March</option>\r\n		<option value="04" <?php if(date("m") == "04"){ echo "selected"; } ?>>April</option>\r\n		<option value="05" <?php if(date("m") == "05"){ echo "selected"; } ?>>May</option>\r\n		<option value="06" <?php if(date("m") == "06"){ echo "selected"; } ?>>June</option>\r\n		<option value="07" <?php if(date("m") == "07"){ echo "selected"; } ?>>July</option>\r\n		<option value="08" <?php if(date("m") == "08"){ echo "selected"; } ?>>August</option>\r\n		<option value="09" <?php if(date("m") == "09"){ echo "selected"; } ?>>September</option>\r\n		<option value="10" <?php if(date("m") == "10"){ echo "selected"; } ?>>October</option>\r\n		<option value="11" <?php if(date("m") == "11"){ echo "selected"; } ?>>November</option>\r\n		<option value="12" <?php if(date("m") == "12"){ echo "selected"; } ?>>December</option>\r\n	</select>\r\n	<select name="fmday" id="fmday">\r\n		<option value="01" <?php if(date("d") == "01"){ echo "selected"; } ?>>01</option>\r\n		<option value="02" <?php if(date("d") == "02"){ echo "selected"; } ?>>02</option>\r\n		<option value="03" <?php if(date("d") == "03"){ echo "selected"; } ?>>03</option>\r\n		<option value="04" <?php if(date("d") == "04"){ echo "selected"; } ?>>04</option>\r\n		<option value="05" <?php if(date("d") == "05"){ echo "selected"; } ?>>05</option>\r\n		<option value="06" <?php if(date("d") == "06"){ echo "selected"; } ?>>06</option>\r\n		<option value="07" <?php if(date("d") == "07"){ echo "selected"; } ?>>07</option>\r\n		<option value="08" <?php if(date("d") == "08"){ echo "selected"; } ?>>08</option>\r\n		<option value="09" <?php if(date("d") == "09"){ echo "selected"; } ?>>09</option>\r\n		<option value="10" <?php if(date("d") == "10"){ echo "selected"; } ?>>10</option>\r\n		<option value="11" <?php if(date("d") == "11"){ echo "selected"; } ?>>11</option>\r\n		<option value="12" <?php if(date("d") == "12"){ echo "selected"; } ?>>12</option>\r\n		<option value="13" <?php if(date("d") == "13"){ echo "selected"; } ?>>13</option>\r\n		<option value="14" <?php if(date("d") == "14"){ echo "selected"; } ?>>14</option>\r\n		<option value="15" <?php if(date("d") == "15"){ echo "selected"; } ?>>15</option>\r\n		<option value="16" <?php if(date("d") == "16"){ echo "selected"; } ?>>16</option>\r\n		<option value="17" <?php if(date("d") == "17"){ echo "selected"; } ?>>17</option>\r\n		<option value="18" <?php if(date("d") == "18"){ echo "selected"; } ?>>18</option>\r\n		<option value="19" <?php if(date("d") == "19"){ echo "selected"; } ?>>19</option>\r\n		<option value="20" <?php if(date("d") == "20"){ echo "selected"; } ?>>20</option>\r\n		<option value="21" <?php if(date("d") == "21"){ echo "selected"; } ?>>21</option>\r\n		<option value="22" <?php if(date("d") == "22"){ echo "selected"; } ?>>22</option>\r\n		<option value="23" <?php if(date("d") == "23"){ echo "selected"; } ?>>23</option>\r\n		<option value="24" <?php if(date("d") == "24"){ echo "selected"; } ?>>24</option>\r\n		<option value="25" <?php if(date("d") == "25"){ echo "selected"; } ?>>25</option>\r\n		<option value="26" <?php if(date("d") == "26"){ echo "selected"; } ?>>26</option>\r\n		<option value="27" <?php if(date("d") == "27"){ echo "selected"; } ?>>27</option>\r\n		<option value="28" <?php if(date("d") == "28"){ echo "selected"; } ?>>28</option>\r\n		<option value="29" <?php if(date("d") == "29"){ echo "selected"; } ?>>29</option>\r\n		<option value="30" <?php if(date("d") == "30"){ echo "selected"; } ?>>30</option>\r\n		<option value="31" <?php if(date("d") == "31"){ echo "selected"; } ?>>31</option>\r\n	</select>\r\n	<select name="fmyear" id="fmyear">\r\n	    <option value = "2011" <?php if(date("Y") == "2011"){ echo "selected"; } ?>>2011</option>\r\n		<option value = "2012" <?php if(date("Y") == "2012"){ echo "selected"; } ?>>2012</option>\r\n		<option value = "2013" <?php if(date("Y") == "2013"){ echo "selected"; } ?>>2013</option>\r\n		<option value = "2014" <?php if(date("Y") == "2014"){ echo "selected"; } ?>>2014</option>\r\n		<option value = "2015" <?php if(date("Y") == "2015"){ echo "selected"; } ?>>2015</option>\r\n		<option value = "2016" <?php if(date("Y") == "2016"){ echo "selected"; } ?>>2016</option>\r\n		<option value = "2017" <?php if(date("Y") == "2017"){ echo "selected"; } ?>>2017</option>\r\n		<option value = "2018" <?php if(date("Y") == "2018"){ echo "selected"; } ?>>2018</option>\r\n		<option value = "2019" <?php if(date("Y") == "2019"){ echo "selected"; } ?>>2019</option>\r\n		<option value = "2020" <?php if(date("Y") == "2020"){ echo "selected"; } ?>>2020</option>\r\n	</select>\r\n<br/>To:<br/>\r\n	<select name="tomonth" id="tomonth">\r\n		<option value="01" <?php if(date("m") == "01"){ echo "selected"; } ?>>January</option>\r\n		<option value="02" <?php if(date("m") == "02"){ echo "selected"; } ?>>February</option>\r\n		<option value="03" <?php if(date("m") == "03"){ echo "selected"; } ?>>March</option>\r\n		<option value="04" <?php if(date("m") == "04"){ echo "selected"; } ?>>April</option>\r\n		<option value="05" <?php if(date("m") == "05"){ echo "selected"; } ?>>May</option>\r\n		<option value="06" <?php if(date("m") == "06"){ echo "selected"; } ?>>June</option>\r\n		<option value="07" <?php if(date("m") == "07"){ echo "selected"; } ?>>July</option>\r\n		<option value="08" <?php if(date("m") == "08"){ echo "selected"; } ?>>August</option>\r\n		<option value="09" <?php if(date("m") == "09"){ echo "selected"; } ?>>September</option>\r\n		<option value="10" <?php if(date("m") == "10"){ echo "selected"; } ?>>October</option>\r\n		<option value="11" <?php if(date("m") == "11"){ echo "selected"; } ?>>November</option>\r\n		<option value="12" <?php if(date("m") == "12"){ echo "selected"; } ?>>December</option>\r\n	</select>\r\n	<select name="today" id="today">\r\n		<option value="01" <?php if(date("d") == "01"){ echo "selected"; } ?>>01</option>\r\n		<option value="02" <?php if(date("d") == "02"){ echo "selected"; } ?>>02</option>\r\n		<option value="03" <?php if(date("d") == "03"){ echo "selected"; } ?>>03</option>\r\n		<option value="04" <?php if(date("d") == "04"){ echo "selected"; } ?>>04</option>\r\n		<option value="05" <?php if(date("d") == "05"){ echo "selected"; } ?>>05</option>\r\n		<option value="06" <?php if(date("d") == "06"){ echo "selected"; } ?>>06</option>\r\n		<option value="07" <?php if(date("d") == "07"){ echo "selected"; } ?>>07</option>\r\n		<option value="08" <?php if(date("d") == "08"){ echo "selected"; } ?>>08</option>\r\n		<option value="09" <?php if(date("d") == "09"){ echo "selected"; } ?>>09</option>\r\n		<option value="10" <?php if(date("d") == "10"){ echo "selected"; } ?>>10</option>\r\n		<option value="11" <?php if(date("d") == "11"){ echo "selected"; } ?>>11</option>\r\n		<option value="12" <?php if(date("d") == "12"){ echo "selected"; } ?>>12</option>\r\n		<option value="13" <?php if(date("d") == "13"){ echo "selected"; } ?>>13</option>\r\n		<option value="14" <?php if(date("d") == "14"){ echo "selected"; } ?>>14</option>\r\n		<option value="15" <?php if(date("d") == "15"){ echo "selected"; } ?>>15</option>\r\n		<option value="16" <?php if(date("d") == "16"){ echo "selected"; } ?>>16</option>\r\n		<option value="17" <?php if(date("d") == "17"){ echo "selected"; } ?>>17</option>\r\n		<option value="18" <?php if(date("d") == "18"){ echo "selected"; } ?>>18</option>\r\n		<option value="19" <?php if(date("d") == "19"){ echo "selected"; } ?>>19</option>\r\n		<option value="20" <?php if(date("d") == "20"){ echo "selected"; } ?>>20</option>\r\n		<option value="21" <?php if(date("d") == "21"){ echo "selected"; } ?>>21</option>\r\n		<option value="22" <?php if(date("d") == "22"){ echo "selected"; } ?>>22</option>\r\n		<option value="23" <?php if(date("d") == "23"){ echo "selected"; } ?>>23</option>\r\n		<option value="24" <?php if(date("d") == "24"){ echo "selected"; } ?>>24</option>\r\n		<option value="25" <?php if(date("d") == "25"){ echo "selected"; } ?>>25</option>\r\n		<option value="26" <?php if(date("d") == "26"){ echo "selected"; } ?>>26</option>\r\n		<option value="27" <?php if(date("d") == "27"){ echo "selected"; } ?>>27</option>\r\n		<option value="28" <?php if(date("d") == "28"){ echo "selected"; } ?>>28</option>\r\n		<option value="29" <?php if(date("d") == "29"){ echo "selected"; } ?>>29</option>\r\n		<option value="30" <?php if(date("d") == "30"){ echo "selected"; } ?>>30</option>\r\n		<option value="31" <?php if(date("d") == "31"){ echo "selected"; } ?>>31</option>\r\n	</select>\r\n	<select name="toyear" id="toyear">\r\n	    <option value = "2011" <?php if(date("Y") == "2011"){ echo "selected"; } ?>>2011</option>\r\n		<option value = "2012" <?php if(date("Y") == "2012"){ echo "selected"; } ?>>2012</option>\r\n		<option value = "2013" <?php if(date("Y") == "2013"){ echo "selected"; } ?>>2013</option>\r\n		<option value = "2014" <?php if(date("Y") == "2014"){ echo "selected"; } ?>>2014</option>\r\n		<option value = "2015" <?php if(date("Y") == "2015"){ echo "selected"; } ?>>2015</option>\r\n		<option value = "2016" <?php if(date("Y") == "2016"){ echo "selected"; } ?>>2016</option>\r\n		<option value = "2017" <?php if(date("Y") == "2017"){ echo "selected"; } ?>>2017</option>\r\n		<option value = "2018" <?php if(date("Y") == "2018"){ echo "selected"; } ?>>2018</option>\r\n		<option value = "2019" <?php if(date("Y") == "2019"){ echo "selected"; } ?>>2019</option>\r\n		<option value = "2020" <?php if(date("Y") == "2020"){ echo "selected"; } ?>>2020</option>\r\n	</select>\r\n	<br/>\r\n	<input type="submit" name="submit" value="submit">\r\n</form>\r\n</body>\r\n</html>		', 'phpSQLDate', 'php', 'php'),
(113, 'My spending', '<?php\r\ninclude("config.php");\r\nif(isset($_COOKIE[''searchID2'']) or isset($_REQUEST[''searchID2'']))\r\n{\r\n	if(isset($_COOKIE[''searchID2''])) {$searchID2=(int)$_COOKIE[''searchID2''];}\r\n	ELSEIF(isset($_REQUEST[''searchID2''])){$searchID2=(int)$_REQUEST[''searchID2''];}\r\n	$GetDisplay = "SELECT *	FROM spending WHERE id = $searchID2 ORDER BY id LIMIT 1";\r\n	include("MySpending.txt");\r\n	setcookie("searchID2","",time() + 3600);\r\n }\r\nELSEIF(isset($_POST[''searchID'']))\r\n{\r\n	$searchID2 = (int)$_POST[''searchID''];\r\n	$GetDisplay = "SELECT * FROM spending WHERE id = $searchID2 ORDER BY id  LIMIT 1";\r\n	include("MySpending.txt");\r\n}\r\nif(isset($_POST[''Delete'']))\r\n{	\r\n	$searchID3 =  (int)$_POST[''searchID''];\r\n	mysql_query("DELETE FROM spending WHERE id = $searchID3");\r\n	$GetDisplay = "SELECT * FROM spending where id < $searchID3 ORDER BY id DESC LIMIT 1";\r\n	include("MySpending.txt");\r\n}\r\nELSEIF(isset($_POST[''Previous'']))\r\n{\r\n	$searchID3 =  (int)$_POST[''searchID''];	\r\n	$GetDisplay = "SELECT * FROM spending WHERE id < $searchID3 ORDER BY id DESC LIMIT 1";\r\n	$result = mysql_query($GetDisplay);\r\n	if (mysql_num_rows($result) == 0){\r\n		$GetDisplay = "SELECT * FROM spending WHERE id = $searchID3";	\r\n	}\r\n	include("MySpending.txt");\r\n}\r\nELSEIF(isset($_POST[''Next'']))\r\n{\r\n	$searchID3 =  (int)$_POST[''searchID''];\r\n	$GetDisplay = "SELECT * FROM spending WHERE id > $searchID3 ORDER BY id LIMIT 1";\r\n	$result = mysql_query($GetDisplay);\r\n	if (mysql_num_rows($result) == 0){\r\n		$GetDisplay = "SELECT * FROM spending WHERE id = $searchID3";\r\n	}					\r\n	include("MySpending.txt");\r\n}\r\nELSEIF(isset($_POST[''First'']))\r\n{\r\n	$GetDisplay = "SELECT * FROM spending ORDER BY id ASC LIMIT 1";\r\n	include("MySpending.txt");\r\n}\r\nELSEIF(isset($_POST[''Last'']))\r\n{\r\n	$GetDisplay = "SELECT * FROM spending ORDER BY id DESC LIMIT 1";\r\n	include("MySpending.txt");\r\n} \r\nELSEIF(isset($_POST[''Save'']))\r\n{\r\n	$searchID3 =  (int)mysql_real_escape_string($_POST[''searchID'']);\r\n	$detail = mysql_real_escape_string($_POST[''detail'']);\r\n	$whospend =  mysql_real_escape_string($_POST[''whospend'']);\r\n	$amount =  mysql_real_escape_string($_POST[''amount'']);\r\n	$code =  mysql_real_escape_string($_POST[''code'']);\r\n	$date =  mysql_real_escape_string($_POST[''date'']);\r\n	mysql_query("UPDATE spending SET detail=''$detail'', whospend=''$whospend'', 	amount=''$amount'', code=''$code'', date=''$date'' WHERE id = $searchID3");\r\n	$GetDisplay = "SELECT * FROM spending	where id = $searchID3 ORDER BY id LIMIT 1";\r\n	include("MySpending.txt");	\r\n}\r\nELSEIF(isset($_POST[''submit'']))\r\n{\r\n	$fmdate = (float)($_POST[''fmyear''].$_POST[''fmmonth''].$_POST[''fmday'']."000000");\r\n	$todate = (float)($_POST[''toyear''].$_POST[''tomonth''].$_POST[''today'']."000000");\r\n	$query="SELECT * FROM spending where date between $fmdate and $todate order by date desc";  // query string stored in a variable\r\n	$result=mysql_query($query);          // query executed \r\n	echo mysql_error();              // if any error is there that will be printed to the screen \r\n}\r\nelse \r\n{\r\n$todate = date( ''Y-m-d H:i:s'');\r\n$replaceStr = array("-", ":", " ");\r\n$todate = strtotime( $todate );\r\n$fmdate = strtotime ( ''-7 day'' , $todate ) ;\r\n$todate = date( ''Y-m-d H:i:s'', $todate );\r\n$fmdate1 = (float)str_replace($replaceStr,"",$fmdate);\r\n$todate1 = (float)str_replace($replaceStr,"",$todate);\r\n	$query="SELECT * FROM spending where date between $fmdate1 and $todate1 order by date desc";  // query string stored in a variable\r\n	$result=mysql_query($query);          // query executed \r\n	echo mysql_error();              // if any error is there that will be printed to the screen \r\n}\r\n$queryResult="SELECT sum(amount) as Total,code FROM spending where 1 group by code";  // query string stored in a variable\r\n$totalResult=mysql_query($queryResult);          // query executed \r\n\r\n?>\r\n<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<link type="text/css" rel="stylesheet" href="css/MyResource.css" />\r\n<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">\r\n<title>My Spending Reporter</title>\r\n<style type="text/css">\r\ntextarea { width: 100%; margin: 0; padding: 1%; border: 1px solid #38c; }\r\n</style>\r\n<script type="text/javascript">\r\nfunction ForceNumericInput(field,DotIncl) {\r\n	if (DotIncl == true) {var regExpr = /^[0-9]*([\\.]?)[0-9]*$/;} else var regExpr = /^[0-9]*$/;\r\n	if (!regExpr.test(field.value)) {field.value = field.value.substr(0,field.value.length-1);}\r\n}\r\n</script>\r\n</head>\r\n<body>\r\n<form action="<?php echo $_SERVER[''SCRIPT_NAME'']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">\r\n<input type="hidden" name="searchID" value="<?php if (isset($searchID)){ echo $searchID; } else ''''; ?>" readonly="readonly">\r\n<table>\r\n	<tr>\r\n    <th>\r\n	<p>Spender</p>\r\n	</th>\r\n	<th>\r\n	<p>Amount</p>\r\n	</th>\r\n	<th>\r\n	<p>Description</p>\r\n	</th>\r\n	</tr>\r\n	<tr>\r\n    <td align="right">\r\n	<select name="whospend" id="whospend">\r\n	   <option value="M" <?php if((isset($whospend) && htmlspecialchars($whospend) == "M") || !isset($whospend)) echo "selected"; ?>>Me</option>\r\n	   <option value="I" <?php if(isset($whospend) && htmlspecialchars($whospend) == "I") echo "selected"; ?>>Elaine</option>\r\n	 </select>	\r\n	</td>\r\n    <td align="right"><input type="text" name="amount" id="amount" size="5" maxlength="5"  onkeyup="ForceNumericInput(this,false);" style="border: 1px solid #38c;"  value="<?php if (isset($amount)){ echo htmlspecialchars($amount); } else ''''; ?>"></td>\r\n    <td align="right">\r\n	<select name="code" id="code" class="reqd" >\r\n	   <option value="Eat Out" <?php if(isset($code) && htmlspecialchars($code) == "Eat Out") echo "selected"; ?>>Eat Out</option>\r\n	   <option value="Family Entertainment" <?php if(isset($code) && htmlspecialchars($code) == "Family Entertainment") echo "selected"; ?>>Family Entertainment</option>\r\n	   <option value="Shopping" <?php if(isset($code) && htmlspecialchars($code) == "Shopping") echo "selected"; ?>>Shopping</option>\r\n	   <option value="Grocery" <?php if(isset($code) && htmlspecialchars($code) == "GE") echo "selected"; ?>>Grocery</option>\r\n	   <option value="Spend on Car" <?php if(isset($code) && htmlspecialchars($code) == "Spend on Car") echo "selected"; ?>>Spend on Car</option>\r\n	   <option value="Snack" <?php if(isset($code) && htmlspecialchars($code) == "Snack") echo "selected"; ?>>Snack</option>\r\n	   <option value="Electronic item" <?php if(isset($code) && htmlspecialchars($code) == "Electronic item") echo "selected"; ?>>Electronic item</option>\r\n	   <option value="Electricity and Water" <?php if(isset($code) && htmlspecialchars($code) == "Electricity and Water") echo "selected"; ?>>Electricity and Water</option>\r\n	   <option value="Insurance" <?php if(isset($code) && htmlspecialchars($code) == "Insurance") echo "selected"; ?>>Insurance</option>\r\n	   <option value="Party and Gift" <?php if(isset($code) && htmlspecialchars($code) == "Party and Gift") echo "selected"; ?>>Party and Gift</option>\r\n	   <option value="Kids Reward" <?php if(isset($code) && htmlspecialchars($code) == "Kids Reward") echo "selected"; ?>>Kids Reward</option>\r\n	   <option value="School" <?php if(isset($code) && htmlspecialchars($code) == "School") echo "selected"; ?>>School</option>\r\n	   <option value="Repair" <?php if(isset($code) && htmlspecialchars($code) == "Repair") echo "selected"; ?>>Repair</option>\r\n	   <option value="Heathy Food" <?php if(isset($code) && htmlspecialchars($code) == "Heathy Food") echo "selected"; ?>>Heathy Food</option>\r\n	   <option value="Unexpected(others)" <?php if(isset($code) && htmlspecialchars($code) == "Unexpected(others)") echo "selected"; ?>>Unexpected(others)</option>\r\n	   <option value="Consumer Gas" <?php if(isset($code) && htmlspecialchars($code) == "Consumer Gas") echo "selected"; ?>>Consumer Gas</option>\r\n	   <option value="Property Tax" <?php if(isset($code) && htmlspecialchars($code) == "Property Tax") echo "selected"; ?>>Property Tax</option>\r\n	   <option value="Home Phone" <?php if(isset($code) && htmlspecialchars($code) == "Home Phone") echo "selected"; ?>>Home Phone</option>\r\n	   <option value="Cellular Phone" <?php if(isset($code) && htmlspecialchars($code) == "Cellular Phone") echo "selected"; ?>>Cellular Phone</option>\r\n	   <option value="Internet" <?php if(isset($code) && htmlspecialchars($code) == "Internet") echo "selected"; ?>>Internet</option>\r\n	   <option value="Television" <?php if(isset($code) && htmlspecialchars($code) == "Television") echo "selected"; ?>>Television</option>\r\n	   <option value="Mortgage" <?php if(isset($code) && htmlspecialchars($code) == "MG") echo "selected"; ?>>Mortgage</option>\r\n	   <option value="Money to Elaine" <?php if(isset($code) && htmlspecialchars($code) == "Money to Elaine") echo "selected"; ?>>Money to Elaine</option>\r\n	 </select>		\r\n	</td>	\r\n   </tr>  \r\n  <tr>\r\n    <td colspan="3" align="left"><input type="text" name="detail" size="50" maxlength="200" style="border: 1px solid #38c;"  value="<?php if (isset($detail)){ echo htmlspecialchars($detail); } else ''''; ?>"></td>\r\n  </tr>\r\n</table>    \r\n<input type="submit" name="Save" value="Save" onclick="return confirm(''Are you sure you want to save?'')">\r\n<input type="reset" name="Cancel" value="Cancel">\r\n<input type="submit" name="Delete" value="Delete" onclick="return confirm(''Are you sure you want to delete?'')">\r\n<input type="button" name="Add" value="Add"  onClick="window.open( ''AddSpending.php'', ''_top'');return false;"><br/>\r\n<input type="submit" name="Previous" value="Previous">\r\n<input type="submit" name="Next" value="Next">\r\n<input type="submit" name="First" value="First">\r\n<input type="submit" name="Last" value="Last">\r\n</form>\r\n<form action="" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">\r\nDate Range From:<br/>\r\n	<select name="fmmonth" id="fmmonth">\r\n		<option value="01" <?php if(date("m") == "01"){ echo "selected"; } ?>>January</option>\r\n		<option value="02" <?php if(date("m") == "02"){ echo "selected"; } ?>>February</option>\r\n		<option value="03" <?php if(date("m") == "03"){ echo "selected"; } ?>>March</option>\r\n		<option value="04" <?php if(date("m") == "04"){ echo "selected"; } ?>>April</option>\r\n		<option value="05" <?php if(date("m") == "05"){ echo "selected"; } ?>>May</option>\r\n		<option value="06" <?php if(date("m") == "06"){ echo "selected"; } ?>>June</option>\r\n		<option value="07" <?php if(date("m") == "07"){ echo "selected"; } ?>>July</option>\r\n		<option value="08" <?php if(date("m") == "08"){ echo "selected"; } ?>>August</option>\r\n		<option value="09" <?php if(date("m") == "09"){ echo "selected"; } ?>>September</option>\r\n		<option value="10" <?php if(date("m") == "10"){ echo "selected"; } ?>>October</option>\r\n		<option value="11" <?php if(date("m") == "11"){ echo "selected"; } ?>>November</option>\r\n		<option value="12" <?php if(date("m") == "12"){ echo "selected"; } ?>>December</option>\r\n	</select>\r\n	<select name="fmday" id="fmday">\r\n		<option value="01" <?php if(date("d") == "01"){ echo "selected"; } ?>>01</option>\r\n		<option value="02" <?php if(date("d") == "02"){ echo "selected"; } ?>>02</option>\r\n		<option value="03" <?php if(date("d") == "03"){ echo "selected"; } ?>>03</option>\r\n		<option value="04" <?php if(date("d") == "04"){ echo "selected"; } ?>>04</option>\r\n		<option value="05" <?php if(date("d") == "05"){ echo "selected"; } ?>>05</option>\r\n		<option value="06" <?php if(date("d") == "06"){ echo "selected"; } ?>>06</option>\r\n		<option value="07" <?php if(date("d") == "07"){ echo "selected"; } ?>>07</option>\r\n		<option value="08" <?php if(date("d") == "08"){ echo "selected"; } ?>>08</option>\r\n		<option value="09" <?php if(date("d") == "09"){ echo "selected"; } ?>>09</option>\r\n		<option value="10" <?php if(date("d") == "10"){ echo "selected"; } ?>>10</option>\r\n		<option value="11" <?php if(date("d") == "11"){ echo "selected"; } ?>>11</option>\r\n		<option value="12" <?php if(date("d") == "12"){ echo "selected"; } ?>>12</option>\r\n		<option value="13" <?php if(date("d") == "13"){ echo "selected"; } ?>>13</option>\r\n		<option value="14" <?php if(date("d") == "14"){ echo "selected"; } ?>>14</option>\r\n		<option value="15" <?php if(date("d") == "15"){ echo "selected"; } ?>>15</option>\r\n		<option value="16" <?php if(date("d") == "16"){ echo "selected"; } ?>>16</option>\r\n		<option value="17" <?php if(date("d") == "17"){ echo "selected"; } ?>>17</option>\r\n		<option value="18" <?php if(date("d") == "18"){ echo "selected"; } ?>>18</option>\r\n		<option value="19" <?php if(date("d") == "19"){ echo "selected"; } ?>>19</option>\r\n		<option value="20" <?php if(date("d") == "20"){ echo "selected"; } ?>>20</option>\r\n		<option value="21" <?php if(date("d") == "21"){ echo "selected"; } ?>>21</option>\r\n		<option value="22" <?php if(date("d") == "22"){ echo "selected"; } ?>>22</option>\r\n		<option value="23" <?php if(date("d") == "23"){ echo "selected"; } ?>>23</option>\r\n		<option value="24" <?php if(date("d") == "24"){ echo "selected"; } ?>>24</option>\r\n		<option value="25" <?php if(date("d") == "25"){ echo "selected"; } ?>>25</option>\r\n		<option value="26" <?php if(date("d") == "26"){ echo "selected"; } ?>>26</option>\r\n		<option value="27" <?php if(date("d") == "27"){ echo "selected"; } ?>>27</option>\r\n		<option value="28" <?php if(date("d") == "28"){ echo "selected"; } ?>>28</option>\r\n		<option value="29" <?php if(date("d") == "29"){ echo "selected"; } ?>>29</option>\r\n		<option value="30" <?php if(date("d") == "30"){ echo "selected"; } ?>>30</option>\r\n		<option value="31" <?php if(date("d") == "31"){ echo "selected"; } ?>>31</option>\r\n	</select>\r\n	<select name="fmyear" id="fmyear">\r\n	    <option value = "2011" <?php if(date("Y") == "2011"){ echo "selected"; } ?>>2011</option>\r\n		<option value = "2012" <?php if(date("Y") == "2012"){ echo "selected"; } ?>>2012</option>\r\n		<option value = "2013" <?php if(date("Y") == "2013"){ echo "selected"; } ?>>2013</option>\r\n		<option value = "2014" <?php if(date("Y") == "2014"){ echo "selected"; } ?>>2014</option>\r\n		<option value = "2015" <?php if(date("Y") == "2015"){ echo "selected"; } ?>>2015</option>\r\n		<option value = "2016" <?php if(date("Y") == "2016"){ echo "selected"; } ?>>2016</option>\r\n		<option value = "2017" <?php if(date("Y") == "2017"){ echo "selected"; } ?>>2017</option>\r\n		<option value = "2018" <?php if(date("Y") == "2018"){ echo "selected"; } ?>>2018</option>\r\n		<option value = "2019" <?php if(date("Y") == "2019"){ echo "selected"; } ?>>2019</option>\r\n		<option value = "2020" <?php if(date("Y") == "2020"){ echo "selected"; } ?>>2020</option>\r\n	</select>\r\n<br/>To:<br/>\r\n	<select name="tomonth" id="tomonth">\r\n		<option value="01" <?php if(date("m") == "01"){ echo "selected"; } ?>>January</option>\r\n		<option value="02" <?php if(date("m") == "02"){ echo "selected"; } ?>>February</option>\r\n		<option value="03" <?php if(date("m") == "03"){ echo "selected"; } ?>>March</option>\r\n		<option value="04" <?php if(date("m") == "04"){ echo "selected"; } ?>>April</option>\r\n		<option value="05" <?php if(date("m") == "05"){ echo "selected"; } ?>>May</option>\r\n		<option value="06" <?php if(date("m") == "06"){ echo "selected"; } ?>>June</option>\r\n		<option value="07" <?php if(date("m") == "07"){ echo "selected"; } ?>>July</option>\r\n		<option value="08" <?php if(date("m") == "08"){ echo "selected"; } ?>>August</option>\r\n		<option value="09" <?php if(date("m") == "09"){ echo "selected"; } ?>>September</option>\r\n		<option value="10" <?php if(date("m") == "10"){ echo "selected"; } ?>>October</option>\r\n		<option value="11" <?php if(date("m") == "11"){ echo "selected"; } ?>>November</option>\r\n		<option value="12" <?php if(date("m") == "12"){ echo "selected"; } ?>>December</option>\r\n	</select>\r\n	<select name="today" id="today">\r\n		<option value="01" <?php if(date("d") == "01"){ echo "selected"; } ?>>01</option>\r\n		<option value="02" <?php if(date("d") == "02"){ echo "selected"; } ?>>02</option>\r\n		<option value="03" <?php if(date("d") == "03"){ echo "selected"; } ?>>03</option>\r\n		<option value="04" <?php if(date("d") == "04"){ echo "selected"; } ?>>04</option>\r\n		<option value="05" <?php if(date("d") == "05"){ echo "selected"; } ?>>05</option>\r\n		<option value="06" <?php if(date("d") == "06"){ echo "selected"; } ?>>06</option>\r\n		<option value="07" <?php if(date("d") == "07"){ echo "selected"; } ?>>07</option>\r\n		<option value="08" <?php if(date("d") == "08"){ echo "selected"; } ?>>08</option>\r\n		<option value="09" <?php if(date("d") == "09"){ echo "selected"; } ?>>09</option>\r\n		<option value="10" <?php if(date("d") == "10"){ echo "selected"; } ?>>10</option>\r\n		<option value="11" <?php if(date("d") == "11"){ echo "selected"; } ?>>11</option>\r\n		<option value="12" <?php if(date("d") == "12"){ echo "selected"; } ?>>12</option>\r\n		<option value="13" <?php if(date("d") == "13"){ echo "selected"; } ?>>13</option>\r\n		<option value="14" <?php if(date("d") == "14"){ echo "selected"; } ?>>14</option>\r\n		<option value="15" <?php if(date("d") == "15"){ echo "selected"; } ?>>15</option>\r\n		<option value="16" <?php if(date("d") == "16"){ echo "selected"; } ?>>16</option>\r\n		<option value="17" <?php if(date("d") == "17"){ echo "selected"; } ?>>17</option>\r\n		<option value="18" <?php if(date("d") == "18"){ echo "selected"; } ?>>18</option>\r\n		<option value="19" <?php if(date("d") == "19"){ echo "selected"; } ?>>19</option>\r\n		<option value="20" <?php if(date("d") == "20"){ echo "selected"; } ?>>20</option>\r\n		<option value="21" <?php if(date("d") == "21"){ echo "selected"; } ?>>21</option>\r\n		<option value="22" <?php if(date("d") == "22"){ echo "selected"; } ?>>22</option>\r\n		<option value="23" <?php if(date("d") == "23"){ echo "selected"; } ?>>23</option>\r\n		<option value="24" <?php if(date("d") == "24"){ echo "selected"; } ?>>24</option>\r\n		<option value="25" <?php if(date("d") == "25"){ echo "selected"; } ?>>25</option>\r\n		<option value="26" <?php if(date("d") == "26"){ echo "selected"; } ?>>26</option>\r\n		<option value="27" <?php if(date("d") == "27"){ echo "selected"; } ?>>27</option>\r\n		<option value="28" <?php if(date("d") == "28"){ echo "selected"; } ?>>28</option>\r\n		<option value="29" <?php if(date("d") == "29"){ echo "selected"; } ?>>29</option>\r\n		<option value="30" <?php if(date("d") == "30"){ echo "selected"; } ?>>30</option>\r\n		<option value="31" <?php if(date("d") == "31"){ echo "selected"; } ?>>31</option>\r\n	</select>\r\n	<select name="toyear" id="toyear">\r\n	    <option value = "2011" <?php if(date("Y") == "2011"){ echo "selected"; } ?>>2011</option>\r\n		<option value = "2012" <?php if(date("Y") == "2012"){ echo "selected"; } ?>>2012</option>\r\n		<option value = "2013" <?php if(date("Y") == "2013"){ echo "selected"; } ?>>2013</option>\r\n		<option value = "2014" <?php if(date("Y") == "2014"){ echo "selected"; } ?>>2014</option>\r\n		<option value = "2015" <?php if(date("Y") == "2015"){ echo "selected"; } ?>>2015</option>\r\n		<option value = "2016" <?php if(date("Y") == "2016"){ echo "selected"; } ?>>2016</option>\r\n		<option value = "2017" <?php if(date("Y") == "2017"){ echo "selected"; } ?>>2017</option>\r\n		<option value = "2018" <?php if(date("Y") == "2018"){ echo "selected"; } ?>>2018</option>\r\n		<option value = "2019" <?php if(date("Y") == "2019"){ echo "selected"; } ?>>2019</option>\r\n		<option value = "2020" <?php if(date("Y") == "2020"){ echo "selected"; } ?>>2020</option>\r\n	</select>\r\n	<br/>\r\n	<input type="submit" name="submit" value="Submit Date">\r\n</form>\r\n	   \r\n<table border=1>\r\n	<tr>\r\n    <th>\r\n	<p>Date</p>\r\n	</th>\r\n	<th>\r\n	<p>Amount</p>\r\n	</th>\r\n	<th>\r\n	<p>Description</p>\r\n	</th>\r\n	<th>\r\n	<p>Spender</p>\r\n	</th>\r\n	</tr>\r\n<?php	\r\nwhile($nt=mysql_fetch_array($result)){\r\necho "\r\n<tr>\r\n    <td>\r\n	$nt[date]\r\n	</td>\r\n	<td>\r\n	$nt[amount]\r\n	</td>\r\n	<td>\r\n	$nt[detail]\r\n	</td>\r\n	<td>\r\n	";\r\necho "$nt[whospend]" ? ''ELAINE'' : ''ME''; 	\r\necho "	\r\n	</td>\r\n</tr>\r\n";\r\n}\r\n?>\r\n</table>\r\n<table>\r\n<?php	\r\nwhile($Total=mysql_fetch_array($totalResult)){\r\necho "\r\n<tr>\r\n    <td>\r\n	$Total[Total]\r\n	</td>\r\n    <td>\r\n	$Total[code]\r\n	</td>	\r\n	</tr>";\r\n}\r\n?>\r\n</table>\r\n</body>\r\n</html>', 'MySpending', 'php', 'php'),
(117, 'number of characters found in a string before any part of the specified character', '<?php\r\necho "use of strcspn()";\r\necho "<br/>";\r\necho "Number of characters before ''w'' is: ".strcspn("Hello world!","w")." in ''Hello world!''";\r\necho "<br/>";\r\necho "Number of characters before ''wo'' is: ". strcspn("Hello world!","wo")." in ''Hello world!''";\r\n?>', 'M_strcspn', 'php', 'phpmenu'),
(114, 'add spending', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n<html>\r\n<head>\r\n<link type="text/css" rel="stylesheet" href="css/MyResource.css" />\r\n<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">\r\n<title></title>\r\n</head>\r\n<body>\r\n\r\n<?php include("AddSpending.txt"); ?>\r\n\r\n<form action="<?php echo $_SERVER[''SCRIPT_NAME'']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">\r\n<table>\r\n	<tr>\r\n    <th>\r\n	<p>Spender</p>\r\n	</th>\r\n	<th>\r\n	<p>Amount</p>\r\n	</th>\r\n	<th>\r\n	<p>Description</p>\r\n	</th>\r\n	</tr>\r\n	<tr>\r\n    <td align="right">\r\n	<select name="whospend" id="whospend">\r\n	   <option value="M" <?php if((isset($whospend) && htmlspecialchars($whospend) == "M") || !isset($whospend)) echo "selected"; ?>>Me</option>\r\n	   <option value="I" <?php if(isset($whospend) && htmlspecialchars($whospend) == "I") echo "selected"; ?>>Elaine</option>\r\n	 </select>	\r\n	</td>\r\n    <td align="right"><input type="text" name="amount" id="amount" size="5" maxlength="5"  onkeyup="ForceNumericInput(this,false);" style="border: 1px solid #38c;"  value="<?php if (isset($amount)){ echo htmlspecialchars($amount); } else ''''; ?>"></td>\r\n    <td align="right">\r\n	<select name="code" id="code" class="reqd" >\r\n	   <option value="Eat Out" <?php if(isset($code) && htmlspecialchars($code) == "Eat Out") echo "selected"; ?>>Eat Out</option>\r\n	   <option value="Family Entertainment" <?php if(isset($code) && htmlspecialchars($code) == "Family Entertainment") echo "selected"; ?>>Family Entertainment</option>\r\n	   <option value="Shopping" <?php if(isset($code) && htmlspecialchars($code) == "Shopping") echo "selected"; ?>>Shopping</option>\r\n	   <option value="Grocery" <?php if(isset($code) && htmlspecialchars($code) == "GE") echo "selected"; ?>>Grocery</option>\r\n	   <option value="Spend on Car" <?php if(isset($code) && htmlspecialchars($code) == "Spend on Car") echo "selected"; ?>>Spend on Car</option>\r\n	   <option value="Snack" <?php if(isset($code) && htmlspecialchars($code) == "Snack") echo "selected"; ?>>Snack</option>\r\n	   <option value="Electronic item" <?php if(isset($code) && htmlspecialchars($code) == "Electronic item") echo "selected"; ?>>Electronic item</option>\r\n	   <option value="Electricity and Water" <?php if(isset($code) && htmlspecialchars($code) == "Electricity and Water") echo "selected"; ?>>Electricity and Water</option>\r\n	   <option value="Insurance" <?php if(isset($code) && htmlspecialchars($code) == "Insurance") echo "selected"; ?>>Insurance</option>\r\n	   <option value="Party and Gift" <?php if(isset($code) && htmlspecialchars($code) == "Party and Gift") echo "selected"; ?>>Party and Gift</option>\r\n	   <option value="Kids Reward" <?php if(isset($code) && htmlspecialchars($code) == "Kids Reward") echo "selected"; ?>>Kids Reward</option>\r\n	   <option value="School" <?php if(isset($code) && htmlspecialchars($code) == "School") echo "selected"; ?>>School</option>\r\n	   <option value="Repair" <?php if(isset($code) && htmlspecialchars($code) == "Repair") echo "selected"; ?>>Repair</option>\r\n	   <option value="Heathy Food" <?php if(isset($code) && htmlspecialchars($code) == "Heathy Food") echo "selected"; ?>>Heathy Food</option>\r\n	   <option value="Unexpected(others)" <?php if(isset($code) && htmlspecialchars($code) == "Unexpected(others)") echo "selected"; ?>>Unexpected(others)</option>\r\n	   <option value="Consumer Gas" <?php if(isset($code) && htmlspecialchars($code) == "Consumer Gas") echo "selected"; ?>>Consumer Gas</option>\r\n	   <option value="Property Tax" <?php if(isset($code) && htmlspecialchars($code) == "Property Tax") echo "selected"; ?>>Property Tax</option>\r\n	   <option value="Home Phone" <?php if(isset($code) && htmlspecialchars($code) == "Home Phone") echo "selected"; ?>>Home Phone</option>\r\n	   <option value="Cellular Phone" <?php if(isset($code) && htmlspecialchars($code) == "Cellular Phone") echo "selected"; ?>>Cellular Phone</option>\r\n	   <option value="Internet" <?php if(isset($code) && htmlspecialchars($code) == "Internet") echo "selected"; ?>>Internet</option>\r\n	   <option value="Television" <?php if(isset($code) && htmlspecialchars($code) == "Television") echo "selected"; ?>>Television</option>\r\n	   <option value="Mortgage" <?php if(isset($code) && htmlspecialchars($code) == "MG") echo "selected"; ?>>Mortgage</option>\r\n	   <option value="Money to Elaine" <?php if(isset($code) && htmlspecialchars($code) == "Money to Elaine") echo "selected"; ?>>Money to Elaine</option>\r\n	 </select>		\r\n	</td>	\r\n   </tr> \r\n  <tr>\r\n    <td colspan="3" align="left"><input type="text" name="detail" size="50" maxlength="200" style="border: 1px solid #38c;"  value="<?php if (isset($detail)){ echo htmlspecialchars($detail); } else ''''; ?>"></td>\r\n  </tr>   \r\n</table>\r\n<input type="Submit" name="Save" value="Save">\r\n<input type="button" name="Cancel" value="Cancel" onClick="window.open( ''MySpending.php'', ''_top'');return false;">\r\n</form>\r\n<p text-align="right" ><font color=red><b><?php if (isset($ErrorMessage)){ echo ''**''.htmlspecialchars($ErrorMessage).''**   ''; } else ''''; ?></b></font></p><br>\r\n</body>\r\n</html>', 'AddSpending', 'php', ''),
(115, 'case-insensitive string comparison', '<?php\r\n$string1=''ww3resource'';\r\n$string2=''W3resource'';\r\n$result=strcasecmp($string1,$string2);\r\necho ''The result for "ww3resource" in a case-insensitive string comparison with "W3resource" is:''. $result;\r\necho "<br/>";\r\n$var1 = "Hello";\r\n$var2 = "hello";\r\nif (strcasecmp($var1, $var2) == 0) {\r\n    echo ''$var1 is equal to $var2 in a case-insensitive string comparison'';\r\n}\r\n\r\n?>', 'M_strcasecmp', 'php', 'phpmenu'),
(116, 'string comparison', '<?php\r\n$pw1 = "yeah";\r\n$pw2 = "yeah";\r\necho ''Returns < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal. '';\r\necho "<br/>";\r\nif (strcmp($pw1, $pw2) == 0) {   // This returns false.\r\n    echo ''$pw1 and $pw2 are the same.'';\r\n} else {\r\n    echo ''$pw1 and $pw2 are NOT the same.'';\r\n}\r\necho "<br/>";\r\nif (strcmp($pw1, $pw2)) {   // This returns false.\r\n    echo ''$pw1 and $pw2 are the same.'';\r\n} else {\r\n    echo ''$pw1 and $pw2 are NOT the same.'';\r\n}\r\necho "<br/>";\r\n//Where the use of the == operator would give us.:\r\nif ($pw1==$pw2) {    // This returns true.\r\n    echo ''$pw1 and $pw2 are the same.'';\r\n} else {\r\n    echo ''$pw1 and $pw2 are NOT the same.'';\r\n}', 'M_strcmp', 'php', 'phpmenu'),
(118, 'Strip HTML and PHP tags from a string,strip BBCode', '<?php\r\necho "use of strip_tags(string,allow) ";\r\necho "<br/>";\r\necho strip_tags("Hello <b>world!</b>");\r\necho "<br/>";\r\necho strip_tags("Hello <b><i>world!</i></b>","<b>");\r\necho "<br/>";\r\necho "simple way to strip BBCode:";\r\necho "<br/>";\r\n$bbcode_str = "Here is some [b]bold text[/b] and some [color=#FF0000]red text[/color]!";\r\necho $bbcode_str;\r\necho "<br/>";\r\n$plain_text = strip_tags(str_replace(array(''['','']''), array(''<'',''>''), $bbcode_str));\r\necho $plain_text;\r\necho "<br/>";\r\necho ''Note that strip_tags may stumble when it encounters two consecutive quotes. Regardless of whether that\\''s a bug or a feature (different PHP versions seem to behave differently) here\\''s a workaround:'';\r\n  $wtf = ''\r\n    <p>First line</p>\r\n    <a href=\\"foo">bar</a>\r\n    <p>Second line</p>\r\n    <a href=\\"foo\\"">bar</a>\r\n    <p>Third line</p>\r\n  '';\r\n  echo ''Raw: '' . $wtf . "<br/>";\r\n  echo ''strip_tags(): '' . strip_tags ($wtf);\r\n  echo "<br/>";\r\n  echo ''Regexp: '' . preg_replace (''/<[^>]*>/'', '''', $wtf);\r\n?>', 'M_strip_tags', 'php', 'phpmenu'),
(119, 'removes backslashes,stripslashes', '<?php\r\necho ''stripcslashes() skips special character sets like "\\n" and "\\r", preserving any line breaks, return carriages, etc. that may be in the string. stripslashes() simply removes any slashes it encounters without parsing anything beforehand.'';\r\necho "<br/>";\r\necho ''stripcslashes("Hello, \\my na\\me is Kai Ji\\m.");'';\r\necho "<br/>";\r\necho stripcslashes("Hello, \\my na\\me is Kai Ji\\m.");\r\necho "<br/>";\r\n?>', 'M_stripcslashes', 'php', 'phpmenu'),
(120, 'Find position of first occurrence of a case-insensitive string', '<?php\r\necho ''stripos("Hello world!","WO");'';\r\necho stripos("Hello world!","WO");\r\necho "<br/>";\r\n$findme    = ''a'';\r\n$mystring1 = ''xyz'';\r\n$mystring2 = ''ABCA'';\r\n\r\n$pos1 = stripos($mystring1, $findme);\r\n$pos2 = stripos($mystring2, $findme);\r\n\r\n// Nope, ''a'' is certainly not in ''xyz''\r\nif ($pos1 === false) {\r\n    echo "The string ''$findme'' was not found in the string ''$mystring1''";\r\n    echo "<br/>";\r\n}\r\n\r\n// Note our use of ===.  Simply == would not work as expected\r\n// because the position of ''a'' is the 0th (first) character.\r\nif ($pos2 !== false) {\r\n    echo "We found ''$findme'' in ''$mystring2'' at position $pos2";\r\n    echo "<br/>";\r\n}\r\n?>', 'M_stripos', 'php', 'phpmenu'),
(121, 'Translate characters or replace substrings, stristr , translates certain characters in a string', '<?php\r\necho ''stristr("Hello world!","WORLD");'';\r\necho stristr("Hello world!","WORLD");\r\necho "<br/>";\r\n$unencripted = "hello";\r\n$from = "abcdefghijklmnopqrstuvwxyz";\r\n$to =    "zyxwvutsrqponmlkjihgfedcba";\r\n$temp = strtr($unencripted, $from, $to);\r\necho $temp;\r\necho "<br/>";\r\necho ''strtr("svool", $from, $to);'';\r\necho "<br/>";\r\necho strtr("svool", $from, $to);\r\necho "<br/>";\r\necho ''To convert special chars to their html entities strtr you can use strtr in conjunction with get_html_translation_table(HTML_ENTITIES) :'';\r\necho "<br/>";\r\necho "<br/>";\r\necho "<br/>";\r\n$trans = get_html_translation_table(HTML_ENTITIES);\r\n$html_code = strtr($html_code, $trans); \r\n\r\necho ''Here is a function to convert middle-european windows charset (cp1250) to the charset, that php script is written in:'';\r\n    function cp1250_to_utf2($text){\r\n        $dict  = array(chr(225) => ''á'', chr(228) =>  ''ä'', chr(232) => ''&#269;'', chr(239) => ''&#271;'',\r\n            chr(233) => ''é'', chr(236) => ''&#283;'', chr(237) => ''í'', chr(229) => ''&#314;'', chr(229) => ''&#318;'',\r\n            chr(242) => ''&#328;'', chr(244) => ''ô'', chr(243) => ''ó'', chr(154) => ''š'', chr(248) => ''&#345;'',\r\n            chr(250) => ''ú'', chr(249) => ''&#367;'', chr(157) => ''&#357;'', chr(253) => ''ý'', chr(158) => ''ž'',\r\n            chr(193) => ''Á'', chr(196) => ''Ä'', chr(200) => ''&#268;'', chr(207) => ''&#270;'', chr(201) => ''É'',\r\n            chr(204) => ''&#282;'', chr(205) => ''Í'', chr(197) => ''&#313;'',    chr(188) => ''&#317;'', chr(210) => ''&#327;'',\r\n            chr(212) => ''Ô'', chr(211) => ''Ó'', chr(138) => ''Š'', chr(216) => ''&#344;'', chr(218) => ''Ú'',\r\n            chr(217) => ''&#366;'', chr(141) => ''&#356;'', chr(221) => ''Ý'', chr(142) => ''Ž'',\r\n            chr(150) => ''-'');\r\n        return strtr($text, $dict);\r\n    }\r\n?>', 'M_strtr', 'php', 'phpmenu'),
(122, 'Get string length', '<?php\r\necho ''strlen("Hello world!");'';\r\necho "<br/>";\r\necho strlen("Hello world!");\r\necho "<br/>";\r\necho ''Beware: strlen() counts new line characters at the end of a string, too! '';\r\necho "<br/>";\r\necho ''strlen("123\\n");'';\r\necho "<br/>";\r\n$a = "123\\n";\r\necho "<p>".strlen($a)."</p>"; \r\necho "<br/>";\r\n?>', 'M_strlen', 'php', 'phpmenu'),
(123, 'compares two strings like human case insensitive', '<?php\r\necho "string ''2Hello world!'' is less than: ''10Hello world!''";\r\necho "<br />";\r\necho strnatcasecmp("2Hello world!","10Hello world!");\r\necho "<br />";\r\necho "string ''10Hello world!'' is greater than: ''2Hello world!''";\r\necho "<br />";\r\necho strnatcasecmp("10Hello world!","2Hello world!");\r\n?> 		', 'M_strnatcasecmp', 'php', ''),
(124, 'String comparisons like human case sensitive', '<?php\r\necho "string ''2Hello world!'' is less than: ''10Hello world!''";\r\necho "<br />";\r\necho strnatcmp("2Hello world!","10Hello world!");\r\necho "<br />";\r\necho "string ''10Hello world!'' is greater than: ''2Hello world!''";\r\necho "<br />";\r\necho strnatcmp("10Hello world!","2Hello world!");\r\necho "<br />";\r\necho "string ''Hello world!'' is less than: ''hello world!''";\r\necho "<br />";\r\necho strnatcmp("Hello world!","hello world!");\r\necho "<br />";\r\necho "string ''10hello world!'' is less than: ''12Hello world!''";\r\necho "<br />";\r\necho strnatcmp("10hello world!","12Hello world!");\r\n\r\n?>', 'M_strnatcmp', 'php', 'phpmenu'),
(125, 'case-insensitive string comparison of the first n characters', '<?php\r\necho strncasecmp("Hello world!","hello earth!",6);\r\necho "<br/>";\r\nif (!strncasecmp("Hello world!", ''hello earth!'', 4)){\r\n       echo "true";\r\n}\r\n\r\n?>', 'M_strncasecmp', 'php', 'phpmenu'),
(126, 'string comparison of the first n characters', '<?php\r\necho strncmp("Hello world!","hello earth!",6);\r\necho "<br/>";\r\nif (!strncmp("Hello world!", ''hello earth!'', 4)){\r\n       echo "true";\r\n}\r\nelse echo "false";\r\n?>', 'M_strncmp', 'php', 'phpmenu'),
(127, 'searches a string for any of the specified characters', '<?php\r\necho ''This function returns the rest of the string from where it found the first occurrence of a specified character, otherwise it returns FALSE.'';\r\necho "<br/>";\r\n$text = ''This is a Simple text.'';\r\n\r\n// this echoes "is is a Simple text." because ''i'' is matched first\r\necho ''strpbrk($text, "mi");'';\r\necho "<br/>";\r\necho strpbrk($text, "mi");\r\necho "<br/>";\r\n\r\n// this echoes "Simple text." because chars are case sensitive\r\necho ''strpbrk($text, "S");'';\r\necho "<br/>";\r\necho strpbrk($text, "S");\r\necho "<br/>";\r\n\r\n?>', 'M_strpbrk', 'php', 'phpmenu'),
(128, 'Find position of first occurrence of a string case sensitive, get content between marker', '<?php\r\necho ''strrpos("Hello world!","wo");'';\r\necho "<br/>";\r\necho strrpos("Hello world!","wo");\r\n\r\n?>', 'M_strpos', 'php', 'phpmenu'),
(129, 'finds the position of the last occurrence of a string within another string, and returns all charact', '<?php\r\necho ''strrchr("Hello world! this is the world we are living in","world");'';\r\necho "<br/>";\r\necho strrchr("Hello world! this is the world we are living in","world");\r\necho "<br/>";\r\n?> 		', 'M_strrchr', 'php', 'phpmenu'),
(130, 'reverses a string', '<?php\r\necho ''strrev("Hello World!");'';\r\necho "<br/>";\r\necho strrev("Hello World!");\r\necho "<br/>";\r\necho ''Add commas to numbers: 1500000.1254'';\r\necho "<br/>";\r\necho commafy("1500000.1254"); // prints 1,500,000.1254\r\necho "<br/>";\r\nfunction commafy($_) {\r\n        return strrev( (string)preg_replace( ''/(\\d{3})(?=\\d)(?!\\d*\\.)/'', ''$1,'' , strrev( $_ ) ) );\r\n}\r\n\r\n?>', 'M_strrev', 'php', 'phpmenu'),
(131, 'Find position of last occurrence of a case-insensitive string in a string', '<?php\r\necho "you can compare this with ''stripos()'' function";\r\necho "<br/>";\r\necho ''strripos("Hello world!","WO");'';\r\necho strripos("Hello world!","WO");\r\necho "<br/>";\r\n$findme    = ''a'';\r\n$mystring1 = ''xyz'';\r\n$mystring2 = ''ABCA'';\r\n\r\n$pos1 = strripos($mystring1, $findme);\r\n$pos2 = strripos($mystring2, $findme);\r\n\r\n// Nope, ''a'' is certainly not in ''xyz''\r\nif ($pos1 === false) {\r\n    echo "The string ''$findme'' was not found in the string ''$mystring1''";\r\n    echo "<br/>";\r\n}\r\n\r\n// Note our use of ===.  Simply == would not work as expected\r\n// because the position of ''a'' is the 0th (first) character.\r\nif ($pos2 !== false) {\r\n    echo "We found ''$findme'' in ''$mystring2'' at position $pos2";\r\n    echo "<br/>";\r\n}\r\n?>', 'M_strripos', 'php', 'phpmenu'),
(132, 'find the position of the occurrence of a string inside another string,case-sensitive', '<?php\r\necho ''strrpos("Hello world!","wo");'';\r\necho "<br/>";\r\necho strrpos("Hello world!","wo");\r\necho "<br/>";\r\n?>', 'M_strrpos', 'php', 'phpmenu'),
(133, 'sub programe for MySpending.php', '<?php\r\n$result = mysql_query($GetDisplay) or die(mysql_error());\r\n\r\nwhile($row = mysql_fetch_array($result))\r\n{\r\n $searchID=$row[''id''];\r\n $detail=$row[''detail''];\r\n $whospend = $row[''whospend''];\r\n $amount =  $row[''amount''];\r\n $code =  $row[''code''];\r\n $date =  $row[''date''];\r\n} \r\n?>\r\n		', 'MySpending2', 'php', 'php');
INSERT INTO `main` (`id`, `ShortDesc`, `Source`, `Name`, `Ext`, `SearchGroup`) VALUES
(134, 'sub programe for Addspending.php', '<?php\r\nif (get_magic_quotes_gpc())\r\n{\r\n    function _stripslashes_rcurs($variable, $top = true)\r\n    {\r\n        $clean_data = array();\r\n        foreach ($variable as $key => $value)\r\n        {\r\n            $key = ($top) ? $key : stripslashes($key);\r\n            $clean_data[$key] = (is_array($value)) ?\r\n                stripslashes_rcurs($value, false) : stripslashes($value);\r\n        }\r\n        return $clean_data;\r\n    }\r\n    $_GET = _stripslashes_rcurs($_GET);\r\n    $_POST = _stripslashes_rcurs($_POST);\r\n}\r\nif(isset($_POST[''Save'']))\r\n{\r\n	include("config.php");\r\n	$detail =  mysql_real_escape_string($_POST[''detail'']);\r\n	$whospend = mysql_real_escape_string($_POST[''whospend'']);\r\n	$amount =  (int)mysql_real_escape_string($_POST[''amount'']);\r\n	$code =  mysql_real_escape_string($_POST[''code'']);\r\n			mysql_query("INSERT INTO spending(detail,whospend,amount,code,date) VALUES(''$detail'', ''$whospend'', ''$amount'',''$code'',NOW())");\r\n			$GetDisplay = "SELECT * FROM spending order by id DESC LIMIT 1";\r\n			include("MySpending.txt");\r\n			$inTwoMonths = 60 * 60 * 24 * 60 + time();\r\n			setcookie( "searchID2", $searchID, $inTwoMonths, "", "", false, true );\r\n			mysql_close();\r\necho <<<_END\r\n<script type="text/javascript">\r\nwindow.open( ''MySpending.php'', ''_top'');\r\n</script>\r\n_END;\r\n\r\n}\r\n?>', 'AddSpending2', 'php', 'php'),
(135, 'Finds the length of the initial segment of a string consisting entirely of characters contained with', '<?php\r\necho ''strspn("this is number of 42 is the answer to the 128th question.", "1234567890");'';\r\n$var = strspn("this is number of 42 is the answer to the 128th question.", "1234567890");\r\necho "<br/>";\r\necho $var;\r\necho "<br/>";\r\necho ''strspn("42 is the answer to the 128th question.", "1234567890");'';\r\necho "<br/>";\r\n$var = strspn("42 is the answer to the 128th question.", "1234567890");\r\necho $var;\r\necho "<br/>";\r\necho ''strspn("Hello world!","kHlleo");'';\r\necho "<br/>";\r\necho strspn("Hello world!","kHlleo");\r\necho "<br/>";\r\necho ''strspn("hHello world!","kHlleo");'';\r\necho "<br/>";\r\necho strspn("hHello world!","kHlleo");\r\n\r\n?>', 'M_strspn', 'php', 'phpmenu'),
(136, 'Find first occurrence of a string', '<?php\r\necho strstr("Hello world!","world");\r\n?> 		', 'M_strstr', 'php', 'phpmenu'),
(137, 'File Download', '<html>\r\n<head>\r\n<title>File Download Example</title>\r\n\r\n</head>\r\n<body>\r\nFile download example:<br/>\r\n<!--- <a href="../PHP/fileDownload.php?download_file=cript.php">Download here</a> -->\r\n<form action="../PHP/fileDownload.php" method="GET">\r\nFile Name for download:<input type="text" name="download_file" id=''download_file''>\r\n<input type="submit" name="Download" value="Start Download">\r\n</form>\r\n</body>\r\n</html>', 'fileDownload', 'html', 'html'),
(138, 'File Download', '<?php\r\n/********************** This program is called by fileDownload.html **********************/\r\n// place this code inside a php file and call it f.e. "download.php"\r\n$path = $_SERVER[''DOCUMENT_ROOT'']."/"; // change the path to fit your websites document structure\r\n$fullPath = $path.$_GET[''download_file''];\r\nif ($fd = fopen ($fullPath, "r")) {\r\n    $fsize = filesize($fullPath);\r\n    $path_parts = pathinfo($fullPath);\r\n    $ext = strtolower($path_parts["extension"]);\r\n    switch ($ext) {\r\n        case "pdf":\r\n        header("Content-type: application/pdf"); // add here more headers for diff. extensions\r\n        header("Content-Disposition: attachment; filename=\\"".$path_parts["basename"]."\\""); // use ''attachment'' to force a download\r\n        break;\r\n        default;\r\n        header("Content-type: application/octet-stream");\r\n        header("Content-Disposition: filename=\\"".$path_parts["basename"]."\\"");\r\n    }\r\n    header("Content-length: $fsize");\r\n    header("Cache-control: private"); //use this to open files directly\r\n    while(!feof($fd)) {\r\n        $buffer = fread($fd, 2048);\r\n        echo $buffer;\r\n    }\r\n}\r\n\r\nfclose ($fd);\r\nexit;\r\n?>', 'fileDownload', 'php', 'php'),
(170, 'returns a single character from an open file', '<?php\r\n$file = fopen("date.txt","r");\r\n\r\nwhile (! feof ($file))\r\n  {\r\n  echo fgetc($file);\r\n  }\r\n\r\nfclose($file);\r\n\r\n?>', 'M_fgetc', 'php', 'phpmenu'),
(139, 'Tokenize string,Split a string by charactor', '<?PHP\r\necho ''You can do things with strtok that you can\\''t do with explode/split. explode breaks a string using another string, split breaks a string using a regular expression.  strtok breaks a string using single _characters_ , but the best part is you can use multiple characters at the same time.\r\n\r\nFor example, if you are accepting user input and aren\\''t sure how the user will decide to divide up their data you could choose to tokenize on spaces, hyphens, slashes and backslashes ALL AT THE SAME TIME:\r\n'';\r\necho "<br/>";\r\n$teststr = "blah1 blah2/blah3-blah4\\\\blah5";\r\n\r\n$tok = strtok($teststr," /-\\\\");\r\nwhile ($tok !== FALSE)\r\n{\r\n  $toks[] = $tok;\r\n  $tok = strtok(" /-\\\\");\r\n}\r\n\r\nwhile (list($k,$v) = each($toks))\r\n{\r\n  echo ("$k => $v<BR/>");\r\n}\r\n\r\n?>', 'M_strtok', 'php', 'phpmenu'),
(140, 'converts a string to lowercase', '<?php\r\necho ''strtolower("Hello WORLD.");'';\r\necho "<br/>";\r\necho strtolower("Hello WORLD.");\r\n?> 		', 'M_strtolower', 'php', 'phpmenu'),
(141, 'converts a string to uppercase', '<?php\r\necho ''strtoupper("Hello WORLD!");'';\r\necho "<br/>";\r\necho strtoupper("Hello WORLD!");\r\n?> 		', 'M_strtoupper', 'php', 'phpmenu'),
(142, 'returns a part of a string', '<?php\r\n    // both lines will output the 3rd character\r\n    echo ''$my_string = "this is a testing";'';\r\n    echo "<br/>";\r\n    $my_string = "this is a testing";\r\n    echo ''substr($my_string, 2, 1);'';\r\n    echo "<br/>";\r\n    echo substr($my_string, 2, 1);\r\n    echo "<br/>";\r\n    echo ''$my_string{2}; '';\r\n    echo "<br/>";\r\n    echo $my_string{2};\r\n    echo "<br/>";\r\n\r\n?>', 'M_substr', 'php', 'phpmenu'),
(143, 'compares two strings from a specified start position', '<?php\r\necho ''\r\n    0 - if the two strings are equal<br/>\r\n    <0 - if string1 (from startpos) is less than string2<br/>\r\n    >0 - if string1 (from startpos) is greater than string2'';\r\necho "<br/>";\r\necho ''substr_compare("abcde", "bc", 1, 2);'';\r\necho "<br/>";\r\necho substr_compare("abcde", "bc", 1, 2); \r\necho "<br/>";\r\necho ''substr_compare("abcde", "de", -2, 2);'';\r\necho "<br/>";\r\necho substr_compare("abcde", "de", -2, 2);\r\necho "<br/>";\r\necho ''substr_compare("abcde", "bcg", 1, 2);'';\r\necho "<br/>";\r\necho substr_compare("abcde", "bcg", 1, 2);\r\necho "<br/>";\r\necho ''substr_compare("abcde", "BC", 1, 2, true);'';\r\necho "<br/>";\r\necho substr_compare("abcde", "BC", 1, 2, true);\r\necho "<br/>";\r\necho ''substr_compare("abcde", "bc", 1, 3);'';\r\necho "<br/>";\r\necho substr_compare("abcde", "bc", 1, 3);\r\necho "<br/>";\r\necho ''substr_compare("abcde", "cd", 1, 2);'';\r\necho "<br/>";\r\necho substr_compare("abcde", "cd", 1, 2);\r\necho "<br/>";\r\necho ''substr_compare("abcde", "abc", 5, 1);'';\r\necho "<br/>";\r\necho substr_compare("abcde", "abc", 5, 1);\r\necho "<br/>";\r\n?>', 'M_substr_compare', 'php', 'phpmenu'),
(144, 'counts the number of times a substring occurs in a string', '<?php\r\necho ''substr_count("Hello world. The world is nice","world");'';\r\necho "<br/>";\r\necho substr_count("Hello world. The world is nice","world");\r\necho "<br/>";\r\n?> \r\n		', 'M_substr_count', 'php', 'phpmenu'),
(145, 'replaces a part of a string with another string,check file chmod value', '<?php\r\necho ''check file chmod value of ResultDisp.php'';\r\necho "<br/>";\r\n$file = "../ResultDisp.php";\r\n$rights = decoct(fileperms($file));\r\necho "File rights: ".substr_replace($rights, "", 0, 3);\r\n\r\n?>', 'M_substr_replace', 'php', 'phpmenu'),
(146, 'emoves whitespaces and other predefined characters from both sides of a string', '<html>\r\n<body>\r\n<?php\r\n$str = "         Hello World!               ";\r\necho "<pre>";\r\necho "Without trim: " . $str;\r\necho "<br />";\r\necho "With trim: " . trim($str);\r\necho "</pre>";\r\n?>\r\n<body>\r\n<html>', 'M_trim', 'php', 'phpmenu'),
(147, 'converts the first character of a string to uppercase', '<?php\r\necho ''ucfirst("hello world");'';\r\necho "<br/>";\r\necho ucfirst("hello world");\r\necho "<br/>";\r\n?>', 'M_ucfirst', 'php', 'phpmenu'),
(148, 'Uppercase the first character of each word in a string', '<?php\r\necho ''ucwords("hello world");'';\r\necho "<br/>";\r\necho ucwords("hello world");\r\n?> 		', 'M_ucwords', 'php', 'phpmenu'),
(149, 'wraps a string into new lines when it reaches a specific length', '<?php\r\necho "<pre>";\r\necho ''wordwrap(string,width,break,cut) '';\r\necho "<br/>";\r\necho ''$str = "An example on a long word is: Supercalifragulistic";'';\r\necho "<br/>";\r\n$str = "An example on a long word is: Supercalifragulistic";\r\necho "<br/>";\r\necho ''wordwrap($str,15);'';\r\necho "<br/>";\r\necho wordwrap($str,15);\r\necho "<br/>";\r\necho "<br/>";\r\necho ''wordwrap($str,15,"<br />\\n");'';\r\necho "<br/>";\r\necho wordwrap($str,15,"<br />\\n");\r\necho "<br/>";\r\necho ''echo wordwrap($str,15,"<br />\\n",TRUE);'';\r\necho "<br/>";\r\necho wordwrap($str,15,"<br />\\n",TRUE);\r\necho "<br/>";\r\necho "</pre>";\r\n?>', 'M_wordwrap', 'php', 'phpmenu'),
(150, 'Change directory', '<?php\r\n$path="../PHP";\r\nchdir($path);\r\necho getcwd();\r\necho "<br/>";\r\n$path="../PHP/";\r\nchdir($path);\r\necho getcwd();\r\n\r\n?>', 'M_chdir', 'php', 'phpmenu'),
(151, 'Open directory handle,Directory and file list', '<?php\r\necho ''function that prints out everything from the starting path to the end'';\r\necho "<br/>";\r\nmap_dirs("../",0);\r\n\r\nfunction map_dirs($path,$level) {\r\n        if(is_dir($path)) {\r\n                if($contents = opendir($path)) {\r\n                        while(($node = readdir($contents)) !== false) {\r\n                                if($node!="." && $node!="..") {\r\n                                        for($i=0;$i<$level;$i++) echo "  ";\r\n                                        if(is_dir($path."/".$node)) echo "../"; else echo " ";\r\n                                        echo $node."<br/>";\r\n                                        map_dirs("$path/$node",$level+1);\r\n                                }\r\n                        }\r\n                }\r\n        }\r\n}\r\n?>', 'M_opendir', 'php', 'phpmenu'),
(152, 'directory list and a clickable link to run the files', '<?php\r\necho ("<h1>Directory Overzicht:</h1>");\r\n\r\nfunction getFiles($path) {\r\n   //Function takes a path, and returns a numerically indexed array of associative arrays containing file information,\r\n   //sorted by the file name (case insensitive).  If two files are identical when compared without case, they will sort\r\n   //relative to each other in the order presented by readdir()\r\n   $files = array();\r\n   $fileNames = array();\r\n   $i = 0;\r\n  \r\n   if (is_dir($path)) {\r\n       if ($dh = opendir($path)) {\r\n           while (($file = readdir($dh)) !== false) {\r\n               if ($file == "." || $file == "..") continue;\r\n               $fullpath = $path . "/" . $file;\r\n               $fkey = strtolower($file);\r\n               while (array_key_exists($fkey,$fileNames)) $fkey .= " ";\r\n               $a = stat($fullpath);\r\n               $files[$fkey][''size''] = $a[''size''];\r\n               if ($a[''size''] == 0) $files[$fkey][''sizetext''] = "-";\r\n               else if ($a[''size''] > 1024) $files[$fkey][''sizetext''] = (ceil($a[''size'']/1024*100)/100) . " K";\r\n               else if ($a[''size''] > 1024*1024) $files[$fkey][''sizetext''] = (ceil($a[''size'']/(1024*1024)*100)/100) . " Mb";\r\n               else $files[$fkey][''sizetext''] = $a[''size''] . " bytes";\r\n               $files[$fkey][''name''] = $file;\r\n               $files[$fkey][''type''] = filetype($fullpath);\r\n               $fileNames[$i++] = $fkey;\r\n           }\r\n           closedir($dh);\r\n       } else die ("Cannot open directory:  $path");\r\n   } else die ("Path is not a directory:  $path");\r\n   sort($fileNames,SORT_STRING);\r\n   $sortedFiles = array();\r\n   $i = 0;\r\n   foreach($fileNames as $f) $sortedFiles[$i++] = $files[$f];\r\n  \r\n   return $sortedFiles;\r\n}\r\n\r\n$files = getFiles("./");\r\nforeach ($files as $file) print "&nbsp;&nbsp;&nbsp;&nbsp;<b><a href=\\"$file[name]\\">$file[name]</a></b><br>\\n";\r\n?>', 'fileDownload2', 'php', ''),
(153, 'Read entry from directory handle, random image display', '<?php\r\nif ($handle = opendir(''../images/'')) {\r\n   $dir_array = array();\r\n    while (false !== ($file = readdir($handle))) {\r\n        if($file!="." && $file!=".."){\r\n            $dir_array[] = $file;\r\n        }\r\n    }\r\n    $name = $dir_array[rand(0,count($dir_array)-1)];\r\n	echo "<img src=''../images/$name'' alt=''Angry face'' />";\r\n	\r\n    closedir($handle);\r\n}\r\n?>', 'M_readdir', 'php', 'phpmenu'),
(154, 'resets the directory handle opened by opendir()', '<?php\r\n//Open images directory\r\n$dir = opendir("../images");\r\necho getcwd();\r\necho "<br/>";\r\n//List files in images directory\r\nwhile (($file = readdir($dir)) !== false)\r\n  {\r\n  echo "filename: " . $file . "<br />";\r\n  }\r\n\r\n//Resets the directory stream\r\nrewinddir($dir);\r\n\r\n//Code to check for changes\r\n\r\nclosedir($dir);\r\necho getcwd();\r\necho "<br/>";\r\n?>', 'rewinddir', 'php', 'phpmenu'),
(155, 'returns an array of files and directories inside a specified path', '<?php\r\necho ''print_r(scandir("../images"));'';\r\necho "<br/>";\r\nprint_r(scandir("../images"));\r\necho "<br/>";\r\n?> 		', 'M_scandir', 'php', 'phpmenu'),
(157, 'returns the filename from a path', '<?php\r\n$path = "../PHP/ResultDisp.php";\r\n\r\n//Show filename with file extension\r\necho basename($path) ."<br/>";\r\n\r\n//Show filename without file extension\r\necho basename($path,".php");\r\n?> 		', 'M_basename', 'php', 'phpmenu'),
(158, 'submit with image', '<?php\r\nif ( isset( $_POST[''submit_x''] ) )\r\n{\r\n    echo "You submited with the image button!";\r\n}\r\nELSEIF(isset($_POST[''Save'']))\r\n{\r\necho "You submited with the Save button!";\r\n}\r\n?>\r\n\r\n<form action="" method="post">\r\n<input	type="image" name="submit"	src="../images/save.jpg" />\r\n<input type="submit" name="Save" value="Save">\r\n</form>', 'imageSubmit', 'php', 'php'),
(159, 'Changes file group', '<?php\r\necho ''Only the superuser may change the group of a file arbitrarily; other users may change the group of a file to any group of which that user is a member. '';\r\necho ''<br/>'';\r\n$filename = ''date.txt'';\r\n$format = "%s''s Group ID @ %s: %d\\n";\r\nprintf($format, $filename, date(''r''), filegroup($filename));\r\necho ''<br/>'';\r\nchgrp($filename, 8);\r\n//chgrp($filename, "admin");\r\nclearstatcache(); // do not cache filegroup() results\r\nprintf($format, $filename, date(''r''), filegroup($filename));\r\necho ''<br/>'';\r\n?>', 'M_chgrp', 'php', 'phpmenu'),
(160, 'Changes file mode', '<?php\r\necho ''Changes directories/file mode recursive in $pathname to $filemode'';\r\necho ''<pre>\r\n$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pathname), RecursiveIteratorIterator::SELF_FIRST);\r\n\r\nforeach($iterator as $item) {\r\n    chmod($item, $filemode);\r\n}\r\n\r\nUsefull reference:\r\n\r\nValue    Permission Level\r\n400    Owner Read\r\n200    Owner Write\r\n100    Owner Execute\r\n40    Group Read\r\n20    Group Write\r\n10    Group Execute\r\n4    Global Read\r\n2    Global Write\r\n1    Global Execute\r\n</pre>'';\r\n?>', 'M_chmod', 'php', 'phpmenu'),
(161, 'changes the owner of the specified file', '<?php\r\necho ''Only the superuser may change the owner of a file.'';	\r\nchown("date.txt","charles")\r\n?> 	', 'M_chown', 'php', ''),
(162, 'clears the file status cache', '<pre>\r\nPHP caches data for some functions for better performance. If a file is being checked several times in a script, you might want to avoid caching to get correct results. To do this, use the clearstatcache() function.\r\n\r\nTip: Functions that are caching:\r\n\r\n    stat()\r\n    lstat()\r\n    file_exists()\r\n    is_writable()\r\n    is_readable()\r\n    is_executable()\r\n    is_file()\r\n    is_dir()\r\n    is_link()\r\n    filectime()\r\n    fileatime()\r\n    filemtime()\r\n    fileinode()\r\n    filegroup()\r\n    fileowner()\r\n    filesize()\r\n    filetype()\r\n    fileperms()\r\n</pre>	\r\n<?php\r\n//check filesize\r\necho filesize("date.txt");\r\necho "<br />";\r\n\r\n$file = fopen("date.txt", "a+");\r\n// truncate file\r\nftruncate($file,100);\r\nfclose($file);\r\n\r\n//Clear cache and check filesize again\r\nclearstatcache();\r\necho filesize("date.txt");\r\n?> 	', 'M_clearstatcache', 'php', 'phpmenu'),
(163, 'Copies file', '<?php\r\nif(!@copy(''../ResultDisp.php'',''testing.php''))\r\n{\r\n    $errors= error_get_last();\r\n    echo "COPY ERROR: ".$errors[''type''];\r\n    echo "<br />\\n".$errors[''message''];\r\n} else {\r\n    echo "File copied from remote!";\r\n}\r\n?>', 'M_copy', 'php', 'phpmenu'),
(169, 'writes all buffered output to an open file', '<?php\r\n$filename = ''date.txt'';\r\n\r\n$file = fopen($filename, ''r+'');\r\nrewind($file);\r\nfwrite($file, ''Foo Bar Tea Apple'');\r\nfflush($file);\r\nftruncate($file, ftell($file));\r\nfclose($file);\r\n?>', 'M_fflush', 'php', 'phpmenu'),
(164, 'Get/Returns parent directory''s path, get www path', '<?php\r\n\r\n// Is the user using HTTPS?\r\n$url = ((isset($_SERVER[''HTTPS'']) && $_SERVER[''HTTPS''] == ''on'')) ? ''https://'' : ''http://'';\r\n\r\n// Complete the URL\r\n$url .= $_SERVER[''HTTP_HOST''] . dirname($_SERVER[''PHP_SELF'']);\r\n\r\n// echo the URL\r\necho $url;\r\necho ''<br/>'';\r\necho dirname(__FILE__) ;\r\n?>', 'M_dirname', 'php', 'phpmenu'),
(165, 'returns the free space, in bytes, of the specified directory, diskfreespace ', '<?php\r\necho ''List all drives, free space, total space and percentage free.'';\r\necho ''<br/>'';\r\n	$drive = dirname(__FILE__);\r\n            $freespace           = @disk_free_space($drive);\r\n            $total_space         = @disk_total_space($drive);\r\n            $percentage_free     = $freespace ? round($freespace / $total_space, 2) * 100 : 0;\r\n            echo $drive.''Free space: ''.to_readble_size($freespace).'' / ''.''Total space: ''.to_readble_size($total_space).'' [''.$percentage_free.''%]<br />'';\r\n\r\n    function to_readble_size($size)\r\n    {\r\n        switch (true)\r\n        {\r\n            case ($size > 1000000000000):\r\n                $size /= 1000000000000;\r\n                $suffix = ''TB'';\r\n                break;\r\n            case ($size > 1000000000):\r\n                $size /= 1000000000;\r\n                $suffix = ''GB'';\r\n                break;\r\n            case ($size > 1000000):\r\n                $size /= 1000000;\r\n                $suffix = ''MB'';   \r\n                break;\r\n            case ($size > 1000):\r\n                $size /= 1000;\r\n                $suffix = ''KB'';\r\n                break;\r\n            default:\r\n                $suffix = ''B'';\r\n        }\r\n        return round($size, 2).$suffix;\r\n    }\r\n	\r\n?>', 'M_disk_free_space', 'php', 'phpmenu'),
(166, 'returns the total space, in bytes, of the specified directory', '<?php\r\n// $ds contains the total number of bytes available on "/"\r\n$ds = @disk_total_space("/");\r\necho $ds;\r\necho ''<br/>'';\r\n// On Windows:\r\n$ds = @disk_total_space("C:");\r\necho $ds;\r\necho ''<br/>'';\r\n?>\r\n		', 'M_disk_total_space', 'php', 'phpmenu'),
(167, 'closes an open file', '<?php\r\n$file = fopen("M_fclose.php", "r");\r\n\r\n//Output a line of the file until the end is reached\r\nwhile(! feof($file))\r\n{\r\n  $current_line = fgets($file);\r\n  if (!feof($file)) {   /* You can put an additional test for feof() inside the loop to avoid the infinite loop */\r\n    echo $current_line. "<br />";\r\n  }\r\n}\r\n\r\nfclose($file);\r\n?>', 'M_fclose', 'php', 'phpmenu'),
(168, 'checks if the "end-of-file" (EOF) has been reached', '<?php\r\n$file = fopen("date.txt", "r");\r\n\r\n//Output a line of the file until the end is reached\r\nwhile(! feof($file))\r\n  {\r\n  echo fgets($file). "<br />";\r\n  }\r\n\r\nfclose($file);\r\n?>', 'M_feof ', 'php', ''),
(171, 'parses a line from an open file, checking for CSV fields.', '<?php\r\n$filename = ''date.txt'';\r\n\r\n$file = fopen($filename, ''r+'');\r\nrewind($file);\r\nfwrite($file, ''Foo,Bar,Tea,Apple'');\r\nfflush($file);\r\nftruncate($file, ftell($file));\r\nfclose($file);\r\n\r\n\r\n$file = fopen("date.txt","r");\r\nprint_r(fgetcsv($file));\r\nfclose($file);\r\n?>', 'M_fgetcsv', 'php', 'phpmenu'),
(172, 'returns a line from an open file', '<?php\r\n$myfile = ''date.txt'';\r\n$command = "tac $myfile > /tmp/myfilereversed.txt";\r\npassthru($command);\r\n$ic = 0;\r\n$ic_max = 100;  // stops after this number of rows\r\n$handle = fopen("/tmp/myfilereversed.txt", "r");\r\nwhile (!feof($handle) && ++$ic<=$ic_max) {\r\n   $buffer = fgets($handle, 4096);\r\n   echo $buffer."<br>";\r\n}\r\nfclose($handle);\r\n?>', 'M_fgets', 'php', 'phpmenu'),
(173, 'returns a line, with HTML and PHP tags removed, from an open file', '<?php\r\n$file = fopen("../HTML/countdown.html","r");\r\necho fgetss($file);\r\nfclose($file);\r\n?> 		', 'M_fgetss', 'php', 'phpmenu'),
(181, 'Gets last access time of file', '<?php\r\n\r\n// outputs e.g.  somefile.txt was last accessed: December 29 2002 22:16:23.\r\n\r\n$filename = ''date.txt'';\r\nif (file_exists($filename)) {\r\n    echo "$filename was last accessed: " . date("F d Y H:i:s.", fileatime($filename));\r\n}\r\n\r\n?>\r\n		', 'M_fileatime', 'php', 'phpmenu'),
(175, 'Checks whether an url exists', '<?php\r\n    function url_exists($url){\r\n        $url = str_replace("http://", "", $url);\r\n        if (strstr($url, "/")) {\r\n            $url = explode("/", $url, 2);\r\n            $url[1] = "/".$url[1];\r\n        } else {\r\n            $url = array($url, "/");\r\n        }\r\n\r\n        $fh = fsockopen($url[0], 80);\r\n        if ($fh) {\r\n            fputs($fh,"GET ".$url[1]." HTTP/1.1\\nHost:".$url[0]."\\n\\n");\r\n            if (fread($fh, 22) == "HTTP/1.1 404 Not Found") { return FALSE; }\r\n            else { return TRUE;    }\r\n\r\n        } else { return FALSE;}\r\n    }\r\nif(url_exists("http://www.raymondlwhuang.com/AddSource.php"))\r\n{\r\n   echo "URL: http://www.raymondlwhuang.com/AddSource.php is exist";\r\n}\r\nelse\r\n   echo "URL: http://www.raymondlwhuang.com/AddSource.php is not exist";\r\n?>', 'url_exists', 'php', ''),
(176, 'Checks whether a file or directory exists', '<?php\r\n$filename = ''/path/to/foo.txt'';\r\n\r\nif (file_exists($filename)) {\r\n    echo "The file $filename exists";\r\n} else {\r\n    echo "The file $filename does not exist";\r\n}\r\n?>\r\n		', 'M_file_exists', 'php', 'phpmenu'),
(177, 'Reads entire file into a string', '<?php\r\n$homepage = file_get_contents(''../HTML/countdown.html'');\r\necho $homepage;\r\n?>', 'M_file_get_contents', 'php', 'phpmenu'),
(178, 'Calender HTML', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" \r\n    "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">\r\n  <title>Calender HTML</title>\r\n  <script language="JavaScript" type="text/javascript">\r\n  \r\n/**************************************************************************************\r\n  htmlDatePicker v0.1\r\n  \r\n  Copyright (c) 2005, Jason Powell\r\n  All Rights Reserved\r\n\r\n  Redistribution and use in source and binary forms, with or without modification, are \r\n    permitted provided that the following conditions are met:\r\n\r\n    * Redistributions of source code must retain the above copyright notice, this list of \r\n      conditions and the following disclaimer.\r\n    * Redistributions in binary form must reproduce the above copyright notice, this list \r\n      of conditions and the following disclaimer in the documentation and/or other materials \r\n      provided with the distribution.\r\n    * Neither the name of the product nor the names of its contributors may be used to \r\n      endorse or promote products derived from this software without specific prior \r\n      written permission.\r\n\r\n  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS \r\n  OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF \r\n  MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL \r\n  THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, \r\n  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE \r\n  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED \r\n  AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING \r\n  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED \r\n  OF THE POSSIBILITY OF SUCH DAMAGE.\r\n  \r\n  -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-==-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\r\n\r\n  \r\n***************************************************************************************/\r\n// User Changeable Vars\r\nvar HighlightToday  = true;    // use true or false to have the current day highlighted\r\nvar DisablePast    = false;    // use true or false to allow past dates to be selectable\r\n// The month names in your native language can be substituted below\r\nvar MonthNames = new Array("January","February","March","April","May","June","July","August","September","October","November","December");\r\n\r\n// Global Vars\r\nvar now = new Date();\r\nvar dest = null;\r\nvar ny = now.getFullYear(); // Today''s Date\r\nvar nm = now.getMonth();\r\nvar nd = now.getDate();\r\nvar sy = 0; // currently Selected date\r\nvar sm = 0;\r\nvar sd = 0;\r\nvar y = now.getFullYear(); // Working Date\r\nvar m = now.getMonth();\r\nvar d = now.getDate();\r\nvar l = 0;\r\nvar t = 0;\r\nvar MonthLengths = new Array(31,28,31,30,31,30,31,31,30,31,30,31);\r\n\r\n/*\r\n  Function: GetDate(control)\r\n\r\n  Arguments:\r\n    control = ID of destination control\r\n*/\r\nfunction GetDate() {\r\n  EnsureCalendarExists();\r\n  DestroyCalendar();\r\n  // One arguments is required, the rest are optional\r\n  // First arguments must be the ID of the destination control\r\n  if(arguments[0] == null || arguments[0] == "") {\r\n    // arguments not defined, so display error and quit\r\n    alert("ERROR: Destination control required in funciton call GetDate()");\r\n    return;\r\n  } else {\r\n    // copy argument\r\n    dest = arguments[0];\r\n  }\r\n  y = now.getFullYear();\r\n  m = now.getMonth();\r\n  d = now.getDate();\r\n  sm = 0;\r\n  sd = 0;\r\n  sy = 0;\r\n  var cdval = dest.value;\r\n  if(/\\d{1,2}.\\d{1,2}.\\d{4}/.test(dest.value)) {\r\n    // element contains a date, so set the shown date\r\n    var vParts = cdval.split("/"); // assume mm/dd/yyyy\r\n    sm = vParts[0] - 1;\r\n    sd = vParts[1];\r\n    sy = vParts[2];\r\n    m=sm;\r\n    d=sd;\r\n    y=sy;\r\n  }\r\n  \r\n//  l = dest.offsetLeft; // + dest.offsetWidth;\r\n//  t = dest.offsetTop - 125;   // Calendar is displayed 125 pixels above the destination element\r\n//  if(t<0) { t=0; }      // or (somewhat) over top of it. ;)\r\n\r\n  /* Calendar is displayed 125 pixels above the destination element\r\n  or (somewhat) over top of it. ;)*/\r\n  l = dest.offsetLeft + dest.offsetParent.offsetLeft;\r\n  t = dest.offsetTop - 125;\r\n  if(t < 0) t = 0; // >\r\n  DrawCalendar();\r\n}\r\n\r\n/*\r\n  function DestoryCalendar()\r\n  \r\n  Purpose: Destory any already drawn calendar so a new one can be drawn\r\n*/\r\nfunction DestroyCalendar() {\r\n  var cal = document.getElementById("dpCalendar");\r\n  if(cal != null) {\r\n    cal.innerHTML = null;\r\n    cal.style.display = "none";\r\n  }\r\n  return\r\n}\r\n\r\nfunction DrawCalendar() {\r\n  DestroyCalendar();\r\n  cal = document.getElementById("dpCalendar");\r\n  cal.style.left = l + "px";\r\n  cal.style.top = t + "px";\r\n  \r\n  var sCal = "<table><tr><td class=\\"cellButton\\"><a href=\\"javascript: PrevMonth();\\" title=\\"Previous Month\\">&lt;&lt;</a></td>"+\r\n    "<td class=\\"cellMonth\\" width=\\"80%\\" colspan=\\"5\\">"+MonthNames[m]+" "+y+"</td>"+\r\n    "<td class=\\"cellButton\\"><a href=\\"javascript: NextMonth();\\" title=\\"Next Month\\">&gt;&gt;</a></td></tr>"+\r\n    "<tr><td>S</td><td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td></tr>";\r\n  var wDay = 1;\r\n  var wDate = new Date(y,m,wDay);\r\n  if(isLeapYear(wDate)) {\r\n    MonthLengths[1] = 29;\r\n  } else {\r\n    MonthLengths[1] = 28;\r\n  }\r\n  var dayclass = "";\r\n  var isToday = false;\r\n  for(var r=1; r<7; r++) {\r\n    sCal = sCal + "<tr>";\r\n    for(var c=0; c<7; c++) {\r\n      var wDate = new Date(y,m,wDay);\r\n      if(wDate.getDay() == c && wDay<=MonthLengths[m]) {\r\n        if(wDate.getDate()==sd && wDate.getMonth()==sm && wDate.getFullYear()==sy) {\r\n          dayclass = "cellSelected";\r\n          isToday = true;  // only matters if the selected day IS today, otherwise ignored.\r\n        } else if(wDate.getDate()==nd && wDate.getMonth()==nm && wDate.getFullYear()==ny && HighlightToday) {\r\n          dayclass = "cellToday";\r\n          isToday = true;\r\n        } else {\r\n          dayclass = "cellDay";\r\n          isToday = false;\r\n        }\r\n        if(((now > wDate) && !DisablePast) || (now <= wDate) || isToday) { // >\r\n          // user wants past dates selectable\r\n          sCal = sCal + "<td class=\\""+dayclass+"\\"><a href=\\"javascript: ReturnDay("+wDay+");\\">"+wDay+"</a></td>";\r\n        } else {\r\n          // user wants past dates to be read only\r\n          sCal = sCal + "<td class=\\""+dayclass+"\\">"+wDay+"</td>";\r\n        }\r\n        wDay++;\r\n      } else {\r\n        sCal = sCal + "<td class=\\"unused\\"></td>";\r\n      }\r\n    }\r\n    sCal = sCal + "</tr>";\r\n  }\r\n  sCal = sCal + "<tr><td colspan=\\"4\\" class=\\"unused\\"></td><td colspan=\\"3\\" class=\\"cellCancel\\"><a href=\\"javascript: DestroyCalendar();\\">Cancel</a></td></tr></table>"\r\n  cal.innerHTML = sCal; // works in FireFox, opera\r\n  cal.style.display = "inline";\r\n}\r\n\r\nfunction PrevMonth() {\r\n  m--;\r\n  if(m==-1) {\r\n    m = 11;\r\n    y--;\r\n  }\r\n  DrawCalendar();\r\n}\r\n\r\nfunction NextMonth() {\r\n  m++;\r\n  if(m==12) {\r\n    m = 0;\r\n    y++;\r\n  }\r\n  DrawCalendar();\r\n}\r\n\r\nfunction ReturnDay(day) {\r\n  cDest = document.getElementById(dest);\r\n  dest.value = (m+1)+"/"+day+"/"+y;\r\n  DestroyCalendar();\r\n}\r\n\r\nfunction EnsureCalendarExists() {\r\n  if(document.getElementById("dpCalendar") == null) {\r\n    var eCalendar = document.createElement("div");\r\n    eCalendar.setAttribute("id", "dpCalendar");\r\n    document.body.appendChild(eCalendar);\r\n  }\r\n}\r\n\r\nfunction isLeapYear(dTest) {\r\n  var y = dTest.getYear();\r\n  var bReturn = false;\r\n  \r\n  if(y % 4 == 0) {\r\n    if(y % 100 != 0) {\r\n      bReturn = true;\r\n    } else {\r\n      if (y % 400 == 0) {\r\n        bReturn = true;\r\n      }\r\n    }\r\n  }\r\n  \r\n  return bReturn;\r\n}  \r\n  \r\n  </script>\r\n  <style type="text/css">\r\n/**************************************************************************************\r\n  htmlDatePicker CSS file\r\n  \r\n  Feel Free to change the fonts, sizes, borders, and colours of any of these elements\r\n***************************************************************************************/\r\n/* The containing DIV element for the Calendar */\r\n#dpCalendar {\r\n  display: none;          /* Important, do not change */\r\n  position: absolute;        /* Important, do not change */\r\n  background-color: #eeeeee;\r\n  color: black;\r\n  font-size: xx-small;\r\n  font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n  width: 150px;\r\n}\r\n/* The table of the Calendar */\r\n#dpCalendar table {\r\n  border: 1px solid black;\r\n  background-color: #eeeeee;\r\n  color: black;\r\n  font-size: xx-small;\r\n  font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n  width: 100%;\r\n}\r\n/* The Next/Previous buttons */\r\n#dpCalendar .cellButton {\r\n  background-color: #ddddff;\r\n  color: black;\r\n}\r\n/* The Month/Year title cell */\r\n#dpCalendar .cellMonth {\r\n  background-color: #ddddff;\r\n  color: black;\r\n  text-align: center;\r\n}\r\n/* Any regular day of the month cell */\r\n#dpCalendar .cellDay {\r\n  background-color: #ddddff;\r\n  color: black;\r\n  text-align: center;\r\n}\r\n/* The day of the month cell that is selected */\r\n#dpCalendar .cellSelected {\r\n  border: 1px solid red;\r\n  background-color: #ffdddd;\r\n  color: black;\r\n  text-align: center;\r\n}\r\n/* The day of the month cell that is Today */\r\n#dpCalendar .cellToday {\r\n  background-color: #ddffdd;\r\n  color: black;\r\n  text-align: center;\r\n}\r\n/* Any cell in a month that is unused (ie: Not a Day in that month) */\r\n#dpCalendar .unused {\r\n  background-color: transparent;\r\n  color: black;\r\n}\r\n/* The cancel button */\r\n#dpCalendar .cellCancel {\r\n  background-color: #cccccc;\r\n  color: black;\r\n  border: 1px solid black;\r\n  text-align: center;\r\n}\r\n/* The clickable text inside the calendar */\r\n#dpCalendar a {\r\n  text-decoration: none;\r\n  background-color: transparent;\r\n  color: blue;\r\n}  \r\n  </style>\r\n</head>\r\n\r\n<body>\r\n<form action="datepicker.cfm" method="post" name="frmMain" id="frmMain">\r\n  Please select a date: \r\n  <input type="text" value="Click me!" name="SelectedDate" id="SelectedDate" readonly onClick="GetDate(this);">\r\n  <br>\r\n  <input type="submit">\r\n\r\n</form>\r\n</body>\r\n</html>\r\n		', 'calender', 'html', 'html'),
(179, 'Write a string to a file', 'http://ca3.php.net/manual/en/function.file-put-contents.php\r\n\r\n\r\n/*file_put_contents,fwrite*/\r\n', 'M_file_put_contents', 'link', 'phpmenu'),
(180, 'Reads entire file into an array line by line', 'http://ca3.php.net/manual/en/function.file.php', 'M_file', 'link', 'phpmenu'),
(182, 'get a list of files ordered by upload time,returns the last time the specified file was changed', '<?php\r\nforeach (glob("../PHP/*") as $path) { //configure path\r\n    $docs[$path] = filectime($path);\r\n} arsort($docs); // sort by value, preserving keys\r\n\r\nforeach ($docs as $path => $timestamp) {\r\n    print date("d. M. Y: ", $timestamp);\r\n    print ''<a href="''. $path .''">''. basename($path) .''</a><br />'';\r\n}\r\n?>', 'M_filectime', 'php', 'phpmenu'),
(183, 'returns the group ID of the specified file', '<?php\r\necho filegroup("date.txt");\r\n?> 		', 'M_filegroup', 'php', 'phpmenu'),
(184, 'returns the last time the file content was modified, get correct modified time under windows', 'http://ca3.php.net/manual/en/function.filemtime.php', 'M_filemtime', 'link', 'phpmenu'),
(185, 'Gets file size (window as well) ', 'http://ca3.php.net/manual/en/function.filesize.php', 'M_filesize', 'link', 'phpmenu'),
(186, 'Match/find filename against a pattern', 'http://ca3.php.net/manual/en/function.fnmatch.php', 'M_fnmatch', 'link', 'phpmenu'),
(187, 'SQL statement and command', 'http://www.w3schools.com/sql/', 'SQL', 'link', 'link'),
(188, 'show or embed a YouTube video', '<object width="425" height="350" data="http://www.youtube.com/v/Ahg6qcgoay4" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/Ahg6qcgoay4" /></object> 		', 'YouTube', 'html', 'html'),
(189, 'left to right slidshow', '<?php\r\n$dirPath = "../images/";\r\n\r\nfunction traverseDir( $dir ) {\r\n  if ( !( $handle = opendir( $dir ) ) ) die( "Cannot open $dir." );\r\n  $files = array();\r\n  while ( $file = readdir( $handle ) ) {\r\n    if ( $file != "." && $file != ".." ) {\r\n      if ( is_dir( $dir . "/" . $file ) ) $file .= "/";\r\n      $files[] = $file;\r\n    }\r\n  }\r\n  sort( $files );\r\n?>\r\n<script type="text/javascript">\r\n    var j = <?php echo count($files); ?>;\r\n	var adImages = new Array(j);\r\n	var i = 0;\r\n</script>\r\n<?php\r\n  foreach ( $files as $file ) {\r\n?>\r\n<script type="text/javascript">\r\n//adImages[i]=''<a href="http://www.raymondlwhuang.com"><img src="../images/<?php echo $file; ?>" border=0"></a>''\r\nadImages[i]=''<img src="../images/<?php echo $file; ?>">'';\r\ni++;\r\n</script>\r\n<?php\r\n	  foreach ( $files as $file ) {\r\n		if ( substr( $file, -1 )  == "/" ) traverseDir( "$dir/" . substr( $file, 0, -1 ) );\r\n	  }\r\n  };\r\n  closedir( $handle );\r\n}\r\ntraverseDir( $dirPath );\r\n?>\r\n\r\n<script language="JavaScript1.2">\r\n\r\n///////configure the below four variables to change the style of the slider///////\r\n//set the scrollerwidth and scrollerheight to the width/height of the LARGEST image in your slideshow!\r\nvar scrollerwidth=''100%''\r\nvar scrollerheight=''100%''\r\nvar scrollerbgcolor=''white''\r\n//3000 miliseconds=3 seconds\r\nvar pausebetweenimages=50\r\n\r\nvar ie=document.all\r\nvar dom=document.getElementById\r\n\r\nif (adImages.length>1)\r\ni=2\r\nelse\r\ni=0\r\n\r\nfunction move1(whichlayer){\r\ntlayer=eval(whichlayer)\r\nif (tlayer.left>0&&tlayer.left<=5){\r\ntlayer.left=0\r\nsetTimeout("move1(tlayer)",pausebetweenimages)\r\nsetTimeout("move2(document.main.document.second)",pausebetweenimages)\r\nreturn\r\n}\r\nif (tlayer.left>=tlayer.document.width*-1){\r\ntlayer.left-=5\r\nsetTimeout("move1(tlayer)",50)\r\n}\r\nelse{\r\ntlayer.left=parseInt(scrollerwidth)+5\r\ntlayer.document.write(adImages[i])\r\ntlayer.document.close()\r\nif (i==adImages.length-1)\r\ni=0\r\nelse\r\ni++\r\n}\r\n}\r\n\r\nfunction move2(whichlayer){\r\ntlayer2=eval(whichlayer)\r\nif (tlayer2.left>0&&tlayer2.left<=5){\r\ntlayer2.left=0\r\nsetTimeout("move2(tlayer2)",pausebetweenimages)\r\nsetTimeout("move1(document.main.document.first)",pausebetweenimages)\r\nreturn\r\n}\r\nif (tlayer2.left>=tlayer2.document.width*-1){\r\ntlayer2.left-=5\r\nsetTimeout("move2(tlayer2)",50)\r\n}\r\nelse{\r\ntlayer2.left=parseInt(scrollerwidth)+5\r\ntlayer2.document.write(adImages[i])\r\ntlayer2.document.close()\r\nif (i==adImages.length-1)\r\ni=0\r\nelse\r\ni++\r\n}\r\n}\r\n\r\nfunction move3(whichdiv){\r\ntdiv=eval(whichdiv)\r\nif (parseInt(tdiv.style.left)>0&&parseInt(tdiv.style.left)<=5){\r\ntdiv.style.left=0+"px"\r\nsetTimeout("move3(tdiv)",pausebetweenimages)\r\nsetTimeout("move4(scrollerdiv2)",pausebetweenimages)\r\nreturn\r\n}\r\nif (parseInt(tdiv.style.left)>=tdiv.offsetWidth*-1){\r\ntdiv.style.left=parseInt(tdiv.style.left)-5+"px"\r\nsetTimeout("move3(tdiv)",50)\r\n}\r\nelse{\r\ntdiv.style.left=scrollerwidth\r\ntdiv.innerHTML=adImages[i]\r\nif (i==adImages.length-1)\r\ni=0\r\nelse\r\ni++\r\n}\r\n}\r\n\r\nfunction move4(whichdiv){\r\ntdiv2=eval(whichdiv)\r\nif (parseInt(tdiv2.style.left)>0&&parseInt(tdiv2.style.left)<=5){\r\ntdiv2.style.left=0+"px"\r\nsetTimeout("move4(tdiv2)",pausebetweenimages)\r\nsetTimeout("move3(scrollerdiv1)",pausebetweenimages)\r\nreturn\r\n}\r\nif (parseInt(tdiv2.style.left)>=tdiv2.offsetWidth*-1){\r\ntdiv2.style.left=parseInt(tdiv2.style.left)-5+"px"\r\nsetTimeout("move4(scrollerdiv2)",50)\r\n}\r\nelse{\r\ntdiv2.style.left=scrollerwidth\r\ntdiv2.innerHTML=adImages[i]\r\nif (i==adImages.length-1)\r\ni=0\r\nelse\r\ni++\r\n}\r\n}\r\n\r\nfunction startscroll(){\r\nif (ie||dom){\r\nscrollerdiv1=ie? first2 : document.getElementById("first2")\r\nscrollerdiv2=ie? second2 : document.getElementById("second2")\r\nmove3(scrollerdiv1)\r\nscrollerdiv2.style.left=scrollerwidth\r\n}\r\nelse if (document.layers){\r\ndocument.main.visibility=''show''\r\nmove1(document.main.document.first)\r\ndocument.main.document.second.left=parseInt(scrollerwidth)+5\r\ndocument.main.document.second.visibility=''show''\r\n}\r\n}\r\n\r\nwindow.onload=startscroll\r\n\r\n</script>\r\n\r\n<ilayer id="main" width=&{scrollerwidth}; height=&{scrollerheight}; bgColor=&{scrollerbgcolor}; visibility=hide>\r\n<layer id="first" left=1 top=0 width=&{scrollerwidth}; >\r\n<script language="JavaScript1.2">\r\nif (document.layers)\r\ndocument.write(adImages[0])\r\n</script>\r\n</layer>\r\n<layer id="second" left=0 top=0 width=&{scrollerwidth}; visibility=hide>\r\n<script language="JavaScript1.2">\r\nif (document.layers)\r\ndocument.write(adImages[1])\r\n</script>\r\n</layer>\r\n</ilayer>\r\n\r\n<script language="JavaScript1.2">\r\nif (ie||dom){\r\ndocument.writeln(''<div id="main2" style="position:relative;width:''+scrollerwidth+'';height:''+scrollerheight+'';overflow:hidden;background-color:''+scrollerbgcolor+''">'')\r\ndocument.writeln(''<div style="position:absolute;width:''+scrollerwidth+'';height:''+scrollerheight+'';clip:rect(0 ''+scrollerwidth+'' ''+scrollerheight+'' 0);left:0px;top:0px">'')\r\ndocument.writeln(''<div id="first2" style="position:absolute;width:''+scrollerwidth+'';left:1px;top:0px;">'')\r\ndocument.write(adImages[0])\r\ndocument.writeln(''</div>'')\r\ndocument.writeln(''<div id="second2" style="position:absolute;width:''+scrollerwidth+'';left:0px;top:0px">'')\r\ndocument.write(adImages[1])\r\ndocument.writeln(''</div>'')\r\ndocument.writeln(''</div>'')\r\ndocument.writeln(''</div>'')\r\n}\r\n</script>\r\n		', 'Slideshow', 'php', 'php'),
(190, 'left to right slidshow', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html class="cufon-active cufon-ready">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\r\n<title>Slide Show</title>\r\n</head>\r\n<body>\r\n<script type="text/javascript" src="../scripts/fancydropdown.js"></script>\r\n<script type="text/javascript" src="../scripts/jquery.cycle.all.min.js"></script>\r\n<script type="text/javascript">\r\n$(document).ready(function() {\r\n	$(''#slider-container'').cycle({\r\n        fx:     ''uncover'',\r\n        speed:  1000,\r\n        timeout: 7000,\r\n		pause:	1,\r\n        pager:  ''#banner-nav''\r\n	});\r\n});\r\n</script>\r\n<?php\r\n$dirPath = "../pictures/";\r\nfunction traverseDir( $dir ) {\r\n$countimg = 0;\r\n  if ( !( $handle = opendir( $dir ) ) ) die( "Cannot open $dir." );\r\n  $files = array();\r\n  while ( $file = readdir( $handle ) ) {\r\n    if ( $file != "." && $file != ".." ) {\r\n      if ( is_dir( $dir . "/" . $file ) ) $file .= "/";\r\n      $files[] = $file;\r\n    }\r\n  }\r\n  sort( $files );\r\n?>\r\n<script type="text/javascript">\r\n    var j = <?php echo count($files); ?>;\r\n	var adpictures = new Array(j);\r\n	var i = 0;\r\n</script>\r\n<?php\r\necho ''<div style="overflow: hidden;" id="slider-container">'';\r\n  foreach ( $files as $file ) {\r\n  $countimg++;\r\n  $content =''<div style="position: absolute; top: 0px; left: -855px; display: none; z-index: 5; opacity: 1; " id="banner''."$countimg".''">'';\r\n  $content = "$content"."<img src=''../pictures/$file'' alt=''Register'' usemap=''#mail-info'' border=''0''>";\r\n  $content = "$content".''</div>'';\r\n  echo "$content";\r\n	  foreach ( $files as $file ) {\r\n		if ( substr( $file, -1 )  == "/" ) traverseDir( "$dir/" . substr( $file, 0, -1 ) );\r\n	  }\r\n  };\r\n  closedir( $handle );\r\necho ''</div>'';\r\n}\r\ntraverseDir( $dirPath );\r\n?>\r\n</body>\r\n</html>', 'Slideshow2', 'php', 'php'),
(191, 'video handling', 'http://camendesign.com/code/video_for_everybody		', 'videoHandling', 'link', 'link'),
(192, 'video handling', '<html>\r\n<head>\r\n<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>\r\n<script src="http://html5media.googlecode.com/svn/trunk/src/jquery.html5media.min.js"></script>\r\n </head>\r\n<body>\r\n<video src="../images/movie.mp4" width="320" height="240" autoplay=true controls autobuffer>\r\nloading please wait ...</video>\r\n</body>\r\n</html>', 'videoHandling2', 'html', 'html'),
(193, 'Text in Transparent Box', '<html>\r\n <head>\r\n <style type="text/css">\r\n div.background\r\n   {\r\n   width:500px;\r\n   height:250px;\r\n   background:url(../images/klematis.jpg) repeat;\r\n   border:2px solid black;\r\n   }\r\n div.transbox\r\n   {\r\n   width:400px;\r\n   height:180px;\r\n   margin:30px 50px;\r\n   background-color:#ffffff;\r\n   border:1px solid black;\r\n   /* for IE */\r\n   filter:alpha(opacity=60);\r\n   /* CSS3 standard */\r\n   opacity:0.6;\r\n   }\r\n div.transbox p\r\n   {\r\n   margin:30px 40px;\r\n   font-weight:bold;\r\n   color:#000000;\r\n   }\r\n </style>\r\n </head>\r\n\r\n <body>\r\n\r\n <div class="background">\r\n <div class="transbox">\r\n <p>This is some text that is placed in the transparent box.\r\n This is some text that is placed in the transparent box.\r\n This is some text that is placed in the transparent box.\r\n This is some text that is placed in the transparent box.\r\n This is some text that is placed in the transparent box.\r\n </p>\r\n </div>\r\n </div>\r\n\r\n </body>\r\n </html>		', 'TextInTransparent', 'html', 'html');
INSERT INTO `main` (`id`, `ShortDesc`, `Source`, `Name`, `Ext`, `SearchGroup`) VALUES
(194, 'Get User''s Location (city,province,state,country,postal code, zip code, latitude,longitude', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>Geocoding Browser Position Using Javascript''s Geolocation API</title>\r\n \r\n	<style type="text/css">\r\n \r\n		html,\r\n		body {\r\n			height: 100% ;\r\n			margin: 0px 0px 0px 0px ;\r\n			overflow: hidden ;\r\n			padding: 0px 0px 0px 0px ;\r\n			width: 100% ;\r\n			}\r\n \r\n		#mapContainer {\r\n			height: 100% ;\r\n			width: 100% ;\r\n			}\r\n \r\n	</style>\r\n	<!--- Include jQuery and Google Map scripts. --->\r\n	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>\r\n	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>\r\n</head>\r\n<body>\r\n \r\n \r\n	<div id="mapContainer">\r\n		<!-- This is where Google map will go. --->\r\n	</div>\r\n \r\n \r\n	<!---\r\n		Now that we have defined our map container, we should be\r\n		able to immediately load our Google Map.\r\n	--->\r\n	<script type="text/javascript">\r\n \r\n		// Get the map container node.\r\n		var mapContainer = $( "#mapContainer" );\r\n \r\n		// Create the new Goole map controller using our\r\n		// map (pass in the actual DOM object). Center it\r\n		// above the first Geolocated IP address.\r\n		map = new google.maps.Map(\r\n			mapContainer[ 0 ],\r\n			{\r\n				zoom: 11,\r\n				center: new google.maps.LatLng(\r\n					40.700683,\r\n					-73.925972\r\n				),\r\n				mapTypeId: google.maps.MapTypeId.ROADMAP\r\n			}\r\n		);\r\n \r\n \r\n		// I add a marker to the map using the given latitude\r\n		// and longitude location.\r\n		function addMarker( latitude, longitude, label ){\r\n			// Create the marker - this will automatically place it\r\n			// on the existing Google map (that we pass-in).\r\n			var marker = new google.maps.Marker({\r\n				map: map,\r\n				position: new google.maps.LatLng(\r\n					latitude,\r\n					longitude\r\n				),\r\n				title: (label || "")\r\n			});\r\n \r\n			// Return the new marker reference.\r\n			return( marker );\r\n		}\r\n \r\n \r\n		// I update the marker''s position and label.\r\n		function updateMarker( marker, latitude, longitude, label ){\r\n			// Update the position.\r\n			marker.setPosition(\r\n				new google.maps.LatLng(\r\n					latitude,\r\n					longitude\r\n				)\r\n			);\r\n \r\n			// Update the title if it was provided.\r\n			if (label){\r\n \r\n				marker.setTitle( label );\r\n \r\n			}\r\n		}\r\n \r\n \r\n		// -------------------------------------------------- //\r\n		// -------------------------------------------------- //\r\n		// -------------------------------------------------- //\r\n		// -------------------------------------------------- //\r\n \r\n \r\n		// Check to see if this browser supports geolocation.\r\n		if (navigator.geolocation) {\r\n \r\n			// This is the location marker that we will be using\r\n			// on the map. Let''s store a reference to it here so\r\n			// that it can be updated in several places.\r\n			var locationMarker = null;\r\n \r\n \r\n			// Get the location of the user''s browser using the\r\n			// native geolocation service. When we invoke this method\r\n			// only the first callback is requied. The second\r\n			// callback - the error handler - and the third\r\n			// argument - our configuration options - are optional.\r\n			navigator.geolocation.getCurrentPosition(\r\n				function( position ){\r\n \r\n					// Check to see if there is already a location.\r\n					// There is a bug in FireFox where this gets\r\n					// invoked more than once with a cahced result.\r\n					if (locationMarker){\r\n						return;\r\n					}\r\n \r\n					// Log that this is the initial position.\r\n					console.log( "Initial Position Found" );\r\n \r\n					// Add a marker to the map using the position.\r\n					locationMarker = addMarker(\r\n						position.coords.latitude,\r\n						position.coords.longitude,\r\n						"Initial Position"\r\n					);\r\n \r\n				},\r\n				function( error ){\r\n					console.log( "Something went wrong: ", error );\r\n				},\r\n				{\r\n					timeout: (5 * 1000),\r\n					maximumAge: (1000 * 60 * 15),\r\n					enableHighAccuracy: true\r\n				}\r\n			);\r\n \r\n \r\n			// Now tha twe have asked for the position of the user,\r\n			// let''s watch the position to see if it updates. This\r\n			// can happen if the user physically moves, of if more\r\n			// accurate location information has been found (ex.\r\n			// GPS vs. IP address).\r\n			//\r\n			// NOTE: This acts much like the native setInterval(),\r\n			// invoking the given callback a number of times to\r\n			// monitor the position. As such, it returns a "timer ID"\r\n			// that can be used to later stop the monitoring.\r\n			var positionTimer = navigator.geolocation.watchPosition(\r\n				function( position ){\r\n \r\n					// Log that a newer, perhaps more accurate\r\n					// position has been found.\r\n					console.log( "Newer Position Found" );\r\n \r\n					// Set the new position of the existing marker.\r\n					updateMarker(\r\n						locationMarker,\r\n						position.coords.latitude,\r\n						position.coords.longitude,\r\n						"Updated / Accurate Position"\r\n					);\r\n \r\n				}\r\n			);\r\n \r\n \r\n			// If the position hasn''t updated within 5 minutes, stop\r\n			// monitoring the position for changes.\r\n			setTimeout(\r\n				function(){\r\n					// Clear the position watcher.\r\n					navigator.geolocation.clearWatch( positionTimer );\r\n				},\r\n				(1000 * 60 * 5)\r\n			);\r\n \r\n		}\r\n \r\n	</script>\r\n \r\n</body>\r\n</html>		', 'UserLocation', 'html', 'html'),
(195, 'Get user''s operating system information', '<html>\r\n<head>\r\n<script type="text/javascript">\r\nfunction yourOS() {\r\n    var ua = navigator.userAgent.toLowerCase();\r\n    if (ua.indexOf("win") != -1) {\r\n        return "Windows";\r\n    } else if (ua.indexOf("mac") != -1) {\r\n        return "Macintosh";\r\n    } else if (ua.indexOf("linux") != -1) {\r\n        return "Linux";\r\n    } else if (ua.indexOf("x11") != -1) {\r\n        return "Unix";\r\n    } else {\r\n        return "Computers";\r\n    }\r\n}\r\n</script>\r\n<body>\r\n<h1>Welcome to GiantCo Computers</h2>\r\n<h2>We love \r\n<script type="text/javascript">document.write(yourOS())</script>\r\n<noscript>Computers</noscript>\r\nUsers!</h2>\r\n</body>\r\n</html>\r\n', 'UserOS', 'html', 'html'),
(196, 'Get browser information', '<?php\r\n function getBrowser() \r\n{ \r\n    $u_agent = $_SERVER[''HTTP_USER_AGENT'']; \r\n    $bname = ''Unknown'';\r\n     $platform = ''Unknown'';\r\n     $version= "";\r\n \r\n    //First get the platform?\r\n     if (preg_match(''/linux/i'', $u_agent)) {\r\n         $platform = ''linux'';\r\n     }\r\n     elseif (preg_match(''/macintosh|mac os x/i'', $u_agent)) {\r\n         $platform = ''mac'';\r\n     }\r\n     elseif (preg_match(''/windows|win32/i'', $u_agent)) {\r\n         $platform = ''windows'';\r\n     }\r\n     \r\n    // Next get the name of the useragent yes seperately and for good reason\r\n     if(preg_match(''/MSIE/i'',$u_agent) && !preg_match(''/Opera/i'',$u_agent)) \r\n    { \r\n        $bname = ''Internet Explorer''; \r\n        $ub = "MSIE"; \r\n    } \r\n    elseif(preg_match(''/Firefox/i'',$u_agent)) \r\n    { \r\n        $bname = ''Mozilla Firefox''; \r\n        $ub = "Firefox"; \r\n    } \r\n    elseif(preg_match(''/Chrome/i'',$u_agent)) \r\n    { \r\n        $bname = ''Google Chrome''; \r\n        $ub = "Chrome"; \r\n    } \r\n    elseif(preg_match(''/Safari/i'',$u_agent)) \r\n    { \r\n        $bname = ''Apple Safari''; \r\n        $ub = "Safari"; \r\n    } \r\n    elseif(preg_match(''/Opera/i'',$u_agent)) \r\n    { \r\n        $bname = ''Opera''; \r\n        $ub = "Opera"; \r\n    } \r\n    elseif(preg_match(''/Netscape/i'',$u_agent)) \r\n    { \r\n        $bname = ''Netscape''; \r\n        $ub = "Netscape"; \r\n    } \r\n    \r\n    // finally get the correct version number\r\n     $known = array(''Version'', $ub, ''other'');\r\n     $pattern = ''#(?<browser>'' . join(''|'', $known) .\r\n     '')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#'';\r\n     if (!preg_match_all($pattern, $u_agent, $matches)) {\r\n         // we have no matching number just continue\r\n     }\r\n     \r\n    // see how many we have\r\n     $i = count($matches[''browser'']);\r\n     if ($i != 1) {\r\n         //we will have two since we are not using ''other'' argument yet\r\n         //see if version is before or after the name\r\n         if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){\r\n             $version= $matches[''version''][0];\r\n         }\r\n         else {\r\n             $version= $matches[''version''][1];\r\n         }\r\n     }\r\n     else {\r\n         $version= $matches[''version''][0];\r\n     }\r\n     \r\n    // check if we have a number\r\n     if ($version==null || $version=="") {$version="?";}\r\n     \r\n    return array(\r\n         ''userAgent'' => $u_agent,\r\n         ''name''      => $bname,\r\n         ''version''   => $version,\r\n         ''platform''  => $platform,\r\n         ''pattern''    => $pattern\r\n     );\r\n } \r\n\r\n// now try it\r\n $ua=getBrowser();\r\n //$yourbrowser= "Your browser: " . $ua[''name''] . " " . $ua[''version''] . " on " .$ua[''platform''] . " reports: <br >" . $ua[''userAgent''];\r\n $yourbrowser= "Your browser is: " . $ua[''name''] . " and run on " .$ua[''platform''];\r\n print_r($yourbrowser);\r\n ?> 		', 'GetBrowserInfo', 'php', 'php'),
(197, 'Detecting user''s screen size ', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">\r\n<title>Detecting user''s screen size</title>\r\n<body>\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0">\r\n  <tbody>\r\n  <tr>\r\n<td id="leftcolumn" valign="top">\r\n\r\n    <table border="0">\r\n      <tbody><tr>\r\n        <td><form method="POST" name="t">\r\n          <table border="1" cellpadding="5">\r\n            <tbody><tr>\r\n              <td valign="top" width="150" bgcolor="#D8EA99"><strong>width:</strong></td>\r\n              <td><input value="1680" size="20" name="t1" type="text"></td>\r\n            </tr>\r\n            <tr>\r\n              <td valign="top" width="150" bgcolor="#D8EA99"><strong>height:</strong></td>\r\n              <td><input value="1050" size="20" name="t2" type="text"></td>\r\n            </tr>\r\n            <tr>\r\n              <td valign="top" width="150" bgcolor="#D8EA99"><strong>availWidth</strong></td>\r\n              <td><input value="1680" size="20" name="t5" type="text"></td>\r\n            </tr>\r\n            <tr>\r\n              <td valign="top" width="150" bgcolor="#D8EA99"><strong>availHeight</strong></td>\r\n              <td><input value="1010" size="20" name="t6" type="text"></td>\r\n            </tr>\r\n            <tr>\r\n              <td valign="top" width="150" bgcolor="#D8EA99"><strong>colorDepth:</strong></td>\r\n              <td><input value="24" size="20" name="t3" type="text"></td>\r\n            </tr>\r\n            <tr>\r\n              <td valign="top" width="150" bgcolor="#D8EA99"><strong>pixelDepth: </strong></td>\r\n              <td><input value="24" size="20" name="t4" type="text"></td>\r\n            </tr>\r\n          </tbody></table>\r\n        </form>\r\n        </td>\r\n      </tr>\r\n    </tbody></table>\r\n    <p align="left"><!--webbot bot="HTMLMarkup" startspan --><script>\r\n<!--\r\nfunction show(){\r\nif (!document.all&&!document.layers&&!document.getElementById)\r\nreturn\r\ndocument.t.t1.value=screen.width\r\ndocument.t.t2.value=screen.height\r\ndocument.t.t3.value=screen.colorDepth\r\ndocument.t.t4.value=screen.pixelDepth\r\ndocument.t.t5.value=screen.availWidth\r\ndocument.t.t6.value=screen.availHeight\r\n}\r\nshow()\r\n//-->\r\n</script><!--webbot bot="HTMLMarkup"\r\n    endspan i-checksum="64960" --></p>\r\n</td>\r\n  </tr>\r\n</tbody></table>\r\n\r\n		', 'ScreenSize', 'html', 'html'),
(198, 'list of User Plugins ', '<html>\r\n<!-- ONE STEP TO INSTALL USER PLUGINS:\r\n\r\n   1.  Put the coding into the BODY of your HTML document  -->\r\n\r\n<!-- STEP ONE: Copy this code into the BODY of your HTML document  -->\r\n\r\n<BODY>\r\n\r\n<CENTER>\r\n<SCRIPT LANGUAGE="JavaScript">\r\n\r\n<!-- This script and many more are available free online at -->\r\n<!-- The JavaScript Source!! http://javascript.internet.com -->\r\n\r\n<!-- Begin\r\nnumPlugins = navigator.plugins.length;\r\nif (numPlugins > 0)\r\ndocument.writeln("<b><font size=+3>Installed plug-ins</font></b><br>");\r\nelse\r\ndocument.writeln("<b><font size=+2>No plug-ins ");\r\ndocument.writeln("are installed.</font></b><br>");\r\ndocument.writeln("<hr>");\r\nfor (i = 0; i < numPlugins; i++) {\r\nplugin = navigator.plugins[i];\r\ndocument.write("<center><font size=+1><b>");\r\ndocument.write(plugin.name);\r\ndocument.writeln("</b></font></center><br>");\r\ndocument.writeln("<dl>");\r\ndocument.writeln("<dd>File name:");\r\ndocument.write(plugin.filename);\r\ndocument.write("<dd><br>");\r\ndocument.write(plugin.description);\r\ndocument.writeln("</dl>");\r\ndocument.writeln("<p>");\r\ndocument.writeln("<table width=100% border=2 cellpadding=5>");\r\ndocument.writeln("<tr>");\r\ndocument.writeln("<th width=20%><font size=-1>Mime Type</font></th>");\r\ndocument.writeln("<th width=50%><font size=-1>Description</font></th>");\r\ndocument.writeln("<th width=20%><font size=-1>Suffixes</font></th>");\r\ndocument.writeln("<th><font size=-1>Enabled</th>");\r\ndocument.writeln("</tr>");\r\nnumTypes = plugin.length;\r\nfor (j = 0; j < numTypes; j++) {\r\nmimetype = plugin[j];\r\nif (mimetype) {\r\nenabled = "No";\r\nenabledPlugin = mimetype.enabledPlugin;\r\nif (enabledPlugin && (enabledPlugin.name == plugin.name))\r\nenabled = "Yes";\r\ndocument.writeln("<tr align=center>");\r\ndocument.writeln("<td>");\r\ndocument.write(mimetype.type);\r\ndocument.writeln("</td>");\r\ndocument.writeln("<td>");\r\ndocument.write(mimetype.description);\r\ndocument.writeln("</td>");\r\ndocument.writeln("<td>");\r\ndocument.write(mimetype.suffixes);\r\ndocument.writeln("</td>");\r\ndocument.writeln("<td>");\r\ndocument.writeln(enabled);\r\ndocument.writeln("</td>");\r\ndocument.writeln("</tr>");\r\n   }\r\n}\r\ndocument.write("</table>");\r\ndocument.write("<p><hr><p>");\r\n}\r\n// End -->\r\n</SCRIPT>\r\n</CENTER>\r\n<!-- Script Size:  2.31 KB  -->\r\n</body>\r\n</html>		', 'UserPlugins', 'html', 'html'),
(199, 'video to flash converter download', 'http://www.dvdvideosoft.com/products/dvd/Free-Video-to-Flash-Converter.htm		', 'videoToFlash', 'link', 'link'),
(200, 'jqmodal', 'http://tautologistics.com/projects/jquery.modaldialog/doc/1.0.0/		', 'jamodal', 'link', 'link'),
(201, 'jqmodal alert confirm, center div', ' <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>\r\n<link rel="stylesheet" type="text/css" media="screen" href="css/jqModal.css"/>\r\n<title>Thickbox to jqModal example</title>\r\n<style type="text/css">\r\ndiv.jqmAlertContent{\r\n  color:#FFFFFF;\r\n  text-align:center;\r\n}\r\ndiv.jqmAlert input[type="submit"] { \r\n	padding: 4px; \r\n	margin: 10px 30px; \r\n	background: #000; \r\n	color: #FFF; \r\n	border: 1px solid #AAA; \r\n}\r\ndiv.jqmAlert { /* contains + positions the alert window */\r\n	display: none;\r\n	border-style:solid outset;\r\n	border-width:5px;\r\n	background: #000000; \r\n	color: #grey; \r\n	position: fixed;\r\n	top: 50%;\r\n	width: 250px;\r\n	height: 50px;\r\n	text-align: left;\r\n	left: 50%;\r\n	margin-left: -125px;\r\n}\r\ndiv.jqmAlert .jqmClose em{display:none;}\r\ndiv.jqmAlert .jqmClose {\r\n	width:20px;\r\n	height:20px;\r\n	display:block;\r\n	float:right;\r\n	clear:right;\r\n	background:transparent url(images/close_icon_double.png) 0 0 no-repeat;\r\n}\r\ndiv.jqmAlert a.jqmClose:hover,div.jqmAlert a.jqmCloseHover{ background-position: 0 -20px; }\r\n\r\n* html div.jqmAlert {\r\n     position: absolute;\r\n     top: expression((document.documentElement.scrollTop || document.body.scrollTop) + Math.round(17 * (document.documentElement.offsetHeight || document.body.clientHeight) / 100) + ''px'');\r\n}\r\n\r\ndiv.jqmConfirm input[type="submit"] { padding: 4px; margin: 10px 30px; background: #000; color: #FFF; border: 1px solid #AAA; }\r\n\r\ndiv.jqmConfirm { /* contains + positions the alert window */\r\n  display: none;\r\n  \r\n  position: fixed;\r\n  top: 17%;\r\n  width: 100%;\r\n}\r\n   \r\n* html div.jqmConfirm {\r\n     position: absolute;\r\n     top: expression((document.documentElement.scrollTop || document.body.scrollTop) + Math.round(17 * (document.documentElement.offsetHeight || document.body.clientHeight) / 100) + ''px'');\r\n}\r\n\r\ndiv.jqmConfirmWindow {\r\n  height:auto;\r\n  width: auto;\r\n  margin: auto;\r\n  \r\n  max-width:400px;\r\n  padding: 0 10px 10px;\r\n  \r\n  background:#FFF;\r\n  border:1px dotted #FFF;\r\n}\r\n\r\n.jqmConfirmTitle{\r\n  margin:5px 2px;\r\n  height:20px;\r\n  color:#000;\r\n  background:#FFF;\r\n}\r\n.jqmConfirmTitle h1{\r\n  margin:5px 2px;\r\n  padding-left:5px;\r\n  padding:0;\r\n  font-size:14px;\r\n  text-transform:capitalize;\r\n  letter-spacing:-1px;\r\n  font-weight:bold;\r\n  color:#000;\r\n\r\n  float:left;\r\n  height:20px;\r\n}\r\n\r\ndiv.jqmConfirm .jqmClose em{display:none;}\r\ndiv.jqmConfirm .jqmClose {\r\n  width:20px;\r\n  height:20px;\r\n  display:block;\r\n  float:right;\r\n  clear:right;\r\n  background:transparent url(images/close_icon_double.png) 0 0 no-repeat;\r\n}\r\n\r\ndiv.jqmConfirm a.jqmClose:hover{ background-position: 0 -20px; }\r\n\r\ndiv.jqmConfirmContent{\r\n  border-top:px;\r\n  color:#000;\r\n  font:11px/14pt arial;\r\n  padding:5px 20px 5px;\r\n  margin:5px;\r\n  border:1px dotted #111;\r\n  letter-spacing:0px;\r\n  background:#FFF url(images/darkgrid.png);\r\n}\r\n\r\n.clearfix:after {\r\n    content: "."; \r\n    display: block; \r\n    height: 0; \r\n    clear: both; \r\n    visibility: hidden;\r\n}\r\n\r\n.clearfix {display: inline-block;}\r\n\r\n* html .clearfix {height: 1%;}\r\n.clearfix {display: block;}\r\n/* End hide from IE-mac */\r\n</style>\r\n<script type="text/javascript" src="scripts/jquery.js"></script>\r\n<script src="scripts/jqModal.js" type="text/javascript">  </script>\r\n<script type="text/javascript">\r\nfunction alert(msg) {\r\n  $(''#alert'')\r\n    .jqmShow()\r\n    .find(''div.jqmAlertContent'')\r\n      .html(msg);\r\n}\r\n\r\n$().ready(function() {\r\n  $(''#alert'').jqm({overlay: 0, modal: true, trigger: false});\r\n  \r\n  // trigger an alert whenever links of class alert are pressed.\r\n  $(''a.alert'').click(function() { \r\n    alert(''You Have triggered an alert!''); \r\n    return false;\r\n  });\r\n});\r\nfunction confirm(msg,callback) {\r\n  $(''#confirm'')\r\n    .jqmShow()\r\n    .find(''p.jqmConfirmMsg'')\r\n      .html(msg)\r\n    .end()\r\n    .find('':submit:visible'')\r\n      .click(function(){\r\n        if(this.value == ''yes'')\r\n          (typeof callback == ''string'') ?\r\n            window.location.href = callback :\r\n            callback();\r\n        $(''#confirm'').jqmHide();\r\n      });\r\n}\r\n\r\n\r\n$().ready(function() {\r\n  $(''#confirm'').jqm({overlay: 88, modal: true, trigger: false});\r\n  \r\n  // trigger a confirm whenever links of class alert are pressed.\r\n  $(''a.confirm'').click(function() { \r\n    confirm(''About to visit: ''+this.href+'' !'',this.href); \r\n    return false;\r\n  });\r\n});\r\n			\r\n</script>\r\n</head>\r\n<body>\r\n\r\n<input type="button" value ="Alert a message" onclick="alert(''this is a testing'');">\r\n<a href="" class="confirm">Confirmation</a>\r\n<!-- Alert Dialog -->\r\n<div class="jqmAlert" id="alert">\r\n<a href="#" class="jqmClose" align="right"><em style="left:230px; position:relative; "></em></a>\r\n	<div id="ex3b" class="jqmAlertWindow">\r\n		<div class="jqmAlertTitle clearfix">\r\n			<div class="jqmAlertContent"></div>\r\n			<h1></h1>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class="jqmConfirm" id="confirm">\r\n\r\n<div id="ex3b" class="jqmConfirmWindow">\r\n    <div class="jqmConfirmTitle clearfix">\r\n    <h1>Confirmation</h1><a href="#" class="jqmClose"><em>Close</em></a>\r\n  </div>\r\n  \r\n  <div class="jqmConfirmContent">\r\n  <p class="jqmConfirmMsg"></p>\r\n  <p>Continue?</p>\r\n  </div>\r\n  \r\n  <input type="submit" value="no" />\r\n  <input type="submit" value="yes" />\r\n  </p>\r\n  \r\n</div>\r\n\r\n</div>\r\n</body> \r\n</html>\r\n		', 'jqmodal', 'html', 'html'),
(202, 'unset session variable', 'unset ($_SESSION[''var''], $var);\r\n \r\nSome people reported that this one didn''t work for them and\r\n proposed an alternative one:\r\n \r\nunset ($_SESSION[''var''];\r\n session_unregister ($var);\r\n \r\nto unset all use\r\n\r\nsession_destroy();\r\n		', 'unset_session', 'txt', 'txt'),
(203, 'Make stretch background to 100% ', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">\r\n<head>\r\n<title>100% backgroup images</title>\r\n\r\n<style type="text/css">\r\nhtml, body {\r\n   height: 100%;\r\n   margin: 0;\r\n   padding: 0;\r\n }\r\nimg#bg {\r\n   position:fixed;\r\n   top:0;\r\n   left:0;\r\n   width:100%;\r\n   height:100%;\r\n   z-index:-5;\r\n } \r\n\r\n</style>\r\n\r\n </head>\r\n<body>\r\n<img src="../images/Desert.jpg" alt="background image" id="bg" />\r\n</body>\r\n</html>		', 'fullBackground', 'html', 'html'),
(204, 'Image inside <option> drop down menu, image combo box', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml"><head>\r\n<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">\r\n	<title>Image combo box/Image select option</title>\r\n<style type="text/css" media="screen">\r\ndiv {\r\n	margin-bottom: 10px;\r\n}\r\n\r\nul {\r\n	display: none;\r\n	list-style-type: none;\r\n	margin-top: 5px;\r\n}\r\n\r\nul > li > a:hover {background: #736F6E;}\r\n\r\ndiv > p {\r\n	display: block;\r\n	width: 130px;\r\n	font-size: 18px;\r\n	font-weight: bold;\r\n	background: #FFFFFF;\r\n	border: 2px outset;\r\n	margin:0\r\n }\r\n \r\ndiv > p:hover  {  border: 2px inset;background: #FFFFFF; border-color: #736F6E;color:white  }\r\n\r\n</style>	\r\n<script type="text/javascript" >\r\nwindow.onload = initAll;\r\n\r\nfunction initAll() {\r\n	var allLinks = document.getElementsByTagName("div");\r\n	\r\n	for (var i=0; i<allLinks.length; i++) {\r\n		allLinks[i].onmouseover = function (){document.getElementById(this.className).style.display = "block";}\r\n		allLinks[i].onmouseout =  function (){document.getElementById(this.className).style.display = "none";}\r\n	}\r\n}\r\n\r\n</script>\r\n</head>\r\n<body>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\n	<div class="menu1">\r\n		<p><img src=''../pictures/M1060003.jpg''  height=''50px'' id="picked" /><img src=''../images/down_arrow.jpg''  width=''40px''/></p>\r\n		<ul style="display: none;text-align:left" id="menu1">\r\n			<li><a href="" onClick="document.getElementById(''picked'').src = ''../pictures/M1060003.jpg'';return false;"><img src=''../pictures/M1060003.jpg''  height=''50px''/></a></li>\r\n			<li><a href="" onClick="document.getElementById(''picked'').src = ''../pictures/M1060004.jpg'';return false;"><img src=''../pictures/M1060004.jpg''  height=''50px''/></a></li>\r\n			<li><a href="" onClick="document.getElementById(''picked'').src = ''../pictures/M1060005.jpg'';return false;"><img src=''../pictures/M1060005.jpg''  height=''50px''/></a></li>\r\n			<li><a href="" onClick="document.getElementById(''picked'').src = ''../pictures/M1060006.jpg'';return false;"><img src=''../pictures/M1060006.jpg''  height=''50px''/></a></li>\r\n			<li><a href="" onClick="document.getElementById(''picked'').src = ''../pictures/M1060007.jpg'';return false;"><img src=''../pictures/M1060007.jpg''  height=''50px''/></a></li>\r\n		</ul>\r\n	</div>\r\n</td>\r\n</tr>\r\n</tbody></table>\r\n</body>\r\n</html>\r\n	', 'ImageCombo', 'html', 'html'),
(205, 'fix innerHTML/Select/IE problem', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml"><head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\r\n<title>Thank you for participating!</title>\r\n<script type="text/javascript">\r\nfunction select_innerHTML(objeto,innerHTML){\r\n    objeto.innerHTML = ""\r\n    var selTemp = document.createElement("micoxselect")\r\n    var opt;\r\n    selTemp.id="micoxselect1"\r\n    document.body.appendChild(selTemp)\r\n    selTemp = document.getElementById("micoxselect1")\r\n    selTemp.style.display="none"\r\n    if(innerHTML.toLowerCase().indexOf("<option")<0){//se não é option eu converto\r\n        innerHTML = "<option>" + innerHTML + "</option>"\r\n    }\r\n    innerHTML = innerHTML.toLowerCase().replace(/<option/g,"<span").replace(/<\\/option/g,"</span")\r\n    selTemp.innerHTML = innerHTML\r\n      \r\n    \r\n    for(var i=0;i<selTemp.childNodes.length;i++){\r\n  var spantemp = selTemp.childNodes[i];\r\n  \r\n        if(spantemp.tagName){     \r\n            opt = document.createElement("OPTION")\r\n    \r\n   if(document.all){ //IE\r\n    objeto.add(opt)\r\n   }else{\r\n    objeto.appendChild(opt)\r\n   }       \r\n    \r\n   //getting attributes\r\n   for(var j=0; j<spantemp.attributes.length ; j++){\r\n    var attrName = spantemp.attributes[j].nodeName;\r\n    var attrVal = spantemp.attributes[j].nodeValue;\r\n    if(attrVal){\r\n     try{\r\n      opt.setAttribute(attrName,attrVal);\r\n      opt.setAttributeNode(spantemp.attributes[j].cloneNode(true));\r\n     }catch(e){}\r\n    }\r\n   }\r\n   //getting styles\r\n   if(spantemp.style){\r\n    for(var y in spantemp.style){\r\n     try{opt.style[y] = spantemp.style[y];}catch(e){}\r\n    }\r\n   }\r\n   //value and text\r\n   opt.value = spantemp.getAttribute("value")\r\n   opt.text = spantemp.innerHTML\r\n   //IE\r\n   opt.selected = spantemp.getAttribute(''selected'');\r\n   opt.className = spantemp.className;\r\n  } \r\n }    \r\n document.body.removeChild(selTemp)\r\n selTemp = null\r\n}\r\nvar inner = "<option value=''1''>Now</option> <option value=''2''>work</option>"; \r\n</script>       \r\n</head>\r\n<body>\r\n<select name=''test'' id=''test''>\r\n<option value=''test1''>test1</option>\r\n<option value=''test2''>test2</option>\r\n</select>\r\n<input type="button" value="Change" onClick="select_innerHTML(document.getElementById(''test''),inner);">\r\n\r\n</body>\r\n</html>		', 'innerHTML_Select', 'html', ''),
(206, 'Get user location with IP', '<?php\r\ninclude("geoip.inc");\r\ninclude("geoipcity.inc");\r\ninclude("geoipregionvars.php");\r\nfunction getIpAddr(){\r\n    if (!empty($_SERVER[''HTTP_CLIENT_IP''])){\r\n        $ip=$_SERVER[''HTTP_CLIENT_IP''];\r\n    }\r\n    // Check if the IP is passed from a proxy.\r\n    elseif (!empty($_SERVER[''HTTP_X_FORWARDED_FOR''])){\r\n        $ip=$_SERVER[''HTTP_X_FORWARDED_FOR''];\r\n	}\r\n	else {\r\n		$ip=$_SERVER[''REMOTE_ADDR''];\r\n	}\r\n	return $ip;\r\n}\r\n$ip = getIpAddr();\r\n$gi = geoip_open("GeoLiteCity.dat", GEOIP_STANDARD);\r\n$rsGeoData = geoip_record_by_addr($gi, $ip);\r\ngeoip_close($gi);	\r\nprint "<pre>";\r\nprint_r($rsGeoData);\r\nprint "</pre>";\r\n$location =  $rsGeoData->city.'',''.$rsGeoData->region;\r\necho $location;\r\n?>		', 'location', 'php', 'php'),
(207, 'Get user''s OS', '<?php \r\n$OSList = array \r\n(\r\n// Match user agent string with operating systems\r\n''Windows 3.11'' => ''Win16'',\r\n''Windows 95'' => ''(Windows 95)|(Win95)|(Windows_95)'',\r\n''Windows 98'' => ''(Windows 98)|(Win98)'',\r\n''Windows 2000'' => ''(Windows NT 5.0)|(Windows 2000)'',\r\n''Windows XP'' => ''(Windows NT 5.1)|(Windows XP)'',\r\n''Windows Server 2003'' => ''(Windows NT 5.2)'',\r\n''Windows Vista'' => ''(Windows NT 6.0)'',\r\n''Windows 7'' => ''(Windows NT 7.0)'',\r\n''Windows NT 4.0'' => ''(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)'',\r\n''Windows ME'' => ''Windows ME'',\r\n''Open BSD'' => ''OpenBSD'',\r\n''Sun OS'' => ''SunOS'',\r\n''Linux'' => ''(Linux)|(X11)'',\r\n''Mac OS'' => ''(Mac_PowerPC)|(Macintosh)'',\r\n''QNX'' => ''QNX'', \r\n''BeOS'' => ''BeOS'',\r\n''OS/2'' => ''OS/2'',\r\n''Search Bot''=>''(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)''\r\n);\r\n// Loop through the array of user agents and matching operating systems\r\nforeach($OSList as $CurrOS=>$Match)\r\n{\r\n// Find a match\r\n//echo $_SERVER[''HTTP_USER_AGENT''];\r\nif (preg_match("/$Match/", $_SERVER[''HTTP_USER_AGENT'']))\r\n{\r\n// We found the correct match\r\nbreak;\r\n}\r\n}\r\n// You are using ...\r\necho "You are using ".$CurrOS;\r\n?>\r\n		', 'UserOS', 'php', 'php'),
(208, 'Tracking Users without Cookies', '<?php\r\nswitch ($_GET[''mode'']) {\r\n        case ''shim'':\r\n                showShim();\r\n                break;\r\n        case ''tracker'':\r\n                showTracker();\r\n                break;\r\n        default:\r\n                showMain();\r\n}\r\n//Demo page. Allows user to send messages to tracker (through shim).\r\nfunction showMain() {\r\n        $shim = ''tracker.php?mode=shim'';\r\n        ?>\r\n                <html>\r\n                        <body>\r\n                                <script type="text/javascript">\r\n                                        var sendMessage = function(message) {\r\n                                                var tracker = ''<?php echo $shim; ?>#'' + escape(message);\r\n                                                var frame = document.createElement(''iframe'');\r\n                                                frame.src = tracker;\r\n                                                frame.id = ''shim'';\r\n                                                frame.height = 400;\r\n                                                frame.width = 400;\r\n                                                var oldFrame = document.getElementById(''shim'');\r\n                                                var container = oldFrame.parentNode;\r\n                                                container.removeChild(oldFrame);\r\n                                                container.appendChild(frame);\r\n                                        }\r\n                                </script>\r\n                                <input type="text" id="message" value="Hello, there." />\r\n                                <button onclick="sendMessage(document.getElementById(''message'').value);">Send</button>\r\n                                <br />\r\n                                <iframe id="shim" src="<?php echo $shim; ?>#Page%20load" height="400" width="400"></iframe>\r\n                        <body>\r\n                </html>\r\n        <?php\r\n}\r\n//Shows a non-expiring shim page which calls tracker.\r\nfunction showShim() {\r\n        //Generate session ID. Stored in users cache.\r\n        $id = uniqid(null, true);\r\n        //This page should never expire. This will force cache to keep our ID.\r\n        $age = 10 * 365 * 24 * 60 * 60;\r\n        $expires = gmdate("D, d M Y H:i:s", time() + $age);\r\n        $modified = gmdate("D, d M Y H:i:s", time());\r\n        header("Cache-Control: max-age=$age; private"); // HTTP/1.1\r\n        header("Last-Modified: $modified GMT");\r\n        header("Expires: $expires GMT");\r\n        $tracker = "tracker.php?mode=tracker&amp;id=" . urlencode($id);\r\n        ?>\r\n                <html>\r\n\r\n                        <body>\r\n                                <h2>Shim</h2>\r\n                                <p>This file contains the unique ID, and is cached indefinately.</p>\r\n                                Time: <?php echo date(''H:i:s''); ?>\r\n                                <script type="text/javascript">\r\n                                        //Try and generate iframe by javascript.\r\n                                        //This allows us to pass message AND referrer to tracker.\r\n                                        var tracker = ''<?php echo addslashes($tracker); ?>'' +\r\n                                                ''&amp;message='' + document.location.hash.substr(1) +\r\n                                                ''&amp;referrer='' + document.referrer;\r\n                                                document.write(''<iframe src="'' + tracker + ''" height="400" width="400"></iframe>'');\r\n                                </script>\r\n                                <noscript>\r\n                                        <!-- No JS fallback, we lose referrer and message, but can still see unique hits -->\r\n                                        <iframe src="<?php echo $tracker; ?>&map;message=No+JS" height="400" width="400"></iframe>\r\n                                </noscript>\r\n                        <body>\r\n                </html>\r\n        <?php\r\n}\r\n//Tracker which logs requests (to temp session) and displays captured info.\r\nfunction showTracker() {\r\n        $id = $_GET[''id''];\r\n        //Initialise session (used for storing messages on server only). No cookies.\r\n        ini_set(''session.use_cookies'', 0);\r\n        session_id(''tracker-'' . md5($id));\r\n        session_start();\r\n        //Get previous messages, trim and prepend the new message.\r\n        $messages = isset($_SESSION[''messages'']) ? $_SESSION[''messages''] : array();\r\n        array_slice($messages, 0, 10);\r\n        array_unshift($messages, $_GET[''message'']);\r\n        //Save messages array\r\n        $_SESSION[''messages''] = $messages;\r\n        $_SESSION[''hitcount''] = (int)$_SESSION[''hitcount''] + 1;\r\n        session_write_close();\r\n        ?>\r\n                <html>\r\n                        <body>\r\n                                <h2>Tracker</h2>\r\n                                ID: <?php echo htmlspecialchars($_GET[''id'']); ?><br />\r\n                                Time: <?php echo date(''H:i:s''); ?><br />\r\n                                Referrer: <?php echo htmlspecialchars($_GET[''referrer'']); ?><br />\r\n                                Hit count: <?php echo htmlspecialchars($_SESSION[''hitcount'']); ?><br />\r\n                                Last Message: <?php echo htmlspecialchars($_GET[''message'']); ?><br />\r\n                                <br />\r\n                                <?php echo implode(''<br />'', array_map(''htmlspecialchars'', $messages)); ?>\r\n                        </body>\r\n                </html>\r\n        <?php\r\n}\r\n		', 'tracker', 'php', 'php'),
(209, 'submit when you hit enter IE', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<?php\r\nif(isset($_POST[''s_message''])) {\r\n	ECHO $_POST[''s_message''];\r\n}\r\n?>\r\n\r\n<link type="text/css" rel="stylesheet" href="styles.css" />\r\n<form class="submit_form" method="post" >\r\n <div>\r\n <img src="../images/chat.jpg" alt="chat" height="22"/>\r\n <input type="text" size="45" name="s_message" />\r\n <input type="submit" value="Say" name="s_say"  style="height:0px; width:0px; border:0px;"/>\r\n </div>\r\n</form>\r\n<script type="text/javascript">\r\nfunction addInputSubmitEvent(form, input) {\r\n    input.onkeydown = function(e) {\r\n        e = e || window.event;\r\n        if (e.keyCode == 13) {\r\n            form.submit();\r\n            return false;\r\n        }\r\n    };\r\n}\r\n\r\nwindow.onload = function() {\r\n    var forms = document.getElementsByTagName(''form'');\r\n\r\n    for (var i=0;i < forms.length;i++) {\r\n        var inputs = forms[i].getElementsByTagName(''input'');\r\n\r\n        for (var j=0;j < inputs.length;j++)\r\n            addInputSubmitEvent(forms[i], inputs[j]);\r\n    }\r\n};\r\n</script>', 'HitEnterSubmit', 'php', 'php'),
(210, 'Remove underline from hyperlink,href, mouse cursors', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml"><head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\r\n<title>How to Remove underline from hyperlink</title>\r\n<style type="text/css" media="screen">\r\na {\r\ntext-decoration: none;\r\n}\r\n</style>\r\n<body>\r\n<a href=''http://www.yahoo.com/'' style=''text-decoration: none;''>yahoo!</a>\r\n\r\n</body>\r\n</html>', 'RemoveUnderline', 'html', 'html'),
(211, 'encode and decode', '<?php\r\n$cloak_keyword = "raymondhuang";\r\n\r\nclass endec {\r\n	\r\n	public function new_encode($string) {\r\n	    global $cloak_keyword;\r\n	    $key = sha1($cloak_keyword);\r\n	    $strLen = strlen($string);\r\n	    $keyLen = strlen($key);\r\n		$hash = '''';\r\n	    $j = 0;\r\n	    for ($i = 0; $i < $strLen; $i++) {\r\n			$ordStr = ord(substr($string,$i,1));\r\n			if ($j == $keyLen) { $j = 0; }\r\n			$ordKey = ord(substr($key,$j,1));\r\n			$j++;\r\n			$hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));\r\n	    }\r\n	    return $hash;\r\n	}\r\n\r\n	public function new_decode($string) {\r\n	    global $cloak_keyword;\r\n	    $key = sha1($cloak_keyword);\r\n	    $strLen = strlen($string);\r\n	    $keyLen = strlen($key);\r\n		$hash = '''';\r\n	    $j = 0;\r\n	    for ($i = 0; $i < $strLen; $i+=2) {\r\n			$ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));\r\n			if ($j == $keyLen) { $j = 0; }\r\n			$ordKey = ord(substr($key,$j,1));\r\n			$j++;\r\n			$hash .= chr($ordStr - $ordKey);\r\n	    }\r\n	    return $hash; \r\n	} \r\n	\r\n} \r\n$e = new endec();  \r\n$testing = $e->new_encode("this is a testing");\r\necho $testing;\r\necho "<br/>";\r\necho $e->new_decode($testing);\r\n?>		', 'endec', 'php', 'php'),
(212, 'submit when you hit enter IE', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<?php\r\n function getBrowser() \r\n{ \r\n    $u_agent = $_SERVER[''HTTP_USER_AGENT'']; \r\n    $bname = ''Unknown'';\r\n     $platform = ''Unknown'';\r\n     $version= "";\r\n \r\n    //First get the platform?\r\n     if (preg_match(''/linux/i'', $u_agent)) {\r\n         $platform = ''linux'';\r\n     }\r\n     elseif (preg_match(''/macintosh|mac os x/i'', $u_agent)) {\r\n         $platform = ''mac'';\r\n     }\r\n     elseif (preg_match(''/windows|win32/i'', $u_agent)) {\r\n         $platform = ''windows'';\r\n     }\r\n     \r\n    // Next get the name of the useragent yes seperately and for good reason\r\n     if(preg_match(''/MSIE/i'',$u_agent) && !preg_match(''/Opera/i'',$u_agent)) \r\n    { \r\n        $bname = ''Internet Explorer''; \r\n        $ub = "MSIE"; \r\n    } \r\n    elseif(preg_match(''/Firefox/i'',$u_agent)) \r\n    { \r\n        $bname = ''Mozilla Firefox''; \r\n        $ub = "Firefox"; \r\n    } \r\n    elseif(preg_match(''/Chrome/i'',$u_agent)) \r\n    { \r\n        $bname = ''Google Chrome''; \r\n        $ub = "Chrome"; \r\n    } \r\n    elseif(preg_match(''/Safari/i'',$u_agent)) \r\n    { \r\n        $bname = ''Apple Safari''; \r\n        $ub = "Safari"; \r\n    } \r\n    elseif(preg_match(''/Opera/i'',$u_agent)) \r\n    { \r\n        $bname = ''Opera''; \r\n        $ub = "Opera"; \r\n    } \r\n    elseif(preg_match(''/Netscape/i'',$u_agent)) \r\n    { \r\n        $bname = ''Netscape''; \r\n        $ub = "Netscape"; \r\n    } \r\n    \r\n    // finally get the correct version number\r\n     $known = array(''Version'', $ub, ''other'');\r\n     $pattern = ''#(?<browser>'' . join(''|'', $known) .\r\n     '')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#'';\r\n     if (!preg_match_all($pattern, $u_agent, $matches)) {\r\n         // we have no matching number just continue\r\n     }\r\n     \r\n    // see how many we have\r\n     $i = count($matches[''browser'']);\r\n     if ($i != 1) {\r\n         //we will have two since we are not using ''other'' argument yet\r\n         //see if version is before or after the name\r\n         if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){\r\n             $version= $matches[''version''][0];\r\n         }\r\n         else {\r\n             $version= $matches[''version''][1];\r\n         }\r\n     }\r\n     else {\r\n         $version= $matches[''version''][0];\r\n     }\r\n     \r\n    // check if we have a number\r\n     if ($version==null || $version=="") {$version="?";}\r\n     \r\n    return array(\r\n         ''userAgent'' => $u_agent,\r\n         ''name''      => $bname,\r\n         ''version''   => $version,\r\n         ''platform''  => $platform,\r\n         ''pattern''    => $pattern\r\n     );\r\n } \r\n\r\n $ua=getBrowser();\r\n if(isset($_POST[''s_message''])) {\r\n	ECHO $_POST[''s_message''];\r\n}\r\n ?>\r\n\r\n<form action="" class="submit_form" method="post" >\r\n <div>\r\n <img src="images/chat.jpg" alt="chat" height="22"/>\r\n<?php if($ua[''name''] == ''Internet Explorer'') {\r\necho <<<_END\r\n<div style="display:none;">\r\n <input style=”border:0; width:0; height:0? type=”text” size=”0? maxlength=”0?  />\r\n </div>\r\n_END;\r\n}\r\n?>\r\n <input type="text" size="45" name="s_message" style="border-color:#0000ff;border-style:ridge;" />\r\n<?php \r\nif($ua[''name''] == ''Internet Explorer'')\r\n	echo ''<input type="submit" value="Say" name="s_say"/>'';\r\nelse \r\n	echo ''<input type="submit" value="Say" name="s_say"  style="height:0px; width:0px; border:0px;"/>'';\r\n?> \r\n </div>\r\n</form>\r\n		', 'HitEnterSubmit2', 'php', 'php'),
(213, 'mouse cursor code', 'http://www.quackit.com/html/codes/html_cursor_code.cfm		', 'mouseCursor', 'link', 'link'),
(214, 'Retrieve Current Date Time in SQL Server', '<?php\r\n$result=mysql_query("SELECT CURRENT_TIMESTAMP");\r\n	while($row = mysql_fetch_array($result))\r\n	{\r\n	 echo "Retrieve Current Date Time in SQL Server :   " . $row[0];\r\n	}\r\necho "<br/>Retrieve Current Date Time with PHP code :";\r\necho date(''Y-m-d H:i:s'');\r\n\r\n?> ', 'CurrentDateTime', 'php', 'php'),
(215, 'Enable/Disable fields', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml"><head>\r\n<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">\r\n	<title>Enable/Disable fields</title>\r\n	<link type="text/css" rel="stylesheet" href="../css/test.css">\r\n<script type="text/javascript">\r\nfunction FieldCtrl(Ctrl) {\r\n	if(Ctrl == 0){ \r\n	alert(''Field disabled'');\r\n	document.getElementById(''start_date'').disabled=true; \r\n	document.getElementById(''amount'').disabled=true;\r\n	} \r\n	else { \r\n	alert(''Field enabled'');\r\n	document.getElementById(''start_date'').disabled=false;\r\n	document.getElementById(''amount'').disabled=false;\r\n	}\r\n}\r\n</script> 	\r\n</head>\r\n<body>\r\n			<select name="frequency" id="frequency" class="reqd"  style="font-size:40px;border-color:#ff0000;border-width: 7px;" onchange="FieldCtrl(this.value)">\r\n				<option value=''0''>Disable Field</option>\r\n				<option value=''1''>Enable Field</option>\r\n			</select>\r\n		    <input type="text" name="amount" id="amount" size="8" maxlength="8" style="font-size:40px;border-color:#ff0000;border-width: 7px;border-style:ridge;"  value="0" disabled="disabled">\r\n			\r\n			<input type="text" size="10" name="start_date" id="start_date"  value="" style="font-size:40px;border-color:#ff0000;border-width: 7px;" disabled="disabled">\r\n\r\n</body>\r\n</html>		', 'Disable_field', 'html', 'html'),
(216, 'Reset AUTO_INCREMENT to 0', 'TRUNCATE TABLE TABLENAME;\r\nALTER TABLE TABLENAME AUTO_INCREMENT = 0;', 'reset', 'txt', 'txt'),
(217, 'post string with space javascript encode', 'use javascript: encodeURIComponent() to post string with space', 'post_space', 'txt', 'txt');
INSERT INTO `main` (`id`, `ShortDesc`, `Source`, `Name`, `Ext`, `SearchGroup`) VALUES
(218, 'special character  replacement macro', 'Save the word document to plain text file \r\nThen choose other encoding-> Western European(Windows) or other encoding(Unicode(UTF-8)) for special character converting\r\n\r\nSub accents()\r\n''\r\n'' Accents Macro\r\n''\r\n''\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="á", ReplaceWith:="&aacute;", _\r\n    Replace:=wdReplaceAll\r\n    \r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="é", ReplaceWith:="&eacute;", _\r\n    Replace:=wdReplaceAll\r\n    \r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="í", ReplaceWith:="&iacute;", _\r\n   Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ó", ReplaceWith:="&oacute;", _\r\n    Replace:=wdReplaceAll\r\n    \r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ú", ReplaceWith:="&uacute;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Á", ReplaceWith:="&Aacute;", _\r\n    Replace:=wdReplaceAll\r\n    \r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="É", ReplaceWith:="&Eacute;", _\r\n    Replace:=wdReplaceAll\r\n    \r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Í", ReplaceWith:="&Iacute;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ó", ReplaceWith:="&Oacute;", _\r\n    Replace:=wdReplaceAll\r\n    \r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ú", ReplaceWith:="&Uacute;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ñ", ReplaceWith:="&ntilde;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ñ", ReplaceWith:="&Ntilde;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="º", ReplaceWith:="&ordm;", _\r\n    Replace:=wdReplaceAll\r\n    \r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="¿", ReplaceWith:="&iquest;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ç", ReplaceWith:="&ccedil;", _\r\n    Replace:=wdReplaceAll\r\n    \r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ã", ReplaceWith:="&atilde;", _\r\n    Replace:=wdReplaceAll\r\n    \r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="€", ReplaceWith:="&euro;", _\r\n    Replace:=wdReplaceAll\r\n    \r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="õ", ReplaceWith:="&otilde;", _\r\n    Replace:=wdReplaceAll\r\n    \r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="-", ReplaceWith:="&ndash;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="-", ReplaceWith:="&mdash;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="¡", ReplaceWith:="&iexcl;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="''", ReplaceWith:="&lsquo;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="''", ReplaceWith:="&rsquo;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="¢", ReplaceWith:="&cent;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="©", ReplaceWith:="&copy;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="÷", ReplaceWith:="&divide;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:=">", ReplaceWith:="&gt;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="<", ReplaceWith:="&lt;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="µ", ReplaceWith:="&micro;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="±", ReplaceWith:="&plusmn;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="£", ReplaceWith:="&pound;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="®", ReplaceWith:="&reg;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="§", ReplaceWith:="&sect;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="™", ReplaceWith:="&trade;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="¥", ReplaceWith:="&yen;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="à", ReplaceWith:="&agrave;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="À", ReplaceWith:="&Agrave;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="â", ReplaceWith:="&acirc;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Â", ReplaceWith:="&Acirc;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="å", ReplaceWith:="&aring;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Å", ReplaceWith:="&Aring;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ã", ReplaceWith:="&Atilde;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ä ", ReplaceWith:="&auml;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ä", ReplaceWith:="&Auml;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="æ", ReplaceWith:="&aelig;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Æ", ReplaceWith:="&AElig;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="è", ReplaceWith:="&egrave;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="È", ReplaceWith:="&Egrave;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ê", ReplaceWith:="&ecirc;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ê", ReplaceWith:="&Ecirc;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ë", ReplaceWith:="&euml;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ë", ReplaceWith:="&Euml;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ì", ReplaceWith:="&igrave;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ì", ReplaceWith:="&Igrave;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="î", ReplaceWith:="&icirc;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Î", ReplaceWith:="&Icirc;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ï", ReplaceWith:="&iuml;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ï", ReplaceWith:="&Iuml;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ò", ReplaceWith:="&ograve;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ò", ReplaceWith:="&Ograve;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ô", ReplaceWith:="&ocirc;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ô", ReplaceWith:="&Ocirc;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ø", ReplaceWith:="&oslash;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ø", ReplaceWith:="&Oslash;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ö", ReplaceWith:="&ouml;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ö", ReplaceWith:="&Ouml;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ß", ReplaceWith:="&szlig;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ù", ReplaceWith:="&ugrave;", _\r\n    Replace:=wdReplaceAll\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ù", ReplaceWith:="&Ugrave;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="û", ReplaceWith:="&ucirc;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Û", ReplaceWith:="&Ucirc;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ü", ReplaceWith:="&uuml;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="Ü", ReplaceWith:="&Uuml;", _\r\n    Replace:=wdReplaceAll\r\n\r\nSet myRange = ActiveDocument.Content\r\nmyRange.Find.Execute FindText:="ÿ", ReplaceWith:="&yuml;", _\r\n    Replace:=wdReplaceAll\r\n       \r\nEnd Sub', 'replacement', 'txt', 'txt'),
(219, 'input field automatic expend to 100%', '<style type="text/css">\r\n.wide {display:block; width: 99%} \r\n</style>\r\n<select name="pay_frq" id="pay_frq" class="wide" style="font-size:30px;border-color:#5050FF;border-width: 3px;">\r\n<option>testing</option>\r\n</select>', 'autoexpend.html', 'html', 'html'),
(220, 'Time different sql', 'SELECT TIMESTAMPDIFF(HOUR,''2009-01-01 00:00:00'',''2010-01-01 00:00:00'');	\r\n\r\n/* FRAC_SECOND (microseconds), SECOND, MINUTE, HOUR, DAY, WEEK, MONTH, QUARTER, or YEAR. */	', 'timediff', 'txt', ''),
(221, 'include music to the site', '<html>\r\n<body>\r\n<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" id="niftyPlayer1" align="" width="165" height="38">\r\n	<param name="movie" value="http://dev.mundomediainc.com/www.mundomedia.com/vegasparty2012/niftyplayer.swf?file=http://dev.mundomediainc.com/www.mundomedia.com/vegasparty2012/192744_SOUNDDOGS__he.mp3&as=1">\r\n	<param name="quality" value="high">\r\n\r\n	<param name="bgcolor" value="#FFFFFF">\r\n	<embed src="http://dev.mundomediainc.com/www.mundomedia.com/vegasparty2012/niftyplayer.swf?file=http://dev.mundomediainc.com/www.mundomedia.com/vegasparty2012/192744_SOUNDDOGS__he.mp3&as=1" quality=high bgcolor="#FFFFFF" width="165" height="38" name="niftyPlayer1" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>\r\n</object>\r\n</body>\r\n</html>		', 'music', 'html', ''),
(222, 'special character inside javascript alert box', 'http://www.fileformat.info/info/unicode/char/search.htm\r\n/*String.fromCharCode(174)*/', 'javascriptalert', 'link', ''),
(223, 'Invoking javascript in child window from parent page iframe', '<!DOCTYPE html>\r\n<html><head>\r\n<meta http-equiv="content-type" content="text/html; charset=UTF-8">\r\n<title>Invoking javascript in child window from parent page</title>\r\n\r\n</head>\r\n<body>\r\n<body>\r\n<input type="button" name="start" value="Call child script" id="Chat" width="40" onClick="call();">\r\n\r\n<iframe src="InvokeChildScript2.html" height="380" width="645" id="ChatFrame" frameborder=1 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#E6FFE6;display:none;">\r\n  <p>Your browser does not support iframes.</p>\r\n</iframe>\r\n</body>\r\n<script type="text/javascript">\r\nfunction call()  \r\n{\r\n	document.getElementById(''ChatFrame'').contentWindow.call(); \r\n}	\r\n</script>\r\n</html>		', 'InvokeChildScript', 'html', ''),
(224, 'Invoking javascript in child window from parent page iframe', '<script type="text/javascript">\r\nfunction call() {\r\n	alert("this is a testing");\r\n}\r\n</script>		', 'InvokeChildScript2', 'html', ''),
(225, 'Invoking javascript in parent window from child page iframe', '<!DOCTYPE html>\r\n<html><head>\r\n<meta http-equiv="content-type" content="text/html; charset=UTF-8">\r\n<title>Invoking javascript in parent window from child page</title>\r\n\r\n</head>\r\n<body>\r\n\r\n<iframe src="InvokeParentScript2.html" height="380" width="645" id="ChatFrame" frameborder=1 SCROLLING=no allowTransparency="false">\r\n  <p>Your browser does not support iframes.</p>\r\n</iframe>\r\n</body>\r\n<script> \r\n \r\nfunction abc() \r\n{ \r\n    alert("sss"); \r\n} \r\n</script> \r\n</html>		', 'InvokeParentScript', 'html', ''),
(226, 'Invoking javascript in parent window from child page iframe', '<!DOCTYPE html>\r\n<html><head>\r\n<meta http-equiv="content-type" content="text/html; charset=UTF-8">\r\n<title>Invoking javascript in parent window from child page</title>\r\n\r\n</head>\r\n<body>\r\n<input type="button" name="start" value="Call Parent script" id="Chat" width="40" onClick="parent.abc();">\r\n</body>\r\n</html>		', 'InvokeParentScript2', 'html', ''),
(227, 'slideshow', 'http://jquery.malsup.com/cycle/int2.html		', '', 'link', ''),
(228, 'repost posting data', '<script type="text/javascript" >\r\n\r\nfunction user_info()  \r\n{\r\n	var plugName="";\r\n	var numPlugins = navigator.plugins.length;\r\n	if (numPlugins > 0)\r\n	{\r\n		for (i = 0; i < numPlugins; i++) {\r\n			plugin = navigator.plugins[i];\r\n			plugName=plugName+"&plugName"+i+"="+plugin.name;\r\n\r\n		}\r\n		window.open(''../PHP/repost2.php?''+plugName,target=''_top'');;\r\n		\r\n	}\r\n}\r\n\r\n</script>\r\n<input type="button" onclick="user_info();" value="go">\r\n\r\n		', 'repost', 'html', ''),
(229, 'repost posting data', '<?php\r\n\r\n		foreach($_REQUEST as $name => $value) {\r\n			echo "<input type=\\"text\\" name=\\"$name\\" value=\\"$value\\">";\r\n		}\r\n		\r\n?>				', 'repost2', 'php', ''),
(230, 'ajax jquery call without load data and post variables ', 'function ajax_call(phone,phone2,phone3) \r\n{ \r\n	var t=new Date().getTime();\r\n    $.ajax({ \r\n       type: "POST", \r\n       url: "http://" + document.domain + "/api_subc_lp.php",\r\n       data: "phone="+phone+"&phone2="+phone2+"&phone3="+phone3+"&t="+t, \r\n       success: function(msg){ \r\n         alert( "Sing up successfully: " + msg ); //Anything you want \r\n       }, \r\n		error:function (xhr, ajaxOptions, thrownError){ \r\n                    alert(xhr.status); \r\n                    alert(thrownError); \r\n        }     	   \r\n     }); \r\n}', 'ajax_call', 'js', ''),
(231, 'Image rattle', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">\r\n<head>\r\n<meta http-equiv="content-type" content="text/html; charset=UTF-8" />\r\n<meta http-equiv="Content-Style-Type" content="text/css" />\r\n<title>JQuery Media Plugin - Audio Demo</title>\r\n<style>\r\n.shakeimage{\r\nposition:relative\r\n}\r\n</style>\r\n</head>\r\n<body>\r\n<a href="step-2.html"><img src="../images/details.gif" class="shakeimage" onMouseover="init(this);rattleimage()" onMouseout="stoprattle(this);top.focus()" onClick="top.focus()" border="0"></a>\r\n<script type="text/javascript">\r\n//configure shake degree (where larger # equals greater shake)\r\nvar rector=3\r\n\r\n///////DONE EDITTING///////////\r\nvar stopit=0 \r\nvar a=1\r\n\r\nfunction init(which){\r\nstopit=0\r\nshake=which\r\nshake.style.left=0\r\nshake.style.top=0\r\n}\r\nfunction rattleimage(){\r\nif ((!document.all&&!document.getElementById)||stopit==1)\r\nreturn\r\nif (a==1){\r\nshake.style.top=parseInt(shake.style.top)+rector+"px"\r\n}\r\nelse if (a==2){\r\nshake.style.left=parseInt(shake.style.left)+rector+"px"\r\n}\r\nelse if (a==3){\r\nshake.style.top=parseInt(shake.style.top)-rector+"px"\r\n}\r\nelse{\r\nshake.style.left=parseInt(shake.style.left)-rector+"px"\r\n}\r\nif (a<4)\r\na++\r\nelse\r\na=1\r\nsetTimeout("rattleimage()",50)\r\n}\r\nfunction stoprattle(which){\r\nstopit=1\r\nwhich.style.left=0\r\nwhich.style.top=0\r\n}\r\n</script>\r\n</body>\r\n</html>\r\n		', 'ImageRattle', 'html', ''),
(233, 'tooltip message display message over image', '<input type="image" src="../images/profile.png" name="Profile" id="Profile" value="Profile" width="40" onclick="window.open(''ChangeProfile.php'',target=''_top'');">\r\n\r\n<script src="../scripts/jquery.js"></script>\r\n<script type="text/javascript" >\r\n$("#Profile").attr(''title'', ''This is the hover-over text''); \r\n</script>		', 'tooltip', 'html', ''),
(237, 'remove IE space between images', 'define a class img for each images you want to remove space\r\nand add this to the stylesheet\r\n\r\n.img{  \r\ndisplay:block;  \r\n}  \r\n		', 'removeSpace', 'txt', ''),
(238, 'special character  search', 'http://www.fileformat.info/info/unicode/char/search.htm		', 'special_character', 'link', ''),
(239, 'slider', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml"><head>\r\n<title>Javascript Slider</title>\r\n<meta http-equiv="content-type" content="text/html; charset=UTF-8">\r\n<meta http-equiv="Content-Style-Type" content="text/css">\r\n<!-- The slider javascript code -->\r\n<script type="text/javascript" src="../scripts/slider.js"></script>\r\n<!--\r\nslide(event, ''[id of the slider itself]'',\r\n     [''horizontal'' or ''vertical''],\r\n     [the slider length in pixels (integer)],\r\n     [the minimum display value],\r\n     [the maximum display value],\r\n     [the number of accepted values in the interval],\r\n     [number of decimals to display],\r\n     ''[id of the display]'')\r\n-->\r\n<!-- The default slider stylessheet -->\r\n<link href="../css/default.css" rel="stylesheet" type="text/css">\r\n<!-- The page stylesheet below contains modifications to the default slider and page specific styling -->\r\n<style type="text/css">\r\n/* Stylesheet for sliders (only properties that differ from default) */\r\n#horizontal_slider_1 {\r\n	background-color: #696;\r\n	border-color: #9c9 #363 #363 #9c9;\r\n	}\r\n#horizontal_track_1, #display_holder_1 {\r\n	background-color: #bdb;\r\n	border-color: #ded #9a9 #9a9 #ded;\r\n	}\r\n#horizontal_slit_1 {\r\n	background-color: #232;\r\n	border-color: #9a9 #ded #ded #9a9;\r\n	}\r\n#value_display_1 {\r\n	background-color: #bdb;\r\n	color: #363;\r\n	}\r\n\r\n#horizontal_track_5, #display_holder_5 {\r\n	background-color: #fff;\r\n	border: #fff;\r\n	}\r\n#horizontal_slit_5 {\r\n	background-color: #000;\r\n	border-color: #999 #fff #fff #999;\r\n	}\r\n#value_display_5 {\r\n	background-color: #fff;\r\n	color: #666;\r\n	}\r\n</style>\r\n</head>\r\n\r\n<body>\r\n<div class="content">\r\n<script type="text/javascript" src="../scripts/show_ads.js"></script>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\n	<!-- Horizontal slider 1 (green) -->\r\n	<div class="horizontal_track" id="horizontal_track_1">\r\n		<div class="horizontal_slit" id="horizontal_slit_1">&nbsp;</div>\r\n		<div class="horizontal_slider" id="horizontal_slider_1" style="left: 0px; top: 0px;" onmousedown="slide(event, ''horizontal'', 100, -255, 255, 0, 0, ''value_display_1'');">&nbsp;</div>\r\n	</div>\r\n</td>\r\n<td>\r\n	<!-- Value display 1 (green) -->\r\n	<div class="display_holder" id="display_holder_1">\r\n		<input class="value_display" id="value_display_1" value="0" onfocus="blur(this);" type="text">\r\n	</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n	<!-- Horizontal slider 5 (transparent) -->\r\n	<div class="horizontal_track" id="horizontal_track_5">\r\n		<div class="horizontal_slit" id="horizontal_slit_5">&nbsp;</div>\r\n		<div class="horizontal_slider" id="horizontal_slider_5" style="left: 50px;" onmousedown="slide(event, ''horizontal'', 100, 0, 100, 100, 1, ''value_display_5'');">&nbsp;</div>\r\n	</div>\r\n</td>\r\n<td>\r\n	<!-- Value display 5 (transparent) -->\r\n	<div class="display_holder" id="display_holder_5">\r\n		<input class="value_display" id="value_display_5" value="50" onfocus="blur(this);" type="text">\r\n	</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n\r\n<table>\r\n<tbody><tr>\r\n<td>\r\n	<!-- Vertical slider 1 (default color - grey) -->\r\n	<div class="vertical_track" style="height: 50px">\r\n		<div class="vertical_slit" style="height: 50px">&nbsp;</div>\r\n		<div class="vertical_slider" id="vertical_slider_1" style="top: 20px;" onmousedown="slide(event, ''vertical'', 50, -25, 25, 51, 0, ''vertical_display_1'');">\r\n			&nbsp;\r\n		</div>\r\n	</div>\r\n</td>\r\n<td>\r\n	<!-- Vertical slider 2 (default color - grey) -->\r\n	<div class="vertical_track" style="height: 50px">\r\n		<div class="vertical_slit" style="height: 50px">&nbsp;</div>\r\n		<div class="vertical_slider" id="vertical_slider_2" style="top: 25px;" onmousedown="slide(event, ''vertical'', 50, -250, 250, 51, 0, ''vertical_display_2'');">&nbsp;</div>\r\n	</div>\r\n</td>\r\n<td>\r\n	<!-- Vertical slider 3 (default color - grey) -->\r\n	<div class="vertical_track" style="height: 50px">\r\n		<div class="vertical_slit" style="height: 50px">&nbsp;</div>\r\n		<div class="vertical_slider" id="vertical_slider_3" style="top: 30px;" onmousedown="slide(event, ''vertical'', 50, -2.5, 2.5, 51, 1, ''vertical_display_3'');">&nbsp;</div>\r\n	</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n	<div class="display_holder">\r\n		<input class="value_display" id="vertical_display_1" value="5" onfocus="blur(this);" type="text">\r\n	</div>\r\n</td>\r\n<td>\r\n	<div class="display_holder">\r\n		<input class="value_display" id="vertical_display_2" value="0" onfocus="blur(this);" type="text">\r\n	</div>\r\n</td>\r\n<td>\r\n	<div class="display_holder">\r\n		<input class="value_display" id="vertical_display_3" value="-0.5" onfocus="blur(this);" type="text">\r\n	</div>\r\n</td>\r\n</tr>\r\n</tbody></table>\r\n\r\n\r\n</body></html>		', 'Slider', 'html', ''),
(236, 'jquery colorbox object on top', '	function set_link() {\r\n$("#ringtones_list").colorbox({ \r\n    href:link, \r\n    data: enc, \r\n    onOpen: function(){ \r\n        $(''#ringtones_list'').css(''visibility'',''hidden''); \r\n    }, \r\n    onClosed: function(){ \r\n    $(''#ringtones_list'').css(''visibility'',''visible''); \r\n    }, \r\n    loop: false, \r\n    opacity: 0.5 \r\n}); \r\n}			', 'colorbox', 'txt', ''),
(240, 'Sure Remove Directory also works on hidden files', '<?php\r\nfunction SureRemoveDir($dir, $DeleteMe) {\r\n    if(!$dh = @opendir($dir)) return;\r\n    while (false !== ($obj = readdir($dh))) {\r\n        if($obj==''.'' || $obj==''..'') continue;\r\n        if (!@unlink($dir.''/''.$obj)) SureRemoveDir($dir.''/''.$obj, true);\r\n    }\r\n\r\n    closedir($dh);\r\n    if ($DeleteMe){\r\n        @rmdir($dir);\r\n    }\r\n}		', 'SureRemoveDir', 'php', ''),
(241, 'difference in timezone is between the web browser client and the web server', '<?php\r\ninclude("../config.php");\r\n$result=mysql_query("SELECT CURRENT_TIMESTAMP");\r\nwhile($row = mysql_fetch_array($result))\r\n{\r\n $now = strtotime($row[0]);\r\n}\r\n$now2=strtotime(date("Y-m-d H:i:s")) ;\r\n$diff_in_second=$now2-$now;\r\n?> \r\n\r\n<script language="Javascript">\r\nvar diff_in_second=<?php echo $diff_in_second; ?>;\r\nwindow.alert("different in second: "+diff_in_second);\r\nvar dt = new Date();\r\nwindow.alert("different in min: "+dt.getTimezoneOffset());\r\n\r\n// OR\r\n\r\n//window.alert(new Date().getTimezoneOffset());\r\n\r\n</script>', 'timediff', 'php', '');

-- --------------------------------------------------------

--
-- Table structure for table `philosophy`
--

CREATE TABLE IF NOT EXISTS `philosophy` (
  `id` int(11) NOT NULL,
  `religion` varchar(30) NOT NULL,
  `relig_description` varchar(1000) NOT NULL,
  `political_views` varchar(30) NOT NULL,
  `view_description` varchar(1000) NOT NULL,
  `inspire_you` varchar(30) NOT NULL,
  `favorite_quotations` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `picture_video`
--

CREATE TABLE IF NOT EXISTS `picture_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_path` char(30) NOT NULL,
  `picture_video` char(10) NOT NULL DEFAULT 'pictures',
  `viewer_group` char(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comments` varchar(4000) NOT NULL,
  `upload_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`viewer_group`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=215 ;

--
-- Dumping data for table `picture_video`
--

INSERT INTO `picture_video` (`id`, `owner_path`, `picture_video`, `viewer_group`, `name`, `comments`, `upload_id`) VALUES
(212, 'raymond3', 'pictures', '', '../pictures/raymond3/M1190040.JPG', '', 6),
(213, 'raymond3', 'pictures', 'Public', '../pictures/eccbc87e4b5ce2fe28308fd9f2a7baf3M1170008.JPG', '', 7),
(214, 'raymond3', 'pictures', '', '../pictures/raymond3/DSC06132.jpg', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `profile_picture`
--

CREATE TABLE IF NOT EXISTS `profile_picture` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `profile_picture` varchar(200) NOT NULL,
  UNIQUE KEY `profile` (`id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_picture`
--

INSERT INTO `profile_picture` (`id`, `user_id`, `profile_picture`) VALUES
(1, 3, '../images/profile/raymond3/M1190018.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `pv_comment`
--

CREATE TABLE IF NOT EXISTS `pv_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `PV_id` bigint(20) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `viewer_user_id` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0-picture,1-video',
  `comment` varchar(200) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pv_share`
--

CREATE TABLE IF NOT EXISTS `pv_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pv_id` int(11) NOT NULL,
  `sharefm_id` bigint(20) NOT NULL,
  `shareto_id` bigint(20) NOT NULL,
  `pv_name` varchar(255) NOT NULL,
  `accept` tinyint(4) NOT NULL COMMENT '0-accept,1,waiting',
  `is_video` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `viewer_id` (`shareto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `spendcode`
--

CREATE TABLE IF NOT EXISTS `spendcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description` (`description`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `spendcode`
--

INSERT INTO `spendcode` (`id`, `description`) VALUES
(1, 'Hair Cut'),
(2, '01.Eat Out'),
(3, 'Family Entertainment'),
(4, '05.Shopping'),
(5, '08.Grocery'),
(6, '02.Spend on Car-gas'),
(7, 'Snack'),
(8, 'Electronic item'),
(9, 'Electricity and Water'),
(10, 'Insurance'),
(11, '10.Party and Gift'),
(12, 'Kids Reward'),
(13, 'School'),
(14, 'Repair'),
(15, 'Heathy Food'),
(17, 'Consumer Gas'),
(18, 'Property Tax'),
(19, 'Home Phone'),
(20, 'Cellular Phone'),
(21, 'Internet'),
(22, 'Television'),
(23, 'Mortgage'),
(24, '09.Money to Elaine'),
(25, 'RSP CONTRIBUTION'),
(26, 'Unexpected(others)'),
(27, '06.Clothes,pants'),
(28, '07.shoes'),
(29, '04.Spend on Car Others'),
(30, 'Printer Ink'),
(31, '03.Spend on Car-Parking'),
(32, 'face care product'),
(33, 'oral care'),
(34, 'C.S.T. PLAN for Kids'),
(35, 'Dental expend');

-- --------------------------------------------------------

--
-- Table structure for table `spender`
--

CREATE TABLE IF NOT EXISTS `spender` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `spender`
--

INSERT INTO `spender` (`id`, `user_id`, `name`) VALUES
(1, 3, 'Me'),
(2, 3, 'Elaine'),
(3, 4, 'Me');

-- --------------------------------------------------------

--
-- Table structure for table `spending`
--

CREATE TABLE IF NOT EXISTS `spending` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `expenses` varchar(100) NOT NULL,
  `code` char(30) NOT NULL,
  `detail` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `paid_date` date NOT NULL,
  `whospend` tinytext NOT NULL,
  `spender_id` tinyint(1) NOT NULL,
  `type_id` tinyint(2) NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `bank_id` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1024 ;

--
-- Dumping data for table `spending`
--

INSERT INTO `spending` (`id`, `user_id`, `category_id`, `item_id`, `comment_id`, `expenses`, `code`, `detail`, `amount`, `date`, `paid_date`, `whospend`, `spender_id`, `type_id`, `paid`, `bank_id`) VALUES
(4, 3, 11, 64, 0, 'q2a4', 'Unexpected(others)', '', 25, '2011-08-01', '2011-08-01', 'M', 1, 1, 1, 2),
(3, 3, 7, 2, 0, 'r2a4', '01.Eat Out', '', 35, '2011-08-01', '2011-08-01', 'I', 2, 1, 1, 2),
(5, 3, 7, 1, 0, 'q284', '01.Eat Out', '', 23, '2011-08-02', '2011-08-02', 'M', 1, 1, 1, 1),
(6, 3, 6, 46, 0, 'w254', 'Family Entertainment', '', 80, '2011-08-02', '2011-08-02', 'M', 1, 1, 1, 2),
(7, 3, 2, 5, 0, 't254', '02.Spend on Car-Gas', 'car gas', 50, '2011-08-03', '2011-08-03', 'M', 1, 1, 1, 2),
(8, 3, 7, 1, 0, 'r2', '01.Eat Out', 'my lunch', 3, '2011-08-03', '2011-08-03', 'M', 1, 1, 1, 1),
(9, 3, 7, 1, 0, 'r2', '01.Eat Out', 'my lunch', 3, '2011-08-04', '2011-08-04', 'M', 1, 1, 1, 1),
(10, 3, 9, 56, 0, 't2d4', '05.Shopping', 'replace the broke phone', 58, '2011-08-04', '2011-08-04', 'M', 1, 1, 1, 2),
(11, 3, 7, 1, 0, 'w2b4', '01.Eat Out', '', 86, '2011-08-05', '2011-08-05', 'M', 1, 1, 1, 1),
(12, 3, 7, 1, 0, 't2', '01.Eat Out', 'my lunch', 5, '2011-08-06', '2011-08-06', 'M', 1, 1, 1, 1),
(13, 3, 10, 67, 0, 'p294', '08.Grocery', '', 14, '2011-08-06', '2011-08-06', 'M', 1, 1, 1, 2),
(14, 3, 7, 1, 0, 'p254', '01.Eat Out', 'my lunch', 10, '2011-08-07', '2011-08-07', 'M', 1, 1, 1, 1),
(15, 3, 9, 56, 0, 'p25464', '05.Shopping', 'shoes', 105, '2011-08-07', '2011-08-07', 'M', 1, 1, 1, 2),
(16, 3, 7, 1, 0, 'q2', '01.Eat Out', 'my lunch', 2, '2011-08-08', '2011-08-08', 'M', 1, 1, 1, 1),
(17, 3, 7, 1, 0, 's2', '01.Eat Out', 'my lunch', 4, '2011-08-09', '2011-08-09', 'M', 1, 1, 1, 1),
(18, 3, 7, 1, 0, 'v254', '01.Eat Out', '', 70, '2011-08-10', '2011-08-10', 'M', 1, 1, 1, 1),
(19, 3, 7, 1, 0, 't2', '01.Eat Out', '', 5, '2011-08-11', '2011-08-11', 'M', 1, 1, 1, 1),
(20, 3, 6, 46, 0, 'p2a4', 'Family Entertainment', 'toll fee', 15, '2011-08-11', '2011-08-11', 'M', 1, 1, 1, 2),
(21, 3, 2, 5, 0, 'w254', '02.Spend on Car-Gas', 'car gas', 80, '2011-08-11', '2011-08-11', 'M', 1, 1, 1, 2),
(22, 3, 7, 1, 0, 'p27414', '01.Eat Out', '', 120, '2011-08-12', '2011-08-12', 'M', 1, 1, 1, 1),
(23, 3, 9, 56, 0, 'q2a414', '05.Shopping', 'clothes', 250, '2011-08-12', '2011-08-12', 'M', 1, 1, 1, 2),
(24, 3, 9, 56, 0, 'u28414', '05.Shopping', 'shoes, clothes,GPS', 630, '2011-08-14', '2011-08-14', 'M', 1, 1, 1, 2),
(25, 3, 7, 1, 0, 't2', '01.Eat Out', '', 5, '2011-08-15', '2011-08-15', 'M', 1, 1, 1, 1),
(26, 3, 9, 56, 0, 'v2', '05.Shopping', 'cleansers', 7, '2011-08-15', '2011-08-15', 'M', 1, 1, 1, 2),
(27, 3, 10, 67, 0, 'q2a4', '08.Grocery', '', 25, '2011-08-16', '2011-08-16', 'M', 1, 1, 1, 2),
(28, 3, 4, 30, 0, 'p26414', 'Printer Ink', '', 110, '2011-08-16', '2011-08-16', 'M', 1, 1, 1, 2),
(29, 3, 7, 1, 0, 'q2', '01.Eat Out', 'my lunch', 2, '2011-08-17', '2011-08-17', 'M', 1, 1, 1, 1),
(30, 3, 2, 5, 0, 't254', '02.Spend on Car-Gas', 'car gas', 50, '2011-08-18', '2011-08-18', 'M', 1, 1, 1, 2),
(31, 3, 7, 1, 0, 's2', '01.Eat Out', 'my lunch', 4, '2011-08-19', '2011-08-19', 'M', 1, 1, 1, 1),
(32, 3, 6, 46, 0, 't2a4', 'Family Entertainment', 'Taxi for Cruise on company even', 55, '2011-08-26', '2011-08-26', 'M', 1, 1, 1, 2),
(33, 3, 7, 1, 0, 'q2', '01.Eat Out', 'my lunch', 2, '2011-08-22', '2011-08-22', 'M', 1, 1, 1, 1),
(34, 3, 7, 1, 0, 'q2', '01.Eat Out', 'my lunch', 2, '2011-08-23', '2011-08-23', 'M', 1, 1, 1, 1),
(35, 3, 2, 5, 0, 't254', '02.Spend on Car-Gas', 'car gas', 50, '2011-08-24', '2011-08-24', 'M', 1, 1, 1, 2),
(36, 3, 7, 1, 0, 'q264', '01.Eat Out', '', 21, '2011-08-13', '2011-08-13', 'M', 1, 1, 1, 1),
(37, 3, 9, 56, 0, 'p2a414', '05.Shopping', 'shoes', 150, '2011-08-13', '2011-08-13', 'M', 1, 1, 1, 2),
(38, 3, 9, 56, 0, 'p2c414', '05.Shopping', 'Buy Birds', 170, '2011-08-20', '2011-08-20', 'M', 1, 1, 1, 2),
(49, 3, 11, 66, 0, 'p2c414', 'RSP CONTRIBUTION', 'RSP', 170, '2011-08-27', '2011-08-27', 'M', 1, 1, 1, 2),
(50, 3, 4, 26, 0, 'r284', 'Consumer Gas', '', 33, '2011-08-27', '2011-08-27', 'M', 1, 1, 1, 2),
(51, 3, 4, 25, 0, 'v2c4', 'Television', '', 77, '2011-08-27', '2011-08-27', 'M', 1, 1, 1, 2),
(52, 3, 3, 18, 0, 'q2c434', 'Insurance', 'STATE FARM', 272, '2011-08-27', '2011-08-27', 'M', 1, 1, 1, 2),
(53, 3, 4, 23, 0, 'r254', 'Home Phone', '', 30, '2011-08-27', '2011-08-27', 'M', 1, 1, 1, 2),
(54, 3, 4, 29, 0, 'v274', 'Internet', '', 72, '2011-08-27', '2011-08-27', 'M', 1, 1, 1, 2),
(55, 3, 3, 15, 0, 'w25414', 'Mortgage', '', 800, '2011-08-27', '2011-08-27', 'M', 1, 1, 1, 2),
(56, 3, 4, 24, 0, 'p29454', 'Cellular Phone', '', 144, '2011-08-27', '2011-08-27', 'M', 1, 1, 1, 2),
(123, 3, 10, 67, 0, 'w264', '08.Grocery', '', 81, '2011-08-29', '2011-08-29', 'M', 1, 1, 1, 2),
(124, 3, 7, 1, 0, 'x2', '01.Eat Out', '', 9, '2011-08-29', '2011-08-29', 'M', 1, 1, 1, 1),
(133, 3, 7, 1, 0, 'u254', '01.Eat Out', 'with king see and mom,mornning tea', 60, '2011-08-31', '2011-08-31', 'M', 1, 1, 1, 1),
(127, 3, 8, 49, 0, 'q2a4', 'School', '', 25, '2011-08-29', '2011-08-29', 'M', 1, 1, 1, 2),
(128, 3, 9, 56, 0, 'u2', '05.Shopping', 'brush', 6, '2011-08-29', '2011-08-29', 'M', 1, 1, 1, 2),
(134, 3, 2, 5, 0, 't254', '02.Spend on Car-Gas', '', 50, '2011-08-31', '2011-08-31', 'M', 1, 1, 1, 2),
(135, 3, 2, 6, 0, 's2', '03.Spend on Car-Parking', 'parking take mom to see specialist', 4, '2011-08-31', '2011-08-31', 'M', 1, 1, 1, 2),
(136, 3, 8, 49, 0, 'w2', 'School', '', 8, '2011-08-31', '2011-08-31', 'M', 1, 1, 1, 2),
(137, 3, 8, 49, 0, 't254', 'School', 'agenders', 50, '2011-09-01', '2011-09-01', 'M', 1, 1, 1, 2),
(138, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-09-01', '2011-09-01', 'M', 1, 1, 1, 1),
(139, 3, 1, 74, 0, 'p25414', '09.Money to Elaine', '', 100, '2011-09-01', '2011-09-01', 'M', 2, 1, 1, 2),
(140, 3, 10, 67, 0, 'w2d4', '08.Grocery', '', 88, '2011-09-01', '2011-09-01', 'M', 1, 1, 1, 2),
(141, 3, 7, 1, 0, 'p2a4', '01.Eat Out', '', 15, '2011-09-01', '2011-09-01', 'M', 1, 1, 1, 1),
(142, 3, 11, 63, 0, 'w254', '10.Party and Gift', '', 80, '2011-09-01', '2011-09-01', 'I', 2, 1, 1, 2),
(143, 3, 4, 24, 0, 'p26444', 'Cellular Phone', '', 113, '2011-09-02', '2011-09-02', 'M', 1, 1, 1, 2),
(39, 3, 11, 63, 0, 'q28414', '10.Party and Gift', 'Hotel booking', 230, '2011-08-17', '2011-08-17', 'M', 1, 1, 1, 2),
(145, 3, 10, 67, 0, 'p284', '08.Grocery', '', 13, '2011-09-02', '2011-09-02', 'M', 1, 1, 1, 2),
(146, 3, 2, 6, 0, 'w2', '03.Spend on Car-Parking', 'parking to see baby', 8, '2011-09-03', '2011-09-03', 'M', 1, 1, 1, 2),
(147, 3, 1, 74, 0, 'v2a414', '09.Money to Elaine', '', 750, '2011-09-04', '2011-09-04', 'I', 2, 1, 1, 2),
(148, 3, 11, 64, 0, 'p254', 'Unexpected(others)', 'leasing to weiwrong', 10, '2011-09-06', '2011-09-06', 'M', 1, 1, 1, 2),
(149, 3, 8, 49, 0, 'r254', 'School', '30', 30, '2011-09-06', '2011-09-06', 'M', 1, 1, 1, 2),
(150, 3, 8, 49, 0, 'w2', 'School', 'agendar', 8, '2011-09-07', '2011-09-07', 'M', 1, 1, 1, 2),
(151, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-09-07', '2011-09-07', 'M', 1, 1, 1, 1),
(152, 3, 7, 1, 0, 'p2b4', '01.Eat Out', '', 16, '2011-09-07', '2011-09-07', 'M', 1, 1, 1, 1),
(153, 3, 10, 67, 0, 'r254', '08.Grocery', '', 30, '2011-09-07', '2011-09-07', 'M', 1, 1, 1, 2),
(154, 3, 2, 5, 0, 't254', '02.Spend on Car-Gas', '', 50, '2011-09-08', '2011-09-08', 'M', 1, 1, 1, 2),
(155, 3, 11, 64, 0, 'l26414', 'Unexpected(others)', 'Payback money from weiwrong', -10, '2011-09-08', '2011-09-08', 'M', 1, 1, 1, 2),
(156, 3, 1, 74, 0, 'w254', '09.Money to Elaine', '', 80, '2011-09-08', '2011-09-08', 'I', 2, 1, 1, 2),
(157, 3, 7, 1, 0, 's2', '01.Eat Out', '', 4, '2011-09-08', '2011-09-08', 'M', 1, 1, 1, 1),
(158, 3, 10, 67, 0, 'p2c4', '08.Grocery', '', 17, '2011-09-09', '2011-09-09', 'M', 1, 1, 1, 2),
(159, 3, 11, 63, 0, 's2d4', '10.Party and Gift', 'moon cake', 48, '2011-09-10', '2011-09-10', 'M', 1, 1, 1, 2),
(160, 3, 10, 67, 0, 'v2', '08.Grocery', '', 7, '2011-09-10', '2011-09-10', 'M', 1, 1, 1, 2),
(161, 3, 11, 60, 0, 'p2b4', 'Hair Cut', '', 16, '2011-09-10', '2011-09-10', 'M', 1, 1, 1, 2),
(162, 3, 8, 49, 0, 'p2a4', 'School', 'gym clothes  ', 15, '2011-09-10', '2011-09-10', 'M', 1, 1, 1, 2),
(163, 3, 9, 56, 0, 'p2a4', '05.Shopping', 'face care for carly', 15, '2011-09-10', '2011-09-10', 'M', 1, 1, 1, 2),
(164, 3, 10, 67, 0, 'r2a4', '08.Grocery', '', 35, '2011-09-10', '2011-09-10', 'M', 1, 1, 1, 2),
(165, 3, 11, 63, 0, 'x2', '10.Party and Gift', '', 9, '2011-09-10', '2011-09-10', 'I', 2, 1, 1, 2),
(166, 3, 3, 17, 0, 't2a4', 'Repair', '', 55, '2011-09-11', '2011-09-11', 'M', 1, 1, 1, 2),
(167, 3, 11, 60, 0, 't2a4', 'Hair Cut', '', 55, '2011-09-11', '2011-09-11', 'I', 2, 1, 1, 2),
(168, 3, 3, 17, 0, 'q2b4', 'Repair', '', 26, '2011-09-11', '2011-09-11', 'M', 1, 1, 1, 2),
(169, 3, 3, 17, 0, 'l28424', 'Repair', '', -31, '2011-09-11', '2011-09-11', 'M', 1, 1, 1, 2),
(170, 3, 3, 17, 0, 'r2', 'Repair', '', 3, '2011-09-12', '2011-09-12', 'M', 1, 1, 1, 2),
(171, 3, 11, 63, 0, 'p254', '10.Party and Gift', '', 10, '2011-09-12', '2011-09-12', 'M', 1, 1, 1, 2),
(172, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-09-13', '2011-09-13', 'M', 1, 1, 1, 1),
(173, 3, 8, 52, 0, 't2', 'Kids Reward', '', 5, '2011-09-13', '2011-09-13', 'M', 1, 1, 1, 2),
(174, 3, 2, 5, 0, 't254', '02.Spend on Car-Gas', '', 50, '2011-09-14', '2011-09-14', 'M', 1, 1, 1, 2),
(175, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-09-14', '2011-09-14', 'M', 1, 1, 1, 1),
(176, 3, 8, 49, 0, 'p2a4', 'School', 'hearing & vision screening', 15, '2011-09-14', '2011-09-14', 'M', 1, 1, 1, 2),
(177, 3, 7, 1, 0, 's2', '01.Eat Out', '', 4, '2011-09-15', '2011-09-15', 'M', 1, 1, 1, 1),
(178, 3, 1, 74, 0, 'p2b414w2', '09.Money to Elaine', '', 1600, '2011-09-15', '2011-09-15', 'I', 2, 1, 1, 2),
(179, 3, 7, 1, 0, 'p2b4', '01.Eat Out', '', 16, '2011-09-15', '2011-09-15', 'M', 1, 1, 1, 1),
(180, 3, 1, 74, 0, 'l28414w2', '09.Money to Elaine', '', -300, '2011-09-16', '2011-09-16', 'I', 2, 1, 1, 2),
(181, 3, 7, 4, 0, 'p274', 'Snack', '', 12, '2011-09-16', '2011-09-16', 'I', 2, 1, 1, 2),
(182, 3, 7, 2, 0, 'q2', 'Unexpected(others)', 'tips', 2, '2011-09-17', '2011-09-17', 'I', 2, 1, 1, 2),
(183, 3, 2, 8, 0, 'w2', 'Unexpected(others)', 'toll fee', 8, '2011-09-17', '2011-09-17', 'I', 2, 1, 1, 2),
(184, 3, 7, 1, 0, 'q2b4', '01.Eat Out', '', 26, '2011-09-17', '2011-09-17', 'M', 1, 1, 1, 1),
(185, 3, 2, 5, 0, 'w274', '02.Spend on Car-Gas', '', 82, '2011-09-17', '2011-09-17', 'M', 1, 1, 1, 2),
(186, 3, 9, 56, 0, 'q2c4', '05.Shopping', 'clothes', 27, '2011-09-17', '2011-09-17', 'I', 2, 1, 1, 2),
(187, 3, 7, 2, 0, 'p2a4', '01.Eat Out', '', 15, '2011-09-17', '2011-09-17', 'I', 2, 1, 1, 2),
(188, 3, 11, 63, 0, 'p25414w2', '10.Party and Gift', '', 1000, '2011-09-17', '2011-09-17', 'I', 2, 1, 1, 2),
(189, 3, 2, 5, 0, 'r294', '02.Spend on Car-Gas', 'hotel parking', 34, '2011-09-18', '2011-09-18', 'M', 1, 1, 1, 2),
(190, 3, 2, 5, 0, 's254', '02.Spend on Car-Gas', '', 40, '2011-09-18', '2011-09-18', 'M', 1, 1, 1, 2),
(191, 3, 2, 5, 0, 'p2a4', '02.Spend on Car-Gas', 'toll fee', 15, '2011-09-18', '2011-09-18', 'I', 2, 1, 1, 2),
(192, 3, 7, 1, 0, 'w2', '01.Eat Out', '', 8, '2011-09-18', '2011-09-18', 'I', 2, 1, 1, 2),
(193, 3, 7, 1, 0, 't2', '01.Eat Out', '', 5, '2011-09-18', '2011-09-18', 'M', 1, 1, 1, 1),
(194, 3, 11, 63, 0, 's254', '10.Party and Gift', '', 40, '2011-09-18', '2011-09-18', 'I', 2, 1, 1, 2),
(195, 3, 2, 5, 0, 's254', '02.Spend on Car-Gas', '', 40, '2011-09-18', '2011-09-18', 'M', 1, 1, 1, 2),
(196, 3, 7, 1, 0, 'p274', '01.Eat Out', '', 12, '2011-09-18', '2011-09-18', 'M', 1, 1, 1, 1),
(197, 3, 1, 74, 0, 'p25474', '09.Money to Elaine', '', 106, '2011-09-18', '2011-09-18', 'I', 2, 1, 1, 2),
(198, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-09-19', '2011-09-19', 'M', 1, 1, 1, 1),
(199, 3, 4, 24, 0, 'r284', 'Cellular Phone', '', 33, '2011-09-19', '2011-09-19', 'M', 1, 1, 1, 2),
(200, 3, 4, 29, 0, 'q2e4', 'Internet', '', 29, '2011-09-19', '2011-09-19', 'M', 1, 1, 1, 2),
(201, 3, 8, 49, 0, 'q294', 'School', '', 24, '2011-09-20', '2011-09-20', 'M', 1, 1, 1, 2),
(202, 3, 7, 1, 0, 't2', '01.Eat Out', '', 5, '2011-09-20', '2011-09-20', 'M', 1, 1, 1, 1),
(203, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-09-21', '2011-09-21', 'M', 1, 1, 1, 1),
(204, 3, 2, 5, 0, 't254', '02.Spend on Car-Gas', '', 50, '2011-09-22', '2011-09-22', 'M', 1, 1, 1, 2),
(205, 3, 7, 1, 0, 's2', '01.Eat Out', '', 4, '2011-09-22', '2011-09-22', 'M', 1, 1, 1, 1),
(206, 3, 9, 56, 0, 'r254', '05.Shopping', 'celler phone case', 30, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(207, 3, 8, 49, 0, 'p2', 'School', '', 1, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(208, 3, 10, 67, 0, 't2', '08.Grocery', '', 5, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(209, 3, 10, 67, 0, 't2', '08.Grocery', '', 5, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(210, 3, 11, 63, 0, 'r25414', '10.Party and Gift', 'my uncle''s daughter''s daughter wedding', 300, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(211, 3, 11, 66, 0, 'p2c414', 'RSP CONTRIBUTION', '', 170, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(212, 3, 4, 26, 0, 'r2a4', 'Consumer Gas', '', 35, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(213, 3, 4, 25, 0, 'v2c4', 'Television', '', 77, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(214, 3, 3, 18, 0, 'q2c434', 'Insurance', '', 272, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(215, 3, 3, 15, 0, 'w25414', 'Mortgage', '', 800, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(216, 3, 2, 5, 0, 'q264', '02.Spend on Car-Gas', '407 toll fee', 21, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(217, 3, 4, 23, 0, 'v254', 'Home Phone', '', 70, '2011-09-24', '2011-09-24', 'M', 1, 1, 1, 2),
(218, 3, 8, 49, 0, 'p2b4', 'School', 'photo for carly', 16, '2011-09-25', '2011-09-25', 'M', 1, 1, 1, 2),
(219, 3, 7, 1, 0, 'v2', '01.Eat Out', '', 7, '2011-09-27', '2011-09-27', 'M', 1, 1, 1, 1),
(220, 3, 7, 1, 0, 'u2', '01.Eat Out', '', 6, '2011-09-28', '2011-09-28', 'M', 1, 1, 1, 1),
(221, 3, 7, 1, 0, 'p2c4', '01.Eat Out', '', 17, '2011-09-29', '2011-09-29', 'M', 1, 1, 1, 1),
(222, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-09-29', '2011-09-29', 'M', 1, 1, 1, 1),
(223, 3, 8, 49, 0, 'v2a4', 'School', 'kerny', 75, '2011-09-29', '2011-09-29', 'I', 2, 1, 1, 2),
(224, 3, 2, 5, 0, 't254', '02.Spend on Car-Gas', '', 50, '2011-09-30', '2011-09-30', 'M', 1, 1, 1, 2),
(226, 3, 9, 56, 0, 'v294', '06.Clothes,pants', 'shoes n clothes', 74, '2011-10-01', '2011-10-01', 'M', 1, 1, 1, 2),
(227, 3, 10, 67, 0, 't2d4', '08.Grocery', '', 58, '2011-10-01', '2011-10-01', 'I', 2, 1, 1, 2),
(228, 3, 9, 56, 0, 'p2c4', '06.Clothes,pants', 'clothes for reward', 17, '2011-10-01', '2011-10-01', 'M', 1, 1, 1, 2),
(229, 3, 10, 67, 0, 'p2c484', '08.Grocery', '', 177, '2011-10-01', '2011-10-01', 'M', 1, 1, 1, 2),
(230, 3, 7, 1, 0, 'p274', '01.Eat Out', '', 12, '2011-10-05', '2011-10-05', 'M', 1, 1, 1, 1),
(231, 3, 8, 49, 0, 't2', 'School', 'buss trip', 5, '2011-10-05', '2011-10-05', 'M', 1, 1, 1, 2),
(232, 3, 1, 74, 0, 'l26414', '09.Money to Elaine', '', -10, '2011-10-05', '2011-10-05', 'M', 2, 1, 1, 2),
(233, 3, 7, 1, 0, 'p254', '01.Eat Out', '', 10, '2011-10-05', '2011-10-05', 'M', 1, 1, 1, 1),
(234, 3, 9, 56, 0, 'p27444', '05.Shopping', 'kitar for carly', 123, '2011-10-05', '2011-10-05', 'M', 1, 1, 1, 2),
(235, 3, 10, 67, 0, 't2', '08.Grocery', '', 5, '2011-10-05', '2011-10-05', 'M', 1, 1, 1, 2),
(236, 3, 7, 1, 0, 'v2', '01.Eat Out', '', 7, '2011-10-06', '2011-10-06', 'M', 1, 1, 1, 1),
(237, 3, 11, 63, 0, 'p2a414', '10.Party and Gift', '', 150, '2011-10-08', '2011-10-08', 'I', 2, 1, 1, 2),
(238, 3, 1, 74, 0, 'r2a414', '09.Money to Elaine', '', 350, '2011-10-08', '2011-10-08', 'I', 2, 1, 1, 2),
(239, 3, 11, 60, 0, 'p2c4', 'Hair Cut', 'hair cut', 17, '2011-10-08', '2011-10-08', 'M', 1, 1, 1, 2),
(240, 3, 10, 67, 0, 'u2b4', '08.Grocery', '', 66, '2011-10-08', '2011-10-08', 'M', 1, 1, 1, 2),
(241, 3, 1, 74, 0, 'l26464w2', '09.Money to Elaine', '', -150, '2011-10-09', '2011-10-09', 'I', 2, 1, 1, 2),
(242, 3, 8, 49, 0, 'q254', 'School', 'chinese', 20, '2011-10-09', '2011-10-09', 'I', 2, 1, 1, 2),
(243, 3, 11, 63, 0, 'q25414', '10.Party and Gift', 'full month party', 200, '2011-10-09', '2011-10-09', 'I', 2, 1, 1, 2),
(244, 3, 9, 56, 0, 'u2', '05.Shopping', 'moth wash', 6, '2011-10-09', '2011-10-09', 'M', 1, 1, 1, 2),
(245, 3, 11, 63, 0, 'p2a4', '10.Party and Gift', '', 15, '2011-10-09', '2011-10-09', 'I', 2, 1, 1, 2),
(246, 3, 2, 5, 0, 'u254', '02.Spend on Car-Gas', '', 60, '2011-10-09', '2011-10-09', 'M', 1, 1, 1, 2),
(247, 3, 7, 4, 0, 'r2', 'Snack', '', 3, '2011-10-09', '2011-10-09', 'I', 2, 1, 1, 2),
(248, 3, 9, 56, 0, 'r294', '05.Shopping', '', 34, '2011-10-15', '2011-10-15', 'M', 1, 1, 1, 2),
(249, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-10-15', '2011-10-15', 'M', 1, 1, 1, 1),
(250, 3, 10, 67, 0, 'u254', '08.Grocery', '', 60, '2011-10-15', '2011-10-15', 'I', 2, 1, 1, 2),
(251, 3, 10, 67, 0, 'v274', '08.Grocery', '', 72, '2011-10-16', '2011-10-16', 'I', 2, 1, 1, 2),
(252, 3, 7, 1, 0, 't2', '01.Eat Out', '', 5, '2011-10-18', '2011-10-18', 'M', 1, 1, 1, 1),
(253, 3, 2, 5, 0, 'u254', '02.Spend on Car-Gas', '', 60, '2011-10-18', '2011-10-18', 'M', 1, 1, 1, 2),
(254, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-10-19', '2011-10-19', 'M', 1, 1, 1, 1),
(255, 3, 8, 54, 0, 'r29464', 'Unexpected(others)', 'jessica dancing club', 345, '2011-10-22', '2011-10-22', 'M', 1, 1, 1, 2),
(256, 3, 8, 49, 0, 'p2b4', 'School', 'photo', 16, '2011-10-22', '2011-10-22', 'M', 1, 1, 1, 2),
(257, 3, 7, 2, 0, 'p254', '01.Eat Out', '', 10, '2011-10-22', '2011-10-22', 'I', 2, 1, 1, 2),
(258, 3, 5, 32, 0, 'q2a414', 'Dental expend', 'dentis on carly', 250, '2011-10-22', '2011-10-22', 'M', 1, 1, 1, 2),
(260, 3, 10, 67, 0, 'v2a4', '08.Grocery', '', 75, '2011-10-22', '2011-10-22', 'I', 2, 1, 1, 2),
(261, 3, 9, 56, 0, 'p274', '05.Shopping', 'photo for wedding ', 12, '2011-10-23', '2011-10-23', 'M', 1, 1, 1, 2),
(262, 3, 1, 74, 0, 'u254', '09.Money to Elaine', '', 60, '2011-10-23', '2011-10-23', 'I', 2, 1, 1, 2),
(263, 3, 7, 1, 0, 'p2e4', '01.Eat Out', 'family', 19, '2011-10-23', '2011-10-23', 'M', 1, 1, 1, 1),
(264, 3, 11, 63, 0, 'p25414', '10.Party and Gift', '', 100, '2011-10-23', '2011-10-23', 'I', 2, 1, 1, 2),
(265, 3, 9, 56, 0, 'r2a4', '05.Shopping', '', 35, '2011-10-23', '2011-10-23', 'M', 1, 1, 1, 2),
(266, 3, 7, 4, 0, 'r2', 'Snack', '', 3, '2011-10-23', '2011-10-23', 'M', 1, 1, 1, 2),
(267, 3, 9, 56, 0, 's2a4', '06.Clothes,pants', 'cloth and pants', 45, '2011-10-23', '2011-10-23', 'M', 1, 1, 1, 2),
(268, 3, 3, 21, 0, 'r2a414', 'Property Tax', '', 350, '2011-08-01', '2011-08-01', 'M', 1, 1, 1, 2),
(269, 3, 3, 21, 0, 'r2a414', 'Property Tax', '', 350, '2011-09-01', '2011-09-01', 'M', 1, 1, 1, 2),
(270, 3, 1, 74, 0, 'p25414', '09.Money to Elaine', '', 100, '2011-10-24', '2011-10-24', 'I', 2, 1, 1, 2),
(271, 3, 10, 67, 0, 'u2a4', '08.Grocery', '', 65, '2011-10-24', '2011-10-24', 'I', 2, 1, 1, 2),
(272, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-10-25', '2011-10-25', 'M', 1, 1, 1, 1),
(273, 3, 7, 1, 0, 'u2', '01.Eat Out', '', 6, '2011-10-26', '2011-10-26', 'M', 1, 1, 1, 1),
(274, 3, 2, 5, 0, 't2a4', '02.Spend on Car-Gas', '', 55, '2011-10-26', '2011-10-26', 'M', 1, 1, 1, 2),
(275, 3, 10, 67, 0, 'u274', '08.Grocery', '', 62, '2011-10-26', '2011-10-26', 'I', 2, 1, 1, 2),
(276, 3, 12, 70, 0, 'r27464', 'Unexpected(others)', 'us $250 write off, other are miss recored', 325, '2011-10-26', '2011-10-26', 'I', 2, 1, 1, 2),
(277, 3, 10, 67, 0, 's254', '08.Grocery', '', 40, '2011-10-28', '2011-10-28', 'M', 1, 1, 1, 2),
(278, 3, 11, 66, 0, 'p2c414', 'RSP CONTRIBUTION', '', 170, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 2),
(279, 3, 4, 24, 0, 't2b4', 'Cellular Phone', '', 56, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 2),
(280, 3, 4, 26, 0, 'v294', 'Consumer Gas', '', 74, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 2),
(281, 3, 4, 25, 0, 'v2c4', 'Television', '', 77, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 2),
(282, 3, 3, 18, 0, 'q2b4a4', 'Insurance', '', 269, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 2),
(283, 3, 8, 65, 0, 'p25444x2', 'C.S.T. PLAN for Kids', '', 1031, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 2),
(284, 3, 4, 23, 0, 'q254', 'Home Phone', '', 20, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 2),
(285, 3, 4, 29, 0, 's274', 'Internet', '', 42, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 2),
(286, 3, 3, 21, 0, 'r2a414', 'Property Tax', '', 350, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 2),
(287, 3, 7, 1, 0, 'p2e4', '01.Eat Out', '', 19, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 1),
(288, 3, 3, 15, 0, 'w25414', 'Mortgage', '', 800, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 2),
(289, 3, 11, 63, 0, 'q264', '10.Party and Gift', '', 21, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 2),
(292, 3, 1, 74, 0, 's25414', '09.Money to Elaine', '', 400, '2011-10-29', '2011-10-29', 'I', 2, 1, 1, 2),
(291, 3, 7, 1, 0, 'r294', '01.Eat Out', '', 34, '2011-10-29', '2011-10-29', 'M', 1, 1, 1, 1),
(293, 3, 11, 63, 0, 'r25414', '10.Party and Gift', '', 300, '2011-10-30', '2011-10-30', 'I', 2, 1, 1, 2),
(294, 3, 11, 63, 0, 'u2', '10.Party and Gift', 'dim sum', 6, '2011-10-31', '2011-10-31', 'I', 2, 1, 1, 2),
(295, 3, 1, 74, 0, 'l2a414', '09.Money to Elaine', '', -50, '2011-10-31', '2011-10-31', 'I', 2, 1, 1, 2),
(296, 3, 11, 63, 0, 'p274', '10.Party and Gift', '', 12, '2011-10-31', '2011-10-31', 'M', 1, 1, 1, 2),
(297, 3, 1, 74, 0, 'q25414', '09.Money to Elaine', '', 200, '2011-11-01', '2011-11-01', 'I', 2, 1, 1, 2),
(298, 3, 7, 1, 0, 's294', '01.Eat Out', 'Esl lunch', 44, '2011-11-01', '2011-11-01', 'M', 1, 1, 1, 1),
(299, 3, 11, 63, 0, 'p25414', '10.Party and Gift', 'to elaine''s unty in hong kong', 100, '2011-11-01', '2011-11-01', 'M', 1, 1, 1, 2),
(300, 3, 7, 1, 0, 'p274', '01.Eat Out', '', 12, '2011-11-02', '2011-11-02', 'M', 1, 1, 1, 1),
(301, 3, 2, 5, 0, 'u2a4', '02.Spend on Car-gas', '', 65, '2011-11-02', '2011-11-02', 'M', 1, 1, 1, 2),
(302, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-11-03', '2011-11-03', 'M', 1, 1, 1, 1),
(303, 3, 10, 67, 0, 'u2c4', '08.Grocery', '', 67, '2011-11-03', '2011-11-03', 'I', 2, 1, 1, 2),
(304, 3, 10, 67, 0, 'q254', '08.Grocery', '', 20, '2011-11-04', '2011-11-04', 'I', 2, 1, 1, 2),
(305, 3, 8, 49, 0, 'q2', 'School', '', 2, '2011-11-04', '2011-11-04', 'I', 2, 1, 1, 2),
(306, 3, 1, 74, 0, 'l284', '09.Money to Elaine', '', -3, '2011-11-04', '2011-11-04', 'I', 2, 1, 1, 2),
(307, 3, 2, 7, 0, 'w2c464', '04.Spend on Car Others', 'replace snow tire', 875, '2011-11-05', '2011-11-05', 'M', 1, 1, 1, 2),
(308, 3, 7, 1, 0, 'p284', '01.Eat Out', '', 13, '2011-11-05', '2011-11-05', 'M', 1, 1, 1, 1),
(309, 3, 11, 63, 0, 'q25414', '10.Party and Gift', '', 200, '2011-11-06', '2011-11-06', 'I', 2, 1, 1, 2),
(310, 3, 1, 74, 0, 'q25414', '09.Money to Elaine', '', 200, '2011-11-06', '2011-11-06', 'I', 2, 1, 1, 2),
(311, 3, 8, 52, 0, 't2', 'Kids Reward', '', 5, '2011-11-06', '2011-11-06', 'M', 1, 1, 1, 2),
(312, 3, 7, 1, 0, 'u2', '01.Eat Out', '', 6, '2011-11-08', '2011-11-08', 'M', 1, 1, 1, 1),
(313, 3, 7, 1, 0, 's2', '01.Eat Out', '', 4, '2011-11-09', '2011-11-09', 'M', 1, 1, 1, 1),
(314, 3, 7, 1, 0, 't2', '01.Eat Out', '', 5, '2011-11-10', '2011-11-10', 'M', 1, 1, 1, 1),
(315, 3, 2, 5, 0, 't2d4', '02.Spend on Car-gas', '', 58, '2011-11-10', '2011-11-10', 'M', 1, 1, 1, 2),
(316, 3, 9, 56, 0, 's2e4', '06.Clothes,pants', '', 49, '2011-11-10', '2011-11-10', 'M', 1, 1, 1, 2),
(317, 3, 7, 1, 0, 'q264', '01.Eat Out', '', 21, '2011-11-10', '2011-11-10', 'M', 1, 1, 1, 1),
(318, 3, 10, 67, 0, 'p264', '08.Grocery', '', 11, '2011-11-10', '2011-11-10', 'M', 1, 1, 1, 2),
(319, 3, 4, 29, 0, 't254', 'Internet', '', 50, '2011-11-12', '2011-11-12', 'M', 1, 1, 1, 2),
(320, 3, 4, 24, 0, 'r2c4', 'Cellular Phone', '', 37, '2011-11-12', '2011-11-12', 'M', 1, 1, 1, 2),
(321, 3, 7, 1, 0, 'q264', '01.Eat Out', '', 21, '2011-11-13', '2011-11-13', 'M', 1, 1, 1, 1),
(322, 3, 10, 67, 0, 'u254', '08.Grocery', '', 60, '2011-11-13', '2011-11-13', 'I', 2, 1, 1, 2),
(323, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-11-15', '2011-11-15', 'M', 1, 1, 1, 1),
(324, 3, 7, 1, 0, 't2', '01.Eat Out', '', 5, '2011-11-16', '2011-11-16', 'M', 1, 1, 1, 1),
(325, 3, 10, 67, 0, 'p2a4', '08.Grocery', '', 15, '2011-11-17', '2011-11-17', 'I', 2, 1, 1, 2),
(326, 3, 7, 1, 0, 'u2', '01.Eat Out', 'breakfast', 6, '2011-11-17', '2011-11-17', 'M', 1, 1, 1, 1),
(327, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-11-17', '2011-11-17', 'M', 1, 1, 1, 1),
(328, 3, 10, 67, 0, 'p284', '08.Grocery', '', 13, '2011-11-17', '2011-11-17', 'M', 1, 1, 1, 2),
(329, 3, 2, 7, 0, 'p2b4', '04.Spend on Car Others', '', 16, '2011-11-18', '2011-11-18', 'M', 1, 1, 1, 2),
(330, 3, 10, 67, 0, 'r284', '08.Grocery', '', 33, '2011-11-19', '2011-11-19', 'I', 2, 1, 1, 2),
(331, 3, 10, 68, 0, 'v254', 'Unexpected(others)', 'unknow expeness', 70, '2011-11-19', '2011-11-19', 'I', 2, 1, 1, 2),
(332, 3, 1, 74, 0, 'q25414', '09.Money to Elaine', '', 200, '2011-11-19', '2011-11-19', 'I', 2, 1, 1, 2),
(333, 3, 2, 5, 0, 'u254', '02.Spend on Car-gas', '', 60, '2011-11-19', '2011-11-19', 'M', 1, 1, 1, 2),
(334, 3, 7, 4, 0, 't2', 'Snack', '', 5, '2011-11-21', '2011-11-21', 'I', 2, 1, 1, 2),
(335, 3, 10, 67, 0, 'u2', '08.Grocery', '', 6, '2011-11-21', '2011-11-21', 'I', 2, 1, 1, 2),
(336, 3, 10, 67, 0, 'q284', '08.Grocery', '', 23, '2011-11-21', '2011-11-21', 'M', 1, 1, 1, 2),
(337, 3, 7, 1, 0, 'p2', '01.Eat Out', '', 1, '2011-11-22', '2011-11-22', 'M', 1, 1, 1, 1),
(338, 3, 2, 6, 0, 'p2a4', '03.Spend on Car-Parking', '', 15, '2011-11-22', '2011-11-22', 'M', 1, 1, 1, 1),
(339, 3, 10, 67, 0, 'q2a4', '08.Grocery', '', 25, '2011-11-23', '2011-11-23', 'M', 1, 1, 1, 1),
(340, 3, 10, 67, 0, 'v254', '08.Grocery', '', 70, '2011-11-23', '2011-11-23', 'M', 1, 1, 1, 1),
(341, 3, 10, 67, 0, 'q274', '08.Grocery', '', 22, '2011-11-23', '2011-11-23', 'I', 2, 1, 1, 2),
(342, 3, 8, 49, 0, 'x2', 'School', '', 9, '2011-11-23', '2011-11-23', 'M', 1, 1, 1, 1),
(343, 3, 7, 1, 0, 't2', '01.Eat Out', '', 5, '2011-11-24', '2011-11-24', 'M', 1, 1, 1, 1),
(344, 3, 5, 33, 0, 'p27464', 'Unexpected(others)', 'massage', 125, '2011-11-24', '2011-11-24', 'M', 1, 1, 1, 1),
(345, 3, 8, 49, 0, 'v2', 'School', '', 7, '2011-11-25', '2011-11-25', 'I', 2, 1, 1, 2),
(346, 3, 2, 5, 0, 't284', '02.Spend on Car-gas', '', 53, '2011-11-25', '2011-11-25', 'M', 1, 1, 1, 1),
(347, 3, 9, 59, 0, 'r2', '05.Shopping', '', 3, '2011-11-26', '2011-11-26', 'M', 1, 1, 1, 1),
(348, 3, 7, 1, 0, 'q254', '01.Eat Out', '', 20, '2011-11-26', '2011-11-26', 'M', 1, 1, 1, 1),
(349, 3, 7, 1, 0, 'p254', '01.Eat Out', '', 10, '2011-11-26', '2011-11-26', 'I', 2, 1, 1, 2),
(350, 3, 9, 59, 0, 'q2d4', '05.Shopping', '', 28, '2011-11-26', '2011-11-26', 'M', 1, 1, 1, 1),
(351, 3, 10, 67, 0, 's254', '08.Grocery', '', 40, '2011-11-26', '2011-11-26', 'I', 2, 1, 1, 2),
(352, 3, 8, 52, 0, 'p2a4', 'Kids Reward', '', 15, '2011-11-26', '2011-11-26', 'M', 1, 1, 1, 1),
(353, 3, 10, 67, 0, 'p254', '08.Grocery', '', 10, '2011-11-26', '2011-11-26', 'M', 1, 1, 1, 1),
(354, 3, 11, 66, 0, 'p2c414', 'RSP CONTRIBUTION', '', 170, '2011-11-27', '2011-11-27', 'M', 1, 1, 1, 1),
(355, 3, 4, 28, 0, 'q2b454', 'Electricity and Water', '', 264, '2011-11-27', '2011-11-27', 'M', 1, 1, 1, 1),
(356, 3, 3, 15, 0, 'w25414', 'Mortgage', '', 800, '2011-11-27', '2011-11-27', 'M', 1, 1, 1, 1),
(357, 3, 4, 26, 0, 'v2a4', 'Consumer Gas', '', 75, '2011-11-27', '2011-11-27', 'M', 1, 1, 1, 1),
(358, 3, 4, 25, 0, 'v2c4', 'Television', '', 77, '2011-11-27', '2011-11-27', 'M', 1, 1, 1, 1),
(359, 3, 3, 18, 0, 'q2b4a4', 'Insurance', '', 269, '2011-11-27', '2011-11-27', 'M', 1, 1, 1, 1),
(360, 3, 4, 23, 0, 'q274', 'Home Phone', '', 22, '2011-11-27', '2011-11-27', 'M', 1, 1, 1, 1),
(361, 3, 5, 36, 0, 's2c414', 'Insurance', '', 470, '2011-11-27', '2011-11-27', 'M', 1, 1, 1, 1),
(362, 3, 4, 29, 0, 'r254', 'Internet', '', 30, '2011-11-27', '2011-11-27', 'M', 1, 1, 1, 1),
(363, 3, 8, 49, 0, 's2', 'School', '', 4, '2011-11-28', '2011-11-28', 'M', 1, 1, 1, 1),
(364, 3, 7, 1, 0, 'u2', '01.Eat Out', '', 6, '2011-11-29', '2011-11-29', 'M', 1, 1, 1, 1),
(365, 3, 7, 1, 0, 'q2', '01.Eat Out', '', 2, '2011-11-30', '2011-11-30', 'M', 1, 1, 1, 1),
(366, 3, 7, 2, 0, 'p2e4z3y2', '', '', 0, '2011-12-01', '2011-12-23', '', 1, 2, 1, 3),
(367, 3, 7, 1, 0, 't2341433', '', '', 0, '2011-12-01', '2011-12-01', '', 1, 1, 1, 1),
(368, 3, 1, 79, 0, 'w294', '', '', 0, '2011-12-01', '2011-12-01', '', 2, 1, 1, 2),
(370, 3, 1, 76, 0, 'v25414', '', '', 0, '2011-12-01', '2011-12-01', '', 2, 1, 1, 2),
(371, 3, 1, 76, 0, 'v25414', '', '', 0, '2011-12-01', '2011-12-01', '', 1, 1, 1, 1),
(372, 3, 1, 77, 0, 'u29414', '', '', 0, '2011-12-03', '2011-12-03', '', 1, 1, 1, 1),
(373, 3, 1, 77, 0, 'l2b454w2', '', '', 0, '2011-12-03', '2011-12-03', '', 1, 1, 1, 2),
(374, 3, 10, 67, 0, 's2a4z35384', '', '', 0, '2011-12-03', '2011-12-23', '', 1, 2, 1, 3),
(375, 3, 10, 67, 0, 'p264', '', '', 0, '2011-12-03', '2011-12-03', '', 2, 1, 1, 2),
(376, 3, 7, 3, 0, 'p23444', '', '', 0, '2011-12-03', '2011-12-03', '', 1, 1, 1, 1),
(377, 3, 11, 63, 0, 'q2b4z3z2b4', '', '', 0, '2011-12-03', '2011-12-23', '', 1, 2, 1, 3),
(378, 3, 8, 49, 0, 'p274', '', '', 0, '2011-12-04', '2011-12-04', '', 1, 1, 1, 1),
(379, 3, 2, 5, 0, 'u254', '', '', 0, '2011-12-04', '2011-12-23', '', 1, 2, 1, 3),
(380, 3, 5, 34, 0, 'p25414', '', '', 0, '2011-12-04', '2011-12-23', '', 1, 2, 1, 3),
(381, 3, 10, 67, 0, 't2a4z34384', '', '', 0, '2011-12-04', '2011-12-04', '', 1, 1, 1, 1),
(382, 3, 7, 3, 0, 'p23454', '', '', 0, '2011-12-04', '2011-12-04', '', 1, 1, 1, 1),
(383, 3, 11, 63, 0, 'p29494u29433', '', '', 0, '2011-12-04', '2011-12-23', '', 1, 2, 1, 3),
(384, 3, 11, 66, 0, 'p2c414', '', '', 0, '2011-12-04', '2011-12-04', '', 1, 1, 1, 3),
(385, 3, 7, 1, 0, 't23464', '', '', 0, '2011-12-06', '2011-12-06', '', 1, 1, 1, 1),
(386, 3, 11, 61, 0, 'r254', '', '', 0, '2011-12-06', '2012-02-15', '', 1, 2, 1, 3),
(387, 3, 7, 2, 0, 'p274z323', '', '', 0, '2011-12-06', '2011-12-23', '', 1, 2, 1, 3),
(388, 3, 11, 63, 0, 'p294', '', '', 0, '2011-12-06', '2011-12-06', '', 2, 1, 1, 2),
(389, 3, 2, 5, 0, 'q2d4', '', '', 0, '2011-12-07', '2011-12-23', '', 1, 2, 1, 3),
(390, 3, 7, 1, 0, 'p2346443', '', '', 0, '2011-12-07', '2011-12-07', '', 1, 1, 1, 1),
(391, 3, 11, 63, 0, 'p284z353a4', '', '', 0, '2011-12-07', '2011-12-23', '', 1, 4, 1, 3),
(392, 3, 7, 1, 0, 't2341433', '', '', 0, '2011-12-08', '2011-12-23', '', 1, 2, 1, 3),
(393, 3, 11, 60, 0, 'r274', '', '', 0, '2011-12-09', '0000-00-00', '', 2, 1, 1, 1),
(394, 3, 9, 83, 0, 'p2c4', '', '', 0, '2011-12-09', '0000-00-00', '', 1, 1, 1, 1),
(395, 3, 3, 15, 0, 'w25414', '', '', 0, '2011-12-10', '0000-00-00', '', 1, 1, 1, 3),
(396, 3, 1, 75, 0, 'v29454u25453', '', '', 0, '2011-12-10', '0000-00-00', '', 2, 1, 1, 3),
(397, 3, 8, 49, 0, 'l294z3w274', '', '', 0, '2011-12-10', '2011-12-23', '', 1, 2, 1, 3),
(398, 3, 10, 67, 0, 'v2d4z33384', '', '', 0, '2011-12-10', '0000-00-00', '', 1, 1, 1, 1),
(399, 3, 10, 67, 0, 'p2a4', '', '', 0, '2011-12-10', '0000-00-00', '', 2, 1, 1, 2),
(400, 3, 11, 63, 0, 'q2a4', '', '', 0, '2011-12-10', '0000-00-00', '', 2, 1, 1, 2),
(401, 3, 1, 77, 0, 'l2a414', '', '', 0, '2011-12-10', '0000-00-00', '', 2, 1, 1, 2),
(402, 3, 1, 77, 0, 't254', '', '', 0, '2011-12-10', '0000-00-00', '', 2, 1, 1, 1),
(403, 3, 8, 49, 0, 's23464x2', '', '', 0, '2011-12-10', '2011-12-23', '', 1, 2, 1, 3),
(404, 3, 10, 67, 0, 's2c4z3x2a4', '', '', 0, '2011-12-10', '2011-12-23', '', 1, 2, 1, 3),
(405, 3, 8, 49, 0, 'l294z31334', '', '', 0, '2011-12-10', '2011-12-23', '', 1, 2, 1, 3),
(406, 3, 2, 5, 0, 'r274', '', '', 0, '2011-12-10', '2011-12-23', '', 1, 2, 1, 3),
(407, 3, 11, 63, 0, 'l26474u29423', '', '', 0, '2011-12-11', '2011-12-23', '', 1, 2, 1, 3),
(408, 3, 10, 67, 0, 'r2', '', '', 0, '2011-12-11', '0000-00-00', '', 1, 1, 1, 1),
(409, 3, 10, 67, 0, 'p294z303', '', '', 0, '2011-12-11', '0000-00-00', '', 2, 1, 1, 2),
(410, 3, 11, 63, 0, 'v254z33394', '', '', 0, '2011-12-11', '2011-12-23', '', 2, 4, 1, 3),
(411, 3, 7, 1, 0, 'p2346443', '', '', 0, '2011-12-13', '0000-00-00', '', 1, 1, 1, 1),
(412, 3, 11, 64, 2, 'o2346433', '', '', 0, '2011-12-13', '0000-00-00', '', 1, 1, 1, 1),
(413, 3, 7, 2, 0, 'p274z32374', '', '', 0, '2011-12-13', '2012-02-15', '', 1, 2, 1, 3),
(414, 3, 1, 74, 0, 'p2944443046384', '', '', 0, '2011-12-15', '0000-00-00', '', 1, 1, 1, 3),
(415, 3, 7, 1, 0, 's23464', '', '', 0, '2011-12-15', '0000-00-00', '', 1, 1, 1, 1),
(416, 3, 3, 18, 0, 'v274z353', '', '', 0, '2011-12-16', '0000-00-00', '', 1, 1, 1, 3),
(417, 3, 2, 10, 0, 'q25444u254z2', '', '', 0, '2011-12-16', '0000-00-00', '', 1, 1, 1, 3),
(418, 3, 8, 52, 0, 'p284z30394', '', '', 0, '2011-12-16', '2012-02-15', '', 1, 2, 1, 3),
(419, 3, 2, 5, 0, 's2b4z3w234', '', '', 0, '2011-12-17', '2012-02-15', '', 1, 2, 1, 3),
(420, 3, 7, 4, 0, 'p254', '', '', 0, '2011-12-17', '0000-00-00', '', 2, 1, 1, 2),
(421, 3, 9, 59, 3, 'p254', '', '', 0, '2011-12-17', '0000-00-00', '', 2, 1, 1, 2),
(422, 3, 1, 81, 0, 'p2e414u25443', '', '', 0, '2011-12-19', '0000-00-00', '', 1, 1, 1, 3),
(423, 3, 7, 3, 0, 'p23444', '', '', 0, '2011-12-19', '0000-00-00', '', 1, 1, 1, 1),
(424, 3, 7, 2, 0, 'p2e4z3y2', '', '', 0, '2011-12-19', '2012-02-15', '', 1, 2, 1, 3),
(425, 3, 10, 67, 0, 'p2d4', '', '', 0, '2011-12-19', '0000-00-00', '', 2, 1, 1, 2),
(426, 3, 7, 1, 0, 's23464', '', '', 0, '2011-12-20', '0000-00-00', '', 1, 1, 1, 1),
(427, 3, 1, 78, 0, 'p25414', '', '', 0, '2011-12-20', '0000-00-00', '', 1, 1, 1, 1),
(428, 3, 10, 67, 0, 'r274z3y274', '', '', 0, '2011-12-20', '2012-02-15', '', 1, 2, 1, 3),
(429, 3, 7, 1, 0, 't2341433', '', '', 0, '2011-12-20', '2011-12-23', '', 1, 2, 1, 3),
(430, 3, 11, 63, 0, 'q26414', '', '', 0, '2011-12-21', '0000-00-00', '', 2, 1, 1, 2),
(431, 3, 11, 63, 0, 'p274', '', '', 0, '2011-12-22', '0000-00-00', '', 2, 1, 1, 2),
(432, 3, 7, 1, 0, 's254', '', '', 0, '2011-12-22', '0000-00-00', '', 1, 1, 1, 1),
(433, 3, 5, 32, 0, 'p28464w2', '', '', 0, '2011-12-22', '2011-12-25', '', 1, 5, 1, 3),
(434, 3, 7, 1, 0, 'q2a4', '', '', 0, '2011-12-22', '0000-00-00', '', 1, 1, 1, 2),
(449, 3, 1, 77, 0, 'l2a414w2', '', '', 0, '2011-12-23', '0000-00-00', '', 2, 1, 1, 3),
(454, 3, 10, 67, 0, 'q254', '', '', 0, '2011-12-24', '0000-00-00', '', 2, 1, 1, 2),
(447, 3, 7, 2, 0, 'r2a4', '', '', 0, '2011-12-23', '0000-00-00', '', 2, 1, 1, 2),
(438, 3, 7, 1, 0, 's294', '', '', 0, '2011-12-22', '0000-00-00', '', 1, 1, 1, 1),
(440, 3, 7, 1, 0, 't2', '', '', 0, '2011-12-22', '0000-00-00', '', 1, 1, 1, 1),
(450, 3, 1, 77, 0, 't25414', '', '', 0, '2011-12-23', '0000-00-00', '', 2, 1, 1, 2),
(448, 3, 7, 2, 0, 'r2', '', '', 0, '2011-12-23', '0000-00-00', '', 2, 1, 1, 2),
(444, 3, 10, 67, 0, 't254', '', '', 0, '2011-12-22', '0000-00-00', '', 2, 1, 1, 2),
(445, 3, 11, 63, 0, 's254', '', '', 0, '2011-12-22', '0000-00-00', '', 2, 1, 1, 2),
(446, 3, 2, 5, 0, 's294z3w274', '', '', 0, '2011-12-22', '2012-02-15', '', 1, 2, 1, 3),
(451, 3, 11, 63, 0, 'r264z3x254', '', '', 0, '2011-12-23', '2012-02-15', '', 1, 2, 1, 3),
(452, 3, 2, 6, 0, 's23464', '', '', 0, '2011-12-23', '0000-00-00', '', 1, 1, 1, 1),
(453, 3, 7, 2, 0, 'p27414', '', '', 0, '2011-12-23', '0000-00-00', '', 1, 1, 1, 1),
(455, 3, 11, 63, 0, 'u25414', '', '', 0, '2011-12-24', '0000-00-00', '', 2, 1, 1, 2),
(456, 3, 1, 77, 0, 'l28414w2', '', '', 0, '2011-12-24', '0000-00-00', '', 1, 1, 1, 3),
(457, 3, 1, 77, 0, 'r25414', '', '', 0, '2011-12-24', '0000-00-00', '', 1, 1, 1, 1),
(458, 3, 1, 77, 0, 'l27414w2', '', '', 0, '2011-12-24', '0000-00-00', '', 1, 1, 1, 1),
(459, 3, 1, 77, 0, 'q25414', '', '', 0, '2011-12-24', '0000-00-00', '', 1, 1, 1, 2),
(460, 3, 7, 2, 0, 'p2d4z3y284', '', '', 0, '2011-12-27', '2012-02-15', '', 1, 2, 1, 3),
(461, 3, 8, 47, 0, 't2346423', '', '', 0, '2011-12-27', '2012-02-15', '', 1, 2, 1, 3),
(462, 3, 8, 47, 0, 'u2343453', '', '', 0, '2011-12-27', '2012-02-15', '', 1, 2, 1, 3),
(463, 3, 7, 3, 0, 'p2343413', '', '', 0, '2011-12-29', '0000-00-00', '', 1, 1, 1, 1),
(464, 3, 7, 4, 0, 'p23494', '', '', 0, '2011-12-29', '0000-00-00', '', 1, 1, 1, 1),
(465, 3, 1, 74, 0, 'p2944443046384', '', '', 0, '2011-12-31', '0000-00-00', '', 1, 1, 1, 3),
(466, 3, 6, 45, 4, 'p2a444', '', '', 0, '2011-12-31', '0000-00-00', '', 1, 1, 1, 1),
(467, 3, 1, 78, 0, 'v25414', '', '', 0, '2011-12-31', '0000-00-00', '', 1, 1, 1, 2),
(468, 3, 1, 77, 0, 'l2e414', '', '', 0, '2011-12-31', '0000-00-00', '', 1, 1, 1, 2),
(469, 3, 1, 77, 0, 'x254', '', '', 0, '2011-12-31', '0000-00-00', '', 1, 1, 1, 1),
(470, 3, 1, 76, 0, 'v25414', '', '', 0, '2012-01-01', '0000-00-00', '', 1, 1, 1, 1),
(471, 3, 1, 77, 0, 'l26434w2', '', '', 0, '2012-01-01', '0000-00-00', '', 1, 1, 1, 3),
(472, 3, 1, 77, 0, 'p27414', '', '', 0, '2012-01-01', '0000-00-00', '', 1, 1, 1, 7),
(473, 3, 1, 77, 0, 'l2a414', '', '', 0, '2012-01-01', '0000-00-00', '', 1, 1, 1, 3),
(474, 3, 1, 77, 0, 't254', '', '', 0, '2012-01-01', '0000-00-00', '', 1, 1, 1, 9),
(475, 3, 4, 24, 0, 'r2e4z34354', '', '', 0, '2012-01-01', '2012-01-01', '', 1, 1, 1, 3),
(476, 3, 4, 25, 0, 'v2b4z34344', '', '', 0, '2012-01-01', '2012-01-01', '', 1, 1, 1, 3),
(477, 3, 4, 26, 0, 'v294', '', '', 0, '2012-01-01', '2012-01-01', '', 1, 1, 1, 3),
(478, 3, 4, 28, 0, 'r2d424u22443', '', '', 0, '2012-01-01', '2012-01-01', '', 1, 1, 1, 3),
(479, 3, 4, 26, 0, 'v294', '', '', 0, '2012-01-04', '2012-01-04', '', 1, 1, 1, 3),
(480, 3, 4, 25, 0, 'v2b4z34344', '', '', 0, '2012-01-06', '2012-01-06', '', 1, 1, 1, 3),
(481, 3, 4, 23, 0, 'r264z31364', '', '', 0, '2012-01-02', '2012-01-17', '', 1, 1, 1, 3),
(482, 3, 4, 29, 0, 'r274z3x294', '', '', 0, '2012-01-02', '2012-01-17', '', 1, 1, 1, 3),
(483, 3, 2, 6, 0, 's23464', '', '', 0, '2012-01-02', '0000-00-00', '', 1, 1, 1, 1),
(484, 3, 2, 5, 0, 'u254', '', '', 0, '2012-01-02', '2012-02-15', '', 1, 2, 1, 3),
(485, 3, 7, 4, 0, 'p284z30344', '', '', 0, '2012-01-02', '2012-02-15', '', 1, 2, 1, 3),
(486, 3, 7, 4, 0, 'q23484y2', '', '', 0, '2012-01-02', '0000-00-00', '', 1, 1, 1, 1),
(487, 3, 7, 1, 0, 'p23474', '', '', 0, '2012-01-04', '0000-00-00', '', 1, 1, 1, 1),
(488, 3, 3, 20, 0, 'w294z3x284', '', '', 0, '2012-01-04', '2012-01-26', '', 1, 4, 1, 3),
(489, 3, 7, 1, 0, 'u23464', '', '', 0, '2012-01-05', '0000-00-00', '', 1, 1, 1, 1),
(490, 3, 7, 1, 0, 'u2346413', '', '', 0, '2012-01-05', '0000-00-00', '', 1, 1, 1, 1),
(491, 3, 10, 67, 0, 'w2a4', '', '', 0, '2012-01-07', '0000-00-00', '', 2, 1, 1, 2),
(492, 3, 7, 2, 0, 'r2d4', '', '', 0, '2012-01-07', '2012-02-15', '', 1, 2, 1, 3),
(493, 3, 2, 6, 0, 'q2348413', '', '', 0, '2012-01-07', '0000-00-00', '', 1, 1, 1, 1),
(494, 3, 3, 20, 0, 'w274z33374', '', '', 0, '2012-01-07', '2012-02-15', '', 1, 2, 1, 3),
(495, 3, 3, 20, 0, 'p2c4z34354', '', '', 0, '2012-01-08', '2012-02-15', '', 1, 2, 1, 3),
(496, 3, 10, 67, 0, 's2942433', '', '', 0, '2012-01-08', '2012-02-15', '', 1, 4, 1, 3),
(497, 3, 3, 20, 0, 'p2e414u28423', '', '', 0, '2012-01-08', '2012-02-15', '', 1, 2, 1, 3),
(498, 3, 10, 67, 0, 'l29454x294', '', '', 0, '2012-01-08', '2012-02-15', '', 1, 4, 1, 3),
(499, 3, 10, 67, 0, 's294z3x294', '', '', 0, '2012-01-08', '2012-01-26', '', 1, 4, 1, 3),
(500, 3, 9, 56, 0, 'q28484u254', '', '', 0, '2012-01-08', '2012-02-15', '', 1, 2, 1, 3),
(501, 3, 3, 20, 0, 's254', '', '', 0, '2012-01-08', '0000-00-00', '', 2, 1, 1, 2),
(502, 3, 7, 4, 0, 'r2349453', '', '', 0, '2012-01-08', '0000-00-00', '', 2, 1, 1, 2),
(503, 3, 1, 77, 0, 'l2a414w2', '', '', 0, '2012-01-08', '0000-00-00', '', 1, 1, 1, 1),
(504, 3, 1, 77, 0, 't25414', '', '', 0, '2012-01-08', '0000-00-00', '', 1, 1, 1, 7),
(505, 3, 10, 67, 0, 's264z3y284', '', '', 0, '2012-01-08', '0000-00-00', '', 1, 1, 1, 1),
(506, 3, 7, 2, 0, 'q254', '', '', 0, '2012-01-08', '0000-00-00', '', 1, 1, 1, 1),
(507, 3, 3, 15, 0, 'w25414', '', '', 0, '2012-01-10', '0000-00-00', '', 1, 1, 1, 3),
(508, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-01-10', '0000-00-00', '', 1, 1, 1, 1),
(509, 3, 1, 75, 0, 'x2d454u27463', '', '', 0, '2012-01-10', '0000-00-00', '', 2, 1, 1, 3),
(510, 3, 10, 67, 0, 'p2d4z35394', '', '', 0, '2012-01-10', '2012-02-15', '', 1, 2, 1, 3),
(511, 3, 8, 55, 6, 't2a4', '', '', 0, '2012-01-16', '2012-01-16', '', 1, 5, 1, 3),
(512, 3, 2, 5, 0, 't254z3w284', '', '', 0, '2012-01-11', '2012-02-15', '', 1, 2, 1, 3),
(513, 3, 7, 1, 0, 's23464', '', '', 0, '2012-01-11', '0000-00-00', '', 1, 1, 1, 1),
(514, 3, 1, 77, 0, 'l26414w2', '', '', 0, '2012-01-11', '0000-00-00', '', 1, 1, 1, 2),
(515, 3, 1, 77, 0, 'p25414', '', '', 0, '2012-01-11', '0000-00-00', '', 1, 1, 1, 1),
(516, 3, 7, 3, 0, 'p23444', '', '', 0, '2012-01-12', '0000-00-00', '', 1, 1, 1, 1),
(517, 3, 8, 49, 0, 't2', '', '', 0, '2012-01-12', '0000-00-00', '', 2, 1, 1, 2),
(518, 3, 11, 60, 0, 'p2c4', '', '', 0, '2012-01-13', '0000-00-00', '', 1, 1, 1, 1),
(519, 3, 8, 49, 0, 'p23424z2', '', '', 0, '2012-01-14', '0000-00-00', '', 1, 1, 1, 1),
(520, 3, 1, 74, 0, 'p2944443046384', '', '', 0, '2012-01-15', '0000-00-00', '', 1, 1, 1, 3),
(521, 3, 1, 77, 0, 'l2b414', '', '', 0, '2012-01-15', '0000-00-00', '', 1, 1, 1, 2),
(522, 3, 1, 77, 0, 'u254', '', '', 0, '2012-01-15', '0000-00-00', '', 1, 1, 1, 1),
(523, 3, 8, 52, 0, 'p274', '', '', 0, '2012-01-15', '0000-00-00', '', 1, 1, 1, 1),
(524, 3, 2, 5, 0, 't254', '', '', 0, '2012-01-15', '2012-02-15', '', 1, 2, 1, 3),
(525, 3, 3, 21, 0, 'r27464', '', '', 0, '2012-01-15', '0000-00-00', '', 1, 1, 1, 10),
(526, 3, 3, 18, 0, 'v274z353', '', '', 0, '2012-01-16', '0000-00-00', '', 1, 1, 1, 3),
(527, 3, 2, 10, 0, 'q25444u254z2', '', '', 0, '2012-01-16', '0000-00-00', '', 1, 1, 1, 3),
(528, 3, 10, 67, 0, 'q254', '', '', 0, '2012-01-16', '0000-00-00', '', 1, 1, 1, 1),
(529, 3, 10, 67, 0, 'w2', '', '', 0, '2012-01-16', '0000-00-00', '', 2, 1, 1, 2),
(530, 3, 7, 2, 0, 's2d4', '', '', 0, '2012-01-17', '0000-00-00', '', 1, 1, 1, 1),
(531, 3, 8, 65, 0, 'p25444w20423', '', '', 0, '2012-01-17', '0000-00-00', '', 1, 1, 1, 3),
(532, 3, 4, 24, 0, 'r2e4z3y294', '', '', 0, '2012-01-17', '0000-00-00', '', 1, 1, 1, 3),
(533, 3, 1, 81, 0, 'p2e414u25443', '', '', 0, '2012-01-18', '0000-00-00', '', 1, 1, 1, 3),
(534, 3, 7, 1, 0, 's23464', '', '', 0, '2012-01-18', '0000-00-00', '', 1, 1, 1, 1),
(535, 3, 10, 67, 0, 'q2a4z3w284', '', '', 0, '2012-01-18', '0000-00-00', '', 1, 1, 1, 1),
(536, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-01-19', '0000-00-00', '', 1, 1, 1, 1),
(537, 3, 5, 34, 0, 'p254z3w254', '', '', 0, '2012-01-21', '2012-02-15', '', 1, 2, 1, 3),
(538, 3, 1, 75, 0, 'x27494u29443', '', '', 0, '2012-01-21', '0000-00-00', '', 2, 1, 1, 10),
(539, 3, 1, 77, 0, 'l29464w2', '', '', 0, '2012-01-21', '0000-00-00', '', 1, 1, 1, 3),
(540, 3, 1, 77, 0, 's2a414', '', '', 0, '2012-01-21', '0000-00-00', '', 1, 1, 1, 2),
(541, 3, 2, 5, 0, 't274', '', '', 0, '2012-01-21', '2012-02-15', '', 1, 2, 1, 3),
(542, 3, 4, 31, 0, 's23414x2', '', '', 0, '2012-01-21', '2012-02-15', '', 1, 2, 1, 3),
(543, 3, 10, 67, 0, 's254', '', '', 0, '2012-01-22', '0000-00-00', '', 2, 1, 1, 2),
(544, 3, 9, 58, 0, 'q2a4z353a4', '', '', 0, '2012-01-22', '0000-00-00', '', 1, 2, 1, 2),
(545, 3, 1, 77, 0, 'l27414w2', '', '', 0, '2012-01-22', '0000-00-00', '', 1, 1, 1, 3),
(546, 3, 1, 77, 0, 'q25414', '', '', 0, '2012-01-22', '0000-00-00', '', 1, 1, 1, 2),
(547, 3, 10, 67, 0, 'p28414', '', '', 0, '2012-01-22', '0000-00-00', '', 2, 1, 1, 2),
(548, 3, 1, 77, 0, 'l29414', '', '', 0, '2012-01-22', '0000-00-00', '', 2, 1, 1, 2),
(549, 3, 1, 77, 0, 's254', '', '', 0, '2012-01-22', '0000-00-00', '', 2, 1, 1, 1),
(550, 3, 10, 67, 0, 'r2a4z30364', '', '', 0, '2012-01-22', '0000-00-00', '', 1, 1, 1, 1),
(551, 3, 11, 63, 0, 'p25414', '', '', 0, '2012-01-22', '0000-00-00', '', 2, 1, 1, 2),
(552, 3, 4, 23, 0, 'r254', '', '', 0, '2012-01-23', '0000-00-00', '', 1, 1, 1, 3),
(553, 3, 4, 29, 0, 'q2b4z3w244', '', '', 0, '2012-01-23', '0000-00-00', '', 1, 1, 1, 3),
(554, 3, 8, 84, 0, 'p254', '', '', 0, '2012-01-25', '0000-00-00', '', 2, 1, 1, 2),
(555, 3, 11, 63, 0, 's254', '', '', 0, '2012-01-25', '0000-00-00', '', 2, 1, 1, 2),
(556, 3, 1, 77, 0, 'l26414w2', '', '', 0, '2012-01-25', '0000-00-00', '', 2, 1, 1, 2),
(557, 3, 1, 77, 0, 'p25414', '', '', 0, '2012-01-25', '0000-00-00', '', 2, 1, 1, 1),
(558, 3, 11, 63, 0, 'p27464', '', '', 0, '2012-01-25', '0000-00-00', '', 2, 1, 1, 2),
(559, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-01-25', '0000-00-00', '', 1, 1, 1, 1),
(560, 3, 7, 1, 0, 't2341433', '', '', 0, '2012-01-26', '2012-02-15', '', 1, 2, 1, 3),
(561, 3, 5, 32, 0, 'p2d414', '', '', 0, '2012-01-26', '2012-01-26', '', 1, 5, 1, 3),
(562, 3, 11, 63, 0, 'r254', '', '', 0, '2012-01-26', '0000-00-00', '', 1, 1, 1, 1),
(563, 3, 11, 63, 0, 'p284z31364', '', '', 0, '2012-01-26', '0000-00-00', '', 2, 1, 1, 2),
(564, 3, 11, 63, 0, 'p2e4z3w284', '', '', 0, '2012-01-26', '0000-00-00', '', 1, 1, 1, 1),
(565, 3, 11, 63, 0, 'p25414', '', '', 0, '2012-01-26', '0000-00-00', '', 2, 1, 1, 2),
(566, 3, 10, 67, 0, 'u254z323', '', '', 0, '2012-01-27', '0000-00-00', '', 1, 1, 1, 1),
(567, 3, 10, 67, 0, 'r264z31344', '', '', 0, '2012-01-27', '0000-00-00', '', 1, 1, 1, 1),
(568, 3, 7, 2, 0, 'p2b4z35364', '', '', 0, '2012-01-27', '2012-02-15', '', 1, 2, 1, 3),
(569, 3, 1, 77, 0, 'l28414w2', '', '', 0, '2012-01-27', '0000-00-00', '', 1, 1, 1, 3),
(570, 3, 1, 77, 0, 'r25414', '', '', 0, '2012-01-27', '0000-00-00', '', 1, 1, 1, 1),
(571, 3, 2, 5, 0, 'u254', '', '', 0, '2012-01-28', '2012-02-15', '', 1, 2, 1, 3),
(572, 3, 11, 63, 0, 'u264', '', '', 0, '2012-01-29', '0000-00-00', '', 1, 1, 1, 1),
(573, 3, 1, 74, 0, 'p2944443046384', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 3),
(574, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 1),
(575, 3, 11, 63, 0, 'r2343433', '', '', 0, '2012-01-31', '2012-02-29', '', 1, 4, 1, 3),
(576, 3, 1, 74, 0, 'q26424w2', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 3),
(577, 3, 1, 74, 0, 'l27424x224', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 5),
(578, 3, 1, 77, 0, 'l27424x224', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 3),
(579, 3, 1, 77, 0, 'q26424w2', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 5),
(580, 3, 1, 74, 0, 'q26414', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 3),
(581, 3, 11, 85, 0, 's2a4z3y2', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 3),
(582, 3, 4, 23, 0, 'r264z3w244', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 3),
(583, 3, 4, 29, 0, 'q2a4', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 3),
(584, 3, 1, 77, 0, 'l26414w224', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 3),
(585, 3, 1, 77, 0, 'p25414w2', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 2),
(586, 3, 11, 63, 0, 'u2a414', '', '', 0, '2012-01-31', '0000-00-00', '', 1, 1, 1, 2),
(587, 3, 4, 24, 0, 'p25494u264y2', '', '', 0, '2012-02-06', '2012-02-06', '', 1, 1, 1, 3),
(588, 3, 1, 76, 0, 'v25414', '', '', 0, '2012-02-01', '0000-00-00', '', 1, 1, 1, 1),
(589, 3, 1, 77, 0, 'l26434w2', '', '', 0, '2012-02-01', '0000-00-00', '', 1, 1, 1, 3),
(590, 3, 1, 77, 0, 'p27414', '', '', 0, '2012-02-01', '0000-00-00', '', 1, 1, 1, 7),
(591, 3, 1, 77, 0, 'l2a414', '', '', 0, '2012-02-01', '0000-00-00', '', 1, 1, 1, 3),
(592, 3, 1, 77, 0, 't254', '', '', 0, '2012-02-01', '0000-00-00', '', 1, 1, 1, 9),
(593, 3, 3, 21, 0, 'q2c414u2a463', '', '', 0, '2012-02-01', '0000-00-00', '', 1, 1, 1, 10),
(594, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-02-01', '0000-00-00', '', 1, 1, 1, 1),
(595, 3, 4, 26, 0, 'v294', '', '', 0, '2012-02-10', '2012-02-10', '', 1, 1, 1, 3),
(596, 3, 4, 25, 0, 'v2b4z34344', '', '', 0, '2012-02-08', '2012-02-08', '', 1, 1, 1, 3),
(597, 3, 2, 5, 0, 'u254z3w234', '', '', 0, '2012-02-04', '2012-02-15', '', 1, 2, 1, 3),
(598, 3, 11, 60, 0, 'p264', '', '', 0, '2012-02-04', '0000-00-00', '', 2, 1, 1, 2),
(599, 3, 11, 63, 0, 'p28414', '', '', 0, '2012-02-04', '0000-00-00', '', 1, 1, 1, 1),
(600, 3, 10, 67, 0, 's2348413', '', '', 0, '2012-02-05', '0000-00-00', '', 1, 1, 1, 1),
(601, 3, 10, 67, 0, 'p254', '', '', 0, '2012-02-06', '0000-00-00', '', 1, 1, 1, 1),
(602, 3, 7, 1, 0, 'r2342403', '', '', 0, '2012-02-07', '0000-00-00', '', 1, 1, 1, 1),
(603, 3, 10, 67, 0, 'p254z3x2a4', '', '', 0, '2012-02-07', '2012-02-29', '', 1, 4, 1, 3),
(604, 3, 7, 1, 0, 's23464', '', '', 0, '2012-02-08', '0000-00-00', '', 1, 1, 1, 1),
(605, 3, 7, 1, 0, 'q23484y2', '', '', 0, '2012-02-09', '0000-00-00', '', 1, 1, 1, 1),
(606, 3, 1, 77, 0, 'l2b464w2', '', '', 0, '2012-02-09', '0000-00-00', '', 1, 1, 1, 1),
(607, 3, 1, 77, 0, 'u2a414', '', '', 0, '2012-02-09', '0000-00-00', '', 1, 1, 1, 3),
(608, 3, 3, 15, 0, 'w25414', '', '', 0, '2012-02-10', '0000-00-00', '', 1, 1, 1, 3),
(609, 3, 2, 5, 0, 't284', '', '', 0, '2012-02-10', '2012-02-15', '', 1, 2, 1, 3),
(610, 3, 3, 20, 0, 'p254z313b4', '', '', 0, '2012-02-11', '2012-02-15', '', 1, 2, 1, 3),
(611, 3, 10, 67, 0, 'u264z32394', '', '', 0, '2012-02-11', '2012-02-15', '', 1, 2, 1, 3),
(612, 3, 10, 67, 0, 'p2e4z333a4', '', '', 0, '2012-02-12', '2012-02-29', '', 1, 4, 1, 3),
(613, 3, 5, 33, 0, 'q23434x2', '', '', 0, '2012-02-12', '2012-02-29', '', 1, 4, 1, 3),
(614, 3, 1, 77, 0, 'l29464w2', '', '', 0, '2012-02-12', '0000-00-00', '', 2, 1, 1, 2),
(615, 3, 1, 77, 0, 's2a414', '', '', 0, '2012-02-12', '0000-00-00', '', 2, 1, 1, 3),
(616, 3, 11, 60, 0, 'p294', '', '', 0, '2012-02-12', '0000-00-00', '', 1, 1, 1, 1),
(617, 3, 7, 1, 0, 't2341433', '', '', 0, '2012-02-13', '2012-02-15', '', 1, 2, 1, 3),
(618, 3, 10, 67, 0, 't2a4', '', '', 0, '2012-02-13', '0000-00-00', '', 2, 1, 1, 2),
(619, 3, 11, 63, 0, 'r284z313a4', '', '', 0, '2012-02-14', '2012-03-20', '', 1, 4, 1, 3),
(620, 3, 11, 63, 0, 'p25414', '', '', 0, '2012-02-14', '2012-02-15', '', 1, 2, 1, 3),
(621, 3, 8, 84, 0, 'p254', '', '', 0, '2012-02-14', '0000-00-00', '', 1, 1, 1, 1),
(622, 3, 1, 74, 0, 'p2a474230443', '', '', 0, '2012-02-15', '0000-00-00', '', 1, 1, 1, 3),
(623, 3, 7, 1, 0, 'u2343413', '', '', 0, '2012-02-15', '0000-00-00', '', 1, 1, 1, 1),
(624, 3, 3, 18, 0, 'v274z353', '', '', 0, '2012-02-16', '0000-00-00', '', 1, 1, 1, 3),
(625, 3, 2, 10, 0, 'q25444u254z2', '', '', 0, '2012-02-16', '0000-00-00', '', 1, 1, 1, 3),
(626, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-02-16', '0000-00-00', '', 1, 1, 1, 1),
(627, 3, 1, 81, 0, 'p2e414u25443', '', '', 0, '2012-02-18', '0000-00-00', '', 1, 1, 1, 3),
(628, 3, 2, 5, 0, 't2d4z3w234', '', '', 0, '2012-02-19', '2012-03-17', '', 1, 2, 1, 3),
(629, 3, 8, 49, 0, 't23454x2', '', '', 0, '2012-02-21', '2012-03-17', '', 1, 2, 1, 3),
(630, 3, 10, 67, 0, 'p2a4', '', '', 0, '2012-02-22', '0000-00-00', '', 2, 1, 1, 2),
(631, 3, 10, 67, 0, 'p2a4', '', '', 0, '2012-02-22', '0000-00-00', '', 2, 1, 1, 2),
(632, 3, 8, 49, 0, 'q254z323', '', '', 0, '2012-02-22', '2012-03-17', '', 1, 2, 1, 3),
(633, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-02-23', '0000-00-00', '', 1, 1, 1, 1),
(634, 3, 8, 49, 0, 'p294', '', '', 0, '2012-02-23', '0000-00-00', '', 2, 1, 1, 2),
(635, 3, 1, 75, 0, 'w26484u27453', '', '', 0, '2012-02-23', '0000-00-00', '', 2, 1, 1, 3),
(636, 3, 1, 77, 0, 'l28414w224', '', '', 0, '2012-02-23', '0000-00-00', '', 1, 1, 1, 3),
(637, 3, 1, 77, 0, 'r25414w2', '', '', 0, '2012-02-23', '0000-00-00', '', 1, 1, 1, 7),
(638, 3, 1, 77, 0, 'l26414w224', '', '', 0, '2012-02-23', '0000-00-00', '', 2, 1, 1, 3),
(639, 3, 1, 77, 0, 'p25414w2', '', '', 0, '2012-02-23', '0000-00-00', '', 2, 1, 1, 9),
(640, 3, 8, 49, 0, 'q2', '', '', 0, '2012-02-24', '0000-00-00', '', 1, 1, 1, 1);
INSERT INTO `spending` (`id`, `user_id`, `category_id`, `item_id`, `comment_id`, `expenses`, `code`, `detail`, `amount`, `date`, `paid_date`, `whospend`, `spender_id`, `type_id`, `paid`, `bank_id`) VALUES
(641, 3, 10, 67, 0, 'v2342453', '', '', 0, '2012-02-24', '2012-03-17', '', 1, 2, 1, 3),
(642, 3, 1, 77, 0, 'l27414w2', '', '', 0, '2012-02-25', '0000-00-00', '', 1, 1, 1, 3),
(643, 3, 1, 77, 0, 'q25414', '', '', 0, '2012-02-25', '0000-00-00', '', 1, 1, 1, 2),
(644, 3, 5, 32, 0, 'p2d414', '', '', 0, '2012-02-25', '0000-00-00', '', 1, 1, 1, 3),
(645, 3, 10, 67, 0, 'p2a4z3w294', '', '', 0, '2012-02-25', '0000-00-00', '', 1, 1, 1, 1),
(646, 3, 10, 67, 0, 'u2349413', '', '', 0, '2012-02-25', '0000-00-00', '', 1, 1, 1, 1),
(647, 3, 10, 67, 0, 'q25414', '', '', 0, '2012-02-25', '0000-00-00', '', 2, 1, 1, 2),
(648, 3, 11, 63, 0, 'p2e414', '', '', 0, '2012-02-25', '0000-00-00', '', 2, 1, 1, 2),
(649, 3, 4, 23, 0, 'q2d4', '', '', 0, '2012-02-25', '0000-00-00', '', 1, 1, 1, 3),
(650, 3, 4, 29, 0, 'q2c4z343', '', '', 0, '2012-02-25', '0000-00-00', '', 1, 1, 1, 3),
(651, 3, 4, 28, 0, 's28414u22463', '', '', 0, '2012-02-25', '0000-00-00', '', 1, 1, 1, 3),
(652, 3, 9, 57, 0, 'p2a444u28453', '', '', 0, '2012-02-26', '2012-03-12', '', 1, 8, 1, 3),
(653, 3, 9, 56, 0, 'p294z32384', '', '', 0, '2012-02-26', '2012-03-12', '', 1, 8, 1, 3),
(654, 3, 9, 59, 0, 'u254z353a4', '', '', 0, '2012-02-26', '2012-03-28', '', 1, 3, 1, 3),
(655, 3, 1, 77, 0, 'l26414w2', '', '', 0, '2012-02-26', '0000-00-00', '', 1, 1, 1, 1),
(656, 3, 1, 77, 0, 'p25414', '', '', 0, '2012-02-26', '0000-00-00', '', 1, 1, 1, 2),
(657, 3, 7, 1, 0, 'r234a433', '', '', 0, '2012-02-28', '0000-00-00', '', 1, 1, 1, 1),
(658, 3, 2, 5, 0, 't2d4', '', '', 0, '2012-02-28', '2012-03-17', '', 1, 2, 1, 3),
(659, 3, 10, 67, 0, 't234a453', '', '', 0, '2012-02-28', '2012-03-20', '', 1, 4, 1, 3),
(660, 3, 4, 24, 0, 'v274z3z244', '', '', 0, '2012-03-08', '2012-03-08', '', 1, 1, 1, 3),
(661, 3, 10, 67, 0, 'q2c4', '', '', 0, '2012-02-28', '0000-00-00', '', 2, 1, 1, 2),
(662, 3, 7, 1, 0, 't23464', '', '', 0, '2012-02-29', '0000-00-00', '', 1, 1, 1, 1),
(663, 3, 7, 2, 0, 'r254z323', '', '', 0, '2012-02-29', '2012-03-17', '', 1, 2, 1, 3),
(664, 3, 1, 76, 0, 'v25414', '', '', 0, '2012-03-01', '0000-00-00', '', 1, 1, 1, 1),
(665, 3, 1, 77, 0, 'l26434w2', '', '', 0, '2012-03-01', '0000-00-00', '', 1, 1, 1, 3),
(666, 3, 1, 77, 0, 'p27414', '', '', 0, '2012-03-01', '0000-00-00', '', 1, 1, 1, 7),
(667, 3, 1, 77, 0, 'l2a414', '', '', 0, '2012-03-01', '0000-00-00', '', 1, 1, 1, 3),
(668, 3, 1, 77, 0, 't254', '', '', 0, '2012-03-01', '0000-00-00', '', 1, 1, 1, 9),
(669, 3, 3, 21, 0, 'q2c414u2a463', '', '', 0, '2012-03-01', '0000-00-00', '', 1, 1, 1, 10),
(670, 3, 7, 1, 0, 't23464', '', '', 0, '2012-03-01', '0000-00-00', '', 1, 1, 1, 1),
(671, 3, 10, 67, 0, 'q2a4z35394', '', '', 0, '2012-03-01', '2012-03-17', '', 1, 2, 1, 3),
(672, 3, 1, 74, 0, 'p2a474230443', '', '', 0, '2012-03-02', '0000-00-00', '', 1, 1, 1, 3),
(673, 3, 10, 67, 0, 'q274z3y2b4', '', '', 0, '2012-03-02', '2012-03-17', '', 1, 2, 1, 3),
(674, 3, 7, 1, 0, 'q274', '', '', 0, '2012-03-02', '0000-00-00', '', 1, 1, 1, 1),
(675, 3, 10, 67, 0, 'u294z303a4', '', '', 0, '2012-03-02', '0000-00-00', '', 1, 1, 1, 2),
(676, 3, 2, 86, 0, 'v2a4', '', '', 0, '2012-03-03', '2012-03-17', '', 1, 2, 1, 3),
(677, 3, 1, 77, 0, 'l2a414w2', '', '', 0, '2012-03-03', '0000-00-00', '', 1, 1, 1, 1),
(678, 3, 1, 77, 0, 't25414', '', '', 0, '2012-03-03', '0000-00-00', '', 1, 1, 1, 2),
(679, 3, 1, 75, 0, 'v2e424u29433', '', '', 0, '2012-03-03', '0000-00-00', '', 2, 1, 1, 3),
(680, 3, 10, 67, 0, 'p2b4z3x2a4', '', '', 0, '2012-03-03', '0000-00-00', '', 1, 1, 1, 1),
(681, 3, 10, 67, 0, 'p294z34374', '', '', 0, '2012-03-03', '2012-03-17', '', 1, 2, 1, 3),
(682, 3, 4, 26, 0, 's284', '', '', 0, '2012-03-09', '2012-03-09', '', 1, 1, 1, 3),
(683, 3, 4, 25, 0, 'v2b4z34344', '', '', 0, '2012-03-09', '2012-03-09', '', 1, 1, 1, 3),
(684, 3, 10, 67, 0, 't294z35374', '', '', 0, '2012-03-06', '2012-03-17', '', 1, 2, 1, 3),
(685, 3, 10, 67, 0, 'l28424', '', '', 0, '2012-03-06', '0000-00-00', '', 2, 1, 1, 2),
(686, 3, 7, 1, 0, 'p2e4z3y274', '', '', 0, '2012-03-06', '2012-03-17', '', 1, 2, 1, 3),
(687, 3, 7, 1, 0, 'p23474', '', '', 0, '2012-03-06', '0000-00-00', '', 1, 1, 1, 1),
(688, 3, 2, 5, 0, 't2d4z3w254', '', '', 0, '2012-03-06', '2012-03-17', '', 1, 2, 1, 3),
(689, 3, 8, 49, 0, 'r234a423', '', '', 0, '2012-03-06', '0000-00-00', '', 1, 1, 1, 1),
(690, 3, 7, 1, 0, 't23464', '', '', 0, '2012-03-07', '0000-00-00', '', 1, 1, 1, 1),
(691, 3, 7, 1, 0, 's2341413', '', '', 0, '2012-03-08', '0000-00-00', '', 1, 1, 1, 1),
(692, 3, 7, 2, 0, 'p2d4z3x274', '', '', 0, '2012-03-08', '2012-04-16', '', 1, 2, 1, 3),
(693, 3, 10, 67, 0, 'q2e4z33334', '', '', 0, '2012-03-09', '0000-00-00', '', 1, 1, 1, 1),
(694, 3, 10, 67, 0, 'u254z3y254', '', '', 0, '2012-03-09', '0000-00-00', '', 2, 1, 1, 2),
(695, 3, 10, 67, 0, 'u254z3y254', '', '', 0, '2012-03-09', '0000-00-00', '', 2, 1, 1, 2),
(696, 3, 11, 63, 0, 'p25414', '', '', 0, '2012-03-09', '0000-00-00', '', 2, 1, 1, 2),
(697, 3, 10, 67, 0, 'r2c4', '', '', 0, '2012-03-09', '0000-00-00', '', 2, 1, 1, 2),
(698, 3, 3, 15, 0, 'w25414', '', '', 0, '2012-03-10', '0000-00-00', '', 1, 1, 1, 3),
(699, 3, 8, 49, 0, 'r2b4z333', '', '', 0, '2012-03-10', '2012-03-28', '', 1, 3, 1, 3),
(700, 3, 11, 87, 0, 'w23474z2', '', '', 0, '2012-03-10', '2012-03-28', '', 1, 3, 1, 3),
(701, 3, 10, 67, 0, 's2346453', '', '', 0, '2012-03-10', '2012-03-28', '', 1, 3, 1, 3),
(702, 3, 6, 43, 0, 'w254', '', '', 0, '2012-03-11', '0000-00-00', '', 1, 1, 1, 1),
(703, 3, 11, 63, 0, 'q25414', '', '', 0, '2012-03-11', '0000-00-00', '', 1, 1, 1, 2),
(704, 3, 2, 5, 0, 't2d4', '', '', 0, '2012-03-12', '2012-03-28', '', 1, 3, 1, 3),
(705, 3, 2, 5, 0, 'l2a494', '', '', 0, '2012-03-12', '0000-00-00', '', 1, 1, 1, 3),
(706, 3, 2, 5, 0, 't2d4', '', '', 0, '2012-03-12', '2012-04-24', '', 1, 3, 1, 3),
(707, 3, 10, 67, 0, 'p2b4z33394', '', '', 0, '2012-03-12', '2012-03-28', '', 1, 3, 1, 3),
(708, 3, 7, 1, 0, 'p2', '', '', 0, '2012-03-13', '0000-00-00', '', 1, 1, 1, 1),
(709, 3, 4, 24, 0, 'p26444', '', '', 0, '2012-03-13', '2012-03-28', '', 1, 3, 1, 3),
(710, 3, 10, 67, 0, 't234a433', '', '', 0, '2012-03-13', '2012-03-28', '', 1, 3, 1, 3),
(711, 3, 10, 67, 0, 'x23464', '', '', 0, '2012-03-13', '0000-00-00', '', 2, 1, 1, 2),
(712, 3, 7, 1, 0, 's2341413', '', '', 0, '2012-03-14', '0000-00-00', '', 1, 1, 1, 1),
(713, 3, 1, 74, 0, 'p2a474230443', '', '', 0, '2012-03-15', '0000-00-00', '', 1, 1, 1, 3),
(714, 3, 10, 67, 0, 'w2345423', '', '', 0, '2012-03-15', '2012-03-20', '', 1, 4, 1, 3),
(715, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-03-15', '0000-00-00', '', 1, 1, 1, 1),
(716, 3, 10, 67, 0, 'w2c4z35374', '', '', 0, '2012-03-15', '2012-03-20', '', 1, 4, 1, 3),
(717, 3, 10, 67, 0, 'l2c414u25433', '', '', 0, '2012-03-15', '0000-00-00', '', 1, 1, 1, 2),
(718, 3, 3, 18, 0, 'v274z353', '', '', 0, '2012-03-17', '0000-00-00', '', 1, 1, 1, 3),
(719, 3, 2, 10, 0, 'q25444u254z2', '', '', 0, '2012-03-17', '0000-00-00', '', 1, 1, 1, 3),
(720, 3, 10, 67, 0, 'q2e4z3z254', '', '', 0, '2012-03-17', '2012-03-28', '', 1, 3, 1, 3),
(721, 3, 1, 75, 0, 'v2d494u24423', '', '', 0, '2012-03-17', '0000-00-00', '', 2, 1, 1, 3),
(722, 3, 9, 59, 0, 'w23474x2', '', '', 0, '2012-03-17', '2012-03-28', '', 1, 3, 1, 3),
(723, 3, 9, 58, 0, 'p29474u2b4', '', '', 0, '2012-03-17', '2012-03-28', '', 1, 3, 1, 3),
(724, 3, 1, 81, 0, 'p2e414u25443', '', '', 0, '2012-03-18', '0000-00-00', '', 1, 1, 1, 3),
(725, 3, 11, 63, 0, 'u2348413', '', '', 0, '2012-03-18', '2012-03-28', '', 1, 3, 1, 3),
(726, 3, 11, 63, 0, 'p23424z2', '', '', 0, '2012-03-18', '0000-00-00', '', 1, 1, 1, 1),
(727, 3, 10, 67, 0, 'q274z33334', '', '', 0, '2012-03-18', '0000-00-00', '', 1, 1, 1, 3),
(728, 3, 10, 67, 0, 'p264z313', '', '', 0, '2012-03-19', '0000-00-00', '', 2, 1, 1, 2),
(729, 3, 8, 49, 0, 't23444', '', '', 0, '2012-03-19', '2012-03-28', '', 1, 3, 1, 3),
(730, 3, 11, 88, 0, 'q25494', '', '', 0, '2012-03-19', '2012-04-24', '', 1, 3, 1, 3),
(731, 3, 7, 1, 0, 's234a413', '', '', 0, '2012-03-20', '0000-00-00', '', 1, 1, 1, 1),
(732, 3, 7, 1, 0, 'p2a4', '', '', 0, '2012-03-20', '0000-00-00', '', 1, 1, 1, 1),
(733, 3, 2, 5, 0, 't2d4z3w234', '', '', 0, '2012-03-21', '2012-03-28', '', 1, 3, 1, 3),
(734, 3, 8, 49, 0, 'q254', '', '', 0, '2012-03-21', '0000-00-00', '', 2, 1, 1, 2),
(735, 3, 7, 1, 0, 's234a413', '', '', 0, '2012-03-21', '0000-00-00', '', 1, 1, 1, 1),
(736, 3, 7, 2, 0, 'q254z3z244', '', '', 0, '2012-03-21', '2012-03-28', '', 1, 3, 1, 3),
(737, 3, 4, 30, 0, 'u264z31394', '', '', 0, '2012-03-22', '2012-04-27', '', 1, 4, 1, 3),
(738, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-03-22', '0000-00-00', '', 1, 1, 1, 1),
(739, 3, 4, 23, 0, 'q2d4', '', '', 0, '2012-03-23', '2012-03-23', '', 1, 1, 1, 3),
(740, 3, 4, 29, 0, 'q2c4z343', '', '', 0, '2012-03-23', '2012-03-23', '', 1, 1, 1, 3),
(741, 3, 10, 67, 0, 't254z30344', '', '', 0, '2012-03-23', '2012-04-24', '', 1, 3, 1, 3),
(742, 3, 11, 64, 0, 'p264z3x2a4', '', '', 0, '2012-03-23', '2012-04-24', '', 1, 3, 1, 3),
(743, 3, 10, 67, 0, 's2343443', '', '', 0, '2012-03-23', '0000-00-00', '', 2, 1, 1, 2),
(744, 3, 11, 60, 0, 'p284z3z2', '', '', 0, '2012-03-24', '0000-00-00', '', 1, 1, 1, 1),
(745, 3, 7, 2, 0, 'p254', '', '', 0, '2012-03-24', '0000-00-00', '', 1, 1, 1, 1),
(746, 3, 3, 20, 0, 's2b4z34374', '', '', 0, '2012-03-24', '2012-04-27', '', 1, 4, 1, 3),
(747, 3, 2, 7, 0, 'p26494u27453', '', '', 0, '2012-03-25', '2012-04-24', '', 1, 3, 1, 3),
(748, 3, 2, 7, 0, 'u2c4z333b4', '', '', 0, '2012-03-25', '2012-04-24', '', 1, 3, 1, 3),
(749, 3, 10, 67, 0, 'p2c4z313b4', '', '', 0, '2012-03-26', '2012-04-24', '', 1, 3, 1, 3),
(750, 3, 7, 1, 0, 's234a413', '', '', 0, '2012-03-27', '0000-00-00', '', 1, 1, 1, 1),
(751, 3, 8, 84, 0, 's2348413', '', '', 0, '2012-03-27', '0000-00-00', '', 1, 1, 1, 1),
(752, 3, 8, 49, 0, 'p2c4z3y254', '', '', 0, '2012-03-28', '2012-04-24', '', 1, 3, 1, 3),
(753, 3, 2, 5, 0, 't2d4', '', '', 0, '2012-03-28', '2012-04-24', '', 1, 3, 1, 3),
(754, 3, 7, 1, 0, 's2341413', '', '', 0, '2012-03-28', '0000-00-00', '', 1, 1, 1, 1),
(755, 3, 10, 67, 0, 'p2a4', '', '', 0, '2012-03-28', '0000-00-00', '', 2, 1, 1, 2),
(756, 3, 11, 60, 0, 'p2b4', '', '', 0, '2012-03-28', '0000-00-00', '', 2, 1, 1, 2),
(757, 3, 8, 52, 0, 't23474z2', '', '', 0, '2012-03-28', '2012-03-28', '', 1, 3, 1, 3),
(758, 3, 4, 24, 0, 'u254z3x244', '', '', 0, '2012-04-03', '2012-04-03', '', 1, 1, 1, 3),
(759, 3, 10, 67, 0, 'q284z3y264', '', '', 0, '2012-03-28', '2012-04-24', '', 1, 3, 1, 3),
(760, 3, 8, 49, 0, 'p254', '', '', 0, '2012-03-29', '0000-00-00', '', 1, 1, 1, 1),
(761, 3, 7, 1, 0, 's234a413', '', '', 0, '2012-03-29', '0000-00-00', '', 1, 1, 1, 1),
(762, 3, 10, 67, 0, 'p264z3z244', '', '', 0, '2012-03-29', '2012-04-24', '', 1, 3, 1, 3),
(763, 3, 11, 63, 0, 'q2b4z31384', '', '', 0, '2012-03-29', '2012-04-24', '', 1, 3, 1, 3),
(764, 3, 3, 17, 0, 'q234a4z2', '', '', 0, '2012-03-30', '0000-00-00', '', 1, 1, 1, 1),
(765, 3, 10, 67, 0, 's294z313b4', '', '', 0, '2012-03-30', '0000-00-00', '', 1, 1, 1, 1),
(766, 3, 7, 1, 0, 'w264z30334', '', '', 0, '2012-04-09', '2012-04-09', '', 1, 1, 1, 3),
(767, 3, 7, 1, 0, 'l2d424u264y2', '', '', 0, '2012-04-09', '2012-04-09', '', 1, 1, 1, 3),
(768, 3, 4, 25, 0, 'w264z30334', '', '', 0, '2012-04-09', '2012-04-09', '', 1, 1, 1, 3),
(769, 3, 4, 26, 0, 's284', '', '', 0, '2012-04-09', '2012-04-09', '', 1, 1, 1, 3),
(770, 3, 1, 74, 0, 'p2a474230443', '', '', 0, '2012-03-31', '0000-00-00', '', 1, 1, 1, 3),
(771, 3, 11, 63, 0, 'p2d4z3w284', '', '', 0, '2012-03-31', '2012-04-24', '', 1, 3, 1, 3),
(772, 3, 1, 75, 0, 'w26434u26463', '', '', 0, '2012-03-31', '0000-00-00', '', 2, 1, 1, 3),
(773, 3, 1, 77, 0, 'l29464w2', '', '', 0, '2012-03-31', '0000-00-00', '', 1, 1, 1, 3),
(774, 3, 1, 77, 0, 's2a414', '', '', 0, '2012-03-31', '0000-00-00', '', 1, 1, 1, 2),
(775, 3, 1, 77, 0, 'l26464w2', '', '', 0, '2012-03-31', '0000-00-00', '', 1, 1, 1, 3),
(776, 3, 1, 77, 0, 'p2a414', '', '', 0, '2012-03-31', '0000-00-00', '', 1, 1, 1, 1),
(777, 3, 10, 67, 0, 'w254', '', '', 0, '2012-03-31', '0000-00-00', '', 1, 1, 1, 2),
(778, 3, 7, 1, 0, 'p274z30344', '', '', 0, '2012-03-31', '2012-04-24', '', 1, 3, 1, 3),
(779, 3, 7, 2, 0, 'x2343423', '', '', 0, '2012-03-31', '2012-04-24', '', 1, 3, 1, 3),
(780, 3, 1, 76, 0, 'v25414', '', '', 0, '2012-04-01', '0000-00-00', '', 1, 1, 1, 1),
(781, 3, 1, 77, 0, 'l26434w2', '', '', 0, '2012-04-01', '0000-00-00', '', 1, 1, 1, 3),
(782, 3, 1, 77, 0, 'p27414', '', '', 0, '2012-04-01', '0000-00-00', '', 1, 1, 1, 7),
(783, 3, 1, 77, 0, 'l2a414', '', '', 0, '2012-04-01', '0000-00-00', '', 1, 1, 1, 3),
(784, 3, 1, 77, 0, 't254', '', '', 0, '2012-04-01', '0000-00-00', '', 1, 1, 1, 9),
(785, 3, 3, 21, 0, 'q2c414u2a463', '', '', 0, '2012-04-01', '0000-00-00', '', 1, 1, 1, 10),
(786, 3, 1, 89, 0, 'r254441304x254', '', '', 0, '2012-04-01', '0000-00-00', '', 1, 1, 1, 3),
(787, 3, 1, 76, 0, 'l2c414w2', '', '', 0, '2012-04-01', '0000-00-00', '', 1, 1, 1, 1),
(788, 3, 11, 63, 0, 'q2a4z3x2', '', '', 0, '2012-04-01', '2012-04-24', '', 1, 3, 1, 3),
(789, 3, 3, 20, 0, 'r2344443', '', '', 0, '2012-04-02', '0000-00-00', '', 1, 1, 1, 1),
(790, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-04-03', '0000-00-00', '', 1, 1, 1, 1),
(791, 3, 10, 67, 0, 'q254', '', '', 0, '2012-04-03', '0000-00-00', '', 2, 1, 1, 2),
(792, 3, 10, 67, 0, 't234a453', '', '', 0, '2012-04-03', '2012-04-27', '', 1, 4, 1, 3),
(793, 3, 6, 42, 0, 'p254', '', '', 0, '2012-04-03', '0000-00-00', '', 2, 1, 1, 2),
(794, 3, 1, 78, 0, 'v25414', '', '', 0, '2012-04-03', '0000-00-00', '', 2, 1, 1, 2),
(795, 3, 2, 5, 0, 't284', '', '', 0, '2012-04-03', '2012-04-24', '', 1, 3, 1, 3),
(796, 3, 7, 2, 0, 'w2d4', '', '', 0, '2012-04-03', '2012-04-24', '', 1, 3, 1, 3),
(797, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-04-04', '0000-00-00', '', 1, 1, 1, 1),
(798, 3, 10, 67, 0, 'p2b4z353a4', '', '', 0, '2012-04-04', '2012-04-27', '', 1, 4, 1, 3),
(799, 3, 11, 63, 0, 'r264z3x264', '', '', 0, '2012-04-05', '2012-04-24', '', 1, 3, 1, 3),
(800, 3, 10, 67, 0, 'p2a4', '', '', 0, '2012-04-05', '0000-00-00', '', 2, 1, 1, 2),
(801, 3, 11, 63, 0, 's254', '', '', 0, '2012-04-05', '0000-00-00', '', 1, 1, 1, 1),
(802, 3, 1, 77, 0, 'l29414w2', '', '', 0, '2012-04-06', '0000-00-00', '', 1, 1, 1, 3),
(803, 3, 1, 77, 0, 's25414', '', '', 0, '2012-04-06', '0000-00-00', '', 1, 1, 1, 5),
(804, 3, 1, 77, 0, 'l26414w224', '', '', 0, '2012-04-06', '0000-00-00', '', 1, 1, 1, 3),
(805, 3, 1, 77, 0, 'p25414w2', '', '', 0, '2012-04-06', '0000-00-00', '', 1, 1, 1, 6),
(806, 3, 1, 77, 0, 'l2848433044354', '', '', 0, '2012-04-06', '0000-00-00', '', 1, 1, 1, 8),
(807, 3, 1, 77, 0, 'r2c484u29413', '', '', 0, '2012-04-06', '0000-00-00', '', 1, 1, 1, 3),
(808, 3, 1, 77, 0, 'l2d414', '', '', 0, '2012-04-06', '0000-00-00', '', 1, 1, 1, 2),
(809, 3, 1, 77, 0, 'w254', '', '', 0, '2012-04-06', '0000-00-00', '', 1, 1, 1, 1),
(810, 3, 11, 63, 0, 'r254z3x234', '', '', 0, '2012-04-06', '0000-00-00', '', 2, 1, 1, 2),
(811, 3, 11, 63, 0, 'r25414', '', '', 0, '2012-04-08', '0000-00-00', '', 2, 1, 1, 2),
(812, 3, 7, 2, 0, 'v294', '', '', 0, '2012-04-08', '0000-00-00', '', 1, 3, 1, 1),
(813, 3, 11, 87, 0, 'w23474z2', '', '', 0, '2012-04-09', '2012-04-24', '', 1, 3, 1, 3),
(814, 3, 7, 1, 0, 's2341413', '', '', 0, '2012-04-09', '0000-00-00', '', 1, 1, 1, 1),
(815, 3, 11, 87, 0, 'v2342443', '', '', 0, '2012-04-09', '2012-04-24', '', 1, 3, 1, 3),
(816, 3, 3, 15, 0, 'w25414', '', '', 0, '2012-04-10', '0000-00-00', '', 1, 1, 1, 3),
(817, 3, 11, 63, 0, 'q25414', '', '', 0, '2012-04-10', '0000-00-00', '', 1, 1, 1, 1),
(818, 3, 11, 63, 0, 'l27414w2', '', '', 0, '2012-04-10', '0000-00-00', '', 1, 1, 1, 1),
(819, 3, 1, 78, 0, 'q25414', '', '', 0, '2012-04-10', '0000-00-00', '', 1, 1, 1, 1),
(820, 3, 8, 49, 0, 's2', '', '', 0, '2012-04-10', '0000-00-00', '', 1, 1, 1, 1),
(821, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-04-10', '0000-00-00', '', 1, 1, 1, 1),
(822, 3, 10, 68, 0, 'p294z35394', '', '', 0, '2012-04-10', '2012-04-27', '', 1, 4, 1, 3),
(823, 3, 8, 49, 0, 'r254', '', '', 0, '2012-04-10', '2012-05-12', '', 1, 5, 1, 3),
(824, 3, 8, 54, 0, 'p2b464', '', '', 0, '2012-04-10', '2012-05-12', '', 1, 5, 1, 3),
(825, 3, 2, 5, 0, 't2d4', '', '', 0, '2012-04-11', '2012-04-24', '', 1, 3, 1, 3),
(826, 3, 7, 1, 0, 's234a413', '', '', 0, '2012-04-11', '0000-00-00', '', 1, 1, 1, 1),
(827, 3, 10, 67, 0, 't294z353', '', '', 0, '2012-04-12', '2012-04-24', '', 1, 3, 1, 3),
(828, 3, 7, 1, 0, 's2341413', '', '', 0, '2012-04-12', '0000-00-00', '', 1, 1, 1, 1),
(829, 3, 7, 2, 0, 'q254z3z254', '', '', 0, '2012-04-13', '2012-04-24', '', 1, 3, 1, 3),
(830, 3, 1, 77, 0, 'l26424z264v234t2', '', '', 0, '2012-04-14', '0000-00-00', '', 1, 1, 1, 10),
(831, 3, 1, 77, 0, 'p264440304z244', '', '', 0, '2012-04-14', '0000-00-00', '', 1, 1, 1, 3),
(832, 3, 12, 70, 7, 's25414', '', '', 0, '2012-04-14', '2012-04-24', '', 1, 3, 1, 3),
(833, 3, 12, 70, 7, 's25414', '', '', 0, '2012-04-14', '2012-04-24', '', 1, 3, 1, 3),
(834, 3, 12, 70, 7, 'r25414', '', '', 0, '2012-04-14', '2012-04-24', '', 1, 3, 1, 3),
(835, 3, 1, 75, 0, 'v2a434', '', '', 0, '2012-04-14', '0000-00-00', '', 2, 1, 1, 3),
(836, 3, 9, 58, 0, 'q2a4z3y264', '', '', 0, '2012-04-14', '2012-04-24', '', 2, 3, 1, 3),
(837, 3, 3, 20, 0, 'v2', '', '', 0, '2012-04-14', '0000-00-00', '', 2, 1, 1, 3),
(838, 3, 7, 2, 0, 'r274', '', '', 0, '2012-04-14', '0000-00-00', '', 1, 1, 1, 1),
(839, 3, 7, 2, 0, 'p264z3y2b4', '', '', 0, '2012-04-14', '2012-04-24', '', 1, 3, 1, 3),
(840, 3, 1, 74, 0, 'p2a474230443', '', '', 0, '2012-04-15', '0000-00-00', '', 1, 1, 1, 3),
(841, 3, 10, 67, 0, 'p274z3y234', '', '', 0, '2012-04-15', '2012-04-24', '', 1, 3, 1, 3),
(842, 3, 1, 78, 0, 't254', '', '', 0, '2012-04-15', '0000-00-00', '', 1, 1, 1, 6),
(843, 3, 1, 78, 0, 't254', '', '', 0, '2012-04-15', '0000-00-00', '', 1, 1, 1, 5),
(844, 3, 1, 78, 0, 'q25414', '', '', 0, '2012-04-15', '0000-00-00', '', 1, 1, 1, 5),
(845, 3, 1, 77, 0, 'l27414w2', '', '', 0, '2012-04-15', '0000-00-00', '', 1, 1, 1, 3),
(846, 3, 1, 77, 0, 'q25414', '', '', 0, '2012-04-15', '0000-00-00', '', 1, 1, 1, 1),
(847, 3, 3, 18, 0, 'v274z353', '', '', 0, '2012-04-17', '0000-00-00', '', 1, 1, 1, 3),
(848, 3, 2, 10, 0, 'q25444u254z2', '', '', 0, '2012-04-17', '0000-00-00', '', 1, 1, 1, 3),
(849, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-04-17', '0000-00-00', '', 1, 1, 1, 1),
(850, 3, 10, 67, 0, 'x2341443', '', '', 0, '2012-04-17', '2012-05-25', '', 1, 4, 1, 3),
(851, 3, 1, 81, 0, 'p2e414u25443', '', '', 0, '2012-04-18', '0000-00-00', '', 1, 1, 1, 3),
(852, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-04-18', '0000-00-00', '', 1, 1, 1, 1),
(853, 3, 10, 67, 0, 'p274z303b4', '', '', 0, '2012-04-18', '2012-05-25', '', 1, 4, 1, 3),
(854, 3, 2, 5, 0, 't2d4', '', '', 0, '2012-04-18', '2012-04-24', '', 1, 3, 1, 3),
(855, 3, 7, 1, 0, 's234a413', '', '', 0, '2012-04-19', '0000-00-00', '', 1, 1, 1, 1),
(856, 3, 4, 23, 0, 'q2d4', '', '', 0, '2012-04-23', '2012-04-23', '', 1, 1, 1, 3),
(857, 3, 4, 29, 0, 'q2c4z343', '', '', 0, '2012-04-23', '2012-04-23', '', 1, 1, 1, 3),
(858, 3, 10, 67, 0, 's294z323a4', '', '', 0, '2012-04-20', '2012-06-07', '', 1, 3, 1, 3),
(859, 3, 11, 63, 0, 'p2a4', '', '', 0, '2012-04-21', '0000-00-00', '', 2, 1, 1, 2),
(860, 3, 9, 56, 0, 'p2a4z313a4', '', '', 0, '2012-04-21', '2012-05-25', '', 1, 2, 1, 3),
(861, 3, 9, 57, 0, 'q274z32344', '', '', 0, '2012-04-21', '2012-05-25', '', 1, 2, 1, 3),
(862, 3, 9, 57, 0, 'r234a453', '', '', 0, '2012-04-21', '2012-06-07', '', 1, 3, 1, 3),
(863, 3, 12, 70, 0, 'q254z33384', '', '', 0, '2012-04-22', '2012-05-25', '', 1, 2, 1, 3),
(864, 3, 3, 20, 0, 'p264z3y274', '', '', 0, '2012-04-22', '2012-05-25', '', 1, 2, 1, 3),
(865, 3, 2, 5, 0, 't2d4', '', '', 0, '2012-04-23', '2012-04-23', '', 1, 2, 1, 3),
(866, 3, 2, 5, 0, 'l2a494', '', '', 0, '2012-04-23', '2012-04-23', '', 1, 2, 1, 3),
(867, 3, 2, 5, 0, 'r2e4', '', '', 0, '2012-04-23', '2012-05-25', '', 1, 2, 1, 3),
(869, 3, 4, 28, 0, 's294a4u22463', '', '', 0, '2012-05-01', '2012-05-01', '', 1, 1, 1, 3),
(868, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-04-24', '2012-04-24', '', 1, 1, 1, 1),
(870, 3, 7, 1, 0, 'p2346443', '', '', 0, '2012-04-25', '2012-04-25', '', 1, 1, 1, 1),
(871, 3, 3, 20, 0, 'q274z313b4', '', '', 0, '2012-04-25', '2012-05-25', '', 1, 4, 1, 3),
(872, 3, 7, 2, 0, 'p26414', '', '', 0, '2012-04-25', '0000-00-00', '', 1, 1, 1, 1),
(873, 3, 9, 58, 0, 't2', '', '', 0, '2012-04-25', '0000-00-00', '', 1, 1, 1, 1),
(874, 3, 7, 3, 0, 'p254', '', '', 0, '2012-04-25', '0000-00-00', '', 2, 1, 1, 2),
(875, 3, 10, 67, 0, 'q2b4', '', '', 0, '2012-04-25', '0000-00-00', '', 2, 1, 1, 2),
(876, 3, 7, 1, 0, 't2342403', '', '', 0, '2012-04-26', '2012-06-07', '', 1, 3, 1, 3),
(877, 3, 8, 49, 0, 'u2348433', '', '', 0, '2012-04-26', '2012-06-07', '', 1, 3, 1, 3),
(878, 3, 4, 25, 0, 'w264z30334', '', '', 0, '2012-05-07', '2012-05-07', '', 1, 1, 1, 3),
(879, 3, 7, 2, 0, 'p2b4z35354', '', '', 0, '2012-04-27', '2012-05-25', '', 1, 4, 1, 3),
(880, 3, 4, 26, 0, 's284', '', '', 0, '2012-05-10', '2012-05-10', '', 1, 1, 1, 3),
(881, 3, 4, 24, 0, 'u254z3x244', '', '', 0, '2012-04-27', '0000-00-00', '', 1, 1, 1, 3),
(882, 3, 1, 79, 8, 'q25414', '', '', 0, '2012-04-28', '0000-00-00', '', 1, 1, 1, 3),
(883, 3, 1, 75, 0, 'u27424u2a403', '', '', 0, '2012-04-28', '0000-00-00', '', 2, 1, 1, 3),
(884, 3, 7, 2, 0, 's234a423', '', '', 0, '2012-04-28', '2012-05-25', '', 1, 2, 1, 3),
(885, 3, 3, 17, 0, 'p28494u2b443', '', '', 0, '2012-04-28', '2012-05-25', '', 1, 2, 1, 3),
(886, 3, 3, 17, 0, 'p254z3x264', '', '', 0, '2012-04-28', '2012-05-25', '', 1, 2, 1, 3),
(887, 3, 10, 67, 0, 'p28474u274z2', '', '', 0, '2012-04-28', '2012-06-07', '', 1, 3, 1, 3),
(888, 3, 11, 60, 0, 'p294', '', '', 0, '2012-04-28', '0000-00-00', '', 1, 1, 1, 1),
(889, 3, 3, 17, 0, 'l26424w2044354', '', '', 0, '2012-04-29', '2012-05-25', '', 1, 2, 1, 3),
(890, 3, 3, 17, 0, 's23464', '', '', 0, '2012-04-29', '2012-05-25', '', 1, 2, 1, 3),
(891, 3, 6, 43, 0, 'u2a4', '', '', 0, '2012-04-29', '0000-00-00', '', 1, 1, 1, 1),
(892, 3, 8, 49, 0, 'w2', '', '', 0, '2012-04-29', '0000-00-00', '', 1, 1, 1, 1),
(893, 3, 2, 5, 0, 't294', '', '', 0, '2012-04-30', '2012-04-30', '', 1, 3, 1, 3),
(894, 3, 7, 2, 0, 'q274z313b4', '', '', 0, '2012-04-30', '2012-06-07', '', 1, 3, 1, 3),
(926, 3, 8, 49, 0, 'r2c4z313', '', '', 0, '2012-05-01', '0000-00-00', '', 1, 1, 1, 1),
(896, 3, 1, 77, 0, 'l26434w2', '', '', 0, '2012-05-01', '0000-00-00', '', 1, 1, 1, 3),
(897, 3, 1, 77, 0, 'p27414', '', '', 0, '2012-05-01', '0000-00-00', '', 1, 1, 1, 7),
(898, 3, 1, 77, 0, 'l2a414', '', '', 0, '2012-05-01', '0000-00-00', '', 1, 1, 1, 3),
(899, 3, 1, 77, 0, 't254', '', '', 0, '2012-05-01', '0000-00-00', '', 1, 1, 1, 9),
(900, 3, 3, 21, 0, 'q2c414u2a463', '', '', 0, '2012-05-01', '0000-00-00', '', 1, 1, 1, 3),
(901, 3, 7, 1, 0, 't2341433', '', '', 0, '2012-05-01', '2012-06-07', '', 1, 3, 1, 3),
(943, 3, 10, 67, 0, 'p2b4z3z264', '', '', 0, '2012-05-12', '2012-06-07', '', 1, 3, 1, 3),
(942, 3, 11, 63, 0, 't254', '', '', 0, '2012-05-12', '0000-00-00', '', 1, 1, 1, 3),
(941, 3, 1, 77, 0, 'q2a414', '', '', 0, '2012-05-12', '0000-00-00', '', 1, 1, 1, 1),
(940, 3, 1, 77, 0, 'l27464w2', '', '', 0, '2012-05-12', '0000-00-00', '', 1, 1, 1, 3),
(939, 3, 1, 75, 0, 't2e474u23443', '', '', 0, '2012-05-12', '0000-00-00', '', 2, 1, 1, 3),
(938, 3, 1, 79, 0, 'q2a414', '', '', 0, '2012-05-12', '0000-00-00', '', 1, 1, 1, 3),
(937, 3, 3, 15, 0, 'w25414', '', '', 0, '2012-05-12', '0000-00-00', '', 1, 1, 1, 3),
(936, 3, 10, 67, 0, 'q294z3w234', '', '', 0, '2012-05-12', '2012-05-12', '', 1, 3, 1, 3),
(935, 3, 10, 67, 0, 'p29414', '', '', 0, '2012-05-09', '0000-00-00', '', 2, 1, 1, 2),
(934, 3, 7, 1, 0, 'r234a433', '', '', 0, '2012-05-09', '2012-05-09', '', 1, 1, 1, 1),
(933, 3, 10, 67, 0, 'q2343413', '', '', 0, '2012-05-08', '2012-05-08', '', 1, 1, 1, 1),
(932, 3, 7, 1, 0, 's2341413', '', '', 0, '2012-05-08', '2012-05-08', '', 1, 1, 1, 1),
(931, 3, 2, 5, 0, 't264', '', '', 0, '2012-05-07', '2012-05-07', '', 1, 3, 1, 3),
(930, 3, 10, 67, 0, 'q264', '', '', 0, '2012-05-06', '0000-00-00', '', 1, 1, 1, 2),
(929, 3, 3, 17, 0, 'p26464', '', '', 0, '2012-05-06', '0000-00-00', '', 1, 1, 1, 2),
(928, 3, 7, 1, 0, 't2341433', '', '', 0, '2012-05-03', '2012-06-07', '', 1, 3, 1, 3),
(927, 3, 7, 1, 0, 't2341433', '', '', 0, '2012-05-02', '2012-06-07', '', 1, 3, 1, 3),
(944, 3, 10, 67, 0, 'p264z3z234', '', '', 0, '2012-05-12', '2012-06-07', '', 1, 3, 1, 3),
(945, 3, 11, 63, 0, 't254', '', '', 0, '2012-05-13', '0000-00-00', '', 1, 1, 1, 1),
(946, 3, 7, 2, 0, 'u2d4', '', '', 0, '2012-05-13', '0000-00-00', '', 1, 1, 1, 1),
(947, 3, 8, 49, 0, 't2347403', '', '', 0, '2012-05-13', '0000-00-00', '', 1, 1, 1, 1),
(948, 3, 1, 74, 0, 'p2a474230443', '', '', 0, '2012-05-15', '0000-00-00', '', 1, 1, 1, 3),
(949, 3, 7, 1, 0, 's234a413', '', '', 0, '2012-05-15', '2012-05-15', '', 1, 1, 1, 1),
(950, 3, 3, 18, 0, 'v284', '', '', 0, '2012-05-16', '0000-00-00', '', 1, 1, 1, 3),
(951, 3, 2, 10, 0, 'q29464', '', '', 0, '2012-05-16', '0000-00-00', '', 1, 1, 1, 3),
(952, 3, 10, 67, 0, 'r254', '', '', 0, '2012-05-16', '0000-00-00', '', 2, 1, 1, 2),
(953, 3, 2, 5, 0, 't2d4z3w254', '', '', 0, '2012-05-16', '2012-05-16', '', 1, 3, 1, 3),
(954, 3, 7, 2, 0, 't254z3x2a4', '', '', 0, '2012-05-16', '2012-06-07', '', 1, 3, 1, 3),
(955, 3, 1, 81, 0, 'p2e414u25443', '', '', 0, '2012-05-18', '0000-00-00', '', 1, 1, 1, 3),
(956, 3, 4, 23, 0, 'r254z343', '', '', 0, '2012-05-25', '2012-05-25', '', 1, 1, 1, 3),
(957, 3, 4, 29, 0, 'r254', '', '', 0, '2012-05-25', '2012-05-25', '', 1, 1, 1, 3),
(958, 3, 1, 76, 0, 'u2a414', '', '', 0, '2012-05-19', '0000-00-00', '', 1, 1, 1, 3),
(959, 3, 3, 17, 0, 'q25434u25463', '', '', 0, '2012-05-19', '0000-00-00', '', 1, 3, 0, 3),
(960, 3, 9, 56, 0, 's254', '', '', 0, '2012-05-20', '0000-00-00', '', 2, 1, 1, 2),
(961, 3, 7, 4, 0, 'p254', '', '', 0, '2012-05-20', '0000-00-00', '', 1, 1, 1, 1),
(962, 3, 8, 47, 0, 'r264z303b4', '', '', 0, '2012-05-20', '2012-06-07', '', 1, 3, 1, 3),
(963, 3, 7, 2, 0, 'p2d4z3w294', '', '', 0, '2012-05-20', '2012-06-07', '', 1, 3, 1, 3),
(964, 3, 10, 67, 0, 'q2e4z32384', '', '', 0, '2012-05-20', '2012-06-07', '', 1, 3, 1, 3),
(965, 3, 1, 77, 0, 'l2b414', '', '', 0, '2012-05-21', '0000-00-00', '', 1, 1, 1, 1),
(966, 3, 1, 77, 0, 'u254', '', '', 0, '2012-05-21', '0000-00-00', '', 1, 1, 1, 2),
(967, 3, 2, 11, 0, 't254', '', '', 0, '2012-05-21', '0000-00-00', '', 2, 1, 1, 2),
(968, 3, 10, 67, 0, 'q29414', '', '', 0, '2012-05-21', '0000-00-00', '', 2, 1, 1, 2),
(969, 3, 7, 1, 0, 'u2348413', '', '', 0, '2012-05-23', '2012-05-23', '', 1, 1, 1, 1),
(970, 3, 2, 5, 0, 't2d4', '', '', 0, '2012-05-23', '2012-05-23', '', 1, 3, 1, 3),
(971, 3, 7, 1, 0, 't2341433', '', '', 0, '2012-05-24', '0000-00-00', '', 1, 3, 0, 3),
(972, 3, 7, 2, 0, 'p2d4z3x2', '', '', 0, '2012-05-24', '0000-00-00', '', 1, 3, 1, 1),
(973, 3, 4, 25, 0, 'w264z30334', '', '', 0, '2012-05-26', '2012-05-26', '', 1, 1, 1, 3),
(974, 3, 1, 75, 0, 'u27424u2a403', '', '', 0, '2012-05-27', '0000-00-00', '', 2, 1, 1, 3),
(975, 3, 1, 77, 0, 'l27414w2', '', '', 0, '2012-05-27', '0000-00-00', '', 2, 1, 1, 3),
(976, 3, 1, 77, 0, 'q25414', '', '', 0, '2012-05-27', '0000-00-00', '', 2, 1, 1, 2),
(977, 3, 3, 17, 0, 'w254z33394', '', '', 0, '2012-05-27', '0000-00-00', '', 1, 3, 0, 3),
(978, 3, 6, 39, 0, 'p254', '', '', 0, '2012-05-28', '0000-00-00', '', 1, 1, 1, 1),
(979, 3, 3, 17, 0, 'q23484x2', '', '', 0, '2012-05-28', '0000-00-00', '', 1, 1, 1, 1),
(980, 3, 7, 1, 0, 'r2342453', '', '', 0, '2012-05-29', '0000-00-00', '', 1, 3, 0, 3),
(981, 3, 4, 26, 0, 's284', '', '', 0, '2012-06-08', '2012-06-08', '', 1, 1, 1, 3),
(982, 3, 10, 67, 0, 's2342453', '', '', 0, '2012-05-30', '0000-00-00', '', 1, 4, 0, 3),
(983, 3, 2, 5, 0, 't2d4', '', '', 0, '2012-05-30', '2012-05-30', '', 1, 3, 1, 3),
(984, 3, 8, 49, 0, 'q2a4', '', '', 0, '2012-05-30', '0000-00-00', '', 1, 1, 1, 1),
(985, 3, 7, 1, 0, 't23464', '', '', 0, '2012-05-31', '2012-05-31', '', 1, 1, 1, 1),
(986, 3, 1, 79, 0, 'p2c464', '', '', 0, '2012-05-31', '0000-00-00', '', 1, 1, 1, 3),
(987, 3, 1, 77, 0, 'l26434w2', '', '', 0, '2012-06-01', '0000-00-00', '', 1, 1, 1, 3),
(988, 3, 1, 77, 0, 'p27414', '', '', 0, '2012-06-01', '0000-00-00', '', 1, 1, 1, 7),
(989, 3, 1, 77, 0, 'l2a414', '', '', 0, '2012-06-01', '0000-00-00', '', 1, 1, 1, 3),
(990, 3, 1, 77, 0, 't254', '', '', 0, '2012-06-01', '0000-00-00', '', 1, 1, 1, 9),
(991, 3, 3, 21, 0, 'q2c414u2a463', '', '', 0, '2012-06-01', '0000-00-00', '', 1, 1, 1, 3),
(992, 3, 1, 76, 0, 'u2a414', '', '', 0, '2012-06-01', '0000-00-00', '', 1, 1, 1, 3),
(993, 3, 1, 76, 0, 'u2a414', '', '', 0, '2012-06-02', '0000-00-00', '', 1, 1, 1, 3),
(994, 3, 7, 2, 0, 'p284z31384', '', '', 0, '2012-06-02', '0000-00-00', '', 1, 3, 1, 1),
(995, 3, 8, 84, 0, 't2', '', '', 0, '2012-06-02', '0000-00-00', '', 1, 1, 1, 1),
(996, 3, 4, 24, 0, 't2e4z32364', '', '', 0, '2012-06-02', '2012-06-02', '', 1, 1, 1, 3),
(997, 3, 2, 7, 0, 'q234a4x2', '', '', 0, '2012-06-03', '0000-00-00', '', 1, 3, 0, 3),
(998, 3, 2, 7, 0, 'p2d4z3w274', '', '', 0, '2012-06-03', '0000-00-00', '', 1, 3, 0, 3),
(999, 3, 9, 57, 0, 'q274z323', '', '', 0, '2012-06-03', '0000-00-00', '', 1, 1, 1, 1),
(1000, 3, 8, 49, 0, 'v234a4z2', '', '', 0, '2012-06-03', '0000-00-00', '', 1, 3, 0, 3),
(1001, 3, 7, 3, 0, 't234a4', '', '', 0, '2012-06-03', '0000-00-00', '', 1, 3, 0, 3),
(1002, 3, 7, 3, 0, 'q2349453', '', '', 0, '2012-06-04', '0000-00-00', '', 1, 3, 0, 3),
(1003, 3, 10, 67, 0, 'u284z3w2a4', '', '', 0, '2012-06-04', '0000-00-00', '', 1, 4, 0, 3),
(1004, 3, 7, 2, 0, 'v234a4', '', '', 0, '2012-06-05', '0000-00-00', '', 1, 3, 0, 3),
(1005, 3, 7, 2, 0, 'v234a4', '', '', 0, '2012-06-05', '0000-00-00', '', 1, 3, 0, 3),
(1006, 3, 7, 1, 0, 's234a413', '', '', 0, '2012-06-05', '0000-00-00', '', 1, 1, 1, 1),
(1007, 3, 7, 1, 0, 's234a413', '', '', 0, '2012-06-06', '0000-00-00', '', 1, 1, 1, 1),
(1008, 3, 3, 20, 0, 'q2343423', '', '', 0, '2012-06-06', '0000-00-00', '', 1, 3, 0, 3),
(1009, 3, 2, 5, 0, 't2d4', '', '', 0, '2012-06-06', '2012-06-06', '', 1, 3, 1, 3),
(1010, 3, 1, 77, 0, 'l28414w2', '', '', 0, '2012-06-07', '0000-00-00', '', 1, 1, 1, 3),
(1011, 3, 1, 77, 0, 'r25414', '', '', 0, '2012-06-07', '0000-00-00', '', 1, 1, 1, 1),
(1012, 3, 11, 63, 0, 'r25414', '', '', 0, '2012-06-07', '0000-00-00', '', 1, 1, 1, 1),
(1013, 3, 7, 2, 0, 'p2a4z333a4', '', '', 0, '2012-06-07', '0000-00-00', '', 1, 3, 0, 3),
(1014, 3, 11, 63, 0, 'r2344453', '', '', 0, '2012-06-07', '0000-00-00', '', 1, 1, 1, 1),
(1015, 3, 1, 75, 0, 'u2d424u29433', '', '', 0, '2012-06-09', '0000-00-00', '', 2, 1, 1, 3),
(1016, 3, 1, 77, 0, 'l27414w2', '', '', 0, '2012-06-09', '0000-00-00', '', 1, 1, 1, 3),
(1017, 3, 1, 77, 0, 'q25414', '', '', 0, '2012-06-09', '0000-00-00', '', 1, 1, 1, 1),
(1018, 3, 7, 2, 0, 'q274z33374', '', '', 0, '2012-06-09', '0000-00-00', '', 1, 1, 1, 1),
(1019, 3, 10, 67, 0, 'q25414', '', '', 0, '2012-06-09', '0000-00-00', '', 2, 1, 1, 2),
(1020, 3, 3, 15, 0, 'w25414', '', '', 0, '2012-06-10', '0000-00-00', '', 1, 1, 1, 3),
(1021, 3, 11, 60, 0, 'v254', '', '', 0, '2012-06-10', '0000-00-00', '', 1, 1, 1, 1),
(1022, 3, 11, 63, 0, 'r254', '', '', 0, '2012-06-10', '0000-00-00', '', 1, 1, 1, 1),
(1023, 3, 12, 70, 0, 'r25484u274z2', '', '', 0, '2012-06-10', '0000-00-00', '', 1, 3, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `spending_category`
--

CREATE TABLE IF NOT EXISTS `spending_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `category` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `spending_category`
--

INSERT INTO `spending_category` (`id`, `user_id`, `category`) VALUES
(1, 0, 'Income'),
(2, 0, 'Transportation'),
(3, 0, 'Home'),
(4, 0, 'Utilities'),
(5, 0, 'Health'),
(6, 0, 'Entertainment'),
(7, 0, 'Dining'),
(8, 0, 'Kids'),
(9, 0, 'Shopping'),
(10, 0, 'Groceries'),
(11, 0, 'Miscellaneous'),
(12, 0, 'None Expenses');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE IF NOT EXISTS `sports` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `with` varchar(30) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sport_athletes`
--

CREATE TABLE IF NOT EXISTS `sport_athletes` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `with` varchar(30) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sport_teams`
--

CREATE TABLE IF NOT EXISTS `sport_teams` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `with` varchar(30) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sp_bank`
--

CREATE TABLE IF NOT EXISTS `sp_bank` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `spender_id` tinyint(1) NOT NULL DEFAULT '0',
  `bank` varchar(30) NOT NULL,
  `balance` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pay_now` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `sp_bank`
--

INSERT INTO `sp_bank` (`id`, `user_id`, `spender_id`, `bank`, `balance`, `date`, `pay_now`) VALUES
(1, 3, 1, 'Cash On Hand(Me)', 'r26424u254z2', '2012-06-10 23:58:05', 1),
(2, 3, 2, 'Cash On Hand(Elaine)', 'u294z32344', '2012-06-09 17:55:25', 1),
(3, 3, 0, 'Royal Bank', 'x2e43453045334', '2012-06-10 21:33:15', 0),
(5, 3, 0, 'Carly Saving', 'v2843413044334', '2012-04-16 02:13:45', 0),
(6, 3, 0, 'Jessica Saving', 'v2b4142304x234', '2012-04-16 02:11:42', 0),
(7, 3, 0, 'RRSP Royal', 'q294242354v2a4s2', '2012-06-01 16:26:21', 0),
(8, 3, 0, 'Royal Bank(Elaine)', 'o2', '2012-04-06 13:06:18', 0),
(9, 3, 0, 'RRSP Royal(Elaine)', 'x27434w2045334', '2012-06-01 16:26:21', 0),
(10, 3, 1, 'Scotia Bank', 'o2', '2012-04-14 17:17:19', 0),
(11, 3, 1, 'C.S.T. Carly', 'q26424w2b4v214z2', '2012-02-25 19:21:56', 0),
(12, 3, 1, 'C.S.T. Jessica', 'p2b414y234v264r2', '2012-02-25 19:22:35', 0),
(13, 4, 3, 'Cash On Hand(Me)', '', '2012-04-04 21:44:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sp_bank_detail`
--

CREATE TABLE IF NOT EXISTS `sp_bank_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `bank_id` tinyint(4) NOT NULL,
  `adjust_amount` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=460 ;

--
-- Dumping data for table `sp_bank_detail`
--

INSERT INTO `sp_bank_detail` (`id`, `user_id`, `bank_id`, `adjust_amount`, `balance`, `date`, `description`) VALUES
(1, 3, 1, 'l2b454w2', 'v2b414', '2011-12-03 13:48:08', 'Income=>Transfer'),
(2, 3, 2, 'u29414', 'p27494w2', '2011-12-03 13:48:08', 'Income=>Transfer'),
(3, 3, 2, 'l26424', 'u274a4', '2011-12-03 13:50:00', 'Groceries=>food'),
(4, 3, 1, 'l264z3z2', 'p2e494u294', '2011-12-03 15:55:22', 'Dining=>Drink'),
(5, 3, 1, 'l26434', 'p2d474u294', '2011-12-04 16:32:36', 'Kids=>School expenses'),
(6, 3, 1, 'l2a464u2a433', 'p28414u2a413', '2011-12-04 17:29:05', 'Groceries=>food'),
(7, 3, 1, 'l264z303', 'p274a4u26413', '2011-12-04 18:00:25', 'Dining=>Drink'),
(8, 3, 3, 'l26484w2', 'l26484w2', '2011-12-05 00:27:23', 'Miscellaneous=>RRSP'),
(9, 3, 1, 'l2a4z313', 'p27444u2b413', '2011-12-06 18:22:35', 'Dining=>Lunch at work'),
(10, 3, 2, 'l26454', 'u26464', '2011-12-07 00:45:19', 'Miscellaneous=>Party & Gifts'),
(11, 3, 1, 'l264z313a4', 'p27434u25433', '2011-12-07 18:10:02', 'Dining=>Lunch at work'),
(12, 3, 1, 'l28434', 'x254z3z284', '2011-12-09 21:07:20', 'Miscellaneous=>Hair Cut'),
(13, 3, 1, 'l26484', 'v284z3z284', '2011-12-09 21:09:28', 'Shopping=>Sockes'),
(14, 3, 3, 'w25414', 'u29494y2040324', '2011-12-10 14:17:40', 'Home=>Mortgage'),
(15, 3, 3, 'v29454u25453', 'v27434230433a4', '2011-12-10 14:17:40', 'Income=>Wage'),
(16, 3, 1, 'l2c494u29433', 'l2a4z303', '2011-12-10 15:49:38', 'Groceries=>food'),
(17, 3, 2, 'l26464', 'u25414', '2011-12-10 16:12:15', 'Groceries=>food'),
(18, 3, 2, 'l27464', 't2c464', '2011-12-10 16:12:57', 'Miscellaneous=>Party & Gifts'),
(19, 3, 2, 'l2a414', 't27464', '2011-12-10 16:49:34', 'Income=>Transfer'),
(20, 3, 1, 't254', 's294z323', '2011-12-10 16:49:34', 'Income=>Transfer'),
(21, 3, 1, 'l284', 's264z323', '2011-12-11 20:07:35', 'Groceries=>food'),
(22, 3, 2, 'l26454u264', 't26414u284', '2011-12-11 20:30:31', 'Groceries=>food'),
(23, 3, 1, 'l264z313a4', 's284z3w244', '2011-12-13 18:11:58', 'Dining=>Lunch at work'),
(24, 3, 1, 'l254z31394', 's294z3w254', '2011-12-13 23:45:02', 'Miscellaneous=>Other'),
(25, 3, 3, 'p2944443046384', 'x274841304x224', '2011-12-15 17:58:46', 'Income=>Salary'),
(26, 3, 1, 'l294z313', 's254z3x2', '2011-12-15 17:58:46', 'Dining=>Lunch at work'),
(27, 3, 3, 'v274z353', 'x27414y204y224', '2011-12-16 23:19:17', 'Home=>Insurance'),
(28, 3, 3, 'q25444u254z2', 'w2e4a4430443a4', '2011-12-16 23:19:17', 'Transportation=>Insurance '),
(29, 3, 2, 'l26414', 't26464', '2011-12-17 17:01:37', 'Dining=>Snack'),
(30, 3, 2, 'l26414', 't26464', '2011-12-17 17:02:47', 'Shopping=>Other'),
(31, 3, 3, 'p2e414u25443', 'x264945304y274', '2011-12-20 00:00:30', 'Income=>CHILD TAX BENEFIT '),
(32, 3, 1, 'l264z3z2', 's284z3z2', '2011-12-20 00:00:30', 'Dining=>Drink'),
(33, 3, 2, 'l26494', 't25484', '2011-12-20 01:01:40', 'Groceries=>food'),
(34, 3, 1, 'l294z313', 's254z3x2', '2011-12-20 18:07:48', 'Dining=>Lunch at work'),
(35, 3, 1, 'p25414', 'p29454u284', '2011-12-20 18:09:12', 'Income=>Gift'),
(36, 3, 2, 'l27424w2', 'r26464', '2011-12-22 00:48:35', 'Miscellaneous=>Party & Gifts'),
(37, 3, 2, 'l26434', 't26444', '2011-12-22 13:35:40', 'Miscellaneous=>Party & Gifts'),
(38, 3, 1, 'l29414', 'p25454u284', '2011-12-22 13:36:20', 'Dining=>Lunch at work'),
(39, 3, 2, 'l27464', 't25414', '2011-12-22 14:07:23', 'Dining=>Lunch at work'),
(40, 3, 2, 'l27464', 't25414', '2011-12-22 14:07:23', 'Dining=>Lunch at work'),
(41, 3, 2, 'l27424w2', 'r26464', '2011-12-22 15:13:21', 'Miscellaneous=>Party & Gifts'),
(42, 3, 2, 'l27424w2', 'r26464', '2011-12-22 15:13:21', 'Miscellaneous=>Party & Gifts'),
(43, 3, 1, 'l29454', 'p25414u284', '2011-12-22 15:27:32', 'Dining=>Lunch at work'),
(44, 3, 1, 'l29454', 'p25414u284', '2011-12-22 15:27:33', 'Dining=>Lunch at work'),
(45, 3, 1, 'l2a4', 'p284a4u284', '2011-12-22 15:30:40', 'Dining=>Lunch at work'),
(46, 3, 1, 'l2a4', 'p284a4u284', '2011-12-22 15:30:40', 'Dining=>Lunch at work'),
(47, 3, 1, 'l29454', 'p25414u284', '2011-12-22 15:37:10', 'Dining=>Lunch at work'),
(48, 3, 1, 'l29454', 'p25414u284', '2011-12-22 15:37:11', 'Dining=>Lunch at work'),
(49, 3, 2, 'l2a414', 's2c464', '2011-12-22 23:10:19', 'Groceries=>food'),
(50, 3, 2, 'l29414', 's2d464', '2011-12-22 23:11:44', 'Miscellaneous=>Party & Gifts'),
(51, 3, 2, 'l28464', 's2e414', '2011-12-23 20:50:14', 'Dining=>Dining Out'),
(52, 3, 2, 'l284', 's2d484', '2011-12-23 20:51:08', 'Dining=>Dining Out'),
(53, 3, 3, 'l2a414w2', 'w2b4541304y224', '2011-12-23 20:54:21', 'Income=>Transfer'),
(54, 3, 2, 't25414', 'x2d484', '2011-12-23 20:54:21', 'Income=>Transfer'),
(55, 3, 1, 'l294z313', 'p29414u234', '2011-12-23 22:58:07', 'Transportation=>Parking'),
(56, 3, 1, 'l26434w2', 'q254z3x2', '2011-12-24 04:51:11', 'Dining=>Dining Out'),
(57, 3, 2, 'l27414', 't2b484', '2011-12-24 15:02:49', 'Groceries=>food'),
(58, 3, 2, 'l2b414w2', 'l28444', '2011-12-24 15:03:16', 'Miscellaneous=>Party & Gifts'),
(59, 3, 3, 'l28414w2', 'w28424z2046394', '2011-12-24 17:33:13', 'Income=>Transfer'),
(60, 3, 1, 'r25414', 'r27414u234', '2011-12-24 17:33:13', 'Income=>Transfer'),
(61, 3, 1, 'l27414w2', 'p27414u234', '2011-12-25 03:06:26', 'Income=>Transfer'),
(62, 3, 2, 'q25414', 'p2b484', '2011-12-25 03:06:26', 'Income=>Transfer'),
(63, 3, 1, 'l264z3y274', 'p26494u2a423', '2011-12-29 20:50:45', 'Dining=>Drink'),
(64, 3, 1, 'l264z343', 'p26484u22423', '2011-12-29 20:51:23', 'Dining=>Snack'),
(65, 3, 3, 'p2944443046384', 'w28484y2045354', '2011-12-31 16:18:06', 'Income=>Salary'),
(66, 3, 1, 'l26464z2', 'l28464u2b423', '2011-12-31 16:18:06', 'Entertainment=>Entering Ticket'),
(67, 3, 2, 'v25414', 'w2b484', '2011-12-31 17:32:40', 'Income=>Gift'),
(68, 3, 2, 'l2e414', 'v2c484', '2011-12-31 17:33:28', 'Income=>Transfer'),
(69, 3, 1, 'x254', 't294z3w274', '2011-12-31 17:33:28', 'Income=>Transfer'),
(70, 3, 1, 'v25414', 'v2a454u22423', '2012-01-01 05:45:20', 'Income=>Rental'),
(71, 3, 3, 'l26434w2', 'fq_balance', '2012-01-01 05:45:20', 'Income=>Transfer'),
(72, 3, 7, 'p27414', 'p2e4644354v2a4s2', '2012-01-01 05:45:20', 'Income=>Transfer'),
(73, 3, 3, 'l2a414', 'fq_balance', '2012-01-01 05:45:20', 'Income=>Transfer'),
(74, 3, 9, 't254', 'p25464w2', '2012-01-01 05:45:20', 'Income=>Transfer'),
(75, 3, 3, 'l284a4u2a403', 'w26474z204x224', '2012-01-01 05:48:40', 'Utilities=>Phone - Cell'),
(76, 3, 3, 'l2c474u2a4z2', 'w254942304y2a4', '2012-01-01 05:49:27', 'Utilities=>TV'),
(77, 3, 3, 'l2c454', 'w25424y204y2a4', '2012-01-01 05:51:03', 'Utilities=>Gas'),
(78, 3, 3, 'l28494x204x284', 'v2b444x204y234', '2012-01-01 05:54:28', 'Utilities=>Electricity'),
(79, 3, 3, 'l2c454', 'u2e494130413', '2012-01-02 14:36:17', 'Utilities=>Gas'),
(80, 3, 3, 'l2c474u2a4z2', 'u2e494y2042394', '2012-01-02 14:44:34', 'Utilities=>TV'),
(81, 3, 3, 'l28424u27413', 'v2543433045374', '2012-01-02 14:47:40', 'Utilities=>Phone - Home'),
(82, 3, 3, 'l28434u23443', 'u2e4a4130433a4', '2012-01-02 14:48:24', 'Utilities=>Internet'),
(83, 3, 1, 'l294z313', 'v294a4u27423', '2012-01-02 18:40:10', 'Transportation=>Parking'),
(84, 3, 1, 'l274z33344', 'v29474u2a403', '2012-01-02 22:04:02', 'Dining=>Snack'),
(85, 3, 1, 'l264z323', 'v29464u24403', '2012-01-04 18:25:27', 'Dining=>Lunch at work'),
(86, 3, 1, 'l2b4z313', 'v28494u29403', '2012-01-05 18:08:35', 'Dining=>Lunch at work'),
(87, 3, 1, 'l2b4z31374', 'v28434u23453', '2012-01-05 18:31:32', 'Dining=>Lunch at work'),
(88, 3, 2, 'l2d464', 'u2e434', '2012-01-07 13:38:33', 'Groceries=>food'),
(89, 3, 1, 'l274z33374', 'v274a4u26403', '2012-01-07 20:14:22', 'Transportation=>Parking'),
(90, 3, 2, 'l29414', 'u2a434', '2012-01-08 23:25:05', 'Home=>Household Supplies'),
(91, 3, 2, 'l284z343b4', 'u29494u234y2', '2012-01-08 23:25:25', 'Dining=>Snack'),
(92, 3, 1, 'l2a414w2', 'q274a4u26403', '2012-01-08 23:26:18', 'Income=>Transfer'),
(93, 3, 7, 't25414', 'q254144354v2a4s2', '2012-01-08 23:26:18', 'Income=>Transfer'),
(94, 3, 1, 'l29424u24433', 'p2d494u23443', '2012-01-08 23:33:25', 'Groceries=>food'),
(95, 3, 1, 'l27414', 'p2b494u23443', '2012-01-08 23:34:46', 'Dining=>Dining Out'),
(96, 3, 3, 'w25414', 't27484230423a4', '2012-01-10 18:19:57', 'Home=>Mortgage'),
(97, 3, 1, 'l264z313a4', 'p2b474u27463', '2012-01-10 18:19:57', 'Dining=>Lunch at work'),
(98, 3, 3, 'x2d454u27463', 'u27474x204y294', '2012-01-10 18:22:43', 'Income=>Wage'),
(99, 3, 1, 'l294z313', 'p2b434u22463', '2012-01-11 18:00:34', 'Dining=>Lunch at work'),
(100, 3, 2, 'l26414w2', 't29494u234y2', '2012-01-11 18:04:34', 'Income=>Transfer'),
(101, 3, 1, 'p25414', 'q2b434u22463', '2012-01-11 18:04:34', 'Income=>Transfer'),
(102, 3, 1, 'l264z3z2', 'x2d4z333b4', '2012-01-12 19:27:07', 'Dining=>Drink'),
(103, 3, 2, 'l2a4', 't29444u234y2', '2012-01-13 02:46:33', 'Kids=>School expenses'),
(104, 3, 1, 'l26484', 'w264z333b4', '2012-01-13 12:12:22', 'Miscellaneous=>Hair Cut'),
(105, 3, 1, 'l264z3x254', 'w254z32384', '2012-01-14 18:11:59', 'Kids=>School expenses'),
(106, 3, 3, 'p2944443046384', 'v2b444x204y234', '2012-01-15 15:02:23', 'Income=>Salary'),
(107, 3, 2, 'l2b414', 's2d444u234y2', '2012-01-15 15:02:23', 'Income=>Transfer'),
(108, 3, 1, 'u254', 'p29414u28433', '2012-01-15 15:02:23', 'Income=>Transfer'),
(109, 3, 1, 'l26434', 'p27494u28433', '2012-01-15 16:36:55', 'Kids=>Kids reward'),
(110, 3, 10, 'l2843413', 'r27444', '2012-01-15 20:27:20', 'Home=>Property Tax'),
(111, 3, 3, 'v274z353', 'v2a4144304z234', '2012-01-17 00:52:26', 'Home=>Insurance'),
(112, 3, 3, 'q25444u254z2', 'v28414030463', '2012-01-17 00:52:26', 'Transportation=>Insurance '),
(113, 3, 1, 'l27414', 'p25494u28433', '2012-01-17 00:52:26', 'Groceries=>food'),
(114, 3, 2, 'l2d4', 's2c464u234y2', '2012-01-17 00:52:47', 'Groceries=>food'),
(115, 3, 1, 'l29494', 'u254z32384', '2012-01-17 16:27:59', 'Dining=>Dining Out'),
(116, 3, 3, 'l26414z224v264', 'u26464130433a4', '2012-01-18 04:36:13', 'Kids=>C.S.T. Plan Fee'),
(117, 3, 3, 'l284a4u24443', 'u2642423041334', '2012-01-18 04:40:15', 'Utilities=>Phone - Cell'),
(118, 3, 3, 'p2e414u25443', 'u28414230443a4', '2012-01-18 18:08:47', 'Income=>CHILD TAX BENEFIT '),
(119, 3, 1, 'l294z313', 't2b4z3x284', '2012-01-18 18:08:47', 'Dining=>Lunch at work'),
(120, 3, 1, 'l27464u22433', 'r264z3x2', '2012-01-19 00:48:02', 'Groceries=>food'),
(121, 3, 1, 'l264z313a4', 'q2e4z31344', '2012-01-19 18:15:58', 'Dining=>Lunch at work'),
(122, 3, 10, 'x27494u29443', 'p2a48443044384', '2012-01-21 14:28:24', 'Income=>Wage'),
(123, 3, 3, 'l29464w2', 't2d45423044374', '2012-01-21 14:36:33', 'Income=>Transfer'),
(124, 3, 2, 's2a414', 'x27464u234y2', '2012-01-21 14:36:33', 'Income=>Transfer'),
(125, 3, 2, 'l29414', 'w2d464u234y2', '2012-01-22 15:17:48', 'Groceries=>food'),
(126, 3, 3, 'l27414w2', 't29474y2041334', '2012-01-22 17:46:24', 'Income=>Transfer'),
(127, 3, 2, 'q25414', 'p254645304y244', '2012-01-22 17:46:24', 'Income=>Transfer'),
(128, 3, 2, 'l26444w2', 'x274a4u23403', '2012-01-22 17:47:35', 'Groceries=>food'),
(129, 3, 2, 'l29414', 'w2d4a4u23403', '2012-01-22 17:48:12', 'Income=>Transfer'),
(130, 3, 1, 's254', 'u2e4z31344', '2012-01-22 17:48:12', 'Income=>Transfer'),
(131, 3, 1, 'l28464u26413', 'r294z3w2a4', '2012-01-22 18:10:58', 'Groceries=>food'),
(132, 3, 2, 'l26414w2', 'v2d4a4u23403', '2012-01-23 03:20:24', 'Miscellaneous=>Party & Gifts'),
(133, 3, 3, 'l28414', 't29444y2041334', '2012-01-24 04:12:26', 'Utilities=>Phone - Home'),
(134, 3, 3, 'l27474u224z2', 't29414230413', '2012-01-24 04:12:47', 'Utilities=>Internet'),
(135, 3, 2, 'l26414', 'v2c4a4u23403', '2012-01-25 12:52:44', 'Kids=>lunch'),
(136, 3, 2, 'l29414', 'v284a4u23403', '2012-01-25 12:53:26', 'Miscellaneous=>Party & Gifts'),
(137, 3, 2, 'l26414w2', 'u284a4u23403', '2012-01-25 12:54:14', 'Income=>Transfer'),
(138, 3, 1, 'p25414', 'p28454u22453', '2012-01-25 12:54:14', 'Income=>Transfer'),
(139, 3, 2, 'l2643413', 't26454u23403', '2012-01-25 18:06:46', 'Miscellaneous=>Party & Gifts'),
(140, 3, 1, 'l264z313a4', 'p28434u274', '2012-01-25 18:19:31', 'Dining=>Lunch at work'),
(141, 3, 1, 'l28414', 'p25434u274', '2012-01-27 00:01:51', 'Miscellaneous=>Party & Gifts'),
(142, 3, 2, 'l26444u27413', 't25414u27463', '2012-01-27 00:10:48', 'Miscellaneous=>Party & Gifts'),
(143, 3, 1, 'l264a4u22433', 'w284z30364', '2012-01-27 00:40:14', 'Miscellaneous=>Party & Gifts'),
(144, 3, 2, 'l26414w2', 's25414u27463', '2012-01-27 04:24:03', 'Miscellaneous=>Party & Gifts'),
(145, 3, 1, 'l2b414u284', 'q274z34364', '2012-01-28 01:05:41', 'Groceries=>food'),
(146, 3, 1, 'l28424u274z2', 'l2d4z323a4', '2012-01-28 01:17:54', 'Groceries=>food'),
(147, 3, 3, 'l28414w2', 's2c434030403a4', '2012-01-28 01:34:31', 'Income=>Transfer'),
(148, 3, 1, 'r25414', 'q2e424u254z2', '2012-01-28 01:34:31', 'Income=>Transfer'),
(149, 3, 1, 'l2b424', 'q28414u254z2', '2012-01-29 19:41:05', 'Miscellaneous=>Party & Gifts'),
(150, 3, 3, 'p2944443046384', 'u26414z2040374', '2012-01-31 18:15:54', 'Income=>Salary'),
(151, 3, 1, 'l264z313a4', 'q27494u29413', '2012-01-31 18:15:54', 'Dining=>Lunch at work'),
(152, 3, 3, 'q26424w2', 'w27424w204x2a4', '2012-02-01 00:49:05', 'Income=>Salary'),
(153, 3, 5, 'l27424x224', 's2a47413044334', '2012-02-01 00:50:07', 'Income=>Salary'),
(154, 3, 3, 'l27424x224', 'u26414w204x2a4', '2012-02-01 00:51:51', 'Income=>Transfer'),
(155, 3, 5, 'q26424w2', 'u2b48413044334', '2012-02-01 00:51:51', 'Income=>Transfer'),
(156, 3, 3, 'q26414', 'u28424w204x2a4', '2012-02-01 00:52:50', 'Income=>Salary'),
(157, 3, 3, 'l29464u244', 'u27474030453a4', '2012-02-01 02:42:35', 'Miscellaneous=>SAFE DEP BOX FEE'),
(158, 3, 3, 'l28424u224z2', 'u27444z2045384', '2012-02-01 02:45:30', 'Utilities=>Phone - Home'),
(159, 3, 3, 'l27464', 'u2741443045384', '2012-02-01 02:45:40', 'Utilities=>Internet'),
(160, 3, 3, 'l26414w224', 't2741443045384', '2012-02-01 02:48:16', 'Income=>Transfer'),
(161, 3, 2, 'p25414w2', 'p29414w20423a4', '2012-02-01 02:48:16', 'Income=>Transfer'),
(162, 3, 2, 'l2b464w2', 'v2a414u27463', '2012-02-01 02:48:51', 'Miscellaneous=>Party & Gifts'),
(163, 3, 3, 'l2641443041324', 't26414w2041374', '2012-02-01 02:52:27', 'Utilities=>Phone - Cell'),
(164, 3, 1, 'v25414', 'x27494u29413', '2012-02-01 18:22:56', 'Income=>Rental'),
(165, 3, 3, 'l26434w2', 'fq_balance', '2012-02-01 18:22:56', 'Income=>Transfer'),
(166, 3, 7, 'p27414', 'q25434w254v2a4s2', '2012-02-01 18:22:56', 'Income=>Transfer'),
(167, 3, 3, 'l2a414', 'fq_balance', '2012-02-01 18:22:56', 'Income=>Transfer'),
(168, 3, 9, 't254', 'v2d434w2045334', '2012-02-01 18:22:56', 'Income=>Transfer'),
(169, 3, 10, 'q2c414u2a463', 'p2b4842304x224', '2012-02-01 18:22:56', 'Home=>Property Tax'),
(170, 3, 1, 'l264z313a4', 'x27484u23433', '2012-02-01 18:22:56', 'Dining=>Lunch at work'),
(171, 3, 3, 'l2c454', 's2e47403045384', '2012-02-04 04:00:43', 'Utilities=>Gas'),
(172, 3, 3, 'l2c474u2a4z2', 's2e474y204x264', '2012-02-04 04:01:37', 'Utilities=>TV'),
(173, 3, 2, 'l26424', 'v284a4u27463', '2012-02-04 16:22:31', 'Miscellaneous=>Hair Cut'),
(174, 3, 1, 'l26444w2', 'v2e484u23433', '2012-02-04 19:25:43', 'Miscellaneous=>Party & Gifts'),
(175, 3, 1, 'l294z33374', 'v2e434u264y2', '2012-02-05 21:32:35', 'Groceries=>food'),
(176, 3, 1, 'l26414', 'v2d434u264y2', '2012-02-07 03:55:33', 'Groceries=>food'),
(177, 3, 1, 'l284z3x264', 'v2c4a4u24443', '2012-02-07 18:03:33', 'Dining=>Lunch at work'),
(178, 3, 1, 'l294z313', 'v2c454u29443', '2012-02-08 17:53:18', 'Dining=>Lunch at work'),
(179, 3, 1, 'l274z33344', 'v2c434u22423', '2012-02-09 18:16:15', 'Dining=>Lunch at work'),
(180, 3, 1, 'l2b464w2', 'p27434u22423', '2012-02-09 18:33:30', 'Income=>Transfer'),
(181, 3, 3, 'u2a414', 't29444z2041364', '2012-02-09 18:33:30', 'Income=>Transfer'),
(182, 3, 3, 'w25414', 's2b444z2041364', '2012-02-10 23:33:44', 'Home=>Mortgage'),
(183, 3, 2, 'l29464w2', 'q2d4a4u27463', '2012-02-12 19:55:30', 'Income=>Transfer'),
(184, 3, 3, 's2a414', 's2d474y204z2', '2012-02-12 19:55:30', 'Income=>Transfer'),
(185, 3, 1, 'l26454', 'p25494u22423', '2012-02-13 04:32:04', 'Miscellaneous=>Hair Cut'),
(186, 3, 2, 'l2a464', 'q28454u27463', '2012-02-14 00:21:17', 'Groceries=>food'),
(187, 3, 1, 'l26414', 'x2d4z3w274', '2012-02-15 01:49:33', 'Kids=>lunch'),
(188, 3, 3, 'p2a474230443', 'u274a4w204z264', '2012-02-15 18:34:08', 'Income=>Salary'),
(189, 3, 1, 'l2b4z3y274', 'x264z343', '2012-02-15 18:34:08', 'Dining=>Lunch at work'),
(190, 3, 3, 'v274z353', 's2c474x204y224', '2012-02-16 18:16:48', 'Home=>Insurance'),
(191, 3, 3, 'q25444u254z2', 's2a464330443a4', '2012-02-16 18:16:48', 'Transportation=>Insurance '),
(192, 3, 1, 'l264z313a4', 'x254z3y244', '2012-02-16 18:16:48', 'Dining=>Lunch at work'),
(193, 3, 3, 'p2e414u25443', 's2c424y2044334', '2012-02-18 15:38:04', 'Income=>CHILD TAX BENEFIT '),
(194, 3, 2, 'l26464', 'q264a4u27463', '2012-02-22 12:37:38', 'Groceries=>food'),
(195, 3, 2, 'l26464', 'q25454u27463', '2012-02-23 00:16:46', 'Groceries=>food'),
(196, 3, 1, 'l264z313a4', 'w2d4z32364', '2012-02-23 20:56:44', 'Dining=>Lunch at work'),
(197, 3, 2, 'l26454', 'p2e414u27463', '2012-02-23 20:57:27', 'Kids=>School expenses'),
(198, 3, 3, 'w26484u27453', 't294542304z294', '2012-02-24 00:47:22', 'Income=>Wage'),
(199, 3, 3, 'l28414w224', 'q294542304z294', '2012-02-24 00:48:19', 'Income=>Transfer'),
(200, 3, 7, 'r25414w2', 'q28434w254v2a4s2', '2012-02-24 00:48:19', 'Income=>Transfer'),
(201, 3, 3, 'l26414w224', 'p294542304z294', '2012-02-24 00:49:08', 'Income=>Transfer'),
(202, 3, 9, 'p25414w2', 'w2d434w2045334', '2012-02-24 00:49:08', 'Income=>Transfer'),
(203, 3, 1, 'l274', 'w2b4z32364', '2012-02-24 13:09:00', 'Kids=>School expenses'),
(204, 3, 3, 'l27414w2', 'p274445304x2a4', '2012-02-25 15:02:04', 'Income=>Transfer'),
(205, 3, 2, 'q25414', 'r2e414u27463', '2012-02-25 15:02:04', 'Income=>Transfer'),
(206, 3, 3, 'l26494w2', 'r2943433045334', '2012-02-25 15:09:29', 'Health=>Dental'),
(207, 3, 1, 'l26464u22443', 'q29454w20403', '2012-02-25 16:43:18', 'Groceries=>food'),
(208, 3, 1, 'l2b4z34374', 'q29444z2041364', '2012-02-25 16:43:44', 'Groceries=>food'),
(209, 3, 2, 'l27414w2', 'p2e414u27463', '2012-02-25 16:44:29', 'Groceries=>food'),
(210, 3, 2, 'l264a4w2', 'o2346453', '2012-02-25 16:45:12', 'Miscellaneous=>Party & Gifts'),
(211, 3, 3, 'l27494', 'r284a453045334', '2012-02-25 19:10:00', 'Utilities=>Phone - Home'),
(212, 3, 3, 'l27484u2a4', 'r28484y204x234', '2012-02-25 19:10:46', 'Utilities=>Internet'),
(213, 3, 3, 'l29444w204x2a4', 'q2e454x2046344', '2012-02-25 19:14:11', 'Utilities=>Electricity'),
(214, 3, 1, 'l26414w2', 'q28444z2041364', '2012-02-26 22:21:47', 'Income=>Transfer'),
(215, 3, 2, 'p25414', 'p25414u27463', '2012-02-26 22:21:47', 'Income=>Transfer'),
(216, 3, 1, 'l284z35394', 'p254a4u26453', '2012-02-28 17:58:01', 'Dining=>Lunch at work'),
(217, 3, 3, 'l2c434u254z2', 'q2a484230403', '2012-02-29 00:55:07', 'Utilities=>Phone - Cell'),
(218, 3, 2, 'l27484', 'v284z313b4', '2012-02-29 00:58:19', 'Groceries=>food'),
(219, 3, 1, 'l2a4z313', 'p25444u2b453', '2012-02-29 18:10:10', 'Dining=>Lunch at work'),
(220, 3, 1, 'v25414', 'w25444u2b453', '2012-03-01 12:11:53', 'Income=>Rental'),
(221, 3, 3, 'l26434w2', 'fq_balance', '2012-03-01 12:11:53', 'Income=>Transfer'),
(222, 3, 7, 'p27414', 'q28444y254v2a4s2', '2012-03-01 12:11:53', 'Income=>Transfer'),
(223, 3, 3, 'l2a414', 'fq_balance', '2012-03-01 12:11:53', 'Income=>Transfer'),
(224, 3, 9, 't254', 'w2d484w2045334', '2012-03-01 12:11:53', 'Income=>Transfer'),
(225, 3, 10, 'q2c414u2a463', 'p294141304y234', '2012-03-01 12:11:53', 'Home=>Property Tax'),
(226, 3, 1, 'l2a4z313', 'v2e494u26453', '2012-03-01 18:05:00', 'Dining=>Lunch at work'),
(227, 3, 3, 'p2a474230443', 'r2e49443044364', '2012-03-02 18:06:01', 'Income=>Salary'),
(228, 3, 1, 'l27434', 'v2c474u26453', '2012-03-03 00:15:55', 'Dining=>Lunch at work'),
(229, 3, 2, 'l2b454u26453', 'x23424x2', '2012-03-03 00:20:03', 'Groceries=>food'),
(230, 3, 1, 'l2a414w2', 'q2c474u26453', '2012-03-03 15:27:48', 'Income=>Transfer'),
(231, 3, 2, 't25414', 't254a4u234y2', '2012-03-03 15:27:48', 'Income=>Transfer'),
(232, 3, 3, 'v2e424u29433', 's2b494z204z234', '2012-03-03 15:57:12', 'Income=>Wage'),
(233, 3, 1, 'l26474u23453', 'q2b414u254', '2012-03-03 16:25:16', 'Groceries=>food'),
(234, 3, 3, 'l29444', 's2b43413040384', '2012-03-03 16:27:45', 'Utilities=>Gas'),
(235, 3, 3, 'l2c474u2a4z2', 's2a4a4x2042364', '2012-03-03 16:29:53', 'Utilities=>TV'),
(236, 3, 2, 'r264', 't29414u234y2', '2012-03-06 14:04:39', 'Groceries=>food'),
(237, 3, 1, 'l264z323', 'q2a494u294', '2012-03-06 18:33:07', 'Dining=>Lunch at work'),
(238, 3, 1, 'l284z35384', 'q2a454u29413', '2012-03-07 00:22:03', 'Kids=>School expenses'),
(239, 3, 1, 'l2a4z313', 'q294a4u24413', '2012-03-07 18:08:23', 'Dining=>Lunch at work'),
(240, 3, 1, 'l294z3w274', 'q29464u23463', '2012-03-08 18:26:17', 'Dining=>Lunch at work'),
(241, 3, 1, 'l274a4u294y2', 'q26464u26453', '2012-03-10 00:20:15', 'Groceries=>food'),
(242, 3, 2, 'l2b414u24403', 's2c4a4u2a453', '2012-03-10 00:22:17', 'Groceries=>food'),
(243, 3, 2, 'l2b414u24403', 's264a4u28423', '2012-03-10 00:22:35', 'Groceries=>food'),
(244, 3, 2, 'l26414w2', 'r264a4u28423', '2012-03-10 00:22:38', 'Miscellaneous=>Party & Gifts'),
(245, 3, 2, 'l28484', 'q2d434u28423', '2012-03-10 00:34:48', 'Groceries=>food'),
(246, 3, 3, 'w25414', 'r26464y2041354', '2012-03-10 21:41:10', 'Home=>Mortgage'),
(247, 3, 1, 'l2d414', 'p28464u26453', '2012-03-12 00:00:02', 'Entertainment=>Hobbies'),
(248, 3, 2, 'l27414w2', 'w274z32374', '2012-03-12 00:01:43', 'Miscellaneous=>Party & Gifts'),
(249, 3, 3, 't2d4', 'r26414y2042334', '2012-03-12 12:15:09', 'Transportation=>Gas'),
(250, 3, 1, 'l264', 'p28454u26453', '2012-03-13 17:12:14', 'Dining=>Lunch at work'),
(251, 3, 2, 'l2e4z313', 'v284z3x274', '2012-03-13 23:20:41', 'Groceries=>food'),
(252, 3, 1, 'l294z3w274', 'p28414u26403', '2012-03-14 17:14:54', 'Dining=>Lunch at work'),
(253, 3, 3, 'p2a474230443', 's2948413041394', '2012-03-15 13:14:03', 'Income=>Salary'),
(254, 3, 1, 'l264z313a4', 'p27494u2a423', '2012-03-15 17:41:50', 'Dining=>Lunch at work'),
(255, 3, 2, 'v254z3z284', 'p29444u274y2', '2012-03-15 22:46:53', 'Groceries=>food'),
(256, 3, 3, 'v274z353', 's29414y2042394', '2012-03-17 14:54:08', 'Home=>Insurance'),
(257, 3, 3, 'q25444u254z2', 's264a45304z274', '2012-03-17 14:54:09', 'Transportation=>Insurance '),
(258, 3, 3, 'v2d494u24423', 's2e49433042324', '2012-03-17 15:45:19', 'Income=>Wage'),
(259, 3, 3, 'p2e414u25443', 't2c494130443a4', '2012-03-18 19:43:05', 'Income=>CHILD TAX BENEFIT '),
(260, 3, 1, 'l264z3x254', 'p27484u294z2', '2012-03-18 19:50:39', 'Miscellaneous=>Party & Gifts'),
(261, 3, 3, 'l27434u294y2', 't2c474z204x294', '2012-03-19 01:48:29', 'Groceries=>food'),
(262, 3, 2, 'l26424u274', 'p28434u224y2', '2012-03-19 22:38:48', 'Groceries=>food'),
(263, 3, 1, 'l294z35374', 'p27434u29443', '2012-03-20 17:04:00', 'Dining=>Lunch at work'),
(264, 3, 1, 'l26464', 'p25484u29443', '2012-03-20 23:22:00', 'Dining=>Lunch at work'),
(265, 3, 2, 'l27414', 'p26434u224y2', '2012-03-21 16:46:23', 'Kids=>School expenses'),
(266, 3, 1, 'l294z35374', 'p25434u2a4z2', '2012-03-21 17:04:41', 'Dining=>Lunch at work'),
(267, 3, 1, 'l264z313a4', 'p25424u24413', '2012-03-22 17:38:30', 'Dining=>Lunch at work'),
(268, 3, 3, 'l27494', 't2c4441304x294', '2012-03-23 02:13:00', 'Utilities=>Phone - Home'),
(269, 3, 3, 'l27484u2a4', 't2c4441304z294', '2012-03-23 02:13:40', 'Utilities=>Internet'),
(270, 3, 2, 'l294z3y2a4', 'p25484u29403', '2012-03-23 23:23:33', 'Groceries=>food'),
(271, 3, 1, 'l26444u254', 'w2c4z35364', '2012-03-24 14:58:34', 'Miscellaneous=>Hair Cut'),
(272, 3, 1, 'l26414', 'v2c4z35364', '2012-03-24 18:43:23', 'Dining=>Dining Out'),
(273, 3, 1, 'l294z35374', 'v274z353b4', '2012-03-27 17:03:17', 'Dining=>Lunch at work'),
(274, 3, 1, 'l294z33374', 'u2d4z3y264', '2012-03-27 17:03:52', 'Kids=>lunch'),
(275, 3, 1, 'l294z3w274', 'u294z3x2b4', '2012-03-28 17:03:54', 'Dining=>Lunch at work'),
(276, 3, 2, 'l26464', 'x274z33354', '2012-03-28 22:27:58', 'Groceries=>food'),
(277, 3, 2, 'l26474', 'v2b4z33354', '2012-03-28 22:28:21', 'Miscellaneous=>Hair Cut'),
(278, 3, 3, 'l2b414u234z2', 't25474x2043384', '2012-03-29 00:55:30', 'Utilities=>Phone - Cell'),
(279, 3, 1, 'l26414', 't294z3x2b4', '2012-03-29 15:12:13', 'Kids=>School expenses'),
(280, 3, 1, 'l294z35374', 's2e4z3y264', '2012-03-29 17:09:46', 'Dining=>Lunch at work'),
(281, 3, 1, 'l274z35354', 's2b4z3z234', '2012-03-30 17:46:38', 'Home=>Maintenance'),
(282, 3, 1, 'l29454u27463', 'p23484y2', '2012-03-30 23:03:56', 'Groceries=>food'),
(283, 3, 3, 'l2d424u264y2', 's2d484y204x254', '2012-03-31 01:08:13', 'Dining=>Lunch at work'),
(284, 3, 3, 'w264z30334', 't2544403045374', '2012-03-31 01:11:20', 'Dining=>Lunch at work'),
(285, 3, 3, 'l2d424u264y2', 's2d484y204x254', '2012-03-31 01:12:14', 'Utilities=>TV'),
(286, 3, 3, 'l29444', 's2e424w2041364', '2012-03-31 01:13:20', 'Utilities=>Gas'),
(287, 3, 3, 'p2a474230443', 'u2a434w204y264', '2012-03-31 16:28:26', 'Income=>Salary'),
(288, 3, 3, 'w26434u26463', 'v28444y2043354', '2012-03-31 16:29:22', 'Income=>Wage'),
(289, 3, 3, 'l29464w2', 'u2d494y2043354', '2012-03-31 16:30:22', 'Income=>Transfer'),
(290, 3, 2, 's2a414', 't27474u29403', '2012-03-31 16:30:22', 'Income=>Transfer'),
(291, 3, 3, 'l26464w2', 'u2c444y2043354', '2012-03-31 16:31:32', 'Income=>Transfer'),
(292, 3, 1, 'p2a414', 'p2a424u294z2', '2012-03-31 16:31:32', 'Income=>Transfer'),
(293, 3, 2, 'l2d414', 's29474u29403', '2012-03-31 18:08:21', 'Groceries=>food'),
(294, 3, 1, 'v25414', 'w2a424u294z2', '2012-04-01 13:23:06', 'Income=>Rental'),
(295, 3, 3, 'l26434w2', 'fq_balance', '2012-04-01 13:23:06', 'Income=>Transfer'),
(296, 3, 7, 'p27414', 'q284540354v2a4s2', '2012-04-01 13:23:06', 'Income=>Transfer'),
(297, 3, 3, 'l2a414', 'fq_balance', '2012-04-01 13:23:06', 'Income=>Transfer'),
(298, 3, 9, 't254', 'w2e434w2045334', '2012-04-01 13:23:06', 'Income=>Transfer'),
(299, 3, 10, 'q2c414u2a463', 'p264440304z244', '2012-04-01 13:23:06', 'Home=>Property Tax'),
(300, 3, 3, 'r254441304x254', 'x2a4a433043394', '2012-04-01 13:23:06', 'Income=>Tax Return'),
(301, 3, 1, 'l2c414w2', 'p2a424u294z2', '2012-04-01 13:24:33', 'Income=>Rental'),
(302, 3, 1, 'l284z3z2a4', 'p29494u25413', '2012-04-02 17:15:50', 'Home=>Household Supplies'),
(303, 3, 1, 'l264z313a4', 'p29474u29433', '2012-04-03 17:02:20', 'Dining=>Lunch at work'),
(304, 3, 2, 'l27414', 's27474u29403', '2012-04-03 17:09:18', 'Groceries=>food'),
(305, 3, 2, 'l26414', 's26474u29403', '2012-04-04 00:29:30', 'Entertainment=>Music'),
(306, 3, 2, 'v25414', 'p2642423044344', '2012-04-04 00:30:28', 'Income=>Gift'),
(307, 3, 1, 'l264z313a4', 'p29464u23453', '2012-04-04 17:01:09', 'Dining=>Lunch at work'),
(308, 3, 2, 'l26464', 'p26414x2044344', '2012-04-06 00:08:31', 'Groceries=>food'),
(309, 3, 1, 'l29414', 'p25464u23453', '2012-04-06 02:51:14', 'Miscellaneous=>Party & Gifts'),
(310, 3, 3, 'l29414w2', 'x2644433042374', '2012-04-06 13:04:11', 'Income=>Transfer'),
(311, 3, 5, 's25414', 'v2548413044334', '2012-04-06 13:04:11', 'Income=>Transfer'),
(312, 3, 3, 'l26414w224', 'w2644433042374', '2012-04-06 13:04:42', 'Income=>Transfer'),
(313, 3, 6, 'p25414w2', 'v2a4642304x234', '2012-04-06 13:04:42', 'Income=>Transfer'),
(314, 3, 8, 'l2848433044354', 'o2', '2012-04-06 13:06:18', 'Income=>Transfer'),
(315, 3, 3, 'r2c484u29413', 'w2a424130403', '2012-04-06 13:06:18', 'Income=>Transfer'),
(316, 3, 2, 'l2d414', 'p25434x2044344', '2012-04-06 14:43:41', 'Income=>Transfer'),
(317, 3, 1, 'w254', 'p2d464u23453', '2012-04-06 14:43:41', 'Income=>Transfer'),
(318, 3, 2, 'l28414u234y2', 'x2e424u284z2', '2012-04-06 16:59:07', 'Miscellaneous=>Party & Gifts'),
(319, 3, 2, 'l28414w2', 'u2e424u284z2', '2012-04-08 13:38:20', 'Miscellaneous=>Party & Gifts'),
(320, 3, 1, 'l294z3w274', 'p2d424u23403', '2012-04-09 17:11:39', 'Dining=>Lunch at work'),
(321, 3, 3, 'w25414', 'v2a4a4w20453a4', '2012-04-10 12:02:32', 'Home=>Mortgage'),
(322, 3, 1, 'l27414w2', 'l26494u2a443', '2012-04-10 12:02:32', 'Miscellaneous=>Party & Gifts'),
(323, 3, 1, 'q25414', 'p2d424u23403', '2012-04-10 12:02:59', 'Miscellaneous=>Party & Gifts'),
(324, 3, 1, 'q25414', 'r2d424u23403', '2012-04-10 12:03:37', 'Income=>Gift'),
(325, 3, 1, 'l294', 'r2c484u23403', '2012-04-10 16:50:58', 'Kids=>School expenses'),
(326, 3, 1, 'l264z313a4', 'r2c464u27423', '2012-04-10 16:51:25', 'Dining=>Lunch at work'),
(327, 3, 1, 'l294z35374', 'r2c414u284', '2012-04-11 16:59:14', 'Dining=>Lunch at work'),
(328, 3, 1, 'l294z3w274', 'r2b474u27423', '2012-04-12 17:15:56', 'Dining=>Lunch at work'),
(329, 3, 10, 'l26424z264v234t2', 'o2', '2012-04-14 17:17:19', 'Income=>Transfer'),
(330, 3, 3, 'p264440304z244', 'w2c4341304y234', '2012-04-14 17:17:19', 'Income=>Transfer'),
(331, 3, 3, 'v2a434', 'x294843304y234', '2012-04-14 17:23:34', 'Income=>Wage'),
(332, 3, 3, 'l2c4', 'x29484w204y234', '2012-04-14 17:55:56', 'Home=>Household Supplies'),
(333, 3, 1, 'l28434', 'r28454u27423', '2012-04-14 20:22:03', 'Dining=>Dining Out'),
(334, 3, 3, 'p2a474230443', 'p26414x2a4v274x2', '2012-04-15 22:22:56', 'Income=>Salary'),
(335, 3, 6, 't254', 'v2b4142304x234', '2012-04-16 02:11:42', 'Income=>Gift'),
(336, 3, 5, 't254', 'v2643413044334', '2012-04-16 02:12:06', 'Income=>Gift'),
(337, 3, 5, 'q25414', 'v2843413044334', '2012-04-16 02:13:45', 'Income=>Gift'),
(338, 3, 3, 'l27414w2', 'p25494x2a4v274x2', '2012-04-16 02:14:41', 'Income=>Transfer'),
(339, 3, 1, 'q25414', 't28454u27423', '2012-04-16 02:14:41', 'Income=>Transfer'),
(340, 3, 3, 'v274z353', 'p254840374v284x2', '2012-04-17 17:18:29', 'Home=>Insurance'),
(341, 3, 3, 'q25444u254z2', 'p254640344v254v2', '2012-04-17 17:18:29', 'Transportation=>Insurance '),
(342, 3, 1, 'l264z313a4', 't28434u2b443', '2012-04-17 17:18:29', 'Dining=>Lunch at work'),
(343, 3, 3, 'p2e414u25443', 'p25484z244v294s2', '2012-04-18 17:14:22', 'Income=>CHILD TAX BENEFIT '),
(344, 3, 1, 'l264z313a4', 't28424u25463', '2012-04-18 17:14:22', 'Dining=>Lunch at work'),
(345, 3, 1, 'l294z35374', 't27474u26413', '2012-04-19 17:02:54', 'Dining=>Lunch at work'),
(346, 3, 3, 'l27494', 'p25484w264v294s2', '2012-04-20 02:02:56', 'Utilities=>Phone - Home'),
(347, 3, 3, 'l27484u2a4', 'p25484w274v214s2', '2012-04-20 02:03:27', 'Utilities=>Internet'),
(348, 3, 2, 'l26464', 'u2c474u284z2', '2012-04-21 13:28:46', 'Miscellaneous=>Party & Gifts'),
(349, 3, 1, 'p2346443', 't27454u2a433', '2012-04-24 17:17:14', 'Dining=>Lunch at work'),
(350, 3, 3, 'l294545304x2a4', 'p254144334v264x2', '2012-04-24 23:22:52', 'Utilities=>Electricity'),
(351, 3, 1, 'p2346443', 't27444u24453', '2012-04-25 17:04:30', 'Dining=>Lunch at work'),
(352, 3, 1, 'l26424w2', 's26444u24453', '2012-04-26 00:39:34', 'Dining=>Dining Out'),
(353, 3, 1, 'l2a4', 's25494u24453', '2012-04-26 00:45:22', 'Shopping=>Electronic Product'),
(354, 3, 2, 'l26414', 'u2b474u284z2', '2012-04-26 00:45:57', 'Dining=>Drink'),
(355, 3, 2, 'l27474', 'u29414u284z2', '2012-04-26 01:26:33', 'Groceries=>food'),
(356, 3, 3, 'l2d424u264y2', 'w2649443042394', '2012-04-26 23:31:34', 'Utilities=>TV'),
(357, 3, 3, 'l29444', 'w27434230463a4', '2012-04-27 23:43:42', 'Utilities=>Gas'),
(358, 3, 3, 'l2b414u234z2', 'w2741453045384', '2012-04-27 23:49:02', 'Utilities=>Phone - Cell'),
(359, 3, 3, 'q25414', 'w2941453045384', '2012-04-28 13:32:19', 'Income=>Other'),
(360, 3, 3, 'u27424u2a403', 'x25444x20443', '2012-04-28 13:33:04', 'Income=>Wage'),
(361, 3, 1, 'l26454', 'r2e454u24453', '2012-04-28 22:55:57', 'Miscellaneous=>Hair Cut'),
(362, 3, 1, 'l2b464', 'r274a4u24453', '2012-04-29 19:37:11', 'Entertainment=>Hobbies'),
(363, 3, 1, 'l2d4', 'r27424u24453', '2012-04-29 23:24:44', 'Kids=>School expenses'),
(364, 3, 3, 'p2a474230443', 'p2546453a4v254', '2012-05-01 17:04:04', 'Income=>Salary'),
(365, 3, 3, 'l26434w2', 'fq_balance', '2012-05-01 17:04:04', 'Income=>Transfer'),
(366, 3, 7, 'p27414', 'q284642354v2a4s2', '2012-05-01 17:04:04', 'Income=>Transfer'),
(367, 3, 3, 'l2a414', 'fq_balance', '2012-05-01 17:04:04', 'Income=>Transfer'),
(368, 3, 9, 't254', 'w2e484w2045334', '2012-05-01 17:04:04', 'Income=>Transfer'),
(369, 3, 3, 'q2c414u2a463', 'p254241394v264r2', '2012-05-01 17:04:04', 'Home=>Property Tax'),
(370, 3, 3, 'p2a474230443', 'p264343374v224s2', '2012-05-01 17:04:44', 'Income=>Salary'),
(371, 3, 3, 'l26434w2', 'fq_balance', '2012-05-01 17:04:44', 'Income=>Transfer'),
(372, 3, 7, 'p27414', 'q284744354v2a4s2', '2012-05-01 17:04:44', 'Income=>Transfer'),
(373, 3, 3, 'l2a414', 'fq_balance', '2012-05-01 17:04:44', 'Income=>Transfer'),
(374, 3, 9, 't254', 'x25434w2045334', '2012-05-01 17:04:44', 'Income=>Transfer'),
(375, 3, 3, 'q2c414u2a463', 'p25494z264v234t2', '2012-05-01 17:04:44', 'Home=>Property Tax'),
(376, 3, 3, 'p2a474230443', 'p27454w224v2a4t2', '2012-05-01 17:05:08', 'Income=>Salary'),
(377, 3, 3, 'l26434w2', 'fq_balance', '2012-05-01 17:05:08', 'Income=>Transfer'),
(378, 3, 7, 'p27414', 'q28494w254v2a4s2', '2012-05-01 17:05:08', 'Income=>Transfer'),
(379, 3, 3, 'l2a414', 'fq_balance', '2012-05-01 17:05:08', 'Income=>Transfer'),
(380, 3, 9, 't254', 'x25484w2045334', '2012-05-01 17:05:08', 'Income=>Transfer'),
(381, 3, 3, 'q2c414u2a463', 'p264a42324v214u2', '2012-05-01 17:05:08', 'Home=>Property Tax'),
(382, 3, 3, 'p2a474230443', 'p28464y284v284u2', '2012-05-01 17:06:22', 'Income=>Salary'),
(383, 3, 3, 'l26434w2', 'fq_balance', '2012-05-01 17:06:22', 'Income=>Transfer'),
(384, 3, 7, 'p27414', 'q284a4y254v2a4s2', '2012-05-01 17:06:22', 'Income=>Transfer'),
(385, 3, 3, 'l2a414', 'fq_balance', '2012-05-01 17:06:22', 'Income=>Transfer'),
(386, 3, 9, 't254', 'x26434w2045334', '2012-05-01 17:06:22', 'Income=>Transfer'),
(387, 3, 3, 'q2c414u2a463', 'p284144374v294v2', '2012-05-01 17:06:22', 'Home=>Property Tax'),
(388, 3, 3, 'p2a474230443', 'p294741344v264v2', '2012-05-01 17:06:36', 'Income=>Salary'),
(389, 3, 3, 'l26434w2', 'fq_balance', '2012-05-01 17:06:36', 'Income=>Transfer'),
(390, 3, 7, 'p27414', 'q294140354v2a4s2', '2012-05-01 17:06:36', 'Income=>Transfer'),
(391, 3, 3, 'l2a414', 'fq_balance', '2012-05-01 17:06:36', 'Income=>Transfer'),
(392, 3, 9, 't254', 'x26484w2045334', '2012-05-01 17:06:36', 'Income=>Transfer'),
(393, 3, 3, 'q2c414u2a463', 'p29434x234v274w2', '2012-05-01 17:06:36', 'Home=>Property Tax'),
(394, 3, 1, 'l28484u274', 'q2d444u29453', '2012-05-02 02:27:55', 'Kids=>School expenses'),
(395, 3, 2, 'l2642413', 't27464u284z2', '2012-05-06 17:20:26', 'Home=>Maintenance'),
(396, 3, 2, 'l27424', 't25454u284z2', '2012-05-06 17:21:39', 'Groceries=>food'),
(397, 3, 1, 's2341413', 'q2c4a4u29403', '2012-05-08 17:06:43', 'Dining=>Lunch at work'),
(398, 3, 1, 'q2343413', 'q2c484u26453', '2012-05-08 17:29:47', 'Groceries=>food'),
(399, 3, 1, 'r234a433', 'q2c444u274y2', '2012-05-09 17:21:01', 'Dining=>Lunch at work'),
(400, 3, 2, 'l26454w2', 'r2b454u284z2', '2012-05-09 22:56:13', 'Groceries=>food'),
(401, 3, 3, 'w25414', 'p28424z274v234v2', '2012-05-12 12:22:13', 'Home=>Mortgage'),
(402, 3, 3, 'q2a414', 'v2a444x2045324', '2012-05-12 12:36:45', 'Income=>Other'),
(403, 3, 3, 't2e474u23443', 'w2643433046394', '2012-05-12 12:37:27', 'Income=>Wage'),
(404, 3, 3, 'l27464w2', 'v2d48433046394', '2012-05-12 13:58:09', 'Income=>Transfer'),
(405, 3, 1, 'q2a414', 't27444u274y2', '2012-05-12 13:58:09', 'Income=>Transfer'),
(406, 3, 3, 'l2a414', 'v2d43433046394', '2012-05-12 14:02:36', 'Miscellaneous=>Party & Gifts'),
(407, 3, 1, 'l2a414', 's2c444u274y2', '2012-05-13 18:50:42', 'Miscellaneous=>Party & Gifts'),
(408, 3, 1, 'l2b494', 's25464u274y2', '2012-05-13 18:51:07', 'Dining=>Dining Out'),
(409, 3, 1, 'l2a4z32364', 'r2e4a4u2a443', '2012-05-13 18:55:22', 'Kids=>School expenses'),
(410, 3, 3, 'p2a474230443', 'x284a403043394', '2012-05-15 17:01:16', 'Income=>Salary'),
(411, 3, 1, 's234a413', 'r2e454u2b4z2', '2012-05-15 17:01:16', 'Dining=>Lunch at work'),
(412, 3, 3, 'v284', 'x28434x2043394', '2012-05-16 17:31:24', 'Home=>Insurance'),
(413, 3, 3, 'q29464', 'x2548423043394', '2012-05-16 17:31:24', 'Transportation=>Insurance '),
(414, 3, 2, 'l28414', 'r28454u284z2', '2012-05-16 17:31:24', 'Groceries=>food'),
(415, 3, 3, 'p2e414u25443', 'x2545443046334', '2012-05-18 21:39:55', 'Income=>CHILD TAX BENEFIT '),
(416, 3, 3, 'l28414u2a4', 'x254244304y234', '2012-05-18 21:41:36', 'Utilities=>Phone - Home'),
(417, 3, 3, 'l28414', 'x2542443046334', '2012-05-18 21:41:58', 'Utilities=>Internet'),
(418, 3, 3, 'u2a414', 'x2b4a443046334', '2012-05-19 12:55:44', 'Income=>Rental'),
(419, 3, 2, 'l29414', 'q2e454u284z2', '2012-05-20 21:26:51', 'Shopping=>Clothes, Pants, Shoes'),
(420, 3, 1, 'l26414', 'r2d454u2b4z2', '2012-05-20 21:27:55', 'Dining=>Snack'),
(421, 3, 1, 'l2b414', 'r27454u2b4z2', '2012-05-22 03:04:22', 'Income=>Transfer'),
(422, 3, 2, 'u254', 'r2a454u284z2', '2012-05-22 03:04:22', 'Income=>Transfer'),
(423, 3, 2, 'l2a414', 'r25454u284z2', '2012-05-22 03:05:16', 'Transportation=>Taxi/Bus'),
(424, 3, 2, 'l27454w2', 'u294z32344', '2012-05-22 03:06:01', 'Groceries=>food'),
(425, 3, 1, 'u2348413', 'r26494u23443', '2012-05-23 17:22:11', 'Dining=>Lunch at work'),
(426, 3, 3, 'w264z30334', 'x2a49423044324', '2012-05-26 15:01:25', 'Utilities=>TV'),
(427, 3, 3, 'u27424u2a403', 'p25434w2a4v264u2', '2012-05-27 14:15:34', 'Income=>Wage'),
(428, 3, 3, 'l27414w2', 'p25414w2a4v264u2', '2012-05-27 14:16:24', 'Income=>Transfer'),
(429, 3, 2, 'q25414', 'q2b454u284z2', '2012-05-27 14:16:24', 'Income=>Transfer'),
(430, 3, 1, 'l26414', 'r25494u23443', '2012-05-29 00:07:19', 'Entertainment=>Events'),
(431, 3, 1, 'l274z33334', 'r25464u26433', '2012-05-29 00:07:53', 'Home=>Maintenance'),
(432, 3, 3, 'l29444', 'x2a484z20423a4', '2012-05-30 12:12:42', 'Utilities=>Gas'),
(433, 3, 1, 'l27464', 'q2d414u26433', '2012-05-30 23:12:22', 'Kids=>School expenses'),
(434, 3, 1, 't23464', 'q2c454u2b433', '2012-05-31 17:02:01', 'Dining=>Lunch at work'),
(435, 3, 3, 'p2c464', 'x2c4a4x20423a4', '2012-05-31 22:26:27', 'Income=>Other'),
(436, 3, 3, 'l26434w2', 'fq_balance', '2012-06-01 16:26:21', 'Income=>Transfer'),
(437, 3, 7, 'p27414', 'q294242354v2a4s2', '2012-06-01 16:26:21', 'Income=>Transfer'),
(438, 3, 3, 'l2a414', 'fq_balance', '2012-06-01 16:26:21', 'Income=>Transfer'),
(439, 3, 9, 't254', 'x27434w2045334', '2012-06-01 16:26:21', 'Income=>Transfer'),
(440, 3, 3, 'q2c414u2a463', 'x28464w20443', '2012-06-01 16:26:21', 'Home=>Property Tax'),
(441, 3, 3, 'u2a414', 'p25414w224v284', '2012-06-01 16:26:21', 'Income=>Rental'),
(442, 3, 3, 'u2a414', 'p254741324v284', '2012-06-02 14:58:46', 'Income=>Rental'),
(443, 3, 1, 'l2a4', 'q2b4a4u2b433', '2012-06-02 14:59:18', 'Kids=>lunch'),
(444, 3, 3, 't2e4z32364', 'p254645334v214w2', '2012-06-03 02:02:00', 'Utilities=>Phone - Cell'),
(445, 3, 1, 'l27434u284', 'q29484u25433', '2012-06-03 20:21:53', 'Shopping=>Skin Care Product'),
(446, 3, 1, 'l294z35374', 'q29434u264y2', '2012-06-05 17:01:15', 'Dining=>Lunch at work'),
(447, 3, 1, 'l294z35374', 'q28484u26433', '2012-06-06 17:11:36', 'Dining=>Lunch at work'),
(448, 3, 3, 'l28414w2', 'p254345334v214w2', '2012-06-08 03:24:19', 'Income=>Transfer'),
(449, 3, 1, 'r25414', 't28484u26433', '2012-06-08 03:24:19', 'Income=>Transfer'),
(450, 3, 1, 'l28414w2', 'q28484u26433', '2012-06-08 03:25:16', 'Miscellaneous=>Party & Gifts'),
(451, 3, 1, 'l284z3z2b4', 'q28454u22443', '2012-06-08 03:28:57', 'Miscellaneous=>Party & Gifts'),
(452, 3, 3, 'u2d424u29433', 'p254a43344v294s2', '2012-06-09 15:48:59', 'Income=>Wage'),
(453, 3, 3, 'l27414w2', 'p25484y2b4v294s2', '2012-06-09 15:51:10', 'Income=>Transfer'),
(454, 3, 1, 'q25414', 's28454u22443', '2012-06-09 15:51:10', 'Income=>Transfer'),
(455, 3, 1, 'l27434u29423', 's26424u254z2', '2012-06-09 17:54:34', 'Dining=>Dining Out'),
(456, 3, 2, 'l27414w2', 'u294z32344', '2012-06-09 17:55:26', 'Groceries=>food'),
(457, 3, 3, 'w25414', 'x2e43453045334', '2012-06-10 21:33:15', 'Home=>Mortgage'),
(458, 3, 1, 'l2c414', 'r29424u254z2', '2012-06-10 21:33:15', 'Miscellaneous=>Hair Cut'),
(459, 3, 1, 'l28414', 'r26424u254z2', '2012-06-10 23:58:05', 'Miscellaneous=>Party & Gifts');

-- --------------------------------------------------------

--
-- Table structure for table `sp_comment`
--

CREATE TABLE IF NOT EXISTS `sp_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sp_comment`
--

INSERT INTO `sp_comment` (`id`, `category_id`, `item_id`, `comment`) VALUES
(1, 11, 60, 'stamps'),
(2, 11, 64, 'stamps'),
(3, 9, 59, 'video CD'),
(4, 6, 45, 'ski'),
(5, 8, 55, 'ski  trip'),
(6, 8, 55, 'ski trip'),
(7, 12, 70, 'shoes'),
(8, 1, 79, 'insurance return');

-- --------------------------------------------------------

--
-- Table structure for table `sp_frequency`
--

CREATE TABLE IF NOT EXISTS `sp_frequency` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `frequency` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sp_frequency`
--

INSERT INTO `sp_frequency` (`id`, `user_id`, `frequency`) VALUES
(1, 0, 'Pay Now'),
(2, 0, 'Daily'),
(3, 0, 'Weekly'),
(4, 0, 'Bi-Weekly'),
(5, 0, 'Monthly'),
(6, 0, 'Quarterly'),
(7, 0, 'Semi-Annually'),
(8, 0, 'Yearly'),
(9, 0, 'Pay Later(One Time)');

-- --------------------------------------------------------

--
-- Table structure for table `sp_monthly`
--

CREATE TABLE IF NOT EXISTS `sp_monthly` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monthly_income` varchar(100) NOT NULL,
  `monthly_expenese` varchar(100) NOT NULL,
  `reset_date` date NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sp_monthly`
--

INSERT INTO `sp_monthly` (`id`, `monthly_income`, `monthly_expenese`, `reset_date`, `user_id`) VALUES
(1, 'o2', 's2c45433', '2011-09-01', 3),
(2, 'o2', 's2c41433', '2011-10-01', 3),
(3, 'o2', 'u2541423', '2011-11-01', 3),
(4, 'o2', 's2b444w2', '2011-12-01', 3),
(5, 't28424y20433a4', 't2c4445304y254', '2012-01-01', 3),
(6, 'u2a4a4x2043384', 'u2e41443044324', '2012-02-01', 3),
(7, 'q2a48403043364', 'r2949413040384', '2012-03-01', 3),
(8, 'v2e494y2046384', 's2748423042384', '2012-04-01', 3),
(9, 'v2a47413046354', 't26444x2045374', '2012-05-01', 3),
(10, 'o2', 'o2', '2012-05-01', 4),
(11, 's25464w204x284', 'r2c494w2046334', '2012-06-01', 3),
(12, 'p2e494x2044374', 'q2841433045364', '2012-07-01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sp_monthly_detail`
--

CREATE TABLE IF NOT EXISTS `sp_monthly_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `expenses` varchar(100) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=296 ;

--
-- Dumping data for table `sp_monthly_detail`
--

INSERT INTO `sp_monthly_detail` (`id`, `user_id`, `category_id`, `item_id`, `expenses`, `month`, `year`) VALUES
(1, 3, 7, 2, 'q27484u24433', 12, 2011),
(2, 3, 7, 1, 'r25494u2a443', 12, 2011),
(3, 3, 1, 79, 'w294', 12, 2011),
(5, 3, 1, 76, 'v25414', 12, 2011),
(6, 3, 10, 67, 'r2e424u264y2', 12, 2011),
(7, 3, 7, 3, 't2343413', 12, 2011),
(8, 3, 11, 63, 'p2a4a41304z294', 12, 2011),
(9, 3, 7, 1, 's28474', 8, 2011),
(10, 3, 7, 2, 'r2a4', 8, 2011),
(11, 3, 6, 46, 'p2a414', 8, 2011),
(12, 3, 10, 67, 'p27414', 8, 2011),
(13, 3, 3, 15, 'w25414', 8, 2011),
(14, 3, 3, 18, 'q2c434', 8, 2011),
(15, 3, 3, 21, 'r2a414', 8, 2011),
(16, 3, 8, 49, 'r284', 8, 2011),
(17, 3, 11, 63, 'q28414', 8, 2011),
(18, 3, 11, 64, 'q2a4', 8, 2011),
(19, 3, 11, 66, 'p2c414', 8, 2011),
(20, 3, 2, 5, 'q2d414', 8, 2011),
(21, 3, 2, 6, 's2', 8, 2011),
(22, 3, 4, 23, 'r254', 8, 2011),
(23, 3, 4, 24, 'p29454', 8, 2011),
(24, 3, 4, 25, 'v2c4', 8, 2011),
(25, 3, 4, 26, 'r284', 8, 2011),
(26, 3, 4, 29, 'v274', 8, 2011),
(27, 3, 4, 30, 'p26414', 8, 2011),
(28, 3, 7, 1, 'p2d494', 9, 2011),
(29, 3, 7, 2, 'p2c4', 9, 2011),
(30, 3, 6, 67, 'q25414', 9, 2011),
(31, 3, 3, 15, 'w25414', 9, 2011),
(32, 3, 3, 18, 'q2c434', 9, 2011),
(33, 3, 3, 21, 'r2a414', 9, 2011),
(34, 3, 8, 49, 'q28454', 9, 2011),
(35, 3, 8, 52, 't2', 9, 2011),
(36, 3, 11, 63, 'p2949433', 9, 2011),
(37, 3, 11, 66, 'p2c414', 9, 2011),
(38, 3, 2, 5, 's28434', 9, 2011),
(39, 3, 2, 6, 'w2', 9, 2011),
(40, 3, 4, 23, 'v254', 9, 2011),
(41, 3, 4, 24, 'q29474', 9, 2011),
(42, 3, 4, 25, 'v2c4', 9, 2011),
(43, 3, 4, 26, 'r2a4', 9, 2011),
(44, 3, 4, 29, 'q2e4', 9, 2011),
(45, 3, 11, 60, 'v264', 9, 2011),
(46, 3, 9, 56, 'v274', 9, 2011),
(47, 3, 2, 8, 'w2', 9, 2011),
(48, 3, 7, 1, 'p26494', 10, 2011),
(49, 3, 7, 2, 'p254', 10, 2011),
(50, 3, 7, 4, 'u2', 10, 2011),
(51, 3, 10, 67, 'u2d414', 10, 2011),
(52, 3, 3, 15, 'w25414', 10, 2011),
(53, 3, 3, 18, 'q2b4a4', 10, 2011),
(54, 3, 3, 21, 'r2a414', 10, 2011),
(55, 3, 8, 49, 's264', 10, 2011),
(56, 3, 11, 63, 'w25454', 10, 2011),
(57, 3, 11, 66, 'p2c414', 10, 2011),
(58, 3, 2, 5, 'p2c464', 10, 2011),
(59, 3, 4, 23, 'v254', 10, 2011),
(60, 3, 4, 24, 'q29474', 10, 2011),
(61, 3, 4, 25, 'v2c4', 10, 2011),
(62, 3, 4, 26, 'v294', 10, 2011),
(63, 3, 4, 29, 's274', 10, 2011),
(64, 3, 11, 60, 'p2c4', 10, 2011),
(65, 3, 9, 56, 'r29474', 10, 2011),
(66, 3, 5, 32, 'q2a414', 10, 2011),
(67, 3, 8, 54, 'r29464', 10, 2011),
(68, 3, 8, 65, 'p25444x2', 10, 2011),
(69, 3, 12, 70, 'r27464', 10, 2011),
(70, 3, 7, 1, 'p2d484', 11, 2011),
(71, 3, 7, 4, 't2', 11, 2011),
(72, 3, 3, 15, 'w25414', 11, 2011),
(73, 3, 3, 18, 'q2b4a4', 11, 2011),
(74, 3, 10, 68, 'v254', 11, 2011),
(75, 3, 5, 33, 'p27464', 11, 2011),
(76, 3, 5, 36, 's2c414', 11, 2011),
(77, 3, 8, 49, 'q274', 11, 2011),
(78, 3, 8, 52, 'q254', 11, 2011),
(79, 3, 11, 63, 'r25414', 11, 2011),
(80, 3, 2, 5, 'q28474', 11, 2011),
(81, 3, 2, 6, 'p2a4', 11, 2011),
(82, 3, 2, 7, 'w2e424', 11, 2011),
(83, 3, 4, 23, 'q274', 11, 2011),
(84, 3, 4, 24, 'r2c4', 11, 2011),
(85, 3, 4, 26, 'v2a4', 11, 2011),
(86, 3, 4, 28, 'q2b454', 11, 2011),
(87, 3, 4, 29, 'w254', 11, 2011),
(88, 3, 11, 66, 'p2c414', 11, 2011),
(89, 3, 4, 25, 'v2c4', 11, 2011),
(90, 3, 8, 49, 'v234a413', 12, 2011),
(91, 3, 2, 5, 'q26414u22433', 12, 2011),
(92, 3, 5, 34, 'p25414', 12, 2011),
(93, 3, 11, 66, 'r29414', 12, 2011),
(94, 3, 3, 15, 'p2b414w2', 12, 2011),
(95, 3, 1, 81, 'r2d414u29413', 12, 2011),
(96, 3, 5, 36, 's2c414', 12, 2011),
(97, 3, 3, 18, 'p29464u2a4', 12, 2011),
(98, 3, 2, 10, 's25474u28413', 12, 2011),
(99, 3, 1, 74, 's2842423046324', 12, 2011),
(100, 3, 11, 61, 'r254', 12, 2011),
(101, 3, 1, 77, 'o2', 12, 2011),
(102, 3, 10, 67, 's2e464', 11, 2011),
(103, 3, 11, 60, 'r274', 12, 2011),
(104, 3, 9, 83, 'p2c4', 12, 2011),
(105, 3, 1, 75, 'v29454u25453', 12, 2011),
(106, 3, 11, 64, 'o2346433', 12, 2011),
(107, 3, 8, 52, 'p284z30394', 12, 2011),
(108, 3, 7, 4, 'p264z343', 12, 2011),
(109, 3, 9, 59, 'p254', 12, 2011),
(110, 3, 1, 78, 'w25414', 12, 2011),
(111, 3, 5, 32, 'p28464w2', 12, 2011),
(112, 3, 2, 6, 's23464', 12, 2011),
(113, 3, 8, 47, 'p264z34374', 12, 2011),
(114, 3, 6, 45, 'p2a444', 12, 2011),
(115, 3, 1, 76, 'v25414', 1, 2012),
(116, 3, 1, 77, 'o2', 1, 2012),
(117, 3, 4, 24, 'p2d484u274y2', 1, 2012),
(118, 3, 4, 25, 'p2a444u28413', 1, 2012),
(119, 3, 4, 26, 'p29494', 1, 2012),
(120, 3, 4, 28, 'r2d424u22443', 1, 2012),
(121, 3, 4, 23, 'x274z31384', 1, 2012),
(122, 3, 4, 29, 'w284z3x2b4', 1, 2012),
(123, 3, 2, 6, 'v2343413', 1, 2012),
(124, 3, 2, 5, 'q2c434u22433', 1, 2012),
(125, 3, 7, 4, 'q254z3w254', 1, 2012),
(126, 3, 7, 1, 'r2a4z3w264', 1, 2012),
(127, 3, 3, 20, 's26464u25463', 1, 2012),
(128, 3, 10, 67, 't29414u224z2', 1, 2012),
(129, 3, 7, 2, 'p27434u2b413', 1, 2012),
(130, 3, 9, 56, 'q28484u254', 1, 2012),
(131, 3, 3, 15, 'w25414', 1, 2012),
(132, 3, 1, 75, 'p2e424z2040374', 1, 2012),
(133, 3, 8, 55, 't2a4', 1, 2012),
(134, 3, 7, 3, 'p23444', 1, 2012),
(135, 3, 8, 49, 'u23424z2', 1, 2012),
(136, 3, 11, 60, 'p2c4', 1, 2012),
(137, 3, 1, 74, 'r2549433046354', 1, 2012),
(138, 3, 8, 52, 'p274', 1, 2012),
(139, 3, 3, 21, 'r27464', 1, 2012),
(140, 3, 3, 18, 'v274z353', 1, 2012),
(141, 3, 2, 10, 'q25444u254z2', 1, 2012),
(142, 3, 8, 65, 'p25444w20423', 1, 2012),
(143, 3, 1, 81, 'p2e414u25443', 1, 2012),
(144, 3, 5, 34, 'p254z3w254', 1, 2012),
(145, 3, 4, 31, 's23414x2', 1, 2012),
(146, 3, 9, 58, 'q2a4z353a4', 1, 2012),
(147, 3, 11, 63, 'p26454x2045384', 1, 2012),
(148, 3, 8, 84, 'p254', 1, 2012),
(149, 3, 5, 32, 'p2d414', 1, 2012),
(150, 3, 11, 85, 's2a4z3y2', 1, 2012),
(151, 3, 1, 76, 'v25414', 2, 2012),
(152, 3, 1, 77, 'o2', 2, 2012),
(153, 3, 3, 21, 'q2c414u2a463', 2, 2012),
(154, 3, 7, 1, 'r2a4z343b4', 2, 2012),
(155, 3, 4, 26, 'v294', 2, 2012),
(156, 3, 4, 25, 'v2b4z34344', 2, 2012),
(157, 3, 2, 5, 'q274a4u224z2', 2, 2012),
(158, 3, 11, 60, 'q2a4', 2, 2012),
(159, 3, 11, 63, 's2a444u27453', 2, 2012),
(160, 3, 10, 67, 's2a444u26453', 2, 2012),
(161, 3, 3, 15, 'w25414', 2, 2012),
(162, 3, 3, 20, 'p254z313b4', 2, 2012),
(163, 3, 5, 33, 'q23434x2', 2, 2012),
(164, 3, 8, 84, 'p254', 2, 2012),
(165, 3, 1, 74, 'p2a474230443', 2, 2012),
(166, 3, 3, 18, 'v274z353', 2, 2012),
(167, 3, 2, 10, 'q25444u254z2', 2, 2012),
(168, 3, 1, 81, 'p2e414u25443', 2, 2012),
(169, 3, 8, 49, 's274z3w234', 2, 2012),
(170, 3, 1, 75, 'w26484u27453', 2, 2012),
(171, 3, 5, 32, 'p2d414', 2, 2012),
(172, 3, 4, 23, 'q2d4', 2, 2012),
(173, 3, 4, 29, 'q2c4z343', 2, 2012),
(174, 3, 4, 28, 's28414u22463', 2, 2012),
(175, 3, 9, 57, 'p2a444u28453', 2, 2012),
(176, 3, 9, 56, 'p294z32384', 2, 2012),
(177, 3, 9, 59, 'u254z353a4', 2, 2012),
(178, 3, 4, 24, 'v274z3z244', 2, 2012),
(179, 3, 7, 2, 'r254z323', 2, 2012),
(180, 3, 1, 76, 'v25414', 3, 2012),
(181, 3, 1, 77, 'o2', 3, 2012),
(182, 3, 3, 21, 'q2c414u2a463', 3, 2012),
(183, 3, 7, 1, 'p26484u25453', 3, 2012),
(184, 3, 10, 67, 'v27484u29423', 3, 2012),
(185, 3, 1, 74, 's2c414w204y2', 3, 2012),
(186, 3, 2, 86, 'v2a4', 3, 2012),
(187, 3, 1, 75, 'q284a4y20423', 3, 2012),
(188, 3, 4, 26, 'w2b4', 3, 2012),
(189, 3, 4, 25, 'p2a494u24403', 3, 2012),
(190, 3, 2, 5, 'q28434u22413', 3, 2012),
(191, 3, 8, 49, 'x284z3x2b4', 3, 2012),
(192, 3, 7, 2, 't2c4z33354', 3, 2012),
(193, 3, 11, 63, 'r2a434u274', 3, 2012),
(194, 3, 3, 15, 'w25414', 3, 2012),
(195, 3, 11, 87, 'w23474z2', 3, 2012),
(196, 3, 6, 43, 'w254', 3, 2012),
(197, 3, 4, 24, 'p2c444u234z2', 3, 2012),
(198, 3, 3, 18, 'v274z353', 3, 2012),
(199, 3, 2, 10, 'q25444u254z2', 3, 2012),
(200, 3, 9, 59, 'w23474x2', 3, 2012),
(201, 3, 9, 58, 'p29474u2b4', 3, 2012),
(202, 3, 1, 81, 'p2e414u25443', 3, 2012),
(203, 3, 11, 88, 'q25494', 3, 2012),
(204, 3, 4, 30, 'u264z31394', 3, 2012),
(205, 3, 4, 23, 'q2d4', 3, 2012),
(206, 3, 4, 29, 'q2c4z343', 3, 2012),
(207, 3, 11, 64, 'p264z3x2a4', 3, 2012),
(208, 3, 11, 60, 'q2e4z3z2', 3, 2012),
(209, 3, 3, 20, 's2b4z34374', 3, 2012),
(210, 3, 2, 7, 'p2d474u25443', 3, 2012),
(211, 3, 8, 84, 's2348413', 3, 2012),
(212, 3, 8, 52, 't23474z2', 3, 2012),
(213, 3, 3, 17, 'q234a4z2', 3, 2012),
(214, 3, 1, 76, 'o2', 4, 2012),
(215, 3, 1, 77, 'o2', 4, 2012),
(216, 3, 3, 21, 'q2c414u2a463', 4, 2012),
(217, 3, 1, 89, 'r254441304x254', 4, 2012),
(218, 3, 11, 63, 's29424u25423', 4, 2012),
(219, 3, 3, 20, 's294z3y244', 4, 2012),
(220, 3, 7, 1, 'r294z3y2', 4, 2012),
(221, 3, 10, 67, 'r2a444u2a423', 4, 2012),
(222, 3, 6, 42, 'p254', 4, 2012),
(223, 3, 1, 78, 'p27414w2', 4, 2012),
(224, 3, 2, 5, 'q2b434', 4, 2012),
(225, 3, 7, 2, 'r2d414u234', 4, 2012),
(226, 3, 11, 87, 'p2a4z34334', 4, 2012),
(227, 3, 3, 15, 'w25414', 4, 2012),
(228, 3, 8, 49, 's2d4z33394', 4, 2012),
(229, 3, 10, 68, 'p294z35394', 4, 2012),
(230, 3, 8, 54, 'p2b464', 4, 2012),
(231, 3, 12, 70, 'p26434w2044374', 4, 2012),
(232, 3, 1, 75, 'p28484z2045344', 4, 2012),
(233, 3, 9, 58, 'r254z3y264', 4, 2012),
(234, 3, 1, 74, 'p2a474230443', 4, 2012),
(235, 3, 3, 18, 'v274z353', 4, 2012),
(236, 3, 2, 10, 'q25444u254z2', 4, 2012),
(237, 3, 1, 81, 'p2e414u25443', 4, 2012),
(238, 3, 4, 23, 'q2d4', 4, 2012),
(239, 3, 4, 29, 'q2c4z343', 4, 2012),
(240, 3, 9, 56, 'p2a4z313a4', 4, 2012),
(241, 3, 9, 57, 'q2b4z32334', 4, 2012),
(242, 3, 4, 28, 's294a4u22463', 4, 2012),
(243, 3, 7, 3, 'p254', 4, 2012),
(244, 3, 4, 25, 'w264z30334', 4, 2012),
(245, 3, 4, 26, 's284', 4, 2012),
(246, 3, 4, 24, 'u254z3x244', 4, 2012),
(247, 3, 1, 79, 'q25414', 4, 2012),
(248, 3, 3, 17, 's274z34394', 4, 2012),
(249, 3, 11, 60, 'p294', 4, 2012),
(250, 3, 6, 43, 'u2a4', 4, 2012),
(251, 3, 1, 74, 'x29414w204z2', 5, 2012),
(252, 3, 1, 77, 'o2', 5, 2012),
(253, 3, 3, 21, 'p2846403041364', 5, 2012),
(254, 3, 7, 1, 's2d4z323b4', 5, 2012),
(255, 3, 8, 49, 'u2d4z3x264', 5, 2012),
(256, 3, 3, 17, 's25414u2a443', 5, 2012),
(257, 3, 10, 67, 't26494u29433', 5, 2012),
(258, 3, 2, 5, 'q27464u22403', 5, 2012),
(259, 3, 3, 15, 'w25414', 5, 2012),
(260, 3, 1, 79, 's27464', 5, 2012),
(261, 3, 1, 75, 'p2742443', 5, 2012),
(262, 3, 11, 63, 'p25414', 5, 2012),
(263, 3, 7, 2, 'p2a454u25423', 5, 2012),
(264, 3, 3, 18, 'v284', 5, 2012),
(265, 3, 2, 10, 'q29464', 5, 2012),
(266, 3, 1, 81, 'p2e414u25443', 5, 2012),
(267, 3, 4, 23, 'r254z343', 5, 2012),
(268, 3, 4, 29, 'r254', 5, 2012),
(269, 3, 1, 76, 'u2a414', 5, 2012),
(270, 3, 9, 56, 's254', 5, 2012),
(271, 3, 7, 4, 'p254', 5, 2012),
(272, 3, 8, 47, 'r264z303b4', 5, 2012),
(273, 3, 2, 11, 't254', 5, 2012),
(274, 3, 4, 25, 'w264z30334', 5, 2012),
(275, 3, 6, 39, 'p254', 5, 2012),
(276, 3, 4, 26, 's284', 5, 2012),
(277, 3, 1, 77, 'o2', 6, 2012),
(278, 3, 3, 21, 'q2c414u2a463', 6, 2012),
(279, 3, 1, 76, 'p28414w2', 6, 2012),
(280, 3, 7, 2, 'u2c4z343b4', 6, 2012),
(281, 3, 8, 84, 't2', 6, 2012),
(282, 3, 4, 24, 't2e4z32364', 6, 2012),
(283, 3, 2, 7, 'q254z35384', 6, 2012),
(284, 3, 9, 57, 'q274z323', 6, 2012),
(285, 3, 8, 49, 'v234a4z2', 6, 2012),
(286, 3, 7, 3, 'w2348453', 6, 2012),
(287, 3, 10, 67, 'q2b444u22453', 6, 2012),
(288, 3, 7, 1, 'x234a4', 6, 2012),
(289, 3, 3, 20, 'q2343423', 6, 2012),
(290, 3, 2, 5, 't2d4', 6, 2012),
(291, 3, 11, 63, 'r28444u25463', 6, 2012),
(292, 3, 1, 75, 'u2d424u29433', 6, 2012),
(293, 3, 3, 15, 'w25414', 6, 2012),
(294, 3, 11, 60, 'v254', 6, 2012),
(295, 3, 12, 70, 'r25484u274z2', 6, 2012);

-- --------------------------------------------------------

--
-- Table structure for table `sp_payment_type`
--

CREATE TABLE IF NOT EXISTS `sp_payment_type` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `Type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sp_payment_type`
--

INSERT INTO `sp_payment_type` (`id`, `user_id`, `Type`) VALUES
(1, 0, 'Cash'),
(2, 0, 'VISA'),
(3, 0, 'MasterCard'),
(4, 0, 'AMEX'),
(5, 0, 'Cheque'),
(6, 0, 'Auto Payment'),
(7, 0, 'Other'),
(8, 3, 'Sears Card');

-- --------------------------------------------------------

--
-- Table structure for table `sp_reminder`
--

CREATE TABLE IF NOT EXISTS `sp_reminder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `spender_id` tinyint(1) NOT NULL,
  `category_id` tinyint(2) NOT NULL,
  `item_id` int(11) NOT NULL,
  `frequency_id` tinyint(2) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `type_id` tinyint(2) NOT NULL,
  `bank_id` tinyint(2) NOT NULL,
  `to_bank_id` tinyint(2) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `activated` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sp_reminder`
--

INSERT INTO `sp_reminder` (`id`, `user_id`, `spender_id`, `category_id`, `item_id`, `frequency_id`, `amount`, `type_id`, `bank_id`, `to_bank_id`, `start_date`, `activated`) VALUES
(1, 3, 1, 7, 1, 2, 'p2346443', 1, 1, 0, '2012-04-20', '2012-06-01'),
(2, 3, 1, 10, 67, 2, 'o2', 1, 1, 0, '2012-04-21', '2012-05-09'),
(3, 3, 1, 10, 67, 2, 'o2', 3, 3, 0, '2012-04-21', '2012-05-13'),
(4, 3, 1, 2, 5, 3, 't2d4', 3, 3, 0, '2012-04-23', '2012-06-11'),
(5, 3, 1, 4, 28, 9, 's294a4u22463', 1, 3, 0, '2012-04-24', '2013-04-24'),
(6, 3, 1, 4, 25, 5, 'w264z30334', 1, 3, 0, '2012-04-26', '2012-06-26'),
(7, 3, 1, 4, 26, 5, 's284', 1, 3, 0, '2012-04-27', '2012-05-27'),
(8, 3, 1, 4, 24, 5, 'u254z3x244', 1, 3, 0, '2012-04-02', '2012-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `s_chat_messages`
--

CREATE TABLE IF NOT EXISTS `s_chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `when` int(11) NOT NULL,
  `msg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `talk_to` varchar(60) NOT NULL,
  `show_flag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=264 ;

--
-- Dumping data for table `s_chat_messages`
--

INSERT INTO `s_chat_messages` (`id`, `user`, `msg_id`, `when`, `msg_time`, `talk_to`, `show_flag`) VALUES
(260, 'Lie wen Huang', 14, 1321058991, '2011-11-12 00:49:51', '|4|3|', ''),
(261, 'Raymond Huang', 15, 1321059015, '2011-11-12 00:50:15', '|3|4|', ''),
(262, 'Lie wen Huang', 16, 1322104684, '2011-11-24 03:18:04', '|4|3|', ''),
(263, 'Raymond Huang', 15, 1322104701, '2012-04-28 15:52:00', '|3|4|', ',3');

-- --------------------------------------------------------

--
-- Table structure for table `talk_message`
--

CREATE TABLE IF NOT EXISTS `talk_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `message` (`message`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `talk_message`
--

INSERT INTO `talk_message` (`id`, `message`) VALUES
(16, 'sYNktY8='),
(14, 'sYNktY8yueX5tO9mRS=='),
(15, 'wONrHo==');

-- --------------------------------------------------------

--
-- Table structure for table `upload_infor`
--

CREATE TABLE IF NOT EXISTS `upload_infor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `upload_date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `viewer_group` char(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `upload_infor`
--

INSERT INTO `upload_infor` (`id`, `user_id`, `upload_date`, `description`, `viewer_group`, `name`) VALUES
(7, 3, '2012-05-01', '', 'Public', ''),
(6, 3, '2012-05-01', '', '', ''),
(8, 3, '2012-06-04', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT '../images/profile/default_profile.png',
  `password` varchar(128) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `is_super_admin` tinyint(1) DEFAULT '0',
  `discoverable` tinyint(4) NOT NULL DEFAULT '1',
  `owner_path` char(30) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `profile_count` int(11) NOT NULL,
  `member_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_address` (`email_address`),
  UNIQUE KEY `owner_path` (`owner_path`),
  UNIQUE KEY `username` (`username`),
  KEY `is_active_idx_idx` (`is_active`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email_address`, `username`, `profile_picture`, `password`, `is_active`, `is_super_admin`, `discoverable`, `owner_path`, `last_activity`, `profile_count`, `member_date`) VALUES
(3, 'raymond', 'huang', 'raymondlwhuang@yahoo.com', '', '../images/profile/raymond3/M1190018.JPG', 'bf820460b2badaed9dcd79e4853edca1', 6, 0, 0, 'raymond3', '2012-06-12 02:30:23', 1, '0000-00-00 00:00:00'),
(4, 'Lie Wen', 'Huang', 'raymondlwhuang@gmail.com', 'raymondlwhuang', '../images/profile/default_profile.png', 'bf820460b2badaed9dcd79e4853edca1', 1, 0, 0, 'testing4', '2012-05-27 14:14:34', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_browser`
--

CREATE TABLE IF NOT EXISTS `user_browser` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `browser` varchar(30) NOT NULL,
  `activity_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_browser`
--

INSERT INTO `user_browser` (`id`, `user_id`, `browser`, `activity_date`) VALUES
(2, 3, 'Google Chrome', '2012-03-22'),
(4, 3, 'Internet Explorer', '2012-03-22'),
(5, 4, 'Mozilla Firefox', '2012-03-22'),
(6, 3, 'Opera', '2012-03-22'),
(7, 3, 'Mozilla Firefox', '2012-03-25'),
(8, 3, 'Apple Safari', '2012-03-25'),
(9, 4, 'Google Chrome', '2012-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `user_location`
--

CREATE TABLE IF NOT EXISTS `user_location` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `ip_address` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `region` varchar(30) NOT NULL,
  `activity_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_location`
--

INSERT INTO `user_location` (`id`, `user_id`, `ip_address`, `city`, `region`, `activity_date`) VALUES
(1, 4, '123.456.789', 'markham', 'ontario', '2012-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `user_os`
--

CREATE TABLE IF NOT EXISTS `user_os` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `os` varchar(15) NOT NULL,
  `activity_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_os`
--

INSERT INTO `user_os` (`id`, `user_id`, `os`, `activity_date`) VALUES
(1, 4, 'Windows NT 4.0', '2012-03-21'),
(2, 3, 'Windows NT 4.0', '2012-03-22'),
(3, 3, 'Windows Vista', '2012-03-25'),
(4, 3, 'Linux', '2012-03-25'),
(5, 4, 'Windows Vista', '2012-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `user_plugin`
--

CREATE TABLE IF NOT EXISTS `user_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `plugin_name` varchar(30) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_screen`
--

CREATE TABLE IF NOT EXISTS `user_screen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `screen_width` int(11) NOT NULL,
  `screen_height` int(11) NOT NULL,
  `screen_availWidth` int(11) NOT NULL,
  `screen_availHeight` int(11) NOT NULL,
  `screen_colorDepth` int(11) NOT NULL,
  `screen_pixelDepth` int(11) NOT NULL,
  `activity_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `user_screen`
--

INSERT INTO `user_screen` (`id`, `user_id`, `screen_width`, `screen_height`, `screen_availWidth`, `screen_availHeight`, `screen_colorDepth`, `screen_pixelDepth`, `activity_date`) VALUES
(1, 4, 1920, 1080, 1920, 1040, 24, 24, '2012-03-21'),
(2, 3, 1920, 1080, 1920, 1040, 32, 32, '2012-03-22'),
(3, 3, 1920, 1080, 1920, 1040, 24, 24, '2012-03-22'),
(4, 3, 1280, 1024, 1280, 994, 24, 24, '2012-03-25'),
(5, 3, 1001, 601, 1001, 601, 32, 32, '2012-03-25'),
(6, 3, 1001, 448, 1001, 448, 32, 32, '2012-03-25'),
(7, 3, 1001, 449, 1001, 449, 32, 32, '2012-03-26'),
(8, 3, 1250, 559, 1250, 559, 32, 32, '2012-03-27'),
(9, 3, 1250, 606, 1250, 606, 32, 32, '2012-03-28'),
(10, 3, 1920, 1080, 1920, 1080, 32, 32, '2012-03-28'),
(11, 3, 1250, 558, 1250, 558, 32, 32, '2012-03-28'),
(12, 3, 1250, 5684, 1250, 5684, 32, 32, '2012-03-29'),
(13, 4, 1280, 1024, 1280, 994, 32, 32, '2012-04-01'),
(14, 3, 1280, 1024, 1280, 994, 32, 32, '2012-04-01'),
(15, 3, 1250, 1639, 1250, 1639, 32, 32, '2012-04-03'),
(16, 3, 1250, 586, 1250, 586, 32, 32, '2012-04-03'),
(17, 3, 3714, 11587, 3714, 11587, 32, 32, '2012-04-05'),
(18, 3, 1001, 469, 1001, 469, 32, 32, '2012-04-05'),
(19, 3, 1250, 583, 1250, 583, 32, 32, '2012-04-05'),
(20, 3, 1261, 564, 1261, 564, 32, 32, '2012-04-05'),
(21, 3, 0, 0, 0, 0, 32, 32, '2012-04-05'),
(22, 3, 1250, 561, 1250, 561, 32, 32, '2012-04-07'),
(23, 3, 1453, 650, 1453, 650, 32, 32, '2012-04-08'),
(24, 3, 1250, 2763, 1250, 2763, 32, 32, '2012-04-09'),
(25, 3, 480, 800, 480, 800, 32, 32, '2012-04-10'),
(26, 3, 800, 480, 800, 480, 32, 32, '2012-04-11'),
(27, 4, 1280, 1024, 1280, 994, 24, 24, '2012-04-11'),
(28, 4, 1920, 1080, 1920, 1080, 24, 24, '2012-05-25');

-- --------------------------------------------------------

--
-- Table structure for table `viewer_group`
--

CREATE TABLE IF NOT EXISTS `viewer_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `owner_path` char(30) NOT NULL,
  `viewer_group` char(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `viewer_group`
--

INSERT INTO `viewer_group` (`id`, `user_id`, `owner_path`, `viewer_group`) VALUES
(1, 3, 'raymond3', 'Friend'),
(2, 4, 'testing4', 'Friend');

-- --------------------------------------------------------

--
-- Table structure for table `view_permission`
--

CREATE TABLE IF NOT EXISTS `view_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `viewer_id` bigint(20) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `owner_path` char(30) NOT NULL,
  `viewer_group` char(30) NOT NULL,
  `viewer_email` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-unchatable,1-chatable,3-chat to, ',
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `share_flag` tinyint(4) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `owner_email` (`owner_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `view_permission`
--

INSERT INTO `view_permission` (`id`, `user_id`, `viewer_id`, `owner_email`, `owner_path`, `viewer_group`, `viewer_email`, `is_active`, `first_name`, `last_name`, `share_flag`) VALUES
(1, 3, 0, 'raymondlwhuang@yahoo.com', 'raymond3', '', 'raymondlwhuang@gmail.com', 1, 'lie', 'wen', 2),
(2, 3, 0, 'raymondlwhuang@yahoo.com', 'raymond3', 'Friend', 'raymondlwhuang@gmail.com', 1, 'lie', 'wen', 2),
(3, 4, 0, 'raymondlwhuang@gmail.com', 'testing4', '', 'raymondlwhuang@yahoo.com', 1, 'raymond', 'huang', 2),
(4, 4, 0, 'raymondlwhuang@gmail.com', 'testing4', 'Friend', 'raymondlwhuang@yahoo.com', 1, 'raymond', 'huang', 2);

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE IF NOT EXISTS `visitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visitdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visitcount` int(11) NOT NULL,
  `ip` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `os` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `region` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `country` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `postal_code` varchar(30) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=40 ;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id`, `visitdate`, `visitcount`, `ip`, `os`, `city`, `region`, `country`, `postal_code`) VALUES
(37, '2011-10-16 04:00:00', 1, '70.51.153.198', 'Windows Vista', 'Markham', 'ON', 'Canada', ''),
(38, '2011-10-24 04:00:00', 3, '70.51.207.28', 'Windows Vista', 'Ottawa', 'ON', 'Canada', 'k1p5m7'),
(39, '2011-11-03 02:47:12', 1, '70.51.154.21', 'Windows Vista', 'Markham', 'ON', 'Canada', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
