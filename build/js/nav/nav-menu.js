
var $ = require('jquery');

var nav_menu = {

	events:function(){

		$('.js-nav-open').on('click', function(){

			$('.nav--mobile').addClass('nav--open');
			$('body').addClass('overlay--open');
			return false;

		});

		$('.js-nav-close').on('click',function(){

			$('.nav--mobile').removeClass('nav--open');
			$('body').removeClass('overlay--open');
			return false;
		});

	}

}

module.exports = nav_menu;