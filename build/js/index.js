// required files for application
var modernizr				= require('modernizr'); 

var nav_menu 				= require('./nav/nav-menu.js');
var nav_menu_account		= require('./nav/nav-menu-account.js'); 
var login_form 				= require('./form-validation/login.js');
var contact_form			= require('./form-validation/contact.js');
var register_form			= require('./form-validation/register.js'); 
var create_password_form	= require('./form-validation/create-password.js');
var reset_password_form		= require('./form-validation/reset-password.js');
var change_password_form	= require('./form-validation/change-password.js');
var checkout_details_form	= require('./form-validation/checkout-details.js');
var overlay					= require('./overlay/overlay.js');  
//var checkout_payment_form	= require('./form-validation/checkout-payment.js'); 
//var cookie_test			= require('./cookie-test/cookie-test.js');

$(document).ready(function(){

	// mobile navigaton click events
	nav_menu.events();
	nav_menu_account.events();

	// form validation
	login_form.add_validation();
	contact_form.add_validation();
	register_form.add_validation();
	create_password_form.add_validation();
	reset_password_form.add_validation();
	change_password_form.add_validation();
	checkout_details_form.add_validation();
	//checkout_payment_form.add_validation();

	// cookies
	//cookie_test.init();

	// run JS functionality depending on window.context set in view
	if( window.context == 'homepage' ){

		var homepage = require('./homepage.js'); 
		homepage.init();

	} 

});

