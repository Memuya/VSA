-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2015 at 09:27 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `user_id`, `img_ext`, `status`) VALUES
(38, 16, 'png', '1'),
(39, 1, 'jpg', '1'),
(40, 5, 'png', '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `name`, `duration`, `date`, `time`, `location`, `cost`, `expired`) VALUES
(1, 'VTS', 'Vacuum Technology', '2 days (Tues - Wed)', '2014-07-01', '8:50am - 5:00pm', 'University of NSW - Sydney, NSW', '480', '1'),
(2, 'VVA', 'Vacuum in Space', '1 week', '2015-05-06', '9:00am - 1:00pm', 'Victoria University, Footscray', '1500', '0'),
(3, 'ATC', 'Advance Vacuum Science', '1 Month', '2016-08-21', '9am - 1pm', 'Deakin University', '2750', '0');

-- --------------------------------------------------------

--
-- Table structure for table `enrolments`
--

CREATE TABLE IF NOT EXISTS `enrolments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `payment_required` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `enrolments`
--

INSERT INTO `enrolments` (`id`, `user_id`, `course_id`, `status`, `payment_required`) VALUES
(1, 1, 2, '1', ''),
(7, 6, 2, '1', ''),
(8, 1, 1, '0', ''),
(10, 5, 2, '1', ''),
(11, 7, 2, '1', ''),
(13, 25, 2, '1', ''),
(14, 24, 2, '1', ''),
(22, 29, 2, '0', ''),
(23, 30, 2, '0', ''),
(26, 29, 3, '0', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `membership_types`
--

INSERT INTO `membership_types` (`id`, `membership`, `price`, `course_discount`) VALUES
(1, 'Student', 10, 10),
(2, 'General', 25, 10),
(3, 'Corporate', 250, 10),
(4, 'Course', 0, 0);

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
(2, 'Shorter Article', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id nunc libero. Sed ac orci vitae magna imperdiet porta id sit amet ante. Nullam tempor malesuada arcu ac tincidunt. Fusce sed dui ut justo iaculis pellentesque nec sed velit. Sed aliquam erat arcu, in interdum massa feugiat at. Nullam id iaculis mauris. Donec iaculis auctor velit, quis egestas justo cursus vel. Etiam blandit ligula tortor, dapibus malesuada urna vestibulum sit amet.</p>\n\n<p>Sed semper aliquet tortor, et porttitor orci tincidunt ut. Nullam gravida, nibh eu euismod semper, sem mauris sollicitudin dolor, vitae fermentum neque purus at ex. Pellentesque porttitor magna orci, sit amet dictum urna egestas non. Nunc ac viverra arcu, ac pellentesque leo. Praesent eu tempus purus. Phasellus ipsum enim, fringilla eu porttitor non, euismod at quam. Mauris vehicula posuere risus, eu varius magna efficitur vitae. Nam elementum et massa vitae molestie. Proin at turpis volutpat, dignissim velit ac, dignissim eros. Nulla commodo purus lorem, sed accumsan nisi faucibus at. Proin ac congue sapien.</p>\n', '1', '1429695588'),
(29, 'Long News Article', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed purus magna, tincidunt ac faucibus eget, fringilla a dolor. Donec sit amet purus et ante volutpat feugiat. Nulla auctor, leo tincidunt tincidunt condimentum, elit sapien dapibus lorem, sit amet hendrerit risus velit nec urna. In vel lectus ultrices, euismod tortor nec, sodales augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam dui tellus, faucibus et dolor vel, rutrum dictum mauris. Curabitur molestie rutrum justo eget pharetra. Aliquam iaculis, massa vel congue aliquet, nulla tortor fermentum diam, vestibulum viverra sapien justo at velit. Nam at velit et enim gravida gravida gravida a nisl. Donec in justo a nisl pulvinar consequat vitae et justo. Ut dapibus pellentesque risus eu fringilla. Proin a tellus cursus mi venenatis imperdiet placerat quis sapien. Donec tincidunt elementum nibh nec varius.</p>\n\n<p>Integer lobortis, lorem ut interdum posuere, turpis eros tincidunt ante, quis mollis justo tellus eget ligula. Nulla hendrerit urna nec elit rutrum ullamcorper. Sed dapibus lorem et erat dignissim, pharetra blandit turpis porta. Duis pretium tincidunt est ut fringilla. Praesent metus ipsum, lobortis non tellus rutrum, pulvinar tincidunt purus. Morbi posuere velit lorem, ac consectetur magna dignissim sit amet. Ut dictum pretium turpis, commodo dictum nisi feugiat id. Maecenas sed commodo diam, vel dignissim leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut ligula tellus, dapibus quis auctor non, suscipit sed enim. Etiam sit amet laoreet tellus. Nam id urna euismod, efficitur nunc vel, viverra mi. Morbi id nunc egestas, blandit arcu a, molestie libero. Donec varius ullamcorper dolor ultricies feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec semper urna et faucibus vulputate.</p>\n\n<p>Etiam accumsan nunc vel egestas dapibus. Integer ultricies eu velit sed pretium. Proin ornare in mi eget sollicitudin. Nullam non varius leo. Phasellus vitae magna pellentesque, aliquet turpis eget, iaculis sapien. Curabitur velit erat, semper sed consectetur ut, faucibus sed augue. Morbi consequat eu tortor ac porttitor. Curabitur a erat est. Quisque facilisis a sapien id dictum. Donec iaculis eget ligula sed interdum.</p>\n\n<p>Phasellus vel sem vel ipsum pretium imperdiet. Integer tincidunt tortor id varius euismod. Ut ultricies vestibulum semper. Vestibulum non cursus magna. Nunc odio erat, convallis ut urna sed, interdum commodo nunc. Cras ullamcorper turpis dui, quis dapibus leo pharetra sed. Duis tincidunt eleifend velit, et tempus mauris finibus nec. Fusce pharetra est eget est accumsan faucibus. Curabitur mollis tortor suscipit, aliquet mauris ac, fermentum enim.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed purus magna, tincidunt ac faucibus eget, fringilla a dolor. Donec sit amet purus et ante volutpat feugiat. Nulla auctor, leo tincidunt tincidunt condimentum, elit sapien dapibus lorem, sit amet hendrerit risus velit nec urna. In vel lectus ultrices, euismod tortor nec, sodales augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam dui tellus, faucibus et dolor vel, rutrum dictum mauris. Curabitur molestie rutrum justo eget pharetra. Aliquam iaculis, massa vel congue aliquet, nulla tortor fermentum diam, vestibulum viverra sapien justo at velit. Nam at velit et enim gravida gravida gravida a nisl. Donec in justo a nisl pulvinar consequat vitae et justo. Ut dapibus pellentesque risus eu fringilla. Proin a tellus cursus mi venenatis imperdiet placerat quis sapien. Donec tincidunt elementum nibh nec varius.</p>\n\n<p>Integer lobortis, lorem ut interdum posuere, turpis eros tincidunt ante, quis mollis justo tellus eget ligula. Nulla hendrerit urna nec elit rutrum ullamcorper. Sed dapibus lorem et erat dignissim, pharetra blandit turpis porta. Duis pretium tincidunt est ut fringilla. Praesent metus ipsum, lobortis non tellus rutrum, pulvinar tincidunt purus. Morbi posuere velit lorem, ac consectetur magna dignissim sit amet. Ut dictum pretium turpis, commodo dictum nisi feugiat id. Maecenas sed commodo diam, vel dignissim leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut ligula tellus, dapibus quis auctor non, suscipit sed enim. Etiam sit amet laoreet tellus. Nam id urna euismod, efficitur nunc vel, viverra mi. Morbi id nunc egestas, blandit arcu a, molestie libero. Donec varius ullamcorper dolor ultricies feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec semper urna et faucibus vulputate.</p>\n\n<p>Etiam accumsan nunc vel egestas dapibus. Integer ultricies eu velit sed pretium. Proin ornare in mi eget sollicitudin. Nullam non varius leo. Phasellus vitae magna pellentesque, aliquet turpis eget, iaculis sapien. Curabitur velit erat, semper sed consectetur ut, faucibus sed augue. Morbi consequat eu tortor ac porttitor. Curabitur a erat est. Quisque facilisis a sapien id dictum. Donec iaculis eget ligula sed interdum.</p>\n\n<p>Phasellus vel sem vel ipsum pretium imperdiet. Integer tincidunt tortor id varius euismod. Ut ultricies vestibulum semper. Vestibulum non cursus magna. Nunc odio erat, convallis ut urna sed, interdum commodo nunc. Cras ullamcorper turpis dui, quis dapibus leo pharetra sed. Duis tincidunt eleifend velit, et tempus mauris finibus nec. Fusce pharetra est eget est accumsan faucibus. Curabitur mollis tortor suscipit, aliquet mauris ac, fermentum enim.</p>\n', '1', '1429695588'),
(33, 'News Article', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed purus magna, tincidunt ac faucibus eget, fringilla a dolor. Donec sit amet purus et ante volutpat feugiat. Nulla auctor, leo tincidunt tincidunt condimentum, elit sapien dapibus lorem, sit amet hendrerit risus velit nec urna. In vel lectus ultrices, euismod tortor nec, sodales augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam dui tellus, faucibus et dolor vel, rutrum dictum mauris. Curabitur molestie rutrum justo eget pharetra. Aliquam iaculis, massa vel congue aliquet, nulla tortor fermentum diam, vestibulum viverra sapien justo at velit. Nam at velit et enim gravida gravida gravida a nisl. Donec in justo a nisl pulvinar consequat vitae et justo. Ut dapibus pellentesque risus eu fringilla. Proin a tellus cursus mi venenatis imperdiet placerat quis sapien. Donec tincidunt elementum nibh nec varius.</p>\n\n<p>Integer lobortis, lorem ut interdum posuere, turpis eros tincidunt ante, quis mollis justo tellus eget ligula. Nulla hendrerit urna nec elit rutrum ullamcorper. Sed dapibus lorem et erat dignissim, pharetra blandit turpis porta. Duis pretium tincidunt est ut fringilla. Praesent metus ipsum, lobortis non tellus rutrum, pulvinar tincidunt purus. Morbi posuere velit lorem, ac consectetur magna dignissim sit amet. Ut dictum pretium turpis, commodo dictum nisi feugiat id. Maecenas sed commodo diam, vel dignissim leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut ligula tellus, dapibus quis auctor non, suscipit sed enim. Etiam sit amet laoreet tellus. Nam id urna euismod, efficitur nunc vel, viverra mi. Morbi id nunc egestas, blandit arcu a, molestie libero. Donec varius ullamcorper dolor ultricies feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec semper urna et faucibus vulputate.</p>\n\n<p>Etiam accumsan nunc vel egestas dapibus. Integer ultricies eu velit sed pretium. Proin ornare in mi eget sollicitudin. Nullam non varius leo. Phasellus vitae magna pellentesque, aliquet turpis eget, iaculis sapien. Curabitur velit erat, semper sed consectetur ut, faucibus sed augue. Morbi consequat eu tortor ac porttitor. Curabitur a erat est. Quisque facilisis a sapien id dictum. Donec iaculis eget ligula sed interdum.</p>\n\n<p>Phasellus vel sem vel ipsum pretium imperdiet. Integer tincidunt tortor id varius euismod. Ut ultricies vestibulum semper. Vestibulum non cursus magna. Nunc odio erat, convallis ut urna sed, interdum commodo nunc. Cras ullamcorper turpis dui, quis dapibus leo pharetra sed. Duis tincidunt eleifend velit, et tempus mauris finibus nec. Fusce pharetra est eget est accumsan faucibus. Curabitur mollis tortor suscipit, aliquet mauris ac, fermentum enim.</p>\n', '1', '1429695588');

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

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `title`, `date`) VALUES
(8, 'CarFacts History Report - VW Golf', '1433249342'),
(9, 'CCDA Guide Chapter 3', '1433249359'),
(12, 'SRS Sample', '1434517444');

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
(1, '<p>Vacuum Society of Australia (VSA) respects your privacy and is committed to protecting the personal information that identifies you or could identify you. Personal information collected by the VSA (also referred as &ldquo;we&rdquo;, &ldquo;our&rdquo;, &ldquo;us&rdquo; and &ldquo;site&rdquo;) is used in accordance with its obligations under the&nbsp;<a href="http://www.austlii.edu.au/au/legis/cth/consol_act/pa1988108/">Australian Commonwealth Government Privacy Act 1988</a>.</p>\r\n\r\n<p>There may be links from the Site to other websites. This privacy policy only applies to this Site and not to any other website including websites linked from this Site. Accessing those third party websites or sources requires you to leave the Site.</p>\r\n\r\n<h2>Why do we collect personal information?</h2>\r\n\r\n<p>We collect personal information about our Members to conduct our activities and meet legal obligations of society incorporated in state of Victoria.</p>\r\n\r\n<h2>What we collect?</h2>\r\n\r\n<p>We may collect the following information:</p>\r\n\r\n<ul>\r\n	<li>your title/salutation and name;</li>\r\n	<li>your address;</li>\r\n	<li>your email address;</li>\r\n	<li>your phone/fax numbers.</li>\r\n</ul>\r\n\r\n<h2>What we do with your personal information?</h2>\r\n\r\n<p>We will not sell or rent it to a third party without your permission. The personal information that you provide will be available to VSA to provide you with a better service and the following reasons:</p>\r\n\r\n<ul>\r\n	<li>Membership registration and to send you newsletters.</li>\r\n	<li>Conduct VSA short courses</li>\r\n	<li>Process enquiries received via the VSA Site</li>\r\n	<li>Internal record keeping.</li>\r\n	<li>We may periodically send emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.</li>\r\n	<li>From time to time, we may also use your information to contact you regarding Society business such as a notice of General Meeting, conferences and other professional activities. We may contact you by email, phone, fax or mail</li>\r\n</ul>\r\n\r\n<p>We may also disclose your personal information if it is required or authorised by law or where disclosure is necessary to prevent a threat to life, health or safety.</p>\r\n\r\n<h2>Do we use cookies?</h2>\r\n\r\n<p>We use Session cookies to allow Member pages browsing. Session cookie is normally destroyed when VSA Member closes browser. This site does not use persistent cookies or tracking software.</p>\r\n\r\n<h2>How do we protect your personal information?</h2>\r\n\r\n<p>VSA implements a variety of security measures to protect personal information we hold from misuse and loss.</p>\r\n\r\n<p>To help protect your privacy, be sure:</p>\r\n\r\n<ul>\r\n	<li>not to share your user ID or password with anyone else;</li>\r\n	<li>to log off the Site when you are finished;</li>\r\n	<li>to use secure Internet connections;</li>\r\n</ul>\r\n\r\n<h2>How to update your personal information?</h2>\r\n\r\n<p>To correct or update your personal information, login with your password and click &lsquo;myAccout&rsquo; link. Under Member Preferences heading, select &lsquo;Change login/password and personal details&rsquo;. Modify your personal information and submit form by pressing &lsquo;Update&rsquo; button. If you are unable to login please please inform us of the changes using the &lsquo;Contact Us&rsquo; link on our Site.</p>\r\n\r\n<h2>Changes to this privacy policy</h2>\r\n\r\n<p>We may change this policy from time to time by updating this page. You should check this page from time to time.</p>\r\n\r\n<h2>Privacy Queries</h2>\r\n\r\n<p>If you have any questions regarding this policy contact us using using the &lsquo;Contact Us&rsquo; link on our Site.</p>\r\n', '1432020730'),
(2, '<p>Vacuum Society of Australia (VSA) respects your privacy and is committed to protecting the personal information that identifies you or could identify you. Personal information collected by the VSA (also referred as &ldquo;we&rdquo;, &ldquo;our&rdquo;, &ldquo;us&rdquo; and &ldquo;site&rdquo;) is used in accordance with its obligations under the&nbsp;<a href="http://www.austlii.edu.au/au/legis/cth/consol_act/pa1988108/">Australian Commonwealth Government Privacy Act 1988</a>.</p>\r\n\r\n<p>There may be links from the Site to other websites. This privacy policy only applies to this Site and not to any other website including websites linked from this Site. Accessing those third party websites or sources requires you to leave the Site.</p>\r\n\r\n<h2>Why do we collect personal information?</h2>\r\n\r\n<p>We collect personal information about our Members to conduct our activities and meet legal obligations of society incorporated in state of Victoria.</p>\r\n\r\n<h2>What we collect?</h2>\r\n\r\n<p>We may collect the following information:</p>\r\n\r\n<ul>\r\n	<li>your title/salutation and name;</li>\r\n	<li>your address;</li>\r\n	<li>your email address;</li>\r\n	<li>your phone/fax numbers.</li>\r\n</ul>\r\n\r\n<h2>What we do with your personal information?</h2>\r\n\r\n<p>We will not sell or rent it to a third party without your permission. The personal information that you provide will be available to VSA to provide you with a better service and the following reasons:</p>\r\n\r\n<ul>\r\n	<li>Membership registration and to send you newsletters.</li>\r\n	<li>Conduct VSA short courses</li>\r\n	<li>Process enquiries received via the VSA Site</li>\r\n	<li>Internal record keeping.</li>\r\n	<li>We may periodically send emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.</li>\r\n	<li>From time to time, we may also use your information to contact you regarding Society business such as a notice of General Meeting, conferences and other professional activities. We may contact you by email, phone, fax or mail</li>\r\n</ul>\r\n\r\n<p>We may also disclose your personal information if it is required or authorised by law or where disclosure is necessary to prevent a threat to life, health or safety.</p>\r\n\r\n<h2>Do we use cookies?</h2>\r\n\r\n<p>We use Session cookies to allow Member pages browsing. Session cookie is normally destroyed when VSA Member closes browser. This site does not use persistent cookies or tracking software.</p>\r\n\r\n<h2>How do we protect your personal information?</h2>\r\n\r\n<p>VSA implements a variety of security measures to protect personal information we hold from misuse and loss.</p>\r\n\r\n<p>To help protect your privacy, be sure:</p>\r\n\r\n<ul>\r\n	<li>not to share your user ID or password with anyone else;</li>\r\n	<li>to log off the Site when you are finished;</li>\r\n	<li>to use secure Internet connections;</li>\r\n</ul>\r\n\r\n<h2>How to update your personal information?</h2>\r\n\r\n<p>To correct or update your personal information, login with your password and click &lsquo;myAccout&rsquo; link. Under Member Preferences heading, select &lsquo;Change login/password and personal details&rsquo;. Modify your personal information and submit form by pressing &lsquo;Update&rsquo; button. If you are unable to login please please inform us of the changes using the &lsquo;Contact Us&rsquo; link on our Site.</p>\r\n\r\n<h2>Changes to this privacy policy</h2>\r\n\r\n<p>We may change this policy from time to time by updating this page. You should check this page from time to time.</p>\r\n\r\n<h2>Privacy Queries</h2>\r\n\r\n<p>If you have any questions regarding this policy contact us using using the &lsquo;Contact Us&rsquo; link on our Site.</p>\r\n', '1432256652'),
(3, '<p><strong>TEST</strong>Vacuum Society of Australia (VSA) respects your privacy and is committed to protecting the personal information that identifies you or could identify you. Personal information collected by the VSA (also referred as &ldquo;we&rdquo;, &ldquo;our&rdquo;, &ldquo;us&rdquo; and &ldquo;site&rdquo;) is used in accordance with its obligations under the&nbsp;<a href="http://www.austlii.edu.au/au/legis/cth/consol_act/pa1988108/">Australian Commonwealth Government Privacy Act 1988</a>.</p>\r\n\r\n<p>There may be links from the Site to other websites. This privacy policy only applies to this Site and not to any other website including websites linked from this Site. Accessing those third party websites or sources requires you to leave the Site.</p>\r\n\r\n<h2>Why do we collect personal information?</h2>\r\n\r\n<p>We collect personal information about our Members to conduct our activities and meet legal obligations of society incorporated in state of Victoria.</p>\r\n\r\n<h2>What we collect?</h2>\r\n\r\n<p>We may collect the following information:</p>\r\n\r\n<ul>\r\n	<li>your title/salutation and name;</li>\r\n	<li>your address;</li>\r\n	<li>your email address;</li>\r\n	<li>your phone/fax numbers.</li>\r\n</ul>\r\n\r\n<h2>What we do with your personal information?</h2>\r\n\r\n<p>We will not sell or rent it to a third party without your permission. The personal information that you provide will be available to VSA to provide you with a better service and the following reasons:</p>\r\n\r\n<ul>\r\n	<li>Membership registration and to send you newsletters.</li>\r\n	<li>Conduct VSA short courses</li>\r\n	<li>Process enquiries received via the VSA Site</li>\r\n	<li>Internal record keeping.</li>\r\n	<li>We may periodically send emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.</li>\r\n	<li>From time to time, we may also use your information to contact you regarding Society business such as a notice of General Meeting, conferences and other professional activities. We may contact you by email, phone, fax or mail</li>\r\n</ul>\r\n\r\n<p>We may also disclose your personal information if it is required or authorised by law or where disclosure is necessary to prevent a threat to life, health or safety.</p>\r\n\r\n<h2>Do we use cookies?</h2>\r\n\r\n<p>We use Session cookies to allow Member pages browsing. Session cookie is normally destroyed when VSA Member closes browser. This site does not use persistent cookies or tracking software.</p>\r\n\r\n<h2>How do we protect your personal information?</h2>\r\n\r\n<p>VSA implements a variety of security measures to protect personal information we hold from misuse and loss.</p>\r\n\r\n<p>To help protect your privacy, be sure:</p>\r\n\r\n<ul>\r\n	<li>not to share your user ID or password with anyone else;</li>\r\n	<li>to log off the Site when you are finished;</li>\r\n	<li>to use secure Internet connections;</li>\r\n</ul>\r\n\r\n<h2>How to update your personal information?</h2>\r\n\r\n<p>To correct or update your personal information, login with your password and click &lsquo;myAccout&rsquo; link. Under Member Preferences heading, select &lsquo;Change login/password and personal details&rsquo;. Modify your personal information and submit form by pressing &lsquo;Update&rsquo; button. If you are unable to login please please inform us of the changes using the &lsquo;Contact Us&rsquo; link on our Site.</p>\r\n\r\n<h2>Changes to this privacy policy</h2>\r\n\r\n<p>We may change this policy from time to time by updating this page. You should check this page from time to time.</p>\r\n\r\n<h2>Privacy Queries</h2>\r\n\r\n<p>If you have any questions regarding this policy contact us using using the &lsquo;Contact Us&rsquo; link on our Site.</p>\r\n', '1432467959'),
(4, '<p>Vacuum Society of Australia (VSA) respects your privacy and is committed to protecting the personal information that identifies you or could identify you. Personal information collected by the VSA (also referred as &ldquo;we&rdquo;, &ldquo;our&rdquo;, &ldquo;us&rdquo; and &ldquo;site&rdquo;) is used in accordance with its obligations under the&nbsp;<a href="http://www.austlii.edu.au/au/legis/cth/consol_act/pa1988108/">Australian Commonwealth Government Privacy Act 1988</a>.</p>\n\n<p>There may be links from the Site to other websites. This privacy policy only applies to this Site and not to any other website including websites linked from this Site. Accessing those third party websites or sources requires you to leave the Site.</p>\n\n<h2>Why do we collect personal information?</h2>\n\n<p>We collect personal information about our Members to conduct our activities and meet legal obligations of society incorporated in state of Victoria.</p>\n\n<h2>What we collect?</h2>\n\n<p>We may collect the following information:</p>\n\n<ul>\n	<li>your title/salutation and name;</li>\n	<li>your address;</li>\n	<li>your email address;</li>\n	<li>your phone/fax numbers.</li>\n</ul>\n\n<h2>What we do with your personal information?</h2>\n\n<p>We will not sell or rent it to a third party without your permission. The personal information that you provide will be available to VSA to provide you with a better service and the following reasons:</p>\n\n<ul>\n	<li>Membership registration and to send you newsletters.</li>\n	<li>Conduct VSA short courses</li>\n	<li>Process enquiries received via the VSA Site</li>\n	<li>Internal record keeping.</li>\n	<li>We may periodically send emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.</li>\n	<li>From time to time, we may also use your information to contact you regarding Society business such as a notice of General Meeting, conferences and other professional activities. We may contact you by email, phone, fax or mail</li>\n</ul>\n\n<p>We may also disclose your personal information if it is required or authorised by law or where disclosure is necessary to prevent a threat to life, health or safety.</p>\n\n<h2>Do we use cookies?</h2>\n\n<p>We use Session cookies to allow Member pages browsing. Session cookie is normally destroyed when VSA Member closes browser. This site does not use persistent cookies or tracking software.</p>\n\n<h2>How do we protect your personal information?</h2>\n\n<p>VSA implements a variety of security measures to protect personal information we hold from misuse and loss.</p>\n\n<p>To help protect your privacy, be sure:</p>\n\n<ul>\n	<li>not to share your user ID or password with anyone else;</li>\n	<li>to log off the Site when you are finished;</li>\n	<li>to use secure Internet connections;</li>\n</ul>\n\n<h2>How to update your personal information?</h2>\n\n<p>To correct or update your personal information, login with your password and click &lsquo;myAccout&rsquo; link. Under Member Preferences heading, select &lsquo;Change login/password and personal details&rsquo;. Modify your personal information and submit form by pressing &lsquo;Update&rsquo; button. If you are unable to login please please inform us of the changes using the &lsquo;Contact Us&rsquo; link on our Site.</p>\n\n<h2>Changes to this privacy policy</h2>\n\n<p>We may change this policy from time to time by updating this page. You should check this page from time to time.</p>\n\n<h2>Privacy Queries</h2>\n\n<p>If you have any questions regarding this policy contact us using using the &lsquo;Contact Us&rsquo; link on our Site.</p>\n', '1433851701'),
(5, '<p>Vacuum Society of Australia (VSA) respects your privacy and is committed to protecting the personal information that identifies you or could identify you. Personal information collected by the VSA (also referred as &ldquo;we&rdquo;, &ldquo;our&rdquo;, &ldquo;us&rdquo; and &ldquo;site&rdquo;) is used in accordance with its obligations under the&nbsp;<a href="http://www.austlii.edu.au/au/legis/cth/consol_act/pa1988108/">Australian Commonwealth Government Privacy Act 1988</a>.</p>\n\n<p>There may be links from the Site to other websites. This privacy policy only applies to this Site and not to any other website including websites linked from this Site. Accessing those third party websites or sources requires you to leave the Site.</p>\n\n<h2>Why do we collect personal information?</h2>\n\n<p>We collect personal information about our Members to conduct our activities and meet legal obligations of society incorporated in state of Victoria.</p>\n\n<h2>What we collect?</h2>\n\n<p>We may collect the following information:</p>\n\n<ul>\n	<li>your title/salutation and name;</li>\n	<li>your address;</li>\n	<li>your email address;</li>\n	<li>your phone/fax numbers.</li>\n</ul>\n\n<h2>What we do with your personal information?</h2>\n\n<p>We will not sell or rent it to a third party without your permission. The personal information that you provide will be available to VSA to provide you with a better service and the following reasons:</p>\n\n<ul>\n	<li>Membership registration and to send you newsletters.</li>\n	<li>Conduct VSA short courses</li>\n	<li>Process enquiries received via the VSA Site</li>\n	<li>Internal record keeping.</li>\n	<li>We may periodically send emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.</li>\n	<li>From time to time, we may also use your information to contact you regarding Society business such as a notice of General Meeting, conferences and other professional activities. We may contact you by email, phone, fax or mail</li>\n</ul>\n\n<p>We may also disclose your personal information if it is required or authorised by law or where disclosure is necessary to prevent a threat to life, health or safety.</p>\n\n<h2>Do we use cookies?</h2>\n\n<p>We use Session cookies to allow Member pages browsing. Session cookie is normally destroyed when VSA Member closes browser. This site does not use persistent cookies or tracking software.</p>\n\n<h2>How do we protect your personal information?</h2>\n\n<p>VSA implements a variety of security measures to protect personal information we hold from misuse and loss.</p>\n\n<p>To help protect your privacy, be sure:</p>\n\n<ul>\n	<li>not to share your user ID or password with anyone else;</li>\n	<li>to log off the Site when you are finished;</li>\n	<li>to use secure Internet connections;</li>\n</ul>\n\n<h2>How to update your personal information?</h2>\n\n<p>To correct or update your personal information, login with your password and click &lsquo;myAccout&rsquo; link. Under Member Preferences heading, select &lsquo;Change login/password and personal details&rsquo;. Modify your personal information and submit form by pressing &lsquo;Update&rsquo; button. If you are unable to login please please inform us of the changes using the &lsquo;Contact Us&rsquo; link on our Site.</p>\n\n<h2>Changes to this privacy policy</h2>\n\n<p>We may change this policy from time to time by updating this page. You should check this page from time to time.</p>\n\n<h2>Privacy Queries</h2>\n\n<p>If you have any questions regarding this policy contact us using using the &lsquo;Contact Us&rsquo; link on our Site.</p>\n', '1433851727'),
(6, '<p>Vacuum Society of Australia (VSA) respects your privacy and is committed to protecting the personal information that identifies you or could identify you. Personal information collected by the VSA (also referred as &ldquo;we&rdquo;, &ldquo;our&rdquo;, &ldquo;us&rdquo; and &ldquo;site&rdquo;) is used in accordance with its obligations under the&nbsp;<a href="http://www.austlii.edu.au/au/legis/cth/consol_act/pa1988108/">Australian Commonwealth Government Privacy Act 1988</a>.</p>\n\n<p>There may be links from the Site to other websites. This privacy policy only applies to this Site and not to any other website including websites linked from this Site. Accessing those third party websites or sources requires you to leave the Site.</p>\n\n<h2>Why do we collect personal information?</h2>\n\n<p>We collect personal information about our Members to conduct our activities and meet legal obligations of society incorporated in state of Victoria.</p>\n\n<h2>What we collect?</h2>\n\n<p>We may collect the following information:</p>\n\n<ul>\n	<li>your title/salutation and name;</li>\n	<li>your address;</li>\n	<li>your email address;</li>\n	<li>your phone/fax numbers.</li>\n</ul>\n\n<h2>What we do with your personal information?</h2>\n\n<p>We will not sell or rent it to a third party without your permission. The personal information that you provide will be available to VSA to provide you with a better service and the following reasons:</p>\n\n<ul>\n	<li>Membership registration and to send you newsletters.</li>\n	<li>Conduct VSA short courses</li>\n	<li>Process enquiries received via the VSA Site</li>\n	<li>Internal record keeping.</li>\n	<li>We may periodically send emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.</li>\n	<li>From time to time, we may also use your information to contact you regarding Society business such as a notice of General Meeting, conferences and other professional activities. We may contact you by email, phone, fax or mail</li>\n</ul>\n\n<p>We may also disclose your personal information if it is required or authorised by law or where disclosure is necessary to prevent a threat to life, health or safety.</p>\n\n<h2>Do we use cookies?</h2>\n\n<p>We use Session cookies to allow Member pages browsing. Session cookie is normally destroyed when VSA Member closes browser. This site does not use persistent cookies or tracking software.</p>\n\n<h2>How do we protect your personal information?</h2>\n\n<p>VSA implements a variety of security measures to protect personal information we hold from misuse and loss.</p>\n\n<p>To help protect your privacy, be sure:</p>\n\n<ul>\n	<li>not to share your user ID or password with anyone else;</li>\n	<li>to log off the Site when you are finished;</li>\n	<li>to use secure Internet connections;</li>\n</ul>\n\n<h2>How to update your personal information?</h2>\n\n<p>To correct or update your personal information, login with your password and click &lsquo;myAccout&rsquo; link. Under Member Preferences heading, select &lsquo;Change login/password and personal details&rsquo;. Modify your personal information and submit form by pressing &lsquo;Update&rsquo; button. If you are unable to login please please inform us of the changes using the &lsquo;Contact Us&rsquo; link on our Site.</p>\n\n<h2>Changes to this privacy policy</h2>\n\n<p>We may change this policy from time to time by updating this page. You should check this page from time to time.</p>\n\n<h2>Privacy Queries</h2>\n\n<p>If you have any questions regarding this policy contact us using using the &lsquo;Contact Us&rsquo; link on our Site.</p>\n', '1439526561');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `company`, `fname`, `lname`, `phone`, `fax`, `email`, `website`, `title`) VALUES
(1, 'AVT Services P/L', 'Kevin', 'Armstrong', '(02) 9674 6711', '(02) 9674 7358', 'armstrong@avtservices.com.au', 'http://www.avtservices.com.au', 'Mr'),
(2, 'Cryoquip Australia P/L', 'Russell', 'Peters', '(03) 9791 7888', '(03) 9769 2788', 'rpeters@cryoquip.com.au', 'http://www.cryoquip.com.au', 'Mr'),
(3, 'Dynapumps', 'Jim', 'Ellery', '(08) 9424 2011', '(08) 9424 2001', 'jim@dynapumps.com.au', 'http://www.dynapumps.com.au', 'Mr'),
(4, 'Ezzi Vision', 'Adil', 'Adamjee', '(03) 9727 0770', '(03) 8610 1928', 'adil.adamjee@ezzivision.com.au', 'http://www.ezzivision.com.au', 'Dr'),
(5, 'JAVAC P/L', 'Andrew ', 'Davies', '(03) 9763 7633', '(03) 9763 2756', 'afd@javac.com.au', 'http://www.javac.com.au/', 'Mr'),
(6, 'John Morris Scientific P/L', 'James ', 'Carter', '(02) 9496 4200', '(02) 9417 8855', 'jamesc@johnmorris.com.au', 'http://www.johnmorrisgroup.com', 'Mr'),
(7, 'QS AUSTRALIA PTY LTD', 'Rene', 'Betschart', '(02) 8810 2573', '(02) 9980 1669', 'rene@qs-australia.com', 'http://www.qs-australia.com', 'Mr'),
(8, 'Scitek Australia P/L', 'Tobias ', 'Schappeler', '(02) 9420 0477', '(02) 9418 3540', 'tobias@scitek.com.au', 'http://www.scitek.com.au/', 'Mr'),
(9, 'Stanton Scientific', 'Will ', 'Stanton', '(02) 6685 6902', '(02) 8569 0588', 'bill@stantonscientific.com', 'http://www.stantonscientific.com/', 'Mr'),
(10, 'Thomson Scientific P/L', 'Paul ', 'Thomson', '(03) 9663 2738', '(03) 9663 3680', 'paul@tsi.com.au', 'http://www.tsi.com.au', 'Mr'),
(11, 'Vacuum Pumps Australia P/L', 'Frank ', 'Burch', '(07) 3287 5533', '(07) 3382 7744', 'frank@vacpumps.com.au', 'http://www.vacpumps.com.au', 'Mr');

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
  `type` enum('1','2','3','4') NOT NULL,
  `active` enum('0','1') NOT NULL,
  `level` enum('1','2') NOT NULL,
  `password_reset` enum('0','1') NOT NULL,
  `activation_code` varchar(40) NOT NULL,
  `reset_code` varchar(100) NOT NULL,
  `payment_made` enum('0','1') NOT NULL,
  `date_created` varchar(100) NOT NULL,
  `payment_due_date` varchar(100) NOT NULL,
  `course_member_expiry` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `title`, `fname`, `lname`, `address`, `suburb`, `state`, `postcode`, `country`, `telephone`, `fax`, `website`, `company`, `blocked`, `type`, `active`, `level`, `password_reset`, `activation_code`, `reset_code`, `payment_made`, `date_created`, `payment_due_date`, `course_member_expiry`) VALUES
(1, 'Admin', '$2y$10$FiMkVxrtXeWNVUXECPN9S.LkIzYp3pjZv3GUAAmQvxkDTm8fG7spq', 'jakub.szajman@vu.edu.au', 'Mr', 'Jakub', 'Szajman', '65 Tree Road', 'Footscray', 'Victoria', 3037, 'Australia', '(03) 9919 4286', '(03) 9919 4286', 'http://www.another.com', 'Vic Uni', '0', '3', '1', '1', '0', '', '', '1', '1435752000', '1438587031', ''),
(2, 'Kiark', '$2y$10$AeChCOu5T61XXo9SsLn0ieZKeade5r4OhP09vClaJ01Vilia8BVV2', 'kiark@hotmail.com', 'Mr', 'Kiark', 'Liark', '43 address drive', 'Footscray', 'Victoria', 3036, 'Australia', '0412587965', 'N/A', 'http://www.', 'N/A', '0', '2', '0', '2', '0', '', '', '1', '0', '1438587031', ''),
(5, 'Mehmet', '$2y$10$9BM47dMJyBy77ujqXYGbT.UWsjGUlrp2EiLjRBxHy/5f7qvbQSzS6', 'asd@asd.asd', 'Mr', 'Mehmet', 'Uyanik', '19 Bolstin crt', 'Footscray', 'VIC', 3037, 'Australia', '+61404366893', '+61404366893', 'http://www.memuya.com.au', 'Memuya Corp', '0', '3', '1', '2', '0', '', '', '1', '0', '1438587031', ''),
(6, 'Bob', '$2y$10$ctxhBbVMSmfVsOKBftZ7.O9g3gHev2QJQIuO4CNEaq3L.8pyXD9yG', 'bobsmith@gmail.com', 'E/Prof', 'Bob', 'Smith', '65 Tree Road', 'Friland', 'Victoria', 3456, 'Australia', '93654123', 'N/A', 'http://www.', 'N/A', '0', '2', '1', '2', '0', '', '', '1', '0', '1438587031', ''),
(7, 'Mem', '$2y$10$AEiKMbUUiti9dmC4BRFvAuPRYLCo43saSHwiDn/ySHPZ/.o.MU5R2', 'mehmet.uyanik@live.com.au', 'Mr', 'Mehmet', 'Uyanik', '19 address drive', 'Melbourne', 'VIC', 3037, 'Australia', '+61404366893', 'N/A', 'http://www.', 'N/A', '0', '2', '1', '2', '0', '', '', '1', '0', '1438587031', ''),
(8, 'Alex', '$2y$10$SZyKdg00fudzRi4CCc1m5O1s.3BH/bOAmGjKXllwDkrlarqVS5r5.', 'alex@hotmail.com', 'Ms', 'Alex', 'Maxitanis', '64 Bellevue Bvd', 'Hillside', 'Victoria', 3037, 'Australia', '0412547896', NULL, NULL, NULL, '0', '1', '1', '2', '0', '', '', '1', '0', '1438587031', ''),
(9, 'Rocky', '$2y$10$QTUNnW8PtphnaTVJFk6xI.IVHQAgwjZYK0yzIraOshCYktZGID3x2', 'rocky@hotmail.com', 'Mr', 'Rocky', 'Calfa', '11 Hillside crt', 'Hillside', 'Victoria', 3037, 'Australia', '0456874398', NULL, NULL, NULL, '0', '2', '1', '2', '0', '', '', '1', '0', '1438587031', ''),
(10, 'Dan', '$2y$10$6ghTrmFO035G7DdCTgAr9emsGSvdQaYKOMqOpi5IEMxpV2kvosCtq', 'dj_rokstr@gmail.com', 'Mr', 'daniel', 'chalmers', '17 Blah', 'keilor', 'VIC', 3037, 'America', '555-1024', '', '', NULL, '1', '1', '1', '2', '0', '', '', '1', '0', '1438587031', ''),
(12, 'Jesse', '$2y$10$I5aKMLGABf2stYRpf6/4fuysa.mJ8afL4oasjaOLto0sivBRbFx3m', 'jesse@hotmail.com', '', 'Jesse', 'Borg', '1 Something drive', 'Hillside', 'VIC', 3037, 'Australia', '0458754125', NULL, NULL, NULL, '0', '2', '1', '2', '0', '', '', '1', '0', '1438587031', ''),
(13, 'Amber', '$2y$10$/acaVwB9.MaVLlZq1i7Ic.X7DCAiHbt1Plm0vmXY0HtyI3WCdA8uC', 'amber@hotmail.com', 'Ms', 'Amber', 'Doignie', '68 Somewhere drive', 'Melton', 'VIC', 3040, 'Australia', '0412654128', '0432456789', 'http://www.amber.com', 'Ambtek Industries', '0', '3', '1', '2', '0', '', '', '1', '0', '1438587031', ''),
(16, 'kevin', '$2y$10$Cml3GpOB2ZsaGLm9EAnGqOgueVO4U9iJs49RUogT5YvBXFG/0oMm2', 'armstrong@avtservices.com.au', 'Mr', 'Kevin', 'Armstrong', '12 Something Drive', 'Footscray', 'Victoria', 3056, 'Australia', '(02) 9674 6711', '(02) 9674 7358', 'http://www.avtservices.com.au', 'AVT Services P/L', '0', '3', '1', '2', '0', '', '', '1', '0', '1438587031', ''),
(21, 'payment', '$2y$10$qNIi1TK.B/t7MqJvmlrFKu6eGnnKYmeCEWPBDS9jGMzqBUBS0OeaG', 'payment@hotmail.com', 'Sir', 'Payment', 'Made', '19 Colston drive', 'Melbourne', 'VIC', 3037, 'Australia', '+61404366893', 'N/A', 'http://www.', 'N/A', '0', '2', '1', '2', '0', '', '', '0', '1438501380', '1438598490', ''),
(23, 'newuser', '$2y$10$uBEw1GW93xeqg3cZTgWkb.j1HdFZE/KlK1WjfIiamKSjOtoy20G92', 'newuser@hotmail.com', 'Dr', 'New', 'User', '90 address', 'Melbourne', 'VIC', 3045, 'Australia', '0458745698', 'N/A', 'http://www.', 'N/A', '0', '2', '1', '2', '0', 'e0a993ed8d2f5a4d94844bdbf93d3ca4d384357f', '', '0', '1439853472', '1442531872', ''),
(29, 'course', '$2y$10$fUMR67H9SHm0./2XNnIZJOTSzRBWzTWMkt.HlVHV3GI7IvtPt.XIC', 'course@otmail.com', 'Ms', 'Course', 'Member', '19 Course Street', 'Hillside', 'Victoria', 3037, 'Australia', '+61404366893', 'N/A', 'http://www.', 'N/A', '0', '4', '1', '2', '0', 'f92ef0b52dc2358ddc17cf6e55b59f77fda6bbbe', '', '0', '1440053111', '1442731511', '1471695132'),
(30, 'expireduser', '$2y$10$zjJ7tupxWUVFQOA4L8Q.dONoaDyHKEHY.dGHiYI.j7QLhF.eRHYa6', 'expireduser@hotmail.com', 'Dr', 'Expired', 'User', '17 Expired drive', 'Expirville', 'NSW', 7654, 'Australia', '93654789', 'N/A', 'http://www.', 'N/A', '0', '4', '1', '2', '0', 'af9236f40863b45c8bafea52c0b7e0f4c1214afe', '', '0', '1440055039', '1442733439', '1439986332');

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
(1, '<h1>Welcome</h1>\n\n<p>The&nbsp;<strong>Vacuum Society of Australia</strong> (VSA) is a not-for-profit organization dedicated to the advancement of vacuum science relating to vacuum technology, materials, surfaces, interfaces, thin films and plasmas and to providing a variety of educational opportunities.&nbsp;Please check our <a href="http://localhost/vsa-demo/news">news</a>&nbsp;page&nbsp;for latest information.</p>\n\n<p>The Society welcomes participation from all its members, and encourages student involvement. It is the Australian body representing IUVSTA (International Union for Vacuum Science, Technique and Applications).</p>\n\n<p>The VSA publishes the Newsletter &quot;OZVAC&quot; which includes scientific and technical articles, product information from manufacturers as well as a &#39;For Sale/Wanted section&#39; and other possibilities for those in the field of Vacuum Science to Network and communicate.Membership is open to all interested parties and discounts for Student membership available.</p>\n\n<p>VSA runs a number of Vacuum Technology <a href="http://localhost/vsa-demo/courses">short courses</a>. The courses are suitable for researchers, technicians and engineers. Vacuum Technology courses cover the fundamental theory, practical knowledge and computer laboratories simulating real vacuum systems. Comprehensive notes are provided. Click on the image to test your practical knowledge of a diffusion pump system.</p>\n');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
