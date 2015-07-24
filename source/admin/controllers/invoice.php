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
			$data['rb_invoice']['serial'] 	 		= $data['rb_invoice']['reference_no'];
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
		$discount		= explode('%', $data['discount']);
		$is_percentage = (count($discount) > 1) ? true : false;
		
		$this->_helper->create_modifier($invoice_id, 'PayInvoiceItem', $data['subtotal'], 10);
		$this->_helper->create_modifier($invoice_id, 'PayInvoiceDiscount', -$discount[0], 20 , $is_percentage);		
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

		if(empty($currency)){
	      		$currency  = $this->getHelper('config')->get('currency');
		}
				
		$response  = PayInvoiceFactory::getAjaxResponse();
		$response->addScriptCall('payinvoice.jQuery("#payinvoice_form_rb_invoice_currency").val',$currency);
		$response->addScriptCall('payinvoice.admin.invoice.on_currency_change', $currency);
		$response->sendResponse();
		
	}
	
	
	public function email()
	{
		$confirmed = $this->input->getBool('confirmed', 0);
		$this->getView()->assign('confirmed', $confirmed);	
		return true;
	}

	// Check reference number is valid & already exist or not
	function ajaxchangeserial()
	{
		$invoice_id 		= $this->input->get('invoice_id');				
		$invoice_ref_no 	= $this->input->get('value');
		
		$ref_no_exists			= $this->_helper->exist_reference_number($invoice_ref_no , $invoice_id);

		$response = array();
		$response['value']  = $invoice_ref_no;
		if($ref_no_exists)
		{	
			$response['valid'] 	 = false;
			$response['message'] = JText::sprintf('COM_PAYINVOICE_INVOICE_REFERENCE_NO_ALREADY_EXIST');
		}
		else
		{
			//check if reference number contain valid prefix or not
			$prefix			= PayInvoiceHelperConfig::get('invoice_rno_prefix');
			if ((strpos($invoice_ref_no, $prefix) !== false) && ($invoice_ref_no != $prefix)) 
			{
		    	$response['valid'] 	 = true;
				$response['message'] = '';
			}
			else
			{
				$response['valid'] 	 = false;
				$response['message'] = JText::sprintf('COM_PAYINVOICE_INVOICE_REFERENCE_NO_PREFIX_ERROR' , $prefix);
			}
			
		}
		echo json_encode($response);
		exit();
	}

	public function markpaid()
	{
		$confirmed = $this->input->getBool('confirmed', 0);
		$this->getView()->assign('confirmed', $confirmed);	
		
		return true;
	}
	
	// Check if discount entered is valid or not
	function ajaxcheckdiscount()
	{
		$discount_value			= $this->input->get('value','','string');
		$discount_value			= trim($discount_value);
		
		$response = array();
		$response['value']  = $discount_value;
		
		//check if discount given in %, if yes get the numeric part out of it
		//also show error if user provides data like num%num
		$discount		= explode('%', $discount_value);
		if(!empty($discount[1]) || empty($discount[0]))
		{
			$response['valid'] 	 = false;
			$response['message'] = JText::sprintf('COM_PAYINVOICE_INVOICE_DISCOUNT_ERROR' , $discount_value);
			
			echo json_encode($response);
			exit();
		}
		
		if(is_numeric($discount[0]))
		{
			$response['valid'] 	 = true;
			$response['message'] = '';
		}
		else
		{
			$response['valid'] 	 = false;
			$response['message'] = JText::sprintf('COM_PAYINVOICE_INVOICE_DISCOUNT_ERROR' , $discount_value);
		}
		echo json_encode($response);
		exit();
	}
	
	//Send bulk mails
	public function sendmail()
	{
		$invoice_ids = JRequest::getVar('cid');
		
		foreach($invoice_ids as $invoice_id)
		{
			$msg = $this->_helper->sendMailToClient($invoice_id);
		}
		
		JFactory::getApplication()->redirect('index.php?option=com_payinvoice&view=invoice' , $msg);
	}

}
