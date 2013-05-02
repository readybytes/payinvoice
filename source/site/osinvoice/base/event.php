<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSI
* @subpackage	Front-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

/** 
 * Base Event
 * @author Gaurav Jain
 */
class OSInvoiceEvent extends JEvent
{
	public function onRbItemAfterSave($prev, $new)
	{
		// if this triger is for OSInvoice
		if($new instanceof Rb_EcommerceInvoice){			
			return self::_onRb_EcommerceInvoiceAfterSave($prev, $new);
		}
	}
	
	protected function _onRb_EcommerceInvoiceAfterSave($prev, $new)
	{		
		$this->_sendEmail($new, $prev);

		return true;
	}
	
	public function _sendEmail($new, $prev)
	{
		if($prev != null && $prev->getStatus() == $new->getStatus()){
			return true;
		}

		if($new->getStatus() != Rb_EcommerceInvoice::STATUS_PAID && $new->getStatus() != Rb_EcommerceInvoice::STATUS_REFUNDED){
			return true;
		}

		
		// get instance of front end email view
		$email_controller 	= OSInvoiceFactory::getInstance('email', 'controller', 'OSInvoicesite');
		$email_view 		= $email_controller->getView();
		$rb_invoice			= $new->toArray();
		$buyer 				= OSInvoiceFactory::getUser($rb_invoice['buyer_id']);
		$config_data		= OSInvoiceFactory::getHelper('config')->get();
		
		$email_view->assign('rb_invoice', $rb_invoice);
		$email_view->assign('buyer', $buyer);
		$email_view->assign('config_data', $config_data);
		
		$suffix = 'paid';
		if($new->getStatus()	== Rb_EcommerceInvoice::STATUS_REFUNDED){
			$suffix = 'refund';			
		}
		
		$body 	 			= $email_view->loadTemplate('invoice_'.$suffix);
		$subject 			= Rb_Text::_('COM_OSINVOICE_INVOICE_SEND_EMAIL_ON_INVOICE_'.strtoupper($suffix));
		
		$result = OSInvoiceFactory::getHelper('utils')->sendEmail($buyer->email, $subject, $body);
		if($result){
			return true;
		}else{
			//XITODO : Handle error when result is false
		}
			
	}
}

$dispatcher = JDispatcher::getInstance();
$dispatcher->register('onRbItemAfterSave', 'OSInvoiceEvent');
