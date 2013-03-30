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
 * Invoice Lib
 * @author Gaurav Jain
 */
class OSInvoiceInvoice extends OSInvoiceLib
{
	protected $invoice_id 	= 0;
	protected $type			= '';
	protected $template		= '';
	
	/**
	 * @var Rb_Registry
	 */
	protected $params		= null;
	
	/**
	 * Gets the instance of OsiInvoice with provide form identifier
	 * 
	 * @param  integer  $id    Unique identifier of input entity
	 * @param  string   $type  
	 * @param  mixed    $bindData  Data to be binded with the object
	 * 
	 * @return Object OSInvoice  Instance of OSInvoice
	 */
	public static function getInstance($id = 0, $bindData = null, $dummy1 = null, $dummy2 = null)
	{
		return parent::getInstance('invoice', $id, $bindData);
	}
	
	/**
	 * Reset all the object properties to their default values
	 * 
	 * @return  Object OSInvoice Instance of OSInvoice
	 */
	function reset()
	{
		$this->invoice_id 	= 0;
		$this->type			= 'invoice';
		$this->template		= '';
		$this->params		= new Rb_Registry();
	
		return $this;
	}
	
	public function getParams($object = true)
	{
		if($object){
			return $this->params->toObject();
		}
		
		return $this->params->toArray();
	} 
}