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

class PayInvoiceAdminControllerInstall extends PayInvoiceController
{
	function getModel($name = '', $prefix = '', $config = array())
	{
		return null;
	}
	
	public function complete()
	{
		$app = PayInvoiceFactory::getApplication();
		$app->redirect("index.php?option=com_payinvoice&view=dashboard");

		return true;	
	}
}
