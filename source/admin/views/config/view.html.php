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
 * Transaction Html View
 * @author Manisha Ranawat
 */
require_once dirname(__FILE__).'/view.php';
class OSInvoiceAdminViewConfig extends OSInvoiceAdminBaseViewConfig
{	
	protected function _adminEditToolbar()
	{
		Rb_HelperToolbar::apply();
		Rb_HelperToolbar::cancel();
	}
	
	function edit($tpl=null)
	{
		$modelform  = OSInvoiceFactory::getInstance('config', 'Modelform' , 'osinvoice');
		$form		= $modelform->getForm();
		
		$file = OSINVOICE_PATH_CORE_FORMS.'/config.xml';
		$form->loadFile($file, false, '//config');
		$records = $this->getModel()->loadRecords();
		
		$data = OSInvoiceHelperConfig::get();
		$form->bind($data);		
		$this->assign('form', $form);
		$this->assign('config_data', $data);

		return true;
	}
}
