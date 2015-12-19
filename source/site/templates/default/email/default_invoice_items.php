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

	$items	= array();
	$tasks	= array();
	$tasks	= $invoice['tasks'];
	$items	= $invoice['items'];
?>
	
<table border="1" width="100%"cellspacing="0" cellpadding="0" style="border-collapse: collapse;font:14px Georgia, Serif">
	<tbody>
	<?php if ($tasks):?>
		<tr>
			<th style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;width: 48%;"><?php echo JText::_('COM_PAYINVOICE_TASKS');?></th>
			<th  style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;"><?php echo JText::_('COM_PAYINVOICE_TASKS_RATE');?></th>
			<th  style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;"><?php echo JText::_('COM_PAYINVOICE_TASKS_HOURS');?></th>
			<th style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;"><?php echo JText::_('COM_PAYINVOICE_TAX');?></th>
			<th  style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;"><?php echo JText::_('COM_PAYINVOICE_LINE_TOTAL');?></th>
		</tr>
		 <?php foreach ($tasks as $task):?>
		 <tr>
			<td style="padding:10px 5px 5px 7px"><?php echo $task['title'];?></td>
			<td style="padding:10px 5px 5px 7px; text-align: center;"><?php echo number_format($task['unit_cost'], 2);?></td>
			<td style="padding:10px 5px 5px 7px; text-align: center;"><?php echo $task['quantity'];?></td>
			<td style="padding:10px 5px 5px 7px; text-align: center;"><?php echo number_format($task['tax'], 2);?></td>
			<td style="padding:10px 5px 5px 7px; text-align: center;"><?php echo number_format($task['line_total'], 2);?></td>
		</tr>
		<?php endforeach;
			  endif;?>
		<?php if ($items):?>
		<tr>
			<th style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;width: 48%;"><?php echo JText::_('COM_PAYINVOICE_ITEMS');?></th>
			<th  style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;"><?php echo JText::_('COM_PAYINVOICE_UNIT_COST');?></th>
			<th  style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;"><?php echo JText::_('COM_PAYINVOICE_QUANTITY');?></th>
			<th style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;"><?php echo JText::_('COM_PAYINVOICE_TAX');?></th>
			<th  style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;"><?php echo JText::_('COM_PAYINVOICE_AMOUNT');?></th>
		</tr>
		<?php foreach ($items as $item) : ?>
		<tr>
			<td style="padding:10px 5px 5px 7px"><?php echo $item['title'];?></td>
			<td style="padding:10px 5px 5px 7px; text-align: center;"><?php echo number_format($item['unit_cost'], 2);?></td>
			<td style="padding:10px 5px 5px 7px; text-align: center;"><?php echo $item['quantity'];?></td>
			<td style="padding:10px 5px 5px 7px; text-align: center;"><?php echo number_format($item['tax'], 2);?></td>
			<td style="padding:10px 5px 5px 7px; text-align: center;"><?php echo number_format($item['line_total'], 2);?></td>
		</tr>
		<?php endforeach;
			  endif;?>
		
		<tr>
			<td colspan="3" style="padding:10px 5px 5px 7px;border: 0;">&nbsp;</td>
			<td align="left" style="padding:10px 5px 10px 7px;border-right:0px;"><?php echo JText::_('COM_PAYINVOICE_SUBTOTAL');?></td>
			<td style="border-left:0px; text-align: center;">&nbsp;&nbsp;<?php echo number_format($subtotal, 2);?></td>
		</tr>
		
		<tr>
			<td colspan="3" style="padding:10px 5px 10px 7px;border: 0;">&nbsp;
			</td>
			<?php if($discount['is_percent']){?>
			<td align="left" style="padding:10px 5px 10px 7px;border-right:0px;"><?php echo JText::_('COM_PAYINVOICE_DISCOUNT')."(".$discount['value']."%)";?></td>
			<td style="border-left:0px; text-align: center;">&nbsp;&nbsp;<?php echo " - ".number_format($discount['amount'] , 2);?></td>
			<?php }else if(!empty($discount['amount'])){?>
			
			<td align="left" style="padding:10px 5px 10px 7px;border-right:0px;"><?php echo JText::_('COM_PAYINVOICE_DISCOUNT');?></td>
			<td style="border-left:0px; text-align: center;">&nbsp;&nbsp;<?php echo " - ".number_format($discount['amount'], 2);?></td>
			<?php }else{?>
			<td align="left" style="padding:10px 5px 10px 7px;border-right:0px;"><?php echo JText::_('COM_PAYINVOICE_DISCOUNT');?></td>
			<td style="border-left:0px; text-align: center;">&nbsp;&nbsp;<?php echo number_format($discount['amount'], 2);?></td>
			<?php }?>
		</tr>				 
		
		
		<tr>
			<td colspan="3" style="padding:10px 5px 5px 7px;border: 0;">&nbsp;</td>
			<td align="left" style="padding:10px 5px 10px 7px;border-right:0px;"><?php echo JText::_('COM_PAYINVOICE_TAX')."(".number_format($tax,2)."%)";?></td>
			<td style="border-left:0px; text-align: center;">&nbsp;&nbsp;<?php echo number_format($tax_amount, 2);?></td>
		</tr>
		<tr>
			<td colspan="3" style="padding:10px 5px 10px 7px;border: 0;">&nbsp;
			</td>
			<td align="left"  style="padding:10px 5px 10px 7px;background-color:#eee;border-right:0px"><?php echo JText::_('COM_PAYINVOICE_TOTAL')?></td>
			<td style="border-left:0px;background-color:#eee; text-align: center;">&nbsp;&nbsp;<?php echo $rb_invoice['currency']." ".number_format($rb_invoice['total'], 2);?></td>
		</tr>
																
	</tbody>
</table>
