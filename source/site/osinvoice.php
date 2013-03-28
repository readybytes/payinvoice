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

if(!defined('RB_FRAMEWORK_LOADED')){
	JLog::add('RB Frameowork not loaded',JLog::ERROR);
}

require_once  dirname(__FILE__).'/osinvoice/includes.php';
$option	= 'com_osinvoice';
$view	= 'dashboard';
$task	= null;
$format	= 'html';

$controllerClass = OSInvoiceHelper::findController($option, $view, $task, $format);

$controller =  OSInvoiceFactory::getInstance($controllerClass, 'controller', 'OSInvoicesite');

// execute task
$controller->execute($task);

// lets complete the task by taking post-action
$controller->redirect();
