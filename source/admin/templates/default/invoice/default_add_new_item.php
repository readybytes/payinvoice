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

<div id="payinvoice-invoice-additem" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-body">
			<form id="payinvoice-invoice-additem-form"action="<?php echo $uri; ?>" method="post"  class="rb-validate-form form-horizontal payinvoice-add-item-form">
				<table class="table table-hover">
					<tr>
						<td><?php echo JText::_('COM_PAYINVOICE_ITEM_TYPE');?></td>
						<td>
							<div class="control-group">
								<div class="controls"><input type="text" id="payinvoice-invoice-additem-type" name="payinvoice_form[type]" value="0" readonly="readonly"></div>								
							</div>
						</td>
					</tr>
					<tr>
						<td><?php echo JText::_('COM_PAYINVOICE_INVOICE_TITLE');?></td>
						<td>
							<div class="control-group">
								<div class="controls"><?php echo $item_form->getInput('title'); ?></div>								
							</div>
						</td>
					</tr>
					<tr>
						<td><?php echo JText::_('COM_PAYINVOICE_ITEM_UNIT_COST');?></td>
						<td>
							<div class="control-group">
								<div class="controls"><?php echo $item_form->getInput('unit_cost'); ?></div>								
							</div>
						</td>
					</tr>
					<tr>
						<td><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></td>
						<td>
							<div class="control-group">
								<div class="controls"><?php echo $item_form->getInput('tax'); ?></div>								
							</div>
						</td>
					</tr>
				</table>
				<div class="row-fluid text-center">
				<a href="#" role="button" class="btn btn-success" onclick="payinvoice.admin.invoice.addNewItem.save()"><?php echo JText::_("COM_PAYINVOICE_SAVE")?></a>
				<a href="#" role="button" class="btn btn-success" onclick="payinvoice.admin.invoice.addNewItem.cancel()"><?php echo JText::_("COM_PAYINVOICE_CANCEL")?></a>
			</div>
				<?php echo $item_form->getInput('buyer_id'); ?>
			<input type="hidden" name="boxchecked" value="1" />	
			<input type="hidden" name="element_id" value="0" id="payinvoice-invoice-additem-row-counter"/>
			</form>
	</div>
	  
</div>
