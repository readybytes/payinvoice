<?php 
/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license	    GNU/GPL, see LICENSE.php
* @package	    PAYINVOICE
* @subpackage	PDFINVOICE
* @contact 	    team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.filesystem.archive' );
jimport( 'joomla.document.document' );

class plgPayinvoicePdfinvoice extends Rb_Plugin
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

	public function onRbControllerCreation($option, $view, $controller, $task, $format)
	{
		if($controller === 'pdfinvoice'){			
			Rb_HelperLoader::addAutoLoadFile(dirname(__FILE__).'/'.$this->_name.'/view/view.'.$format.'.php', 'PayInvoiceAdminViewPdfInvoice');
			Rb_HelperLoader::addAutoLoadFile(dirname(__FILE__).'/'.$this->_name.'/controller.php', 'PayInvoiceAdminControllerPdfInvoice');			
			Rb_HelperLoader::addAutoLoadFile(dirname(__FILE__).'/'.$this->_name.'/helper.php', 'PayInvoiceHelperPdfInvoice');			
			Rb_HelperLoader::addAutoLoadFolder(__DIR__.'/pdfinvoice/dompdf0.6', '');
		}
		
		// load class of dompdf
		require_once dirname(__FILE__).'/pdfinvoice/dompdf0.6/dompdf_config.inc.php';
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

	public function onPayinvoiceLoadPosition($position, $view, $data)
	{
		// XITODO : load html from tmpl
			if($position == 'admin-invoice-edit-footer'){
				$invoiceId = $data['invoice']->getId();
				if(!empty($invoiceId)){
					ob_start();
					?>

					<a href="index.php?option=com_payinvoice&view=pdfinvoice&task=download&format=pdf&invoice_id=<?php echo $data['invoice']->getId();?>" class="btn btn-success"><i class="icon-download-alt icon-white"></i> <?php echo Rb_Text::_('PLG_PAYINVOICE_PGFINVOICE_DOWNLOAD_PDF');?></a>
					<?php
	
					$content = ob_get_contents();
					ob_end_clean();
					return $content;
				}
			}
		
		return false;
	}
}

