<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
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
class OSInvoiceSiteControllerInvoice extends OSInvoiceController
{
	/**
	 * @var OSInvoiceHelperInvoice
	 */
	public $helper = null;
	
	public function ajaxRequestBuildForm()
	{
		$itemid 		= $this->_getId(); 
		$args 			= $this->_getArgs();
		$processor_id 	= $args['processor_id'];		
		$processor 		= OSInvoiceProcessor::getInstance($processor_id);
		$xiee_invoice 	= $this->helper->get_xiee_invoice($itemid);
		
		// save the processor configuration
		$xiee_invoice['processor_type'] 	= $processor->getType();
		$xiee_invoice['processor_config'] 	= $processor->getParams();
		XiEEApi::invoice_update($xiee_invoice['invoice_id'], $xiee_invoice);
		
		$this->getView()->assign('response', XiEEApi::invoice_request('build', $xiee_invoice['invoice_id'], array()));
		return true;		
	}
	
	public function paynow()
	{
		$data 			= Rb_Factory::getApplication()->input->post->get('payment_data', array(), 'array');		
		$itemid 		= $this->_getId();
		$xiee_invoice 	= $this->helper->get_xiee_invoice($itemid);		
		
		$request_name = 'payment';
		
		while(true){
			$req_response 	= XiEEApi::invoice_request($request_name, $xiee_invoice['invoice_id'], $data);
			$response 		= XiEEApi::invoice_process($xiee_invoice['invoice_id'], $req_response);
						
			if($response->get('next_request', false) == false){
				break;
			}
			$data = array();
			$request_name = $response->get('next_request_name', 'payment');
		}

		// XITODO : redirect url
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
		$invoice_id 	  = XiEEAPI::invoice_get_from_response($processor_type, $response);		
		$response = XiEEApi::invoice_process($invoice_id, $response);			
	}
}