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
?>
<script type="text/javascript">
(function($){

	<?php if($invoice->getId()) :?>
		var osi_invoice_items = <?php echo json_encode($invoice->getParams()->items);?>;
	<?php else : ?>
		var osi_invoice_items = [];
	<?php endif;?>
	
	$(document).ready(function(){

		$('.osi-invoice-item:first').hide();

		for(var e in osi_invoice_items){
			if(osi_invoice_items.hasOwnProperty(e)){
				manipulate(osi_invoice_items[e].title, osi_invoice_items[e].quantity, osi_invoice_items[e].price, osi_invoice_items[e].total);
			}
		}

		// XITODO : move to admin.js
		function manipulate(item_description, quantity, price, total)
		{
			var counter = $('#osi-invoice-item-add').attr('counter'); 
			var html = $('.osi-invoice-item:first').html();
			html = html.replace(/##counter##/g, counter);
			html = html.replace(/##item_description##/g, item_description);
			html = html.replace(/##quantity##/g, quantity);
			html = html.replace(/##price##/g, price);

			if(total == ''){
				total = '0.00';
			}
			
			html = html.replace(/##total##/g, total);
			$('<div class="osi-invoice-item">' + html + '</div>').appendTo('.osi-invoice-items').show();
			$('#osi-invoice-item-add').attr('counter', parseInt(counter) + 1);
			return false;
		}
		
		$('#osi-invoice-item-add').click(function(){
			
			manipulate('', '', '' , '0.00');
			return false;
						
		});

		$('.osi-invoice-item_remove').live('click', function(){

			$(this).parents('.osi-invoice-item').remove();
			return false;
			
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