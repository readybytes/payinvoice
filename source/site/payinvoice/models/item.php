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

class PayInvoiceModelItem extends PayInvoiceModel
{
	public $filterMatchOpeartor = array(
	'type'	=> array('LIKE'),
	);
	
    
}
class PayInvoiceModelformItem extends PayInvoiceModelform { }