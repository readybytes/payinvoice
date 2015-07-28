<?php
/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * DashBoard Controller
 * @author Manisha Ranawat
 */
class PayInvoiceSiteControllerDashboard extends PayInvoiceController
{
	public function display($cachable = false, $urlparams = array())
	{
		return true;
	}
	
	function getModel($name = '', $prefix = '', $config = array())
	{
		return null;
	}
}