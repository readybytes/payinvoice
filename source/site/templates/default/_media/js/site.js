/**
* @copyright	Copyright (C) 2009-2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PAYINVOICE
* @contact 		team@readybytes.in
*/

if (typeof(payinvoice)=='undefined'){
	var payinvoice = {}
}

// all admin function should be in admin scope 
if(typeof(payinvoice.site)=='undefined'){
	payinvoice.site = {};
}

//all admin function should be in admin scope 
if(typeof(Joomla)=='undefined'){
	Joomla = {};
}


(function($){
// START : 	
// Scoping code for easy and non-conflicting access to $.
// Should be first line, write code below this line.	

payinvoice.site.invoice = {		
			on_processor_change	: function(processor, invoiceId){
				var args   = { 'event_args' : {'processor_id' : processor} };
				var url = 'index.php?option=com_payinvoice&view=invoice&task=ajaxRequestBuildForm&invoice_id='+invoiceId;
				payinvoice.ajax.go(url, args);
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
})(payinvoice.jQuery);