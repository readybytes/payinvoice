<?php
/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayInvoice
* @subpackage	Frontend
*/
if(defined('_JEXEC')===false) die();

class PayinvoiceHtmlRange
{	
	static function filter($name, $view, Array $filters = array(), $type="date", $prefix='filter_payinvoice', $attr='')
	{
		$elementName   = $prefix.'_'.$view.'_'.$name;
		$elementValue0 = @array_shift($filters[$name]);
		$elementValue1 = @array_shift($filters[$name]);
		
		$from  = '<div class="muted pull-left" style="min-width:40px;"><label>'.JText::_('COM_PAYINVOICE_FILTERS_FROM').'</label></div>';
		$to    = '<div class="muted pull-left" style="min-width:40px;"><label>'.JText::_('COM_PAYINVOICE_FILTERS_TO').'</label></div>';
			
			
		if(JString::strtolower($type)=="date"){
			$from .= '<div>'. JHtml::_('calendar', $elementValue0, $elementName.'[0]', $elementName.'_0', '%Y-%m-%d', $attr).'</div>';
			$to   .= '<div>'.JHtml::_('calendar', $elementValue1, $elementName.'[1]', $elementName.'_1', '%Y-%m-%d',  $attr).'</div>';
		}
		elseif(JString::strtolower($type)=="text"){
			
			$from .= '<div>'
						.'<input id="'.$elementName.'_0" ' 
						.'style="margin-bottom:8px;"'
						.'name="'.$elementName.'[0]" ' 
						.'value="'.$elementValue0.'" '
						.'class="input-small" />'
						.'</div>';
			$to   .= '<div>'
						.'<input id="'.$elementName.'_1" ' 
						.'name="'.$elementName.'[1]" ' 
						.'value="'.$elementValue1.'" '
						.'class="input-small" />'
						.'</div>';
		}	  
		
		return '<div class="clearfix">'.$from.'</div><div class="clearfix">'.$to.'</div>';
	}	
}
