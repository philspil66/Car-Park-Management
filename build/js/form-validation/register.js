var $ 			= jQuery = require('jquery');
var validate 	= require('jquery-validate');

var register_form = {

	add_validation:function(){

		$('#register-form').validate({
			rules: {

				user_firstname : {
					required : true
				},
				user_surname : {
					required : true
				},
				email : {
					required : true,
			    	email : true,
				},
				user_password : {
					required : true
				},
				user_password_confirm : {
					required : true,
					equalTo: '#user_password'
				},
				terms_agree : {
					required : true
				}

			},
			messages : {

				user_firstname : {
					required : 'Please enter your firstname'
				},
				user_surname : {
					required : 'Please enter your surname'
				},
				email : {
					required : 'Please enter your email address',
			    	email : 'Please enter a valid email address'
				},
				user_password : {
					required : 'Please enter your password'
				},
				user_password_confirm : {
					required : 'Please confirm your password',
					equalTo: 'Passwords do not match'
				},
				terms_agree : {
					required : 'You must agree to our terms before you can register'
				}

			}
		}); 
	}

}

module.exports = register_form;
