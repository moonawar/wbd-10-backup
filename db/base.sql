  CREATE TABLE `user` (
    `username` varchar(32) PRIMARY KEY,
    `role` ENUM ('customer', 'admin') NOT NULL,
    `email` varchar(320),
    `password` varchar(8, 128) NOT NULL,
    `image_path` text
  );

  CREATE TABLE `have` (
    `username` varchar(25),
    `book_id` integer,
    `purchase_date` timestamp,
    PRIMARY KEY (`username`, `book_id`)
  );

  CREATE TABLE `book` (
    `book_id` integer PRIMARY KEY,
    `title` varchar(255) NOT NULL,
    `year` year(4) NOT NULL,
    `summary` text DEFAULT '-',
    `price` integer NOT NULL,
    `duration` integer NOT NULL COMMENT 'in seconds',
    `lang` varchar(64) DEFAULT "English",
    -- `average_rating` numeric(1,2),
    -- `num_of_ratings` integer NOT NULL DEFAULT 0
  );

  CREATE TABLE `review` (
    `username` varchar(32),
    `book_id` integer,
    `rating` numeric(1,2) NOT NULL,
    `comment` text,
    PRIMARY KEY (`username`, `book_id`)
  );

  CREATE TABLE `genre` (
    `name` varchar(32) PRIMARY KEY,
    `description` text
  );

  CREATE TABLE `book_genre` (
    `book_id` integer,
    `genre_name` varchar(32),
    PRIMARY KEY (`book_id`, `genre_name`)
  );

  CREATE TABLE `author` (
    `author_id` integer PRIMARY KEY AUTO_INCREMENT,
    `full_name` varchar(32) NOT NULL,
    `email` varchar(320)
  );

  CREATE TABLE `authored_by` (
    `book_id` integer,
    `author_id` integer,
    PRIMARY KEY (`book_id`, `author_id`)
  );

  ALTER TABLE `have` ADD FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;

  ALTER TABLE `have` ADD FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE;

  ALTER TABLE `review` ADD FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;

  ALTER TABLE `review` ADD FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE;

  ALTER TABLE `book_genre` ADD FOREIGN KEY (`genre_name`) REFERENCES `genre` (`name`) ON DELETE CASCADE;

  ALTER TABLE `book_genre` ADD FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE;

  ALTER TABLE `authored_by` ADD FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE CASCADE;

  ALTER TABLE `authored_by` ADD FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE;