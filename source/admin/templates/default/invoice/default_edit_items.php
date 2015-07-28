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

		for(var e in payinvoice_invoice_items){
			if(payinvoice_invoice_items.hasOwnProperty(e)){
				payinvoice.admin.invoice.item.add(payinvoice_invoice_items[e].title, payinvoice_invoice_items[e].quantity, payinvoice_invoice_items[e].price, payinvoice_invoice_items[e].total);
			}
		}
		payinvoice.admin.invoice.calculate_total();
		
		$('#payinvoice-invoice-item-add').click(function(){			
			payinvoice.admin.invoice.item.add('', '', '' , '0.00');
			return false;						
		});

		$(document).on('click', '.payinvoice-invoice-item_remove',function(){
			$(this).parents('.payinvoice-invoice-item').remove();
			payinvoice.admin.invoice.calculate_total();
			return false;			
		});

		$(document).on('blur', '.payinvoice-item-quantity',function(){
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
			payinvoice.admin.invoice.calculate_total();
		});

		$(document).on('blur','.payinvoice-item-price', function(){
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
			payinvoice.admin.invoice.calculate_total();
		});

		$('#payinvoice-invoice-discount').blur(function(){
			payinvoice.admin.invoice.calculate_total();
		});

		$('#payinvoice-invoice-tax').blur(function(){
			payinvoice.admin.invoice.calculate_total();
		});
	});
	
})(payinvoice.jQuery);

</script>

<!-- START : Item Table -->				
<h3><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEMS' ); ?></h3>
<hr>
<!--  ONE ITEM -->
<div class="payinvoice-invoice-items">
	
</div>
<?php 