<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
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
class OSInvoiceAdminViewInvoice extends OSInvoiceAdminBaseViewInvoice
{	
	public function email()
	{
		// set by controller
		$invoice_id = $this->getModel()->getId();	
		
		// get instance of front end email view
		$email_controller 	= OSInvoiceFactory::getInstance('email', 'controller', 'OSInvoicesite');
		$email_view 		= $email_controller->getView();
		
		$xiee_invoice =  $this->_helper->get_xiee_invoice($invoice_id);
		$email_view->assign('xiee_invoice', $xiee_invoice);
		$email_view->assign('invoice', OSInvoiceInvoice::getInstance($invoice_id)->toArray());
		
		// email content
		$body 	 = $email_view->loadTemplate('invoice');
		$subject = Rb_Text::_('COM_OSINVOICE_INVOICE_SEND_EMAIL_SUBJECT');
		$user 	 = OSInvoiceFactory::getUser($xiee_invoice['buyer_id']);		
		
		$result = $this->getHelper('utils')->sendEmail($user->email, $subject, $body);
		$msg = Rb_Text::_('COM_OSINVOICE_INVOICE_EMAIL_SENT');
		if(!$result){
			$msg = Rb_Text::_('COM_OSINVOICE_INVOICE_ERROR_SEND_ERROR');						
		}
		elseif($result instanceof Exception){
			$msg  = Rb_Text::_('COM_OSINVOICE_INVOICE_ERROR_SEND_ERROR');
			$msg .= "<br/><div class='alert alert-error'>".$result->getMessage()."</div>";
		}
		
		$this->_setAjaxWinTitle(Rb_Text::_('COM_OSINVOICE_INVOICE_EMAIL_WINDOW_TITLE'));
		$this->_setAjaxWinBody($msg);
		
		$this->_addAjaxWinAction('close', 'rb.ui.dialog.close();', 'btn');
		$this->_setAjaxWinAction();		
		
		$ajax = Rb_Factory::getAjaxResponse();
		$ajax->sendResponse();
	}
}