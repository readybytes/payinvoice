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

if(!defined('RB_FRAMEWORK_LOADED')){
	JLog::add('RB Frameowork not loaded',JLog::ERROR);
}

require_once JPATH_SITE.'/components/com_osinvoice/osinvoice/includes.php';

// find the controller to handle the request
$option	= 'com_osinvoice';
$view	= 'dashboard';
$task	= null;
$format	= 'html';

$controllerClass = OSInvoiceHelper::findController($option,$view, $task,$format);


$controller = OSInvoiceFactory::getInstance($controllerClass, 'controller', 'OSInvoiceadmin');

// execute task
try{
	$controller->execute($task);
}catch(Exception $e){
	OSInvoiceHelper::handleException($e);
}

// lets complete the task by taking post-action
$controller->redirect();
