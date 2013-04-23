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

<div class="row well well-small">
	   <div class="span8">
		   <address>
				<strong><?php echo $config_data['company_name'];?></strong><br>
				<?php echo $config_data['company_address'];?> <br>
				<?php echo $config_data['company_city'];?><br>
				<abbr title="Phone"><?php echo Rb_Text::_('COM_OSINVOICE_COMPANY_PHONE_NO');?></abbr> (+91) <?php echo $config_data['company_phone'];?>
			</address>
	  	 </div>		   
	   	<div class="span2 offset2">
	   		<img src="<?php echo Rb_HelperTemplate::mediaURI($config_data['company_logo'], false);?>" class="img-polaroid">
   		</div>
</div>
