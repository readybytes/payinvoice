<?php

/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

Rb_HelperTemplate::loadSetupEnv();
Rb_HelperTemplate::loadMedia();

// load bootsrap css
Rb_Html::_('bootstrap.loadcss');

Rb_Html::script(PAYINVOICE_PATH_CORE_MEDIA.'/js/payinvoice.js');
Rb_Html::stylesheet(PAYINVOICE_PATH_CORE_MEDIA.'/css/payinvoice.css');

Rb_Html::script('com_payinvoice/admin/admin.js');
Rb_Html::stylesheet('com_payinvoice/admin/admin.css');

// Load CSS for Joomla 2.5 only
if(RB_CMS_VERSION_FAMILY === '16'){
	Rb_Html::stylesheet('com_payinvoice/admin/admin.j25.css');
}