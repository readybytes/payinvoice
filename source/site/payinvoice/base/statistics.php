<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Base Statistics
 * @author Gaurav Jain
 */
abstract class PayInvoiceStatistics extends JObject
{
	/**
	 * Holds the currenct, in which chart has been requested
	 */
	protected $currency = null;
	
	/**
	 * Holds the statistics data in the supported format 
	 * @var stdClass
	 */
	protected $states = null;
	
	/**
	 * Start Time of Calculating Statistics
	 * @var Rb_Date
	 */
	protected $start_time = null;
	
	/**
	 * End Time of Calculating Statistics
	 * @var Rb_Date
	 */
	protected $end_time = null;
		
	/**
	 * Initialize the Statistics Object with the data, so that further operation can be done.  
	 * @param Array $data
	 */
	public function init(Array $data = array())
	{
		$this->start_time 	 = new Rb_Date($data['start_time']);
		$this->end_time 	 = new Rb_Date($data['end_time']);
		$this->currency 	 = $data['currency'];
		
		return $this;
	}
	
	/**
	 * Calculate the statistics data and assign it to $states
	 */
	abstract public function calculate();

	public function getHtml()
	{
		return '';
	}
	
	static function getInstance($name)
	{
		$class = 'PayinvoiceStatistics'.$name;
		return new $class();
	}
}