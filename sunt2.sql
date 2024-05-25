-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2024 at 08:52 PM
-- Server version: 10.6.17-MariaDB-cll-lve-log
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `balance` double NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `refresh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `userName`, `password`, `balance`, `type`, `refresh`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', '123456', 3861611676.44, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admintransaction`
--

CREATE TABLE `admintransaction` (
  `id` int(11) NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `description` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_notification`
--

CREATE TABLE `admin_notification` (
  `id` int(11) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `deposit` double NOT NULL,
  `withdraw` double NOT NULL,
  `notificationType` int(11) NOT NULL,
  `pay_method` varchar(20) NOT NULL,
  `acc_type` varchar(20) NOT NULL,
  `from_number` varchar(20) NOT NULL,
  `to_number` varchar(20) NOT NULL,
  `ref_number` varchar(20) NOT NULL,
  `time` varchar(50) NOT NULL,
  `seen` int(11) NOT NULL,
  `action` int(11) NOT NULL DEFAULT 0,
  `wAction` int(11) NOT NULL DEFAULT 0,
  `confirm_number` varchar(20) NOT NULL,
  `rate` double NOT NULL,
  `notes` text NOT NULL,
  `actionAt` varchar(50) NOT NULL,
  `userType` int(11) NOT NULL,
  `userBalance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_notify`
--

CREATE TABLE `admin_notify` (
  `id` int(11) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balance_transfer`
--

CREATE TABLE `balance_transfer` (
  `id` int(11) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `to_userId` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `time` varchar(50) NOT NULL,
  `notes` text NOT NULL,
  `userBalance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bet`
--

CREATE TABLE `bet` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` int(50) NOT NULL,
  `club` varchar(50) NOT NULL,
  `betTitle` varchar(50) NOT NULL,
  `matchTitle` varchar(50) NOT NULL,
  `betRate` varchar(50) NOT NULL,
  `betAmount` varchar(50) NOT NULL,
  `betId` int(50) NOT NULL,
  `matchId` int(50) NOT NULL,
  `betTitleId` int(10) NOT NULL,
  `returnAmount` varchar(50) NOT NULL,
  `time` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `betclosehistory`
--

CREATE TABLE `betclosehistory` (
  `id` int(11) NOT NULL,
  `matchId` int(11) NOT NULL,
  `queId` int(11) NOT NULL,
  `gainAmunt` double NOT NULL,
  `SendingAmount` double NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `betting_subtitle`
--

CREATE TABLE `betting_subtitle` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `bettingId` varchar(255) NOT NULL,
  `showStatus` int(11) NOT NULL DEFAULT 0,
  `limitedAmount` double NOT NULL,
  `bettedAmount` double NOT NULL,
  `hide` int(11) NOT NULL DEFAULT 0,
  `close` int(11) NOT NULL DEFAULT 0,
  `ariaHide` int(11) NOT NULL DEFAULT 1,
  `waittingTime` int(11) NOT NULL DEFAULT 1,
  `section_ct` int(11) NOT NULL,
  `section_hide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `betting_sub_title_option`
--

CREATE TABLE `betting_sub_title_option` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `bettingSubTitleId` int(11) NOT NULL,
  `betCount` int(11) NOT NULL DEFAULT 0,
  `showStatus` int(11) NOT NULL DEFAULT 1,
  `limitedAmount` double NOT NULL,
  `bettedAmount` double NOT NULL,
  `hide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `betting_title`
--

CREATE TABLE `betting_title` (
  `id` int(10) UNSIGNED NOT NULL,
  `A_team` varchar(50) NOT NULL,
  `B_team` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `gameType` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `close` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bettintransaction`
--

CREATE TABLE `bettintransaction` (
  `id` int(11) NOT NULL,
  `totalSending` varchar(255) NOT NULL,
  `totalGaining` varchar(255) NOT NULL,
  `totalSaving` varchar(255) NOT NULL,
  `s_save` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bettintransaction`
--

INSERT INTO `bettintransaction` (`id`, `totalSending`, `totalGaining`, `totalSaving`, `s_save`) VALUES
(1, '15455', '1320', '906883.48457091', 767786.4830678);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `userId` varchar(100) NOT NULL,
  `msg` text NOT NULL,
  `admin` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `userId` int(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobileNumber` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rate` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `default_ans`
--

CREATE TABLE `default_ans` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `bettingSubTitleId` int(11) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `default_match`
--

CREATE TABLE `default_match` (
  `id` int(11) NOT NULL,
  `A_team` varchar(100) NOT NULL,
  `B_team` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `gameType` int(11) NOT NULL,
  `ariaHide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `default_match`
--

INSERT INTO `default_match` (`id`, `A_team`, `B_team`, `title`, `date`, `status`, `gameType`, `ariaHide`) VALUES
(68, 'A', 'B', 'T20', 'c', 2, 2, 0),
(69, 'A', 'B', 'Football', 'c', 0, 1, 1),
(70, 'A', 'B', 'ODI', 'c', 1, 2, 1),
(71, 'A', 'B', 'Basketball ', 'c', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `default_ques`
--

CREATE TABLE `default_ques` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '1',
  `bettingId` varchar(255) NOT NULL,
  `ariaHide` int(11) NOT NULL DEFAULT 1,
  `section_ct` int(11) NOT NULL DEFAULT 1,
  `g_type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `default_ques`
--

INSERT INTO `default_ques` (`id`, `title`, `bettingId`, `ariaHide`, `section_ct`, `g_type`) VALUES
(417, 'Toss Winner', '68', 0, 1, 2),
(418, 'Match Winner', '68', 0, 1, 2),
(420, '1st Ball Run---1st Batting', '68', 0, 1, 2),
(421, '1st Over Run---1st Batting', '68', 0, 1, 2),
(422, '1st Over Run ---1st Batting ', '68', 0, 1, 2),
(423, '1st Over Run 4way win---1st Batting', '68', 0, 1, 2),
(425, 'Full Time Result--? ', '69', 1, 1, 1),
(426, 'Halftime Result--?  ', '69', 1, 1, 1),
(427, 'Total Goal ---?', '69', 1, 1, 1),
(428, 'Draw No Bet', '69', 0, 1, 1),
(430, '1st Wicket Lost Method---1st Batting', '68', 0, 1, 2),
(431, '2nd Over Run---1st Batting ', '68', 0, 7, 2),
(432, '3rd Over Run---1st Batting ', '68', 0, 7, 2),
(433, '4th Over Run---1st Batting ', '68', 0, 7, 2),
(434, '5th Over Run---1st Batting ', '68', 0, 7, 2),
(435, '6th Over Run---1st Batting ', '68', 0, 7, 2),
(436, '7th Over Run---1st Batting ', '68', 0, 7, 2),
(437, '8th Over Run---1st Batting ', '68', 0, 7, 2),
(438, '9th Over Run---1st Batting ', '68', 0, 7, 2),
(439, '10th Over Run---1st Batting ', '68', 0, 7, 2),
(441, 'Toss Winner', '70', 0, 1, 2),
(442, 'Match Winner', '70', 0, 1, 2),
(445, '1st Ball Run---1st Batting', '70', 0, 1, 2),
(446, '1st Ball Run---1st Batting', '70', 0, 1, 2),
(447, '1st Over Run---1st Batting', '70', 0, 1, 2),
(448, '1st Over Run 4way win---1st Batting', '70', 0, 1, 2),
(449, '1st Innings Runs ( Over/Under)', '68', 0, 3, 2),
(450, '1st Innings Total Runs ( Odd/Even)', '68', 0, 3, 2),
(451, 'Total Run In Match (Over/Under)', '68', 0, 3, 2),
(452, 'Total Run In Match (Odd/Even )', '68', 0, 3, 2),
(453, 'Total Sixes ( Over/Under) ', '68', 0, 3, 2),
(454, 'Total Four ( Over/ Under) ', '68', 0, 3, 2),
(455, 'Most Sixes', '68', 0, 3, 2),
(456, 'Most Fours', '68', 0, 3, 2),
(457, 'Highest 1st Over Run ', '68', 0, 3, 2),
(458, 'Highest Opening Partnership   ', '68', 0, 3, 2),
(459, '6 Over Total Run Over/ Under (1st Batting)', '68', 0, 3, 2),
(460, 'Most Run Out', '68', 0, 3, 2),
(462, 'Fall of 1st Wicket Run(Over/Under)', '68', 0, 3, 2),
(463, 'Match winner', '71', 0, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `deposit_and_withdraw_his`
--

CREATE TABLE `deposit_and_withdraw_his` (
  `id` int(11) NOT NULL,
  `m_number` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `startDate` varchar(50) NOT NULL,
  `finishDate` varchar(50) NOT NULL,
  `d_or_w` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hiddenmatch`
--

CREATE TABLE `hiddenmatch` (
  `id` int(11) NOT NULL,
  `matchId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ip`
--

CREATE TABLE `ip` (
  `id` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `totalVisit` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ip`
--

INSERT INTO `ip` (`id`, `ip`, `totalVisit`, `tag`, `user`) VALUES
(18, '198.54.112.126', 1, 'home page', '');

-- --------------------------------------------------------

--
-- Table structure for table `ip_permit`
--

CREATE TABLE `ip_permit` (
  `id` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `tg` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ip_permit`
--

INSERT INTO `ip_permit` (`id`, `ip`, `tg`) VALUES
(1, '198.54.112.126', 'nazmul');

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE `method` (
  `id` int(11) NOT NULL,
  `method` varchar(20) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(20) UNSIGNED NOT NULL,
  `text` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receiving_money_number`
--

CREATE TABLE `receiving_money_number` (
  `id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refresh`
--

CREATE TABLE `refresh` (
  `id` int(11) NOT NULL,
  `refresh` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `refresh`
--

INSERT INTO `refresh` (`id`, `refresh`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE `rule` (
  `id` int(11) NOT NULL,
  `minimumBalance` double NOT NULL,
  `waitingTime` int(11) NOT NULL,
  `waitingTimeAfterDeposit` int(11) NOT NULL,
  `clubCommission` double NOT NULL DEFAULT 2,
  `userSponsor` double NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id`, `minimumBalance`, `waitingTime`, `waitingTimeAfterDeposit`, `clubCommission`, `userSponsor`) VALUES
(1, 0, 60, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sending_money_number`
--

CREATE TABLE `sending_money_number` (
  `id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sending_money_number`
--

INSERT INTO `sending_money_number` (`id`, `phone`) VALUES
(132, '6406'),
(181, '4062');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `deposit` double NOT NULL,
  `withdrawal` double NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `time` varchar(50) NOT NULL,
  `clubId` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `clubCredit` double NOT NULL,
  `clubDebit` double NOT NULL,
  `total` double NOT NULL,
  `sposor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `sponsorUsername` varchar(50) NOT NULL DEFAULT '0',
  `clubId` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `loan` double NOT NULL,
  `sponsorCommission` double NOT NULL DEFAULT 0,
  `refresh` int(11) NOT NULL DEFAULT 1,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userverifynumber`
--

CREATE TABLE `userverifynumber` (
  `id` int(11) NOT NULL,
  `userId` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `time` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_notify`
--

CREATE TABLE `user_notify` (
  `id` int(11) NOT NULL,
  `userId` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `w_method`
--

CREATE TABLE `w_method` (
  `method` varchar(20) NOT NULL,
  `rate` double NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admintransaction`
--
ALTER TABLE `admintransaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_notification`
--
ALTER TABLE `admin_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_notify`
--
ALTER TABLE `admin_notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance_transfer`
--
ALTER TABLE `balance_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bet`
--
ALTER TABLE `bet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `betclosehistory`
--
ALTER TABLE `betclosehistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `betting_subtitle`
--
ALTER TABLE `betting_subtitle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `betting_sub_title_option`
--
ALTER TABLE `betting_sub_title_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `betting_title`
--
ALTER TABLE `betting_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bettintransaction`
--
ALTER TABLE `bettintransaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_ans`
--
ALTER TABLE `default_ans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_match`
--
ALTER TABLE `default_match`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_ques`
--
ALTER TABLE `default_ques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_and_withdraw_his`
--
ALTER TABLE `deposit_and_withdraw_his`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hiddenmatch`
--
ALTER TABLE `hiddenmatch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip_permit`
--
ALTER TABLE `ip_permit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiving_money_number`
--
ALTER TABLE `receiving_money_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refresh`
--
ALTER TABLE `refresh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rule`
--
ALTER TABLE `rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sending_money_number`
--
ALTER TABLE `sending_money_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userverifynumber`
--
ALTER TABLE `userverifynumber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notify`
--
ALTER TABLE `user_notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `w_method`
--
ALTER TABLE `w_method`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `admintransaction`
--
ALTER TABLE `admintransaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_notification`
--
ALTER TABLE `admin_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_notify`
--
ALTER TABLE `admin_notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balance_transfer`
--
ALTER TABLE `balance_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bet`
--
ALTER TABLE `bet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `betclosehistory`
--
ALTER TABLE `betclosehistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `betting_subtitle`
--
ALTER TABLE `betting_subtitle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `betting_sub_title_option`
--
ALTER TABLE `betting_sub_title_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `betting_title`
--
ALTER TABLE `betting_title`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bettintransaction`
--
ALTER TABLE `bettintransaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `default_ans`
--
ALTER TABLE `default_ans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `default_match`
--
ALTER TABLE `default_match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `default_ques`
--
ALTER TABLE `default_ques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=464;

--
-- AUTO_INCREMENT for table `deposit_and_withdraw_his`
--
ALTER TABLE `deposit_and_withdraw_his`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hiddenmatch`
--
ALTER TABLE `hiddenmatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ip`
--
ALTER TABLE `ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `ip_permit`
--
ALTER TABLE `ip_permit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `method`
--
ALTER TABLE `method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receiving_money_number`
--
ALTER TABLE `receiving_money_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refresh`
--
ALTER TABLE `refresh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rule`
--
ALTER TABLE `rule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sending_money_number`
--
ALTER TABLE `sending_money_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userverifynumber`
--
ALTER TABLE `userverifynumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9265;

--
-- AUTO_INCREMENT for table `user_notify`
--
ALTER TABLE `user_notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `w_method`
--
ALTER TABLE `w_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
