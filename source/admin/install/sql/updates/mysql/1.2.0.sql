-- --------------------------------------------------------
-- 
-- Update Database version: 1.2.0
-- 
-- --------------------------------------------------------

INSERT INTO `#__payinvoice_config`(`key`, `value`) VALUES ('invoice_rno_prefix' , 'INV-01-');

ALTER TABLE `#__payinvoice_invoice` ADD `invoice_serial` varchar(255) DEFAULT NULL;

INSERT INTO `#__payinvoice_item`(`type`, `title`) VALUES ('task' , 'General'), ('task' , 'Meetings'), ('task' , 'Research');