<?php
/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class PayInvoiceAdminBaseViewInstall extends PayInvoiceView
{
	public function display()
	{
		return true;
	}
	public function _basicFormSetup($task)
	{
		return true;
	}
}
