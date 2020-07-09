-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2018 at 10:15 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academydb`
--
CREATE DATABASE IF NOT EXISTS `academydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `academydb`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cartid` int(3) NOT NULL AUTO_INCREMENT,
  `courseid` int(3) NOT NULL,
  `regid` int(3) NOT NULL,
  PRIMARY KEY (`cartid`),
  KEY `courseid` (`courseid`),
  KEY `regid` (`regid`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartid`, `courseid`, `regid`) VALUES
(3, 4, 6),
(4, 2, 6),
(11, 6, 7),
(28, 3, 11);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `catid` int(3) NOT NULL AUTO_INCREMENT,
  `catname` varchar(20) NOT NULL,
  `catparentid` int(3) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `catname`, `catparentid`) VALUES
(1, 'web development', 0),
(2, 'Mobile Development', 0),
(3, 'PHP', 1),
(4, 'Android', 2),
(5, 'Python', 1),
(6, 'Design', 0),
(7, 'Web Design', 6),
(8, 'Graphic Design', 6),
(9, 'Game Development', 0),
(10, 'unity', 9),
(11, 'Unreal Engine', 9),
(12, 'Business', 0),
(13, 'Finance', 12),
(14, 'Management', 12),
(15, 'Sales', 12),
(16, 'Game Design', 6),
(17, 'ASP.NET', 1),
(18, 'Health & Fitness', 0),
(19, 'Yoga', 18),
(20, 'Fitness', 18),
(21, 'Dieting', 18),
(22, 'JavaScript', 1),
(23, 'Jquery', 1),
(24, 'IOS', 2);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `cityid` int(3) NOT NULL AUTO_INCREMENT,
  `cityname` varchar(30) NOT NULL,
  `pincode` varchar(7) NOT NULL,
  PRIMARY KEY (`cityid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityid`, `cityname`, `pincode`) VALUES
(1, 'navsari', '396445'),
(2, 'surat', '394220'),
(3, 'Ahmedabad', '320008'),
(4, 'vadodara', '391510'),
(5, 'mumbai', '400099'),
(6, 'delhi', '110012'),
(7, 'kolkata', '700028');

-- --------------------------------------------------------

--
-- Table structure for table `cmprecord`
--

