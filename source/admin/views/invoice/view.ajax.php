<?php

/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact 		support+payinvoice
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Invoice Html View
 * @author Gaurav Jain
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewInvoice extends PayInvoiceAdminBaseViewInvoice
{	
	public function email()
	{
		// set by controller
		$invoice_id = $this->getModel()->getId();	
		
		if(!$this->get('confirmed')){
			$this->_confirmSendmail($invoice_id);	
		}
		
		$mail_status = $this->_helper->sendMailToClient($invoice_id);
		$msg		 = $mail_status['msg'];
		
		$this->_setAjaxWinTitle(JText::_('COM_PAYINVOICE_INVOICE_EMAIL_WINDOW_TITLE'));
		$this->_setAjaxWinBody($msg);
		
		$this->_addAjaxWinAction('close', 'rb.ui.dialog.close();', 'btn');
		$this->_setAjaxWinAction();		
		
		$ajax = Rb_Factory::getAjaxResponse();
		$ajax->sendResponse();
		
	}

    // Confirm send email
	public function _confirmSendmail($invoice_id)
	{
		$this->_setAjaxWinTitle(JText::_('COM_PAYINVOICE_INVOICE_EMAIL_WINDOW_TITLE'));
		$this->_setAjaxWinBody(JText::_('COM_PAYINVOICE_INVOICE_EMAIL_CONFIRM_MESSAGE'));
	
		$this->_addAjaxWinAction(JText::_('COM_PAYINVOICE_CONFIRM'), 'payinvoice.admin.invoice.email.send('.$invoice_id.');', 'btn btn-success', 'id="payinvoice-invoice-email-confirm-button"');
		$this->_addAjaxWinAction(JText::_('COM_PAYINVOICE_CLOSE'), 'rb.ui.dialog.close();', 'btn');
		$this->_setAjaxWinAction();		
	
		$ajax = Rb_Factory::getAjaxResponse();
		$ajax->sendResponse();
	}
	
	public function markpaid()
	{
		// set by controller
		$invoice_id = $this->getModel()->getId();	
		
		if(!$this->get('confirmed')){
			$this->_confirmpayment($invoice_id);	
		}
		
		$this->_paymentRequest($invoice_id);
	}
	
 	// Confirm send email
	public function _confirmpayment($invoice_id)
	{
		$this->_setAjaxWinTitle(JText::_('COM_PAYINVOICE_INVOICE_MARKPAID_WINDOW_TITLE'));
		$this->_setAjaxWinBody(JText::_('COM_PAYINVOICE_INVOICE_MARKPAID_CONFIRM_MESSAGE'));

		$this->_addAjaxWinAction(JText::_('COM_PAYINVOICE_CONFIRM'), 'payinvoice.admin.invoice.markpaid.processpayment('.$invoice_id.');', 'btn btn-success', 'id="payinvoice-invoice-payment-confirm-button"');
		$this->_addAjaxWinAction(JText::_('COM_PAYINVOICE_CLOSE'), 'rb.ui.dialog.close();', 'btn');
		$this->_setAjaxWinAction();
	
		$ajax = Rb_Factory::getAjaxResponse();
		$ajax->sendResponse();
	}
	
	public function _paymentRequest($invoice_id)
	{
		$invoice_id 		= $this->input->get('invoice_id', 0);	
		$rb_invoice			= $this->_helper->get_rb_invoice($invoice_id);
		$request_name		= 'payment';
		
		$data   			= $rb_invoice['processor_type'];
		
		$this->_helper->process_payment($request_name, $rb_invoice, $data , $invoice_id);

		$this->_setAjaxWinTitle(JText::_('COM_PAYINVOICE_INVOICE_MARKPAID_WINDOW_TITLE'));
		$this->_setAjaxWinBody(JText::_('COM_PAYINVOICE_INVOICE_MARKPAID_SUCCESSFULL_MESSAGE'));
		$this->_addAjaxWinAction('close', 'rb.ui.dialog.close(); window.location.reload();', 'btn');
		$this->_setAjaxWinAction();		
		
		$ajax = Rb_Factory::getAjaxResponse();
		$ajax->sendResponse();
		
	}
	
}