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
  `audio_path` text NOT NULL,
  `cover_path` text NOT NULL
);

CREATE TABLE IF NOT EXISTS `genre` (
  `genre_id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(32)
);

CREATE TABLE IF NOT EXISTS `book_genre` (
  `book_id` integer,
  `genre_id` integer,
  PRIMARY KEY (`book_id`, `genre_id`)
);

CREATE TABLE IF NOT EXISTS `author` (
  `author_id` integer PRIMARY KEY AUTO_INCREMENT,
  `full_name` varchar(32) NOT NULL,
  `age` int
);

CREATE TABLE IF NOT EXISTS `authored_by` (
  `book_id` integer,
  `author_id` integer,
  PRIMARY KEY (`book_id`, `author_id`)
);

ALTER TABLE `have` ADD FOREIGN KEY (`username`) REFERENCES `user`(`username`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `have` ADD FOREIGN KEY (`book_id`) REFERENCES `book`(`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `book_genre` ADD FOREIGN KEY (`book_id`) REFERENCES `book`(`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `book_genre` ADD FOREIGN KEY (`genre_id`) REFERENCES `genre`(`genre_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `authored_by` ADD FOREIGN KEY (`book_id`) REFERENCES `book`(`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `authored_by` ADD FOREIGN KEY (`author_id`) REFERENCES `author`(`author_id`) ON DELETE CASCADE ON UPDATE CASCADE;