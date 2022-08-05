var $ = require('jquery');

var message = {

	init:function(){

		this.add_events(); 

	},
	add_events:function(){

		// open message popup
		$(document).on('click','.js-message',function(e){

			$('.overlay').addClass('active');
			$('.message--box').addClass('open'); 

			// set custom message if available
			if( $(this).attr('data-message-text') ){
				$('.message--box__content').html('<p>' + $(this).attr('data-message-text') + '</p>');
			}
			else{
				$('.message--box__content').html('<p>Please click ok to continue.</p>');
			}

			// set custom button text and url if available
			if( $(this).attr('data-message-button-text') && $(this).attr('data-message-button-url') ){
				$('.message--box a').eq(0).attr('href', $(this).attr('data-message-button-url'));
				$('.message--box a').eq(0).html( $(this).attr('data-message-button-text') );
			}

			e.preventDefault();

		});

		// close message popup
		$(document).on('click','.js-message-close',function(e){

			// close the message popup if the url has not bee set
			if( $('.message--box a').eq(0).attr('href') == '' ){
				$('.overlay').removeClass('active');
				$('.message--box').removeClass('open');
				e.preventDefault();
			}

		});

	} 

}

module.exports = message;