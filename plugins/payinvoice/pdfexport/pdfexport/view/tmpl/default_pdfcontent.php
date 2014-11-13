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

$params = $invoice->getParams();
$items = array();
if(isset($params->items)){
	$items = $params->items;
}
?>

<div style="page-break-after:always; display:block;"> 
	<!-- 
	--------------------------------------------------------------------------------------------------------
				Company Logo, Address , User's and additional details			
	--------------------------------------------------------------------------------------------------------
    -->
	<table class="pp-pdf-header" >
		<tr>
			
			<td width="90%" align="left">
				<h2>
					<?php if(!empty($config_data['company_name'])):?>
					<?php echo $config_data['company_name']; ?> 
					<?php endif;?>
				</h2>
				<p>
					<?php if(!empty($config_data['company_address'])):?>
					<?php echo $config_data['company_address'];?><br />
					<?php endif;?>
					<?php if(!empty($config_data['company_phone'])):?>
					<?php echo $config_data['company_phone'];?><br />
					<?php endif;?>
				</p>
			</td>
			
			<td>
				<div style="max-width:150px; width:150px;" align="right">
					<?php if(!empty($config_data['company_logo'])):?>
						<img alt="" src="<?php echo JUri::root().$config_data['company_logo'];?>">												
					 <?php endif;?>
				</div>		
			</td>
			
		</tr>
		<tr><td><h3>&nbsp;</h3></td></tr>
		<tr>
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
		?>
		
			<td width="50%" align="left">
				<p><b><?php echo JText::_('PLG_PAYINVOICE_PDFEXPORT_INVOICE_BILL_TO');?></b><br/>
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
				</p>
			</td>
		</tr>
		<tr><td><h3>&nbsp;</h3></td></tr>
	</table>
	
	<!-- 
	--------------------------------------------------------------------------------------------------------
				Invoice Details 			
	--------------------------------------------------------------------------------------------------------
    -->	
    <fieldset>
    	<legend>
			<span><h3><?php echo JText::_($status_list[$data['status']]);?></h3>
			</span>
		</legend>
		<table style="border-collapse:collapse;">
			<tr>
				<td width="45%">
					<table class="pp-pdf-top-margin">
						<tr>
							<td align="left">
								<p>
								<b>	<?php echo JText::_('PLG_PAYINVOICE_PDFEXPORT_INVOICE_NUMBER');?><br/>
									<?php echo JText::_('PLG_PAYINVOICE_PDFEXPORT_INVOICE_TITLE');?><br/>	
							    	<?php if(!empty($data['txn_key'])):?>
							    	<?php echo JText::_('PLG_PAYINVOICE_PDFEXPORT_INVOICE_TRANSACTION_KEY');?><br/>
							    	<?php endif;?> 
							    	<?php if(!empty($rb_invoice->processor_type)):?>
							    	<?php echo JText::_('COM_PAYINVOICE_INVOICE_EDIT_PAYMENT_METHOD');?></b><br/>
							    	<?php endif;?>
							    </p>
							</td>
							<td align="left">
								<p>
								<?php echo $rb_invoice->serial; ?><br/>
								<?php echo $rb_invoice->title;?><br/>	
								<?php if(!empty($data['txn_key'])):?>
								<?php echo $data['txn_key'];?><br/>
								<?php endif;?> 
								<?php if(!empty($rb_invoice->processor_type)):?>
								<?php echo $rb_invoice->processor_type;?><br/>
								<?php endif;?>
								</p>
							</td>
						</tr>
					</table>
				</td>
				<td width="15%">&nbsp;</td>
			    <td width="40%">
				  <p class="pp-pdf-margin-top-14"></p>
					    <table cellspacing ="0" class="pp-pdf-box pp-pdf-colored-border" border-collapse="collapse">
					    	<tr>
					    		<td class="pp-pdf-colored-border">
					    			<p><b><?php echo $data['title'];?></b></p>
					    			<?php $paid_date = new Rb_Date($data['date']);?>
							        <p><?php echo $this->getHelper('format')->date($paid_date); ?></p>			
								</td>
								
					    		<td class="pp-pdf-colored-border">
					    			<p><b><?php echo JText::_('COM_PAYINVOICE_TOTAL'); ?></b></p>
									<p><?php echo $currency_symbol." ".number_format($rb_invoice->total, 2);?></p>
									
					    		</td>
					    		<td class="pp-pdf-colored-border">
					    			<p><b><?php echo JText::_('PLG_PAYINVOICE_PDFEXPORT_INVOICE_ISSUE_ON'); ?></b></p>
					    			<?php $issue_date = new Rb_Date($rb_invoice->issue_date);?>
									<p><?php echo $this->getHelper('format')->date($issue_date); ?></p>
					    		</td>
					    	</tr>
					    </table>
				</td>
			</tr>
		</table>
		<br><br>
		
		<!-- 
		--------------------------------------------------------------------------------------------------------
					Invoice Items Details	
		--------------------------------------------------------------------------------------------------------
	    -->
		<table style="border:0.5 solid #ccc; width:100%; cellspacing:0; cellpadding:0;" >
			<tbody>
				<tr>
					<th style="padding-top: 12px;padding-bottom: 10px;background-color: #eee;width: 48%;text-align:left;"><?php echo JText::_('COM_PAYINVOICE_ITEMS');?></th>
					<th style="padding-top: 12px;padding-bottom: 10px;background-color: #eee;text-align:right;"><?php echo JText::_('COM_PAYINVOICE_QUANTITY');?></th>
					<th style="padding-top: 12px;padding-bottom: 10px;background-color: #eee;text-align:right;"><?php echo JText::_('COM_PAYINVOICE_UNIT_PRICE');?></th>
					<th style="padding-top: 12px;padding-bottom: 10px;background-color: #eee;text-align:right;"><?php echo JText::_('COM_PAYINVOICE_AMOUNT');?></th>
				</tr>
				<?php foreach ($items as $item) :?>
				<tr>
					<td style="padding:10px 5px 5px 7px;text-align:left;"><?php echo $item->title;?></td>
					<td style="padding:10px 5px 5px 7px;text-align:right;"><?php echo $item->quantity;?></td>
					<td style="padding:10px 5px 5px 7px;text-align:right;"><?php echo $currency_symbol." ".number_format($item->price, 2);?></td>
					<td style="padding:10px 5px 5px 7px;text-align:right;"><?php echo $currency_symbol." ".number_format($item->total, 2);?></td>
				</tr>
				<?php endforeach;?>														
			</tbody>
		</table>
		<br><br>
		
		<!-- 
		--------------------------------------------------------------------------------------------------------
					Subtotal,discount, Tax and Total	
		--------------------------------------------------------------------------------------------------------
	    -->
		<table class="pp-pdf-bottom-fullborder">
			<tr><td><h3>&nbsp;</h3></td></tr>
			<tr>
				<td>
			 		<table style="border-collapse:collapse;">
			 			<thead>
				 			<tr>
			 					<th width="80%" class="pp-pdf-bottom-fullborder" align="left"><p><?php echo JText::_('PLG_PAYINVOICE_PDFEXPORT_INVOICE_DESCRIPTION'); ?></p></th>
			 					<th width="20%" align="right" class="pp-pdf-bottom-fullborder"><p><?php echo JText::_('PLG_PAYINVOICE_PDFEXPORT_INVOICE_AMOUNT'); ?></p></th>
				 			</tr>
			 			</thead>
					 			
			 			<tbody>							
							<tr>
								<td width="80%" class="pp-pdf-bottom-border"><p><?php echo JText::_('COM_PAYINVOICE_SUBTOTAL'); ?></p></td>
								<td width="20%" align="right" class="pp-pdf-bottom-border"><p><?php echo $currency_symbol." ".number_format($subtotal,2);?></p></td>
							</tr>
							
							<tr>
								<td width="80%" class="pp-pdf-bottom-border"><p><?php echo JText::_('COM_PAYINVOICE_DISCOUNT'); ?></p></td>
								<td width="20%" align="right" class="pp-pdf-bottom-border"><p><?php echo $currency_symbol." ".number_format($discount,2);?></p></td>
							</tr>
							
							<tr>
								<td width="80%" class="pp-pdf-bottom-border"><p><?php echo JText::_('COM_PAYINVOICE_TAX'); ?></p></td>
								<td width="20%" align="right" class="pp-pdf-bottom-border"><p><?php echo " %".number_format($tax, 2);?></p></td>
							</tr>
									
			 			</tbody>
					 </table>
					 
					 
					 <table style="border-collapse:collapse;">
					 	<tr><td><h3>&nbsp;</h3></td></tr>
					 	<tr>
					 			<td width="80%">&nbsp;</td>
					 			<td width="10%"><p><b><?php echo JText::_('COM_PAYINVOICE_TOTAL'); ?></b></p></td>
					 			<td width="10%" align="right"><p><?php echo $currency_symbol." ".number_format($rb_invoice->total, 2);?></p></td>
					 	</tr>
					 	
					 </table>
				</td>
				</tr>
		</table>
		<br/><br/>
		
		<?php 	$invoiceParams	= $invoice->getParams();?>
		<?php if(!empty($invoiceParams->terms_and_conditions)):?>
		<table style="border:0.2 solid #ccc; width:100%; cellspacing:0; cellpadding:0;">
			<thead>
	 			<tr>
	 				<th style="font-size: 80%; background-color: #eee;"><p><?php echo JText::_('COM_PAYINVOICE_INVOICE_TERMS_AND_CONDITIONS'); ?></p></th>
	 			</tr>
 			</thead> 			
 			<tbody>	
				<tr>
					<td><p style="font-size: 70%"><?php echo strip_tags($invoiceParams->terms_and_conditions);?></p></td> 
				</tr>
			</tbody>
		</table>
		<?php endif;?>
			
	</fieldset>
</div>