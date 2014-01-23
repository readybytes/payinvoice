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
	
	public function display($tpl=null)
	{
		$this->assign('currencies', $this->getHelper('statistics')->currencies_used());
		$this->assign('default_currency', $this->getHelper('config')->get('currency'));
		return true;
	}
	
	public function _basicFormSetup($task)
	{
		return true;
	}
}