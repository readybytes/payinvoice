<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/
// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

if($osi_invoice['params']['terms_and_conditions']){
	$terms_and_conditions	= $osi_invoice['params']['terms_and_conditions'];
 }else {
 	$terms_and_conditions 	= $config_data['terms_and_conditions'];
 }?>
      
<div class="well">
     	<h5>
			<input type="checkbox" name="terms-and-conditions" required="true">
			<?php echo " ".Rb_Text::_('COM_OSINVOICE_INVOICE_TERMS');?>
		</h5>

    	<?php echo JString::substr(strip_tags($terms_and_conditions), 0, 340); ?>	

      	<a href="#osi-terms-and-conditions" role="button" class="" data-toggle="modal">...more</a>
		
       	<div>&nbsp;</div>
    	
		<div id="osi-terms-and-conditions" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    			<h3 id="myModalLabel">Terms and Conditions</h3>
    		</div>

   		 	<div class="modal-body">
    			<p><?php echo $terms_and_conditions;?></p>
    		</div>

    		<div class="modal-footer">
    			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    		</div>
	    </div>
</div>