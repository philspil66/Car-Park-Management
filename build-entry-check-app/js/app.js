var $ 				= require('jquery');
var Mustache 		= require('mustache');
var sync_data		= require('./sync-data');
var event_details	= require('./event-details');
var search 			= require('./search'); 

$(document).ready(function(){

	if( window.localStorage ){

		sync_data.init();
		event_details.init();
		search.init();

	}
	else{

		$('.msg').html('Your device does not support local storage');

	}

});
