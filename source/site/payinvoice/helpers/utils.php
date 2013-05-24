<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PAYINVOICE
* @subpackage	Frontend
* @contact 		team@readybytes.in
*/
if(defined('_JEXEC')===false) die('Restricted access' );
class PayInvoiceHelperUtils extends JObject
{
	function saveUploadedFile($storagepath='',$filepath='',$filename='',$supportedExtensions=array(),$savedname="default")
	{
		//no file selected then do nothing
		if(empty($filepath))
		{
		  	return false;
		}
	
		$app = PayInvoiceFactory::getApplication();
	
		//remove backslashes from file name
		$filename = stripslashes($filename);

		//get file extension
	   	$extension = strtolower(JFile::getExt($filename));	

	  	//check if file has supported extensions or not
		if(!in_array($extension, $supportedExtensions))
		{
			$app->enqueueMessage(Rb_Text::_('COM_PAYINVOICE_CONFIG_CUSTOMIZATION_EDIT_EXTENSION_NOT_SUPPORTED'));
			return false;
		}

		//check if folder exist or not. If not exists then create it.
		if(JFolder::exists(JPATH_ROOT.$storagepath)==false){
			JFolder::create(JPATH_ROOT.$storagepath);
		}
		
		//select the path for image storage
		$imgname = JPATH_ROOT.$storagepath.$savedname.'.'.$extension;
		 
		$img1= $storagepath.$savedname.'.'.$extension;
		copy($filepath, $imgname);
	
		return $img1;
	}
	
	static function removeFile($file)
	{
		if(JFile::exists($file)){
			return JFile::delete($file);
		}
	}	
	
	public function sendEmail( $emails, $subject, $message, $attachments=null)
	{
		//when no email address exists
		if (empty($emails)){
			return true;
		}
		
		$emails 	= is_array($emails) ? $emails : array($emails);
		$app  		= PayInvoiceFactory::getApplication();
		$mailfrom 	= $app->getCfg( 'mailfrom' );
		$fromname 	= $app->getCfg( 'fromname' );
		
		if( !$mailfrom  || !$fromname ) {
			throw new Exception(Rb_Text::_('COM_PAYINVOCIE_EXCEPTION_UTILS_NO_EMAILFROM_AND_FROMNAME_EXISTS'));
		}
		
		$message = html_entity_decode($message, ENT_QUOTES);
		$mail 	 = PayInvoiceFactory::getMailer()->setSender( array($mailfrom, $fromname))
											   	->addRecipient(array_shift($emails))
									           	->setSubject($subject)
									           	->setBody($message);

		$mail->IsHTML(true);
		if($attachments != null){
			$mail->addAttachment($attachments);
		}
		
		foreach ($emails as $email){
			$mail->addBCC($email);
		}
		
		return $mail->Send();	
	}
}
