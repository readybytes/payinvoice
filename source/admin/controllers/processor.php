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
 * Invoice Controller
 * @author Manisha Ranawat
 */
class PayInvoiceAdminControllerProcessor extends PayInvoiceController
{
	function selectProcessor()
	{		
		return true;
	}
	
	public function _save(array $data, $itemId=null, $type=null)
	{
        // When form post then processors data post in processo_config, to save these data into params we assign it into params
		$data['params'] = $data['processor_config'];
		
		return parent::_save($data, $itemId, $type);
	}	
}
