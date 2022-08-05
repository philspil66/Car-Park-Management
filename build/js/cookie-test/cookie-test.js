
var $ 		= require('jquery');
var Cookies = require('jquery-cookie');

var test_cookies = {

	init:function(){

		this.set_cookie();
		this.get_cookie();
		this.remove_cookie();

	},
	set_cookie : function(){

		$('a.set-cookie').click(function(){

			Cookies.set('user','Scott');
			return false;

		});

	},
	get_cookie : function(){

		$('a.view-cookie').click(function(){

			console.log( 'User cookie is: ' + Cookies.get('user') );
			return false;

		});

	},
	remove_cookie : function(){

		$('a.remove-cookie').click(function(){

			Cookies.remove('user');
			return false;

		});

	}

}

module.exports = test_cookies;