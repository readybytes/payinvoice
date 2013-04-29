/**
* @copyright	Copyright (C) 2009-2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		OSINVOICE
* @contact 		team@readybytes.in
*/

if (typeof(osinvoice)=='undefined'){
	var osinvoice = {}
}

// all admin function should be in admin scope 
if(typeof(osinvoice.site)=='undefined'){
	osinvoice.site = {};
}

//all admin function should be in admin scope 
if(typeof(Joomla)=='undefined'){
	Joomla = {};
}


(function($){
// START : 	
// Scoping code for easy and non-conflicting access to $.
// Should be first line, write code below this line.	

osinvoice.site.invoice = {		
			on_processor_change	: function(processor, invoiceId){
				var args   = { 'event_args' : {'processor_id' : processor} };
				var url = 'index.php?option=com_osinvoice&view=invoice&task=ajaxRequestBuildForm&invoice_id='+invoiceId;
				osinvoice.ajax.go(url, args);
			}
	
};
	
/*--------------------------------------------------------------
  on Document ready 
--------------------------------------------------------------*/
$(document).ready(function(){
	
});

//ENDING :
//Scoping code for easy and non-conflicting access to $.
//Should be last line, write code above this line.
})(osinvoice.jQuery);