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
 * Item Html View
 * @author Dinesh
 */
require_once dirname(__FILE__).'/view.php';
class PayInvoiceAdminViewItem extends PayInvoiceAdminBaseViewItem
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
   function _displayGrid($records)
	{
		$ItemIds = array();
		foreach($records as $record){
			$ItemIds[] = $record->item_id;
		}
				
		return parent::_displayGrid($records);
	}

  function edit($tpl= null, $itemId = null)
	{
		$itemId  = ($itemId === null) ? $this->getModel()->getState('id') : $itemId ;
		$item = PayInvoiceItem::getInstance($itemId);
		$form 	 = $item->getModelform()->getForm($item);
		
		$this->assign('item', $item);
		$this->assign('form',  $form);

        return true;
	}
}