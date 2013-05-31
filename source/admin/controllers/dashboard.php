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
 * Dashboard Controller
 * @author Gaurav Jain
 */
class PayInvoiceAdminControllerDashboard extends PayInvoiceController
{
	public function refresh_statistics()
	{
		$args = $this->_getArgs();
		$view = $this->getView();
		
		$view->assign('args', 	$args);
		return true;
	}
}