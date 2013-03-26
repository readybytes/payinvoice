CREATE TABLE IF NOT EXISTS `#__osi_invoice` (
  `invoice_id` 	int(11) NOT NULL AUTO_INCREMENT,
  `type` 	varchar(25) NOT NULL,
  `template` 	varchar(25) NOT NULL,
  `params` 	text,
  PRIMARY KEY (`invoice_id`),
  INDEX `idx_type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__osi_invoiceitem` (
  `invoiceitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `price_per_unit` decimal(15,4) NOT NULL,
  PRIMARY KEY (`invoiceitem_id`),
  INDEX `idx_invoice_id` (`invoice_id`),
  INDEX `idx_item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__osi_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `price` double(15,4) NOT NULL,
  `params` text,
  PRIMARY KEY (`item_id`),
  INDEX `idx_title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__osi_buyer` (
  `buyer_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency` char(3) NOT NULL,
  `address` text,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `params`  text,
  PRIMARY KEY (`buyer_id`),
  INDEX `idx_city` (`city`),
  INDEX `idx_state` (`state`),
  INDEX `idx_country` (`country`),
  INDEX `idx_zipcode` (`zipcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
