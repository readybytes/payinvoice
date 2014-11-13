<?php

/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
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
									<?php if(!empty($config_data['company_logo'])):?>
										<td align="left" height="100">
											<img alt="" src="<?php echo JUri::root().$config_data['company_logo'];?>">
										</td>
									<?php endif;?>
								</tr>
							</tbody>
						</table>
						<p class="fontlist pp-WordSpacing" style="padding: 10px; margin-left: 15px;"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo sprintf(JText::_('COM_PAYINVOICE_HELLO'), $buyer->name);?>,</span></p>
						<p class="fontlist pp-lineWordSpacing" style="padding: 10px; margin-left: 15px;"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo JText::_('COM_PAYINVOICE_PAYMENT_ERROR_MESSAGE');?></span><br /><br /><span style="font-size: 12pt; color: #4d4d4d;"> <strong><?php echo JText::_('COM_PAYINVOICE_WEBSITE_DETAILS');?></strong></span></p>
						<table class="fontlist" align="center">
							<tbody>
								<tr>
									<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;"><strong><?php echo JText::_('COM_PAYINVOICE_BUYER_USERNAME')." ";?></strong></span></td>
									<td class="col"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo $buyer->username;?></span></td>
									</tr>
									
									<tr>
									<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;"><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_NUMBER')." ";?></strong></span></td>
									<td class="col"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo $rb_invoice['serial'];?></span></td>
								</tr>						
								<tr>
									<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;"><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_ISSUE_DATE')." ";?></strong></span></td>
									<td class="col"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo $rb_invoice['issue_date'];?></span></td>
								</tr>
								<tr>
									<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;"><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_PAYMENT_METHOD')." ";?></strong></span></td>
									<td class="col"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo $rb_invoice['processor_type'];?></span></td>
								</tr>								
								<tr>
									<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;"><strong><?php echo JText::_('COM_PAYINVOICE_INVOICE_ERROR_MESSAGE')." ";?></strong></span></td>
									<td class="col"><span style="font-size: 12pt; color: #4d4d4d;"><?php echo JText::_($transaction['message']);?></span></td>
								</tr>
								
							</tbody>
						</table>						
						<p class="fontlist" style="padding: 10px; margin-left: 15px;"><span style="font-size: 10pt;"><?php echo JText::_('COM_PAYINVOICE_PAYINVOICING');?></span><br /><br /><span style="font-size: 10pt;"> <strong><?php echo $config_data['company_name'];?></strong></span><br /><span style="padding: 20px 0px; font-size: 10pt;"><?php echo $config_data['company_address'];?></span><br /><span style="padding: 20px 0px; font-size: 10pt;"> <?php echo "Phone :".$config_data['company_phone'];?></span><br /><br /><span style="font-size: 10pt;"><a class="links" style="text-decoration: none;" href="#"></a></span></p>
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
					<td id="fourth-middle" align="right"><span style="font-family: 'Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11px; color: #888;"> Copyright © 2013 <?php echo $config_data['company_name'];?>. All Rights Reserved. <br /> &nbsp;&nbsp;<?php echo $config_data['company_address'].",".JText::_('COM_PAYINVOICE_COMPANY_PHONE_NO')." ".$config_data['company_phone'];?> </span></td>
					<td id="fourth-right" bgcolor="#ffffff" height="10" width="10"></td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>	