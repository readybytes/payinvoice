<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

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