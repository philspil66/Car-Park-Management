var $ = require('jquery');

var confirm = {

	init:function(){

		this.add_events(); 

	},
	add_events:function(){

		// open confirm popup
		$(document).on('click','.js-confirm',function(e){

			$('.overlay').addClass('active');
			$('.confirm--box').addClass('open'); 

			// set custom message if available
			if( $(this).attr('data-confirm-message') ){
				$('.confirm--box__content').html('<p>' + $(this).attr('data-confirm-message') + '</p>');
			}
			else{
				$('.confirm--box__content').html('<p>Are you sure you wish to continue?</p>');
			}

			if( $(this).attr('data-confirm-url') ){
				$('.confirm--box a').eq(0).attr('href', $(this).attr('data-confirm-url'));
			}

			if( $(this).attr('data-confirm-class') ){
				$('.confirm--box a').eq(0).addClass( $(this).attr('data-confirm-class') );
			}

			if( $(this).attr('data-confirm-id') ){
				$('.confirm--box a').eq(0).attr('data-confirm-id', $(this).attr('data-confirm-id'));
			}

			e.preventDefault();

		});

		// close confirm popup
		$(document).on('click','.js-confirm-close',function(e){

			$('.overlay').removeClass('active');
			$('.confirm--box').removeClass('open');
			e.preventDefault();

		});

	}

}

module.exports = confirm;