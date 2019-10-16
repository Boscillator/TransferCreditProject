SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `TransferCredit`
--
CREATE DATABASE IF NOT EXISTS TransferCredit DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE TransferCredit;

--
-- Table structure for table `courses`
--
CREATE TABLE courses (
    id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    school int(10) UNSIGNED NOT NULL,
    code varchar(100) NOT NULL,
    course_name varchar(100) NOT NULL,
    description varchar(10000) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `schools`
--
CREATE TABLE schools (
    id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

