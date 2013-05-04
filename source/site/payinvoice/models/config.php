<?php 
/**
* @copyright 	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PAYINVOICE	
* @subpackage	Frontend
* @contact 		team@readybytes.in
*/
if(defined('_JEXEC')===false) die();


class PayInvoiceModelConfig extends PayInvoiceModel
{
	function save($data = array())
	{		
		$keys 	= array_keys($data);
		$db 	= PayInvoiceFactory::getDbo();
		$delete = " DELETE FROM `#__payinvoice_config` WHERE `key` IN ('".implode("', '", $keys)."')" ;
		
		$db->setQuery($delete)
		   ->query();
		
		
		$query  =  "INSERT INTO `#__payinvoice_config` (`key`, `value`) VALUES ";
		$queryValue = array();
		
		foreach ($data as $key => $value){
			if(is_array($value)){
				$value  = json_encode($value);
			}

			$queryValue[] = "(".$db->quote($key).",". $db->quote($value).")";
		}

		$query .= implode(",", $queryValue);
		
		return $db->setQuery($query)
		   		  ->query();
		
	}
}

class PayInvoiceModelformConfig extends PayInvoiceModelform { }

