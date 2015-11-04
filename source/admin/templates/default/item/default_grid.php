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
				<th><?php echo JText::_('COM_PAYINVOICE_ITEM_ID');?></th>
				<th><?php echo JText::_('COM_PAYINVOICE_ITEM_TITLE');?></th>
				<th><?php echo JText::_('COM_PAYINVOICE_ITEM_TYPE');?></th>
			</tr>
		</thead>
		<tbody>
			<?php $count= $limitstart;
			  foreach ($records as $record):?>
			  
			  <tr class="<?php echo "row".$count%2; ?>">
				    <th class="default-grid-chkbox hidden-phone">
				    	<?php echo PayInvoiceHtml::_('grid.id', $count, $record->{$record_key} ); ?>
				    </th>
					<td><?php echo $record->item_id;?></td>
					<td><?php echo PayInvoiceHtml::link($uri.'&task=edit&id='.$record->{$record_key}, $record->title);?> </td>
					<td><?php echo $record->type;?></td>
			<?php $count++;?>		
			<?php endforeach;?>
			</tr>
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
<?php 
