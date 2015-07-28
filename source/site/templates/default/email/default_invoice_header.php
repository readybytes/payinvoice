<?php

/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$config_data['company_name']	= isset($config_data['company_name'])  		? $config_data['company_name'] 		: "";
$config_data['company_address']	= isset($config_data['company_address']) 	? $config_data['company_address'] 	: "";
$config_data['company_phone']	= isset($config_data['company_phone']) 		? $config_data['company_phone']		: "";
?>
<table width="100%;" border="0" cellspacing="0" cellpadding="0" style="font-size: 16px;padding: 20px 0px 20px 0px">
	<tbody>
		<tr>
			<td height="100px"	valign="top">
				<table border="0" cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
							<td>
								<p style="margin:0px 0px 5px;font-family: sans-serif;"><?php echo $config_data['company_name'];?></p>
								<address style="font-family: Times New Roman;"><?php echo $config_data['company_address'];?><br>
								 <?php if(!empty($config_data['company_phone'])):
											echo JText::_('COM_PAYINVOICE_COMPANY_PHONE_NO');?><span href="tel:"></span>: <?php echo $config_data['company_phone'];?></address>																		
								 <?php endif;?>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		
			<td height="100px" valign="top">
				<table border="0" cellspacing="0" cellpadding="0" align="right">
					<tbody>
						<tr>
							<?php if(!empty($config_data['company_logo'])):?>
								<td>
									<img alt="" src="<?php echo JUri::root().$config_data['company_logo'];?>" class="img-polaroid">	
								</td>
							<?php endif;?>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
												
		<tr>
			<td height="30px">&nbsp;													
			</td>
		</tr>
	
		<!-- company names -->
		<tr>		
			<td height="110;" valign="top">
				<h3 style="font-family: caption;">
				<?php	$address 	= $buyer[$rb_invoice['buyer_id']]->address;
						$city		= $buyer[$rb_invoice['buyer_id']]->city;
						$country	= $buyer[$rb_invoice['buyer_id']]->country; ?>
					
				<?php	echo $buyer[$rb_invoice['buyer_id']]->name."<br>".$buyer[$rb_invoice['buyer_id']]->email; ?><br>
				<?php 	if($address) echo $address;?><br>
				<?php 	if($city) echo $city;?><br>
				<?php 	if($country) echo ",".$country;?>
		</h3>
			</td>
						
			<td  height="110;" valign="bottom">
				<table width="350px" cellspacing="0" cellpadding="8" border="1" align="right" style="font:14px Georgia, Serif;border-collapse: collapse;">
					<tbody>
						<tr>
							<td style="background-color:#eee"><?php echo JText::_('COM_PAYINVOICE_INVOICE_STATUS');?></td>
							<td style="text-align:right"><strong><?php echo $status_list[$rb_invoice['status']];?></strong></td>
						</tr>
						<tr>
							<td style="background-color:#eee">
								<?php echo JText::_('COM_PAYINVOICE_INVOICE_NUMBER');?>
							</td>
							<td style="text-align:right">
									<?php echo $rb_invoice['serial'];?>
							</td>
						</tr>
						<tr>
							<td style="background-color:#eee">
									<?php echo JText::_('COM_PAYINVOICE_INVOICE_DUE_DATE');?>
							</td>
							<td style="text-align:right">
									<?php 	$dueDate	= new Rb_Date($rb_invoice['due_date']);
											echo $this->getHelper('format')->date($dueDate);?>
							</td>
						</tr>
						<tr>
							<td style="background-color:#eee">
									<?php echo JText::_('COM_PAYINVOICE_AMOUNT');?>
							</td>
							<td style="text-align:right">
									<?php echo $rb_invoice['currency']." ".number_format($rb_invoice['total'], 2);?>
							</td>
						</tr>
					</tbody>
				</table>																					
			</td>
		</tr>
	</tbody>
</table>
