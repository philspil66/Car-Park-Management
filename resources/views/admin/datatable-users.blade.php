
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(['title' => 'Datatable - Users'])
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="card">

				<h2>datatable: users</h2>

				<div class="table--wrapper">
					<table class="table--base" id="users-table">
				        <thead>
				            <tr>
				                <th>
				                	Id
				                	<i class="icon-filter"></i>
				                	<i class="icon-filterup"></i> 
				                	<i class="icon-filterdown"></i> 
				                </th>
				                <th>
				                	First Name 
				                	<i class="icon-filter"></i>
				                	<i class="icon-filterup"></i> 
				                	<i class="icon-filterdown"></i> 
				                </th>
				                <th>
				                	Last Name
				                	<i class="icon-filter"></i>
				                	<i class="icon-filterup"></i> 
				                	<i class="icon-filterdown"></i>
				                </th>
				                <th>
				                	Email
				                	<i class="icon-filter"></i>
				                	<i class="icon-filterup"></i> 
				                	<i class="icon-filterdown"></i>
				                </th>
				                <th>Actions</th>
				            </tr>
				        </thead>
				    </table>
			    </div>

			</div>

		</div>
	@endsection

	@section('snippet-bottom')

		<script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
		<script>
			$(function() {

				// users table
			   $('#users-table').DataTable({

			    	bAutoWidth : false,
			        processing: true,
			        serverSide: true,
			        ajax: '/datatable-users/data',
			        "pagingType": "simple_numbers",
			        
			        columns: [
			            { data: 'id', name: 'id' },
			            { data: 'firstname', name: 'firstname' },
			            { data: 'lastname', name: 'lastname' },
			            { data: 'email', name: 'email' },
			            { data: 'id', name: 'id' }
			        ],

			        "oLanguage": {
				      	"sLengthMenu": '<select>'+
				        	'<option value="10">10</option>'+
				        	'<option value="25">25</option>'+
				        	'<option value="50">50</option>'+
				        	'<option value="100">100</option>' +
				        	'</select> Records per page',
				        "sProcessing" : '<div class="spinner"><i class="icon-spinner"></i></div>'
					},

			        "columnDefs": [
			        	{ "width" : "10%", "targets" : 0},
			        	{ "width" : "20%", "targets" : 1},
			        	{ "width" : "20%", "targets" : 2},
			        	{ "width" : "40%", "targets" : 3},
			        	{ 
			        		"width" : "10%",
			        		"targets" : 4,
			                "render": function ( data, type, row ) {

			                	var edit_url 	= '/edit-user/' + data; 
			                	var delete_url	= '/delete-user/' + data;

			                	var actions = '';
			                	actions += '<a class="icon--link" href="' + edit_url + '"><i class="icon-cogs"></i></a>';
			                	actions += '<a class="icon--link" href="' + delete_url + '"><i class="icon-bin2"></i></a>';
			                	return actions;

			                }
		            	}    
			        ]

			    });

			});
		</script>

	@endsection