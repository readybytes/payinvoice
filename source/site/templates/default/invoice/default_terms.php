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
	<span>Late Fee amount will be apply after due date :</span>
    		<table>
    			<tr>
    			<?php if ($late_fee['percentage']){?>
    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_LATE_FEE')." (".$late_fee['value']."%) :-";?></strong></td>
    			<td class="pull-right"><?php echo $currency." ".number_format($late_fee['amount'], 2);?></td>
    			</tr>
    			<?php }else{?>
    			<tr>
    			<td><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_ITEM_LATE_FEE');?></strong></td>
    			<td class="pull-right"><?php echo $currency." ".number_format($late_fee['amount'], 2);?></td>
    			<?php }?>
    		</tr>
    	   </table>
	<p><?php echo $payinvoice_invoice['params']['terms_and_conditions'];?></p>
</div>
<?php endif;