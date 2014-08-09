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
 *Pdf Export Html View
 * @author Manisha Ranawat
 */

// constant for limit
define('PAYINVOICE_PDF_EXPORT_LIMIT', 10);

require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewPdfExport extends PayInvoiceAdminBaseViewPdfExport
{
	public function download()
	{
		$invoice_id = $this->input->get('invoice_id');
		if($invoice_id){
			$InvoiceIds     = is_array($invoice_id)	? $invoice_id : (array)$invoice_id;

		}else {
			$InvoiceIds 	= $this->input->get('cid', array(), 'array');
			$session		= PayInvoiceFactory::getSession();
			if(!empty($InvoiceIds)){
				$this->deleteUserFiles();	
				$this->clearSessionVariables();	
				$session->set('invoice_ids',$InvoiceIds);
			}else {
				$InvoiceIds = $session->get('invoice_ids',array());
			}
		}
						
		if(count($InvoiceIds) > PAYINVOICE_PDF_EXPORT_LIMIT){
			$session		= PayInvoiceFactory::getSession();
			$count	     	= $session->get('pdfexport_count',1);
			$limitStart 	= $session->get('pdfexport_start',0);
			
			if($limitStart < count($InvoiceIds)){
		
				$invoice_ids 	= array_slice($InvoiceIds , $limitStart, PAYINVOICE_PDF_EXPORT_LIMIT);
				$contents		= $this->getContent($invoice_ids);
					
				$this->createFolder($this->genratePdf($contents), $count);
				$app 		 	= PayInvoiceFactory::getApplication();
				$session->set('invoice_ids', $InvoiceIds);
				$session->set('pdfexport_count', ++$count);
				$session->set('pdfexport_start', $limitStart + PAYINVOICE_PDF_EXPORT_LIMIT);
				$this->doRefresh();
			}	
			
			$this->clearSessionVariables();
			$this->createZipOfFiles();
			
		}else { 
			$contents	= $this->getContent($InvoiceIds);
			$pdf   		= $this->genratePdf($contents);
			$pdf->stream(invoice.pdf);
		}
			
		return true;
	}
	
	function doRefresh()
	{
		$app 		 = PayInvoiceFactory::getApplication();
		$currentUrl  = JURI::getInstance();
		// set task for generate pdf files for next slote
		$currentUrl->setVar('task', 'download');
		$redirectUrl = $currentUrl->toString();
       	$app->redirect($currentUrl);
	}
	
	public function getContent($invoice_ids)
	{
		$filter 		= array('object_id' => array(array('IN', '('.implode(",", $invoice_ids).')')));
		$invoices 		= $this->getHelper('invoice')->get_rb_invoice_records($filter);
		$contents		= '';
		foreach ($invoices as $invoice)
		{
			$this->getTemplate($invoice);
			$contents	.= $this->getPdfContent($invoice);
		}
		return $contents;
	}
	
	
	public function getTemplate($rb_invoice)
	{
		$i_helper = $this->getHelper('invoice');
		$f_helper = $this->getHelper('format');	

		//get instances
		$invoice	= PayInvoiceInvoice::getInstance($rb_invoice->object_id);
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
	}
	
	public function getPdfContent($rb_invoice)
	{
		$i_helper = $this->getHelper('invoice');
		$f_helper = $this->getHelper('format');	
		
		// generate invoice for non paid and non-refunded paid 
		if(!in_array($rb_invoice->status, array(PayInvoiceInvoice::STATUS_PAID, PayInvoiceInvoice::STATUS_REFUNDED))){			
			$extra_data = array();
			$extra_data['txn_key']  = '';
			$extra_data['title']	= Rb_Text::_('PLG_PAYINVOICE_PDFEXPORT_DUE_ON');
			$extra_data['date']	 	= $rb_invoice->due_date;
			$extra_data['status']   = PayInvoiceInvoice::STATUS_DUE;
						
			$this->assign('data', $extra_data);
			return $this->loadTemplate('pdfcontent');
		}
		
				
		$transaction   	    = Rb_EcommerceAPI::transaction_get_records(array('invoice_id' => $rb_invoice->invoice_id, 'payment_status' => 'payment_complete'), array(), '',$orderby='invoice_id');
		
		$extra_data = array();
		$extra_data['title']	= Rb_Text::_('PLG_PAYINVOICE_PDFEXPORT_PAID_ON');
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
			$extra_data['title']	= Rb_Text::_('PLG_PAYINVOICE_PDFEXPORT_REFUND_ON');
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
	
	/**
	 *  Generate pdf file
	 */
	public function genratePdf($contents)
	{
		$pdfContent	  = $this->loadTemplate('pdfheader');		
		$pdfContent  .= $contents;
		$pdfContent  .= "</body></html>";
		$pdf          = new DOMPDF();
		$pdf->set_paper("a4", "portrait");
		$pdf->load_html($pdfContent);
		$pdf->render();
		
		return $pdf;	
	}
	
	
	/**
	 *  Creating folder of given pdf files
	 */
	function createFolder($pdf, $count = 0 , $buyerId = null)
	{
		$buyer	  = PayInvoiceFactory::getUser($buyerId);
		$dir_path = dirname(dirname(dirname(__FILE__))).'/pdfexport'.$buyer->id;
		if(!is_dir($dir_path)){
			mkdir($dir_path);
		} 	
		file_put_contents($dir_path.'/invoice'.$count.'.pdf', $pdf->output());
		return ;
	}	
	

	/**
	 * delete folder and contained files
	 */
	function deleteFolder($dirPath)
	{
		if(is_dir($dirPath)){	
			$files = JFolder::files($dirPath);
			foreach ($files as $file){
				unlink($dirPath.'/'.$file);
			}
			JFolder::delete($dirPath);
		}
		return true;	
	}
	
	function deleteUserFiles($buyerId = null)
	{   
		$buyer 	= PayInvoiceFactory::getUser($buyerId);
		//delete files and folder before and after processing
		$this->deleteFolder(dirname(dirname(dirname(__FILE__))).'/pdfexport'.$buyer->id);
		return true;
	}
	
	/**
	 * Create zip of pdf files 
	 */
	function createZipOfFiles()
	{
		$buyer 			   = PayInvoiceFactory ::getUser();
		$dir_path 		   = dirname(dirname(dirname(__FILE__))).'/pdfexport'.$buyer->id.'/';
		$archive_file_name = $dir_path."pdfinvoices".$buyer->id.".zip";
		$files             = JFolder::files($dir_path);
		$zip 			   = new JArchive();
		$zip_adapter       = JArchive::getAdapter('zip'); // compression type
		
		$filesToZip 	   = array();
		//create file data required for zip_adapter
		foreach ($files as $file){
			$data 		   = JFile::read($dir_path.DS.$file);
			$filesToZip[]  = array('name'=> $file, 'data'=>$data);
		}
		
		//create the file and throw the error if unsuccessful
		if (!$zip_adapter->create($archive_file_name,$filesToZip)) {
          exit('Error creating zip file');
        }
		
	    //then send the headers to force download the zip file
	    if(file_exists($archive_file_name)){
		    header("Content-type: application/zip");
		    header("Content-Disposition: attachment; filename=pdfInvoices.zip");
		    header("Pragma: no-cache");
		    header("Expires: 0");
		    readfile("$archive_file_name");
		    exit;
	    }
	    return true;
	}

	/**
	 * clear all session variables
	 */
	function clearSessionVariables()
	{
		$mysess   = PayInvoiceFactory::getSession();
		$sessVars = array('pdfexport_start','pdfexport_count','invoice_ids');
		foreach ($sessVars as $var){
			$mysess->clear($var);
		}
		return true;	
	}
	
}
