<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
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

<html>
<head>
	<style></style>
</head>
<body>
	<div style="background-color:#fff;">
		<table id="page-table" style="width: 650px;" bgcolor="#f8f8f8" border="0" cellpadding="0" cellspacing="0" align="center">
			<tbody>
				<tr id="second-row">
					<td id="second-left" bgcolor="#ffffff" width="10"></td>
					<td id="second-middle" bgcolor="f8f8f8">
						<table style="padding: 10px; width: 100%;" bgcolor="f1f2f3">
							<tbody>
								<tr>
									<td align="left" height="100"><img src="<?php echo Rb_HelperTemplate::mediaURI($config_data['company_logo'], false);?>" class="img-polaroid" /></td>
								</tr>
							</tbody>
						</table>
						<p class="fontlist pp-WordSpacing" style="padding: 10px; margin-left: 15px;"><span style="font-size: 12pt; color: #4d4d4d;">Hello <?php echo $buyer->name;?>,</span></p>
						<p class="fontlist pp-lineWordSpacing" style="padding: 10px; margin-left: 15px;"><span style="font-size: 12pt; color: #4d4d4d;">This mail is to notify that your payment not completed successfully.</span><br /><br /><span style="font-size: 12pt; color: #4d4d4d;"> <strong>Your details at our website:</strong></span></p>
						<table class="fontlist" align="center">
							<tbody>
								<tr>
									<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;"><strong><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_USERNAME')." ";?></strong></span></td>
									<td class="col"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo $buyer->username;?></span></td>
									</tr>
									
									<tr>
									<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;"><strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_NUMBER')." ";?></strong></span></td>
									<td class="col"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo $rb_invoice['serial'];?></span></td>
								</tr>						
								<tr>
									<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;"><strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_ISSUE_DATE')." ";?></strong></span></td>
									<td class="col"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo $rb_invoice['issue_date'];?></span></td>
								</tr>
								<tr>
									<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;"><strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_PAYMENT_METHOD')." ";?></strong></span></td>
									<td class="col"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo $rb_invoice['processor_type'];?></span></td>
								</tr>								
								<tr>
									<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;"><strong><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_ERROR_MESSAGE')." ";?></strong></span></td>
									<td class="col"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo Rb_Text::_($transaction['message']);?></span></td>
								</tr>
								
							</tbody>
						</table>						
						<p class="fontlist" style="padding: 10px; margin-left: 15px;"><span style="font-size: 10pt;">Happy Invoicing! </span><br /><br /><span style="font-size: 10pt;"> <strong><?php echo $config_data['company_name'];?></strong></span><br /><span style="padding: 20px 0px; font-size: 10pt;"><?php echo $config_data['company_address'].";".$config_data['company_city'];?></span><br /><span style="padding: 20px 0px; font-size: 10pt;"> <?php echo "Phone :".$config_data['company_phone'];?></span><br /><br /><span style="font-size: 10pt;"><a class="links" style="text-decoration: none;" href="#"></a></span></p>
					</td>
					<td bgcolor="#ffffff" width="10"></td>
				</tr>
				<tr id="third-row">
						<td id="third-left" bgcolor="#ffffff" height="10" width="10"></td>
						<td id="third-middle" bgcolor="#ffffff" height="10"></td>
						<td id="third-right" bgcolor="#ffffff" height="10" width="10"></td>
				</tr>
				<tr id="fourth-row" bgcolor="#ffffff">
					<td id="fourth-left" bgcolor="#ffffff" height="10" width="10"></td>
					<td id="fourth-middle" align="right"><span style="font-family: 'Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11px; color: #888;"> Copyright © 2013 <?php echo $config_data['company_name'];?>. All Rights Reserved. <br /> &nbsp;&nbsp;<?php echo $config_data['company_address'].",".$config_data['company_city'].", Phone:".$config_data['company_phone'];?> </span></td>
					<td id="fourth-right" bgcolor="#ffffff" height="10" width="10"></td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>	