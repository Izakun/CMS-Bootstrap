-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema DB_CMS
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DB_CMS
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DB_CMS` DEFAULT CHARACTER SET utf8 ;
USE `DB_CMS` ;

-- -----------------------------------------------------
-- Table `DB_CMS`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_CMS`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_CMS`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_CMS`.`articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `content` VARCHAR(2500) NOT NULL,
  `comment` TINYINT NOT NULL,
  `create_date` DATETIME NOT NULL,
  `update_date` DATETIME NULL,
  `visible` TINYINT NOT NULL,
  `authorId` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `authorId`
    FOREIGN KEY (`authorId`)
    REFERENCES `DB_CMS`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_CMS`.`themes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_CMS`.`themes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_CMS`.`preferences`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_CMS`.`preferences` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `userId` INT NOT NULL,
  `admin` TINYINT NOT NULL,
  `themeId` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `userId`
    FOREIGN KEY (`userId`)
    REFERENCES `DB_CMS`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `themeId`
    FOREIGN KEY (`themeId`)
    REFERENCES `DB_CMS`.`themes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_CMS`.`cms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_CMS`.`cms` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `contact` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
