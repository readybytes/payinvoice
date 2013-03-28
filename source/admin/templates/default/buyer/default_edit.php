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
     
<fieldset class="form-horizontal">
         <h2><?php echo Rb_Text::_('COM_OSINVOICE_BUYER_EDIT_DETAILS' ); ?></h2>
         <hr>
		      <div class="row-fluid">
					<div class="span3">
					  	<img src="../administrator/components/com_osinvoice/templates/default/buyer/avtar.jpeg" class="img-polaroid">
			  		</div>  
			 
		    
			    	<div class="span9">
			    		    <div class="span6">
			    		          <h3><?php echo Rb_Text::_('COM_OSINVOICE_BUYER_LOGIN_DETAILS')?></h3><hr>
			    		          
			    		          	<div class="control-group">
										<div class="control-label"><?php echo $form->getLabel('name'); ?> </div>
										<div class="controls"><?php echo $form->getInput('name'); ?></div>	
									 </div>		
									 
				    		        <div class="control-group">
										<div class="control-label"><?php echo $form->getLabel('username'); ?> </div>
										<div class="controls"><?php echo $form->getInput('username'); ?></div>	
									 </div>			
								
								    <div class="control-group">
										<div class="control-label"><?php echo $form->getLabel('email'); ?> </div>
										<div class="controls"><?php echo $form->getInput('email'); ?></div>	
									</div>	
									
									<div class="control-group">
										<div class="control-label"><?php echo $form->getLabel('password'); ?> </div>
										<div class="controls"><?php echo $form->getInput('password'); ?></div>	
									 </div>	
									 <br>
									 
									<h3><?php echo Rb_Text::_('COM_OSINVOICE_BUYER_BASIC_DETAILS')?></h3><hr>
									   
									   <div class="control-group">
											<div class="control-label"><?php echo $form->getLabel('currency'); ?> </div>
											<div class="controls"><?php echo $form->getInput('currency'); ?></div>	
									   </div>			
								
								       <div class="control-group">
											<div class="control-label"><?php echo $form->getLabel('address'); ?> </div>
											<div class="controls"><?php echo $form->getInput('address'); ?></div>	
									   </div>	
									
										<div class="control-group">
											<div class="control-label"><?php echo $form->getLabel('city'); ?> </div>
											<div class="controls"><?php echo $form->getInput('city'); ?></div>	
										 </div>	
										 
										 <div class="control-group">
											<div class="control-label"><?php echo $form->getLabel('state'); ?> </div>
											<div class="controls"><?php echo $form->getInput('state'); ?></div>	
										 </div>
										 
										 <div class="control-group">
											<div class="control-label"><?php echo $form->getLabel('country'); ?> </div>
											<div class="controls"><?php echo $form->getInput('country'); ?></div>	
										 </div>
										 
										 <div class="control-group">
											<div class="control-label"><?php echo $form->getLabel('zipcode'); ?> </div>
											<div class="controls"><?php echo $form->getInput('zipcode'); ?></div>	
										 </div>
										 
									   
							</div>						
	             
		             		<div class="span3"> </div>  
		           
		              </div>
		          </div>

</fieldset>
	
	<?php echo $form->getInput('buyer_id'); ?>
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="boxchecked" value="1" />
</form>
<?php 
