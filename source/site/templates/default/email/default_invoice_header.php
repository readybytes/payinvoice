<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

$config_data['company_name']	= isset($config_data['company_name'])  		? $config_data['company_name'] 		: "";
$config_data['company_address']	= isset($config_data['company_address']) 	? $config_data['company_address'] 	: "";
$config_data['company_city']	= isset($config_data['company_city']) 		? $config_data['company_city'] 		: "";
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
								<address style="font-family: Times New Roman;"><?php echo $config_data['company_address'];?><br><?php echo $config_data['company_city'];?><br>
								  Phone<span href="tel:"></span>: <?php echo $config_data['company_phone'];?></address>																		
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		
			<td height="100px" valign="top">
				<table border="0" cellspacing="0" cellpadding="0" align="right">
					<tbody>
						<tr>
							<td>
									<img src="<?php echo Rb_HelperTemplate::mediaURI($config_data['company_logo'], false);?>" class="img-polaroid">																	</td>
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
				<h3 style="font-family: caption;"><?php echo $buyer[$rb_invoice['buyer_id']]->name."<br>".$buyer[$rb_invoice['buyer_id']]->email."<br>".$buyer[$rb_invoice['buyer_id']]->address."<br>".$buyer[$rb_invoice['buyer_id']]->city.",".$buyer[$rb_invoice['buyer_id']]->country;?></h3>
			</td>
						
			<td  height="110;" valign="bottom">
				<table width="350px" cellspacing="0" cellpadding="8" border="1" align="right" style="font:14px Georgia, Serif;border-collapse: collapse;">
					<tbody>
						<tr>
							<td style="background-color:#eee">
								<?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_NUMBER');?>
							</td>
							<td style="text-align:right">
									<?php echo $rb_invoice['serial'];?>
							</td>
						</tr>
						<tr>
							<td style="background-color:#eee">
									<?php echo Rb_Text::_('COM_OSINVOICE_INVOICE_DUE_DATE');?>
							</td>
							<td style="text-align:right">
									<?php echo $rb_invoice['due_date'];?>
							</td>
						</tr>
						<tr>
							<td style="background-color:#eee">
									<?php echo Rb_Text::_('COM_OSINVOICE_AMOUNT');?>
							</td>
							<td style="text-align:right">
									<?php echo $currency." ".number_format($rb_invoice['total'], 2);?>
							</td>
						</tr>
					</tbody>
				</table>																					
			</td>
		</tr>
	</tbody>
</table>
