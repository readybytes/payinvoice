<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayInvoice
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayinvoiceHtmlStatus
{	
	static function filter($name, $view, Array $filters = array(), $entity, $prefix='filter_payinvoice', $attr = "")
	{
		$elementName  = $prefix.'_'.$view.'_'.$name;
		$elementValue = @array_shift($filters[$name]);
		
		$attr['none']  = true;
		$attr['style'] = (isset($attr['style']) ? $attr['style'] : '').' onchange="document.adminForm.submit();"';
		return PayinvoiceHtml::_('payinvoicehtml.status.edit', $elementName.'[]', $elementValue, $attr, $entity,'');
	}
	
	/**
	 * @return select box html of all available status
	 * @param $name - name for the html element
	 * @param $value- selected value of status
	 * @param $entity : for which entity id, status are asked
	 * @param $attr - other attributes of select box html
	 */
	static function edit($name, $elementValue, $attr=null, $ignore=array())
	{
		$options    = array();
		$options[0] = array('text'=>JText::_('COM_PAYINVOICE_SELECT_STATUS'), 'value'=>'');
		$status 	= PayInvoiceInvoice::getStatusList();
		
		foreach ($status as $key => $value){			
			$options[] = array('text' => JText::_($value), 'value' => $key);
		}
   		
		$style = (isset($attr['style'])) ? $attr['style'] : "class=$class";
    	return JHTML::_('select.genericlist', $options, $name, $style, 'value', 'text', array($elementValue));
	}
}