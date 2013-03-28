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
} 
JHtml::_('behavior.framework');
?>

<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm">
  <table class="table table-hover">
    <thead>
		<!-- TABLE HEADER START -->
			<tr>
				<th  width="1%">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($records); ?>);" />
				</th>		
				<th class="default-grid-sno">
          			<?php echo Rb_Text::_("COM_OSINVOICE_BUYER_NUM"); ?>
        		</th> 
				<th><?php echo Rb_Html::_('grid.sort', "COM_OSINVOICE_BUYER_ID", 'buyer_id', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo Rb_Html::_('grid.sort', "COM_OSINVOICE_BUYER_NAME", 'name', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo Rb_Html::_('grid.sort', "COM_OSINVOICE_BUYER_EMAIL",'email', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo Rb_Text::_("COM_OSINVOICE_BUYER_INVOICES");?></th>				
			</tr>
		<!-- TABLE HEADER END -->
		</thead>
		
		<tbody>
		<?php $count= $limitstart;
			  foreach ($records as $record):?>
				<tr class="<?php echo "row".$count%2; ?>">
				    <th class="default-grid-chkbox">
				    	<?php echo Rb_Html::_('grid.id', $count, $record->{$record_key} ); ?>
				    </th>
					<td> <?php echo $count+1; ?> </td>	
					<td><?php echo Rb_Html::link($uri.'&task=edit&id='.$record->{$record_key}, $record->{$record_key}); ?></td>							
					<td><?php echo $record->name;?></td>
					<td><?php echo $record->email;?></td>
					<td><?php echo ""; ?></td>
			
		<?php $count++;?>		
		<?php endforeach;?>
		</tbody>
    
  </table>
  
	<input type="hidden" name="filter_order" value="<?php echo $filter_order;?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $filter_order_Dir;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
