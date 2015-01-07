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
?>

<form action="<?php echo $uri; ?>" method="post" name="adminForm">
	<div class="row-fluid">
		<div class="span12">
			<p class="lead center"><?php echo $heading; ?></p>
			<p class="center"><?php echo $msg; ?></p>
		</div>
		
		<div class="center">
			<a href="http://www.readybytes.net/payinvoice/forum.html" target="_blank" class="btn disabled"><i class="icon-question-sign "></i>&nbsp;<?php echo JText::_('COM_PAYINVOICE_SUPPORT_BUTTON');?></a>
			<a href="http://www.readybytes.net/payinvoice/documentation" target="_blank" class="btn disabled"><i class="icon-book"></i>&nbsp;<?php echo JText::_('COM_PAYINVOICE_DOCUMENTATION_BUTTON');?></a>
		</div>
		
	</div> 
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
<?php 
