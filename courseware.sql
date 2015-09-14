-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2015 at 09:58 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
create database courseware;
USE courseware;


set foreign_key_checks = 0;



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `courseware`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--
CREATE TABLE IF NOT EXISTS `Course` (
`course_id` int(10) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `objective` varchar(500) NOT NULL,
  `topics` varchar(500) NOT NULL,
  `course_references` varchar(500) NOT NULL,
  `prerequisite` varchar(250) NOT NULL,
  `time_frame` varchar(50) NOT NULL,
  `assessment` varchar(500) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `professor_id` int(10) NOT NULL,
  primary key(course_id),
  FOREIGN KEY (faculty_id) REFERENCES Faculty(Faculty_Id),
  FOREIGN KEY (professor_id) REFERENCES Professor(professor_id)
  
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credential`
--

CREATE TABLE IF NOT EXISTS `Credentials` (
  `professor_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  primary key (username),
  FOREIGN KEY (professor_id) REFERENCES Professor(professor_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credential`
--

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `Faculty` (
  `faculty_id` int(10) NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(200) NOT NULL,
  `faculty_head` varchar(50) NOT NULL,
  primary key (faculty_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE IF NOT EXISTS `Professor` (
  `professor_id` int(10) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(10) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `qualifications` varchar(255) DEFAULT NULL,
  primary key (professor_id),
  FOREIGN KEY (faculty_id) REFERENCES Faculty(faculty_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `Credentials` (`professor_id`, `username`, `password`) VALUES
(2, 'first', 'last');

INSERT INTO `Credentials` (`professor_id`, `username`, `password`) VALUES
(1, 'hello', 'world');

INSERT INTO `Faculty` (`faculty_name`, `faculty_head`) VALUES
('computer science', 'ayorkor korsah');

INSERT INTO `Course` (`faculty_id`, `professor_id`, `description_id`) VALUES
(1,1,1);

INSERT INTO `Professor` (`faculty_id`, `first_name`, `last_name`, `email`, `qualifications`) VALUES
(1, 'Nathan', 'Amanquah', 'namanquah@ashesi.edu.gh', 'PHD');

INSERT INTO `Description` (`objectives`, `topics`, `references`, `time frame`, `prerequisites`, `assessments`) VALUES
('learn code', 'encryption in c++', 'thining in c++', 8, 'programming 3', 'amazing course');

INSERT INTO `professor` (`professor_id`, `faculty_id`, `first_name`, `last_name`, `email`, `qualifications`) VALUES
(3, 2, 'Ebo', 'Spio', 'espio@ashesi.edu.gh', 'PHD'),
(4, 2, 'Vincent', 'Ocran', 'vocran@ashesi.edu.gh', 'PHD'),
(5, 2, 'Kajsa', 'Hallberg', 'kadu@ashesi.edu.gh', 'PHD'),
(6, 2, 'Kobby', 'Graham', 'kgraham@ashesi.edu.gh', 'PHD'),
(7, 1, 'Aelaf', 'Dafla', 'adafla@ashesi.edu.gh', 'PHD');

set foreign_key_checks = 1;