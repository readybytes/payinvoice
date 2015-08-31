<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayInvoice
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayinvoiceHtmlPaymentStatus
{	
	static function filter($name, $view, Array $filters = array(), $entity, $prefix='filter_payinvoice', $attr = "")
	{
		$elementName  = $prefix.'_'.$view.'_'.$name;
		$elementValue = @array_shift($filters[$name]);
		
		$attr['none']  = true;
		$attr['style'] = (isset($attr['style']) ? $attr['style'] : '').' onchange="document.adminForm.submit();"';
				
		$options    = array();
		$options[0] = array('title'=>JText::_('COM_PAYINVOICE_SELECT_STATUS'), 'value'=>'');
		$status 	= Rb_EcommerceResponse::getStatusList();
		
		foreach ($status as $key => $value){			
			$options[$key] = array('title' => JText::_($value), 'value' => $key);
		}
		echo JHtml::_('select.genericlist', $options, $elementName.'[]', $attr['style'], 'value', 'title', $elementValue);
	}
}