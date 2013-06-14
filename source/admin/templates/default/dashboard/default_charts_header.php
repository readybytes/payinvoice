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
<div class="well well-small center alert alert-info">
	<div class="row-fluid">		
		<div class="span4">
			<h3><span id="payinvoice-dashboard-total">0</span></h3>
			<strong><?php echo Rb_Text::_('COM_PAYINVOICE_DASHBOARD_HEADER_PAID');?></strong>
		</div>	
		
		<div class="span4">
			<h3><span id="payinvoice-dashboard-refund">0</span></h3>
			<strong><?php echo Rb_Text::_('COM_PAYINVOICE_DASHBOARD_HEADER_REFUND');?></strong>
		</div>
		
		<div class="span4">
			<h3><span id="payinvoice-dashboard-gross">0</span></h3>
			<strong><?php echo Rb_Text::_('COM_PAYINVOICE_DASHBOARD_HEADER_TOTAL');?></strong>
		</div>		
	</div>	
</div>

<div>
	<div class="row-fluid">
		<div class="span6">
		</div>
		<div class="span6">					
			<select name="payinvoice_form[statistics][currency]" id="payinvoice_form_statistics_currency" class="input-medium pull-right"">
				<?php foreach($currencies as $currency) :?>
					<option value="<?php echo $currency->currency_id;?>" <?php echo ($default_currency == $currency->currency_id) ? 'selected="selected"' : '';?> ><?php echo $currency->title;?></option>
				<?php endforeach;?>
			</select>
			
			<div class=" pull-right">
				<?php echo Rb_Html::_('rb_html.daterangepicker.edit', 'payinvoice_form_statistics_start_time', 'payinvoice_form_statistics_end_time', array('onchange' => 'payinvoice.admin.dashboard.statistics.refresh();'));?>			
				<input type="hidden" class="input-small" name="payinvoice_form[statistics][start_time]" id="payinvoice_form_statistics_start_time"/>
				<input type="hidden" class="input-small" name="payinvoice_form[statistics][end_time]" id="payinvoice_form_statistics_end_time"/>
			</div>
		</div>	
	</div>
</div>
<?php 