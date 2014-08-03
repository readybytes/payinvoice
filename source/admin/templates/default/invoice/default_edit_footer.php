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
?>
<div class="pull-right">
	<?php if(!empty($record_id)):?>
	<?php if($mark_paid):?>
		<a href="#" onclick="payinvoice.admin.invoice.markpaid.confirm('<?php echo $record_id?>')" class="btn btn-success"><?php echo Rb_Text::_('Mark Paid');?></a>
	<?php endif;?>
	
	<a href="#payinvoice-invoice-preview" id="payinvoice-preview-link" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-search icon-white"></i>&nbsp;<?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_PREVIEW_LINK');?></a>					
	<a href="#" onclick="payinvoice.admin.invoice.email.confirm('<?php echo $record_id?>')" class="btn btn-success"><i class="icon-envelope icon-white"></i>&nbsp;<?php echo Rb_Text::_('PAYINVOCIE_TOOLBAR_EMAIL');?></a>		
	<?php endif;?>	
	
	<?php // PAYINOICE-TRIGGER-POSITION ?>
	<?php $result = $this->loadPosition('admin-invoice-edit-footer', $this->_tplVars);?>
	<?php if(is_array($result)):?>
		<?php foreach($result as $key => $html):?>
			<?php echo $html;?>
		<?php endforeach;?>
	<?php endif;?>	
</div>
<?php 