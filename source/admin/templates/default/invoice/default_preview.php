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
						<dl class="dl-horizontal pull-right">
							<dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_SUBTOTAL');?></dt>
							<dd><?php echo $currency_symbol." ".$subtotal;?></dd>
							<dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_DISCOUNT');?></dt>
							<dd><?php echo $discount;?></dd>
							<dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></dt>
							<dd><?php echo $tax." %";?></dd><hr>
							<dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TOTAL');?></dt>
							<dd><?php echo $currency_symbol." ".number_format($rb_invoice['total'], 2);?></dd><br>
							<?php if($valid):?>
							<dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?></dt>
							<dd><?php if(!empty($rb_invoice['processor_type'])){?>
								<?php echo ucfirst($rb_invoice['processor_type']);?>
								<?php	 }else {
							 				echo PayInvoiceHtml::_('payinvoicehtml.processors.edit', 'payinvoice_form[params][processor_id]', '', array('none'=>true, 'style' => 'class="input-small"'));
				   					  	 }?>
				   			</dd>
				   			<?php endif;?>
			   			</dl>
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
