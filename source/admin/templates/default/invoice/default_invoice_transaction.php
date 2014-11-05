<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');

// Get Transaction status list
$statusList = Rb_EcommerceAPI::response_get_status_list();
?>	
<table class="table table-hover">
	<thead>
	<!-- TABLE HEADER START -->
		<tr>	
			<th><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_ID');?></th>
			<th><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_AMOUNT');?></th>
			<th><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_PAYMENT_STATUS');?></th>
		</tr>
		<!-- TABLE HEADER END -->
		</thead>
		<tbody>
		<?php foreach ($transactions as $transaction):?>
			<tr>
				<td><?php echo PayInvoiceHtml::link('index.php?option=com_payinvoice&view=transaction&task=edit&id='.$transaction->transaction_id, $transaction->transaction_id); ?></td>							
				<td><?php echo $transaction->amount;?></td>
				<td><?php echo JText::_($statusList[$transaction->payment_status]);?></td>
			</tr>		
		<?php endforeach;?>
		</tbody>
    
</table>
<?php 

