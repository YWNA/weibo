ALTER TABLE `company` ADD COLUMN `baoguan_day` TEXT NULL AFTER `company_name_s`;
ALTER TABLE `info` ADD COLUMN `sort` INT(11) NULL AFTER `link`;
ALTER TABLE `info` ADD COLUMN `status` TINYINT(1) NULL AFTER `sort`;
ALTER TABLE `info` CHANGE `status` `status` TINYINT(1) DEFAULT 1 NULL;