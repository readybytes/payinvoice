<?php
/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$config_data['company_name']	= isset($config_data['company_name']) 		? $config_data['company_name'] 		: "";
$config_data['company_address']	= isset($config_data['company_address']) 	? $config_data['company_address']	: "";
$config_data['company_phone']	= isset($config_data['company_phone'])		? $config_data['company_phone']		: "";
?>
      
<div class="row-fluid">
	<div>&nbsp;</div>

	<div id="payinvoice-invoice-addbuyer" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<form action="<?php echo $uri; ?>" method="post" class="rb-validate-form form-horizontal payinvoice-add-buyer-form">
			<div class="span6">
				<fieldset class="form payinvoice-margin-left">
					<h3><?php echo JText::_('COM_PAYINVOICE_BUYER_LOGIN_DETAILS' ); ?></h3>
					<hr>		          
		            <div class="control-group">
						<div class="control-label"><?php echo $buyer_form->getLabel('name'); ?></div>
						<div class="controls"><?php echo $buyer_form->getInput('name'); ?></div>	
					</div>	
		
					<div class="control-group">
						<div class="control-label"><?php echo $buyer_form->getLabel('username'); ?></div>
						<div class="controls">
							<input 	type="text" 
									name="payinvoice_form[username]" 
									class="required"
									value="<?php echo $buyer_form->getValue('username'); ?>"
									data-validation-ajax-ajax="<?php echo Rb_Route::_('index.php?option=com_payinvoice&view=buyer&task=ajaxvalidateusername&buyer_id='.$record_id);?>"/>
						</div>
					</div>		
							 
					<div class="control-group">
						<div class="control-label"><?php echo $buyer_form->getLabel('email'); ?></div>
						<div class="controls">
							<input 	type="text" 
									name="payinvoice_form[email]" 
									class="required validate-email"
									value="<?php echo $buyer_form->getValue('email'); ?>"
									data-validation-ajax-ajax="<?php echo Rb_Route::_('index.php?option=com_payinvoice&view=buyer&task=ajaxvalidateemail&buyer_id='.$record_id);?>"/>								
						</div>										
					</div>	
							
					<div class="control-group">
						<div class="control-label"><?php echo $buyer_form->getLabel('password'); ?></div>
						<div class="controls"><?php echo $buyer_form->getInput('password'); ?></div>	
					</div>	
				</fieldset>
			</div>
		
			<div class="span6">
				<fieldset class="form payinvoice-margin-left">
					<h3><?php echo JText::_('COM_PAYINVOICE_BUYER_BASIC_DETAILS')?></h3><hr>
								   
					<div class="control-group">
						<div class="control-label"><?php echo $buyer_form->getLabel('currency'); ?></div>
						<div class="controls"><?php echo $buyer_form->getInput('currency'); ?></div>	
				   	</div>
				   	
					<div class="control-group">
						<div class="control-label"><?php echo $buyer_form->getLabel('tax_number'); ?></div>
						<div class="controls"><?php echo $buyer_form->getInput('tax_number'); ?></div>	
					</div>
					
					<div class="control-group">
						<div class="control-label"><?php echo $buyer_form->getLabel('address'); ?></div>
						<div class="controls"><?php echo $buyer_form->getInput('address'); ?></div>	
					</div>	
						
					<div class="control-group">
						<div class="control-label"><?php echo $buyer_form->getLabel('city'); ?></div>
						<div class="controls"><?php echo $buyer_form->getInput('city'); ?></div>	
					</div>	
							
					<div class="control-group">
						<div class="control-label"><?php echo $buyer_form->getLabel('zipcode'); ?></div>
						<div class="controls"><?php echo $buyer_form->getInput('zipcode'); ?></div>	
					</div>
					 
					<div class="control-group">
						<div class="control-label"><?php echo $buyer_form->getLabel('state'); ?></div>
						<div class="controls"><?php echo $buyer_form->getInput('state'); ?></div>	
					</div>
							 
					<div class="control-group">
						<div class="control-label"><?php echo $buyer_form->getLabel('country'); ?></div>
						<div class="controls"><?php echo $buyer_form->getInput('country'); ?></div>	
					</div>
				</fieldset>
			</div>

			<div class="row-fluid text-center">
				<a href="#" role="button" class="btn btn-success" onclick="payinvoice.admin.invoice.addbuyer.save()"><?php echo JText::_("COM_PAYINVOICE_SAVE")?></a>
				<a href="#" role="button" class="btn btn-success" onclick="payinvoice.admin.invoice.addbuyer.cancel()"><?php echo JText::_("COM_PAYINVOICE_CANCEL")?></a>
			</div>
			
		<?php echo $buyer_form->getInput('buyer_id'); ?>
		<input type="hidden" name="boxchecked" value="1" />	
	</form>
	</div>
</div>
<?php 
