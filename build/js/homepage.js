var $ = require('jquery');
var height_normalise = require('./helpers/height-normalise.js'); 

var homepage = {

	init:function(){

		if( $(window).width() > 800){
			height_normalise.children_by_parent('.js-category-row', '.js-category-column');
			this.window_resize_event();
		}

	},
	window_resize_event:function(){

		var timeout;
		$(window).resize(function(){

		    clearTimeout(timeout);
		    timeout = setTimeout(function(){  

		    	$('.js-category-column').css('height','auto');
		    	height_normalise.children_by_parent('.js-category-row', '.js-category-column');

		    }, 250);

		});

	}

}

module.exports = homepage;