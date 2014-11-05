<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class PayInvoiceAdminControllerAppstore extends PayInvoiceController
{
	function getModel($name = '', $prefix = '', $config = array())
	{
		return null;
	}
	
	public function display()
	{
		$db		= PayInvoiceFactory::getDbo();
		$query	= 'SELECT * FROM `#__extensions`'
				 .'WHERE `type` LIKE "component"'
				 .'AND `element` LIKE "com_rbinstaller"'
				 .'AND `enabled` =1';
				
		$db->setQuery($query);
		if(!$db->loadColumn())
		{
	 		$file_url  	= 'http://pub.readybytes.net/rbinstaller/update/live.json';
     		$link     	= new JURI($file_url);  
      		$curl     	= new JHttpTransportCurl(new Rb_Registry());
     		$response   = $curl->request('GET', $link);
      
      		if($response->code != 200){
      			$msg = JText::_('COM_PAYINVOICE_UNABLE_TO_FIND_FILE');
       	 		PayInvoiceFactory::getApplication()->redirect("index.php?option=com_payinvoice", $msg, 'error');
      		}
                
     		$content   		=  json_decode($response->body, true);    
     		$file_path		=  new JUri($content['rbinstaller']['file_path']);
			
			$data			=  $curl->request('GET', $file_path);		
			$content_type 	=  $data->headers['Content-Type'];
    
   			 if ($content_type != 'application/zip'){ 
   			 	$msg = JText::_('COM_PAYINVOICE_UNABLE_TO_FIND_FILE');
      			PayInvoiceFactory::getApplication()->redirect("index.php?option=com_payinvoice", $msg, 'error');
   		 	}
    		else {
      			$file =  $data->body;
				if(!$this->getHelper('utils')->install($file)){
					$msg  = JText::_('COM_PAYINVOICE_INSTALLATIN_FAILED');
					PayInvoiceFactory::getApplication()->redirect("index.php?option=com_payinvoice", $msg, 'error');
				}
			}
		}
       	 		
		$app = PayInvoiceFactory::getApplication();
		$app->redirect("index.php?option=com_rbinstaller&view=item&product_tag=rbappspayinvoice&tmpl=component#/app");
	}
}
