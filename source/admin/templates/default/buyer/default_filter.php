<?php
/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/

defined('_JEXEC') OR die();
?>

<div class="container-fluid well">
	<div class="row-fluid">
		<div class="span8">
			<div class="row-fluid">
				<div class="span3" style="min-width: 100px;">
					<label><?php echo JText::_("COM_PAYINVOICE_USER_GRID_FILTER_USERNAME").' / '.JText::_("COM_PAYINVOICE_BUYER_EMAIL")?></label>
					<?php echo payinvoiceHtml::_('payinvoicehtml.text.filter', 'username', 'buyer', $filters, 'filter_payinvoice',array('class'=>'pi-filter-width'));?>
				</div>
				
				<div class="span3" style="min-width: 150px;">
					<label><?php echo JText::_('COM_PAYINVOICE_BUYER_COUNTRY');?></label>
					<?php echo rb_ecommerceHtml::_('rb_ecommercehtml.countries.filter','country','buyer',$filters,'filter_payinvoice')?>
				</div>
				
				<div class="span2 pi-filter-gap-top" style="min-width: 150px;">
					<input type="submit" name="filter_submit" class="btn-block btn btn-primary" value="<?php echo JText::_('COM_PAYINVOICE_FILTERS_GO');?>" />
					<input type="reset"  name="filter_reset"  class="btn-block btn" value="<?php echo JText::_('COM_PAYINVOICE_FILTERS_RESET');?>" onclick="payinvoice.admin.grid.filters.reset(this.form);" />
				</div>
			</div>
		</div>
	</div>
</div>
<?php 