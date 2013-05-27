<?php 
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PAYINVOICE
* @subpackage	Backend
* @contact 		team@readybytes.in
*/

if(defined('_JEXEC')===false) die('Restricted access');

JHtml::_('behavior.formvalidation');
//JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
?>

<script type="text/javascript">

(function($){
	$(document).ready(function(){
       $('#payinvoice-delete-logo').click(function(){
               var args   = { };
               var url = 'index.php?option=com_payinvoice&view=config&task=removelogo';
               payinvoice.ajax.go(url, args);
               return false;
       });
	});
})(payinvoice.jQuery);
</script>

<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" class="rb-validate-form">	
  <fieldset class="form-horizontal">
  	<div class="span6">	
			<h3> <?php echo Rb_Text::_('COM_PAYINVOICE_CONFIG_BASIC_SETTING' ); ?> </h3><hr>	
			
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('currency'); ?> </div>
				<div class="controls"><?php echo $form->getInput('currency'); ?></div>								
			</div>	
			
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('date_format'); ?> </div>
				<div class="controls"><?php echo $form->getInput('date_format'); ?></div>								
			</div>
			
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('terms_and_conditions'); ?> </div>
				<div class="controls"><?php echo $form->getInput('terms_and_conditions'); ?></div>								
			</div>
	  
	</div>				
			
		<div class="span6">
			<h3> <?php echo Rb_Text::_('COM_PAYINVOICE_CONFIG_COMPANY_SETTINGS' ); ?> </h3><hr>	
				
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('company_logo'); ?> </div>
				<div class="controls">
					<!-- XITODO : Fix size of logo properly -->
					<?php if(isset($config_data['company_logo'])):?>
						<div id="payinvoice-logo-image"><img src="<?php echo Rb_HelperTemplate::mediaURI($config_data['company_logo'], false); ?>" width="210" /></div>
						<div>&nbsp;</div>
					<?php endif;?>
					<?php echo $form->getInput('company_logo'); ?>
					<div><a href="#" id="payinvoice-delete-logo" class="span3">Delete</a></div>
				</div>								
			</div>
			
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('company_name'); ?> </div>
				<div class="controls"><?php echo $form->getInput('company_name'); ?></div>								
			</div>
			
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('company_address'); ?> </div>
				<div class="controls"><?php echo $form->getInput('company_address'); ?></div>								
			</div>
			
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('company_city'); ?> </div>
				<div class="controls"><?php echo $form->getInput('company_city'); ?></div>								
			</div>
			
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('company_phone'); ?> </div>
				<div class="controls"><?php echo $form->getInput('company_phone'); ?></div>								
			</div>			
	</div>
</fieldset>
	
	<input type="hidden" name="task" value="save" />
</form>
<?php 

