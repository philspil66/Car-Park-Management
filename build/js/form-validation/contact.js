var $ 			= jQuery = require('jquery');
var validate 	= require('jquery-validate');

var contact_form = {

	add_validation:function(){

		$('#contact-form').validate({
			rules: {

				enquiry_type : {
					required : true
				},
				user_name : {
					required : true
				},
				user_email : {
					required : true,
			    	email : true,
				},
				user_phone : {
					required : true
				}

			},
			messages : {

				enquiry_type : {
					required : 'Please choose an enquiry type'
				},
				user_name : {
					required : 'Please enter your name'
				},
				user_email : {
					required : 'Please enter your email address',
			    	email : 'Please enter a valid email address'
				},
				user_phone : {
					required : 'Please enter your phone number'
				}

			}
		}); 
	}

}

module.exports = contact_form;