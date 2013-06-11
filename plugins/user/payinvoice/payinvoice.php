<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @contact		team@readybytes.in
*/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.filesystem.file');
require_once JPATH_SITE.'/components/com_payinvoice/payinvoice/includes.php';

class plgUserPayInvoice extends JPlugin
{
	
	function onUserAfterSave( $user )
	{
	    $db = JFactory::getDBO();
	    
	    if( is_object($user))
	    {
	        $user   = get_object_vars( $user );
	    }
	    
	    if( !isset( $user['id'] ) && empty( $user['id'] ) )
			return;
	    
	   $BuyerId     		= $user['id'];
	    
       $buyer  = PayInvoiceLib::getInstance('buyer');   
	   $buyer->set('buyer_id', $BuyerId)
	         ->save();
	  
       return true;
	}
	
	
	function onUserBeforeDelete($user)
	{
	    $mainframe	= JFactory::getApplication();
		
	    if( is_object($user))
	    {
	        $user   = get_object_vars( $user );
	    }
		
	    $buyerId     	= $user['id'];
		
	    $buyer  = PayInvoiceLib::getInstance('buyer', $buyerId);
	    $buyer->delete();

		//Delete invoice & transaction related to the user (after deleting user from joomla)
		$filter		= array('buyer_id' => $buyerId, 'object_type' => 'PayInvoiceInvoice');	
		$invoices	= Rb_EcommerceAPI::invoice_get_records($filter);
		foreach ($invoices as $invoice)
		{	
			PayInvoiceInvoice::getInstance($invoice->object_id)->delete();
		}

		return true;   	
	}
	
}

