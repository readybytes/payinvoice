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
<?php echo $this->loadTemplate('edit_task');?>
<?php echo $this->loadTemplate('add_new_item');?>

<div class="row-fluid">
<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm" class="rb-validate-form form-horizontal">	
	<div class="row-fluid">
		<div class="span9"><h2><?php echo JText::_('COM_PAYINVOICE_INVOICE_DETAILS' ); ?></h2></div>		
		<?php if($form->getValue('invoice_id')):?>
			<div class="span3 center">
				<div class="row-fluid <?php echo $statusbutton['class']?>">
					<h4><?php echo $statusbutton['status']?></h4>
				</div>
				<div class="row-fluid">
					<br/>
					<?php 
							$invoice_serial = $invoice->getInvoiceSerial();
							echo JText::_("COM_PAYINVOICE_INVOICE_SERIAL")." : ";
							if(empty($invoice_serial))
							{
								echo JText::_('COM_PAYINVOICE_NOT_APPLICABLE');
							}
							else
							{
								echo $invoice_serial;
							}
					?>
				</div>
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
								<div class="control-label"><?php echo $rb_invoice_fields['title']->label;?></div>
								<div class="controls"><?php echo $rb_invoice_fields['title']->input;?></div>								
							</div>
							<div class="control-group">
								<div class="control-label"><?php echo $rb_invoice_fields['buyer_id']->label;?></div>
								<div class="controls">
									<?php echo $rb_invoice_fields['buyer_id']->input;?>	
									<a href="#payinvoice-invoice-addbuyer" id="payinvoice_add_buyer_link" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-search icon-plus"></i>&nbsp;<?php echo JText::_('COM_PAYINVOICE_INVOICE_ADD_NEW');?></a>
								</div>								
							</div>
							<div class="control-group">
								<div class="control-label"><?php echo $rb_invoice_fields['reference_no']->label;?></div>
								<div class="controls">
								  	<input 	type="text" 
								  			name="payinvoice_form[rb_invoice][reference_no]" 
								  			class="required"
								  			value="<?php echo $rb_invoice_fields['reference_no']->value; ?>"
								  			data-validation-ajax-ajax="<?php echo Rb_Route::_('index.php?option=com_payinvoice&view=invoice&task=ajaxchangeserial&invoice_id='.$invoice->getInvoiceId());?>"/>
								  	<i class="icon-question-sign icon-white payinvoice-cursor-pointer" title="<?php echo JText::_('COM_PAYINVOICE_REFRENECE_NUMBER_DESC');?>"></i>								
								</div>							
							</div>
						</div>
						<?php // IMP : we are skiping one span, to fix ui issue ?>
						<div class="span5">
							<div class="control-group">
								<div class="control-label"><?php echo $rb_invoice_fields['currency']->label;?></div>
								<div class="controls"><?php echo $rb_invoice_fields['currency']->input;?></div>								
							</div>						
							<div class="control-group">
								<div class="control-label"><?php echo $rb_invoice_fields['issue_date']->label;?></div>
								<div class="controls"><?php echo $rb_invoice_fields['issue_date']->input;?></div>								
							</div>
							<div class="control-group">
								<div class="control-label"><?php echo $rb_invoice_fields['due_date']->label;?></div>
								<div class="controls"><?php echo $rb_invoice_fields['due_date']->input;?></div>								
							</div>
							<div class="control-group">
								<div class="control-label"><?php echo JText::_('COM_PAYINVOICE_CONFIG_INVOICE_LATE_FEE_INPERCENT');?></div>				
								<div class="controls"><fieldset class="radio btn-group" id="payinvoice_form_params_late_fee_type">
														<input type="radio" value="0" name="payinvoice_form[params][late_fee_type]" id="payinvoice_form_params_late_fee_type0" <?php echo $invoiceArray['params']['late_fee_type']=='0' ? 'checked="checked"':'';?>">
														<label for="payinvoice_form_params_late_fee_type0" class="btn">No</label>
														<input type="radio" value="1" name="payinvoice_form[params][late_fee_type]" id="payinvoice_form_params_late_fee_type1" <?php echo $invoiceArray['params']['late_fee_type']=='1' ? 'checked="checked"':'';?>" >
														<label for="payinvoice_form_params_late_fee_type1" class="btn">Yes</label>
													</fieldset>
								</div>
														
							</div>
							<div class="control-group">
								<div class="control-label"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_LATE_FEE');?></div>
								<div class="controls">
									<input type="text" class="input-medium" name=payinvoice_form[params][late_fee_value] value="<?php echo $invoiceArray['params']['late_fee_value']?>" >
								</div>
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
				<button type="button" class="btn btn-small btn-success" id="payinvoice-invoice-item-add" counter="0"><i class="icon-plus"></i><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_ADD')?></button>
			</div>

			<div class="row-fluid">
				<!-- START : Item Table -->
					<?php echo $this->loadTemplate('edit_total');?>		
				<!-- END : Item Table -->
			</div>
			
			<div class="row-fluid">
				<h4><?php echo JText::_('COM_PAYINVOICE_INVOICE_TERMS_AND_CONDITIONS');?></h4>
				<hr>
				<?php echo $invoice_params['terms_and_conditions'];?>
			</div>
			
			<div class="row-fluid">
				<!-- START : Item Table -->
					<?php echo $this->loadTemplate('edit_footer');?>		
				<!-- END : Item Table -->
			</div>
			<div>&nbsp;</div>
		</div>		
			
		<div class="span3">
			<?php if($form->getValue('invoice_id')):?>
				<div class="row-fluid">
					<div class="well well-small">	
						<h4 class="center muted"><?php echo JText::_('COM_PAYINVOICE_INVOICE_RELATED_DATES')?></h4><hr>
					    <ul class="horizontal unstyled center">
						    <li class="muted"><?php echo JText::_('COM_PAYINVOICE_INVOICE_CREATED_ON')." ".$rb_invoice['created_date'];?></li><hr>
						    <li class="muted"><?php echo JText::_('COM_PAYINVOICE_INVOICE_MODIFIED_ON')." ".$rb_invoice['modified_date'];?></li><hr>
						    <?php if(!empty($rb_invoice['paid_date'])):?>
						    <li class="muted"><?php echo JText::_('COM_PAYINVOICE_INVOICE_PAID_ON')." ".$rb_invoice['paid_date'];?></li><hr>
						    <?php endif;?>
						    <?php if(!empty($rb_invoice['refund_date'])):?>
						    <li class="muted"><?php echo JText::_('COM_PAYINVOICE_INVOICE_REFUNDED_ON')." ".$rb_invoice['refund_date'];?></li>
						    <?php endif;?>
					    </ul>
				    </div>
				</div>
			<?php endif;?>
			
			<div class="row-fluid">
			    <div class="well well-small">
						<?php $class="";?>
						<a href="#" id="payinvoice-add-processor" class="btn btn-success btn-block btn-large" title="<?php echo JText::_('COM_PAYINVOICE_INVOICE_ADD_PROCESSOR_TOOLTIP');?>">
							<?php echo JText::_('COM_PAYINVOICE_INVOICE_ADD_PROCESSOR');?>
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
						<div class="well well-small payinvoice-word-wrap">
							<h5><?php echo JText::_('COM_PAYINVOICE_COPY_LINK');?></h5><hr>
							<p class="info"><a href="<?php echo $invoice->getPayUrl();?>" target="_blank"><?php echo $invoice->getPayUrl();?></a></p>
						</div>
					</div>

					<?php if(!empty($transactions)):?>
						<div class="row-fluid">	
              				<div class="well well-small">
               			 		<h4 class="muted"><?php echo JText::_('Transactions');?></h4><hr>
                				<?php echo $this->loadTemplate('invoice_transaction');?>  
              				</div>
           				</div>
           			<?php endif;?>		
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
<?php endif;?>

<!--Load Add Buyer template-->
<?php echo $this->loadTemplate('addbuyer');?>
<?php 