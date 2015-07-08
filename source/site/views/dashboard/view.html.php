<?php

/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Dashboard Html View
 * @author Manisha Ranawat
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceSiteViewDashboard extends PayInvoiceSiteBaseViewDashboard
{	
	public function display($tpl = null)
	{
		$userId = PayInvoiceFactory::getUser()->id;
		if(!$userId){
			return true;
		}
		
		$buyer		 	= PayInvoiceBuyer::getInstance($userId);	
		$filter 		= array('buyer_id' => $buyer->getBuyer(), 'object_type' => 'PayInvoiceInvoice');
		$invoices 		= $this->getHelper('invoice')->get_rb_invoice_records($filter);	
		$payurls		= array();
		
		foreach ($invoices as $data){
			$invoice 					= PayInvoiceInvoice::getInstance($data->object_id);
			$payurls[$data->invoice_id] = $invoice->getPayUrl();
		}
		
		$this->assign('invoices',		$invoices);		
		$this->assign('payurls', 		$payurls);		
		$this->assign('buyer', 			$buyer);
		$this->assign('status_list', 	PayInvoiceInvoice::getStatusList());
		
		return true;
	}

	public function _basicFormSetup($task=null)
	{
		return true;
	}
	
}
