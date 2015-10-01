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
		//validation on item & task quantity
 		$data['items'] = $this->validateQuantity($data['items']);	
 		$data['tasks'] = $this->validateQuantity($data['tasks']);	
		
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
	//for adding new item in item table and call from ajax
	function addNewItem()
	{
		$data 			= JRequest::getVar('payinvoice_form');
		$element_id		= JRequest::getVar('element_id');
		$item 			= PayInvoiceItem::getInstance();
		$items			= $item->bind($data)->save();
		$item_data		= $items->toArray();
		$item_data['element_id']=$element_id;					   
		$response  		= PayInvoiceFactory::getAjaxResponse();
		$response->addScriptCall('payinvoice.admin.invoice.addNewItem_on_success', $item_data);
		 $response->sendResponse();

	}
	
	// for changing item from invoice screen
	function ajaxchangeitem()
	{
		$args     			= $this->_getArgs();
		$item_id 			= $args['item_id'];
		$element_id			= $args['element_id'];
		$item 				= PayInvoiceItem::getInstance($item_id);
		$data				= $item->toArray();
		$data['element_id'] = $element_id;	
		$response  		 	= PayInvoiceFactory::getAjaxResponse();
		$response->addScriptCall('payinvoice.admin.invoice.on_item_change_success', $data);
		$response->sendResponse();
	}
	
	// Show currency symbol in all price fiel when cureency changes
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
			$mail_status = $this->_helper->sendMailToClient($invoice_id);
		}
		
		$type = ($mail_status['sentEmail']) ? 'message' : 'error';
		
		JFactory::getApplication()->enqueueMessage($mail_status['msg'] , $type);
		JFactory::getApplication()->redirect('index.php?option=com_payinvoice&view=invoice');
	}
	
	// validating the quantity
	protected function validateQuantity($items)
	{			
		for($i = 0 ; $i < count($items) ; $i++)
		{		
			$items[$i]['quantity'] = ltrim(($items[$i]['quantity']) , "0");	
		}
		return $items;
	}

	// copy function of invoice
	public function _copy($itemId)
	{	
		$id 				= array('object_id' => $itemId);	
		$invoice			= PayInvoiceInvoice::getInstance($itemId);
		$invoice ->setId(0);
		//reset payinvoice invoice serial no.
		$invoice->set('invoice_serial','');

		$model			 = PayinvoiceFactory::getInstance('invoice', 'model');
		$lastSerial		 = $model->getLastSerial();
		
		$invoice->save();
		$invoice_id 		= $invoice->getInvoiceId();
		$invoice_record 	= Rb_EcommerceAPI::invoice_get($id, false);
		$invoice_record['object_id'] = $invoice_id;
		$rb_invoice_id 		= $invoice_record['invoice_id'];
		
		//reset payment status for paid invoice
		$invoice_record['status'] = PayInvoiceInvoice::STATUS_DUE;
		$invoice_record['processor_type']   = '';
		$invoice_record['processor_config'] = '';
		$invoice_record['processor_data']   = '';
		//verify issue date and due date 
 		
 		$currentDate 	=  gmdate("Y-m-d H:i:s");
 		$invoice_record['issue_date']	= $currentDate;
 		$invoice_record['created_date']	= $currentDate;
 		$due_date 						= new Rb_Date($rb_invoice['due_date']);
 		$due_date->modify('+7 day');
 		$invoice_record['due_date'] 	= (string)$due_date;
		
		//assign serial no to Invoice
		$prefix			 = $this->getHelper('config')->get('invoice_rno_prefix');
		$invoice_record['serial'] = $prefix.($lastSerial+1);

 		//creating new copy invoice in rb_ecommerce table
		$invoice_create_Id 		= Rb_EcommerceAPI::invoice_create($invoice_record,true);
		$invoice_record['invoice_id']   = $invoice_create_Id;
		//get modifier data and create new modifier for copy invoice
		$modifiers 			= Rb_EcommerceAPI::modifier_get($rb_invoice_id);
		
		foreach ($modifiers as $key => $value)
		{
			$value->invoice_id = $invoice_create_Id;
			$modifiers[$key]->amount;
			if ($value->serial == 10)
			{
				$this->_helper->create_modifier($value->invoice_id, 'PayInvoiceItem', $value->amount, 10);
			}
			else if ($value->serial == 20)
				 {
					$this->_helper->create_modifier($value->invoice_id, 'PayInvoiceDiscount', $value->amount, 20 , $value->percentage);
		   		 }
			else if ($value->serial == 45)
				{
					$this->_helper->create_modifier($value->invoice_id, 'PayInvoiceTax', $value->amount, 45, true);
				}
		}
		//change rb_ecommerce invoice title for copy
		$invoice_record['title'] = JText::_("COM_PAYINVOICE_COPY_OF").$itemId;
		$invoice_id = Rb_EcommerceAPI::invoice_update($invoice_create_Id, $invoice_record, true);
		return $invoice_id;
	}
}
