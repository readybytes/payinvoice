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

$fieldSets = $form->getFieldsets($fieldset_name); ?>
<?php foreach ($fieldSets as $name => $fieldSet) : ?>

	<?php foreach ($form->getFieldset($name) as $field):?>
		<div class="control-group">
			<div class="control-label"><?php echo $field->label; ?> </div>
			<div class="controls"><?php echo $field->input; ?></div>								
		</div>
	<?php endforeach;?>
<?php endforeach;

