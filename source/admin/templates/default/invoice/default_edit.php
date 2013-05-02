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
JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
// XITODO : Javascript issue with chosen
//JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">
(function($){

	<?php if(isset($currency)) :?>
		var osi_invoice_currency = '<?php echo $currency;?>';
	<?php endif;?>
	
 $(document).ready(function(){
	 
			osinvoice.admin.invoice.item.on_currency_change(osi_invoice_currency);
				
			$('#osinvoice_form_rb_invoice_currency').change(function(){
				var currency   = $(this).val();
				osinvoice.admin.invoice.item.on_currency_change(currency);
				return false;
			}),

			$('#osinvoice_form_rb_invoice_buyer_id').change(function(){
			  	var buyer   = $(this).val();
			  	osinvoice.admin.invoice.item.on_buyer_change(buyer);
				return false;
			}),

			$('#osinvoice_form_rb_invoice_serial').change(function(){
				var serial 	= $(this).val();
				osinvoice.admin.invoice.item.on_serial_change(serial);
				return false;	
			}),

			$("#osi-add-processor").click(function () {
				$("#osi-payment-processor").slideToggle("fast");				
			});
	});
})(osinvoice.jQuery);
</script>	

<?php echo $this->loadTemplate('edit_item');?>

<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm" class="rb-validate-form">
	<div class="row-fluid">
	<div class="span8"><h2><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_DETAILS' ); ?></h2></div>
	<?php if($form->getValue('invoice_id')):?>
	<div class="offset1 span3 pull-right">
		<div class="label <?php echo $status['class']?> center"><h5><?php  echo $status['status'];?></h5></div>
	</div>
	<?php endif;?>
	</div>
	
	<hr>
	<fieldset class="form-horizontal">	
		<div class="row-fluid">
			<div class="span8">
			
				<!-- START : Invoice Details -->
				<div class="row-fluid well well-large">					
					<div class="span6">		
						<div class="control-group">
							<?php echo $rb_invoice_fields['title']->label;?>
							<div class="controls"><?php echo $rb_invoice_fields['title']->input;?></div>								
						</div>
						<div class="control-group">
							<?php echo $rb_invoice_fields['buyer_id']->label;?>
							<div class="controls"><?php echo $rb_invoice_fields['buyer_id']->input;?></div>								
						</div>
						<div class="control-group">
							<?php echo $rb_invoice_fields['serial']->label;?>
							<div class="controls"><?php echo $rb_invoice_fields['serial']->input;?><br>
								<span class="invoice-error error"></span>
							</div>							
						</div>
					</div>
					
					<div class="span6">
						<div class="control-group">
							<?php echo $rb_invoice_fields['currency']->label;?>
							<div class="controls"><?php echo $rb_invoice_fields['currency']->input;?></div>								
						</div>						
						<div class="control-group">
							<?php echo $rb_invoice_fields['issue_date']->label;?>
							<div class="controls"><?php echo $rb_invoice_fields['issue_date']->input;?></div>								
						</div>
						<div class="control-group">
							<?php echo $rb_invoice_fields['due_date']->label;?>
							<div class="controls"><?php echo $rb_invoice_fields['due_date']->input;?></div>								
						</div>
					</div>			
				</div>
				<!-- END : Invoice Details -->
				
				<!-- START : Item Table -->
						<?php echo $this->loadTemplate('edit_items');?>		
				<!-- END : Item Table -->
				
				
				<!-- START : Total -->
				<div class="row-fluid">
					<div class="span7">
					
					</div>
					<div class="span5">
						<div class="control-group">
							<label class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_EDIT_ITEM_SUBTOTAL');?></label>
				  			<div class="controls">
				  				<div class="input-prepend">              			
									<span class="add-on osi-currency"></span>
									<input type="text" name="osinvoice_form[subtotal]" class="input-small" readonly="readonly" id="osi-invoice-subtotal">		
								</div>
				  			</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_EDIT_ITEM_DISCOUNT');?></label>
				  			<div class="controls">
				  				<div class="input-prepend">
									<span class="add-on osi-currency"></span>
									<input type="text" name="osinvoice_form[discount]" class="input-small" id="osi-invoice-discount" value="<?php echo $discount;?>">
								</div>
				  			</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_EDIT_ITEM_TAX');?></label>
				  			<div class="controls">
				  				<div class="input-append">									
									<input type="text" name="osinvoice_form[tax]" class="input-small" id="osi-invoice-tax" value="<?php echo $tax;?>">
									<span class="add-on">%</span>
								</div>
				  			</div>
						</div>
						<hr>
						<div class="control-group">
							<label class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_EDIT_ITEM_TOTAL');?></label>
				  			<div class="controls">
				  				<div class="input-prepend">
									<span class="add-on osi-currency"></span>
									<input type="text" name="osinvoice_form[total]" class="input-small" readonly="readonly" id="osi-invoice-total" >
								</div>
				  			</div>
						</div>
					</div>
				</div>	
				<!-- END : Total -->
				
				<h4><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_TERMS_AND_CONDITIONS');?></h4><hr>
					<?php echo $invoice_params['terms_and_conditions'];?>
				
				<div>&nbsp;</div>
				<div class="pull-right">
					<?php if(!empty($invoice_url)):?>
					<a href="<?php echo $invoice_url;?>" class="btn btn-info" target="_blank"><i class="icon-search icon-white"></i>&nbsp;<?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_PREVIEW_LINK');?></a>					<?php endif;?>
				</div>								

			</div>		
		
				<div class="pull-right span3 ">
				<?php if($form->getValue('invoice_id')):?>
					<div class="row-fluid well well-small">	
						<h4 class="center muted"><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_RELATED_DATES')?></h4><hr>
					    <ul class="horizontal unstyled center">
						    <li class="muted"><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_CREATED_ON')." ".$rb_invoice['created_date'];?></li><hr>
						    <li class="muted"><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_MODIFIED_ON')." ".$rb_invoice['modified_date'];?></li><hr>
						    <?php if(!empty($rb_invoice['paid_on'])):?>
						    <li class="muted"><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_PAID_ON')." ".$rb_invoice['paid_on'];?></li><hr>
						    <?php endif;?>
						    <?php if(!empty($rb_invoice['refunded_on'])):?>
						    <li class="muted"><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_REFUNDED_ON')." ".$rb_invoice['refunded_on'];?></li>
						    <?php endif;?>
					    </ul>
				    </div>
				    <?php endif;?>	
				    
			    	<?php $class="";?>
					<?php if(empty($osi_invoice['params']['processor_id'])):?>
					<a href="#" id="osi-add-processor" class="btn btn-info" title="<?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_ADD_PROCESSOR_TOOLTIP');?>">
						<?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_ADD_PROCESSOR');?>
					</a>
					<?php $class='class="hide"';?>
					<?php endif;?>
					<div>&nbsp;</div>
					<div id="osi-payment-processor" <?php echo $class;?>>
						<div class="control-group">
							<label class="control-label"><strong><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?></strong></label>
				  			<div class="controls">
							    	<?php echo OSInvoiceHtml::_('osinvoicehtml.processors.edit', 'osinvoice_form[params][processor_id]' ,$processor_id ,array('none'=>true, 'style' => 'class="input-medium"')); ?>
				  			</div>
						</div>
					</div>
						
				  	<?php echo $rb_invoice_fields['notes']->label;?>
					<hr>
					<?php echo $rb_invoice_fields['notes']->input;?>			
    		</div>	
    		
			
	
		</div>
	</fieldset>
	
	<!--  HIDDEN -->
	<input type="hidden" name="task" value="save" />
	<?php echo $form->getInput('type');?>
	<?php echo $form->getInput('invoice_id');?>
	<?php echo $rb_invoice_fields['invoice_id']->input;?>
</form>
