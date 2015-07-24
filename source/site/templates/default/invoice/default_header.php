<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$config_data['company_name']	= isset($config_data['company_name']) 		? $config_data['company_name'] 		: "";
$config_data['company_address']	= isset($config_data['company_address']) 	? $config_data['company_address']	: "";
$config_data['company_phone']	= isset($config_data['company_phone'])		? $config_data['company_phone']		: "";
?>
<div class="pi-payinvoice-header-layout">
<div class="row-fluid">
		<div class="span6">
			<address>
				<strong><?php echo $config_data['company_name'];?></strong><br>
				<?php echo $config_data['company_address'];?> <br>
				<?php if(!empty($config_data['company_phone'])):?>
				<abbr title="Phone"><?php echo JText::_('COM_PAYINVOICE_COMPANY_PHONE_NO');?></abbr>&nbsp;<?php echo $config_data['company_phone'];?>
				<?php endif;?>
			</address>
		</div>
		<div class="span4 offset2 pull-right">
	   		<?php if(!empty($config_data['company_logo'])):?>
	   			<img class="img-rounded" alt="" src="<?php echo JUri::root(true).$config_data['company_logo'];?>">
   			<?php endif;?>
   		</div>
</div>
</div>
<hr>
<?php 
