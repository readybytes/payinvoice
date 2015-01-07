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

/** 
 * Buyer Html View
 * @author Manisha Ranawat
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewBuyer extends PayInvoiceAdminBaseViewBuyer
{	

	protected function _adminEditToolbar()
	{	
		JToolbarHelper::apply();
		JToolbarHelper::save();
		JToolbarHelper::save2new('savenew');
		JToolbarHelper::divider();
		JToolbarHelper::cancel();
	}

	protected function _adminGridToolbar()
	{
		JToolbarHelper::addNew('new');
		JToolbarHelper::editList();
		JToolbarHelper::divider();
		JToolbarHelper::deleteList(JText::_('COM_PAYINVOICE_JS_ARE_YOU_SURE_TO_DELETE'));
	}
	
	function edit($tpl=null,$itemId = null)
	{
		$itemId  =  ($itemId === null) ? $this->getModel()->getState('id') : $itemId ;
		$buyer   =  PayInvoiceBuyer::getInstance($itemId);
		
		$this->assign('buyer', $buyer);
		$this->assign('form',  $buyer->getModelform()->getForm($buyer));
        $this->assign('user', $buyer->getbuyer(true));
		
		return true;
		
	}
}