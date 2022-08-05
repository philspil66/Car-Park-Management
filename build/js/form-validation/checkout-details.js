var $ 			= jQuery = require('jquery');
var validate 	= require('jquery-validate');

var checkout_details_form = {

	add_validation:function(){

		$('#checkout-details-form').validate({ 
			rules: {
			    address1 : {
			    	required : true
			    },
			    postcode : {
			    	required : true
			    },
			    telephone : {
			    	required : true
			    } 
			},
			messages : {
				address1 : {
			    	required : 'Please enter address line 1',
			    },
			    postcode : {
			    	required : 'Please enter your postcode'
			    },
			    telephone : {
			    	required : 'Please enter your mobile number'
			    }
			}
		});

	}
}

module.exports = checkout_details_form;