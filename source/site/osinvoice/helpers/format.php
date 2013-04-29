<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		OSINVOICE
* @subpackage	Frontend
* @contact 		team@readybytes.in
*/

if(defined('_JEXEC')===false) die();

class OSInvoiceHelperFormat extends JObject
{
	public static function getCurrency($itemId, $format = null)
	{
	   $currencyId	= array('currency_id' => $itemId);
	   $currencies 	= Rb_EcommerceAPI::currency_get_records($currencyId);
	   
	   if(!isset($format) || $format == 'fullname'){
			return $currencies[$itemId]->title.' ('. $currencies[$itemId]->currency_id .')';
		}
		
		if($format == 'id'){
			return $currencies[$itemId]->currency_id;
		}
		
		if($format == 'symbol'){
			return $currencies[$itemId]->symbol;
		}
		
		return false;
	}
	
	public static function date(Rb_Date $date ,$format=null)
	{
		$configHelper	= OSInvoiceFactory::getHelper('config');
		$date_format	= $configHelper->get('date_format');
		$format 		= ($format === null) ? $date_format : $format;
		return $date->toFormat($format);
	}
}
