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
<html>
<head>
	<style>
		
	</style>
</head>
<body>
	<div style="background-color:#fff;">
		<table style="font-family: arial;margin: 0px auto;" align="center" width="100%;" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
					<td>
						<table width="100%;" border="0	" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td height="20px" align="center" style="background-color: #222222;">
										<h1 style="color: #FFFFFF;font-family: arial;font-size: 15px;font-weight: bold;letter-spacing: 18px;margin: 0; padding: 5px;"><?php echo $xiee_invoice['title'];?></h1>
									</td>
								</tr>
								
								<tr>			
									<td>
										<?php echo $this->loadTemplate('invoice_header');?>
									</td>
								</tr>								
					
								<!-- Items Descriptions -->
								<tr>
									<td style="padding:20px 0px">
										<?php echo $this->loadTemplate('invoice_items');?>
									</td>
								</tr>												
								
								<!-- Footer -->
								<tr>
									<td>
										<table cellspacing="0" cellpadding="0" style="width: 100%;">
											<tbody>
											<tr>
												<td><a href="<?php echo JUri::root().'index.php?option=com_osinvoice&view=invoice&invoice_id='.$invoice['invoice_id'];?>" style="float: right;font-size: 16px;color: white;border: 1px #0056AE solid;width: 150px;font-weight: 600;background-color: #0056AE;border-radius: 3px;padding: 8px 5px;font-family: arial;text-align: center;text-decoration: none;margin: 0px auto 0px auto;display: block;;"><?php echo Rb_Text::_('COM_OSINVOICE_PAY_NOW');?></a></td>
											</tr>
											<tr>
										
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
 </div>

</body>
</html>
