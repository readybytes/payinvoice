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
 * Buyer Html View
 * @author Manisha Ranawat
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewBuyer extends PayInvoiceAdminBaseViewBuyer
{	

	protected function _adminEditToolbar()
	{	
		Rb_HelperToolbar::apply();
		Rb_HelperToolbar::save();
		Rb_HelperToolbar::save2new('savenew');
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::cancel();
		Rb_HelperToolbar::divider();
	}

	protected function _adminGridToolbar()
	{
		Rb_HelperToolbar::addNew('new');
		Rb_HelperToolbar::editList();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::deleteList();
	}
	
	function edit($tpl=null,$itemId = null)
	{
		$itemId  =  ($itemId === null) ? $this->getModel()->getState('id') : $itemId ;
		$buyer   =  PayInvoiceBuyer::getInstance($itemId);
		
		$this->assign('buyer', $buyer);
		$this->assign('form',  $buyer->getModelform()->getForm($buyer));
        $this->assign('user', $buyer->getbuyer(true));
		
		return true;
		
	}
}