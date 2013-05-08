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
 * Invoice Lib
 * @author Gaurav Jain
 */
class PayInvoiceInvoice extends PayInvoiceLib
{
	protected $invoice_id 	= 0;
	protected $type			= '';
	protected $template		= '';
	
	const STATUS_NONE		= 0;	
	const STATUS_DUE		= 401;
	const STATUS_PAID 		= 402;
	const STATUS_REFUNDED	= 403;
	const STATUS_INPROCESS	= 404;
	const STATUS_EXPIRED	= 405;
	
	/**
	 * @var Rb_Registry
	 */
	protected $params		= null;
	
	/**
	 * Gets the instance of PayInvoice with provide form identifier
	 * 
	 * @param  integer  $id    Unique identifier of input entity
	 * @param  string   $type  
	 * @param  mixed    $bindData  Data to be binded with the object
	 * 
	 * @return Object PayInvoice  Instance of PayInvoice
	 */
	public static function getInstance($id = 0, $bindData = null, $dummy1 = null, $dummy2 = null)
	{
		return parent::getInstance('invoice', $id, $bindData);
	}
	
	/**
	 * Reset all the object properties to their default values
	 * 
	 * @return  Object PayInvoice Instance of PayInvoice
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
	
	public function getPayUrl()
	{
		$invoice_id		= $this->invoice_id;
		$rb_invoice 	= $this->getHelper('invoice')->get_rb_invoice($invoice_id);
		$key			= md5($rb_invoice['created_date']);
		return JUri::root().'index.php?option=com_payinvoice&view=invoice&invoice_id='.$invoice_id.'&key='.$key;
	}
	
	public static function getStatusList()
	{
		return array(
            self::STATUS_NONE		=> Rb_Text::_('COM_PAYINVOICE_INVOICE_STATUS_NONE'),
			self::STATUS_DUE 		=> Rb_Text::_('COM_PAYINVOICE_INVOICE_STATUS_DUE'),
			self::STATUS_PAID		=> Rb_Text::_('COM_PAYINVOICE_INVOICE_STATUS_PAID'),
			self::STATUS_REFUNDED	=> Rb_Text::_('COM_PAYINVOICE_INVOICE_STATUS_REFUNDED'),
			self::STATUS_INPROCESS	=> Rb_Text::_('COM_PAYINVOICE_INVOICE_STATUS_INPROCESS'),
			self::STATUS_EXPIRED	=> Rb_Text::_('COM_PAYINVOICE_INVOICE_STATUS_EXPIRED'),		
		);
	}
}