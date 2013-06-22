<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
// XITODO : Javascript issue with chosen
//JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">
(function($){

	<?php if(isset($currency)) :?>
		var payinvoice_invoice_currency = '<?php echo $currency;?>';
	<?php endif;?>
	
 $(document).ready(function(){
	 
			payinvoice.admin.invoice.on_currency_change(payinvoice_invoice_currency);
				
			$('#payinvoice_form_rb_invoice_currency').change(function(){
				var currency   = $(this).val();
				payinvoice.admin.invoice.on_currency_change(currency);
				return false;
			}),

			$('#payinvoice_form_rb_invoice_buyer_id').change(function(){
			  	var buyer   = $(this).val();
			  	payinvoice.admin.invoice.on_buyer_change(buyer);
				return false;
			}),

			$("#payinvoice-add-processor").click(function () {
				$("#payinvoice-payment-processor").slideToggle("fast");	
				return false;
			});
	});
})(payinvoice.jQuery);
</script>	

<?php echo $this->loadTemplate('edit_item');?>
<div class="row-fluid">
<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm" class="rb-validate-form">	
	<div class="row-fluid">
		<div class="span9"><h2><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_DETAILS' ); ?></h2></div>		
		<?php if($form->getValue('invoice_id')):?>
			<div class="span3">
				<?php echo $statusbutton;?>
			</div>
		<?php endif;?>
	</div>
	
	<hr>
	<div class="row-fluid">
		<div class="span9">		
		<div class="row-fluid">
			<fieldset class="form">
				<div class="well well-large">
					<!-- START : Invoice Details -->
					<div class="row-fluid">											
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
								<div class="controls">
								  	<input 	type="text" 
								  			name="payinvoice_form[rb_invoice][serial]" 
								  			class="required"
								  			value="<?php echo $rb_invoice_fields['serial']->value; ?>"
								  			data-validation-ajax-ajax="<?php echo Rb_Route::_('index.php?option=com_payinvoice&view=invoice&task=ajaxchangeserial');?>"/>								
								</div>							
							</div>
						</div>
						<?php // IMP : we are skiping one span, to fix ui issue ?>
						<div class="span5">
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
				</div>				
			</fieldset>
			</div>			
			<!-- END : Invoice Details -->
			
			<div class="row-fluid">
				<!-- START : Item Table -->
					<?php echo $this->loadTemplate('edit_items');?>		
				<!-- END : Item Table -->
			</div>
			
			<div class="row-fluid">
				<button type="button" class="btn btn-small btn-success" id="payinvoice-invoice-item-add" counter="0"><i class="icon-plus"></i><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_ADD')?></button>
			</div>

			<div class="row-fluid">
				<!-- START : Item Table -->
					<?php echo $this->loadTemplate('edit_total');?>		
				<!-- END : Item Table -->
			</div>
			
			<div class="row-fluid">
				<h4><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_TERMS_AND_CONDITIONS');?></h4>
				<hr>
				<?php echo $invoice_params['terms_and_conditions'];?>
			</div>
			
			<div class="row-fluid">
				<!-- START : Item Table -->
					<?php echo $this->loadTemplate('edit_footer');?>		
				<!-- END : Item Table -->
			</div>
		</div>		
			
		<div class="span3">
			<?php if($form->getValue('invoice_id')):?>
				<div class="row-fluid">
					<div class="well well-small">	
						<h4 class="center muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_RELATED_DATES')?></h4><hr>
					    <ul class="horizontal unstyled center">
						    <li class="muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_CREATED_ON')." ".$rb_invoice['created_date'];?></li><hr>
						    <li class="muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_MODIFIED_ON')." ".$rb_invoice['modified_date'];?></li><hr>
						    <?php if(!empty($rb_invoice['paid_date'])):?>
						    <li class="muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_PAID_ON')." ".$rb_invoice['paid_date'];?></li><hr>
						    <?php endif;?>
						    <?php if(!empty($rb_invoice['refund_date'])):?>
						    <li class="muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_REFUNDED_ON')." ".$rb_invoice['refund_date'];?></li>
						    <?php endif;?>
					    </ul>
				    </div>
				</div>
			<?php endif;?>
			
			<div class="row-fluid">
			    <div class="well well-small">
						<?php $class="";?>
						<a href="#" id="payinvoice-add-processor" class="btn btn-success btn-block btn-large" title="<?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_ADD_PROCESSOR_TOOLTIP');?>">
							<?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_ADD_PROCESSOR');?>
						</a>
						<?php if(!$processor_id):?>
						<?php $class='class="hide"';?>
						<?php endif;?>
						<div>&nbsp;</div>
						<div id="payinvoice-payment-processor" <?php echo $class;?>>
							<div class="center">
				    			<?php echo PayInvoiceHtml::_('payinvoicehtml.processors.edit', 'payinvoice_form[params][processor_id]' ,$processor_id ,array('none'=>true, 'style' => 'class="input-medium"')); ?>
							</div>
						</div>
					</div>
				</div>
				    
				<div class="row-fluid">
					<div class="well well-small">	
					  	<?php echo $rb_invoice_fields['notes']->label;?>
						<hr>
						<?php echo $rb_invoice_fields['notes']->input;?>
					</div>
				</div>
				
				<?php if(!empty($record_id)):?>
					<div class="row-fluid">
						<div class="well well-small">
							<h5><?php echo Rb_Text::_('COM_PAYINVOICE_COPY_LINK');?></h5>
							<p class="info"><?php echo $invoice->getPayUrl();;?></p>
						</div>
					</div>
 				<?php endif;?>
		</div>				
	</div>			

	<!--  HIDDEN -->
	<input type="hidden" name="task" value="save" />
	<?php echo $form->getInput('type');?>
	<?php echo $form->getInput('invoice_id');?>
	<?php echo $rb_invoice_fields['invoice_id']->input;?>
</form>
</div>
<!--Load Preview template-->
<?php if(!empty($record_id)):?>
<?php echo $this->loadTemplate('preview');?>
<?php endif;
