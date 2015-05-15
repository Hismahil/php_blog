-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema app_blog
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `app_blog` ;

-- -----------------------------------------------------
-- Schema app_blog
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `app_blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `app_blog` ;

-- -----------------------------------------------------
-- Table `app_blog`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `app_blog`.`roles` ;

CREATE TABLE IF NOT EXISTS `app_blog`.`roles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_admin` TINYINT(1) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `app_blog`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `app_blog`.`users` ;

CREATE TABLE IF NOT EXISTS `app_blog`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `role_id` INT UNSIGNED NOT NULL,
  `active` TINYINT(1) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_roles1_idx` (`role_id` ASC),
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `app_blog`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `app_blog`.`articles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `app_blog`.`articles` ;

CREATE TABLE IF NOT EXISTS `app_blog`.`articles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `about` VARCHAR(45) NULL,
  `content` LONGTEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_articles_users_idx` (`user_id` ASC),
  CONSTRAINT `fk_articles_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `app_blog`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `app_blog`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `app_blog`.`comments` ;

CREATE TABLE IF NOT EXISTS `app_blog`.`comments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment` LONGTEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `article_id` INT UNSIGNED NOT NULL,
  `user_name` VARCHAR(45) NULL,
  `comment_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_articles1_idx` (`article_id` ASC),
  INDEX `fk_comments_comments1_idx` (`comment_id` ASC),
  CONSTRAINT `fk_comments_articles1`
    FOREIGN KEY (`article_id`)
    REFERENCES `app_blog`.`articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_comments1`
    FOREIGN KEY (`comment_id`)
    REFERENCES `app_blog`.`comments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
