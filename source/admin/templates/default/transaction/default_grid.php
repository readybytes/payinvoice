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
?>

<form action="<?php echo $uri; ?>" method="post" id="adminForm" name="adminForm">
	<?php echo $this->loadTemplate('filter'); ?>
	<table class="table table-hover">
		<thead>
			<!-- TABLE HEADER START -->
			<tr>
				<th  width="1%" class="hidden-phone">
					<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
				</th>
				
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_ID", 'transaction_id', $filter_order_Dir, $filter_order);?></th>
				<th class="hidden-phone"><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_BUYER", 'buyer_id', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_INVOICE_ID", 'invoice_id', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_AMOUNT", 'amount', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_PAYMENT_STATUS", 'payment_status', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_PAYMENT_METHOD", 'processor_type', $filter_order_Dir, $filter_order);?></th>				
				<th class="hidden-phone"><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_CREATED_DATE", 'created_date', $filter_order_Dir, $filter_order);?></th>
	
			</tr>
		<!-- TABLE HEADER END -->
		</thead>
		<tbody>
		<?php $count= $limitstart;
			  foreach ($records as $record):?>
				<tr class="<?php echo "row".$count%2; ?>">
				 	<th class="default-grid-chkbox nowrap hidden-phone">
				    	<?php echo PayInvoiceHtml::_('grid.id', $count, $record->{$record_key} ); ?>
				    </th>
					<td><?php echo PayInvoiceHtml::link($uri.'&task=edit&id='.$record->{$record_key}, $record->{$record_key}); ?></td>							
					<td class="nowrap hidden-phone"><?php echo PayInvoiceHtml::link('index.php?option=com_payinvoice&view=buyer&task=edit&id='.$record->buyer_id, $record->buyer_id.'('.$buyer[$record->buyer_id]->name.')');?>
					     </td>
					<td><?php echo PayInvoiceHtml::link('index.php?option=com_payinvoice&view=invoice&task=edit&id='.$invoice[$record->invoice_id]->object_id, $invoice[$record->invoice_id]->object_id.'('.$invoice[$record->invoice_id]->title.')');?></td>
					<td><?php echo $record->amount;?></td>
					<td><?php echo JText::_($statusList[$record->payment_status]);?></td>
					<td><?php echo $record->processor_type;?></td>					
					<td class="nowrap hidden-phone"><?php echo Rb_date::timeago($record->created_date);?></td>
			
		<?php $count++;?>		
		<?php endforeach;?>
		</tbody>
    
  </table>
 		<div class="row">
     		<div class="offset5 span7"><?php echo $pagination->getListFooter();?></div>
   		</div> 
    
			
	<input type="hidden" name="filter_order" value="<?php echo $filter_order;?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $filter_order_Dir;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
