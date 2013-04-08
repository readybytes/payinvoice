/**
* @copyright	Copyright (C) 2009-2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		OSINVOICE
* @contact 		team@readybytes.in
*/

//define osinvoice, if not defined.
if (typeof(osinvoice)=='undefined'){
	var osinvoice = {}
}

// all admin function should be in admin scope 
if(typeof(osinvoice.admin)=='undefined'){
	osinvoice.admin = {};
}

//all admin function should be in admin scope 
if(typeof(Joomla)=='undefined'){
	Joomla = {};
}


(function($){
// START : 	
// Scoping code for easy and non-conflicting access to $.
// Should be first line, write code below this line.	
	
	
/*--------------------------------------------------------------
osinvoice.admin.grid
	submit
	filters
--------------------------------------------------------------*/
osinvoice.admin.grid = {
		
		//default submit function
		submit : function( view, action, validActions){
			
			// try views function if exist
			var funcName = view+'_'+ action ; 
			if(this[funcName] instanceof Function) {
				if(this[funcName].apply(this) == false)
					return false;
			}
			
			// then lastly submit form
			//submitform( action );
			if (action) {
		        document.adminForm.task.value=action;
		    }
			
			// validate actions
			//XITODO : send values as key of array , saving a loop
			validActions = eval(validActions);
			var isValidAction = false;
			for(var i=0; i < validActions.length ; i++){
				if(validActions[i] == action){
					isValidAction = true;
					break;
				}
			}
			
						
			var result = true;
		    if (document.adminForm.onsubmit instanceof Function) {
			    result = document.adminForm.onsubmit.apply(this, Array(isValidAction));
				// below code is not working on IE7+, so added above line
		        //result=document.adminForm.onsubmit(isValidAction);
		    }
		    if(result){
		    	document.adminForm.submit();
		    }
		},
		
		filters : {
			reset : function(form){
				 // loop through form elements
			    var str = new Array();
                            var i=0;
			    for(i=0; i<form.elements.length; i++)
			    {
			        var string = form.elements[i].name;
			        if (string && string.substring(0,6) == 'filter' && (string!='filter_reset' && string!='filter_submit'))
			        {
			            form.elements[i].value = '';
			        }
			    }
				this.submit(view,null,validActions);
			}
		}		
};


osinvoice.admin.invoice = {
		item : {
			add : function (item_description, quantity, price, total){
						if(total == ''){
							total = 0;
						}
									
						var counter = $('#osi-invoice-item-add').attr('counter'); 
						var html = $('.osi-invoice-item:first').html();
						html = html.replace(/##counter##/g, counter);
						html = html.replace(/##item_description##/g, item_description);
						html = html.replace(/##quantity##/g, quantity);
						
						if(!isNaN(parseFloat(price))){
							price = parseFloat(price).toFixed(2);
						}
						html = html.replace(/##price##/g, price);
						
						if(!isNaN(parseFloat(total))){
							total = parseFloat(total).toFixed(2)
						}
						else{
							total = '0.00';
						}
						
						html = html.replace(/##total##/g, total);
						$('<div class="osi-invoice-item">' + html + '</div>').appendTo('.osi-invoice-items').show();
						$('#osi-invoice-item-add').attr('counter', parseInt(counter) + 1);
						return false;
			},
			
			calculate_total : function(){
						var subtotal = 0;
						$('.osi-item-total:visible').each(function(e){
							subtotal = subtotal + parseFloat($(this).val());
						});
						$('#osi-invoice-subtotal').val(parseFloat(subtotal).toFixed(2));
						
						var discount = parseFloat($('#osi-invoice-discount').val());
						var tax 	 = parseFloat($('#osi-invoice-tax').val());
						
						var total = subtotal - discount;
						if(tax > 0){
							total = total + total * tax / 100;
						}
						$('#osi-invoice-total').val(parseFloat(total).toFixed(2));
			}
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