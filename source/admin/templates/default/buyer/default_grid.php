<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHtml::_('behavior.framework');
?>

<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm">
  <table class="table table-hover">
    <thead>
		<!-- TABLE HEADER START -->
			<tr>
				<th  width="1%" class="hidden-phone">
					<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
				</th>		
				<th class="default-grid-sno hidden-phone">
          			<?php echo Rb_Text::_("COM_PAYINVOICE_NUM"); ?>
        		</th> 
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_BUYER_ID", 'buyer_id', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_BUYER_NAME", 'name', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayInvoiceHtml::_('grid.sort', "COM_PAYINVOICE_BUYER_EMAIL",'email', $filter_order_Dir, $filter_order);?></th>
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
					<td class="nowrap hidden-phone"><?php echo $count+1; ?> </td>	
					<td><?php echo PayInvoiceHtml::link($uri.'&task=edit&id='.$record->{$record_key}, $record->{$record_key}); ?></td>							
					<td><?php echo $record->name;?></td>
					<td><?php echo $record->email;?></td>
					</tr>
			
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
