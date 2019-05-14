-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2018 at 10:19 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smarthospital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

DROP TABLE IF EXISTS `admission`;
CREATE TABLE IF NOT EXISTS `admission` (
  `admission_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipd_no` varchar(10) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `patient_bed_no` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `patient_phone` varchar(10) NOT NULL,
  `patient_phone1` varchar(10) NOT NULL,
  `patient_address` text NOT NULL,
  `patient_ps` varchar(200) NOT NULL,
  `patient_city_district` varchar(200) NOT NULL,
  `patient_pin` varchar(8) NOT NULL,
  `patient_admission_date` date NOT NULL,
  `doctor` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `is_discharged` varchar(100) NOT NULL,
  `discharge_comment` text NOT NULL,
  `discharge_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`admission_id`, `ipd_no`, `patient_name`, `patient_bed_no`, `sex`, `age`, `patient_phone`, `patient_phone1`, `patient_address`, `patient_ps`, `patient_city_district`, `patient_pin`, `patient_admission_date`, `doctor`, `remarks`, `is_discharged`, `discharge_comment`, `discharge_date`, `created_by`, `add_date`) VALUES
(1, 'IPD000001', 'J DAS', '101', 'male', 67, '9876543210', '1234567890', 'NEWTOWN', 'KOTWALI', 'COOCH BEHAR', '736101', '2016-12-03', 1, 'NA........................', 'on', 'testaasdasasdasdasdasdasdasd', '2017-01-17', 0, '2016-12-03 09:55:58'),
(2, 'IPD000002', 'K DAS', '201', 'female', 32, '9988', '4455', 'NEWTOWN', 'KOTWALI', 'COOCH BEHAR', '736101', '2016-12-03', 2, '...........................................', '', '', '0000-00-00', 0, '2016-12-03 10:00:28'),
(3, 'IPD000003', 'S BISWAS', '101', 'male', 67, '667788', '998877', 'KOL', 'KOTWALI', 'COOCH BEHAR', '736101', '2016-12-03', 1, 'NA....................................', '', '', '0000-00-00', 0, '2016-12-03 10:17:13'),
(4, 'IPD000004', 'L DAS', '102', 'male', 45, '4455669988', '00', 'BULLIGUNGE', 'BULLIGUNGE', 'KOLKATA', '700019', '2016-12-27', 1, 'NA..............................', 'on', 'asdasdasdasdasdasdasdasdasdadsas', '2017-01-17', 0, '2016-12-27 12:36:41'),
(5, 'IPD000005', 'Arnab', '102', 'male', 22, '3324324', '', 'asad', 'asaa', 'adas', '2343', '2017-04-01', 2, 'saasdadadsadadassadasa', '', '', '0000-00-00', 0, '2017-04-01 14:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `bank_ledger`
--

DROP TABLE IF EXISTS `bank_ledger`;
CREATE TABLE IF NOT EXISTS `bank_ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_no` varchar(200) NOT NULL,
  `recipt_voucher_type` varchar(5) NOT NULL,
  `party` varchar(100) NOT NULL,
  `depositer_name` varchar(100) NOT NULL,
  `voucher_type` varchar(100) NOT NULL,
  `mode` int(11) NOT NULL,
  `posting_ledger` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `narration` text NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `voucher_no` (`voucher_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bank_ledger`
--

INSERT INTO `bank_ledger` (`id`, `voucher_no`, `recipt_voucher_type`, `party`, `depositer_name`, `voucher_type`, `mode`, `posting_ledger`, `debit`, `credit`, `narration`, `add_date`) VALUES
(1, 'R000013', 'opd', 'OPD000001', 'Arnab Baul', 'recipt', 4, 2, 1000, 0, 'Test', '2017-04-17 15:50:15'),
(2, 'R000016', '', 'arnab', 'ranab', 'payment', 4, 2, 0, 5000, 'asasdada', '2017-04-17 15:52:43'),
(3, 'R000017', 'ipd', 'IPD000005', 'T.S.Mishra', 'recipt', 1, 2, 2000, 0, 'sdadasdas', '2017-04-18 18:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

DROP TABLE IF EXISTS `bed`;
CREATE TABLE IF NOT EXISTS `bed` (
  `bed_id` int(11) NOT NULL AUTO_INCREMENT,
  `bed_no` varchar(50) NOT NULL,
  `bed_type` int(11) NOT NULL,
  `charge` float NOT NULL,
  `unit` int(11) NOT NULL,
  `status` varchar(2) NOT NULL DEFAULT 'V' COMMENT 'O for occupied, V for vacant',
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`bed_id`, `bed_no`, `bed_type`, `charge`, `unit`, `status`, `add_date`) VALUES
(1, '101', 2, 500, 1, 'V', '2016-12-03 09:14:37'),
(2, '201', 1, 1200, 1, 'V', '2016-12-03 09:15:05'),
(3, '102', 2, 500, 1, 'O', '2016-12-27 12:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `bed_shift`
--

DROP TABLE IF EXISTS `bed_shift`;
CREATE TABLE IF NOT EXISTS `bed_shift` (
  `bed_shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipd_no` varchar(11) NOT NULL,
  `patient_bed_no` varchar(100) NOT NULL,
  `add_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bed_shift_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bed_shift`
--

INSERT INTO `bed_shift` (`bed_shift_id`, `ipd_no`, `patient_bed_no`, `add_date`) VALUES
(1, 'IPD000005', '102', '2017-04-01 14:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `bed_type`
--

DROP TABLE IF EXISTS `bed_type`;
CREATE TABLE IF NOT EXISTS `bed_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bed_type`
--

INSERT INTO `bed_type` (`id`, `type`) VALUES
(1, 'Cabin'),
(2, 'General');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(100) NOT NULL,
  `bill_type` varchar(11) NOT NULL,
  `ipd_no` varchar(100) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `total_amount` varchar(200) NOT NULL,
  `final` int(11) NOT NULL DEFAULT '0',
  `discount` varchar(100) NOT NULL,
  `original_amount` varchar(100) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bill_generate_date` date NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `bill_no`, `bill_type`, `ipd_no`, `admission_id`, `total_amount`, `final`, `discount`, `original_amount`, `add_date`, `bill_generate_date`) VALUES
