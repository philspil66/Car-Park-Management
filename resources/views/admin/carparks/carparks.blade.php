
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Car Parks', 'url' => '/admin/carparks']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Car Parks</h1>
				</div>
				<div class="panel__body">

					{{-- tabs --}}
					<div class="tabs">
						<a class="active">All Car Parks</a>
						<a href="/admin/carparks/add-edit">Add</a>
					</div>
					<div class="tabs--content">
					<div class="tabs--content__panel active">
						<div class="tabs--content__spacer">

							@if ( Session::has('success') )
					            <div class="msg msg-success">
						            <ul>                
						                <li><i class="icon-info"></i> {{ Session::get('success') }}</li>
						            </ul>
					            </div>
					        @endif

							{{-- datatable --}}
							<div class="table--wrapper">
								<table class="table--base" id="carparks-table">
							        <thead>
							            <tr>
 							                <th>
							                	ID
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>
							                <th>
							                	Name
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>           
							                <th>
							                	SKU
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>
							                <th>
							                	Capacity
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>
							                <th>
							                	Priority
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>
							                <th>&nbsp;</th>
							            </tr>
							        </thead>
							    </table>
						    </div>
						    {{-- end datatable --}}

						</div>

					</div>
					</div>

				</div>
			</div>


		</div>

	@endsection
	