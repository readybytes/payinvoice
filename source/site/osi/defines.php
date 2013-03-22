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

// If file is already included
if(defined('OSI_SITE_DEFINED')){
	return;
}

//mark core loaded
define('OSI_SITE_DEFINED', true);
define('OSI_COMPONENT_NAME','osi');


// define versions
define('OSI_VERSION', '@build.version@');
define('OSI_REVISION','@build.number@');

//shared paths
define('OSI_PATH_CORE',				JPATH_SITE.'/components/com_osi/osi');
define('OSI_PATH_CORE_MEDIA',			JPATH_ROOT.'/media/com_osi');
define('OSI_PATH_CORE_FORM',			OSI_PATH_CORE.'/form');

// front-end
define('OSI_PATH_SITE', 				JPATH_SITE.'/components/com_osi');
define('OSI_PATH_SITE_CONTROLLER',		OSI_PATH_SITE.'/controllers');
define('OSI_PATH_SITE_VIEW',			OSI_PATH_SITE.'/views');
define('OSI_PATH_SITE_TEMPLATE',		OSI_PATH_SITE.'/templates');

// back-end
define('OSI_PATH_ADMIN', 				JPATH_ADMINISTRATOR.'/components/com_osi');
define('OSI_PATH_ADMIN_CONTROLLER',	OSI_PATH_ADMIN.'/controllers');
define('OSI_PATH_ADMIN_VIEW',			OSI_PATH_ADMIN.'/views');
define('OSI_PATH_ADMIN_TEMPLATE',		OSI_PATH_ADMIN.'/templates');

// Html => form + fields
define('OSI_PATH_CORE_FORMS', 			OSI_PATH_CORE.'/html/forms');
define('OSI_PATH_CORE_FIELDS', 		OSI_PATH_CORE.'/html/fields');

// Expiration Types
define('OSI_EXPIRATION_TYPE_FIXED', 	'fixed');
define('OSI_EXPIRATION_TYPE_FOREVER', 	'forever');
define('OSI_EXPIRATION_TYPE_RECURRING','recurring');

// object to identify extension, create once, so same can be consumed by constructors
Rb_Extension::getInstance(OSI_COMPONENT_NAME, array('prefix_css'=>'osi'));