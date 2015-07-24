<?php

/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		Rb_Html::script(PAYINVOICE_PATH_CORE_MEDIA.'/js/payinvoice.js');@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

Rb_HelperTemplate::loadSetupEnv();
Rb_HelperTemplate::loadMedia();

Rb_Html::script('com_payinvoice/payinvoice.js');
Rb_Html::script('com_payinvoice/site.js');

// load bootsrap css
Rb_Html::_('bootstrap.loadcss');

//load css
Rb_Html::stylesheet('com_payinvoice/site.css');
