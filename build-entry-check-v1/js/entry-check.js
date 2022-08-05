var entry_check = {

	user_search : null,
	event_data 	: JSON.parse(localStorage.getItem('event_data')),
	data 		: { results : [] },
	results_msg : null,

	init:function(){

		var $this = this;

		// keyup event on user_search field
		$(document).on('keyup','input#user_search', function(e){

			// clear old results
			$this.data.results = [];

			// get users_search, convert to uppercase, and strip out spaces
			$this.user_search = $('#user_search').val(); 
			$this.user_search = $this.user_search.toUpperCase();
			$this.user_search = $this.user_search.replace(/\s/g, '');

			// if user has started typing a search term show the clear search button
			$this.user_search.length != 0 ? $('a.clear-search').addClass('show') : $('a.clear-search').removeClass('show');

			// check that users search term is at least 3 characters long
			if( $this.user_search.length < 3){
				$this.set_info_html('Please enter at least 3 characters');
				$('.results').html('');
				return false;
			}

			// check if event data is available		
			if( $this.event_data ){

				// search for plate number
				$this.search_field('plate'); 

				// if results not found search for postcode
				if( $this.data.results.length == 0 ){					
					$this.search_field('postcode');
				}
				
				// if results not found search for order reference
				if( $this.data.results.length == 0 ){		
					$this.search_field('order_ref');
				}

				// if results not found display message
				if( $this.data.results.length == 0 ){
					$this.set_info_html('No results were found.');
				}
				else{

					if( $this.data.results.length == 1){
						$this.results_msg = '<strong>1</strong> result was found.';
					}
					else{
						$this.results_msg = '<strong>' + $this.data.results.length  + 
						                    '</strong> results were found.'
					}

					$this.set_info_html($this.results_msg);
				}

			}
			else{
				$this.set_info_html('<strong>0</strong> matches were found.');
			}

			// setup mustache JS template for displaying results
			var template = $('#results_template').html();

			// render mustache template using data and add to .search-results elem
			$('.results').html( Mustache.render( template, $this.data ));

		});

		// prevent search form from submitting when user hits enter
		$('.search-form form').submit(function(e){
			e.preventDefault();
		});
	
		// click event for clear search button
		$(document).on('click','.clear-search',function(e){

			$('#user_search').val('');
			$('.results').html('');
			$this.set_info_html('');
			$(this).removeClass('show');
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

			if( search_field.indexOf(this.user_search) != -1 ){	

				this.data.results.push({ 
					plate : this.check_data(records[i].pn),
					postcode : this.check_data(records[i].pc),
					order_ref : this.check_data(records[i].or),
					fullname : this.check_data(records[i].fn),
					carpark_name : this.check_data(records[i].cp)
				});

			}

		} 

	},
	check_data:function(field){

		// if the field is blank set field as 'n/a' and return
		if( !field ){
			field = 'n/a'; 
		}
		return field;

	},
	set_info_html:function(html){

		$('.info').html(html);

	}

}

module.exports = entry_check;
