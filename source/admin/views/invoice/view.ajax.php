<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
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
		
		$this->_sendMailToClient($invoice_id);
	}

    // Confirm send email
	public function _confirmSendmail($invoice_id)
	{
		$this->_setAjaxWinTitle(Rb_Text::_('COM_PAYINVOICE_INVOICE_EMAIL_WINDOW_TITLE'));
		$this->_setAjaxWinBody(Rb_Text::_('COM_PAYINVOICE_INVOICE_EMAIL_CONFIRM_MESSAGE'));
	
		$this->_addAjaxWinAction(Rb_Text::_('COM_PAYINVOICE_CONFIRM'), 'payinvoice.admin.invoice.email.send('.$invoice_id.');', 'btn btn-success', 'id="payinvoice-invoice-email-confirm-button"');
		$this->_addAjaxWinAction(Rb_Text::_('COM_PAYINVOICE_CLOSE'), 'rb.ui.dialog.close();', 'btn');
		$this->_setAjaxWinAction();		
	
		$ajax = Rb_Factory::getAjaxResponse();
		$ajax->sendResponse();
	}
	
	// Send email to client
	public function _sendMailToClient($invoice_id)
	{
		// get instance of front end email view
		$email_controller 	= PayInvoiceFactory::getInstance('email', 'controller', 'PayInvoicesite');
		$email_view 		= $email_controller->getView();
		
		$rb_invoice =  $this->_helper->get_rb_invoice($invoice_id);
		
		$email_view->assign('rb_invoice', 	$rb_invoice);
		$email_view->assign('invoice', 		PayInvoiceInvoice::getInstance($invoice_id)->toArray());
		$email_view->assign('status_list', 	PayInvoiceInvoice::getStatusList());
		$email_view->assign('config_data', 	$this->getHelper('config')->get());
		$email_view->assign('buyer', 		$this->getHelper('buyer')->get($rb_invoice['buyer_id']));
		
		//XITODO : Currency Symbol not shown in email template	
		//$currency = $this->getHelper('format')->getCurrency($rb_invoice['currency'], 'symbol');
		//$email_view->assign('currency', $currency);
		
		$email_view->assign('tax', 		$this->_helper->get_tax($rb_invoice['invoice_id']));
		$email_view->assign('discount', $this->_helper->get_discount($rb_invoice['invoice_id']));
		$email_view->assign('subtotal', $this->_helper->get_subtotal($rb_invoice['invoice_id']));
		
        // md5 key generated for authentication		
		$key	= md5($rb_invoice['created_date']);
		$url	= JUri::root().'index.php?option=com_payinvoice&view=invoice&invoice_id='.$invoice_id.'&key='.$key;
		$email_view->assign('pay_url', $url);
		
		// email content
		$body 	 = $email_view->loadTemplate('invoice');
		$subject = Rb_Text::_('COM_PAYINVOICE_INVOICE_SEND_EMAIL_SUBJECT');
		$user 	 = PayInvoiceFactory::getUser($rb_invoice['buyer_id']);		
		
		$result = $this->getHelper('utils')->sendEmail($user->email, $subject, $body);
		$msg = Rb_Text::_('COM_PAYINVOICE_INVOICE_EMAIL_SENT');
		if(!$result){
			$msg = Rb_Text::_('COM_PAYINVOICE_INVOICE_ERROR_SEND_ERROR');						
		}
		elseif($result instanceof Exception){
			$msg  = Rb_Text::_('COM_PAYINVOICE_INVOICE_ERROR_SEND_ERROR');
			$msg .= "<br/><div class='alert alert-error'>".$result->getMessage()."</div>";
		}
		
		$this->_setAjaxWinTitle(Rb_Text::_('COM_PAYINVOICE_INVOICE_EMAIL_WINDOW_TITLE'));
		$this->_setAjaxWinBody($msg);
		
		$this->_addAjaxWinAction('close', 'rb.ui.dialog.close();', 'btn');
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
		$this->_setAjaxWinTitle(Rb_Text::_('COM_PAYINVOICE_INVOICE_MARKPAID_WINDOW_TITLE'));
		$this->_setAjaxWinBody(Rb_Text::_('COM_PAYINVOICE_INVOICE_MARKPAID_CONFIRM_MESSAGE'));
	
		$this->_addAjaxWinAction(Rb_Text::_('COM_PAYINVOICE_CONFIRM'), 'payinvoice.admin.invoice.markpaid.processpayment('.$invoice_id.');', 'btn btn-success', 'id="payinvoice-invoice-payment-confirm-button"');
		$this->_addAjaxWinAction(Rb_Text::_('COM_PAYINVOICE_CLOSE'), 'rb.ui.dialog.close();', 'btn');
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
		
		$this->_helper->process_payment($request_name, $rb_invoice, $data);
		
		$this->_setAjaxWinTitle(Rb_Text::_('COM_PAYINVOICE_INVOICE_MARKPAID_WINDOW_TITLE'));
		$this->_setAjaxWinBody(Rb_Text::_('COM_PAYINVOICE_INVOICE_MARKPAID_SUCCESSFULL_MESSAGE'));		
		$this->_addAjaxWinAction('close', 'rb.ui.dialog.close(); window.location.reload();', 'btn');
		$this->_setAjaxWinAction();		
		
		$ajax = Rb_Factory::getAjaxResponse();
		$ajax->sendResponse();
		
	}
	
}