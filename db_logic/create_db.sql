CREATE SCHEMA `gra_php` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci ;

CREATE TABLE `gra_php`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(150) NULL,
  `password` VARCHAR(255) NULL,
  `user_name` VARCHAR(120) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE);

  CREATE TABLE `gra_php`.`resources` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `wood` INT NULL,
  `iron` INT NULL,
  `clay` INT NULL,
  `wheat` INT NULL,
  `money` INT NULL,
  `id_user` INT NOT NULL,
  PRIMARY KEY (`id`));

  CREATE TABLE `gra_php`.`buildings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `barracksLvl` INT NULL,
  `hideoutLvl` INT NULL,
  `warehouseLvl` INT NULL,
  `defensiveWallsLvl` INT NULL,
  `palaceLvl` INT NULL,
  `TownHallLvl` INT NULL,
  `marketLvl` INT NULL,
  `stableLvl` INT NULL,
  `id_user` INT NOT NULL,
  PRIMARY KEY (`id`));