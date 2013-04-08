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

$params = $invoice->getParams();;
?>
<script type="text/javascript">
(function($){

	<?php if($invoice->getId() && isset($params->items)) :?>
		var osi_invoice_items = <?php echo json_encode($params->items);?>;
	<?php else : ?>
		var osi_invoice_items = [];
	<?php endif;?>
	
	$(document).ready(function(){

		$('.osi-invoice-item:first').hide();

		for(var e in osi_invoice_items){
			if(osi_invoice_items.hasOwnProperty(e)){
				osinvoice.admin.invoice.item.add(osi_invoice_items[e].title, osi_invoice_items[e].quantity, osi_invoice_items[e].price, osi_invoice_items[e].total);
			}
		}
		osinvoice.admin.invoice.item.calculate_total();
		
		$('#osi-invoice-item-add').click(function(){			
			osinvoice.admin.invoice.item.add('', '', '' , '0.00');
			return false;						
		});

		$('.osi-invoice-item_remove').live('click', function(){
			$(this).parents('.osi-invoice-item').remove();
			osinvoice.admin.invoice.item.calculate_total();
			return false;			
		});

		$('.osi-item-quantity').live('blur', function(){
			var quantity = parseFloat($(this).val());
			var price 	 = parseFloat($(this).parents('.osi-invoice-item').find('.osi-item-price').val());
			var total 	 = quantity * price;

			if(!isNaN(parseFloat(total))){
				total = parseFloat(total).toFixed(2)
			}
			else{
				total = '0.00';
			}
			
			$(this).parents('.osi-invoice-item').find('.osi-item-total').val(total);
			osinvoice.admin.invoice.item.calculate_total();
		});

		$('.osi-item-price').live('blur', function(){
			var price	 = parseFloat($(this).val());
			var quantity = parseFloat($(this).parents('.osi-invoice-item').find('.osi-item-quantity').val());
			var total 	 = quantity * price;

			if(!isNaN(parseFloat(total))){
				total = parseFloat(total).toFixed(2)
			}
			else{
				total = '0.00';
			}
			
			$(this).parents('.osi-invoice-item').find('.osi-item-total').val(total);
			osinvoice.admin.invoice.item.calculate_total();
		});

		$('#osi-invoice-discount').blur(function(){
			osinvoice.admin.invoice.item.calculate_total();
		});

		$('#osi-invoice-tax').blur(function(){
			osinvoice.admin.invoice.item.calculate_total();
		});
	});
	
})(osinvoice.jQuery);

</script>

<!-- START : Item Table -->				
<h3><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_EDIT_ITEMS' ); ?></h3>
<hr>
<!--  ONE ITEM -->
<div class="osi-invoice-items">
	
</div>

<div class="row-fluid">
	<button type="button" class="btn btn-small btn-success" id="osi-invoice-item-add" counter="0"><i class="icon-plus"></i><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_EDIT_ITEM_ADD')?></button>
</div>