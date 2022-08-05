var $ 			= jQuery = require('jquery');
var validate 	= require('jquery-validate');

var create_password_form = {

	add_validation:function(){ 

		$('#create-password-form').validate({
			rules: {
			    password : {
			    	required : true,
			    	minlength : 5
			    },
			    password_confirmation : {
			    	required : true,
			    	minlength : 5,
			    	equalTo: '#password'
			    }
			},
			messages : {
				password : {
			    	required : 'Please enter your new password', 
			    	minlength : 'Your new password should be at least 5 characters long'
			    },
			    password_confirmation : {
			    	required : 'Please confirm your new password',
			    	minlength : 'Your new password should be at least 5 characters long',
			    	equalTo: 'Passwords do not match'
			    }
			}
		}); 
	}

}

module.exports = create_password_form;