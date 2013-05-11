<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
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
class PayInvoiceSiteViewInvoice extends PayInvoiceSiteBaseViewInvoice
{	
	public function display()
	{
		$itemid  = $this->getModel()->getId();
		$payinvoice_invoice = PayInvoiceInvoice::getInstance($itemid)->toArray();	

		// XITODO : use helper function
		$filter 	= array('object_type' => 'PayInvoiceInvoice', 'object_id' => $itemid, 'master_invoice_id' => 0);
		$rb_invoice = Rb_EcommerceAPI::invoice_get($filter);
		$buyer   	= PayInvoiceBuyer::getInstance($rb_invoice['buyer_id']);
		
		$discount	=  $this->_helper->get_discount($rb_invoice['invoice_id']);
		$tax		=  $this->_helper->get_tax($rb_invoice['invoice_id']);
		$subtotal	=  $this->_helper->get_subtotal($rb_invoice['invoice_id']);
		
		$formatHelper	= $this->getHelper('format');
		$currency  		= $formatHelper->getCurrency($rb_invoice['currency'], 'symbol');
		$statusbutton 		= $this->_helper->get_status_button($rb_invoice['status']);
		
		$config			= $this->getHelper('config');
		$configData     = $config->get();
		
		$createdDate	= new Rb_Date($rb_invoice['issue_date']);
		$dueDate		= new Rb_Date($rb_invoice['due_date']);	
		$created_date   = $formatHelper->date($createdDate);
		$due_date		= $formatHelper->date($dueDate);
		
		$valid       	= $this->getHelper('invoice')->is_valid_date($rb_invoice['issue_date'], $rb_invoice['due_date']);
		if(!empty($payinvoice_invoice['params']['processor_id'])){
			$processor	= PayInvoiceProcessor::getInstance($payinvoice_invoice['params']['processor_id'])->toArray();
			$this->assign('processor_title', $processor['title']);
		}

		$applicable	= $this->getHelper('invoice')->is_applicable_date($rb_invoice['issue_date'], $rb_invoice['due_date']);
		
		//XITODO : Clean the code		
		$this->assign('tax', $tax);
		$this->assign('discount', $discount);
		$this->assign('subtotal', $subtotal);
		$this->assign('buyer', $buyer);
		$this->assign('payinvoice_invoice', $payinvoice_invoice);
		$this->assign('rb_invoice', $rb_invoice);
		$this->assign('statusbutton', $statusbutton);
		$this->assign('currency', $currency);
		$this->assign('config_data', $configData);
		$this->assign('created_date', $created_date);
		$this->assign('due_date', $due_date);
		$this->assign('valid', $valid);
		$this->assign('applicable', $applicable);

		return true;
	}

	public function _basicFormSetup()
	{
		return true;
	}
	
	function complete()
	{
		$itemId 	= $this->getModel()->getId();
		$invoice	= $this->getHelper('invoice')->get_rb_invoice($itemId);
				
		$action = Rb_Factory::getApplication()->input->get('action','success');
		
		if($action === 'success'){
			$this->setTpl('complete_success');			
		}else {
			$this->setTpl('complete_error');
		}
			
		return true;
	}
	
	public function cancel()
	{
		$this->setTpl('complete_cancel');
		return true;
	}
	
}
