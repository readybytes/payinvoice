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
 * Configuration Controller
 * @author Manisha Ranawat
 */
class OSInvoiceAdminControllerConfig extends OSInvoiceController
{
	protected 	$_defaultTask = 'edit';
	
	public function _save(array $data, $itemId=null)
	{
		//fields with blank value does not get posted so value does not get updated in the configuration
		$modelform  = OSInvoiceFactory::getInstance('config', 'Modelform' , 'OSInvoice');
		$form		= $modelform->getForm();
		$fieldset   = $form->getFieldset('config_params');
		
		if(!empty($_FILES['osinvoice_form']['tmp_name']['company_logo'])){
		    //save logo image
			$companylogo_imgpath 	= $_FILES['osinvoice_form']['tmp_name']['company_logo'];
			$companylogo_imgname 	= $_FILES['osinvoice_form']['name']['company_logo'];
			$supported_imageExt		= array("jpg","jpeg","png","gif");
			$storage_path     		= OSINVOICE_PATH_IMAGES;
			$logo_image				= OSInvoiceHelperUtils::saveUploadedFile($storage_path,$companylogo_imgpath,$companylogo_imgname,$supported_imageExt,"company_logo");
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
		$response       = OSInvoiceFactory::getAjaxResponse();

		$image   = OSInvoiceHelperConfig::get('company_logo');
		$data['company_logo'] = '';
			
		$extension      = JFile::getExt($image);
        
        OSInvoiceHelperUtils::removeFile(JPATH_ROOT.$image);
        $model 	= $this->getModel();
		$model->save($data);
		
		$response->addScriptCall('osinvoice.jQuery(\'#osinvoice-logo-image\').hide');
		$response->addAlert(Rb_Text::_('COM_OSINVOICE_LOGO_REMOVED_SUCCESSFULLY'));
		$response->sendResponse();
		return false;
	}
}
