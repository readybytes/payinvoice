<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
} ?>

<form action="<?php echo $uri; ?>" method="post" id="adminForm" name="adminForm">
	<table class="table table-hover">
		<thead>
			<!-- TABLE HEADER START -->
			<tr>
				<th  width="1%">
					<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
				</th>
				
				<th class="default-grid-sno">
          			<?php echo Rb_Text::_("COM_PAYINVOICE_NUM"); ?>
        		</th>
				
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_ID", 'transaction_id', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_BUYER", 'buyer_id', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_INVOICE_ID", 'invoice_id', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_AMOUNT", 'amount', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_PAYMENT_STATUS", 'payment_status', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_MESSAGE", 'message', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_TRANSACTION_CREATED_DATE", 'created_date', $filter_order_Dir, $filter_order);?></th>
	
			</tr>
		<!-- TABLE HEADER END -->
		</thead>
		<tbody>
		<?php $count= $limitstart;
			  foreach ($records as $record):?>
				<tr class="<?php echo "row".$count%2; ?>">
				 	<th class="default-grid-chkbox">
				    	<?php echo PayInvoiceHtml::_('grid.id', $count, $record->{$record_key} ); ?>
				    </th>
					<td> <?php echo $count+1; ?> </td>	
					<td><?php echo PayInvoiceHtml::link($uri.'&task=edit&id='.$record->{$record_key}, $record->{$record_key}); ?></td>							
					<td><?php echo PayInvoiceHtml::link('index.php?option=com_payinvoice&view=buyer&task=edit&id='.$record->buyer_id, $record->buyer_id.'('.$buyer[$record->buyer_id]->name.')');?>
					     </td>
					<td><?php echo PayInvoiceHtml::link('index.php?option=com_payinvoice&view=invoice&task=edit&id='.$invoice[$record->invoice_id]->object_id, $invoice[$record->invoice_id]->object_id.'('.$invoice[$record->invoice_id]->title.')');?></td>
					<td><?php echo $record->amount;?></td>
					<td><?php echo Rb_Text::_($statusList[$record->payment_status]);?></td>
					<td><?php echo Rb_Text::_($record->message);?></td>
					<td><?php echo $record->created_date;?></td>
			
		<?php $count++;?>		
		<?php endforeach;?>
		</tbody>
    
  </table>
			
	<input type="hidden" name="filter_order" value="<?php echo $filter_order;?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $filter_order_Dir;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
