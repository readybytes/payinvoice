<?php

/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// If file is already included
if(defined('PAYINVOICE_SITE_DEFINED')){
	return;
}

//mark core loaded
define('PAYINVOICE_SITE_DEFINED', true);
define('PAYINVOICE_COMPONENT_NAME','payinvoice');


// define versions
define('PAYINVOICE_VERSION', '@build.version@');
define('PAYINVOICE_REVISION','@build.number@');

//shared paths
define('PAYINVOICE_PATH_CORE',				JPATH_SITE.'/components/com_payinvoice/payinvoice');
define('PAYINVOICE_PATH_CORE_MEDIA',			dirname(dirname(dirname(dirname(__FILE__)))).'/media/com_payinvoice');
define('PAYINVOICE_PATH_CORE_FORM',			PAYINVOICE_PATH_CORE.'/form');

// front-end
define('PAYINVOICE_PATH_SITE', 				JPATH_SITE.'/components/com_payinvoice');
define('PAYINVOICE_PATH_SITE_CONTROLLER',		PAYINVOICE_PATH_SITE.'/controllers');
define('PAYINVOICE_PATH_SITE_VIEW',			PAYINVOICE_PATH_SITE.'/views');
define('PAYINVOICE_PATH_SITE_TEMPLATE',		PAYINVOICE_PATH_SITE.'/templates');

// back-end
define('PAYINVOICE_PATH_ADMIN', 				JPATH_ADMINISTRATOR.'/components/com_payinvoice');
define('PAYINVOICE_PATH_ADMIN_CONTROLLER',	PAYINVOICE_PATH_ADMIN.'/controllers');
define('PAYINVOICE_PATH_ADMIN_VIEW',			PAYINVOICE_PATH_ADMIN.'/views');
define('PAYINVOICE_PATH_ADMIN_TEMPLATE',		PAYINVOICE_PATH_ADMIN.'/templates');

// Html => form + fields
define('PAYINVOICE_PATH_CORE_FORMS', 			PAYINVOICE_PATH_CORE.'/html/forms');
define('PAYINVOICE_PATH_CORE_FIELDS', 		PAYINVOICE_PATH_CORE.'/html/fields');

define('PAYINVOICE_PATH_IMAGES', 		'/media/com_payinvoice/images/');

// Expiration Types
define('PAYINVOICE_EXPIRATION_TYPE_FIXED', 	'fixed');
define('PAYINVOICE_EXPIRATION_TYPE_FOREVER', 	'forever');
define('PAYINVOICE_EXPIRATION_TYPE_RECURRING','recurring');

// object to identify extension, create once, so same can be consumed by constructors
Rb_Extension::getInstance(PAYINVOICE_COMPONENT_NAME, array('prefix_css'=>'payinvoice'));
