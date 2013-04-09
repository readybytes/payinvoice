<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		XiEC
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}
?>
<div>
	<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm">
		<div>	
			<span><?php echo OSInvoiceHtml::_('osinvoicehtml.processortypes.edit', 'processor_type', '', array('none'=>true)); ?></span>
			<span><input type="submit" name="submit" value="Submit"/></span>
		</div>
		<input type="hidden" name="task" value="new" />

	</form>
</div>
<?php 
