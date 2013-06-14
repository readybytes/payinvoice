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
 * Base Model Form
 * @author Gaurav Jain
 */
class PayInvoiceModelform extends Rb_Modelform
{
	public	$_component			= PAYINVOICE_COMPONENT_NAME;	
	protected $_forms_path 		= PAYINVOICE_PATH_CORE_FORMS;
	protected $_fields_path 	= PAYINVOICE_PATH_CORE_FIELDS;
}