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

JFormHelper::loadFieldClass('list');

/** 
 * Users Field
 * @author Manisha Ranawat
 */
class PayInvoiceFormFieldProcessors extends JFormFieldList
{

	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  1.0
	 */
	public $type = 'Users';

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   1.0
	 */
	protected function getOptions()
	{
		// Initialize variables.
		$options = array();

		$value_field  = isset($this->element['value_field']) ? $this->element['value_field'] : 'isocode3';		
		
		$filters	 	= array('published'=>1);
        $processors 	= PayInvoiceFactory::getInstance('processor', 'model')->loadRecords($filters);
		
		foreach ($processors as $processor){
			$options[] = JHtml::_('select.option', $processor->processor_id, $processor->title);
		}
		
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
