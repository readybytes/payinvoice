<?php

/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Invoice Helper
 * @author Gaurav Jain
 */
class PayInvoiceHelperInvoice extends JObject
{
	public function create_modifier($invoice_id, $type, $amount, $serial, $is_percentage = false)
	{
		//deleting existing invoice if exist
		$query = new Rb_Query();
		$query->delete()
			->from('#__rb_ecommerce_modifier')
			->where('`object_type` = "'.$type.'"')
			->where('`invoice_id` = '.$invoice_id);
			
		if(!$query->dbLoadQuery()->execute()){
		throw new Exception('Error in deleting modifier table');
		}
		
		if($amount == 0)
		{
			return false;
		}
		
		
		$invoice = Rb_EcommerceAPI::invoice_get(array('object_type' => 'PayInvoiceInvoice', 'invoice_id' => $invoice_id));
		$modifier = new stdClass();
		$modifier->modifier_id 	= 0;				
		$modifier->invoice_id 	= $invoice_id;
		$modifier->buyer_id 	= $invoice['buyer_id'];
		$modifier->amount	 	= $amount;			
		$modifier->object_type	= $type;
		$modifier->object_id	= 0;
		$modifier->message 		= 'COM_PAYINVOICE_MODIFIER_'.strtoupper($type);
		$modifier->percentage	= $is_percentage;			
		$modifier->serial 		= $serial;
		$modifier->frequency	= 'ONLY_THIS';	
		
		Rb_EcommerceAPI::modifier_create($modifier);
	}
	
	public function get_rb_invoice($invoice_id, $empty_record = false)
	{
		$filter = array('object_type' => 'PayInvoiceInvoice', 'object_id' => $invoice_id, 'master_invoice_id' => 0);
		return Rb_EcommerceAPI::invoice_get($filter, $empty_record);
	}
	
	public function delete_rb_invoice($invoice_id)
	{
		$rb_invoice = $this->get_rb_invoice($invoice_id);
		return Rb_EcommerceAPI::invoice_delete($rb_invoice['invoice_id']);
	}
	
	public function get_rb_invoice_records($filter)
	{
		return Rb_EcommerceAPI::invoice_get_records($filter);
	}
	
	public function get_status_button($status)
	{
		if($status == PayInvoiceInvoice::STATUS_PAID){
	   		$class = 'label label-success';
	   	}
	   	elseif ($status == PayInvoiceInvoice::STATUS_DUE){
	   	 	$class = 'label label-warning';
	   	}elseif ($status == PayInvoiceInvoice::STATUS_REFUNDED){
	   		$class =  'label label-default';
	   	}
	   	else {
	   		$class = 'label label-info';
	   }
	   
	   $status_list	= PayInvoiceInvoice::getStatusList();
	   
	   return array('class' => $class, 'status' => $status_list[$status]);
	}
	
    // get existing reference number
	public function exist_reference_number($ref_no , $invoice_id = null)
	{
		$filter			= array('serial' => $ref_no, 'object_type' => 'PayInvoiceInvoice');
		$ref_number	= Rb_EcommerceAPI::invoice_get_records($filter);
		
		//if its a new invoice, then return true if reference number exists
		if((is_null($invoice_id) || ($invoice_id == 0)) && !empty($ref_number)){
			return true;
		}

		//if user is editing previously made invoice, then restrict only if the reference number entered is of another invoice 
		if(!empty($ref_number) && $invoice_id){
			$keys = array_keys($ref_number);			
			if(!in_array($invoice_id,$keys)){
				return true;
			}
		}
		
		return false;
	}
	
	// get discount through modifiers
	public function get_discount($invoice_id)
	{
		$discount 	= 0.00;		
		$discount_modifier = Rb_EcommerceAPI::modifier_get($invoice_id, 'PayInvoiceDiscount');
		if (!empty($discount_modifier)){
			$discount_modifier = array_pop($discount_modifier);
			$discount = -$discount_modifier->amount;
		}
		return $discount;
	}
	
    // get tax through modifiers
	public function get_tax($invoice_id)
	{
		$tax 		= 0.00;
		$tax_modifier = Rb_EcommerceAPI::modifier_get($invoice_id, 'PayInvoiceTax');
		if (!empty($tax_modifier)){
			$tax_modifier = array_pop($tax_modifier);
			$tax = $tax_modifier->amount;
		}
		return $tax;
	}
	
