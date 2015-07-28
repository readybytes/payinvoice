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
	$buyer_address = $buyer_address."</br>".$zip_code;
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
<div class="pi-payinvoice-default-details">
<div class="row-fluid">
	<div class="span7 pull-left">
		<address>
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
		</address>
	</div>
	<div class="span5 pull-right">
	   	<table class="table">
			<tr>
				<td class="text-right"><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE');?></strong></td>
				<td><?php echo " : ";?></td>
				<td><?php echo $rb_invoice['serial'];?></td>
			</tr>
			<tr>
				<td class="text-right"><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_ISSUE_DATE');?></strong></td>
				<td><?php echo " : ";?></td>
					<?php $issue_date = new Rb_Date($rb_invoice['issue_date']);?>
				<td><?php echo $this->getHelper('format')->date($issue_date);?></td>
			</tr>
			<tr>
			       <?php if ($statusbutton['status'] == JText::_('COM_PAYINVOICE_INVOICE_STATUS_PAID')){
					$paid_date = new Rb_Date($rb_invoice['paid_date']);?>
					<td class="text-right"><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_PAID_DATE');?></strong></td>
					<td><?php echo " : ";?></td>
					<td><?php echo $this->getHelper('format')->date($paid_date);?></td>
				<?php }
				     else{
					$due_date = new Rb_Date($rb_invoice['due_date']);?>
					<td class="text-right"><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_DUE_DATE');?></strong></td>
					<td><?php echo " : ";?></td>
					<td><?php echo $this->getHelper('format')->date($due_date);?></td>
				<?php }?>
			</tr>
		</table>
	  	<div>
			<?php if(!$applicable){?>
				<div class="center label <?php echo $statusbutton['class']?> status-display"><h4><?php echo $statusbutton['status']?></h4></div>
			<?php }else {?>
				<div class="center label status display">
					<i class="pull-right icon-question-sign" title='<?php echo $applicable['message']?>'></i><h4><i class='icon-lock'></i>&nbsp;<?php echo $applicable['title']?></h4></div>
			<?php }?>
		</div>
	</div>
</div>
</div>
<?php 
