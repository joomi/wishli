CREATE TABLE IF NOT EXISTS `#__wishli_user` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`name` VARCHAR(255)  NOT NULL ,
`email` VARCHAR(255)  NOT NULL ,
`j_user_id` INT(11)  NOT NULL ,
`fb_user_id` INT(11)  NOT NULL ,
`avatar` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__wishli_list` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`categories` VARCHAR(255)  NOT NULL ,
`userid` VARCHAR(255)  NOT NULL ,
`desc` TEXT(65535)  NOT NULL ,
`event_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`location` VARCHAR(255)  NOT NULL ,
`title` VARCHAR(255)  NOT NULL ,
`theme` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__wishli_category` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`title` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__wishli_gift` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`listid` INT(11)  NOT NULL ,
`title` VARCHAR(255)  NOT NULL ,
`link` VARCHAR(255)  NOT NULL ,
`desc` TEXT(65535)  NOT NULL ,
`status` INT(11)  NOT NULL ,
`image` VARCHAR(255)  NOT NULL ,
`budget` VARCHAR(255)  NOT NULL ,
`price` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__wishli_buyer` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`user_id` INT(11)  NOT NULL ,
`gift_id` INT(11)  NOT NULL ,
`buyer_name` VARCHAR(255)  NOT NULL ,
`email` VARCHAR(255)  NOT NULL ,
`attending` VARCHAR(255)  NOT NULL ,
`percentage` INT(11)  NOT NULL ,
`message` TEXT(65535)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

