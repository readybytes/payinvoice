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
 * Transaction Html View
 * @author Manisha Ranawat
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewTransaction extends PayInvoiceAdminBaseViewTransaction
{	
	public function refund()
	{
		// set by controller
		$invoice_id = $this->get('invoice_id');	
		
		if(!$this->get('confirmed')){
			$this->_confirmRefund($invoice_id);
		}
		
		$this->_refundRequest($invoice_id);	
	}
	
	// Confirm refund request
	public function _confirmRefund($invoice_id)
	{
		$this->_setAjaxWinTitle(Rb_Text::_('COM_PAYINVOICE_INVOICE_REFUND_WINDOW_TITLE'));
		$this->_setAjaxWinBody(Rb_Text::_('COM_PAYINVOICE_INVOICE_REFUND_CONFIRM_MESSAGE'));
	
		$this->_addAjaxWinAction(Rb_Text::_('COM_PAYINVOICE_CONFIRM'), 'payinvoice.admin.transaction.refund.request('.$invoice_id.');', 'btn btn-info', 'id="payinvoice-invoice-refund-confirm-button"');
		$this->_addAjaxWinAction(Rb_Text::_('COM_PAYINVOICE_CLOSE'), 'rb.ui.dialog.close();', 'btn');
		$this->_setAjaxWinAction();		
	
		$ajax = Rb_Factory::getAjaxResponse();
		$ajax->sendResponse();
	}

	// Send request for refund payment
	public function _refundRequest($invoice_id)
	{
		$response	= PayInvoiceInvoice::refund($invoice_id);

		$msg = Rb_Text::_('COM_PAYINVOICE_INVOICE_REFUND_COMPLETED_SUCCESSFULLY');
		if($response->get('payment_status') != 'payment_refund'){
			$msg = Rb_Text::_('COM_PAYINVOICE_INVOICE_ERROR_REFUND_ERROR');						
		}
		elseif($response instanceof Exception){
			$msg  = Rb_Text::_('COM_PAYINVOICE_INVOICE_ERROR_REFUND_ERROR');
			$msg .= "<br/><div class='alert alert-error'>".$response->get('message')."</div>";
		}
		
		$this->_setAjaxWinTitle(Rb_Text::_('COM_PAYINVOICE_INVOICE_REFUND_WINDOW_TITLE'));
		$this->_setAjaxWinBody($msg);
		
		$this->_addAjaxWinAction('close', 'rb.ui.dialog.close(); window.location.reload();', 'btn');
		$this->_setAjaxWinAction();	
		
		$ajax = Rb_Factory::getAjaxResponse();
		$ajax->sendResponse();

	}
	
}
