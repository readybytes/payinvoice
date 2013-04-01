<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
* @contact		team@readybytes.in
*/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.filesystem.file');
require_once JPATH_SITE.'/components/com_osinvoice/osinvoice/includes.php';

class plgUserOSInvoice extends JPlugin
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
	    
       $buyer  = OSInvoiceLib::getInstance('buyer');   
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
		
	    $buyer  = OSInvoiceLib::getInstance('buyer', $buyerId);
	    $buyer->delete();

		return true;   	
	}
	
}

