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
 * Configuration Controller
 * @author Manisha Ranawat
 */
class PayInvoiceAdminControllerConfig extends PayInvoiceController
{
	protected 	$_defaultTask = 'edit';
	
	public function _save(array $data, $itemId=null)
	{
		//fields with blank value does not get posted so value does not get updated in the configuration
		$modelform  = PayInvoiceFactory::getInstance('config', 'Modelform' , 'PayInvoice');
		$form		= $modelform->getForm();
		$fieldset   = $form->getFieldset('config_params');
		
		if(!empty($_FILES['payinvoice_form']['tmp_name']['company_logo'])){
		    //save logo image
			$companylogo_imgpath 	= $_FILES['payinvoice_form']['tmp_name']['company_logo'];
			$companylogo_imgname 	= $_FILES['payinvoice_form']['name']['company_logo'];
			$supported_imageExt		= array("jpg","jpeg","png","gif");
			$storage_path     		= PAYINVOICE_PATH_IMAGES;
			$utils					= $this->getHelper('utils');
			$logo_image				= $utils->saveUploadedFile($storage_path,$companylogo_imgpath,$companylogo_imgname,$supported_imageExt,"company_logo");
		    $data['company_logo'] 	= $logo_image;
		}

		$configParams = array();
		foreach ($fieldset as $index => $field){	
			$configParams[] = $field->fieldname;
		}
		
		$model 	= $this->getModel();
		$model->save($data);
		return true;
	}
	
	public function removelogo()
	{
		$response       		= PayInvoiceFactory::getAjaxResponse();

		$image   				= $this->_helper->get('company_logo');
		$data['company_logo'] 	= '';
			
		$extension      = JFile::getExt($image);
		
		$this->getHelper('utils')->removeFile(JPATH_ROOT.$image);
        $model 	= $this->getModel();
		$model->save($data);
		
		$response->addScriptCall('payinvoice.jQuery(\'#payinvoice-logo-image\').hide');
		$response->addAlert(Rb_Text::_('COM_PAYINVOICE_LOGO_REMOVED_SUCCESSFULLY'));
		$response->sendResponse();
		return false;
	}
}
