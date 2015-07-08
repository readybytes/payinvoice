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
 * Invoice Model
 * @author Gaurav Jain
 */
class PayInvoiceModelInvoice extends PayInvoiceModel
{
	public function getLastSerial()
	{
		$db		 = JFactory::getDbo();
		$query	 = 'SELECT MAX(invoice_id) FROM `#__payinvoice_invoice`';
		$db->setQuery($query);
		
		return $db->loadResult();
	}
}

class PayInvoiceModelformInvoice extends PayInvoiceModelform { }