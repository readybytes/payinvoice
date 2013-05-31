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

		$formatHelper	= $this->getHelper('format');
		$currency  		= $formatHelper->getCurrency($rb_invoice['currency'], 'symbol');
		
		$createdDate	= new Rb_Date($rb_invoice['issue_date']);
		$dueDate		= new Rb_Date($rb_invoice['due_date']);	
		$created_date   = $formatHelper->date($createdDate);
		$due_date		= $formatHelper->date($dueDate);

		$valid       	= $this->getHelper('invoice')->is_valid_date($rb_invoice['issue_date'], $rb_invoice['due_date']);
		if(!empty($payinvoice_invoice['params']['processor_id'])){
			$processor	= PayInvoiceProcessor::getInstance($payinvoice_invoice['params']['processor_id'])->toArray();
			$this->assign('processor_title', $processor['title']);
		}
		
		//XITODO : Clean the code		
		$this->assign('tax', 				$this->_helper->get_tax($rb_invoice['invoice_id']));
		$this->assign('discount', 			$this->_helper->get_discount($rb_invoice['invoice_id']));
		$this->assign('subtotal', 			$this->_helper->get_subtotal($rb_invoice['invoice_id']));
		$this->assign('buyer', 				PayInvoiceBuyer::getInstance($rb_invoice['buyer_id']));
		$this->assign('payinvoice_invoice', $payinvoice_invoice);
		$this->assign('rb_invoice', 		$rb_invoice);
		$this->assign('statusbutton', 		$this->_helper->get_status_button($rb_invoice['status']));
		$this->assign('currency', 			$currency);
		$this->assign('config_data', 		$this->getHelper('config')->get());
		$this->assign('created_date', 		$created_date);
		$this->assign('due_date', 			$due_date);
		$this->assign('valid', 				$valid);
		$this->assign('applicable', 		$this->getHelper('invoice')->is_applicable_date($rb_invoice));

		return true;
	}

	public function _basicFormSetup()
	{
		return true;
	}
	
	function complete()
	{
		$itemId 	= $this->getModel()->getId();
		if(!$itemId){
			// XITODO : get invoice number from response
		}
		else{	
			$invoice = $this->getHelper('invoice')->get_rb_invoice($itemId);							
			$this->assign('rb_invoice', $invoice);
			$suffix = '';
			if($invoice['status'] == PayInvoiceInvoice::STATUS_DUE){
				$suffix = 'DUE';
			}
			elseif($invoice['status'] == PayInvoiceInvoice::STATUS_INPROCESS){
				$suffix = 'INPROCESS';
			}
			elseif($invoice['status'] == PayInvoiceInvoice::STATUS_PAID){
				$suffix = 'PAID';
			}
			elseif($invoice['status'] == PayInvoiceInvoice::STATUS_REFUNDED){
				$suffix = 'REFUNDED';
			}
			else{
				$suffix = 'CONTACT_ADMIN';
			}
			
			$this->assign('message', 'COM_PAYINVOICE_INVOICE_COMPLETE_MESSAGE_'.$suffix);
		}
		
		$this->setTpl('complete');
		return true;
	}
	
	public function cancel()
	{
		$this->setTpl('complete_cancel');
		return true;
	}
	
}
