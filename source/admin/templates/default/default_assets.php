<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

Rb_HelperTemplate::loadSetupEnv();
Rb_HelperTemplate::loadSetupScripts();

Rb_Html::script(PAYINVOICE_PATH_CORE_MEDIA.'/js/payinvoice.js');
Rb_Html::script(dirname(__FILE__).'/_media/admin.js');
Rb_Html::stylesheet(dirname(__FILE__).'/_media/css/admin.css');

// load bootsrap css
Rb_Html::_('bootstrap.loadcss');
Rb_Html::stylesheet(dirname(__FILE__).'/_media/admin.css');

