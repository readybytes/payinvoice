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

$config_data['company_name']	= isset($config_data['company_name']) 		? $config_data['company_name'] 		: "";
$config_data['company_address']	= isset($config_data['company_address']) 	? $config_data['company_address']	: "";
$config_data['company_phone']	= isset($config_data['company_phone'])		? $config_data['company_phone']		: "";
?>
      
<div class="row-fluid">
	<div>&nbsp;</div>
	<div id="payinvoice-invoice-preview" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="myModalLabel"><?php echo Rb_Text::_('Invoice Preview');?></h3>
    	</div>

   	 	<div class="modal-body">
   		 	<div class="container-fluid">
   		 	 	<div class="row-fluid">	
					<div class="row-fluid well well-small">
			  		 	<div class="span8">
					  	 <address>
							<strong><?php echo $config_data['company_name'];?></strong><br>
							<?php echo $config_data['company_address'];?> <br>
							<?php if(!empty($config_data['company_phone'])):?>
							<abbr title="Phone"><?php echo Rb_Text::_('COM_PAYINVOICE_COMPANY_PHONE_NO');?></abbr>&nbsp;<?php echo $config_data['company_phone'];?>
							<?php endif;?>
						</address>
			  	 		</div>	
			  	 		
			  	 		<div class="span2"></div>	
			  	 		   
			   			<div class="span2">
				   			<?php if(!empty($config_data['company_logo'])):?>
				   				<img src="<?php echo Rb_HelperTemplate::mediaURI($config_data['company_logo'], false);?>">
			   				<?php endif;?>
		   				</div>
					</div>
				</div>
   	 	
	   	 		<div class="row-fluid">
					<div class="span8"><h5><?php echo $rb_invoice['serial'];?> : <?php echo $rb_invoice['title'];?></h5></div>
						<?php if(!$applicable){?>
						<div class="span4"><?php echo $statusbutton;?></div>	
						<?php }else { ?>
						<div class="span4"><?php echo $applicable;?></div>	
						<?php }?>
				</div>
				<hr>
				<div class="row-fluid">
					<div class="span5">
					    <ul class="unstyled">
							<li><strong><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_NAME');?></strong></li>
							<li><?php echo $buyer->getBuyername();?></li>
							<li><strong><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_EMAIL');?></strong></li>
							<li><?php echo $buyer->getEmail(); ?></li>
							<li><strong><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_ADDRESS');?></strong></li>
							<li><?php echo $buyer->getAddress().",".$buyer->getCity(); ?></li>
							<li><strong><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_TAX_NUMBER');?></strong></li>
							<li><?php echo $buyer->getTaxnumber(); ?></li>
						</ul>
					</div>
					
					<div class="span2"></div>
	   
			   		<div class="span5">
							 <ul class="unstyled">    
									<li><strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_ISSUE_DATE');?></strong></li>
									<li><?php echo $rb_invoice['created_date'];?></li>		    			    
									<li><strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_DUE_DATE');?></strong></li>
									<li><?php echo $rb_invoice['due_date'];?></li>		    
							</ul>
					</div>
				</div>
	
				<!--Load Item's table-->
				<?php echo $this->loadTemplate('view_items');?>
	
				<div class="row-fluid">
					<div class="span7"></div>
					<div class="span5">
						<dl class="dl-horizontal pull-right">
							<dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_SUBTOTAL');?></dt>
							<dd><?php echo $currency_symbol." ".number_format($subtotal,2);?></dd>
							<dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_DISCOUNT');?></dt>
							<dd><?php echo $currency_symbol." ".number_format($discount,2);?></dd>
							<dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></dt>
							<dd><?php echo number_format($tax, 2)." %";?></dd><hr>
							<dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TOTAL');?></dt>
							<dd><?php echo $currency_symbol." ".number_format($rb_invoice['total'], 2);?></dd><br>
							<?php if($valid):?>
							<dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?></dt>
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
					<div class="well well-small">
						<h5><input type="checkbox" name="terms-and-conditions"><?php echo " ".Rb_Text::_('COM_PAYINVOICE_INVOICE_TERMS_AND_CONDITIONS');?></h5>
						<?php echo JString::substr(strip_tags($invoiceParams->terms_and_conditions), 0, 340); ?>			
					</div>
				</div> 
				<?php endif;?>
		
   				</div>			
			</div>

    		<div class="modal-footer">
	    		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo Rb_Text::_('COM_PAYINVOICE_CLOSE');?></a>
    		</div>
	    </div>
</div>
<?php 