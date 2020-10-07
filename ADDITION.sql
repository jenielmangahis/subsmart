ALTER TABLE `admintom_nsmart_companies`.`user_docfile_recipients` 
ADD COLUMN `color` VARCHAR(45) NULL AFTER `host_email`;

CREATE TABLE `admintom_nsmart_companies`.`esign_library_template` (
  `esignLibraryTemplateId` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `content` LONGTEXT NULL DEFAULT NULL,
  `createdDateTime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isActive` TINYINT(1) UNSIGNED NULL DEFAULT 0 COMMENT 'Esign Library ',
  PRIMARY KEY (`esignLibraryTemplateId`),
  UNIQUE INDEX `title_UNIQUE` (`title` ASC));

ALTER TABLE `admintom_nsmart_companies`.`esign_library_template` 
ADD COLUMN `user_id` INT(11) NOT NULL AFTER `content`,
DROP INDEX `title_UNIQUE` ;

ALTER TABLE `admintom_nsmart_companies`.`esign_library_template` 
ADD COLUMN `category_id` INT(11) NOT NULL DEFAULT 1 AFTER `user_id`;

CREATE TABLE `admintom_nsmart_companies`.`esign_library_category` (
  `category_id` INT(11) NOT NULL AUTO_INCREMENT,
  `categoryName` VARCHAR(45) NOT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  `isDefault` TINYINT(1) UNSIGNED NULL DEFAULT 1,
  `isActive` TINYINT(1) UNSIGNED NULL DEFAULT 1,
  `createdDateTime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`));

INSERT INTO `admintom_nsmart_companies`.`esign_library_category` (`categoryName`, `isDefault`) VALUES ('Credit Repair Letters Library', '1');
INSERT INTO `admintom_nsmart_companies`.`esign_library_category` (`categoryName`, `isDefault`) VALUES ('Alarm Industry Library', '1');
INSERT INTO `admintom_nsmart_companies`.`esign_library_category` (`categoryName`, `isDefault`) VALUES ('Business Library', '1');
