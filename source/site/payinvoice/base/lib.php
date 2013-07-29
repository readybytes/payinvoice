<?php

/**
 * @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * @package 	PAYINVOICE
 * @subpackage	Front-end
 * @contact		team@readybytes.in
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Base Lib
 * @author Gaurav Jain
 */
class PayInvoiceLib extends Rb_Lib
{
	public	$_component	= PAYINVOICE_COMPONENT_NAME;

	static public function getInstance($name, $id=0, $data=null, $dummy = null)
	{
		return parent::getInstance(PAYINVOICE_COMPONENT_NAME, $name, $id, $data);
	}
	
	public function getHelper()
	{
		$helper = PayInvoiceFactory::getHelper();
		$name   = $this->getName();
		return isset($helper->$name) ? $helper->$name : false;  // assert if helper not found
	}
}
