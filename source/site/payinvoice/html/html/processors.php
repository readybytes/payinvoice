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
 * Processor Type Html Element
 * @author Gaurav Jain
 */

class PayInvoiceHtmlProcessors
{
	function edit($name, $value, $attr=null, $ignore=array())
	{
	    $filters	 		= array('published'=>1);
        $processors 	= PayInvoiceFactory::getInstance('processor', 'model')->loadRecords($filters);		
		
		$options = array();
		if(isset($attr['none']))
			$options[] = PayInvoiceHtml::_('select.option', '', Rb_Text::_('Select Processor'));
			
		foreach($processors  as $processor){
			$options[] = PayInvoiceHtml::_('select.option', $processor->processor_id, JString::ucfirst($processor->title));	
		}

		$style = isset($attr['style']) ? $attr['style'] : '';
		return PayInvoiceHtml::_('select.genericlist', $options, $name, $style, 'value', 'text', $value);
	}
}
