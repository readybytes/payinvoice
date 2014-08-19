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
	
	<div class="payinvoice-install-border">
		<div class="row-fluid">
			<div class="span5 center"><?php echo Rb_Html::image(Rb_HelperTemplate::mediaURI(PAYINVOICE_PATH_ADMIN_TEMPLATE."/default/_media/images/payinvoice-apps-banner.jpg", false), Rb_Text::_('COM_PAYINVOICE_APPS_BANNER'));?></div>	
			
			<div class="span2">&nbsp;</div>
			
			<div class="span5">
				<div class="payinvoice-unit">
	    			<span class="payinvoice-install-header"><?php echo Rb_Text::_('COM_PAYINVOICE_INSTALLATION_HEADER');?></span>
	    			<p><?php echo Rb_Text::_('COM_PAYINVOICE_INSTALLATION_HEADER_MSG')?></p>
				    <p><a href="<?php echo JUri::base().'index.php?option=com_payinvoice&view=appstore';?>" class="btn btn-info btn-large"><?php echo Rb_Text::_('COM_PAYINVOICE_GET_APPS');?></a></p>
		    	</div>
			</div>
		</div>
	</div>
	
	<div>&nbsp;</div>
		
	<div class="row-fluid">
		<button type="submit" class="btn btn-success btn-large pull-right" onclick="window.location.href='<?php echo JUri::base().'index.php?option=com_payinvoice&view=install&task=complete';?>';">
	  	<i class="icon-hand-right"></i>&nbsp;<?php echo Rb_Text::_('COM_PAYINVOICE_FINISH_INSTALLATION_BUTTON');?>
		</button>
	</div>	
	<div>&nbsp;</div>
	
</div>

<div class="row-fluid">
		<div class="hide">
		<?php
			$version 	= new JVersion();
			$suffix 	= 'jom=J'.$version->RELEASE.'&utm_campaign=broadcast&payinvoice=PI'.PAYINVOICE_VERSION.'&dom='.JURI::getInstance()->toString(array('scheme', 'host', 'port'));?>
			<iframe src="http://pub.jpayplans.com/payinvoice/broadcast/installation.html?<?php //echo $suffix?>"></iframe>
			
			<?php 
			$event			= "product.installation";
			$domain 		= JURI::getInstance()->toString(array('scheme', 'host', 'port'));
			$event_args 	= array('domain'=> $domain, 'version'=> "'.PAYINVOICE_VERSION.'", 'product'=>'PayInvoice', 'email'=>'', 'joomla_version'=> "'.$version->RELEASE.'");
            $event_args 	= urlencode(json_encode($event_args)); ?>

			<iframe id="iframe-id" src="http://www.readybytes.net/broadcast/track.html?event=<?php echo $event;?>&event_args=<?php echo $event_args;?>" style="display :none;"></iframe>
	</div>
</div>
<?php 
