-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2014 at 01:27 PM
-- Server version: 5.0.95
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ehayn5db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ADDRESS`
--

CREATE TABLE IF NOT EXISTS `ADDRESS` (
  `AI` int(11) NOT NULL auto_increment COMMENT 'Address Index',
  `Street` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(2) NOT NULL,
  `ZipCode` int(5) NOT NULL,
  PRIMARY KEY  (`AI`),
  KEY `Number` (`Street`,`City`,`State`,`ZipCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `ADDRESS`
--

INSERT INTO `ADDRESS` (`AI`, `Street`, `City`, `State`, `ZipCode`) VALUES
(8, '', '', '', 0),
(11, '12 Main St.', 'Indianapolis', 'In', 46532),
(36, '123 fake st.', 'Plymouth', 'IN', 46563),
(24, '1234 My House', 'imn', 'IN', 99699),
(25, '1234 My House', 'Indianapolis', 'IN', 46237),
(23, '1234 My House', 'My City', 'My', 99699),
(19, '1301 S Michigan Ave', 'New York', 'Ne', 85215),
(32, '1542 Allen Court', 'Washington', 'VA', 48494),
(31, '1582 W. Michigan Ave.', 'Indianapolis', 'IN', 45215),
(41, '1600 Oopsadaisy', 'TestBurg', 'IN', 46235),
(22, '1600 Pennsylvania', 'Washington', 'DC', 20500),
(21, '2', '2', '2', 2),
(7, '307 N Main', 'Indianapolis', 'In', 46202),
(5, '307 S Main', 'Indianapolis', 'In', 46202),
(40, '330 Burton Lane', 'MItchell', 'IN', 47446),
(20, '3702 riverwood drive', 'Indianapolis', 'IN', 46214),
(34, '4411 staughton rds', 'new york', 'RF', 32999),
(10, '492 Marion St.', 'St. Petersburg', 'Vi', 57512),
(35, '66565 pen st', 'wash', 'IN', 65646),
(26, '721 W Hudson St', 'Washington', 'Wa', 84213),
(27, '732 S Main St.', 'Albon', 'Ar', 93213),
(30, '8268 W Michigan St', 'Indianapolis', 'IN', 46202),
(33, '86412 W. Main St.', 'Albany', 'NY', 62442),
(29, 'df', 'dsf', '33', 22222),
(28, 'df', 'dsf', 'df', 0),
(1, 'E Harrison St', 'Petersburg', 'VA', 86384),
(3, 'E Lincolnway', 'Madison', 'No', 39234),
(39, 'Lolz street', 'Whatever', 'IN', 12345),
(2, 'N Williams St', 'Chicago', 'Il', 57842),
(37, 'sdfsadf', 'asdfasdfsda', 'IN', 64646),
(4, 'Third St', 'Phoenix', 'Ar', 85638);

-- --------------------------------------------------------

--
-- Table structure for table `ADMIN`
--

