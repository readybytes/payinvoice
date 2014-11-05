<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Transaction Html View
 * @author Manisha Ranawat
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewConfig extends PayInvoiceAdminBaseViewConfig
{	
	protected function _adminEditToolbar()
	{
		JToolbarHelper::apply();
		JToolbarHelper::cancel();
	}
	
	function edit($tpl=null)
	{
		$modelform  = PayInvoiceFactory::getInstance('config', 'Modelform' , 'payinvoice');
		$form		= $modelform->getForm();
		
		$file = PAYINVOICE_PATH_CORE_FORMS.'/config.xml';
		$form->loadFile($file, false, '//config');
		$records = $this->getModel()->loadRecords();
		
		$data 	= $this->_helper->get();
		$form->bind($data);		
		$this->assign('form', $form);
		$this->assign('config_data', $data);

		return true;
	}
}
