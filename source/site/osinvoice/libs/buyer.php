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
	protected $tax_number 		    = '';
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
		$this->tax_number           = '';
		$this->params 				= new Rb_Registry();
		
		return $this;
	}
	
	public static function getInstance($id = 0, $data = null, $dummy1 = null, $dummy2 = null)
	{
		return parent::getInstance('buyer', $id, $data);
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function getBuyer($requireinstance=false)
	{
		if($requireinstance == true){
			return OSInvoiceBuyer::getInstance($this->buyer_id);
		}

		return $this->buyer_id;
	}
	
	public function getBuyername()
	{
		return $this->name;
	}
	
	public function getUsername()
	{
		return $this->username;
	}
	
	public function getCurrency()
	{
		return $this->currency;
	}
	
	public function getCity()
	{
		return $this->city;
	}
	
	public function getAddress()
	{
		return $this->address;
	}
	
	public function getState()
	{
		return $this->state;
	}
	
	public function getCountry()
	{
		return $this->country;
	}
	
	public function getZipcode()
	{
		return $this->zipcode;
	}
	
	public function getTaxnumber()
	{
		return $this->tax_number;
	}
	
	public function getAvatar($size="default")
	{
		// You can set size as Default, Small, Medium, Large
        return "http://avatars.io/gravatar/" . md5( strtolower( trim( $this->getEmail() ) ) ) . "?size=" . $size;
	}
}
