<?php

/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Invoice Html View
 * @author Gaurav Jain
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceSiteViewInvoice extends PayInvoiceSiteBaseViewInvoice
{
	public function ajaxRequestBuildForm()
	{
		$invoice_id 	= $this->getModel()->getId();
		$post_url 		= !empty($this->get('response')->data->post_url) ? $this->get('response')->data->post_url : JUri::root().'index.php?option=com_payinvoice&view=invoice&task=paynow&invoice_id='.$invoice_id;
		$response->html	=  $processResponseData->data->form;
		
		$ajax 		= Rb_Factory::getAjaxResponse();		
		$ajax->addScriptCall('payinvoice.jQuery("form#paynowForm").attr', 'action', $post_url); 
		$ajax->addScriptCall('payinvoice.jQuery(\'#payinvoice-paynow-html\').html', $this->loadTemplate('paynow'));
		$ajax->sendResponse();
	}
}