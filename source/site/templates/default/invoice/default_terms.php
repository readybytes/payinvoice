<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if(!empty($payinvoice_invoice['params']['terms_and_conditions'])): ?>
      
<div class="well">
     	<h5>
			<input type="checkbox" name="terms-and-conditions" required="true">
			<?php echo " ".Rb_Text::_('COM_PAYINVOICE_INVOICE_TERMS_AND_CONDITIONS');?>
		</h5>

    	<?php echo JString::substr(strip_tags($payinvoice_invoice['params']['terms_and_conditions']), 0, 340); ?>	

      	<a href="#payinvoice-terms-and-conditions" role="button" class="" data-toggle="modal">...more</a>
		
       	<div>&nbsp;</div>
    	
		<div id="payinvoice-terms-and-conditions" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    			<h3 id="myModalLabel"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_TERMS_AND_CONDITIONS');?></h3>
    		</div>

   		 	<div class="modal-body">
    			<p><?php echo $payinvoice_invoice['params']['terms_and_conditions'];?></p>
    		</div>

    		<div class="modal-footer">
    			<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo Rb_Text::_('COM_PAYINVOICE_CLOSE');?></button>
    		</div>
	    </div>
</div>
<?php endif;