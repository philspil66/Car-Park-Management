
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(['title' => 'Datatable - Categories'])
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="card">
					
				<h2>datatable: categories</h2>

				<div class="table--wrapper">
					<table class="table--base" id="categories-table">
				        <thead>
				            <tr>
				                <th>
				                	Id
				                	<i class="icon-filter"></i>
				                	<i class="icon-filterup"></i>
				                	<i class="icon-filterdown"></i>
				                </th>
				                <th>
				                	Description
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
				
				// categories table
			    $('#categories-table').DataTable({

			    	bAutoWidth : false,
			        processing: true,
			        serverSide: true,
			        ajax: '/datatable-categories/data',
			        "pagingType": "simple_numbers",
			        
			        columns: [
			            { data: 'id', name: 'id' },
			            { data: 'description', name: 'description'},
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
			        	{ "width" : "5%", "targets" : 0},
			        	{ "width" : "85%", "targets" : 1},
			        	{ 
			        		"width" : "10%", 
			        		"targets" : 2,
		                	"render": function ( data, type, row ) {

			                	var edit_url 	= '/edit-user/' + data; 
			                	var delete_url	= '/delete-user/' + data;

			                	var actions = '';
			                	actions += '<a class="icon--link" href="' + edit_url + '"><i class="icon-cogs"></i></a>';
			                	actions += '<a class="icon--link js-confirm" href="" data-confirm-url="' + delete_url + '" data-confirm-message="Are you sure you wish to delete (' + data + ')?">';
			                	actions += '	<i class="icon-bin2"></i>';
			                	actions += '</a>';
			                	return actions;

			                }
			            }
			        ]
			         
			    });

			});
		</script>

	@endsection