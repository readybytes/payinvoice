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
 * Invoice Controller
 * @author Gaurav Jain
 */
class PayInvoiceSiteControllerInvoice extends PayInvoiceController
{
	/**
	 * @var PayInvoiceHelperInvoice
	 */
	public $_helper = null;
	
	public function ajaxRequestBuildForm()
	{
		$itemid 		= $this->_getId(); 
		$args 			= $this->_getArgs();
		$processor_id 	= $args['processor_id'];		
		$processor 		= PayInvoiceProcessor::getInstance($processor_id);
		$rb_invoice 	= $this->_helper->get_rb_invoice($itemid);
		
		// save the processor configuration
		$rb_invoice['processor_type'] 	= $processor->getType();
		$rb_invoice['processor_config'] 	= $processor->getParams();
		Rb_EcommerceApi::invoice_update($rb_invoice['invoice_id'], $rb_invoice);
		
		$this->getView()->assign('response', Rb_EcommerceApi::invoice_request('build', $rb_invoice['invoice_id'], array()));
		return true;		
	}
	
	public function paynow()
	{
		$data 			= Rb_Factory::getApplication()->input->post->get('payment_data', array(), 'array');		
		$itemid 		= $this->_getId();
		$rb_invoice 	= $this->_helper->get_rb_invoice($itemid);		
		
		$request_name = 'payment';
		
		while(true){
			$req_response 	= Rb_EcommerceApi::invoice_request($request_name, $rb_invoice['invoice_id'], $data);
			$response 		= Rb_EcommerceApi::invoice_process($rb_invoice['invoice_id'], $req_response);
						
			if($response->get('next_request', false) == false){
				break;
			}
			$data = array();
			$request_name = $response->get('next_request_name', 'payment');
		}

		$this->setRedirect(Rb_Route::_('index.php?option=com_payinvoice&view=invoice&task=complete&invoice_id='.$itemid));
		return false;
	}
	
	public function notify()
	{
		$get 	= Rb_Request::get('GET'); // XITODO :
		$post 	= Rb_Request::get('POST');// XITODO :
		$data 	= array_merge($get, $post);
		
		$response = new stdClass();
		$response->data = $data;
		
//		file_put_contents(JPATH_SITE.'/tmp/'.time(), var_export($data,true), FILE_APPEND);		
		
		if(!isset($data['processor'])){
			// raise error				
		}
		
		$processor_type   = $data['processor'];
		$invoice_id 	  = Rb_EcommerceAPI::invoice_get_from_response($processor_type, $response);		
		$response 		  = Rb_EcommerceApi::invoice_process($invoice_id, $response);			
	}

	public function display()
	{
		$key		= PayInvoiceFactory::getApplication()->input->get('key');
		$itemid 	= $this->getModel()->getId();
	
		// XITODO :: pass invoice as a reference to use in invoice view
		$rb_invoice = $this->_helper->get_rb_invoice($itemid);
		
		if($key != md5($rb_invoice['created_date'])){
		   $this->setTemplate('error');
		   return true;   
		}
		
		return true;
	}
	
	public function complete()
	{
		return true;
	}
	
	public function cancel()
	{
		return true;
	}
}