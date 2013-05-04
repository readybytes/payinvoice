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
 * Transaction Model
 * @author Manisha Ranawat
 */
class PayInvoiceModelProcessor extends PayInvoiceModel
{
}

class PayInvoiceModelformProcessor extends PayInvoiceModelform
{
	 /**
	 * Processor type parameters will be set in config_params here.
	 * (non-PHPdoc)
	 * @see libraries/joomla/application/component/JModelForm::preprocessForm()
	 */
	function preprocessForm($form, $data)
	{		
		if(isset($data['type'])){	
			$processor = Rb_EcommerceAPI::get_processor_instance($data['type']);
			$file = $processor->getLocation().'/'.$processor->getName().'.xml';
			$form->loadFile($file, false, '//config');
		}
		
		return parent::preprocessForm($form, $data);
	}
	
	protected function loadFormData()
	{
        // when form load then we get processor's data into params, to bind this data into processor_config we assing params into this
		if(isset($this->_lib_data)){
			$data = $this->_lib_data->toArray();
			$data['processor_config'] = $data['params'];
			return $data;
		}
		
		return array();
	}
}
