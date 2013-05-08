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
 * Buyer Controller
 * @author Gaurav Jain
 */
class PayInvoiceAdminControllerBuyer extends PayInvoiceController
{
	public function _save(array $data, $itemId=null, $type=null)
	{
		if(empty($data['username'])){
		   $data['username'] = $data['email'];
		}

		$id = $this->_helper->storeUser($data);
		if(!$id){
			JFactory::getApplication()->enqueueMessage(JText::sprintf('COM_PAYINVOICE_BUYER_NOT_SAVED'));
			return true;
		}
		$data['buyer_id'] = $id;

		return parent::_save($data, $itemId, $type);
	}	
    
  	// Check email already registere or not
	public function ajaxvalidateemail()
	{
		$args     	= $this->_getArgs();
		$email		= $args['email'];
		$buyer_id	= $args['buyer_id'];
		
		$existing_userid = $this->_helper->getjoomlaUser('email', $email);
		$response 	 	 = PayInvoiceFactory::getAjaxResponse();
		if($existing_userid && ($existing_userid != $buyer_id)){
			$response->addScriptCall('payinvoice.jQuery("span.payinvoice-email-error").html', Rb_Text::_('COM_PAYINVOICE_EMAIL_ALREADY_EXIST'));
			$response->addScriptCall('payinvoice.jQuery("#payinvoice_form_email").focus()');
		}else {
			$response->addScriptCall('payinvoice.jQuery("span.payinvoice-email-error").html', "");
		}
		$response->sendResponse();	
	}
	
	// XITODO : Clean Code
	// Check username already registered or not
	public function ajaxvalidateusername()
	{
		$args     	= $this->_getArgs();
		$username	= $args['username'];
		$buyer_id	= $args['buyer_id'];
		
		$existing_username = $this->_helper->getjoomlaUser('username', $username);
		$response 	 	 = PayInvoiceFactory::getAjaxResponse();
		if($existing_username && ($existing_username != $buyer_id)){
			$response->addScriptCall('payinvoice.jQuery("span.payinvoice-username-error").html', Rb_Text::_('COM_PAYINVOICE_USERNAME_ALREADY_EXIST'));
			$response->addScriptCall('payinvoice.jQuery("#payinvoice_form_username").focus()');
		}else {
			$response->addScriptCall('payinvoice.jQuery("span.payinvoice-username-error").html', "");
		}
		$response->sendResponse();	
	}
}
