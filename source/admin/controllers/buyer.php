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
 * Buyer Controller
 * @author Gaurav Jain
 */
class OSInvoiceAdminControllerBuyer extends OSInvoiceController
{
	public function _save(array $data, $itemId=null, $type=null)
	{
		if(empty($data['username'])){
		   $data['username'] = $data['email'];
		}

		$id = $this->_helper->storeUser($data);
		if(!$id){
			JFactory::getApplication()->enqueueMessage(JText::sprintf('COM_OSINVOICE_BUYER_NOT_SAVED'));
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
		
		$exist		= $this->_helper->getjoomlaUser('email', $email);
		$response 	 = OSInvoiceFactory::getAjaxResponse();
		if($exist){
			$response->addScriptCall('osinvoice.jQuery("span.osi-email-error").html', Rb_Text::_('COM_OSINVOICE_EMAIL_ALREADY_EXIST'));
			$response->addScriptCall('osinvoice.jQuery("#osinvoice_form_email").focus()');
		}
		$response->sendResponse();	
	}
}