DROP TABLE IF EXISTS `cmprecord`;
CREATE TABLE IF NOT EXISTS `cmprecord` (
  `crid` int(3) NOT NULL AUTO_INCREMENT,
  `courseid` int(3) NOT NULL,
  `regid` int(3) NOT NULL,
  `noc` int(4) NOT NULL,
  `cmpdate` date DEFAULT NULL,
  PRIMARY KEY (`crid`),
  KEY `courseid` (`courseid`),
  KEY `regid` (`regid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cmprecord`
--

INSERT INTO `cmprecord` (`crid`, `courseid`, `regid`, `noc`, `cmpdate`) VALUES
(6, 4, 13, 2, NULL),
(7, 6, 3, 2, NULL),
(8, 4, 7, 1, NULL),
(9, 6, 10, 1, NULL),
(10, 3, 14, 1, '2018-04-03'),
(11, 4, 3, 2, '2018-04-03'),
(12, 2, 3, 2, '2018-04-03'),
(13, 4, 15, 2, '2018-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `contentid` int(3) NOT NULL AUTO_INCREMENT,
  `courseid` int(3) NOT NULL,
  `sectionid` int(3) NOT NULL,
  `contentname` varchar(50) NOT NULL,
  `contentdesc` text,
  `contenttype` varchar(10) DEFAULT NULL,
  `contenturl` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`contentid`),
  KEY `courseid` (`courseid`),
  KEY `content_ibfk_1` (`sectionid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`contentid`, `courseid`, `sectionid`, `contentname`, `contentdesc`, `contenttype`, `contenturl`) VALUES
(4, 2, 3, 'asdas', 'dsadsa', 'video', 'video-5aa4d00883839-1520750600.mp4'),
(5, 2, 3, 'dasdsad', 'dasdsadsa', 'video', 'video-5aa4d01228dce-1520750610.mp4'),
(6, 3, 4, 'PHP login & registration', '', 'video', 'video-5aaa1c783a952-1521097848.mp4'),
(7, 4, 5, 'Custom Alert Box in Javascript', '', 'video', 'video-5aaff8af48836-1521481903.mp4'),
(8, 4, 6, 'Custom ConfirmBox in Javascript', '', 'video', 'video-5aaff8fabf434-1521481978.mp4'),
(11, 5, 7, 'Centralised and Decentralised Decision-Making', '', 'video', 'video-5ab9411ac1531-1522090266.mp4'),
(12, 6, 8, 'Objects & Classes', '', 'video', 'video-5abf7d6523f7c-1522498917.mp4'),
(13, 6, 9, 'Inheritance', '', 'video', 'video-5abf7d9a5ed3d-1522498970.mp4'),
(14, 6, 10, 'Encapsulation', '', 'video', 'video-5abf7dd1df7ef-1522499025.mp4'),
(15, 6, 11, 'Abstract Classes', '', 'video', 'video-5abf7e2302d95-1522499107.mp4'),
(16, 6, 12, 'Interfaces', '', 'video', 'video-5abf7e32b67ab-1522499122.mp4'),
(17, 7, 13, 'How to make an iPhone App', '', 'video', 'video-5abf8b228e66e-1522502434.mp4'),
(18, 8, 14, 'Python Programming', '', 'video', 'video-5ac3ce76a2977-1522781814.mp4'),
(19, 9, 15, 'Intro To Tool', '', 'video', 'video-5ac497cc52246-1522833356.mp4'),
(20, 9, 16, 'Implement Tools with image', '', 'video', 'video-5ac498338508e-1522833459.mp4'),
(21, 9, 17, 'Properties of Tools', '', 'video', 'video-5ac4986adc80b-1522833514.mp4'),
(22, 9, 18, 'Make Your Own Image', '', 'video', 'video-5ac498964e4ac-1522833558.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `courseid` int(3) NOT NULL AUTO_INCREMENT,
  `coursename` varchar(250) NOT NULL,
  `catid` int(3) NOT NULL,
  `coursedate` date NOT NULL,
  `description` text NOT NULL,
  `coursetype` varchar(10) NOT NULL,
  `price` int(5) DEFAULT NULL,
  `prerequirement` text NOT NULL,
  `whatlearn` text,
  `skilllevel` varchar(20) DEFAULT NULL,
  `keyword` varchar(50) DEFAULT NULL,
  `lang` varchar(15) NOT NULL,
  `thumbnailurl` varchar(50) DEFAULT NULL,
  `thumbvidurl` varchar(100) DEFAULT NULL,
  `instid` int(3) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`courseid`),
  KEY `catid` (`catid`),
  KEY `course_ibfk_2` (`instid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `coursename`, `catid`, `coursedate`, `description`, `coursetype`, `price`, `prerequirement`, `whatlearn`, `skilllevel`, `keyword`, `lang`, `thumbnailurl`, `thumbvidurl`, `instid`, `status`) VALUES
(2, 'another something course', 7, '2018-03-11', 'dasdsadas', 'paid', 2500, 'dasdsad`dasdsa`dassa`', 'adasdas`dasdasd`dasdsad`', 'beginner', 'css,css3,css4', 'English', 'image-5aa4cfe8b1c9f-1520750568.jpg', '', 2, 1),
(3, 'PHP User login & Registration with all features.', 3, '2018-03-15', 'This Course Is about to creating Login, Registration & forget-password reset with database.', 'paid', 2500, 'Wampserver`Text-editor`Basic Knowledge of html & php`', 'Creating Login`Creating Registration`Forget-password Reset`', 'intermediate', 'PHP ,html', 'English', 'image-5aaa1b5202bf4-1521097554.jpg ', '', 5, 1),
(4, 'Custom Alert Box and Confirm Box in Javascript, CSS, HTML', 1, '2018-03-19', 'You Can Built Your Own Custom Javascript Alert Box and Confirm Box After this Course', 'paid', 500, 'text editor (ANY One)`Basic Knowledge of HTML, Javascript`', 'to Built Custom Own Alert Box in  Javascript`to Built Custom Own Confirm Box in  Javascript`', 'all', 'javascript, CSS, HTML, Confirm box, Alert Box', 'English', 'image-5aaff818dfd60-1521481752.jpg', '', 2, 1),
(5, 'Centralised and Decentralised Decision-Making', 14, '2018-03-27', 'this course will give you chance to explore Centralised and Decentralised Decision-Making\r\n', 'free', 0, 'Basic Knowledge of Management `', 'gain Knowledge of Decentralised `gain Knowledge of centralised `', 'beginner', 'Centralised Decentralised ', 'English', 'image-5ab940c668c19-1522090182.jpg', '', 7, 1),
(6, 'OOPS conepts in PHP in Hindi ', 3, '2018-03-31', 'This Course will help to get beginner Knowledge in the field of Object Oriented Programming in PHP .', 'paid', 7500, 'PHP`Wamp server`Text editor`', 'Basic in oop concepts in php`', 'beginner', 'PHP, OOP, HINDI, ', 'Hindi', 'image-5abf7c3d4584b-1522498621.jpg', '', 5, 1),
(7, 'How to Make An Iphone App', 24, '2018-03-31', 'This Help Student to make their first iphone app', 'free', 0, 'IOS 11, Swift 4, Xcode 9`', 'Built First Iphone App`', 'beginner', 'ios, iphone, app', 'English', 'image-5abf8a8f1db89-1522502287.jpg', '', 8, 1),
(8, 'Learning Python', 5, '2018-04-04', 'This Video Help You know about more in Python Programming', 'free', 0, 'required Python`', 'About Python`', 'beginner', 'python beginner', 'English', 'image-5ac3ce2a12548-1522781738.jpg', '', 8, 1),
(9, 'All tools of Adobe Photoshop', 8, '2018-04-04', 'Learn the tools of the photoshop and make the awesome photoshop images.', 'paid', 5000, 'Windows Redistribution`Software Adobe Photoshop`RAM atleast 4GB`', 'Student can learn the different tools of photoshop`Learning the tools like crop the image, moving tool, etc.`The category like selection tools, magic tool , etc`', 'beginner', 'photoshop', 'Hindi', 'image-5ac495c34db2b-1522832835.jpg', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courseenroll`
--

DROP TABLE IF EXISTS `courseenroll`;
CREATE TABLE IF NOT EXISTS `courseenroll` (
  `enrollid` int(4) NOT NULL AUTO_INCREMENT,
  `courseid` int(3) NOT NULL,
  `regid` int(3) NOT NULL,
  `enrolldate` date NOT NULL,
  PRIMARY KEY (`enrollid`),
  KEY `courseid` (`courseid`),
  KEY `regid` (`regid`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courseenroll`
--

INSERT INTO `courseenroll` (`enrollid`, `courseid`, `regid`, `enrolldate`) VALUES
(2, 3, 2, '2018-03-17'),
(4, 2, 3, '2018-03-21'),
(5, 4, 3, '2018-03-21'),
(6, 2, 13, '2018-03-22'),
(7, 4, 10, '2018-03-22'),
(8, 2, 10, '2018-03-22'),
(9, 3, 15, '2018-03-23'),
(10, 4, 15, '2018-03-23'),
(11, 5, 3, '2018-03-28'),
(12, 2, 12, '2018-03-28'),
(13, 4, 12, '2018-03-28'),
(14, 4, 13, '2018-04-01'),
(15, 6, 3, '2018-04-01'),
(16, 2, 9, '2018-04-02'),
(17, 3, 7, '2018-04-02'),
(18, 3, 9, '2018-04-02'),
(19, 4, 9, '2018-04-02'),
(20, 6, 9, '2018-04-02'),
(21, 4, 7, '2018-04-02'),
(22, 3, 10, '2018-04-02'),
(23, 6, 10, '2018-04-02'),
(24, 3, 14, '2018-04-03'),
(25, 3, 3, '2018-04-04'),
(26, 9, 14, '2018-04-05'),
(27, 6, 2, '2018-04-05'),
(28, 3, 17, '2018-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `earning`
--

DROP TABLE IF EXISTS `earning`;
CREATE TABLE IF NOT EXISTS `earning` (
  `earnid` int(3) NOT NULL AUTO_INCREMENT,
  `earndate` date NOT NULL,
  `regid` int(3) NOT NULL,
  `courseid` int(3) NOT NULL,
  `amount` int(10) NOT NULL,
  PRIMARY KEY (`earnid`),
  KEY `regid` (`regid`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `earning`
--

INSERT INTO `earning` (`earnid`, `earndate`, `regid`, `courseid`, `amount`) VALUES
(1, '2018-03-21', 2, 2, 2000),
(2, '2018-03-21', 1, 2, 500),
(3, '2018-03-21', 2, 4, 400),
(4, '2018-03-21', 1, 4, 100),
(5, '2018-03-22', 2, 2, 2000),
(6, '2018-03-22', 1, 2, 500),
(7, '2018-03-22', 2, 4, 400),
(8, '2018-03-22', 1, 4, 100),
(9, '2018-03-22', 2, 2, 2000),
(10, '2018-03-22', 1, 2, 500),
(11, '2018-03-23', 2, 4, 400),
(12, '2018-03-23', 1, 4, 100),
(13, '2018-03-28', 2, 2, 2000),
(14, '2018-03-28', 1, 2, 500),
(15, '2018-03-28', 2, 4, 400),
(16, '2018-03-28', 1, 4, 100),
(17, '2018-04-01', 2, 4, 400),
(18, '2018-04-01', 1, 4, 100),
(19, '2018-04-01', 5, 6, 6000),
(20, '2018-04-01', 1, 6, 1500),
(21, '2018-04-02', 2, 2, 2000),
(22, '2018-04-02', 1, 2, 500),
(23, '2018-04-02', 5, 3, 2000),
(24, '2018-04-02', 1, 3, 500),
(25, '2018-04-02', 5, 3, 2000),
(26, '2018-04-02', 1, 3, 500),
(27, '2018-04-02', 2, 4, 400),
(28, '2018-04-02', 1, 4, 100),
(29, '2018-04-02', 5, 6, 6000),
(30, '2018-04-02', 1, 6, 1500),
(31, '2018-04-02', 2, 4, 400),
(32, '2018-04-02', 1, 4, 100),
(33, '2018-04-02', 5, 3, 2000),
(34, '2018-04-02', 1, 3, 500),
(35, '2018-04-02', 5, 6, 6000),
(36, '2018-04-02', 1, 6, 1500),
(37, '2018-04-03', 5, 3, 2000),
(38, '2018-04-03', 1, 3, 500),
(39, '2018-04-04', 5, 3, 2000),
(40, '2018-04-04', 1, 3, 500),
(41, '2018-04-05', 2, 9, 4000),
(42, '2018-04-05', 1, 9, 1000),
(43, '2018-04-05', 5, 6, 6000),
(44, '2018-04-05', 1, 6, 1500),
(45, '2018-04-06', 5, 3, 2000),
(46, '2018-04-06', 1, 3, 500);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
CREATE TABLE IF NOT EXISTS `email` (
  `emailid` int(3) NOT NULL AUTO_INCREMENT,
  `emaildate` date NOT NULL,
  `emailto` varchar(50) NOT NULL,
  `emailfrom` varchar(50) NOT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `details` text NOT NULL,
  `regid` int(3) NOT NULL,
  PRIMARY KEY (`emailid`),
  KEY `regid` (`regid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `fbid` int(3) NOT NULL AUTO_INCREMENT,
  `fbdate` date NOT NULL,
  `regid` int(3) NOT NULL,
  `fbfor` varchar(30) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `star` int(3) NOT NULL,
  PRIMARY KEY (`fbid`),
  KEY `regid` (`regid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
CREATE TABLE IF NOT EXISTS `instructor` (
  `instid` int(3) NOT NULL AUTO_INCREMENT,
  `instname` varchar(50) NOT NULL,
  `regid` int(3) NOT NULL,
  `photo` varchar(60) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `qualification` varchar(30) DEFAULT NULL,
  `expirance` varchar(10) DEFAULT NULL,
  `speciality` varchar(20) DEFAULT NULL,
  `about` text,
  PRIMARY KEY (`instid`),
  KEY `regid` (`regid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instid`, `instname`, `regid`, `photo`, `gender`, `qualification`, `expirance`, `speciality`, `about`) VALUES
(1, 'Kamiyab Asamadi', 2, 'assests/img/users/kamiyab-5aa0f9ff0ce32.png', 'm', 'Web Developer', '5 year', 'Php', '<p style=\"text-align: center;\"><strong>Working As a PHP Develpor.</strong></p>'),
(2, 'Pradip Karmakar', 5, 'assests/img/users/pradip-5aaa19b92844f.png', 'm', 'Web designer', '18 years', 'CSS3', NULL),
(3, 'Akshay Astik', 7, 'assests/img/default_M.png', 'm', NULL, NULL, NULL, NULL),
(4, 'Bhavesh Patel', 8, 'assests/img/default_M.png', 'm', NULL, NULL, NULL, NULL),
(5, 'Jalesh Gandhi', 9, 'assests/img/default_M.png', 'm', NULL, NULL, NULL, NULL),
(6, 'Kamiyab Husain', 16, 'assests/img/default_M.png', 'm', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `msgid` int(3) NOT NULL AUTO_INCREMENT,
  `msgdatetime` datetime NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `senderregid` int(3) NOT NULL,
  `receiverregid` int(3) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`msgid`),
  KEY `regid` (`senderregid`),
  KEY `receiverregid` (`receiverregid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msgid`, `msgdatetime`, `subject`, `message`, `senderregid`, `receiverregid`, `status`) VALUES
(1, '2018-03-15 22:36:00', 'Demo Subject', 'demo Msg', 5, 1, 1),
(2, '2018-03-16 00:22:27', 'Your Course Has been Rejected', '<strong>Your course: PHP User login & Registration with all features. is Rejected following Reason<br/>due to some missing things', 1, 5, 1),
(4, '2018-03-16 13:03:17', 'Your Course Has been Rejected', '<strong>Your course: PHP User login & Registration with all features. is Rejected following Reason<br/>mere system k hisab se acha nahi hai', 1, 5, 1),
(6, '2018-03-17 00:01:48', '<p class=\'text-success\'>Your Course Has Been Accepted</p>', '<p>Now your Course : PHP User login & Registration with all features. Has been Public for Everyone so You Can Share and Earn from this course</p>', 1, 5, 1),
(7, '2018-03-17 00:22:08', '<p class=\'text-success\'>Has Been Reviewed your Course</p>', '<p>rating : 5<br/>Message : nice Course yaar <br/><i>This Message Automated By System</i></p>', 2, 5, 1),
(8, '2018-03-19 14:11:16', 'Your Course Has been Rejected', '<strong>Your course: PHP User login & Registration with all features. is Rejected following Reason<br/>maza nathi tara course ma', 1, 5, 1),
(9, '2018-03-19 23:25:57', '<p class=\'text-success\'>Your Course Has Been Accepted</p>', '<p>Now your Course : Custom Alert Box and Confirm Box in Javascript, CSS, HTML Has been Public for Everyone so You Can Share and Earn from this course</p>', 1, 2, 1),
(12, '2018-03-21 11:00:22', '<p class=\'text-success\'>Has Reviewed your Course</p>', '<p>rating : 2<br/>Message : nath <br/><i>This Message Automated By System</i></p>', 3, 2, 1),
(13, '2018-03-21 11:17:49', 'Your Course Has been Rejected', '<strong>Your course: PHP User login & Registration with all features. is Rejected following Reason<br/>dasdkla', 1, 5, 1),
(14, '2018-03-23 11:09:27', '<p class=\'text-success\'>Your Course Has Been Accepted</p>', '<p>Now your Course : how to something Has been Public for Everyone so You Can Share and Earn from this course</p>', 1, 2, 1),
(15, '2018-03-23 11:48:55', '<p class=\'text-success\'>Has Reviewed your Course</p>', '<p>rating : 4<br/>Message : Very Good <br/><i>This Message Automated By System</i></p>', 15, 2, 1),
(16, '2018-03-27 00:27:12', '<p class=\'text-success\'>Your Course Has Been Accepted</p>', '<p>Now your Course : Centralised and Decentralised Decision-Making Has been Public for Everyone so You Can Share and Earn from this course</p>', 1, 7, 1),
(17, '2018-03-27 02:02:03', '<p>Have Query on Your Lecture</p>', '<p>vaibhav Ask Question About your Lecture : Custom Alert Box in Javascript<br/>Question : ok this is something<br/> You Can Reply with Email : vaibhavkumarbca01@gmail.com </p>', 3, 2, 1),
(18, '2018-03-27 11:50:57', '<p>Have Query on Your Lecture</p>', '<p>vaibhav Ask Question About your Lecture : Custom ConfirmBox in Javascript<br/>Question : ANASCASD<br/> You Can Reply with Email : vaibhavkumarbca01@gmail.com </p>', 3, 2, 1),
(19, '2018-03-31 18:03:24', '<p class=\'text-success\'>Your Course Has Been Accepted</p>', '<p>Now your Course : OOPS conepts in PHP in Hindi  Has been Public for Everyone so You Can Share and Earn from this course</p>', 1, 5, 1),
(20, '2018-03-31 18:05:44', '<p class=\'text-success\'>Your Course Has Been Accepted</p>', '<p>Now your Course : PHP User login & Registration with all features. Has been Public for Everyone so You Can Share and Earn from this course</p>', 1, 5, 1),
(21, '2018-04-04 00:28:03', '<p class=\'text-success\'>Your Course Has Been Accepted</p>', '<p>Now your Course : How to Make An Iphone App Has been Public for Everyone so You Can Share and Earn from this course</p>', 1, 8, 0),
(22, '2018-04-04 00:28:05', '<p class=\'text-success\'>Your Course Has Been Accepted</p>', '<p>Now your Course : Learning Python Has been Public for Everyone so You Can Share and Earn from this course</p>', 1, 8, 0),
(23, '2018-04-04 15:16:49', '<p class=\'text-success\'>Your Course Has Been Accepted</p>', '<p>Now your Course : All tools of Adobe Photoshop Has been Public for Everyone so You Can Share and Earn from this course</p>', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `paymentid` int(3) NOT NULL AUTO_INCREMENT,
  `paymentdate` date NOT NULL,
  `pmethod` varchar(150) NOT NULL,
  `pamount` int(10) NOT NULL,
  `regid` int(3) NOT NULL,
  PRIMARY KEY (`paymentid`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentid`, `paymentdate`, `pmethod`, `pamount`, `regid`) VALUES
(2, '2018-03-21', 'Credit Card', 3000, 3),
(3, '2018-03-22', 'Credit Card', 2500, 13),
(4, '2018-03-22', 'Credit Card', 500, 10),
(5, '2018-03-22', 'Credit Card', 2500, 10),
(6, '2018-03-23', 'Debit Card', 500, 15),
(7, '2018-03-28', 'Credit Card', 3000, 12),
(8, '2018-04-01', 'Credit Card', 500, 13),
(9, '2018-04-01', 'Credit Card', 7500, 3),
(10, '2018-04-02', 'Credit Card', 2500, 9),
(11, '2018-04-02', 'Credit Card', 2500, 7),
(12, '2018-04-02', 'Credit Card', 2500, 9),
(13, '2018-04-02', 'Credit Card', 500, 9),
(14, '2018-04-02', 'Payu', 7500, 9),
(15, '2018-04-02', 'Payu', 500, 7),
(16, '2018-04-02', 'Payu', 10000, 10),
(17, '2018-04-03', 'Payu', 2500, 14),
(18, '2018-04-04', 'Payu', 2500, 3),
(19, '2018-04-05', 'Payu', 5000, 14),
(20, '2018-04-05', 'Payu', 7500, 2),
(21, '2018-04-06', 'Payu', 2500, 17);

-- --------------------------------------------------------

--
-- Table structure for table `playtime`
--

DROP TABLE IF EXISTS `playtime`;
CREATE TABLE IF NOT EXISTS `playtime` (
  `ptid` int(3) NOT NULL AUTO_INCREMENT,
  `contentid` int(3) NOT NULL,
  `regid` int(3) NOT NULL,
  `timeplayed` int(10) NOT NULL,
  PRIMARY KEY (`ptid`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playtime`
--

INSERT INTO `playtime` (`ptid`, `contentid`, `regid`, `timeplayed`) VALUES
(6, 7, 3, 724),
(5, 4, 3, 5),
(7, 8, 3, 645),
(9, 9, 3, 71),
(10, 10, 3, 11),
(12, 7, 13, 724),
(13, 8, 13, 645),
(14, 12, 3, 731),
(15, 13, 3, 1223),
(16, 7, 7, 724),
(17, 12, 10, 731),
(18, 6, 14, 3845),
(19, 5, 3, 71),
(20, 7, 15, 724),
(21, 8, 15, 645);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `regid` int(5) NOT NULL AUTO_INCREMENT,
  `regdate` date NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactno` varchar(15) DEFAULT NULL,
  `securitycode` int(4) DEFAULT NULL,
  PRIMARY KEY (`regid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`regid`, `regdate`, `username`, `password`, `usertype`, `email`, `contactno`, `securitycode`) VALUES
(1, '2017-12-25', 'academyadmin', 'academy@159', 'admin', 'info@taalem.com', NULL, NULL),
(2, '2018-02-27', 'kamiyab', 'kamiyab@123', 'instructor', 'kamiyabasamadi@gmail.com', NULL, NULL),
(3, '2018-02-28', 'vaibhav', 'vaibhav@159', 'student', 'vaibhavkumarbca01@gmail.com', NULL, NULL),
(4, '2018-03-03', 'mearaj', 'mearaj@123', 'student', 'mearaj@gmail.com', NULL, NULL),
(5, '2018-03-15', 'pradip', 'pradip@123', 'instructor', 'skpradip88.pk@gmail.com', NULL, NULL),
(6, '2018-03-16', 'sudip', 'sudip@123', 'student', 'sudip123@gmail.com', NULL, NULL),
(7, '2018-03-17', 'akshay', 'akshay@123', 'instructor', 'akshay@gmail.com', NULL, NULL),
(8, '2018-03-17', 'bhavesh', 'bhavesh@123', 'instructor', 'bhavesh@gmail.com', NULL, NULL),
(9, '2018-03-17', 'jalesh', 'jalesh@123', 'instructor', 'jalesh@gmail.com', NULL, NULL),
(10, '2018-03-17', 'adani', 'adani@123', 'student', 'adani@gmail.com', NULL, NULL),
(11, '2018-03-17', 'shruti', 'shruti@123', 'student', 'shruti@gmail.com', NULL, NULL),
(12, '2018-03-20', 'rajesh', 'rajesh@123', 'student', 'rajesh@gmail.com', NULL, NULL),
(13, '2018-03-20', 'Kajal', 'kajal@123', 'student', 'kajal143@gmail.com', NULL, NULL),
(14, '2018-03-22', 'mitali', 'nidhi62112@', 'student', 'm@gmail.com', NULL, NULL),
(15, '2018-03-23', 'Blast', 'Blast@98', 'student', 'kamaludvadia1234@gmail.com', NULL, NULL),
(16, '2018-03-30', 'kamiyabh530', 'kamiyab@123', 'instructor', 'kamiyabh530@gmail.com', NULL, NULL),
(17, '2018-04-06', 'abbas', 'abbas@123', 'student', 'abbas@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `revid` int(3) NOT NULL AUTO_INCREMENT,
  `courseid` int(3) NOT NULL,
  `regid` int(3) NOT NULL,
  `revdesc` text,
  `rating` float NOT NULL,
  `revdate` date NOT NULL,
  PRIMARY KEY (`revid`),
  KEY `courseid` (`courseid`),
  KEY `regid` (`regid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`revid`, `courseid`, `regid`, `revdesc`, `rating`, `revdate`) VALUES
(5, 3, 2, 'nice Course yaar', 5, '2018-03-17'),
(7, 4, 15, 'Very Good', 4, '2018-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `sectionid` int(3) NOT NULL AUTO_INCREMENT,
  `courseid` int(3) NOT NULL,
  `sectionname` varchar(50) NOT NULL,
  `sectiondesc` text,
  PRIMARY KEY (`sectionid`),
  KEY `courseid` (`courseid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sectionid`, `courseid`, `sectionname`, `sectiondesc`) VALUES
(3, 2, 'adasdas', 'sadasd'),
(4, 3, 'Login - Register', ''),
(5, 4, 'Custom Alert Box', ''),
(6, 4, 'Custom Confirm Box', ''),
(7, 5, 'Centralised and Decentralised Decision-Making', ''),
(8, 6, 'Objects & Classes', ''),
(9, 6, 'Inheritance', ''),
(10, 6, 'Encapsulation', ''),
(11, 6, 'Abstract Classes', ''),
(12, 6, 'Interfaces', ''),
(13, 7, 'How to make an iPhone App', ''),
(14, 8, 'Python Programming', ''),
(15, 9, 'Photoshop Tools Basic Intro', ''),
(16, 9, 'Make image own Image', ''),
(17, 9, 'Extra Properties of Tools', ''),
(18, 9, 'Final Project', '');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

DROP TABLE IF EXISTS `social`;
CREATE TABLE IF NOT EXISTS `social` (
  `socialid` int(3) NOT NULL AUTO_INCREMENT,
  `regid` int(3) NOT NULL,
  `socialbrandname` varchar(20) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`socialid`),
  KEY `regid` (`regid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`socialid`, `regid`, `socialbrandname`, `url`) VALUES
(1, 2, 'facebook', 'https://www.facebook.com/kamiyab.asamadi'),
(2, 2, 'twitter', ''),
(3, 2, 'instagram', 'https://www.instagram.com/k.hussain_asamadi/'),
(4, 2, 'gplus', ''),
(5, 2, 'linkedin', 'https://www.linkedin.com/in/kamiyab-asamadi-1a26a713b/'),
(6, 2, 'websitelink', 'http://www.azadarehussaini.com'),
(7, 5, 'facebook', ''),
(8, 5, 'twitter', ''),
(9, 5, 'instagram', ''),
(10, 5, 'gplus', ''),
(11, 5, 'linkedin', ''),
(12, 5, 'websitelink', 'http://xload-xtreme.tk');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `studid` int(3) NOT NULL AUTO_INCREMENT,
  `regid` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gender` char(1) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `cityid` int(3) DEFAULT NULL,
  `about` text,
  `interest` varchar(30) DEFAULT NULL,
  `photo` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`studid`),
  KEY `regid` (`regid`),
  KEY `cityid` (`cityid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studid`, `regid`, `name`, `gender`, `address`, `cityid`, `about`, `interest`, `photo`) VALUES
(1, 3, 'Vaibhav Patel', 'm', 'Near Shiv Shankar Soc.', 1, '', 'Web Designing', 'assests/img/users/vaibhav-5a9f868849cc4.jpg'),
(2, 4, 'Mearaj Ambaliyasana', 'f', NULL, NULL, NULL, NULL, 'assests/img/default_F.png'),
(3, 6, 'Sudip Karmakar', 'm', '', 1, NULL, 'science', 'assests/img/default_M.png'),
(7, 10, 'Adani Sharma', 'm', NULL, NULL, NULL, NULL, 'assests/img/default_M.png'),
(8, 11, 'Shruti Gupta', 'f', NULL, NULL, NULL, NULL, 'assests/img/default_F.png'),
(9, 12, 'Rajesh Khanna', 'm', NULL, NULL, NULL, NULL, 'assests/img/default_M.png'),
(10, 13, 'Kajal Agrawal', 'f', NULL, NULL, NULL, NULL, 'assests/img/default_F.png'),
(11, 14, 'Patel Mitali', 'f', NULL, NULL, NULL, NULL, 'assests/img/users/mitali-5ab3506e72bf1.jpg'),
(12, 15, 'Udvadia Kamal', 'm', NULL, NULL, NULL, NULL, 'assests/img/default_M.png'),
(13, 17, 'Abbas Ali', 'm', NULL, NULL, NULL, NULL, 'assests/img/default_M.png');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`regid`) REFERENCES `register` (`regid`);

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`sectionid`) REFERENCES `section` (`sectionid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `content_ibfk_2` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `category` (`catid`),
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`instid`) REFERENCES `register` (`regid`);

--
-- Constraints for table `courseenroll`
--
ALTER TABLE `courseenroll`
  ADD CONSTRAINT `courseenroll_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`),
  ADD CONSTRAINT `courseenroll_ibfk_2` FOREIGN KEY (`regid`) REFERENCES `register` (`regid`);

--
-- Constraints for table `earning`
--
ALTER TABLE `earning`
  ADD CONSTRAINT `earning_ibfk_1` FOREIGN KEY (`regid`) REFERENCES `register` (`regid`);

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`regid`) REFERENCES `register` (`regid`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`regid`) REFERENCES `register` (`regid`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`regid`) REFERENCES `register` (`regid`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`senderregid`) REFERENCES `register` (`regid`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiverregid`) REFERENCES `register` (`regid`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`regid`) REFERENCES `register` (`regid`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`);

--
-- Constraints for table `social`
--
ALTER TABLE `social`
  ADD CONSTRAINT `social_ibfk_1` FOREIGN KEY (`regid`) REFERENCES `register` (`regid`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`regid`) REFERENCES `register` (`regid`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`cityid`) REFERENCES `city` (`cityid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
