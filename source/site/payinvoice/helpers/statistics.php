<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/
// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

/** 
 * Statistics Helper
 * @author Gaurav Jain
 */
class PayInvoiceHelperStatistics extends PayInvoiceHelper
{
	public function get_revenue($start_time, $end_time, $currency)
	{
		if(!($start_time instanceof Rb_Date)){
			$start_time = new Rb_Date($start_time);
		}
		
		if(!($end_time instanceof Rb_Date)){
			$end_time = new Rb_Date($end_time);
		}
		
		$sql = "SELECT SUM(`total`) as `total`
				FROM `#__rb_ecommerce_invoice` 
				WHERE `object_type` = 'PayInvoiceInvoice' AND (DATE(`paid_date`) BETWEEN '".$start_time->toSql()."' AND '".$end_time->toSql()."') AND `currency` = '".$currency."' AND `status` = ".PayInvoiceInvoice::STATUS_PAID." 
				";
		
		$db = PayInvoiceFactory::getDbo();
		$db->setQuery($sql);
		$revenue = $db->loadResult();
		
		if(empty($revenue)){
			return 0;
		}
		
		return $revenue;
	}
	
	public function get_refunded_amount($start_time, $end_time, $currency)
	{
		if(!($start_time instanceof Rb_Date)){
			$start_time = new Rb_Date($start_time);
		}
		
		if(!($end_time instanceof Rb_Date)){
			$end_time = new Rb_Date($end_time);
		}
		
		$sql = "SELECT SUM(`total`) as `total`
				FROM `#__rb_ecommerce_invoice` 
				WHERE `object_type` = 'PayInvoiceInvoice' AND (DATE(`refund_date`) BETWEEN '".$start_time->toSql()."' AND '".$end_time->toSql()."') AND `currency` = '".$currency."' AND `status` = ".PayInvoiceInvoice::STATUS_REFUNDED." 
				";
		
		$db = PayInvoiceFactory::getDbo();
		$db->setQuery($sql);
		$revenue = $db->loadResult();
		
		if(empty($revenue)){
			return 0;
		}
		
		return $revenue;
	}
	
	function currencies_used()
	{
		$sql = "SELECT *
				FROM `#__rb_ecommerce_currency` 
				WHERE `currency_id` IN
					(
						SELECT `currency` 
						FROM `#__rb_ecommerce_invoice`			
						WHERE `object_type` = 'PayInvoiceInvoice' 
					)		 
				";
		
		$db = PayInvoiceFactory::getDbo();
		$db->setQuery($sql);
		return $db->loadObjectList();
	}
}
