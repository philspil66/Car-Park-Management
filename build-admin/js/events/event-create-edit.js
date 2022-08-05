var $ 			= require('jquery');
var jquery_ui 	= require('jquery-ui');

var event_create_edit = {

	init:function(){

		$('#event_date').datepicker({
			'dateFormat' : 'yy-mm-dd',
			'minDate' : new Date()
		});

	}

}

module.exports = event_create_edit;