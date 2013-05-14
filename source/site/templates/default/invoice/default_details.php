<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/
// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}
?>

<div class="row-fluid">
		<div class="span8"><h5><?php echo $rb_invoice['serial'];?> : <?php echo $rb_invoice['title'];?></h5></div>
		<?php if(!$applicable){?>
			<div class="span4"><?php echo $statusbutton;?></div>	
		<?php }else { ?>
			<div class="span4"><?php echo $applicable;?></div>	
		<?php }?>
</div>
	
<div class="row">
	<hr>
 	<div class="span2">
  		<img class="img-polaroid" src="<?php echo $buyer->getAvatar('medium');?>" alt="">
  	</div>
	   	 
    <div class="span4">
        <dl class="dl-horizontal">
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_NAME');?></dt>
		    <dd><?php echo $buyer->getBuyername();?></dd>
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_EMAIL');?></dt>
		    <dd><?php echo $buyer->getEmail(); ?></dd>
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_ADDRESS');?></dt>
		    <dd><?php echo $buyer->getAddress().",".$buyer->getCity(); ?></dd>
		    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_TAX_NUMBER');?></dt>
		    <dd><?php echo $buyer->getTaxnumber(); ?></dd>
	    </dl>
	</div>
   
   	<div class="span4 offset2 well well-small">
    	<dl class="dl-horizontal">	    
			    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_ISSUE_DATE');?></dt>
			    <dd><?php echo $created_date;?></dd>		    			    
			    <dt><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_DUE_DATE');?></dt>
			    <dd><?php echo $due_date;?></dd>		    
	    </dl>
	</div>
</div>
<?php 
