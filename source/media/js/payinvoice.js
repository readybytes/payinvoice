/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PAYINVOICE
* @subpackage	Javascript
* @contact 		team@readybytes.in
*/

if (typeof(payinvoice)=='undefined'){
	var payinvoice 	= {};
	payinvoice.$ 	= payinvoice.jQuery = rb.jQuery;
	payinvoice.ajax	= rb.ajax;
	payinvoice.ui	= rb.ui;
}

if (typeof(payinvoice.element)=='undefined'){
	payinvoice.element = {}
}

(function($){
// START : 	
// Scoping code for easy and non-conflicting access to $.
// Should be first line, write code below this line.

/*--------------------------------------------------------------
  URL related to works
   	url.modal 		: open a url in modal window
   	url.redirect 	: redirect current window to new url
   	url.fetch		: fetch the url and replace to given node 
--------------------------------------------------------------*/
payinvoice.url = {
  	modal: function( theurl, options){
		if( typeof options=== "undefined" ){
			var ajaxCall = {'url':theurl, 'data': {}, 'iframe': false};
		}	
		else{
		    var ajaxCall = {'url':theurl, 'data':options.data, 'iframe' : false};
		}

		payinvoice.ui.dialog.create(ajaxCall, '', 650, 300);
	},
		
	redirect:function(url){
		        document.location.href=url;
	}
};

// ENDING :
// Scoping code for easy and non-conflicting access to $.
// Should be last line, write code above this line.
})(payinvoice.jQuery);