var $ 				= require('jquery');
var Mustache 		= require('mustache');
var sync_data		= require('./sync-data');
var event_details	= require('./event-details');
var entry_check 	= require('./entry-check');

$(document).ready(function(){

	if( window.localStorage ){

		sync_data.init();
		event_details.init();
		entry_check.init(); 

	}
	else{

		$('.info').html('Your device does not support local storage');

	}

});
