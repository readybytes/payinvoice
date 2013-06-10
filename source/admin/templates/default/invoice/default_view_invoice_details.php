<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}
JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
?>	

	<!-- START : Invoice Details -->
		<div class="row-fluid well well-large">					
			<div class="span6">		
				<div class="control-group">
					<?php echo $rb_invoice_fields['title']->label;?>
					<div class="controls"><?php echo $rb_invoice['title'];?></div>								
				</div>
				<div class="control-group">
					<?php echo $rb_invoice_fields['buyer_id']->label;?>
					<div class="controls"><?php echo $rb_invoice['buyer_id'];?></div>								
				</div>
				<div class="control-group">
					<?php echo $rb_invoice_fields['serial']->label;?>
					<div class="controls"><?php echo $rb_invoice['serial'];?></div>						
				</div>
			</div>
			
			<div class="span6">
				<div class="control-group">
					<?php echo $rb_invoice_fields['currency']->label;?>
					<div class="controls"><?php echo $rb_invoice['currency'];?></div>								
				</div>						
				<div class="control-group">
					<?php echo $rb_invoice_fields['issue_date']->label;?>
					<div class="controls"><?php echo $rb_invoice['issue_date'];?></div>								
				</div>
				<div class="control-group">
					<?php echo $rb_invoice_fields['due_date']->label;?>
					<div class="controls"><?php echo $rb_invoice['due_date'];?></div>								
				</div>
			</div>			
		</div>
		<!-- END : Invoice Details -->
		
		<!-- START : Item Table -->
			<?php echo $this->loadTemplate('view_items');?>		
		<!-- END : Item Table -->
		
		
		<!-- START : Total -->
<div class="row-fluid">
	<div class="span7"></div>
	<div class="span5">
		<dl class="dl-horizontal">
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_SUBTOTAL');?></dt>
		    <dd><?php echo $currency_symbol." ".number_format($rb_invoice['subtotal'],2);?></dd>
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_DISCOUNT');?></dt>
		    <dd><?php echo $currency_symbol." ".number_format($discount,2);?></dd>
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></dt>
		    <dd><?php echo number_format($tax, 2)." %";?></dd>
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?></dt>
		    <dd><?php echo $rb_invoice['processor_type'];?></dd>
		 </dl>
		 <hr>
		 
		 <dl class="dl-horizontal">
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TOTAL');?></dt>
		    <dd><?php echo $currency_symbol." ".number_format($rb_invoice['total'], 2);?></dd>
	    </dl>
	</div>
</div>	
			
	
