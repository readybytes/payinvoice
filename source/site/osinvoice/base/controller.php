<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSI
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
class OSInvoiceController extends Rb_Controller
{
	public $_component = OSINVOICE_COMPONENT_NAME;	
	
	function __construct($options = array())
	{
		parent::__construct();
		
		if(!isset($this->input)){
			$this->input = OSInvoiceFactory::getApplication()->input; 
		}
		
		if(!isset($this->helper)){
			$this->helper = $this->getHelper();
		}
	}
	
	public function getHelper($name = '')
	{
		if(empty($name)){
			$name = $this->getName();
		}
		
		return OSInvoiceFactory::getHelper($name);
	}
}
