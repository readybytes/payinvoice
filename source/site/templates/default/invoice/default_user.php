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
	<h5>Bill To :</h5><hr>
 	 <div class="span2">
  			<img class="img-polaroid" src="<?php echo $buyer->getAvatar('medium');?>" alt="">
  	</div>
	   	 
    <div class="span4">
        <dl class="dl-horizontal">
		    <dt>Name</dt>
		    <dd><?php echo $buyer->getBuyername();?></dd>
		    <dt>Email</dt>
		    <dd><?php echo $buyer->getEmail(); ?></dd>
		    <dt>Address</dt>
		    <dd><?php echo $buyer->getAddress().",".$buyer->getCity(); ?></dd>
		    <dt>Tax Number</dt>
		    <dd><?php echo $buyer->getTaxnumber(); ?></dd>
	    </dl>
	</div>
   
   	<div class="span4 offset2 well well-small">
    	<dl class="dl-horizontal">
			    <dt>Invoice No</dt>
			    <dd>#001</dd>
			    <dt>Invoice Status</dt>
			    <dd><span class="label label-warning">Pending</span></dd>
			    <dt>Issued On</dt>
			    <dd>30/03/13</dd>
			    <dt>Due on</dt>
			    <dd>06/0/13</dd>
	    </dl>
	</div>
</div>
