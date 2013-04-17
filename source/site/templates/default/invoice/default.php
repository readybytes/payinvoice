<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}?>

<script>
(function($){
	$(document).ready(function(){
		$('#osinvoice_formparamsprocessor_id').change(function(){
			var args   = { 'event_args' : {'processor_id' : $(this).val()} };
			var url = 'index.php?option=com_osinvoice&view=invoice&task=ajaxRequestBuildForm&invoice_id=<?php echo $osi_invoice['invoice_id'];?>';
			osinvoice.ajax.go(url, args);
		});
	});
})(osinvoice.jQuery);
</script>

<div class="container-fluid">
    <div class="row-fluid">		  
		  <?php echo $this->loadTemplate('header');?>
		  <?php echo $this->loadTemplate('details');?>
		  <?php echo $this->loadTemplate('items');?>
	 	
	 	<div class="row">
	 		<div class="span5 offset7">
	 		 		<dl class="dl-horizontal">
					    <dt>Sub Total</dt>
					    <dd>$<?php echo number_format($subtotal, 2);?></dd>
					    <dt>Discount</dt>
					    <dd>$<?php echo number_format($discount, 2);?></dd>
					    <dt>Tax</dt>
					    <dd><?php echo number_format($tax, 2);?>%</dd>
					 </dl><hr>
					 <dl class="dl-horizontal">
					    <dt>Total</dt>
					    <dd>$<?php echo number_format($xiee_invoice['total'], 2);?></dd>
				    </dl>
	 		</div>
	 	</div>
	 	
	 	<div class="row">
	 	  	<div class="span7"> 
	 	   		<label class="checkbox"><input type="checkbox">Terms and Conditions</label>
	 	   		<dl class="span5">
				    <dt>Note To Recieptent	</dt>
				    <dd style="text-align:justify;"> This is for testing purpose.Thanks for using our products.Enjoy your business...</dd>
			    </dl>
    		</div>   
	 	   <div class="span5">
		 	   <dl class="dl-horizontal">
				    <dt>Payment Method</dt>
				    <dd>
				    	<?php echo OSInvoiceHtml::_('osinvoicehtml.processors.edit', 'osinvoice_form[params][processor_id]' , '',array('none'=>true, 'style' => 'class="input-medium"')); ?>
		   			</dd>
		   		</dl>	 	   		
	 	   	</div>
	 	</div>
	 		
	 	<div class="row">
	 		<form action="" method="post"  name="paynowForm" id="paynowForm">
	 			<div id="osinvoice-paynow-html">
	 			</div>
	 			<button type="submit" class="btn btn-primary pull-right">Pay Now</button>
	 		</form>
	 	</div>
 </div>
</div>
<?php 