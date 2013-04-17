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

// If file is already included
if(defined('OSINVOICE_SITE_DEFINED')){
	return;
}

//mark core loaded
define('OSINVOICE_SITE_DEFINED', true);
define('OSINVOICE_COMPONENT_NAME','osinvoice');


// define versions
define('OSINVOICE_VERSION', '0.0.1');
define('OSINVOICE_REVISION','v0.9.0-4-ga3793b7');

//shared paths
define('OSINVOICE_PATH_CORE',				JPATH_SITE.'/components/com_osinvoice/osinvoice');
define('OSINVOICE_PATH_CORE_MEDIA',			JPATH_ROOT.'/media/com_osinvoice');
define('OSINVOICE_PATH_CORE_FORM',			OSINVOICE_PATH_CORE.'/form');

// front-end
define('OSINVOICE_PATH_SITE', 				JPATH_SITE.'/components/com_osinvoice');
define('OSINVOICE_PATH_SITE_CONTROLLER',		OSINVOICE_PATH_SITE.'/controllers');
define('OSINVOICE_PATH_SITE_VIEW',			OSINVOICE_PATH_SITE.'/views');
define('OSINVOICE_PATH_SITE_TEMPLATE',		OSINVOICE_PATH_SITE.'/templates');

// back-end
define('OSINVOICE_PATH_ADMIN', 				JPATH_ADMINISTRATOR.'/components/com_osinvoice');
define('OSINVOICE_PATH_ADMIN_CONTROLLER',	OSINVOICE_PATH_ADMIN.'/controllers');
define('OSINVOICE_PATH_ADMIN_VIEW',			OSINVOICE_PATH_ADMIN.'/views');
define('OSINVOICE_PATH_ADMIN_TEMPLATE',		OSINVOICE_PATH_ADMIN.'/templates');

// Html => form + fields
define('OSINVOICE_PATH_CORE_FORMS', 			OSINVOICE_PATH_CORE.'/html/forms');
define('OSINVOICE_PATH_CORE_FIELDS', 		OSINVOICE_PATH_CORE.'/html/fields');

define('OSINVOICE_PATH_IMAGES', 		'/media/com_osinvoice/images/');

// Expiration Types
define('OSINVOICE_EXPIRATION_TYPE_FIXED', 	'fixed');
define('OSINVOICE_EXPIRATION_TYPE_FOREVER', 	'forever');
define('OSINVOICE_EXPIRATION_TYPE_RECURRING','recurring');

// object to identify extension, create once, so same can be consumed by constructors
Rb_Extension::getInstance(OSINVOICE_COMPONENT_NAME, array('prefix_css'=>'osinvoice'));