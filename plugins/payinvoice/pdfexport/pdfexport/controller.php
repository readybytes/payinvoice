<?php
/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYEXPORT
* @subpackage	PDFINVOICE
* @contact		team@readybytes.in
*/

jimport( 'joomla.filesystem.archive' );
jimport( 'joomla.document.document' );

if(defined('_JEXEC')===false) die();

class PayInvoiceadmincontrollerPdfExport extends PayInvoiceController
{	
	public function getModel($name = '', $prefix = '', $config = array())
	{
		return null;
	}
	
	public function download()
	{
		return true;
	}
}

