<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PAYINVOICE
* @subpackage	Frontend
* @contact 		team@readybytes.in
*/
if(defined('_JEXEC')===false) die('Restricted access' );
?>

<?php
		$header	= 'COM_PAYINVOICE_THANK_YOU_MESSAGE';
	 	if($rb_invoice['status'] != PayInvoiceInvoice::STATUS_PAID){
			$header	= 'COM_PAYINVOICE_PAYMENT_NOT_COMPLETED_MESSAGE';
		}
?>
<div class="center">
	<h2><?php echo Rb_Text::_($header);?></h2>
	<?php echo Rb_Text::_($message);?>		
</div>
<?php 