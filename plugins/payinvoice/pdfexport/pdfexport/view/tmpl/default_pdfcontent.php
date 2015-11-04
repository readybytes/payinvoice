<?php 
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license	    GNU/GPL, see LICENSE.php
* @package	    PAYINVOICE
* @subpackage	PDFEXPORT
* @contact 	    support+payinvoice@readybytes.in
*/

// no direct access
if(defined('_JEXEC')===false) die();

$itemData = $invoice->toArray();
$items	= array();
$tasks	= array();
if(isset($itemData['tasks'])){
	$tasks	= $itemData['tasks'];
}
if(isset($itemData ['items'])){
	$items	= $itemData ['items'];
}
?>
 <div style="page-break-after:always; display:block;">
	<!-- 
	--------------------------------------------------------------------------------------------------------
				Company Logo, Address , User's and additional details			
	--------------------------------------------------------------------------------------------------------
    -->
   
<?php if (JText::_($status_list[$rb_invoice->status]) == JText::_('COM_PAYINVOICE_PAID')){?>
<h3 class="invoice-paid"><?php echo JText::_($status_list[$rb_invoice->status]);?></h3>
<?php }else if (JText::_($status_list[$rb_invoice->status]) == JText::_('COM_PAYINVOICE_DUE')){?>
<h3 class="invoice-due"><?php echo JText::_($status_list[$rb_invoice->status]);?></h3>
	
<?php }else{?>
<h3 class="invoice-other-status"><?php echo JText::_($status_list[$rb_invoice->status]);?></h3>
<?php }?>

