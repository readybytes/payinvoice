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
	public function getCurrency($itemId, $format = null)
	{
	   $currencies = XiEEAPI::currency_get_records($itemId);
	   
	   if(!isset($format) || $format == 'fullname'){
			return $currencies[$itemId['currency_id']]->title.' ('. $currencies[$itemId['currency_id']]->currency_id .')';
		}
		
		if($format == 'id'){
			return $currencies[$itemId['currency_id']]->currency_id;
		}
		
		if($format == 'symbol'){
			return $currencies[$itemId['currency_id']]->symbol;
		}
		
		return false;
	}
}

