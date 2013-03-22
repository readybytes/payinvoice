<?php

/**
 * @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * @package 	OSI
 * @subpackage	Front-end
 * @contact		team@readybytes.in
 */

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

/** 
 * Base Model Form
 * @author Gaurav Jain
 */
class OsiModelform extends Rb_Modelform
{
	public	$_component			= OSI_COMPONENT_NAME;	
	protected $_forms_path 		= OSI_PATH_CORE_FORMS;
	protected $_fields_path 	= OSI_PATH_CORE_FIELDS;
}