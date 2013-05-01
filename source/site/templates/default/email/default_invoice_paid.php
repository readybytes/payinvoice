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
}?>

<html>
<head>
	<style>
		
	</style>
</head>
<body>
	<div style="background-color:#fff;">
		<table id="page-table" style="width: 650px;" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#f8f8f8" class="mceItemTable">
			<tbody>
				<tr id="second-row">
					<td id="second-left" bgcolor="#ffffff" width="10">&nbsp;</td>
					<td id="second-middle" bgcolor="f8f8f8">
						<table style="padding: 10px; width: 100%;" bgcolor="f1f2f3" class="mceItemTable">
							<tbody>
								<tr>
									<td align="left" height="100"><img src="<?php echo Rb_HelperTemplate::mediaURI($config_data['company_logo'], false);?> alt=""></td>
								</tr>
							</tbody>
						</table>
						
						<p class="fontlist pp-wordSpacing" style="margin-left: 25px;" mce_style="margin-left: 25px;"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1">Hello  <?php echo $buyer->name;?>,</span></p>
						<p class="fontlist pp-lineWordSpacing" style="padding: 10px; margin-left: 15px;" mce_style="padding: 10px; margin-left: 15px;"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1">Refund Processed for <?php echo $rb_invoice['title']; ?> is completed. ><br><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1"> <strong>Your details are as follows:</strong></span></p>
						<table class="fontlist pp-wordSpacing mceItemTable" align="center">
							<tbody>
								<tr>
								<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1">Username:</span></td>
								<td class="col"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1"><?php echo $buyer->username; ?></span></td>
								</tr>
								<tr>
								<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1">Invoice Number:</span></td>
								<td class="col"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1"> <?php echo $rb_invoice['serial'];?></span></td>
								</tr>
								<tr>
								<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1">Invoice Title:</span></td>
								<td class="col"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1"><?php echo $rb_invoice['title']; ?></span></td>
								</tr>
								<tr>
								<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1">Amount Paid:</span></td>
								<td class="col"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1"><?php echo $rb_invoice['total']; ?></span></td>
								</tr>
								<tr>
								<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1">Issue Date:</span></td>
								<td class="col"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1"><?php echo $rb_invoice['issue_date']; ?></span></td>
								</tr>
								<tr>
								<td class="col" align="right"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1">Refund Date:</span></td>
								<td class="col"><span style="font-size: 12pt; color: #4d4d4d;" mce_style="font-size: 12pt; color: #4d4d4d;" data-mce-mark="1"><?php echo $rb_invoice['refunded_on']; ?></span></td>
								</tr>
							</tbody>
						</table>
					</td>
					
					<td bgcolor="#ffffff" width="10">&nbsp;</td>
				</tr>
				
				<tr id="third-row">
				<td id="third-left" bgcolor="#ffffff" width="10" height="10">&nbsp;</td>
				<td id="third-middle" bgcolor="#ffffff" height="10">&nbsp;</td>
				<td id="third-right" bgcolor="#ffffff" width="10" height="10">&nbsp;</td>
				</tr>
				
				<tr id="fourth-row" bgcolor="#ffffff">
				<td id="fourth-left" bgcolor="#ffffff" width="10" height="10">&nbsp;</td>
				<td id="fourth-middle" align="right"><span style="font-family: 'Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11px; color: #888;" mce_style="font-family: 'Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11px; color: #888;" data-mce-mark="1"> Copyright © <?php echo $config_data['company_name'];?>. All Rights Reserved. <br> &nbsp;&nbsp;<?php echo $config_data['company_address'].",".$config_data['company_city'];?>, </span></td>
				<td id="fourth-right" bgcolor="#ffffff" width="10" height="10">&nbsp;</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>	
<?php 