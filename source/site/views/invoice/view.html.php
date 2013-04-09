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
 * Invoice Html View
 * @author Gaurav Jain
 */
require_once dirname(__FILE__).'/view.php';
class OSInvoiceSiteViewInvoice extends OSInvoiceSiteBaseViewInvoice
{	
	public function display()
	{
		$userId    = OSInvoiceFactory::getUser()->id;
		$buyer     = OSInvoiceBuyer::getInstance($userId);
		$this->assign('buyer', $buyer);

		return true;
	}

	public function _basicFormSetup()
	{
		return true;
	}
	
}