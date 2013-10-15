<?php
/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
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
		if(!Rb_HelperPlugin::getStatus('rbinstaller', 'system'))
		{
	 		$file_url  = 'http://pub.readybytes.net/rbinstaller/update/live.json';
     		$link     = new JURI($file_url);  
      		$curl     = new JHttpTransportCurl(new Rb_Registry());
     		$response   = $curl->request('GET', $link);
      
      		if($response->code != 200){
      			$msg = Rb_Text::_('COM_PAYINVOICE_UNABLE_TO_FIND_FILE');
       	 		PayInvoiceFactory::getApplication()->redirect("index.php?option=com_payinvoice", $msg, 'error');
      		}
                
     		$content   	=  json_decode($response->body, true);    
     		$file_path	= new JUri($content['rbinstaller']['file_path']);
			
			$data			= $curl->request('GET', $file_path);		
			$content_type 	= $data->headers['Content-Type'];
    
   			 if ($content_type != 'application/zip'){ 
   			 	$msg = Rb_Text::_('COM_PAYINVOICE_UNABLE_TO_FIND_FILE');
      			PayInvoiceFactory::getApplication()->redirect("index.php?option=com_payinvoice", $msg, 'error');
   		 	}
    		else {
      			$file =  $data->body;
				if(!$this->getHelper('utils')->install($file)){
					$msg  = Rb_Text::_('COM_PAYINVOICE_INSTALLATIN_FAILED');
					PayInvoiceFactory::getApplication()->redirect("index.php?option=com_payinvoice", $msg, 'error');
				}
			}
		}
       	 		
		$app = PayInvoiceFactory::getApplication();
		$app->redirect("index.php?option=com_rbinstaller&view=item&product_tag=rbappspayinvoice&tmpl=component#/app");
	}
}
