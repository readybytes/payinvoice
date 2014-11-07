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

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
?>
<div class="row-fluid">
	<a class="btn btn-success pull-right" target="_blank" href="http://www.jpayplans.com/payinvoice/documentation/item/paypal-payment-gateway.html"><i class="icon-white icon-book"></i>&nbsp;<?php echo Rb_Text::_('COM_PAYINVOICE_DOCUMENTATION_BUTTON');?></a>
</div>

<div class="row-fluid">
	<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm" class="rb-validate-form">
		<div class="span6">		
			<fieldset class="form">
				<h3> <?php echo ucfirst(JText::_($processor->getType()))." - ".JText::_('COM_PAYINVOICE_PROCESSOR_EDIT_DETAILS' ); ?></h3><hr>
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
			<fieldset class="form">
				<h3> <?php echo JText::_('COM_PAYINVOICE_PAYMENTMETHOD_EDIT_CONFIG_PARAMS' ); ?></h3><hr>
				<div class="row-fluid">
					<?php echo $this->loadTemplate('fieldset');?>
				</div>				
		
				<?php //XITODO : generalize the concept of toggle ?>
				<?php if(!empty($help['help'])): ?>
					<div class="row-fluid">
						<legend onClick="payinvoice.jQuery('.payinvoice-processor-help').slideToggle();">
							<span class="payinvoice-processor-help">[+]</span>
							<span> <?php echo JText::_('COM_PAYINVOICE_PROCESSOR_HELP_MESSAGE'); ?></span>
						</legend>
				
						<div class="hide payinvoice-processor-help">				
							<div><?php echo (isset($help['help']) && !empty($help['help'])) ? JText::_($help['help']) : ''; ?></div>
						</div>
					</div>
				<?php endif;?>
			</fieldset>
		</div>
		
		<?php echo $form->getInput('processor_id'); ?>
		<?php echo $form->getInput('type'); ?>
		<input type="hidden" name="task" value="save" />
		<input type="hidden" name="boxchecked" value="1" />
	</form>
</div>
<?php 
