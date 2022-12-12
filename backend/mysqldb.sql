CREATE DATABASE IF NOT EXISTS payment_db DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE USER 'payment_user'@'%' IDENTIFIED BY '';

GRANT ALL PRIVILEGES ON payment_db.* TO 'payment_user'@'%';

CREATE TABLE `payment_db`.`merchants` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `psp_name` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `active` TINYINT(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `LOGIN` (`username` ASC, `password` ASC) VISIBLE);

INSERT INTO `payment_db`.`merchants` (`username`, `email`, `password`, `psp_name`, `created_at`, `updated_at`, `deleted_at`, `active`)
values
('merchant_1', 'test.merchant.1@gmail.com', 'placeholder_password', 'pin', '2022-12-12 00:00:00', null, null, 1),
('merchant_2', 'test.merchant.2@gmail.com', 'placeholder_password', 'pin', '2022-12-12 00:00:00', null, null, 1),
('merchant_3', 'test.merchant.3@gmail.com', 'placeholder_password', 'pin', '2022-12-12 00:00:00', null, null, 1);