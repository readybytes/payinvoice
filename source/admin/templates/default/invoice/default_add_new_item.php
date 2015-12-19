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
			<form id="payinvoice-invoice-additem-form" action="<?php echo $uri; ?>" method="post" class="rb-validate-form form-horizontal payinvoice-add-item-form">
							<p class="lead"><?php echo JText::_('COM_PAYINVOICE_INVOICE_REUSABLE_ITEM_TEXT');?></p>
					
							<div class="control-group">
								<div class="control-label"><?php echo $item_form->getLabel('type');?></div>
								<div class="controls"><input type="text" id="payinvoice-invoice-additem-type" name="payinvoice_form[type]" value="0" readonly="readonly"></div>								
							</div>
							<div class="control-group">
								<div class="control-label"><?php echo $item_form->getLabel('title');?></div>
								<div class="controls"><?php echo $item_form->getInput('title'); ?></div>
								<p class="help-block"></p>								
							</div>
							
							<div class="control-group">
								<div class="control-label"><?php echo $item_form->getLabel('unit_cost');?></div>
								<div class="controls"><?php echo $item_form->getInput('unit_cost'); ?></div>
								<p class="help-block"></p>								
							</div>
						
							<div class="control-group">
								<div class="control-label"><?php echo $item_form->getLabel('tax');?></div>
								<div class="controls"><?php echo $item_form->getInput('tax'); ?></div>
								<p class="help-block"></p>								
							</div>
				<div class="row-fluid text-center">
				<a href="#" role="button" class="btn btn-success" onclick="payinvoice.admin.invoice.addNewItem.save()"><?php echo JText::_("COM_PAYINVOICE_SAVE")?></a>
				<a href="#" role="button" class="btn btn-success" onclick="payinvoice.admin.invoice.addNewItem.cancel()"><?php echo JText::_("COM_PAYINVOICE_CANCEL")?></a>
			</div>
			<input type="hidden" name="boxchecked" value="1" />	
			<input type="hidden" name="element_id" value="0" id="payinvoice-invoice-additem-row-counter"/>
			</form>
	</div>
	  
</div>
