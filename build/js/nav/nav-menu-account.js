var $ = require('jquery');

var nav_menu_account = {

	events:function(){

		$('.account-icon a').on('click', function(){

			$('.nav--account--mobile').addClass('nav--open');
			$('body').addClass('overlay--open');
			return false;

		});

		$('.nav--account--mobile .nav__close').on('click',function(){

			$('.nav--account--mobile').removeClass('nav--open');
			$('body').removeClass('overlay--open');
			return false;

		});

	}

}

module.exports = nav_menu_account;