CREATE TABLE IF NOT EXISTS `ADMIN` (
  `AID` int(11) NOT NULL auto_increment COMMENT 'Admin ID',
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY  (`AID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `AID` (`AID`,`FirstName`,`LastName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `ADMIN`
--

INSERT INTO `ADMIN` (`AID`, `FirstName`, `LastName`, `Email`, `Password`) VALUES
(2, 'Logan', 'Fuller', 'loganfuller13@hotmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(7, 'Kyle', 'Bruhn', 'kab701@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(14, 'tony', 'neel', 'tonyneel1127@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(17, 'frogboy', 'frogboy', 'tonyneel923@yahoo.com', 'dd5617fa68c0c0f35ddf2b31e4addae5a9651a37'),
(20, 'matt', 'mangold', 'mmangold7@gmail.com', 'ddf6c9a1df4d57aef043ca8610a5a0dea097af0b'),
(22, 'ethan', 'Hayn', 'black3math@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(23, 'Test First', 'Test Last', 'Hopetestproject@gmail.com', '5e0d4a9c365e9302ac6f98e1cef5ddeb3601ceb6'),
(24, 'Missing', 'Missing', 'elh3190@yahoo.com', '8eb30df65e97083076e0607bf306f8952a9ccf21');

-- --------------------------------------------------------

--
-- Table structure for table `ATTENDANCE`
--

CREATE TABLE IF NOT EXISTS `ATTENDANCE` (
  `TID` int(11) NOT NULL,
  `VID` int(11) NOT NULL,
  KEY `TID` (`TID`,`VID`),
  KEY `TID_2` (`TID`),
  KEY `TID_3` (`TID`),
  KEY `VID` (`VID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ATTENDANCE`
--

INSERT INTO `ATTENDANCE` (`TID`, `VID`) VALUES
(26, 52);

-- --------------------------------------------------------

--
-- Table structure for table `CONTACT`
--

CREATE TABLE IF NOT EXISTS `CONTACT` (
  `contactID` int(10) NOT NULL auto_increment,
  `firstName` varchar(70) NOT NULL,
  `lastName` varchar(70) NOT NULL,
  `client` varchar(3) NOT NULL default 'no',
  `donor` varchar(3) NOT NULL default 'no',
  `volunteer` varchar(3) NOT NULL default 'no',
  `dateOfBirth` varchar(20) NOT NULL,
  `organizationID` int(10) default NULL,
  `contactNotes` text NOT NULL,
  PRIMARY KEY  (`contactID`),
  KEY `organizationID` (`organizationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `CONTACT`
--

INSERT INTO `CONTACT` (`contactID`, `firstName`, `lastName`, `client`, `donor`, `volunteer`, `dateOfBirth`, `organizationID`, `contactNotes`) VALUES
(40, 'Alexanderrrr', 'TheGreat2', 'yes', 'yes', 'no', '1212-12-12', 9, 'Awesome12345678910123456789013r'),
(41, 'Felix', 'McDonald', 'yes', 'yes', 'yes', '', 9, 'Class notes\r\n1\r\n2\r\n3'),
(46, 'Gon', 'Sanders', 'no', 'yes', 'no', '', 9, 'Awesome'),
(64, 'Alexanderr', 'TheGreat', 'no', 'yes', 'no', '', NULL, 'Awesome'),
(65, 'Name', 'Last', 'yes', 'yes', 'no', '2222-02-22', NULL, 'newEdit'),
(67, 'Ethyn', 'Hayn', 'yes', 'no', 'yes', '1990-03-01', 34, 'Not Awesomelol'),
(104, 'Alexanderr', 'TheGreat', 'no', 'yes', 'no', '', 8, 'Awesome'),
(105, 'Alexander', 'TheGreat', 'no', 'yes', 'no', '1900/11/22', 8, 'Awesome'),
(106, 'Alexander', 'TheGreat', 'no', 'yes', 'no', '1900/11/22', 28, 'Awesome'),
(109, 'Alexander', 'TheGreat', 'no', 'yes', 'no', '1900/11/22', NULL, 'Awesome'),
(110, 'NotAlexander', 'PrettyMediocre', 'yes', 'no', 'no', '2017-01-02', 28, 'bljsdgf'),
(111, 'NotAlexander2', 'PrettyMediocre2', 'yes', 'no', 'no', '', 28, 'dfdf'),
(112, 'Newer Name', 'This Guy', 'no', 'no', 'no', '', 40, ''),
(113, 'meme', 'going', 'no', 'yes', 'no', '', 40, ''),
(114, 'May', 'Jun', 'yes', 'yes', 'no', '1981-12-22', 8, 'Remember Me2'),
(115, 'More', 'Contact', 'yes', 'yes', 'no', '1988-03-23', 8, 'Ener notes here'),
(116, 'Ashley', 'White', 'no', 'no', 'no', '1999-03-04', 8, 'ooooooooooooooooooo'),
(117, 'upload', 'pleasework', 'yes', 'no', 'no', '1991-12-12', 34, 'this will work'),
(118, '&lt;h1&gt;44545&lt;/h1&gt;', '4534535', 'no', 'no', 'no', '', 42, ''),
(119, 'Mayhh', 'yuo', 'no', 'yes', 'yes', '1111-12-12', 38, 'nn'),
(120, 'new', 'add', 'no', 'no', 'no', '', 9, ''),
(121, 'Alexander3', 'the456', 'no', 'no', 'yes', '23332-12-12', NULL, ''),
(122, 'Dalton', 'McMullen', 'no', 'no', 'no', '2014-12-31', 37, '');

-- --------------------------------------------------------

--
-- Table structure for table `CONTACT_ADDRESS`
--

CREATE TABLE IF NOT EXISTS `CONTACT_ADDRESS` (
  `contactID` int(10) NOT NULL,
  `addressDetail` varchar(30) character set utf8 NOT NULL,
  `City` varchar(30) NOT NULL,
  `State` varchar(30) NOT NULL,
  `Street` varchar(60) NOT NULL,
  `Apt` int(10) default NULL,
  `ZipCode` int(5) NOT NULL,
  KEY `contactID` (`contactID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CONTACT_ADDRESS`
--

INSERT INTO `CONTACT_ADDRESS` (`contactID`, `addressDetail`, `City`, `State`, `Street`, `Apt`, `ZipCode`) VALUES
(65, '', 'Avon', 'IN', '7046 E US 36', 0, 46123),
(106, 'Primary Address', '', '', 'test', 0, 0),
(106, 'Home Address', 'df', '', 'df', 0, 0),
(113, 'Home Address', 'Indaana', '', 'streeroad', 1233, 23344),
(115, 'Primary Address', 'Minicity', 'CT', 'IliveHere', 55, 34567),
(115, 'Primary Address', 'thisbeit', 'CO', 'youlivehere', 0, 65755),
(116, 'Other Address', 'citystate', 'WY', 'otheraddress', 234, 33321),
(40, 'Primary Address', 'Indianapolis', 'Indiana', '465 n state ave', 0, 46201),
(64, '', 'Avon', 'IN', '7046 E US 36', 0, 46123),
(67, '', 'Avon', 'IN', '7046 E US 36', 16, 46123),
(104, 'Home Address', 'Indianapolisd', 'IN', '465 N State Aved', 746, 46201),
(104, 'Primary Address', ';lkj', 'LA', '43lkj', 0, 0),
(41, 'Primary Address', 'Brazil', 'IN', '654 n drive', 456, 98745),
(119, 'Other Address', 'Indaana', 'AZ', 'streeroad', 1233, 23344),
(120, 'Other Address', 'InTown33', '', 'LivingRoad', 0, 22222),
(121, 'Work Address', 'InTown', 'DE', 'LivingRoad', 0, 45675),
(114, 'Work Address', 'InTown', 'CA', 'LivingRoad', 2442, 45675),
(114, 'Home Address', 'InTown', 'CA', '2581 Photon Ave.', 25, 45675);

-- --------------------------------------------------------

--
-- Table structure for table `CONTACT_EMAIL`
--

CREATE TABLE IF NOT EXISTS `CONTACT_EMAIL` (
  `contactID` int(10) NOT NULL,
  `Detail` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  KEY `contactID` (`contactID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CONTACT_EMAIL`
--

INSERT INTO `CONTACT_EMAIL` (`contactID`, `Detail`, `email`) VALUES
(65, 'primary', 'black3math@gmail.com'),
(105, 'Primary Email', 'cat2@df.com'),
(105, 'Other Email', 'cat@email.com'),
(106, 'Primary Email', 'cscin342@gmail.com'),
(109, 'Primary Email', 'fsaddsfsa@dasfsfd.com'),
(110, 'Primary Email', 'normal@notalex.com'),
(115, 'Work Email', 'emmethispls@more.com'),
(115, 'Work Email', 'myworkemail@hotmail.org'),
(111, 'Primary Email', 'asdf@gmail.com'),
(40, 'work email', 'myemail@gg.com'),
(64, 'primary', 'black3math@gmail.com'),
(67, 'primary', 'black3math@gmail.com'),
(104, 'Primary Email', 'testi;slkjdf@dfkja.com'),
(41, 'Primary Email', 'cat@meowmix.com'),
(119, 'Other Email', 'myworkemail@hotmail.org'),
(120, 'Other Email', 'myworke45mail@hotmail.org'),
(121, 'Other Email', 'thisemail@hotmail.com'),
(122, 'Primary Email', 'asdfasdfasdf123@gmail.com'),
(114, 'Work Email', 'thisemail@hotmail.com'),
(118, 'Primary Email', 'thisemail@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `CONTACT_FILE`
--

CREATE TABLE IF NOT EXISTS `CONTACT_FILE` (
  `contactID` int(10) NOT NULL,
  `Detail` varchar(30) NOT NULL,
  `fileLink` varchar(100) NOT NULL,
  KEY `contactID` (`contactID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CONTACT_FILE`
--

INSERT INTO `CONTACT_FILE` (`contactID`, `Detail`, `fileLink`) VALUES
(104, 'file', 'upload/CurrentTestFirst_CurrentTestLast_0.png'),
(105, 'file', 'upload/dfdfd_asdfasdf_0.png'),
(106, 'file', 'upload/Test_test_0.png'),
(109, 'file', 'upload/Larry_Bird_0.png'),
(110, 'file', 'upload/NotAlexander_PrettyMediocre_0.png'),
(112, 'file', 'upload/Newer Name_This Guy_0.png'),
(113, 'file', 'upload/meme_going_0.png'),
(114, 'file', 'upload/May_Jun_0.png'),
(115, 'file', 'upload/More_Contact_0.png'),
(116, 'file', 'upload/Ashley_White_0.png'),
(114, 'file', 'upload/May_Jun_1.jpg'),
(114, 'file', 'upload/May_Jun_3.jpg'),
(118, 'file', 'upload/44545_4534535_0'),
(119, 'file', 'upload/Mayhh_yuo_0'),
(122, 'file', 'upload/Dalton_McMullen_0.php');

-- --------------------------------------------------------

--
-- Table structure for table `CONTACT_PHONE`
--

CREATE TABLE IF NOT EXISTS `CONTACT_PHONE` (
  `contactID` int(10) NOT NULL,
  `Detail` varchar(30) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  KEY `contactID` (`contactID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CONTACT_PHONE`
--

INSERT INTO `CONTACT_PHONE` (`contactID`, `Detail`, `PhoneNumber`) VALUES
(65, 'Mobile', '(574)933-4191'),
(106, 'Primary Phone', '(111)333-2222'),
(109, 'Primary Phone', '(111)145-2814'),
(112, 'Primary Phone', '(555)858-88'),
(113, 'Home Phone', '(232)312-3333'),
(115, 'Other Phone', '(343)434-2342'),
(116, 'Home Phone', '(342)342-4323'),
(117, 'Other Phone', '(333)333-3332'),
(40, 'home phone', '2147483647'),
(40, 'cell phone', '2147483647'),
(64, 'Mobile', '5749334191'),
(67, 'primary', '(574)933-4191'),
(104, 'Primary Phone', '(549)876-5698'),
(104, 'Primary Phone', '(594)984-654'),
(46, 'Primary Phone', '(324)234-3453'),
(121, 'Primary Phone', '(232)312-3333'),
(122, 'Primary Phone', '(111)111-1111'),
(114, 'Primary Phone', '(312)323-4599'),
(118, 'Other Phone', '(232)312-3333');

-- --------------------------------------------------------

--
-- Table structure for table `DATABASE_USER`
--

CREATE TABLE IF NOT EXISTS `DATABASE_USER` (
  `userID` int(10) NOT NULL auto_increment,
  `firstName` varchar(70) NOT NULL,
  `lastName` varchar(70) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `permission` int(1) NOT NULL,
  `permissionSite` int(1) NOT NULL,
  PRIMARY KEY  (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `DATABASE_USER`
--

INSERT INTO `DATABASE_USER` (`userID`, `firstName`, `lastName`, `username`, `password`, `permission`, `permissionSite`) VALUES
(28, 'Ethan', 'Hayn', 'black3math@gmail.com', 'ddf6c9a1df4d57aef043ca8610a5a0dea097af0b', 1, 0),
(29, '', '', 'jjflower@imail.iu.edu', '3dfeb982dbfcfe28e2527bf0c9ff2da2c05012b4', 1, 2),
(37, '', '', 'ehayn@iupui.edu', 'ddf6c9a1df4d57aef043ca8610a5a0dea097af0b', 4, 2),
(38, '', '', 'mmangold7@gmail.com', 'ddf6c9a1df4d57aef043ca8610a5a0dea097af0b', 1, 0),
(39, '', '', 'cscin342@gmail.com', '4be8b614a2dee845a9aa73ef1c7f3e3d0dbbfcf1', 2, 1),
(40, '', '', 'loganfuller13@hotmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 0, 0),
(41, '', '', 'kab701@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 0, 0),
(42, '', '', 'tonyneel1127@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 0, 0),
(43, '', '', 'tonyneel923@yahoo.com', 'dd5617fa68c0c0f35ddf2b31e4addae5a9651a37', 0, 0),
(45, '', '', 'elh3190@yahoo.com', '8eb30df65e97083076e0607bf306f8952a9ccf21', 4, 2),
(46, 'John', 'Smith', 'elh3190@yahoo.com', '49c1057c44fc041ced3695d1f8aa6bf0f4b4a2d3', 1, 0),
(47, 'Marcy', 'Pedersen', 'pedersenm@mac.com', 'ddf6c9a1df4d57aef043ca8610a5a0dea097af0b', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `FILES`
--

CREATE TABLE IF NOT EXISTS `FILES` (
  `FID` int(11) NOT NULL auto_increment COMMENT 'File ID',
  `VID` int(11) NOT NULL COMMENT 'Volunteer ID',
  `Link` varchar(50) NOT NULL,
  KEY `FID` (`FID`,`VID`,`Link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `FILES`
--

INSERT INTO `FILES` (`FID`, `VID`, `Link`) VALUES
(19, 32, 'upload/FredGonzalez/files/0'),
(26, 39, 'upload/HenrySwade/files/0'),
(27, 42, 'upload/LogFull/files/contact.png'),
(28, 42, 'upload/LogFull/files/340Syllabus (2).pdf'),
(29, 42, 'upload/LogFull/files/340Syllabus.pdf'),
(30, 43, 'upload/JeremiahFlowers/files/May_Jun_3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `INCIDENTREPORT`
--

CREATE TABLE IF NOT EXISTS `INCIDENTREPORT` (
  `IID` int(11) NOT NULL auto_increment COMMENT 'Incident ID',
  `Volunteer` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Report` text NOT NULL,
  PRIMARY KEY  (`IID`),
  KEY `Volunteer` (`Volunteer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `INCIDENTREPORT`
--

INSERT INTO `INCIDENTREPORT` (`IID`, `Volunteer`, `Date`, `Report`) VALUES
(26, 7, '2014-02-17', ''),
(27, 52, '1991-04-18', 'Delete Test werere');

-- --------------------------------------------------------

--
-- Table structure for table `LAB4_DEPARTMENT`
--

CREATE TABLE IF NOT EXISTS `LAB4_DEPARTMENT` (
  `DID` int(11) NOT NULL auto_increment COMMENT 'Department ID',
  `Department` varchar(50) NOT NULL,
  PRIMARY KEY  (`DID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `LAB4_DEPARTMENT`
--

INSERT INTO `LAB4_DEPARTMENT` (`DID`, `Department`) VALUES
(1, 'Art and Design'),
(2, 'Business'),
(3, 'Dentistry'),
(4, 'Education'),
(5, 'Engineering and Technology'),
(6, 'Health and Rehabilitation'),
(7, 'Informatics and Computing'),
(8, 'Journalism'),
(9, 'Law'),
(10, 'Liberal Arts'),
(11, 'Medicine'),
(12, 'Nursing'),
(13, 'Philanthropy'),
(14, 'Physical Education and Tourism Managment'),
(15, 'Public and Environmental Affairs'),
(16, 'Public Health'),
(17, 'Science'),
(18, 'Social Work');

-- --------------------------------------------------------

--
-- Table structure for table `LAB4_REGISTRATION`
--

CREATE TABLE IF NOT EXISTS `LAB4_REGISTRATION` (
  `UID` int(11) NOT NULL auto_increment COMMENT 'User ID',
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Pass` varchar(50) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Department` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL COMMENT 'Status of User',
  `Activation` varchar(50) NOT NULL,
  `Activated` varchar(3) NOT NULL COMMENT 'Determines if User has activated the account.',
  PRIMARY KEY  (`UID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `FirstName` (`FirstName`,`LastName`,`Department`),
  KEY `Department` (`Department`),
  KEY `Gender` (`Gender`),
  KEY `Password` (`Pass`),
  KEY `Activation` (`Activation`),
  KEY `Activated` (`Activated`),
  KEY `Status` (`Status`),
  KEY `LastName` (`LastName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `LAB4_REGISTRATION`
--

INSERT INTO `LAB4_REGISTRATION` (`UID`, `FirstName`, `LastName`, `Email`, `Pass`, `Gender`, `Department`, `Status`, `Activation`, `Activated`) VALUES
(14, 'logan', 'fuller', 'loganfuller13@hotmail.com', 'd3be108edb464e68220fe19e53695d1d7959006c', 'Male', 7, 'Student', 'TZNA8JJTLJMYUOGVUCXALBL52ZETXFS33XJ38YV7B1JIKRR6F3', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `ORGANIZATION`
--

CREATE TABLE IF NOT EXISTS `ORGANIZATION` (
  `organizationID` int(10) NOT NULL auto_increment,
  `name` varchar(70) NOT NULL,
  `website` varchar(100) NOT NULL,
  `primaryContactID` int(10) default NULL,
  PRIMARY KEY  (`organizationID`),
  KEY `primaryContact` (`primaryContactID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `ORGANIZATION`
--

INSERT INTO `ORGANIZATION` (`organizationID`, `name`, `website`, `primaryContactID`) VALUES
(8, 'Hope Center', 'www.hope.com', 114),
(9, 'Dell', 'www.dell.com', NULL),
(28, 'Foodstuff', 'pepsi.com', 106),
(29, 'IUPUI', 'iupui.com', NULL),
(34, 'XOR Media', 'xormedia.com', NULL),
(35, 'Testing Orgg', 'sak;jasljdf.com', NULL),
(36, 'Test', 'dsfadf', NULL),
(37, 'TestOrg5', 'lol.com', NULL),
(38, 'ATTf', '', NULL),
(39, 'Jimmy John''', '', NULL),
(40, 'Jimmy John''s', '', NULL),
(41, '', '', NULL),
(42, 'Eureka', 'eureka.net', NULL),
(43, 'Testing the Display', 'test.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ORGANIZATION_ADDRESS`
--

CREATE TABLE IF NOT EXISTS `ORGANIZATION_ADDRESS` (
  `organizationID` int(10) NOT NULL,
  `City` varchar(30) NOT NULL,
  `State` varchar(30) NOT NULL,
  `Street` varchar(60) NOT NULL,
  `Zipcode` int(10) NOT NULL,
  KEY `contactID` (`organizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORGANIZATION_ADDRESS`
--

INSERT INTO `ORGANIZATION_ADDRESS` (`organizationID`, `City`, `State`, `Street`, `Zipcode`) VALUES
(29, 'Indianapolis', 'IN', '25122 University blvd', 46532),
(35, 'Atedsty', 'DE', 'TEst adress', 79865),
(36, 'asdf', 'IN', 'sdf', 0),
(37, 'sdf;ljk', 'KS', 'as;dlfkj', 54654),
(39, '', 'IN', '', 0),
(40, '', 'IN', '', 0),
(41, '', 'IN', '', 41521),
(34, 'Plymouth', 'GA', '11012 Queen Rd.', 46563),
(9, '', 'AL', 'test', 0),
(28, 'Avon', 'CO', '7046 E US 36', 46123),
(43, 'test city', 'IN', 'test add', 65456),
(42, 'test city', 'AL', '', 0),
(38, '', 'IN', '', 45656);

-- --------------------------------------------------------

--
-- Table structure for table `ORGANIZATION_FILE`
--

CREATE TABLE IF NOT EXISTS `ORGANIZATION_FILE` (
  `organizationID` int(10) NOT NULL,
  `Detail` varchar(30) NOT NULL,
  `fileLink` varchar(100) NOT NULL,
  KEY `contactID` (`organizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORGANIZATION_FILE`
--

INSERT INTO `ORGANIZATION_FILE` (`organizationID`, `Detail`, `fileLink`) VALUES
(34, 'file', 'upload/34_XOR Media_0.png'),
(36, 'file', 'upload/36_Test_0.png'),
(42, 'file', 'upload/42_Eureka_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ORGANIZATION_PHONE`
--

CREATE TABLE IF NOT EXISTS `ORGANIZATION_PHONE` (
  `organizationID` int(10) NOT NULL,
  `Detail` varchar(30) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  KEY `contactID` (`organizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORGANIZATION_PHONE`
--

INSERT INTO `ORGANIZATION_PHONE` (`organizationID`, `Detail`, `PhoneNumber`) VALUES
(29, 'primary', '(984)555-4158'),
(35, 'primary', '(498)756-4564'),
(36, 'primary', '(111)111-1111'),
(37, 'primary', ''),
(39, 'primary', ''),
(34, 'Primary Phone', '(574)936-3492'),
(34, 'Cell Phone', '(574)933-4191'),
(34, 'Other Phone', '(666)966-6666'),
(8, 'Home Phone', '(100)0');

-- --------------------------------------------------------

--
-- Table structure for table `PICTURE`
--

CREATE TABLE IF NOT EXISTS `PICTURE` (
  `PID` int(11) NOT NULL auto_increment,
  `PicLink` varchar(100) NOT NULL,
  PRIMARY KEY  (`PID`),
  KEY `PicLink` (`PicLink`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `PICTURE`
--

INSERT INTO `PICTURE` (`PID`, `PicLink`) VALUES
(7, ''),
(9, ''),
(10, ''),
(11, ''),
(12, ''),
(21, ''),
(22, ''),
(23, ''),
(26, ''),
(28, ''),
(29, ''),
(30, ''),
(40, ''),
(33, 'Chrysanthemum1.jpg'),
(34, 'Chrysanthemum1.jpg'),
(35, 'Chrysanthemum1.jpg'),
(36, 'Chrysanthemum1.jpg'),
(37, 'Chrysanthemum1.jpg'),
(38, 'Chrysanthemum1.jpg'),
(63, 'upload/anthonyneel/'),
(32, 'upload/dsfdf/Chrysanthemum1.jpg'),
(54, 'upload/EthanHayn/'),
(39, 'upload/FredGonzalez/'),
(8, 'upload/GeorgeWashington/washington.jpg'),
(5, 'upload/HenrCla/download (2).jpg'),
(48, 'upload/HenrySwade/'),
(44, 'upload/JamesMag/'),
(52, 'upload/JeremiahFlowers/ChooseFile.png'),
(65, 'upload/KyleBruhn/'),
(51, 'upload/LogFull/LittleKid.png'),
(64, 'upload/MarcyPedersen/'),
(53, 'upload/MattMangold/'),
(55, 'upload/MattMangold/'),
(56, 'upload/MattMangold/'),
(57, 'upload/MattMangold/'),
(58, 'upload/MattMangold/'),
(6, 'upload/tonyneel/chee.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `SPOUSE`
--

CREATE TABLE IF NOT EXISTS `SPOUSE` (
  `SID` int(11) NOT NULL auto_increment COMMENT 'Spouse ID',
  `SPFirstName` varchar(50) NOT NULL,
  `SPLastName` varchar(50) NOT NULL,
  PRIMARY KEY  (`SID`),
  KEY `FirstName` (`SPFirstName`,`SPLastName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `SPOUSE`
--

INSERT INTO `SPOUSE` (`SID`, `SPFirstName`, `SPLastName`) VALUES
(33, '', ''),
(32, 'Betty', 'Gonzalez'),
(2, 'Christina', 'Halcomb'),
(45, 'erer', 'sdsd'),
(48, 'Guy', 'Mister'),
(46, 'Hi', 'Bye'),
(5, 'jada', 'ram'),
(10, 'jadar', 'rama'),
(1, 'James', 'Tremming'),
(12, 'jenny', 'neel'),
(3, 'Larry', 'Fish'),
(17, 'Laur', 'Regen'),
(13, 'Laura', 'Regent'),
(16, 'Lauran', 'Regen'),
(14, 'Lauran', 'Regent'),
(15, 'Lauran', 'Regents'),
(31, 'Lauren', 'Mills'),
(42, 'Laurett', 'Henr'),
(40, 'Lauretta', 'Henry'),
(51, 'Madam', 'John'),
(47, 'Martha', 'Gozalez'),
(50, 'old', 'man'),
(4, 'Peter', 'Rogers'),
(43, 'Sam', 'Detzel'),
(11, 'Tara', 'Wierd'),
(44, 'That', 'Person');

-- --------------------------------------------------------

--
-- Table structure for table `TRAINING`
--

CREATE TABLE IF NOT EXISTS `TRAINING` (
  `TID` int(11) NOT NULL auto_increment COMMENT 'Training ID',
  `Title` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Notes` text NOT NULL,
  PRIMARY KEY  (`TID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `TRAINING`
--

INSERT INTO `TRAINING` (`TID`, `Title`, `Date`, `Notes`) VALUES
(26, 'Trainging test', '1991-04-18', '');

-- --------------------------------------------------------

--
-- Table structure for table `VOLUNTEER`
--

CREATE TABLE IF NOT EXISTS `VOLUNTEER` (
  `VID` int(11) NOT NULL auto_increment COMMENT 'Volunteer ID',
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `SID` int(11) NOT NULL COMMENT 'Spouse ID',
  `Email` varchar(50) NOT NULL,
  `PhoneNumber` bigint(10) NOT NULL,
  `AI` int(11) NOT NULL COMMENT 'Address Index',
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `EndEval` int(1) NOT NULL COMMENT 'Post Evaluation Complete?',
  `BirthDate` date NOT NULL,
  `JobTitle` varchar(50) NOT NULL,
  `PID` int(11) NOT NULL COMMENT 'Picture ID',
  `Notes` text NOT NULL,
  PRIMARY KEY  (`VID`),
  KEY `AI` (`AI`),
  KEY `BirthDate` (`BirthDate`,`JobTitle`,`PID`),
  KEY `PID` (`PID`),
  KEY `SID` (`SID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `VOLUNTEER`
--

INSERT INTO `VOLUNTEER` (`VID`, `FirstName`, `LastName`, `SID`, `Email`, `PhoneNumber`, `AI`, `StartDate`, `EndDate`, `EndEval`, `BirthDate`, `JobTitle`, `PID`, `Notes`) VALUES
(3, 'Henry', 'Allen', 3, 'allenman32@yahoo.com', 0, 3, '2014-02-04', '2014-02-27', 1, '0000-00-00', 'Terminated', 7, ''),
(4, 'Barry', 'Aster', 4, 'basterry@live.com', 0, 4, '2014-02-03', '2014-02-14', 0, '0000-00-00', 'Mentor', 7, 'Great Performance.'),
(7, 'Logan', 'Fuller', 11, 'loganfuller13@hotmail.com', 5555555555, 1, '2001-01-01', '2001-01-14', 0, '1994-07-27', 'Tester', 7, ''),
(8, 'anthony', 'neel', 12, 'tonyneel923@yahoo.com', 2147483647, 1, '1993-09-23', '2010-09-01', 0, '1999-09-12', 'hahas', 7, ''),
(13, 'Freddy', 'Gonzalez', 32, 'fgon@gmail.com', 9227868423, 11, '0000-00-00', '2013-03-13', 0, '1984-07-14', 'Manager', 7, ''),
(14, 'Henr', 'Cla', 42, 'hcla@gmail.com', 8264788562, 19, '2014-01-01', '2012-10-26', 0, '1998-10-29', 'Test', 5, ''),
(15, 'tony', 'neel', 43, 'tonyneel923@yahoo.com', 3176901789, 20, '2014-04-01', '2014-04-15', 0, '1993-09-23', 'Manager', 6, ''),
(32, 'Fred', 'Gonzalez', 47, 'fgonzalez@gmail.com', 8786512482, 30, '0000-00-00', '2011-01-31', 0, '0000-00-00', 'Marketing', 39, ''),
(43, 'Jeremiah', 'going', 48, 'jflower@flowa.org', 2312322222, 34, '2013-12-12', '1991-11-11', 0, '2015-12-12', 'person', 52, 'NOTESW'),
(44, 'Matt', 'Mangold', 33, 'mmangold777@mailinator.com', 6665656565, 35, '2014-01-01', '2015-01-01', 0, '2000-01-01', 'pres', 53, 'testing'),
(50, 'anthony', 'neel', 33, 'antneel@iupui.edu', 1234567890, 39, '0001-01-01', '0001-01-01', 0, '0001-01-01', 'huh', 63, ''),
(51, 'Marcy', 'Pedersen', 50, 'pedersenm@mac.com', 8128496599, 40, '0000-00-00', '0000-00-00', 0, '0000-00-00', 'slave', 64, ''),
(52, 'Kyle', 'Bruhn', 51, 'kab701@gmail.com', 5559874563, 41, '1554-12-19', '4523-05-12', 0, '1991-04-18', 'Test Subject', 65, 'Kyle Test');

-- --------------------------------------------------------

--
-- Stand-in structure for view `VW_INCIDENT`
--
CREATE TABLE IF NOT EXISTS `VW_INCIDENT` (
`IID` int(11)
,`FirstName` varchar(50)
,`LastName` varchar(50)
,`Date` date
,`Report` text
);
-- --------------------------------------------------------

--
-- Table structure for table `VW_INCIDENT_EDIT`
--

CREATE TABLE IF NOT EXISTS `VW_INCIDENT_EDIT` (
  `VID` int(11) default NULL,
  `IID` int(11) default NULL,
  `FirstName` varchar(50) default NULL,
  `LastName` varchar(50) default NULL,
  `Date` date default NULL,
  `Report` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `VW_INCIDENT_EDIT`
--


-- --------------------------------------------------------

--
-- Table structure for table `VW_TRAINING`
--

CREATE TABLE IF NOT EXISTS `VW_TRAINING` (
  `TID` int(11) default NULL,
  `Title` varchar(50) default NULL,
  `Date` date default NULL,
  `VID` int(11) default NULL,
  `FirstName` varchar(50) default NULL,
  `LastName` varchar(50) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `VW_TRAINING`
--


-- --------------------------------------------------------

--
-- Table structure for table `VW_TRAINING_EDIT`
--

CREATE TABLE IF NOT EXISTS `VW_TRAINING_EDIT` (
  `VID` int(11) default NULL,
  `TID` int(11) default NULL,
  `FirstName` varchar(50) default NULL,
  `LastName` varchar(50) default NULL,
  `Title` varchar(50) default NULL,
  `Date` date default NULL,
  `Notes` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `VW_TRAINING_EDIT`
--


-- --------------------------------------------------------

--
-- Table structure for table `VW_VOLUNTEER`
--

CREATE TABLE IF NOT EXISTS `VW_VOLUNTEER` (
  `VID` int(11) default NULL,
  `PicLink` varchar(100) default NULL,
  `FirstName` varchar(50) default NULL,
  `LastName` varchar(50) default NULL,
  `SPFirstName` varchar(50) default NULL,
  `SPLastName` varchar(50) default NULL,
  `Email` varchar(50) default NULL,
  `PhoneNumber` bigint(10) default NULL,
  `Street` varchar(50) default NULL,
  `City` varchar(50) default NULL,
  `STATE` varchar(2) default NULL,
  `ZipCode` int(5) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `VW_VOLUNTEER`
--


-- --------------------------------------------------------

--
-- Table structure for table `VW_VOLUNTEER_EDIT`
--

CREATE TABLE IF NOT EXISTS `VW_VOLUNTEER_EDIT` (
  `VID` int(11) default NULL,
  `FirstName` varchar(50) default NULL,
  `LastName` varchar(50) default NULL,
  `SPFirstName` varchar(50) default NULL,
  `SPLastName` varchar(50) default NULL,
  `Email` varchar(50) default NULL,
  `PhoneNumber` bigint(10) default NULL,
  `StartDate` date default NULL,
  `EndDate` date default NULL,
  `BirthDate` date default NULL,
  `JobTitle` varchar(50) default NULL,
  `PicLink` varchar(100) default NULL,
  `Notes` text,
  `Street` varchar(50) default NULL,
  `City` varchar(50) default NULL,
  `STATE` varchar(2) default NULL,
  `ZipCode` int(5) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `VW_VOLUNTEER_EDIT`
--


-- --------------------------------------------------------

--
-- Structure for view `VW_INCIDENT`
--
DROP TABLE IF EXISTS `VW_INCIDENT`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ehayn`@`localhost` SQL SECURITY DEFINER VIEW `VW_INCIDENT` AS select `INCIDENTREPORT`.`IID` AS `IID`,`VOLUNTEER`.`FirstName` AS `FirstName`,`VOLUNTEER`.`LastName` AS `LastName`,`INCIDENTREPORT`.`Date` AS `Date`,`INCIDENTREPORT`.`Report` AS `Report` from (`VOLUNTEER` join `INCIDENTREPORT`) where (`VOLUNTEER`.`VID` = `INCIDENTREPORT`.`Volunteer`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CONTACT`
--
ALTER TABLE `CONTACT`
  ADD CONSTRAINT `CONTACT_ibfk_1` FOREIGN KEY (`organizationID`) REFERENCES `ORGANIZATION` (`organizationID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CONTACT_ADDRESS`
--
ALTER TABLE `CONTACT_ADDRESS`
  ADD CONSTRAINT `CONTACT_ADDRESS_ibfk_1` FOREIGN KEY (`contactID`) REFERENCES `CONTACT` (`contactID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CONTACT_EMAIL`
--
ALTER TABLE `CONTACT_EMAIL`
  ADD CONSTRAINT `CONTACT_EMAIL_ibfk_1` FOREIGN KEY (`contactID`) REFERENCES `CONTACT` (`contactID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CONTACT_FILE`
--
ALTER TABLE `CONTACT_FILE`
  ADD CONSTRAINT `CONTACT_FILE_ibfk_1` FOREIGN KEY (`contactID`) REFERENCES `CONTACT` (`contactID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CONTACT_PHONE`
--
ALTER TABLE `CONTACT_PHONE`
  ADD CONSTRAINT `CONTACT_PHONE_ibfk_1` FOREIGN KEY (`contactID`) REFERENCES `CONTACT` (`contactID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ORGANIZATION`
--
ALTER TABLE `ORGANIZATION`
  ADD CONSTRAINT `ORGANIZATION_ibfk_1` FOREIGN KEY (`primaryContactID`) REFERENCES `CONTACT` (`contactID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ORGANIZATION_ADDRESS`
--
ALTER TABLE `ORGANIZATION_ADDRESS`
  ADD CONSTRAINT `ORGANIZATION_ADDRESS_ibfk_1` FOREIGN KEY (`organizationID`) REFERENCES `ORGANIZATION` (`organizationID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ORGANIZATION_FILE`
--
ALTER TABLE `ORGANIZATION_FILE`
  ADD CONSTRAINT `ORGANIZATION_FILE_ibfk_1` FOREIGN KEY (`organizationID`) REFERENCES `ORGANIZATION` (`organizationID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ORGANIZATION_PHONE`
--
ALTER TABLE `ORGANIZATION_PHONE`
  ADD CONSTRAINT `ORGANIZATION_PHONE_ibfk_1` FOREIGN KEY (`organizationID`) REFERENCES `ORGANIZATION` (`organizationID`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_COUNT_ADDRESS`(IN ad VARCHAR(50), IN adc VARCHAR(50), IN ads VARCHAR(50), IN adz INT(5), OUT count INT)
Select count(*) into count from ADDRESS where Street = ad and City = adc and State = ads and ZipCode = adz$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_COUNT_ADMIN`(IN fn VARCHAR(50), IN ln VARCHAR(50), IN em VARCHAR(50), OUT count INT)
Select count(*) into count from DATABASE_USER where firstName = fn and lastName = ln and username = em$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_COUNT_ATTENDANCE`(IN trid INT(11), IN void INT(11), OUT count INT)
Select count(*) into count from ATTENDANCE where TID = trid and VID = void$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_COUNT_INCIDENT`(IN vid INT(11), IN da DATE, OUT count INT)
Select count(*) into count from INCIDENTREPORT where Volunteer = vid and Date = da$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_COUNT_SPOUSE`(IN fn VARCHAR(50), IN ln VARCHAR(50), OUT count INT)
Select count(*) into count from SPOUSE where FirstName = fn and LastName = ln$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_COUNT_TRAINING`(IN ti VARCHAR(50), OUT count INT)
Select count(*) into count from TRAINING where Title = ti$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_COUNT_USER`(IN uname VARCHAR(50), IN pwd VARCHAR(50), OUT count INT)
Select count(*) into count from DATABASE_USER where username = uname and password = pwd$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_COUNT_VOLUNTEER`(IN fn VARCHAR(50), IN ln VARCHAR(50), IN em VARCHAR(50), OUT count INT)
Select count(*) into count from VOLUNTEER where FirstName = fn and LastName = ln and Email = em$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_COUNT_VOLUNTEER_TRAINING`(IN fn VARCHAR(50), IN ln VARCHAR(50), OUT count INT)
Select count(*) into count from VOLUNTEER where FirstName = fn and LastName = ln$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_FIND_ADDRESS_ID`(IN ad VARCHAR(50), IN adc VARCHAR(50), IN ads VARCHAR(50), IN adz INT(5), OUT adi INT)
Select AI into adi from ADDRESS where Street = ad and City = adc and State = ads and ZipCode = adz$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_FIND_O_ID`(IN orgName VARCHAR(70), OUT oID INT(10))
Select organizationID into oID from ORGANIZATION where name = orgName$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_FIND_PERMISSION`(IN uname VARCHAR(50), IN pwd VARCHAR(50), OUT perm INT)
Select permission into perm from DATABASE_USER where username = uname and password = pwd$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_FIND_PERMISSIONSITE`(IN uname VARCHAR(50), IN pwd VARCHAR(50), OUT permsite INT)
Select permissionSite from DATABASE_USER where username = uname and password = pwd$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_FIND_PICTURE`(IN pc VARCHAR(100), OUT pi INT)
Select PID into pi from PICTURE where PicLink = pc$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_FIND_SPOUSE_ID`(IN fn VARCHAR(50), IN ln VARCHAR(50), OUT spid INT)
Select SID into spid from SPOUSE where FirstName = fn and LastName = ln$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_FIND_TRAINING_ID`(IN ti VARCHAR(50), OUT trainid INT)
Select TID into trainid from TRAINING where Title = ti$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_FIND_USER_ID`(IN uname VARCHAR(50), IN pwd VARCHAR(50), OUT uid INT)
Select userID into uid from DATABASE_USER where username = uname and password = pwd$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_FIND_VOLUNTEER_ID`(IN fn VARCHAR(50), IN ln VARCHAR(50), OUT volid INT)
Select VID into volid from VOLUNTEER where FirstName = fn and LastName = ln$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_ADDRESS`(IN ad VARCHAR(50), IN adc VARCHAR(50), IN ads VARCHAR(50), IN adz INT(5))
Insert into ADDRESS values(null, ad, adc, ads, adz)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_ADMIN`(IN fn VARCHAR(50), IN ln VARCHAR(50), IN em VARCHAR(50), IN pass VARCHAR(50))
Insert into DATABASE_USER values(null, fn, ln, em, pass, 1, 0)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_ATTENDANCE`(IN TID INT(11), IN VID INT(11))
Insert into ATTENDANCE values(TID, VID)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_CONTACT`(IN firstName VARCHAR(70), IN lastName VARCHAR(70), IN client VARCHAR(3), IN donor VARCHAR(3), IN volunteer VARCHAR(3), IN dob VARCHAR(20), IN notes TEXT)
insert into CONTACT values (null, firstName, lastName, client, donor, volunteer, dob, null, notes)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_CONTACT_ADDRESS`(IN contactID INT(10), IN contactDetail VARCHAR(30), IN City VARCHAR(30), IN State VARCHAR(30), IN Street VARCHAR(60), IN Apt INT(10), IN ZipCode INT(5))
insert into CONTACT_ADDRESS values (contactID, contactDetail, City, State, Street, Apt, ZipCode)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_CONTACT_EMAIL`(IN contactID INT(10), IN detail VARCHAR(30), IN email VARCHAR(40))
insert into CONTACT_EMAIL values (contactID, detail, email)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_CONTACT_FILE`(IN contactID INT(10), IN Detail VARCHAR(30), IN fileLink VARCHAR(100))
insert into CONTACT_FILE values (contactID, Detail, fileLink)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_CONTACT_O`(IN firstName VARCHAR(70), IN lastName VARCHAR(70), IN client VARCHAR(3), IN donor VARCHAR(3), IN volunteer VARCHAR(3), IN dob VARCHAR(20), IN orgID INT(10), IN notes TEXT)
insert into CONTACT values (null, firstName, lastName, client, donor, volunteer, dob, orgID, notes)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_CONTACT_PHONE`(IN contactID INT(10), IN Detail VARCHAR(30), IN PhoneNumber VARCHAR(20))
insert into CONTACT_PHONE values (contactID, Detail, PhoneNumber)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_FILE`(IN vid INT(11), IN link VARCHAR(50))
Insert into FILES values(null, vid, link)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_INCIDENT`(IN Volunteer INT(11), IN Date DATE, IN Report TEXT)
Insert into INCIDENTREPORT values(null, Volunteer, Date, Report)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_NEWTRAIN`(IN na VARCHAR(50), IN da DATE, IN dt TEXT)
Insert into TRAINING values (null, na, da, dt)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_ORGANIZATION`(IN name VARCHAR(70), IN website VARCHAR(100))
insert into ORGANIZATION values (null, name, website, null)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_ORGANIZATION_ADDRESS`(IN organizationID INT(10), IN City VARCHAR(30), IN State VARCHAR(30), IN Street VARCHAR(60), IN Zipcode INT(10))
insert into ORGANIZATION_ADDRESS values (organizationID, City, State, Street, Zipcode)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_ORGANIZATION_FILE`(IN organizationID INT(10), IN Detail VARCHAR(30), IN fileLink VARCHAR(100))
insert into ORGANIZATION_FILE values (organizationID, Detail, fileLink)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_ORGANIZATION_PHONE`(IN organizationID INT(10), IN Detail VARCHAR(30), IN PhoneNumber VARCHAR(20))
insert into ORGANIZATION_PHONE values (organizationID, Detail, PhoneNumber)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_PICTURE`(IN pc VARCHAR(100))
Insert into PICTURE values(null, pc)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_SPOUSE`(IN fn VARCHAR(50), IN ln VARCHAR(50))
Insert into SPOUSE values(null, fn, ln)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_USER`(IN uname VARCHAR(50), IN pwd VARCHAR(50), IN perm int(1), IN permSite int(1))
insert into DATABASE_USER values (null, uname, pwd, perm, permsite)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_INSERT_VOLUNTEER`(IN FirstName VARCHAR(50), IN LastName VARCHAR(50), IN SID INT(11), IN Email VARCHAR(50), IN PhoneNumber BIGINT(10), IN AI INT(11), IN StartDate DATE, IN EndDate DATE, IN BirthDate DATE, IN JobTitle VARCHAR(50), IN Picture VARCHAR(50), IN Notes TEXT)
Insert into VOLUNTEER values(null, FirstName, LastName, SID, Email, PhoneNumber, AI, StartDate, EndDate, 0, BirthDate, JobTitle, Picture, Notes)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_UPDATE_CONTACT`(IN updateContactID INT(10), IN updateFirstName VARCHAR(70), IN updateLastName VARCHAR(70), IN updateClient VARCHAR(3), IN updateDonor VARCHAR(3), IN updateVolunteer VARCHAR(3), IN updatedob VARCHAR(20), IN updateNotes TEXT)
UPDATE CONTACT SET firstName = updateFirstName, lastName = updateLastName, client = updateClient, donor = updateDonor, volunteer = updateVolunteer, dateOfBirth = updatedob, contactNotes = updateNotes WHERE (contactID = updateContactID)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_UPDATE_CONTACT_O`(IN updateContactID INT(10), IN updateFirstName VARCHAR(70), IN updateLastName VARCHAR(70), IN updateClient VARCHAR(3), IN updateDonor VARCHAR(3), IN updateVolunteer VARCHAR(3), IN updatedob VARCHAR(20), IN orgID INT(10), IN updateNotes TEXT)
UPDATE CONTACT SET firstName = updateFirstName, lastName = updateLastName, client = updateClient, donor = updateDonor, volunteer = updateVolunteer, dateOfBirth = updatedob, organizationID = orgID, contactNotes = updateNotes WHERE (contactID = updateContactID)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_UPDATE_ORGANIZATION`(IN updateOID INT(10), IN updateName VARCHAR(70), IN updateSite VARCHAR(100), IN updateContact INT(10))
UPDATE ORGANIZATION SET name = updateName, website = updateSite, primaryContactID = updateContact WHERE (organizationID = updateOID)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_UPDATE_PASSWORD`(IN pass VARCHAR(50), IN em VARCHAR(50))
UPDATE DATABASE_USER SET password = pass where username = em$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_UPDATE_USER`(IN updateUserID INT(10), IN updateFirstName VARCHAR(70), IN updateLastName VARCHAR(70), IN updateEmail VARCHAR(70), IN updatePermission VARCHAR(100), IN updateSitePermission INT(10))
UPDATE DATABASE_USER SET firstName = updateFirstName, lastName = updateLastName, username = updateEmail, permission = updatePermission, permissionSite = updateSitePermission WHERE (userID = updateUserID)$$

CREATE DEFINER=`ehayn`@`localhost` PROCEDURE `SP_VALIDATE_PASSWORD`(IN em VARCHAR(50), OUT pass VARCHAR(50))
Select Password into pass from DATABASE_USER where username = em$$

DELIMITER ;
