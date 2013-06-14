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

if(isset($response)){
	$form = $response->data->form;
	$fieldSets = $form->getFieldsets();

?>
<?php foreach ($fieldSets as $name => $fieldSet) : ?>
	<fieldset class="form-horizontal">
		<?php foreach ($form->getFieldset($name) as $field): ?>
		<div class="formelm">
			<?php echo $field->label; ?>
			<?php echo $field->input; ?>
		</div>
		<?php endforeach;?>
	</fieldset>
<?php endforeach;?>
	<div id ="payinvoice-paynow">
		<button type="submit" class="btn btn-primary pull-right"><?php echo Rb_Text::_('COM_PAYINVOICE_PAY_NOW');?></button>
	</div>
<?php } 