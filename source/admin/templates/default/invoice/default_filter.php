<?php
/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayInvoice
* @subpackage	Frontend
*/
if(defined('_JEXEC')===false) die();?>
<?php $attr = array(); ?>
<div class="container-fluid well">
	<div class="row-fluid">

		<div class="span1 hidden-phone">&nbsp;</div>
		<div class="span11">

			<div class="span12">
			
			<div class="span2 hidden-phone" style="min-width: 170px;">
				<label><?php echo JText::_('COM_PAYINVOICE_GRID_FILTER_DUE_DATE');?></label>
				<div>
					<?php $attr['style'] = "width:89px;"; ?>
					<?php echo PayinvoiceHtml::_('payinvoicehtml.range.filter', 'due_date', 'invoice', $filters, 'date', 'filter_payinvoice', $attr);?>
				</div>
			</div>
			
			<div class="span2 hidden-phone" style="min-width: 170px;">
				<label><?php echo JText::_('COM_PAYINVOICE_INVOICE_GRID_PAID_DATE');?></label>
				<div>
					<?php $attr['style'] = "width:89px;"; ?>
					<?php echo PayinvoiceHtml::_('payinvoicehtml.range.filter', 'paid_date', 'invoice', $filters, 'date', 'filter_payinvoice', $attr);?>
				</div>
			</div>
			
			<div class="span2 hidden-tablet hidden-phone" style="min-width: 140px;">
				<div class="row-fluid">
					<label><?php echo JText::_('COM_PAYINVOICE_TOTAL');?></label>
					<?php echo PayinvoiceHtml::_('payinvoicehtml.range.filter', 'total', 'invoice', $filters, 'text', 'filter_payinvoice', $attr);?>
				</div>
			</div>
			
			<div class="span2" style="min-width: 100px;">		
				<div class="row-fluid">
					<label><?php echo JText::_('COM_PAYINVOICE_USER_GRID_FILTER_USERNAME');?></label>
					<?php $attr['style'] = 'class="pi-filter-width"';?>
					<?php echo PayinvoiceHtml::_('payinvoicehtml.text.filter', 'username', 'invoice', $filters, 'filter_payinvoice', $attr);?>
				</div>
			</div>
			
			<div class="span1" style="min-width: 140px;">				
				<div class="row-fluid">
					<label><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_GRID_FILTER_INVOICE_TITLE');?></label>
					<?php $attr['style'] ='class="pi-filter-width"';?>
					<div><?php echo PayinvoiceHtml::_('payinvoicehtml.text.filter', 'title', 'invoice', $filters, 'filter_payinvoice', $attr);?></div>
				</div>
			</div>
			
			<div class="span2" style="min-width: 100px;">				
				<div class="row-fluid">
					<label><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_PAYMENT_STATUS');?></label>
					<?php $attr['style'] ='class="pi-filter-width"';?>
					<?php echo PayinvoiceHtml::_('payinvoicehtml.status.filter', 'status', 'invoice', $filters, 'invoice', 'filter_payinvoice', $attr);?>
				</div>
				<div class="row-fluid">
					<label><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_GRID_FILTER_GATEWAY');?></label>
					<?php $attr['style'] ='class="pi-filter-width"';?>
					<div><?php echo PayinvoiceHtml::_('payinvoicehtml.processortypes.filter', 'processor_type', 'invoice', $filters, 'payment', 'filter_payinvoice', $attr);?></div>
				</div>
			</div>

			<div style="min-width: 85px;" class="span1">
				<div class="row-fluid">&nbsp;</div>
				<div><input type="submit" name="filter_submit" class="btn btn-primary pi-filter-width pi-filter-gap-top" value="<?php echo JText::_('COM_PAYINVOICE_FILTERS_GO');?>" /></div>
				<div><input type="reset"  name="filter_reset"  class="btn pi-filter-width pi-filter-gap-top" value="<?php echo JText::_('COM_PAYINVOICE_FILTERS_RESET');?>" onclick="payinvoice.admin.grid.filters.reset(this.form);" /></div>
			</div>

		</div>
		</div>
	</div>
</div>
<?php  