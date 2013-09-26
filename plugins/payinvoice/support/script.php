<?php
/**
* @copyright		Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license			GNU/GPL, see LICENSE.php
* @package			Support
* @subpackage		Backend
*/
if(defined('_JEXEC')===false) die('Restricted access' );

class PlgpayinvoicesupportInstallerScript
{	
	/**
	 * Runs on installation
	 * 
	 * @param JInstaller $parent 
	 */
	
	public function postflight()
	{
		
		$extension 	= array('type'=>'payinvoice', 'name'=>'support');
		$this->changeExtensionState($extension);
		return true;
	}


	function changeExtensionState($extension, $state = 1)
	{
		if(empty($extension)){
			return true;
		}

		$db		= JFactory::getDBO();
		$query		= 'UPDATE '. $db->quoteName( '#__extensions' )
				. ' SET   '. $db->quoteName('enabled').'='.$db->Quote($state)
				. 'WHERE '. $db->quoteName('element').'='.$db->Quote($extension['name'])
				. ' AND ' . $db->quoteName('folder').'='.$db->Quote($extension['type'])
			        .'  AND `type`="plugin" ';

		$db->setQuery($query);
		return $db->query();
	}
}
