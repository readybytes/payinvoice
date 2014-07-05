<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Invoice Html View
 * @author Gaurav Jain
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewInvoice extends PayInvoiceAdminBaseViewInvoice
{		
	protected function _adminEditToolbar()
	{	
		$invoice_id 	= $this->getModel()->getState('id');
		$editable		= $this->_helper->isEditable($invoice_id);
		if($editable){
			Rb_HelperToolbar::apply();
			Rb_HelperToolbar::save();
			Rb_HelperToolbar::save2new('savenew');
			Rb_HelperToolbar::divider();
		}
		Rb_HelperToolbar::cancel();
	}
	
	protected function _adminGridToolbar()
	{
		Rb_HelperToolbar::addNew('new');
		Rb_HelperToolbar::editList();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::deleteList(Rb_Text::_('COM_PAYINVOICE_JS_ARE_YOU_SURE_TO_DELETE'));
		Rb_HelperToolbar::custom('download', 'download-alt', 'download-alt', Rb_Text::_('COM_PAYINVOICE_JS_EXPORT_PDF'));
	}
	
	function _displayGrid($records)
	{
		$InvoiceIds = array();
		foreach($records as $record){
			$InvoiceIds[] = $record->invoice_id;
		}
		
		$filter = array('object_id' => array(array('IN', '('.implode(",", $InvoiceIds).')')), 'master_invoice_id' => 0, 'object_type' => 'PayInvoiceInvoice');
		$invoices = Rb_EcommerceAPI::invoice_get_records($filter, array(), '',$orderby='object_id');
		
		$buyerIds  = array();
		foreach ($invoices as $invoice){
			$buyerIds[] = $invoice->buyer_id;
		}
		
		$this->assign('invoice', 	 $invoices);
		$this->assign('buyer', 		 $this->getHelper('buyer')->get($buyerIds));
		$this->assign('status_list', PayInvoiceInvoice::getStatusList());

		return parent::_displayGrid($records);
	}
	
	function edit($tpl= null, $itemId = null)
	{
		$itemId  = ($itemId === null) ? $this->getModel()->getState('id') : $itemId ;
		$invoice = PayInvoiceInvoice::getInstance($itemId);
		$form 	 = $invoice->getModelform()->getForm($invoice);

		$this->assign('invoice', $invoice);
		$this->assign('form',  $form);
		
		$params        = $invoice->getParams();
		$processor_id  = 0;
		if(!empty($params->processor_id)){
			$processor_id  = $params->processor_id;
		}
		
		$rb_invoice = $this->_helper->get_rb_invoice($itemId, true);	
		$discount	= 0.00;
		$tax		= 0.00;
		
		if($itemId){
			$form->bind(array('rb_invoice' => $rb_invoice)); 
			
			$discount	= $this->_helper->get_discount($rb_invoice['invoice_id']);
			$tax		= $this->_helper->get_tax($rb_invoice['invoice_id']);
	 		$currency 	= $rb_invoice['currency'];
	 		
	 		$this->assign('statusbutton', 	$this->_helper->get_status_button($rb_invoice['status']));
	 		$this->assign('rb_invoice', 	$rb_invoice);
 	        $this->assign('currency_symbol', 	$this->getHelper('format')->getCurrency($currency, 'symbol'));	
		}
		else{
			// XITODO : need to fix it properly
			// add 7 days in due date
			$binddata['rb_invoice']['issue_date'] = $rb_invoice['issue_date'];
			$due_date = new Rb_Date($rb_invoice['due_date']);
			// Previously add is used instead of modify(fix for php 5.2 compatibility)			
			$due_date->modify('+7 day');
			$binddata['rb_invoice']['due_date'] = (string)$due_date;
	
			$helper					= $this->getHelper('config');
			$currency 				= $helper->get('currency');
			$terms					= $helper->get('terms_and_conditions');
			$binddata['rb_invoice']['currency'] = $currency;
			$binddata['params'] 	=  array('terms_and_conditions' => $terms);
			$form->bind($binddata);	
		}	
		
		$rb_invoice_fieldset = $form->getFieldset('rb_invoice');
		$rb_invoice_fields = array();
		foreach ($rb_invoice_fieldset as $field){
			$rb_invoice_fields[$field->fieldname] = $field;
		}

		$invoice_params_fieldset	= $form->getFieldset('params');
		$invoice_params_fields		= array();
		foreach ($invoice_params_fieldset as $field){		 
				$invoice_params_fields[$field->fieldname] = $field->input;
		}
		
		$editable		= $this->_helper->isEditable($itemId);
		if(!$editable){
			$this->setTpl('view');
		}
		
		// Get transactions of an invoice
		$filter				= array('invoice_id' => $rb_invoice['invoice_id']);
		$transaction   		= Rb_EcommerceAPI::transaction_get_records($filter);
		
		$processor	= PayInvoiceProcessor::getInstance($processor_id)->toArray();
		$this->assign('processor_title', $processor['title']);
		
		$this->assign('discount', 			number_format($discount, 2));
		$this->assign('tax', 				number_format($tax, 2));
		$this->assign('rb_invoice_fields', 	$rb_invoice_fields);
        $this->assign('processor_id', 		$processor_id);   
        $this->assign('currency', 			$currency);
		$this->assign('invoice_params', 	$invoice_params_fields);
		$this->assign('transactions', 		$transaction);
		$this->assign('valid', 				$this->getHelper('invoice')->is_valid_date($rb_invoice['issue_date'], $rb_invoice['due_date']));
		$this->assign('applicable', 		$this->getHelper('invoice')->is_applicable_date($rb_invoice));
		$this->assign('buyer', 				PayInvoiceBuyer::getInstance($rb_invoice['buyer_id']));
		$this->assign('config_data',        $this->getHelper('config')->get());
		$this->assign('subtotal', 			number_format($this->_helper->get_subtotal($rb_invoice['invoice_id']), 2));
        return true;
	}	
}
