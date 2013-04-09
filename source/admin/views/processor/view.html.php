<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/
// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

/** 
 * Transaction Html View
 * @author Manisha Ranawat
 */
require_once dirname(__FILE__).'/view.php';
class OSInvoiceAdminViewProcessor extends OSInvoiceAdminBaseViewProcessor
{	
	protected function _adminGridToolbar()
	{
		Rb_HelperToolbar::addNew('selectProcessor');
		Rb_HelperToolbar::editList();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::publish();
		Rb_HelperToolbar::unpublish();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::deleteList();
	}
	
	function edit($tpl= null, $itemId = null, $processor_type= null)
	{
		$itemId  		=  ($itemId === null) ? $this->getModel()->getState('id') : $itemId ;		
		$processorType 	=  OSInvoiceProcessor::getInstance($itemId);
		
		if(!$itemId){
			$processor_type =	$this->input->get('processor_type', $processor_type);
			Rb_Error::assert(($processor_type), Rb_Text::_('COM_OSINVOICE_NO_PROCESSOR_TYPE'));
			$processorType->set('type',$processor_type);
		}
		
		$this->assign('processor', $processorType);
		$this->assign('form',  $processorType->getModelform()->getForm($processorType));
		
		return true;
	}
	
	public function selectProcessor()
	{
		$processors = XiEEAPI::get_processors_list();
		$this->assign('processors', $processors);
		
		$this->setTpl('select_processor');
		return true;
	}
}
