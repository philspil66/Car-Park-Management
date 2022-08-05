var $ = jQuery = require('jquery');

var overlay = {

	open_overlay : function(){

		$('.overlay').addClass('open');


	},
	close_overlay : function(){

		$('.overlay').removeClass('open');

	},
	set_overlay_content : function(content, close_icon){ 

		// TO DO: add close icon (which can be turned off by setting close_icon to false)
		if(close_icon == undefined){
			close_icon = true;
		}

		$('.overlay .overlay__content').html(content);

	}

}

module.exports = overlay;