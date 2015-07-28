-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2015 at 09:11 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company` int(10) NOT NULL,
  `img` varchar(200) NOT NULL,
  `url` varchar(250) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `company`, `img`, `url`, `status`) VALUES
(1, 1, '1.png', '', '1'),
(2, 2, '2.png', '', '1'),
(3, 3, '3.png', '', '1'),
(4, 4, '4.png', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `when` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `where` varchar(100) NOT NULL,
  `cost` varchar(10) NOT NULL,
  `expired` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `name`, `duration`, `when`, `time`, `where`, `cost`, `expired`) VALUES
(1, 'VTS', 'Vacuum Technology', '2 days (Tues - Wed)', '2014-07-01', '8:50am to 5:00pm', 'University of NSW\r\nSydney, NSW', '480', '0'),
(2, 'VVA', 'Test Course of Vacuum Technology', '1 week', '2015-05-06', '9:00am - 1:00pm', 'Victoria University, Footscray', '1500', '1');

-- --------------------------------------------------------

--
-- Table structure for table `executives`
--

CREATE TABLE IF NOT EXISTS `executives` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `organization` varchar(150) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `executives`
--

INSERT INTO `executives` (`id`, `organization`, `name`, `position`, `telephone`, `email`) VALUES
(1, 'Australian Nuclear Science and Technology Organisation, NSW', 'Dr Anton Stampfl', 'President', '0439 130 430', 'anton.stampfl@gmail.com'),
(2, 'Eng & Science, VU, VIC', 'Dr Jakub Szajman', 'Past-President', '(03) 9919 4286', 'jakub.szajman@vu.edu.au');

-- --------------------------------------------------------

--
-- Table structure for table `membership_types`
--

CREATE TABLE IF NOT EXISTS `membership_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `membership` varchar(30) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `membership_types`
--

INSERT INTO `membership_types` (`id`, `membership`, `price`) VALUES
(1, 'Student', 10),
(2, 'General', 25),
(3, 'Corporate', 250);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `body` longtext NOT NULL,
  `posted_by` varchar(80) NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `body`, `posted_by`, `date`) VALUES
