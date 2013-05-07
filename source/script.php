<?php
/**
* @copyright		Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license			GNU/GPL, see LICENSE.php
* @package			PAYINVOICE
* @subpackage		Backend
*/
if(defined('_JEXEC')===false) die();

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
		$extensions[] 	= array('type'=>'system',   'name'=>'rbsl');

		$this->changeExtensionState($extensions);
		return true;
	}

	function uninstall($parent)
	{
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
}