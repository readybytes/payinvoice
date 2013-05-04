<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

/** 
 * Invoice Helper
 * @author Gaurav Jain
 */
class PayInvoiceHelperInvoice extends JObject
{
	public function create_modifier($invoice_id, $type, $amount, $serial, $is_percentage = false)
	{
		// get modifiers of item type on the current invoice
		$modifiers = Rb_EcommerceAPI::modifier_get($invoice_id, $type);
		
		$found = false;
		// there will be only modifier of each type
		foreach($modifiers as $modifier){
			if($modifier->object_type === $type){
				$found = $modifier;
				break;
			}
		}
		
		if($found){
			$modifier->amount 	  = $amount;
			$modifier->percentage = $is_percentage;			
		}
		else{
			$invoice = Rb_EcommerceAPI::invoice_get(array('invoice_id' => $invoice_id));
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
		}
		
		Rb_EcommerceAPI::modifier_create($modifier);
	}
	
	public function get_rb_invoice($invoice_id)
	{
		$filter = array('object_type' => 'PayInvoiceInvoice', 'object_id' => $invoice_id, 'master_invoice_id' => 0);
		return Rb_EcommerceAPI::invoice_get($filter);
	}
	
	public function get_rb_invoice_records($filter)
	{
		return Rb_EcommerceAPI::invoice_get_records($filter);
	}
	
	public function get_invoice_status_type($status)
	{
	   $status_list  = Rb_EcommerceAPI::invoice_get_status_list();
	   $statusType   = $status_list[$status];
	   
	   if($statusType == "Paid"){
	   	$class = 'label-success';
	   }
	   elseif ($statusType == "Pending" || $statusType == "Checkout"){
	   	 $class = 'label-warning';
	   }
	   else {
	   	$class = 'label-info';
	   }
	   
	   $status_data  = array('status' => $statusType, 'class' => $class);
	   return $status_data;
	}
	
    // get existing serial number
	public function exist_serial_number($serial)
	{
		$filter			= array('serial' => $serial);
		$serial_number	= Rb_EcommerceAPI::invoice_get_records($filter);
		if($serial_number){
			return true;
		}
		
		return false;
	}
	
	// get discount through modifiers
	public function get_discount($invoice_id)
	{
		$discount 	= 0.00;		
		$discount_modifier = Rb_EcommerceAPI::modifier_get($invoice_id, 'PayInvoiceDiscount');
		if($discount_modifier != false){
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
		if($tax_modifier != false){
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
		if($items_modifier != false){
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
	
}
