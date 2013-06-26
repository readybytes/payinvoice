<?php

/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PAYINVOICE
* @subpackage	SUPPORT
* @contact		team@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgPayinvoiceSupport extends Rb_Plugin
{
	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);
		
		define('PAYINVOICE_PREMIUM_BUILD', true);
	}	
		
	
}
