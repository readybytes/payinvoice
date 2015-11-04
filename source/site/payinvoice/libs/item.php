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
 * @author dinesh sharma
 */
class PayInvoiceItem extends PayInvoiceLib
{
	protected $item_id 	  	  = 0;
	protected $type			  = '';
	protected $title		  = '';
	protected $unit_cost	  	  = 0.00;
	protected $tax	 	  	  = 0.00;
	
	//TODO: Remove and move to defines.php, add prefix payinvoice
	const TYPE_TASK		  = 'task';	
	const TYPE_ITEM		  = 'item';

	function reset()
	{
		$this->item_id 	  	  = 0;
		$this->type		  = '';
		$this->title		  = '';
		$this->unit_cost	  = 0.00;
		$this->tax	 	  = 0.00;
		return $this;
	}

	public static function getInstance($id = 0, $bindData = null, $dummy1 = null, $dummy2 = null)
	{
		return parent::getInstance('item', $id, $bindData);
	}
    	
	public static function getItemType()
	{
		return array(
		    	self::TYPE_TASK => JText::_('COM_PAYINVOICE_ITEM_TYPE_TASK'),
			self::TYPE_ITEM => JText::_('COM_PAYINVOICE_ITEM_TYPE_ITEM'),
		);
	}
}