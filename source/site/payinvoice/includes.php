<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

// if PAYINVOICE already loaded, then do not load it again
if(defined('PAYINVOICE_CORE_LOADED')){
	return;
}

define('PAYINVOICE_CORE_LOADED', true);

// include defines
include_once dirname(__FILE__).'/defines.php';

//load core
Rb_HelperLoader::addAutoLoadFolder(PAYINVOICE_PATH_CORE.'/base',		     '',		 'PayInvoice');

Rb_HelperLoader::addAutoLoadFolder(PAYINVOICE_PATH_CORE.'/models',		'Model',	 'PayInvoice');
Rb_HelperLoader::addAutoLoadFolder(PAYINVOICE_PATH_CORE.'/models',		'Modelform', 'PayInvoice');

Rb_HelperLoader::addAutoLoadFolder(PAYINVOICE_PATH_CORE.'/tables',		'Table',	 'PayInvoice');
Rb_HelperLoader::addAutoLoadFolder(PAYINVOICE_PATH_CORE.'/libs',			'',			 'PayInvoice');
Rb_HelperLoader::addAutoLoadFolder(PAYINVOICE_PATH_CORE.'/helpers',		'Helper',	 'PayInvoice');
Rb_HelperLoader::addAutoLoadFolder(PAYINVOICE_PATH_CORE.'/payment',		'',	 		 'PayInvoice');

// load Ecommerce Package
rb_import('ecommerce');

//html
Rb_HelperLoader::addAutoLoadFolder(PAYINVOICE_PATH_CORE.'/html/html',		'Html',		 'PayInvoice');
Rb_HelperLoader::addAutoLoadFolder(PAYINVOICE_PATH_CORE.'/html/fields',	'FormField', 'PayInvoice');

// site
Rb_HelperLoader::addAutoLoadFolder(PAYINVOICE_PATH_SITE.'/controllers',	'Controller',		'PayInvoiceSite');
Rb_HelperLoader::addAutoLoadViews(PAYINVOICE_PATH_SITE.'/views', RB_REQUEST_DOCUMENT_FORMAT,  'PayInvoiceSite');

// admin
Rb_HelperLoader::addAutoLoadFolder(PAYINVOICE_PATH_ADMIN.'/controllers',	'Controller',		'PayInvoiceAdmin');
Rb_HelperLoader::addAutoLoadViews(PAYINVOICE_PATH_ADMIN.'/views', RB_REQUEST_DOCUMENT_FORMAT, 'PayInvoiceAdmin');


//load processor
Rb_EcommerceAPI::get_processors_list();

// include the event file so that events can be registered
require_once PAYINVOICE_PATH_CORE.'/base/event.php';