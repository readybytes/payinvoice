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

Rb_HelperTemplate::loadSetupEnv();
Rb_HelperTemplate::loadMedia();

Rb_Html::_('rb_html.nvd3.load');
Rb_Html::_('rb_html.daterangepicker.load');
?>
<script>
(function($){
	$(document).ready(function(){
		$('#payinvoice_form_statistics_currency').change(function(){
			payinvoice.admin.dashboard.statistics.refresh();
		});
		
	});

})(payinvoice.jQuery);
</script>
<?php 

echo $this->loadTemplate('charts_header');

?>

<div id="payinvoice-dashboard-chart-revenue">
	
</div>
<?php 		