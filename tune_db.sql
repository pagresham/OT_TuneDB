-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2017 at 07:28 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tune_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `LINKS`
--
create database tune_db;
use tune_db;
CREATE TABLE `LINKS` (
  `LINKS_ID` int(11) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(100) NOT NULL,
  `VERSION_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `LINKS`
--

INSERT INTO `LINKS` (`LINKS_ID`, `URL`, `DESCRIPTION`, `VERSION_ID`) VALUES
(4, 'https://www.youtube.com/watch?v=_fDVyb6y8GU', 'Here is someone playing Hiram Stamper''s version of this old tune.', 12),
(5, 'https://www.youtube.com/watch?v=4K_1uk1YHac', 'Here is the Wilders playing this tune.', 13),
(6, 'https://www.youtube.com/watch?v=gV98pfwsM3k', 'Here is the Great John Hartford playing Squirrel Hunters.', 13),
(7, 'https://www.youtube.com/watch?v=-wQZ3IjdT78', 'Travis and Trevor Stewart of North Carolina', 14),
(8, 'https://www.youtube.com/watch?v=pSdLf_oN4J4', 'Jason and Pharis Romero Playing Johhny Court the Widdow', 14),
(9, 'https://www.youtube.com/watch?v=7qNVl7hlr_k', 'Altamont, the tune', 22),
(10, 'https://www.youtube.com/watch?v=rMLcm73rqUc', 'Jack and Trisha playing Farewell Trion', 23),
(11, 'https://www.youtube.com/watch?v=KTLZC67ZuOo', 'The ''original'' recording from Bangin and Sawin. Fiddled by James Bryan', 23),
(12, 'https://www.youtube.com/watch?v=dUcWPpMNI7g', 'Tommy Jarrel Playing the Texas Gals', 24),
(13, 'https://www.youtube.com/watch?v=rKbZiPy1wBM', 'Billy Constable and friends playing a bluegrass version.\r\n', 24),
(14, 'https://www.youtube.com/watch?v=5KySVxVeqDI', 'More Texas Gals', 24),
(15, 'https://www.youtube.com/watch?v=z9e2D6WVtYs', 'Flatt and Scruggs play Sally Goodin', 27),
(16, 'https://www.youtube.com/watch?v=4P96PbGm1Oo', 'Cochetopa Canyon, Shootin Creek, and a beaver.\r\n', 29),
(17, 'https://www.youtube.com/watch?v=uc2UZx6ui1c', 'Rhys Jones and Friends play Possum on a Rail at Clifftop. ', 30),
(18, 'https://www.youtube.com/watch?v=VsnZxfkkoKQ', 'Turkey in the Straw Played on an old TV show', 31);

-- --------------------------------------------------------

--
-- Table structure for table `LISTS`
--

CREATE TABLE `LISTS` (
  `VERSION_ID` int(11) NOT NULL,
  `MEMBER_ID` int(11) NOT NULL,
  `SKILL_LVL` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `LISTS`
--

INSERT INTO `LISTS` (`VERSION_ID`, `MEMBER_ID`, `SKILL_LVL`) VALUES
(15, 14, 'learning'),
(16, 14, 'learning'),
(17, 14, 'learning'),
(18, 14, 'learning'),
(19, 16, 'learning'),
(20, 16, 'learning'),
(21, 16, 'learning'),
(22, 12, 'learning'),
(23, 12, 'learning'),
(25, 16, 'learning'),
(26, 14, 'learning'),
(28, 12, 'Learning'),
(30, 12, 'Learning'),
(31, 12, 'Mastered'),
(54, 12, 'Learning'),
(55, 12, 'Mastered'),
(56, 12, 'Learning');

-- --------------------------------------------------------

--
-- Table structure for table `MEMBERS`
--

CREATE TABLE `MEMBERS` (
  `MEMBER_ID` int(11) NOT NULL,
  `USERNAME` varchar(45) NOT NULL,
  `F_NAME` varchar(45) NOT NULL,
  `L_NAME` varchar(45) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ZIP_CODE` int(11) NOT NULL,
  `TOWN` varchar(45) DEFAULT NULL,
  `STATE` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `MEMBERS`
--

INSERT INTO `MEMBERS` (`MEMBER_ID`, `USERNAME`, `F_NAME`, `L_NAME`, `EMAIL`, `PASSWORD`, `ZIP_CODE`, `TOWN`, `STATE`) VALUES
(12, 'piercegresham', 'pierce', 'gresham', 'pierce@here.com', '$2y$10$IFQ9sWkyI4psS/n89zsrgeN.mikU01LjLutC7v0QH30JCWVxnO2VW', 81224, 'Keeseville', 'NY'),
(14, 'phoebebird', 'Phoebe', 'Gresham', 'phoebe@here.com', '$2y$10$ZdNTSvWG9MKmxwHA7SRdc.acPEFeHQ3wL.o4HyEHG4Odk0zc.np7e', 81224, 'Montpelier', 'Vermont'),
(15, 'RobinGresham', 'robin', 'gresham', 'robin@here.com', '$2y$10$MZM3Mf/1I6udIxUlrYjQie3xGKzqz.lL3m4/sPMBnZWjqepC3Joa6', 81224, 'Richmond', 'Vermont'),
(16, 'SageGresham', 'Sage', 'Gresham', 'sage@here.com', '$2y$10$qizZjDuaUFq0tVgIfBnnYuh1riG1iQQcQ9JYEbwStwEa20VIp3Ws6', 81224, 'Burlington', 'Vermont'),
(17, 'JimmyDean', 'Jimmy', 'Dean', 'jimmy@here.com', '$2y$10$NfFkBnUOaqRkklcGfmW8ueETSf4lYSYxUxg1WUsZXqTSLBjAw2cce', 5676, 'Bolton Valley', 'Vermont'),
(18, 'drewmurdza', 'Drew', 'Murdza', 'drew@drew.com', '$2y$10$QdlmHZUailfDqKJEbyuLQeBT66.O72a3XPj3MPWKK5YZPNmBaR6Eu', 81224, NULL, NULL),
(19, 'ryaneversole', 'Ryan', 'Eversole', 'ryan@ryan.com', '$2y$10$JuZB5K/aa56dvmtVlbtWqu4f.1tmVbgscSpBlKdq90PZPk64s8KPm', 41701, 'Hazard', 'Kentucky'),
(20, 'sampankratz', 'Sam', 'Pankratz', 'sam@sam.com', '$2y$10$dGlHv1Sj3MYJ6r3rSEpM.OVtKbscBj/l8vdhDgC77tpXDZgNoK8eW', 81224, 'Gunnison', 'Colorado');

-- --------------------------------------------------------

--
-- Table structure for table `RECORDINGS`
--

CREATE TABLE `RECORDINGS` (
  `RECORDINGS_ID` int(11) NOT NULL,
  `ARTIST` varchar(45) NOT NULL,
  `RECORD_LABEL` varchar(45) DEFAULT NULL,
  `RELEASE_DATE` date DEFAULT NULL,
  `VERSION_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SOURCES`
--

CREATE TABLE `SOURCES` (
  `SOURCES_ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(45) NOT NULL COMMENT 'Populate dropdown with this, as well as let user enter unique source.\n',
  `SOURCE_TYPE` varchar(20) NOT NULL,
  `ADD_INFO` varchar(100) DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SOURCES`
--

INSERT INTO `SOURCES` (`SOURCES_ID`, `DESCRIPTION`, `SOURCE_TYPE`, `ADD_INFO`) VALUES
(103, 'Jimmy Dean', 'Personal', 'Another great Source'),
(104, 'Bruce Green', 'Personal', 'None'),
(106, 'Kentucky Fiddle tunes Book', 'Book', 'The Jeff Todd Titan Book'),
(107, 'John Hartford', 'Personal', 'None'),
(108, 'Stuart Brothers', 'Audio-recording', 'None'),
(109, 'Dad', 'Personal', 'None'),
(110, 'Dad', 'Personal', 'None'),
(111, 'Dad', 'Personal', 'None'),
(112, 'Little Einsteins', 'Video-recording', 'None'),
(113, 'Lynard Skynard', 'Audio-recording', 'None'),
(114, 'Snoop Dizzle', 'Personal', 'None'),
(115, 'Dad', 'Personal', 'None'),
(116, 'Mississippi Fiddle Tunes', 'Audio-recording', 'This is the classic collection of Mississippi String Band recordings.'),
(117, 'Banging and Sawing', 'Audio-recording', 'Fiddled by James Bryan on the recording'),
(119, 'Rhyse Jones', 'Audio-recording', 'None'),
(120, 'Glee Class', 'Other', 'None'),
(121, 'Bubba George Stringband', 'Video-recording', 'None'),
(122, 'Bubba George Stringband', 'Video-recording', 'None'),
(123, 'Bubba George Stringband', 'Video-recording', 'None'),
(124, 'Bubba George Stringband', 'Video-recording', 'None'),
(125, 'Bubba George Stringband', 'Video-recording', 'None'),
(130, 'Dave Bing', 'Personal', 'Dave Bing, is a great traditional, West Va. Musician. I learned this tune from him at a fest.'),
(131, 'Dad', 'Personal', 'None'),
(133, 'Jimmy Dean', 'Audio-recording', 'None'),
(139, 'Bruce Green', 'Audio-recording', ' '),
(140, 'Jimmy Dean', 'Book', 'None'),
(141, 'Jimmy Dean', 'Video-recording', 'None'),
(145, 'Rhyse Jones', 'Audio-recording', 'None'),
(146, 'You Tube', 'Video-recording', 'A great old tv version found on You Tube'),
(163, 'thisthis', 'Book', 'None'),
(169, 'Fiddlers Fakebook', 'Book', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `VERSIONS`
--

CREATE TABLE `VERSIONS` (
  `VERSION_ID` int(11) NOT NULL,
  `SOURCES_ID` int(11) NOT NULL,
  `TUNE_NAME` varchar(60) NOT NULL,
  `TUNE_KEY` varchar(2) NOT NULL,
  `PARTS` int(11) NOT NULL,
  `MEMBER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `VERSIONS`
--

INSERT INTO `VERSIONS` (`VERSION_ID`, `SOURCES_ID`, `TUNE_NAME`, `TUNE_KEY`, `PARTS`, `MEMBER_ID`) VALUES
(15, 109, 'Mary Had a Little LAmb', 'A', 1, 14),
(16, 110, 'Twinkle Twinkls', 'G', 2, 14),
(17, 111, 'I like Coffee', 'A', 1, 14),
(18, 112, 'Little Einsteins Theme', 'C', 2, 14),
(19, 113, 'Freebird', 'Bb', 4, 16),
(20, 114, 'The Chronic', 'F', 5, 16),
(21, 115, 'The Wheels on the Bus', 'G', 2, 16),
(22, 116, 'Altamont', 'C', 2, 12),
(23, 117, 'Farewell Trion', 'C', 2, 12),
(25, 119, 'I got a gal in Baltimore', 'D', 2, 16),
(26, 120, 'One One Two One', 'G', 1, 14),
(28, 130, 'Sows Ear', 'C', 2, 12),
(30, 145, 'Possum on a rail', 'G', 2, 12),
(31, 146, 'Turkey in the Straw', 'D', 2, 12),
(54, 169, 'Devils Dream', 'A', 2, 12),
(55, 169, 'Salt Creek', 'A', 2, 12),
(56, 169, 'Bonapartes Retreat', 'D', 4, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `LINKS`
--
ALTER TABLE `LINKS`
  ADD PRIMARY KEY (`LINKS_ID`);

--
-- Indexes for table `LISTS`
--
ALTER TABLE `LISTS`
  ADD PRIMARY KEY (`VERSION_ID`,`MEMBER_ID`),
  ADD KEY `fk_MEMBER_has_VERSION_MEMBERS1_idx` (`MEMBER_ID`);

--
-- Indexes for table `MEMBERS`
--
ALTER TABLE `MEMBERS`
  ADD PRIMARY KEY (`MEMBER_ID`);

--
-- Indexes for table `RECORDINGS`
--
ALTER TABLE `RECORDINGS`
  ADD PRIMARY KEY (`RECORDINGS_ID`),
  ADD KEY `fk_RECORDINGS_TUNE_VERSION1_idx` (`VERSION_ID`);

--
-- Indexes for table `SOURCES`
--
ALTER TABLE `SOURCES`
  ADD PRIMARY KEY (`SOURCES_ID`);

--
-- Indexes for table `VERSIONS`
--
ALTER TABLE `VERSIONS`
  ADD PRIMARY KEY (`VERSION_ID`),
  ADD KEY `fk_TUNES_SOURCES1_idx` (`SOURCES_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `LINKS`
--
ALTER TABLE `LINKS`
  MODIFY `LINKS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `MEMBERS`
--
ALTER TABLE `MEMBERS`
  MODIFY `MEMBER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `RECORDINGS`
--
ALTER TABLE `RECORDINGS`
  MODIFY `RECORDINGS_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `SOURCES`
--
ALTER TABLE `SOURCES`
  MODIFY `SOURCES_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT for table `VERSIONS`
--
ALTER TABLE `VERSIONS`
  MODIFY `VERSION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `LISTS`
--
ALTER TABLE `LISTS`
  ADD CONSTRAINT `fk_MEMBER_has_VERSION_MEMBERS1` FOREIGN KEY (`MEMBER_ID`) REFERENCES `MEMBERS` (`MEMBER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MEMBER_has_VERSION_VERSIONS1` FOREIGN KEY (`VERSION_ID`) REFERENCES `VERSIONS` (`VERSION_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `RECORDINGS`
--
ALTER TABLE `RECORDINGS`
  ADD CONSTRAINT `fk_RECORDINGS_TUNE_VERSION1` FOREIGN KEY (`VERSION_ID`) REFERENCES `VERSIONS` (`VERSION_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `VERSIONS`
--
ALTER TABLE `VERSIONS`
  ADD CONSTRAINT `fk_TUNES_SOURCES1` FOREIGN KEY (`SOURCES_ID`) REFERENCES `SOURCES` (`SOURCES_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
