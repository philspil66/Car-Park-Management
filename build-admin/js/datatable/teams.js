
var datatable_teams = {

	init:function(){

		$('#teams-table').DataTable({

		   	pageLength: 20,
	    	bAutoWidth : false,
	    	dom: 'tipr',
	        processing: true,
	        serverSide: true,
	        ajax: '/admin/teams/data',
	        pagingType: 'simple_numbers',
	        
	        columns: [
                { data: 'id', name: 'id' },
	            { data: 'name', name: 'name' },
	            { data: 'description', name: 'description' },
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
	        	{ "width" : "35%", "targets" : 1},
	        	{ "width" : "35%", "targets" : 2},
	        	{ 
	        		"width" : "5%", 
	        		"targets" : 3,
	        		"render": function ( data, type, row ) {

	        			var link = 	'<a class="icon--link" href="/admin/teams/add-edit?id=' 
	        			    	   	+ data + '"><i class="icon-pencil"></i></a>';
	        			return link;
	                }	        	
	        	}    
	        ]

	    });

	}

}

module.exports = datatable_teams;