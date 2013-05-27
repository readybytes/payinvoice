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
 * Invoice Controller
 * @author Gaurav Jain
 */
class PayInvoiceAdminControllerInvoice extends PayInvoiceController
{
	/**
	 * @var PayInvoiceHelperInvoice
	 */
	public $_helper = null;
	public function _save(array $data, $itemId=null, $type=null)
	{
		// If Serial number already exist then do nothing
		$serial_exist	= $this->_helper->exist_serial_number($data['rb_invoice']['serial']);
		if(!$itemId && $serial_exist){
			return true;
		}
		//create new lib instance
		$invoice = Rb_Lib::getInstance($this->_component->getPrefixClass(), $this->getName(), $itemId, $data)
						->save();
		
	   if(!empty($data['params']['processor_id'])){
		    $processor = PayInvoiceProcessor::getInstance($data['params']['processor_id']);
	
		    $data['rb_invoice']['processor_type']     = $processor->getType();
		    $data['rb_invoice']['processor_config']   = $processor->getParams();
		}else {
			$data['rb_invoice']['processor_type']     = '';
		    $data['rb_invoice']['processor_config']   = '';
		}
						
		// create invoice in Rb_Ecommerce, in $itemId is null
		if(!$itemId){
			$data['rb_invoice']['status'] 	 		= PayInvoiceInvoice::STATUS_DUE;
			$data['rb_invoice']['object_type'] 	 	= 'PayInvoiceInvoice';
			$data['rb_invoice']['object_id'] 	 	= $invoice->getId();
			$data['rb_invoice']['expiration_type'] 	= RB_ECOMMERCE_EXPIRATION_TYPE_FIXED;
			$data['rb_invoice']['time_price'] 		= array('time' => array('000000000000'), 'price' => array('0.00'));
			$invoice_id = Rb_EcommerceAPI::invoice_create($data['rb_invoice'], true); 
			$data['rb_invoice']['invoice_id'] = $invoice_id;
		}	
		else{
			$invoice_id = $data['rb_invoice']['invoice_id'];
		}
		
		// XITODO : use constants
		$this->_helper->create_modifier($invoice_id, 'PayInvoiceItem', $data['subtotal'], 10);
		$this->_helper->create_modifier($invoice_id, 'PayInvoiceDiscount', -$data['discount'], 20);
		$this->_helper->create_modifier($invoice_id, 'PayInvoiceTax', $data['tax'], 45, true);
		
		$invoice_id = Rb_EcommerceAPI::invoice_update($invoice_id, $data['rb_invoice'], true);
		
		return $invoice;
	}
    
    // Show currency symbol in all price fiel when cureency change
	function ajaxchangecurrency()
	{
		$args     	= $this->_getArgs();
		$currency 	= $args['currency'];
		
		$format		 = $this->getHelper('format');
		$symbol		 = $format->getCurrency($currency, 'symbol');
				
		$response  = PayInvoiceFactory::getAjaxResponse();
		$response->addScriptCall('payinvoice.jQuery(".payinvoice-currency").html',$symbol);
		$response->sendResponse();
		
	}
	
    // When select user then set currency of user in currency field
	function ajaxchangebuyer()
	{
		$args     	= $this->_getArgs();
		$buyer_id 	= $args['buyer'];
		
		$buyer 		= PayInvoiceBuyer::getInstance($buyer_id);
		$currency   = $buyer->getCurrency();
				
		$response  = PayInvoiceFactory::getAjaxResponse();
		$response->addScriptCall('payinvoice.jQuery("#payinvoice_form_rb_invoice_currency").val',$currency);
		$response->addScriptCall('payinvoice.admin.invoice.item.on_currency_change', $currency);
		$response->sendResponse();
		
	}
	
	
	public function email()
	{
		$confirmed = $this->input->getBool('confirmed', 0);
		$this->getView()->assign('confirmed', $confirmed);	
		return true;
	}

	// Check serial number is already exist or not
	function ajaxchangeserial()
	{
		$invoice_serial 	= $this->input->get('value');	
		$serial				= $this->_helper->exist_serial_number($invoice_serial);

		$response = array();
		$response['value'] = $invoice_serial;
		if($serial){	
			$response['valid'] 	 = false;
			$response['message'] = Rb_Text::_('COM_PAYINVOICE_INVOICE_SERIAL_ALREADY_EXIST');
		}else {
			$response['valid'] 	 = true;
			$response['message'] = '';
		}
		echo json_encode($response);
		exit();
	}
}
