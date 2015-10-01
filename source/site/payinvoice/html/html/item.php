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
 * Processor Type Html Element
 * @author Dinesh
 */

class PayInvoiceHtmlItem
{
	static function edit($name, $type, $attr=null, $ignore=array())
	{
		$filters        = array('type' => $type);
        	$items		= PayInvoiceFactory::getInstance('item', 'model')->loadRecords($filters);		
		$options 	= array();
		if(isset($attr['none'])){
			$options[] = PayInvoiceHtml::_('select.option', '', JText::_(''));
			$options[] = PayInvoiceHtml::_('select.option', '#addnew', JText::_('Add New Item'));
		}

		foreach($items  as $item){
			$options[] = PayInvoiceHtml::_('select.option', $item->item_id, JString::ucfirst($item->title));	
		}
		
		$attr['class'] = isset($attr['class']) ? $attr['class'] : '';
		$attr['data-counter'] 	= '##counter##' ;
		$attr['data-type'] 	= $type;
		$html= PayInvoiceHtml::_('select.genericlist', $options, $name, $attr, 'value', 'text');
		return $html;
	}
}