(1, 'VSA Committee 2015', '<p><ins>Dr Anton Stampfl</ins>&nbsp;was elected President of the VSA at the recent AGM. Anton is keen for the society to bring to the attention of research, academic and technical&nbsp;staff, the resources and relevance of the VSA for those engaged in scientific fields represented &nbsp;within IUVSTA. These include&nbsp;the following:</p>\n\n<ul>\n	<li><strong>Applied Surface Science</strong></li>\n	<li><strong>Electronic Materials</strong></li>\n	<li><strong>Nanometer Structures</strong></li>\n	<li><strong>Plasma Science</strong></li>\n	<li><strong>Surface Science</strong></li>\n	<li><strong>Thin Films&nbsp;</strong>&nbsp;</li>\n</ul>\n\n<p>Also&nbsp;Dr Karyn Jarvis&nbsp;(<em>Secretary)</em>&nbsp;and&nbsp;Prof Bruce King&nbsp;(<em>Membership Secretary)</em>have taken up executive positions for 2015. The full 2015 committee members are listed under the&nbsp;<strong><a href="http://www.vacuumsociety.org.au/executive.php">Executive</a></strong>&nbsp;site heading.</p>\n', '1', '1429695588'),
(2, 'Vlll Southern Cross Conference Series:', '<p>Multiwavelength dissection of galaxies. Sydney,NSW\nhttp://www.aao.gov.au/conference/multiwavelength-dissection-of-galaxies</p>', '1', '1429695588'),
(29, '\\"Testing Quotes\\". I\\''m also testing Slashes/Back Slashes\\\\', '<p>Quotes and slashes now work with form elements. Both for inputs and outputs.</p>\n', '1', '1429695588'),
(33, 'Dates', '<p>Dates are now saved along with each news article. It&#39;s saved as a unix timestamp and is converted into a date formart using the PHP Date object.</p>\n', '1', '1429695588'),
(36, 'Lorem Ipsum', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy</p>\n\n<p>text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently</p>\n\n<p>with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\n\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\n\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n', '1', '1430473391');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE IF NOT EXISTS `sponsors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company` varchar(150) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `title` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `company`, `fname`, `lname`, `phone`, `fax`, `email`, `website`, `title`) VALUES
(1, 'AVT Services P/L', 'Kevin', 'Armstrong', '(02) 9674 6711', '(02) 9674 7358', 'armstrong@avtservices.com.au', 'http://www.avtservices.com.au', 'Mr'),
(2, 'Cryoquip Australia P/L', 'Russell', 'Peters', '(03) 9791 7888', '(03) 9769 2788', 'rpeters@cryoquip.com.au', 'http://www.cryoquip.com.au', 'Mr'),
(3, 'Dynapumps', 'Jim', 'Ellery', '(08) 9424 2011', '(08) 9424 2001', 'jim@dynapumps.com.au', 'http://www.dynapumps.com.au', 'Mr'),
(4, 'Ezzi Vision', 'Adil', 'Adamjee', '(03) 9727 0770', '(03) 8610 1928', 'adil.adamjee@ezzivision.com.au', 'http://www.ezzivision.com.au', 'Dr');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `title` varchar(6) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `address` varchar(80) NOT NULL,
  `suburb` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postcode` int(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `blocked` enum('0','1') NOT NULL,
  `type` enum('1','2','3') NOT NULL,
  `active` enum('0','1') NOT NULL,
  `level` enum('1','2') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `title`, `fname`, `lname`, `address`, `suburb`, `state`, `postcode`, `country`, `telephone`, `blocked`, `type`, `active`, `level`) VALUES
(1, 'Admin', '$2y$10$bFuRjITql6OcmFUZ9XTdQO6QPFdQVHsX/GbL5lpuvjl.WNFxY88Nm', 'admin@vsa.org.au', 'Dr', 'Jakub', 'Szajman', '44 Reed St', 'Taylors Lakes', 'Victoria', 3025, 'Australia', '0458745632', '0', '2', '1', '1'),
(2, 'Kiark', '$2y$10$bFuRjITql6OcmFUZ9XTdQO6QPFdQVHsX/GbL5lpuvjl.WNFxY88Nm', 'lil_memi@hotmail.com', 'Mr', 'Mehmet', 'Uyanik', '19 Colston drive', 'Hillside', 'Victoria', 3037, 'Australia', '+61404366893', '1', '1', '0', '2'),
(5, 'Mehmet', '$2y$10$pjI6.m3Yuv46Bwh8MT58beeBF3x/7O4YBBM2EtzdruEdxTAV7yMXW', 'asd@asd.asd', 'Mr', 'Mehmet', 'Uyanik', '19 Colston drive', 'Melbourne', 'VIC', 3037, 'Australia', '+61404366893', '0', '3', '1', '1'),
(6, 'Bob', '$2y$10$Pf.BO3jGtqybdeiAYn2bo.P9DnD4WgHplfx0IoY8f/2l6qAYF8vYK', 'bobsmith@gmail.com', 'E/Prof', 'Bob', 'Smith', '65 Tree Road', 'Friland', 'Victoria', 3456, 'Australia', '93654123', '0', '1', '1', '2'),
(7, 'Mem', '$2y$10$AEiKMbUUiti9dmC4BRFvAuPRYLCo43saSHwiDn/ySHPZ/.o.MU5R2', 'mehmet.uyanik@live.com.au', 'Mr', 'Mehmet', 'Uyanik', '19 Colston drive', 'Melbourne', 'VIC', 3037, 'Australia', '+61404366893', '0', '2', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `welcome_message`
--

CREATE TABLE IF NOT EXISTS `welcome_message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `welcome_message`
--

INSERT INTO `welcome_message` (`id`, `body`) VALUES
(1, '<h1>Welcome</h1>\r\n\r\n<p>The<strong> </strong><strong>Vacuum Society of Australia</strong> (VSA) is a not-for-profit organization dedicated to the advancement of vacuum science relating to vacuum technology, materials, surfaces, interfaces, thin films and plasmas and to providing a variety of educational opportunities.&nbsp;Please check our <a href="http://localhost/vsoa/news">news</a>&nbsp;page&nbsp;for latest information.</p>\r\n\r\n<p>The Society welcomes participation from all its members, and encourages student involvement. It is the Australian body representing IUVSTA (International Union for Vacuum Science, Technique and Applications).</p>\r\n\r\n<p>The VSA publishes the Newsletter &quot;OZVAC&quot; which includes scientific and technical articles, product information from manufacturers as well as a &#39;For Sale/Wanted section&#39; and other possibilities for those in the field of Vacuum Science to Network and communicate.Membership is open to all interested parties and discounts for Student membership available.</p>\r\n\r\n<p>VSA runs a number of Vacuum Technology <a href="http://localhost/vsoa/courses">short courses</a>. The courses are suitable for researchers, technicians and engineers. Vacuum Technology courses cover the fundamental theory, practical knowledge and computer laboratories simulating real vacuum systems. Comprehensive notes are provided. Click on the image to test your practical knowledge of a diffusion pump system.</p>\r\n');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
