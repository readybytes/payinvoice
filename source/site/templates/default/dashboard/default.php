<?php

/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<?php if (!PayInvoiceFactory::getUser()->id) :?>
	<div class="well well-large">
		<div class="page-header">
			<h2 class="text-center"><?php echo Rb_Text::_('COM_PAYINVOICE_ACCESS_PROHIBITED');?></h2>
			<h3 class="text-center"><small><?php echo Rb_Text::_('COM_PAYINVOICE_PLEASE_LOGIN_TO_SEE_YOUR_INVOICES');?></small></h3>
		</div>
	</div>
<?php else :?>

<div class="container-fluid">
	<div class="row-fluid page-header">
		<h2><?php echo Rb_Text::_('COM_PAYINVOICE_MY_INVOICES');?></h2>
	</div>
	<table class="table">
	<thead>
			<tr>
				<th class="span2"><span><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE');?></span></th>
				<th class="span2"><span><?php echo Rb_Text::_('COM_PAYINVOICE_DUE_ON');?></span></th>
				<th class="span2"><span><?php echo Rb_Text::_('COM_PAYINVOICE_PAID_ON');?></span></th>
				<th class="span2"><span><?php echo Rb_Text::_('COM_PAYINVOICE_PAYMENT_METHOD');?></span></th>
				<th class="span2"><span><?php echo Rb_Text::_('COM_PAYINVOICE_AMOUNT');?></span></th>
				<th class="span2"><span><?php echo Rb_Text::_('COM_PAYINVOICE_STATUS')?></span></th>
				<th class="span1"></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($invoices as $invoice) : ?>
		<?php $class = '';?>
		<?php 	if($invoice->status == PayInvoiceInvoice::STATUS_PAID || $invoice->status == PayInvoiceInvoice::STATUS_REFUNDED){
					$class  = 'label-success';
				}
				elseif ($invoice->status == PayInvoiceInvoice::STATUS_DUE){
					$class  = 'label-warning';
				}else {
					$class  = 'label-info';
				} ?>
				
				<tr>
					<td class="span2">
						<span><a target="_blank" href="<?php echo $payurls[$invoice->invoice_id];?>"><?php echo $invoice->serial;?></a></span><br/>
					</td>
					
					<td class="span2">
						<?php $due_date = new Rb_Date($invoice->due_date);?>
						<span><?php echo $this->getHelper('format')->date($due_date);?></span>
					</td>
					
					<td class="span2">
						<?php $paid_date = new Rb_Date($invoice->paid_date);?>
						<span><?php echo $this->getHelper('format')->date($paid_date);?></span>
					</td>
					
					<td>
						<span><?php if($invoice->processor_type){
										echo $invoice->processor_type;
									} else {
										echo Rb_Text::_('None');
									}?>
						</span></td>
					
					<td class="span2"><span><?php echo $invoice->total; ?></span></td>
					<td class="span2"><span class="label <?php echo $class;?>"><?php echo Rb_Text::_($status_list[$invoice->status]); ?></span></td>
					<td class="span1">
						<?php $url = PayInvoiceRoute::_('index.php?option=com_payinvoice&view=pdfexport&action=sitePdfAction&invoice_id='.$invoice->invoice_id);?>
						<a href="<?php echo $url; ?>">
							<i class="icon-download-alt"></i>
						</a>						
					</td>
				</tr>
		<?php endforeach;?>
		</tbody>
	</table>	
</div>
<?php endif; 
