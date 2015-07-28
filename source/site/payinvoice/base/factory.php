<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Factory
 * @author Gaurav Jain
 */
class PayInvoiceFactory extends Rb_Factory
{
	static $records; 
	
	static function getInstance($name, $type='', $prefix='PayInvoice', $refresh=false)
	{
		return parent::getInstance($name, $type, $prefix, $refresh);
	}
	
	static function getHelper($name = null, $type = 'Helper', $prefix = 'PayInvoice')
	{
		static $helper = null;
		
		if($helper === null){						
			$path 	= PAYINVOICE_PATH_CORE.'/helpers';
			$files 	= JFolder::files($path, '.php');
			$helper = new stdClass();
			
			foreach($files as $file){
				$file = preg_replace('#.php#', '', $file);
				$class_name 	= $prefix.$type.$file;
				$helper->$file 	= new $class_name();
			}
		}
		
		if($name != null){
			if(isset($helper->$name)){
				return $helper->$name;
			}
			
			//XITODO : raise error
		}
		
		return $helper;	
	}
	
	public static function getConfig($file = null, $type = 'PHP', $namespace = '')
	{
		if(self::$records) {
			return self::$records;
		}

		$payinvoiceModelConfig = self::getInstance('config', 'model');
		
		$payinvoiceConfig = $payinvoiceModelConfig->loadRecords();

		$records	=	Array();
		foreach ($payinvoiceConfig as $record) {
			$value = $record->value;
			
			// if $value is a json string then convert decode it and use
			json_decode($value);
 			if(json_last_error() == JSON_ERROR_NONE){
 				$value = json_decode($value);
 			}
			
			$records[$record->key] = $value;
		}
		
		return $records;
	}
	
	public static function saveConfig($data, $file = null, $type = 'PHP', $namespace = '')
	{	
		$payinvoiceConfig = self::getInstance('config', 'model');
		if($payinvoiceConfig->save($data))
		{
			return true;
		}
		
		return false;			
	}
}
