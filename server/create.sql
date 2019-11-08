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

--
-- Table structure for table `index`
--
CREATE TABLE course_index (
    course_a int(10) UNSIGNED NOT NULL,
    course_b int(10) UNSIGNED NOT NULL,
    score double NOT NULL,
    PRIMARY KEY (course_a, course_b),
    FOREIGN KEY (course_a) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (course_b) REFERENCES courses(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

