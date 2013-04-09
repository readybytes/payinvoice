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
}
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
?>
<script type="text/javascript">
       Joomla.submitbutton = function(task)
       {
               if (task == 'cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
                       Joomla.submitform(task, document.getElementById('adminForm'));
               }
       }
</script>

<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm">
		<div class="span6">		
			<fieldset class="form-horizontal">
				<h3> <?php echo ucfirst(Rb_Text::_($processor->getType()))." - ".Rb_Text::_('COM_OSINVOICE_PROCESSOR_EDIT_DETAILS' ); ?></h3><hr>
				<div class="control-group">
					<div class="control-label"><?php echo $form->getLabel('title'); ?> </div>
					<div class="controls"><?php echo $form->getInput('title'); ?></div>				
				</div>
			
				<div class="control-group">
					<div class="control-label"><?php echo $form->getLabel('published'); ?> </div>
					<div class="controls"><?php echo $form->getInput('published'); ?></div>				
				</div>
			
				<div class="control-group">
					<div class="control-label"><?php echo $form->getLabel('description'); ?> </div>
					<div class="controls"><?php echo $form->getInput('description'); ?></div>								
				</div>
			</fieldset>
		</div>
	
		<div class="span6">
			<fieldset class="form-horizontal">
				<h3> <?php echo Rb_Text::_('COM_OSINVOICE_PAYMENTMETHOD_EDIT_CONFIG_PARAMS' ); ?></h3><hr>
					<?php $fieldset_name = 'processor_config';?>
					<?php echo $this->loadTemplate('partial_fieldset', compact('fieldset_name', 'form'));?>
			</fieldset>
		</div>
	
		<?php echo $form->getInput('processor_id'); ?>
		<?php echo $form->getInput('type'); ?>
		<input type="hidden" name="task" value="save" />
		<input type="hidden" name="boxchecked" value="1" />
	</form>
<?php 