	// get subtotal through modifiers
	public function get_subtotal($invoice_id)
	{
		$subtotal = 0.00;
		$items_modifier = Rb_EcommerceAPI::modifier_get($invoice_id, 'PayInvoiceItem');
		if (!empty($items_modifier)){
			$items_modifier = array_pop($items_modifier);
			$subtotal = $items_modifier->amount;
		}
		return $subtotal;
	}
	
	public function is_valid_date($issue_date, $due_date)
	{
	    $current_date   = new Rb_Date('now');
	    $issue_date		= new Rb_Date($issue_date);
		$due_date      	= new Rb_Date($due_date);
		
		$currentDate 	= $current_date->toUnix();
		$issueDate    	= $issue_date->toUnix();
		$dueDate 		= $due_date->toUnix();
		
		if($currentDate > $issueDate && $currentDate < $dueDate){
			return true;
		}
		
		return false;
	}
	
	public function is_applicable_date($rb_invoice)
	{
		if($rb_invoice['status'] == PayInvoiceInvoice::STATUS_DUE)
		{
			$current_date   = new Rb_Date('now');
		    $issue_date		= new Rb_Date($rb_invoice['issue_date']);
			$due_date      	= new Rb_Date($rb_invoice['due_date']);
			
			$currentDate 	= $current_date->toUnix();
			$issueDate    	= $issue_date->toUnix();
			$dueDate 		= $due_date->toUnix();
			
			$title			= JText::_('COM_PAYINVOICE_INVOICE_LOCKED');
			$message		= '';
			if($currentDate < $issueDate){
				$message	= JText::_('COM_PAYINVOICE_INVOICE_LOCKED_ISSUE_DATE_MSG');
			}elseif ($currentDate > $dueDate) {
				$message	= JText::_('COM_PAYINVOICE_INVOICE_LOCKED_DUE_DATE_MSG');
			}

			if($message){
				return array('message' => $message, 'title' => $title);
			}
		}
		
		return false;
		
	}

	// Check that Invoice is editable or not	
	public function isEditable($invoice_id)
	{
		$rb_invoice = $this->get_rb_invoice($invoice_id, true);
		if($rb_invoice['status'] == PayInvoiceInvoice::STATUS_DUE || $rb_invoice['status'] == PayInvoiceInvoice::STATUS_NONE){
			return true;
		}	
		return false;
	}

	public function process_payment($request_name, $rb_invoice, $data , $itemid)
	{
		while(true){
			$req_response 	= Rb_EcommerceApi::invoice_request($request_name, $rb_invoice['invoice_id'], $data);
			$response 		= $this->process_invoice($rb_invoice['invoice_id'], $req_response , $itemid);

			if($response->get('next_request', false) == false){
				
				//Give proper message if the transaction fails due to configuration settings or anything else
				if($response->get('payment_status') == Rb_EcommerceResponse::FAIL){
					JFactory::getApplication()->enqueueMessage($response->get('message') , 'error');
				}
				break;
			}

			$request_name = $response->get('next_request_name', 'payment');
		}
	}
	
	//function to process invoice and assign serial number accordingly
	public function process_invoice($invoice_id , $req_response , $itemid)
	{
		$response = Rb_EcommerceApi::invoice_process($invoice_id , $req_response);
		
		//assign serial number to paid invoice when its paid online   		
   		//don't do anything if it is an offline payment, because in offline payment, invoice serial would be assigned when it would be marked paid
   		
   		if($response && ($response->get('payment_status') == Rb_EcommerceResponse::PAYMENT_COMPLETE))
   		{
   			PayInvoiceHelperInvoice::setInvoiceSerial($itemid);
   		}
   		
   		return $response;
	}
	
	// Assign invoice serial number to paid invoices
	public function setInvoiceSerial($invoice_id)
	{
		$config_records	 = PayInvoiceFactory::getConfig();
		$lastCounter 	 = $config_records['expert_invoice_last_serial'];
			
		if (empty($lastCounter)) {
			$lastCounter = 0;
		}
		
		$lastCounter++;

		$db 		= JFactory::getDbo();
		$query 		= "UPDATE `#__payinvoice_invoice` SET `invoice_serial` = $lastCounter WHERE `invoice_id` = $invoice_id";
		$db->setQuery($query);
		
		if($db->execute())
		{		
			$config_records['expert_invoice_last_serial'] = $lastCounter;
			PayInvoiceFactory::saveConfig($config_records);			
		}
	}
	
