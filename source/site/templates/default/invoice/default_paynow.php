<?php

/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

if(isset($response)){ ?>
<div class="row-fluid">
	<div class="span12">
		<?php echo $response->data->form;?>
	</div>

	<div class="row-fluid">
		<div id ="payinvoice-paynow">
			<button type="submit" class="btn btn-primary pull-right"><?php echo JText::_('COM_PAYINVOICE_PAY_NOW');?></button>
		</div>
	</div>
</div>
<?php } 