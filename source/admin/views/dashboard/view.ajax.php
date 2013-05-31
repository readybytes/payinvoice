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

/** 
 * Dashboard Html View
 * @author Gaurav Jain
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewDashboard extends PayInvoiceAdminBaseViewDashboard
{
	protected function _adminToolbar()
	{
		$this->_adminToolbarTitle();
	}
	
	public function display()
	{
		return true;
	}
	
	public function _basicFormSetup($task)
	{
		return true;
	}
	
	public function refresh_statistics()
	{
		$args = $this->get('args');
		
		$ajax = PayInvoiceFactory::getAjaxResponse();
		
		$paid_statistics = PayInvoiceStatisticsRevenue::getInstance();		
		$paid_statistics->init($args);
		$paid_statistics->calculate();
		$html = $paid_statistics->getHtml();
		$ajax->addScriptCall('payinvoice.jQuery("#payinvoice-dashboard-chart-revenue").html', $html);
	
		$s_helper = $this->getHelper('statistics');
		$f_helper = $this->getHelper('format');
		
		$revenue = $s_helper->get_revenue($args['start_time'], $args['end_time'], $args['currency']);		
		$ajax->addScriptCall('payinvoice.jQuery("#payinvoice-dashboard-gross").html', $f_helper->price($revenue, $args['currency'], 'symbol'));
		
		$refund = $s_helper->get_refunded_amount($args['start_time'], $args['end_time'], $args['currency']);		
		$ajax->addScriptCall('payinvoice.jQuery("#payinvoice-dashboard-refund").html', $f_helper->price($refund, $args['currency'], 'symbol'));
		
		$revenue = $refund + $revenue;				
		$ajax->addScriptCall('payinvoice.jQuery("#payinvoice-dashboard-total").html', $f_helper->price($revenue, $args['currency'], 'symbol'));
				
		$ajax->sendResponse();
	}
}