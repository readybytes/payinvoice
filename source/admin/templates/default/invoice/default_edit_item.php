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
<div class="payinvoice-invoice-item">
	<div class="row-fluid">
		<table class="table" cellpadding="0" cellspacing="0" style="width: 100%;">
		<tbody>
			<tr>
				<td class="span3">
					<div class="control-group">
							<?php echo PayInvoiceHtml::_('payinvoicehtml.item.edit', "payinvoice_form[items][##counter##][item_id]", 'item', array('none'=>true, 'class' => "input-medium")); ?>
						</div>
				</td>
				<td class="span2">
					<div class="control-group">
						<input type="text" class="input-small payinvoice-item-price validate-number" required="true" min="0" name="<?php echo $component_name;?>_form[items][##counter##][unit_cost]" value="##price##" placeholder="<?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_PRICE_PER_UNIT');?>">						
						<p class="help-block"></p>
					</div>
				</td>
				<td class="span2">	
					<div class="control-group">		
						<input type="text" class="input-small payinvoice-item-quantity validate-number" required="true" min="0" name="<?php echo $component_name;?>_form[items][##counter##][quantity]"  value="##quantity##" placeholder="<?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_QUANTITY');?>">
						<p class="help-block"></p>
					</div>	
					
				</td>
				<td class="span2">
					<div class="control-group">
						<input type="text" class="input-small payinvoice-item-tax validate-number" required="true" name="<?php echo $component_name;?>_form[items][##counter##][tax]" min="0" value="##tax##">
						<p class="help-block"></p>
					</div>
				</td>
				<td class="span2">
					<div class="control-group">
						<input type="text" class="input-small payinvoice-item-total" name="<?php echo $component_name;?>_form[items][##counter##][line_total]" value="##line_total##" readonly="readonly">
						<p class="help-block"></p>
					</div>
				</td>
				<td class="span1">
					<div class="control-group">
						<button type="button" class="btn payinvoice-invoice-item_remove" name="<?php echo $component_name;?>_form_params_items_##counter##_remove"><i class="icon-remove"></i></button>
					</div>
				</td>
				
			</tr>
		</tbody>
		</table>
		<input type="hidden" name="payinvoice_form[items][##counter##][type]" value="item">
 </div>
	
</div>
<?php 