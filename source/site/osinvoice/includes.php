<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

// if OSINVOICE already loaded, then do not load it again
if(defined('OSINVOICE_CORE_LOADED')){
	return;
}

define('OSINVOICE_CORE_LOADED', true);

// include defines
include_once dirname(__FILE__).'/defines.php';

//load core
Rb_HelperLoader::addAutoLoadFolder(OSINVOICE_PATH_CORE.'/base',		     '',		 'OSInvoice');

Rb_HelperLoader::addAutoLoadFolder(OSINVOICE_PATH_CORE.'/models',		'Model',	 'OSInvoice');
Rb_HelperLoader::addAutoLoadFolder(OSINVOICE_PATH_CORE.'/models',		'Modelform', 'OSInvoice');

Rb_HelperLoader::addAutoLoadFolder(OSINVOICE_PATH_CORE.'/tables',		'Table',	 'OSInvoice');
Rb_HelperLoader::addAutoLoadFolder(OSINVOICE_PATH_CORE.'/libs',			'',			 'OSInvoice');
Rb_HelperLoader::addAutoLoadFolder(OSINVOICE_PATH_CORE.'/helpers',		'Helper',	 'OSInvoice');
Rb_HelperLoader::addAutoLoadFolder(OSINVOICE_PATH_CORE.'/payment',		'',	 		 'OSInvoice');

// load the xiee plugin
JPluginHelper::importPlugin('rb', 'xiee');

//html
Rb_HelperLoader::addAutoLoadFolder(OSINVOICE_PATH_CORE.'/html/html',		'Html',		 'OSInvoice');
Rb_HelperLoader::addAutoLoadFolder(OSINVOICE_PATH_CORE.'/html/fields',	'FormField', 'OSInvoice');

// site
Rb_HelperLoader::addAutoLoadFolder(OSINVOICE_PATH_SITE.'/controllers',	'Controller',		'OSInvoiceSite');
Rb_HelperLoader::addAutoLoadViews(OSINVOICE_PATH_SITE.'/views', RB_REQUEST_DOCUMENT_FORMAT,  'OSInvoiceSite');

// admin
Rb_HelperLoader::addAutoLoadFolder(OSINVOICE_PATH_ADMIN.'/controllers',	'Controller',		'OSInvoiceAdmin');
Rb_HelperLoader::addAutoLoadViews(OSINVOICE_PATH_ADMIN.'/views', RB_REQUEST_DOCUMENT_FORMAT, 'OSInvoiceAdmin');

// include the event file so that events can be registered
require_once OSINVOICE_PATH_CORE.'/base/event.php';