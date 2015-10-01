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
	<?php echo $this->loadTemplate('filter'); ?>
	<table class="table table-hover">
		<thead>
			<!-- TABLE HEADER START -->
			<tr>
				<th  width="1%" class="hidden-phone">
					<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
				</th>
				<th class="default-grid-sno hidden-phone">
					<?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_INVOICE_ID", 'object_id', 	$filter_order_Dir, $filter_order);?>
				</th>
				<th>
					<?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_INVOICE_TITLE", 'title', 	$filter_order_Dir, $filter_order);?>
				</th>
				<th>
					<?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_INVOICE_SERIAL", 'paid_date', 	$filter_order_Dir, $filter_order);?>
				</th>
				<th class="hidden-phone">
					<?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_INVOICE_BUYER", 'buyer_id', 	$filter_order_Dir, $filter_order);?>
				</th>				
				<th>
					<?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_INVOICE_TOTAL", 'total', 	$filter_order_Dir, $filter_order);?>
				</th>
				<th>
					<?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_INVOICE_STATUS", 'status', 	$filter_order_Dir, $filter_order);?>
				</th>
				<th>
					<?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_INVOICE_PAYMENT_METHOD", 'processor_type', 	$filter_order_Dir, $filter_order);?>
				</th>		
				<th><?php echo JText::_('COM_PAYINVOICE_INVOICE_EMAIL_SENT');?></th>
							
			</tr>
		<!-- TABLE HEADER END -->
		</thead>
		
		<tbody>
			<?php $count= $limitstart;
			  foreach ($records as $record):?>
			  
			  	<?php 
			  		// get the label color for each invoice	
					$status_css;
					$status = $record->status;
					switch ($status) {
						case PayInvoiceInvoice::STATUS_DUE :
								$status_css = "label-warning";
								break;
							
						case PayInvoiceInvoice::STATUS_PAID :
								$status_css = "label-success";
								break;
							
						case PayInvoiceInvoice::STATUS_INPROCESS:
								$status_css = "label-info";
								break;
							
						case PayInvoiceInvoice::STATUS_EXPIRED:
								$status_css = "label-danger";
								break;
							
						case PayInvoiceInvoice::STATUS_REFUNDED:
								$status_css = "label-default";
								break;
							
						default:
								$status_css = "label-primary";
								break;
					}
				?>
			  
				<tr class="<?php echo "row".$count%2; ?>">
				    <th class="default-grid-chkbox hidden-phone">
				    	<?php echo PayInvoiceHtml::_('grid.id', $count, $record->object_id ); ?>
				    </th>
					<td class="nowrap hidden-phone"><?php echo $record->object_id;?></td>
					<td><?php echo PayInvoiceHtml::link($uri.'&task=edit&id='.$record->object_id, $record->title.' ('.$record->serial.')');?> </td>
					<td><?php if(empty($record->invoice_serial))
							  {
							  		echo JText::_('COM_PAYINVOICE_NOT_APPLICABLE');
							  }
							  else
							  {
							  		echo $record->invoice_serial;
							  }
						?>
					</td>
                   	<td class="nowrap hidden-phone"><?php echo PayInvoiceHtml::link('index.php?option=com_payinvoice&view=buyer&task=edit&id='.$invoice[$record->invoice_id]->buyer_id, $invoice[$record->invoice_id]->buyer_id.'('.$buyer[$invoice[$record->invoice_id]->buyer_id]->name.')');?></td>
                    <td><?php echo number_format($invoice[$record->invoice_id]->total , 2);?></td>
                    <td><label class="label <?php echo $status_css?>"><?php echo JText::_($status_list[$invoice[$record->invoice_id]->status]);?></label></td>
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

