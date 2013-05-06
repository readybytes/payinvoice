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

$params = $invoice->getParams();;
?>
<script type="text/javascript">
(function($){

	<?php if($invoice->getId() && isset($params->items)) :?>
		var payinvoice_invoice_items = <?php echo json_encode($params->items);?>;
	<?php else : ?>
		var payinvoice_invoice_items = [];
	<?php endif;?>
	
	$(document).ready(function(){

		$('.payinvoice-invoice-item:first').hide();

		for(var e in payinvoice_invoice_items){
			if(payinvoice_invoice_items.hasOwnProperty(e)){
				payinvoice.admin.invoice.item.add(payinvoice_invoice_items[e].title, payinvoice_invoice_items[e].quantity, payinvoice_invoice_items[e].price, payinvoice_invoice_items[e].total);
			}
		}
		payinvoice.admin.invoice.item.calculate_total();
		
		$('#payinvoice-invoice-item-add').click(function(){			
			payinvoice.admin.invoice.item.add('', '', '' , '0.00');
			return false;						
		});

		$('.payinvoice-invoice-item_remove').live('click', function(){
			$(this).parents('.payinvoice-invoice-item').remove();
			payinvoice.admin.invoice.item.calculate_total();
			return false;			
		});

		$('.payinvoice-item-quantity').live('blur', function(){
			var quantity = parseFloat($(this).val());
			var price 	 = parseFloat($(this).parents('.payinvoice-invoice-item').find('.payinvoice-item-price').val());
			var total 	 = quantity * price;

			if(!isNaN(parseFloat(total))){
				total = parseFloat(total).toFixed(2)
			}
			else{
				total = '0.00';
			}
			
			$(this).parents('.payinvoice-invoice-item').find('.payinvoice-item-total').val(total);
			payinvoice.admin.invoice.item.calculate_total();
		});

		$('.payinvoice-item-price').live('blur', function(){
			var price	 = parseFloat($(this).val());
			var quantity = parseFloat($(this).parents('.payinvoice-invoice-item').find('.payinvoice-item-quantity').val());
			var total 	 = quantity * price;

			if(!isNaN(parseFloat(total))){
				total = parseFloat(total).toFixed(2)
			}
			else{
				total = '0.00';
			}
			
			$(this).parents('.payinvoice-invoice-item').find('.payinvoice-item-total').val(total);
			payinvoice.admin.invoice.item.calculate_total();
		});

		$('#payinvoice-invoice-discount').blur(function(){
			payinvoice.admin.invoice.item.calculate_total();
		});

		$('#payinvoice-invoice-tax').blur(function(){
			payinvoice.admin.invoice.item.calculate_total();
		});
	});
	
})(payinvoice.jQuery);

</script>

<!-- START : Item Table -->				
<h3><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEMS' ); ?></h3>
<hr>
<!--  ONE ITEM -->
<div class="payinvoice-invoice-items">
	
</div>

<div class="row-fluid">
	<button type="button" class="btn btn-small btn-success" id="payinvoice-invoice-item-add" counter="0"><i class="icon-plus"></i><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_ADD')?></button>
</div>