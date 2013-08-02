<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PAYINVOICE
* @subpackage	Frontend
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Config Helper
 * @author Manisha Ranawat
 */
class PayInvoiceHelperConfig extends JObject
{
	static $configuration = null;
	
	public function get($key = null, PayInvoiceModelConfig $cModel = null, PayInvoiceModelformConfig $cModelform = null)
	{
		if(self::$configuration === null || ($key !== null && !isset(self::$configuration[$key])))
		{
			if($cModel === null){
				$cModel = PayInvoiceFactory::getInstance('config', 'model');
			}			
			$config = $cModel->loadRecords();
			
			foreach ($config as $record){
				self::$configuration[$record->key] = $record->value;
			}

			if($cModelform == null){
				$cModelform = PayInvoiceFactory::getInstance('config', 'Modelform' , 'PayInvoice');
			}
			
			$form		= $cModelform->getForm();
			$fieldset   = $form->getFieldset('config_params');
			
			foreach ($fieldset as $index => $field){
				$value  = $field->value;
				if(isset(self::$configuration[$field->fieldname])){										
					$value = self::$configuration[$field->fieldname];
				}
			
				//json decode if multiple is set to true since array value is saved as json encoded
				if($field->multiple == true){
					$value = json_decode($value);
				}

				self::$configuration[$field->fieldname] = $value;
			}
		}
		
		if($key !== null){
			if(isset(self::$configuration[$key])){
				return self::$configuration[$key];
			}
			
			// else return blank
			return '';
		}
		
		return self::$configuration;
	}
}
