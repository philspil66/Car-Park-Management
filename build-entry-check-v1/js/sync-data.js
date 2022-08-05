
var sync_data = {

	data : {
		event_name : null,
		number_records : null
	},

	init:function(){

		var $this = this;

		// Sync data click event
		$(document).on('click', '#load_data', function(e){

			if( $this.has_connection() ){ 

				$.ajax({
	                headers: {  'X-CSRF-TOKEN': $('#_token').val() },
	                url: 'get-webapp-data/', 
	                type: 'post',
	                cache: false,
	                success: function(response) {

	                	localStorage.setItem('event_data', response);
	                	window.location.reload();

	                }
	            });

			}
			else{
				$('#load_data').html('No data connection is available...');
				setTimeout(function(){
					$('#load_data').html('Sync Data');
				},3000);
				return false;
			}

            e.preventDefault();

		});

		// Delete data click event
		$(document).on('click', '#delete_data', function(e){
			localStorage.removeItem('event_data');
			window.location.reload();
		});

	},
	has_connection:function(){

		var connection_available = false;
		var cache_buster = Math.round(Math.random() * 10000);

		$.ajax({
            headers: {  'X-CSRF-TOKEN': $('#_token').val() },
            url: 'images/entry-check-app/dont-delete.jpg?cache_buster=' + cache_buster,
            type: 'post',
            async: false,
            cache: false,
            success: function(response) {

            	connection_available = true;

            }
	    });

		return connection_available;

	}

}

module.exports = sync_data;