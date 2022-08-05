$(document).ready(function(){

	confirm_box.init();

});

var confirm_box = {

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
				$('.confirm--box p').html($(this).attr('data-confirm-message'));
			}

			if( $(this).attr('data-confirm-url') ){
				$('.confirm--box a').eq(0).attr('href', $(this).attr('data-confirm-url'));
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