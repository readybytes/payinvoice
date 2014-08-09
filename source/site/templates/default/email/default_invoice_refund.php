<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$config_data['company_name']	= !empty($config_data['company_name'])  		? $config_data['company_name'] 		: "";
$config_data['company_address']	= !empty($config_data['company_address']) 	? $config_data['company_address'] 	: "";
$config_data['company_phone']	= !empty($config_data['company_phone']) 		? $config_data['company_phone']		: "";
?>

<html>
<body style="padding:0;margin:0;"bgcolor="#E4E8EB">
<div style="padding-left:0!important;padding-right:0!important;padding-top:0!important;margin-right:0!important;width:100%!important;margin-left:0!important;margin-bottom:0!important;margin-top:0!important;padding-bottom:0!important;font-family:Arial,sans-serif,Helvetica Neue,Helvetica;">

<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#E4E8EB">
	<tbody>
		<tr valign="top">
			<td valign="top" align="center" style="border-collapse:collapse"> 
               	<table align="center" cellpadding="0" cellspacing="0" border="0">
                   	<tbody>
                   		<tr>
                       		<td valign="middle" height="70px" align="center" style="font-size:0;line-height:0;border-collapse:collapse">&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
             
	
		<tr>
			<td>
				<table align="center" cellpadding="0" cellspacing="0">
	            		<tbody>
	            			<tr>
	                       		<td valign="top" bgcolor="#f6f8fa" style="max-width:598px;width:600px;border: 1px solid #fff;">
	                       			<table cellspacing="0" border="0" cellpadding="0" bgcolor="#f6f8fa" width="600" align="center" style="padding:30px;">
	                       				<tbody>
					                       	<tr>
					                       		<td valign="middle" height="30px" align="center" style="font-size:0;line-height:0;border-collapse:collapse">&nbsp;</td>
											</tr>
											
											<tr>
					                       		<td style="padding-bottom: 30px;border-bottom: 1px solid #e8e8e8;">
					                       			<img alt="company_Logo" src="<?php echo Rb_HelperTemplate::mediaURI($config_data['company_logo'], false);?>" height="60" width="140" />
					                       		</td>
					                      	</tr>

								<tr>
									<td valign="middle" height="30px" align="center" style="font-size:0;line-height:0;border-collapse:collapse">&nbsp;</td>
								</tr>
											
								<tr>
					                       		<td valign="middle" style="border-collapse:collapse;font-size:14px;color:#666;line-height:2;">
					                       			<p><?php echo sprintf(Rb_Text::_('COM_PAYINVOICE_HELLO'), $buyer->name);?>,</p>
					                       			<p><?php echo sprintf(Rb_Text::_('COM_PAYINVOICE_REFUND_MESSAGE'), $rb_invoice['title']);?></p>

					                       		</td>
											</tr>
											
									<tr>
										<td valign="middle" height="30px" align="center" style="font-size:0;line-height:0;border-collapse:collapse">&nbsp;</td>
									</tr>

											<tr>
												<td>
													<p style="font-size:16px; color:#666"><?php echo Rb_Text::_('COM_PAYINVOICE_WEBSITE_DETAILS');?></p>
												</td>
											</tr>
											<tr>
					                       		<td valign="middle" height="10px" align="center" style="font-size:0;line-height:0;border-collapse:collapse">&nbsp;</td>
											</tr>
											<tr>
												<td>
													<table cellpadding="0" cellspacing="0" border="0" align="center" style="line-height: 36px;font-size: 14px;color: #333;">
														<tbody>
															<tr>
																<td><span style="color:#666"><?php echo Rb_Text::_('COM_PAYINVOICE_BUYER_USERNAME');?></span></td>
																	<td><span style="padding: 0 10px;">:</span></td>
																<td><span style="color:#333"><?php echo $buyer->username;?></span></td>
															</tr>
															<tr>
																<td><span style="color:#666"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_NUMBER');?></span></td>
																<td><span style="padding: 0 10px;">:</span></td>
																<td><span style="color:#333"><?php echo $rb_invoice['serial'];?></span></td>
															</tr>
															<tr>
																<td><span style="color:#666"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_ISSUE_DATE');?></span></td>
																<td><span style="padding: 0 10px;">:</span></td>
																<td><span style="color:#333"><?php echo $rb_invoice['issue_date'];?></span></td>
															</tr>
															<tr>
																<td><span style="color:#666"><?php echo Rb_Text::_('COM_PAYINVOICE_REFUNDED_DATE');?></span></td>
																<td><span style="padding: 0 10px;">:</span></td>
																<td><span style="color:#333"><?php echo $rb_invoice['refund_date'];?></span></td>
															</tr>
															<tr>
																<td><span style="color:#666"><?php echo Rb_Text::_('COM_PAYINVOICE_AMOUNT_PAID');?></span></td>
																<td><span style="padding: 0 10px;">:</span></td>
																<td><span style="color:#333"><?php echo $rb_invoice['currency']." ".number_format($rb_invoice['total'],2);?></span></td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											
											<tr>
					                       		<td valign="middle" height="40px" align="center" style="font-size:0;line-height:0;border-collapse:collapse">&nbsp;</td>
											</tr>
											
											<tr>
					                       		<td>
					                       			<table cellpadding="0" cellspacing="0" border="0" style="line-height: 2;font-size:14px;color:#666;">
					                       				<tbody>
															<tr>
																<td><p><?php echo Rb_Text::_('COM_PAYINVOICE_PAYINVOICING');?></p></td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table> 
	                       		</td>
	                    	</tr>
	                </tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="middle" height="20px" align="center" style="font-size:0;line-height:0;border-collapse:collapse">&nbsp;</td>
		</tr>
		<tr>
			<td align="center">
                 <table cellpadding="0" cellspacing="0" border="0" style="font-size: 10px;color: #777;" align="center">
                 	<tbody>
                 		<tr>
                     		<td align="center">
                     			<p>Copyright &copy; <?php echo $config_data['company_name'];?></p>
                     			<p><?php echo $config_data['company_address'].", Phone:".$config_data['company_phone'];?></p>
                     		</td>
                     	</tr>
					</tbody>
				</table>
        	</td>
		</tr>
		<tr>
			<td valign="middle" height="80px" align="center" style="font-size:0;line-height:0;border-collapse:collapse">&nbsp;</td>
		</tr>
	</tbody>
</table>

</div>
</body>
</html>