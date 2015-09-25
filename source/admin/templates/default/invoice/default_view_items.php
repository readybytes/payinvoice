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

	$items	= array();
	$tasks	= array();
	$tasks	= $invoiceArray['tasks'];
	$items	= $invoiceArray['items'];

?>
<!-- START : Task Table -->
<div class="pi-invoice-wraper-item">
<div class="row-fluid">
<?php if ($tasks):?>

	<table class="table table-striped" cellpadding="0" cellspacing="0" style="width: 100%;">
		<thead>
		<tr>
			<th class="span4"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_TASKS');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_TASK_RATE');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_HOURS');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_LINE_TOTAL');?></th>
	    </tr>
	   </thead>
	   <tbody>
	   <?php foreach ($tasks as $task):?>
	   	<tr>
	   		<td class="span4"><?php echo $task['title'];?></td>
	   		<td class="span2"><?php echo $task['unit_cost'];?></td>
	   		<td class="span2"><?php echo $task['quantity'];?></td>
	   		<td class="span2"><?php echo $task['tax'];?></td>
	   		<td class="span2"><?php echo $task['line_total'];?></td>
	   	</tr>
	   <?php endforeach;?>
	   </tbody>
</table>
<hr>
<?php endif;?>

<!-- START : Item Table -->				
<?php if ($items):?>

	<table class="table table-striped" cellpadding="0" cellspacing="0" style="width: 100%;">
		<thead>
		<tr>
			<th class="span4"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEMS');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_TASK_RATE');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_HOURS');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></th>
			<th class="span2"><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_LINE_TOTAL');?></th>
	    </tr>
	   </thead>
	   <tbody>
	   <?php foreach ($items as $item):?>
	   	<tr>
	   		<td class="span4"><?php echo $item['title'];?></td>
	   		<td class="span2"><?php echo $item['unit_cost'];?></td>
	   		<td class="span2"><?php echo $item['quantity'];?></td>
	   		<td class="span2"><?php echo $item['tax'];?></td>
	   		<td class="span2"><?php echo $item['line_total'];?></td>
	   	</tr>
	   <?php endforeach;?>
	   </tbody>
</table>
<?php endif;?>

</div>
</div>
<?php 
