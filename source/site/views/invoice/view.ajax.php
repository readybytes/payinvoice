<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

/** 
 * Invoice Html View
 * @author Gaurav Jain
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceSiteViewInvoice extends PayInvoiceSiteBaseViewInvoice
{
	public function ajaxRequestBuildForm()
	{
		$invoice_id = $this->getModel()->getId();
		$post_url 	= !empty($this->get('response')->data->post_url) ? $this->get('response')->data->post_url : JUri::root().'index.php?option=com_payinvoice&view=invoice&task=paynow&invoice_id='.$invoice_id;
		
		$ajax 		= Rb_Factory::getAjaxResponse();		
		$ajax->addScriptCall('payinvoice.jQuery("form#paynowForm").attr', 'action', $post_url); 
		$ajax->addScriptCall('payinvoice.jQuery(\'#payinvoice-paynow-html\').html', $this->loadTemplate('paynow'));
		$ajax->sendResponse();
	}
}