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

<?php 
	$items = array();
	if(isset($osi_invoice['params']['items'])){
		$items = $osi_invoice['params']['items'];
	}

?>
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
			<?php foreach ($items as $item) :?>
			<tr>
			    <td><?php echo $item->title;?></td>
			    <td><?php echo $item->quantity;?></td>
			    <td><?php echo $currency." ".number_format($item->price, 2);?></td>
			    <td><?php echo $currency." ".number_format($item->total, 2);?></td>
		    </tr>
		    <?php endforeach;?>
		</tbody>
	</table>
</div>
<?php 