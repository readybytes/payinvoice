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
 * Invoice Controller
 * @author Gaurav Jain
 */
class OSInvoiceAdminControllerInvoice extends OSInvoiceController
{
	/**
	 * @var OSInvoiceHelperInvoice
	 */
	public $helper = null;
	public function _save(array $data, $itemId=null, $type=null)
	{
		//create new lib instance
		$invoice = Rb_Lib::getInstance($this->_component->getPrefixClass(), $this->getName(), $itemId, $data)
						->save();
						
		// create invoice in XiEE, in $itemId is null
		if(!$itemId){
			$data['xiee_invoice']['object_type'] 	 = 'OSInvoiceInvoice';
			$data['xiee_invoice']['object_id'] 	 	 = $invoice->getId();
			$data['xiee_invoice']['expiration_type'] = XIEE_EXPIRATION_TYPE_FIXED;
			$data['xiee_invoice']['time_price'] = array('time' => array('000000000000'), 'price' => array('0.00'));
			$invoice_id = XiEEAPI::invoice_create($data['xiee_invoice'], true); 
		}	
		else{
			$invoice_id = $data['xiee_invoice']['invoice_id'];
		}
		
		// XITODO : use constants
		$this->helper->create_modifier($invoice_id, 'OSInvoiceItem', $data['subtotal'], 10);
		$this->helper->create_modifier($invoice_id, 'OSInvoiceDiscount', -$data['discount'], 20);
		$this->helper->create_modifier($invoice_id, 'OSInvoiceTax', $data['tax'], 45, true);
		
		$invoice_id = XiEEAPI::invoice_update($data['xiee_invoice']['invoice_id'], $data['xiee_invoice'], true);
		
		return $invoice;
	}
}
