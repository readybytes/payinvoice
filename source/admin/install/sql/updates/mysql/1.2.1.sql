-- --------------------------------------------------------
-- 
-- Update Database version: 1.2.1
-- 
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `#__payinvoice_item` (
`item_id` int(11) NOT NULL AUTO_INCREMENT,
`type` varchar(255) NOT NULL,
`title` varchar(255) NOT NULL,
`unit_cost` decimal(15,5) NOT NULL,
`tax` decimal(15,5) NOT NULL,
`created_date` datetime,
PRIMARY KEY (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `#__payinvoice_item`(`type`, `title`) VALUES ('task' , 'General'), ('task' , 'Meetings'), ('task' , 'Research');


CREATE TABLE IF NOT EXISTS `#__payinvoice_invoice_x_item` (
 `invoice_id` int(11) NOT NULL, 
`item_id` int(11) NOT NULL,
`title` varchar(255) NOT NULL,
`type` varchar(255) NOT NULL,
`unit_cost` decimal(15,5) NOT NULL,
`quantity` int(11) NOT NULL,
`tax` decimal(15,5) NOT NULL,
`line_total` decimal(15,5) NOT NULL,
`created_date` datetime
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
