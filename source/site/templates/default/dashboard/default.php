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
			<h2 class="text-center"><?php echo XiText::_('Access Prohibited.');?></h2>
			<h3 class="text-center"><small><?php echo XiText::_('Please login to see your Invoices.');?></small></h3>
		</div>
	</div>
<?php else :?>

<div class="container-fluid">
	<div class="row-fluid page-header">
		<h2><?php echo XiText::_('My Invoices');?></h2>
	</div>
	<table class="table">
	<thead>
			<tr>
				<th class="span2"><span><?php echo Rb_Text::_('Invoice #');?></span></th>
				<th class="span2"><span><?php echo Rb_Text::_('Due On');?></span></th>
				<th class="span2"><span><?php echo Rb_Text::_('Paid On');?></span></th>
				<th class="span2"><span><?php echo Rb_Text::_('Payment Method');?></span></th>
				<th class="span2"><span><?php echo Rb_Text::_('Amount');?></span></th>
				<th class="span2"><span><?php echo Rb_Text::_('Status')?></span></th>
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
						<a href="index.php?option=com_payinvoice&view=pdfexport&action=sitePdfAction&invoice_id=<?php echo $invoice->invoice_id; ?>">
							<i class="icon-download-alt"></i>
						</a>						
					</td>
				</tr>
		<?php endforeach;?>
		</tbody>
	</table>	
</div>
<?php endif; 
