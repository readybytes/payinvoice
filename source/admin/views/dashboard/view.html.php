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
 * Dashboard Html View
 * @author Gaurav Jain
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewDashboard extends PayInvoiceAdminBaseViewDashboard
{
	protected function _adminToolbar()
	{
		$this->_adminToolbarTitle();
	}
}