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
//JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');

if(empty($record_id)){
	$record_id = 0;
}

?>
<div class="row-fluid">	
	<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm" class="rb-validate-form">
		<div class="span6">
			<fieldset class="form">
				<h3><?php echo JText::_('COM_PAYINVOICE_BUYER_LOGIN_DETAILS' ); ?></h3>
				<hr>		          
	            <div class="control-group">
					<?php echo $form->getLabel('name'); ?>
					<div class="controls"><?php echo $form->getInput('name'); ?></div>	
				</div>	
	
				<div class="control-group">
					<?php echo $form->getLabel('username'); ?>
					<div class="controls">
						<input 	type="text" 
								name="payinvoice_form[username]" 
								class="required"
								value="<?php echo $form->getValue('username'); ?>"
								data-validation-ajax-ajax="<?php echo Rb_Route::_('index.php?option=com_payinvoice&view=buyer&task=ajaxvalidateusername&buyer_id='.$record_id);?>"/>
					</div>
				</div>		
						 
				<div class="control-group">
					<?php echo $form->getLabel('email'); ?>
					<div class="controls">
						<input 	type="text" 
								name="payinvoice_form[email]" 
								class="required validate-email"
								value="<?php echo $form->getValue('email'); ?>"
								data-validation-ajax-ajax="<?php echo Rb_Route::_('index.php?option=com_payinvoice&view=buyer&task=ajaxvalidateemail&buyer_id='.$record_id);?>"/>								
					</div>										
				</div>	
						
				<div class="control-group">
					<?php echo $form->getLabel('password'); ?>
					<div class="controls"><?php echo $form->getInput('password'); ?></div>	
				</div>	
			</fieldset>
		</div>
		
		<div class="span6">
			<fieldset class="form">
				<h3><?php echo JText::_('COM_PAYINVOICE_BUYER_BASIC_DETAILS')?></h3><hr>
							   
				<div class="control-group">
					<?php echo $form->getLabel('currency'); ?>
					<div class="controls"><?php echo $form->getInput('currency'); ?></div>	
			   	</div>
			   	
				<div class="control-group">
					<?php echo $form->getLabel('tax_number'); ?>
					<div class="controls"><?php echo $form->getInput('tax_number'); ?></div>	
				</div>
				
				<div class="control-group">
					<?php echo $form->getLabel('address'); ?>
					<div class="controls"><?php echo $form->getInput('address'); ?></div>	
				</div>	
					
				<div class="control-group">
					<?php echo $form->getLabel('city'); ?>
					<div class="controls"><?php echo $form->getInput('city'); ?></div>	
				</div>	
						
				<div class="control-group">
					<?php echo $form->getLabel('zipcode'); ?>
					<div class="controls"><?php echo $form->getInput('zipcode'); ?></div>	
				</div>
				 
				<div class="control-group">
					<?php echo $form->getLabel('state'); ?>
					<div class="controls"><?php echo $form->getInput('state'); ?></div>	
				</div>
						 
				<div class="control-group">
					<?php echo $form->getLabel('country'); ?>
					<div class="controls"><?php echo $form->getInput('country'); ?></div>	
				</div>
			</fieldset>
		</div>		

	<?php echo $form->getInput('buyer_id'); ?>
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="boxchecked" value="1" />	
	</form>
</div>
<?php 
