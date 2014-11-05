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

<?php 
	$items = array();
	if(isset($payinvoice_invoice['params']['items'])){
		$items = $payinvoice_invoice['params']['items'];
	}

?>
<div class="row-fluid">
 	<table class="table table-bordered">
    	<thead>
			<tr>
				<th class="span5"><span><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEMS');?></span></th>
				<th class="span2"><span class="pull-right"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_QUANTITY');?></span></th>
				<th class="span2"><span class="pull-right"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_PRICE_PER_UNIT');?></span></th>
				<th class="span3"><span class="pull-right"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_PRICE_TOTAL');?></span></th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($items as $item) :
				$item  = is_array($item) ? (object)$item : $item ; ?>
			<tr>
			    <td class="span5"><span><?php echo $item->title;?></span></td>
			    <td class="span2"><span class="pull-right"><?php echo $item->quantity;?></span></td>
			    <td class="span2"><span class="pull-right"><?php echo $currency." ".number_format($item->price, 2);?></span></td>
			    <td class="span3"><span class="pull-right"><?php echo $currency." ".number_format($item->total, 2);?></span></td>
		    </tr>
		    <?php endforeach;?>
		</tbody>
	</table>
</div>
<?php 