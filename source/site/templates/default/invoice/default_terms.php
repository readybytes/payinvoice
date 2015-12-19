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

if(!empty($payinvoice_invoice['params']['terms_and_conditions'])): ?>  
<div>
	<p><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_TERMS_AND_CONDITIONS');?></strong></p>
		<?php if(!empty(intval($late_fee['amount']))){?>
	<span>Late Fee amount will be apply after due date :</span>
    			<?php if ($late_fee['percentage']){?>
    			<span><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_LATE_FEE')." (".$late_fee['value']."%) :-";?></strong></span>
    			<span><?php echo $currency." ".number_format($late_fee['amount'], 2);?></span>
    			
    			<?php }else{?>
    			<span><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_LATE_FEE');?></strong></span>
    			<span><?php echo $currency." ".number_format($late_fee['amount'], 2);?></span>
    			<?php }?>
    <?php }?>
	<p><?php echo $payinvoice_invoice['params']['terms_and_conditions'];?></p>
</div>
<?php endif; 