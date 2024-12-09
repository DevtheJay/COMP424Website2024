CREATE DATABASE IF NOT EXISTS `comp424webpage`;
USE `comp424webpage`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `users` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Username` VARCHAR(200) NOT NULL,
  `Email` VARCHAR(200) NOT NULL,
  `Fname` VARCHAR(200) NOT NULL,
  `Lname` VARCHAR(200) NOT NULL,
  `Birth_date` DATE NOT NULL,
  `PASSWORD` VARCHAR(255) NOT NULL,
  `question1` VARCHAR(200) NOT NULL,
  `question2` VARCHAR(200) NOT NULL,
  `question3` VARCHAR(200) NOT NULL,
  `lastlogin` DATETIME DEFAULT NULL,
  `timesloggedin` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Email_UNIQUE` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `users` (`Id`, `Username`, `Email`, `Fname`, `Lname`, `Birth_date`, `PASSWORD`, `question1`, `question2`, `question3`, `lastlogin`, `timesloggedin`) VALUES
(1, 'poop', 'poop@gmail.com', 'p', 'diddy', '1999-07-01', '$2y$10$X08CYjzLnHALXvwDhWgmzeD4uuAH4ea4oCqIrwL8ZRvGdBVsnTxLq', 'dog', 'fish', 'chicago', '2024-10-28 10:00:00', 7);

COMMIT;
