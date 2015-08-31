<?php 
/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayInvoice
* @contact 		payinvoice@readybytes.in
*/
if(defined('_JEXEC')===false) die();?>
<?php $attr = array(); ?>
<div class="container-fluid well">
	<div class="row-fluid">

		<div class="span1 hidden-phone">&nbsp;</div>
		<div class="span11">

			<div class="span12">
				<div class="span2 hidden-phone" style="min-width: 170px;">
					<label><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_GRID_FILTER_CREATED_DATE');?></label>
					<div>
						<?php $attr['style'] = "width:89px;"; ?>
						<?php echo PayinvoiceHtml::_('payinvoicehtml.range.filter', 'created_date', 'transaction', $filters, 'date', 'filter_rb_ecommerce', $attr);?>
					</div>
				</div>

				<div class="span2 hidden-tablet hidden-phone" style="min-width: 140px;">
					<label><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_GRID_FILTER_AMOUNT');?></label>
					<div><?php echo PayinvoiceHtml::_('payinvoicehtml.range.filter', 'amount', 'transaction', $filters, 'text', 'filter_rb_ecommerce');?></div>
				</div>

				<div class="span2 hidden-tablet" style="min-width: 100px;">
					<label><?php echo JText::_('COM_PAYINVOICE_USER_GRID_FILTER_USERNAME');?></label>
					<div>
						<?php $attr['style'] = 'class="pi-filter-width"';?>
						<?php echo PayinvoiceHtml::_('payinvoicehtml.text.filter', 'username', 'transaction', $filters, 'filter_rb_ecommerce', $attr);?>
					</div>
				</div>

				<div class="span2" style="min-width: 90px;">
					<label><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_GRID_FILTER_INVOICE_ID');?></label>
					<div><?php echo PayinvoiceHtml::_('payinvoicehtml.text.filter', 'object_id', 'transaction', $filters, 'filter_rb_ecommerce', $attr);?></div>
				</div>
				
				<div class="span2" style="min-width: 90px;">
					<label><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_GRID_FILTER_INVOICE_TITLE');?></label>
					<div><?php echo PayinvoiceHtml::_('payinvoicehtml.text.filter', 'title', 'transaction', $filters, 'filter_rb_ecommerce', $attr);?></div>
				</div>

				<div class="span2" style="min-width: 110px;">
					<div class="row-fluid">
						<label><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_GRID_FILTER_GATEWAY');?></label>
						<?php $attr['style'] ='class="pi-filter-width"';?>
						<div><?php echo PayinvoiceHtml::_('payinvoicehtml.processortypes.filter', 'processor_type', 'transaction', $filters, 'payment', 'filter_rb_ecommerce', $attr);?></div>
					</div>
					<div class="row-fluid">
						<label><?php echo JText::_('COM_PAYINVOICE_TRANSACTION_PAYMENT_STATUS');?></label>
						<?php $attr['style'] ='class="pi-filter-width"';?>
						<div><?php echo PayinvoiceHtml::_('payinvoicehtml.paymentstatus.filter', 'payment_status', 'transaction', $filters, 'payment', 'filter_rb_ecommerce', $attr);?></div>
					</div>
				</div>

				<div class="hidden-phone">&nbsp;</div>
				
				<div style="min-width: 85px;" class="span1">
					<div><input type="submit" name="filter_submit" class="btn btn-primary pi-filter-width pi-filter-gap-top" value="<?php echo JText::_('COM_PAYINVOICE_FILTERS_GO');?>" /></div>
					<div><input type="reset"  name="filter_reset"  class="btn pi-filter-width pi-filter-gap-top" value="<?php echo JText::_('COM_PAYINVOICE_FILTERS_RESET');?>" onclick="payinvoice.admin.grid.filters.reset(this.form);" /></div>
				</div>

			</div>
		</div>
	</div>
</div>
<?php
