<?php

/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );?>
<script>
(function($){
	$(document).ready(function(){	
		var invoice_id	= '<?php echo $payinvoice_invoice['invoice_id'];?>';
		
		<?php if(!empty($payinvoice_invoice['params']['processor_id'])) :?>
			var payinvoice_invoice_processor = '<?php echo $payinvoice_invoice['params']['processor_id'];?>';
			payinvoice.site.invoice.on_processor_change(payinvoice_invoice_processor, invoice_id);
		<?php endif;?>
        	
		$('#payinvoice_formparamsprocessor_id').change(function(){
			var processor   = $(this).val();
			if(processor != ""){
				$('#payinvoice-paynow-html').html("");	
			}
			payinvoice.site.invoice.on_processor_change(processor, invoice_id);
			return false;
		});
	});
})(payinvoice.jQuery);
</script>

<div class="container-fluid">
<div class="pi-invoice-wraper">
    <div class="row-fluid">
    	 <h3 class="text-center"><?php echo JText::_('COM_PAYINVOICE_INVOICE_HEADING_TITLE');?></h3>

		  <?php echo $this->loadTemplate('header');?>
		  <?php echo $this->loadTemplate('details');?><br>
		  <?php echo $this->loadTemplate('items');?>
	 
	 		<div class="row-fluid">
	 				<div class="span8"></div>
				    <div class="span4 pull-right pi-invoice-amount">
				    	<table class="table">
				    		<tr>
				    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_SUBTOTAL');?></strong></td>
				    			<td class="pull-right"><?php echo $currency." ". number_format($subtotal, 2);?></td>
				    		</tr>
				    		<tr>
				    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_DISCOUNT');?></strong></td>
				    			<td class="pull-right"><?php echo $discount;?></td>
				    		</tr>
				    		<tr>
				    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></strong></td>
				    			<td class="pull-right"><?php echo number_format($tax,2)." %";?></td>
				    		</tr>
				    	</table><hr>
				    	<table class="table">
				    		<tr>
				    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TOTAL');?></strong></td>
				    			<td class="pull-right"><strong><?php echo $currency." ".number_format($rb_invoice['total'], 2);?></strong></td>
				    	</table>
				    </div>
			</div>
			<div class="row">
				    <div class="span5 pull-right ">
				    	<table>
				    		<tr>
				    			<?php if($valid && $rb_invoice['total'] != floatval(0) && $rb_invoice['status'] == PayInvoiceInvoice::STATUS_DUE):?>
				    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_PAYMENT_METHOD')." ";?></strong></td>
				    			<td><?php if(!empty($processor_title)) {
				    				 echo $processor_title;?>
					    			<?php }else {
		    		 				 echo PayInvoiceHtml::_('payinvoicehtml.processors.edit', 'payinvoice_form[params][processor_id]', '', array('none'=>true, 'style' => 'class="input-medium"'));
		   					  		 }?>
		   					  	</td>
		   					  	<?php endif;?>
		   					 </tr>
				    	</table>
				   </div>
			</div>
	 	<div class="row-fluid">
	 		<form action="" method="post"  name="paynowForm" id="paynowForm" class="rb-validate-form">
	 			<div class="row-fluid">
	 				<div id="payinvoice-paynow-html"></div>
	 			</div>
	 			
	 			<div>&nbsp;</div>
	 			<div>&nbsp;</div>
	 			
				<div class="row-fluid">
					<?php echo $this->loadTemplate('terms');?>
				</div>
	 		</form>
	 	</div>
	</div>
</div>
</div>
<?php 
