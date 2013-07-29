<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if(!defined('RB_FRAMEWORK_LOADED')){
	JLog::add('RB Frameowork not loaded',JLog::ERROR);
}

require_once  dirname(__FILE__).'/payinvoice/includes.php';
$option	= 'com_payinvoice';
$view	= 'invoice';
$task	= null;
$format	= 'html';

$controllerClass = PayInvoiceHelper::findController($option, $view, $task, $format);

$controller =  PayInvoiceFactory::getInstance($controllerClass, 'controller', 'PayInvoicesite');

// execute task
$controller->execute($task);

// lets complete the task by taking post-action
$controller->redirect();
