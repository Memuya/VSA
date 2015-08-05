-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2015 at 09:47 PM
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
  `user_id` int(10) NOT NULL,
  `img_ext` varchar(5) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `user_id`, `img_ext`, `status`) VALUES
(28, 16, 'png', '1'),
(30, 1, 'png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(20) NOT NULL,
  `location` varchar(100) NOT NULL,
  `cost` varchar(10) NOT NULL,
  `expired` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `name`, `duration`, `date`, `time`, `location`, `cost`, `expired`) VALUES
(1, 'VTS', 'Vacuum Technology', '2 days (Tues - Wed)', '2014-07-01', '8:50am to 5:00pm', 'University of NSW - Sydney, NSW', '480', '1'),
(2, 'VVA', 'Vacuum in Space', '1 week', '2015-05-06', '9:00am - 1:00pm', 'Victoria University, Footscray', '1500', '0');

-- --------------------------------------------------------

--
-- Table structure for table `enrolments`
--

CREATE TABLE IF NOT EXISTS `enrolments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `executives`
--

CREATE TABLE IF NOT EXISTS `executives` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `organization` varchar(150) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `title` varchar(6) NOT NULL,
  `lname` varchar(10) NOT NULL,
  `position` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `executives`
--

INSERT INTO `executives` (`id`, `organization`, `fname`, `title`, `lname`, `position`, `telephone`, `email`) VALUES
(1, 'Australian Nuclear Science and Technology Organisation, NSW', 'Anton', 'Dr', 'Stampfl', 'President', '0439 130 430', 'anton.stampfl@gmail.com'),
(2, 'Eng & Science, VU, VIC', 'Jakub', 'Dr', 'Szajman', 'Past-President', '(03) 9919 4286', 'jakub.szajman@vu.edu.au'),
(5, 'ANSTO, NSW', 'Karyn', 'Dr', 'Jarvis', 'Secretary', '(02) 9717 3458', 'karynj@ansto.gov.au'),
(6, 'Vacuum Society of Australia, NSW', 'Anthony', 'Dr', 'Simpson', 'Treasurer', '(02) 4822 4680', 'beony13@northnet.com.au'),
(7, 'Newcastle University, NSW', 'Bruce', 'Prof', 'King', 'Membership Secretary', '(02) 4921 5448', 'bruce.king@newcastle.edu.au'),
(8, 'Stanton Scientific, NSW', 'Will', 'Mr', 'Stanton', 'Editor', '(02) 6685 6902', 'bill@stantonscientific.com'),
(9, 'AVT Services P/L, NSW', 'Kevin', 'Mr', 'Armstrong', 'Committee', '(02) 9674 6711', 'armstrong@avtservices.com.au'),
(10, 'ANU, ACT', 'Rod', 'Prof', 'Boswell', 'Committee', '(02) 6125 3442', 'rod.boswell@anu.edu.au'),
(11, 'BASF, Chemistry, UQ, QLD', 'Barry', 'Dr', 'Wood', 'Committee', '(07) 3365 3722', 'b.wood@chemistry.uq.edu.au'),
(12, 'Vacuum Society of Australia, VIC', 'Kevin', 'Mr', 'Lawlor', 'Committee', '(03) 9842 4902', 'kevin.lawlor@bigpond.com');

-- --------------------------------------------------------

--
-- Table structure for table `membership_types`
--

CREATE TABLE IF NOT EXISTS `membership_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `membership` varchar(30) NOT NULL,
  `price` double NOT NULL,
  `course_discount` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `membership_types`
--

