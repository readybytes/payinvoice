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
		var invoice_id	= '<?php echo $osi_invoice['invoice_id'];?>';
		
		<?php if(!empty($osi_invoice['params']['processor_id'])) :?>
			var osi_invoice_processor = '<?php echo $osi_invoice['params']['processor_id'];?>';
			osinvoice.site.invoice.on_processor_change(osi_invoice_processor, invoice_id);
		<?php endif;?>
        	
		$('#osinvoice_formparamsprocessor_id').change(function(){
			var processor   = $(this).val();
			osinvoice.site.invoice.on_processor_change(processor, invoice_id);
			return false;
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
	 		<div class="span7"></div>
	 		
	 		<div class="span5">
	 		 		<dl class="dl-horizontal">
					    <dt>Sub Total</dt>
					    <dd><?php echo $currency." ". number_format($subtotal, 2);?></dd>
					    <dt>Discount</dt>
					    <dd><?php echo $currency." ". number_format($discount, 2);?></dd>
					    <dt>Tax</dt>
					    <dd><?php echo number_format($tax, 2)." %";?></dd>
					 </dl><hr>

	 		</div>
	 	</div>
	 	
	 	<div class="row">
	 		<div class="span7">
	 		</div>
	 		
	 		<div class="span5">
	 	 		<dl class="dl-horizontal">
						    <dt>Total</dt>
						    <dd><?php echo $currency." ".number_format($rb_invoice['total'], 2);?></dd>
			    </dl>
		    </div>
		</div>
		
		 	<div class="row">
		 	  	<div class="span7"> 
		 	  	</div> 
	    		<?php if($valid):?>  
		 	   <div class="span5">
			 	   <dl class="dl-horizontal">
					    <dt>Payment Method</dt>
					    <dd>
					    	<?php 	if(!empty($processor_title)){?>
				    				 <?php echo $processor_title;?>
					    	 <?php	 }else {
			    		 				echo OSInvoiceHtml::_('osinvoicehtml.processors.edit', 'osinvoice_form[params][processor_id]', '', array('none'=>true, 'style' => 'class="input-medium"'));
			   					  	 }?>
			   			</dd>
					   
			   		</dl>	 	   		
		 	   	</div>
		 	</div>
		 		
		 	<div class="row">
		 		<form action="" method="post"  name="paynowForm" id="paynowForm">
		 			<div id="osinvoice-paynow-html">
		 			</div>
		 			<button type="submit" class="btn btn-primary pull-right"><?php echo Rb_Text::_('COM_OSINVOICE_PAY_NOW');?></button>
		 		</form>
		 	</div>
		 	 <?php endif;?>
		<div>&nbsp;</div>
		<div class="row">
			<?php echo $this->loadTemplate('terms');?>
		</div>
 </div>
</div>
<?php 
