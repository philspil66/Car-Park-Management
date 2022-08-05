$(document).ready(function(){

	menu.init(); 

});

var menu = {

	init:function(){

		this.toggle_menu();
		this.toggle_sub_menu();

	},
	toggle_menu:function(){

		$(document).on('click', 'a.header__menu__icon', function(e){

			if( $('.menu').hasClass('menu-collapsed') ){

				$('.menu').removeClass('menu-collapsed');
				$('.site-wrapper').removeClass('no-menu');

			}
			else{

				$('.menu').addClass('menu-collapsed');
				$('.site-wrapper').addClass('no-menu');

			}

			e.preventDefault();

		});

	},
	toggle_sub_menu:function(){

		$(document).on('click', '.menu .menu__top a', function(e){

			var $sub_menu = $(this).parent().find('ul.menu__sub');

			if( $sub_menu.length ){
				
				if( ! $sub_menu.hasClass('open') ){

					// hide all open sub menus
					$('ul.menu__sub').slideUp().removeClass('open');
					$('.menu .menu__top a').removeClass('active');

					// show active sub menu
					$sub_menu.slideDown();
					$sub_menu.addClass('open');
					$(this).addClass('active');
					
				}
				else{

					$sub_menu.slideUp();
					$sub_menu.removeClass('open');
					$(this).removeClass('active');

				}

				e.preventDefault();
			}

		});

	}

}

