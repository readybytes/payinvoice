<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$config_data['company_name']	= isset($config_data['company_name']) 		? $config_data['company_name'] 		: "";
$config_data['company_address']	= isset($config_data['company_address']) 	? $config_data['company_address']	: "";
$config_data['company_phone']	= isset($config_data['company_phone'])		? $config_data['company_phone']		: "";
?>

<div class="row well well-small">
	   <div class="span8">
		   <address>
				<strong><?php echo $config_data['company_name'];?></strong><br>
				<?php echo $config_data['company_address'];?> <br>
				<?php if(!empty($config_data['company_phone'])):?>
					<abbr title="Phone"><?php echo Rb_Text::_('COM_PAYINVOICE_COMPANY_PHONE_NO');?></abbr>&nbsp;<?php echo $config_data['company_phone'];?>
				<?php endif;?>
			</address>
	  	 </div>		   
	   	<div class="span2 offset2">
	   		<?php if(!empty($config_data['company_logo'])):?>
	   			<img src="<?php echo Rb_HelperTemplate::mediaURI($config_data['company_logo'], false);?>">
   			<?php endif;?>
   		</div>
</div>
