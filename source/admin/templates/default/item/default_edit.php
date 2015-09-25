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
<div class="row-fluid">
<div class="container-fluid">
	<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm">
		
		<table class="table table-hover">
			<tr>
				<td><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TYPE');?></td>
				<td>
					<div class="control-group">
						<div class="controls"><?php echo $form->getInput('type'); ?></div>								
					</div>
				</td>
			</tr>
				
			<tr>
				<td><?php echo JText::_('COM_PAYINVOICE_INVOICE_TITLE');?></td>
				<td>
					<div class="control-group">
						
						<div class="controls"><?php echo $form->getInput('title'); ?></div>								
					</div>
				</td>
			</tr>
			<tr>
				<td><?php echo JText::_('COM_PAYINVOICE_ITEM_UNIT_COST');?></td>
				<td>
					<div class="control-group">
						
						<div class="controls"><?php echo $form->getInput('unit_cost'); ?></div>								
					</div>
				</td>
			</tr>
			<tr>
				<td><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_TAX');?></td>
				<td>
					<div class="control-group">
						
						<div class="controls"><?php echo $form->getInput('tax'); ?></div>								
					</div>
				</td>
			</tr>
					
		</table>
		<input type="hidden" name="task" value="save" />
		<?php echo $form->getInput('item_id');?>
	
	</form>
</div>
</div>