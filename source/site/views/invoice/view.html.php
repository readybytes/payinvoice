<?php

/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Invoice Html View
 * @author Gaurav Jain
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceSiteViewInvoice extends PayInvoiceSiteBaseViewInvoice
{	
	public function display($tpl = null)
	{
		$itemid  = $this->getModel()->getId();
		$payinvoice_invoice = PayInvoiceInvoice::getInstance($itemid)->toArray();
		
		// XITODO : use helper function
		$rb_invoice	= $this->getHelper('invoice')->get_rb_invoice($itemid);

		$formatHelper	= $this->getHelper('format');
		$currency  	= $formatHelper->getCurrency($rb_invoice['currency'], 'symbol');
		
		$createdDate	= new Rb_Date($rb_invoice['issue_date']);
		$dueDate		= new Rb_Date($rb_invoice['due_date']);	
		$created_date   = $formatHelper->date($createdDate);
		$due_date		= $formatHelper->date($dueDate);
		$current_date   = gmdate("d-m-Y");
		
		//check whether discount is implemented in % and add % after discount-value if its implemented in %
		$subtotal		   = $this->_helper->get_subtotal($rb_invoice['invoice_id']);
		$tax			   = $this->_helper->get_tax($rb_invoice['invoice_id']);
		
		$discount		= array();
		$discount['value']	= $this->_helper->get_discount($rb_invoice['invoice_id']);
		$discount_modifier 	= Rb_EcommerceAPI::modifier_get($rb_invoice['invoice_id'], 'PayInvoiceDiscount');
		if (!empty($discount_modifier)){
			$discount_modifier = array_pop($discount_modifier);
			$discount['is_percent'] 	   = $discount_modifier->percentage;
			
		}
		else{
			$discount['is_percent'] = false;
		}
		$discount['amount']   = ($discount['is_percent']) ? $this->_helper->get_discount_amount($subtotal , $discount['value']) : number_format($discount['value'], 2);
		
		//get tax amount from given data
		$tax_amount		   = $this->_helper->get_tax_amount($subtotal , $discount['amount'] , $tax);
		$valid       	= $this->getHelper('invoice')->is_valid_date($rb_invoice['issue_date'], $rb_invoice['due_date']);
		if(!empty($payinvoice_invoice['params']['processor_id'])){
			$processor	= PayInvoiceProcessor::getInstance($payinvoice_invoice['params']['processor_id'])->toArray();
			$this->assign('processor_title', $processor['title']);
		}
		
		//for due date over then late fee will be applied and make modifier
		$late_fee				= array();
		$late_fee['value']		= $payinvoice_invoice['params']['late_fee_value'];
		$late_fee['percentage']	= $payinvoice_invoice['params']['late_fee_type'];
		$late_fee['amount']	 	= ($late_fee['percentage']) ? $this->_helper->get_latefee_amount($late_fee['value'] , $subtotal ,$discount['amount'],$tax_amount) : $late_fee['value'];
		if (strtotime($current_date) > strtotime($due_date) && $rb_invoice['status'] == PayInvoiceInvoice::STATUS_DUE && $rb_invoice['status'] != PayInvoiceInvoice::STATUS_INPROCESS )
		{
			$this->_helper->create_modifier($rb_invoice['invoice_id'], 'PayInvoiceLateFee', $late_fee['value'], 55 , $late_fee['percentage']);
			$invoice_id = Rb_EcommerceAPI::invoice_update($rb_invoice['invoice_id'], $rb_invoice, true);
			$rb_invoice	= $this->getHelper('invoice')->get_rb_invoice($itemid);
			
		}
		$late_fee_modifier = Rb_EcommerceAPI::modifier_get($rb_invoice['invoice_id'], 'PayInvoiceLateFee');
		if (!empty($late_fee_modifier)){
			$late_fee['status'] = true;
		}
		else {
			$late_fee['status'] = false;
		}
				
		//XITODO : Clean the code
		
		$this->assign('late_fee',		$late_fee);
		$this->assign('discount' , 		$discount);
		$this->assign('tax_amount',		$tax_amount);
		$this->assign('tax', 			$tax);
		$this->assign('subtotal', 		$subtotal);
		$this->assign('buyer', 			PayInvoiceBuyer::getInstance($rb_invoice['buyer_id']));
		$this->assign('payinvoice_invoice', $payinvoice_invoice);
		$this->assign('rb_invoice', 		$rb_invoice);
		$this->assign('statusbutton', 		$this->_helper->get_status_button($rb_invoice['status']));
		$this->assign('currency', 		$currency);
		$this->assign('config_data', 		$this->getHelper('config')->get());
		$this->assign('created_date', 		$created_date);
		$this->assign('due_date', 		$due_date);
//		$this->assign('valid', 			$valid);
		$this->assign('applicable', 		$this->getHelper('invoice')->is_applicable_date($rb_invoice));

		return true;
	}

	public function _basicFormSetup($task=null)
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
			$invoice = Rb_EcommerceAPI::invoice_get(array('object_id' => $itemId, 'object_type' => 'PayInvoiceInvoice'), false);						
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
