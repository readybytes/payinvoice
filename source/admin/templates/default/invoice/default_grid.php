<?php

/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<form action="<?php echo $uri; ?>" method="post" id="adminForm" name="adminForm">
	<table class="table table-hover">
		<thead>
			<!-- TABLE HEADER START -->
			<tr>
				<th  width="1%" class="hidden-phone">
					<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
				</th>
				<th class="default-grid-sno hidden-phone">
					<?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_INVOICE_ID", 'invoice_id', 	$filter_order_Dir, $filter_order);?>
				</th>
				<th><?php echo JText::_('COM_PAYINVOICE_INVOICE_TITLE');?></th>
				<th class="hidden-phone"><?php echo JText::_('COM_PAYINVOICE_INVOICE_BUYER');?></th>				
				<th><?php echo JText::_('COM_PAYINVOICE_INVOICE_TOTAL');?></th>
				<th><?php echo JText::_('COM_PAYINVOICE_INVOICE_STATUS');?></th>
				<th><?php echo JText::_("COM_PAYINVOICE_INVOICE_PAYMENT_METHOD");?></th>		
				<th><?php echo JText::_('COM_PAYINVOICE_INVOICE_EMAIL_SENT');?></th>
							
			</tr>
		<!-- TABLE HEADER END -->
		</thead>
		
		<tbody>
			<?php $count= $limitstart;
			  foreach ($records as $record):?>
				<tr class="<?php echo "row".$count%2; ?>">
				    <th class="default-grid-chkbox hidden-phone">
				    	<?php echo PayInvoiceHtml::_('grid.id', $count, $record->{$record_key} ); ?>
				    </th>
					<td class="nowrap hidden-phone"><?php echo $record->invoice_id;?></td>
					<td><?php echo PayInvoiceHtml::link($uri.'&task=edit&id='.$record->{$record_key}, $invoice[$record->invoice_id]->title.' ('.$invoice[$record->invoice_id]->serial.')');?> </td>
                   	<td class="nowrap hidden-phone"><?php echo PayInvoiceHtml::link('index.php?option=com_payinvoice&view=buyer&task=edit&id='.$invoice[$record->invoice_id]->buyer_id, $invoice[$record->invoice_id]->buyer_id.'('.$buyer[$invoice[$record->invoice_id]->buyer_id]->name.')');?></td>
                    <td><?php echo $invoice[$record->invoice_id]->total;?></td>
                    <td><?php echo JText::_($status_list[$invoice[$record->invoice_id]->status]);?></td>
					<td><?php 	if(!empty($invoice[$record->invoice_id]->processor_type)){
                    				echo $invoice[$record->invoice_id]->processor_type;
                    			}else {
                    				echo JText::_('JNONE');
                    			}?>
                    </td>
                    <td>
						<?php 	$params = json_decode($record->params);
                    			$class 	= 'icon-unpublish';
				            	if(isset($params->emailSent) && $params->emailSent){
				            		$class = 'icon-publish';
				            	}?>
                    	<span class="<?php echo $class;?>"></span>
                    </td>
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

