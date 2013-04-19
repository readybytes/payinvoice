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
}?>

<form action="<?php echo $uri; ?>" method="post" name="adminForm">
	<div class="row-fluid">
		<div class="span12">
			<p class="lead center"><?php echo $heading; ?></p>
			<p class="center"><?php echo $msg; ?></p>
		</div>
		
		<div class="center">
			<a href="<?php echo JUri::base().'index.php?option=com_osinvoice&view=processor&task=selectProcessor';?>" class="btn btn-success jxif-width100"><i class="icon-plus-sign icon-white"></i>&nbsp;<?php echo Rb_Text::_('JTOOLBAR_NEW');?></a>
			<a href="#" target="_blank" class="btn disabled"><i class="icon-question-sign "></i>&nbsp;<?php echo Rb_Text::_('COM_OSINVOICE_SUPPORT_BUTTON');?></a>
			<a href="#" target="_blank" class="btn disabled"><i class="icon-book"></i>&nbsp;<?php echo Rb_Text::_('COM_OSINVOICE_DOCUMENTATION_BUTTON');?></a>
		</div>
		
	</div> 
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
<?php 
