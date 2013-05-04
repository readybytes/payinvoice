/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PAYINVOICE
* @subpackage	Javascript
* @contact 		team@readybytes.in
*/

// define payplans, if not defined.
if (typeof(payinvoice)=='undefined'){
	var payinvoice = {};
	payinvoice.$ = payinvoice.jQuery = rb.jQuery;
	payinvoice.ajax	= rb.ajax;
}

if (typeof(payinvoice.element)=='undefined'){
	payinvoice.element = {}
}

(function($){
// START : 	
// Scoping code for easy and non-conflicting access to $.
// Should be first line, write code below this line.


// ENDING :
// Scoping code for easy and non-conflicting access to $.
// Should be last line, write code above this line.
})(payinvoice.jQuery);