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

$params = $invoice->getParams();
if(is_object($invoice)){
		//$data =  (array) $invoice;
		$data = $invoice->toArray();
}
$component_name = $this->_component->getNameSmall();
?>
<script type="text/javascript">
(function($){
	
	<?php if($invoice->getId() && (isset($data['items']) ) || isset($data['tasks']) ) :?>
		var payinvoice_invoice_items = <?php echo json_encode($data['items']);?>;
		var payinvoice_invoice_tasks = <?php echo json_encode($data['tasks']);?>;
	<?php else : ?>
		var payinvoice_invoice_items = [];
		var payinvoice_invoice_tasks = [];
	<?php endif;?>
	
	$(document).ready(function(){

		$('.payinvoice-invoice-item:first').hide();

		for(var e in payinvoice_invoice_items){
			if(payinvoice_invoice_items.hasOwnProperty(e)){
				payinvoice.admin.invoice.item.add(payinvoice_invoice_items[e].item_id,payinvoice_invoice_items[e].title, payinvoice_invoice_items[e].quantity, payinvoice_invoice_items[e].unit_cost, payinvoice_invoice_items[e].tax, payinvoice_invoice_items[e].line_total);
			}
		}

		$('.payinvoice-invoice-task:first').hide();
		
		for(var e in payinvoice_invoice_tasks){
			if(payinvoice_invoice_tasks.hasOwnProperty(e)){
				payinvoice.admin.invoice.addtask(payinvoice_invoice_tasks[e].item_id, payinvoice_invoice_tasks[e].title, payinvoice_invoice_tasks[e].quantity, payinvoice_invoice_tasks[e].unit_cost, payinvoice_invoice_tasks[e].tax, payinvoice_invoice_tasks[e].line_total);
			}
		}
		
		payinvoice.admin.invoice.calculate_total();

		//add new item row in invoice		
		$('#payinvoice-invoice-item-add').click(function(){			
			payinvoice.admin.invoice.item.add('', '', '' , '', '0.00');
			return false;						
		});

		//add new task row in invoice
		$(document).on('click', '#payinvoice-invoice-task-add',function(){
			payinvoice.admin.invoice.addtask('', '', '' , '', '0.00');
			return false;			
		});

		$(document).on('change',  "select",function(){
			var counter		 = $(this).attr('data-counter');
			var element_id	 = $(this).attr('id');
			var data_type 	 = $(this).attr('data-type');
			var item_id  	 = $(this).val();
//			for(i=counter-1;i>=0;i--)
//			{	
//				//restriction for select item can't select again
//				if($('#payinvoice_formitems'+i+'item_id option:selected').val() == item_id)
//				{
//					alert('<?php echo JText::_('COM_PAYINVOICE_INVOICE__RESTRICTION_FOR_REUSE_ITEM' ); ?>');
//					$('#payinvoice_formitems'+counter+'item_id option:first').attr('selected', 'true');
//					return false;
//				}
//				if($('#payinvoice_formtasks'+i+'item_id option:selected').val() == item_id)
//				{
//					alert('<?php echo JText::_('COM_PAYINVOICE_INVOICE__RESTRICTION_FOR_REUSE_ITEM' ); ?>');
//					$('#payinvoice_formtasks'+counter+'item_id option:first').attr('selected', 'true');
//					return false;
//				}
//				
//			}
						
			if(item_id == '#addnew')
			{
				payinvoice.admin.invoice.addNewItem.showModal(data_type,element_id);
				return false;		
			}
			
			payinvoice.admin.invoice.on_item_change(item_id, element_id);
			return false;			
		});

		//for give css to option list
		$(".input-medium option[value='#addnew']").css({"background-color": "#5bb75b" , "color": "#fff", "padding": "6px 4px", "font-size": "16px"}); 
		
		$(document).on('click', '.payinvoice-invoice-item_remove',function(){
			$(this).parents('.payinvoice-invoice-item').remove();
			payinvoice.admin.invoice.calculate_total();
			return false;			
		});

		$(document).on('click', '.payinvoice-invoice-task_remove',function(){
			$(this).parents('.payinvoice-invoice-task').remove();
			payinvoice.admin.invoice.calculate_total();
			return false;			
		});

		$(document).on('blur', '.payinvoice-item-quantity',function(){
			var quantity = parseFloat($(this).val());
			var price 	 = parseFloat($(this).parent().parent().siblings().find('.payinvoice-item-price').val());
			var tax 	 = parseFloat($(this).parent().parent().siblings().find('.payinvoice-item-tax').val());
			var total 	 = (quantity * price) + quantity * price * tax * 0.01;

			if(!isNaN(parseFloat(total))){
				total = parseFloat(total).toFixed(2);
			}
			else{
				total = '0.00';
			}
			
			$(this).parent().parent().siblings().find('.payinvoice-item-total').val(total);
			payinvoice.admin.invoice.calculate_total();
		});

		$(document).on('blur','.payinvoice-item-price', function(){
			var price	 = parseFloat($(this).val());
			var quantity = parseFloat($(this).parent().parent().siblings().find('.payinvoice-item-quantity').val());
			var tax 	 = parseFloat($(this).parent().parent().siblings().find('.payinvoice-item-tax').val());
			var total 	 = quantity * price + quantity * price * tax * 0.01;
			
			if(!isNaN(parseFloat(total))){
				total = parseFloat(total).toFixed(2)
			}
			else{
				total = '0.00';
			}
			
			$(this).parent().parent().siblings().find('.payinvoice-item-total').val(total);
			payinvoice.admin.invoice.calculate_total();
		});

		$(document).on('blur','.payinvoice-item-tax', function(){
			var tax	 = parseFloat($(this).val());
			var quantity = parseFloat($(this).parent().parent().siblings().find('.payinvoice-item-quantity').val());
			var price 	 = parseFloat($(this).parent().parent().siblings().find('.payinvoice-item-price').val());
			
			var total	= quantity * price + quantity * price * tax * 0.01;
			
			if(!isNaN(parseFloat(total))){
				total = parseFloat(total).toFixed(2)
			}
			else{
				total = '0.00';
			}
			
			$(this).parent().parent().siblings().find('.payinvoice-item-total').val(total);
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
<!-- Task Table -->
<h3><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_TASKS' ); ?></h3>
<div class="row-fluid pi-invoice-wraper-item">
	<table class="table" cellpadding="0" cellspacing="0" style="width: 100%;">
		<thead>
		<tr>
			<th class="span3 center"><?php echo JText::_('COM_PAYINVOICE_INVOICE_TITLE');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_TASK_RATE');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_HOURS');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_LINE_TOTAL');?></th>
			<th class="span1"></th>
		</tr>
	</thead>
</table>
</div>
<!-- ONE TASK -->

<div class="payinvoice-invoice-tasks">


</div>
<!-- button : add task table -->

	<div class="row-fluid">
		<button type="button" class="btn btn-small btn-success" id="payinvoice-invoice-task-add" counter="0"><i class="icon-plus"></i><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TASK')?></button>
	</div>
<div>
<hr>
</div>

<!-- START : Item Table -->				
<h3><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEMS' ); ?></h3>
<div class="row-fluid pi-invoice-wraper-item">
<table class="table table-striped" cellpadding="0" cellspacing="0" style="width: 100%;">
	<thead>
		<tr>
			<th class="span3 center"><?php echo JText::_('COM_PAYINVOICE_INVOICE_TITLE');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_ITEM_UNIT_COST');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_QUANTITY');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_LINE_TOTAL');?></th>
			<th class="span1"></th>
		</tr>
	</thead>
	</table>
</div>

<!--  ONE ITEM -->
<div class="payinvoice-invoice-items">
	
</div>
<?php 