INSERT INTO `membership_types` (`id`, `membership`, `price`, `course_discount`) VALUES
(1, 'Student', 10, 10),
(2, 'General', 25, 10),
(3, 'Corporate', 250, 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `body`, `posted_by`, `date`) VALUES
(2, 'Vlll Southern Cross Conference Series:', '<p>Multiwavelength dissection of galaxies. Sydney,NSW\nhttp://www.aao.gov.au/conference/multiwavelength-dissection-of-galaxies</p>', '1', '1429695588'),
(29, '"Testing Quotes". I''m also testing Slashes/Back Slashes\\', '<p>Quotes and slashes now work with form elements. Both for inputs and outputs.</p>\n', '1', '1429695588'),
(33, 'Dates', '<p>Dates are now saved along with each news article. It&#39;s saved as a unix timestamp and is converted into a date formart using the PHP Date object.</p>\n', '1', '1429695588');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE IF NOT EXISTS `privacy_policy` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `body`, `date`) VALUES
(1, '<p>Vacuum Society of Australia (VSA) respects your privacy and is committed to protecting the personal information that identifies you or could identify you. Personal information collected by the VSA (also referred as &ldquo;we&rdquo;, &ldquo;our&rdquo;, &ldquo;us&rdquo; and &ldquo;site&rdquo;) is used in accordance with its obligations under the&nbsp;<a href="http://www.austlii.edu.au/au/legis/cth/consol_act/pa1988108/">Australian Commonwealth Government Privacy Act 1988</a>.</p>\r\n\r\n<p>There may be links from the Site to other websites. This privacy policy only applies to this Site and not to any other website including websites linked from this Site. Accessing those third party websites or sources requires you to leave the Site.</p>\r\n\r\n<h2>Why do we collect personal information?</h2>\r\n\r\n<p>We collect personal information about our Members to conduct our activities and meet legal obligations of society incorporated in state of Victoria.</p>\r\n\r\n<h2>What we collect?</h2>\r\n\r\n<p>We may collect the following information:</p>\r\n\r\n<ul>\r\n	<li>your title/salutation and name;</li>\r\n	<li>your address;</li>\r\n	<li>your email address;</li>\r\n	<li>your phone/fax numbers.</li>\r\n</ul>\r\n\r\n<h2>What we do with your personal information?</h2>\r\n\r\n<p>We will not sell or rent it to a third party without your permission. The personal information that you provide will be available to VSA to provide you with a better service and the following reasons:</p>\r\n\r\n<ul>\r\n	<li>Membership registration and to send you newsletters.</li>\r\n	<li>Conduct VSA short courses</li>\r\n	<li>Process enquiries received via the VSA Site</li>\r\n	<li>Internal record keeping.</li>\r\n	<li>We may periodically send emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.</li>\r\n	<li>From time to time, we may also use your information to contact you regarding Society business such as a notice of General Meeting, conferences and other professional activities. We may contact you by email, phone, fax or mail</li>\r\n</ul>\r\n\r\n<p>We may also disclose your personal information if it is required or authorised by law or where disclosure is necessary to prevent a threat to life, health or safety.</p>\r\n\r\n<h2>Do we use cookies?</h2>\r\n\r\n<p>We use Session cookies to allow Member pages browsing. Session cookie is normally destroyed when VSA Member closes browser. This site does not use persistent cookies or tracking software.</p>\r\n\r\n<h2>How do we protect your personal information?</h2>\r\n\r\n<p>VSA implements a variety of security measures to protect personal information we hold from misuse and loss.</p>\r\n\r\n<p>To help protect your privacy, be sure:</p>\r\n\r\n<ul>\r\n	<li>not to share your user ID or password with anyone else;</li>\r\n	<li>to log off the Site when you are finished;</li>\r\n	<li>to use secure Internet connections;</li>\r\n</ul>\r\n\r\n<h2>How to update your personal information?</h2>\r\n\r\n<p>To correct or update your personal information, login with your password and click &lsquo;myAccout&rsquo; link. Under Member Preferences heading, select &lsquo;Change login/password and personal details&rsquo;. Modify your personal information and submit form by pressing &lsquo;Update&rsquo; button. If you are unable to login please please inform us of the changes using the &lsquo;Contact Us&rsquo; link on our Site.</p>\r\n\r\n<h2>Changes to this privacy policy</h2>\r\n\r\n<p>We may change this policy from time to time by updating this page. You should check this page from time to time.</p>\r\n\r\n<h2>Privacy Queries</h2>\r\n\r\n<p>If you have any questions regarding this policy contact us using using the &lsquo;Contact Us&rsquo; link on our Site.</p>\r\n', '1432020730');

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
  `fax` varchar(20) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `company` varchar(150) DEFAULT NULL,
  `blocked` enum('0','1') NOT NULL,
  `type` enum('1','2','3') NOT NULL,
  `active` enum('0','1') NOT NULL,
  `level` enum('1','2') NOT NULL,
  `password_reset` enum('0','1') NOT NULL,
  `reset_code` varchar(100) NOT NULL,
  `payment_made` enum('0','1') NOT NULL,
  `date_created` varchar(100) NOT NULL,
  `payment_due_date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `title`, `fname`, `lname`, `address`, `suburb`, `state`, `postcode`, `country`, `telephone`, `fax`, `website`, `company`, `blocked`, `type`, `active`, `level`, `password_reset`, `reset_code`, `payment_made`, `date_created`, `payment_due_date`) VALUES
(1, 'Admin', '$2y$10$Yv9DyrR0Z/ThL.iqFofDZuNVf1tL2.VDCkzxqf.VWmUYOYoTykdBS', 'jakub.szajman@vu.edu.au', 'Mr', 'Jakub', 'Szajman', '65 Tree Road', 'Footscray', 'Victoria', 3037, 'Australia', '(03) 9919 4286', '(03) 9919 4286', 'http://www.vicuni.com.au', 'Vic Uni', '0', '3', '1', '1', '0', '', '1', '0', '1438587031'),
(2, 'Kiark', '$2y$10$AeChCOu5T61XXo9SsLn0ieZKeade5r4OhP09vClaJ01Vilia8BVV2', 'lil_memi@hotmail.com', 'Mr', 'Mehmet', 'Uyanik', '19 Colston drive', 'Hillside', 'Victoria', 3037, 'Australia', '+61404366893', NULL, NULL, NULL, '0', '2', '0', '2', '0', '', '1', '0', '1438587031'),
(5, 'Mehmet', '$2y$10$9BM47dMJyBy77ujqXYGbT.UWsjGUlrp2EiLjRBxHy/5f7qvbQSzS6', 'asd@asd.asd', 'Mr', 'Mehmet', 'Uyanik', '19 Colston drive', 'Melbourne', 'VIC', 3037, 'Australia', '+61404366893', '61404366893', 'http://www.anotherone.com', 'Another One', '0', '3', '1', '2', '0', '', '1', '0', '1438587031'),
(6, 'Bob', '$2y$10$5/1.9Hob1hGAL1292vWOTOQmfonf2w6/tPQZs/ZFBJNCjoTNZQNKG', 'bobsmith@gmail.com', 'E/Prof', 'Bob', 'Smith', '65 Tree Road', 'Friland', 'Victoria', 3456, 'Australia', '93654123', NULL, NULL, NULL, '0', '1', '1', '2', '0', '', '1', '0', '1438587031'),
(7, 'Mem', '$2y$10$AEiKMbUUiti9dmC4BRFvAuPRYLCo43saSHwiDn/ySHPZ/.o.MU5R2', 'mehmet.uyanik@live.com.au', 'Mr', 'Mehmet', 'Uyanik', '19 Colston drive', 'Melbourne', 'VIC', 3037, 'Australia', '+61404366893', NULL, NULL, NULL, '0', '2', '1', '2', '0', '', '1', '0', '1438587031'),
(8, 'Alex', '$2y$10$SZyKdg00fudzRi4CCc1m5O1s.3BH/bOAmGjKXllwDkrlarqVS5r5.', 'alex@hotmail.com', 'Ms', 'Alex', 'Maxitanis', '64 Bellevue Bvd', 'Hillside', 'Victoria', 3037, 'Australia', '0412547896', NULL, NULL, NULL, '0', '1', '1', '2', '0', '', '1', '0', '1438587031'),
(9, 'Rocky', '$2y$10$QTUNnW8PtphnaTVJFk6xI.IVHQAgwjZYK0yzIraOshCYktZGID3x2', 'rocky@hotmail.com', 'Mr', 'Rocky', 'Calfa', '11 Hillside crt', 'Hillside', 'Victoria', 3037, 'Australia', '0456874398', NULL, NULL, NULL, '0', '2', '1', '2', '0', '', '1', '0', '1438587031');

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
(1, '<h1>Welcome</h1>\n\n<p>The&nbsp;<strong>Vacuum Society of Australia</strong> (VSA) is a not-for-profit organization dedicated to the advancement of vacuum science relating to vacuum technology, materials, surfaces, interfaces, thin films and plasmas and to providing a variety of educational opportunities.&nbsp;Please check our <a href="http://localhost/vsa/news">news</a>&nbsp;page&nbsp;for latest information.</p>\n\n<p>The Society welcomes participation from all its members, and encourages student involvement. It is the Australian body representing IUVSTA (International Union for Vacuum Science, Technique and Applications).</p>\n\n<p>The VSA publishes the Newsletter &quot;OZVAC&quot; which includes scientific and technical articles, product information from manufacturers as well as a &#39;For Sale/Wanted section&#39; and other possibilities for those in the field of Vacuum Science to Network and communicate.Membership is open to all interested parties and discounts for Student membership available.</p>\n\n<p>VSA runs a number of Vacuum Technology <a href="http://localhost/vsa/courses">short courses</a>. The courses are suitable for researchers, technicians and engineers. Vacuum Technology courses cover the fundamental theory, practical knowledge and computer laboratories simulating real vacuum systems. Comprehensive notes are provided. Click on the image to test your practical knowledge of a diffusion pump system.</p>\n');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
