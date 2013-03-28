<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSI
* @subpackage	Front-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

/** 
 * Invoice Lib
 * @author Manisha Ranawat
 */
class OSInvoiceBuyer extends OSInvoiceLib
{

    protected $buyer_id 			= 0;
	protected $name              	= '';
	protected $username             = '';
	protected $email                = '';
	protected $password             = '';
	protected $currency 			= 'USD';
	protected $city 			    = '';
	protected $address 				= '';
	protected $state 				= '';
	protected $country				= '';
	protected $zipcode 		        = '';
	protected $params               = '';


	public function reset()
	{		
		$this->buyer_id 			= 0;
		$this->name                 = '';
		$this->username             = '';
		$this->email                = '';
		$this->currency 			= 'USD';
		$this->city                 = '';
		$this->address              = '';
		$this->state                = '';
		$this->country              = '';
		$this->zipcode              = '';
		$this->params 				= new Rb_Registry();
		
		return $this;
	}
	
	public static function getInstance($id = 0, $data = null, $dummy1 = null, $dummy2 = null)
	{
		return parent::getInstance('buyer', $id, $data);
	}
	
	public function save()
	{
		$data 			 	= new stdClass();
		$data->name         = $this->name;
		$data->username 	= $this->username;
		$data->email 	    = $this->email;
		$data->password 	= $this->password;
		$data->buyer_id 	= $this->buyer_id;
			
		$helper = $this->getHelper();
		$helper->storeUser($data);

		return parent::save(true);
		
	}
	
	
}
