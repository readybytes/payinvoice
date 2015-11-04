<?php

/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Invoice Lib
 * @author Gaurav Jain
 */
class PayInvoiceInvoice extends PayInvoiceLib
{
	protected $invoice_id 	  = 0;
	protected $type			  = '';
	protected $template		  = '';
	protected $invoice_serial = '';
	
	protected $_items		 = array();
	protected $_tasks		 = array();
	
	const STATUS_NONE		  = 0;	
	const STATUS_DUE		  = 401;
	const STATUS_PAID 		  = 402;
	const STATUS_REFUNDED	  = 403;
	const STATUS_INPROCESS	  = 404;
	const STATUS_EXPIRED	  = 405;
	
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
		$this->invoice_id 	  = 0;
		$this->type			  = 'invoice';
		$this->template		  = '';
		$this->invoice_serial = '';
		$this->params		  = new Rb_Registry();
	
		$this->items		 = array();
		$this->tasks		 = array();
		return $this;
	}
	
	public function bind($data, $ignore = Array())
	{
		if(is_object($data)){
			$data = (array) ($data);
		}

		parent::bind($data, $ignore);
		
		if(! (isset($data['items']) || isset($data['tasks']) ) ) {
			 $this->items = $this->getModel()->getItemMapping($this->getId(), 'item');
			 $this->tasks = $this->getModel()->getItemMapping($this->getId(), 'task');
		}
		//else{
		//	if (empty($data['items']))
		//	{
		//		$this->items = array();
		//		$this->tasks = $data['tasks'];
		//		return $this;
		//	}
		//	if (empty($data['tasks']))
		//	{
		//		$this->tasks = array();
		//		$this->items = $data['items'];
		//		return $this;
		//	}
		else {
			$this->items = $data['items'];
			$this->tasks = $data['tasks'];
		}
		//}
	
		return $this;
	}

	//save items and tasks data in mapping table payinvoice_invoice_x_item
	public function _save($previousObject)
	{
		$id = parent::_save($previousObject);

		if (empty($this->tasks))
		{
			$items = array_merge($this->items, (array)$this->tasks);
		}
		else if (empty($this->items))
		{
			$items = array_merge($this->tasks, (array)$this->items);
		}
		else {
			$items = array_merge($this->items, $this->tasks);
		}
		// if save fail
		if (!$id) { 
			return false;
		}
		
		$model = $this->getModel();
		$model->saveItemMapping($id, $items);
		return $id;
	}
	
	public function getParams($object = true, $default = null, $property='params')
	{
		if($object){
			return $this->params->toObject();
		}
		
		return $this->params->toArray();
	} 
	
	public function getPayUrl($site = false)
	{
		$invoice_id		= $this->invoice_id;
		$rb_invoice 	= $this->getHelper('invoice')->get_rb_invoice($invoice_id);
		$key			= md5($rb_invoice['created_date']);
		if($site){
			return PayInvoiceRoute::_('index.php?option=com_payinvoice&view=invoice&task=display&invoice_id='.$invoice_id.'&key='.$key);
		}else{
			return JUri::root().'index.php?option=com_payinvoice&view=invoice&task=display&invoice_id='.$invoice_id.'&key='.$key;
		}		
	}
	
	public static function getStatusList()
	{
		return array(
            self::STATUS_NONE		=> JText::_('COM_PAYINVOICE_INVOICE_STATUS_NONE'),
			self::STATUS_DUE 		=> JText::_('COM_PAYINVOICE_INVOICE_STATUS_DUE'),
			self::STATUS_PAID		=> JText::_('COM_PAYINVOICE_INVOICE_STATUS_PAID'),
			self::STATUS_REFUNDED	=> JText::_('COM_PAYINVOICE_INVOICE_STATUS_REFUNDED'),
			self::STATUS_INPROCESS	=> JText::_('COM_PAYINVOICE_INVOICE_STATUS_INPROCESS'),
			self::STATUS_EXPIRED	=> JText::_('COM_PAYINVOICE_INVOICE_STATUS_EXPIRED'),		
		);
	}
	
	public function delete()
	{
		// XITODO : error handling		
		$this->getHelper()->delete_rb_invoice($this->getId());
		
		return parent::delete();
	} 

	public static function refund($invoice_id)
	{
		$req_response 	= Rb_EcommerceAPI::invoice_request('refund', $invoice_id);
		$response 		= Rb_EcommerceAPI::invoice_process($invoice_id, $req_response);	
		
		return $response;
	}

	// Check that Invoice is editable or not	
	public function isEditable($invoice_id)
	{
		$rb_invoice = $this->getHelper('invoice')->get_rb_invoice($invoice_id, true);
		if($rb_invoice['status'] == PayInvoiceInvoice::STATUS_DUE || $rb_invoice['status'] == PayInvoiceInvoice::STATUS_NONE){
			return true;
		}	
		return false;
	}
	
	public function getInvoiceId()
	{
		return $this->invoice_id;
	}
	
	public function getInvoiceSerial()
	{
		return $this->invoice_serial;
	}

	//PI::TODO - remove if not required 
        //get title of the items and tasks from item table
	function getItems($invoiceArray){
		if (!empty($invoiceArray['items']))
			{	
				$item = $invoiceArray['items'];
				foreach ($item as $key => $value)
				{
					$data = PayInvoiceItem::getInstance($value['item_id']);
					$data1 = $data->toArray();
					$invoiceArray['items'][$key]['title']=$data1['title'];
				}
			}
		if (!empty($invoiceArray['tasks']))
			{	
				$item = $invoiceArray['tasks'];
				foreach ($item as $key => $value)
				{
					$data = PayInvoiceItem::getInstance($value['item_id']);
					$data1 = $data->toArray();
					$invoiceArray['tasks'][$key]['title']=$data1['title'];
				}
			}
		return $invoiceArray;
	} 
}