<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
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
		      			<?php echo Rb_Text::_("COM_OSINVOICE_NUM"); ?>
		    		</th> 
					<th>
						<?php echo OSInvoiceHtml::_('grid.sort', "COM_OSINVOICE_PROCESSOR_ID", 'processor_id', 	$filter_order_Dir, $filter_order);?>
					</th>
					<th><?php echo OSInvoiceHtml::_('grid.sort', "COM_OSINVOICE_PROCESSOR_TYPE", 'type', 	$filter_order_Dir, $filter_order);?></th>
					<th><?php echo OSInvoiceHtml::_('grid.sort', "COM_OSINVOICE_PROCESSOR_TITLE", 'title', 	$filter_order_Dir, $filter_order);?></th>
					<th><?php echo OSInvoiceHtml::_('grid.sort', "COM_OSINVOICE_PUBLISHED", 'published', $filter_order_Dir, $filter_order);?></th>
				</tr>
			<!-- TABLE HEADER END -->
			</thead>
		
			<tbody>
			<?php $count= $limitstart;
				  foreach ($records as $record):?>
					<tr class="<?php echo "row".$count%2; ?>">
						<th class="default-grid-chkbox">
							<?php echo OSInvoiceHtml::_('grid.id', $count, $record->{$record_key} ); ?>
						</th>
						<td> <?php echo $count+1; ?> </td>	
						<td><?php echo OSInvoiceHtml::link($uri.'&task=edit&id='.$record->{$record_key}, $record->{$record_key}); ?></td>							
						<td><?php echo $record->type;?></td>
						<td><?php echo $record->title;?>
							<p class="muted"><?php echo $record->description;?></p>
						</td>
						<td><?php echo OSInvoiceHtml::_("rb_html.boolean.grid", $record, 'published', $count, 'tick.png', 'publish_x.png', '', $langPrefix='COM_OSINVOICE');?></td>
			
			<?php $count++;?>		
			<?php endforeach;?>
			</tbody>
  		</table>
  
		<input type="hidden" name="filter_order" value="<?php echo $filter_order;?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $filter_order_Dir;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
	</form>
