<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
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

(function($){
 $(document).ready(function(){
	 var buyer_id	= '';
	 <?php if($record_id):?>
	       buyer_id	= '<?php echo $record_id;?>';
	 <?php endif;?>
	 				
			$('#payinvoice_form_email').change(function(){
			  	var email   = $(this).val();
			  	payinvoice.admin.buyer.on_email_change(email, buyer_id);
				return false;
			});
			
	});
})(payinvoice.jQuery);
</script>

<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm" class="rb-validate-form">
<div class="row-fluid">
<fieldset class="form-horizontal">
	<h2><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_EDIT_DETAILS' ); ?></h2>
    <hr>         
    <div class="row-fluid">
		<div class="span3">
		  	<img src="<?php echo $user->getAvatar('large'); ?>" class="img-polaroid">
  		</div> 	 
    
    	<div class="span9">
    	    <div class="span6">
    		    <h3><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_LOGIN_DETAILS')?></h3>
    		    <hr>			    		          
    	        <div class="control-group">
					<?php echo $form->getLabel('name'); ?>
					<div class="controls"><?php echo $form->getInput('name'); ?></div>	
				</div>		
						 
				<div class="control-group">
					<?php echo $form->getLabel('email'); ?>
					<div class="controls"><?php echo $form->getInput('email'); ?><br>
						<span class="payinvoice-email-error error"></span>
					</div>										
				</div>	
						
				<div class="control-group">
					<?php echo $form->getLabel('password'); ?>
					<div class="controls"><?php echo $form->getInput('password'); ?></div>	
				</div>	
				<br>
						 
				<h3><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_BASIC_DETAILS')?></h3><hr>
						   
				<div class="control-group">
					<?php echo $form->getLabel('currency'); ?>
					<div class="controls"><?php echo $form->getInput('currency'); ?></div>	
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
					<?php echo $form->getLabel('state'); ?>
					<div class="controls"><?php echo $form->getInput('state'); ?></div>	
				</div>
						 
				<div class="control-group">
					<?php echo $form->getLabel('country'); ?>
					<div class="controls"><?php echo $form->getInput('country'); ?></div>	
				</div>

				<div class="control-group">
					<?php echo $form->getLabel('tax_number'); ?>
					<div class="controls"><?php echo $form->getInput('tax_number'); ?></div>	
				</div>
						 
				<div class="control-group">
					<?php echo $form->getLabel('zipcode'); ?>
					<div class="controls"><?php echo $form->getInput('zipcode'); ?></div>	
				</div> 
			</div>
			<div class="span3"> </div>          
		</div>
	</div>
</fieldset>
	
<?php echo $form->getInput('buyer_id'); ?>
<?php echo $form->getInput('username'); ?>
<input type="hidden" name="task" value="save" />
<input type="hidden" name="boxchecked" value="1" />
</div>
</form>
<?php 
