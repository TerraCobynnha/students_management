-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 03:10 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `terracom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindetails`
--

CREATE TABLE `admindetails` (
  `ad_id` int(11) NOT NULL,
  `ad_username` tinytext NOT NULL,
  `ad_email` tinytext NOT NULL,
  `ad_password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admindetails`
--

INSERT INTO `admindetails` (`ad_id`, `ad_username`, `ad_email`, `ad_password`) VALUES
(1, 'Terra', 'tcobynnha2@gmail.com', '$2y$10$qlac8K1qFBVYO3PSfHKRNOi9R6ON204e4UFUYSle9/doEPRD0hBQm');

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `admin_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`username`, `password`, `admin_name`) VALUES
('TerraCom', 'Heresome', 'Terra'),
('TiffCom', 'Heresome', 'Tiffany');

-- --------------------------------------------------------

--
-- Table structure for table `staffdetails`
--

CREATE TABLE `staffdetails` (
  `stf_id` int(11) NOT NULL,
  `stf_title` varchar(11) NOT NULL,
  `stf_first` varchar(30) NOT NULL,
  `stf_last` varchar(30) NOT NULL,
  `stf_sex` varchar(10) NOT NULL,
  `stf_department` varchar(256) NOT NULL,
  `stf_dob` date NOT NULL,
  `stf_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stf_imgstat` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffdetails`
--

INSERT INTO `staffdetails` (`stf_id`, `stf_title`, `stf_first`, `stf_last`, `stf_sex`, `stf_department`, `stf_dob`, `stf_joined`, `stf_imgstat`) VALUES
(2, 'Mr.', 'Fredrick', 'Ashitey', 'Male', 'Archaeology', '1988-08-08', '2018-12-21 14:51:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staffgallery`
--

CREATE TABLE `staffgallery` (
  `img_id` int(11) NOT NULL,
  `img_stfid` int(11) NOT NULL,
  `img_folder` varchar(256) NOT NULL,
  `img_fullname` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffgallery`
--

INSERT INTO `staffgallery` (`img_id`, `img_stfid`, `img_folder`, `img_fullname`) VALUES
(1, 1, 'images/', 'staffimg1.jpg'),
(2, 2, 'images/', 'staffimg2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `std_id` int(11) NOT NULL,
  `std_first` varchar(30) NOT NULL,
  `std_last` varchar(30) NOT NULL,
  `std_sex` varchar(10) NOT NULL,
  `std_hall` varchar(256) NOT NULL,
  `std_course` varchar(256) NOT NULL,
  `std_dob` date NOT NULL,
  `std_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `std_imgstat` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`std_id`, `std_first`, `std_last`, `std_sex`, `std_hall`, `std_course`, `std_dob`, `std_joined`, `std_imgstat`) VALUES
(2, 'Tiffany', 'Bandoh', 'Female', 'Akuafo', 'Pharmacy', '1998-09-22', '2018-12-14 08:03:21', 1),
(3, 'Emmanuella', 'Baffoe', 'Female', 'Nelson', 'Psychology', '2001-04-22', '2018-12-14 14:28:49', 1),
(4, 'Angela', 'Frimpomah', 'Female', 'Kwapong', 'Education', '1997-07-17', '2018-12-14 09:00:31', 1),
(5, 'Tiffany', 'Ocansey', 'Female', 'Evandy', 'Physics', '1995-05-31', '2018-12-14 16:41:37', 1),
(6, 'Olga', 'Makafui', 'Female', 'Sey', 'Pharmacy', '1993-12-12', '2018-12-14 16:09:38', 1),
(8, 'Linda', 'Gyamera', 'Female', 'Sarbah', 'Bsc. Computer Science', '1998-12-12', '2018-12-14 17:51:31', 1),
(9, 'Terah', 'Baffoe', 'Male', 'None', 'Bsc. Computer Science', '1999-07-13', '2018-12-17 08:35:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentgallery`
--

CREATE TABLE `studentgallery` (
  `img_id` int(11) NOT NULL,
  `img_stdid` int(11) NOT NULL,
  `img_folder` varchar(256) NOT NULL,
  `img_fullname` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentgallery`
--

INSERT INTO `studentgallery` (`img_id`, `img_stdid`, `img_folder`, `img_fullname`) VALUES
(1, 2, 'images/', 'studentimg2.jpg'),
(2, 3, 'images/', 'studentimg3.jpg'),
(3, 4, 'images/', 'studentimg4.jpg'),
(4, 5, 'images/', 'studentimg5.jpg'),
(5, 6, 'images/', 'studentimg6.png'),
(6, 8, 'images/', 'studentimg8.jpg'),
(7, 9, 'images/', 'studentimg9.jpg'),
(8, 10, '', ''),
(9, 11, 'images/', 'studentimg11.jpg'),
(10, 10, 'images/', 'studentimg10.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admindetails`
--
ALTER TABLE `admindetails`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `staffdetails`
--
ALTER TABLE `staffdetails`
  ADD PRIMARY KEY (`stf_id`);

--
-- Indexes for table `staffgallery`
--
ALTER TABLE `staffgallery`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `studentgallery`
--
ALTER TABLE `studentgallery`
  ADD PRIMARY KEY (`img_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admindetails`
--
ALTER TABLE `admindetails`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staffdetails`
--
ALTER TABLE `staffdetails`
  MODIFY `stf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staffgallery`
--
ALTER TABLE `staffgallery`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studentdetails`
--
ALTER TABLE `studentdetails`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `studentgallery`
--
ALTER TABLE `studentgallery`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
