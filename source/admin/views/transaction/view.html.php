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
 * Transaction Html View
 * @author Gaurav Jain
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewTransaction extends PayInvoiceAdminBaseViewTransaction
{	
	/**
	 * @var PayInvoiceHelperInvoice
	 */
	public $_helper = null;
	
	protected function _adminGridToolbar()
	{
		Rb_HelperToolbar::editList();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::deleteList(Rb_Text::_('COM_PAYINVOICE_JS_ARE_YOU_SURE_TO_DELETE'));
	}
	
	protected function _adminEditToolbar()
	{	
		Rb_HelperToolbar::cancel();
	}
	
	function _displayGrid($records)
	{
		$buyerIds 	= array();
		$InvoiceIds	= array();
		foreach($records as $record){
			$buyerIds[] = $record->buyer_id;
			$InvoiceIds[] = $record->invoice_id;
		}
		
		$filter 	= array('invoice_id' => array(array('IN', '('.implode(",", $InvoiceIds).')')));
		$invoices 	= $this->getHelper('invoice')->get_rb_invoice_records($filter);				
		$helper		= $this->getHelper('buyer');
		$buyer 		= $helper->get($buyerIds);
        $statusList = Rb_EcommerceAPI::response_get_status_list();
		$this->assign('buyer', $buyer);
		$this->assign('statusList', $statusList);
        $this->assign('invoice', $invoices);
		
		return parent::_displayGrid($records);
	}
	
	function edit($tpl=null,$itemId = null)
	{
		$itemId  		= ($itemId === null) ? $this->getModel()->getState('id') : $itemId ;
		$filter			= array('transaction_id' => $itemId);
		$transaction   	= Rb_EcommerceAPI::transaction_get($filter);
		
		$invoice		= $this->getHelper('invoice')->get_rb_invoice_records(array('invoice_id' => $transaction['invoice_id']));
		$buyer			= $this->getHelper('buyer')->get($transaction['buyer_id']);
		
		$statusList 	= Rb_EcommerceAPI::response_get_status_list();
		
		// Show or hide refund button
		$refundable 		= false;
		if($transaction['payment_status'] == 'payment_complete'){ 
			if($invoice[$transaction['invoice_id']]->status == PayInvoiceInvoice::STATUS_PAID || $invoice[$transaction['invoice_id']]->status != PayInvoiceInvoice::STATUS_REFUNDED){
				$processor		= Rb_EcommerceAPI::get_processor_instance($invoice[$transaction['invoice_id']]->processor_type);
				$refundable 	= $processor->supportForRefund();
			}
		}
		
		$this->assign('transaction', $transaction);	
		$this->assign('invoice', $invoice);	
		$this->assign('buyer', $buyer);	
		$this->assign('statusList', $statusList);
		$this->assign('refundable', $refundable);
		
		return true;	
	}	
}
