var $ 			= jQuery = require('jquery');
var validate 	= require('jquery-validate');

var login_form = {

	add_validation:function(){

		$('#login-form').validate({
			rules: {
			    user_email : {
			    	required : true,
			    	email : true
			    },
			    user_password : {
			    	required : true,
			    	minlength : 5
			    }
			},
			messages : {
			    user_email : {
			    	required : 'Please enter your email address',
			    	email : 'Please enter a valid email address'
			    },
			    user_password : {
			    	required : 'Please enter your password',
			    	minlength : 'Your password must be at least 5 characters long'
			    }
			}
		}); 
	}

}

module.exports = login_form;
