
var event_details = {

	event_data : JSON.parse( localStorage.getItem('event_data') ),

	init:function(){

		if( this.event_data ){

			var data = {
				event_name : this.event_data.event_name,
				number_records : this.event_data.records.length
			}

			// Setup mustache JS template for displaying event details
			var template = $('#event_data_template').html();

			// Render mustache template using data and add to .event--details elem
			$('.event--data__details').html( Mustache.render( template, data ));

		}

	}

}

module.exports = event_details;
