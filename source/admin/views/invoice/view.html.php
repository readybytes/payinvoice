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
		$invoices = XiEEAPI::invoice_get_records($filter, array(), '',$orderby='object_id');
		
		$buyerIds  = array();
		foreach ($invoices as $invoice){
			$buyerIds[] = $invoice->buyer_id;
		}
		
		$buyer = OSInvoiceHelperBuyer::get($buyerIds);
		$statusList = XiEEAPI::invoice_get_status_list();
		
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
		$discount 	= 0.00;
		$tax 		= 0.00;

		if($itemId){
			$xiee_invoice = XiEEAPI::invoice_get(array('object_type' => 'OSInvoiceInvoice', 'object_id' => $itemId, 'master_invoice_id' => 0));						
			$form->bind(array('xiee_invoice' => $xiee_invoice)); 
			
			$discount_modifier = XiEEAPI::modifier_get($xiee_invoice['invoice_id'], 'OSInvoiceDiscount');
			if($discount_modifier != false){
				$discount_modifier = array_pop($discount_modifier);
				$discount = -$discount_modifier->amount;
			}
			
			$tax_modifier = XiEEAPI::modifier_get($xiee_invoice['invoice_id'], 'OSInvoiceTax');
			if($tax_modifier != false){
				$tax_modifier = array_pop($tax_modifier);
				$tax = $tax_modifier->amount;
			}
		 	$currency = $xiee_invoice['currency']; 	
		}
		else{
			$currency = OSInvoiceHelperConfig::get('currency');
			$form->bind(array('xiee_invoice' => array('currency' => $currency)));
		}	
		
		$xiee_invoice_fieldset = $form->getFieldset('xiee_invoice');
		$xiee_invoice_fields = array();
		foreach ($xiee_invoice_fieldset as $field){
			$xiee_invoice_fields[$field->fieldname] = $field;
		}
		
		$this->assign('discount', number_format($discount, 2));
		$this->assign('tax', number_format($tax, 2));
		$this->assign('xiee_invoice_fields', $xiee_invoice_fields);
        $this->assign('processor_id', $processor_id);   
        $this->assign('currency', $currency);
		return true;
	}	
}