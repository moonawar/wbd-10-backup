CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(32) PRIMARY KEY,
  `role` ENUM('customer', 'admin') NOT NULL,
  `email` varchar(320),
  `password` varchar(128) NOT NULL,
  `image_path` TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS `have` (
  `username` varchar(25),
  `book_id` integer,
  `purchase_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`, `book_id`)
);

CREATE TABLE IF NOT EXISTS `book` (
  `book_id` integer PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `summary` text,
  `price` integer NOT NULL,
  `duration` integer NOT NULL COMMENT 'in seconds',
  `lang` varchar(64) DEFAULT 'English',
  `audio_path` text NOT NULL
);

CREATE TABLE IF NOT EXISTS `genre` (
  `name` varchar(32) PRIMARY KEY,
  `description` text
);

CREATE TABLE IF NOT EXISTS `book_genre` (
  `book_id` integer,
  `genre_name` varchar(32),
  PRIMARY KEY (`book_id`, `genre_name`)
);

CREATE TABLE IF NOT EXISTS `author` (
  `author_id` integer PRIMARY KEY AUTO_INCREMENT,
  `full_name` varchar(32) NOT NULL,
  `email` varchar(320)
);

CREATE TABLE IF NOT EXISTS `authored_by` (
  `book_id` integer,
  `author_id` integer,
  PRIMARY KEY (`book_id`, `author_id`)
);