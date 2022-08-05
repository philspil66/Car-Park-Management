var $ 			= jQuery = require('jquery');
var validate 	= require('jquery-validate');

var reset_password_form = {

	add_validation:function(){

		$('#reset-password-form').validate({
			rules: {
				email : {
					required : true,
					email: true
				}
			},
			messages : {
				email : {
			    	required : 'Please enter your email address', 
			    	email : 'Please enter a valid email address'
			    }
			}
		}); 
	}

}

module.exports = reset_password_form;