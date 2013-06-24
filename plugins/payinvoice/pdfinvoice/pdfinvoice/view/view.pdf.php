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

/** 
 *Pdf Invoice Html View
 * @author Manisha Ranawat
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewPdfInvoice extends PayInvoiceAdminBaseViewPdfInvoice
{
	public function download()
	{
		$i_helper = $this->getHelper('invoice');
		$f_helper = $this->getHelper('format');	
		
		// set by controller
		$invoice_id = $this->input->get('invoice_id');	
		$rb_invoice	= $i_helper->get_rb_invoice($invoice_id);
		$rb_invoice= (object) $rb_invoice;
			
		//get instances
		$invoice	= PayInvoiceInvoice::getInstance($invoice_id);
		$buyer		= PayInvoiceBuyer::getInstance($rb_invoice->buyer_id);
	
		$this->assign('invoice',	 		$invoice);
		$this->assign('rb_invoice', 		$rb_invoice);	
		$this->assign('buyer', 				$buyer);
		$this->assign('currency_symbol',	$f_helper->getCurrency($rb_invoice->currency, 'symbol'));
		$this->assign('tax', 				$i_helper->get_tax($rb_invoice->invoice_id));
		$this->assign('discount', 			$i_helper->get_discount($rb_invoice->invoice_id));
		$this->assign('subtotal', 			$i_helper->get_subtotal($rb_invoice->invoice_id));
		$this->assign('config_data',		$this->getHelper('config')->get());
		$this->assign('status_list', 		PayInvoiceInvoice::getStatusList());
		
		$contents = $this->loadTemplate('pdfheader');		
		$contents .= $this->getPdf($rb_invoice);
		$contents.= "</body></html>";
		$pdf      = new DOMPDF();
		$pdf->set_paper("a4", "portrait");
		$pdf->load_html($contents);
		$pdf->render();
		$pdf->stream('invoice.pdf');
	}
	
	public function getPdf($rb_invoice)
	{
		$i_helper = $this->getHelper('invoice');
		$f_helper = $this->getHelper('format');	
		
		// generate invoice for non paid and non-refunded paid 
		if(!in_array($rb_invoice->status, array(PayInvoiceInvoice::STATUS_PAID, PayInvoiceInvoice::STATUS_REFUNDED))){			
			$extra_data = array();
			$extra_data['txn_key']  = '';
			$extra_data['title']	= Rb_Text::_('PLG_PAYINVOICE_PGFINVOICE_DUE_ON');
			$extra_data['date']	 	= $rb_invoice->due_date;
			$extra_data['status']   = PayInvoiceInvoice::STATUS_DUE;
						
			$this->assign('data', $extra_data);
			return $this->loadTemplate('pdfcontent');
		}
		
				
		$transaction   	    = Rb_EcommerceAPI::transaction_get_records(array('invoice_id' => $rb_invoice->invoice_id, 'payment_status' => 'payment_complete'), array(), '',$orderby='invoice_id');
		
		$extra_data = array();
		$extra_data['title']	= Rb_Text::_('PLG_PAYINVOICE_PGFINVOICE_PAID_ON');
		$extra_data['date']		= $rb_invoice->paid_date;
		$extra_data['txn_key'] 	= '';
		$extra_data['status']  	= PayInvoiceInvoice::STATUS_PAID;
			
		if(isset($transaction[$rb_invoice->invoice_id])){			
			$extra_data['txn_key'] = $transaction[$rb_invoice->invoice_id]->gateway_txn_id;							
		}
		
		$this->assign('data', $extra_data);
		$contents = $this->loadTemplate('pdfcontent');
		
		if($rb_invoice->status == PayInvoiceInvoice::STATUS_REFUNDED){
			$transaction		 	= Rb_EcommerceAPI::transaction_get_records(array('invoice_id' => $rb_invoice->invoice_id, 'payment_status' => 'payment_refund'), array(), '',$orderby='invoice_id');
			$extra_data['title']	= Rb_Text::_('PLG_PAYINVOICE_PGFINVOICE_REFUND_ON');
			$extra_data['date']	 	= $rb_invoice->refund_date;
			$extra_data['txn_key']  = '';
			$extra_data['status']   = PayInvoiceInvoice::STATUS_REFUNDED;
			
			if(isset($transaction[$rb_invoice->invoice_id])){			
				$extra_data['txn_key'] = $transaction[$rb_invoice->invoice_id]->gateway_txn_id;							
			}
			
			$this->assign('data', $extra_data);
			$contents .= $this->loadTemplate('pdfcontent');			
		}
		
		return $contents;	
	}
}