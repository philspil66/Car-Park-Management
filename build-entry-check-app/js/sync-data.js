
var sync_data = {

	cache_buster : null,

	init:function(){

		this.sync_data_event();
		this.delete_data_event();

	},
	sync_data_event:function(){

		var $this = this;

		$(document).on('click', '.sync-data', function(e){

			$this.cache_buster = Math.round(Math.random() * 10000);

			// ajax request an image file to test for connection (using cache_buster number above)
			$.ajax({
	            headers: {  'X-CSRF-TOKEN': $('#_token').val() },
	            url: '/images/entry-check-app/dont-delete.jpg?cache_buster=' + $this.cache_buster,
	            cache: false
		    })
		    .done(function(){ 
		    	$this.sync_data(); 
		    })
		    .fail(function(){ 
		    	$this.set_sync_link_text('No data connection available...');  
		    });

		    e.preventDefault();

		});

	},
	sync_data:function(){

		var $this = this;

		$.ajax({
            headers: {  'X-CSRF-TOKEN': $('#_token').val() },
            url: 'get-webapp-data/',
            cache: false
        })
        .done(function(data){
        	localStorage.setItem('event_data', data);
            window.location.reload();
        })
        .fail(function(){
        	$this.set_sync_link_text('Data sync failed...'); 
        });

	},
	set_sync_link_text:function(text){

		$('.sync-data').html(text);
    	setTimeout(function(){
    		$('.sync-data').html('<i class="icon-repeat"></i> Sync Data');
    	},3000);

	},
	delete_data_event:function(){

		$(document).on('click', '.delete-data', function(e){
			localStorage.removeItem('event_data');
			window.location.reload();
		});

	}

}

module.exports = sync_data;