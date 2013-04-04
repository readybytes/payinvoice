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
 * Buyer Helper
 * @author Manisha Ranawat
 */
class OSInvoiceHelperBuyer extends JObject
{
	
	public function storeUser($data = array())
	{
		require_once JPATH_ROOT. '/components/com_users/models/registration.php';
		$model = new UsersModelRegistration();
		
		// load user helper
		jimport('joomla.user.helper');
		$temp = array(	'username'=>$data['username'],'name'=>$data['name'],'email1'=>$data['email'],
						'password1'=>$data['password'], 'password2'=>$data['password'], 'block'=>0 );
				
		$config = JFactory::getConfig();
		$params = JComponentHelper::getParams('com_users');

		// Initialise the table with JUser.
		$user = new JUser($data['buyer_id']);
		
		$userData = (array)$model->getData();
		// Merge in the registration data.
		foreach ($temp as $k => $v) {
			$userData[$k] = $v;
		}

		// Prepare the data for the user object.
		$userData['email']		= $userData['email1'];
		$userData['password']	= $userData['password1'];
		
		// Bind the data.
		//XITODO Handling
		if (!$user->bind($userData)) {
			JFactory::getApplication()->enqueueMessage(JText::sprintf('COM_OSINVOICE_BUYER_NOT_SAVED', $user->getError()));
			return false;
		}

		// Load the users plugin group.
		JPluginHelper::importPlugin('user');

		if(!$data['buyer_id']){			
			$updateonly = false;
		}else {
			$updateonly = true;
		}
		
		// Store the data.
		//XITODO Handling
		if (!$user->save($updateonly)) {
			JFactory::getApplication()->enqueueMessage(JText::sprintf('COM_OSINVOICE_BUYER_REGISTRATION_FAILED', $user->getError()));
			return false;
		}
		
		return $user->id;
	}

	public function get($buyerIds)
	{
		if(!is_array($buyerIds)){
			$buyerIds = array($buyerIds);
		}
		
		$buyerIds  = array_unique($buyerIds);
		
		$filter = array('buyer_id' => array(array('IN', '('.implode(",", $buyerIds).')')));
		return OSInvoiceFactory::getInstance('buyer', 'model')->loadRecords($filter);
	}
}
