<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
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
class PayInvoiceAdminViewProcessor extends PayInvoiceAdminBaseViewProcessor
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
	
	function _displayGrid($records)
	{	
		$this->assign('processor_names',  Rb_EcommerceAPI::get_processors_list());
		return parent::_displayGrid($records);
	}
	
	function edit($tpl= null, $itemId = null, $processor_type= null)
	{
		$itemId  		=  ($itemId === null) ? $this->getModel()->getState('id') : $itemId ;		
		$processorType 	=  PayInvoiceProcessor::getInstance($itemId);
		
		if(!$itemId){
			$processor_type =	$this->input->get('processor_type', $processor_type);
			Rb_Error::assert(($processor_type), Rb_Text::_('COM_PAYINVOICE_NO_PROCESSOR_TYPE'));
			$processorType->set('type',$processor_type);
		}
		
		$help  	   =  $this->getHelper('processor')->getXml($processorType->getType());
				
		$this->assign('processor', $processorType);
		$this->assign('form',  $processorType->getModelform()->getForm($processorType));
		$this->assign('help', $help);
		
		return true;
	}
	
	public function selectProcessor()
	{
		$processors = Rb_EcommerceAPI::get_processors_list();
		$this->assign('processors', $processors);
		
		$this->setTpl('select_processor');
		return true;
	}
}
