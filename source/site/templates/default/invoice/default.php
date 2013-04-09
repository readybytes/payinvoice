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

<div class="container-fluid">
    <div class="row-fluid">
		<form action="<?php echo $uri; ?>" method="post"  name="siteForm">
		  
		  <?php echo $this->loadTemplate('header');?>
		  <?php echo $this->loadTemplate('user');?>
	 	
	 	<div class="row">
		 	<table class="table table-hover">
				      <thead>
							<tr>		 
								<th>Items</th>
								<th>Quantity</th>
								<th>Unit Price</th>
								<th>Amount</th>			
							</tr>
					</thead>
					
					<tbody>
						<tr>
						    <td>Item 1</td>
						    <td>2</td>
						    <td>10.00 $</td>
						    <td>20.00 $</td>
				       </tr>
				       
				       <tr>
						    <td>Item 2</td>
						    <td>1</td>
						    <td>30.00 $</td>
						    <td>30.00 $</td>
				       </tr>
				    </tbody>
				  </table>
	 	</div>
	 	
	 	<div class="row">
	 		<div class="span5 offset7">
	 		 		<dl class="dl-horizontal">
					    <dt>Sub Total</dt>
					    <dd>50.00 $</dd>
					    <dt>Discount</dt>
					    <dd>5.00 $</dd>
					    <dt>Tax</dt>
					    <dd>10.00 $</dd>
					 </dl><hr>
					 <dl class="dl-horizontal">
					    <dt>Total</dt>
					    <dd>55.00 $</dd>
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
				    	<select style="width:140px;">
							<option>PayPal</option>
							<option>Authorize.Net</option>
							<option>Paxum</option>
			   			</select>
		   			</dd>
		   		</dl>
	 	   		<button type="submit" class="btn btn-primary pull-right">Pay Now</button>
	 	   	</div>
	 	</div>		
	</form>
	
 </div>
</div>
