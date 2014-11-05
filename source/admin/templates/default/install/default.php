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

JHtml::_('behavior.framework');
?>

<!--Congratulation Message-->
<div class="row-fluid">
	
	<div class="row-fluid">
		<div class="alert alert-success center">
			<h3><em><?php echo JText::_('COM_PAYINVOICE_INSTALLATION_SUCCESS_MSG');?></em></h3>
			<p><?php echo JText::_('COM_PAYINVOICE_INSTALLATION_SUCCESS_MSG_CONTENT');?></p>
		</div>
	</div>
	
	<div class="payinvoice-install-border">
		<div class="row-fluid">
			<div class="span5 center"><?php echo Rb_Html::image(Rb_HelperTemplate::mediaURI(PAYINVOICE_PATH_CORE_MEDIA."/admin/images/payinvoice-apps-banner.jpg", false), Rb_Text::_('COM_PAYINVOICE_APPS_BANNER'));?></div>	
			
			<div class="span2">&nbsp;</div>
			
			<div class="span5">
				<div class="payinvoice-unit">
	    			<span class="payinvoice-install-header"><?php echo JText::_('COM_PAYINVOICE_INSTALLATION_HEADER');?></span>
	    			<p><?php echo JText::_('COM_PAYINVOICE_INSTALLATION_HEADER_MSG')?></p>
				    <p><a href="<?php echo JUri::base().'index.php?option=com_payinvoice&view=appstore';?>" class="btn btn-info btn-large"><?php echo JText::_('COM_PAYINVOICE_GET_APPS');?></a></p>
		    	</div>
			</div>
		</div>
	</div>
	
	<div>&nbsp;</div>
		
	<div class="row-fluid">
		<button type="submit" class="btn btn-success btn-large pull-right" onclick="window.location.href='<?php echo JUri::base().'index.php?option=com_payinvoice&view=install&task=complete';?>';">
	  	<i class="icon-hand-right"></i>&nbsp;<?php echo JText::_('COM_PAYINVOICE_FINISH_INSTALLATION_BUTTON');?>
		</button>
	</div>	
	<div>&nbsp;</div>
	
</div>

<div class="row-fluid">
	<div class="hide">
		<?php

		$domain 		= JURI::getInstance()->toString(array('scheme', 'host', 'port'));
		$version 		= new JVersion();
		$suffix 		= 'jom=J'.$version->RELEASE.'&utm_campaign=broadcast&payinvoice=PI'.PAYINVOICE_VERSION.'&dom='.$domain;
		$event 			= "product.installation";
		$event_args 	= array('product'=>'PayInvoice', 'version'=>PAYINVOICE_VERSION, 'domain'=>$domain, 'joomla_version'=>$version->RELEASE, 'email'=>$email);
		$event_args 	= urlencode(json_encode($event_args));?>
		
		<iframe src="http://pub.jpayplans.com/payinvoice/broadcast/installation.html?<?php echo $suffix?>"></iframe>
		<iframe src="http://www.readybytes.net/broadcast/track.html?event=<?php echo $event;?>&event_args=<?php echo $event_args;?>" style="display :none;"></iframe>

	</div>
</div>
<?php 
