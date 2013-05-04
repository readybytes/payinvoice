<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

/** 
 * Base Controller
 * @author Gaurav Jain
 */
class PayInvoiceController extends Rb_Controller
{
	public $_component = PAYINVOICE_COMPONENT_NAME;	
	
	function __construct($options = array())
	{
		parent::__construct();
		
		if(!isset($this->input)){
			$this->input = PayInvoiceFactory::getApplication()->input; 
		}
		
		if(!isset($this->_helper)){
			$this->_helper = $this->getHelper();
		}
	}
	
	public function getHelper($name = '')
	{
		if(empty($name)){
			$name = $this->getName();
		}
		
		return PayInvoiceFactory::getHelper($name);
	}
}
