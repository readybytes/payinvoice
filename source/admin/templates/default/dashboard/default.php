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

?>

<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
		<div class="span8">	
			<?php echo $this->loadTemplate('charts');?>
		</div>
		
		<!--For BroadCast By PayInvoice-->
		<div class="span4 well well-small">
			<?php 	$version = new JVersion();
					$suffix = 'jom=J'.$version->RELEASE.'&utm_campaign=broadcast&payinvoice=PI'.PAYINVOICE_VERSION.'&dom='.JURI::getInstance()->toString(array('scheme', 'host', 'port'));?>
				<iframe class="span12 payinvoice-border00" height="350px;" src="http://pub.jpayplans.com/payinvoice/broadcast/broadcast.html?<?php echo $suffix?>"></iframe>
				<div class="span12" style="display:none;">
					
				</div>
		</div>
		</div>
	</div>
</div>

<?php 