
var datatable_orders = {

	init:function(){

		var orders_table = $('#orders-table').DataTable({

	   	    pageLength: 20,
	    	bAutoWidth: false,
	    	dom: "tipr",
	        processing: true,
	        serverSide: true,			        
	        ajax: {
	        	url : '/admin/orders/data',
	        	data: function ( d ) {

	        		d.search.value  = $('.search-input').val().toLowerCase();
					d.search_column = $('.search-column').val();
					
				}
			},
			
	        pagingType: 'simple_numbers',
	        
	        columns: [
	            { data: 'order_ref', name: 'order_ref' },
	            { data: 'created_at', name: 'created_at' },
	            { data: 'firstname', name: 'firstname' },
	            { data: 'lastname', name: 'lastname' },
	            { data: 'email', name: 'email' },
	            { data: 'transaction_ref', name: 'transaction_ref' },
	            { data: 'id', name: 'id' }
	        ],

	        order: [[ 6, "desc" ]],

	        oLanguage: {
		      	sLengthMenu: '<select>'+
		        	'<option value="20">20</option>'+
		        	'<option value="50">50</option>'+
		        	'<option value="100">100</option>' +
		        	'</select> Records per page',
		        sProcessing : '<div class="spinner"><i class="icon-spinner"></i></div>'
			},

			columnDefs: [
	        	{ "width" : "10%", "targets" : 0},
	        	{ "width" : "15%", "targets" : 1},
	        	{ "width" : "15%", "targets" : 2},
	        	{ "width" : "15%", "targets" : 3},
	        	{ "width" : "20%", "targets" : 4},
	        	{ "width" : "20%", "targets" : 5},
	        	{ 
	        		"width" : "5%", 
	        		"targets" : 6,
	        		"render": function ( data, type, row ) {

	        			var link = 	'<a class="icon--link" href="/admin/orders/view?order_id=' 
	        						+ data + '"><i class="icon-eye"></i></a>&nbsp;' + 
	        						'<a class="icon--link" href="/admin/impersonate/?order_id=' 
	        						+ data + '"><i class="icon-user"></i></a>';

	        			return link;

	                }			        	
	        	}    
	        ]

	    });

		// orders table uses custom search box as we need a select filter
		// default one is disabled in 'dom' options above
		$('.search-input').on('keyup',function(){
			orders_table.search( $(this).val() ).draw();
		});

		// change filter event (re-searches on selected column)
		$('.search-column').on('change',function(){
			orders_table.search( $('.search-input').val() ).draw();
		});

	}

}

module.exports = datatable_orders;