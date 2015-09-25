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
	$tasks = array();
	if(isset($payinvoice_invoice['items'])){
		$items = $payinvoice_invoice['items'];
	}
	if(isset($payinvoice_invoice['tasks'])){
		$tasks = $payinvoice_invoice['tasks'];
	}

?>
<div class="pi-invoice-item-layout">
<div class="row-fluid ">
	<?php if (!empty($tasks)):?>
	<table class="table table-striped pi-invoice-item-table-layout">
    	<thead>
			<tr class="pi-invoice-item" >
				<td class="span4"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_TASKS');?></td>
				<td class="span2 hidden-phone"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_RATE');?></td>
				<td class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_HOURS');?></td>
				<td class="span2 hidden-phone"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></td>
				<td class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_PRICE_LINE_TOTAL');?></td>
			</tr>
		</thead>	
		<tbody>
			<?php foreach ($tasks as $task) :
				$task  = is_array($task) ? (object)$task : $task ; ?>
			<tr>
			    <td class="span4"><?php echo $task->title;?></td>
			    <td class="span2 hidden-phone"><?php echo number_format($task->unit_cost,2);?></td>
			    <td class="span2"><?php echo $task->quantity;?></td>
			    <td class="span2 hidden-phone"><?php echo number_format($task->tax, 2);?></td>
			    <td class="span2"><?php echo number_format($task->line_total, 2);?></td>
		    </tr>
		    <?php endforeach;?>
		</tbody>
	</table>
	<?php endif;?>
 	<table class="table table-striped pi-invoice-item-table-layout">
    	<thead>
			<tr class="pi-invoice-item">
				<td class="span4"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEMS');?></td>
				<td class="span2 hidden-phone"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_UNIT_COST');?></td>
				<td class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_QUANTITY');?></td>
				<td class="span2 hidden-phone"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></td>
				<td class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_PRICE_LINE_TOTAL');?></td>
			</tr>
		</thead>	
		<tbody>
			<?php foreach ($items as $item) :
				$item  = is_array($item) ? (object)$item : $item ; ?>
			<tr>
			    <td class="span4"><?php echo $item->title;?></td>
			    <td class="span2 hidden-phone"><?php echo number_format($item->unit_cost, 2);?></td>
			    <td class="span2"><?php echo $item->quantity;?></td>
			    <td class="span2 hidden-phone"><?php echo number_format($item->tax, 2);?></td>
			    <td class="span2"><?php echo number_format($item->line_total, 2);?></td>

		    </tr>
		    <?php endforeach;?>
		</tbody>
	</table>
</div>
</div>
<?php 