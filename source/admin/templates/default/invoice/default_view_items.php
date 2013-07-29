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
?>

<script type="text/javascript">
(function($){
	$(document).ready(function(){
		$('.payinvoice-invoice-item:first').hide();
	});	
})(payinvoice.jQuery);	
</script>
<?php 
$params = $invoice->getParams();
$items = array();
if(isset($params->items)){
	$items = $params->items;
}
?>

<!-- START : Item Table -->				
<div class="row-fluid">
 	<table class="table table-hover">
    	<thead>
			<tr>
				<th class="span5"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEMS');?></th>
				<th class="span2"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_QUANTITY');?></th>
				<th class="span2"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_PRICE_PER_UNIT');?></th>
				<th class="span2"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_PRICE_TOTAL');?></th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($items as $item) :?>
			<tr>
			    <td><?php echo $item->title;?></td>
			    <td><?php echo $item->quantity;?></td>
			    <td><?php echo $currency_symbol." ".number_format($item->price, 2);?></td>
			    <td><?php echo $currency_symbol." ".number_format($item->total, 2);?></td>
		    </tr>
		    <?php endforeach;?>
		</tbody>
	</table>
</div>
<?php 
