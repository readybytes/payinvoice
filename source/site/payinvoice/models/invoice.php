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

/** 
 * Invoice Model
 * @author Gaurav Jain
 */
class PayInvoiceModelInvoice extends PayInvoiceModel
{
	public $filterMatchOpeartor = array(
										'due_date'   			=> array('>=', '<='),
										'paid_date'   			=> array('>=', '<='),
										'title'					=> array('LIKE'),
										'username' 				=> array('LIKE'),
										'processor_type'	 	=> array('LIKE'),
										'status'				=> array('='),
										'total'	   				=> array('>=', '<=')										
	);
	
	/**
     * Builds FROM tables list for the query
     */
    protected function _buildQueryFrom(Rb_Query &$query)
    {
    	$tname		=	$this->getTable()->getTableName();

    	// Join rb_ecommerce invoice table
    	$join1 		= " `#__rb_ecommerce_invoice` AS rb_ecom_invoice ON ( (pi_invoice.`invoice_id` = rb_ecom_invoice.`object_id`) AND (rb_ecom_invoice.`object_type` LIKE '%PayInvoiceInvoice%') ) ";
    	
    	$sql  		= new Rb_Query();
    	
		//PITODO::Improve this query

    	$sql->select('rb_ecom_invoice.`invoice_id` AS `inv_id`')
    		->select('rb_ecom_invoice.`object_id`')
    		->select('rb_ecom_invoice.`object_type`')
    		->select('rb_ecom_invoice.`buyer_id`')
    		->select('rb_ecom_invoice.`master_invoice_id`')
    		->select('rb_ecom_invoice.`currency`')
    		->select('rb_ecom_invoice.`sequence`')
    		->select('rb_ecom_invoice.`serial`')
    		->select('rb_ecom_invoice.`status`')
    		->select('rb_ecom_invoice.`title`')
    		->select('rb_ecom_invoice.`expiration_type`')
    		->select('rb_ecom_invoice.`time_price`')
    		->select('rb_ecom_invoice.`recurrence_count`')
    		->select('rb_ecom_invoice.`subtotal`')
    		->select('rb_ecom_invoice.`total`')
    		->select('rb_ecom_invoice.`notes`')
    		->select('rb_ecom_invoice.`params`')
    		->select('rb_ecom_invoice.`created_date`')
    		->select('rb_ecom_invoice.`modified_date`')
    		->select('rb_ecom_invoice.`paid_date`')
    		->select('rb_ecom_invoice.`refund_date`')
    		->select('rb_ecom_invoice.`due_date`')
    		->select('rb_ecom_invoice.`issue_date`')
    		->select('rb_ecom_invoice.`processor_type`')
    		->select('rb_ecom_invoice.`processor_config`')
    		->select('rb_ecom_invoice.`processor_data`')
    		->select('pi_invoice.`invoice_id`')
    		->select('pi_invoice.`invoice_serial`')
    		->select('pi_invoice.`params` AS `pi_invoice_params`')
    		->from('`'.$tname.'` AS pi_invoice')
    		->leftJoin($join1);
    	
	    $query->from('( '.$sql->__toString().') AS tbl ');
    }
	
	/**
    * (non-PHPdoc)
    * @see plugins/system/rbsl/rb/rb/Rb_AbstractModel::_populateGenericFilters()
    * 
    * Overrided to add specific filters directly
    */
    public function _populateGenericFilters(Array &$filters=array())
	{
		parent::_populateGenericFilters($filters);

		$app  = Rb_Factory::getApplication();
				
		//now add the filters
		$data = array('due_date', 'paid_date', 'title', 'username', 'processor_type', 'status', 'total');
		foreach ($data as $key){
			$context = $this->getContext();
			$filterName  = "filter_{$context}_{$key}";
			$oldValue    = $app->getUserState($filterName);
			$value       = $app->getUserStateFromRequest($filterName ,$filterName);
		
			//offset is set to 0 in case previous value is not equals to current value
			//otherwise it will filter according to the pagination offset
			if(!empty($oldValue) && $oldValue != $value){
				$filters['limitstart']=0;
			}
			$filters[$context][$key] = $value;
		}

		return;		
	}
	