	// Send email to client
	public function sendMailToClient($invoice_id)
	{
		// get instance of front end email view
		$email_controller 	= PayInvoiceFactory::getInstance('email', 'controller', 'PayInvoicesite');
		$email_view 		= $email_controller->getView();
		
		$rb_invoice =  $this->get_rb_invoice($invoice_id);
		
		$email_view->assign('rb_invoice', 	$rb_invoice);
		$email_view->assign('invoice', 		PayInvoiceInvoice::getInstance($invoice_id)->toArray());
		$email_view->assign('status_list', 	PayInvoiceInvoice::getStatusList());
		$email_view->assign('config_data', 	PayInvoiceFactory::getHelper('config')->get());
		$email_view->assign('buyer', 		PayInvoiceFactory::getHelper('buyer')->get($rb_invoice['buyer_id']));
		
		//XITODO : Currency Symbol not shown in email template	
		//$currency = $this->getHelper('format')->getCurrency($rb_invoice['currency'], 'symbol');
		//$email_view->assign('currency', $currency);
		
		$email_view->assign('tax', 			$this->get_tax($rb_invoice['invoice_id']));
		$email_view->assign('discount', 	$this->get_discount($rb_invoice['invoice_id']));
		$email_view->assign('subtotal', 	$this->get_subtotal($rb_invoice['invoice_id']));
		
        // md5 key generated for authentication		
		$key	= md5($rb_invoice['created_date']);
		$url	= JUri::root().'index.php?option=com_payinvoice&view=invoice&invoice_id='.$invoice_id.'&key='.$key;
		$email_view->assign('pay_url', $url);
		
		// email content
		$body 	 = $email_view->loadTemplate('invoice');
		$subject = JText::_('COM_PAYINVOICE_INVOICE_SEND_EMAIL_SUBJECT');
		$user 	 = PayInvoiceFactory::getUser($rb_invoice['buyer_id']);		
		
		// attach Pdf Invoice with email		
		$args			= array($rb_invoice['object_id'], &$user->email, &$subject, &$body, &$attachment);
		Rb_HelperPlugin::trigger('onPayInvoiceEmailBeforSend', $args, '' ,$this);

		$result = PayInvoiceFactory::getHelper('utils')->sendEmail($user->email, $subject, $body, $attachment);
		$msg = JText::_('COM_PAYINVOICE_INVOICE_EMAIL_SENT');
		$sentEmail	= true;
		if(!$result){
			$msg = JText::_('COM_PAYINVOICE_INVOICE_ERROR_SEND_ERROR');	
			$sentEmail	= false;					
		}
		elseif($result instanceof Exception){
			$msg  = JText::_('COM_PAYINVOICE_INVOICE_ERROR_SEND_ERROR');
			$msg .= "<br/><div class='alert alert-error'>".$result->getMessage()."</div>";
			$sentEmail	= false;
		}
		
		// Save parameter to ensure email being sent or not
		$invoice  = PayInvoiceInvoice::getInstance($invoice_id);
		$invoice->setParam('emailSent' , $sentEmail);
		$invoice->save();
		
		$mail_status = array('sentEmail' => $sentEmail , 'msg' => $msg);
		return $mail_status;
	}
	
	//TODO: change it to getTaxAmount
	public function get_tax_amount($subtotal , $discount_amount , $tax)
	{
		$value = $subtotal-$discount_amount;
		$amount = $tax*$value*0.01;
		return $amount;
	}

	//TODO: change it to getDiscountAmount
	public function get_discount_amount($subtotal , $discount)
	{
		return $subtotal*$discount*0.01;
	}

	// get late fee amount
	public function get_latefee_amount($late_fee , $subtotal ,$discount_amount,$tax_amount){
		$total = $subtotal - $discount_amount + $tax_amount;
		$amount = $total * $late_fee * 0.01;
		return $amount;
	}
	
}
