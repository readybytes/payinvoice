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
 * Dashboard Base View
 * @author Gaurav Jain
 */
class PayInvoiceAdminBaseViewDashboard extends PayInvoiceView
{
	public function display()
	{
		return true;
	}
	
	public function _basicFormSetup()
	{
		return true;
	}
}