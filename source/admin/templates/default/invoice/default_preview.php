<?php
/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$config_data['company_name']	= isset($config_data['company_name']) 		? $config_data['company_name'] 		: "";
$config_data['company_address']	= isset($config_data['company_address']) 	? $config_data['company_address']	: "";
$config_data['company_phone']	= isset($config_data['company_phone'])		? $config_data['company_phone']		: "";
?>
      
<div class="row-fluid">
	<div>&nbsp;</div>
	<div id="payinvoice-invoice-preview" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="myModalLabel"><?php echo JText::_('Invoice Preview');?></h3>
    	</div>

   	 	<div class="modal-body">
   		 	<div class="container-fluid">
   		 			<div>
						<?php if(!$applicable){?>
							<div class="center label <?php echo $statusbutton['class']?> status-display"><h4><?php echo $statusbutton['status']?></h4></div>
						<?php }else {?>
							<div class="center label status-display">
								<i class="pull-right icon-question-sign" title='<?php echo $applicable['message']?>'></i><h4><i class='icon-lock'></i>&nbsp;<?php echo $applicable['title']?></h4></div>
						<?php }?>
					</div>
				<div class="pi-payinvoice-header-layout">
   	  	 	 	<div class="row-fluid ">
   		 	 		<div class="span7">
						<address>
							<strong><?php echo $config_data['company_name'];?></strong><br>
							<?php echo $config_data['company_address'];?> <br>
							<?php if(!empty($config_data['company_phone'])):?>
							<abbr title="Phone"><?php echo JText::_('COM_PAYINVOICE_COMPANY_PHONE_NO');?></abbr>&nbsp;<?php echo $config_data['company_phone'];?>
							<?php endif;?>
						</address>
					</div>
					<div class="span5 pull-right text-right">
				   		<?php if(!empty($config_data['company_logo'])):?>
				   			<img class="img-rounded" alt="" src="<?php echo JUri::root(true).$config_data['company_logo'];?>">
			   			<?php endif;?>
			   		</div>
				</div>
   	 	<hr>
	   	 		<div class="row-fluid">
					<div class="span7 pull-left">
						<address>
							<?php echo $buyer->getBuyername(); ?><br/>
							<?php echo $buyer->getEmail();?><br/>
							<?php if(!empty($buyer_address)):?>
							<?php echo $buyer_address; ?><br/>
							<?php endif;?>
							<?php if(!empty($buyer_country)):?>
							<?php echo $buyer_country;?><br/>
							<?php endif;?>
							<?php if(!empty($tax_number)):?>
							<?php echo "<b>".JText::_('COM_PAYINVOICE_BUYER_TAX_NUMBER')."</b> : ".$tax_number;?><br/>
							<?php endif;?>
						</address>
					</div>
					<div class="span5 pull-right pi-payinvoice-default-details">
					   	<table class="table">
							<tr>
								<td class="text-right"><?php echo JText::_('COM_PAYINVOICE_INVOICE_NUMBER');?></td>
								<td><?php echo " : ";?></td>
								<td><?php echo $rb_invoice['serial'];?></td>
							</tr>
							<tr>
								<td class="text-right"><?php echo JText::_('COM_PAYINVOICE_INVOICE_ISSUE_DATE');?></td>
								<td><?php echo " : ";?></td>
									<?php $issue_date = new Rb_Date($rb_invoice['issue_date']);?>
								<td><?php echo $this->getHelper('format')->date($issue_date);?></td>
							</tr>
							<tr>
						        <?php if ($statusbutton['status'] == JText::_('COM_PAYINVOICE_INVOICE_STATUS_PAID')){
								$paid_date = new Rb_Date($rb_invoice['paid_date']);?>
								<td class="text-right"><?php echo JText::_('COM_PAYINVOICE_INVOICE_PAID_DATE');?></td>
								<td><?php echo " : ";?></td>
								<td><?php echo $this->getHelper('format')->date($paid_date);?></td>
								<?php }
							     else{
								$due_date = new Rb_Date($rb_invoice['due_date']);?>
								<td class="text-right"><?php echo JText::_('COM_PAYINVOICE_INVOICE_DUE_DATE');?></td>
								<td><?php echo " : ";?></td>
								<td><?php echo $this->getHelper('format')->date($due_date);?></td>
								<?php }?>
							</tr>
						</table>
					</div>
				</div>
			</div>
				<!--Load Item's table-->
				<?php echo $this->loadTemplate('view_items');?>
	
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
								<div class="span12">
										<table class="table">
											<tr>
										    	<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_SUBTOTAL');?></strong></td>
										    	<td><?php echo $subtotal;?></td>
										    </tr>
										    <?php if($discount['is_percent']){?>
											<tr>
								    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_DISCOUNT')."(".$discount['value']."%)";?></strong></td>
								    			<td><?php echo " - ".number_format($discount['amount'] , 2);?></td>
								    		</tr>
								    		<?php }else if(!empty($discount['amount'])){?>
								    		<tr>
								    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_DISCOUNT');?></strong></td>
								    			<td><?php echo $discount['amount'];?></td>
								    		</tr>
								    		<?php }else{?>
								    		<tr>
								    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_DISCOUNT');?></strong></td>
								    			<td><?php echo $discount['amount'];?></td>
								    		</tr>
								    		<?php }?>
										    <tr>
										    	<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX')."(".number_format($tax,2)."%)";?></strong></td>
										    	<td><?php echo number_format($tax_amount, 2);?></td>
										    </tr>
										    <?php if ($late_fee['status']):?>
								    		<tr>
								    			<?php if ($late_fee['percentage']){?>
								    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_LATE_FEE')." (".$late_fee['value']."%)";?></strong></td>
								    			<td><?php echo number_format($late_fee['amount'], 2);?></td>
								    			<?php }else{?>
								    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_LATE_FEE');?></strong></td>
								    			<td><?php echo number_format($late_fee['amount'], 2);?></td>
								    			<?php }?>
								    		</tr>
								    		<?php endif;?>
								    		<?php if ($rb_invoice['processor_type']):?>
								    		<tr>
										    	<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?></strong></td>
										    	<td><?php echo ucfirst($rb_invoice['processor_type']);?></td>
										    </tr>
										    <?php endif;?>
										    <tr>
										    	<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TOTAL');?></strong></td>
										    	<td><strong><?php echo $currency_symbol." ".number_format($rb_invoice['total'], 2);?></strong></td>
											</tr>
							
										<?php if($rb_invoice['total'] != floatval(0) && $rb_invoice['status'] == PayInvoiceInvoice::STATUS_DUE):?>
										<tr>
										<td><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?></td>
										<td><?php if(!empty($rb_invoice['processor_type'])){?>
											<?php echo ucfirst($rb_invoice['processor_type']);?>
											<?php	 }else {
										 				echo PayInvoiceHtml::_('payinvoicehtml.processors.edit', 'payinvoice_form[params][processor_id]', '', array('none'=>true, 'style' => 'class="input-small"'));
							   					  	 }?>
							   			</td>
							   			<?php endif;?>
						   			</tr>
			   						</table>
							</div>
					</div>
				</div>	

				</div>
		
				<?php 	$invoiceParams	= $invoice->getParams();?>
				<?php 	if(!empty($invoiceParams->terms_and_conditions)):?>
				<div class="row-fluid">
					<div>
						<p><strong><?php echo " ".JText::_('COM_PAYINVOICE_INVOICE_TERMS_AND_CONDITIONS');?></strong></p>
						<?php echo JString::substr(strip_tags($invoiceParams->terms_and_conditions), 0, 340); ?>			
					</div>
				</div> 
				<?php endif;?>
				<div>
					<?php if (!empty($rb_invoice['notes'])):?>
					<p><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_NOTES')." :";?></strong></p>
					<p><?php echo $rb_invoice['notes'];?></p>
					<?php endif;?>
				</div>
   				</div>
   				
   				<div class="modal-footer">
	    			<a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_PAYINVOICE_CLOSE');?></a>
    			</div>			
			</div>	
	    </div>
<?php 
