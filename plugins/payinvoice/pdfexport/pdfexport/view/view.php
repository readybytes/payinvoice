<?php

/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Pdf Export Base View
 * @author Manisha Ranawat
 */
class PayInvoiceAdminBaseViewPdfExport extends PayInvoiceView
{
	/**
	 * @var PayInvoiceHelperPdfInvoice
	 */
	public $_helper = null;
	 
	public function __construct($config = array())
	{
		parent::__construct($config);
		
		$this->addPathToTemplate(dirname(__FILE__).'/tmpl');
	}
	
	public function getModel($anme = '')
	{
		return null;
	} 
}
