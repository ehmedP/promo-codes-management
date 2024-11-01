
CREATE DATABASE IF NOT EXISTS `promocodesdb`;

USE `promocodesdb`;

CREATE TABLE IF NOT EXISTS `promo_codes` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(255) NOT NULL
);

CREATE INDEX `idx_code` ON `promo_codes`(`code`);

CREATE TABLE IF NOT EXISTS `promocode_users` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR (255) NOT NULL,
    `email` VARCHAR (255) NOT NULL,
    `used_promocode_id` INT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		CONSTRAINT `fk_promocode_users_used_promocode`
    		FOREIGN KEY (`used_promocode_id`) REFERENCES `promo_codes`(`id`)
    			ON DELETE CASCADE
);

CREATE UNIQUE INDEX `idx_email` ON `promocode_users`(`email`); 