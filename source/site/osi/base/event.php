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

/** 
 * Base Event
 * @author Gaurav Jain
 */
class OsiEvent extends JEvent
{
	public function onRbItemAfterSave($prev, $new)
	{
		// if this triger is for OSIInvoice
		
	}
	
}

$dispatcher = JDispatcher::getInstance();
$dispatcher->register('onRbItemAfterSave', 'OsiEvent');