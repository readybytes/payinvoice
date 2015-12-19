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
	<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm" class="rb-validate-form form-horizontal payinvoice-add-item-form">
		<div class="control-group">
			<div class="control-label"><?php echo $form->getLabel('type');?></div>
			<div class="controls"><?php echo $form->getInput('type'); ?></div>
									
		</div>
		
		<div class="control-group">
			<div class="control-label"><?php echo $form->getLabel('title');?></div>
			<div class="controls"><?php echo $form->getInput('title'); ?></div>
										
		</div>
		
		<div class="control-group">
			<div class="control-label"><?php echo $form->getLabel('unit_cost');?></div>
			<div class="controls"><?php echo $form->getInput('unit_cost'); ?></div>
								
		</div>
	
		<div class="control-group">
			<div class="control-label"><?php echo $form->getLabel('tax');?></div>
			<div class="controls"><?php echo $form->getInput('tax'); ?></div>
								
		</div>
		<input type="hidden" name="task" value="save" />
		<?php echo $form->getInput('item_id');?>
	
	</form>
</div>
</div>