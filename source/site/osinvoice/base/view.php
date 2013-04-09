<?php

/**
 * @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * @package 	OSI
 * @subpackage	Front-end
 * @contact		team@readybytes.in
 */

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

if(RB_REQUEST_DOCUMENT_FORMAT === 'ajax'){
	class OSInvoiceViewbase extends Rb_ViewAjax{}
}elseif(RB_REQUEST_DOCUMENT_FORMAT === 'json'){
	class OSInvoiceViewbase extends Rb_ViewJson{}
}else{
	class OSInvoiceViewbase extends Rb_ViewHtml{}
}


/** 
 * Base View
 * @author Gaurav Jain
 */
class OSInvoiceView extends OSInvoiceViewbase 
{
	public $_component = OSINVOICE_COMPONENT_NAME;
	
	public function __construct($config = array())
	{
		parent::__construct($config);
		
		// intialize input
		$this->input = OSInvoiceFactory::getApplication()->input;
		self::addSubmenus(array('dashboard', 'invoice', 'processor', 'transaction', 'buyer'));
		return $this;
	}
	
	protected function _adminGridToolbar()
	{
		Rb_HelperToolbar::addNew('new');
		Rb_HelperToolbar::editList();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::publish();
		Rb_HelperToolbar::unpublish();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::deleteList();
	}
	
	protected function _adminEditToolbar()
	{
		Rb_HelperToolbar::apply();
		Rb_HelperToolbar::save();
		Rb_HelperToolbar::save2new();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::cancel();
	}
}
