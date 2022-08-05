var $ 			= jQuery = require('jquery');
var validate 	= require('jquery-validate');
var overlay		= require('../overlay/overlay.js');

var checkout_payment_form = {

	add_validation:function(){

		$('#checkout-payment-form').validate({ 
			rules: {
			    order_card_holder : {
			    	required : true
			    },
			    order_card_number : {
			    	required : true
			    },
			    order_card_security : {
			    	required : true
			    }
			},
			messages : {
				order_card_holder : {
			    	required : 'Please enter card holders name',
			    },
			    order_card_number : {
			    	required : 'Please enter card number'
			    },
			    order_card_security : {
			    	required : 'Please enter card security code'
			    }
			},
			submitHandler:function(form){

				var content = '';
				content += '<h2>Payment Processing</h2>';
				content += '<p>Please be patient while we process your payment.</p>';
				content += '<div class="ajax__loader"></div>';

				// set overlay content
				overlay.set_overlay_content(content, false);

				// open the overlay
				overlay.open_overlay();

				form.submit();

			}
		});

	},

}

module.exports = checkout_payment_form;