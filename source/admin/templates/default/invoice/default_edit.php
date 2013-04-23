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
				
			$('#osinvoice_form_xiee_invoice_currency').change(function(){
				var currency   = $(this).val();
				osinvoice.admin.invoice.item.on_currency_change(currency);
				return false;
			}),

			$('#osinvoice_form_xiee_invoice_buyer_id').change(function(){
			  	var buyer   = $(this).val();
			  	osinvoice.admin.invoice.item.on_buyer_change(buyer);
				return false;
			});
	});
})(osinvoice.jQuery);
</script>	

<?php echo $this->loadTemplate('edit_item');?>

<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm">
	<h2><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_DETAILS' ); ?></h2><hr>
	<fieldset class="form-horizontal">	
		<div class="row-fluid">
			<div class="span8">
			
				<!-- START : Invoice Details -->
				<div class="row-fluid well well-large">					
					<div class="span6">		
						<div class="control-group">
							<div class="control-label"><?php echo $xiee_invoice_fields['title']->label;?></div>
							<div class="controls"><?php echo $xiee_invoice_fields['title']->input;?></div>								
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $xiee_invoice_fields['buyer_id']->label;?></div>
							<div class="controls"><?php echo $xiee_invoice_fields['buyer_id']->input;?></div>								
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $xiee_invoice_fields['serial']->label;?></div>
							<div class="controls"><?php echo $xiee_invoice_fields['serial']->input;?></div>								
						</div>
					</div>
					
					<div class="span6">
						<div class="control-group">
							<div class="control-label"><?php echo $xiee_invoice_fields['currency']->label;?></div>
							<div class="controls"><?php echo $xiee_invoice_fields['currency']->input;?></div>								
						</div>						
						<div class="control-group">
							<div class="control-label"><?php echo $xiee_invoice_fields['issue_date']->label;?></div>
							<div class="controls"><?php echo $xiee_invoice_fields['issue_date']->input;?></div>								
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $xiee_invoice_fields['due_date']->label;?></div>
							<div class="controls"><?php echo $xiee_invoice_fields['due_date']->input;?></div>								
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
						
						<div class="control-group">
							<label class="control-label"><strong><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?></strong></label>
				  			<div class="controls">
				  				<div class="input-medium">
							    	<?php echo OSInvoiceHtml::_('osinvoicehtml.processors.edit', 'osinvoice_form[params][processor_id]' ,$processor_id ,array('none'=>true)); ?>
								</div>
				  			</div>
						</div>
					</div>
				</div>	
				<!-- END : Total -->
				
				
				<?php echo $xiee_invoice_fields['notes']->label;?>
				<hr>
				<?php echo $xiee_invoice_fields['notes']->input;?>								

			</div>			
		</div>
	</fieldset>
	
	<!--  HIDDEN -->
	<input type="hidden" name="task" value="save" />
	<?php echo $form->getInput('type');?>
	<?php echo $form->getInput('invoice_id');?>
	<?php echo $xiee_invoice_fields['invoice_id']->input;?>
</form>