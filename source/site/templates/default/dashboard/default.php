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
<div class="pi-invoice-dashboard-wraper">
<div class="container-fluid">
    <div class="row-fluid pi-invoice-header-margin">
		<p class="lead text-center"><?php echo Rb_Text::_('COM_PAYINVOICE_MY_INVOICES');?></p>
	</div>
	<table class="table table-hover pi-invoice-item ">
		<thead>
			<tr>
				
				<th class="span2"><span><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE');?></span></th>
				<th class="span2 hidden-phone"><span><?php echo Rb_Text::_('COM_PAYINVOICE_DUE_ON');?></span></th>
				<th class="span2 hidden-phone"><span><?php echo Rb_Text::_('COM_PAYINVOICE_PAID_ON');?></span></th>
				<th class="span2 hidden-phone"><span><?php echo Rb_Text::_('COM_PAYINVOICE_PAYMENT_METHOD');?></span></th>
				<th class="span2"><span><?php echo Rb_Text::_('COM_PAYINVOICE_AMOUNT');?></span></th>
				<th class="span1 center"><span><?php echo Rb_Text::_('COM_PAYINVOICE_STATUS')?></span></th>
				<th class="span1"><span class="hidden-phone"><?php ?></span></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($invoices as $invoice) :?>
			<?php $class = '';?>
			<?php 	if($invoice->status == PayInvoiceInvoice::STATUS_PAID){
					$class  = 'label label-success';
				}
				elseif ($invoice->status == PayInvoiceInvoice::STATUS_DUE){
					$class  = 'label label-warning';
				}elseif($invoice->status == PayInvoiceInvoice::STATUS_REFUNDED){
					$class  = "label label-default";
				}
				else {
					$class  = 'label label-info';
				} ?>
			<tr>
				<td class="span1">
					<span><a href="<?php echo $payurls[$invoice->invoice_id];?>"><?php echo $invoice->serial;?></a></span><br/>
				</td>
					
				<td class="span2 hidden-phone">
					<span><?php 
						if ($invoice->status == PayInvoiceInvoice::STATUS_PAID){
							echo Rb_Text::_('COM_PAYINVOICE_STATUS_NULL');	
						}
						else{
							$due_date = new Rb_Date($invoice->due_date);
							echo $this->getHelper('format')->date($due_date);
						}?>
					</span>
				</td>
				<td class="span2 hidden-phone">
					<span><?php 
						if ($invoice->status == PayInvoiceInvoice::STATUS_DUE){
							echo Rb_Text::_('COM_PAYINVOICE_STATUS_NULL');	
						}
						else{
							$paid_date = new Rb_Date($invoice->paid_date);
							echo $this->getHelper('format')->date($paid_date);
						}?>
					</span>
				</td>
				<td class="span2 hidden-phone">
					<span><?php
						if($invoice->processor_type){
							echo $invoice->processor_type;
						} else {
							echo Rb_Text::_('None');
						}?>
					</span>
				</td>
				<td class="span2"><span><?php $formatHelper	= $this->getHelper('format');
								$currency  	= $formatHelper->getCurrency($invoice->currency, 'symbol');
	 							echo $currency." ".number_format($invoice->total, 2); ?>
	 							</span>
	 			</td>
				<td class="span2"><span class="span12 center label <?php echo $class;?>"><strong class="line-height"><?php echo Rb_Text::_($status_list[$invoice->status]); ?></strong></span>
					<?php if ($invoice->status == PayInvoiceInvoice::STATUS_PAID){
						$paid_date = new Rb_Date($invoice->paid_date);?>
						<div class="text-center visible-phone"><?php echo $this->getHelper('format')->date($paid_date);?></div>
						<?php }
							else {
							$due_date = new Rb_Date($invoice->due_date);?>
							<div class="text-center visible-phone"><?php echo $this->getHelper('format')->date($due_date);?></div>
						<?php }?>
				</td>
				<td class="span1 center">
					<?php $url = PayInvoiceRoute::_('index.php?option=com_payinvoice&view=pdfexport&action=sitePdfAction&invoice_id='.$invoice->object_id);?>
					<a title="download invoice" href="<?php echo $url;  ?>">
						<i class="icon-download-alt"></i>
					</a>						
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>	
</div>
</div>
<?php endif; 
