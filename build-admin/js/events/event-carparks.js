var $ = require('jquery');

var event_carparks = {

	init:function(){

		this.carpark_dropdown_event();

	},
	carpark_dropdown_event:function(){

		// add carpark form dropdown change event (populates placeholder with data attribute on option element)
		$('#event__add__carpark__dropdown').on('change', function(){

			var max = $(this).find(':selected').data('car-park-capacity');
			$('input#allocated').attr('placeholder', max ? 'Max ' + max : '');
			
		});

	}

}

module.exports = event_carparks;