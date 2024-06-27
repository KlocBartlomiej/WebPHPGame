CREATE SCHEMA `gra_php` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci ;

CREATE TABLE `gra_php`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(150) NULL,
  `password` VARCHAR(150) NULL,
  `user_name` VARCHAR(120) NULL,
  PRIMARY KEY (`idnew_table`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE);

INSERT INTO gra_php.users (email, password, user_name) VALUES ("root@kloc.pl", "toor", "root");