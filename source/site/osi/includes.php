<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSI
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

// if OSI already loaded, then do not load it again
if(defined('OSI_CORE_LOADED')){
	return;
}

define('OSI_CORE_LOADED', true);

// include defines
include_once dirname(__FILE__).'/defines.php';

//load core
Rb_HelperLoader::addAutoLoadFolder(OSI_PATH_CORE.'/base',		     '',		 'Osi');

Rb_HelperLoader::addAutoLoadFolder(OSI_PATH_CORE.'/models',		'Model',	 'Osi');
Rb_HelperLoader::addAutoLoadFolder(OSI_PATH_CORE.'/models',		'Modelform', 'Osi');

Rb_HelperLoader::addAutoLoadFolder(OSI_PATH_CORE.'/tables',		'Table',	 'Osi');
Rb_HelperLoader::addAutoLoadFolder(OSI_PATH_CORE.'/libs',			'',			 'Osi');
Rb_HelperLoader::addAutoLoadFolder(OSI_PATH_CORE.'/helpers',		'Helper',	 'Osi');
Rb_HelperLoader::addAutoLoadFolder(OSI_PATH_CORE.'/payment',		'',	 		 'Osi');

//html
Rb_HelperLoader::addAutoLoadFolder(OSI_PATH_CORE.'/html/html',		'Html',		 'Osi');
Rb_HelperLoader::addAutoLoadFolder(OSI_PATH_CORE.'/html/fields',	'FormField', 'Osi');

// site
Rb_HelperLoader::addAutoLoadFolder(OSI_PATH_SITE.'/controllers',	'Controller',		'OsiSite');
Rb_HelperLoader::addAutoLoadViews(OSI_PATH_SITE.'/views', RB_REQUEST_DOCUMENT_FORMAT,  'OsiSite');

// admin
Rb_HelperLoader::addAutoLoadFolder(OSI_PATH_ADMIN.'/controllers',	'Controller',		'OsiAdmin');
Rb_HelperLoader::addAutoLoadViews(OSI_PATH_ADMIN.'/views', RB_REQUEST_DOCUMENT_FORMAT, 'OsiAdmin');

// include the event file so that events can be registered
require_once OSI_PATH_CORE.'/base/event.php';