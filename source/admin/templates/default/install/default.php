<?php

/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHtml::_('behavior.framework');
?>

<!--Congratulation Message-->
<div class="row-fluid">
	
	<div class="row-fluid">
		<div class="alert alert-success center">
			<h3><em><?php echo Rb_Text::_('COM_PAYINVOICE_INSTALLATION_SUCCESS_MSG');?></em></h3>
			<p><?php echo Rb_Text::_('COM_PAYINVOICE_INSTALLATION_SUCCESS_MSG_CONTENT');?></p>
		</div>
	</div>
		
	<div class="row-fluid">
		<button type="submit" class="btn btn-success btn-large pull-right" onclick="window.location.href='<?php echo JUri::base().'index.php?option=com_payinvoice&view=install&task=complete';?>';">
	  	<i class="icon-hand-right"></i>&nbsp;<?php echo Rb_Text::_('COM_PAYINVOICE_FINISH_INSTALLATION_BUTTON');?>
		</button>
   	</div>	
	
</div>


<div class="row-fluid">
	<div class="hide">
		<?php
			$version = new JVersion();
			$suffix = 'jom=J'.$version->RELEASE.'&utm_campaign=broadcast&payinvoice=PI'.PAYINVOICE_VERSION.'&dom='.JURI::getInstance()->toString(array('scheme', 'host', 'port'));?>
			<iframe src="http://pub.jpayplans.com/payinvoice/broadcast/installation.html?<?php echo $suffix?>"></iframe>
	</div>
</div>
<?php 
