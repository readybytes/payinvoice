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

/** 
 * Invoice Helper
 * @author Manisha Ranawat
 */
class PayInvoiceHelperProcessor extends JObject
{
	static $xmlData = null;
	static public function getXml($processor_type = null)
	{	
		if(self::$xmlData === null)
		{
			$processors = Rb_EcommerceAPI::get_processors_list();
				
			foreach($processors as $key => $value){	
				$xml = dirname($value['location']).'/'.$key. '.xml'; ;
				if (file_exists($xml)) {
					$xmlContent = simplexml_load_file($xml);
				}
				else {
					$xmlContent = null;
				}

				foreach ($xmlContent as $element=> $value){
					self::$xmlData[$key][$element] = (string) $value;
				}
			}
		}
		
		if($processor_type !== null){
			return self::$xmlData[$processor_type];
		}
		
		return self::$xmlData;
		
	}
	
}
