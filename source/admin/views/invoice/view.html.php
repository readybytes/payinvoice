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
class PayInvoiceAdminViewInvoice extends PayInvoiceAdminBaseViewInvoice
{		
	protected function _adminEditToolbar()
	{	
		$invoice_id 	= $this->getModel()->getState('id');
		$editable		= $this->_helper->isEditable($invoice_id);
		if($editable){
			JToolbarHelper::apply();
			JToolbarHelper::save();
			JToolbarHelper::save2new('savenew');
			JToolbarHelper::divider();
		}
		JToolbarHelper::cancel();
	}
	
	protected function _adminGridToolbar()
	{
		JToolbarHelper::addNew('new');
		JToolbarHelper::editList();
		JToolbarHelper::divider();
		JToolbarHelper::custom( 'copy', 'copy.png', 'copy_f2.png', 'COM_PAYINVOICE_COPY', true );
		JToolbarHelper::deleteList(JText::_('COM_PAYINVOICE_JS_ARE_YOU_SURE_TO_DELETE'));
		JToolbarHelper::custom('download', 'download-alt', 'download-alt', JText::_('COM_PAYINVOICE_JS_EXPORT_PDF'));
		JToolbarHelper::custom('sendmail', 'envelope', 'envelope', JText::_('COM_PAYINVOICE_SEND_MAIL'));
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
		
		//get title of the items from item table
		$invoiceArray = $invoice->toArray();
		$invoiceArray = $invoice->getItems($invoiceArray);
       
		$this->assign('invoice', $invoice);
		$this->assign('form',  $form);
		//$this->assign('invoiceArray' ,$invoiceArray);
			
		$params        = $invoice->getParams();
		$processor_id  = 0;
		if(!empty($params->processor_id)){
			$processor_id  = $params->processor_id;
		}
		
		$rb_invoice = $this->_helper->get_rb_invoice($itemId, true);	
		$discount	= 0.00;
		$tax		= 0.00;
		
		if($itemId){			
			$rb_invoice['reference_no'] = $rb_invoice['serial'];
			$form->bind(array('rb_invoice' => $rb_invoice)); 
			
			$discount	= $this->_helper->get_discount($rb_invoice['invoice_id']);
			$tax		= $this->_helper->get_tax($rb_invoice['invoice_id']);
	 		$currency 	= $rb_invoice['currency'];
	 		
	 		//check whether discount is implemented in % and add % after discount-value if its implemented in %
			$discount_modifier = Rb_EcommerceAPI::modifier_get($rb_invoice['invoice_id'], 'PayInvoiceDiscount');
			if (!empty($discount_modifier)){
			$discount_modifier = array_pop($discount_modifier);
			$is_percent 	   = $discount_modifier->percentage;
			}
			else {
				$is_percent = false;
				$discount_modifier = 0.00;
			}
			$discount		   = ($is_percent) ? $discount.'%' : number_format($discount, 2);
	 		$this->assign('statusbutton', 		$this->_helper->get_status_button($rb_invoice['status']));
	 		$this->assign('rb_invoice', 		$rb_invoice);
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
			
			//assign serial no to Invoice
			$model			 = PayinvoiceFactory::getInstance('invoice', 'model');
			$lastSerial		 = $model->getLastSerial();
			$prefix			 = $this->getHelper('config')->get('invoice_rno_prefix');
			$binddata['rb_invoice']['reference_no'] = $prefix.($lastSerial+1);
	
			$helper							 = $this->getHelper('config');
			$currency 						 = $helper->get('currency');
			$terms							 = $helper->get('terms_and_conditions');
			$binddata['rb_invoice']['currency']			 = $currency;
			$invoiceArray['params']['late_fee_value']    	 = $helper->get('invoice_late_fee_amount');
			$invoiceArray['params']['late_fee_type']	 = $helper->get('invoice_late_fee_type');
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
		
		// Mark Inoice paid from backend itself 
		$this->assign('mark_paid', false);
		if($rb_invoice['status'] == PayInvoiceInvoice::STATUS_INPROCESS){
			$this->assign('mark_paid', true);
		}
		
		// Get transactions of an invoice
		$filter				= array('invoice_id' => $rb_invoice['invoice_id']);
		$transaction   		= Rb_EcommerceAPI::transaction_get_records($filter);
		
		$processor	= PayInvoiceProcessor::getInstance($processor_id)->toArray();
		$this->assign('processor_title', $processor['title']);
		$this->assign('invoiceArray', 		$invoiceArray);
		$this->assign('discount', 			$discount);
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
		
		//For Buyer Form
		
		$buyer   =  PayInvoiceBuyer::getInstance();
		$this->assign('buyer_form',  $buyer->getModelform()->getForm($buyer));
        $this->assign('user', $buyer->getbuyer(true));
        
        //For Item Form
        $item      = PayInvoiceItem::getInstance();
	$item_form = $item->getModelform()->getForm($item);
	$this->assign('item_form',  $item_form);
        return true;
	}
}