<h4 style="text-align:center; margin-bottom:10px;">INVOICE</h4>

 <table style="margin-top:20px;">
 		<tr>			
			<td align="left">
				<h2>
					<?php if(!empty($config_data['company_name'])):?>
					<?php echo $config_data['company_name']; ?> 
					<?php endif;?>
				</h2>
					<?php if(!empty($config_data['company_address'])):?>
					<?php echo $config_data['company_address'];?><br />
					<?php endif;?>
					<?php if(!empty($config_data['company_phone'])):?>
					<?php echo JText::_('COM_PAYINVOICE_COMPANY_PHONE_NO');?>&nbsp;<?php echo $config_data['company_phone'];?>
					<?php endif;?>	
			</td>
			
			<td align="right">
					<?php if(!empty($config_data['company_logo'])):?>
						<img alt="" src="<?php echo JUri::root().$config_data['company_logo'];?>" width=200 height=120>												
					 <?php endif;?>	
			</td>
			
		</tr>
	</table><br>
	

		<table>
			<tr><td width="60%" align="left">
		<?php 
				$address    = $buyer->getAddress();
				$city       = $buyer->getCity();
				$state      = $buyer->getState();
				$country	= $buyer->getCountry();
				$zip_code	= $buyer->getZipcode();
				$tax_number	= $buyer->getTaxnumber();
				
				$buyer_address = '';
				if(!empty($address)){
					$buyer_address	= $address;
				}

				if(!empty($city)){
					$buyer_address = $buyer_address." ,".$city;
				}
				
				if(!empty($zip_code)){
					$buyer_address = $buyer_address."<br/>".$zip_code;
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
		?>
		
				<b><?php echo JText::_('PLG_PAYINVOICE_PDFEXPORT_INVOICE_BILL_TO');?></b><br/>
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
		
		</td>
		<td width="40%" align="right">
					<table>
							<tr>
								<td><?php echo JText::_('PLG_PAYINVOICE_PDFEXPORT_INVOICE_NUMBER');?></td>
								<td align="right"><?php echo $rb_invoice->serial; ?></td>
							</tr>
							<?php if(JText::_($status_list[$rb_invoice->status]) != JText::_('COM_PAYINVOICE_DUE')):?>
							<tr>
								<td><?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?> </td>
								<td align="right">	
									<?php echo $rb_invoice->processor_type;?><br/>
								</td>
							</tr>
							<?php endif;?>
							<tr>
								<td><?php echo JText::_('COM_PAYINVOICE_INVOICE_ISSUE_DATE');?></td>
								<td align="right"><?php	echo date("d-m-Y", strtotime($rb_invoice->issue_date));?></td>
							</tr>
							
							<tr>
								<?php if (JText::_($status_list[$data['status']]) == "Paid"){?>
								<td><?php echo JText::_('COM_PAYINVOICE_INVOICE_PAID_DATE');?></td>
								<td align="right"><?php echo date("d-m-Y", strtotime($rb_invoice->paid_date));?></td>
								<?php 
								}else
									{?>
								<td><?php echo JText::_('COM_PAYINVOICE_INVOICE_DUE_DATE');?></td>
								<td align="right"><?php	echo date("d-m-Y", strtotime($rb_invoice->due_date));  }?></td>
								
							</tr>
					</table>
		</td></tr>
	</table>
	<br><br>

    <!-- 
		--------------------------------------------------------------------------------------------------------
					Invoice Items Details	
		--------------------------------------------------------------------------------------------------------
	    -->
<?php if (!empty($tasks)):?>
<table style="border:0.5px solid #ccc; width:100%; cellspacing:0; cellpadding:0;"  >
			
				<tr>
					<th style="padding-top: 6px;padding-bottom: 6px;background-color: #E3E3E3;width: 40%;text-align:left;"><?php echo JText::_('COM_PAYINVOICE_TASKS');?></th>
					<th style="padding-top: 6px;padding-bottom: 6px;background-color: #E3E3E3;text-align:right;"><?php echo JText::_('COM_PAYINVOICE_RATE');?></th>
					<th style="padding-top: 6px;padding-bottom: 6px;background-color: #E3E3E3;text-align:right;"><?php echo JText::_('COM_PAYINVOICE_HOURS');?></th>
					<th style="padding-top: 6px;padding-bottom: 6px;background-color: #E3E3E3;text-align:right;"><?php echo JText::_('COM_PAYINVOICE_TAX');?></th>
					<th style="padding-top: 6px;padding-bottom: 6px;background-color: #E3E3E3;text-align:right;"><?php echo JText::_('COM_PAYINVOICE_LINE_TOTAL');?></th>
				</tr>
				<?php foreach ($tasks as $task) :?>
				<tr>
					<td style="padding:6px 5px 5px 7px;text-align:left; width: 40%;"><?php echo $task['title'];?></td>
					<td style="padding:6px 5px 5px 7px;text-align:right;"><?php echo number_format($task['unit_cost'], 2);?></td>
					<td style="padding:6px 5px 5px 7px;text-align:right;"><?php echo $task['quantity'];?></td>
					<td style="padding:6px 5px 5px 7px;text-align:right;"><?php echo number_format($task['tax'], 2);?></td>
					<td style="padding:6px 5px 5px 7px;text-align:right;"><?php echo number_format($task['line_total'], 2);?></td>
				</tr>
				<?php endforeach;?>														
			
</table>
<?php endif;?>
<table style="border:0.5px solid #ccc; width:100%; cellspacing:0; cellpadding:0;"  >
			
				<tr>
					<th style="padding-top: 6px;padding-bottom: 6px;background-color: #E3E3E3;width: 40%;text-align:left;"><?php echo JText::_('COM_PAYINVOICE_ITEMS');?></th>
					<th style="padding-top: 6px;padding-bottom: 6px;background-color: #E3E3E3;text-align:right;"><?php echo JText::_('COM_PAYINVOICE_UNIT_COST');?></th>
					<th style="padding-top: 6px;padding-bottom: 6px;background-color: #E3E3E3;text-align:right;"><?php echo JText::_('COM_PAYINVOICE_QUANTITY');?></th>
					<th style="padding-top: 6px;padding-bottom: 6px;background-color: #E3E3E3;text-align:right;"><?php echo JText::_('COM_PAYINVOICE_TAX');?></th>
					<th style="padding-top: 6px;padding-bottom: 6px;background-color: #E3E3E3;text-align:right;"><?php echo JText::_('COM_PAYINVOICE_LINE_TOTAL');?></th>
				</tr>
				<?php foreach ($items as $item) : ?>
				<tr>
					<td style="padding:6px 5px 5px 7px;text-align:left;width: 40%;"><?php echo $item['title'];?></td>
					<td style="padding:6px 5px 5px 7px;text-align:right;"><?php echo number_format($item['unit_cost'], 2);?></td>
					<td style="padding:6px 5px 5px 7px;text-align:right;"><?php echo $item['quantity'];?></td>
					<td style="padding:6px 5px 5px 7px;text-align:right;"><?php echo number_format($item['tax'], 2);?></td>
					<td style="padding:6px 5px 5px 7px;text-align:right;"><?php echo number_format($item['line_total'], 2);?></td>
				</tr>
				<?php endforeach;?>													
			
</table>
	<!-- 
	--------------------------------------------------------------------------------------------------------
				Subtotal,discount, Tax and Total	
	--------------------------------------------------------------------------------------------------------
    -->
	<table>
		<tr ><td width="60%">&nbsp;</td>
			<td width="40%">
		 		<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td><?php echo JText::_('COM_PAYINVOICE_SUBTOTAL'); ?></td>
							<td align="right"><?php echo number_format($subtotal,2);?></td>
						</tr>
						<?php if($discount['is_percent']){ ?>
						<tr>
							<td><?php echo JText::_('COM_PAYINVOICE_DISCOUNT')."(".$discount['value']."%)"; ?></td>
							<td align="right"><?php echo number_format($discount['amount'], 2);?></td>
						</tr>
						<?php }else {?>
						<tr>
							<td><?php echo JText::_('COM_PAYINVOICE_DISCOUNT'); ?></td>
							<td align="right"><?php echo number_format($discount['amount'], 2);?></td>
						</tr>
							<?php }?>
						<tr>
							<td><?php echo JText::_('COM_PAYINVOICE_TAX')."(".number_format($tax ,2)."%)"; ?></td>
							<td  align="right"><?php echo number_format($tax_amount,2);?></td>
						</tr>
						<?php if ($late_fee['status']):?>
			    		<tr>
			    			<?php if ($late_fee['percentage']){?>
			    			<td><?php echo JText::_('COM_PAYINVOICE_LATE_FEE')." (".$late_fee['value']."%)";?></td>
			    			<td align="right"><?php echo number_format($late_fee['amount'], 2);?></td>
			    			<?php }else{?>
			    			<td><?php echo JText::_('COM_PAYINVOICE_LATE_FEE');?></td>
			    			<td align="right"><?php echo number_format($late_fee['amount'], 2);?></td>
			    			<?php }?>
			    		</tr>
				    	<?php endif;?>
						<tr>
			 				<td ><b><?php echo JText::_('COM_PAYINVOICE_TOTAL'); ?></b></td>
			 				<td align="right"><b><?php echo $currency_symbol." ".number_format($rb_invoice->total, 2);?></b></td>
				 		</tr>
				 </table>
			</td>
		</tr>
	</table>
	<br><br>	
	<?php 	$invoiceParams	= $invoice->getParams();?>
	<?php if(!empty($invoiceParams->terms_and_conditions)):?>
	<p><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_TERMS_AND_CONDITIONS')." :"; ?></strong></p>
 	<?php echo strip_tags($invoiceParams->terms_and_conditions);?> 
	<?php endif;?>


		<?php if (!empty($rb_invoice->notes)):?>
		<p><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_NOTES')." :";?></strong></p>
		<span><?php echo $rb_invoice->notes;?></span>
		<?php endif;?>

</div>