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
$component_name = $this->_component->getNameSmall();
?>

<div class="payinvoice-invoice-task">
	<div class="row-fluid">
	<table class="table" cellpadding="0" cellspacing="0" style="width: 100%;">
		<tbody>
			<tr>
				<td class="span4">
					<div class="control-group">
						<?php echo PayInvoiceHtml::_('payinvoicehtml.item.edit', 'payinvoice_form[tasks][##counter##][item_id]', 'task', array('none'=>true, 'class'=> "input-medium")); ?><span> OR </span>
					<input type="text" class="input-medium payinvoice-item-title" required="true" min="0" name="<?php echo $component_name;?>_form[tasks][##counter##][title]" value="##title##" placeholder="<?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TITLE');?>">						
						<p class="help-block"></p>
					</div>
				</td>
				<td class="span2">
					<div class="control-group">
						<input class="input-medium payinvoice-item-price validate-number" required="true" type="text" name="<?php echo $component_name;?>_form[tasks][##counter##][unit_cost]" value='##price##' placeholder="<?php echo JText::_('COM_PAYINVOICE_TASK_RATE');?>">
						<p class="help-block"></p>
					</div>
				</td>
				<td class="span2">
					<div class="control-group">
						<input class="input-medium payinvoice-item-quantity validate-number" required="true" type="text" name="<?php echo $component_name;?>_form[tasks][##counter##][quantity]" value="##quantity##" placeholder="<?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_HOURS');?>">
						<p class="help-block"></p>
					</div>
				</td>
				<td class="span2">
					<div class="control-group">
						<input class="input-medium payinvoice-item-tax validate-number" required="true" type="text" name="<?php echo $component_name;?>_form[tasks][##counter##][tax]" value="##tax##" placeholder="<?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?>">
						<p class="help-block"></p>
					</div>
				</td>
				<td class="span2">
					<div class="control-group">
						<input class="input-medium payinvoice-item-total" type="text" name="<?php echo $component_name;?>_form[tasks][##counter##][line_total]" value="##total##" readonly="true">
					</div>
				</td>
				<td class="span1">
						<div class="control-group">
							<button type="button" class="btn payinvoice-invoice-task_remove" name="<?php echo $component_name;?>_form_params_tasks_##counter##_remove"><i class="icon-remove"></i></button>
						</div>
				</td>
			</tr>
		</tbody>
	</table>
	<input type="hidden" name="payinvoice_form[tasks][##counter##][type]" value="task">
	</div>
</div>