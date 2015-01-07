<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$address    	= $buyer->getAddress();
$city       	= $buyer->getCity();
$state      	= $buyer->getState();
$country		= $buyer->getCountry();
$zip_code		= $buyer->getZipcode();
$tax_number		= $buyer->getTaxnumber();

$buyer_address 	= '';
if(!empty($address)){
	$buyer_address	= $address;
}

if(!empty($city)){
	$buyer_address = $buyer_address." ,".$city;
}

if(!empty($zip_code)){
	$buyer_address = $buyer_address." -".$zip_code;
}

$buyer_country = '';

if(!empty($state) && empty($country)){
	$buyer_country	= $state;
}

if(!empty($country) && empty($state)){
	$buyer_country  = $country; 
}
elseif(!empty($state) && !empty($country)){
	$buyer_country = $state." ,".$country;
}

$status = '';
if(!$applicable){
	$status = $statusbutton;
}else {
	$status = $applicable;
}
?>	
<div class="row-fluid">
	
	<div class="row-fluid">
		<div class="span8"><h4><?php echo $rb_invoice['serial']." : ". $rb_invoice['title'];?></h4></div>
		<?php if(!$applicable){?>
			<div class="span4 center <?php echo $statusbutton['class']?>"><h4><?php echo $statusbutton['status']?></h4></div>
		<?php }else {?>
			<div class="span4 center label">
				<i class="pull-right icon-question-sign" title='<?php echo $applicable['message']?>'></i><h4><i class='icon-lock'></i>&nbsp;<?php echo $applicable['title']?></h4></div>
		<?php }?>
	</div><hr>
	
	
	<div class="row-fluid">
	    <div class="span6">
	    	<?php echo $buyer->getBuyername(); ?><br/>
			<?php echo $buyer->getEmail();?><br/>
			<?php if(!empty($buyer_address)):?>
			<?php echo $buyer_address; ?><br/>
			<?php endif;?>
			<?php if(!empty($buyer_country)):?>
			<?php echo $buyer_country;?><br/>
			<?php endif;?>
			<?php if(!empty($tax_number)):?>
			<?php echo "<b>".JText::_('COM_PAYINVOICE_BUYER_TAX_NUMBER')."</b> : ".$tax_number;?><br/>
			<?php endif;?>
		</div>
   
   		<div class="span2">&nbsp;</div>
   
	   	<div class="span4">
	    	<dl class="dl-horizontal pull-right">	
			    <dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_ISSUE_DATE');?></dt>
			   	<?php $issue_date = new Rb_Date($rb_invoice['issue_date']);?>
			    <dd><?php echo $this->getHelper('format')->date($issue_date);?></dd>
			    <?php $due_date = new Rb_Date($rb_invoice['due_date']);?>		    			    
			    <dt><?php echo JText::_('COM_PAYINVOICE_INVOICE_DUE_DATE');?></dt>
			    <dd><?php echo $this->getHelper('format')->date($due_date);?></dd>		    
		    </dl>
		</div>
	</div>
</div>
<?php 
