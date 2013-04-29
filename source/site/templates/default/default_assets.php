<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

Rb_HelperTemplate::loadSetupEnv();
Rb_HelperTemplate::loadSetupScripts();

Rb_Html::script(OSINVOICE_PATH_CORE_MEDIA.'/js/osinvoice.js');
Rb_Html::script(dirname(__FILE__).'/_media/js/site.js');

// load bootsrap css
Rb_Html::_('bootstrap.loadcss');
Rb_Html::stylesheet(dirname(__FILE__).'/_media/admin.css');

