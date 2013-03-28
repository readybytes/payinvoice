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
 * Buyer Html View
 * @author Manisha Ranawat
 */
require_once dirname(__FILE__).'/view.php';
class OSInvoiceAdminViewBuyer extends OSInvoiceAdminBaseViewBuyer
{	
	
	function edit($tpl=null,$itemId = null)
	{
		$itemId  =  ($itemId === null) ? $this->getModel()->getState('id') : $itemId ;
		$buyer   =  OSInvoiceBuyer::getInstance($itemId);
		
		$this->assign('buyer', $buyer);
		$this->assign('form',  $buyer->getModelform()->getForm($buyer));
		
		return true;
		
	}
}