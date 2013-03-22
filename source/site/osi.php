<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSI
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

require_once  dirname(__FILE__).'/osi/includes.php';
$option	= 'com_osi';
$view	= 'dashboard';
$task	= null;
$format	= 'html';

$controllerClass = OsiHelper::findController($option, $view, $task, $format);

$controller = OsiFactory::getInstance($controllerClass, 'controller', 'osisite');

// execute task
$controller->execute($task);

// lets complete the task by taking post-action
$controller->redirect();
