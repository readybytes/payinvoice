<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
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
class OSInvoiceHelperInvoice extends JObject
{
	public function create_modifier($invoice_id, $type, $amount, $serial, $is_percentage = false)
	{
		// get modifiers of item type on the current invoice
		$modifiers = XiEEAPI::modifier_get($invoice_id, $type);
		
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
			$invoice = XiEEAPI::invoice_get(array('invoice_id' => $invoice_id));
			$modifier = new stdClass();
			$modifier->modifier_id 	= 0;				
			$modifier->invoice_id 	= $invoice_id;
			$modifier->buyer_id 	= $invoice['buyer_id'];
			$modifier->amount	 	= $amount;			
			$modifier->object_type	= $type;
			$modifier->object_id	= 0;
			$modifier->message 		= 'COM_OSINVOICE_MODIFIER_'.strtoupper($type);
			$modifier->percentage	= $is_percentage;			
			$modifier->serial 		= $serial;
			$modifier->frequency	= 'ONLY_THIS';	
		}
		
		XiEEAPI::modifier_create($modifier);
	}
	
	public function get_xiee_invoice($invoice_id)
	{
		$filter = array('object_type' => 'OSInvoiceInvoice', 'object_id' => $invoice_id, 'master_invoice_id' => 0);
		return XiEEAPI::invoice_get($filter);
	}
	
	public function get_invoice_status_type($status)
	{
	   $status_list  = XiEEAPI::invoice_get_status_list();
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
		$serial_number	= XiEEAPI::invoice_get_records($filter);
		if($serial_number){
			return true;
		}
		
		return false;
	}
	
	// get discount through modifiers
	public function get_discount($invoice_id)
	{
		$discount 	= 0.00;		
		$discount_modifier = XiEEAPI::modifier_get($invoice_id, 'OSInvoiceDiscount');
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
		$tax_modifier = XiEEAPI::modifier_get($invoice_id, 'OSInvoiceTax');
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
		$items_modifier = XiEEAPI::modifier_get($invoice_id, 'OSInvoiceItem');
		if($items_modifier != false){
			$items_modifier = array_pop($items_modifier);
			$subtotal = $items_modifier->amount;
		}
		return $subtotal;
	}
	
}
