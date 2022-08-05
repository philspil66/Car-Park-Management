
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Teams', 'url' => '/admin/teams']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Teams</h1>
				</div>
				<div class="panel__body">

					{{-- tabs --}}
					<div class="tabs">
						<a class="active">All Teams</a>
						<a href="/admin/teams/add-edit">Add</a>
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
								<table class="table--base" id="teams-table">
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
							                	Category
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
	