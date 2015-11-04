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
		$options = array();
		if(isset($attr['none']))
			$options[] = PayInvoiceHtml::_('select.option', '0', JText::_('COM_PAYINVOICE_SELECT_ITEM'));
			$options[] = PayInvoiceHtml::_('select.option', '#addnew', JText::_('COM_PAYINVOICE_ADD_NEW_ITEM'));
		foreach($items  as $item){
			$options[] = PayInvoiceHtml::_('select.option', $item->item_id, JString::ucfirst($item->title));			
		}
		
		$attr['class'] = isset($attr['class']) ? $attr['class'] : '';
		$attr['data-counter'] = '##counter##' ;
		$attr['data-type'] = $type;
		$html= PayInvoiceHtml::_('select.genericlist', $options, $name, $attr, 'value', 'text');
		return $html;
	}
    static function filter($name, $view, Array $filters = array(), $entity, $prefix='filter_payinvoice', $attr = "")
	{
		$elementName  = $prefix.'_'.$view.'_'.$name;
		$elementValue = @array_shift($filters[$name]);
		
		$attr['none']  = true;
		$attr['style'] = (isset($attr['style']) ? $attr['style'] : '').' onchange="document.adminForm.submit();"';
		return PayinvoiceHtml::_('payinvoicehtml.item.getItemList', $elementName.'[]', $elementValue, $attr, $entity,'');
	}
   static function getItemList($name, $elementValue, $attr=null, $ignore=array())
	{
		$options    = array();
		$options[0] = array('text'=>JText::_('COM_PAYINVOICE_SELECT_ITEM'), 'value'=>'');
		$status 	= PayInvoiceItem::getItemType();
		
		foreach ($status as $key => $value){			
			$options[] = array('text' => JText::_($value), 'value' => $key);
		}
   		
		$style = (isset($attr['style'])) ? $attr['style'] : "class=$class";
    	return JHTML::_('select.genericlist', $options, $name, $style, 'value', 'text', array($elementValue));
	}
	
}
