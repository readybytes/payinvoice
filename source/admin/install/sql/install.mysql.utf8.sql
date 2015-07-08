CREATE TABLE IF NOT EXISTS `#__payinvoice_invoice` (
  `invoice_id` 	int(11) NOT NULL AUTO_INCREMENT,
  `type` 	varchar(25) NOT NULL,
  `template` 	varchar(25) NOT NULL,
  `params` 	text,
  PRIMARY KEY (`invoice_id`),
  INDEX `idx_type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__payinvoice_buyer` (
  `buyer_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency` char(3) NOT NULL,
  `address` text,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `tax_number` varchar(255),
  `params`  text,
  PRIMARY KEY (`buyer_id`),
  INDEX `idx_city` (`city`),
  INDEX `idx_state` (`state`),
  INDEX `idx_country` (`country`),
  INDEX `idx_zipcode` (`zipcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__payinvoice_processor` (
  `processor_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `type` varchar(255) NOT NULL,
  `params` text,  
  PRIMARY KEY (`processor_id`),
  INDEX `idx_type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__payinvoice_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text,
  PRIMARY KEY (`config_id`),
  UNIQUE KEY `idx_key` (`key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `#__payinvoice_config`(`key`, `value`) VALUES ('invoice_sno_prefix' , 'INV-01-')
