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
?>	

	<!-- START : Invoice Details -->
<fieldset class="form">
	<div class="well well-large">
		<div class="row-fluid">					
			<div class="span6">		
				<div class="control-group">
					<strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_TITLE');?></strong>
					<div class="controls"><?php echo $rb_invoice['title'];?></div>								
				</div>
				<div class="control-group">
					<strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_BUYER_ID');?></strong>
					<div class="controls"><?php echo $rb_invoice['buyer_id']. '('.$buyer->getBuyername().')';?></div>								
				</div>
				<div class="control-group">
				<strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_REFERENCE_NUMBER');?></strong>
					<div class="controls"><?php echo $rb_invoice['serial'];?></div>						
				</div>
			</div>
			
			<div class="span5">
				<div class="control-group">
					<strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_CURRENCY');?></strong>
					<div class="controls"><?php echo $rb_invoice['currency'];?></div>								
				</div>						
				<div class="control-group">
					<strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_ISSUE_DATE');?></strong>
					<div class="controls"><?php echo $rb_invoice['issue_date'];?></div>								
				</div>
				<div class="control-group">
					<strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_PAID_DATE');?></strong>
					<div class="controls"><?php echo $rb_invoice['paid_date'];?></div>								
				</div>
			</div>			
		</div>
	</div>
</fieldset>	
		<!-- END : Invoice Details -->
		
		<!-- START : Item Table -->
			<?php echo $this->loadTemplate('view_items');?>		
		<!-- END : Item Table -->
		
		
		<!-- START : Total -->
<div class="row-fluid">
	<div class="span7"></div>
	<div class="span5 pull-right">
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
    				<td><?php echo " - ".$discount['amount'];?></td>
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
    			<tr>
			    	<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?></strong></td>
			    	<td><?php echo ucfirst($rb_invoice['processor_type']);?></td>
			</tr>
			<tr>
			    	<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TOTAL');?></strong></td>
			    	<td><strong><?php echo $currency_symbol." ".number_format($rb_invoice['total'], 2);?></strong></td>
			</tr>
		</table>
	</div>
</div>	
<?php		
	
