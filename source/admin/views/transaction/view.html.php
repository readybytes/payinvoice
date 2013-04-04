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
 * Transaction Html View
 * @author Gaurav Jain
 */
require_once dirname(__FILE__).'/view.php';
class OSInvoiceAdminViewTransaction extends OSInvoiceAdminBaseViewTransaction
{	
	function _displayGrid($records)
	{
		$buyerIds = array();
		foreach($records as $record){
			$buyerIds[] = $record->buyer_id;
		}
		
		$buyer = OSInvoiceHelperBuyer::get($buyerIds);
        $statusList = XiEEAPI::response_get_status();
		$this->assign('buyer', $buyer);
		$this->assign('statusList', $statusList);
		
		return parent::_displayGrid($records);
	}
	
}