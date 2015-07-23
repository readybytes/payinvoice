/**
* @copyright	Copyright (C) 2009-2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PAYINVOICE
* @contact 		team@readybytes.in
*/

//define payinvoice, if not defined.
if (typeof(payinvoice)=='undefined'){
	var payinvoice = {}
}

// all admin function should be in admin scope 
if(typeof(payinvoice.admin)=='undefined'){
	payinvoice.admin = {};
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
payinvoice.admin.grid
	submit
	filters
--------------------------------------------------------------*/
payinvoice.admin.grid = {
		
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
			
			if(isValidAction){
				if (!$('#adminForm').find("input,textarea,select").jqBootstrapValidation("hasErrors")) {
					Joomla.submitform(action, document.getElementById('adminForm'));
				}
				else{
					$('#adminForm').submit();
				}
			}else{
				//prevent form from validating data when action is "cancel"
				$(document.getElementById('adminForm')).unbind("submit");
				Joomla.submitform(action, document.getElementById('adminForm'));
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


payinvoice.admin.invoice = {
		item : {
			add : function (item_description, quantity, price, total){
						if(total == ''){
							total = 0;
						}
									
						var counter = $('#payinvoice-invoice-item-add').attr('counter'); 
						var html = $('.payinvoice-invoice-item:first').html();
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
						$('<div class="payinvoice-invoice-item">' + html + '</div>').appendTo('.payinvoice-invoice-items').show();
						$('#payinvoice-invoice-item-add').attr('counter', parseInt(counter) + 1);
						
						// apply validation on added item
						$('.payinvoice-item-quantity, .payinvoice-item-price, .payinvoice-item-title').jqBootstrapValidation();						
						
						return false;
			}
		},
			
		calculate_total : function(){
					var subtotal = 0;
					var discount = 0
					$('.payinvoice-item-total:visible').each(function(e){
						subtotal = subtotal + parseFloat($(this).val());
					});
					$('#payinvoice-invoice-subtotal').val(parseFloat(subtotal).toFixed(2));
					
					if($('#payinvoice-invoice-discount').val() != ''){
						var discount		= $('#payinvoice-invoice-discount').val();
						var is_percent		= discount.indexOf("%");
						if(is_percent != -1){
							discount 		= discount.replace("%" , "");
							discount 		= parseFloat(discount);
							discount 		= discount * 0.01 * subtotal;
						}
						else{
							discount 		= parseFloat(discount);
						}
						
					}
					var tax 	 = parseFloat($('#payinvoice-invoice-tax').val());
					
					var total = subtotal - discount;
					if(tax > 0){
						total = total + total * tax / 100;
					}
					$('#payinvoice-invoice-total').val(parseFloat(total).toFixed(2));
		},
	
		on_currency_change : function(currency){
					var currency   = {'event_args' :{'currency' : currency} };
					var url		   = 'index.php?option=com_payinvoice&view=invoice&task=ajaxchangecurrency';
					payinvoice.ajax.go(url,currency);
					return false;
		},
		
		on_buyer_change : function(buyer){
				var buyer   = {'event_args' :{'buyer' : buyer} };
				var url 	= 'index.php?option=com_payinvoice&view=invoice&task=ajaxchangebuyer';
				payinvoice.ajax.go(url, buyer);
		},
		
		email : {	
			confirm : function(invoice_id){
				var url 	= 'index.php?option=com_payinvoice&view=invoice&task=email&invoice_id='+invoice_id;
				payinvoice.url.modal(url);
			},
			
			send : function(invoice_id){
				payinvoice.ui.dialog.body('<div class="center"><span class="spinner">&nbsp;</span></div>');
				// XITODO : use bootstarp to disable the button click
				$('#payinvoice-invoice-email-confirm-button').attr('disabled', 'disabled');
				var url 	= 'index.php?option=com_payinvoice&view=invoice&task=email&confirmed=1&invoice_id='+invoice_id;
				payinvoice.ajax.go(url);
			}			
		},

		markpaid : {
			confirm : function(invoice_id){
				var url = 'index.php?option=com_payinvoice&view=invoice&task=markpaid&invoice_id='+invoice_id;
				payinvoice.url.modal(url);
		},

			processpayment : function(invoice_id){
				payinvoice.ui.dialog.body('<div class="center"><span class="spinner">&nbsp;</span></div>');
				// XITODO : use bootstarp to disable the button click
				$('#payinvoice-invoice-payment-confirm-button').attr('disabled', 'disabled');

				var url = 'index.php?option=com_payinvoice&view=invoice&task=markpaid&confirmed=1&invoice_id='+invoice_id;
				payinvoice.ajax.go(url);
			}
		}, 
		
		addbuyer :{
			save : function(){
				
				var msgHtml = "<div id='payinvoice-msghtml' class='payinvoice-msghtml text-center text-warning'><h3>Please do not refresh. Window will be closed automatically after adding new user!<br/></h3></div>";
				$('#payinvoice-invoice-addbuyer').append(msgHtml);
				
				var url   = 'index.php?option=com_payinvoice&view=buyer&task=addbuyer';				
				var data  = $('.payinvoice-add-buyer-form').serializeArray();
				
				payinvoice.ajax.go(url , data , payinvoice.admin.invoice.addbuyerSuccess);				
			},
			
			cancel : function(){
				//code to close the modal window
				$('#payinvoice-invoice-addbuyer').modal('hide');
			}
		},
		
		addbuyerSuccess : function(json){
			
			//from json, get buyer_id, name and username
			var data 		= json[0][1];

			//code to add new buyer in selectbox
			var key 	= data.buyer_id;
			var value  	= data.name+" ("+data.username+")";
			
			$('#payinvoice_form_rb_invoice_buyer_id')
	         .append($("<option></option>")
	         .attr("value" , key)
	         .attr("selected" , true)
	         .text(value));
			
			//reset the form
			$("form#payinvoice-invoice-addbuyer-form :input").each(function(){
				 var input = $(this); // This is the jquery object of the input, do what you will
				 input.val("");
				});			
			$('div.payinvoice-msghtml').remove();
			
			//close the modal window
			$('#payinvoice-invoice-addbuyer').modal('hide');
			
			//change the currency as given by the buyer
			payinvoice.admin.invoice.on_buyer_change(key);
		}
		
	
};

payinvoice.admin.transaction = {
		refund : {	
			confirm : function(invoice_id){
				var url 	= 'index.php?option=com_payinvoice&view=transaction&task=refund&invoice_id='+invoice_id;
				payinvoice.url.modal(url);
			},
	
			request : function(invoice_id){
				payinvoice.ui.dialog.body('<div class="center"><span class="spinner">&nbsp;</span></div>');
				// XITODO : use bootstarp to disable the button click
				$('#payinvoice-invoice-refund-confirm-button').attr('disabled', 'disabled');
				var url 	= 'index.php?option=com_payinvoice&view=transaction&task=refund&confirmed=1&invoice_id='+invoice_id;
				payinvoice.ajax.go(url);
			}
		}
};

payinvoice.admin.dashboard = {
		statistics : {
			refresh : function (){
				var start_time 	= $('#payinvoice_form_statistics_start_time').val();
				var end_time 	= $('#payinvoice_form_statistics_end_time').val();
				var currency 	= $('#payinvoice_form_statistics_currency').val();
	
				var url 		= 'index.php?option=com_payinvoice&view=dashboard&task=refresh_statistics';
				var args   		= {'event_args' : {'start_time' : start_time, 'end_time' : end_time, 'currency' : currency} };
	
				$("#payinvoice-dashboard-chart-revenue").html('<div class="center"><span class="spinner">&nbsp;</span></div>');
				payinvoice.ajax.go(url, args); 
			}
		}
};

payinvoice.admin.config = {
		deleteLogo : {	
			confirm : function(){
				var url 	= 'index.php?option=com_payinvoice&view=config&task=removelogo';
				payinvoice.url.modal(url);
			},
	
			remove : function(invoice_id){
				payinvoice.ui.dialog.body('<div class="center"><span class="spinner">&nbsp;</span></div>');
				// XITODO : use bootstarp to disable the button click
				$('#payinvoice-invoice-deletelogo-confirm-button').attr('disabled', 'disabled');
				var url 	= 'index.php?option=com_payinvoice&view=config&task=removelogo&confirmed=1';
				payinvoice.ajax.go(url);
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
})(payinvoice.jQuery);
