<?php

/**
 * @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * @package 	PAYINVOICE
 * @subpackage	Front-end
 * @contact		team@readybytes.in
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if(RB_REQUEST_DOCUMENT_FORMAT === 'ajax'){
	class PayInvoiceViewbase extends Rb_ViewAjax{}
}elseif(RB_REQUEST_DOCUMENT_FORMAT === 'json'){
	class PayInvoiceViewbase extends Rb_ViewJson{}
}else{
	class PayInvoiceViewbase extends Rb_ViewHtml{}
}


/** 
 * Base View
 * @author Gaurav Jain
 */
class PayInvoiceView extends PayInvoiceViewbase 
{
	public $_component = PAYINVOICE_COMPONENT_NAME;
	
	public function __construct($config = array())
	{
		parent::__construct($config);
		
		// intialize input
		$this->input = PayInvoiceFactory::getApplication()->input;
		self::addSubmenus(array('dashboard', 'config' , 'processor', 'buyer', 'invoice', 'transaction', 'appstore'));
		
		if(!isset($this->_helper)){
			$this->_helper = $this->getHelper();
		}
		
		return $this;
	}
	
	public function getHelper($name = '')
	{
		if(empty($name)){
			$name = $this->getName();
		}
		
		return PayInvoiceFactory::getHelper($name);
	} 
	
	protected function _adminGridToolbar()
	{
		Rb_HelperToolbar::addNew('new');
		Rb_HelperToolbar::editList();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::publish();
		Rb_HelperToolbar::unpublish();
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::deleteList();
	}
	
	protected function _adminEditToolbar()
	{
		Rb_HelperToolbar::apply();
		Rb_HelperToolbar::save();
		Rb_HelperToolbar::save2new('savenew');
		Rb_HelperToolbar::divider();
		Rb_HelperToolbar::cancel();
	}
	
	protected function _showFooter()
	{
		// avoid ajax request
		if(JRequest::getVar('tmpl')=='component'){
			return '';
		}
		
		//always shown in admin
		if(PayInvoiceFactory::getApplication()->isAdmin()==true){
			return $this->_showAdminFooter();
		}

		return ;
	}
	
	
	protected function _showAdminFooter()
	{
		ob_start()?>
       
         	 <div class="powered-by">
				<div class="pull-right muted">
				   <?php echo Rb_Text::_('COM_PAYINVOICE_POWERED_BY') .'<a href="http://www.readybytes.net/payinvoice.html" target="_blank" >PayInvoice</a>';?>
				   <?php echo ' | '.Rb_Text::_('COM_PAYINVOICE_FOOTER_VERSION').' <strong>'.PAYINVOICE_VERSION .'</strong> | '. Rb_Text::_('COM_PAYINVOICE_FOOTER_BUILD').PAYINVOICE_REVISION; ?>	  	
			    	<?php echo '<br />'
			    		.Rb_Text::_('COM_PAYINVOICE_FOOTER_MESSAGE')
			    		.'<a href="http://bit.ly/14LBgOB" target="_blank">'.Rb_Text::_('COM_PAYINVOICE_FOOTER_MESSAGE_JED_LINK').'</a>'
			    	?>
		    	</div>
			</div>
		<?php 
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	public function _adminSubmenu($selMenu = 'dashboard')
	{
		$selMenu	= strtolower(JRequest::getVar('view',$selMenu));

		if($this->getTask() == 'display' || $this->getTask() == ''){
			foreach(self::$_submenus as $menu){
				Rb_HelperToolbar::addSubMenu($menu, $selMenu, $this->_component->getNameCom());
			}
		}
		
		return $this;
	}
	
	public function loadPosition($position, $data = array())
	{
		$args = array($position, $this, $data);
		return Rb_HelperPlugin::trigger('onPayinvoiceLoadPosition', $args);
	}
}
