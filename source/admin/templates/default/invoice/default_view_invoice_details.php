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

	<!-- START : Invoice Details -->
<fieldset class="form">
	<div class="well well-large">
		<div class="row-fluid">					
			<div class="span6">		
				<div class="control-group">
					<strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_TITLE');?></strong>
					<div class="controls"><?php echo $rb_invoice['title'];?></div>								
				</div>
				<div class="control-group">
					<strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_BUYER_ID');?></strong>
					<div class="controls"><?php echo $rb_invoice['buyer_id']. '('.$buyer->getBuyername().')';?></div>								
				</div>
				<div class="control-group">
				<strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_SERIAL');?></strong>
					<div class="controls"><?php echo $rb_invoice['serial'];?></div>						
				</div>
			</div>
			
			<div class="span5">
				<div class="control-group">
					<strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_CURRENCY');?></strong>
					<div class="controls"><?php echo $rb_invoice['currency'];?></div>								
				</div>						
				<div class="control-group">
					<strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_ISSUE_DATE');?></strong>
					<div class="controls"><?php echo $rb_invoice['issue_date'];?></div>								
				</div>
				<div class="control-group">
					<strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_DUE_DATE');?></strong>
					<div class="controls"><?php echo $rb_invoice['due_date'];?></div>								
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
	<div class="span4">
		<dl class="dl-horizontal pull-right">
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_SUBTOTAL');?></dt>
		    <dd><?php echo $currency_symbol." ".number_format($subtotal, 2);?></dd>
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_DISCOUNT');?></dt>
		    <dd><?php echo $currency_symbol." ".number_format($discount,2);?></dd>
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></dt>
		    <dd><?php echo number_format($tax, 2)." %";?></dd>
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?></dt>
		    <dd><?php echo ucfirst($rb_invoice['processor_type']);?></dd><hr> 
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TOTAL');?></dt>
		    <dd><?php echo $currency_symbol." ".number_format($rb_invoice['total'], 2);?></dd>
		 </dl>
	</div>
</div>	
<?php		
	
