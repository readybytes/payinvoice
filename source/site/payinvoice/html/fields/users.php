<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JFormHelper::loadFieldClass('list');

/** 
 * Users Field
 * @author Gaurav Jain
 */
class PayInvoiceFormFieldUsers extends JFormFieldList
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

		$users = Rb_HelperJoomla::getJoomlaUsers();
		
		foreach ($users as $user){
			$options[] = JHtml::_('select.option', $user->id, $user->name.' ('.$user->username.')');
		}
		
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
