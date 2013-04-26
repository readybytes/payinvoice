<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}
?>
<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm">
     
<fieldset class="form-horizontal">
  	<div class="row-fluid"> 
    	<div class="span6">
		     <h2><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_DETAILS' ); ?></h2><hr>
	      	<div class="control-group">
				<div class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_ID' ); ?></div>
				<div class="controls"><?php echo $transaction['transaction_id']; ?></div>	
			 </div>		
			 
			<div class="control-group">
				<div class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_INVOICE' ); ?> </div>
				<div class="controls"><?php echo OSInvoiceHtml::link('index.php?option=com_osinvoice&view=invoice&task=edit&id='.$invoice[$transaction['invoice_id']]->object_id, $invoice[$transaction['invoice_id']]->object_id.'('.$invoice[$transaction['invoice_id']]->title.')');?></div>
			
			</div>	
		
			<div class="control-group">
				<div class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_BUYER' ); ?> </div>
				<div class="controls"><?php echo OSInvoiceHtml::link('index.php?option=com_osinvoice&view=buyer&task=edit&id='.$transaction['buyer_id'], $transaction['buyer_id'].'('.$buyer[$transaction['buyer_id']]->name.')'); ?></div>	
			 </div>	
							   
		   <div class="control-group">
				<div class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_PROCESSOR' ); ?> </div>
				<div class="controls"><?php echo $transaction['processor_type']; ?></div>	
		   </div>	

 			<div class="control-group">
				<div class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_GATEWAY_TXN_ID' ); ?> </div>
				<div class="controls"><?php echo $transaction['gateway_txn_id']; ?></div>	
		   </div>	
	
			<div class="control-group">
				<div class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_GATEWAY_PARENT_TXN' ); ?> </div>
				<div class="controls"><?php echo $transaction['gateway_parent_txn']; ?></div>	
			 </div>	
			 
			 <div class="control-group">
				<div class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_GATEWAY_SUBSCRIPTION_ID' ); ?> </div>
				<div class="controls"><?php echo $transaction['gateway_subscr_id']; ?></div>	
			 </div>
			 
			 <div class="control-group">
				<div class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_AMOUNT' ); ?> </div>
				<div class="controls"><?php echo $transaction['amount']; ?></div>	
			 </div>

			<div class="control-group">
				<div class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_CREATED_DATE' ); ?> </div>
				<div class="controls"><?php echo $transaction['created_date']; ?></div>	
			 </div>
			 
			 <div class="control-group">
				<div class="control-label"><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_MESSAGE' ); ?> </div>
				<div class="controls"><?php echo $transaction['message']; ?></div>	
			 </div>
		</div>
			
			<div class="span6">
				<h2><?php echo Rb_Text::_('COM_OSINVOICE_TRANSACTION_PARAMS'); ?></h2><hr>
				<?php foreach ($transaction['params'] as $key => $value):?>
					 <div class="control-group">
						<div class="control-label"><?php echo $key;?> </div>
						<div class="controls"><?php echo $value; ?></div>	
					 </div>
				<?php endforeach;?>
			</div> 
	</div>
</fieldset>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="1" />
</form>
<?php 		
