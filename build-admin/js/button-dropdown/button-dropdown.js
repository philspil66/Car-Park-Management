
var $ = require('jquery');

var button_dropdown = {

	init:function(){

		$(document).on('click','.button--dropdown',function(e){

			var $dropdown_elem = $(this).siblings('.dropdown');

			if( $dropdown_elem.hasClass('open') ){
				$dropdown_elem.removeClass('open'); 
			}
			else{
				$dropdown_elem.addClass('open');
			}

			e.stopPropagation();
			e.preventDefault();

		});

		$(document).click(function(){
			$('.button--dropdown').siblings('.dropdown').removeClass('open');
		});

	}

}

module.exports = button_dropdown;