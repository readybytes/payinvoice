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
		$buyerIds 	= array();
		$InvoiceIds	= array();
		foreach($records as $record){
			$buyerIds[] = $record->buyer_id;
			$InvoiceIds[] = $record->invoice_id;
		}
		
		$filter = array('invoice_id' => array(array('IN', '('.implode(",", $InvoiceIds).')')));
		$invoices = XiEEAPI::invoice_get_records($filter);
		
		$helper		= $this->getHelper('buyer');
		$buyer 		= $helper->get($buyerIds);
        $statusList = XiEEAPI::response_get_status_list();
		$this->assign('buyer', $buyer);
		$this->assign('statusList', $statusList);
        $this->assign('invoice', $invoices);
		
		return parent::_displayGrid($records);
	}
	
	function edit($tpl=null,$itemId = null)
	{
		$itemId  		= ($itemId === null) ? $this->getModel()->getState('id') : $itemId ;
		$transaction   	= XiEEAPI::transaction_get_record($itemId);
		
		$invoice		= XiEEAPI::invoice_get_records(array('invoice_id' => $transaction['invoice_id']));
		$buyer			= $this->getHelper('buyer')->get($transaction['buyer_id']);;
		
		$this->assign('transaction', $transaction);	
		$this->assign('invoice', $invoice);	
		$this->assign('buyer', $buyer);	
		return true;	
	}
	
}