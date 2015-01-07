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

$items = array();
if(isset($invoice['params']['items'])){
	$items = $invoice['params']['items'];
}?>
	
<table border="1" width="100%"cellspacing="0" cellpadding="0" style="border-collapse: collapse;font:14px Georgia, Serif">
	<tbody>
		<tr>
			<th style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;width: 48%;"><?php echo JText::_('COM_PAYINVOICE_ITEMS');?></th>
			<th  style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;"><?php echo JText::_('COM_PAYINVOICE_QUANTITY');?></th>
			<th style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;"><?php echo JText::_('COM_PAYINVOICE_UNIT_PRICE');?></th>
			<th  style="font-size: 1em;padding-top: 12px;padding-bottom: 10px;background-color: #eee;"><?php echo JText::_('COM_PAYINVOICE_AMOUNT');?></th>
		</tr>
		<?php foreach ($items as $item) :
			$item  = is_array($item) ? (object)$item : $item ; ?>
		<tr>
			<td style="padding:10px 5px 5px 7px"><?php echo $item->title;?></td>
			<td style="padding:10px 5px 5px 7px"><?php echo $item->quantity;?></td>
			<td style="padding:10px 5px 5px 7px"><?php echo $rb_invoice['currency']." ".number_format($item->price, 2);?></td>
			<td style="padding:10px 5px 5px 7px"><?php echo $rb_invoice['currency']." ".number_format($item->total, 2);?></td>
		</tr>
		<?php endforeach;?>
		
		<tr>
			<td colspan="2" style="padding:10px 5px 5px 7px;border: 0;">&nbsp;</td>
			<td align="right" style="padding:10px 5px 10px 7px;border-right:0px;"><?php echo JText::_('COM_PAYINVOICE_SUBTOTAL');?></td>
			<td style="border-left:0px;">&nbsp;&nbsp;<?php echo $rb_invoice['currency']." ".number_format($subtotal, 2);?></td>
		</tr>
		<tr>
			<td colspan="2" style="padding:10px 5px 10px 7px;border: 0;">&nbsp;
			</td>
			<td align="right" style="padding:10px 5px 10px 7px;border-right:0px;"><?php echo JText::_('COM_PAYINVOICE_DISCOUNT');?></td>
			<td style="border-left:0px;">&nbsp;&nbsp;<?php echo $rb_invoice['currency']." ".number_format($discount, 2);?></td>
		</tr>
		
		<tr>
			<td colspan="2" style="padding:10px 5px 5px 7px;border: 0;">&nbsp;</td>
			<td align="right" style="padding:10px 5px 10px 7px;border-right:0px;"><?php echo JText::_('COM_PAYINVOICE_TAX');?></td>
			<td style="border-left:0px;">&nbsp;&nbsp;<?php echo number_format($tax, 2)." %";?></td>
		</tr>
		<tr>
			<td colspan="2" style="padding:10px 5px 10px 7px;border: 0;">&nbsp;
			</td>
			<td align="right"  style="padding:10px 5px 10px 7px;background-color:#eee;border-right:0px"><?php echo JText::_('COM_PAYINVOICE_TOTAL')?></td>
			<td style="border-left:0px;background-color:#eee;">&nbsp;&nbsp;<?php echo $rb_invoice['currency']." ".number_format($rb_invoice['total'], 2);?></td>
		</tr>
																
	</tbody>
</table>
