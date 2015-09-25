<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
support+payinvoice
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm">
	<div class="row-fluid">
		<div class="span12">
			<p class="lead center"><?php echo $heading; ?></p>
			<p class="center"><?php echo $msg; ?></p>
		</div>
		
		<div class="center">
			<a href="<?php echo JUri::base().'index.php?option=com_payinvoice&view=item&task=selectItem';?>" class="btn btn-success jxif-width100"><i class="icon-plus-sign icon-white"></i>&nbsp;<?php echo JText::_('JTOOLBAR_NEW');?></a>
			<a href="http://www.readybytes.net/payinvoice/forum.html" target="_blank" class="btn disabled"><i class="icon-question-sign "></i>&nbsp;<?php echo JText::_('COM_PAYINVOICE_SUPPORT_BUTTON');?></a>
			<a href="http://www.readybytes.net/payinvoice/documentation" target="_blank" class="btn disabled"><i class="icon-book"></i>&nbsp;<?php echo JText::_('COM_PAYINVOICE_DOCUMENTATION_BUTTON');?></a>
		</div>
		
	</div> 
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
<?php 