(3, '000003', 'ipd', 'IPD000003', 3, '', 0, '', '', '2016-12-21 15:10:24', '0000-00-00'),
(4, '000004', 'ipd', 'IPD000002', 2, '', 0, '', '', '2016-12-21 17:40:46', '0000-00-00'),
(15, '2017-2018-000001', 'ipd', 'IPD000005', 5, '1000', 1, '', '', '2017-04-03 17:13:57', '2017-04-03'),
(16, '2017-2018-000002', 'opd', 'OPD000001', 1, '400', 1, '', '', '2017-04-10 18:52:46', '2017-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `bill_bed_details`
--

DROP TABLE IF EXISTS `bill_bed_details`;
CREATE TABLE IF NOT EXISTS `bill_bed_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(100) NOT NULL,
  `bed_type` varchar(100) NOT NULL,
  `bed_no` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `bill_bed_details`
--

INSERT INTO `bill_bed_details` (`id`, `bill_no`, `bed_type`, `bed_no`, `qty`, `rate`, `unit`, `amount`, `add_date`) VALUES
(4, '000001', 'General', '101', 3, '500', 'day', '1500', '2016-12-21 16:26:43'),
(5, '000001', 'Cabin', '201', 2, '1200', 'day', '2400', '2016-12-21 17:59:25'),
(6, '000006', 'General', '102', 3, '500', 'day', '1500', '2016-12-27 16:43:46'),
(7, '000006', 'Cabin', '201', 2, '1200', 'day', '2400', '2016-12-27 16:43:51'),
(10, '2017-2018-000001', 'General', '102', 2, '500', 'day', '1000', '2017-04-03 17:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `bill_doctor_details`
--

DROP TABLE IF EXISTS `bill_doctor_details`;
CREATE TABLE IF NOT EXISTS `bill_doctor_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(100) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `doctor_charge` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bill_doctor_details`
--

INSERT INTO `bill_doctor_details` (`id`, `bill_no`, `doctor_name`, `doctor_charge`, `unit`, `qty`, `amount`, `add_date`) VALUES
(3, '000001', 'Dr. Bidhan Ch. Oraon', '800', 'day', '2', '1600', '2016-12-21 16:27:19'),
(4, '000001', 'Dr. Nirmal Palit', '1000', 'day', '1', '1000', '2016-12-21 16:40:59'),
(5, '000006', 'Dr. Bidhan Ch. Oraon', '800', 'day', '2', '1600', '2016-12-27 16:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `bill_machine_details`
--

DROP TABLE IF EXISTS `bill_machine_details`;
CREATE TABLE IF NOT EXISTS `bill_machine_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(100) NOT NULL,
  `machine_name` varchar(100) NOT NULL,
  `charge` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bill_machine_details`
--

INSERT INTO `bill_machine_details` (`id`, `bill_no`, `machine_name`, `charge`, `unit`, `qty`, `amount`, `add_date`) VALUES
(3, '000001', 'Ventelator', '1200', 'nos', '3', '3600', '2016-12-24 10:36:45'),
(4, '000006', 'Pulse Oximeter', '180', 'nos', '2', '360', '2016-12-27 16:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `bill_service_details`
--

DROP TABLE IF EXISTS `bill_service_details`;
CREATE TABLE IF NOT EXISTS `bill_service_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(100) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_charge` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bill_service_details`
--

INSERT INTO `bill_service_details` (`id`, `bill_no`, `service_name`, `service_charge`, `unit`, `qty`, `amount`, `add_date`) VALUES
(3, '000001', 'ECG', '500', 'nos', '2', '1000', '2016-12-21 16:27:12'),
(4, '000006', 'ECG', '500', 'nos', '1', '500', '2016-12-27 16:44:02'),
(5, '000006', 'X-RAY', '200', 'nos', '1', '200', '2016-12-27 16:44:07'),
(6, '000006', 'X-RAY', '200', 'nos', '2', '400', '2016-12-27 16:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `biochemestry_patient`
--

DROP TABLE IF EXISTS `biochemestry_patient`;
CREATE TABLE IF NOT EXISTS `biochemestry_patient` (
  `biochem_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_no` varchar(20) NOT NULL,
  `patient_type` int(11) NOT NULL COMMENT '1 for opd,2 for ipd',
  `patient_name` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `patient_phone` varchar(10) NOT NULL,
  `patient_address` text NOT NULL,
  `patient_ps` varchar(200) NOT NULL,
  `patient_city_district` varchar(200) NOT NULL,
  `patient_pin` varchar(8) NOT NULL,
  `patient_opd_date` date NOT NULL,
  `doctor` int(11) NOT NULL,
  `is_bill_generated` int(11) NOT NULL COMMENT '1 for yes, 0 for no',
  `created_by` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`biochem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `biochemistry_att`
--

DROP TABLE IF EXISTS `biochemistry_att`;
CREATE TABLE IF NOT EXISTS `biochemistry_att` (
  `bai_id` int(11) NOT NULL AUTO_INCREMENT,
  `bai_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`bai_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `biochemistry_att`
--

INSERT INTO `biochemistry_att` (`bai_id`, `bai_desc`) VALUES
(1, 'Blood Glucose(Fasting)'),
(2, 'Blood Glucose(PP)'),
(3, 'Blood Glucose(Ran)'),
(4, 'Blood (Urea)'),
(5, 'Serum Creatinin'),
(6, 'Cholestrol'),
(7, 'Serum Triglyserdes'),
(8, 'HDL Cholestrol'),
(9, 'LDL Cholestrol'),
(10, 'VLDL Cholestrol'),
(11, 'SERUM LDH'),
(12, 'SERUM Bilirubin(Total)'),
(13, 'SERUM Bilirubin(Direct)'),
(14, 'SERUM Bilirubin(Indirect)'),
(15, 'SERUM Alkaline Phospet'),
(16, 'SERUM GPT'),
(17, 'SERUM GOT'),
(18, 'Serum Total Protin'),
(19, 'Albumin'),
(20, 'Globin'),
(21, 'Ratio'),
(22, 'Serum CGT'),
(23, 'Serum Uric Acid');

-- --------------------------------------------------------

--
-- Table structure for table `birthcertificate`
--

DROP TABLE IF EXISTS `birthcertificate`;
CREATE TABLE IF NOT EXISTS `birthcertificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipd_no` varchar(100) NOT NULL,
  `born_date` date NOT NULL,
  `born_time` time NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `ps` varchar(100) NOT NULL,
  `pin` varchar(11) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `birthcertificate`
--

INSERT INTO `birthcertificate` (`id`, `ipd_no`, `born_date`, `born_time`, `child_name`, `sex`, `nationality`, `mother_name`, `father_name`, `address`, `city`, `ps`, `pin`, `religion`, `add_date`) VALUES
(2, 'IPD000004', '2016-12-27', '13:14:09', 'Child', 'female', 'Indian', 'L DAS', 'Child Father', 'BULLIGUNGE', 'KOLKATA', 'BULLIGUNGE', '700019', 'Hindu', '2017-01-27 19:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `deathcertificate`
--

DROP TABLE IF EXISTS `deathcertificate`;
CREATE TABLE IF NOT EXISTS `deathcertificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipd_no` varchar(100) NOT NULL,
  `death_date` date NOT NULL,
  `death_time` time NOT NULL,
  `age` varchar(11) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `ps` varchar(100) NOT NULL,
  `pin` varchar(11) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `reason` text NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `deathcertificate`
--

INSERT INTO `deathcertificate` (`id`, `ipd_no`, `death_date`, `death_time`, `age`, `sex`, `nationality`, `name`, `address`, `city`, `ps`, `pin`, `religion`, `reason`, `add_date`) VALUES
(2, 'IPD000001', '2017-01-24', '10:01:01', '67', 'male', 'Indian', 'J DAS', 'NEWTOWN', 'COOCH BEHAR', 'KOTWALI', '736101', 'Hindu', 'asasdadadadadadadadadadada', '2017-01-28 07:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_name` varchar(100) NOT NULL,
  `doctor_charge` float NOT NULL,
  `unit` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `doctor_name`, `doctor_charge`, `unit`, `add_date`) VALUES
(1, 'Dr. Nirmal Palit', 1000, 1, '2016-12-03 09:42:07'),
(2, 'Dr. Bidhan Ch. Oraon', 800, 1, '2016-12-03 09:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_opd`
--

DROP TABLE IF EXISTS `doctor_opd`;
CREATE TABLE IF NOT EXISTS `doctor_opd` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_name` varchar(100) NOT NULL,
  `doctor_charge` float NOT NULL,
  `unit` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `doctor_opd`
--

INSERT INTO `doctor_opd` (`doctor_id`, `doctor_name`, `doctor_charge`, `unit`, `add_date`) VALUES
(2, 'Dr. A. Basu', 400, 0, '2017-04-07 19:49:15'),
(3, 'Dr. B B Das', 100, 0, '2017-04-07 19:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `financial_year`
--

DROP TABLE IF EXISTS `financial_year`;
CREATE TABLE IF NOT EXISTS `financial_year` (
  `fin_id` int(11) NOT NULL AUTO_INCREMENT,
  `financial_year` varchar(100) NOT NULL,
  PRIMARY KEY (`fin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `financial_year`
--

INSERT INTO `financial_year` (`fin_id`, `financial_year`) VALUES
(1, '2017-2018');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_master`
--

DROP TABLE IF EXISTS `ledger_master`;
CREATE TABLE IF NOT EXISTS `ledger_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ledger_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ledger_master`
--

INSERT INTO `ledger_master` (`id`, `ledger_name`) VALUES
(1, 'Bank Book(Khata)'),
(2, 'Pass Book(Khata)');

-- --------------------------------------------------------

--
-- Table structure for table `machinary`
--

DROP TABLE IF EXISTS `machinary`;
CREATE TABLE IF NOT EXISTS `machinary` (
  `machinary_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipement_name` varchar(100) NOT NULL,
  `charge` float NOT NULL,
  `unit` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`machinary_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `machinary`
--

INSERT INTO `machinary` (`machinary_id`, `equipement_name`, `charge`, `unit`, `add_date`) VALUES
(2, 'Pulse Oximeter', 180, 2, '2016-12-03 09:16:44'),
(3, 'Ventelator', 1200, 2, '2016-12-03 09:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `opd_patient`
--

DROP TABLE IF EXISTS `opd_patient`;
CREATE TABLE IF NOT EXISTS `opd_patient` (
  `opd_id` int(11) NOT NULL AUTO_INCREMENT,
  `opd_no` varchar(20) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `patient_phone` varchar(10) NOT NULL,
  `patient_address` text NOT NULL,
  `patient_ps` varchar(200) NOT NULL,
  `patient_city_district` varchar(200) NOT NULL,
  `patient_pin` varchar(8) NOT NULL,
  `patient_opd_date` date NOT NULL,
  `doctor` int(11) NOT NULL,
  `is_bill_generated` int(11) NOT NULL COMMENT '1 for yes, 0 for no',
  `created_by` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`opd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `opd_patient`
--

INSERT INTO `opd_patient` (`opd_id`, `opd_no`, `patient_name`, `sex`, `age`, `patient_phone`, `patient_address`, `patient_ps`, `patient_city_district`, `patient_pin`, `patient_opd_date`, `doctor`, `is_bill_generated`, `created_by`, `add_date`) VALUES
(1, 'OPD000001', 'Arnab', 'male', 24, '9903495772', 'Atabagan', 'Bansdroni', 'Kolkata', '700084', '2017-04-08', 2, 1, 0, '2017-04-08 08:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `opd_service_charg`
--

DROP TABLE IF EXISTS `opd_service_charg`;
CREATE TABLE IF NOT EXISTS `opd_service_charg` (
  `service_charge_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_charge` varchar(11) NOT NULL,
  PRIMARY KEY (`service_charge_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `opd_service_charg`
--

INSERT INTO `opd_service_charg` (`service_charge_id`, `service_charge`) VALUES
(1, '20');

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

DROP TABLE IF EXISTS `payment_mode`;
CREATE TABLE IF NOT EXISTS `payment_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`id`, `mode_name`) VALUES
(1, 'Cash'),
(2, 'Card'),
(3, 'Cheque'),
(4, 'NEFT');

-- --------------------------------------------------------

--
-- Table structure for table `purchaser`
--

DROP TABLE IF EXISTS `purchaser`;
CREATE TABLE IF NOT EXISTS `purchaser` (
  `purchaser_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_ledger` varchar(100) NOT NULL,
  `purchaser_no` varchar(50) NOT NULL,
  `grand_total` varchar(20) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchaser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchaser_item_details`
--

DROP TABLE IF EXISTS `purchaser_item_details`;
CREATE TABLE IF NOT EXISTS `purchaser_item_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchaser_no` varchar(50) NOT NULL,
  `perticular` text NOT NULL,
  `amount` varchar(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_amount` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `recipt_voucher`
--

DROP TABLE IF EXISTS `recipt_voucher`;
CREATE TABLE IF NOT EXISTS `recipt_voucher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_no` varchar(200) NOT NULL,
  `recipt_voucher_type` varchar(5) NOT NULL,
  `party` varchar(100) NOT NULL,
  `depositer_name` varchar(100) NOT NULL,
  `voucher_type` varchar(100) NOT NULL,
  `mode` int(11) NOT NULL,
  `posting_ledger` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `narration` text NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `voucher_no` (`voucher_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `recipt_voucher`
--

INSERT INTO `recipt_voucher` (`id`, `voucher_no`, `recipt_voucher_type`, `party`, `depositer_name`, `voucher_type`, `mode`, `posting_ledger`, `debit`, `credit`, `narration`, `add_date`) VALUES
(1, 'R000001', '', 'IPD000002', '', 'recipt', 4, 2, 0, 5000, 'Test the receipt voucher is perfect or not', '2016-12-06 15:58:33'),
(2, 'R000002', '', 'IPD000002', '', 'recipt', 1, 1, 0, 20000, 'TEST.....................', '2016-12-10 12:02:59'),
(3, 'R000003', '', 'IPD000005', 'Arnab Baul', 'recipt', 4, 2, 0, 200000, 'asdadadsadasdadadsadadada', '2017-04-01 14:44:52'),
(4, 'R000004', '', 'IPD000005', 'Arnab Baul', 'recipt', 1, 1, 0, 3000, 'nasasdas......................', '2017-04-01 14:47:31'),
(5, 'R000005', '', 'arnab', 'T.K. Thakur', 'payment', 1, 2, 2000, 0, 'test', '2017-04-05 16:40:17'),
(6, 'R000006', '', 'IPD000005', 'T.S.Mishra', 'recipt', 1, 2, 0, 1500, 'Test', '2017-04-05 16:40:53'),
(7, 'R000007', '', 'IPD000005', 'AS Mitra', 'recipt', 2, 2, 0, 4000, 'Test', '2017-04-06 18:46:40'),
(8, 'R000008', '', 'IPD000005', 'AS Mitra', 'recipt', 1, 2, 0, 3000, 'Test', '2017-04-06 18:47:10'),
(9, 'R000009', '', 'arnab', 'asdsda', 'payment', 1, 2, 2000, 0, 'Test', '2017-04-06 18:48:21'),
(10, 'R000010', 'opd', 'OPD000001', 'AS Mitra', 'recipt', 1, 2, 0, 3000, 'Test', '2017-04-08 09:03:54'),
(11, 'R000011', 'opd', 'OPD000001', 'AS Mitra', 'recipt', 4, 0, 0, 1500, 'ghgh', '2017-04-08 11:28:40'),
(12, 'R000012', 'opd', 'OPD000001', 'Arnab Baul', 'recipt', 4, 2, 0, 1000, 'Test', '2017-04-17 15:48:17'),
(13, 'R000013', 'opd', 'OPD000001', 'Arnab Baul', 'recipt', 4, 2, 0, 1000, 'Test', '2017-04-17 15:50:15'),
(14, 'R000014', '', 'arnab', 'T.K. Thakur', 'payment', 4, 1, 500, 0, 'asasdasdasd', '2017-04-17 15:51:02'),
(15, 'R000015', '', 'arnab', 'ranab', 'payment', 4, 2, 5000, 0, 'asasdada', '2017-04-17 15:52:22'),
(16, 'R000016', '', 'arnab', 'ranab', 'payment', 4, 2, 5000, 0, 'asasdada', '2017-04-17 15:52:43'),
(17, 'R000017', 'ipd', 'IPD000005', 'T.S.Mishra', 'recipt', 1, 2, 0, 2000, 'sdadasdas', '2017-04-18 18:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) NOT NULL,
  `charge` float NOT NULL,
  `unit` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `charge`, `unit`, `add_date`) VALUES
(1, 'X-RAY', 200, 2, '2016-12-21 15:11:43'),
(2, 'ECG', 500, 2, '2016-12-21 15:12:09');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_ledger` varchar(100) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_address` text NOT NULL,
  `supplier_phone` varchar(10) NOT NULL,
  `supplier_remarks` text NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_ledger`, `supplier_name`, `supplier_address`, `supplier_phone`, `supplier_remarks`, `add_date`) VALUES
(1, 'arnab', 'Arnab', 'B/25, Atabagan, Garia', '9903495773', ' Test of arnab from home at 12:15 AM', '2016-12-30 18:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(100) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `unit_name`, `display_name`) VALUES
(1, 'Day', 'day'),
(2, 'Nos', 'nos'),
(3, 'PCS', 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_role` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `user_role`, `add_date`) VALUES
(1, 'Admin', 'admin', '202cb962ac59075b964b07152d234b70', 1, '2016-12-03 09:09:27'),
(2, 'Arnab', 'arnab', '202cb962ac59075b964b07152d234b70', 2, '2017-04-01 13:44:00'),
(3, 'Arnab1', 'arnab1', '202cb962ac59075b964b07152d234b70', 2, '2017-04-01 13:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Clark');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
