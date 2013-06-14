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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
?>	
<table class="table table-hover">
	<thead>
	<!-- TABLE HEADER START -->
		<tr>
				
			<th><?php echo Rb_Text::_('COM_PAYINVOICE_TRANSACTION_ID');?></th>
			<th><?php echo Rb_Text::_('COM_PAYINVOICE_TRANSACTION_AMOUNT');?>
			<th><?php echo Rb_Text::_('COM_PAYINVOICE_TRANSACTION_MESSAGE');?></th>
			<th><?php echo Rb_Text::_('COM_PAYINVOICE_TRANSACTION_CREATED_DATE');?></th>
		</tr>
		<!-- TABLE HEADER END -->
		</thead>
		<tbody>
		<?php foreach ($transactions as $transaction):?>
			<tr>
				<td><?php echo PayInvoiceHtml::link('index.php?option=com_payinvoice&view=transaction&task=edit&id='.$transaction->transaction_id, $transaction->transaction_id); ?></td>							
				<td><?php echo $transaction->amount;?></td>
				<td><?php echo Rb_Text::_($transaction->message);?></td>
				<td><?php echo $transaction->created_date;?></td>
			</tr>		
		<?php endforeach;?>
		</tbody>
    
</table>
<?php 

