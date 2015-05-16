<?php 
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license	    GNU/GPL, see LICENSE.php
* @package	    PAYINVOICE
* @subpackage	PDFEXPORT
* @contact 	    support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.filesystem.archive' );
jimport( 'joomla.document.document' );

class plgPayinvoicePdfExport extends Rb_Plugin
{
	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);
		
		// set some required variables in instance of plugin ($this)
		$this->app 		= JFactory::getApplication();
		$this->input 	= $this->app->input;
		
		// load language file also
		$this->loadLanguage();	
	}	

	public function onRbControllerCreation(&$option, &$view, &$controller, &$task, &$format)
	{
		if($controller === 'pdfexport'){			
			$this->__loadFiles($format);
			// load class of dompdf
			$this->__loadDomPdfClass();
		}
		
		if($controller === 'invoice' && $task === 'download'){	
			$controller	= 'PdfExport';
			$this->__loadFiles();

			// load class of dompdf
			$this->__loadDomPdfClass();
		}
	}

	public function onPayinvoiceLoadPosition($position, $view, $data)
	{
		// XITODO : load html from tmpl
			if($position == 'admin-invoice-edit-footer'){
				$invoiceId = $data['invoice']->getId();
				if(!empty($invoiceId)){
					ob_start();
					?>

					<a href="index.php?option=com_payinvoice&view=pdfexport&task=download&format=pdf&invoice_id=<?php echo $data['invoice']->getId();?>" class="btn btn-success"><i class="icon-download-alt icon-white"></i> <?php echo JText::_('PLG_PAYINVOICE_PDFEXPORT_DOWNLOAD_PDF');?></a>
					<?php
	
					$content = ob_get_contents();
					ob_end_clean();
					return $content;
				}
			}
		
		return false;
	}
	
	protected function __loadFiles($format = 'pdf')
	{
		Rb_HelperLoader::addAutoLoadFile(dirname(__FILE__).'/'.$this->_name.'/view/view.'.$format.'.php', 'PayInvoiceAdminViewPdfExport');
		Rb_HelperLoader::addAutoLoadFile(dirname(__FILE__).'/'.$this->_name.'/controller.php', 'PayInvoiceAdminControllerPdfExport');			
		Rb_HelperLoader::addAutoLoadFile(dirname(__FILE__).'/'.$this->_name.'/helper.php', 'PayInvoiceHelperPdfExport');			
		Rb_HelperLoader::addAutoLoadFolder(__DIR__.'/pdfexport/dompdf0.6', '');
	}
	
	/* load class of dompdf */
	protected function __loadDomPdfClass()
	{
		require_once dirname(__FILE__).'/pdfexport/dompdf0.6/dompdf_config.inc.php';
	    $files = JFolder::files(DOMPDF_INC_DIR);
	    foreach ($files as $file){
			$class = JFile::stripExt($file);
			$class = JFile::stripExt($class);
			$frags = explode('_',$class);
		
			for($i=0; $i < count($frags); $i++)
				$frags[$i] = JString::ucfirst($frags[$i]);
				
			$class = implode ('_',$frags);
			Rb_HelperLoader::addAutoLoadFile(DOMPDF_INC_DIR.'/'."$file",$class);
		}
	}

	public function onPayInvoiceEmailBeforSend($invoice_id, $email, $subject, $body, $attachment)
	{
		$this->__loadFiles();
		$this->__loadDomPdfClass();	// Load class of DomPdf
		
		$rb_invoice		= PayInvoiceFactory::getHelper('invoice')->get_rb_invoice($invoice_id);
		$rb_invoice		= (object)$rb_invoice;
		
		$pdf_controller	= PayInvoiceFactory::getInstance('pdfexport', 'controller', 'PayInvoiceadmin');
		$pdf_view 		= $pdf_controller->getView('pdfexport', 'pdf');
		
		$i_helper = PayInvoiceFactory::getHelper('invoice');
		$f_helper = PayInvoiceFactory::getHelper('format');	
			
		//get instances of Invoice and Buyer
		$invoice	= PayInvoiceInvoice::getInstance($rb_invoice->object_id);
		$buyer		= PayInvoiceBuyer::getInstance($rb_invoice->buyer_id);
	
		$pdf_view->assign('invoice',	 		$invoice);
		$pdf_view->assign('rb_invoice', 		$rb_invoice);	
		$pdf_view->assign('buyer', 				$buyer);
		$pdf_view->assign('currency_symbol',	$f_helper->getCurrency($rb_invoice->currency, 'symbol'));
		$pdf_view->assign('tax', 				$i_helper->get_tax($rb_invoice->invoice_id));
		$pdf_view->assign('discount', 			$i_helper->get_discount($rb_invoice->invoice_id));
		$pdf_view->assign('subtotal', 			$i_helper->get_subtotal($rb_invoice->invoice_id));
		$pdf_view->assign('config_data',		PayInvoiceFactory::getHelper('config')->get());
		$pdf_view->assign('status_list', 		PayInvoiceInvoice::getStatusList());
		
	
	 	// Delete folder and contained files before generating new folder
		$filePath = dirname(__FILE__).'/pdfexport'.$rb_invoice->buyer_id;
		$pdf_view->deleteFolder($filePath);
		
		$content	= $pdf_view->getPdfContent($rb_invoice);
		$pdf		= $pdf_view->genratePdf($content);
		$pdf_view->createFolder($pdf, $invoice_id, $rb_invoice->buyer_id);
		
		$filePath = dirname(__FILE__).'/pdfexport'.$rb_invoice->buyer_id;
		$filename = 'invoice'.$rb_invoice->invoice_id.'.pdf';
			
		//check whether file exists or not
		if(file_exists($filePath.'/'.$filename)){
			$attachment = $filePath.'/'.$filename;
			return true;
		}
		
		return false;
	}
}


