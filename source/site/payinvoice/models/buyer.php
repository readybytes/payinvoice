<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Buyer Model
 * @author Manisha Ranawat
 */
class PayInvoiceModelBuyer extends PayInvoiceModel
{
	protected $recordId ;
	public $filterMatchOpeartor = array(
										'username' 	=> array('LIKE'),
										'country'=> array('LIKE')
										);
	
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
		$data = array('username', 'country');
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
	
	/**
     * Builds FROM tables list for the query
     */
    protected function _buildQueryFrom(Rb_Query &$query)
    {
    	$tname		=	$this->getTable()->getTableName();

    	// Join payinvoice buyer table
    	$join1 = " `$tname` AS t  ON ( t.`buyer_id` = joomlausertbl.`id` ) ";
    	// Join usergroup-map table (get user-type id)
    	$join2 = " `#__user_usergroup_map` AS g  ON ( g.`user_id` = joomlausertbl.`id` ) ";
    	
    	$sql  = new Rb_Query();
    	
    	$sql->select(' joomlausertbl.`id` AS buyer_id ')
    			   ->select(' joomlausertbl.`name` AS name ')
    			   ->select(' joomlausertbl.`username` AS username ')
    			   ->select(' joomlausertbl.`email` AS email ')
    			   ->select(' joomlausertbl.`registerDate` AS registerDate ')
    			   ->select(' joomlausertbl.`lastvisitDate` AS lastvisitDate ')
    			   ->select(' t.`currency` ')
    			   ->select(' t.`address` ')
    			   ->select(' t.`state` ')
    			   ->select(' t.`city` ')
    			   ->select(' t.`country` ')
    			   ->select(' t.`zipcode` ')
    			   ->select(' t.`tax_number`')
    			   ->select(' t.`params` ')
    			   ->from(' `#__users` AS joomlausertbl ')
    	    	   ->leftJoin($join1)
    	   		   ->leftJoin($join2)
    	  		   ->group("  g.`user_id` ");
    	
	    $query->from('( '.$sql->__toString().') AS tbl ');
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

    		if($key == 'country'){
    			$db = JFactory::getDbo();
    			$country_query	= "SELECT country.`isocode2`, country.`isocode3` FROM `#__rb_ecommerce_country` AS country 
    								                 WHERE country.`country_id` = '{$val}'";
    			$country = $db->setQuery($country_query)->loadRow();
				
    			$query->where(" `tbl`.`country` LIKE '{$country[0]}' ||
    							`tbl`.`country` LIKE '{$country[1]}'"	);
    			continue;
    		}
			
    		if(JString::strtoupper($op) == 'LIKE'){
    			if($key == 'username'){
	    			$query->where("`tbl`.`buyer_id` IN( SELECT `id` FROM `#__users` 
	    								                 WHERE `$key` $op '%{$val}%' || 
	    								                 `name` $op '%{$val}%' || 
	    								                 `email` $op '%{$val}%' ||
	    								                 `id`	$op '%{$val}%' )");
	    			continue;
	    		}
				$query->where("`$key` $op '$val'");
				continue;
			}
		}
    }

	function save($data, $pk=null, $new=false)
    {
		$new = $this->getTable()->load($pk)? false : true;
		return parent::save($data, $pk, $new);
    }
    
	public function loadRecords(Array $queryFilters=array(), Array $queryClean = array(), $emptyRecord=false, $indexedby = null)
	{	
		//it is required to decide which query to execute in FROM
		// for single record or multiple record
		if(!empty($queryFilters)){
			foreach($queryFilters as $key =>$value){
				$key = ($key==='id')? $this->getTable()->getKeyName() : $key;
				if($key === 'buyer_id'){
					$this->recordId = $value;
				}
			}
		}
		
		$query = $this->getQuery();

		//there might be no table and no query at all
		if($query === null )
			return null;

		//Support Query Filters, and query cleanup
		$tmpQuery = clone ($query);

		foreach($queryClean as $clean){
			$tmpQuery->clear(JString::strtolower($clean));
		}

		foreach($queryFilters as $key=>$value){
			//support id too, replace with actual name of key
			$key = ($key==='id')? $this->getTable()->getKeyName() : $key;

			// only one condition for this key
			if(is_array($value)==false){
				$tmpQuery->where("`tbl`.`$key` =".$this->_db->Quote($value));
				continue;
			}
			
			// multiple keys are there
			foreach($value as $condition){
				
				// not properly formatted
				if(is_array($condition)==false){
					continue;
				}
				
				// first value is condition, second one is value
				list($operator, $val)= $condition;
				$tmpQuery->where("`tbl`.`$key` $operator ".$val);
			}
			
		}

		//we want returned record indexed by columns
		$this->_recordlist = $tmpQuery->dbLoadQuery()
		 							  ->loadObjectList($this->getTable()->getKeyName());

		//handle if some one required empty records, only if query records were null
		if($emptyRecord && empty($this->_recordlist)){
			$this->_recordlist = $this->getEmptyRecord();
		}

		$data = $this->_recordlist;

		//get usertype of the user and append it with the data
		$this->getUsertype($data);
			
		return $data;
	}
	
	public function getQuery()
	{
		//create a new query
		$this->_query = new Rb_Query();

		// Query builder will ensure the query building process
		// can be overridden by child class
		if($this->_buildQuery($this->_query))
			return $this->_query;

		//in case of errors return null
		//XITODO : Generate a 500 Error Here
		return null;
	}
	
	protected function getUsertype(&$buyers)
	{
		$buyer_ids = array_keys($buyers);

		//when there is nothing in users
		if(empty($buyer_ids)){
			return $buyers;
		}
		
		$query = new Rb_Query();
		
		//if only single record exists 
		if(count($buyers) == 1){
			$query->where(' usergroupmap.user_id = '.array_shift($buyer_ids));
		}
		
		else { 
				//in case of multiple users, user_usergroup_map table 
				//contains multiple records for a single user thats why 
				//group by with user_id is required
				$query->where(' usergroupmap.user_id IN ('.implode(',', $buyer_ids).') ')
			  		  ->group(' usergroupmap.user_id ');
		}
		
		$query->select('group_concat(groups.`title`) as usertype, usergroupmap.`user_id` as user_id')
			  ->from('`#__user_usergroup_map` as usergroupmap , `#__usergroups` as groups')
			  ->where(' usergroupmap.group_id = groups.id ');
			    
		$userGroups[] = $query->dbLoadQuery()
							  ->loadObjectList('user_id');

		$groups = array_shift($userGroups);
		foreach ($buyers as $user){
			$user->usertype = $groups[$user->buyer_id]->usertype;
		}
		
	}
}

class PayInvoiceModelformBuyer extends PayInvoiceModelform {
	
}
