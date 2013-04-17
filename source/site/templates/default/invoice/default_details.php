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
}
?>

<div class="row">
		<div class="span9"><h5><?php echo $xiee_invoice['serial'];?> : <?php echo $xiee_invoice['title'];?></h5></div>
		<div class="span3 label label-warning center"><h4>Pending</h4></div>		
</div>
	
<div class="row">
	<hr>
 	<div class="span2">
  		<img class="img-polaroid" src="<?php echo $buyer->getAvatar('medium');?>" alt="">
  	</div>
	   	 
    <div class="span4">
        <dl class="dl-horizontal">
		    <dt><?php echo Rb_Text::_('COM_OSINVOICE_BUYER_NAME');?></dt>
		    <dd><?php echo $buyer->getBuyername();?></dd>
		    <dt><?php echo Rb_Text::_('COM_OSINVOICE_BUYER_EMAIL');?></dt>
		    <dd><?php echo $buyer->getEmail(); ?></dd>
		    <dt><?php echo Rb_Text::_('COM_OSINVOICE_BUYER_ADDRESS');?></dt>
		    <dd><?php echo $buyer->getAddress().",".$buyer->getCity(); ?></dd>
		    <dt><?php echo Rb_Text::_('COM_OSINVOICE_BUYER_TAX_NUMBER');?></dt>
		    <dd><?php echo $buyer->getTaxnumber(); ?></dd>
	    </dl>
	</div>
   
   	<div class="span4 offset2 well well-small">
    	<dl class="dl-horizontal">	    
			    <dt><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_ISSUE_DATE');?></dt>
			    <dd><?php echo $xiee_invoice['issue_date'];?></dd>		    			    
			    <dt><?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_DUE_DATE');?></dt>
			    <dd><?php echo $xiee_invoice['due_date'];?></dd>		    
	    </dl>
	</div>
</div>
<?php 
