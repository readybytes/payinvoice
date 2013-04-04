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
 * Transaction Controller
 * @author Gaurav Jain
 */
class OSInvoiceAdminControllerTransaction extends OSInvoiceController
{
	public function getModel()
	{
        return XiEEAPI::transaction_get_model();
	}

}
