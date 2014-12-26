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