	//added filter for user so it is necessary to override _buildQueryFilter function here 
	//so that proper query can be build corresponding to applied filter
	protected function _buildQueryFilter(Rb_Query &$query, $key, $value, $tblAlias='`tbl`.')
    {
    	// Only add filter if we are working on bulk records
		if($this->getId()){
			return $this;
		}
		
    	Rb_Error::assert(isset($this->filterMatchOpeartor[$key]), "OPERATOR FOR $key IS NOT AVAILABLE FOR FILTER");
    	Rb_Error::assert(is_array($value), JText::_('PLG_SYSTEM_RBSL_VALUE_FOR_FILTERS_MUST_BE_AN_ARRAY'));

    	$cloneOP    = $this->filterMatchOpeartor[$key];
    	$cloneValue = $value;
    	
    	while(!empty($cloneValue) && !empty($cloneOP)){
    		$op  = array_shift($cloneOP);
    		$val = array_shift($cloneValue);

			// discard empty values
    		if(!isset($val) || '' == JString::trim($val))
    			continue;
    		
    		if(JString::strtoupper($op) == 'LIKE'){
    			if($key == 'username'){
    				$db = JFactory::getDbo();
    				$buyer_query	= "SELECT `id` FROM `#__users` 
	    							   WHERE `$key` $op '%{$val}%' || 
	    								     `name` $op '%{$val}%' || 
	    								     `email` $op '%{$val}%' ";
    				$val			= $db->setQuery($buyer_query)->loadResult();
    				$key			= 'buyer_id';

    				$query->where(" `tbl`.`$key` = '$val' ");
					
					continue;
	    		}
	    		
	    		if($key == 'title'){
	    			$query->where(" (`tbl`.`$key` $op '%{$val}%' ||
	    			    	   		`tbl`.`serial` $op '%{$val}%' )");
	    			continue;
	    		}
	    		
				$query->where(" `tbl`.`$key` $op '%{$val}%' ");
				continue;
			}
			
			$query->where(" `tbl`.`$key` $op '$val' ");
		}
    }
	
	public function getLastSerial()
	{
		$db		 = JFactory::getDbo();
		$query	 = 'SELECT MAX(invoice_id) FROM `#__payinvoice_invoice`';
		$db->setQuery($query);
		
		return $db->loadResult();
	}

	public function saveItemMapping($pk, $values)
	{
		// remove empty values [0, null, false, ''] 
		$values = array_filter($values);
		 
		$query = new Rb_Query();
		$query->delete()
				->from('#__payinvoice_invoice_x_item')
				->where('`invoice_id` = '.$pk);
				
		if(!$query->dbLoadQuery()->execute()){
			throw new Exception('Error in deleting item invoice Mapping');
		}
		
		if(empty($values)){
			return $this;
		}
		
		$sql = 'INSERT INTO `#__payinvoice_invoice_x_item` (`invoice_id`, `item_id`, `type`, `quantity`, `unit_cost`, `tax`, `line_total`) VALUES';		
		
		$insert = array();
		foreach($values as $value){
			if(empty($value)){
				continue;
			}
			
			$insert[] = '('.$pk.', '.$value['item_id'].', "'.$value['type'].'", '.$value['quantity'].', '.$value['unit_cost'].', '.$value['tax'].', '.$value['line_total'].')';
		}
		$sql .= implode(', ', $insert);
		
		$db = PayInvoiceFactory::getDbo();
		$db->setQuery($sql);
		if(!$db->execute()){
			throw new Exception('Error in inserting invoice item Mapping');
		}
		
		return $this;
	}

	public function getItemMapping($pk, $type)
	{
		$query = new Rb_Query();
		$query->select('*')
				->from('#__payinvoice_invoice_x_item')
				->where('`type` = "'.$type.'"')
				->where('`invoice_id` = '.$pk);
				
		return   $query->dbLoadQuery()->loadAssocList();
	}

	public function delete($pk=null)
	{
		//try to calculate automatically
		if($pk === null){
			$pk = (int) $this->getId();
		}
		
		if(!$pk){
			$this->setError('Invalid itemid to delete for model : '.$this->getName());
			return false;
		}
		
		$query = new Rb_Query();
		$query->delete()
				->from('#__payinvoice_invoice_x_item')
				->where('`invoice_id` = '.$pk);
				
		if(!$query->dbLoadQuery()->execute()){
			$this->setError('Error in deleting invoice item Mapping');
			return false;
		}
		
		return parent::delete($pk);
	}
	
}

class PayInvoiceModelformInvoice extends PayInvoiceModelform { }