<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<?php 
	$items = array();
	if(isset($payinvoice_invoice['params']['items'])){
		$items = $payinvoice_invoice['params']['items'];
	}

?>
<div class="row">
 	<table class="table table-hover">
    	<thead>
			<tr>
				<th><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEMS');?></th>
				<th><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_QUANTITY');?></th>
				<th><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_PRICE_PER_UNIT');?></th>
				<th><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_PRICE_TOTAL');?></th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($items as $item) :?>
			<tr>
			    <td><?php echo $item->title;?></td>
			    <td><?php echo $item->quantity;?></td>
			    <td><?php echo $currency." ".number_format($item->price, 2);?></td>
			    <td><?php echo $currency." ".number_format($item->total, 2);?></td>
		    </tr>
		    <?php endforeach;?>
		</tbody>
	</table>
</div>
<?php 