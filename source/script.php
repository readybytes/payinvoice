<?php
/**
* @copyright		Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license			GNU/GPL, see LICENSE.php
* @package			PAYINVOICE
* @subpackage		Backend
*/
if(defined('_JEXEC')===false) die('Restricted access' );

class Com_payinvoiceInstallerScript
{
	
	/**
	 * Runs on installation
	 * 
	 * @param JInstaller $parent 
	 */
	
	public function install($parent)
	{
		$this->installExtensions();

		$extensions 	= array();
		$extensions[] 	= array('type'=>'user', 'name'=>'payinvoice');
		//For Enabling Rb_Framework
		$extensions[] 	= array('type' => 'system',   'name'=>'rbsl');
		//For Enabling Stripe Processor
		$extensions[]	= array('type' => 'rb_ecommerceprocessor ', 'name'=>'stripe');
		//For Enabling PdfExport plugin
		$extensions[]	= array('type' => 'payinvoice', 'name'=>'pdfexport');
		
		$this->changeExtensionState($extensions);
		$this->addDefaultProcessor();
		return true;
	}

	function uninstall($parent)
	{
		$state=0;
		$extensions[] 	= array('type'=>'user', 'name'=>'payinvoice');
		$extensions[] 	= array('type'=>'system',   'name'=>'rbsl');
		$extensions[]	= array('type'=>'payinvoice ', 'name'=>'pdfexport');
		$this->changeExtensionState($extensions, $state);

		return true;
	}

	
	function update($parent)
	{
		self::install($parent);
	}

	function installExtensions($actionPath=null,$delFolder=true)
	{
		//if no path defined, use default path
		if($actionPath==null)
			$actionPath = dirname(__FILE__).'/admin/install/extensions';

		//get instance of installer
		$installer =  new JInstaller();

		$extensions	= JFolder::folders($actionPath);

		//no extension to install
		if(empty($extensions))
			return true;

		//install all extensions
		foreach ($extensions as $extension)
		{
			$msg = " ". $extension . ' : Installed Successfully ';

			// Install the packages
			if($installer->install("{$actionPath}/{$extension}")==false){
				$msg = " ". $extension . ' : Installation Failed. Please try to reinstall. [Supportive plugin/module for PayInvoice]';
			}

			//enque the message
			JFactory::getApplication()->enqueueMessage($msg);
		}

		if($delFolder){
			$delPath = JPATH_ADMINISTRATOR.'/components/com_payinvoice/install/extensions';
			JFolder::delete($delPath);
		}

		return true;
	}

	function changeExtensionState($extensions = array(), $state = 1)
	{
		if(empty($extensions)){
			return true;
		}

		$db		= JFactory::getDBO();
		$query		= 'UPDATE '. $db->quoteName( '#__extensions' )
				. ' SET   '. $db->quoteName('enabled').'='.$db->Quote($state);

		$subQuery = array();
		foreach($extensions as $extension => $value){
			$subQuery[] = '('.$db->quoteName('element').'='.$db->Quote($value['name'])
				    . ' AND ' . $db->quoteName('folder').'='.$db->Quote($value['type'])
			            .'  AND `type`="plugin"  )   ';
		}

		$query .= 'WHERE '.implode(' OR ', $subQuery);

		$db->setQuery($query);
		return $db->query();
	}
	
	function addDefaultProcessor()
	{
		$db = JFactory::getDBO();
		
		$processor_exist		= 'SELECT * FROM #__payinvoice_processor';
		$db->setQuery($processor_exist);
		if($db->loadColumn()){
			return true;
		}
	
		$query   = 'INSERT INTO `#__payinvoice_processor` (`title`, `published`, `type`) VALUES ("Stripe",1,"stripe")';
						 
		$db->setQuery($query);
		return $db->query();
	}


