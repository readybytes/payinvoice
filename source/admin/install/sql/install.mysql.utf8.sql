CREATE TABLE IF NOT EXISTS `#__payinvoice_invoice` (
  `invoice_id` 	int(11) NOT NULL AUTO_INCREMENT,
  `type` 	varchar(25) NOT NULL,
  `template` 	varchar(25) NOT NULL,
  `params` 	text,
  `invoice_serial` varchar(255) DEFAULT NULL,
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

INSERT INTO `#__payinvoice_config`(`key`, `value`) VALUES ('invoice_rno_prefix' , 'INV-01-');

CREATE TABLE IF NOT EXISTS `#__payinvoice_item` (
`item_id` int(11) NOT NULL AUTO_INCREMENT,
`type` varchar(255) NOT NULL,
`title` varchar(255) NOT NULL,
`unit_cost` decimal(15,5) NOT NULL,
`tax` decimal(15,5) NOT NULL,
`created_date` datetime,
PRIMARY KEY (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__payinvoice_invoice_x_item` (
 `invoice_id` int(11) NOT NULL, 
`item_id` int(11) NOT NULL,
`type` varchar(255) NOT NULL,
`unit_cost` decimal(15,5) NOT NULL,
`quantity` int(11) NOT NULL,
`tax` decimal(15,5) NOT NULL,
`line_total` decimal(15,5) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
