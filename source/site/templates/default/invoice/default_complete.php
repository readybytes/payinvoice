<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PAYINVOICE
* @subpackage	Frontend
* @contact 		support+payinvoice@readybytes.in
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<?php
		$header	= 'COM_PAYINVOICE_THANK_YOU_MESSAGE';
	 	if($rb_invoice['status'] != PayInvoiceInvoice::STATUS_PAID){
			$header	= 'COM_PAYINVOICE_PAYMENT_NOT_COMPLETED_MESSAGE';
		}
?>
<div class="row-fluid">
	<div class="center">
		<h2><?php echo JText::_($header);?></h2>
		<?php echo JText::_($message);?>		
	</div>
	
	<div>&nbsp;</div>
	<div>&nbsp;</div>
</div>
<?php 