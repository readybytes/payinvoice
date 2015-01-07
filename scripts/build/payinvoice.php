<?php
/**
* @copyright		Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license			GNU/GPL, see LICENSE.php
* @package			PayInvoice
* @subpackage		Backend
*/
if(defined('_JEXEC')===false) die();

class pkg_PayinvoiceInstallerScript
{
	function postflight($type, $parent)
	{
		$db      = JFactory::getDbo();

		$query = 'SELECT `extension_id` FROM #__extensions'
			 . ' WHERE `type` = "package" AND `element` = "pkg_PayInvoicePackage" ';
			    
	    	$db->setQuery( $query );
		$eid = $db->loadResult();

        	if($eid) {
			$file    = JPATH_ADMINISTRATOR . '/manifests/packages/pkg_payinvoice.xml';
			$newFile = JPATH_ADMINISTRATOR . '/manifests/packages/pkg_PayInvoicePackage.xml';

			if(JFile::exists($file)){
				JFile::move($file, $newFile);	
			}
			
			require_once JPATH_ADMINISTRATOR . '/components/com_installer/models/manage.php';		
			$model = new InstallerModelManage();
			$model->remove(array($eid));	
		}

		//$a = JInstaller::getInstance();
		return $this->_addScript();
		//$a->setRedirectURL('index.php?option=com_payinvoices&view=install');
	}

	function _addScript()
	{
		
		?>
			<script type="text/javascript">
				window.onload = function(){	
				  setTimeout("location.href = 'index.php?option=com_payinvoice&view=install';", 100);
				}
			</script>
		<?php
	}	
}

