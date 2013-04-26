<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

/** 
 * Invoice Html View
 * @author Gaurav Jain
 */
require_once dirname(__FILE__).'/view.php';
class OSInvoiceSiteViewInvoice extends OSInvoiceSiteBaseViewInvoice
{	
	public function display()
	{
		$itemid  = $this->getModel()->getId();
		$osi_invoice = OSInvoiceInvoice::getInstance($itemid);	

		// XITODO : use helper function
		$filter = array('object_type' => 'OSInvoiceInvoice', 'object_id' => $itemid, 'master_invoice_id' => 0);
		$xiee_invoice = XiEEAPI::invoice_get($filter);
		$buyer   = OSInvoiceBuyer::getInstance($xiee_invoice['buyer_id']);
		
		$discount	=  $this->_helper->get_discount($itemid);
		$tax		=  $this->_helper->get_tax($itemid);
		$subtotal	=  $this->_helper->get_subtotal($itemid);
		
		$formatHelper			= $this->getHelper('format');
		$currency  				= $formatHelper->getCurrency($xiee_invoice['currency'], 'symbol');
		$status 				= $this->_helper->get_invoice_status_type($xiee_invoice['status']);
		
		$config			= $this->getHelper('config');
		$configData     = $config->get();
			
		$this->assign('tax', $tax);
		$this->assign('discount', $discount);
		$this->assign('subtotal', $subtotal);
		$this->assign('buyer', $buyer);
		$this->assign('osi_invoice', $osi_invoice->toArray());
		$this->assign('xiee_invoice', $xiee_invoice);
		$this->assign('status', $status);
		$this->assign('currency', $currency);
		$this->assign('config_data', $configData);

		return true;
	}

	public function _basicFormSetup()
	{
		return true;
	}
	
}