	public function preflight($type, $parent)
	{
		if ($type != 'install' && $type != 'update'){
			return true;
		}

		$message 	= JText::_('ERROR_RB_NOT_FOUND : RB-Framework not found. Please refer <a href="http://www.readybytes.net/support/forum/knowledge-base/201257-error-codes.html" target="_blank">Error Codes </a> to resolve this issue.');
		// get content for rbframework version
		$file_url 	= 'http://pub.readybytes.net/rbinstaller/update/live.json';
		$link 		= new JURI($file_url);
		$curl 		= new JHttpTransportCurl(new JRegistry());
		$response 	= $curl->request('GET', $link);
	
		if($response->code != 200){
			JFactory::getApplication()->redirect('index.php?option=com_installer&view=install', $message, 'error');
		}

		$content 	= json_decode($response->body, true);
		if(!isset($content['rbframework']) || !isset($content['rbframework']['file_path'])){
			JFactory::getApplication()->redirect('index.php?option=com_installer&view=install', $message, 'error');
		}

		// check if already exists
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('*')
			  ->from($db->quoteName('#__extensions'))
			  ->where('`type` 		= '.$db->quote('plugin'))
			  ->where('`folder` 	= '.$db->quote('system'))
			  ->where('`client_id` 	= 0')
			  ->where('`element` 	= '.$db->quote('rbsl'));

		$db->setQuery($query);
		$result = $db->loadObject();

		//when rbframework is not already installed
		if (!$result) {
			$this->installRBFramework($content['rbframework']);
			$this->changeExtensionState(array(array('type'=>'system', 'name'=>'rbsl')));
			return true;
		}

		$query	= $db->getQuery(true);
		$query->select('*')
			  ->from($db->quoteName('#__extensions'))
		      ->where('`type` = '.$db->quote('component'). ' AND `element` LIKE '.$db->quote('com_jxiforms'));
		
		$db->setQuery($query);
		$installed_extensions = $db->loadObjectList();

		//when no dependent extension is installed, install framework
		if (!$installed_extensions){
			$this->installRBFramework($content['rbframework']);
			$this->changeExtensionState(array(array('type'=>'system', 'name'=>'rbsl')));
			return true;
		}
		else {
			$params 				= json_decode($result->manifest_cache, true);
			$latest_rb_version 		= explode('.', $content['rbframework']['version']);
			$installed_rb_version 	= explode('.', $params['version']);
	
			//if there is no change in the major version of rbframework then install else show message
			if(version_compare($installed_rb_version[0].'.'.$installed_rb_version[1], $latest_rb_version[0].'.'.$latest_rb_version[1]) == 0){
				$this->installRBFramework($content['rbframework']);
				if(!$result->enabled){
					$this->changeExtensionState(array(array('type'=>'system', 'name'=>'rbsl')));
				}
				return true;
			}

			$message = JText::_('ERROR_RB_MAJOR_VERSION_CHANGE : Major version change in the RB-Framework. Refer <a href="http://www.readybytes.net/support/forum/knowledge-base/201257-error-codes.html" target="_blank">Error Codes </a> to resolve this issue.');
			JFactory::getApplication()->redirect('index.php?option=com_installer&view=install', $message, 'error');
		}
		return true;
	}

	public function postFlight( $type, $parent ) 
	{
		// Create default Front end menus
		require_once JPATH_ADMINISTRATOR.'/components/com_payinvoice/install/script/menu.php';
		
		PayinvoiceInstallScriptMenu::createMenus();
	}
	
	protected function installRBFramework($content)
	{
		// get file
		$link 			= new JUri($content['file_path']);
		$curl			= new JHttpTransportCurl(new JRegistry());
		$response 		= $curl->request('GET', $link);
		$content_type 	= $response->headers['Content-Type'];

		if ($content_type != 'application/zip'){
			return false;
		}
		else {
			$response 	= $response->body;
		}

		//install rb-framework kit
		$random				= rand(1000, 999999);
		$tmp_file_name 		= JPATH_ROOT.'/tmp/'.$random.'item_rbframework'.'_'.$content['version'].'.zip';
		$tmp_folder_name 	= JPATH_ROOT.'/tmp/'.$random.'item_rbframework'.'_'.$content['version'];
	
		// create a file
		JFile::write($tmp_file_name, $response);
		jimport('joomla.filesystem.archive');
		jimport( 'joomla.installer.installer' );
		jimport('joomla.installer.helper');
		JArchive::extract($tmp_file_name, $tmp_folder_name);

		$installer = new JInstaller;
		if($installer->install($tmp_folder_name)){
			$response = true;
		}
		else{
			$response = false;
		}

		if (JFolder::exists($tmp_folder_name)){
			JFolder::delete($tmp_folder_name);
		}

		if (JFile::exists($tmp_file_name)){
			JFile::delete($tmp_file_name);
		}

		return $response;
	}

}
