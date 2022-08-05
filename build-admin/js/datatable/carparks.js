
var datatable_carparks = {

	init:function(){

		$('#carparks-table').DataTable({

		   	pageLength: 20,
	    	bAutoWidth : false,
	    	dom: 'tipr',
	        processing: true,
	        serverSide: true,
	        ajax: '/admin/carparks/data',
	        pagingType: 'simple_numbers',
	        
	        columns: [
                { data: 'id', name: 'id' },
	            { data: 'name', name: 'name' },
	            { data: 'sku', name: 'sku' },
                { data: 'capacity', name: 'capacity' },
                { data: 'priority', name: 'priority' },
                { data: 'id', name: 'id' }
	        ],

	        oLanguage: {
		      	sLengthMenu: '<select>'+
		        	'<option value="20">20</option>'+
		        	'<option value="50">50</option>'+
		        	'<option value="100">100</option>' +
		        	'</select> Records per page',
		        sProcessing : '<div class="spinner"><i class="icon-spinner"></i></div>'
			},

			columnDefs: [
                { "width" : "5%",  "targets" : 0},
	        	{ "width" : "48%", "targets" : 1},
	        	{ "width" : "22%", "targets" : 2},
	        	{ "width" : "10%", "targets" : 3},
	        	{ "width" : "10%", "targets" : 4},
	        	{ 
	        		"width" : "5%", 
	        		"targets" : 5,
	        		"render": function ( data, type, row ) {

	        			var link = 	'<a class="icon--link" href="/admin/carparks/add-edit?id=' + data + '"><i class="icon-pencil"></i></a>';

	        			return link;

	                }
	        	
	        	}    
	        ]

	    });

	}

}

module.exports = datatable_carparks;