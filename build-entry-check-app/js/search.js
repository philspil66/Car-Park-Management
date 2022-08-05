var search = {

	event_data 	: JSON.parse(localStorage.getItem('event_data')),
	user_search : null,
	search_type : 'basic',
	data 		: { results : [] },
	results_msg : null,

	init:function(){

		this.search_type_event();
		this.search_clear_event();
		this.search_focus_blur_event();
		this.search_event();

	},
	search_event:function(){

		var $this = this;

		// keyup event on user_search field
		$(document).on('keyup','input#user_search', function(e){

			// clear old results
			$this.data.results = [];

			// reset status icon
			$this.reset_status_icon();

			// get users_search, convert to uppercase, and strip out spaces
			$this.user_search = $('#user_search').val(); 
			$this.user_search = $this.user_search.toUpperCase();
			$this.user_search = $this.user_search.replace(/\s/g, '');

			// if user has started typing show the clear icon and hide the search icon
			if( $this.user_search.length != 0){
				$('a.search-icon').addClass('hide');
				$('a.clear-icon').addClass('show');
			}
			else{
			 	$('a.search-icon').removeClass('hide');
				$('a.clear-icon').removeClass('show');
			}

			// check that users search term is at least 3 characters long
			if( $this.user_search.length < 3){
				$this.set_msg_html('Please enter at least 3 characters');
				$('.results').html('');
				return false;
			}

			if( $this.event_data ){
				$this.search_type == 'basic' ? $this.basic_search() : $this.advanced_search();
			}
			else{
				$this.set_msg_html('No event data exists.');
			}

		});

	},
	basic_search:function(){

		// search for plate number
		this.search_field('plate'); 

		if( this.data.results.length == 0 ){	
			this.set_msg_html('<strong>0</strong> matches were found.');
			this.set_status_icon('red');
		}
		else if( this.data.results.length == 1 ){
			this.set_msg_html('<strong>1</strong> match was found.');
			this.set_status_icon('green');
		}
		else{
			this.set_msg_html('<strong>' + this.data.results.length  + '</strong> matches were found.');
			this.set_status_icon('amber');
		}

		// setup mustache JS template for displaying results
		var template = $('#result_basic_template').html();

		// render mustache template using data and add to .search-results elem
		$('.results').html( Mustache.render( template, this.data )); 

	},
	advanced_search:function(){

		// search for plate number
		this.search_field('plate'); 

		// if results not found search for postcode
		if( this.data.results.length == 0 ){					
			this.search_field('postcode');
		}
		
		// if results not found search for order reference
		if( this.data.results.length == 0 ){		
			this.search_field('order_ref');
		}
                
 		// if results not found search for fullname
		if( this.data.results.length == 0 ){		
			this.search_field('fullname');
		}               

		// if results not found display message
		if( this.data.results.length == 0 ){
			this.set_msg_html('<strong>0</strong> matches were found.'); 
			this.set_status_icon('red');
		}
		else if( this.data.results.length == 1){
			this.set_msg_html('<strong>1</strong> match was found.');
			this.set_status_icon('green');
		}
		else{
			this.set_msg_html('<strong>' + this.data.results.length  + '</strong> matches were found.');
			this.set_status_icon('amber');
		}

		// setup mustache JS template for displaying results
		var template = $('#result_advanced_template').html();

		// render mustache template using data and add to .search-results elem
		$('.results').html( Mustache.render( template, this.data )); 

	},
	search_type_event:function(){

		var $this = this;

		$(document).on('click','.search--type a',function(e){

			$this.search_type = $('.search--type a').index( this ) == 0 ? 'basic' : 'advanced';

			$('.search--type a').removeClass('active');
			$(this).addClass('active');
			
			$this.data.results = [];
			$this.user_search = '';
			$('input#user_search').val('').focus();
			$('.results, .msg').html('');
			$('.clear-icon').click();
			$this.reset_status_icon();

			e.preventDefault();

		});

	},
	search_focus_blur_event:function(){

		$(document).on('focus','input#user_search',function(e){
			$('.event--data').hide();
		});

		$(document).on('blur','input#user_search',function(e){
			$('.event--data').show();
		});

	},
	search_clear_event:function(){

		var $this = this;

		$(document).on('click','.clear-icon',function(e){

			$('#user_search').val('');
			$('.results').html('');
			$this.set_msg_html('');
			$this.reset_status_icon();
			$(this).removeClass('show');
			$('.search-icon').removeClass('hide');
			e.preventDefault();

		});

	},
	search_field:function(field){ 

		var search_field 	= null;
		var records 		= this.event_data.records;

		for( var i = 0 ; i < records.length ; i++ ){

			if(field == 'plate'){ 
				search_field = records[i].pn 
			}
			else if(field == 'postcode'){ 
				search_field = records[i].pc 
			}
			else if(field == 'order_ref'){ 
				search_field = records[i].or 
			}
 			else if(field == 'fullname'){ 
				search_field = records[i].fn 
			}  
  			else if(field == 'telephone'){ 
				search_field = records[i].tn 
			}                       

			if( search_field.indexOf(this.user_search) != -1 ){	

				this.data.results.push({ 
					plate : this.check_plate_data(records[i].pn),
					postcode : records[i].pc,
					order_ref : records[i].or,
					fullname : records[i].fn,
                                        telephone : records[i].tn,
					carpark_name : records[i].cp
				});

			} 

		} 

	},
	check_plate_data:function(plate){

		return plate == '' ? 'NO PLATE' : plate;

	},
	set_status_icon:function(status){

		$('.status-icon').addClass('show ' + status);

	},
	reset_status_icon:function(){

		$('.status-icon').removeClass('show red amber green');

	},
	set_msg_html:function(html){

		$('.msg').html(html);

	}

}

module.exports = search;
