<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

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

	function _remove($itemId=null, $userId=null)
	{
		$user           = JFactory::getUser($itemId);
		$isUserSA       = $user->authorise('core.admin');
		
		if($isUserSA)
		{
			$this->setError(Rb_Text::_('COM_PAYINVOICE_CANNOT_DELETE_SUPER_ADMINISTRATOR'));
			return false;

		}else {
			$user->delete();
			// Invoice delated related to deleted user
			$filter		= array('buyer_id' => $itemId, 'object_type' => 'PayInvoiceInvoice');	
			$invoices	= Rb_EcommerceAPI::invoice_get_records($filter);
			foreach ($invoices as $invoice)
			{	
				PayInvoiceInvoice::getInstance($invoice->object_id)->delete();
			}
		}
		
		return true;
	}
    
  	// Check email already registere or not
	public function ajaxvalidateemail()
	{
		$email				= $this->input->getHtml('value');
		$buyer_id			= $this->_getId();
		$existing_userid 	= $this->_helper->getjoomlaUser('email', $email);
		
		$response = array();
		$response['value'] = $email;
		if($existing_userid && $existing_userid != $buyer_id){
			$response['valid'] 	 = false;
			$response['message'] = Rb_Text::_('COM_PAYINVOICE_EMAIL_ALREADY_EXIST');
		}else {
			$response['valid'] 	 = true;
			$response['message'] = '';
		}
		echo json_encode($response);
		exit();	
	}
	
	// XITODO : Clean Code
	// Check username already registered or not
	public function ajaxvalidateusername()
	{
		$username			= $this->input->getHtml('value');
		$buyer_id			= $this->_getId();
		$existing_userid 	= $this->_helper->getjoomlaUser('username', $username);
		
		$response = array();
		$response['value'] = $username;
		if($existing_userid && $existing_userid != $buyer_id){	
			$response['valid'] 	 = false;
			$response['message'] = Rb_Text::_('COM_PAYINVOICE_USERNAME_ALREADY_EXIST');
		}else {
			$response['valid'] 	 = true;
			$response['message'] = '';
		}
		echo json_encode($response);
		exit();
	}
}
