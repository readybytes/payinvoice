<?php

/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

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
    <div class="row-fluid">		  
		  <?php echo $this->loadTemplate('header');?>
		  <?php echo $this->loadTemplate('details');?><br>
		  <?php echo $this->loadTemplate('items');?>
	 	
	 	<div class="row-fluid">
	 		<div class="span7"></div>
	 		
	 		<div class="span5">
 		 		<dl class="dl-horizontal pull-right">
				    <dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_SUBTOTAL');?></dt>
				    <dd><?php echo $currency." ". number_format($subtotal, 2);?></dd>
				    <dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_DISCOUNT');?></dt>
				    <dd><?php echo $discount;?></dd>
				    <dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></dt>
				    <dd><?php echo number_format($tax, 2)." %";?></dd><hr>
			     	<dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TOTAL');?></dt>
				    <dd><?php echo $currency." ".number_format($rb_invoice['total'], 2);?></dd><br>
					<!-- Payment method-->
	  				<?php if($valid && $rb_invoice['total'] != floatval(0) && $rb_invoice['status'] == PayInvoiceInvoice::STATUS_DUE):?>  
				    <dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?></dt>
			    	<dd><?php if(!empty($processor_title)) {
			    				 echo $processor_title;?>
				    	<?php }else {
	    		 				 echo PayInvoiceHtml::_('payinvoicehtml.processors.edit', 'payinvoice_form[params][processor_id]', '', array('none'=>true, 'style' => 'class="input-medium"'));
	   					  	 }?>
				 	</dd>
				 	<?php endif;?>
			 	</dl>
	 		</div>
	 	</div>
	 	
	 	<?php if($valid && $rb_invoice['total'] != floatval(0) && $rb_invoice['status'] == PayInvoiceInvoice::STATUS_DUE):?>  
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
	 	 <?php endif;?>
		
 	</div>
</div>
<?php 
