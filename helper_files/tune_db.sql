-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2017 at 02:37 AM
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
(18, 'https://www.youtube.com/watch?v=VsnZxfkkoKQ', 'Turkey in the Straw Played on an old TV show', 31),
(19, 'https://www.youtube.com/watch?v=J-GYhg9gIaU', 'WheelHoss Played by the Bluegrass Album Band', 62),
(20, 'https://www.youtube.com/watch?v=0IyomC16KTo', 'Charlie Acuff Playin the Old Yeller Dog', 69),
(22, 'https://www.youtube.com/watch?v=iz0WcPu5mEU', 'Bruce Molsky playing Jeff Sturgeon, and some fine dancing.', 71),
(23, 'https://www.youtube.com/watch?v=iz0WcPu5mEU', 'Bruce Molsky playing Jeff Sturgeon, and some fine dancing.', 71),
(24, 'https://www.youtube.com/watch?v=zQbQABKiJ_8', 'Chance Mcoy and the Appalachian String Band play Waynsboro', 77),
(25, 'https://www.youtube.com/watch?v=3FXGQ2AYz94', 'Bonapartes Retreat played by John Hartford and his band.', 56),
(26, 'https://www.youtube.com/watch?v=Cm7ckNRuiX0', 'Ways of the World played by Andy Fitzgibbon', 76),
(27, 'https://www.youtube.com/watch?v=EYlh60ObgZI', 'Meg Gray played by Brian Scott', 78),
(28, 'https://www.youtube.com/watch?v=5-Fg5SCoeBA', 'Duck River and Dry and Dusty played by Brittany Haas', 79),
(29, 'https://www.youtube.com/watch?v=HOiEP7s-UAc', 'Beaumont Rag, played by Jonny Gimble', 81);

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
(56, 12, 'Learning'),
(57, 22, 'Mastered'),
(58, 22, 'Mastered'),
(59, 22, 'Interested'),
(60, 14, 'Interested'),
(61, 18, 'Learning'),
(62, 18, 'Mastered'),
(63, 18, 'Mastered'),
(64, 18, 'Mastered'),
(65, 18, 'Learning'),
(66, 20, 'Mastered'),
(67, 20, 'Mastered'),
(68, 20, 'Mastered'),
(69, 20, 'Mastered'),
(70, 20, 'Interested'),
(71, 12, 'Mastered'),
(72, 18, 'Learning'),
(73, 18, 'Mastered'),
(74, 18, 'Mastered'),
(75, 12, 'Interested'),
(76, 12, 'Learning'),
(77, 12, 'Learning'),
(78, 12, 'Learning'),
(79, 12, 'Mastered'),
(80, 20, 'Mastered'),
(81, 20, 'Mastered');

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
(18, 'drewmurdza', 'Drew', 'Murdza', 'drew@drew.com', '$2y$10$QdlmHZUailfDqKJEbyuLQeBT66.O72a3XPj3MPWKK5YZPNmBaR6Eu', 81224, 'Gunnison', 'Colorado'),
(19, 'ryaneversole', 'Ryan', 'Eversole', 'ryan@ryan.com', '$2y$10$JuZB5K/aa56dvmtVlbtWqu4f.1tmVbgscSpBlKdq90PZPk64s8KPm', 41701, 'Hazard', 'Kentucky'),
(20, 'sampankratz', 'Sam', 'Pankratz', 'sam@sam.com', '$2y$10$dGlHv1Sj3MYJ6r3rSEpM.OVtKbscBj/l8vdhDgC77tpXDZgNoK8eW', 81224, 'Gunnison', 'Colorado'),
(22, 'jimmymartin', 'Jimmy', 'Martin', 'jimmy@ilovehounddogs.com', '$2y$10$C9stjDhNgKJDlAZ4TJENfuRhtzOD1ulvcP1BM6tiCc4aKTup/9zde', 37869, 'Sneedville', 'Tennessee'),
(23, 'luvdafiddle', 'Luvda', 'Fiddle', 'iluvdafiddle@here.com', '$2y$10$TVIfHxk1UBBxfTnV3Uj2oOHuUB6gm.i9.34V4AAkBgWyopiDxjzf.', 26241, 'Elkins', 'West Virginia');

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
(169, 'Fiddlers Fakebook', 'Book', 'None'),
(170, 'The King of Bluegrass', 'Personal', 'A great song about Jimmy''s favorite coondog, Ol Pete'),
(171, 'Eck Roberts', 'Personal', 'Sally Goodin is a staple tune in Texas Fiddling contests'),
(172, 'Earl Scruggs', 'Personal', 'The Classic bluegrass banjo tune, from the movie Bonnie and Clyde'),
(173, 'Tchaikovsky', 'Audio-recording', 'The march from the Nutcracker'),
(174, 'Bill Monroe', 'Audio-recording', 'Bill wrote many tunes. Wheel Hoss is a Boss!'),
(175, 'French Carpenter', 'Personal', 'French Carpenter lived in the first part of the 20th Century. '),
(176, 'Ralph Stanley', 'Personal', 'None'),
(177, 'Chance Mcoy', 'Personal', 'Contemporary West Virginia Musician');

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
(56, 169, 'Bonapartes Retreat', 'D', 4, 12),
(57, 170, 'Run Pete Run', 'G', 2, 22),
(58, 171, 'Sally Goodin', 'A', 4, 22),
(59, 172, 'Foggy Mountain Breakdown', 'G', 2, 22),
(60, 173, 'Ode to Joy', 'C', 4, 14),
(61, 169, 'Cherokee Shuffle', 'A', 2, 18),
(62, 174, 'Wheel Hoss', 'G', 2, 18),
(63, 175, 'Elk Creek', 'D', 2, 18),
(64, 107, 'Dawgs Due', 'F', 3, 18),
(65, 173, 'Caravan', 'F', 2, 18),
(66, 141, 'Gunnison Blues', 'B', 3, 20),
(67, 146, 'Chinquapin Hunting', 'D', 2, 20),
(68, 176, 'Clinch Mountain Backstep', 'A', 2, 20),
(69, 131, 'Old Yeller Dog', 'G', 2, 20),
(70, 169, 'Jenny Lynn', 'A', 2, 20),
(71, 106, 'Jeff Sturgeon', 'A', 3, 12),
(72, 106, 'New Five Cents', 'D', 3, 18),
(73, 106, 'Old Christmas', 'A', 2, 18),
(74, 169, 'Arkansas Traveller', 'D', 2, 18),
(75, 106, 'Turkey in a Peapatch', 'D', 2, 12),
(76, 106, 'Ways of the World', 'A', 3, 12),
(77, 177, 'Waynsboro', 'G', 2, 12),
(78, 106, 'Maggie Gray', 'A', 2, 12),
(79, 106, 'Duck River', 'D', 2, 12),
(80, 131, 'Dry and Dusty', 'D', 2, 20),
(81, 106, 'Beaumont Rag', 'C', 2, 20);

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
  MODIFY `LINKS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `MEMBERS`
--
ALTER TABLE `MEMBERS`
  MODIFY `MEMBER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `RECORDINGS`
--
ALTER TABLE `RECORDINGS`
  MODIFY `RECORDINGS_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `SOURCES`
--
ALTER TABLE `SOURCES`
  MODIFY `SOURCES_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;
--
-- AUTO_INCREMENT for table `VERSIONS`
--
ALTER TABLE `VERSIONS`
  MODIFY `VERSION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
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
