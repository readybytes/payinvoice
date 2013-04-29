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
class OSInvoiceAdminViewInvoice extends OSInvoiceAdminBaseViewInvoice
{		
	protected function _adminEditToolbar()
	{	
		Rb_HelperToolbar::apply();
		Rb_HelperToolbar::save();
		Rb_HelperToolbar::save2new();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::cancel();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::custom('email', 'envelope.png', 'envelope_f2.png', 'OSINVOCIE_TOOLBAR_EMAIL', false);
	}
	
	function _displayGrid($records)
	{
		$InvoiceIds = array();
		foreach($records as $record){
			$InvoiceIds[] = $record->invoice_id;
		}
		
		$filter = array('object_id' => array(array('IN', '('.implode(",", $InvoiceIds).')')), 'master_invoice_id' => 0);
		$invoices = Rb_EcommerceAPI::invoice_get_records($filter, array(), '',$orderby='object_id');
		
		$buyerIds  = array();
		foreach ($invoices as $invoice){
			$buyerIds[] = $invoice->buyer_id;
		}
		
		$buyerHelper	= $this->getHelper('buyer');
		$buyer 			= $buyerHelper->get($buyerIds);
		$statusList 	= Rb_EcommerceAPI::invoice_get_status_list();
		
		$this->assign('invoice', $invoices);
		$this->assign('buyer', $buyer);
		$this->assign('statusList', $statusList);

		return parent::_displayGrid($records);
	}
	
	function edit($tpl= null, $itemId = null)
	{
		$itemId  = ($itemId === null) ? $this->getModel()->getState('id') : $itemId ;
		$invoice = OSInvoiceInvoice::getInstance($itemId);
		$form 	 = $invoice->getModelform()->getForm($invoice);

		$this->assign('invoice', $invoice);
		$this->assign('form',  $form);
		
		$params        = $invoice->getParams();
		$processor_id  = 0;
		if(isset($params->processor_id)){
			$processor_id  = $params->processor_id;
		}
		
		if($itemId){
			$rb_invoice = $this->_helper->get_rb_invoice($itemId);
			$form->bind(array('rb_invoice' => $rb_invoice)); 
			
			$discount	= $this->_helper->get_discount($rb_invoice['invoice_id']);
			$tax		= $this->_helper->get_tax($rb_invoice['invoice_id']);
		 	$currency 	= $rb_invoice['currency'];

		 	$invoice_url	= $invoice->getPayUrl();
		 	$this->assign('invoice_url', $invoice_url);
		}
		else{
			$helper		= $this->getHelper('config');
			$currency 	= $helper->get('currency');
			$form->bind(array('rb_invoice' => array('currency' => $currency)));
		}	
		
		$rb_invoice_fieldset = $form->getFieldset('rb_invoice');
		$rb_invoice_fields = array();
		foreach ($rb_invoice_fieldset as $field){
			$rb_invoice_fields[$field->fieldname] = $field;
		}
		
		$this->assign('discount', number_format($discount, 2));
		$this->assign('tax', number_format($tax, 2));
		$this->assign('rb_invoice_fields', $rb_invoice_fields);
        $this->assign('processor_id', $processor_id);   
        $this->assign('currency', $currency);
		return true;
	}	
}